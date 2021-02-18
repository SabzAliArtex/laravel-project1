<?php
use App\License;
use Carbon\Carbon;
use App\License_devices;
use Jenssegers\Agent\Agent;
use Illuminate\Http\Request;
use App\Traits\LicenseBooking;
use App\Http\Middleware\Authenticate;
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
function success_code($num,$license,$is_valid,$expiry_date){
if($num == 300){
//  $responseLicense = array([
//     'LicenseCode'=>$license->license_id,
//     'ActivationTime'=>$license->activation_date,
//     'IsTrial'=>false,
//     'StartTrialTime'=>$license->activation_date,


//  ]);
$isTrial=false;

$responseLicense = new LicenseBooking();

$responseLicense->set_license($license,$isTrial);

 return json_encode(array("License"=>$responseLicense,"Message"=>"Activated","IsOK"=>true,"IsError"=>false,"IsValid"=>$is_valid,"ExpiryDate"=>$expiry_date));
}

}
function error_code($code){
  if(isset($code)){
    if($code == 500){
      $isTrial=false;

      $responseLicense = new LicenseBooking();
      
      
      
       return json_encode(array("License"=>$responseLicense,"Message"=>"Duplication not Allowed. License Already Activated for this device.","IsOK"=>false,"IsError"=>true,"IsValid"=>true,"ExpiryDate"=>""));
      
  }else if($code == 400){
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

