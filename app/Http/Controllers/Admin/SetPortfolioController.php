<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Rules\CheckTotal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\MarketService;
use Illuminate\Support\Facades\Validator;

class SetPortfolioController extends Controller
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
        if(Auth::user()->hasRole('superadmin') || Auth::user()->in_house == 1)
        {
            $amc_codes = $this->marketService->getAMCCodes();
            $equity_scheme_codes = $this->marketService->getAllSchemeCodes('wealth-equity');
            $debt_scheme_codes = $this->marketService->getAllSchemeCodes('wealth-debt');
            $shortterm_scheme_codes = $this->marketService->getAllSchemeCodes('shortterm');
            $tax_scheme_codes = $this->marketService->getAllSchemeCodes('tax');
            $gold_scheme_codes = $this->marketService->getAllSchemeCodes('gold');
            return view('admin.modelportfolio.setportfolio')->with([
                'amc_codes' => $amc_codes,
                'equity_scheme_codes' => $equity_scheme_codes,
                'debt_scheme_codes' => $debt_scheme_codes,
                'shortterm_scheme_codes' => $shortterm_scheme_codes,
                'tax_scheme_codes' => $tax_scheme_codes,
                'gold_scheme_codes' => $gold_scheme_codes,
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $type = $request->type;
        if($type == 'equity' || $type == 'debt')
        {
            $scheme_codes = $this->marketService->getAllSchemeCodes('wealth-'.$type);
        }else{
            $scheme_codes = $this->marketService->getAllSchemeCodes($type);
        }

        $count = $request->count;
        $name = '';
        $scheme_id = 'scheme_code_'.$type.'_'.$count;
        $scheme_id = $request->$scheme_id;
        $amc_code_rr = 'amc_code_'.$type.'_regular_residence_'.$count;
        $amc_code_rr = $request->$amc_code_rr;
        $scheme_code_rn = 'scheme_code_'.$type.'_regular_nri_'.$count;
        $scheme_code_rn = $request->$scheme_code_rn;
        $amc_code_sr = 'amc_code_'.$type.'_swp_residence_'.$count;
        $amc_code_sr = $request->$amc_code_sr;
        $scheme_code_sn = 'scheme_code_'.$type.'_swp_nri_'.$count;
        $scheme_code_sn = $request->$scheme_code_sn;
        $scheme_code_sp = 'scheme_code_'.$type.'_swp_priority_'.$count;
        $scheme_code_sp = $request->$scheme_code_sp;
        //dd($amc_code_rr,$scheme_code_rn,$amc_code_sr,$scheme_code_sn);
        if($type == 'equity')
        {
            $name = 'Equity';
        }else if($type == 'debt'){
            $name = 'Debt';
        }else if($type == 'shortterm'){
            $name = 'Short Term';
        }else if($type == 'tax'){
            $name = 'Tax';
        }else if($type == 'gold'){
            $name = 'Gold';
        }
        $data = '';
        $data .= '<tr class="active_scheme_'.$count.'">';
            $data .= '<td data-title="Scheme Name">';
                $data .= '<select class="form-control max_select schemecode_'.$count.'" id="scheme_code_'.$type.'_'.$count.'" data-type="'.$type.'" name="scheme_code_'.$type.'_'.$count.'">';
                    $data .= '<option value="" selected disabled>Select Scheme Name</option>';
                    foreach ($scheme_codes as $code)
                    {
                        if($scheme_id == $code->id)
                        {
                            $data .= '<option value="'.$code->id.'" selected>'.$code->scheme_nav_name.'</option>';
                        }else{
                            $data .= '<option value="'.$code->id.'">'.$code->scheme_nav_name.'</option>';
                        }
                    }
                $data .= '</select>';
            $data .= '</td>';
            if($type == 'equity' || $type == 'debt')
            {
                $data .= '<td data-title="Amc Code '.$name.' Regular Residence">';
                    $data .= '<select class="form-control amccode_regular_residence_'.$count.'" data-type="'.$type.'_residence" id="amc_code_'.$type.'_regular_residence_'.$count.'" name="amc_code_'.$type.'_regular_residence_'.$count.'">';
                        for ($i=0; $i <= 100; $i++) {
                            if($amc_code_rr == $i)
                            {
                                $data .= '<option value="'.$i.'" selected>'.sprintf("%02d", $i).'</option>';
                            }else{
                                $data .= '<option value="'.$i.'">'.$i.'</option>';
                            }
                        }
                    $data .= '</select>';
                $data .= '</td>';
                $data .= '<td data-title="Scheme Code '.$name.' Regular NRI">';
                    $data .= '<select class="form-control schemecode_regular_nri_'.$count.'" id="scheme_code_'.$type.'_regular_nri_'.$count.'" data-type="'.$type.'_nri" name="scheme_code_'.$type.'_regular_nri_'.$count.'">';
                        for ($j=0; $j <= 100; $j++) {
                            if($scheme_code_rn == $j)
                            {
                                $data .= '<option value="'.$j.'" selected>'.sprintf("%02d", $j).'</option>';
                            }else{
                                $data .= '<option value="'.$j.'">'.$j.'</option>';
                            }
                        }
                    $data .= '</select>';
                $data .= '</td>';
                $data .= '<td data-title="Scheme Code '.$name.' SWP Priority" class="border-left">';
                    $data .= '<div class="custom-checkbox mr-3 text-center">';
                        if($scheme_code_sp == 0)
                        $data .= '<input type="checkbox" class="swp_priority form-control scheme_code_'.$type.'_swp_priority_'.$count.'" id="scheme_code_'.$type.'_swp_priority_'.$count.'" data-type="'.$type.'_priority" name="scheme_code_'.$type.'_swp_priority_'.$count.'" value="0">';
                        else
                        $data .= '<input type="checkbox" class="swp_priority form-control scheme_code_'.$type.'_swp_priority_'.$count.'" id="scheme_code_'.$type.'_swp_priority_'.$count.'" data-type="'.$type.'_priority" name="scheme_code_'.$type.'_swp_priority_'.$count.'" value="1" checked>';
                        $data .= '<label for="scheme_code_'.$type.'_swp_priority_'.$count.'"></label>';
                    $data .= '</div>';
                $data .= '</td>';
                $data .= '<td data-title="Amc Code '.$name.' SWP Residence">';
                    $data .= '<select class="form-control amccode_swp_residence_'.$count.'" data-type="'.$type.'_residence" id="amc_code_'.$type.'_swp_residence_'.$count.'" name="amc_code_'.$type.'_swp_residence_'.$count.'">';
                        for ($k=0; $k <= 100; $k++) {
                            if($amc_code_sr == $k)
                            {
                                $data .= '<option value="'.$k.'" selected>'.sprintf("%02d", $k).'</option>';
                            }else{
                                $data .= '<option value="'.$k.'">'.$k.'</option>';
                            }
                        }
                    $data .= '</select>';
                $data .= '</td>';
                $data .= '<td data-title="Scheme Code '.$name.' SWP NRI">';
                    $data .= '<select class="form-control schemecode_swp_nri_'.$count.'" id="scheme_code_'.$type.'_swp_nri_'.$count.'" data-type="'.$type.'_nri" name="scheme_code_'.$type.'_swp_nri_'.$count.'">';
                        for ($l=0; $l <= 100; $l++) {
                            if($scheme_code_sn == $l)
                            {
                                $data .= '<option value="'.$l.'" selected>'.sprintf("%02d", $l).'</option>';
                            }else{
                                $data .= '<option value="'.$l.'">'.$l.'</option>';
                            }
                        }
                    $data .= '</select>';
                $data .= '</td>';

            }else{
                $data .= '<td data-title="Amc Code '.$name.' Regular Residence">';
                    $data .= '<select class="form-control amc_code_'.$type.'_regular_residence_'.$count.'" data-type="'.$type.'_residence" id="amc_code_'.$type.'_regular_residence_'.$count.'" name="amc_code_'.$type.'_regular_residence_'.$count.'">';
                        $data .= '<option value="" selected disabled>-- Select --</option>';

                        if($amc_code_rr == 1){
                        $data .= '<option value="1" Selected>Yes</option>';}else{
                        $data .= '<option value="1">Yes</option>';}

                        if($amc_code_rr == 2){
                        $data .= '<option value="2" Selected>No</option>';}else{
                        $data .= '<option value="2">No</option>';}

                    $data .= '</select>';
                $data .= '</td>';
                $data .= '<td data-title="Scheme Code '.$name.' Regular NRI">';
                    $data .= '<select class="form-control scheme_code_'.$type.'_regular_nri_'.$count.'" id="scheme_code_'.$type.'_regular_nri_'.$count.'" data-type="'.$type.'_nri" name="scheme_code_'.$type.'_regular_nri_'.$count.'">';
                        $data .= '<option value="" selected disabled>-- Select --</option>';
                        if($scheme_code_rn == 1){
                            $data .= '<option value="1" Selected>Yes</option>';}else{
                            $data .= '<option value="1">Yes</option>';}

                            if($scheme_code_rn == 2){
                            $data .= '<option value="2" Selected>No</option>';}else{
                            $data .= '<option value="2">No</option>';}
                    $data .= '</select>';
                $data .= '</td>';

            }
        $data .= '</tr>';
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

        //return response()->json($data);
       // dd($data);
        $validator = Validator::make($data, [
                'wef_date' => ['required'],
                'scheme_code_equity_regular_residence_total' => ['required',new CheckTotal()],
                'scheme_code_equity_regular_nri_total' => ['required',new CheckTotal()],
                'amc_code_equity_swp_residence_total' => ['required',new CheckTotal()],
                'scheme_code_equity_swp_nri_total' => ['required',new CheckTotal()],
                'scheme_code_debt_regular_residence_total' => ['required',new CheckTotal()],
                'scheme_code_debt_regular_nri_total' => ['required',new CheckTotal()],
                'amc_code_debt_swp_residence_total' => ['required',new CheckTotal()],
                'scheme_code_debt_swp_nri_total' => ['required',new CheckTotal()],
            ],
            [
                'wef_date.required' => 'Select start date',
                'scheme_code_equity_regular_residence_total.required' => 'Total must required',
                'scheme_code_equity_regular_nri_total.required' => 'Total must required',
                'amc_code_equity_swp_residence_total.required' => 'Total must required',
                'scheme_code_equity_swp_nri_total.required' => 'Total must required',
                'scheme_code_debt_regular_residence_total.required' => 'Total must required',
                'scheme_code_debt_regular_nri_total.required' => 'Total must required',
                'amc_code_debt_swp_residence_total.required' => 'Total must required',
                'scheme_code_debt_swp_nri_total.required' => 'Total must required',
            ]
        );
        if ($validator->fails()) {
            return response()->json(["errors" => $validator->getMessageBag()->toArray()], 404);
        }

        $portfolios = $this->marketService->storeNewPortfolio($data);

        return response()->json($portfolios);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $type = $request->type;
        $amc_codes = $this->marketService->getSchemeCodes($id,$type);
        return response()->json($amc_codes);
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
