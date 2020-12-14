<?php

namespace App\Http\Controllers;
use Jenssegers\Agent\Agent;
use Illuminate\Http\Request;
use App\User;
use Hash;
use File;
use Str;
use Image;
use Session;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
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
        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $platform = $agent->platform();
        $version = $agent->version($platform);
        return view('admin.home');
    }
}
