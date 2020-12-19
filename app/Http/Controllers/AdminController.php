<?php

namespace App\Http\Controllers;

use App\Notifications\VerifyAccount;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Notification;
use App\User;
use App\UserRole;
use Hash;
use File;
use Str;
use Image;
use Session;

class AdminController extends Controller
{

  public function manageprofile(){
        return view('admin.profile');
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

        if($get->file('thumb')){
            $this->validate($get, [
                "thumb" => "mimes:png,jpg,jpeg"
            ],[
                "thumb.mimes" => "Please upload png or jpg format" 
            ]);
            if(File::exists($user->thumb)){
                File::delete($user->thumb);
            }
            $path = 'files/upload/admin/';
            
            $thumb = $get->file('thumb');
            $image = Str::slug($user->name).rand(12345678,98765432).'.'.$thumb->getClientOriginalExtension();
            if (!file_exists($path)) {
                mkdir($path, 666, true);
            }
            Image::make($thumb)->resize(300,300)->save($path.$user->first_name.'_'.$image);
            
            $user->thumb = $path.$user->first_name.'_'.$image;
            $user->save();
        }
        Session::flash("success", "User information has been updated");
        return back();
    }
    public function addUser(){
    	$data['roles'] = UserRole::all();
    	return view('admin.adduser',$data);
    }
    public function Users(){
        $data['users'] = User::with('userrole')->where('is_deleted' ,'0')->where('id','<>', Auth::user()->id)->Paginate('10');
        
        
    	// echo '<pre>'; print_r($data); exit;
    	return view('admin.userslist',$data);
    }
    public function SalesPersons(){
    	$data['users'] = User::with('userrole')->where('is_deleted' ,'0')->where('role','=', 3)->get();
    	// echo '<pre>'; print_r($data); exit;
    	return view('admin.salespersons',$data);
    }
    public function EditUser($user_id){
    	$data['roles'] = UserRole::all();
        $data['user'] = User::with('userrole')->find($user_id);
        
    	return view('admin.edituser',$data);
    }
    public function EditSalesPerson($user_id){
    	$data['roles'] = UserRole::all();
    	$data['user'] = User::with('userrole')->find($user_id);
    	return view('admin.editsalesperson',$data);
    }
    public function DeleteUser($user_id){
    	$user = User::find($user_id);
    	
    	$user->is_deleted = 1;
    	$user->save();
    	Session::flash("success", "User has been deleted!");
    	return back();
    }
    public function addUserPost(Request $get){
    	// print_r($_POST); exit;

    	$this->validate($get, [
            "first_name" => "required",
            "last_name" => "required",
            "email" => 'required|email|unique:users,email',
            "password" => 'required|min:8',
            "role" => 'required',
        ],[
            "first_name.required" => "Please enter first name",
            "last_name.required" => "Please enter last name",
            "email.required" => 'Enter your email here',
            "email.email" => 'Enter your valid email',
            "password.required" => 'Please enter password',
            "password.min" => 'Password should be greater then 8 charecters',
            "role.required" => 'Please Enter Role',
        ]);
        $token = rand(123456,987643);
        $Comission = $get['commission'] != '' ?  $get['commission']  : 0 ;
        $user =  User::create([
            'first_name' => $get['first_name'],
            'last_name' => $get['last_name'],
            'role' => $get['role'],
            'email' => $get['email'],
            'verify_token' => $token,
            'commission' => $Comission,
            'phone' => $get['phone'],
            'is_active' => $get['is_active'],
            'password' => Hash::make($get['password']),
        ]);
        try{
            Notification::route('mail', $get['email'])->notify(new VerifyAccount($user , $token));
        }catch(\Exception $e){

        }
        Session::flash("success", "User added successfully");
        return back();
    }

    public function EditUserPost(Request $get , $id){

    	$this->validate($get, [
            "first_name" => "required",
            "last_name" => "required",
            "email" => 'required|email|unique:users,email,'.$id.',id',
            "role" => 'required',
        ],[
            "first_name.required" => "Please enter first name",
            "last_name.required" => "Please enter last name",
            "email.required" => 'Enter your email here',
            "email.email" => 'Enter your valid email',
            "role.required" => 'Please Enter Role',
        ]);

        $Comission = $get['commission'] != '' ?  $get['commission']  : NULL ;
        $user = User::find($id);
        $user->first_name = $get['first_name'];
        $user->last_name 	= $get['last_name'];
        $user->role = $get['role'];
        $user->email = $get['email'];
        $user->commission = $Comission;
        $user->phone = $get['phone'];
        $user->is_active = $get['is_active'];
        $user->save();

        Session::flash("success", "User updated successfully");
        return back();
    }
}
