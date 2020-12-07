<?php

namespace App\Http\Controllers;

use Hash;
use App\Log;
use Session;
use App\User;
use App\WebSite;
use Notification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Notifications\ResetPassword;
use App\Notifications\VerifyAccount;
use Illuminate\Support\Facades\Auth;

class BasicAuthController extends Controller
{
    public function __construct(){
        
    }
    public function login(){
        return view("auth.login");
    }
    public function forgetpassword(){
        return view("auth.reset");
    }
    public function register(){
        return view("auth.register");
    }
    // public function register(){
    //     return view("auth.verify");
    // }
    public function loginpost(Request $get){
        $this->validate($get,[
            "email" => 'required|email|exists:users,email',
            "password" => 'required'
        ],[
            "email.required" => 'Enter your email here',
            "email.email" => 'Enter your valid email',
            "email.exists" => 'This email is not registered',
            "password.required" => 'Enter your password'
        ]);         
        $user = User::with('userrole')->where('email', $get->email)->first();
        if(Hash::check($get->password, $user->password)){
            // if($user->is_active == 0){
            //     Session::flash('error', 'Your account is not activated yet! Please check you email.');
            //     return back();
            // }
            Auth::login($user);
            if($get->remember){
                $reminfo = [
                    'email' => $get->email,
                    'password' => $get->password
                ];
                Session::put('reminfo', $reminfo);
            }
            Session::flash("success", "Login Successful");
            if($user->role == 1)
                return redirect('/home');
            else
                return redirect('/user/home');
        }else{
            Session::flash('error', 'Invalid User Information.');
            return back();
        }        
    }
    public function registerpost(Request $get){
        
        $this->validate($get,[
            "first_name" => 'required',
            "last_name" => 'required',
            "phone" => 'required',
            "email" => 'required|email|unique:users,email',
            "password" => 'required|min:8|confirmed'
        ],[
            "name.required" => 'Enter your full name here',
            "email.required" => 'Enter your email here',
            "email.email" => 'Enter your valid email',
            "email.unique" => 'This email id already registered',
            "password.required" => 'Enter your password',
            "password.confirmed" => 'Password not matches',
            "password.min" => 'Password should in 8 digits'
        ]);
        $token = rand(123456,987643);
        $user =  User::create([
            'first_name' => $get['first_name'],
            'last_name' => $get['last_name'],
            'role' => 1,
            'email' => $get['email'],
            'verify_token' => $token,
            'phone' => $get['phone'],
            'password' => Hash::make($get['password']),
        ]);

        if($user){
            try{
                Notification::route('mail', $get['email'])->notify(new VerifyAccount($user , $token));
            }catch(\Exception $e){
    
            }
            Session::flash('success', 'Registration successfull! you can login now');
            return redirect()->route('login');
        }else{
            $createuser = $this->unVerified();
            if($createuser == true){
                Session::flash('error', 'Something went wrong');
                return redirect()->route('login');
            }else{
                echo 'asdf'; exit;
            }
        }
    }
       
    public function logout(){
        Auth::logout();
        Session::flash("success", "Logout Successful");
        return redirect('/');
    }
}
