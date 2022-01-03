@extends('layouts.master')

@section('style')

<style>
.acustomMulti {
    min-width: 15rem;
}
.acustomMulti .form-group label {
    font-size: 1rem;
    line-height: 1;
    width: 100%;
    text-transform: capitalize;
}
.nominee_reset,.nominee_hide{
    display: none;
}
div[readonly] textarea{
    background-color: #eee;
}
.acc-default_bank{
    display: none;
}
.accounts-tab .nav-item .remove-account {
    position: absolute;
    right: 1rem;
    top: 50%;
    -webkit-transform: translateY(-50%);
    transform: translateY(-50%);
    font-weight: bold;
    color: var(--primary, #365b58);
    cursor: pointer;
    font-size: 8px;
}
.accounts-tab .nav-item .nav-link.active ~ .remove-account {

.color: #fff !important;
}
.nominee_set{
    display: none;
}


    input[type="checkbox"][readonly],div[readonly] {
  pointer-events: none;
}
    .account_type {
        display: none;
    }
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
.customMulti[readonly] {
    pointer-events: none;
    background-color: #eee;
}
/*Select2 ReadOnly Start*/
        select[readonly].select2-hidden-accessible+.select2-container {
           touch-action: none;pointer-events: none;
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
                @php
                    $individual_count = 0;
                    $nonindividual_count = 0;
                    $non_ucc = 0;
                    foreach ($client->account_profiles as $profile) {
                        if($profile->account_type == 1)
                        {
                            $individual_count++;
                        }else{
                            $nonindividual_count++;
                        }
                    }
                    //dd( $individual_count,$nonindividual_count);
                    //dd($client);
                @endphp

                <form class="col-lg-8 col-xl-9 step-forms col-md-8 pl-0" id="client_creation" method="POST" action="{{ route('creation.store') }}">
                    @csrf
                    <input type="hidden" name="id" id="client_id" value="{{ @$client_id }}">
                    <input type="hidden" name="client_edit" id="client_edit" value="1">
                    <input type="hidden" name="step_edit" id="step_edit" value="0">
                    <input type="hidden" name="is_account_opened" id="is_account_opened" value="1">
                    <input type="hidden" name="account_count" id="account_count" value="{{ $client->accountsdata_count }}">
                    <input type="hidden" name="is_verify" id="is_verify" value="{{ $is_verify }}">
                    <input type="hidden" name="is_reject" id="is_reject" value="0">
                    <input type="hidden" name="has_new_account" id="has_new_account" value="0">
                    <input type="hidden" name="individual_count" id="individual_count" value="{{ $individual_count }}">
                    <input type="hidden" name="nonindividual_count" id="nonindividual_count" value="{{ $nonindividual_count }}">
                    <section class="trial active" id="account_creation" data-step="1" autocomplete="off">
                        <div class="form-inner-section">
                            <div class="form-header">
                                <h3 class="card-title"><i class="icon-left-arrow back-btn back_to_allocation"></i>Account Creation

                                    @if ($client->is_account_opened == 1)
                                        <span class="edit-now float-right mt-1">Edit</span>
                                    @endif
                                </h3>
                            </div>
                            <div class="form-content">
                                <div class="row flex-column">
                                    <div class="col-12" id="account_detail">
                                        <div class="form-sections">
                                            <ul class="nav nav-tabs accounts-tab no-wrap" id="bank-account-opening"
                                                role="tablist">
                                                @if(isset($client->accountsdata) && !empty($client->accountsdata))
                                                    @foreach ($client->accountsdata as $headaccount)
                                                        @php
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
                                                        <li class="nav-item mb-4" role="presentation">
                                                            <a class="nav-link @if($headaccount->sr_no == 1) {{'active'}} @endif pr-4" data-toggle="tab"
                                                                href="#account{{ $headaccount->id }}" role="tab" aria-selected="true">{{ $headaccount->sr_no }} -
                                                                {{ $name }}</a>
                                                        </li>
                                                    @endforeach

                                                @endif
                                                @if($is_verify != 1)
                                                <li class="nav-item add-account-item mb-4" role="presentation">
                                                    <a class="nav-link add-account @if(isset($client->accountsdata) && empty($client->accountsdata)) {{'active'}} @endif" data-toggle="tab"
                                                        href="#add-account" role="tab" aria-selected="true">Add Account</a>
                                                </li>
                                                @endif
                                            </ul>
                                            <div class="tab-content" id="account-tab">
                                                @if(isset($client->accountsdata) && !empty($client->accountsdata))
                                                @php
                                                    //dd($client);
                                                @endphp
                                                @foreach ($client->accountsdata as $bodyaccount)
                                                @php
                                                    if($bodyaccount->is_verified == 0)
                                                    {
                                                        $non_ucc++;
                                                    }
                                                @endphp
                                                <input type="hidden" name="account-accountid_{{ $bodyaccount->sr_no }}" value="{{ $bodyaccount->id }}">
                                                <div class="tab-pane account-created fade show @if($bodyaccount->sr_no == 1) {{'active'}} @endif" data-account_id = "{{ $bodyaccount->id }}" id="account{{$bodyaccount->id}}"
                                                    role="tabpanel" aria-labelledby="add-tab">
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
                                                        <input type="hidden" name="account-has_updated_{{$bodyaccount->sr_no}}"  value="0">
                                                        <input type="hidden" name="account-has_nominee_{{$bodyaccount->sr_no}}"  value="{{ $bodyaccount->has_nominee }}">
                                                        <input type="hidden" name="account-nominee_id_{{$bodyaccount->sr_no}}"  value="{{ $bodyaccount->client_profile_id }}">
                                                        <input type="hidden" name="account-nominee_name_{{$bodyaccount->sr_no}}" value="{{ $bodyaccount->client_profile_name }}">
                                                        <input type="hidden" name="account-nominee_relationship_{{$bodyaccount->sr_no}}" value="{{ $bodyaccount->relationship }}">
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
                                                    </div>
                                                    @php
                                                       //dd($bodyaccount);
                                                    @endphp
                                                    <div class="form-sections">
                                                        <h4 class="form-section-title text-uppercase">Bank Details</h4>
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <div class="form-group mb-3 mb-sm-0">
                                                                    <label>Default Bank</label>
                                                                    <select class="form-control-plaintext font-bold acc-default_bank" name="account-default_bank_{{ $bodyaccount->sr_no }}">
                                                                        @foreach ($bodyaccount->first_holder_profile->banks as $first_profile_bank)
                                                                           <option value="{{ $first_profile_bank->id }}" @if($first_profile_bank->id == $bodyaccount->dbankdata->bank_id){{'selected'}}@endif>{{ $first_profile_bank->bank_name }}</option>
                                                                        @endforeach
                                                                    <select>
                                                                    <input type="text" readonly class="form-control-plaintext font-bold acc-default_bank_opp" value="{{ $bodyaccount->defaultbankname }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4 account-other_bank_{{ $bodyaccount->sr_no }}">
                                                                <div class="form-group mb-3 mb-sm-0">
                                                                    <label>Other Bank</label>
                                                                    <div class="dropdown acustomMulti acc-other_bank">
                                                                        <a class="dropdown-toggle select-dropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                            <span class="text-grey">Select Other bank</span>
                                                                        </a>
                                                                        <div id="account-other_bank_{{ $bodyaccount->sr_no }}" class="dropdown-menu dropdown-menu-left select-dropdown-list" style="position: absolute; transform: translate3d(0px, 39px, 0px); top: 0px; left: 0px; will-change: transform;" x-placement="bottom-start">
                                                                            <div class="data-list">
                                                                                @foreach ($bodyaccount->first_holder_profile->banks as $bank)
                                                                                <a class="dropdown-item">
                                                                                    <div class="form-group custom-checkbox m-0">
                                                                                        <input type="checkbox" name="account-other_bank_{{ $bodyaccount->sr_no }}[]" id="account-other_bank_{{ $bodyaccount->sr_no }}_{{$bank->id}}" value="{{ $bank->id }}" @if(in_array($bank->id, $bodyaccount->otherbanksid)) {{ 'checked' }} @endif>
                                                                                        <label for="account-other_bank_{{ $bodyaccount->sr_no }}_{{$bank->id}}">{{ $bank->bank_name }}</label>
                                                                                    </div>
                                                                                </a>
                                                                                @endforeach
                                                                                <a class="dropdown-item">
                                                                                    <div class="form-group custom-checkbox m-0">
                                                                                        <input type="checkbox" name="account-other_bank_{{ $bodyaccount->sr_no }}[]" id="account-other_bank_{{ $bodyaccount->sr_no }}_0" value="0"  @if(empty($bodyaccount->otherbanksid)) {{ 'checked' }} @endif>
                                                                                        <label for="account-other_bank_{{ $bodyaccount->sr_no }}_0">NA</label>
                                                                                    </div>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <input type="text" readonly class="form-control-plaintext font-bold acc-other_bank_opp" value="{{ $bodyaccount->otherbanksname }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @if(!empty($bodyaccount->rejected_remarks))
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="card small-card option-2 mb-4">
                                                                    <div class="card-header">
                                                                        <h6 class="card-title">Client Rejected Reason</h6>
                                                                    </div>
                                                                    <div class="card-body">
                                                                        <div class="transaction-wrapper trade-status">
                                                                            @foreach ($bodyaccount->rejected_remarks as $profile_remark)

                                                                                @if($profile_remark->status == 'rejected')
                                                                                <div class="transaction-steps regected">
                                                                                    <div class="trade-title mb-1">
                                                                                        <h4 class="mb-0">{{$profile_remark->remarks}}</h4>
                                                                                        <div class="info">
                                                                                            <span>{{ Carbon\Carbon::parse($profile_remark->verified_on)->format('h:i:s A') }}</span>
                                                                                            <span>{{ Carbon\Carbon::parse($profile_remark->verified_on)->format('l, jS F Y') }}</span>
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
                                                </div>
                                                @endforeach
                                                @endif
                                                <!--Begin :: New Account-->
                                                {!! $new_account !!}
                                                <!--End :: New Account-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-footer">
                                @if($is_verify == 0 || $is_verify == 2)
                                    <button type="submit" class="btn btn-primary btn-lg proceed">Proceed</button>
                                @endif
                                @if($is_verify == 1)

                                    @if($non_ucc > 0)
                                    <button type="button" class="btn btn-danger btn-lg mr-3" data-toggle="modal" data-target="#RejectionModal">Reject</button>
                                    <button type="button" class="btn btn-primary btn-lg proceed">Approved</button>
                                    @else
                                    <button type="button" class="btn btn-primary btn-lg proceed">Proceed</button>
                                    @endif
                                @endif
                            </div>
                        </div>


                    <div class="modal fade" id="RejectionModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Define the reason to reject</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    @foreach ($client->account_profiles as $profile)
                                    <div class="row form-sections">
                                        <div class="col-12">
                                            <h4 class="form-section-title text-uppercase text-grey">{{ $profile->name }}</h4>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap">
                                            <div class="form-group custom-checkbox mr-3">
                                                <input type="checkbox" id="profile_{{$profile->id}}" name="reject-profile_{{$profile->id}}" value="0">
                                                <label for="profile_{{$profile->id}}">Profile</label>
                                            </div>
                                            <div class="form-group custom-checkbox mr-3">
                                                <input type="checkbox" id="communication_{{$profile->id}}" name="reject-communication_{{$profile->id}}" value="0">
                                                <label for="communication_{{$profile->id}}">Communication</label>
                                            </div>
                                            <div class="form-group custom-checkbox mr-3">
                                                <input type="checkbox" id="bankid_{{$profile->id}}" name="reject-bankid_{{$profile->id}}" value="0">
                                                <label for="bankid_{{$profile->id}}">Bank</label>
                                            </div>
                                            <div class="form-group custom-checkbox mr-3">
                                                <input type="checkbox" id="allocation_{{$profile->id}}" name="reject-allocation_{{$profile->id}}" value="0">
                                                <label for="allocation_{{$profile->id}}">Allocation</label>
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap">
                                            <div class="col-md-3 profile_{{$profile->id}}" readonly>
                                                <div class="form-group mb-3">
                                                    <label>Profile :: Reject Reason</label>
                                                    <textarea class="form-control" name="profile-reason_{{$profile->id}}" rows="4" placeholder="Add Comment"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-3 communication_{{$profile->id}}" readonly>
                                                <div class="form-group mb-3">
                                                    <label>Communication :: Add Reject Reason</label>
                                                    <textarea class="form-control" name="communication-reason_{{$profile->id}}" rows="4" placeholder="Add Comment"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-3 bankid_{{$profile->id}}" readonly>
                                                <div class="form-group mb-3">
                                                    <label>Bank :: Add Reject Reason</label>
                                                    <textarea class="form-control" name="bank-reason_{{$profile->id}}" rows="4" placeholder="Add Comment"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-3 allocation_{{$profile->id}}" readonly>
                                                <div class="form-group mb-3">
                                                    <label>Allocation :: Add Reject Reason</label>
                                                    <textarea class="form-control" name="allocation-reason_{{$profile->id}}" rows="4" placeholder="Add Comment"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary col-sm-3 proceed">Submit</button>
                                </div>
                            </div>
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
@php
   // dd($client);
@endphp

@endsection

@section('script')
<script type="text/javascript" src="{{ asset('assets/javascript/client.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/javascript/clientcreation.js') }}"></script>

@endsection
