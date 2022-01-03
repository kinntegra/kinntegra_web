<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\MarketService;
use App\Services\MyServices;
use App\Services\Security;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class NewTransactionController extends Controller
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
    //Ok
    public function index(Request $request)
    {
        $type = isset($request->type) ? $request->type : 'initiate';

        $transactionsession = (string) Str::uuid();

        if($type == 'initiate')
        {
            $clients = $this->marketService->getTransactionClients();
            $pendings = $this->marketService->getPendingTransactions();
            //dd($pendings);
            return view('transaction.newtransaction')->with([
                'clients' => $clients,
                'transactionsession' => $transactionsession,
                'pendings' => $pendings,
            ]);
        }
    }

    //NOT OK
    public function index1(Request $request)
    {
        $type = isset($request->type) ? $request->type : 'initiate';
        //$transactionsession = session('transactionsession');

        $data = $request->all();
        $getclient = '';

        if($id = $request->id)
        {
            $getclient = $this->marketService->getTransactionClientDetails($id);
            $transactionsession = $getclient->trans_session;
        }else if($id = $request->allocation_id){
            $getclient = $this->marketService->getTransactionClientAllocationDetails($id,$data);
            $transactionsession = $getclient->trans_session;
        }
        else{
            $transactionsession = (string) Str::uuid();
        }
        //dd($getclient);
        //dd($transactionsession);
        if($type == 'initiate')
        {
            $clients = $this->marketService->getTransactionClients();
            $pendings = $this->marketService->getPendingTransactions();
            //dd($pendings);
            return view('transaction.newtransaction')->with([
                'clients' => $clients,
                'transactionsession' => $transactionsession,
                'pendings' => $pendings,
                'client' => $getclient,
            ]);
        }

        if($type == 'details')
        {
            //dd($getclient);
            $subtype = $request->subtype;
            //dd($subtype);
            if($subtype == 'Wealth' || $subtype == 'Tax' || $subtype == 'Shortterm' || $subtype == 'Gold' || $subtype == 'SWP'){
                if($getclient->type == 'Lumpsum')
                {
                    return view('transaction.newtransactiondetails_lumpsum')->with([
                        'transactionsession' => $transactionsession,
                        'client' => $getclient,
                    ]);
                }else if($getclient->type == 'SIP')
                {
                    return view('transaction.newtransactiondetails_sip')->with([
                        'transactionsession' => $transactionsession,
                        'client' => $getclient,
                    ]);
                }else if($getclient->type == 'SWP')
                {
                    //dd($getclient);
                    return view('transaction.newtransactiondetails_swp')->with([
                        'transactionsession' => $transactionsession,
                        'client' => $getclient,
                    ]);
                }
            }else if($subtype == 'Other'){
                return view('transaction.newtransactiondetails_other');
            }else if($subtype == 'allocation'){
                //dd($getclient);
                return view('transaction.newtransactiondetails_allocation')->with([
                    'transactionsession' => $transactionsession,
                    'client' => $getclient,
                    'allocation_id' => $request->allocation_id,
                    'type' => $request->type,
                    'subtype' => $request->subtype,
                    'maintype' => $request->maintype,
                    'status' => $request->status,
                ]);
            }
        }

        // if($type == 'Payment')
        // {
        //     //dd($getclient);
        //     return view('transaction.newtransactionpayment')->with([
        //         'client' => $getclient,
        //         'transactionsession' => $transactionsession,
        //     ]);
        // }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //dd($request->all());
        $id = $request->id;
        $type = $request->type ? $request->type : 'Recommended';
        $amount = (int)str_replace( ',', '', $request->amount);
        $withdrawal_amount = $request->withdrawal_amount;
        $description = isset($request->description) ? $request->description : null;
        if($request->withdrawal_amount)
        {
            $withdrawal_amount = $request->withdrawal_amount > 0 ? (int)str_replace( ',', '', $request->withdrawal_amount) : 0;
        }
        $equity = $request->equity;

        //dd($id,$amount,$withdrawal_amount,$equity,$type);
        $data= $this->marketService->setTransactionamount($id,$amount,$withdrawal_amount,$equity,$type,$description);
        //dd($data);
        return response()->json($data);
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
        //dd($data);
        //return response()->json($request->all());
        // if($request->ajax())
        // {
        //     return response()->json($request->all());
        // }
        if($request->type == 'initiate')
        {
            $validator = Validator::make($data, [
                    'transaction_client' => 'required',
                    'transaction_type' => 'required',
                    'transaction_plan' => 'required',
                    'transaction_portfolio' => 'required_if:transaction_plan,lumpsum,sip',
                ],
                [
                    'transaction_client.required' => 'Please select client',
                    'transaction_type.required' => 'Please select type',
                    'transaction_plan.required' => 'Please select plan',
                    'transaction_portfolio.required_if' => 'Please select portfolio',
                ]
            );
            //dd($request['transactionsession']);
            if ($validator->fails()) {
                return redirect('transaction')
                ->withErrors($validator)
                ->withInput()
                ->with('transactionsession', $request['transactionsession']);
            }
            //return response()->json($request->all());
            //dd($data);
            $newtransaction = $this->marketService->setNewTransaction($data);
            //dd($newtransaction);
            $tid = Security::encryptData($newtransaction->id);
            return redirect()->route('transaction.type.show',['transaction'=>strtolower($newtransaction->type),'type'=>strtolower($newtransaction->fund_category),'id' => $tid]);
            //return redirect()->route('transaction.index',['id' => $newtransaction->id,'type' => 'details', 'subtype' => $newtransaction->fund_category]);
        }

        if($request->type == 'details')
        {
            //return response()->json($data);
            $newtransaction = $this->marketService->setNewTransaction($data);
            if($request->ajax())
            {
                return response()->json($newtransaction);
            }
            //dd($newtransaction);
            if(!empty($newtransaction->allocation_id))
            {
                return redirect()->route('transaction.index',['allocation_id' => $newtransaction->allocation_id,'type' => 'details', 'subtype' => 'allocation', 'maintype' => $newtransaction->subtype, 'status' => 0]);
            }
            if($newtransaction->type == 'payment')
            {
                //dd($newtransaction);
                return redirect()->route('transaction.payment.index', $newtransaction->trans_session);
            }else{
                //return redirect()->route('transaction.index',['id' => $newtransaction->id,'type' => $newtransaction->type, 'subtype' => $newtransaction->subtype]);
                //dd($newtransaction);
                $tid = Security::encryptData($newtransaction->id);
                return redirect()->route('transaction.type.show',['transaction'=>strtolower($request->transaction_plan),'type'=>strtolower($newtransaction->subtype),'id' => $tid]);
            }
        }
        //dd($request->all());
        if($request->type == 'payment')
        {
            return response()->json($data);
            $newtransaction = $this->marketService->setNewTransactionPayment($data);
            //dd($newtransaction);
        }
        //return response()->json($newtransaction);
        //dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        if($request->ajax())
        {
            //Reset the SWP Function
            $newtransaction = $this->marketService->delSWPTransaction($id);
            return response()->json($newtransaction);
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
     * Update section is used to update the allocation module
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();

        //dd(str_replace( '₹', '', $request->scheme_amount_171 ));
        //dd(str_replace( ',', '', $request->scheme_amount_171 ));
        foreach($data as $k => $v)
        {
            if( strpos($v, '₹') !== false ) {
                $v = str_replace( '₹', '', $v );
                $data[$k] = $v;
            }
            if( strpos($v, ',') !== false ) {
                $v = str_replace( ',', '', $v );
                $data[$k] = $v;
            }
            if (strpos($k, 'wealth-') === 0) {
                // It starts with 'http'
                $k = str_replace('wealth-', '', $k);
                $data[$k] = $v;
            }
            if (strpos($k, 'Tax-') === 0) {
                // It starts with 'http'
                $k = str_replace('Tax-', '', $k);
                $data[$k] = $v;
            }
            if (strpos($k, 'Shortterm-') === 0) {
                // It starts with 'http'
                $k = str_replace('Shortterm-', '', $k);
                $data[$k] = $v;
            }
            if (strpos($k, 'Gold-') === 0) {
                // It starts with 'http'
                $k = str_replace('Gold-', '', $k);
                $data[$k] = $v;
            }
            if (strpos($k, 'sip-') === 0) {
                // It starts with 'http'
                $k = str_replace('sip-', '', $k);
                $data[$k] = $v;
            }
        }
        //dd($data);
        //return response()->json($data);
        $newtransaction = $this->marketService->setNewTransactionAllocation($data,$id);
        //dd($newtransaction);
        if($request->ajax())
        {
            return response()->json($newtransaction);
        }
        if($newtransaction->status == 'payment')
        {
            return redirect()->route('transaction.payment.index', $newtransaction->trans_session);
        }
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
