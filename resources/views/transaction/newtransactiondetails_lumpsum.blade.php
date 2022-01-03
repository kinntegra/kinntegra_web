@extends('layouts.master')

@section('style')
<style>
    .dynamic .transaction-steps.sip_date:after {
        background-color: #ffffff;
    }
    .dynamic .transaction-steps.line:after {
        width: 0px;
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
    .disabled{
  pointer-events: none;
}

    /* .sip_start_date_fixed{
        display: none;
    } */
</style>
@endsection


@section('content')
<div class="container-fluid">
    <div class="table-top-section d-flex justify-content-between align-items-center mb-4">
        <a class="back-btn" href="#">
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
                //dd($client);
                    $allocation_type = '';
                    $equity_ratio = '';
                    $sip_added = '';
                    if($client->allocation_type)
                    {
                        $sip_added = 'no';
                    }
                    $is_sip = $client->sip_added;
                    $sip_amount = '';
                    $sip_allocation = '';
                    $sip_equity_ratio = '';
                    $sip_equity = $client->client_profile->equity_ratio_lumpsum;
                    $sip_debt = $client->client_profile->debt_ratio_lumpsum;
                    $sip_tenure = '';
                    $sip_frequency = '';
                    $sip_from_today = 'no';
                    $sip_first_date = '';
                    $sip_second_date = '';
                    $sip_increment = '';
                    $sip_increment_tenure = '';
                    $sip_increment_by_percentage = '';
                    $sip_increment_by_amount = '';
                    $sip_start_date_type = '';
                    $sip_start_date = '';
                    if($is_sip == 1 && $client->managesip != null)
                    {
                        $sip_added = 'yes';
                        //dd($client);
                        $managesip = $client->managesip;
                        //Step 2 Sip Amount
                        $sip_amount = $managesip->amount ?  $managesip->amount : 0;
                        //Step 2 Sip Allocation Type and Equity and Debt Ratio
                        $sip_allocation = $managesip->allocation_type;
                        if($sip_allocation == 'Custom')
                        {$sip_equity_ratio = $managesip->equity;$sip_equity = $managesip->equity;$sip_debt = $managesip->debt;}
                        //Step 2 Sip Tenure
                        $sip_tenure = $managesip->sip_tenure;
                        //Step 2 Sip Frequency
                        $sip_frequency = $managesip->sip_frequency;
                        //Step 3 Sip Increment
                        if($managesip->sip_from_today == 1)
                        {
                            $sip_from_today = 'yes';
                            $sip_first_date = '';
                            $sip_second_date = \Carbon\Carbon::parse($managesip->sip_second_date)->format('d-m-Y');

                        }
                        //dd($managesip);
                        if($managesip->sip_increment == 1)
                        {
                            $sip_increment = 'yes';
                            //Step 3 Sip Increment Tenure
                            $sip_increment_tenure = $managesip->sip_increment_tenure;
                            //Step 3 Sip Increment By Percentage
                            $sip_increment_by_percentage = $managesip->sip_increment_percentage;
                            //Step 3 Sip Increment By Amount
                            $sip_increment_by_amount = $managesip->sip_increment_amount;
                            //dd($sip_increment);
                        }else{
                            $sip_increment = 'no';
                        }

                        //Step 4 Sip Start Date Type
                        $sip_start_date_type = $managesip->sip_start_date_type;

                        //Step 4 Sip Start Date
                        $sip_start_date = $managesip->sip_day;
                        //dd($managesip);
                    }

                    $allocation_type = $client->allocation_type;

                    if($allocation_type == 'Custom')
                    {$equity_ratio = $client->equity;}


                    $trans_type = '';
                    $pending_status = $client->status == 'completed' ? 0 : 1;
                    if ($client->trans_type == "P")
                    $trans_type = 'Buy';
                    elseif ($client->trans_type == "R")
                    $trans_type = 'Sell';
                    elseif ($client->trans_type == "S")
                    $trans_type = 'Switch';
                    //dd($sip_added);
                @endphp
                <div class="col-xl-3 col-lg-4 col-md-4">
                    <div class="custom-wrapper">
                        <h3 class="card-title">New Transaction</h3>
                        <div class="form-percentage">
                            <svg viewBox="0 0 36 36" class="circular-chart orange">
                                <path class="circle-bg" d="M18 2.0845
                                    a 15.9155 15.9155 0 0 1 0 31.831
                                    a 15.9155 15.9155 0 0 1 0 -31.831" />
                                <path class="circle" stroke-dasharray="{{ $client->percentage }}, 100" d="M18 2.0845
                                    a 15.9155 15.9155 0 0 1 0 31.831
                                    a 15.9155 15.9155 0 0 1 0 -31.831" />
                                <text x="18" y="20.35" class="percentage">{{ $client->percentage }}%</text>
                            </svg>
                        </div>
                        <div class="transaction-table-wrap">
                            <div class="title">
                                <svg width="40" height="40" viewBox="0 0 60 60">
                                    <use xlink:href="#transactions"></use>
                                </svg>
                                <h6>Trade for {{ $client->client_profile->name }}</h6>
                            </div>
                            <div class="table-wrap">
                                <table class="transaction-table">
                                    <tr>
                                        <th>Type</th>
                                        <td>{{$trans_type}}</td>
                                    </tr>
                                    <tr>
                                        <th>Plan</th>
                                        <td class="text-capitalize">{{ $client->type }}</td>
                                    </tr>
                                    <tr>
                                        <th>Portfolio</th>
                                        <td class="text-capitalize">{{ $client->view_portfolio }}</td>
                                    </tr>
                                    <tr>
                                        <th>Market Value</th>
                                        <td>₹{{ $client->amount }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- @php
                    dd($client);
                @endphp --}}
                <div class="col-lg-8 col-xl-9 step-forms col-md-8 pl-0 pr-0 pr-sm-3">
                    <form class="trial active" action="{{ route('transaction.store') }}" id="portfolio_details" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $client->id }}">
                        <input type="hidden" name="transactionsession" value="{{ $transactionsession }}">
                        <input type="hidden" name="transaction_type" value="{{ $trans_type }}">
                        <input type="hidden" name="pending" value="{{ $pending_status }}">
                        <input type="hidden" name="transaction_client" id="transaction_client" value="{{ $client->client_account_id }}">
                        <input type="hidden" name="type" value="details">
                        <input type="hidden" name="subtype" id="subtype" value="{{ $client->fund_category }}">
                        <input type="hidden" name="set_allocation" id="set_allocation" value="0">
                        <input type="hidden" name="equity" id="equity" value="{{ $client->equity != '' ? $client->equity : $client->client_profile->equity_ratio_lumpsum }}">
                        <input type="hidden" name="debt" id="debt" value="{{ $client->debt != '' ? $client->debt : $client->client_profile->debt_ratio_lumpsum }}">
                        <input type="hidden" name="sip_equity" id="sip_equity" value="{{ $sip_equity }}">
                        <input type="hidden" name="sip_debt" id="sip_debt" value="{{ $sip_debt }}">
                        <input type="hidden" name="transaction_plan" id="transaction_plan" value="{{ $client->type }}">
                        <div class="form-inner-section">
                            <div class="form-header">
                                <h3 class="card-title">Portfolio 1: <span class="text-capitalize">{{ $client->fund_category }}</span></h3>
                            </div>
                            <div class="form-content">
                                <div class="transaction-wrapper dynamic">
                                    <div class="transaction-steps @if($sip_added == 'no' || $sip_added == ''){{'line'}} @endif @if($sip_added == 'yes')  {{'current'}} @endif">
                                        <div class="row">
                                            <div class="col-xl-4 col-md-6 amount1">
                                                <div class="form-group">
                                                    <label>Enter Amount</label>
                                                    <input type="text" class="form-control amount" id="amount" name="amount" placeholder="Enter Amount" value="@if(isset($client->amount) && $client->amount > 0){{ $client->amount }}@endif">
                                                </div>
                                            </div>

                                            @if($client->fund_category == 'Wealth')
                                            <div class="col-xl-4 col-md-6 allocation1">
                                                <div class="form-group">
                                                    <label>Allocation</label>
                                                    <select class="form-control" name="allocation" id="allocation">
                                                        <option value="" selected disabled>- Select -</option>
                                                        <option value="Recommended" @if($allocation_type == 'Recommended'){{ 'selected' }} @endif>Recommended ({{ $client->client_profile->equity_ratio_lumpsum }}:{{ $client->client_profile->debt_ratio_lumpsum }})</option>
                                                        <option value="Custom" @if($allocation_type == 'Custom') {{ 'selected' }} @endif>Custom</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xl-2 col-md-4 equity_ratio1">
                                                <div class="form-group">
                                                    <label>Equity Ratio</label>
                                                    <select class="form-control" id="equity_ratio" name="equity_ratio" @if($allocation_type != 'Custom') {{ 'readonly' }} @endif>
                                                        @include('transaction.transaction_ratio', ['val' => $equity_ratio])
                                                    </select>
                                                </div>
                                            </div>
                                            @endif
                                            <div class="col-xl-2 col-md-4 add_sip1">
                                                <div class="form-group">
                                                    <label>Add SIP?</label>
                                                    <select class="form-control" name="add_sip" id="add_sip">
                                                        <option value="" selected disabled>Add SIP</option>
                                                        <option value="yes" @if($sip_added == 'yes') {{ 'selected' }} @endif>Yes</option>
                                                        <option value="no" @if($sip_added == 'no') {{ 'selected' }} @endif>No</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="transaction-steps @if($sip_added == 'no'){{'line'}} @endif @if($sip_added == 'yes')  {{'current'}} @endif" @if($sip_added == 'no' || $sip_added == ''){{'style=display:none'}} @endif>
                                        <div class="row">
                                            <div class="col-xl-4 col-md-6">
                                                <div class="sip_amount1">
                                                    <div class="form-group mb-3">
                                                        <label>SIP Amount</label>
                                                        <input type="text" class="form-control amount" placeholder="Enter Amount" name="sip_amount" id="sip_amount" value="{{ $sip_amount }}">
                                                    </div>
                                                </div>
                                                @if(!empty($client->client_mandate))

                                                <div class="form-inline">
                                                    <div class="form-group custom-radio-btn">
                                                        <label>Mandate: </label>
                                                        @foreach ($client->client_mandate as $mandate)
                                                        @php
                                                           //dd($mandate);
                                                        @endphp
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="sip_mandate" id="mandate{{$mandate->id}}" value="{{$mandate->id}}">
                                                            <label class="form-check-label" for="mandate{{$mandate->id}}">
                                                                <span data-toggle="tooltip" data-placement="right" data-html="true"
                                                                title="Bank Name <span>{{ $mandate->bank_detail->bank_name }}</span><br/>
                                                                Account No <span>{{ $mandate->bank_detail->account_no }}</span><br/>
                                                                Start Date <span>{{ \Carbon\Carbon::parse($mandate->start_date)->format('d-m-Y') }}</span><br/>
                                                                End Date <span>{{ \Carbon\Carbon::parse($mandate->end_date)->format('d-m-Y') }}</span><br/>
                                                                Amount <span>{{ $mandate->amount }}</span><br/>
                                                                Created Date <span>{{ \Carbon\Carbon::parse($mandate->created_at)->format('d-m-Y') }}</span><br/>
                                                                Updated Date <span>{{ \Carbon\Carbon::parse($mandate->updated_at)->format('d-m-Y') }}</span>">
                                                                    <span class="badge @if($mandate->bse_mandate_status == 'Approved') {{'badge-success'}} @else {{'badge-warning'}} @endif badge-pill">{{ $mandate->bse_mandate_id }}</span>
                                                                </span>
                                                            </label>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                @endif
                                            </div>
                                            @if($client->fund_category == 'Wealth')
                                            @if($client->managesip)
                                                @if($client->managesip->fund_category == 'Wealth-SIP' || $client->managesip->fund_category == 'tax-sip' || $client->managesip->fund_category == 'shortterm-sip')
                                                <div class="@if($sip_allocation == 'Custom') {{'col-xl-2 col-md-4'}} @else {{'col-xl-4 col-md-6'}} @endif sip_allocation1">
                                                    <div class="form-group">
                                                        <label>Allocation</label>
                                                        <select class="form-control" name="sip_allocation" id="sip_allocation">
                                                            <option value="" selected disabled>- Select -</option>
                                                            <option value="Recommended" @if($sip_allocation == 'Recommended') {{'selected'}} @endif>Recommended ({{ $client->client_profile->equity_ratio_sip }}:{{ $client->client_profile->debt_ratio_sip }})</option>
                                                            <option value="Custom" @if($sip_allocation == 'Custom') {{'selected'}} @endif>Custom</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-xl-2 col-md-4 @if($sip_allocation != 'Custom'){{'d-none'}} @endif sip_equity_ratio1">
                                                    <div class="form-group">
                                                        <label>Equity Ratio</label>
                                                        <select class="form-control" id="sip_equity_ratio" name="sip_equity_ratio" @if($sip_allocation != 'Custom'){{'readonly'}} @endif>
                                                            @include('transaction.transaction_ratio', ['val' => $sip_equity_ratio])
                                                        </select>
                                                    </div>
                                                </div>
                                                @endif
                                            @else
                                            <div class="@if($sip_allocation == 'Custom') {{'col-xl-2 col-md-4'}} @else {{'col-xl-4 col-md-6'}} @endif sip_allocation1">
                                                <div class="form-group">
                                                    <label>Allocation</label>
                                                    <select class="form-control" name="sip_allocation" id="sip_allocation">
                                                        <option value="" selected disabled>- Select -</option>
                                                        <option value="Recommended" @if($sip_allocation == 'Recommended') {{'selected'}} @endif>Recommended ({{ $client->client_profile->equity_ratio_lumpsum }}:{{ $client->client_profile->debt_ratio_lumpsum }})</option>
                                                        <option value="Custom" @if($sip_allocation == 'Custom') {{'selected'}} @endif>Custom</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xl-2 col-md-4 @if($sip_allocation != 'Custom'){{'d-none'}} @endif sip_equity_ratio1">
                                                <div class="form-group">
                                                    <label>Equity Ratio</label>
                                                    <select class="form-control" id="sip_equity_ratio" name="sip_equity_ratio" @if($sip_allocation != 'Custom'){{'readonly'}} @endif>
                                                        @include('transaction.transaction_ratio', ['val' => $sip_equity_ratio])
                                                    </select>
                                                </div>
                                            </div>
                                            @endif
                                            @endif
                                            <div class="col-xl-2 col-md-4 sip_tenure1">
                                                <div class="form-group">
                                                    <label>Tenure (Month)</label>
                                                    <input type="number" class="form-control" min="12" max="999" placeholder="Sip Tenure" name="sip_tenure" id="sip_tenure" value="{{ $sip_tenure }}">
                                                    {{-- <select class="form-control" name="sip_tenure" id="sip_tenure">
                                                        @include('transaction.transaction_month', ['val' => $sip_tenure])

                                                    </select> --}}
                                                </div>
                                            </div>
                                            <div class="col-xl-2 col-md-4">
                                                <div class="form-group">
                                                    <label>Frequency</label>
                                                    <select class="form-control" name="sip_frequency" id="sip_frequency">
                                                        <option value="" selected disabled>- Select -</option>
                                                        <option value="daily" @if($sip_frequency == 'daily'){{'selected'}} @endif>DAILY</option>
                                                        <option value="monthly" @if($sip_frequency == 'monthly'){{'selected'}} @endif>MONTHLY</option>
                                                        <option value="quarterly" @if($sip_frequency == 'quarterly'){{'selected'}} @endif>QUARTERLY</option>
                                                        <option value="annually" @if($sip_frequency == 'annually'){{'selected'}} @endif>ANNUALLY</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="transaction-steps @if($sip_added == 'no'){{'line'}} @endif @if($sip_added == 'yes')  {{'current'}} @endif" @if($sip_added == 'no' || $sip_added == ''){{'style=display:none'}} @endif>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group custom-radio-btn">
                                                    <label class="text-uppercase">Do you wish to increment your SIP?</label>
                                                    <div class="form-inline mt-2">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="sip_increment" id="increment_yes" value="yes" @if($sip_increment == 'yes') {{'checked'}} @endif>
                                                            <label class="form-check-label" for="increment_yes">Yes</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="sip_increment" id="increment_no" value="no" @if($sip_increment == 'no') {{'checked'}} @endif>
                                                            <label class="form-check-label" for="increment_no">No</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-2 col-md-4 sip_increment_no sip_increment_tenure1" @if($sip_increment == 'no' || $sip_increment == ''){{'style=display:none'}} @endif>
                                                <div class="form-group">
                                                    <label>Tenure(Month)</label>
                                                    <input type="number" class="form-control" min="12" max="999" placeholder="Sip Tenure" name="sip_increment_tenure" id="sip_increment_tenure" value="{{ $sip_increment_tenure }}">
                                                    {{-- <select class="form-control" name="sip_increment_tenure" id="sip_increment_tenure">
                                                        @include('transaction.transaction_month', ['val' => $sip_increment_tenure])
                                                    </select> --}}
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-md-6 sip_increment_no" @if($sip_increment == 'no' || $sip_increment == ''){{'style=display:none'}} @endif>
                                                <div class="form-group last-form-group">
                                                    <label>Increment by</label>
                                                    <div class="multi-input sip_increment_by">

                                                        <input type="text" class="form-control mr-0" name="sip_increment_by_percentage" id="sip_increment_by_percentage" placeholder="Percent" value="{{ $sip_increment_by_percentage }}">

                                                        <span class="or">OR</span>

                                                        <input type="text" class="form-control" name="sip_increment_by_amount" id="sip_increment_by_amount" placeholder="Amount" value="{{ $sip_increment_by_amount }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="transaction-steps sip_date @if($sip_added == 'no'){{'line'}} @endif @if($sip_added == 'yes')  {{'current'}} @endif" @if($sip_added == 'no' || $sip_added == ''){{'style=display:none'}} @endif>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group custom-radio-btn">
                                                    <label class="text-uppercase">Select SIP Start Date
                                                    </label>
                                                    <div class="form-inline mt-2">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="sip_start_date_type" id="sip_fixed" value="fixed" @if($sip_start_date_type == 'fixed') {{'checked'}} @endif>
                                                            <label class="form-check-label" for="sip_fixed">Fixed
                                                            </label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="sip_start_date_type" id="sip_recommended" value="recommended" @if($sip_start_date_type == 'recommended') {{'checked'}} @endif>
                                                            <label class="form-check-label" for="sip_recommended"><span class="text">Spread Across Month</span>
                                                                <span class="badge badge-success badge-pill ml-2">Recommended</span>
                                                            </label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="sip_start_date_type" id="sip_custom" value="custom" @if($sip_start_date_type == 'custom') {{'checked'}} @endif>
                                                            <label class="form-check-label" for="sip_custom">Custom</label>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-md-6 sip_start_date_fixed" @if($sip_start_date_type != 'fixed'){{'style=display:none'}} @endif >
                                                <div class="form-group">
                                                    <label>Fixed Date</label>
                                                    <select class="form-control" name="sip_start_date" id="sip_start_date">
                                                        @include('transaction.transaction_sip_date', ['val' => $sip_start_date])
                                                    </select>
                                                    {{-- <input type="text" class="form-control" name="sip_start_date" id="sip_start_date"> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-footer ">
                                {{-- <a href="{{ route('transaction.index',['allocation_id' => $client->buy_id,'type' => 'details', 'subtype' => 'allocation', 'maintype' => $client->fund_category, 'status' => 0]) }}" class="btn btn-link view_allocation disabled"><svg width="30" height="30" viewBox="0 0 24 24"> --}}
                                    <a href="{{ route('transaction.allocation.index',[\App\Services\Security::encryptData($client->buy_id)]) }}" class="btn btn-link view_allocation disabled"><svg width="30" height="30" viewBox="0 0 24 24">
                                    <use xlink:href="#allocation"></use>
                                </svg>View Allocation</a>
                                <button type="submit" class="btn btn-primary btn-lg ml-4 proceed disabled">Proceed</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('modal')
@endsection


@section('script')
<script>
    $('form input').keydown(function (e) {
    if (e.keyCode == 13) {
        e.preventDefault();
        return false;
    }
});
$( document ).ready(function()
{
    let amount = $("#amount").val();
    $(".amount").trigger('keyup');
    let add_sip = $("#add_sip").val();
    console.log(add_sip);
    if(add_sip == 'no')
    {
        $(".view_allocation").removeClass('disabled');
        $(".proceed").removeClass('disabled');
    }
    $sip_start_date = $("input[type=radio][name=sip_start_date_type]:checked").val();
    //console.log($sip_start_date);
    if($sip_start_date )
    {
        $(".view_allocation").removeClass('disabled');
        $(".proceed").removeClass('disabled');
    }
});
    // $('.last-form-group .form-control').on('select2:select', function (e) {
    //     let parent = $(this).parentsUntil(".transaction-steps").parent();
    //     parent.addClass('current');
    //     parent.next().show();
    // });

    // $(window).on('load', function () {
    //     $('input[name="sip_start_date"]').datepicker({
    //     autoclose: true,
    //     format: "dd-mm-yyyy"
    // });
    //});
    $(document).on('change', '#allocation', function (e) {
        let val = e.target.value;
        if(val == 'Custom')
        {
            $("#equity_ratio").attr('readonly', false);
        }else{
            let text = $(this).find('option:selected').text();
            let pos = text.indexOf("(") + 1;
            text.slice(pos, -1);
            let ratio = text.slice(pos, text.lastIndexOf(")"));
            let split_ratio = ratio.split(":");
            $("#equity").val(split_ratio[0]);
            $("#debt").val(split_ratio[1]);
            $("#equity_ratio").val("").trigger('change');
            $("#equity_ratio").attr('readonly', true);
        }
        savetempfile();
    });

    $(document).on('change', '#sip_allocation', function (e) {
        let val = e.target.value;
        if(val == 'Custom')
        {
            //col-xl-4
            $(".sip_allocation1").removeClass('col-xl-4');
            $(".sip_allocation1").addClass('col-xl-2');
            $(".sip_equity_ratio1").removeClass('d-none');
            $("#sip_equity_ratio").attr('readonly', false);
        }else{
            let text = $(this).find('option:selected').text();
            let pos = text.indexOf("(") + 1;
            text.slice(pos, -1);
            let ratio = text.slice(pos, text.lastIndexOf(")"));
            let split_ratio = ratio.split(":");
            $("#sip_equity").val(split_ratio[0]);
            $("#sip_debt").val(split_ratio[1]);
            $("#sip_equity_ratio").val("").trigger('change');
            $(".sip_allocation1").removeClass('col-xl-2');
            $(".sip_allocation1").addClass('col-xl-4');
            $(".sip_equity_ratio1").addClass('d-none');
            $("#sip_equity_ratio").attr('readonly', true);
        }
    });

    $(document).on('change', '#equity_ratio', function (e) {
        let equity_val = e.target.value;
        if(equity_val != '')
        {
            let debt_val = 100 - equity_val;
            $("#equity").val(equity_val);
            $("#debt").val(debt_val);
        }
    });

    $(document).on('change', '#sip_equity_ratio', function (e) {
        let equity_val = e.target.value;
        if(equity_val != '')
        {
            let debt_val = 100 - equity_val;
            $("#sip_equity").val(equity_val);
            $("#sip_debt").val(debt_val);
        }
    });

    $(document).on('change', '#add_sip', function (e) {

        let val = e.target.value;
        if(val)
        {
            let category = $("#subtype").val();
            let allocation = $("#set_allocation").val();
            let error = 0;
            $('.error').removeClass('error');
            $('.span_err').remove();

            error = validatestep1(category,error);
            //console.log(error);
            if(error > 0)
            {
                $("#add_sip").val("").trigger('change');
                return false;
            }else{

                savetempfile();

            }
            if(val == 'yes')
            {
                $(".view_allocation").addClass('disabled');
                $(".proceed").addClass('disabled');
                let parent = $(this).parentsUntil(".transaction-steps").parent();
                parent.addClass('current');
                parent.removeClass('line');
                parent.next().addClass('line');
                parent.next().show();

            }else if(val == 'no'){
                $(".view_allocation").removeClass('disabled');
                $(".proceed").removeClass('disabled');
                // if(category == 'Wealth')
                // {
                //     $(".view_allocation").removeClass('disabled');
                //     $(".proceed").removeClass('disabled');
                // }else{
                //     if(allocation == 0)
                //     {
                //         $(".view_allocation").removeClass('disabled');
                //     }else{
                //         $(".view_allocation").removeClass('disabled');
                //         $(".proceed").removeClass('disabled');
                //     }
                // }
                let parent = $(this).parentsUntil(".transaction-steps").parent();
                parent.addClass('current');
                parent.addClass('line');
                parent.next().hide();
            }
        }

    });

    function savetempfile()
    {
        let post = $('form#portfolio_details').attr('method');
        let url = $('form#portfolio_details').attr('action');
        //console.log(url);
        let formData = new FormData($('#portfolio_details')[0]);
        console.log(post,url);
        //return false;
        $.ajax({
            type: post,
            url: url,
            data: formData,
            //async: false,
            beforeSend: function() {
                //$('#loading').show();
            },
            success:function(data) {
                //
                console.log(data);
            },
            error: function(xhr, textStatus, thrownError)
            {
                //
            },
            cache: false,
            contentType: false,
            processData: false,
        });
    }

    function validatestep1(category,error)
    {
        let amount = $("#amount").val();
        if(!amount)
        {
            error++;
            $('.amount1').children().not("label").not("span").append("<label id='amount_error' class='error span_err'>Please enter amount</label>");
        }
        if(category == 'Wealth')
        {
            let allocation = $("select#allocation option").filter(":selected").val();
            let equity_ratio = $("select#equity_ratio option").filter(":selected").val();

            if(!allocation)
            {
                error++;
                $('.allocation1').children().not("label").not("span").append("<label id='allocation_error' class='error span_err'>Select allocation</label>");
            }
            if(allocation == 'Custom' && !equity_ratio)
            {
                error++;
                $('.equity_ratio1').children().not("label").not("span").append("<label id='equity_ratio_error' class='error span_err'>Select ratio</label>");
            }
        }
        return error;
    }

    function validatestep2(category,error)
    {
        let sip_amount = $("#sip_amount").val();
        //let sip_tenure = $("select#sip_tenure option").filter(":selected").val();
        let sip_tenure = $("#sip_tenure").val();

        if(!sip_amount)
        {
            error++;
            $('.sip_amount1').children().not("label").not("span").append("<label id='sip_amount_error' class='error span_err'>Please enter amount</label>");
        }
        if(category == 'Wealth')
        {
            let sip_allocation = $("select#sip_allocation option").filter(":selected").val();
            let sip_equity_ratio = $("select#sip_equity_ratio option").filter(":selected").val();


            if(!sip_allocation)
            {
                error++;
                $('.sip_allocation1').children().not("label").not("span").append("<label id='sip_allocation_error' class='error span_err'>Select allocation</label>");
            }
            if(sip_allocation == 'Custom' && !sip_equity_ratio)
            {
                error++;
                $('.sip_equity_ratio1').children().not("label").not("span").append("<label id='sip_equity_ratio_error' class='error span_err'>Select ratio</label>");
            }
        }
        if(!sip_tenure)
        {
            error++;
            $('.sip_tenure1').children().not("label").not("span").append("<label id='sip_tenure_error' class='error span_err'>Enter tenure</label>");
        }else{
            console.log(sip_tenure);
            if(sip_tenure < 12)
            {
                error++;
                $('.sip_tenure1').children().not("label").not("span").append("<label id='sip_tenure_error' class='error span_err'>Minimum 12 months</label>");
            }
            if(sip_tenure > 999)
            {
                error++;
                $('.sip_tenure1').children().not("label").not("span").append("<label id='sip_tenure_error' class='error span_err'>Maximum 999 months</label>");
            }
        }
        return error;
    }

    function validatestep3(category,error)
    {
        //let sip_increment_tenure = $("select#sip_increment_tenure option").filter(":selected").val();
        let sip_increment_tenure = $("#sip_increment_tenure").val();

        if(!sip_increment_tenure)
        {
            error++;
            $('.sip_increment_tenure1').children().not("label").not("span").append("<label id='sip_increment_tenure_error' class='error span_err'>Enter tenure</label>");
        }

        return error;
    }

    $(document).on('change', '#sip_frequency', function (e) {
        let val = e.target.value;
        if(val)
        {
            let category = $("#subtype").val();
            let allocation = $("#set_allocation").val();
            let error = 0;
            $('.error').removeClass('error');
            $('.span_err').remove();
            error = validatestep2(category,error);
            console.log(error);
            if(error > 0)
            {
                $("#sip_frequency").val("").trigger('change');
                return false;
            }
            else{
                savetempfile();
            }

            let parent = $(this).parentsUntil(".transaction-steps").parent();
                parent.addClass('current');
                parent.removeClass('line');
                parent.next().addClass('line');
                parent.next().show();
        }
    });

    $(document).on('change', 'input[type=radio][name=sip_increment]', function (event) {
        switch($(this).val()) {
        case 'yes' :
            $(".sip_increment_no").show();

            break;
        case 'no' :

            $(".sip_increment_no").hide();
            $("#sip_increment_tenure").val("").trigger('change');
            $("#sip_increment_by_percentage").val("");
            $("#sip_increment_by_amount").val("");
            let parent = $(".last-form-group .form-control").parentsUntil(".transaction-steps").parent();
            parent.addClass('current');
            parent.removeClass('line');
            parent.next().addClass('line');
            parent.next().show();
            break;
        }
    });
    $(".last-form-group .form-control").blur(function () {
        let category = $("#subtype").val();
        let allocation = $("#set_allocation").val();
        let error = 0;
        $('.error').removeClass('error');
        $('.span_err').remove();
        error = validatestep3(category,error);
        if(error > 0)
        {
            $("#sip_increment_by_percentage").val("");
            $("#sip_increment_by_amount").val("");
            return false;
        }


        let parent = $(this).parentsUntil(".transaction-steps").parent();
        parent.addClass('current');
        parent.removeClass('line');
        parent.next().addClass('line');
        parent.next().show();
    });

    $(document).on('keyup', '#sip_increment_by_percentage', function (event) {
        let pval = $("#sip_increment_by_percentage").val();
        let aval = $("#sip_increment_by_amount").val();
        let sip_amount = $("#sip_amount").val();
        let inc_amount = 0;
        if(pval == '')
        {
            $("#sip_increment_by_amount").attr('readonly', false);
        }else{
            if(pval <= 100)
            {
                //sip_amount = sip_amount.replace(/,/g , '');
                inc_amount = (sip_amount * pval) / 100;
                $("#sip_increment_by_amount").attr('readonly', true);
                //$("#sip_increment_by_amount").val(inc_amount);
            }
        }
    });

    $(document).on('keyup', '#sip_increment_by_amount', function (event) {
        let pval = $("#sip_increment_by_percentage").val();
        let aval = $("#sip_increment_by_amount").val();
        let sip_amount = $("#sip_amount").val();
        let inc_perc = 0;
        if(aval == '')
        {
            $("#sip_increment_by_percentage").attr('readonly', false);
        }else{
            sip_amount = sip_amount.replace(/,/g , '');
            console.log(sip_amount);
            inc_perc = (aval * 100) / sip_amount;

            $("#sip_increment_by_percentage").attr('readonly', true);
            //$("#sip_increment_by_percentage").val(inc_perc);
        }
    });

    // $(document).on('blur', '#sip_tenure', function (event){
    //     let sip_tenure = $('#sip_tenure').val();
    //     console.log('sss');
    //     if(sip_tenure < 12)
    //     {
    //         $('.error').removeClass('error');
    //         $('.span_err').remove();
    //         $('.sip_tenure1').children().not("label").not("span").append("<label id='sip_tenure_error' class='error span_err'>Sip must be atleast for a Year(12 month)</label>");
    //     }
    // });

    $(document).on('change', 'input[type=radio][name=sip_start_date_type]', function (event) {
        let category = $("#subtype").val();
        let allocation = $("#set_allocation").val();
        if(category == 'Wealth')
        {
            $(".view_allocation").removeClass('disabled');
            $(".proceed").removeClass('disabled');
        }else{
            if(allocation == 0)
            {
                $(".view_allocation").removeClass('disabled');
            }else{
                $(".view_allocation").removeClass('disabled');
                $(".proceed").removeClass('disabled');
            }
        }

        // $(".view_allocation").removeClass('disabled');
        //     $(".proceed").removeClass('disabled');
            let parent = $(this).parentsUntil(".transaction-steps").parent();
        parent.addClass('current');
    switch($(this).val()) {
        case 'fixed' :
        $(".sip_start_date_fixed").show();
        break;
        case 'recommended' :
        $(".sip_start_date_fixed").hide();
        break;
        case 'custom' :
        $(".sip_start_date_fixed").hide();
        break;

    }
});
    //sip_start_date_fixed



</script>
@endsection
