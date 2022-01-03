@extends('layouts.master')

@section('style')
<style>
    /* On screens that are 992px wide or less, go from four columns to two columns */
    /* @media screen and (min-width: 601px) {
        .big-checkbox {
            margin-right: 1.5rem;
        }
    } */

    /* On screens that are 600px wide or less, make the columns stack on top of each other instead of next to each other */
    /* @media screen and (max-width: 600px) {
        .big-checkbox {
            margin-right: 1.1rem;
        }
    } */
    div.customSingle a.select-dropdown {
        overflow: auto;
    }
    .transaction-steps.hideline:after {
        width: 0px;
    }
    .transaction-steps.showline:after  {
        width: 1px;
    }
    .big-checkbox label{
        min-width : 8rem;
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
</style>
@endsection


@section('content')
<div class="container-fluid">
    <div class="table-top-section">
        <div class="section-header">

            @include('partials.top')

        </div>
    </div>

    <div class="row">
        <div class="col-xl-7 col-lg-6 col-md-6">
            <form action="{{ route('transaction.store') }}" method="post">
                @csrf

                @php

                $transaction_client = null;
                $transaction_type = null;
                $transaction_plan = null;
                $transaction_portfolio = null;
                if(!empty($client))
                {
                    //dd($client);
                    $transaction_client = $client->client_account_id;
                    if($client->trans_type == 'P'){
                        $transaction_type = 'buy';
                    }elseif($client->trans_type == 'R'){
                        $transaction_type = 'sell';
                    }elseif ($client->trans_type == 'S') {
                        $transaction_type = 'switch';
                    }
                    $transaction_plan = $client->type;
                    $transaction_portfolio = $client->portfolio;
                }
                if(old('transaction_client') !== null){
                    $transaction_client = old('transaction_client');
                }
                if(old('transaction_type') !== null){
                    $transaction_type = old('transaction_type');
                }
                if(old('transaction_plan') !== null){
                    $transaction_plan = old('transaction_plan');
                }
                if(old('transaction_portfolio', []))
                {
                    $transaction_portfolio = old('transaction_portfolio', []);
                }
                @endphp
                <input type="hidden" name="transactionsession" value="{{ $transactionsession }}">
                <input type="hidden" name="pending" value="1">
                <input type="hidden" name="transaction_client" id="transaction_client" value="{{ @$transaction_client }}">
                <input type="hidden" name="type" value="initiate">
                <input type="hidden" name="client" value="{{old('transaction_client')}}">
                <div class="card card-sm">
                    <div class="card-body">
                        <h3 class="card-title border-bottom">
                            <svg width="50" height="50" viewBox="0 5 50 50">
                                <use xlink:href="#new-transactions" />
                            </svg>
                            New Transaction
                        </h3>

                        <div class="transaction-wrapper">
                            <div class="transaction-steps hideline" id="step_1">
                                <div class="row">
                                    <div class="col-lg-6 col-xl-6">
                                        <h4 class="title">Enter Details</h4>
                                        <div class="form-group">
                                            <label for="client">Client</label>
                                            <div class="dropdown customSingle">

                                                <a class="dropdown-toggle select-dropdown" type="button"
                                                    data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    <span class="text-grey">Select Client</span>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right select-dropdown-list">

                                                    <input type="text" placeholder="Search" class="form-control search-input">
                                                    <div class="data-list">
                                                        @foreach ($clients as $client)
                                                        @if($transaction_client !== null && $client->id == $transaction_client)
                                                        <a class="dropdown-item selected" href="javascript:void(0)" onclick="setClient({{ $client->id }})" data-clientid="{{ $client->id }}">{!! $client->accountname !!}</a>
                                                        @else
                                                        <a class="dropdown-item" href="javascript:void(0)" onclick="setClient({{ $client->id }})" data-clientid="{{ $client->id }}">{!! $client->accountname !!}</a>
                                                        @endif
                                                        @endforeach
                                                    </div>
                                                    <hr>
                                                    <button class="btn btn-transparent border-0 w-100"> + Add Client</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="type">Type</label>
                                            <select class="form-control" name="transaction_type" id="transaction_type">
                                                <option value="" disabled selected>Select Type</option>
                                                <option value="buy" @if($transaction_type == 'buy') {{'Selected'}} @endif>Buy</option>
                                                <option value="sell" @if($transaction_type == 'sell') {{'Selected'}} @endif>Sell</option>
                                                <option value="switch" @if($transaction_type == 'switch') {{'Selected'}} @endif>Switch</option>
                                            </select>

                                        </div>
                                        <div class="form-group">
                                            <label for="client">Plan</label>
                                            <div class="select-wrapper">
                                                <select class="form-control" name="transaction_plan" id="transaction_plan" @if($transaction_plan == '') {{'readonly'}} @endif>
                                                    <option value="" disabled selected>Select Plan</option>
                                                    <option value="Lumpsum" @if($transaction_plan == 'Lumpsum') {{'Selected'}} @endif>LUMPSUM</option>
                                                    <option value="SWP" @if($transaction_plan == 'SWP') {{'Selected'}} @endif>SWP</option>
                                                    <option value="SIP" @if($transaction_plan == 'SIP') {{'Selected'}} @endif>SIP</option>
                                                    <option value="Same_AMC" @if($transaction_plan == 'Same_AMC') {{'Selected'}} @endif>SAME AMC</option>
                                                    <option value="Diff_AMC" @if($transaction_plan == 'Diff_AMC') {{'Selected'}} @endif>DIFFERENT AMC</option>

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-xl-6">
                                        <lottie-player src="/assets/images/json/client.json" background="transparent" speed="1"
                                    style="height: 300px;" loop autoplay></lottie-player>
                                    </div>
                                </div>
                            </div>
                            <div class="transaction-steps" id="step_2" style="display: none">

                                <h4 class="title">Select Portfolio</h4>
                                <div class="big-checkbox">
                                    <input type="checkbox" name="transaction_portfolio[]" value="Wealth" @if($transaction_portfolio != null && in_array('Wealth', $transaction_portfolio)) {{'checked'}} @endif id="html_wealth">
                                    <label for="html_wealth">
                                        <span class="check-mark"></span>
                                        <svg width="60" height="60" viewBox="0 0 80 80">
                                            <use xlink:href="#wealth" />
                                        </svg>
                                        <h4>WEALTH</h4>
                                    </label>
                                </div>
                                <div class="big-checkbox">
                                    <input type="checkbox" name="transaction_portfolio[]" value="Tax" @if($transaction_portfolio != null && in_array('Tax', $transaction_portfolio)) {{'checked'}} @endif id="html_tax">
                                    <label for="html_tax">
                                        <span class="check-mark"></span>
                                        <svg width="60" height="60" viewBox="0 0 80 80">
                                            <use xlink:href="#tax" />
                                        </svg>
                                        <h4>Tax</h4>
                                    </label>
                                </div>
                                <div class="big-checkbox">
                                    <input type="checkbox" name="transaction_portfolio[]" value="Shortterm" @if($transaction_portfolio != null && in_array('Shortterm', $transaction_portfolio)) {{'checked'}} @endif id="html_shortterm">
                                    <label for="html_shortterm">
                                        <span class="check-mark"></span>
                                        <svg width="60" height="60" viewBox="0 0 80 80">
                                            <use xlink:href="#short-term" />
                                        </svg>
                                        <h4>ShortTerm</h4>
                                    </label>
                                </div>
                                <div class="big-checkbox">
                                    <input type="checkbox" name="transaction_portfolio[]" value="Gold" @if($transaction_portfolio != null && in_array('Gold', $transaction_portfolio)) {{'checked'}} @endif id="html_gold">
                                    <label for="html_gold">
                                        <span class="check-mark"></span>
                                        <svg width="60" height="60" viewBox="0 0 80 80">
                                            <use xlink:href="#short-term" />
                                        </svg>
                                        <h4>Gold</h4>
                                    </label>
                                </div>
                                <div class="big-checkbox">
                                    <input type="checkbox" name="transaction_portfolio[]" value="Other" @if($transaction_portfolio != null && in_array('Other', $transaction_portfolio)) {{'checked'}} @endif id="html_other">
                                    <label for="html_other">
                                        <span class="check-mark"></span>
                                        <svg width="60" height="60" viewBox="0 0 80 80">
                                            <use xlink:href="#short-term" />
                                        </svg>
                                        <h4>Other</h4>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="text-right">
                            <button class="btn btn-primary btn-lg">Proceed</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-xl-5 col-lg-6 col-md-6 mt-4 mt-md-0">
            <div class="card card-sm">
                <div class="card-body">
                    <h3 class="card-title border-bottom">
                        <svg width="50" height="50" viewBox="0 5 50 50">
                            <use xlink:href="#trade" />
                        </svg>
                        Transactions
                    </h3>

                    <div class="filter-options d-flex justify-content-between align-items-center mb-4">
                        <div class="input-group w-50">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="table-search">
                                    <svg width="24" height="24" viewBox="0 0 24 24">
                                        <use xlink:href="#search" />
                                    </svg>
                                </span>
                            </div>
                            <input type="text" class="form-control" placeholder="Search"
                                aria-label="table-search" id="tableSearch" aria-describedby="table-search">
                        </div>
                        <button class="btn btn-icon" data-toggle="modal" data-target="#filterModal">
                            <svg width="40" viewBox="0 0 36 36">
                                <use xlink:href="#filter" />
                            </svg>
                        </button>
                    </div>
                    <ul class="nav nav-tabs mb-4" id="transactions" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="Recent-tab" data-toggle="tab" href="#Recent"
                                role="tab" aria-controls="Recent" aria-selected="true">Recent</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="Recommended-tab" data-toggle="tab" href="#Recommended"
                                role="tab" aria-controls="Recommended" aria-selected="false">Recommended</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="analysis-tab" data-toggle="tab" href="#Pending"
                                role="tab" aria-controls="Pending" aria-selected="false">Pending
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="Paused-tab" data-toggle="tab" href="#Paused" role="tab"
                                aria-controls="Paused" aria-selected="false">Paused</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="transactions">
                        <div class="tab-pane fade show active" id="Recent" role="tabpanel"
                            aria-labelledby="Recent-tab">
                            <ul class="transaction-list">
                                <li>
                                    <div class="list-title">
                                        <h5>Buy, Lumpsum</h5>
                                        <a href="#">
                                            <i class="icon-link-arrow"></i>
                                        </a>
                                    </div>

                                    <ul class="transaction-details">
                                        <li>
                                            <label>Client Name</label>
                                            <span class="value">Rishi Chadda</span>
                                        </li>
                                        <li>
                                            <label>Amount</label>
                                            <span class="value">₹12.4L</span>
                                        </li>
                                        <li>
                                            <label>Portfolio</label>
                                            <span class="value">Wealth</span>
                                        </li>
                                        <li>
                                            <label>Status</label>
                                            <span class="value">Trade Approved by Client</span>
                                        </li>
                                    </ul>

                                </li>
                                <li>
                                    <div class="list-title">
                                        <h5>Buy, Lumpsum</h5>
                                        <a href="#">
                                            <i class="icon-link-arrow"></i>
                                        </a>
                                    </div>

                                    <ul class="transaction-details">
                                        <li>
                                            <label>Client Name</label>
                                            <span class="value">Rishi Chadda</span>
                                        </li>
                                        <li>
                                            <label>Amount</label>
                                            <span class="value">₹12.4L</span>
                                        </li>
                                        <li>
                                            <label>Portfolio</label>
                                            <span class="value">Wealth</span>
                                        </li>
                                        <li>
                                            <label>Status</label>
                                            <span class="value">Trade Approved by Client</span>
                                        </li>
                                    </ul>

                                </li>
                                <li>
                                    <div class="list-title">
                                        <h5>Buy, Lumpsum</h5>
                                        <a href="#">
                                            <i class="icon-link-arrow"></i>
                                        </a>
                                    </div>

                                    <ul class="transaction-details">
                                        <li>
                                            <label>Client Name</label>
                                            <span class="value">Rishi Chadda</span>
                                        </li>
                                        <li>
                                            <label>Amount</label>
                                            <span class="value">₹12.4L</span>
                                        </li>
                                        <li>
                                            <label>Portfolio</label>
                                            <span class="value">Wealth</span>
                                        </li>
                                        <li>
                                            <label>Status</label>
                                            <span class="value">Trade Approved by Client</span>
                                        </li>
                                    </ul>

                                </li>
                                <li>
                                    <div class="list-title">
                                        <h5>Buy, Lumpsum</h5>
                                        <a href="#">
                                            <i class="icon-link-arrow"></i>
                                        </a>
                                    </div>

                                    <ul class="transaction-details">
                                        <li>
                                            <label>Client Name</label>
                                            <span class="value">Rishi Chadda</span>
                                        </li>
                                        <li>
                                            <label>Amount</label>
                                            <span class="value">₹12.4L</span>
                                        </li>
                                        <li>
                                            <label>Portfolio</label>
                                            <span class="value">Wealth</span>
                                        </li>
                                        <li>
                                            <label>Status</label>
                                            <span class="value">Trade Approved by Client</span>
                                        </li>
                                    </ul>

                                </li>
                            </ul>
                        </div>
                        <div class="tab-pane fade" id="Recommended" role="tabpanel"
                            aria-labelledby="Recommended-tab">
                            <ul class="transaction-list">
                                <li>
                                    <div class="list-title">
                                        <h5>Switch 10 lacs to align existing investments to
                                            wealth strategy</h5>
                                        <a href="#">
                                            <i class="icon-link-arrow"></i>
                                        </a>
                                    </div>
                                    <div class="date-time">
                                        <span>02:10 AM</span>
                                        <span>Tuesday, 23rd Mar 2020</span>
                                    </div>


                                </li>
                                <li>
                                    <div class="list-title">
                                        <h5>Switch 10 lacs to align existing investments to
                                            wealth strategy</h5>
                                        <a href="#">
                                            <i class="icon-link-arrow"></i>
                                        </a>
                                    </div>
                                    <div class="date-time">
                                        <span>02:10 AM</span>
                                        <span>Tuesday, 23rd Mar 2020</span>
                                    </div>


                                </li>
                                <li>
                                    <div class="list-title">
                                        <h5>Switch 10 lacs to align existing investments to
                                            wealth strategy</h5>
                                        <a href="#">
                                            <i class="icon-link-arrow"></i>
                                        </a>
                                    </div>
                                    <div class="date-time">
                                        <span>02:10 AM</span>
                                        <span>Tuesday, 23rd Mar 2020</span>
                                    </div>


                                </li>
                                <li>
                                    <div class="list-title">
                                        <h5>Switch 10 lacs to align existing investments to
                                            wealth strategy</h5>
                                        <a href="#">
                                            <i class="icon-link-arrow"></i>
                                        </a>
                                    </div>
                                    <div class="date-time">
                                        <span>02:10 AM</span>
                                        <span>Tuesday, 23rd Mar 2020</span>
                                    </div>


                                </li>
                                <li>
                                    <div class="list-title">
                                        <h5>Switch 10 lacs to align existing investments to
                                            wealth strategy</h5>
                                        <a href="#">
                                            <i class="icon-link-arrow"></i>
                                        </a>
                                    </div>
                                    <div class="date-time">
                                        <span>02:10 AM</span>
                                        <span>Tuesday, 23rd Mar 2020</span>
                                    </div>


                                </li>
                                <li>
                                    <div class="list-title">
                                        <h5>Switch 10 lacs to align existing investments to
                                            wealth strategy</h5>
                                        <a href="#">
                                            <i class="icon-link-arrow"></i>
                                        </a>
                                    </div>
                                    <div class="date-time">
                                        <span>02:10 AM</span>
                                        <span>Tuesday, 23rd Mar 2020</span>
                                    </div>


                                </li>
                            </ul>
                        </div>
                        <div class="tab-pane fade" id="Pending" role="tabpanel"
                            aria-labelledby="Pending-tab">
                            <ul class="transaction-list">
                                @foreach ($pendings as $pending)

                                <li>
                                    <div class="list-title">
                                        <h5>
                                            @if ($pending->trans_type == "P")
                                            Buy
                                            @elseif ($pending->trans_type == "R")
                                            Sell
                                            @elseif ($pending->trans_type == "S")
                                            Switch
                                            @endif
                                            , <span class="text-capitalize">{{ $pending->type }}</span></h5>
                                            @if($pending->target_type == 'payment')
                                            {{-- <a href="{{ route('transaction.index',['id' => $pending->target_session,'type' => $pending->target_type]) }}">
                                                <i class="icon-link-arrow"></i>
                                            </a> --}}
                                            <a href="{{ route('transaction.payment.index',[$pending->target_session]) }}">
                                                <i class="icon-link-arrow"></i>
                                            </a>
                                            @else

                                            {{-- <a href="{{ route('transaction.index',['id' => $pending->traget_id,'type' => $pending->target_type, 'subtype' => $pending->target_subtype]) }}">
                                                <i class="icon-link-arrow"></i>
                                            </a> --}}

                                            <a href="{{ route('transaction.type.show',['transaction'=>strtolower($pending->type),'type'=>strtolower($pending->fund_category),'id' => \App\Services\Security::encryptData($pending->id)]) }}">
                                                <i class="icon-link-arrow"></i>
                                            </a>
                                            @endif
                                    </div>

                                    <ul class="transaction-details">
                                        <li>
                                            <label>Client Name</label>
                                            <span class="value">{{ $pending->name }}</span>
                                        </li>
                                        <li>
                                            <label>Amount</label>
                                            <span class="value">₹{{ $pending->total_amount }}</span>
                                        </li>
                                        <li>
                                            <label>Portfolio</label>
                                            <span class="value text-capitalize">{{ $pending->view_portfolio }}</span>
                                        </li>
                                        <li>
                                            <label>Initiation Date</label>
                                            <span class="value">{{ Carbon\Carbon::parse($pending->created_at)->format('d-m-Y') }}</span>
                                        </li>
                                    </ul>

                                </li>
                                @endforeach

                                {{-- <li>
                                    <div class="list-title">
                                        <h5>Buy, Lumpsum</h5>
                                        <a href="#">
                                            <i class="icon-link-arrow"></i>
                                        </a>
                                    </div>

                                    <ul class="transaction-details">
                                        <li>
                                            <label>Client Name</label>
                                            <span class="value">Rishi Chadda</span>
                                        </li>
                                        <li>
                                            <label>Amount</label>
                                            <span class="value">₹12.4L</span>
                                        </li>
                                        <li>
                                            <label>Portfolio</label>
                                            <span class="value">Wealth</span>
                                        </li>
                                        <li>
                                            <label>Initiation Date</label>
                                            <span class="value">04-12-19</span>
                                        </li>
                                    </ul>

                                </li>
                                <li>
                                    <div class="list-title">
                                        <h5>Buy, Lumpsum</h5>
                                        <a href="#">
                                            <i class="icon-link-arrow"></i>
                                        </a>
                                    </div>

                                    <ul class="transaction-details">
                                        <li>
                                            <label>Client Name</label>
                                            <span class="value">Rishi Chadda</span>
                                        </li>
                                        <li>
                                            <label>Amount</label>
                                            <span class="value">₹12.4L</span>
                                        </li>
                                        <li>
                                            <label>Portfolio</label>
                                            <span class="value">Wealth</span>
                                        </li>
                                        <li>
                                            <label>Initiation Date</label>
                                            <span class="value">04-12-19</span>
                                        </li>
                                    </ul>

                                </li>
                                <li>
                                    <div class="list-title">
                                        <h5>Buy, Lumpsum</h5>
                                        <a href="#">
                                            <i class="icon-link-arrow"></i>
                                        </a>
                                    </div>

                                    <ul class="transaction-details">
                                        <li>
                                            <label>Client Name</label>
                                            <span class="value">Rishi Chadda</span>
                                        </li>
                                        <li>
                                            <label>Amount</label>
                                            <span class="value">₹12.4L</span>
                                        </li>
                                        <li>
                                            <label>Portfolio</label>
                                            <span class="value">Wealth</span>
                                        </li>
                                        <li>
                                            <label>Initiation Date</label>
                                            <span class="value">04-12-19</span>
                                        </li>
                                    </ul>

                                </li> --}}
                            </ul>
                        </div>
                        <div class="tab-pane fade" id="Paused" role="tabpanel" aria-labelledby="Paused-tab">
                            <ul class="transaction-list">
                                <li>
                                    <div class="list-title">
                                        <h5>Ashish Mehta</h5>
                                        <a href="#">
                                            <i class="icon-link-arrow"></i>
                                        </a>
                                    </div>

                                    <ul class="transaction-details">
                                        <li>
                                            <label>Invested Amount</label>
                                            <span class="value">₹12.4L</span>
                                        </li>
                                        <li>
                                            <label>SWP Amount</label>
                                            <span class="value">₹12.4L</span>
                                        </li>
                                        <li>
                                            <label>Initiation Date</label>
                                            <span class="value">04-12-19</span>
                                        </li>
                                    </ul>

                                </li>
                                <li>
                                    <div class="list-title">
                                        <h5>Ashish Mehta</h5>
                                        <a href="#">
                                            <i class="icon-link-arrow"></i>
                                        </a>
                                    </div>

                                    <ul class="transaction-details">
                                        <li>
                                            <label>Invested Amount</label>
                                            <span class="value">₹12.4L</span>
                                        </li>
                                        <li>
                                            <label>SWP Amount</label>
                                            <span class="value">₹12.4L</span>
                                        </li>
                                        <li>
                                            <label>Initiation Date</label>
                                            <span class="value">04-12-19</span>
                                        </li>
                                    </ul>

                                </li>
                                <li>
                                    <div class="list-title">
                                        <h5>Ashish Mehta</h5>
                                        <a href="#">
                                            <i class="icon-link-arrow"></i>
                                        </a>
                                    </div>

                                    <ul class="transaction-details">
                                        <li>
                                            <label>Invested Amount</label>
                                            <span class="value">₹12.4L</span>
                                        </li>
                                        <li>
                                            <label>SWP Amount</label>
                                            <span class="value">₹12.4L</span>
                                        </li>
                                        <li>
                                            <label>Initiation Date</label>
                                            <span class="value">04-12-19</span>
                                        </li>
                                    </ul>

                                </li>
                                <li>
                                    <div class="list-title">
                                        <h5>Ashish Mehta</h5>
                                        <a href="#">
                                            <i class="icon-link-arrow"></i>
                                        </a>
                                    </div>

                                    <ul class="transaction-details">
                                        <li>
                                            <label>Invested Amount</label>
                                            <span class="value">₹12.4L</span>
                                        </li>
                                        <li>
                                            <label>SWP Amount</label>
                                            <span class="value">₹12.4L</span>
                                        </li>
                                        <li>
                                            <label>Initiation Date</label>
                                            <span class="value">04-12-19</span>
                                        </li>
                                    </ul>

                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection


@section('modal')
<div class="modal fade show" id="filterModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
aria-labelledby="staticBackdropLabel" aria-modal="true">
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header border-bottom">
            <div class="d-flex justify-content-between align-items-center w-100 mr-0 mr-sm-4">
                <h5 class="modal-title" id="staticBackdropLabel">Transaction Filter</h5>
                <a href="#" class="text-uppercase">Clear Filters</a>
            </div>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
            <ul class="nav nav-tabs " role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" data-toggle="tab" href="#filterRecent" role="tab"
                        aria-selected="true">Recent</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" data-toggle="tab" href="#filterRecommended" role="tab"
                        aria-selected="false">Recommended</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" data-toggle="tab" href="#filterPending" role="tab"
                        aria-selected="false">Pending</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" data-toggle="tab" href="#filterPaused" role="tab"
                        aria-selected="false">Paused</a>
                </li>
            </ul>
            <div class="tab-content mt-4">
                <div class="tab-pane fade show active" id="filterRecent" role="tabpanel">
                    <div class="row form-sections">
                        <div class="col-12">
                            <h4 class="form-section-title text-uppercase text-light">Filter By Location</h4>
                        </div>
                        <div class="col-12">
                            <div id="slider"></div>
                        </div>

                    </div>
                    <div class="row form-sections">
                        <div class="col-12">
                            <h4 class="form-section-title text-uppercase text-light">Filter By Portfolio</h4>
                        </div>
                        <div class="col-12 d-flex flex-wrap">
                            <div class="form-group custom-checkbox mr-3">
                                <input type="checkbox" id="Wealth">
                                <label for="Wealth">Wealth</label>
                            </div>
                            <div class="form-group custom-checkbox mr-3">
                                <input type="checkbox" id="Tax">
                                <label for="Tax">Tax</label>
                            </div>
                            <div class="form-group custom-checkbox mr-3">
                                <input type="checkbox" id="ShortTerm">
                                <label for="ShortTerm">Short Term</label>
                            </div>
                        </div>

                    </div>
                    <div class="row form-sections">
                        <div class="col-12">
                            <h4 class="form-section-title text-uppercase text-light">Filter By Status</h4>
                        </div>
                        <div class="col-12 d-flex flex-wrap">
                            <div class="form-group custom-checkbox mr-3">
                                <input type="checkbox" id="byClient">
                                <label for="byClient">Approved By Client</label>
                            </div>
                            <div class="form-group custom-checkbox mr-3">
                                <input type="checkbox" id="byBSE">
                                <label for="byBSE">Approved by BSE</label>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="tab-pane fade" id="filterRecommended" role="tabpanel">
                    <div class="row form-sections">
                        <div class="col-12">
                            <h4 class="form-section-title text-uppercase text-grey">Filter By Location</h4>
                        </div>
                        <div class="col-12">
                            <div id="slider"></div>
                        </div>

                    </div>
                    <div class="row form-sections">
                        <div class="col-12">
                            <h4 class="form-section-title text-uppercase text-grey">Filter By Location</h4>
                        </div>
                        <div class="col-12 d-flex flex-wrap">
                            <div class="form-group custom-checkbox mr-3">
                                <input type="checkbox" id="Mumbai">
                                <label for="Mumbai">Mumbai</label>
                            </div>
                            <div class="form-group custom-checkbox mr-3">
                                <input type="checkbox" id="Mumbai">
                                <label for="Mumbai">Mumbai</label>
                            </div>
                            <div class="form-group custom-checkbox mr-3">
                                <input type="checkbox" id="Mumbai">
                                <label for="Mumbai">Mumbai</label>
                            </div>
                            <div class="form-group custom-checkbox mr-3">
                                <input type="checkbox" id="Mumbai">
                                <label for="Mumbai">Mumbai</label>
                            </div>
                            <div class="form-group custom-checkbox mr-3">
                                <input type="checkbox" id="Mumbai">
                                <label for="Mumbai">Mumbai</label>
                            </div>
                            <div class="form-group custom-checkbox mr-3">
                                <input type="checkbox" id="Mumbai">
                                <label for="Mumbai">Mumbai</label>
                            </div>
                        </div>

                    </div>
                    <div class="row form-sections">
                        <div class="col-12">
                            <h4 class="form-section-title text-uppercase text-grey">Filter By Location</h4>
                        </div>
                        <div class="col-12 d-flex flex-wrap">
                            <div class="form-group custom-checkbox mr-3">
                                <input type="checkbox" id="Mumbai">
                                <label for="Mumbai">Mumbai</label>
                            </div>
                            <div class="form-group custom-checkbox mr-3">
                                <input type="checkbox" id="Mumbai">
                                <label for="Mumbai">Mumbai</label>
                            </div>
                            <div class="form-group custom-checkbox mr-3">
                                <input type="checkbox" id="Mumbai">
                                <label for="Mumbai">Mumbai</label>
                            </div>
                            <div class="form-group custom-checkbox mr-3">
                                <input type="checkbox" id="Mumbai">
                                <label for="Mumbai">Mumbai</label>
                            </div>
                            <div class="form-group custom-checkbox mr-3">
                                <input type="checkbox" id="Mumbai">
                                <label for="Mumbai">Mumbai</label>
                            </div>
                            <div class="form-group custom-checkbox mr-3">
                                <input type="checkbox" id="Mumbai">
                                <label for="Mumbai">Mumbai</label>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="tab-pane fade" id="filterPending" role="tabpanel">
                    <div class="row form-sections">
                        <div class="col-12">
                            <h4 class="form-section-title text-uppercase text-grey">Filter By Location</h4>
                        </div>
                        <div class="col-12">
                            <div id="slider"></div>
                        </div>

                    </div>
                    <div class="row form-sections">
                        <div class="col-12">
                            <h4 class="form-section-title text-uppercase text-grey">Filter By Location</h4>
                        </div>
                        <div class="col-12 d-flex flex-wrap">
                            <div class="form-group custom-checkbox mr-3">
                                <input type="checkbox" id="Mumbai">
                                <label for="Mumbai">Mumbai</label>
                            </div>
                            <div class="form-group custom-checkbox mr-3">
                                <input type="checkbox" id="Mumbai">
                                <label for="Mumbai">Mumbai</label>
                            </div>
                            <div class="form-group custom-checkbox mr-3">
                                <input type="checkbox" id="Mumbai">
                                <label for="Mumbai">Mumbai</label>
                            </div>
                            <div class="form-group custom-checkbox mr-3">
                                <input type="checkbox" id="Mumbai">
                                <label for="Mumbai">Mumbai</label>
                            </div>
                            <div class="form-group custom-checkbox mr-3">
                                <input type="checkbox" id="Mumbai">
                                <label for="Mumbai">Mumbai</label>
                            </div>
                            <div class="form-group custom-checkbox mr-3">
                                <input type="checkbox" id="Mumbai">
                                <label for="Mumbai">Mumbai</label>
                            </div>
                        </div>

                    </div>
                    <div class="row form-sections">
                        <div class="col-12">
                            <h4 class="form-section-title text-uppercase text-grey">Filter By Location</h4>
                        </div>
                        <div class="col-12 d-flex flex-wrap">
                            <div class="form-group custom-checkbox mr-3">
                                <input type="checkbox" id="Mumbai">
                                <label for="Mumbai">Mumbai</label>
                            </div>
                            <div class="form-group custom-checkbox mr-3">
                                <input type="checkbox" id="Mumbai">
                                <label for="Mumbai">Mumbai</label>
                            </div>
                            <div class="form-group custom-checkbox mr-3">
                                <input type="checkbox" id="Mumbai">
                                <label for="Mumbai">Mumbai</label>
                            </div>
                            <div class="form-group custom-checkbox mr-3">
                                <input type="checkbox" id="Mumbai">
                                <label for="Mumbai">Mumbai</label>
                            </div>
                            <div class="form-group custom-checkbox mr-3">
                                <input type="checkbox" id="Mumbai">
                                <label for="Mumbai">Mumbai</label>
                            </div>
                            <div class="form-group custom-checkbox mr-3">
                                <input type="checkbox" id="Mumbai">
                                <label for="Mumbai">Mumbai</label>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="tab-pane fade" id="filterPaused" role="tabpanel">
                    <div class="row form-sections">
                        <div class="col-12">
                            <h4 class="form-section-title text-uppercase text-grey">Filter By Location</h4>
                        </div>
                        <div class="col-12">
                            <div id="slider"></div>
                        </div>

                    </div>
                    <div class="row form-sections">
                        <div class="col-12">
                            <h4 class="form-section-title text-uppercase text-grey">Filter By Location</h4>
                        </div>
                        <div class="col-12 d-flex flex-wrap">
                            <div class="form-group custom-checkbox mr-3">
                                <input type="checkbox" id="Mumbai">
                                <label for="Mumbai">Mumbai</label>
                            </div>
                            <div class="form-group custom-checkbox mr-3">
                                <input type="checkbox" id="Mumbai">
                                <label for="Mumbai">Mumbai</label>
                            </div>
                            <div class="form-group custom-checkbox mr-3">
                                <input type="checkbox" id="Mumbai">
                                <label for="Mumbai">Mumbai</label>
                            </div>
                            <div class="form-group custom-checkbox mr-3">
                                <input type="checkbox" id="Mumbai">
                                <label for="Mumbai">Mumbai</label>
                            </div>
                            <div class="form-group custom-checkbox mr-3">
                                <input type="checkbox" id="Mumbai">
                                <label for="Mumbai">Mumbai</label>
                            </div>
                            <div class="form-group custom-checkbox mr-3">
                                <input type="checkbox" id="Mumbai">
                                <label for="Mumbai">Mumbai</label>
                            </div>
                        </div>

                    </div>
                    <div class="row form-sections">
                        <div class="col-12">
                            <h4 class="form-section-title text-uppercase text-grey">Filter By Location</h4>
                        </div>
                        <div class="col-12 d-flex flex-wrap">
                            <div class="form-group custom-checkbox mr-3">
                                <input type="checkbox" id="Mumbai">
                                <label for="Mumbai">Mumbai</label>
                            </div>
                            <div class="form-group custom-checkbox mr-3">
                                <input type="checkbox" id="Mumbai">
                                <label for="Mumbai">Mumbai</label>
                            </div>
                            <div class="form-group custom-checkbox mr-3">
                                <input type="checkbox" id="Mumbai">
                                <label for="Mumbai">Mumbai</label>
                            </div>
                            <div class="form-group custom-checkbox mr-3">
                                <input type="checkbox" id="Mumbai">
                                <label for="Mumbai">Mumbai</label>
                            </div>
                            <div class="form-group custom-checkbox mr-3">
                                <input type="checkbox" id="Mumbai">
                                <label for="Mumbai">Mumbai</label>
                            </div>
                            <div class="form-group custom-checkbox mr-3">
                                <input type="checkbox" id="Mumbai">
                                <label for="Mumbai">Mumbai</label>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary col-sm-3">Apply</button>
        </div>
    </div>
</div>
</div>
@endsection


@section('script')
<script src="{{ asset('modules/nouislider/distribute/nouislider.min.js') }}"></script>
<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
<script>
    //$(".customSingle .data-list a").trigger('change');
    $( document ).ready(function() {
        let val = $(".customSingle .data-list a.selected").html();
        let transaction_type = $('#transaction_type').val();
        let id = $(".customSingle .data-list a.selected").attr('data-clientid');
        set_transaction_type(transaction_type);
        setClient(id);
        $(".customSingle .data-list a").parent().parent().prev().html(val);
        //console.log($val);
    });
    var slider = document.getElementById('slider');
        noUiSlider.create(slider, {
            start: [20, 80],
            connect: true,
            tooltips: true,
            range: {
                'min': 0,
                'max': 100
            },
            pips: {
                mode: 'steps',
                density: 2
            }
        });

    function set_transaction_type(transaction_type)
    {
        $('#transaction_plan').children('option').prop('disabled', true);
        if(transaction_type == 'buy'){
            $('#transaction_plan').children('option[value="Lumpsum"],option[value="SWP"],option[value="SIP"]').prop('disabled',false);
        }else if(transaction_type == 'sell'){
            $('#transaction_plan').children('option[value="Lumpsum"],option[value="SWP"]').prop('disabled',false);
        }else if(transaction_type == 'switch'){
            $('#transaction_plan').children('option[value="Same_AMC"],option[value="Diff_AMC"]').prop('disabled',false);
        }
        $('#transaction_plan').attr('readonly', false);

    }

    $(document).on('change', '#transaction_type', function (e) {
        let val = e.target.value;
        if(val)
        {
            set_transaction_type(val);
            $("#transaction_plan").val('').trigger('change');
        }
    });

    $(document).on('change', '#transaction_plan', function (e) {
        let val = e.target.value;
        if(val)
        {
            if(val == 'Lumpsum' || val == 'SIP')
            {
                $('#step_1').removeClass('hideline');
                $('#step_1').addClass('showline');
                $('#step_2').show();
            }else if(val == 'SWP')
            {
                $('#step_1').removeClass('showline');
                $('#step_1').addClass('hideline');
                $('#step_2').hide();
            }
            // set_transaction_plan(val);
            // $("#transaction_plan").val('').trigger('change');
        }
    });

    function setClient($id)
    {
        $("#transaction_client").val($id);
        return true;
    }
</script>
@endsection
