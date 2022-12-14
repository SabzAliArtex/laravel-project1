<?php
use App\User;
use App\License;
use App\Apiloggs;
use Carbon\Carbon;
use App\LicenseHistory;
use App\License_devices;
use App\LicenseActivation;
use App\PurchaseHistory;
use Jenssegers\Agent\Agent;
use Illuminate\Http\Request;
use App\Traits\LicenseBooking;
use Illuminate\Support\Facades\Hash;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;
use App\Notifications\LicensePurchased;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Notification;


/**
 * Premium Checker
 * Returns true or false regarding current
 * logged user's READ permission with given keyname.
 *
 * @param type $permissionName
 * @return boolean
 */ 

  
function generate_license_key(){
   $rendom_string =  config('app.License_prefix').random_str(16);
   $license_key = License::where('license','=' , $rendom_string)->first();
   if($license_key){
        return generate_license_key();
   }

   return $rendom_string;
}
function random_str($length = 8)
{
    $chars = '0123456789bcdfghjklmnprstvwxzaeiou';
    $result = '';
    for ($p = 0; $p < $length; $p++)
    {
        $result .= ($p%2) ? $chars[mt_rand(19, 23)] : $chars[mt_rand(0, 18)];
    }

    return strtoupper($result);
}
function getLicenseLimit($license_count_rows, $license_device_limit,$user_id,$license_id,$dev_name,$dev_os,$dev_id,$is_valid,$expiry_date){
  if($license_count_rows < $license_device_limit){
      $license_devices = new License_devices();
      $license_devices->user_id = $user_id;
      $license_devices->license_id = $license_id;
      $license_devices->device_id = $dev_id;
      $license_devices->device_name = $dev_name;
      $license_devices->device_os = $dev_os;
      $license_devices->activation_date = date("Y-m-d H:i:s");
      $license_devices->save();    
      return success_code(300,$license_devices,$is_valid,$expiry_date);
  } else {
    return limit_error_code(600,$license_device_limit);
  }
}
function success_code($num,$license,$is_valid,$expiry_date)
{
  if($num == 300){
    $isTrial=false;
    $responseLicense = new LicenseBooking();
    $responseLicense->set_license($license,$isTrial); 
    return json_encode(array("License"=>$responseLicense,"Message"=>"Activated","IsOK"=>true,"IsError"=>false,"IsValid"=>$is_valid,"ExpiryDate"=>$expiry_date));
  }
}
function error_code($code){
  if(isset($code)){
    if($code == 500)
    {
      $isTrial=false; 
      $responseLicense = new LicenseBooking();
      return json_encode(array("License"=>$responseLicense,"Message"=>"Duplication not Allowed. License Already Activated for this device.","IsOK"=>false,"IsError"=>true,"IsValid"=>true,"ExpiryDate"=>""));
    }
    else if($code == 400)
    {
      $response['Message'] = "Not a Registered User";
    return json_encode($response);
    }

  }
}
function has_error(string $code , int $limit = NULL){
    if($code == 'not_purchased')
    {
      $message = 'Please Purchase License First';
    }
    if($code == 'expired')
    {
      $message = 'License is Expired please Renew it or Buy a new one';
    }
    if($code == 'same_device')
    {
      $message = 'Duplication not Allowed. License Already Activated for this device.';
    }
    if($code == 'limit')
    {
      $message = "License is valid for ".$limit." devices.";
    }
    if($code == 'invalid')
    {
      $message = "Your License is Invalid.";
    }

    $responseLicense = new LicenseBooking();
      $response = json_encode(array("License"=>$responseLicense,"Message"=>$message,"IsOK"=>false,"IsError"=>true,"IsValid"=>true,"ExpiryDate"=>""));
    return $response;
}
function removeSpace($value){
  $result = str_replace(' ','',$value);
  return $result;
}
  function loggs($payload)
{
  $current_route = Route::getCurrentRoute()->uri;
  $current_controller = Route::getCurrentRoute()->getActionName();
  $current_payload = json_encode($payload);
  $log = new Apiloggs(); 
  $log->current_url = $current_route;
  $log->current_controller = $current_controller;
  $log->current_payload = $current_payload;
  $log->current_payload_type = $payload['type']??null;
  $log->save();
  if ($log)
  {
    $response['message'] = "Loggs are being maintained";
    return json_encode($response);
  } else {
    $response['message'] = "Failed to maintain Loggs";
    return json_encode($response);
  }
}
function order_meta_loggs($payload , $type)
{
  $log = new Apiloggs(); 
  $log->current_url = Route::getCurrentRoute()->uri;
  $log->current_controller = Route::getCurrentRoute()->getActionName();
  $log->current_payload = $payload;
  $log->current_payload_type = $type;
  $log->save();
  if ($log)
  {
    $response['message'] = "Loggs are being maintained";
    return json_encode($response);
  }
  else
  {
    $response['message'] = "Failed to maintain Loggs";
    return json_encode($response);
  }
}

