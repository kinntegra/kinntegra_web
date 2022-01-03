<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\MarketService;
use App\Services\Security;

class TransactionLogTypeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(MarketService $marketService)
    {
        $this->middleware('auth');

        parent::__construct($marketService);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function show($type,$fund_category,Request $request)
    {
        $id = Security::decryptData($request->id);

        $getclient = $this->marketService->getTransactionLogClientDetails($id);
        $transactionsession = $getclient->trans_session;
        dd($getclient);
        // if($getclient->type == 'Lumpsum')
        // {
        //     return view('transaction.newtransactiondetails_lumpsum')->with([
        //         'transactionsession' => $transactionsession,
        //         'client' => $getclient,
        //     ]);
        // }else if($getclient->type == 'SIP')
        // {
        //     return view('transaction.newtransactiondetails_sip')->with([
        //         'transactionsession' => $transactionsession,
        //         'client' => $getclient,
        //     ]);
        // }else if($getclient->type == 'SWP')
        // {
        //     //dd($getclient);
        //     return view('transaction.newtransactiondetails_swp')->with([
        //         'transactionsession' => $transactionsession,
        //         'client' => $getclient,
        //     ]);
        // }
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
