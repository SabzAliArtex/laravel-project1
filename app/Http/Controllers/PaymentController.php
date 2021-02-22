<?php

namespace App\Http\Controllers;

use App\Payment;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
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


        # code...


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


        # code...


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
        $results = $payments;
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
}
