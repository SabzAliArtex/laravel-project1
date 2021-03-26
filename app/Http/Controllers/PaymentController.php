<?php

namespace App\Http\Controllers;

use App\User;
use App\License;
use App\Payment;
use App\PurchaseHistory;
use Illuminate\Http\Request;
use App\Events\PaymentFailure;
use Illuminate\Support\Facades\DB;
use App\Notifications\PaymentFailed;
use Illuminate\Support\Facades\Auth;
use App\Notifications\LicenseRenewal;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Notification;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $data['payments'] = Payment::with('sales_person', 'license')->orderByRaw('id DESC')->paginate(10);
        $data['users_sales'] = User::where('role', '=', 3)->where('is_deleted', '0')->where('id', '<>', Auth::user()->id)->Paginate('10');

        return view('admin.commission.commissionlist', $data);

    }

    public function paymentSearch(Request $request)
    {


        $query = $request['search'];
        $formatCheck = 0;
        if ($query == "") {
            

            $payments = DB::table('payments AS p1')
            ->join('licenses', 'licenses.id', 'p1.license_id')
            ->Join('users as t1', 't1.id', 'p1.sales_person_id')
            ->select('p1.*','t1.first_name','t1.last_name')
            ->get();
            
            return view('admin.commission.subviews.commissionlistsearchresults', [
                'payments' => $payments,
            ]);


        } else {

            $payments = DB::table('payments AS p1')
                ->join('licenses', 'licenses.id', 'p1.license_id')
                ->Join('users as t1', 't1.id', 'p1.sales_person_id')
                ->select('p1.*','t1.first_name','t1.last_name')
                ->where('p1.is_approved', 'LIKE', '%' . $query . '%')
                ->orWhere('t1.first_name', 'LIKE', '%' . $query . '%')
                ->orWhere('t1.last_name', 'LIKE', '%' . $query . '%')
                ->orWhere('p1.updated_at', 'LIKE', '%' . $query . '%')
                ->get();

                
            return view('admin.commission.subviews.commissionlistsearchresults', [
                'payments' => $payments,
            ]);
        }

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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $status)
    {
        $payments = Payment::find($id);
        $word = "Approve";
        $word2 = "Pending";
        if (strpos($status, $word) !== false) {
            $payments->is_approved = 1;
            $payments->save();
            return $payments;

        }
        if (strpos($status, $word2) !== false) {
            $payments->is_approved = 0;
            $payments->save();
            return $payments;
        }
    }

    public function editSearched(Request $request)

    {
        $id = $request->get('id');
        $status = $request->get('status');
        $payments = Payment::find($id);
        $word = "Approve";
        $word2 = "Pending";

        if (strpos($status, $word) !== false) {
            $payments->is_approved = 1;
            $payments->save();
            return $payments;

        }
        if (strpos($status, $word2) !== false) {
            $payments->is_approved = 0;
            $payments->save();
            return $payments;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function pendingCommision()
    {

        $payments = Payment::with('sales_person', 'license')->where('is_approved', '=', 0)->orderByRaw('id DESC')->paginate(10);
        
        return view('admin.commission.commissionlistpending', [
            'payments' => $payments
        ]);
    }

    public function pendingCommisionSearchResults(Request $request)
    {
        
        $query = $request['search'];
        
        if ($query == "") {
            
            $payments = DB::connection()
            ->table('payments as p')
            ->join('licenses as l', 'l.id', 'p.license_id')
            ->Join('users as u', function ($join) {
                $join->on('u.id', '=', 'p.sales_person_id');
                $join->where('is_approved', '=', '0');
            })->select('p.*', 'u.first_name', 'u.last_name')->get();
            
            return view('admin.commission.subviews.commissionlistpendingsearchresults', [
                
                'payments' => $payments,
            ]);
        } else {
            $payments = DB::connection()
                ->table('payments as p')
                ->join('licenses as l', 'l.id', 'p.license_id')
                ->Join('users as u', function ($join) {
                    $join->on('u.id', '=', 'p.sales_person_id');
                    $join->where('is_approved', '=', '0');
                })
                ->select('p.*', 'u.first_name', 'u.last_name')
                ->where('p.is_approved', 'LIKE', '%' . $query . '%')
                ->orWhere('u.first_name', 'LIKE', '%' . $query . '%')
                ->orWhere('u.last_name', 'LIKE', '%' . $query . '%')
                ->get();

            return view('admin.commission.subviews.commissionlistpendingsearchresults', [                
                'payments' => $payments,
            ]);

        }

    }
    public function orderCreation(Request $request)
    {  
        $data = $request->all();
        if($data == NULL)
            {
            //Do Payment Failed functioning
            //How this function will be triggered if the payment is getting failed
            //because this function will not be hit from webhook response url 
            //echo 'no payload but there should be one payload as operations depend upon that data';
            //How can i send notification if i am not getting the user to send to
            // Notification::send($data['email'],new PaymentFailed($data));
            }   
        
        $trigger = false;
       
            Storage::put('attempt1.txt',json_encode( $data));
        
        
             foreach($data['line_items'] as $row)
            {
             if(isset($row['properties'])){
                
                foreach($row['properties'] as $license)
                {
                     
                    if($license['value'] == NULL){
                            $trigger= true;
                            
                        }
                    if(isset($license['name']) && isset($license['value']))
                    {
                      
                        $this->licenseRenew($data,$license['value'],$row['variant_id']);
                        
                        
                    }
                }
            }else
            {
                $trigger = true;
            
            }
         }
         
         
        if($trigger == true)
        {
     
        findUser($data);
        findLicense($data);
        $purchaseHistory = new PurchaseHistory();
        try {
        foreach($data['line_items'] as $row){
            
            $purchaseHistory->email = $request->get('email');
            
            // $purchaseHistory->license = $row['title'];
            if(isset($row['properties'])){
                
                foreach($row['properties'] as $license)
                {
                    if($license['value'] == NULL)
                    {
                        $purchaseHistory->license = $license['value'];
                    }
                    // if($license['name'] && $license['value'])
                    // {
                    //
                    //     $this->licenseRenew($data,$license['value'],$row['variant_id']);
                    //    
                    //    
                    // }
                }
            }
        
            if($row['variant_id'] == '39277635862712')
            {
                $purchaseHistory->license_type_id = 1;
            }
           else if($row['variant_id'] == '39277635895480')
            {
                $purchaseHistory->license_type_id = 2;
            }
            else if($row['variant_id'] == '39277635928248')
            {
                $purchaseHistory->license_type_id = 3;

             }
        else
        {
            $purchaseHistory->license_type_id = 4;
         }
        
            $purchaseHistory->purchase_date =  date("Y-m-d H:i:s");
            $purchaseHistory->activation_date = date("Y-m-d H:i:s");
            $purchaseHistory->status = 1; 
            $purchaseHistory->save();
           
        }
    }
        catch(\Exception $e){
            Storage::put('customerror.txt',json_encode($e));
        }

        }

    
    }
    public function paymentcheck(Request $request)
    {
        Storage::put('paymentcheck.txt',json_encode($request));
    }
    public function orderSubscription(Request $request)
    {
        Storage::put('subscriber.txt',json_encode($request->all()));
    }
    public function orderCancel(Request $request)
    {
        Storage::put('cancel.txt',json_encode($request->all()));
    }
    public function licenseRenew($request,$key,$variant)
    {
        Storage::put('licenserenewal.txt',json_encode($request));
        
        $data = $request;
       
        $user = User::where('email','=',$data['email'])->first();
        //  echo json_encode($user);
        // return;
        
        $license = License::where('license','=',$key)->first();
        if($variant == '39277635862712')
        {
            $license->license_expiry = now()->addMonths(1);

        }
        else if($variant='39277635895480')
        {
            $license->license_expiry =  now()->addYears(1);
        }else if($variant == '39277635928248')
        {

            $license->license_expiry =  now()->addYears(100);
        }
       

        
        $license->save();
        Notification::send($user,new LicenseRenewal($user,$license));
      

    }
}
