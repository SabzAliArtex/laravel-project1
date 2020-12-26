<?php

namespace App\Http\Controllers;
use App\Payment;
use Illuminate\Http\Request;
use DB; 

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
           $payments = Payment::with('sales_person','license')->orderByRaw('id DESC')->paginate(10);
           $results = $payments;
           return view('admin.commission.commissionlist',[
                'payments' => $payments
           ]);

    }
    public function paymentSearch(Request $request){


    $query = $request['search'];
    $formatCheck = 0;
    if($query == ""){
      $formatCheck = 1;

     $payments = Payment::with('sales_person','license')->orderByRaw('id DESC')->paginate(10);
         return view('admin.commission.subviews.commissionlistsearchresults',[
          'payments'=>$payments,
          'formatCheck'=>$formatCheck,
        ]);  




    }else{
      $formatCheck = 0;
      
             $payments= DB::table('payments AS p1')
                ->join('licenses','licenses.id','p1.license_id')
                ->Join('users as t1','t1.id','p1.sales_person_id')
                ->where('p1.is_approved','LIKE','%'.$query.'%')
                ->orWhere('t1.first_name','LIKE','%'.$query.'%')
                ->orWhere('t1.last_name','LIKE','%'.$query.'%')
                ->get();
                
               
            return view('admin.commission.subviews.commissionlistsearchresults',[
          'payments'=>$payments,
          'formatCheck'=>$formatCheck,
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
    public function edit($id,$status)
    {   $payments = Payment::find($id);
        $word = "Approve";
        $word2 = "Pending";
        
        if(strpos($status, $word) !== false){
            $payments->is_approved = 1;
            $payments->save();
            return $payments;

        }
        if(strpos($status,$word2) !== false){
            $payments->is_approved = 0;
            $payments->save();
            return $payments;
        }
        
        
            # code...
        

    }
      public function editSearched(Request $request)

    {
        $id = $request->get('id');
        $status = $request->get('status');
      $payments = Payment::find($id);
        $word = "Approve";
        $word2 = "Pending";
        
        if(strpos($status, $word) !== false){
            $payments->is_approved = 1;
            $payments->save();
            return $payments;

        }
        if(strpos($status,$word2) !== false){
            $payments->is_approved = 0;
            $payments->save();
            return $payments;
        }
        
        
            # code...
        

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
    public function pendingCommision(){

     $payments = Payment::with('sales_person','license')->where('is_approved','=',0)->orderByRaw('id DESC')->paginate(10);
       $results = $payments;
       return view('admin.commission.commissionlistpending',[
            'payments' => $payments
       ]);
    }
    public function pendingCommisionSearchResults(Request $request){
        $query = $request['search'];
        $formatCheck = 0;
        if($query == ""){
           // return;
            $formatCheck = 1;
             $payments = Payment::with('sales_person','license')->where('is_approved','=',0)->orderByRaw('id DESC')->paginate(10);
            return view('admin.commission.subviews.commissionlistpendingsearchresults',[
                'formatCheck'=>$formatCheck,
                'payments'=>$payments,
             ]);
        }else{
            $formatCheck = 0;

            $payments = DB::connection()
                ->table('payments as p')
                ->join('licenses as l','l.id','p.license_id')
                ->Join('users as u', function($join) {
                    $join->on('u.id', '=', 'p.sales_person_id');
                    $join->where('is_approved', '=', '0');
                })
                ->select('p.*','u.first_name','u.last_name')
                ->where('p.is_approved','LIKE','%'.$query.'%')
                ->orWhere('u.first_name','LIKE','%'.$query.'%')
                ->orWhere('u.last_name','LIKE','%'.$query.'%')
                ->get();
                
                return view('admin.commission.subviews.commissionlistpendingsearchresults',[
                'formatCheck'=>$formatCheck,
                'payments'=>$payments,
             ]);

        }

    }
}
