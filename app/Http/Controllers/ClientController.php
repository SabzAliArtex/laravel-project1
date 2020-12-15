<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\License_devices;
use App\License;
use Hash;
use File;
use Str;
use Image;
use Session;

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
    public function manageprofile(){
        return view('user.profile');
    }
    public function updateprofile(Request $get){
        $user = User::find($get->id);
        $this->validate($get, [
            "first_name" => "required",
            "last_name" => "required",
        ],[
            "first_name.required" => "Please enter first name",
            "last_name.required" => "Please enter last name"
        ]);
        $user->first_name = $get->first_name;
        $user->last_name = $get->last_name;
        $user->save();
        $path  = 'files/upload/user/';
        if($get->file('thumb')){
            $this->validate($get, [
                "thumb" => "mimes:png,jpg,jpeg"
            ],[
                "thumb.mimes" => "Please upload png or jpg format" 
            ]);
            if(File::exists($user->thumb)){
                File::delete($user->thumb);
            }

            if (!file_exists($path)) {
                mkdir($path, 666, true);
            }
            $thumb = $get->file('thumb');
            $image = Str::slug($user->name).rand(12345678,98765432).'.'.$thumb->getClientOriginalExtension();

            Image::make($thumb)->resize(300,300)->save($path.$user->first_name.'_'.$image);
            $user->thumb = $path.$user->first_name.'_'.$image;
            $user->save();
        }
        Session::flash("success", "User information has been updated");
        return back();
    }
    public function LicensesActivated(){
        $licenses = License_devices::with('deviceLicense','users','license_type')->where('user_id', Auth::user()->id)->where('is_deleted', '=' , 0)->orderByRaw('id DESC')->get();
         return collect(['licenses',$licenses]);
    
    }
    public function LicenseListLessDetails(){
        $licenses = License_devices::with('deviceLicense','users','license_type')->where('user_id', Auth::user()->id)->where('is_deleted', '=' , 0)->orderByRaw('id DESC')->get();

            return view('user.activelicenselist',compact('licenses'));
    }
    public function userLicenseList(){
        dd('here');
    }
    public function deleteLicense($id){
        $user_license = License_devices::find($id);
        $user_license->is_deleted = 1;
        $user_license->save();
        Session::flash("success", "Deleted successfully");

        return back(); 
    }
}
