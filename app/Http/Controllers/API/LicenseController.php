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
            //Notification::send($userPerson,new UserCreatedFromApp($userPerson,$token=rand()));
        }

        $license_dev_count_rows = License_devices::with('deviceLicense')->where('device_id', '=', $payload['DeviceUniqueId'])->first();
        $license_count_rows = License_devices::with('deviceLicense')->where('license_id', '=', $payload['LicenseCode'])->get();
        $license_count_user = $license_count_rows->count();
        $license_data = License::where('license', '=', $payload['LicenseCode'])->with('license_type')->first();

        if ($license_data == null) 
        {
            $responseLicenseTrial = new LicenseBooking();
            return json_encode(array(
                "License" => $responseLicenseTrial,
                "Message" => "Your License is Invalid",
                "IsOK" => false,
                "IsError" => true
            ));
        } 
        else
        {
            $licenseValidity = "license expiry";
            $license_data->user_id = $userPerson->id;
            $license_data->license_activated_at = date("Y-m-d H:i:s");
            $license_data->is_active = 1;
            $expiry_date = calculateExpiry($license_data);
            LicenseHistory::updateOrCreate(
            [
            'license_id'=>$license_data->id
            ],
            [
                "user_id"=>$license_data->user_id,
                "license_expiry"=>$license_data->license_expiry,
                "trial_activated_at"=>$license_data->trial_activated_at,
                "license_activated_at"=>$license_data->license_activated_at
                
            ]);
            $license_data->save();
            $admin = User::where('role','=',1)->first();
            Notification::send($admin,new UserCreatedFromApp($userPerson,$token=rand(),$license_data));
            $license_device_limit = $license_data->no_of_devices_allowed;
            if (is_null($license_dev_count_rows))
            {
                //$userPerson->role == 2 means that person is of type 'USER'
                Notification::send($userPerson,new LicenseActivated($userPerson,$license_data));
              return  getLicenseLimit($license_count_user, $license_device_limit, $userPerson->id, $payload['LicenseCode'], $payload['dev_name']??$name='devname', $payload['dev_os']??$name='devos', $payload['DeviceUniqueId'], $licenseValidity,$expiry_date);
            } 
            else if ($license_dev_count_rows->device_id == $payload['DeviceUniqueId'])
            {
                return error_code(500);
            }
        }
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
    public function checkLicenseExists($LicenseCode)
    {
        $payload = $LicenseCode;
        loggs($payload);
        $license_key = $LicenseCode;
        $is_license = License::where('license', '=', $license_key)->first();
        if (!$is_license)
        {
            return json_encode(array("result" => false));
        }
        $is_license->updated_at = date('Y-m-d H:i:s');
        $is_license->save();
        return json_encode(array("result" => true));
    }
}

public function LicensesActivated($licenseid)
{
    $LicenseCode = License::find($licenseid);   
    $licenses = License_devices::with('deviceLicense', 'users', 'license_type')
    ->where([['license_id', '=', $LicenseCode->license], ['user_id', '=', Auth::user()->id], ['is_deleted', '=', 0]])->orderByRaw('id DESC')->get();
    return $licenses;
}