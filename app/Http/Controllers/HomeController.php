<?php

namespace App\Http\Controllers;
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


       
        return view('admin.home');
    }
   
}
