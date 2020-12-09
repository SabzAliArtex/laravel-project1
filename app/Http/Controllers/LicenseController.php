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
    public function DeleteLicense($id){
        $user = License::find($id);
        $user->is_deleted = 1;
        $user->save();
        Session::flash("success", "Deleted successfully");
        return back();
    }
    public function licenseActivation($user_id,$sales_person_id,$license_key,$license_id){
        //Demo Variable Values Start
        $user_id=2;
        $sales_person_id = 3;
        $license_key = 'r123sadas21cc33';
        //Variables end

        $userPerson = User::where([['id',$user_id]])->first();
        if($userPerson->role == 2){
        $userPersons_salesPerson = User::where([['role',3],['id',$sales_person_id]])->first();
        if(!isset($userPersons_salesPerson)){
            dd('Not sales person or Sales Person Id is missing');
        }else{
        //$userPerson->role == 2 means that person is of type 'USER'
        $license_type = Licensetype::where('id','=',$license_id)->first();
        $license = new License();
        $license->user_id  = $userPerson->id;
        $license->sales_person_id = $userPersons_salesPerson->id;
        $license->license_type_id = $license_type->id ;
        $license->license = $license_key;
        $license->license_duration = $license_type->license_duration ;
        $license->license_expiry = null ;
        $license->allowed_test = $license_type->allowed_test;
        $license->trial_activated_at = date("Y-m-d H:i:s") ;
        $license->license_activated_at = date("Y-m-d H:i:s") ;
        $license->device_name ='Example Device Name' ;
        $license->device_model ='Example Model Name' ;
        $license->device_unique_id = 'Example Machine Address';
        $license->is_active = 1 ;
        $license->is_deleted = null;
        $license->created_at = date("Y-m-d H:i:s");
        $license->updated_at = date("Y-m-d H:i:s");
        $license->save();
            dd($license);
        }
        }else{

            //Person is not a User


        }


    }
    
}
