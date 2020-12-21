<?php

namespace App\Http\Controllers;

use App\LicenseType;
use App\Test;
use Illuminate\Http\Request;
use Session;

class LicenseTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['license_types'] = LicenseType::where('is_deleted','=', NULL)->get();
        return view('admin.license.licensetype',$data);
    }

    public function AddLicenseType()
    {
        $tests = Test::where('is_active','=',1)->get();

        return view('admin.license.addlicensetype',[
            'tests'=>$tests,
        ]);
    }
    public function AddLicenseTypePost(Request $get)
    {
        
        $this->validate($get, [
            "title" => "required",
            "price" => "required|numeric|min:2|max:9999",
            "type" => "required",
        ],[
            "title.required" => "Please enter license type.",
            "price.required" => "Please enter price.",
            "price.numeric" => 'Please enter valid number.',
            "price.min" => 'Price should be greater then 1. ',
            "price.max" => 'Price should be less then 1000. ',
            "type.required" => 'Please select license type.',
        ]);
        
        $licenseType =  LicenseType::create([
            'title' => $get['title'],
            'price' => $get['price'],
            'type' => $get['type'],
            'allowed_test' => json_encode($get['allowed_test']),
            'is_active' => $get['is_active'],
        ]);
        Session::flash("success", "License type created successfully");
        return redirect('/licensetypes');
    }

    public function EditLicenseType($id)
    {
        $data['licensetype'] = LicenseType::find($id);
        $data['tests'] = Test::latest()->get();
        
        
        return view('admin.license.editlicensetype',$data);
    }
    public function EditLicenseTypePost(Request $get)
    {
        
        $this->validate($get, [
            "title" => "required",
            "price" => "required|numeric|min:2|max:9999",
        ],[
            "title.required" => "Please enter license type",
            "price.required" => "Please enter price",
            "price.numeric" => 'Please enter valid number',
            "price.min" => 'Price should be greater then 1 ',
            "price.max" => 'Price should be less then 1000 ',
        ]);

        $LicenseType = LicenseType::find($get->get('id'));
        $LicenseType->title = $get['title'];
        $LicenseType->price = $get['price'];
        $LicenseType->type = $get['type'];
        $LicenseType->allowed_test = $get['allowed_test'];
        $LicenseType->is_active = $get['is_active'];
        $LicenseType->save();

        Session::flash("success", "License type updated successfully");
        return redirect('/licensetypes');
    }
    public function deleteLicenseType($id){
        $user = LicenseType::find($id);
        
        $user->is_deleted = 1;
        $user->save();
        Session::flash("success", "Deleted successfully");
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
     * @param  \App\LicenseType  $licenseType
     * @return \Illuminate\Http\Response
     */
    public function show(LicenseType $licenseType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LicenseType  $licenseType
     * @return \Illuminate\Http\Response
     */
    public function edit(LicenseType $licenseType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LicenseType  $licenseType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LicenseType $licenseType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LicenseType  $licenseType
     * @return \Illuminate\Http\Response
     */
    public function destroy(LicenseType $licenseType)
    {
        //
    }
}
