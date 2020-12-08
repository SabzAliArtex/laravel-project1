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
            else if($user->role == 2)
                return redirect('/user/home');
            else
                return redirect('/salesperson/home');
        }else{
            Session::flash('error', 'Invalid User Information.');
            return back();
        }        
    }
}
