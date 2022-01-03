@extends('layouts.master')

@section('style')
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    .trade-status .transaction-steps {

    min-height:2rem;
}
    h6.sameLevel{
        /* cursor: initial; */
        pointer-events:none;
        padding-left: 0rem;
    margin-top: 0rem;
    margin-left: -1rem;
    }

    .edit-now {
        font-size: 12px;
        font-weight: 600;
        font-style: italic;
    }
    .skip{
        cursor: pointer;
    }
    .edit-now:hover {
        cursor: pointer;
        color: #1a2b2a;
        text-decoration: underline;
    }
    label[readonly] {
        background-color: #f6f6f6;
        border: 1px solid #a3a3a3;
        cursor: auto;
        pointer-events: none;
    }
    input.net_worth_date[readonly] {
        cursor: auto;
        pointer-events: none;
    }
    div.customMulti[readonly] {
        background-color: #f6f6f6;
        cursor: auto;
        pointer-events: none;
    }
    .ifsc_search{
        cursor: pointer;
    }
    .w-20{
        width: 20% !important;
    }
    .w-75{
        width: 75% !important;
    }
    .w-80{
        width: 80% !important;
    }
    .mt-2px{
        margin-top: 2px !important;
    }
    .description {
        pointer-events: none;
    }

    .input-group .form-control:disabled,
    .input-group .form-control[readonly] {
        background-color: #e9ecef !important;
    }

    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }
    /*Select2 ReadOnly Start*/
    select[readonly].select2-hidden-accessible+.select2-container {
        pointer-events: none;
        touch-action: none;
    }

    select[readonly].select2-hidden-accessible+.select2-container .select2-selection {
        background: #eee;
        box-shadow: none;
    }

    select[readonly].select2-hidden-accessible+.select2-container .select2-selection__arrow,
    select[readonly].select2-hidden-accessible+.select2-container .select2-selection__clear {
        display: none;
    }

    .select2-container--default .select2-results__option[aria-disabled=true] {
        display: none;
    }

    input[readonly] {
        background-color: #f6f6f6 !important;
    }
    select[readonly] {
        background-color: #f6f6f6 !important;
    }
