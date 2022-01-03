<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Services\MarketService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ClientIntroductionController extends Controller
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
        $data = [];
        if(isset($request->family_detail) && $request->family_detail == 1)
        {
            //return response()->json($request->all());
            $name = 'name'.$request->member_count;
            $name = $request->$name;
            $splitname = explode(" ",$name);
            $firstname = $splitname[0];
            $birthdate = 'birthdate'.$request->member_count;
            $birthdate = $request->$birthdate;
            $relation = 'relation'.$request->member_count;
            $relationship = $request->$relation;
            $taxstatus = 'taxstatus'.$request->member_count;
            $taxstatus = $request->$taxstatus;
            $taxslab = 'taxslab'.$request->member_count;
            $taxslab = $request->$taxslab;
            $lifeexpectancy = 'lifeexpectancy'.$request->member_count;
            $lifeexpectancy = $request->$lifeexpectancy;
            $account['account_type'] = 1;
            $individual_taxStatus = $this->marketService->getTaxStatus($account);
            $taxslabs = $this->marketService->getTaxSlab($account);
            $relations = $this->marketService->getRelationList();

            $content .= '<input type="hidden" class="member-profileid" name="member-profileid_'.$request->member_count.'" id="member-profile_id_'.$request->member_count.'" value="0">';
            $content .= '<div class="tab-pane fade show" id="member'.$request->member_count.'" role="tabpanel" aria-labelledby="member-tab_'.$request->member_count.'">';
                $content .= '<div class="row">';
                    $content .= '<div class="col-sm-4 member-name_'.$request->member_count.'">';
                        $content .= '<div class="form-group">';
                            $content .= '<label for="member-name_'.$request->member_count.'">Name</label>';
                            $content .= '<input type="text" class="form-control member-name" data-count="'.$request->member_count.'" data-target="member'.$request->member_count.'" id="member-name_'.$request->member_count.'" name="member-name_'.$request->member_count.'" placeholder="Enter Name" value="'.$name.'">';
                        $content .= '</div>';
                    $content .= '</div>';
                    $content .= '<div class="col-sm-4 member-birthdate_'.$request->member_count.'">';
                        $content .= '<div class="form-group">';
                            $content .= '<label for="member-birthdate_'.$request->member_count.'">Date of Birth</label>';
                            $content .= '<input type="text" name="member-birthdate_'.$request->member_count.'" class="form-control" id="member-birthdate_'.$request->member_count.'" placeholder="Enter Name" value="'.$birthdate.'">';
                        $content .= '</div>';
                    $content .= '</div>';
                    $content .= '<div class="col-sm-4 member-relation_'.$request->member_count.'">';
                        $content .= '<div class="form-group">';
                            $content .= '<label for="member-relation_'.$request->member_count.'">Relation</label>';
                            $content .= '<div class="select-wrapper exclude">';
                                $content .= '<select class="form-control valid" id="member-relation_'.$request->member_count.'" name="member-relation_'.$request->member_count.'" aria-invalid="false">';
                                    $content .= '<option value="">Select Relation</option>';
                                    if($request->member_count == 1)
                                    {
                                        $content .= '<option value="primary" selected>Self</option>';
                                    }
                                    else{
                                        foreach($relations as $relation)
                                        {
                                            if($relation->name == $relationship)
                                            $content .= '<option value="'.$relation->name.'" Selected>'.$relation->name.'</option>';
                                            else
                                            $content .= '<option value="'.$relation->name.'">'.$relation->name.'</option>';
                                        }
                                    }
                                $content .= '</select>';
                            $content .= '</div>';
                        $content .= '</div>';
                    $content .= '</div>';
                    $content .= '<div class="col-sm-4 member-taxstatus_'.$request->member_count.'">';
                        $content .= '<div class="form-group">';
                            $content .= '<label for="member-taxstatus_'.$request->member_count.'">Tax Status</label>';
                            $content .= '<div class="select-wrapper exclude">';
                                $content .= '<select class="form-control tax-slab" id="member-taxstatus_'.$request->member_count.'" name="member-taxstatus_'.$request->member_count.'">';
                                    $content .= '<option value="">Select Tax Status</option>';
                                    foreach($individual_taxStatus as $status)
                                    {
                                        if($status->name == $taxstatus)
                                        $content .= '<option value="'.$status->name.'" Selected>'.$status->name.'</option>';
                                        else
                                        $content .= '<option value="'.$status->name.'">'.$status->name.'</option>';
                                    }
                                $content .= '</select>';
                            $content .= '</div>';
                        $content .= '</div>';
                    $content .= '</div>';
                    $content .= '<div class="col-sm-4 member-taxslab_'.$request->member_count.'">';
                        $content .= '<div class="form-group">';
                            $content .= '<label for="member-taxslab_'.$request->member_count.'">Tax Slab</label>';
                            $content .= '<div class="select-wrapper exclude">';
                                $content .= '<select class="form-control tax-slab" id="member-taxslab_'.$request->member_count.'" name="member-taxslab_'.$request->member_count.'">';
                                    $content .= '<option value="">Select Tax Slab</option>';
                                    foreach($taxslabs as $slab)
                                    {
                                        if($slab->code == $taxslab)
                                        $content .= '<option value="'.$slab->code.'" Selected>'.$slab->name.'</option>';
                                        else
                                        $content .= '<option value="'.$slab->code.'">'.$slab->name.'</option>';
                                    }
                                $content .= '</select>';
                            $content .= '</div>';
                        $content .= '</div>';
                    $content .= '</div>';
                    $content .= '<div class="col-sm-4 member-lifeexpectancy_'.$request->member_count.'">';
                        $content .= '<div class="form-group">';
                            $content .= '<label for="member-lifeexpectancy_'.$request->member_count.'">Life Expectancy</label>';
                            $content .= '<input type="text" class="form-control member_lifeexpectancy" id="member-lifeexpectancy_'.$request->member_count.'" name="member-lifeexpectancy_'.$request->member_count.'" placeholder="Enter Life Expectancy" value="'.$lifeexpectancy.'">';
                        $content .= '</div>';
                    $content .= '</div>';
                $content .= '</div>';
            $content .= '</div>';

            $headContent .= '<li class="nav-item mb-3" role="presentation" data-count="' . $request->member_count . '">';
                $headContent .= '<a class="nav-link member_tab"  id="member-tab_' . $request->member_count . '"';
                $headContent .= 'data-toggle="tab"  href="#member' . $request->member_count . '" role="tab"';
                $headContent .= 'aria-selected="false">' . $firstname . '</a>';
            $headContent .= '<span class="remove-member"><i class="icon-close"></i></span></li>';

            $data = [
                $content,$headContent
            ];
        }

        if(isset($request->company_detail) && $request->company_detail == 1)
        {
            $cname = 'cname'.$request->company_count;
            $cname = $request->$cname;
            $cincorpdate = 'cincorpdate'.$request->company_count;
            $cincorpdate = $request->$cincorpdate;
            $ctaxstatus = 'ctaxstatus'.$request->company_count;
            $ctaxstatus = $request->$ctaxstatus;
            $ctaxslab = 'ctaxslab'.$request->company_count;
            $ctaxslab = $request->$ctaxslab;
            $cauthname1 = 'cauthname1'.$request->company_count;
            $cauthname1 = $request->$cauthname1;
            $cauthdesignation1 = 'cauthdesignation1'.$request->company_count;
            $cauthdesignation1 = $request->$cauthdesignation1;
            $cauthname2 = 'cauthname2'.$request->company_count;
            $cauthname2 = $request->$cauthname2;
            $cauthdesignation2 = 'cauthdesignation2'.$request->company_count;
            $cauthdesignation2 = $request->$cauthdesignation2;
            $account['account_type'] = 2;
            $taxslabs = $this->marketService->getTaxSlab($account);
            $entitytypes = $this->marketService->getTaxStatus($account);

            $content .= '<input type="hidden" class="company-profileid" name="company-profileid_'.$request->company_count.'" id="company-profile_id_'.$request->company_count.'" value="0">';
            $content .= '<div class="tab-pane fade" id="company'.$request->company_count.'" role="tabpanel" aria-labelledby="company-tab_'.$request->company_count.'">';
                $content .= '<div class="row">';
                    $content .= '<div class="col-sm-4 company-cname_'.$request->company_count.'">';
                        $content .= '<div class="form-group">';
                            $content .= '<label for="company-cname_'.$request->company_count.'">Name</label>';
                            $content .= '<input type="text" class="form-control company-cname_" data-count="'.$request->company_count.'" data-target="company'.$request->company_count.'" id="company-cname_'.$request->company_count.'" name="company-cname_'.$request->company_count.'" placeholder="Enter Name" value="'.$cname.'" />';
                        $content .= '</div>';
                    $content .= '</div>';
                    $content .= '<div class="col-sm-3 company-cincorpdate_'.$request->company_count.'">';
                        $content .= '<div class="form-group">';
                            $content .= '<label for="company-cincorpdate_'.$request->company_count.'">Date of Incorporation</label>';
                            $content .= '<input type="text" name="company-cincorpdate_'.$request->company_count.'" class="form-control incorpdate" id="company-cincorpdate_'.$request->company_count.'" placeholder="Enter Name" value="'.$cincorpdate.'" />';
                        $content .= '</div>';
                    $content .= '</div>';
                    $content .= '<div class="col-sm-3 company-ctaxstatus_'.$request->company_count.'">';
                        $content .= '<div class="form-group">';
                        $content .= '<label for="company-ctaxstatus_'.$request->company_count.'">Tax Status</label>';
                            $content .= '<div class="select-wrapper">';
                            $content .= '<select class="form-control ctaxstatus" id="company-ctaxstatus_'.$request->company_count.'" name="company-ctaxstatus_'.$request->company_count.'" >';
                            $content .= '<option value="" disabled selected>Select Tax Status</option>';
                            foreach($entitytypes as $etype)
                            {
                                if($etype->name == $ctaxstatus)
                                $content .= '<option value="'.$etype->name.'" Selected>'.$etype->name.'</option>';
                                else
                                $content .= '<option value="'.$etype->name.'">'.$etype->name.'</option>';
                            }
                            $content .= '</select>';
                            $content .= '</div>';
                        $content .= '</div>';
                    $content .= '</div>';
                    $content .= '<div class="col-sm-2 company-ctaxslab_'.$request->company_count.'">';
                        $content .= '<div class="form-group">';
                        $content .= '<label for="company-ctaxslab_'.$request->company_count.'">Tax Slab</label>';
                            $content .= '<div class="select-wrapper">';
                            $content .= '<select class="form-control tax-slab" id="company-ctaxslab_'.$request->company_count.'" name="company-ctaxslab_'.$request->company_count.'">';
                            $content .= '<option value="">Select Tax Slab</option>';
                            foreach($taxslabs as $slab)
                            {
                                if($slab->code == $ctaxslab)
                                $content .= '<option value="'.$slab->code.'" Selected>'.$slab->name.'</option>';
                                else
                                $content .= '<option value="'.$slab->code.'">'.$slab->name.'</option>';
                            }
                            $content .= '</select>';
                            $content .= '</div>';
                        $content .= '</div>';
                    $content .= '</div>';
                    $content .= '<div class="col-sm-12">';
                        $content .= '<h4 class="form-section-title text-uppercase">AUTHORIZED Personel Details</h4>';
                    $content .= '</div>';
                    $content .= '<div class="col-sm-4 company-cauthname1_'.$request->company_count.'">';
                        $content .= '<div class="form-group">';
                            $content .= '<label for="company-cauthname1_'.$request->company_count.'">AUTHORIZED SIGNITORY NAME - 1</label>';
                            $content .= '<input type="text" class="form-control" id="company-cauthname1_'.$request->company_count.'" name="company-cauthname1_'.$request->company_count.'" placeholder="Enter Life Expectancy" value="'.$cauthname1.'" />';
                        $content .= '</div>';
                    $content .= '</div>';
                    $content .= '<div class="col-sm-4 company-cauthdesignation1_'.$request->company_count.'">';
                        $content .= '<div class="form-group">';
                            $content .= '<label for="company-cauthdesignation1_'.$request->company_count.'">Designation</label>';
                            $content .= '<input type="text" class="form-control" id="company-cauthdesignation1_'.$request->company_count.'" name="company-cauthdesignation1_'.$request->company_count.'" placeholder="Enter Life Expectancy" value="'.$cauthdesignation1.'" />';
                        $content .= '</div>';
                    $content .= '</div>';
                    $content .= '<div class="col-sm-12"></div>';
                    $content .= '<div class="col-sm-4 company-cauthname2_'.$request->company_count.'">';
                        $content .= '<div class="form-group">';
                            $content .= '<label for="company-cauthname2_'.$request->company_count.'">AUTHORIZED SIGNITORY NAME - 2</label>';
                            $content .= '<input type="text" class="form-control" id="company-cauthname2_'.$request->company_count.'" name="company-cauthname2_'.$request->company_count.'" placeholder="Enter Life Expectancy" value="'.$cauthname2.'" />';
                        $content .= '</div>';
                    $content .= '</div>';
                    $content .= '<div class="col-sm-4 company-cauthdesignation2_'.$request->company_count.'">';
                        $content .= '<div class="form-group">';
                            $content .= '<label for="company-cauthdesignation2_'.$request->company_count.'">Designation</label>';
                            $content .= '<input type="text" class="form-control cauthdesignation" id="company-cauthdesignation2_'.$request->company_count.'" name="company-cauthdesignation2_'.$request->company_count.'" placeholder="Enter Life Expectancy" value="'.$cauthdesignation2.'" />';
                        $content .= '</div>';
                    $content .= '</div>';
                $content .= '</div>';
            $content .= '</div>';

            $headContent .= '<li class="nav-item mb-3" role="presentation" data-count="' . $request->company_count . '">';
                $headContent .= '<a class="nav-link company_tab"  id="company-tab_' . $request->company_count . '"';
                $headContent .= 'data-toggle="tab"  href="#company' . $request->company_count . '" role="tab"';
                $headContent .= 'aria-selected="false">' . $cname . '</a>';
            $headContent .= '<span class="remove-company"><i class="icon-close"></i></span></li>';

            $data = [
                $content,$headContent
            ];

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

        if(!empty($request->accounttype))
        {
            $data['accounttype'] = json_encode($request->accounttype);
        }
        //dd($data);
        $introduction = $this->marketService->setClientDetails($data);

        return response()->json($introduction);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $active = 1;
        $account = [];
        $associates = $this->marketService->getAssoicates($active);
        //dd($associates);
        $data = [];
        $user_associate = '';
        $associate_id = '';
        $employees = '';
        if(Auth::user()->hasRole('admin'))
        {
            $user_associate = $this->marketService->getUserAssociate(Auth::user()->service_id);
            $associate_id = $user_associate->id;
        }
        if(Auth::user()->hasRole('employee'))
        {
            $employee = $this->marketService->getSingleEmployee(Auth::user()->service_id);
            $user_associate = $this->marketService->getUserAssociate($employee->associate_id);
            $associate_id = $user_associate->id;
        }
        // if($user_associate)
        // {
        //     $data['associate_id'] = $user_associate->id;
        //     $employees = $this->marketService->getAssoicateEmployees($user_associate->id);
        // }
        $client = $this->marketService->getClientDetail($id);
        //dd($client);
        if (Auth::user()->in_house == 1 || Auth::user()->hasRole('superadmin'))
        {
            $employees = $this->marketService->getAssoicateEmployees($client->lead->associate_id);
        }else{
            if($associate_id == $client->lead->associate_id)
            {
                $employees = $this->marketService->getAssoicateEmployees($associate_id);
            }else{
                return abort(500);
            }
        }
        //dd($client);
        $account['account_type'] = 1;
        $individual_taxStatus = $this->marketService->getTaxStatus($account);
        $individual_taxslabs = $this->marketService->getTaxSlab($account);
        $account['account_type'] = 2;
        $company_taxStatus = $this->marketService->getTaxStatus($account);
        $company_taxslabs = $this->marketService->getTaxSlab($account);
        $relations = $this->marketService->getRelationList();
        return view('client.introduction')
            ->with([
                'associates' => $associates,
                'user_associate' => $user_associate,
                'employees' => $employees,
                'client' => $client,
                'individual_taxStatus' => $individual_taxStatus,
                'company_taxStatus' => $company_taxStatus,
                'individual_taxslabs' => $individual_taxslabs,
                'company_taxslabs' => $company_taxslabs,
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
