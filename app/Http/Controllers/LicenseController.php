<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\License;
use App\User;
use App\LicenseType;
use App\License_devices;
use App\Payment;
use Session;
use Carbon\Carbon;
use Auth;
class LicenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $licenses = License::with('sales_person','user','license_type')->where('is_deleted',0)->orderByRaw('id DESC')->paginate(10);
        

        
        // echo '<pre>'; print_r($licenses); exit;
        if(Auth::user()->userrole->role == 'User'){
          

        return view('user.license.licenselist',[
          'licenses' => $licenses,
          
        ]);

        }
       
       if(Auth::user()->userrole->role == 'Admin'){

        return view('admin.license.licenselist',compact('licenses'));  

        }

       if(Auth::user()->userrole->role == 'Sales Person'){

        return view('salesPerson.license.licenselist',compact('licenses'));  

        }
    }
   


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sales_persons = User::where([['is_active','1'],['role','3'],['is_deleted','0']])->get();
        $Licensetypes = LicenseType::where('is_active','1')->get();
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
    public function EditLicense($license)
    {
        $licenses = License::where('license', $license)->firstOrFail();
        $sales_persons = User::where([['is_active','1'],['role','3'],['is_deleted','0']])->get();
        $Licensetypes = Licensetype::where('is_active','1')->get();

        return view('admin.license.editlicense',compact("licenses","sales_persons","Licensetypes"));
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
    public function licenseActivation($user_id,$license_id,$dev_id,$dev_os,$dev_name){
      /*user 3 licen 1 */

      $response = array();
      $response['message'] = "";
     if(!isset($license_id)){
          $response['message'] = "License Key Not Found";
          return json_encode($response);
      }
    if(!isset($dev_os) || !isset($dev_name) || !isset($dev_id))
        {
            $response['message'] = "Device Credentials are Invalid";
         return  json_encode($response);

        }

      $userPerson = User::where([['id',$user_id]])->first();
      $license_dev_count_rows = License_devices::with('deviceLicense')->where('device_id','=',$dev_id)->first();
       $license_count_rows = License_devices::with('deviceLicense')->where('license_id','=',$license_id)->get();
       $license_count_user = $license_count_rows->count();
      
      $license_data = License::where('id','=',$license_id)->first();
      $license_data->user_id = $userPerson->id;
      $license_data->save();
      $license_device_limit = $license_data->no_of_devices_allowed;
      if (is_null($license_dev_count_rows)) {

        //$userPerson->role == 2 means that person is of type 'USER'
     return getLicenseLimit($license_count_user,$license_device_limit,$user_id,$license_id,$dev_name,$dev_os,$dev_id);

    
 
      }else if($license_dev_count_rows->device_id == $dev_id){
      return error_code(500);
      }
      

    
}
    public function licenseActivation_old($user_id,$license_id,$dev_name,$dev_os,$dev_id){
      $response = array();
      $response['message'] = "";
      $userPerson = User::where([['id',$user_id]])->first();
      if($userPerson->role == 2){
        //$userPerson->role == 2 means that person is of type 'USER'
      $license = new License();
      $license_checks=License_devices::all()->first();
       /*Can be used later$license->user_id  = $userPerson->id;$license->license = $license_key;$license->license_expiry = null ;$license->trial_activated_at = date("Y-m-d H:i:s") ;$license->license_activated_at = date("Y-m-d H:i:s") ;$license->device_name ='Example Device Name' ;$license->device_model ='Example Model Name' ;$license->device_unique_id = 'Example Machine Address';*/  
        if(!isset($license_id)){
            $response['message'] = "License Key Not Found";
            return json_encode($response);
        }
        if($license_checks->license != $license_id){      
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