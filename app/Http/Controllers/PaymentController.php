<?php

namespace App\Http\Controllers;
use App\Payment;
use Illuminate\Http\Request;

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
           $payments = Payment::with('sales_person','license')->orderByRaw('id DESC')->get();
           $results = $payments;
           return view('admin.commission.commissionlist',[
                'payments' => $payments
           ]);

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
     $payments = Payment::with('sales_person','license')->where('is_approved','=',0)->orderByRaw('id DESC')->get();
       $results = $payments;
       return view('admin.commission.commissionlistpending',[
            'payments' => $payments
       ]);
    }
}
