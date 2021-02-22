<?php
use App\License;
use App\Apiloggs;
use Carbon\Carbon;
use App\License_devices;
use App\LicenseActivation;
use Jenssegers\Agent\Agent;
use Illuminate\Http\Request;
use App\Traits\LicenseBooking;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;
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
  function deviceCheck(){
         $agent = new Agent();
         //if desktop
      if($agent->isDesktop()){
       $platform = $agent->platform();
       $device = $agent->device();
       echo $platform;
       echo $device;
      }//if mobile
      else if($agent->isPhone()){
        $platform = $agent->platform();
       $device = $agent->device();
       echo $platform;
       echo $device;
      }
      //if tablet
      else if($agent->isTablet()){
             $platform = $agent->platform();
       $device = $agent->device();
       echo $platform;
       echo $device;
      }
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
    }else{
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
  function limit_error_code($code,$limit){
     if($code == 600){
      $isTrial=false;
 
      $responseLicense = new LicenseBooking();
      
      
      
       return json_encode(array("License"=>$responseLicense,"Message"=>"License is valid for ".$limit." devices.","IsOK"=>false,"IsError"=>true,"IsValid"=>true,"ExpiryDate"=>""));
 
  }

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

    $log = Apiloggs::create([
        'current_url' => $current_route,
        'current_controller' => $current_controller,
        'current_payload' => $current_payload,
    ]);
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
      // / Monthlyd
      //  valid true, expired false
      //  $is_valid = calculateMonthExpiry($license_data->license_activated_at);
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
      
  } 
  elseif($license_data->license_type->type == 2) 
  {
      // Yearly

      // $licenseValidity = calculateYearExpiry($license_data->license_activated_at);
      $next_year = strtotime('+1 year', strtotime($license_data->license_activated_at));
      $license_data->license_expiry = date('Y:m:d H:i:s', $next_year);
      $licenseValidity = ($license_data->license_activated_at >= $next_year) ? 'false' : 'true';
      if ($licenseValidity == true)
      {
          // $license_data->is_active = 1;
        return  $expiry_date = $license_data->license_expiry;
      }
      else
      {
          // $license_data->is_active = 0;
        return  $expiry_date = $license_data->license_expiry;
      }
  } 
  elseif($license_data->license_type->type == 3)    
  {
      // Lifetime 
      $licenseValidity = true;
     return $expiry_date = $license_data->license_expiry;
  }
  else{
      
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
        LicenseActivation::updateOrCreate([
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
    }
    else
    {
        $response['Message'] = "License Key is not valid";
        return json_encode($response);
    }
}