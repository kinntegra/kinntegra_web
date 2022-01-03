@extends('layouts.master')

@section('style')

<style>

.mandate-list .row:first-child .delete-mandate {
    display: block;
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

                <form class="col-lg-8 col-xl-9 step-forms col-md-8 pl-0" id="client_mandate_creation" method="POST" action="{{ route('mandate.store') }}">
                    @csrf
                    <input type="hidden" name="id" id="client_id" value="{{ @$client_id }}">
                    <input type="hidden" name="client_edit" id="client_edit" value="1">
                    <input type="hidden" name="step_edit" id="step_edit" value="1">
                    <input type="hidden" name="is_mandate" id="is_mandate" value="1">
                    <input type="hidden" name="is_verify" id="is_verify" value="{{ $is_verify }}">
                    <input type="hidden" name="has_new_mandate" id="has_new_mandate" value="0">
                    <input type="hidden" name="individual_count" id="individual_count" value="{{ $individual_count }}">
                    <input type="hidden" name="nonindividual_count" id="nonindividual_count" value="{{ $nonindividual_count }}">
                    <input type="hidden" name="active_account" id="active_account" value="">
                    <input type="hidden" name="mandatetype" id="mandatetype" value="XSIP">
                    <section class="trial active" id="mandate_creation" data-step="1" autocomplete="off">
                        <div class="form-inner-section">
                            <div class="form-header">
                                <h3 class="card-title"><i class="icon-left-arrow back-btn back_to_creation"></i>Mandate Creation

                                    {{-- @if ($client->is_mandate == 1)
                                        <span class="edit-now float-right mt-1">Edit</span>
                                    @endif --}}
                                </h3>
                            </div>
                            <div class="form-content">
                                <div class="row flex-column">
                                    <div class="col-12" id="account_detail">
                                        <div class="form-sections">
                                            <ul class="nav nav-tabs accounts-tab no-wrap" id="mandate-creation" role="tablist">

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
                                                        @if($headaccount->bse_export_status == 1)
                                                        <li class="nav-item mb-3" role="presentation">
                                                            <a class="nav-link @if($headaccount->sr_no == 1) {{'active'}} @endif pr-4 account-link" data-toggle="tab"
                                                                href="#account{{ $headaccount->id }}" data-accountid="{{ $headaccount->id }}" role="tab" aria-selected="true">{{ $headaccount->sr_no }} -
                                                                {{ $name }}</a>
                                                        </li>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </ul>
                                            <div class="tab-content" id="account-tab">

                                                @if(isset($client->accountsdata) && !empty($client->accountsdata))
                                                    @foreach ($client->accountsdata as $bodyaccount)

                                                        @if($bodyaccount->bse_export_status == 1)
                                                            <input type="hidden" name="mandate-accountid_{{ $bodyaccount->id }}_count" id="mandate-accountid_{{ $bodyaccount->id }}_count" value="0">

                                                            <div class="tab-pane account-created fade show @if($bodyaccount->sr_no == 1) {{'active'}} @endif" data-account_id = "{{ $bodyaccount->id }}" id="account{{$bodyaccount->id}}"
                                                                role="tabpanel" aria-labelledby="add-tab">
                                                                @if($is_verify != 1)

                                                                <div class="mandate-list">

                                                                    <a class="btn btn-link d-block m-auto add-more-mandate">
                                                                        <svg width="30" height="30" viewBox="-2 -2 28 28"
                                                                            class="mr-0">
                                                                            <use xlink:href="#add-btn"></use>
                                                                        </svg> Add Mandate
                                                                    </a>
                                                                </div>
                                                                @endif

                                                                @if($bodyaccount->mandates_count > 0)
                                                                @php
                                                                    //dd($bodyaccount);
                                                                @endphp
                                                                @foreach ($bodyaccount->client_mandates as $mandate)
                                                                    <div class="form-sections mt-3">
                                                                        <h4 class="form-section-title text-uppercase">
                                                                            Mandate (ID:{{ $mandate->bse_mandate_id }}, Type:{{$mandate->mandate_type}}, Created Date:{{ Carbon\Carbon::parse($mandate->start_date)->format('d-m-Y')}})
                                                                        </h4>
                                                                        <div class="row">
                                                                            <div class="col-sm-4">
                                                                                <div class="form-group mb-3 mb-sm-0">
                                                                                    <label>Bank</label>
                                                                                    <input type="text"  readonly class="form-control-plaintext font-bold" value="{{$mandate->bank->bank_name}}{{$mandate->bank->account_no}}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-4">
                                                                                <div class="form-group mb-3 mb-sm-0">
                                                                                    <label>Amount</label>
                                                                                    <input type="text" readonly class="form-control-plaintext font-bold" value="{{ $mandate->amount }}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-4">
                                                                                <div class="form-group mb-3 mb-sm-0">
                                                                                    <label>Status</label>
                                                                                    <input type="text"  readonly class="form-control-plaintext font-bold" value="{{$mandate->bse_mandate_status}}">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endforeach

                                                                @endif
                                                            </div>

                                                        @endif


                                                    @endforeach
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-footer">
                                <button type="button" class="btn btn-primary btn-lg proceed">Proceed</button>
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
<script type="text/javascript" src="{{ asset('assets/javascript/clientmandate.js') }}"></script>


@endsection
