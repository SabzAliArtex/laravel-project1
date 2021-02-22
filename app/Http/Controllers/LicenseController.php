<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\License;
use App\User;
use App\LicenseType;
use App\License_devices;
use App\Payment;
use Session;
use Carbon\Carbon;
use Auth;
use DB;
use Notification;
use App\Notifications\TrialActivated;
use App\Notifications\LicenseExpired;
use App\Notifications\CreateLicenseUser;

class LicenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $licenses = License::with('sales_person', 'user', 'license_type')->where('is_deleted', 0)->orderByRaw('id DESC')->paginate(10);


        // echo '<pre>'; print_r($licenses); exit;
        if (Auth::user()->userrole->role == 'User') {


            return view('user.license.licenselist', [
                'licenses' => $licenses,

            ]);

        }

        if (Auth::user()->userrole->role == 'Admin') {

            return view('admin.license.licenselist', compact('licenses'));

        }

        if (Auth::user()->userrole->role == 'Sales Person') {

            return view('salesPerson.license.licenselist', compact('licenses'));

        }
    }

    public function licenseSearchResults(Request $request)
    {
        $query = $request['search'];
        if ($query == "") {
            
            $licenses = License::with('sales_person', 'user', 'license_type')->where('is_deleted', 0)->orderByRaw('id DESC')->get();
            
            
            
            return view('admin.license.subviews.licensesearchresults', [
                'licenses' => $licenses,
                
            ]);
        } else {
            
            $licenses = DB::table('licenses')
                ->join('users as u', 'u.id', '=', 'licenses.user_id')
                ->join('users as sp', 'sp.id', '=', 'licenses.sales_person_id')
                ->join('license_types', 'license_types.id', '=', 'licenses.license_type_id')
                ->select('licenses.*', 'license_types.*', 'u.first_name', 'u.last_name', 'u.email', 'sp.first_name as fname', 'sp.last_name as lname')
                ->where('u.first_name', 'LIKE', '%' . $query . '%')
                ->orWhere('u.last_name', 'LIKE', '%' . $query . '%')
                ->orWhere('u.email', 'LIKE', '%' . $query . '%')
                ->orWhere('sp.first_name', 'LIKE', '%' . $query . '%')
                ->orWhere('sp.last_name', 'LIKE', '%' . $query . '%')
                ->get();

            return view('admin.license.subviews.licensesearchresults', [
                'licenses' => $licenses,
            ]);
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $sales_persons = User::where([['is_active', '1'], ['role', '3'], ['is_deleted', '0']])->get();
        $Licensetypes = LicenseType::where('is_active', '1')->get();
        return view('admin.license.addlicense', compact('sales_persons', 'Licensetypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if (isset($request['numberoflicenses'])) {

            if ($request['numberoflicenses']>20){

                return back()->with("error","Enter value less than or equal to 20");

            }

            $this->validate($request, [
                "numberoflicenses" => "required | min:1 | max:20",

            ], [
                "numberoflicenses.required" => "Quantity can neither be empty nor 0",
                "numberoflicenses.min" => "Quantity cannot be less than 1",

            ]);


            for ($i=1;$i<=$request->get('numberoflicenses');$i++){
                    $license = new License();
                    $license->license = generate_license_key();
                    $license->no_of_devices_allowed = $request['numofdevs'];
                    $license->sales_person_id = $request['sales_person'];
                    $license->license_type_id = $request['license_type'];
                    $license->save();
            }




            Session::flash("success", "License added successfully!");
            return redirect('license');
        } else {
            $this->validate($request, [
                "license" => "required",

            ], [
                "license.required" => "Please enter Valid License Code",

            ]);

            $license = new License();
            $license->license = $request['license'];
            $license->no_of_devices_allowed = $request['numofdevs'];
            $license->sales_person_id = $request['sales_person'];
            $license->license_type_id = $request['license_type'];
            $license->save();

            Session::flash("success", "License added successfully!");
            return redirect('license');
        }
    }
    public function EditLicense($license)
    {
        $licenses = License::where('license', $license)->firstOrFail();
        $sales_persons = User::where([['is_active', '1'], ['role', '3'], ['is_deleted', '0']])->get();
        $Licensetypes = Licensetype::where('is_active', '1')->get();

        return view('admin.license.editlicense', compact("licenses", "sales_persons", "Licensetypes"));
    }

    public function EditLicensePost(Request $request)
    {
        $License = License::find($request['id']);
        $this->validate($request, [
            "license_type" => "required",
        ], [
            "license_type.required" => "Pleas select license ",
        ]);

        if (!$License) {
            Session::flash("error", "Something went wrong!");
            return back();
        }

        $License->license_type_id = $request['license_type'];
        $License->sales_person_id = $request['sales_person'];
        $License->no_of_devices_allowed = $request['numofdevs'];
        $License->save();

        Session::flash("success", "License updated successfully!");
        return back();
    }

    public function DeleteLicense($id)
    {


        $License = License::find($id);

        $License->is_deleted = 1;
        $License->is_active = 0;
        $License->save();
        Session::flash("success", "Deleted successfully");

        return back();
    }

    public function licenseActivation($user_id, $license_id, $dev_id, $dev_os, $dev_name)
    {
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
        $userPerson = User::where([['id', $user_id]])->first();
        $license_dev_count_rows = License_devices::with('deviceLicense')->where('device_id', '=', $dev_id)->first();
        $license_count_rows = License_devices::with('deviceLicense')->where('license_id', '=', $license_id)->get();
        $license_count_user = $license_count_rows->count();
        $license_data = License::where('id', '=', $license_id)->first();
        $license_data->user_id = $userPerson->id;
        $license_data->save();
        $license_device_limit = $license_data->no_of_devices_allowed;
        if (is_null($license_dev_count_rows)) {
//$userPerson->role == 2 means that person is of type 'USER'
            return getLicenseLimit($license_count_user, $license_device_limit, $user_id, $license_id, $dev_name, $dev_os, $dev_id);

        } else if ($license_dev_count_rows->device_id == $dev_id) {
            return error_code(500);
        }


    }



    public function trialActivation($loggeduserid, $license_key)
    {

        $response = array();
        $response['message'] = "";
        $token = rand();
        $userPerson = User::where([['id', $loggeduserid]])->first();
        if (isset($userPerson)) {
            if ($userPerson->role == 2) {
                $licenseTrial = License::where('license', '=', $license_key)->first();
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
        } else {
            $response['message'] = "Invalid Person";
            return json_encode($response);
        }
    }

    public function userTrialExpire($license_key)
    {
        $token = rand();
        $license = License::where('license', '=', $license_key)->first();
        $trialDate = $license->trial_activated_at;
        $expire = strtotime($trialDate . ' + 30 days');
        $today = strtotime("today midnight");
        $sales_person = User::find($license->sales_person_id);
        $user_license = User::find($license->user_id);

        if ($today <= $expire) {
            echo 1;
            Notification::send($sales_person, new LicenseExpired($sales_person, $token));
            Notification::send($user_license, new LicenseExpired($user_license, $token));


        }

    }


    public function createLicenseUser(Request $request)
    {
        $token = rand();
        $license_key = generate_license_key();
        $user = User::find($request->get('user'));
        Notification::send($user, new CreateLicenseUser($user, $license_key));

    }

    public function checkLicenseExists(Request $request)
    {

        $license_key = $request->get('licensecode');
        $is_license = License::where('license', '=', $license_key)->first();
        if (!$is_license) {
            return false;
        }
        $is_license->updated_at = date('Y-m-d H:i:s');
        $is_license->save();
        return true;
    }

    public function multipleLicenses(){
        $sales_persons = User::where([['is_active', '1'], ['role', '3'], ['is_deleted', '0']])->get();
        $Licensetypes = LicenseType::where('is_active', '1')->get();
        return view('admin.license.addmultiplelicense', compact('sales_persons', 'Licensetypes'));
    }



}
