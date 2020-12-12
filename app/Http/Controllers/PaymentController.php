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
    public function edit($id)
    {   
        
        $payment_status = Payment::find($id);
        return $payment_status->is_approved;
            # code...
        
        /*
        
        if($is_clicked == 1 ){
            if($payment_status->is_approved == 1){
                $payment_status->is_approved = 0;
            $payment_status->save();
                
            }else{

            $payment_status->is_approved = 0;
            $payment_status->save();
            return $payment_status;   
            }
        }elseif ($is_clicked == 0) {
            if($payment_status->is_approved == 0){

            $payment_status->is_approved = 0;
            $payment_status->save();
            return $payment_status;   
            }else{

            return false;
            }
            
        }
        else{
            $response['message'] = "Incorrect Operations";
            return json_encode($reponse);
        }
*/
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
