<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use App\User;
use App\License;
use App\Payment;
use Notification;
use Carbon\Carbon;
use App\LicenseType;
use App\License_devices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Notifications\LicenseExpired;
use App\Notifications\TrialActivated;
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

    

    public function multipleLicenses(){
        $sales_persons = User::where([['is_active', '1'], ['role', '3'], ['is_deleted', '0']])->get();
        $Licensetypes = LicenseType::where('is_active', '1')->get();
        return view('admin.license.addmultiplelicense', compact('sales_persons', 'Licensetypes'));
    }



}
