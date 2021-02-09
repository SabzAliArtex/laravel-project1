<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\License;
use App\License_devices;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Apiloggs;
class LicenseController extends Controller
{
    
   
    public function licenseActivation(Request $request)
    {
        
        $payload = $request->all();
         
         $this->loggs($payload);
         $user_id = $request->get('UserEmail');

         $license_id = $request->get('LicenseCode');
         $dev_id = $request->get('DeviceUniqueId');
         $dev_os = $request->get('dev_os');
         $dev_name = $request->get('dev_name');
         /*user 3 licen 1 */
         $response = array();
         $response['message'] = "";
         if (!isset($license_id)) {
             $response['message'] = "License Object is null";
             return json_encode($response);
         }
         if (!isset($dev_os) || !isset($dev_name) || !isset($dev_id)) {
             $response['message'] = "Device Credentials are Invalid";
             return json_encode($response);

         }
         $userPerson = User::where([['email', $user_id]])->first();
         $license_dev_count_rows = License_devices::with('deviceLicense')->where('device_id', '=', $dev_id)->first();
         $license_count_rows = License_devices::with('deviceLicense')->where('license_id', '=', $license_id)->get();
         $license_count_user = $license_count_rows->count();

         $license_data = License::where('license', '=', $license_id)->first();

         $license_data->user_id = $userPerson->id;
         $license_data->license_activated_at = date("Y-m-d H:i:s");
         $license_data->save();
         $license_device_limit = $license_data->no_of_devices_allowed;

         if (is_null($license_dev_count_rows)) {
            //$userPerson->role == 2 means that person is of type 'USER'
             return getLicenseLimit($license_count_user, $license_device_limit, $userPerson->id, $license_id, $dev_name, $dev_os, $dev_id);

         } else if ($license_dev_count_rows->device_id == $dev_id) {
             return error_code(500);
         }



    }
    public function trialActivation(Request $request)
    {    $payload = $request->all();
        $this->loggs($payload);
        $loggeduserid = $request->get('user_id');
        $license_key = $request->get('license_key');
        $response = array();
        $response['Message'] = "";
        $token = rand();
        $userPerson = User::where([['id', $loggeduserid]])->first();
        if (isset($userPerson)) {
            if ($userPerson->role == 2) {
                $licenseTrial = License::where('license', '=', $license_key)->first();
             $this->trialActivateGeneral($licenseTrial);
            }
        } else {
            $response['Message'] = "Invalid Person";
            return json_encode($response);
        }
        $this->loggs($request);
    }
    public function checkLicenseExists(Request $request)
    {   $payload = $request->all();
        $this->loggs($payload);
        $license_key = $request->get('licensecode');
        $is_license = License::where('license', '=', $license_key)->first();
        if (!$is_license) {
            return false;
        }
        $is_license->updated_at = date('Y-m-d H:i:s');
        $is_license->save();
        return true;
    }


    //General Function for Activation
    public function trialActivateGeneral($licenseTrial){


        if (isset($licenseTrial)) {
            $licenseTrial->trial_activated_at = date("Y-m-d H:i:s");
            $licenseTrial->save();

            $sales_person = User::find($licenseTrial->sales_person_id);


            /* sending email -- uncomment if email functionality needed
            Notification::send($sales_person,new TrialActivated($sales_person, $token));*/

            $response['message'] = "Trial Period Activated";
            return json_encode($response);
        } else {
            $response['message'] = "License Key is not valid";
            return json_encode($response);
        }
    }
    public function loggs($payload){
        $current_route = Route::getCurrentRoute()->uri;
        $current_controller = Route::getCurrentRoute()->getActionName();
        $current_payload = json_encode($payload);

        $log = Apiloggs::create([
            'current_url'=>$current_route,
            'current_controller'=>$current_controller,
            'current_payload'=>$current_payload,
        ]);
        if($log){
            $response['message'] = "Loggs are being maintained";
            return json_encode($response);
        }else{
            $response['message'] = "Failed to maintain Loggs";
            return json_encode($response);

        }


    }

}
