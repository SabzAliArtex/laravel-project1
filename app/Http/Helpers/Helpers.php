<?php
use App\Http\Middleware\Authenticate;
use App\License;
use App\License_devices;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
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
    function getLicenseLimit($license_dev_count, $license_device_limit,$user_id,$license_id,$dev_name,$dev_os,$dev_id){
         if($license_dev_count < $license_device_limit){
          $license_devices = new License_devices();
      $license_devices->user_id = $user_id;
      $license_devices->license_id = $license_id;
      $license_devices->device_id = $dev_id;
      $license_devices->device_name = $dev_name;
      $license_devices->device_os = $dev_os;
      $license_devices->activation_date = date("Y-m-d H:i:s");
      $license_devices->save();
      
    }else{
      $response['message'] = "License is Valid for ". $license_device_limit." devices only" ;
      return $response;

    }
    }


