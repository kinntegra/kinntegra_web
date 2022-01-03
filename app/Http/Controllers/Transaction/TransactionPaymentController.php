<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\MarketService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class TransactionPaymentController extends Controller
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
    public function index($id,Request $request)
    {
        $getclient = $this->marketService->getTransactionClientDetails($id);
        $transactionsession = $getclient->trans_session;
        // dd($id);
        // $client = $this->marketService->GetTransactionDetail($id);
        //dd($getclient);
        return view('transaction.newtransactionpayment')->with([
            'client' => $getclient,
            'transactionsession' => $transactionsession,
        ]);

        //dd('reached');
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
        //dd($data);
        $rules = [];
        if($request->payment == 'OTM')
        {
            $rules = [
                'payment' => 'required',
                'otm_mandate' => 'required',
            ];
        }

        if($request->payment == 'NEFT/RTGS')
        {
            $rules = [
                'payment' => 'required',
                'utr_number' => 'required',
            ];
        }

        if($request->payment == 'Net Banking')
        {
            $rules = [
                'payment' => 'required',
                'net_bank_id' => 'required',
            ];
        }

        if($request->payment == 'Cheque')
        {
            $rules = [
                'cheque_number' => 'required|numeric|digits:6',
                'cheque_date' => 'required',
                'cheque_bank_id' => 'required',
                'cheque_upload' => 'required|max:512|mimes:png,jpg,jpeg',
            ];
        }


        // $rules = [
        //     'payment' => 'required',
        //     'otm_mandate' => 'required_if:payment,OTM',
        //     'utr_number' => 'required_if:payment,neftrtgs',
        //     'net_bank_id' => 'required_if:payment,netbanking',
        //     'cheque_number' => 'sometimes|required_if:payment,cheque|numeric|digits:6',
        //     'cheque_date' => 'required_if:payment,cheque',
        //     'cheque_bank_id' => 'required_if:payment,cheque',
        //     'cheque_upload' => 'required_if:payment,cheque',
        // ];

        $messages = [
            'payment.required' => 'Select payment mode',
            'otm_mandate.required' => 'Please select mandate',
            'utr_number.required' => 'Please enter utr no',
            'net_bank_id.required' => 'Please select bank',
            'cheque_number.required' => 'Enter cheque no',
            'cheque_date.required' => 'Select cheque date',
            'cheque_bank_id.required' => 'Select bank',
            'cheque_upload.required' => 'Upload Cheque photo',
        ];

        $validator = Validator::make($data, $rules, $messages);


        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput()
            ->with('transactionsession', $request['transactionsession']);
        }
        if($request->payment == 'multiple_payment')
        {
            foreach($data as $key => $value)
            {
                $portfolio_ids = json_decode($request->multiple_payment_ids);
                foreach($portfolio_ids as $id => $val)
                {
                    $main_payment = 'multi_payment_'.$id;
                    $check_main_payment = $request->$main_payment;
                    if($check_main_payment == null)
                    {
                        $validator->after(function($validator) use($val,$main_payment)
                        {
                            $validator->errors()->add($main_payment, 'Select payment type for '.$val.' portfolio');
                        });
                    }else{
                        //dd($check_main_payment);
                        if($check_main_payment == 'OTM')
                        {
                            $otm_mandate = 'otm_mandate_'.$id;
                            $check_otm_mandate = $request->$otm_mandate;
                            //dd($check_otm_mandate);
                            if($check_otm_mandate == null)
                            {
                                $validator->after(function($validator) use($val,$otm_mandate)
                                {
                                    $validator->errors()->add($otm_mandate, 'Please select mandate for '.$val.' portfolio');
                                });
                            }
                        }

                        if($check_main_payment == 'NEFT/RTGS')
                        {
                            $utr_number = 'utr_number_'.$id;
                            $check_utr_number = $request->$utr_number;
                            if($check_utr_number == null)
                            {
                                $validator->after(function($validator) use($val,$utr_number)
                                {
                                    $validator->errors()->add($utr_number, 'Enter utr no for '.$val.' portfolio');
                                });
                            }
                        }

                        if($check_main_payment == 'Net Banking')
                        {
                            $netbanking = 'net_bank_id_'.$id;
                            $check_netbanking = $request->$netbanking;
                            if($check_netbanking == null)
                            {
                                $validator->after(function($validator) use($val,$netbanking)
                                {
                                    $validator->errors()->add($netbanking, 'Please select bank for '.$val.' portfolio');
                                });
                            }
                        }

                        if($check_main_payment == 'Cheque')
                        {
                            $cheque_number = 'cheque_number_'.$id;
                            $check_cheque_number = $request->$cheque_number;
                            if($check_cheque_number == null)
                            {
                                $validator->after(function($validator) use($val,$cheque_number)
                                {
                                    $validator->errors()->add($cheque_number, 'Enter cheque no for '.$val.' portfolio');
                                });
                            }

                            $cheque_date = 'cheque_date_'.$id;
                            $check_cheque_date = $request->$cheque_date;
                            if($check_cheque_date == null)
                            {
                                $validator->after(function($validator) use($val,$cheque_date)
                                {
                                    $validator->errors()->add($cheque_date, 'Enter cheque date for '.$val.' portfolio');
                                });
                            }

                            $cheque_bank_id = 'cheque_bank_id_'.$id;
                            $check_cheque_bank_id = $request->$cheque_bank_id;
                            if($check_cheque_bank_id == null)
                            {
                                $validator->after(function($validator) use($val,$cheque_bank_id)
                                {
                                    $validator->errors()->add($cheque_bank_id, 'Select bank for '.$val.' portfolio');
                                });
                            }

                            $cheque_upload = 'cheque_upload_'.$id;
                            $check_cheque_upload = $request->$cheque_upload;
                            if($check_cheque_upload == null)
                            {
                                $validator->after(function($validator) use($val,$cheque_upload)
                                {
                                    $validator->errors()->add($cheque_upload, 'Upload Cheque for '.$val.' portfolio');
                                });
                            }
                        }
                    }
                }
            }
        }

        if ($validator->fails())
        {
            return redirect()->back()
                    ->withErrors($validator)
                    ->withInput()
                    ->with('transactionsession', $request['transaction_session']);
        }
        //return response()->json($request->all());
        // if($request->hasFile('cheque_upload'))
        // {
        //     $data['cheque_upload'] = fopen($request->cheque_upload->path(), 'r');
        // }
        $i = 1;
        foreach($data as $key => $value)
        {

            if(Str::startsWith($key, 'cheque_upload'))
            {
                if($request->hasFile($key))
                {
                    if($key == 'cheque_upload' )
                    {
                        $data[$key] = fopen($request->$key->path(), 'r');
                    }else{
                        $key_id = explode("_",$key,3);
                        $temp_key = $key_id[0]."_".$key_id[1]."_".$i;
                        $temp_akey = $key_id[0]."_account_".$i;
                        $kid = $key_id[count($key_id)-1];
                        $data[$temp_key] = fopen($request->$key->path(), 'r');
                        $data[$temp_akey] = $kid;
                        $i++;

                    }
                }
            }
        }
        // dd($request->all());
        // dd($data);
        // return response()->json($data);
        $transaction = $this->marketService->setPaymentMode($data);

        //dd($transaction);
        return response()->json($transaction);
        // dd($request->all());
        // dd('shashi');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($tid,$id)
    {
        //dd($tid,$id);
        $getclient = $this->marketService->getTransactionPaymentDetails($tid,$id);
        $transactionsession = $getclient->trans_session;
        // dd($id);
        // $client = $this->marketService->GetTransactionDetail($id);
        //dd($getclient);
        return view('transaction.transactionpayment')->with([
            'client' => $getclient,
            'transactionsession' => $transactionsession,
        ]);
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
    public function destroy($tid,$id)
    {
        $deleteclient = $this->marketService->deleteTransactionClientDetails($tid,$id);

        return response()->json($deleteclient);
    }
}