function calculateExpiry($license_data){
  if ($license_data->license_type->type == 1) 
  {
    $next_month = strtotime('+1 month', strtotime($license_data->license_activated_at));

    $license_data->license_expiry = date('Y:m:d H:i:s', $next_month);
    $licenseValidity = ($license_data->license_activated_at >= $next_month) ? 'false' : 'true';
    if ($licenseValidity == true)
    {
      return $expiry_date = $license_data->license_expiry;
    }
    else
    {
      return $expiry_date = $license_data->license_expiry;
    }
  } elseif($license_data->license_type->type == 2) {
      // Yearly
      $next_year = strtotime('+1 year', strtotime($license_data->license_activated_at));
      $license_data->license_expiry = date('Y:m:d H:i:s', $next_year);
      $licenseValidity = ($license_data->license_activated_at >= $next_year) ? 'false' : 'true';
      if ($licenseValidity == true)
      {
        return  $expiry_date = $license_data->license_expiry;
      }
      else
      {
        return  $expiry_date = $license_data->license_expiry;
      }
  } elseif($license_data->license_type->type == 3) {
      // Lifetime 
    $licenseValidity = true;
    return $expiry_date = $license_data->license_expiry;
  } else { 
    return  $expiry_date = $license_data->license_expiry;
  }
}
function trialActivateGeneral($licenseTrial, $startTrialTime,$existing)
{
  if (isset($licenseTrial))
  {
    if($existing == false){
      $licenseTrial->trial_activated_at = $startTrialTime;
      $licenseTrial->save();
    }
    LicenseHistory::updateOrCreate([
      'license_id'=>$licenseTrial->id
    ],[
      "user_id"=>$licenseTrial->user_id,
      "license_expiry"=>NULL,
      "trial_activated_at"=>$startTrialTime,
      "license_activated_at"=>NULL
    ]);
    $isTrial = True;
    $responseLicenseTrial = new LicenseBooking();
    $responseLicenseTrial->set_license($licenseTrial, $isTrial);
    if($existing == true)
    {
      return json_encode(array("License" => $responseLicenseTrial, "Message" => "Trial Already Activated purchase license for full features", "IsOK" => true, "IsError" => false,"IsTrial"=>$isTrial));
    }
      return json_encode(array("License" => $responseLicenseTrial, "Message" => "Trial Activated", "IsOK" => true, "IsError" => false,"IsTrial"=>$isTrial));
  } else {
    $response['Message'] = "License Key is not valid";
    return json_encode($response);
  }
}
function findUser($user)
{
  $userPerson = User::where('email', '=', $user['email'])->first();
  if ($userPerson == NULL) 
  {
      $newuser = new User();
      $newuser->email =  $user['email'];
      $newuser->role =  2;
      $newuser->first_name = $user['billing_address']['first_name'];
      $newuser->last_name = $user['billing_address']['last_name'];
      $newuser->phone = $user['billing_address']['phone']??"231321321";
      $newuser->password = Hash::make('ccvtwagonner');
      $newuser->is_active = 1;
      $newuser->is_deleted = 0;
      $newuser->save();
      Storage::put('usercreate.txt', json_encode($newuser));      
  } else {
    Storage::put('usercreate.txt', json_encode($userPerson));
  }
}

