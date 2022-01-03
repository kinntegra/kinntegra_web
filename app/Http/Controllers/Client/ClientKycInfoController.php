<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Services\MarketService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use SebastianBergmann\Environment\Console;

class ClientKycInfoController extends Controller
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
    public function index(Request $request)
    {
        $content = '';
        $headContent = '';
        $pid = $request->pid;
        $bank_count = $request->bank_count;

        //dd($request->all());
        // $ifsc_no = 'ifsc_no_'.$pid.'_'.$bank_count;
        // $ifsc_no = $request->$ifsc_no;

        // $bank_name = 'bank_name_'.$pid.'_'.$bank_count;
        // $bank_name = $request->$bank_name;

        // $branch_name = 'branch_name_'.$pid.'_'.$bank_count;
        // $branch_name = $request->$branch_name;

        // $micr = 'micr_'.$pid.'_'.$bank_count;
        // $micr = $request->$micr;

        // $account_type = 'account_type_'.$pid.'_'.$bank_count;
        // $account_type = $request->$account_type;

        // $account_no = 'account_no_'.$pid.'_'.$bank_count;
        // $account_no = $request->$account_no;

        // $cheque_upload = 'cheque_upload_'.$pid.'_'.$bank_count;
        // $cheque_upload = $request->$cheque_upload;
        // $cheque_upload_name = Str::of($cheque_upload)->basename();

        $accounttype = $request->account_type;
        $is_nri = $request->is_nri;
        $content .= '<input type="hidden" class="bank-bankid" name="bank-bankid_'.$pid.'_'.$bank_count.'" id="bank-bankid_'.$pid.'_'.$bank_count.'" value="0">';
        $content .= '<input type="hidden" class="bank-is_default" name="bank-is_default_'.$pid.'_'.$bank_count.'" id="bank-is_default_'.$pid.'_'.$bank_count.'" value="0">';
        $content .= '<input type="hidden" class="bank-is_active" name="bank-is_active_'.$pid.'_'.$bank_count.'" id="bank-is_active_'.$pid.'_'.$bank_count.'" value="1">';
        $content .= '<div class="tab-pane fade show active" id="addbank_'.$pid.'_'.$bank_count.'" role="tabpanel" aria-labelledby="add-bank-tab-'.$pid.'_'.$bank_count.'">';
            $content .= '<div class="addBankTab_'.$pid.'_'.$bank_count.' row">';
                $content .= '<div class="col-sm-3 bank-ifsc_no_'.$pid.'_'.$bank_count.'">';
                    $content .= '<div class="form-group">';
                        $content .= '<label>IFSC Code</label>';
                        $content .= '<div class="input-group ">';
                            $content .= '<input type="text" class="form-control ifsc_no" placeholder="Enter IFSC Code" aria-label="table-search-'.$pid.'_'.$bank_count.'" id="bank-ifsc_no_'.$pid.'_'.$bank_count.'" name="bank-ifsc_no_'.$pid.'_'.$bank_count.'" aria-describedby="table-search-'.$pid.'_'.$bank_count.'">';
                            $content .= '<div class="input-group-append">';
                                $content .= '<span class="input-group-text ifsc_search" id="table-search_'.$pid.'_'.$bank_count.'">';
                                    $content .= '<svg width="24" height="24" viewBox="0 0 24 24">';
                                    $content .= '<use xlink:href="#search" />';
                                    $content .= '</svg>';
                                $content .= '</span>';
                            $content .= '</div>';
                        $content .= '</div>';
//                        $content .= '<input type="text" class="form-control ifsc_no" placeholder="Enter IFSC Code" id="bank-ifsc_no_'.$pid.'_'.$bank_count.'" name="bank-ifsc_no_'.$pid.'_'.$bank_count.'" value="">';
                    $content .= '</div>';
                $content .= '</div>';
                $content .= '<div class="col-sm-3 bank-bank_name_'.$pid.'_'.$bank_count.'">';
                    $content .= '<div class="form-group">';
                        $content .= '<label>Bank Name</label>';
                        $content .= '<input type="text" class="form-control bank_name" placeholder="Enter Bank Name" id="bank-bank_name_'.$pid.'_'.$bank_count.'" name="bank-bank_name_'.$pid.'_'.$bank_count.'" value="">';
                    $content .= '</div>';
                $content .= '</div>';
                $content .= '<div class="col-sm-3 bank-branch_name_'.$pid.'_'.$bank_count.'">';
                    $content .= '<div class="form-group">';
                        $content .= '<label>Bank Branch</label>';
                        $content .= '<input type="text" class="form-control branch_name" placeholder="Enter Bank Branch" id="bank-branch_name_'.$pid.'_'.$bank_count.'" name="bank-branch_name_'.$pid.'_'.$bank_count.'" value="">';
                    $content .= '</div>';
                $content .= '</div>';


                $content .= '<div class="col-sm-3 bank-micr_'.$pid.'_'.$bank_count.'">';
                    $content .= '<div class="form-group">';
                        $content .= '<label>MICR</label>';
                        $content .= '<input type="text" class="form-control micr" placeholder="Enter MICR" id="bank-micr_'.$pid.'_'.$bank_count.'" name="bank-micr_'.$pid.'_'.$bank_count.'" value="">';
                    $content .= '</div>';
                $content .= '</div>';

                $content .= '<div class="col-sm-3 bank-account_type_'.$pid.'_'.$bank_count.'">';
                    $content .= '<div class="form-group">';
                        $content .= '<label>Account type</label>';
                        $content .= '<select class="form-control account_type" id="bank-account_type_'.$pid.'_'.$bank_count.'" name="bank-account_type_'.$pid.'_'.$bank_count.'">';
                            $content .= '<option value="" disabled selected>Select Account type</option>';
                            if($is_nri == 1)
                            {
                                $content .= '<option value="Non-resident ordinary">Non-resident ordinary</option>';
                                $content .= '<option value="Non-resident external">Non-resident external</option>';

                            }else{
                                $content .= '<option value="Saving">Saving</option>';
                                $content .= '<option value="Current">Current</option>';
                            }
                        $content .= '</select>';
                    $content .= '</div>';
                $content .= '</div>';

                $content .= '<div class="col-sm-3 bank-account_no_'.$pid.'_'.$bank_count.'">';
                    $content .= '<div class="form-group">';
                        $content .= '<label>Account Number</label>';
                        $content .= '<input type="text" class="form-control account_no" placeholder="Enter Account Number" id="bank-account_no_'.$pid.'_'.$bank_count.'" name="bank-account_no_'.$pid.'_'.$bank_count.'" value="">';
                    $content .= '</div>';
                $content .= '</div>';
                $content .= '<div class="col-sm-3 bank-cheque_upload_'.$pid.'_'.$bank_count.'">';
                    $content .= '<div class="form-group">';
                        $content .= '<label for="bank-cheque_upload_'.$pid.'_'.$bank_count.'">Proof<span class="required-sign">*</span></label>';
                        $content .= '<label for="bank-cheque_upload_'.$pid.'_'.$bank_count.'" class="btn input-btn w-100">';

                            $content .= '<svg width="24" height="24" viewBox="0 0 24 24">';
                                $content .= '<use xlink:href="#upload" />';
                            $content .= '</svg>';
                            $content .= '<input id="bank-cheque_upload_'.$pid.'_'.$bank_count.'" name="bank-cheque_upload_'.$pid.'_'.$bank_count.'" class="cheque_upload" type="file" />';
                            $content .= '<div class="value-wrap">';
                                $content .= '<span class="default-text">Upload</span>';
                                $content .= '<span class="value"></span>';
                            $content .= '</div>';
                        $content .= '</label>';
                    $content .= '</div>';
                $content .= '</div>';
                $content .= '<div class="col-sm-3">';
                    $content .= '<label></label>';
                    $content .= '<div class="form-group mt-2px">';
                        $content .= '<button type="button" id="bank_created_'.$pid.'_'.$bank_count.'" class="add-bank-button btn btn-primary btn-width-sm w-75 mr-2" data-pid="'. $pid .'" data-bank_count="' . $bank_count . '">Add</button>';
                        $content .= '<button type="button" id="bank_clear_'.$pid.'_'.$bank_count.'" class="btn btn-danger btn-width-sm w-20 bank_clear" data-pid="'. $pid .'" data-bank_count="' . $bank_count . '">X</button>';
                    $content .= '</div>';
                $content .= '</div>';
            $content .= '</div>';
        $content .= '</div>';

        $headContent .= '<li class="nav-item add-bank-item mb-4" id="bank-item_'.$pid.'_'.$bank_count.'" role="presentation" data-count="' . $bank_count . '">';
            $headContent .= '<a class="nav-link add-bank active" id="add-bank-tab-'.$pid.'_'.$bank_count.'" data-pid="'. $pid .'" data-bank_count="' . $bank_count . '"';
                $headContent .= 'data-toggle="tab" href="#addbank_'.$pid.'_'.$bank_count.'" role="tab"';
                $headContent .= 'aria-selected="true">Add Bank</a>';
        $headContent .= '</li>';//<span class="remove-bank"><i class="icon-close"></i></span>
        $data = [
            $content,$headContent
        ];
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
        //dd($request->all());
        $active_step = 3;
        $pid = $request->current_pid;
        $num = $request->current_step_id;
        $fixed = 3;
        $val = fmod($num, $fixed);//dd($pid,$num);
        $val = (int) $val;//dd($val);
        //dd($val);$data['is_kyc_information'] = 1;
        $data = $request->only('id','client_edit','step_edit','current_pid','current_step_id','is_kyc_information');
        $data['active_step'] = $active_step;
        //$data['']
        if($val > 0)
        {
            $active_step = $val;
        }
        //dd($active_step);
        if($active_step == 1)
        {
            $account_type = 'account_type_'.$pid;
            $has_guardian = 'has_guardian_'.$pid;
            $account_type = $request->$account_type;

            $client_guardian_id = 'client_guardian_id_'.$pid;
            if(!empty($request->$client_guardian_id))
            {
                $data['client_guardian_id'] = $request->$client_guardian_id;

                $pan_upload_path = 'pan_upload_path_'.$pid;
                if(!empty($request->$pan_upload_path))
                {
                    $data['pan_upload'] = fopen($request->$pan_upload_path, 'r');
                }
                $kyc_upload_path = 'kyc_upload_path_'.$pid;
                if(!empty($request->$kyc_upload_path))
                {
                    $data['kyc_upload'] = fopen($request->$kyc_upload_path, 'r');
                }
            }

            $birth_upload = 'birth_upload_'.$pid;
            if($request->hasFile($birth_upload))
            {
                $data['birth_upload'] = fopen($request->$birth_upload->path(), 'r');
            }

            $pan = 'pan_'.$pid;
            if(!empty($request->$pan))
            {
                $data['pan'] = $request->$pan;
            }
            $kyc_status = 'kyc_status_'.$pid;
            if(!empty($request->$kyc_status))
            {
                $data['kyc_status'] = $request->$kyc_status;
            }

            $pan_upload = 'pan_upload_'.$pid;
            if($request->hasFile($pan_upload))
            {
                $data['pan_upload'] = fopen($request->$pan_upload->path(), 'r');
            }

            $kyc_upload = 'kyc_upload_'.$pid;
            if($request->hasFile($kyc_upload))
            {
                $data['kyc_upload'] = fopen($request->$kyc_upload->path(), 'r');
            }

            $ckyc_no = 'ckyc_no_'.$pid;
            if(!empty($request->$ckyc_no))
            {
                $data['ckyc_no'] = $request->$ckyc_no;
            }

            $gender = 'gender_'.$pid;
            if(!empty($request->$gender))
            {
                $data['gender'] = $request->$gender;
            }

            $aadhar = 'aadhar_'.$pid;
            if(!empty($request->$aadhar))
            {
                $data['aadhar'] = $request->$aadhar;
            }

            $country_code = 'country_code_'.$pid;
            if(!empty($request->$country_code))
            {
                $data['country_code'] = $request->$country_code;
            }else{
                $data['country_code'] = 91;
            }

            $mobile = 'mobile_'.$pid;
            if(!empty($request->$mobile))
            {
                $data['mobile'] = $request->$mobile;
            }

            $email = 'email_'.$pid;
            if(!empty($request->$email))
            {
                $data['email'] = $request->$email;
            }

            $birth_incorp_place = 'birth_incorp_place_'.$pid;
            if(!empty($request->$birth_incorp_place))
            {
                $data['birth_incorp_place'] = $request->$birth_incorp_place;
            }

            $birth_incorp_country = 'birth_incorp_country_'.$pid;
            if(!empty($request->$birth_incorp_country))
            {
                $data['birth_incorp_country'] = $request->$birth_incorp_country;
            }

            $tax_status = 'tax_status_'.$pid;
            if(!empty($request->$tax_status))
            {
                $data['tax_status'] = $request->$tax_status;
            }

            $occupation = 'occupation_'.$pid;
            if(!empty($request->$occupation))
            {
                $data['occupation'] = $request->$occupation;
            }

            $employer_name = 'employer_name_'.$pid;
            if(!empty($request->$employer_name))
            {
                $data['employer_name'] = $request->$employer_name;
            }

            $gross_annual_income = 'gross_annual_income_'.$pid;
            if(!empty($request->$gross_annual_income))
            {
                $data['gross_annual_income'] = $request->$gross_annual_income;
            }

            $net_worth = 'net_worth_'.$pid;
            if(!empty($request->$net_worth))
            {
                $data['net_worth'] = (float) str_replace(',', '', $request->$net_worth);;
            }

            $net_worth_date = 'net_worth_date_'.$pid;
            if(!empty($request->$net_worth_date))
            {
                $data['net_worth_date'] = $request->$net_worth_date;
            }

            $business_nature = 'business_nature_'.$pid;
            if(!empty($request->$business_nature))
            {
                $data['business_nature'] = $request->$business_nature;
            }

            $wealth_source = 'wealth_source_'.$pid;
            if(!empty($request->$wealth_source))
            {
                $data['wealth_source'] = $request->$wealth_source;
            }

            $ubo_count = 'ubo_count_'.$pid;
            if(!empty($request->$ubo_count))
            {
                $data['ubo_count'] = $request->$ubo_count;
            }

            $ubo_name = 'ubo_name_'.$pid;
            if(!empty($request->$ubo_name))
            {
                $data['ubo_name'] = json_encode($request->$ubo_name);
            }

            $data['politically_exposed'] = 'No';

            $data['is_profile'] = 1;

        }
        //dd($data);
        if($active_step ==2)
        {
            $client_guardian_id = 'client_guardian_id_'.$pid;
            $is_guardian_address = 'is_guardian_address_'.$pid;

            if(isset($request->$is_guardian_address) && $request->$is_guardian_address == 1)
            {
                $data['is_guardian_address'] = $request->$is_guardian_address;

                $address_upload_path = 'address_upload_path_'.$pid;
                if(!empty($request->$address_upload_path))
                {
                    $data['address_upload'] = fopen($request->$address_upload_path, 'r');
                }

                $foreign_address_upload_path = 'foreign_address_upload_path_'.$pid;
                if(!empty($request->$foreign_address_upload_path))
                {
                    $data['foreign_address_upload'] = fopen($request->$foreign_address_upload_path, 'r');
                }
            }

            $addresstype_id = 'address_type_'.$pid;
            if(!empty($request->$addresstype_id))
            {
                $data['addresstype_id'] = $request->$addresstype_id;
            }

            $address1 = 'address1_'.$pid;
            if(!empty($request->$address1))
            {
                $data['address1'] = $request->$address1;
            }

            $address2 = 'address2_'.$pid;
            if(!empty($request->$address2))
            {
                $data['address2'] = $request->$address2;
            }

            $address3 = 'address3_'.$pid;
            if(!empty($request->$address3))
            {
                $data['address3'] = $request->$address3;
            }

            $address_upload = 'address_upload_'.$pid;
            if($request->hasFile($address_upload))
            {
                $data['address_upload'] = fopen($request->$address_upload->path(), 'r');
            }

            $city = 'city_'.$pid;
            if(!empty($request->$city))
            {
                $data['city'] = $request->$city;
            }

            $state = 'state_'.$pid;
            if(!empty($request->$state))
            {
                $data['state'] = $request->$state;
            }

            $country = 'country_'.$pid;
            if(!empty($request->$country))
            {
                $data['country'] = $request->$country;
            }

            $pincode = 'pincode_'.$pid;
            if(!empty($request->$pincode))
            {
                $data['pincode'] = $request->$pincode;
            }
            $is_address_same_all = 'is_address_same_all_'.$pid;

            if(!empty($request->$is_address_same_all))
            {
                $data['is_address_same_all'] = $request->$is_address_same_all;
            }

            $foreign_addresstype_id = 'foreign_address_type_'.$pid;
            if(!empty($request->$foreign_addresstype_id))
            {
                $data['foreign_addresstype_id'] = $request->$foreign_addresstype_id;
            }

            $foreign_address1 = 'foreign_address1_'.$pid;
            if(!empty($request->$foreign_address1))
            {
                $data['foreign_address1'] = $request->$foreign_address1;
            }

            $foreign_address2 = 'foreign_address2_'.$pid;
            if(!empty($request->$foreign_address2))
            {
                $data['foreign_address2'] = $request->$foreign_address2;
            }

            $foreign_address3 = 'foreign_address3_'.$pid;
            if(!empty($request->$foreign_address3))
            {
                $data['foreign_address3'] = $request->$foreign_address3;
            }

            $foreign_address_upload = 'foreign_address_upload_'.$pid;
            if($request->hasFile($foreign_address_upload))
            {
                $data['foreign_address_upload'] = fopen($request->$foreign_address_upload->path(), 'r');
            }

            $foreign_city = 'foreign_city_'.$pid;
            if(!empty($request->$foreign_city))
            {
                $data['foreign_city'] = $request->$foreign_city;
            }

            $foreign_state = 'foreign_state_'.$pid;
            if(!empty($request->$foreign_state))
            {
                $data['foreign_state'] = $request->$foreign_state;
            }

            $foreign_country = 'foreign_country_'.$pid;
            if(!empty($request->$foreign_country))
            {
                $data['foreign_country'] = $request->$foreign_country;
            }

            $foreign_pincode = 'foreign_pincode_'.$pid;
            if(!empty($request->$foreign_pincode))
            {
                $data['foreign_pincode'] = $request->$foreign_pincode;
            }
            $is_address_same_all = 'is_address_same_all_'.$pid;

            $data['is_communication'] = 1;
        }
        if($active_step == 3)
        {
            $bank_count = 'bank_count_'.$pid;
            $data[$bank_count] = $request->$bank_count;
            $bank = 'bank-';
            foreach ($request->all() as $key => $value) {
                $pattern1 = "/^".$bank.".*\_".$pid."_1$/";
                $pattern2 = "/^".$bank.".*\_".$pid."_2$/";
                $pattern3 = "/^".$bank.".*\_".$pid."_3$/";
                $pattern4 = "/^".$bank.".*\_".$pid."_4$/";
                $pattern5 = "/^".$bank.".*\_".$pid."_5$/";
                if(preg_match($pattern1, $key) || preg_match($pattern2, $key) || preg_match($pattern3, $key) || preg_match($pattern4, $key) || preg_match($pattern5, $key))
                {
                    if(Str::contains($key, 'cheque_upload'))
                    {
                        $keyval = "-cheque_upload_".$pid."_";
                        $keyval = str_replace($keyval,"",$key).'_upload';
                        $data[$keyval] = fopen($request->$key->path(), 'r');
                    }else{
                        $data[$key] = $value;
                    }
                }
            }
        }
        //dd($data);
        $kycinformation = $this->marketService->setClientDetails($data);//$this->marketService->setClientKycInformation($request->id,$data);
        //dd($kycinformation);
        return response()->json($kycinformation);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Get Client
        $client = $this->marketService->getClientDetail($id);//getKycProfileNames($id);
        //dd($client);
        //Get Client Profiles
        $profiles = $client->account_profiles;
        //dd($profiles);
        //Get Client Guardian
        $guardians = $this->marketService->getClientGuardians($id);
        //Get Occupation
        $occupations = $this->marketService->getOccupations();
        //Get KYC Status
        $kycstatus = $this->marketService->getKycStatus();
        //Get Gross Income
        $grossincomes = $this->marketService->GetGrossAnnualIncome();
        //Get Wealth Source
        $wealthsources = $this->marketService->getWealthSource();
        $account['account_type'] = 1;
        $individual_taxStatus = $this->marketService->getTaxStatus($account);
        //$individual_taxslabs = $this->marketService->getTaxSlab($account);
        $account['account_type'] = 2;
        $company_taxStatus = $this->marketService->getTaxStatus($account);
        //$company_taxslabs = $this->marketService->getTaxSlab($account);
        //Address Type
        $addresstypes = $this->marketService->getAddressType();
        //Get Countires List
        $countries = $this->marketService->getCountryList();
        //Logic
        $details = 0;
        //dd($profiles);
        return view('client.kycinfo', [
            'client_id' => $id,
            'client' => $client,
            'profiles' => $profiles,
            'guardians' => $guardians,
            'occupations' => $occupations,
            'kycstatus' => $kycstatus,
            'grossincomes' => $grossincomes,
            'wealthsources' => $wealthsources,
            'individual_taxStatus' => $individual_taxStatus,
            'company_taxStatus' => $company_taxStatus,
            'addresstypes' => $addresstypes,
            'countries' =>$countries,
            'details' => $details,
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
