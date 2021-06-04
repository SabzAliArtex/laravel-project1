<?php

namespace App\Http\Controllers;

use Str;
use File;
use Hash;
use Image;
use Session;
use App\User;
use App\EmailLayout;
use Jenssegers\Agent\Agent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\TrialActivated;
use Illuminate\Support\Facades\Notification;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {


        return view('admin.home');
    }
    public function cool()
    {
        $data = file_get_contents(resource_path('views/emails/licenserenewal.blade.php'));
        $created = new  EmailLayout();
        $created->email_layout = $data;
        $created->name = 'LicenseTrial';
        $created->save();
        
    }
    public function checkLayout()
    {
       $user =  User::find(Auth::user()->id);
       $emaillayout = EmailLayout::latest()->first();
       return view('emails.trialactivated',[
            'el'=>$emaillayout,
            'user'=>$user
       ]);
    //    Notification::send($user,new TrialActivated($user,$token=rand()));

    }
}
