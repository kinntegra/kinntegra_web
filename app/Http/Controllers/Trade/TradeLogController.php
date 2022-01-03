<?php

namespace App\Http\Controllers\Trade;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\MarketService;
use App\Services\Security;

class TradeLogController extends Controller
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
        $data = $this->marketService->getTradeLogClients();
        //dd($data);
        return view('tradelog.index')->with([
            'existingclients' => $data->existingclients,
            'clients' => $data->clients,
            'fromdate' => $data->fromdate,
            'todate' => $data->todate,
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

    public function GetOrderLogs($trans_buy_clients_id,$ucc,$type)
    {
        $trans_buy_clients_id = Security::decryptData($trans_buy_clients_id);
        if($type == 'lumpsum')
        {
            $funds = $this->marketService->getTradeLogGroups($trans_buy_clients_id,$ucc,$type);
            $client = $this->marketService->getTradeLogTransactions($trans_buy_clients_id,$type);
        }

        //dd($client);
        return view('tradelog.tradelog')->with(['funds' => $funds,'client' => $client]);
    }
}
