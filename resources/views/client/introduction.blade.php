@extends('layouts.master')

@section('style')

<style>
    .edit-now {
        font-size: 12px;
        font-weight: 600;
        font-style: italic;
    }
    .edit-now:hover {
        cursor: pointer;
        color: #1a2b2a;
        text-decoration: underline;
    }
/**/
/*Select2 ReadOnly Start*/
        select[readonly].select2-hidden-accessible+.select2-container {
            pointer-events: none;
            touch-action: none;
        }

        select[readonly].select2-hidden-accessible+.select2-container .select2-selection {
            background: #e9ecef;
            box-shadow: none;
        }

        select[readonly].select2-hidden-accessible+.select2-container .select2-selection__arrow,
        select[readonly].select2-hidden-accessible+.select2-container .select2-selection__clear {
            display: none;
        }

        .select2-container--default .select2-results__option[aria-disabled=true] {
            display: none;
        }
        .members-tab .nav-item .nav-link.added-member{
            padding-right: 1rem;
        }
        .companys-tab .nav-item .nav-link.added-company{
            padding-right: 1rem;
        }
        .readonly {
            pointer-events: none;
        }

    /* #company_detail .remove-company .icon-close{
        color: #ffffff;
    } */
</style>

@endsection


@section('content')
<div class="container-fluid">
    <div class="table-top-section d-flex justify-content-between align-items-center mb-4">
        <a class="back-btn" href="{{ url()->previous() }}">
            <i class="icon-left-arrow"></i>
            Go Back
        </a>
        <div class="section-header ">

            @include('partials.top')

        </div>
    </div>
    <div class="card w-100">
        <div class="card-body p-0">
            <div class="row">
                @php
                $is_verify = 0;
                $url = Request::fullurl();
                $url_components = parse_url($url);
                if(isset($url_components['query']))
                {
                    parse_str($url_components['query'], $params);
                    $is_verify = $params['is_verify'];
                }

                @endphp
                <div class="col-xl-3 col-lg-4 col-md-4">
                    <div class="custom-wrapper">
                        @include('client.leftbar', ['is_verify' => $is_verify])
                    </div>
                </div>

                <form class="col-lg-8 col-xl-9 step-forms col-md-8 pl-0" id="client_introduction" method="POST" action="{{ route('introduction.store') }}">
                    @csrf
                    <input type="hidden" name="id" id="client_id" value="{{ $client->id }}">
                    <input type="hidden" name="client_edit" id="client_edit" value="0">
                    <input type="hidden" name="step_edit" id="step_edit" value="0">
                    <input type="hidden" name="employee_code" id="employee_code" value="{{ isset($client->lead->employee_id) && !empty($client->lead->employee_id) ? $client->lead->employee_id : null}}">
                    <input type="hidden" name="has_employee" value="{{ isset($employees) && !empty($employees) ? 1 : 0}}">
                    <input type="hidden" name="user_associate" value="{{ isset($user_associate) && !empty($user_associate) ? 1 : 0}}">
                    <input type="hidden" name="individual_lead_count" id="individual_lead_count" value="{{ $client->individual_member_count }}">
                    <input type="hidden" name="company_lead_count" id="company_lead_count" value="{{ $client->company_member_count }}">
                    <input type="hidden" name="is_introduction" id="is_introduction" value="1">
                    <input type="hidden" name="is_verify" id="is_verify" value="{{ $is_verify }}">
                    <section id="introduction" autocomplete="off" class="trial active">
                        <div class="form-inner-section">
                            <div class="form-header">
                                <h3 class="card-title d-inline">Introduction</h3>
                                @if ($client->is_introduction == 1)
                                    <span class="edit-now float-right mt-1">Edit</span>
                                @endif
                            </div>
                            <div class="form-content">
                                <div class="row">
                                    @if(Auth::user()->in_house == 1)
                                    <div class="col-sm-4 associate_id">
                                        <div class="form-group">
                                            <label for="associate_id">Associate <span class="required-sign">*</span></label>
                                            <div class="select-wrapper exclude">
                                                <select class="form-control" id="associate_id" name="associate_id" readonly>
                                                    <option value="" @if(!isset($client->lead->associate_id)) {{'disabled selected'}} @endif>Select Associate</option>
                                                    @foreach ($associates as $associate)
                                                        <option value="{{$associate->id}}" @if(isset($client->lead->associate_id) && $client->lead->associate_id == $associate->id){{ 'selected' }} @endif>{{ $associate->entity_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    @else
                                    <input type="hidden" name="associate_id" id="associate_id" value="{{ $user_associate->id }}">
                                    @endif
                                    @if(isset($employees) && !empty($employees))
                                    <div class="col-sm-4 employee_id">
                                        <div class="form-group">
                                            <label for="employee_id">Employee <span class="required-sign">*</span></label>
                                            <div class="select-wrapper exclude">
                                                <select class="form-control" id="employee_id" name="employee_id" @if(isset($client->lead->employee_id) && $client->lead->employee_id != ''){{ 'readonly' }} @endif>
                                                    <option value="" @if(!isset($client->lead->employee_id)) {{'disabled selected'}} @endif>Select Employee</option>
                                                    @foreach ($employees as $employee)
                                                        <option value="{{$employee->id}}" @if(isset($client->lead->employee_id) && $client->lead->employee_id == $employee->id){{ 'selected' }} @endif>{{ $employee->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    <div class="col-sm-12 inline-form" id="accounttype">
                                        <div class="form-group" style="margin-bottom: 5px;">
                                            <label for="accounttype" style="margin-bottom: 13px;">Account Type</label>
                                            <div class="d-flex ">
                                                <div class="form-group custom-checkbox mb-0">
                                                    <input type="checkbox" id="individual" name="accounttype[]" value="individual" checked="true" readonly="true">
                                                    <label for="individual">Individual</label>
                                                </div>
                                                <div class="form-group custom-checkbox mb-0">
                                                    <input type="checkbox" id="nonindividual" name="accounttype[]" value="nonindividual" @if(isset($client->is_nonindividual) && $client->is_nonindividual == 1) {{ 'checked' }} @endif @if($client->is_introduction == 1) {{ 'readonly' }} @endif>
                                                    <label for="nonindividual">Non Individual</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @php
                                    $Individual = 0;
                                    if(isset($client->individual_member_count) && $client->individual_member_count != 0)
                                    {
                                        $Individual = 1;
                                    }
                                    //$individual_count = count($client->individual_profile_manage);
                                    //dd($client->individual_profile_manage);
                                    @endphp

                                    <div class="col-12" id="family_detail" @if($Individual == 1) {{'style=display:block;'}} @else {{'style=display:none;'}} @endif>
                                        <hr>
                                        <div class="form-sections mb-0">

                                            <h4 class="form-section-title text-uppercase">FAMILY Details - {{ $client->name }}</h4>
                                            <ul class="nav nav-tabs members-tab no-wrap" id="lead-generation"
                                                role="tablist">
                                                @if(isset($client->individual_profile_manage) && !empty($client->individual_profile_manage))
                                                @foreach ($client->individual_profile_manage as $profile)
                                                <li class="nav-item mb-3" role="presentation" data-count="{{$profile->member_count}}">
                                                    <a class="nav-link member_tab @if($profile->member_count == 1) {{ 'active' }}@endif added-member" id="member-tab_{{$profile->member_count}}" data-toggle="tab" href="#member{{$profile->member_count}}" role="tab" aria-selected="false">{{$profile->first_name}}</a>
                                                    {{-- <span class="remove-member"><i class="icon-close"></i></span> --}}
                                                </li>
                                                @endforeach
                                                @endif
                                                @if($is_verify != 1)
                                                <li class="nav-item add-member-item mb-4 @if($client->is_introduction == 1) {{ 'readonly' }} @endif" role="presentation">
                                                    <a class="nav-link add-member @if(isset($client->individual_profile_manage) && empty($client->individual_profile_manage)) {{ 'active' }}@endif" id="add-tab"
                                                        data-toggle="tab" href="#add" role="tab"
                                                        aria-selected="true">Add Member</a>
                                                </li>
                                                @endif
                                            </ul>
                                            <div class="tab-content" id="family-tab">
                                                @if(isset($client->individual_profile_manage) && !empty($client->individual_profile_manage))
                                                @foreach ($client->individual_profile_manage as $profile)
                                                <input type="hidden" class="member-profileid" name="member-profileid_{{$profile->member_count}}" id="member-profile_id_{{$profile->member_count}}" value="{{ $profile->id }}">
                                                <div class="tab-pane @if($profile->member_count == 1) {{ 'active' }}@endif fade show" id="member{{$profile->member_count}}" role="tabpanel" aria-labelledby="member-tab_{{$profile->member_count}}">
                                                    <div class="row">
                                                        <div class="col-sm-4 member-name_{{$profile->member_count}}">
                                                            <div class="form-group">
                                                                <label for="member-name_{{$profile->member_count}}">Name</label>
                                                                <input type="text" class="form-control member-name" data-count="{{$profile->member_count}}" data-target="member{{$profile->member_count}}" id="member-name_{{$profile->member_count}}" name="member-name_{{$profile->member_count}}" placeholder="Enter Name" value="{{ $profile->name }}"  @if($client->is_introduction == 1) {{ 'readonly' }} @endif>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4 member-birthdate_{{$profile->member_count}}">
                                                            <div class="form-group">
                                                                <label for="member-birthdate_{{$profile->member_count}}">Date of Birth</label>
                                                                <input type="text" name="member-birthdate_{{$profile->member_count}}" class="form-control birth_date" id="member-birthdate_{{$profile->member_count}}" placeholder="Enter DOB" value="{{ $profile->date_of_birth_incorp }}" @if($client->is_introduction == 1) {{ 'readonly' }} @endif>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4 member-relation_{{$profile->member_count}}">
                                                            <div class="form-group">
                                                                <label for="member-relation_{{$profile->member_count}}">Relation</label>
                                                                <div class="select-wrapper exclude">
                                                                    <select class="form-control valid" id="member-relation_{{$profile->member_count}}" name="member-relation_{{$profile->member_count}}" aria-invalid="false" @if($profile->member_count == 1) {{'readonly'}}@endif @if($client->is_introduction == 1) {{ 'readonly' }} @endif>
                                                                        <option value="" @if(isset($profile->relation) && empty($profile->relation)){{'disabled selected'}}@endif>Select Relation</option>
                                                                        @if($profile->member_count == 1)
                                                                        <option value="primary" selected>Self</option>
                                                                        @else
                                                                        @foreach ($relations as $relation)
                                                                        <option value="{{ $relation->name }}" @if($profile->relation == $relation->name) {{ 'selected' }} @endif>{{ $relation->name }}</option>
                                                                        @endforeach
                                                                        @endif
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4 member-taxstatus_{{$profile->member_count}}">
                                                            <div class="form-group">
                                                                <label for="member-taxstatus_{{$profile->member_count}}">Tax Status</label>
                                                                <div class="select-wrapper exclude">
                                                                    <select class="form-control" id="member-taxstatus_{{$profile->member_count}}" name="member-taxstatus_{{$profile->member_count}}" @if($client->is_introduction == 1) {{ 'readonly' }} @endif>
                                                                        <option value="" @if(isset($profile->tax_status) && empty($profile->tax_status)){{'disabled selected'}}@endif>Select Tax Status</option>
                                                                        @foreach ($individual_taxStatus as $status)
                                                                            <option value="{{ $status->name }}" @if($profile->tax_status == $status->name) {{ 'selected' }} @endif>{{ $status->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4 member-taxslab_{{$profile->member_count}}">
                                                            <div class="form-group">
                                                                <label for="member-taxslab_{{$profile->member_count}}">Tax Slab</label>
                                                                <div class="select-wrapper exclude">
                                                                    <select class="form-control tax-slab" id="member-taxslab_{{$profile->member_count}}" name="member-taxslab_{{$profile->member_count}}" @if($client->is_introduction == 1) {{ 'readonly' }} @endif>
                                                                        <option value="" @if(isset($profile->tax_slab) && empty($profile->tax_slab)){{'disabled selected'}}@endif>Select</option>
                                                                        @foreach ($individual_taxslabs as $slab)
                                                                        <option value="{{ $slab->code }}" @if($profile->tax_slab == $slab->code) {{ 'selected' }} @endif>{{ $slab->name }}</option>
                                                                        @endforeach


                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4 member-lifeexpectancy_{{$profile->member_count}}">
                                                            <div class="form-group">
                                                                <label for="member-lifeexpectancy_{{$profile->member_count}}">Life Expectancy</label>
                                                                <input type="text" class="form-control member_lifeexpectancy" id="member-lifeexpectancy_{{$profile->member_count}}" name="member-lifeexpectancy_{{$profile->member_count}}" placeholder="Enter Life Expectancy" value="{{ $profile->life_expectancy }}" @if($client->is_introduction == 1) {{ 'readonly' }} @endif>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                                @endif
                                                <div class="tab-pane fade show @if(isset($client->individual_profile_manage) && empty($client->individual_profile_manage)) {{ 'active' }}@endif" id="add" role="tabpanel"
                                                    aria-labelledby="add-tab">
                                                    <div class="addTab row">
                                                        <div class="col-sm-4 name">
                                                            <div class="form-group">
                                                                <label for="name">Name</label>
                                                                <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name" />
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4 birthdate">
                                                            <div class="form-group">
                                                                <label for="birthdate">Date of Birth</label>
                                                                <input type="text" class="form-control birth_date"
                                                                    id="birthdate" name="birthdate" placeholder="Enter Name" />
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4 relation">
                                                            <div class="form-group">
                                                                <label for="relation">Relation</label>
                                                                <div class="select-wrapper exclude">
                                                                    <select class="form-control" id="relation" name="relation">
                                                                        <option value="" selected>Select Relation</option>
                                                                        @foreach ($relations as $relationship)
                                                                        <option value="{{ $relationship->name }}">{{ $relationship->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4 taxstatus">
                                                            <div class="form-group">
                                                                <label for="tax-status">Tax Status</label>
                                                                <div class="select-wrapper exclude">
                                                                    <select class="form-control" id="taxstatus" name="taxstatus">
                                                                        <option value="" selected>Select Tax status</option>
                                                                        @foreach ($individual_taxStatus as $status)
                                                                            <option value="{{ $status->name }}">{{ $status->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4 taxslab">
                                                            <div class="form-group">
                                                                <label for="tax-slab">Tax Slab</label>
                                                                <div class="select-wrapper exclude">
                                                                    <select class="form-control tax-slab" id="taxslab" name="taxslab">
                                                                        <option value="" selected>Select</option>
                                                                        @foreach ($individual_taxslabs as $slab)
                                                                            <option value="{{ $slab->code }}">{{ $slab->name }}</option>
                                                                        @endforeach

                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4 lifeexpectancy">
                                                            <div class="form-group">
                                                                <label for="expectancy">Life Expectancy</label>
                                                                <input type="text" class="form-control"
                                                                    id="lifeexpectancy" name="lifeexpectancy"
                                                                    placeholder="Enter Life Expectancy" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    @php
                                    $nonIndividual = 0;
                                    if(isset($client->company_member_count) && $client->company_member_count != 0)
                                    {
                                        $nonIndividual = 1;
                                    }
                                    @endphp
                                    <div  id="company_detail" class="col-12" @if($nonIndividual == 1) {{'style=display:block;'}} @else {{'style=display:none;'}} @endif>
                                        <hr>
                                        <div class="form-sections mb-0">
                                            <h4 class="form-section-title text-uppercase">Company Details</h4>
                                            <ul class="nav nav-tabs companys-tab no-wrap" id="add_company"
                                                role="tablist">
                                                @if(isset($client->company_profile_manage) && !empty($client->company_profile_manage))
                                                @foreach ($client->company_profile_manage as $profile)
                                                <li class="nav-item mb-3" role="presentation" data-count="{{$profile->member_count}}">
                                                    <a class="nav-link company_tab added-company @if($profile->member_count == 1) {{ 'active' }}@endif" id="company-tab_{{$profile->member_count}}" data-toggle="tab" href="#company{{$profile->member_count}}" role="tab" aria-selected="false">{{$profile->name}}</a>
                                                    {{-- <span class="remove-company"><i class="icon-close"></i></span> --}}
                                                </li>
                                                @endforeach
                                                @endif
                                                <li class="nav-item add-company-item mb-3 @if($client->is_introduction == 1) {{ 'readonly' }} @endif" role="presentation">
                                                    <a class="nav-link add-company @if(isset($client->company_profile_manage) && empty($client->company_profile_manage)) {{ 'active' }}@endif" id="addcompany-tab"
                                                        data-toggle="tab" href="#addcompany" role="tab"
                                                        aria-selected="true">Add Company</a>
                                                </li>
                                            </ul>
                                            <div class="tab-content" id="company-tab">
                                                @if(isset($client->company_profile_manage) && !empty($client->company_profile_manage))
                                                @foreach ($client->company_profile_manage as $profile)
                                                <input type="hidden" class="company-profileid" name="company-profileid_{{$profile->member_count}}" id="company-profile_id_{{$profile->member_count}}" value="{{ $profile->id }}">
                                                <div class="tab-pane @if($profile->member_count == 1) {{ 'active' }}@endif fade show" id="company{{$profile->member_count}}" role="tabpanel" aria-labelledby="company-tab_{{$profile->member_count}}">
                                                    <div class="row">
                                                        <div class="col-sm-4 company-cname_{{$profile->member_count}}">
                                                            <div class="form-group">
                                                                <label for="company-cname_{{$profile->member_count}}">Name of Establishment</label>
                                                                <input type="text" class="form-control company-cname" data-count="{{$profile->member_count}}" data-target="company{{$profile->member_count}}" id="company-cname_{{$profile->member_count}}" name="company-cname_{{$profile->member_count}}" placeholder="Enter Name" value="{{ $profile->cname }}" @if($client->is_introduction == 1) {{ 'readonly' }} @endif/>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3 company-cincorpdate_{{$profile->member_count}}">
                                                            <div class="form-group">
                                                                <label for="company-cincorpdate_{{$profile->member_count}}">Date of Incorporation</label>
                                                                <input type="text" name="company-cincorpdate_{{$profile->member_count}}" class="form-control incorpdate" id="company-cincorpdate_{{$profile->member_count}}" placeholder="Enter Name" value="{{ $profile->cincorpdate }}" @if($client->is_introduction == 1) {{ 'readonly' }} @endif/>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3 company-ctaxstatus_{{$profile->member_count}}">
                                                            <div class="form-group">
                                                            <label for="company-ctaxstatus_{{$profile->member_count}}">Tax Status</label>
                                                                <div class="select-wrapper">
                                                                <select class="form-control ctaxstatus" id="company-ctaxstatus_{{$profile->member_count}}" name="company-ctaxstatus_{{$profile->member_count}}" @if($client->is_introduction == 1) {{ 'readonly' }} @endif>
                                                                    <option value="" @if(isset($profile->ctaxstatus) && empty($profile->ctaxstatus)){{'disabled selected'}}@endif>Select Tax Status</option>
                                                                    @foreach ($company_taxStatus as $type)
                                                                        <option value="{{ $type->name }}" @if($profile->ctaxstatus == $type->name) {{ 'selected' }} @endif>{{ $type->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2 company-ctaxslab_{{$profile->member_count}}">
                                                            <div class="form-group">
                                                            <label for="company-ctaxslab_{{$profile->member_count}}">Company Tax Slab</label>
                                                                <div class="select-wrapper">
                                                                <select class="form-control tax-slab" id="company-ctaxslab_{{$profile->member_count}}" name="company-ctaxslab_{{$profile->member_count}}" @if($client->is_introduction == 1) {{ 'readonly' }} @endif>
                                                                    <option value="" @if(isset($profile->ctaxslab) && empty($profile->ctaxslab)){{'disabled selected'}}@endif>Select</option>
                                                                    @foreach ($company_taxslabs as $slab)
                                                                    <option value="{{ $slab->code }}" @if($profile->ctaxslab == $slab->code) {{ 'selected' }} @endif>{{ $slab->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <h4 class="form-section-title text-uppercase">AUTHORIZED Personel Details</h4>
                                                        </div>
                                                        <div class="col-sm-4 company-cauthname1_{{$profile->member_count}}">
                                                            <div class="form-group">
                                                                <label for="company-cauthname1_{{$profile->member_count}}">AUTHORIZED SIGNITORY NAME - 1</label>
                                                                <div class="select-wrapper exclude">
                                                                    <select class="form-control" id="company-cauthname1_{{$profile->member_count}}" name="company-cauthname1_{{$profile->member_count}}" @if($client->is_introduction == 1) {{ 'readonly' }} @endif>
                                                                        <option value="" disabled selected>Select Name</option>
                                                                        @if($client->individual_member_count > 0)
                                                                            @foreach ($client->individual_profile_manage as $ind_profile)
                                                                                @if($ind_profile->tax_status == 'Individual')
                                                                                <option value="{{ $ind_profile->name }}" @if($ind_profile->name == $profile->cauthname1) {{'selected'}} @endif>{{ $ind_profile->name }}</option>
                                                                                @endif
                                                                            @endforeach
                                                                        @endif
                                                                    </select>
                                                                </div>
                                                                {{-- <input type="text" class="form-control" id="company-cauthname1_{{$profile->member_count}}" name="company-cauthname1_{{$profile->member_count}}" placeholder="" value="{{ $profile->cauthname1 }}" /> --}}
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4 company-cauthdesignation1_{{$profile->member_count}}">
                                                            <div class="form-group">
                                                                <label for="company-cauthdesignation1_{{$profile->member_count}}">Designation</label>
                                                                <input type="text" class="form-control" id="company-cauthdesignation1_{{$profile->member_count}}" name="company-cauthdesignation1_{{$profile->member_count}}" placeholder="" value="{{ $profile->cauthdesignation1 }}" @if($client->is_introduction == 1) {{ 'readonly' }} @endif/>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12"></div>
                                                        @if(!in_array($profile->ctaxstatus, ["HUF","Sole Proprietorship"]))
                                                        <div class="col-sm-4 company-cauthname2_{{$profile->member_count}}">
                                                            <div class="form-group">
                                                                <label for="company-cauthname2_{{$profile->member_count}}">AUTHORIZED SIGNITORY NAME - 2</label>
                                                                <div class="select-wrapper exclude">
                                                                    <select class="form-control" id="company-cauthname2_{{$profile->member_count}}" name="company-cauthname2_{{$profile->member_count}}" @if($client->is_introduction == 1) {{ 'readonly' }} @endif>
                                                                        <option value="" disabled selected>Select Name</option>
                                                                        @if($client->individual_member_count > 0)
                                                                            @foreach ($client->individual_profile_manage as $ind_profile)
                                                                                @if($ind_profile->tax_status == 'Individual')
                                                                                <option value="{{ $ind_profile->name }}" @if($ind_profile->name == $profile->cauthname2) {{'selected'}} @endif>{{ $ind_profile->name }}</option>
                                                                                @endif
                                                                            @endforeach
                                                                        @endif
                                                                    </select>
                                                                </div>
                                                                {{-- <input type="text" class="form-control" id="company-cauthname2_{{$profile->member_count}}" name="company-cauthname2_{{$profile->member_count}}" placeholder="" value="{{ $profile->cauthname2 }}" /> --}}
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4 company-cauthdesignation2_{{$profile->member_count}}">
                                                            <div class="form-group">
                                                                <label for="company-cauthdesignation2_{{$profile->member_count}}">Designation</label>
                                                                <input type="text" class="form-control cauthdesignation" id="company-cauthdesignation2_{{$profile->member_count}}" name="company-cauthdesignation2_{{$profile->member_count}}" placeholder="" value="{{ $profile->cauthdesignation2 }}" @if($client->is_introduction == 1) {{ 'readonly' }} @endif/>
                                                            </div>
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                @endforeach
                                                @endif
                                                <div class="tab-pane fade show @if(isset($client->company_profile_manage) && empty($client->company_profile_manage)) {{ 'active' }}@endif" id="addcompany" role="tabpanel" aria-labelledby="addcompany-tab">
                                                    <div class="addCompanyTab row" style="margin-bottom: 10px;">
                                                        <div class="col-sm-4 cname">
                                                            <div class="form-group">
                                                                <label for="cname">Name of Establishment</label>
                                                                <input type="text" class="form-control" id="cname"
                                                                    name="cname" />
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3 cincorpdate">
                                                            <div class="form-group">
                                                                <label for="cincorpdate">Date of Incorporation</label>
                                                                <input type="text" name="cincorpdate" class="form-control incorpdate"
                                                                    id="cincorpdate" placeholder="" />
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3 ctaxstatus">
                                                            <div class="form-group">
                                                                <label for="ctaxstatus">Tax Status</label>
                                                                <div class="select-wrapper exclude">
                                                                    <select class="form-control" id="ctaxstatus" name="ctaxstatus">
                                                                        <option value="" selected>Select Tax Status</option>
                                                                        @foreach ($company_taxStatus as $type)
                                                                            <option value="{{ $type->name }}">{{ $type->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2 ctaxslab">
                                                            <div class="form-group">
                                                                <label for="ctaxslab">Company Tax Slab</label>
                                                                <div class="select-wrapper exclude">
                                                                    <select class="form-control" id="ctaxslab" name="ctaxslab">
                                                                        <option value="" disabled selected>Select</option>
                                                                        @foreach ($company_taxslabs as $slab)
                                                                            <option value="{{ $slab->code }}">{{ $slab->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-12">
                                                            <h4 class="form-section-title text-uppercase">AUTHORIZED Personel Details</h4>
                                                        </div>
                                                        <div class="col-sm-3 cauthname1">
                                                            <div class="form-group">
                                                                <label for="cauthname1">AUTHORIZED SIGNITORY NAME - 1</label>
                                                                <div class="select-wrapper exclude">
                                                                    <select class="form-control" id="cauthname1" name="cauthname1">
                                                                        <option value="" disabled selected>Select Name</option>
                                                                        {{-- @if($client->individual_member_count > 0)
                                                                            @foreach ($client->individual_profile_manage as $profile)
                                                                                <option value="{{ $profile->name }}">{{ $profile->name }}</option>
                                                                            @endforeach
                                                                        @endif --}}
                                                                    </select>
                                                                </div>
                                                                {{-- <input type="text" class="form-control" id="cauthname1" name="cauthname1"
                                                                    /> --}}
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3 cauthdesignation1">
                                                            <div class="form-group">
                                                                <label for="cauthdesignation1">Designation</label>
                                                                <input type="text" class="form-control" id="cauthdesignation1" name="cauthdesignation1"
                                                                    />
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12"></div>
                                                        <div class="col-sm-3 cauthname2">
                                                            <div class="form-group">
                                                                <label for="cauthname2">AUTHORIZED SIGNITORY NAME - 2</label>
                                                                <div class="select-wrapper exclude">
                                                                    <select class="form-control" id="cauthname2" name="cauthname2">
                                                                        <option value="" disabled selected>Select Name</option>
                                                                        {{-- @if($client->individual_member_count > 0)
                                                                            @foreach ($client->individual_profile_manage as $profile)
                                                                                <option value="{{ $profile->name }}">{{ $profile->name }}</option>
                                                                            @endforeach
                                                                        @endif --}}
                                                                    </select>
                                                                </div>
                                                                {{-- <input type="text" class="form-control" id="cauthname2" name="cauthname2"
                                                                    /> --}}
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3 cauthdesignation2">
                                                            <div class="form-group">
                                                                <label for="cauthdesignation2">Designation</label>
                                                                <input type="text" class="form-control" id="cauthdesignation2" name="cauthdesignation2"
                                                                    />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <hr>
                                        <div class="form-sections">
                                            <h4 class="form-section-title text-uppercase">Select Next Step</h4>
                                            <div class="row">
                                                <div class="col-sm-4 proceedto">
                                                    <div class="form-group">
                                                        <label for="proceedto">Proceed to</label>
                                                        <div class="select-wrapper">
                                                            <select class="form-control" id="proceedto" name="proceedto" @if($client->is_introduction == 1) {{ 'readonly' }} @endif>
                                                                <option value="" disabled selected>Proceed to
                                                                </option>
                                                                <option value="Comprehensive plan" @if(isset($client->proceed_to) && $client->proceed_to == 'Comprehensive plan') {{ 'selected' }}@endif >Comprehensive plan
                                                                </option>
                                                                <option value="Account Opening" @if(isset($client->proceed_to) && $client->proceed_to == 'Account Opening') {{ 'selected' }}@endif >Account Opening</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-footer">
                                <button type="button" class="btn btn-primary btn-lg proceed">
                                    @if($client->is_introduction == 1)
                                    Save and Next
                                    @else
                                    Confirm
                                    @endif
                                </button>
                            </div>
                        </div>



                    </section>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection


@section('modal')

@endsection

@section('script')
<script type="text/javascript" src="{{ asset('assets/javascript/colorpicker.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/javascript/client.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/javascript/introduction.js') }}"></script>
@endsection
