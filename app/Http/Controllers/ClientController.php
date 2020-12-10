<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
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

        if($get->file('thumb')){
            $this->validate($get, [
                "thumb" => "mimes:png,jpg,jpeg"
            ],[
                "thumb.mimes" => "Please upload png or jpg format" 
            ]);
            if(File::exists($user->thumb)){
                File::delete($user->thumb);
            }
            $path  = 'files/upload/user/';
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
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
