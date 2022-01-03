<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientMandateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = $request->all();
        $client = $this->marketService->getClientDetail($request->cid);
        $accounts = $client->accountsdata;
        $content = '';
        foreach($accounts as $bodyaccount)
        {
            if($bodyaccount->id == $request->aid)
            {
                $bank = '<option value="" disabled selected>Select Type</option>';
                //dd($bodyaccount->first_holder);
                if($bodyaccount->first_holder > 0)
                {
                    $bank .= '<optgroup label="'.$bodyaccount->first_holder_profile->name.'">';
                    foreach ($bodyaccount->first_holder_profile->banks as $first_bank)
                    {
                        $bank .= '<option value="'.$first_bank->id.'">'.$first_bank->bank_name.' - '.$first_bank->account_no.'</option>';
                    }
                    $bank .= '</optgroup>';
                }
                if($bodyaccount->second_holder > 0)
                {
                    $bank .= '<optgroup label="'.$bodyaccount->second_holder_profile->name.'">';
                    foreach ($bodyaccount->second_holder_profile->banks as $second_bank) {
                        $bank .= '<option value="'.$second_bank->id.'">'.$second_bank->bank_name.' - '.$second_bank->account_no.'</option>';
                    }
                    $bank .= '</optgroup>';
                }
                if($bodyaccount->third_holder > 0)
                {
                    $bank .= '<optgroup label="'.$bodyaccount->third_holder_profile->name.'">';
                    foreach ($bodyaccount->third_holder_profile->banks as $third_bank) {
                        $bank .= '<option value="'.$third_bank->id.'">'.$third_bank->bank_name.' - '.$third_bank->account_no.'</option>';
                    }
                    $bank .= '</optgroup>';
                }
                $content .= '<div class=" row">';
                    $content .= '<div class="col-sm-4 bankdetail_'. $bodyaccount->id .'_'.$request->sr_no.'">';
                        $content .= '<div class="form-group">';
                            $content .= '<label>Type</label>';
                            $content .= '<select class="form-control" name="bankdetail_'. $bodyaccount->id .'_'.$request->sr_no.'" id="bankdetail_'. $bodyaccount->id .'_'.$request->sr_no.'">';
                                $content .= $bank;
                            $content .= '</select>';
                        $content .= '</div>';
                    $content .= '</div>';
                    $content .= '<div class="col-sm-4 amountdetail_'. $bodyaccount->id .'_'.$request->sr_no.'">';
                        $content .= '<div class="form-group">';
                        $content .= '<label>Amount</label>';
                        $content .= '<input type="text" class="form-control" name="amountdetail_'. $bodyaccount->id .'_'.$request->sr_no.'" id="amountdetail_'. $bodyaccount->id .'_'.$request->sr_no.'" placeholder="Enter Amount">';
                        $content .= '</div>';
                    $content .= '</div>';
                    $content .= '<div class="col-sm-1">';
                        $content .= '<a class="btn delete-mandate btn-danger mt-4">';
                            $content .= '<i class="icon-close"></i>';
                        $content .= '</a>';
                    $content .= '</div>';
                $content .= '</div>';

            }
        }
        return response()->json($content);
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
        // return response()->json($data);
        $client = $this->marketService->setClientDetails($data);
        // dd($client);
        if($request->ajax())
        {
            return response()->json($client);
        }
        return redirect()->route('download.show',$request->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = $this->marketService->getClientDetail($id);
        $relations = $this->marketService->getRelationList();
        //dd($client->accountsdata);
        return view('client.mandate')
        ->with([
            'client_id' => $id,
            'client' => $client,
            'relations' => $relations,
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
    public function destroy($id)
    {
        //
    }
}