function findLicense($data)
{   
  $user = User::where('email','=',$data['email'])->first();
  $license = License::where('user_id','=',$user->id)->first();
  Storage::put('licensecheck.txt', json_encode($license));
   
  if(!isset($license->license)){
    $license = new License();
    $is_new_license = 1;
  }
   
  foreach($data['line_items'] as $row){

    if($row['properties'][1]['value'] == 'Monthly')
    {
      $license->license_expiry = date('Y:m:d H:i:s', strtotime('+1 month'));
      $license->license_type_id = 1;
    }
    else if($row['properties'][1]['value'] == 'Yearly')
    {
      $license->license_expiry = date('Y:m:d H:i:s', strtotime('+1 year'));
      $license->license_type_id = 2;
    }
    else if($row['properties'][1]['value'] == 'Lifetime')
    {
      $license->license_expiry = date('Y:m:d H:i:s', strtotime('+100 year'));
      $license->license_type_id = 3;
    }
    else
    {
      $license->license_type_id = 4;
    }

    if(isset($is_new_license)){
      $license->user_id = $user->id;
      $license->license = generate_license_key();
      $license->no_of_devices_allowed=1;
      $license->is_purchased=1;
      $license->is_active = 0;
      $license->save(); 
      Storage::put('licensecheck.txt', json_encode($license));
    }else{
      $license->save(); 
    }
    Notification::send($user,new LicensePurchased($user, $license));
    return $license;
  }
}

function maintainPurchaseHistory($data , $license){
  $purchaseHistory = new PurchaseHistory();
  if(isset($data))
  {
    foreach($data['line_items'] as $row)
    {    
      $purchaseHistory->email = $data['email'];
      if(isset($row['properties'])){
        $purchaseHistory->license = $row['properties'][0]['value']??'';          
      }
      if($row['properties'][1]['value'] == Config::get('constants.VARIANT_ID.MONTHLY'))
      {
        $purchaseHistory->license_type_id = 1;
      }else if($row['properties'][1]['value'] == Config::get('constants.VARIANT_ID.YEARLY'))
      {
        $purchaseHistory->license_type_id = 2;
      }else if($row['properties'][1]['value'] == Config::get('constants.VARIANT_ID.LIFETIME'))
      {
        $purchaseHistory->license_type_id = 3;
      }
      else
      {
        $purchaseHistory->license_type_id = 4;
      }
      $purchaseHistory->license =  $license->license;
      $purchaseHistory->purchase_date =  date("Y-m-d H:i:s");
      $purchaseHistory->activation_date = date("Y-m-d H:i:s");
      $purchaseHistory->status = 1; 
      $purchaseHistory->save();
    }
  }
}

function get_license_type_text($license){
  if($license->license_type && $license->license_type->type == '1' )
    $type = $license->license_type->title .' (Monthly-'. $license->license_type->price . ') ';
  elseif ($license->license_type &&  $license->license_type->type == '2' )
    $type = $license->license_type->title .' (Yearly-'. $license->license_type->price . ') ';
  elseif ($license->license_type &&  $license->license_type->type == '3' )
    $type = $license->license_type->title .' (Lifetime-'. $license->license_type->price . ') ';
  else
    $type = 'Trial';
  return $type;
}
function get_license_duration($license){
  if( $license->type == '1' )
    $type ='Monthly';
  elseif ( $license->type == '2' )
    $type ='Yearly';
  elseif ( $license->type == '3' )
    $type ='Lifetime';
  return $type;
}

function licenseUpdate($license , $user){
  if(!$license->user_id){
    $license->user_id = $user->id;
  }  
  if(!$license->license_activated_at){
    $license->license_activated_at = date("Y-m-d H:i:s");
    $expiry_date = calculateExpiry($license);
  }
  $license->is_active = 1;
  $license->save();
  return $license;
}
function maintain_activation($license, $user , $payload){
  
  $license_devices = new License_devices();
  $license_devices->user_id = $user->id;
  $license_devices->license_id = $license->license;
  $license_devices->device_id = $payload['DeviceUniqueId'];
  $license_devices->device_name = $payload['DeviceInfo'];
  $license_devices->device_os = '';
  $license_devices->activation_date = date("Y-m-d H:i:s");
  $license_devices->save();
      
  $success = success_code(300,$license_devices,$is_valid = 'ExpiryDate',$expiry_date = $license->license_expiry);
  return $success;
}