<?php

namespace App\Http\Controllers;

use Str;
use File;
use Hash;
use Image;
use Session;
use App\User;
use App\License;
use App\License_devices;
use App\PurchaseHistory;
use App\LicenseActivation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function userHome()
    {
        return view('user.home');
    }

    public function manageprofile()
    {
        return view('user.profile');
    }

    public function updateprofile(Request $get)
    {
        $user = User::find($get->id);
        $this->validate($get,[
            "first_name" => "required",
            "last_name" => "required",
        ], [
            "first_name.required" => "Please enter first name",
            "last_name.required" => "Please enter last name"
        ]);
        $user->first_name= $get->first_name;
        $user->last_name = $get->last_name;
        $user->save();
        $path = 'files/upload/user/';
        if ($get->file('thumb')) {
            $this->validate($get, [
                "thumb" => "mimes:png,jpg,jpeg"
            ], [
                "thumb.mimes" => "Please upload png or jpg format"
            ]);
            if (File::exists($user->thumb)) {
                File::delete($user->thumb);
            }

            if (!file_exists($path)) {
                mkdir($path, 666, true);
            }
            $thumb = $get->file('thumb');
            $image = Str::slug($user->name) . rand(12345678, 98765432) . '.' . $thumb->getClientOriginalExtension();

            Image::make($thumb)->resize(300, 300)->save($path . $user->first_name . '_' . $image);
            $user->thumb = $path . $user->first_name . '_' . $image;
            $user->save();
        }
        Session::flash("success", "User information has been updated");
        return back();
    }

    public function alluseranddevs()
    {

        // $licenses = License_devices::with('deviceLicense')->paginate(10);
        $licenses = DB::connection()
        ->table('license_devices as ld')
        ->join('licenses as li', 'li.license', 'ld.license_id')
        ->join('license_types', 'license_types.id', 'li.license_type_id')
        ->Join('users', function ($join) {
            $join->on('users.id', '=', 'ld.user_id');
            $join->where('ld.is_deleted', '=', '0');
        })->get();
        
            


        return view('admin.useranddevslist', compact('licenses'));

    }

    public function alluseranddevssearch(Request $request)
    {
        $query = $request['search'];
        $formatCheck = 0;
        if ($query == "") {
              $licenses = DB::connection()
                ->table('license_devices as ld')
                ->join('licenses as li', 'li.license', 'ld.license_id')
                ->join('license_types', 'license_types.id', 'li.license_type_id')
                ->Join('users', function ($join) {
                    $join->on('users.id', '=', 'ld.user_id');
                    $join->where('ld.is_deleted', '=', '0');
                })->get();
                

            return view('admin.subviews.userdevsanddevicessearchresults',compact('licenses'));
        } else {
            

            $licenses = DB::connection()
                ->table('license_devices as ld')
                ->join('licenses as li', 'li.license', 'ld.license_id')
                ->join('license_types', 'license_types.id', 'li.license_type_id')
                ->Join('users', function ($join) {
                    $join->on('users.id', '=', 'ld.user_id');
                    $join->where('ld.is_deleted', '=', '0');
                })
                ->where('email', 'LIKE', '%' . $query . '%')
                ->orWhere('li.license', 'LIKE', '%' . $query . '%')
                ->orWhere('ld.device_id', 'LIKE', '%' . $query . '%')
                ->get();


            return view('admin.subviews.userdevsanddevicessearchresults', [
                
                'licenses' => $licenses,
            ]);
        }
    }

    public function LicensesActivated($licenseid)

    {
        
        $LicenseCode = License::find($licenseid);
        
        $licenses = License_devices::with('deviceLicense', 'users', 'license_type')
        ->where([['license_id', '=', $LicenseCode->license], ['user_id', '=', Auth::user()->id], ['is_deleted', '=', 0]])->orderByRaw('id DESC')->get();
        return $licenses;


    }

    public function LicenseListLessDetails()
    {
      

        $licenses = License::with('sales_person', 'user', 'license_type')->
        where([['user_id', Auth::user()->id], ['is_deleted', '=', 0]])
            ->orderByRaw('id DESC')
            ->paginate(10);
            
            
        return view('user.activelicenselist', compact('licenses'));
        

    }
    public function purchaseLicense(Request $request){
       
       $license = License::where([['user_id','=', Auth::user()->id],['license_type_id', '>=',4]])->first();
       $license->license_type_id = $request->get('license_type_id');
      
       LicenseActivation::create([
            'license_id'=>$license->id,
            "user_id"=>$license->user_id,
            "license_expiry"=>$license->license_expiry,
            "trial_activated_at"=>$license->trial_activated_at,
            "license_activated_at"=>$license->license_activated_at
            
        ]);
        $license->save();
       return $license;
    }

    public function searchResults(Request $request)
    {
        $query = $request->get('search');
        if ($query == "") {

            $licenses = License::with('sales_person', 'user', 'license_type')->
            where([['user_id', Auth::user()->id], ['is_deleted', '=', 0]])
                ->orderByRaw('id DESC')
                ->paginate(10);

        } else {
            $licenses = License::with('sales_person', 'user', 'license_type')->
            where('license', 'LIKE', '%' . $query . '%')
                ->orderByRaw('id DESC')
                ->paginate(10);
        }


        return view('user.subviews.usersearchresulttable', compact('licenses'));


    }


    public function deleteLicense($id)
    {
        $user_license = License_devices::find($id);
        $user_license->is_deleted = 1;
        $user_license->save();
        Session::flash("success", "Deleted successfully");
        return back();


    }

    public function deactivateDevice($id)
    {

        $user_license = License_devices::where('device_id', '=', $id)->first();
        $user_license->is_deactive = 1;
        $user_license->save();
        Session::flash("success", "Device Deactivated");
        return back();


    }

    public function activateDevice($id)
    {

        $user_license = License_devices::where('device_id', '=', $id)->first();

        $user_license->is_deactive = 0;
        $user_license->save();
        Session::flash("success", "Device Activated");
        return back();


    }
    public function purchaseHistory()
    {
        $response = PurchaseHistory::where('email','=',Auth::user()->email)->get();
        return view('user.purchasehistory',[
            'history'=>$response,
        ]);

    }
}
