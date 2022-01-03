<?php

namespace App\Http\Controllers\External;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\MyServices;
use Illuminate\Support\Facades\Validator;

class TransactionBuyOrder extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(isset($request->log_id))
        {
            $data = $this->marketService->getExternalSchemeLogDetail($request->log_id);
        }
        return response()->json($data);
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
        $data = $request->all();
        return response()->json($data);
        //dd($data);

        $output = $this->marketService->setExternalBuyOrder($data);

        return response()->json($output);
    }

    public function paymentorderbuy(Request $request)
    {
        $data = $request->all();

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //dd($id);
        $data = $this->marketService->getExternalBuyOrder($id);
        //dd($data);
        if($data->status == 'Canceled')
        {
            return view('external.transaction.transactionbuyCanceled');
        }
        if($data->status == 'success')
        {
            return view('external.transaction.transactionbuy')->with([
                'client' => $data->transaction,
                'trans_param' => $id,
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $output = $this->marketService->setExternalBuyPaymentOrder($id);
        return response()->json($output);
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

    /**
     * Order Success
     */

    public function OrderStatus($status)
    {
        if($status == 'success')
        {
            return view('external.transaction.transaction_message')->with([
                'status' => $status,
                'message' => 'Your Order has been Successfully send to AMC for Validation',
            ]);
        }
        if($status == 'reject')
        {
            return view('external.transaction.transaction_message')->with([
                'status' => $status,
                'message' => 'Your rejection request has been send to associate for further updation',
            ]);
        }
        if($status == 'failed')
        {
            return view('external.transaction.transaction_failed');
        }
    }
}
