<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\License;
use Hash;
use File;
use Str;
use Image;
use Session;

class SalesPersonController extends Controller
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
        return view('salesperson.home');
    }
    public function manageprofile(){
        return view('salesperson.profile');
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
        $path  = 'files/upload/salesperson/';
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
        Session::flash("success", "salesperson information has been updated");
        return back();
    }
    public function LicensesAll(){
    	$licenses = License::with('sales_person','user')->where('sales_person_id',Auth::user()->id)->where('is_deleted',NULL)->orderByRaw('id DESC')->get();

    	return view('salesperson.licenselist',compact('licenses'));
    }
    public function LicensesActivated(){
    	$licenses = License::with('sales_person','user')->where('sales_person_id',Auth::user()->id)->where('license_activated_at', '!=' , NULL)->orderByRaw('id DESC')->get();

    	return view('salesperson.activelicenselist',compact('licenses'));
    }
}
