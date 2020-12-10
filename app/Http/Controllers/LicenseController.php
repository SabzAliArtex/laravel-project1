<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\License;
use App\User;
use App\Licensetype;
use Session;
use Carbon\Carbon;
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
            
        ],[
            "license.required" => "Please enter Valid License Code",
            
        ]);


        $license = License::create([
            'license' => $request['license'],
            'sales_person_id' => $request['sales_person'],
            'license_type_id' => $request['license_type'],
        ]);
        
        Session::flash("success", "License addedd successfully!");
        return back();
    }
    public function DeleteLicense($id){
        $user = License::find($id);
        $user->is_deleted = 1;
        $user->save();
        Session::flash("success", "Deleted Successfully");
        return back();
    }
    public function licenseActivation($user_id,$license_key,$dev_name,$dev_model,$dev_id){
      $response = array();
      $response['message'] = "";
      $userPerson = User::where([['id',$user_id]])->first();
      if($userPerson->role == 2){
        //$userPerson->role == 2 means that person is of type 'USER'
      $license = new License();
      $license_checks=License::all()->first();
       /*Can be used later$license->user_id  = $userPerson->id;$license->license = $license_key;$license->license_expiry = null ;$license->trial_activated_at = date("Y-m-d H:i:s") ;$license->license_activated_at = date("Y-m-d H:i:s") ;$license->device_name ='Example Device Name' ;$license->device_model ='Example Model Name' ;$license->device_unique_id = 'Example Machine Address';*/  
        if(!isset($license_key)){
            $response['message'] = "License Key Not Found";
            return json_encode($response);
        }
        if($license_checks->license != $license_key){      
            $response['message'] = "License Key isn't Valid";
            return json_encode($response);
            
        }
        /*else{
            $license->is_active == 1;

        }*/
                
            if(!isset($dev_model) || !isset($dev_name) || !isset($dev_id))
            {
                $response['message'] = "Device Credentials are Invalid";
             return  json_encode($response);

            }else{
            if($license_checks->device_name != $dev_name && $license_checks->device_model != $dev_model && $license_checks->device_unique_id !=$dev_id){

                $license->device_name =$dev_name;
                $license->device_model =$dev_model;
                $license->device_unique_id = $dev_id;
                /*Adding for time being as license_type_id doesnt have default value*/
                $license->license_type_id = 1;
                
                /*----------------------===============----------------------------*/
                $license->is_active = 1;
                $license->license = 'example value';
               
                /*----------=====-----------*/
                $today = date("d-M-Y",time());
                  $trialPeriod = 20;
                  $startDate = date("d-M-Y", time());
                  $getExpiryDate = strtotime('+'.$trialPeriod."days", strtotime($startDate));
                  $expiryDate = date("d-M-Y", $getExpiryDate);
                  /*$checkStatus = License::latest()->count();*/
                  
                  

                /*$checkStatus = mysqli_num_rows(mysqli_query($db,"SELECT * FROM timebomb"));*/
                  /*  if($checkStatus == 0){
                    mysqli_query($db,"INSERT INTO timebomb(StartDate,ExpiryDate) values   
                         ('$startDate','$expiryDate')") or die(mysqli_error());
                   }else{
                   $getPeriod = mysqli_query($db,"SELECT * FROM timebomb");
                    while($period = mysqli_fetch_array($getPeriod)){
                    $endOfTrial = $period['ExpiryDate'];
                    }
                    if($endOfTrial == $today){
                    echo "<center><font size='5' color='red'>
                 PLEASE YOUR TRIAL PERIOD IS OVER. 
                 IF YOU ENJOYED USING THIS PRODUCT, <br/>
                 CONTACT ALBERT (0205173224) FOR THE FULL VERSION. 
                  THANK YOU.";
                    exit();
                            }

                        }*/
                }
               
                    $license->save();
            }   
        
               
  }else{

    $response['message'] = "Not a Registered User";
    return json_encode($response);
  }
}
public function trialActivation($user_id,$license_key){
    $response = array();
      $response['message'] = "";
      $userPerson = User::where([['id',$user_id]])->first();
      if(isset($userPerson)){
      if($userPerson->role == 2){
      $licenseTrial = License::where('license','=',$license_key)->first();
      if(isset($licenseTrial)){
      $licenseTrial->trial_activated_at =  date("Y-m-d H:i:s");
      $licenseTrial->save();
      $response['message']  = "Trial Period Activated";
      return json_encode($response);
      }else{
      $response['message'] = "License Key is not valid";
      return json_encode($response);
            }
                                }
      }else{
    $response['message'] = "Invalid Person";
    return json_encode($response);
           }
       }
}    