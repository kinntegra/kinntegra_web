@extends('layouts.external')

@section('style')

<style>
div.error{
    font-size: 80%;
    font-weight: 400;
    color: #ce4b4b;
    position: absolute;
    top: 100%;
    left: 0;
    width: 100%;
    text-transform: capitalize;
}
    .normal-table tbody tr td{
        padding: 0.75rem;
    }
    .aprofile.invalid td:nth-child(1) {
    color:#dc3a3a;}

    .aprofile.invalid td.select.invalid .select2-selection--single {
    border: 1px solid #c44d4d !important;
    }
td label.error {
    font-size: 80%;
    font-weight: 400;
    color: #dc3a3a;
    position: absolute;
    /* top: 100%;
    left: 0;
    width: 100%; */
    text-transform: capitalize;
}
/*Select2 ReadOnly Start*/
        select[readonly].select2-hidden-accessible+.select2-container {
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

        .readonly {
            pointer-events: none;
        }
        .bb-0{
            border-bottom : 0 !important;
        }
    /* #company_detail .remove-company .icon-close{
        color: #ffffff;
    } */
</style>

@endsection


@section('content')
<div class="container-fluid">

    <div class="card w-100">
        <div class="card-body p-0">
            <div class="row">
                <div class="col-xl-3 col-lg-4 col-md-4">
                    <div class="custom-wrapper">

                        {{-- <div class="col-12 d-flex center">

                            <img src="http://127.0.0.1:8001/assets/logo/logo-green.svg" width="30%">
                            <h3 style="margin-top: 7px;font-size: 25px;margin-left:10px;">Kinntegra</h3>

                     </div> --}}
                     <h3 style="margin-top: 7px;font-size: 25px;margin-left:10px;">Kinntegra</h3>
                        <div class="form-percentage">
                            <svg viewBox="0 0 36 36" class="circular-chart orange">
                                <path class="circle-bg" d="M18 2.0845
                                    a 15.9155 15.9155 0 0 1 0 31.831
                                    a 15.9155 15.9155 0 0 1 0 -31.831" />
                                <path class="circle" stroke-dasharray="00, 100" d="M18 2.0845
                                    a 15.9155 15.9155 0 0 1 0 31.831
                                    a 15.9155 15.9155 0 0 1 0 -31.831" />
                                <text x="18" y="20.35" class="percentage">0%</text>
                            </svg>
                        </div>
                        <ul class="form-lists">
                            @foreach ($client->accounts as $headaccount)
                                @php
                                    //dd($headaccount);
                                    $name = '';
                                    $accounttype = ['JOINT','ANYONE OR SURVIVOR'];
                                    if (in_array($headaccount->account_type, $accounttype))
                                    {

                                        if(!empty($headaccount->first_holder_name)){
                                            $name .=  $headaccount->first_holder_name;
                                        }
                                        if(!empty($headaccount->second_holder_name)){
                                            $name .= ' + ';
                                            $name .=  $headaccount->second_holder_name;
                                        }
                                        if(!empty($headaccount->third_holder_name)){
                                            $name .= ' + ';
                                            $name .=  $headaccount->third_holder_name;
                                        }
                                    }else{
                                        $name .=  $headaccount->first_holder_name;
                                    }
                                @endphp
                                <li data-form="account_{{$headaccount->id}}" class="active">
                                    <div class="indicator">
                                        <div class="check"></div>
                                    </div>
                                    {{ $name }}
                                </li>
                            @endforeach

                        </ul>
                    </div>
                </div>

                <form class="col-lg-8 col-xl-9 step-forms col-md-8 pl-0" id="client_external_account_approval" method="POST" action="{{ route('postverify',['client_id' => $client_id,'profile_id' => $profile_id]) }}">
                    @csrf
                    <input type="hidden" name="id" id="client_id" value="{{ @$client->id }}">
                    <input type="hidden" name="client_id" id="client_id" value="{{ @$client_id }}">
                    <input type="hidden" name="profile_id" id="profile_id" value="{{ @$profile_id }}">
                    @php
                        $i = 0;
                        $count = count($client->accounts);
                    @endphp
                    <input type="hidden" name="account_count" id="account_count" value="{{ $count }}">
                    @foreach ($client->accounts as $bodyaccount)
                        @php
                            $i++;
                            $name = '';
                            $accounttype = ['JOINT','ANYONE OR SURVIVOR'];
                            if (in_array($bodyaccount->account_type, $accounttype))
                            {

                                if(!empty($bodyaccount->first_holder_name)){
                                    $name .=  $bodyaccount->first_holder_name;
                                }
                                if(!empty($bodyaccount->second_holder_name)){
                                    $name .= ' + ';
                                    $name .=  $bodyaccount->second_holder_name;
                                }
                                if(!empty($bodyaccount->third_holder_name)){
                                    $name .= ' + ';
                                    $name .=  $bodyaccount->third_holder_name;
                                }
                            }else{
                                $name .=  $bodyaccount->first_holder_name;
                            }
                        @endphp
                        <section class="trial @if($i == 1) {{'active'}} @endif" id="account_{{$bodyaccount->id}}" data-step="{{ $i }}" autocomplete="off">
                            <div class="form-inner-section">
                                <div class="form-header">
                                    <h3 class="card-title">@if($i > 1)<i class="icon-left-arrow back-btn"></i> @endif{{ $name }}</h3>
                                </div>
                                <div class="form-content">
                                    <div class="row flex-column">
                                        <div class="col-12">
                                            <div class="form-sections">
                                                <h4 class="form-section-title text-uppercase">Account Details</h4>
                                                <div class="row">

                                                    @if($bodyaccount->first_holder_name)
                                                    <div class="col-sm-4">
                                                        <div class="form-group mb-3 mb-sm-0">
                                                            <label>First Holder</label>
                                                            <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $bodyaccount->first_holder_name }}">
                                                            <input type="hidden" name="account-first_holder_{{$bodyaccount->sr_no}}" value="{{ $bodyaccount->first_holder }}">
                                                        </div>
                                                    </div>
                                                    @endif
                                                    @if($bodyaccount->second_holder_name)
                                                    <div class="col-sm-4">
                                                        <div class="form-group mb-3 mb-sm-0">
                                                            <label>Second Holder</label>
                                                            <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $bodyaccount->second_holder_name }}">
                                                            <input type="hidden" name="account-second_holder_{{$bodyaccount->sr_no}}" value="{{ $bodyaccount->second_holder }}">
                                                        </div>
                                                    </div>
                                                    @endif
                                                    @if($bodyaccount->third_holder_name)
                                                    <div class="col-sm-4">
                                                        <div class="form-group mb-3 mb-sm-0">
                                                            <label>Third Holder</label>
                                                            <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $bodyaccount->third_holder_name }}">
                                                            <input type="hidden" name="account-third_holder_{{$bodyaccount->sr_no}}"  value="{{ $bodyaccount->third_holder }}">
                                                        </div>
                                                    </div>
                                                    @endif

                                                </div>
                                                <div class="row mt-3 mb-0">
                                                    <div class="col-sm-4">
                                                        <div class="form-group mb-3 mb-sm-0">
                                                            <label>Account type*</label>
                                                            <input type="text"  readonly class="form-control-plaintext font-bold" value="{{$bodyaccount->account_type}}">
                                                            <input type="hidden" name="account-account_type_{{$bodyaccount->sr_no}}"  value="{{ $bodyaccount->account_type }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr/>
                                                @if(!empty($bodyaccount->first_holder_profile))
                                                @php
                                                    //dd($bodyaccount->first_holder_profile);
                                                @endphp
                                                <!--Profile Details-->
                                                <h4 class="form-section-title text-uppercase">First Holder :: {{ $bodyaccount->first_holder_profile->name }}</h4>
                                                <div class="row">
                                                    <div class="col-sm-12 ">
                                                        <div class="form-sections mt-2 mb-0">
                                                            <h4 class="form-section-title text-uppercase">Profile DETAILS</h4>
                                                            @if($bodyaccount->first_holder_profile->client_guardian_id != null)
                                                            <div class="row mt-3 mb-0">
                                                                <div class="col-sm-4">
                                                                    <div class="form-group mb-3 mb-sm-0">
                                                                        <label>Guardian Name</label>
                                                                        <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $bodyaccount->first_holder_profile->client_guardian_name }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4 birth_upload">
                                                                    <div class="form-group  mb-3 mb-sm-0">
                                                                        <label for="birth_upload" class="w-100">Birth Certificate</label>
                                                                        @if(isset($bodyaccount->first_holder_profile->birth_upload) && !empty($bodyaccount->first_holder_profile->birth_upload))
                                                                            <button type="button" class="btn btn-primary btn-sm form-control w-50" onclick="showImage('{{ @$bodyaccount->first_holder_profile->birth_upload }}')">View</button>
                                                                        @else
                                                                            <button type="button" class="btn btn-danger btn-sm form-control w-50">N/A</button>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @endif
                                                            <div class="row mt-3 mb-0">
                                                                <div class="col-sm-4">
                                                                    <div class="form-group mb-3 mb-sm-0">
                                                                        <label>Pancard No</label>
                                                                        <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $bodyaccount->first_holder_profile->pan }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4 photo_upload">
                                                                    <div class="form-group  mb-3 mb-sm-0">
                                                                        <label for="photo_upload" class="w-100">Pan Copy</label>
                                                                        @if(isset($bodyaccount->first_holder_profile->pan_upload) && !empty($bodyaccount->first_holder_profile->pan_upload))
                                                                            <button type="button" class="btn btn-primary btn-sm form-control w-50" onclick="showImage('{{ @$bodyaccount->first_holder_profile->pan_upload }}')">View</button>
                                                                        @else
                                                                            <button type="button" class="btn btn-danger btn-sm form-control w-50">N/A</button>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mt-3 mb-0">
                                                                <div class="col-sm-4">
                                                                    <div class="form-group mb-3 mb-sm-0">
                                                                        <label>KYC VERIFIED STATUS</label>
                                                                        <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $bodyaccount->first_holder_profile->kyc_status }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4 photo_upload">
                                                                    <div class="form-group  mb-3 mb-sm-0">
                                                                        <label for="photo_upload" class="w-100">KYC Copy</label>
                                                                        @if(isset($bodyaccount->first_holder_profile->kyc_upload) && !empty($bodyaccount->first_holder_profile->kyc_upload))
                                                                            <button type="button" class="btn btn-primary btn-sm form-control w-50" onclick="showImage('{{ @$bodyaccount->first_holder_profile->kyc_upload }}')">View</button>
                                                                        @else
                                                                            <button type="button" class="btn btn-danger btn-sm form-control w-50">N/A</button>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mt-3 mb-0">
                                                                <div class="col-sm-4">
                                                                    <div
                                                                        class="form-group mb-3 mb-sm-0">
                                                                        <label>CKYC NO</label>
                                                                        <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $bodyaccount->first_holder_profile->ckyc_no }}">

                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <div class="form-group mb-3 mb-sm-0">
                                                                        <label>Gender</label>
                                                                        <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $bodyaccount->first_holder_profile->gender }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <div
                                                                        class="form-group mb-3 mb-sm-0">
                                                                        <label>Aadhar No</label>
                                                                        <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $bodyaccount->first_holder_profile->aadhar }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mt-3 mb-0">
                                                                <div class="col-sm-4">
                                                                    <div
                                                                        class="form-group mb-3 mb-sm-0">
                                                                        <label>Country Code</label>
                                                                        <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $bodyaccount->first_holder_profile->country_code }}">

                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <div class="form-group mb-3 mb-sm-0">
                                                                        <label>Mobile Number</label>
                                                                        <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $bodyaccount->first_holder_profile->mobile }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <div
                                                                        class="form-group mb-3 mb-sm-0">
                                                                        <label>Email</label>
                                                                        <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $bodyaccount->first_holder_profile->email }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mt-3 mb-0">
                                                                <div class="col-sm-4">
                                                                    <div
                                                                        class="form-group mb-3 mb-sm-0">
                                                                        <label>Place of Birth</label>
                                                                        <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $bodyaccount->first_holder_profile->birth_incorp_place }}">

                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <div class="form-group mb-3 mb-sm-0">
                                                                        <label>Country Of Birth</label>
                                                                        <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $bodyaccount->first_holder_profile->birth_incorp_country }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <div
                                                                        class="form-group mb-3 mb-sm-0">
                                                                        <label>Tax Status</label>
                                                                        <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $bodyaccount->first_holder_profile->tax_status }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mt-3 mb-0">
                                                                <div class="col-sm-4">
                                                                    <div
                                                                        class="form-group mb-3 mb-sm-0">
                                                                        <label>Occupation</label>
                                                                        <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $bodyaccount->first_holder_profile->occupation }}">

                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <div class="form-group mb-3 mb-sm-0">
                                                                        <label>Employer Name</label>
                                                                        <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $bodyaccount->first_holder_profile->employer_name }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <div
                                                                        class="form-group mb-3 mb-sm-0">
                                                                        <label>Gross Annual Income</label>
                                                                        <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $bodyaccount->first_holder_profile->gross_annual_income }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mt-3 mb-0">
                                                                <div class="col-sm-4">
                                                                    <div
                                                                        class="form-group mb-3 mb-sm-0">
                                                                        <label>Net Worth</label>
                                                                        <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $bodyaccount->first_holder_profile->net_worth }}">

                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <div class="form-group mb-3 mb-sm-0">
                                                                        <label>Net Worth Date</label>
                                                                        <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $bodyaccount->first_holder_profile->net_worth_date }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <div
                                                                        class="form-group mb-3 mb-sm-0">
                                                                        <label>Source Of Wealth</label>
                                                                        <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $bodyaccount->first_holder_profile->wealth_source }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-12 ">
                                                        <div class="form-sections mt-2 mb-0">
                                                            <h4 class="form-section-title text-uppercase">Communication DETAILS</h4>
                                                            <div class="row mt-3 mb-0">
                                                                <div class="col-sm-4">
                                                                    <div class="form-group mb-3 mb-sm-0">
                                                                        <label>Address Type</label>
                                                                        <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $bodyaccount->first_holder_profile->address->addresstype }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <div class="form-group mb-3 mb-sm-0">
                                                                        <label>Address Line 1</label>
                                                                        <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $bodyaccount->first_holder_profile->address->address1 }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4 address_upload">
                                                                    <div class="form-group  mb-3 mb-sm-0">
                                                                        <label for="photo_upload" class="w-100">Address Copy</label>
                                                                        @if(isset($bodyaccount->first_holder_profile->address->address_upload) && !empty($bodyaccount->first_holder_profile->address->address_upload))
                                                                            <button type="button" class="btn btn-primary btn-sm form-control w-50" onclick="showImage('{{ @$bodyaccount->first_holder_profile->address->address_upload }}')">View</button>
                                                                        @else
                                                                            <button type="button" class="btn btn-danger btn-sm form-control w-50">N/A</button>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mt-3 mb-0">
                                                                <div class="col-sm-4">
                                                                    <div class="form-group mb-3 mb-sm-0">
                                                                        <label>ADDRESS LINE 2</label>
                                                                        <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $bodyaccount->first_holder_profile->address->address2 }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <div class="form-group mb-3 mb-sm-0">
                                                                        <label>ADDRESS LINE 3</label>
                                                                        <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $bodyaccount->first_holder_profile->address->address3 }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <div class="form-group mb-3 mb-sm-0">
                                                                        <label>CITY</label>
                                                                        <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $bodyaccount->first_holder_profile->address->city }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mt-3 mb-0">
                                                                <div class="col-sm-4">
                                                                    <div
                                                                        class="form-group mb-3 mb-sm-0">
                                                                        <label>STATE</label>
                                                                        <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $bodyaccount->first_holder_profile->address->state_name }}">

                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <div class="form-group mb-3 mb-sm-0">
                                                                        <label>COUNTRY</label>
                                                                        <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $bodyaccount->first_holder_profile->address->country_name }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <div
                                                                        class="form-group mb-3 mb-sm-0">
                                                                        <label>PINCODE</label>
                                                                        <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $bodyaccount->first_holder_profile->address->pincode }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-12 ">
                                                        <div class="form-sections mt-2 mb-0">
                                                            <h4 class="form-section-title text-uppercase">Bank DETAILS</h4>
                                                            @foreach ($bodyaccount->first_holder_profile->banks as $bank)
                                                                <div class="row mt-3 mb-0">

                                                                    <div class="col-sm-4">
                                                                        <div class="form-group mb-3 mb-sm-0">
                                                                            <label>IFSC CODE @if($bodyaccount->defaultbankdata->id == $bank->id){{'(Default Bank)'}}@endif</label>
                                                                            <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $bank->ifsc_no }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-group mb-3 mb-sm-0">
                                                                            <label>Bank Name</label>
                                                                            <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $bank->bank_name }}">

                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-group mb-3 mb-sm-0">
                                                                            <label>Bank Branch</label>
                                                                            <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $bank->branch_name }}-{{ $bank->micr }}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row mt-3 mb-0">
                                                                    <div class="col-sm-4">
                                                                        <div class="form-group mb-3 mb-sm-0">
                                                                            <label>ACCOUNT TYPE</label>
                                                                            <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $bank->account_type }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-group mb-3 mb-sm-0">
                                                                            <label>ACCOUNT NUMBER</label>
                                                                            <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $bank->account_no }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4 address_upload">
                                                                        <div class="form-group  mb-3 mb-sm-0">
                                                                            <label for="photo_upload" class="w-100">Address Copy</label>
                                                                            @if(isset($bank->cheque_upload) && !empty($bank->cheque_upload))
                                                                                <button type="button" class="btn btn-primary btn-sm form-control w-50" onclick="showImage('{{ @$bank->cheque_upload }}')">View</button>
                                                                            @else
                                                                                <button type="button" class="btn btn-danger btn-sm form-control w-50">N/A</button>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <hr/>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                                <!--End-->
                                                @if(!empty($bodyaccount->second_holder_profile))
                                                <!--Profile Details-->
                                                <h4 class="form-section-title text-uppercase">Second Holder :: {{ $bodyaccount->second_holder_profile->name }}</h4>
                                                <div class="row">
                                                    <div class="col-sm-12 ">
                                                        <div class="form-sections mt-2 mb-0">
                                                            <h4 class="form-section-title text-uppercase">Profile DETAILS</h4>
                                                            <div class="row mt-3 mb-0">
                                                                <div class="col-sm-4">
                                                                    <div class="form-group mb-3 mb-sm-0">
                                                                        <label>Pancard No</label>
                                                                        <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $bodyaccount->second_holder_profile->pan }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4 photo_upload">
                                                                    <div class="form-group  mb-3 mb-sm-0">
                                                                        <label for="photo_upload" class="w-100">Pan Copy</label>
                                                                        @if(isset($bodyaccount->second_holder_profile->pan_upload) && !empty($bodyaccount->second_holder_profile->pan_upload))
                                                                            <button type="button" class="btn btn-primary btn-sm form-control w-50" onclick="showImage('{{ @$bodyaccount->second_holder_profile->pan_upload }}')">View</button>
                                                                        @else
                                                                            <button type="button" class="btn btn-danger btn-sm form-control w-50">N/A</button>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mt-3 mb-0">
                                                                <div class="col-sm-4">
                                                                    <div class="form-group mb-3 mb-sm-0">
                                                                        <label>KYC VERIFIED STATUS</label>
                                                                        <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $bodyaccount->second_holder_profile->kyc_status }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4 photo_upload">
                                                                    <div class="form-group  mb-3 mb-sm-0">
                                                                        <label for="photo_upload" class="w-100">KYC Copy</label>
                                                                        @if(isset($bodyaccount->second_holder_profile->kyc_upload) && !empty($bodyaccount->second_holder_profile->kyc_upload))
                                                                            <button type="button" class="btn btn-primary btn-sm form-control w-50" onclick="showImage('{{ @$bodyaccount->second_holder_profile->kyc_upload }}')">View</button>
                                                                        @else
                                                                            <button type="button" class="btn btn-danger btn-sm form-control w-50">N/A</button>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mt-3 mb-0">
                                                                <div class="col-sm-4">
                                                                    <div
                                                                        class="form-group mb-3 mb-sm-0">
                                                                        <label>CKYC NO</label>
                                                                        <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $bodyaccount->second_holder_profile->ckyc_no }}">

                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <div class="form-group mb-3 mb-sm-0">
                                                                        <label>Gender</label>
                                                                        <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $bodyaccount->second_holder_profile->gender }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <div
                                                                        class="form-group mb-3 mb-sm-0">
                                                                        <label>Aadhar No</label>
                                                                        <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $bodyaccount->second_holder_profile->aadhar }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mt-3 mb-0">
                                                                <div class="col-sm-4">
                                                                    <div
                                                                        class="form-group mb-3 mb-sm-0">
                                                                        <label>Country Code</label>
                                                                        <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $bodyaccount->second_holder_profile->country_code }}">

                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <div class="form-group mb-3 mb-sm-0">
                                                                        <label>Mobile Number</label>
                                                                        <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $bodyaccount->second_holder_profile->mobile }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <div
                                                                        class="form-group mb-3 mb-sm-0">
                                                                        <label>Email</label>
                                                                        <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $bodyaccount->second_holder_profile->email }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mt-3 mb-0">
                                                                <div class="col-sm-4">
                                                                    <div
                                                                        class="form-group mb-3 mb-sm-0">
                                                                        <label>Place of Birth</label>
                                                                        <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $bodyaccount->second_holder_profile->birth_incorp_place }}">

                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <div class="form-group mb-3 mb-sm-0">
                                                                        <label>Country Of Birth</label>
                                                                        <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $bodyaccount->second_holder_profile->birth_incorp_country }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <div
                                                                        class="form-group mb-3 mb-sm-0">
                                                                        <label>Tax Status</label>
                                                                        <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $bodyaccount->second_holder_profile->tax_status }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mt-3 mb-0">
                                                                <div class="col-sm-4">
                                                                    <div
                                                                        class="form-group mb-3 mb-sm-0">
                                                                        <label>Occupation</label>
                                                                        <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $bodyaccount->second_holder_profile->occupation }}">

                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <div class="form-group mb-3 mb-sm-0">
                                                                        <label>Employer Name</label>
                                                                        <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $bodyaccount->second_holder_profile->employer_name }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <div
                                                                        class="form-group mb-3 mb-sm-0">
                                                                        <label>Gross Annual Income</label>
                                                                        <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $bodyaccount->second_holder_profile->gross_annual_income }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mt-3 mb-0">
                                                                <div class="col-sm-4">
                                                                    <div
                                                                        class="form-group mb-3 mb-sm-0">
                                                                        <label>Net Worth</label>
                                                                        <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $bodyaccount->second_holder_profile->net_worth }}">

                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <div class="form-group mb-3 mb-sm-0">
                                                                        <label>Net Worth Date</label>
                                                                        <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $bodyaccount->second_holder_profile->net_worth_date }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <div
                                                                        class="form-group mb-3 mb-sm-0">
                                                                        <label>Source Of Wealth</label>
                                                                        <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $bodyaccount->second_holder_profile->wealth_source }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-12 ">
                                                        <div class="form-sections mt-2 mb-0">
                                                            <h4 class="form-section-title text-uppercase">Communication DETAILS</h4>
                                                            <div class="row mt-3 mb-0">
                                                                <div class="col-sm-4">
                                                                    <div class="form-group mb-3 mb-sm-0">
                                                                        <label>Address Type</label>
                                                                        <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $bodyaccount->second_holder_profile->address->addresstype }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <div class="form-group mb-3 mb-sm-0">
                                                                        <label>Address Line 1</label>
                                                                        <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $bodyaccount->second_holder_profile->address->address1 }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4 address_upload">
                                                                    <div class="form-group  mb-3 mb-sm-0">
                                                                        <label for="photo_upload" class="w-100">Address Copy</label>
                                                                        @if(isset($bodyaccount->second_holder_profile->address->address_upload) && !empty($bodyaccount->second_holder_profile->address->address_upload))
                                                                            <button type="button" class="btn btn-primary btn-sm form-control w-50" onclick="showImage('{{ @$bodyaccount->second_holder_profile->address->address_upload }}')">View</button>
                                                                        @else
                                                                            <button type="button" class="btn btn-danger btn-sm form-control w-50">N/A</button>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mt-3 mb-0">
                                                                <div class="col-sm-4">
                                                                    <div class="form-group mb-3 mb-sm-0">
                                                                        <label>ADDRESS LINE 2</label>
                                                                        <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $bodyaccount->second_holder_profile->address->address2 }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <div class="form-group mb-3 mb-sm-0">
                                                                        <label>ADDRESS LINE 3</label>
                                                                        <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $bodyaccount->second_holder_profile->address->address3 }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <div class="form-group mb-3 mb-sm-0">
                                                                        <label>CITY</label>
                                                                        <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $bodyaccount->second_holder_profile->address->city }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mt-3 mb-0">
                                                                <div class="col-sm-4">
                                                                    <div
                                                                        class="form-group mb-3 mb-sm-0">
                                                                        <label>STATE</label>
                                                                        <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $bodyaccount->second_holder_profile->address->state_name }}">

                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <div class="form-group mb-3 mb-sm-0">
                                                                        <label>COUNTRY</label>
                                                                        <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $bodyaccount->second_holder_profile->address->country_name }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <div
                                                                        class="form-group mb-3 mb-sm-0">
                                                                        <label>PINCODE</label>
                                                                        <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $bodyaccount->second_holder_profile->address->pincode }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-12 ">
                                                        <div class="form-sections mt-2 mb-0">
                                                            <h4 class="form-section-title text-uppercase">Bank DETAILS</h4>
                                                            @foreach ($bodyaccount->second_holder_profile->banks as $bank)
                                                                <div class="row mt-3 mb-0">
                                                                    <div class="col-sm-4">
                                                                        <div class="form-group mb-3 mb-sm-0">
                                                                            <label>IFSC CODE</label>
                                                                            <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $bank->ifsc_no }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-group mb-3 mb-sm-0">
                                                                            <label>Bank Name</label>
                                                                            <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $bank->bank_name }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-group mb-3 mb-sm-0">
                                                                            <label>Bank Branch</label>
                                                                            <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $bank->branch_name }}-{{ $bank->micr }}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row mt-3 mb-0">
                                                                    <div class="col-sm-4">
                                                                        <div class="form-group mb-3 mb-sm-0">
                                                                            <label>ACCOUNT TYPE</label>
                                                                            <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $bank->account_type }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-group mb-3 mb-sm-0">
                                                                            <label>ACCOUNT NUMBER</label>
                                                                            <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $bank->account_no }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4 address_upload">
                                                                        <div class="form-group  mb-3 mb-sm-0">
                                                                            <label for="photo_upload" class="w-100">Address Copy</label>
                                                                            @if(isset($bank->cheque_upload) && !empty($bank->cheque_upload))
                                                                                <button type="button" class="btn btn-primary btn-sm form-control w-50" onclick="showImage('{{ @$bank->cheque_upload }}')">View</button>
                                                                            @else
                                                                                <button type="button" class="btn btn-danger btn-sm form-control w-50">N/A</button>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <hr/>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                                <!-- End -->
                                                @if(!empty($bodyaccount->third_holder_profile))
                                                <!--Profile Details-->
                                                <h4 class="form-section-title text-uppercase">Third Holder :: {{ $bodyaccount->third_holder_profile->name }}</h4>
                                                <div class="row">
                                                    <div class="col-sm-12 ">
                                                        <div class="form-sections mt-2 mb-0">
                                                            <h4 class="form-section-title text-uppercase">Profile DETAILS</h4>
                                                            <div class="row mt-3 mb-0">
                                                                <div class="col-sm-4">
                                                                    <div class="form-group mb-3 mb-sm-0">
                                                                        <label>Pancard No</label>
                                                                        <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $bodyaccount->third_holder_profile->pan }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4 photo_upload">
                                                                    <div class="form-group  mb-3 mb-sm-0">
                                                                        <label for="photo_upload" class="w-100">Pan Copy</label>
                                                                        @if(isset($bodyaccount->third_holder_profile->pan_upload) && !empty($bodyaccount->third_holder_profile->pan_upload))
                                                                            <button type="button" class="btn btn-primary btn-sm form-control w-50" onclick="showImage('{{ @$bodyaccount->third_holder_profile->pan_upload }}')">View</button>
                                                                        @else
                                                                            <button type="button" class="btn btn-danger btn-sm form-control w-50">N/A</button>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mt-3 mb-0">
                                                                <div class="col-sm-4">
                                                                    <div class="form-group mb-3 mb-sm-0">
                                                                        <label>KYC VERIFIED STATUS</label>
                                                                        <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $bodyaccount->third_holder_profile->kyc_status }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4 photo_upload">
                                                                    <div class="form-group  mb-3 mb-sm-0">
                                                                        <label for="photo_upload" class="w-100">KYC Copy</label>
                                                                        @if(isset($bodyaccount->third_holder_profile->kyc_upload) && !empty($bodyaccount->third_holder_profile->kyc_upload))
                                                                            <button type="button" class="btn btn-primary btn-sm form-control w-50" onclick="showImage('{{ @$bodyaccount->third_holder_profile->kyc_upload }}')">View</button>
                                                                        @else
                                                                            <button type="button" class="btn btn-danger btn-sm form-control w-50">N/A</button>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mt-3 mb-0">
                                                                <div class="col-sm-4">
                                                                    <div
                                                                        class="form-group mb-3 mb-sm-0">
                                                                        <label>CKYC NO</label>
                                                                        <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $bodyaccount->third_holder_profile->ckyc_no }}">

                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <div class="form-group mb-3 mb-sm-0">
                                                                        <label>Gender</label>
                                                                        <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $bodyaccount->third_holder_profile->gender }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <div
                                                                        class="form-group mb-3 mb-sm-0">
                                                                        <label>Aadhar No</label>
                                                                        <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $bodyaccount->third_holder_profile->aadhar }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mt-3 mb-0">
                                                                <div class="col-sm-4">
                                                                    <div
                                                                        class="form-group mb-3 mb-sm-0">
                                                                        <label>Country Code</label>
                                                                        <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $bodyaccount->third_holder_profile->country_code }}">

                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <div class="form-group mb-3 mb-sm-0">
                                                                        <label>Mobile Number</label>
                                                                        <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $bodyaccount->third_holder_profile->mobile }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <div
                                                                        class="form-group mb-3 mb-sm-0">
                                                                        <label>Email</label>
                                                                        <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $bodyaccount->third_holder_profile->email }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mt-3 mb-0">
                                                                <div class="col-sm-4">
                                                                    <div
                                                                        class="form-group mb-3 mb-sm-0">
                                                                        <label>Place of Birth</label>
                                                                        <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $bodyaccount->third_holder_profile->birth_incorp_place }}">

                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <div class="form-group mb-3 mb-sm-0">
                                                                        <label>Country Of Birth</label>
                                                                        <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $bodyaccount->third_holder_profile->birth_incorp_country }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <div
                                                                        class="form-group mb-3 mb-sm-0">
                                                                        <label>Tax Status</label>
                                                                        <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $bodyaccount->third_holder_profile->tax_status }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mt-3 mb-0">
                                                                <div class="col-sm-4">
                                                                    <div
                                                                        class="form-group mb-3 mb-sm-0">
                                                                        <label>Occupation</label>
                                                                        <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $bodyaccount->third_holder_profile->occupation }}">

                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <div class="form-group mb-3 mb-sm-0">
                                                                        <label>Employer Name</label>
                                                                        <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $bodyaccount->third_holder_profile->employer_name }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <div
                                                                        class="form-group mb-3 mb-sm-0">
                                                                        <label>Gross Annual Income</label>
                                                                        <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $bodyaccount->third_holder_profile->gross_annual_income }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mt-3 mb-0">
                                                                <div class="col-sm-4">
                                                                    <div
                                                                        class="form-group mb-3 mb-sm-0">
                                                                        <label>Net Worth</label>
                                                                        <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $bodyaccount->third_holder_profile->net_worth }}">

                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <div class="form-group mb-3 mb-sm-0">
                                                                        <label>Net Worth Date</label>
                                                                        <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $bodyaccount->third_holder_profile->net_worth_date }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <div
                                                                        class="form-group mb-3 mb-sm-0">
                                                                        <label>Source Of Wealth</label>
                                                                        <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $bodyaccount->third_holder_profile->wealth_source }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-12 ">
                                                        <div class="form-sections mt-2 mb-0">
                                                            <h4 class="form-section-title text-uppercase">Communication DETAILS</h4>
                                                            <div class="row mt-3 mb-0">
                                                                <div class="col-sm-4">
                                                                    <div class="form-group mb-3 mb-sm-0">
                                                                        <label>Address Type</label>
                                                                        <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $bodyaccount->third_holder_profile->address->addresstype }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <div class="form-group mb-3 mb-sm-0">
                                                                        <label>Address Line 1</label>
                                                                        <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $bodyaccount->third_holder_profile->address->address1 }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4 address_upload">
                                                                    <div class="form-group  mb-3 mb-sm-0">
                                                                        <label for="photo_upload" class="w-100">Address Copy</label>
                                                                        @if(isset($bodyaccount->third_holder_profile->address->address_upload) && !empty($bodyaccount->third_holder_profile->address->address_upload))
                                                                            <button type="button" class="btn btn-primary btn-sm form-control w-50" onclick="showImage('{{ @$bodyaccount->third_holder_profile->address->address_upload }}')">View</button>
                                                                        @else
                                                                            <button type="button" class="btn btn-danger btn-sm form-control w-50">N/A</button>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mt-3 mb-0">
                                                                <div class="col-sm-4">
                                                                    <div class="form-group mb-3 mb-sm-0">
                                                                        <label>ADDRESS LINE 2</label>
                                                                        <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $bodyaccount->third_holder_profile->address->address2 }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <div class="form-group mb-3 mb-sm-0">
                                                                        <label>ADDRESS LINE 3</label>
                                                                        <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $bodyaccount->third_holder_profile->address->address3 }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <div class="form-group mb-3 mb-sm-0">
                                                                        <label>CITY</label>
                                                                        <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $bodyaccount->third_holder_profile->address->city }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mt-3 mb-0">
                                                                <div class="col-sm-4">
                                                                    <div
                                                                        class="form-group mb-3 mb-sm-0">
                                                                        <label>STATE</label>
                                                                        <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $bodyaccount->third_holder_profile->address->state_name }}">

                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <div class="form-group mb-3 mb-sm-0">
                                                                        <label>COUNTRY</label>
                                                                        <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $bodyaccount->third_holder_profile->address->country_name }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <div
                                                                        class="form-group mb-3 mb-sm-0">
                                                                        <label>PINCODE</label>
                                                                        <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $bodyaccount->third_holder_profile->address->pincode }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-12 ">
                                                        <div class="form-sections mt-2 mb-0">
                                                            <h4 class="form-section-title text-uppercase">Bank DETAILS</h4>
                                                            @foreach ($bodyaccount->third_holder_profile->banks as $bank)
                                                                <div class="row mt-3 mb-0">
                                                                    <div class="col-sm-4">
                                                                        <div class="form-group mb-3 mb-sm-0">
                                                                            <label>IFSC CODE</label>
                                                                            <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $bank->ifsc_no }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-group mb-3 mb-sm-0">
                                                                            <label>Bank Name</label>
                                                                            <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $bank->bank_name }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-group mb-3 mb-sm-0">
                                                                            <label>Bank Branch</label>
                                                                            <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $bank->branch_name }}-{{ $bank->micr }}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row mt-3 mb-0">
                                                                    <div class="col-sm-4">
                                                                        <div class="form-group mb-3 mb-sm-0">
                                                                            <label>ACCOUNT TYPE</label>
                                                                            <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $bank->account_type }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-group mb-3 mb-sm-0">
                                                                            <label>ACCOUNT NUMBER</label>
                                                                            <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $bank->account_no }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4 address_upload">
                                                                        <div class="form-group  mb-3 mb-sm-0">
                                                                            <label for="photo_upload" class="w-100">Address Copy</label>
                                                                            @if(isset($bank->cheque_upload) && !empty($bank->cheque_upload))
                                                                                <button type="button" class="btn btn-primary btn-sm form-control w-50" onclick="showImage('{{ @$bank->cheque_upload }}')">View</button>
                                                                            @else
                                                                                <button type="button" class="btn btn-danger btn-sm form-control w-50">N/A</button>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <hr/>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                                <!-- End -->
                                                {{-- <input type="hidden" name="account-has_nominee_{{$bodyaccount->sr_no}}"  value="{{ $bodyaccount->has_nominee }}">
                                                <input type="hidden" name="account-nominee_id_{{$bodyaccount->sr_no}}"  value="{{ $bodyaccount->client_profile_id }}">
                                                <input type="hidden" name="account-nominee_name_{{$bodyaccount->sr_no}}" value="{{ $bodyaccount->client_profile_name }}">
                                                <input type="hidden" name="account-nominee_relationship_{{$bodyaccount->sr_no}}" value="{{ $bodyaccount->relationship }}"> --}}
                                                @if($bodyaccount->has_nominee == 1)
                                                <div class="row">
                                                    <div class="col-sm-12 ">
                                                        <div class="form-sections mt-5 mb-0">
                                                            <h4 class="form-section-title text-uppercase">NOMINEE DETAILS</h4>
                                                            @foreach ($bodyaccount->client_nominees as $nominee)

                                                            <div class="row">

                                                                <div class="col-sm-3">
                                                                    <div
                                                                        class="form-group mb-3 mb-sm-0">
                                                                        <label>Nominee Name</label>
                                                                        <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $nominee->client_profile_name }}">

                                                                    </div>
                                                                </div>

                                                                <div class="col-sm-3">
                                                                    <div class="form-group mb-3 mb-sm-0">
                                                                        <label>Guardian Name</label>
                                                                        @if($nominee->client_guardian_name != null)
                                                                            <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $nominee->client_guardian_name }}">
                                                                        @else
                                                                            <span class="form-control-plaintext font-bold">No Guardian</span>
                                                                        @endif
                                                                    </div>
                                                                </div>

                                                                <div class="col-sm-3">
                                                                    <div
                                                                        class="form-group mb-3 mb-sm-0">
                                                                        <label>Relationship</label>
                                                                        <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $nominee->relationship }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <div
                                                                        class="form-group mb-3 mb-sm-0">
                                                                        <label>Applicable %</label>
                                                                        <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $nominee->applicable }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif

                                                <!-- <div class="row">
                                                    <div class="col-sm-12 ">
                                                        <div class="form-sections mt-5 mb-0">
                                                            <h4 class="form-section-title text-uppercase">Bank Details</h4>
                                                            <div class="row">
                                                                <div class="col-sm-4">
                                                                    <div class="form-group mb-3 mb-sm-0">
                                                                        <label>Default Bank</label>
                                                                        <input type="text" readonly class="form-control-plaintext font-bold acc-default_bank_opp" value="{{ $bodyaccount->defaultbankname }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4 account-other_bank_{{ $bodyaccount->sr_no }}">
                                                                    <div class="form-group mb-3 mb-sm-0">
                                                                        <label>Other Bank</label>
                                                                        <input type="text" readonly class="form-control-plaintext font-bold acc-other_bank_opp" value="{{ $bodyaccount->otherbanksname }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-footer">
                                    @if($count == $i)
                                        <button type="button" class="proceed btn btn-primary btn-lg mr-3">Accept</button>
                                        <button type="button" class="reject-now btn btn-danger btn-lg float-right">Reject</button>
                                        <input type="hidden" id="userstatus" name="userstatus" value="0">

                                        <div class="modal fade" id="RejectModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
                                            aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog"><!-- modal-lg-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel">Rejection Reason</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-sm-12 verification_remarks">
                                                                <div class="form-group">
                                                                    <label for="verification_remarks">Specify Details</label>
                                                                    <textarea class="form-control" id="verification_remarks" name="verification_remarks" rows="5"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="proceed btn btn-primary btn-lg" style="min-width: 11rem">Submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    @else
                                        <button type="button" class="proceed btn btn-primary btn-lg">Next</button>
                                    @endif

                                </div>
                            </div>
                        </section>
                    @endforeach
                </form>
            </div>
        </div>

    </div>
</div>
@endsection


@section('modal')

<!-- Modal -->

  <div class="modal fade" id="uploadModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog"><!-- modal-lg-->
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
                           <img src="" id="show_img" alt="image" class="img-fluid">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="" id="download_img" class="btn btn-primary col-sm-3" download target="_blank">Download</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script type="text/javascript" src="{{ asset('external/js/clientaccount.js') }}"></script>
{{-- <script type="text/javascript" src="{{ asset('assets/javascript/assetallocation.js') }}"></script> --}}

@endsection
