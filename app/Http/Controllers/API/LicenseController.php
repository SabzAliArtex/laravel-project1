<?php

namespace App\Http\Controllers\API;

use App\User;
use App\License;
use App\Apiloggs;
use App\LicenseHistory;
use App\License_devices;
use App\LicenseActivation;
use Illuminate\Http\Request;
use App\Traits\LicenseBooking;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Notifications\TrialActivated;
use Illuminate\Support\Facades\Route;
use App\Notifications\LicensePurchased;
use App\Notifications\UserCreatedFromApp;
use App\Notifications\LicenseActivated;
use Illuminate\Support\Facades\Notification;

class LicenseController extends Controller
{
    public function licenseActivation(Request $request)
    {
        $payload = file_get_contents('php://input');
        $payload = json_decode($payload , true);
        loggs($payload);
      
        $response = array();
        
        if (!isset($payload['LicenseCode']))
        {
            $response['Message'] = "License Object is null";
            return json_encode($response);
        }

        $license_dev_count_rows = License_devices::with('deviceLicense')->where('device_id', '=', $payload['DeviceUniqueId'])->where('license_id', '=', $payload['LicenseCode'])->first();
        $license_count_rows = License_devices::with('deviceLicense')->where('license_id', '=', $payload['LicenseCode'])->get();
        $license_count_user = $license_count_rows->count();
        $license_data = License::where('license', '=', $payload['LicenseCode'])->with('license_type')->first();

        // if license is code not found
        if ($license_data == null) 
        {
            return has_error('invalid');
        }
        // check if license is not purchased yet
        if (!$license_data->is_purchased)
        {
            return has_error('not_purchased');
        }
        // Check if license is Expired
        if ($license_data->is_purchased  && $license_data->license_expiry <= date('Y-m-d H:i:s'))
        {
            return has_error('expired');
        } 
        // if device is already registered for this device
        if ($license_dev_count_rows != null)
        {
            return has_error('same_device');
        }
        // no of devices allowed Check
        if ($license_data->no_of_devices_allowed <= $license_count_user) 
        {
            return has_error('limit', $license_data->no_of_devices_allowed);
        }
        // search user and create new user incase of user not found
        $userPerson = User::where('email', '=', $payload['UserEmail'])->first();
        if ($userPerson == NULL) 
        {
            $userPerson = User::create([
                "email" => $payload['UserEmail'],
                "role" => 2,
                "first_name" => $payload['UserFirstName'],
                "last_name" => $payload['UserLastName'],
                "phone" => $payload['UserPhone'],
                "password" => Hash::make($payload['UserPassword']),
                "is_active" => 1
            ]);
        }

        $license = licenseUpdate($license_data , $userPerson);
        Notification::send($userPerson,new LicenseActivated($userPerson,$license_data));
        return  licenseActivate_android($license_data, $userPerson, $payload); 
    }
    
    public function trialActivation(Request $request)
    {
      
        $payload = file_get_contents('php://input');
        $payload = json_decode($payload , true);

        loggs($payload);
        $time = $payload['StartTrialTime'];
        $numtime = strtotime($time);
        $startTrialTime = date("Y-m-d H:i:s",$numtime);
        $existing = false;        
        $userPerson = User::where([['email', $payload['UserEmail']]])->first();
        if (isset($userPerson)) {
            if ($userPerson->role == 2) 
            {
            $license_new_trial = License::where([['license', '=', $payload['LicenseCode']],['user_id','=',$userPerson->id]])->first();
            $existing = true;
            return trialActivateGeneral($license_new_trial, $startTrialTime, $existing);
            }
        }
        else
        {
            $userPerson = User::create([
                "email" => $payload['UserEmail'],
                "role" => 2,
                "first_name" => $payload['UserFirstName'],
                "last_name" => $payload['UserLastName'],
                "phone" => $payload['UserPhone'],
                "password" => Hash::make($payload['UserPassword']),
                "is_active" => 1
            ]);
            $admin = User::where('role','=',1)->first();
            if ($userPerson->role == 2)
            {              
                $license_new_trial = new License();
                $license_new_trial->user_device_unique_id = $payload['DeviceUniqueId'];
                $license_new_trial->user_id = $userPerson->id;
                $license_new_trial->license_type_id = 4;
                $license_new_trial->license = generate_license_key();
                $license_new_trial->save();
                Notification::send($admin,new UserCreatedFromApp($userPerson,$token=rand(),$license_new_trial));
                Notification::send($userPerson,new TrialActivated($userPerson,$token=rand(),$license_new_trial));
                return trialActivateGeneral($license_new_trial, $startTrialTime,$existing);
            }
        }
        loggs($request);
    }
    public function checkLicenseExists($licenseCode)
    {
        $payload = $LicenseCode;
        loggs($payload);
        $is_license = License::where('license', '=', $licenseCode)->first();
        if (!$is_license)
        {
            return json_encode(array("result" => false));
        }
        $is_license->updated_at = date('Y-m-d H:i:s');
        $is_license->save();
        return json_encode(array("result" => true));
    }
}