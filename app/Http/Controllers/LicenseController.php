<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\License;
use App\User;
use App\Licensetype;
use Session;

class LicenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $licenses = License::with('sales_person','user','license_type')->where('is_deleted',NULL)->orderByRaw('id DESC')->get();
        // echo '<pre>'; print_r($licenses); exit;
        return view('admin.license.licenselist',compact('licenses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sales_persons = User::where([['is_active','1'],['role','3']])->get();
        $Licensetypes = Licensetype::where('is_active','1')->get();
        
        return view('admin.license.addlicense',compact('sales_persons','Licensetypes'));        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $this->validate($request, [
            "license" => "required",
            "license_type" => "required",
        ],[
            "license.required" => "Please enter Valid License Code",
            "license_type.required" => "Pleas select license ",
        ]);

        $license = License::create([
            'license' => $request['license'],
            'license_type_id' => $request['license_type'],
            'sales_person_id' => $request['sales_person'],
        ]);
        
        Session::flash("success", "License addedd successfully!");
        return back();
    }
    public function EditLicense($license)
    {
        $licenses = License::where('license', $license)->firstOrFail();
        $sales_persons = User::where([['is_active','1'],['role','3']])->get();
        $Licensetypes = Licensetype::where('is_active','1')->get();

        return view('admin.license.editLicense',compact("licenses","sales_persons","Licensetypes"));
    }
    public function EditLicensePost(Request $request)
    {
        $License = License::find($request['id']);
        $this->validate($request, [
            "license_type" => "required",
        ],[
            "license_type.required" => "Pleas select license ",
        ]);

        if(!$License){
            Session::flash("error", "Something went wrong!");
            return back(); 
        }

        $License->license_type_id = $request['license_type'];
        $License->sales_person_id = $request['sales_person'];
        $License->save();

        Session::flash("success", "License updated successfully!");
        return back();
    }
    public function DeleteLicense($id){
        $License = License::find($id);
        
        $License->is_deleted = 1;
        $License->save();
        Session::flash("success", "Deleted successfully");
        return back();
    }
    
}
