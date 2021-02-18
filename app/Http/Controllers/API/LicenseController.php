<?php

namespace App\Http\Controllers\API;

use App\User;
use App\License;
use App\Apiloggs;
use App\License_devices;
use App\LicenseActivation;
use Illuminate\Http\Request;
use App\Traits\LicenseBooking;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

class LicenseController extends Controller
{


    public function licenseActivation(Request $request)
    {
        $expiry_date = '';
        $payload = $request->all();
        $this->loggs($payload);
        $user_id = $request->get('UserEmail');
        $user_password = $request->get('UserPassword');
        $user_firstname = $request->get('UserFirstName');
        $user_lastname = $request->get('UserLastName');
        $user_phone = $request->get('UserPhone');
        $license_id = $request->get('LicenseCode');
        $dev_id = $request->get('DeviceUniqueId');
        $dev_os = $request->get('dev_os');
        $dev_name = $request->get('dev_name');
        $response = array();
        $response['Message'] = "";
        if (!isset($license_id))
        {
            $response['Message'] = "License Object is null";
            return json_encode($response);
        }
        $userPerson = User::where('email', '=', $user_id)->first();
        if ($userPerson == NULL) 
        {
            $userPerson = User::create([
                "email" => $user_id,
                "role" => 2,
                "first_name" => $user_firstname,
                "last_name" => $user_lastname,
                "phone" => $user_phone,
                "password" => Hash::make($user_password),
                "is_active" => 1
            ]);
        }

        $license_dev_count_rows = License_devices::with('deviceLicense')->where('device_id', '=', $dev_id)->first();
        $license_count_rows = License_devices::with('deviceLicense')->where('license_id', '=', $license_id)->get();
        $license_count_user = $license_count_rows->count();
        $license_data = License::where('license', '=', $license_id)->with('license_type')->first();

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

                // When App will return us License TYpe then below if condition's left side will be replaced by the type recieved from mobile application side

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

                    $expiry_date = $license_data->license_expiry;
                }
                else
                {
                    $expiry_date = $license_data->license_expiry;
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
                    $expiry_date = $license_data->license_expiry;
                }
                else
                {
                    // $license_data->is_active = 0;
                    $expiry_date = $license_data->license_expiry;
                }
            } 
            elseif($license_data->license_type->type == 3)    
            {
                // Lifetime 
                $licenseValidity = true;
                $expiry_date = $license_data->license_expiry;
            }
            else{
                
                $expiry_date = $license_data->license_expiry;

            }
            
            // In the example below,
            //  if a flight exists with a departure location of Oakland and a destination location of San Diego, 
            // its price and discounted columns will be updated.
            //  If no such flight exists, a new flight will be created which has the attributes resulting 
            // from merging the first argument array with the second argument array:

            //     $flight = Flight::updateOrCreate(
            //         ['departure' => 'Oakland', 'destination' => 'San Diego'],
            //         ['price' => 99, 'discounted' => 1]
            //     );
             
            
            LicenseActivation::updateOrCreate([
            'license_id'=>$license_data->id
            ],[
                "user_id"=>$license_data->user_id,
                "license_expiry"=>$license_data->license_expiry,
                "trial_activated_at"=>$license_data->trial_activated_at,
                "license_activated_at"=>$license_data->license_activated_at
                
            ]);
            $license_data->save();
            $license_device_limit = $license_data->no_of_devices_allowed;
            if (is_null($license_dev_count_rows))
            {
                //$userPerson->role == 2 means that person is of type 'USER'
                return getLicenseLimit($license_count_user, $license_device_limit, $userPerson->id, $license_id, $dev_name, $dev_os, $dev_id, $licenseValidity, $expiry_date);
            } 
            else if ($license_dev_count_rows->device_id == $dev_id)
            {
                return error_code(500);
            }
        }
    }
    
    public function trialActivation(Request $request)
    {
        $payload = $request->all();
        $this->loggs($payload);
        $loggeduserid = $request->get('UserEmail');
        $userfirstname = $request->get('UserFirstName');
        $userlastname = $request->get('UserLastName');
        $userpassword = $request->get('UserPassword');
        $userphone = $request->get('UserPhone');
        $license_key = $request->get('LicenseCode');
        $time = $request->get('StartTrialTime');
        $deviceUniqueId = $request->get('DeviceUniqueId');
        $numtime = strtotime($time);
        $startTrialTime = date("Y-m-d H:i:s",$numtime);
        $response = array();
        $response['Message'] = "";
        $token = rand();
        $existing = false;
        $userPerson = User::where([['email', $loggeduserid]])->first();
        
        if (isset($userPerson)) {
            if ($userPerson->role == 2) 
            {
            $license_new_trial = License::where([['license', '=', $license_key],['user_id','=',$userPerson->id]])->first();
            $existing = true;
            return $this->trialActivateGeneral($license_new_trial, $startTrialTime, $payload, $existing);
            }
        }
        else
        {
            $userPerson = User::create([
                "email" => $loggeduserid,
                "role" => 2,
                "first_name" => $userfirstname,
                "last_name" => $userlastname,
                "phone" => $userphone,
                "password" => Hash::make($userpassword),
                "is_active" => 1
            ]);
            if ($userPerson->role == 2)
            {
                // $licenseTrial = License::where('license', '=', $license_key)->first();

                $license_new_trial = new License();
                $license_new_trial->user_device_unique_id = $deviceUniqueId;
                $license_new_trial->user_id = $userPerson->id;
                $license_new_trial->license_type_id = 4;
                $license_new_trial->license = generate_license_key();
                $license_new_trial->save();
                return $this->trialActivateGeneral($license_new_trial, $startTrialTime, $payload,$existing);
            }
        }
        $this->loggs($request);
    }
    public function checkLicenseExists($LicenseCode)
    {
        $payload = $LicenseCode;
        $this->loggs($payload);
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


    //General Function for Activation
    public function trialActivateGeneral($licenseTrial, $startTrialTime,$payload,$existing)
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
            /* $sales_person = User::find($licenseTrial->sales_person_id);
             sending email -- uncomment if email functionality needed
            Notification::send($sales_person,new TrialActivated($sales_person, $token));*/
            $isTrial = True;
            $responseLicenseTrial = new LicenseBooking();
            $responseLicenseTrial->set_license_trial($licenseTrial, $isTrial);
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
    public function loggs($payload)
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
}