/* .banks-tab .nav-item .nav-link.active {
    border: 1px solid var(--primary, #365b58);
    background-color: var(--primary, #365b58);
    color: #fff;
}
.banks-tab .nav-item .nav-link.add-bank{
    color: #545454;
    padding-right: 1.25rem;
    border: 1px dashed #545454;
    background-color: transparent;
}
.banks-tab .nav-item .nav-link {
    border: 1px solid var(--primary, #365b58);
    border-radius: 20px;
    text-transform: uppercase;
    padding: 4px 1.25rem;
    font-size: 0.875rem;
    color: var(--primary, #365b58);
    padding-right: 3rem;
} */
.banks-tab .nav-item:last-child {
margin-right: 0;
}
.banks-tab .nav-item+.nav-item {
margin-left: 0;
}
.banks-tab .nav-item {
position: relative;
margin-right: 1.25rem;
}
    .banks-tab .nav-item .nav-link.add-bank, .banks-tab .nav-item .nav-link.add-account, .income-tab .nav-item .nav-link.add-banks, .income-tab .nav-item .nav-link.add-account, .accounts-tab .nav-item .nav-link.add-bank, .accounts-tab .nav-item .nav-link.add-account {
color: #545454;
padding-right: 1.25rem;
border: 1px dashed #545454;
background-color: transparent;
}
.banks-tab .nav-item .nav-link.bank_added.active{
border: 1px solid var(--primary, #365b58);
background-color: var(--primary, #365b58);
color: #fff;
}
.banks-tab .nav-item .nav-link {
border: 1px solid var(--primary, #365b58);
border-radius: 20px;
text-transform: uppercase;
padding: 4px 1.25rem;
font-size: 0.875rem;
color: var(--primary, #365b58);
padding-right: 3rem;
}
.banks-tab .nav-item .remove-bank {
position: absolute;
right: 1rem;
top: 50%;
transform: translateY(-50%);
font-weight: bold;
color: var(--primary, #365b58);
cursor: pointer;
font-size: 8px;
}
.banks-tab .nav-item .nav-link.add-bank{
color: #545454;
padding-right: 1.25rem;
border: 1px dashed #545454;
background-color: transparent;
}

</style>
<style>
    .modal-confirm {
	color: #636363;
	width: 400px;
}
.modal-confirm .modal-content {
	padding: 20px;
	border-radius: 5px;
	border: none;
	text-align: center;
	font-size: 14px;
}
.modal-confirm .modal-header {
	border-bottom: none;
	position: relative;
}
.modal-confirm h4 {
	text-align: center;
	font-size: 26px;
	margin: 30px 0 -10px;
}
.modal-confirm .close {
	position: absolute;
	top: -5px;
	right: -2px;
}
.modal-confirm .modal-body {
	color: #999;
}
.modal-confirm .modal-footer {
	border: none;
	text-align: center;
	border-radius: 5px;
	font-size: 13px;
	padding: 10px 15px 25px;
}
.modal-confirm .modal-footer a {
	color: #999;
}
.modal-confirm .icon-box {
	width: 80px;
	height: 80px;
	margin: 0 auto;
	border-radius: 50%;
	z-index: 9;
	text-align: center;
	border: 3px solid #f15e5e;
}
.modal-confirm .icon-box i {
	color: #f15e5e;
	font-size: 46px;
	display: inline-block;
	margin-top: 13px;
}
.modal-confirm .btn, .modal-confirm .btn:active {
	color: #fff;
	border-radius: 4px;
	background: #60c7c1;
	text-decoration: none;
	transition: all 0.4s;
	line-height: normal;
	min-width: 120px;
	border: none;
	min-height: 40px;
	border-radius: 3px;
	margin: 0 5px;
}
.modal-confirm .btn-secondary {
	background: #c1c1c1;
}
.modal-confirm .btn-secondary:hover, .modal-confirm .btn-secondary:focus {
	background: #a8a8a8;
}
.modal-confirm .btn-danger {
	background: #f15e5e;
}
.modal-confirm .btn-danger:hover, .modal-confirm .btn-danger:focus {
	background: #ee3535;
}
.trigger-btn {
	display: inline-block;
	margin: 100px auto;
}
</style>
@endsection


@section('content')
<div class="container-fluid">
    <!--STEPER LOGIC-->
    @php
        $a = 0;
        $b = 0;
        $c = 0;

        foreach ($profiles as $profile) {
            $a++;
            $step = 'step'.$a;
            $$step = (isset($profile->is_profile) && $profile->is_profile == 1) ? 'completed' : null;
            if($$step == 'completed')
            {
                $b++;
            }else{
                if($c == 0)
                {
                    $c = $a;
                }
            }

            $a++;
            $step = 'step'.$a;
            $$step = (isset($profile->is_communication) && $profile->is_communication == 1) ? 'completed' : null;
            if($$step == 'completed')
            {
                $b++;
            }else{
                if($c == 0)
                {
                    $c = $a;
                }
            }

            $a++;
            $step = 'step'.$a;
            $$step = (isset($profile->is_bank) && $profile->is_bank == 1) ? 'completed' : null;
            if($$step == 'completed')
            {
                $b++;
            }else{
                if($c == 0)
                {
                    $c = $a;
                }
            }


        }
        if($a == $b)
        {
            $c = 1;
        }
        //dd($a,$b,$c);
        //dd($step1,$step2,$step3,$step4,$step5,$step6);
    @endphp
    <!-- End Steper Logic -->
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

                <form class="col-lg-8 col-xl-9 step-forms col-md-8 pl-0" id="client_kycinformation" method="POST" action="{{ route('kycinformation.store') }}" enctype="multipart/form-data">
                    @csrf
                    @php $i = 1;@endphp
                    <input type="hidden" name="id" id="client_id" value="{{ @$client_id }}">
                    <input type="hidden" name="client_edit" id="client_edit" value="@if($b > 0){{ '1' }} @else {{ '0' }}  @endif">
                    <input type="hidden" name="step_edit" id="step_edit" value="@if($a == $b){{ '0' }} @else {{ '1' }}  @endif">
                    <input type="hidden" name="current_pid" id="current_pid" value="{{ $profiles[0]->id }}">
                    <input type="hidden" name="current_step_id" id="current_step_id" value="{{ $c }}">
                    <input type="hidden" name="is_kyc_information" id="is_kyc_information" value="1">
                    <input type="hidden" name="is_verify" id="is_verify" value="{{ $is_verify }}">
                    @foreach ($profiles as $profile)

                    <input type="hidden" name="client_profile_id_{{ $profile->id }}" id="client_profile_id_{{ $profile->id }}" value="{{ @$profile->id }}">
                    <input type="hidden" name="client_profile_accounttype_{{ $profile->id }}" id="client_profile_accounttype_{{ $profile->id }}" value="{{ @$profile->account_type }}">
                    <input type="hidden" name="client_is_nri_{{ $profile->id }}" id="client_is_nri_{{ $profile->id }}" value="{{ (isset($profile->tax_status) && ($profile->tax_status == 'NRI' || $profile->tax_status == 'NRE' || $profile->tax_status == 'NRO')) ? 1 : 0 }}">
                    <input type="hidden" name="client_is_minor_{{ $profile->id }}" id="client_is_minor_{{ $profile->id }}" value="{{ (isset($profile->tax_status) && ($profile->tax_status == 'On behalf of minor')) ? 1 : 0 }}">

                        @php $pid = $profile->id; $step = 'step'.$i;
                            //$c = 7;
                            //dd($profile->vrejectionremarks);
                        @endphp
                        {{-- @if($i == 1){{'active'}}@endif --}}
                        <section class="trial {{ $$step }} @if($i == $c){{'active'}}@endif" id="profile_{{$pid}}" data-step="{{ $i }}" data-pid="{{ $pid }}" autocomplete="off">
                            <input type="hidden" name="is_profile_{{$pid}}" id="is_profile_{{$pid}}" value="{{ @$profile->is_profile }}">
                            <input type="hidden" name="account_type_{{$pid}}" id="account_type_{{$pid}}" value="{{ @$profile->account_type }}">
                            <input type="hidden" name="has_guardian_{{$pid}}" id="has_guardian_{{$pid}}" value="{{ @$profile->showguardian }}">
                            <div class="form-inner-section">
                                <div class="form-header">
                                    <h3 class="card-title"><i class="icon-left-arrow back-btn  @if($i == 1) {{'back_to_kycdetail'}} @endif"></i> {{ $profile->name }} - Profile
                                        @if ($$step == 'completed' && $details == 0)
                                            <span class="edit-now float-right mt-1">Edit</span>
                                        @endif
                                    </h3>
                                </div>
                                <div class="form-content">

                                    @if($profile->account_type == 1)
                                    <div class="row">
                                        @if($profile->showguardian == true)

                                        <input type="hidden" name="pan_upload_path_{{$pid}}" id="pan_upload_path_{{$pid}}" value="">
                                        <input type="hidden" name="kyc_upload_path_{{$pid}}" id="kyc_upload_path_{{$pid}}" value="">
                                        <div class="col-sm-4 client_guardian_id_{{ $pid }}">
                                            <div class="form-group">
                                                <label>Guardian <span class="required-sign">*</span></label>
                                                @php
                                                    //dd($profiles);
                                                @endphp
                                                <select class="form-control client_guardian_id" name="client_guardian_id_{{ $pid }}" id="client_guardian_id_{{ $pid }}" @if ($$step == 'completed') {{'readonly=true'}} @endif>
                                                    <option value="" disabled selected>Select Guardian</option>
                                                    @foreach ($profiles as $gprofile)
                                                        @if($gprofile->account_type == 1 && $gprofile->age > 18)
                                                        <option value="{{$gprofile->id}}" @if($profile->client_guardian_id == $gprofile->id) {{'Selected'}} @endif>{{$gprofile->name}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                {{-- <input type="text" class="form-control pan text-uppercase" name="pan_{{ $pid }}" id="pan_{{ $pid }}" value="{{ @$profile->pan }}" placeholder="Enter PAN Number" @if ($$step == 'completed') {{'readonly=true'}} @endif> --}}
                                            </div>
                                        </div>
                                        <div class="col-sm-3 birth_upload_{{ $pid }}">
                                            <div class="form-group">
                                                <label for="birth_upload_{{ $pid }}">Upload Birth Certificate <span class="required-sign">*</span></label>
                                                <label for="birth_upload_{{ $pid }}" class="btn input-btn w-100" @if ($$step == 'completed') {{'readonly=true'}} @endif>
                                                    <svg width="24" height="24" viewBox="0 0 24 24">
                                                        <use xlink:href="#upload" />
                                                    </svg>
                                                    <input id="birth_upload_{{ $pid }}" class="birth_upload" type="file" name="birth_upload_{{ $pid }}"  />
                                                    <div class="value-wrap">
                                                        <span class="default-text">
                                                            @if (isset($profile->birth_upload) && !empty($profile->birth_upload))
                                                            Update @else Upload @endif
                                                        </span>
                                                        <span class="value"></span>
                                                    </div>
                                                </label>
                                                @if (isset($profile->birth_upload) && !empty($profile->birth_upload))
                                                <label class="w-100">
                                                    <span class="text-lowercase font-italic"><a href="javascript:showImage('{{ $profile->birth_upload }}')" data-src="{{ $profile->birth_upload }}">Preview</a></span>
                                                </label>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-5"></div>
                                        @endif
                                        <div class="col-sm-4 pan_{{ $pid }}">
                                            <div class="form-group">
                                                <label>PAN Number <span class="required-sign">*</span></label>
                                                <input type="text" class="form-control pan text-uppercase" name="pan_{{ $pid }}" id="pan_{{ $pid }}" value="{{ @$profile->pan }}" placeholder="Enter PAN Number" @if ($$step == 'completed') {{'readonly=true'}} @endif>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 pan_upload_{{ $pid }}">
                                            <div class="form-group">
                                                <label for="pan_upload_{{ $pid }}">Upload PAN <span class="required-sign">*</span></label>
                                                <label for="pan_upload_{{ $pid }}" class="btn input-btn w-100" @if ($$step == 'completed') {{'readonly=true'}} @endif>
                                                    <svg width="24" height="24" viewBox="0 0 24 24">
                                                        <use xlink:href="#upload" />
                                                    </svg>
                                                    <input id="pan_upload_{{ $pid }}" class="pan_upload" type="file" name="pan_upload_{{ $pid }}"  />
                                                    <div class="value-wrap">
                                                        <span class="default-text">
                                                            @if (isset($profile->pan_upload) && !empty($profile->pan_upload))
                                                            Update @else Upload @endif
                                                        </span>
                                                        <span class="value"></span>
                                                    </div>
                                                </label>
                                                @if (isset($profile->pan_upload) && !empty($profile->pan_upload))
                                                <label class="w-100">
                                                    <span class="text-lowercase font-italic"><a href="javascript:showImage('{{ $profile->pan_upload }}')" data-src="{{ $profile->pan_upload }}">Preview</a></span>
                                                </label>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-5"></div>
                                        <div class="col-sm-4 kyc_status_{{ $pid }}">
                                            <div class="form-group">
                                                <label>KYC Verified Status <span class="required-sign">*</span></label>
                                                <select class="form-control kyc_status" name="kyc_status_{{ $pid }}" id="kyc_status_{{ $pid }}" @if ($$step == 'completed') {{'readonly=true'}} @endif>
                                                    <option value="" disabled selected>Select KYC Status</option>
                                                    @foreach ($kycstatus as $status)
                                                        <option value="{{ $status->name }}" @if($profile->kyc_status == $status->name) {{ 'selected' }} @endif >{{ $status->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>
                                        <div class="col-sm-3 kyc_upload_{{ $pid }}">
                                            <div class="form-group">
                                                <label for="kyc_upload_{{ $pid }}">Upload KYC <span class="required-sign">*</span></label>
                                                <label for="kyc_upload_{{ $pid }}" class="btn input-btn w-100" @if ($$step == 'completed') {{'readonly=true'}} @endif>

                                                    <svg width="24" height="24" viewBox="0 0 24 24">
                                                        <use xlink:href="#upload" />
                                                    </svg>
                                                    <input id="kyc_upload_{{ $pid }}" type="file" class="kyc_upload" name="kyc_upload_{{ $pid }}" />
                                                    <div class="value-wrap">
                                                        <span class="default-text">
                                                            @if (isset($profile->kyc_upload) && !empty($profile->kyc_upload))
                                                            Update @else Upload @endif
                                                        </span>
                                                        <span class="value"></span>
                                                    </div>
                                                </label>
                                                @if (isset($profile->kyc_upload) && !empty($profile->kyc_upload))
                                                <label class="w-100">
                                                    <span class="text-lowercase font-italic"><a href="javascript:showImage('{{ $profile->kyc_upload }}')" data-src="{{ $profile->kyc_upload }}">Preview</a></span>
                                                </label>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-5"></div>

                                        <div class="col-sm-4 ckyc_no_{{ $pid }}">
                                            <div class="form-group">
                                                <label>CKyc No</label>
                                                <input type="text" class="form-control ckyc_no" id="ckyc_no_{{ $pid }}" placeholder="CKyc No" name="ckyc_no_{{ $pid }}" value="{{ @$profile->ckyc_no }}" @if ($$step == 'completed') {{'readonly=true'}} @endif>
                                            </div>
                                        </div>

                                        <div class="col-sm-4 gender_{{ $pid }}">
                                            <div class="form-group">
                                                <label>Gender <span class="required-sign">*</span></label>
                                                <select class="form-control gender" id="gender_{{ $pid }}" name="gender_{{ $pid }}" @if ($$step == 'completed') {{'readonly=true'}} @endif>
                                                    <option value="" disabled selected>Select Gender</option>
                                                    <option value="MALE" @if($profile->gender == 'MALE'){{ 'selected' }} @endif>Male</option>
                                                    <option value="FEMALE" @if($profile->gender == 'FEMALE'){{ 'selected' }} @endif>Female</option>
                                                    <option value="OTHER" @if($profile->gender == 'OTHER'){{ 'selected' }} @endif>Other</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 aadhar_{{ $pid }}">
                                            <div class="form-group">
                                                <label>Aadhar No</label>
                                                <input type="text" class="form-control aadhar" id="aadhar_{{ $pid }}" placeholder="Aadhar No" name="aadhar_{{ $pid }}" value="{{ @$profile->aadhar }}" @if ($$step == 'completed') {{'readonly=true'}} @endif>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 country_code_{{ $pid }}">
                                            <div class="form-group">
                                                <label>Country Code <span class="required-sign">*</span></label>
                                                <input type="text" class="form-control country_code" id="country_code_{{ $pid }}" placeholder="Country Code" name="country_code_{{ $pid }}" value="{{ @$profile->country_code }}" @if ($$step == 'completed') {{'readonly=true'}} @endif>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 mobile_{{ $pid }}">
                                            <div class="form-group">
                                                <label>Mobile Number <span class="required-sign">*</span></label>
                                                <input type="tel" class="form-control mobile" id="mobile_{{ $pid }}" placeholder="Enter Mobile Number" name="mobile_{{ $pid }}" value="{{ @$profile->mobile }}" @if ($$step == 'completed') {{'readonly=true'}} @endif>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 email_{{ $pid }}">
                                            <div class="form-group">
                                                <label>Email <span class="required-sign">*</span></label>
                                                <input type="text" class="form-control email_address" id="email_{{ $pid }}" placeholder="Enter Email" name="email_{{ $pid }}" value="{{ @$profile->email }}" @if ($$step == 'completed') {{'readonly=true'}} @endif>
                                            </div>
                                        </div>

                                        <div class="col-sm-4 birth_incorp_place_{{ $pid }}">
                                            <div class="form-group">
                                                <label>Place of Birth <span class="required-sign">*</span></label>
                                                <input type="text" class="form-control birth_incorp_place" placeholder="Place of Birth" id="birth_incorp_place_{{ $pid }}" name="birth_incorp_place_{{ $pid }}" value="{{ @$profile->birth_incorp_place }}" @if ($$step == 'completed') {{'readonly=true'}} @endif>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 birth_incorp_country_{{ $pid }}">
                                            <div class="form-group">
                                                <label>Country of Birth <span class="required-sign">*</span></label>
                                                <input type="text" class="form-control birth_incorp_country" placeholder="Country of Birth" id="birth_incorp_country_{{ $pid }}" name="birth_incorp_country_{{ $pid }}" value="{{ @$profile->birth_incorp_country }}" @if ($$step == 'completed') {{'readonly=true'}} @endif>
                                            </div>
                                        </div>

                                        <div class="col-sm-4 tax_status_{{ $pid }}">
                                            <div class="form-group">
                                                <label>Tax Status <span class="required-sign">*</span></label>
                                                <select class="form-control tax_status" name="tax_status_{{ $pid }}" id="tax_status_{{ $pid }}" readonly=true>{{-- @if ($$step == 'completed') {{'readonly=true'}} @endif --}}
                                                    <option value="" disabled selected>Select Tax Status</option>
                                                    @if($profile->account_type == 1)
                                                        @foreach ($individual_taxStatus as $taxstatus)
                                                            @if ($profile->tax_status == 'Individual' || $profile->tax_status == 'On behalf of minor')
                                                                @if($taxstatus->name == 'Individual' || $taxstatus->name == 'On behalf of minor')
                                                                <option value="{{$taxstatus->name}}" @if($profile->tax_status == $taxstatus->name){{ 'selected' }} @endif>{{$taxstatus->name}}</option>
                                                                @endif
                                                            @elseif($profile->tax_status == 'NRI' || $profile->tax_status == 'NRI - Minor')
                                                                @if($taxstatus->name == 'NRI' || $taxstatus->name == 'NRI - Minor')
                                                                <option value="{{$taxstatus->name}}" @if($profile->tax_status == $taxstatus->name){{ 'selected' }} @endif>{{$taxstatus->name}}</option>
                                                                @endif
                                                            @endif

                                                        @endforeach
                                                    @else
                                                        @foreach ($company_taxStatus as $taxstatus)

                                                        <option value="{{$taxstatus->name}}" @if($profile->tax_status == $taxstatus->name){{ 'selected' }} @endif>{{$taxstatus->name}}</option>

                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 occupation_{{ $pid }}">
                                            <div class="form-group">
                                                <label>Occupation <span class="required-sign">*</span></label>
                                                <select class="form-control occupation" name="occupation_{{ $pid }}" id="occupation_{{ $pid }}" @if ($$step == 'completed') {{'readonly=true'}} @endif>
                                                    <option value="" disabled selected>Select Occupation</option>
                                                    @foreach ($occupations as $occupation)
                                                    <option value="{{$occupation->name}}" @if($profile->occupation == $occupation->name){{ 'selected' }} @endif>{{$occupation->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 employer_name_{{ $pid }}">
                                            <div class="form-group">
                                                <label>Employer Name</label>
                                                <input type="text" class="form-control" placeholder="Enter Employer Name" id="employer_name_{{ $pid }}" name="employer_name_{{ $pid }}" value="{{ @$profile->employer_name }}" @if ($$step == 'completed') {{'readonly=true'}} @endif>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 gross_annual_income_{{ $pid }}">
                                            <div class="form-group">
                                                <label>Gross Annual Income <span class="required-sign">*</span></label>
                                                <select class="form-control gross_annual_income" id="gross_annual_income_{{ $pid }}" name="gross_annual_income_{{ $pid }}" @if ($$step == 'completed') {{'readonly=true'}} @endif>
                                                    <option value="" disabled selected>Select Gross Annual Income</option>
                                                    @foreach ($grossincomes as $income)
                                                    <option value="{{$income->name}}" @if($profile->gross_annual_income == $income->name){{ 'selected' }} @endif>{{$income->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 net_worth_{{ $pid }}">
                                            <div class="form-group">
                                                <label>Net Worth <span class="required-sign">*</span></label>
                                                <input type="text" class="amount form-control net_worth" placeholder="Net Worth" id="net_worth_{{ $pid }}" name="net_worth_{{ $pid }}" value="{{(isset($profile->net_worth) && $profile->net_worth > 0) ? $profile->net_worth : ''}}" @if ($$step == 'completed') {{'readonly=true'}} @endif>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 net_worth_date_{{ $pid }}">
                                            <div class="form-group">
                                                <label>Net Worth Date <span class="required-sign">*</span></label>
                                                <input type="text" class="form-control net_worth_date" placeholder="Net Worth Date" id="net_worth_date_{{ $pid }}" name="net_worth_date_{{ $pid }}" value="{{ @$profile->net_worth_date }}" @if ($$step == 'completed') {{'readonly=true'}} @endif>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 wealth_source_{{ $pid }}">
                                            <div class="form-group">
                                                <label>Source of Wealth <span class="required-sign">*</span></label>
                                                <select class="form-control wealth_source" name="wealth_source_{{ $pid }}" id="wealth_source_{{ $pid }}" @if ($$step == 'completed') {{'readonly=true'}} @endif>
                                                    <option value="" disabled selected>Select Source of Wealth</option>
                                                    @foreach ($wealthsources as $source)
                                                    <option value="{{$source->name}}" @if($profile->wealth_source == $source->name){{ 'selected' }} @endif>{{$source->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                    @elseif($profile->account_type == 2)
                                    <div class="row">
                                        <input type="hidden" name="ubo_count_{{ $pid }}" id="ubo_count_{{ $pid }}" value="{{ @$profile->ubo_count }}">
                                        <div class="col-sm-4 pan_{{ $pid }}">
                                            <div class="form-group">
                                                <label>PAN Number <span class="required-sign">*</span></label>
                                                <input type="text" class="form-control pan text-uppercase" name="pan_{{ $pid }}" id="pan_{{ $pid }}" value="{{ @$profile->pan }}" placeholder="Enter PAN Number" @if ($$step == 'completed') {{'readonly=true'}} @endif>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 pan_upload_{{ $pid }}">
                                            <div class="form-group">
                                                <label for="pan_upload_{{ $pid }}">Upload PAN <span class="required-sign">*</span></label>
                                                <label for="pan_upload_{{ $pid }}" class="btn input-btn w-100" @if ($$step == 'completed') {{'readonly=true'}} @endif>
                                                    <svg width="24" height="24" viewBox="0 0 24 24">
                                                        <use xlink:href="#upload" />
                                                    </svg>
                                                    <input id="pan_upload_{{ $pid }}" class="pan_upload" type="file" name="pan_upload_{{ $pid }}"  />
                                                    <div class="value-wrap">
                                                        <span class="default-text">
                                                            @if (isset($profile->pan_upload) && !empty($profile->pan_upload))
                                                            Update @else Upload @endif
                                                        </span>
                                                        <span class="value"></span>
                                                    </div>
                                                </label>
                                                @if (isset($profile->pan_upload) && !empty($profile->pan_upload))
                                                <label class="w-100">
                                                    <span class="text-lowercase font-italic"><a href="javascript:showImage('{{ $profile->pan_upload }}')" data-src="{{ $profile->pan_upload }}">Preview</a></span>
                                                </label>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-5"></div>
                                        <div class="col-sm-4 kyc_status_{{ $pid }}">
                                            <div class="form-group">
                                                <label>KYC Verified Status <span class="required-sign">*</span></label>
                                                <select class="form-control kyc_status" name="kyc_status_{{ $pid }}" id="kyc_status_{{ $pid }}" @if ($$step == 'completed') {{'readonly=true'}} @endif>
                                                    <option value="" disabled selected>Select KYC Status</option>
                                                    @foreach ($kycstatus as $status)
                                                        <option value="{{ $status->name }}" @if($profile->kyc_status == $status->name) {{ 'selected' }} @endif >{{ $status->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>
                                        <div class="col-sm-3 kyc_upload_{{ $pid }}">
                                            <div class="form-group">
                                                <label for="kyc_upload_{{ $pid }}">Upload KYC <span class="required-sign">*</span></label>
                                                <label for="kyc_upload_{{ $pid }}" class="btn input-btn w-100" @if ($$step == 'completed') {{'readonly=true'}} @endif>

                                                    <svg width="24" height="24" viewBox="0 0 24 24">
                                                        <use xlink:href="#upload" />
                                                    </svg>
                                                    <input id="kyc_upload_{{ $pid }}" type="file" class="kyc_upload" name="kyc_upload_{{ $pid }}" />
                                                    <div class="value-wrap">
                                                        <span class="default-text">
                                                            @if (isset($profile->kyc_upload) && !empty($profile->kyc_upload))
                                                            Update @else Upload @endif
                                                        </span>
                                                        <span class="value"></span>
                                                    </div>
                                                </label>
                                                @if (isset($profile->kyc_upload) && !empty($profile->kyc_upload))
                                                <label class="w-100">
                                                    <span class="text-lowercase font-italic"><a href="javascript:showImage('{{ $profile->kyc_upload }}')" data-src="{{ $profile->kyc_upload }}">Preview</a></span>
                                                </label>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-5"></div>
                                        <input type="hidden" class="form-control country_code" id="country_code_{{ $pid }}" placeholder="Country Code" name="country_code_{{ $pid }}" value="@if (isset($profile->country_code) && !empty($profile->country_code)) {{$profile->country_code}} @else {{'91'}} @endif">
                                        {{-- <div class="col-sm-4 country_code_{{ $pid }}">
                                            <div class="form-group">
                                                <label>Country Code <span class="required-sign">*</span></label>
                                                <input type="text" class="form-control country_code" id="country_code_{{ $pid }}" placeholder="Country Code" name="country_code_{{ $pid }}" value="{{ @$profile->country_code }}" @if ($$step == 'completed') {{'readonly=true'}} @endif>
                                            </div>
                                        </div> --}}
                                        <div class="col-sm-4 occupation_{{ $pid }}">
                                            <div class="form-group">
                                                <label>Occupation <span class="required-sign">*</span></label>
                                                <select class="form-control occupation" name="occupation_{{ $pid }}" id="occupation_{{ $pid }}" @if ($$step == 'completed') {{'readonly=true'}} @endif>
                                                    <option value="" disabled selected>Select Occupation</option>
                                                    @foreach ($occupations as $occupation)
                                                    <option value="{{$occupation->name}}" @if($profile->occupation == $occupation->name){{ 'selected' }} @endif>{{$occupation->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 mobile_{{ $pid }}">
                                            <div class="form-group">
                                                <label>Mobile Number <span class="required-sign">*</span></label>
                                                <input type="tel" class="form-control mobile" id="mobile_{{ $pid }}" placeholder="Enter Mobile Number" name="mobile_{{ $pid }}" value="{{ @$profile->mobile }}" @if ($$step == 'completed') {{'readonly=true'}} @endif>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 email_{{ $pid }}">
                                            <div class="form-group">
                                                <label>Email <span class="required-sign">*</span></label>
                                                <input type="text" class="form-control email_address" id="email_{{ $pid }}" placeholder="Enter Email" name="email_{{ $pid }}" value="{{ @$profile->email }}" @if ($$step == 'completed') {{'readonly=true'}} @endif>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 tax_status_{{ $pid }}">
                                            <div class="form-group">
                                                <label>Tax Status <span class="required-sign">*</span></label>
                                                <select class="form-control tax_status" name="tax_status_{{ $pid }}" id="tax_status_{{ $pid }}" @if ($$step == 'completed') {{'readonly=true'}} @endif>
                                                    <option value="" disabled selected>Select Tax Status</option>
                                                    @foreach ($company_taxStatus as $taxstatus)

                                                        <option value="{{$taxstatus->name}}" @if($profile->tax_status == $taxstatus->name){{ 'selected' }} @endif>{{$taxstatus->name}}</option>

                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 birth_incorp_place_{{ $pid }}">
                                            <div class="form-group">
                                                <label>Place of Incorporation <span class="required-sign">*</span></label>
                                                <input type="text" class="form-control birth_incorp_place" placeholder="Place of incorporation" id="birth_incorp_place_{{ $pid }}" name="birth_incorp_place_{{ $pid }}" value="{{ @$profile->birth_incorp_place }}" @if ($$step == 'completed') {{'readonly=true'}} @endif>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 birth_incorp_country_{{ $pid }}">
                                            <div class="form-group">
                                                <label>Country of Incorporation <span class="required-sign">*</span></label>
                                                <input type="text" class="form-control birth_incorp_country" placeholder="Country of incorporation" id="birth_incorp_country_{{ $pid }}" name="birth_incorp_country_{{ $pid }}" value="{{ @$profile->birth_incorp_country }}" @if ($$step == 'completed') {{'readonly=true'}} @endif>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 gross_annual_income_{{ $pid }}">
                                            <div class="form-group">
                                                <label>Gross Annual Income <span class="required-sign">*</span></label>
                                                <select class="form-control gross_annual_income" id="gross_annual_income_{{ $pid }}" name="gross_annual_income_{{ $pid }}" @if ($$step == 'completed') {{'readonly=true'}} @endif>
                                                    <option value="" disabled selected>Select Gross Annual Income</option>
                                                    @foreach ($grossincomes as $income)
                                                    <option value="{{$income->name}}" @if($profile->gross_annual_income == $income->name){{ 'selected' }} @endif>{{$income->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 net_worth_{{ $pid }}">
                                            <div class="form-group">
                                                <label>Net Worth <span class="required-sign">*</span></label>
                                                <input type="text" class="form-control net_worth amount" placeholder="Net Worth" id="net_worth_{{ $pid }}" name="net_worth_{{ $pid }}" value="{{(isset($profile->net_worth) && $profile->net_worth > 0) ? $profile->net_worth : ''}}" @if ($$step == 'completed') {{'readonly=true'}} @endif>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 net_worth_date_{{ $pid }}">
                                            <div class="form-group">
                                                <label>Net Worth Date <span class="required-sign">*</span></label>
                                                <input type="text" class="form-control net_worth_date" placeholder="Net Worth Date" id="net_worth_date_{{ $pid }}" name="net_worth_date_{{ $pid }}" value="{{ @$profile->net_worth_date }}" @if ($$step == 'completed') {{'readonly=true'}} @endif>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 business_nature_{{ $pid }}">
                                            <div class="form-group">
                                                <label>Nature of Business <span class="required-sign">*</span></label>
                                                <input type="text" class="form-control business_nature" id="business_nature_{{ $pid }}" placeholder="Nature of Business" name="business_nature_{{ $pid }}" value="{{ @$profile->business_nature }}" @if ($$step == 'completed') {{'readonly=true'}} @endif>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 wealth_source_{{ $pid }}">
                                            <div class="form-group">
                                                <label>Source of Wealth <span class="required-sign">*</span></label>
                                                <select class="form-control wealth_source" name="wealth_source_{{ $pid }}" id="wealth_source_{{ $pid }}" @if ($$step == 'completed') {{'readonly=true'}} @endif>
                                                    <option value="" disabled selected>Select Source of Wealth</option>
                                                    @foreach ($wealthsources as $source)
                                                    <option value="{{$source->name}}" @if($profile->wealth_source == $source->name){{ 'selected' }} @endif>{{$source->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        {{-- <div class="col-sm-12">
                                            <h4 class="form-section-title text-uppercase">UBO Details</h4>
                                        </div>

                                        <div class="col-sm-4 ubo_count_{{ $pid }}">
                                            <div class="form-group">
                                                <label>UBO Count <span class="required-sign">*</span></label>
                                                <select class="form-control ubo_count" name="ubo_count_{{ $pid }}" id="ubo_count_{{ $pid }}" @if ($$step == 'completed') {{'readonly=true'}} @endif>
                                                    <option value="" disabled selected>Select UBO Count</option>
                                                    @for ($j = 1; $j <= $profile->ubo_max_count; $j++)
                                                    <option value="{{$j}}" @if($profile->ubo_count == $j) {{ 'Selected' }} @endif>{{$j}}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div> --}}
                                        @php
                                            $ubo_array = [
                                                $profile->ubo_name1,
                                                $profile->ubo_name2,
                                                $profile->ubo_name3,
                                                $profile->ubo_name4,
                                            ];
                                        @endphp

                                        <div class="col-sm-4 ubo_name_{{ $pid }}"><!--row flex-column -->
                                            <div class="form-group">
                                                <label for="ubo_name_{{ $pid }}">UBO Name <span class="required-sign">*</span></label>
                                                <div class="dropdown customMulti" @if ($$step == 'completed') {{'readonly=true'}} @endif>
                                                    <a class="dropdown-toggle select-dropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <span class="text-grey">Select UBO NAME</span>
                                                    </a>
                                                    <div id="ubo_name_{{ $pid }}" class="ubo_name dropdown-menu dropdown-menu-left select-dropdown-list">
                                                        <div class="data-list">
                                                            @foreach ($profile->ubo_max_name as $name)
                                                            <a class="dropdown-item">
                                                                <div class="form-group custom-checkbox m-0">
                                                                    <input type="checkbox" name="ubo_name_{{ $pid }}[]" id="ubo_name_{{ $pid }}_{{$name->id}}" value="{{ $name->name }}" @if(in_array($name->name, $ubo_array)){{ 'checked' }} @endif>
                                                                    <label for="ubo_name_{{ $pid }}_{{$name->id}}">{{ $name->name }}</label>
                                                                </div>
                                                            </a>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    <!-- Error Message -->
                                    @if(isset($profile->vrejectionremarks) && !empty($profile->vrejectionremarks))
                                    @php
                                        $premark = 0;
                                        foreach($profile->vrejectionremarks as $profileremark)
                                        {
                                            if($profileremark->type == 'profile')
                                            {
                                                $premark++;
                                            }
                                        }
                                    @endphp
                                    @if($premark > 0)
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card small-card option-2 mb-4">
                                                <div class="card-header">
                                                    <h6 class="card-title">Rejected Reason</h6>
                                                </div>
                                                <div class="card-body">
                                                    <div class="transaction-wrapper trade-status">
                                                        @foreach ($profile->vrejectionremarks as $profile_remark)
                                                        @if($profile_remark->type == 'profile')
                                                        <div class="transaction-steps regected">
                                                            <div class="trade-title mb-1">
                                                                <h4 class="mb-0">{{$profile_remark->remarks}}</h4>
                                                                <div class="info">
                                                                    <span>{{ Carbon\Carbon::parse($profile_remark->created_at)->format('h:i:s A') }}</span>
                                                                    <span>{{ Carbon\Carbon::parse($profile_remark->created_at)->format('l, jS F Y') }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @endif
                                </div>
                                <div class="form-footer">
                                    <button type="button" class="btn btn-primary btn-lg proceed">Proceed</button>
                                </div>
                            </div>
                        </section>
                        @php $i++; $step = 'step'.$i;

                        @endphp
                        <section class="trial {{ $$step }} @if($i == $c){{'active'}}@endif" id="communication_{{$pid}}" data-step="{{ $i }}" data-pid="{{ $pid }}" autocomplete="off">
                            <input type="hidden" name="is_communication_{{$pid}}" id="is_communication_{{$pid}}" value="{{ @$profile->is_communication }}">
                            <div class="form-inner-section">
                                <div class="form-header">
                                    <h3 class="card-title"><i class="icon-left-arrow back-btn"></i> {{ $profile->name }} - Communication
                                        @if ($$step == 'completed' && $details == 0)
                                            <span class="edit-now float-right mt-1">Edit</span>
                                        @endif
                                    </h3>
                                </div>
                                <div class="form-content">

                                    <input type="hidden" name="statecode_{{ $pid }}" id="statecode_{{ $pid }}" value="{{ @$profile->state }}">
                                    <input type="hidden" name="address_upload_path_{{$pid}}" id="address_upload_path_{{$pid}}" value="">
                                    <div class="row">
                                        <div class="col-sm-4 address_type_{{ $pid }}">
                                            <div class="form-group">
                                                <label>Address Type <span class="required-sign">*</span></label>
                                                <div class="select-wrapper exclude">
                                                    @php
                                                      //dd($profile);
                                                    @endphp
                                                    <select class="form-control address_type" id="address_type_{{ $pid }}" name="address_type_{{ $pid }}" @if ($$step == 'completed') {{'readonly=true'}} @endif>
                                                        <option value="" disabled selected>Select Address Type</option>
                                                        @foreach ($addresstypes as $type)
                                                            @if($type->id == 2 || $type->id == 3)
                                                                <option value="{{$type->id}}" @if(isset($profile->address_type) && $profile->address_type == $type->id) {{'selected'}} @endif >{{$type->name}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 address1_{{ $pid }}">
                                            <div class="form-group">
                                                <label>Address Line 1 <span class="required-sign">*</span></label>
                                                <input type="text" class="form-control address1" placeholder="Enter Address Line 1" id="address1_{{ $pid }}" name="address1_{{ $pid }}" value="{{ @$profile->address1 }}" @if ($$step == 'completed') {{'readonly=true'}} @endif>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 address_upload_{{ $pid }}">
                                            <div class="form-group">
                                                <label for="address_upload_{{ $pid }}">Upload Proof <span class="required-sign">*</span></label>
                                                <label for="address_upload_{{ $pid }}" class="btn input-btn w-100" @if ($$step == 'completed') {{'readonly=true'}} @endif>

                                                    <svg width="24" height="24" viewBox="0 0 24 24">
                                                        <use xlink:href="#upload" />
                                                    </svg>
                                                    <input id="address_upload_{{ $pid }}" type="file" class="address_upload" name="address_upload_{{ $pid }}" />
                                                    <div class="value-wrap">
                                                        <span class="default-text">
                                                            @if (isset($profile->address_upload) && !empty($profile->address_upload))
                                                            Update @else Upload @endif
                                                        </span>
                                                        <span class="value"></span>
                                                    </div>
                                                </label>
                                                @if (isset($profile->address_upload) && !empty($profile->address_upload))
                                                <label class="w-100">
                                                    <span class="text-lowercase font-italic"><a href="javascript:showImage('{{ $profile->address_upload }}')" data-src="{{ $profile->address_upload }}">Preview</a></span>
                                                </label>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-4 address2_{{ $pid }}">
                                            <div class="form-group">
                                                <label>Address Line 2 <span class="required-sign">*</span></label>
                                                <input type="text" class="form-control address2" placeholder="Enter Address Line 2" id="address2_{{ $pid }}" name="address2_{{ $pid }}" value="{{ @$profile->address2 }}" @if ($$step == 'completed') {{'readonly=true'}} @endif>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 address3_{{ $pid }}">
                                            <div class="form-group">
                                                <label>Address Line 3</label>
                                                <input type="text" class="form-control address3" placeholder="Enter Address Line 3" id="address3_{{ $pid }}" name="address3_{{ $pid }}" value="{{ @$profile->address3 }}" @if ($$step == 'completed') {{'readonly=true'}} @endif>
                                            </div>
                                        </div>

                                        <div class="col-sm-4 city_{{ $pid }}">
                                            <div class="form-group">
                                                <label>City <span class="required-sign">*</span></label>
                                                <input type="text" class="form-control city" placeholder="Enter City Name" id="city_{{ $pid }}" name="city_{{ $pid }}" value="{{ @$profile->city }}" @if ($$step == 'completed') {{'readonly=true'}} @endif>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 state_{{ $pid }}">
                                            <div class="form-group">
                                                <label>State <span class="required-sign">*</span></label>
                                                <select class="form-control state" id="state_{{ $pid }}" name="state_{{ $pid }}" @if ($$step == 'completed') {{'readonly=true'}} @endif>
                                                    <option value="" disabled selected>Select State</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 country_{{ $pid }}">
                                            <div class="form-group">
                                                <label>Country <span class="required-sign">*</span></label>
                                                <select class="form-control country" id="country_{{ $pid }}" name="country_{{ $pid }}" @if ($$step == 'completed') {{'readonly=true'}} @endif>
                                                    <option value="" disabled selected>Select Country</option>
                                                    @foreach ($countries as $country)
                                                    <option value="{{ $country->id }}" @if (isset($profile->country) && $country->id == $profile->country) {{ 'selected' }} @elseif($country->id == 98) {{ 'selected' }} @endif>{{ $country->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 pincode_{{ $pid }}">
                                            <div class="form-group">
                                                <label>Pincode <span class="required-sign">*</span></label>
                                                <input type="text" class="form-control pincode" placeholder="Enter Pincode" id="pincode_{{ $pid }}" name="pincode_{{ $pid }}" value="{{ @$profile->pincode }}" @if ($$step == 'completed') {{'readonly=true'}} @endif>
                                            </div>
                                        </div>

                                    </div>
                                    @if(in_array($profile->tax_status,['NRI','NRE','NRO']))
                                    <input type="hidden" name="foreign_statecode_{{ $pid }}" id="foreign_statecode_{{ $pid }}" value="{{ @$profile->foreign_state }}">
                                    <input type="hidden" name="foreign_address_upload_path_{{$pid}}" id="foreign_address_upload_path_{{$pid}}" value="">
                                    <div class="row">
                                        <div class="col-sm-12">
                                        <h6 class="card-title">
                                            Foreign Address
                                        </h6>
                                        </div>

                                        <div class="col-sm-4 foreign_address_type_{{ $pid }}">
                                            <div class="form-group">
                                                <label>Address Type <span class="required-sign">*</span></label>
                                                <div class="select-wrapper exclude">

                                                    <select class="form-control foreign_address_type" id="foreign_address_type_{{ $pid }}" name="foreign_address_type_{{ $pid }}" @if ($$step == 'completed') {{'readonly=true'}} @endif>
                                                        <option value="" disabled selected>Select Address Type</option>
                                                        @foreach ($addresstypes as $type)
                                                            @if($type->id == 2 || $type->id == 3)
                                                                <option value="{{$type->id}}" @if(isset($profile->foreign_address_type) && $profile->foreign_address_type == $type->id) {{'selected'}} @endif >{{$type->name}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 foreign_address1_{{ $pid }}">
                                            <div class="form-group">
                                                <label>Address Line 1 <span class="required-sign">*</span></label>
                                                <input type="text" class="form-control foreign_address1" placeholder="Enter Address Line 1" id="foreign_address1_{{ $pid }}" name="foreign_address1_{{ $pid }}" value="{{ @$profile->foreign_address1 }}" @if ($$step == 'completed') {{'readonly=true'}} @endif>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 foreign_address_upload_{{ $pid }}">
                                            <div class="form-group">
                                                <label for="foreign_address_upload_{{ $pid }}">Upload Proof <span class="required-sign">*</span></label>
                                                <label for="foreign_address_upload_{{ $pid }}" class="btn input-btn w-100" @if ($$step == 'completed') {{'readonly=true'}} @endif>

                                                    <svg width="24" height="24" viewBox="0 0 24 24">
                                                        <use xlink:href="#upload" />
                                                    </svg>
                                                    <input id="foreign_address_upload_{{ $pid }}" type="file" class="foreign_address_upload" name="foreign_address_upload_{{ $pid }}" />
                                                    <div class="value-wrap">
                                                        <span class="default-text">
                                                            @if (isset($profile->foreign_address_upload) && !empty($profile->foreign_address_upload))
                                                            Update @else Upload @endif
                                                        </span>
                                                        <span class="value"></span>
                                                    </div>
                                                </label>
                                                @if (isset($profile->foreign_address_upload) && !empty($profile->foreign_address_upload))
                                                <label class="w-100">
                                                    <span class="text-lowercase font-italic"><a href="javascript:showImage('{{ $profile->foreign_address_upload }}')" data-src="{{ $profile->foreign_address_upload }}">Preview</a></span>
                                                </label>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-4 foreign_address2_{{ $pid }}">
                                            <div class="form-group">
                                                <label>Address Line 2 <span class="required-sign">*</span></label>
                                                <input type="text" class="form-control foreign_address2" placeholder="Enter Address Line 2" id="foreign_address2_{{ $pid }}" name="foreign_address2_{{ $pid }}" value="{{ @$profile->foreign_address2 }}" @if ($$step == 'completed') {{'readonly=true'}} @endif>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 foreign_address3_{{ $pid }}">
                                            <div class="form-group">
                                                <label>Address Line 3</label>
                                                <input type="text" class="form-control foreign_address3" placeholder="Enter Address Line 3" id="foreign_address3_{{ $pid }}" name="foreign_address3_{{ $pid }}" value="{{ @$profile->foreign_address3 }}" @if ($$step == 'completed') {{'readonly=true'}} @endif>
                                            </div>
                                        </div>

                                        <div class="col-sm-4 foreign_city_{{ $pid }}">
                                            <div class="form-group">
                                                <label>City <span class="required-sign">*</span></label>
                                                <input type="text" class="form-control foreign_city" placeholder="Enter City Name" id="foreign_city_{{ $pid }}" name="foreign_city_{{ $pid }}" value="{{ @$profile->foreign_city }}" @if ($$step == 'completed') {{'readonly=true'}} @endif>
                                            </div>
                                        </div>

                                        <div class="col-sm-4 foreign_country_{{ $pid }}">
                                            <div class="form-group">
                                                <label>Country <span class="required-sign">*</span></label>
                                                <select class="form-control foreign_country" id="foreign_country_{{ $pid }}" name="foreign_country_{{ $pid }}" @if ($$step == 'completed') {{'readonly=true'}} @endif>
                                                    <option value="" disabled selected>Select Country</option>
                                                    @foreach ($countries as $country)
                                                    <option value="{{ $country->id }}" @if (isset($profile->foreign_country) && $country->id == $profile->foreign_country) {{ 'selected' }} @endif>{{ $country->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 foreign_state_{{ $pid }}">
                                            <div class="form-group">
                                                <label>State <span class="required-sign">*</span></label>
                                                <select class="form-control foreign_state" id="foreign_state_{{ $pid }}" name="foreign_state_{{ $pid }}" @if ($$step == 'completed') {{'readonly=true'}} @endif>
                                                    <option value="" disabled selected>Select State</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 foreign_pincode_{{ $pid }}">
                                            <div class="form-group">
                                                <label>Pincode <span class="required-sign">*</span></label>
                                                <input type="text" class="form-control foreign_pincode" placeholder="Enter Pincode" id="foreign_pincode_{{ $pid }}" name="foreign_pincode_{{ $pid }}" value="{{ @$profile->foreign_pincode }}" @if ($$step == 'completed') {{'readonly=true'}} @endif>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    <div class="row">
                                        @if(isset($profile->relation) && $profile->relation == 'primary' && $profile->account_type == 1 && $profile->tax_status != 'On behalf of minor')
                                        <div class="col-sm-12 is_address_same_all_{{ $pid }}">
                                            <div class="form-group custom-checkbox">
                                                <input type="checkbox" id="is_address_same_all_{{ $pid }}" name="is_address_same_all_{{ $pid }}" class="is_address_same_all" value="{{ @$profile->is_address_same_all }}" @if(isset($profile->is_address_same_all) && $profile->is_address_same_all == '1') {{ 'checked' }} @endif>
                                                <label for="is_address_same_all_{{ $pid }}">Address same for all members</label>
                                            </div>
                                        </div>
                                        @endif
                                        @if($profile->tax_status == 'On behalf of minor' && !empty($profile->client_guardian_id))
                                        <div class="col-sm-12 is_guardian_address_{{ $pid }}">
                                            <div class="form-group custom-checkbox">
                                                <input type="checkbox" id="is_guardian_address_{{ $pid }}" name="is_guardian_address_{{ $pid }}" class="is_guardian_address" value="{{ @$profile->is_guardian_address }}" @if(isset($profile->is_guardian_address) && $profile->is_address_same_all == '1') {{ 'checked' }} @endif>
                                                <label for="is_guardian_address_{{ $pid }}">Use guardian address</label>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                    <!--Error Message-->
                                    @if(isset($profile->vrejectionremarks) && !empty($profile->vrejectionremarks))
                                    @php
                                        $cremark = 0;
                                        foreach($profile->vrejectionremarks as $profileremark)
                                        {
                                            if($profileremark->type == 'communication')
                                            {
                                                $cremark++;
                                            }
                                        }
                                    @endphp
                                    @if($cremark > 0)
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card small-card option-2 mb-4">
                                                <div class="card-header">
                                                    <h6 class="card-title">Rejected Reason</h6>
                                                </div>
                                                <div class="card-body">
                                                    <div class="transaction-wrapper trade-status">
                                                        @foreach ($profile->vrejectionremarks as $profile_remark)
                                                        @if($profile_remark->type == 'communication')
                                                        <div class="transaction-steps regected">
                                                            <div class="trade-title mb-1">
                                                                <h4 class="mb-0">{{$profile_remark->remarks}}</h4>
                                                                <div class="info">
                                                                    <span>{{ Carbon\Carbon::parse($profile_remark->created_at)->format('h:i:s A') }}</span>
                                                                    <span>{{ Carbon\Carbon::parse($profile_remark->created_at)->format('l, jS F Y') }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @endif
                                </div>
                                <div class="form-footer">
                                    <button type="button" class="proceed btn btn-primary btn-lg">Proceed</button>
                                </div>
                            </div>
                        </section>
                        @php

                            $i++;
                            $b_count = 'bank_count_'.$pid;
                            $profile_bank_count = $profile->$b_count;
                            $bank_count= (isset($profile_bank_count) && $profile_bank_count > 0) ? $profile_bank_count + 1 : 1;
                            $step = 'step'.$i;
                            if($profile->tax_status == 'NRI' || $profile->tax_status == 'NRE' || $profile->tax_status == 'NRO')
                            $total_bank_count = 2;
                            else if($profile->tax_status == 'On behalf of minor' || $profile->tax_status == 'NRI - Minor')
                            $total_bank_count = 1;
                            else
                            $total_bank_count = 5;

                        @endphp
                        <section class="trial {{ $$step }} @if($i == $c){{'active'}}@endif edit_bank_detail" id="bank-details_{{$pid}}" data-step="{{ $i }}" data-bankcount="{{ $bank_count }}" data-pid="{{ $pid }}" autocomplete="off">
                            <input type="hidden" name="is_bank_{{$pid}}" id="is_bank_{{$pid}}" value="{{ @$profile->is_bank }}">
                            <input type="hidden" name="bank_count_{{$pid}}" id="bank_count_{{$pid}}" value="{{ $bank_count }}">
                            <div class="form-inner-section">
                                <div class="form-header">
                                    <h3 class="card-title"><i class="icon-left-arrow back-btn"></i> {{ $profile->name }} - Bank Details
                                        @if ($$step == 'completed' && $details == 0)
                                            <span class="edit-now float-right mt-1">Edit</span>
                                        @endif
                                    </h3>
                                </div>
                                <div class="form-content">

                                    <div class="col-12 bank_detail_{{$pid}}" id="bank_detail_{{$pid}}">
                                        <div class="form-sections mb-0">
                                            <ul class="nav nav-tabs banks-tab" id="bank-generation_{{$pid}}"
                                                    role="tablist">
                                                @if(isset($profile_bank_count) && $profile_bank_count <= 5)
                                                    @foreach ($profile->banks as $bank)
                                                    @php
                                                        $bank_atype = $bank->account_type;
                                                        $bank_account_type = '';
                                                        switch ($bank_atype) {
                                                            case "Saving":
                                                                $bank_account_type = 'SB';
                                                                break;
                                                            case "Non-resident external":
                                                                $bank_account_type = 'NRE';
                                                                break;
                                                            case "Non-resident ordinary":
                                                                $bank_account_type = 'NRO';
                                                                break;
                                                            case "Current":
                                                                $bank_account_type = 'CB';
                                                                break;
                                                            default:
                                                                $bank_account_type = $bank_atype;
                                                            }
                                                    @endphp
                                                        <li class="nav-item add-bank-item mb-4" id="bank-item_{{$pid}}_{{$bank->sr_no}}" role="presentation" data-count="{{$bank->sr_no}}">
                                                            <a class="nav-link add-bank bank_added @if($bank->sr_no == 1) {{'active'}} @endif" id="add-bank-tab-{{$pid}}_{{$bank->sr_no}}" data-pid="{{ $pid }}" data-bank_count="{{ $bank->sr_no }}"
                                                                data-toggle="tab" href="#addbank_{{$pid}}_{{$bank->sr_no}}" role="tab"
                                                                aria-selected="true">{{ $bank->bank_name }} - {{$bank_account_type}}</a>
                                                        </li>
                                                    @endforeach
                                                @endif
                                                @if($bank_count <= $total_bank_count)
                                                <li class="nav-item add-bank-item mb-4" id="bank-item_{{$pid}}_{{$bank_count}}" role="presentation" data-count="{{$bank_count}}">
                                                    <a class="nav-link add-bank @if($profile->is_bank == 0) {{ 'active description' }} @endif" id="add-bank-tab-{{$pid}}_{{$bank_count}}" data-pid="{{ $pid }}" data-bank_count="{{ $bank_count }}"
                                                        data-toggle="tab" href="#addbank_{{$pid}}_{{$bank_count}}" role="tab"
                                                        aria-selected="true">Add Bank</a>
                                                </li>
                                                @endif
                                            </ul>
                                            <div class="tab-content" id="bank-tab_{{$pid}}">
                                                @if(isset($profile_bank_count) && $profile_bank_count <= 5)
                                                    @foreach ($profile->banks as $bank)
                                                    <input type="hidden" class="bank-bankid" name="bank-bankid_{{$pid}}_{{$bank->sr_no}}" id="bank-bankid_{{$pid}}_{{$bank->sr_no}}" value="{{ $bank->id }}">
                                                    <input type="hidden" class="bank-is_default" name="bank-is_default_{{$pid}}_{{$bank->sr_no}}" id="bank-is_default_{{$pid}}_{{$bank->sr_no}}" value="{{ $bank->is_default }}">
                                                    <input type="hidden" class="bank-is_active" name="bank-is_active_{{$pid}}_{{$bank->sr_no}}" id="bank-is_active_{{$pid}}_{{$bank->sr_no}}" value="{{ $bank->is_active }}">

                                                    <div class="tab-pane fade show bank_added_{{$pid}} @if($bank->sr_no == 1) {{'active'}} @endif" id="addbank_{{$pid}}_{{$bank->sr_no}}" role="tabpanel" aria-labelledby="add-bank-tab-{{$pid}}_{{$bank->sr_no}}" data-active="{{ $bank->is_active }}">
                                                        @if(isset($bank->is_active) && $bank->is_active == 0)
                                                        <p class="_{{$pid}}_{{$bank->sr_no}}">Note::Only Superadmin can have access to activate it again</p>
                                                        @endif
                                                        <div class="addBankTab_{{$pid}}_{{$bank->sr_no}} row">
                                                            <div class="col-sm-3 bank-ifsc_no_{{ $pid }}_{{$bank->sr_no}}">
                                                                <div class="form-group">
                                                                <label>IFSC Code</label>
                                                                    <div class="input-group ">
                                                                        <input type="text" class="form-control ifsc_no" placeholder="Enter IFSC Code" aria-label="table-search-{{ $pid }}_{{$bank->sr_no}}" id="bank-ifsc_no_{{ $pid }}_{{$bank->sr_no}}" name="bank-ifsc_no_{{ $pid }}_{{$bank->sr_no}}" aria-describedby="table-search-{{ $pid }}_{{$bank->sr_no}}" value="{{ $bank->ifsc_no }}" readonly="true">

                                                                        <div class="input-group-append">
                                                                            <span class="input-group-text ifsc_search" id="table-search_{{ $pid }}_{{$bank->sr_no}}">
                                                                                <svg width="24" height="24" viewBox="0 0 24 24">
                                                                                    <use xlink:href="#search" />
                                                                                </svg>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-3 bank-bank_name_{{ $pid }}_{{$bank->sr_no}}">
                                                                <div class="form-group">
                                                                    <label>Bank Name</label>
                                                                    <input type="text" class="form-control bank_name" placeholder="Enter Bank Name" id="bank-bank_name_{{ $pid }}_{{$bank->sr_no}}" name="bank-bank_name_{{ $pid }}_{{$bank->sr_no}}" value="{{ $bank->bank_name }}" readonly="true">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-3 bank-branch_name_{{ $pid }}_{{$bank->sr_no}}">
                                                                <div class="form-group">
                                                                    <label>Bank Branch</label>
                                                                    <input type="text" class="form-control branch_name" placeholder="Enter Bank Branch" id="bank-branch_name_{{ $pid }}_{{$bank->sr_no}}" name="bank-branch_name_{{ $pid }}_{{$bank->sr_no}}" value="{{ $bank->branch_name }}" readonly="true">
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-3 bank-micr_{{ $pid }}_{{$bank->sr_no}}">
                                                                <div class="form-group">
                                                                    <label>MICR</label>
                                                                    <input type="text" class="form-control micr" placeholder="Enter MICR" id="bank-micr_{{ $pid }}_{{$bank->sr_no}}" name="bank-micr_{{ $pid }}_{{$bank->sr_no}}" value="{{ $bank->micr }}" readonly='true'>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-3 bank-account_type_{{ $pid }}_{{$bank->sr_no}}">
                                                                <div class="form-group">
                                                                    <label>Account type</label>
                                                                    <select class="form-control account_type" id="bank-account_type_{{ $pid }}_{{$bank->sr_no}}" name="bank-account_type_{{ $pid }}_{{$bank->sr_no}}"  readonly='true'>
                                                                        <option value="">Select Account type</option>
                                                                        @if(isset($profile->tax_status) && !(in_array($profile->tax_status, ['NRI', 'NRI - Minor', 'NRE', 'NRO', 'NRI Child'])))
                                                                        <option value="Saving" @if(isset($bank->account_type) && $bank->account_type == 'Saving') {{ 'Selected' }} @endif>Saving</option>
                                                                        <option value="Current" @if(isset($bank->account_type) && $bank->account_type == 'Current') {{ 'Selected' }} @endif>Current</option>
                                                                        @else
                                                                        <option value="Non-resident ordinary" @if(isset($bank->account_type) && $bank->account_type == 'Non-resident ordinary') {{ 'Selected' }} @endif>Non-resident ordinary</option>
                                                                        <option value="Non-resident external" @if(isset($bank->account_type) && $bank->account_type == 'Non-resident external') {{ 'Selected' }} @endif>Non-resident external</option>
                                                                        @endif
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-3 bank-account_no_{{ $pid }}_{{$bank->sr_no}}">
                                                                <div class="form-group">
                                                                    <label>Account Number</label>
                                                                    <input type="text" class="form-control account_no" placeholder="Enter Account Number" id="bank-account_no_{{ $pid }}_{{$bank->sr_no}}" name="bank-account_no_{{ $pid }}_{{$bank->sr_no}}" value="{{ $bank->account_no }}" readonly='true'>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-3 bank-cheque_upload_{{ $pid }}_{{$bank->sr_no}}">
                                                                <div class="form-group">
                                                                    <label for="bank-cheque_upload_{{ $pid }}_{{$bank->sr_no}}">Proof<span class="required-sign">*</span></label>
                                                                    <label for="bank-cheque_upload_{{ $pid }}_{{$bank->sr_no}}" class="btn input-btn w-100" readonly="true">

                                                                        <svg width="24" height="24" viewBox="0 0 24 24">
                                                                            <use xlink:href="#upload" />
                                                                        </svg>
                                                                        <input id="bank-cheque_upload_{{ $pid }}_{{$bank->sr_no}}" name="bank-cheque_upload_{{ $pid }}_{{$bank->sr_no}}" class="cheque_upload" type="file" />
                                                                        <div class="value-wrap">
                                                                            <span class="default-text">Update</span>
                                                                            <span class="value"></span>
                                                                        </div>
                                                                    </label>
                                                                    @if (isset($bank->cheque_upload) && !empty($bank->cheque_upload))
                                                                    <label class="w-100">
                                                                        <span class="text-lowercase font-italic"><a href="javascript:showImage('{{ $bank->cheque_upload }}')" data-src="{{ $bank->cheque_upload }}">Preview</a></span>
                                                                    </label>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <label></label>
                                                                <div class="form-group mt-2px">
                                                                    @if (isset($bank->is_active) && $bank->is_active == 1)
                                                                    <button type="button" id="bank_created_{{ $pid }}_{{$bank->sr_no}}" class="edit-bank-button bank_added btn btn-primary btn-width-sm w-75 mr-1" data-pid="{{ $pid }}" data-bank_count="{{ $bank->sr_no }}">Edit</button>
                                                                    <button type="button" id="bank_delete_{{ $pid }}_{{$bank->sr_no}}" class="delete-bank-button btn btn-danger btn-width-sm w-20" data-pid="{{ $pid }}" data-bank_count="{{ $bank->sr_no }}" @if($bank->is_default == 1) {{'disabled'}} @endif>X</button>
                                                                    @else
                                                                    <button type="button" id="bank_created_{{ $pid }}_{{$bank->sr_no}}" class="bank_added btn btn-primary btn-width-sm w-100 mr-1" data-pid="{{ $pid }}" data-bank_count="{{ $bank->sr_no }}" disabled>Inactive</button>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                @endif
                                                @if($bank_count <= $total_bank_count)
                                                <input type="hidden" class="bank-bankid" name="bank-bankid_{{$pid}}_{{$bank_count}}" id="bank-bankid_{{$pid}}_{{$bank_count}}" value="0">
                                                <input type="hidden" class="bank-is_default" name="bank-is_default_{{$pid}}_{{$bank_count}}" id="bank-is_default_{{$pid}}_{{$bank_count}}" value="0">
                                                <input type="hidden" class="bank-is_active" name="bank-is_active_{{$pid}}_{{$bank_count}}" id="bank-is_active_{{$pid}}_{{$bank_count}}" value="1">
                                                <div class="tab-pane fade show @if($profile->is_bank == 0) {{ 'active' }} @endif" id="addbank_{{$pid}}_{{$bank_count}}" role="tabpanel" aria-labelledby="add-bank-tab-{{$pid}}_{{$bank_count}}">
                                                    <div class="addBankTab_{{$pid}}_{{$bank_count}} row">
                                                        <div class="col-sm-3 bank-ifsc_no_{{ $pid }}_{{$bank_count}}">
                                                            <div class="form-group">
                                                            <label>IFSC Code</label>
                                                                <div class="input-group ">
                                                                    <input type="text" class="form-control ifsc_no" placeholder="Enter IFSC Code" aria-label="table-search-{{ $pid }}_{{$bank_count}}" id="bank-ifsc_no_{{ $pid }}_{{$bank_count}}" name="bank-ifsc_no_{{ $pid }}_{{$bank_count}}" aria-describedby="table-search-{{ $pid }}_{{$bank_count}}">
                                                                    <div class="input-group-append">
                                                                        <span class="input-group-text ifsc_search" id="table-search_{{ $pid }}_{{$bank_count}}">
                                                                            <svg width="24" height="24" viewBox="0 0 24 24">
                                                                                <use xlink:href="#search" />
                                                                            </svg>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3 bank-bank_name_{{ $pid }}_{{$bank_count}}">
                                                            <div class="form-group">
                                                                <label>Bank Name</label>
                                                                <input type="text" class="form-control bank_name" placeholder="Enter Bank Name" id="bank-bank_name_{{ $pid }}_{{$bank_count}}" name="bank-bank_name_{{ $pid }}_{{$bank_count}}">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3 bank-branch_name_{{ $pid }}_{{$bank_count}}">
                                                            <div class="form-group">
                                                                <label>Bank Branch</label>
                                                                <input type="text" class="form-control branch_name" placeholder="Enter Bank Branch" id="bank-branch_name_{{ $pid }}_{{$bank_count}}" name="bank-branch_name_{{ $pid }}_{{$bank_count}}">
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-3 bank-micr_{{ $pid }}_{{$bank_count}}">
                                                            <div class="form-group">
                                                                <label>MICR</label>
                                                                <input type="text" class="form-control micr" placeholder="Enter MICR" id="bank-micr_{{ $pid }}_{{$bank_count}}" name="bank-micr_{{ $pid }}_{{$bank_count}}">
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-3 bank-account_type_{{ $pid }}_{{$bank_count}}">
                                                            <div class="form-group">
                                                                <label>Account type</label>
                                                                <select class="form-control account_type" id="bank-account_type_{{ $pid }}_{{$bank_count}}" name="bank-account_type_{{ $pid }}_{{$bank_count}}">
                                                                    <option value="" disabled selected>Select Account type</option>
                                                                    @if(isset($profile->tax_status) && !(in_array($profile->tax_status, ['NRI', 'NRI - Minor', 'NRE', 'NRO', 'NRI Child'])))
                                                                    <option value="Saving">Saving</option>
                                                                    <option value="Current">Current</option>
                                                                    @else
                                                                    <option value="Non-resident ordinary">Non-resident ordinary</option>
                                                                    <option value="Non-resident external">Non-resident external</option>
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-3 bank-account_no_{{ $pid }}_{{$bank_count}}">
                                                            <div class="form-group">
                                                                <label>Account Number</label>
                                                                <input type="text" class="form-control account_no" placeholder="Enter Account Number" id="bank-account_no_{{ $pid }}_{{$bank_count}}" name="bank-account_no_{{ $pid }}_{{$bank_count}}">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3 bank-cheque_upload_{{ $pid }}_{{$bank_count}}">
                                                            <div class="form-group">
                                                                <label for="bank-cheque_upload_{{ $pid }}_{{$bank_count}}">Proof<span class="required-sign">*</span></label>
                                                                <label for="bank-cheque_upload_{{ $pid }}_{{$bank_count}}" class="btn input-btn w-100">

                                                                    <svg width="24" height="24" viewBox="0 0 24 24">
                                                                        <use xlink:href="#upload" />
                                                                    </svg>
                                                                    <input id="bank-cheque_upload_{{ $pid }}_{{$bank_count}}" name="bank-cheque_upload_{{ $pid }}_{{$bank_count}}" class="cheque_upload" type="file" />
                                                                    <div class="value-wrap">
                                                                        <span class="default-text">Upload</span>
                                                                        <span class="value"></span>
                                                                    </div>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <label></label>
                                                            <div class="form-group mt-2px">
                                                                <button type="button" id="bank_created_{{ $pid }}_{{$bank_count}}" class="add-bank-button btn btn-primary btn-width-sm w-75 mr-1" data-pid="{{ $pid }}" data-bank_count="{{ $bank_count }}">Add</button>
                                                                <button type="button" id="bank_clear_{{ $pid }}_{{$bank_count}}" class="btn btn-danger btn-width-sm w-20 bank_clear" data-pid="{{ $pid }}" data-bank_count="{{ $bank_count }}">X</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Error Message -->
                                    @if(isset($profile->vrejectionremarks) && !empty($profile->vrejectionremarks))
                                    @php
                                        $bremark = 0;
                                        foreach($profile->vrejectionremarks as $profileremark)
                                        {
                                            if($profileremark->type == 'bankid')
                                            {
                                                $bremark++;
                                            }
                                        }
                                    @endphp
                                    @if($bremark > 0)
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card small-card option-2 mb-4">
                                                <div class="card-header">
                                                    <h6 class="card-title">Rejected Reason</h6>
                                                </div>
                                                <div class="card-body">
                                                    <div class="transaction-wrapper trade-status">
                                                        @foreach ($profile->vrejectionremarks as $profile_remark)
                                                        @if($profile_remark->type == 'bankid')
                                                        <div class="transaction-steps regected">
                                                            <div class="trade-title mb-1">
                                                                <h4 class="mb-0">{{$profile_remark->remarks}}</h4>
                                                                <div class="info">
                                                                    <span>{{ Carbon\Carbon::parse($profile_remark->created_at)->format('h:i:s A') }}</span>
                                                                    <span>{{ Carbon\Carbon::parse($profile_remark->created_at)->format('l, jS F Y') }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @endif
                                </div>
                                <div class="form-footer">
                                    <button type="button" class="proceed btn btn-primary btn-lg">Proceed</button>
                                </div>
                            </div>
                        </section>
                        @php $i++;@endphp
                    @endforeach

                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('modal')

<!-- Modal -->

<div class="modal fade" id="uploadModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <!-- modal-lg-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">View Proof</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row form-sections">
                    <div class="col-12 d-flex justify-content-center" id="show_doc">
                        {{-- <img src="" id="show_img" alt="image" class="img-fluid"> --}}
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="" id="download_img" class="btn btn-primary col-sm-3" download target="_blank">Download</a>
            </div>
        </div>
    </div>
</div>

<!-- Modal HTML -->
<div id="deleteModal" class="modal fade">
	<div class="modal-dialog modal-confirm">
		<div class="modal-content">
			<div class="modal-header flex-column">
				<div class="icon-box">
					<i class="material-icons">&#xE5CD;</i>
				</div>
				<h4 class="modal-title w-100">Are you sure?</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">
				<p>Do you really want to inative these bank details?</p>
                <p>Note: For activation required Superadmin Approval</p>
                <input type="hidden" name="delete_pid" value="">
                <input type="hidden" name="delete_bank_count" value="">
			</div>
			<div class="modal-footer justify-content-center">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
				<button type="button" class="delete_bank_confirmed btn btn-danger">Delete</button>
			</div>
		</div>
	</div>
</div>
@endsection
@section('script')
<script type="text/javascript" src="{{ asset('assets/javascript/colorpicker.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/javascript/client.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/javascript/kycinfo.js') }}"></script>

@endsection
