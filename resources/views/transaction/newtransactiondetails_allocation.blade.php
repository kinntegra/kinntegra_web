@extends('layouts.master')

@section('style')
<style>
    .text-error {
        color: #ce4b4b;
    }
    label.error{
        color: #ce4b4b;
    }
    .pb-1{
        padding-bottom: 1rem !important;
    }
    .tooltip {
  position: relative;
  display: inline-block;
  border-bottom: 1px dotted black;
}

.tooltip .tooltiptext {
  visibility: hidden;
  width: 120px;
  background-color: black;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 5px 0;

  /* Position the tooltip */
  position: absolute;
  z-index: 1;
}
.table-dark {
    color: #fed8b3;
    background-color: #548989;
}
.table-error {
    background-color: #f51010 !important;
    color: #ffffff !important;
}

.tooltip:hover .tooltiptext {
  visibility: visible;
}
    td.scheme_amount_equity input[readonly],td.scheme_amount_debt input[readonly] {
    background-color: #ffffff !important;
}
td.scheme_amount_equity input[readonly]:hover,td.scheme_amount_debt input[readonly]:hover {
    background-color: rgba(54, 91, 88, 0.1) !important;
}
    .withdrawal-amount{
        display: none;
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
    .edit-now,.reset-now,.save-now {
        font-size: 12px;
        font-weight: 600;
        font-style: italic;
    }

    .edit-now:hover,.save-now:hover,.reset-now:hover {
        cursor: pointer;
        color: #1a2b2a;
        text-decoration: underline;
    }
    input[readonly] {
        background-color: #f6f6f6 !important;
    }
    .s_info{
        font-size: 1.5rem;
    color: red;
    }
    .s_info_color{
    color: red;
    }
    /* .tableFixHead          { overflow: auto; height: 500px; }
.tableFixHead thead th { position: sticky; top: 0; z-index: 1; } */
.tableFixHead          { overflow: auto; height: 500px; }
.tableFixHead thead th { position: sticky; top: 0; z-index: 9; background: #fff}
.tableFixHead tbody th { position: sticky; left: 0;z-index: 8; }

</style>
@endsection


@section('content')
@php
   // dd($client);
@endphp
    <div class="container-fluid">
        <div class="table-top-section d-flex justify-content-between align-items-center mb-4">
            <a class="back-btn" href="{{ url()->previous() }}">
                <i class="icon-left-arrow"></i>
                Allocation for {{$client->client_profile->name}}
            </a>
            <div class="section-header ">
                @foreach ($client->portfolios as $portfolio)
                    @if($portfolio->fund_category == 'Wealth' &&  $client->type == 'Lumpsum')
                        <a id="view_logic_wealth" class="btn btn-link" data-toggle="modal" data-target="#view-logic-{{$portfolio->fund_category}}-{{$client->type}}"><svg width="30" height="30" viewBox="0 0 24 24">
                            <use xlink:href="#allocation"></use>
                        </svg>View Logic</a>
                    @elseif (($portfolio->fund_category == 'Wealth-SIP' && $client->type == 'Lumpsum') || ($portfolio->fund_category == 'Wealth' && $client->type == 'SIP'))
                        <a id="view_logic_wealth_sip" class="btn btn-link" data-toggle="modal" data-target="#view-logic-{{$portfolio->fund_category}}-{{$client->type}}"><svg width="30" height="30" viewBox="0 0 24 24">
                            <use xlink:href="#allocation"></use>
                        </svg>View Logic</a>
                    @elseif ($portfolio->fund_category == 'SWP' && $client->type == 'SWP')
                        <a class="btn btn-link disabled swp_view_logic" data-toggle="modal" data-target="#view-logic-{{$portfolio->fund_category}}-{{$client->type}}"><svg width="30" height="30" viewBox="0 0 24 24">
                            <use xlink:href="#allocation"></use>
                        </svg>View Logic</a>
                    @endif
                @endforeach
            </div>
        </div>
        <ul class="nav nav-tabs mb-4" id="transaction_nav" role="tablist">
            @php
                //dd($client);
                $total_portfolio_count = 0;
                foreach ($client->portfolios as $portfolio) {
                    if($portfolio->trans_status == 1)
                    {
                        $total_portfolio_count++;
                    }
                }

                //dd($total_portfolio_count);
                //$total_portfolio_count = count($client->portfolios);

                $i = 0;
            @endphp
        @foreach ($client->portfolios as $portfolio)

            @if($portfolio->trans_status == 1)
            @php
                $i++;
            @endphp
            <li class="nav-item" role="presentation">
                <a class="nav-link @if($i == 1){{'active'}}@endif text-uppercase" data-count={{$i}} data-toggle="tab" href="#{{$portfolio->fund_category}}-{{ $client->type }}" role="tab">{{$portfolio->fund_category}}</a>
            </li>

            @endif
        @endforeach
        {{-- <li class="nav-item" role="presentation">
                    <a class="nav-link" data-toggle="tab" href="#sip" role="tab">Wealth (SIP)</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" data-toggle="tab" href="#taxLumpsum" role="tab">Tax (Lumpsum)</a>
                </li> --}}
        </ul>
        <div class="tab-content" id="transaction_content" data-total-count={{$i}}>
            @php
                //dd($client);
                $j = 1;
            @endphp
            @foreach ($client->portfolios as $portfolio)
            @if($portfolio->trans_status == 1)
                @if($portfolio->fund_category == 'Wealth' && $client->type == 'Lumpsum')
                @include('transaction.newtransactiondetails_allocation_wealth')
                @endif

                @if(($portfolio->fund_category == 'Tax' || $portfolio->fund_category == 'Shortterm' || $portfolio->fund_category == 'Gold') && $client->type == 'Lumpsum')
                @include('transaction.newtransactiondetails_allocation_tax_sterm_gold')
                @endif

                @if(($portfolio->fund_category == 'Wealth-SIP' && $client->type == 'Lumpsum') || ($portfolio->fund_category == 'Wealth' && $client->type == 'SIP'))
                @include('transaction.newtransactiondetails_allocation_sip')
                @endif

                @if($portfolio->fund_category == 'SWP' && $client->type == 'SWP')
                @include('transaction.newtransactiondetails_allocation_swp')
                @endif

                @if(($portfolio->fund_category == 'Tax-SIP' || $portfolio->fund_category == 'Shortterm-SIP' || $portfolio->fund_category == 'Gold-SIP') && $client->type == 'Lumpsum')
                @include('transaction.newtransactiondetails_allocation_sip_tax_sterm_gold')
                @endif

                @if(($portfolio->fund_category == 'Tax' || $portfolio->fund_category == 'Shortterm' || $portfolio->fund_category == 'Gold') && $client->type == 'SIP')
                @include('transaction.newtransactiondetails_allocation_sip_tax_sterm_gold')
                @endif
            @php
                $j++;
            @endphp
            @endif
            @endforeach
        </div>
    </div>

@endsection


@section('modal')
<div class="modal fade confirmation-modal" id="errormodal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <!-- <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> -->
            <div class="modal-body text-center">
                <div class="confirmation-popup">
                    <div class="status-icon error">
                        <i class="icon-close"></i>
                    </div>

                    <p>Amount doesn't exceed to total amount</p>
                </div>

                <div class="row justify-content-center">
                    <div class="col-6">
                        <button type="button" class="btn btn-primary w-100" data-dismiss="modal">Ok</button>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
@foreach ($client->portfolios as $portfolio)
@if($portfolio->fund_category == 'Wealth' &&  $client->type == 'Lumpsum')
<div class="modal fade" id="view-logic-{{$portfolio->fund_category}}-{{$client->type}}" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">View the calculation logic for allocation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card small-card option-2 mb-0">
                    <div class="card-header">
                        <h6 class="card-title">Trade Status</h6>
                    </div>
                    <div class="card-body">
                            @if($portfolio->trans_status == 1)
                                <div class="tab-pane fade show  @if($j == 1){{'active'}}@endif" id="{{$portfolio->fund_category}}-{{ $client->type }}" role="tabpanel">
                                    <div class="row">

                                        <div class="col-md-12">
                                            <div class="card small-card option-2 mb-4">
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table class="table normal-table sortable">
                                                            <thead>
                                                                <tr>

                                                                    <th>Scheme Name</th>
                                                                    <th>Rational</th>
                                                                    <th>Amount Calculation</th>
                                                                    <th class="text-right">Amount</th>
                                                                    {{-- <th>Allocation Calculation</th> --}}
                                                                    {{-- <th class="text-right">Allocation</th> --}}
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                                @foreach ($portfolio->modelportfolios as $mportfolio)

                                                                    @foreach ($mportfolio->asset_model_portfolios as $amportfolio)

                                                                            {{-- @if($amportfolio->send_to_bse == true) --}}
                                                                            {{-- @php
                                                                                dd($amportfolio->master_scheme->isin);
                                                                            @endphp --}}
                                                                            <tr>
                                                                                <td data-title="Scheme Name">
                                                                                    <span class="text-capitalize" data-toggle="tooltip" data-placement="right" data-html="true" title="{{$amportfolio->master_scheme->isin}} |
                                                                                    {{$amportfolio->master_scheme->code}}">{{ $amportfolio->master_scheme->scheme_nav_name }}</span>
                                                                                </td>
                                                                                <td>
                                                                                    @if($mportfolio->main_category == 'Equity')
                                                                                    If 100% is {{$amportfolio->allocation_ratio}}% then {{$portfolio->equity}}% of {{$amportfolio->allocation_ratio}}% is  <span class="font-weight-bold" style="color: #dc3545"> {{ $amportfolio->scheme_percentage }}% </span>
                                                                                    @else
                                                                                    If 100% is {{$amportfolio->allocation_ratio}}% then {{$portfolio->debt}}% of {{$amportfolio->allocation_ratio}}% is <span class="font-weight-bold" style="color: #dc3545"> {{ $amportfolio->scheme_percentage }}%</span>
                                                                                    @endif
                                                                                </td>
                                                                                <td class="text-center">
                                                                                    @if($mportfolio->main_category == 'Equity')
                                                                                    {{ $portfolio->amount_format }} * {{ $amportfolio->scheme_percentage }}%
                                                                                    @else
                                                                                    {{ $portfolio->amount_format }} * {{ $amportfolio->scheme_percentage }}%
                                                                                    @endif
                                                                                </td>
                                                                                <td class="text-right" data-title="Amount">
                                                                                    ₹{{ $amportfolio->scheme_amount }}
                                                                                </td>
                                                                                {{-- <td>({{ $amportfolio->scheme_amount }} * 100) \ {{ $portfolio->amount_format }}</td> --}}
                                                                                {{-- <td data-title="Allocation" class="text-right">
                                                                                    {{ $amportfolio->scheme_percentage }}%
                                                                                </td> --}}
                                                                            </tr>
                                                                            {{-- @endif --}}
                                                                        @endforeach

                                                                @endforeach


                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- <div class="col-12 text-right">
                                            <button class="btn btn-primary btn-lg">Bank to Allocation</button>
                                        </div> --}}
                                    </div>
                                </div>


                                @php
                                    $j++;
                                @endphp
                            @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@elseif (($portfolio->fund_category == 'Wealth-sip' && $client->type == 'Lumpsum') || ($portfolio->fund_category == 'Wealth' && $client->type == 'SIP'))
<div class="modal fade" id="view-logic-{{$portfolio->fund_category}}-{{$client->type}}" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">View the calculation logic for allocation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card small-card option-2 mb-0">
                    <div class="card-header">
                        <h6 class="card-title">Trade Status</h6>
                    </div>
                    <div class="card-body">
                            @if($portfolio->trans_status == 1)
                                <div class="tab-pane fade show  @if($j == 1){{'active'}}@endif" id="{{$portfolio->fund_category}}-{{ $client->type }}" role="tabpanel">
                                    <div class="row">

                                        <div class="col-md-12">
                                            <div class="card small-card option-2 mb-4">
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table class="table normal-table sortable">
                                                            <thead>
                                                                <tr>

                                                                    <th>Scheme Name</th>
                                                                    <th>Rational</th>
                                                                    <th>Amount Calculation</th>
                                                                    <th class="text-right">Amount</th>
                                                                    {{-- <th>Allocation Calculation</th> --}}
                                                                    {{-- <th class="text-right">Allocation</th> --}}
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                                @foreach ($portfolio->modelportfolios as $mportfolio)

                                                                    @foreach ($mportfolio->asset_model_portfolios as $amportfolio)

                                                                            {{-- @if($amportfolio->send_to_bse == true) --}}
                                                                            {{-- @php
                                                                                dd($amportfolio->master_scheme_sip);
                                                                            @endphp --}}
                                                                            <tr>
                                                                                <td data-title="Scheme Name">

                                                                                    <span class="text-capitalize" data-toggle="tooltip" data-placement="right" data-html="true" title="{{$amportfolio->master_scheme_sip->isin}} |
                                                                                    {{$amportfolio->master_scheme_sip->scheme_code}}">{{ $amportfolio->master_scheme_sip->scheme_name }}</span>
                                                                                </td>
                                                                                <td>
                                                                                    @if($mportfolio->main_category == 'Equity')
                                                                                    If 100% is {{$amportfolio->allocation_ratio}}% then {{$portfolio->equity}}% of {{$amportfolio->allocation_ratio}}% is  <span class="font-weight-bold" style="color: #dc3545"> {{ $amportfolio->scheme_percentage }}% </span>
                                                                                    @else
                                                                                    If 100% is {{$amportfolio->allocation_ratio}}% then {{$portfolio->debt}}% of {{$amportfolio->allocation_ratio}}% is <span class="font-weight-bold" style="color: #dc3545"> {{ $amportfolio->scheme_percentage }}%</span>
                                                                                    @endif
                                                                                </td>
                                                                                <td class="text-center">
                                                                                    @if($mportfolio->main_category == 'Equity')
                                                                                    {{ $portfolio->amount_format }} * {{ $amportfolio->scheme_percentage }}%
                                                                                    @else
                                                                                    {{ $portfolio->amount_format }} * {{ $amportfolio->scheme_percentage }}%
                                                                                    @endif
                                                                                </td>
                                                                                <td class="text-right" data-title="Amount">
                                                                                    ₹{{ $amportfolio->scheme_amount }}
                                                                                </td>
                                                                                {{-- <td>({{ $amportfolio->scheme_amount }} * 100) \ {{ $portfolio->amount_format }}</td> --}}
                                                                                {{-- <td data-title="Allocation" class="text-right">
                                                                                    {{ $amportfolio->scheme_percentage }}%
                                                                                </td> --}}
                                                                            </tr>
                                                                            {{-- @endif --}}
                                                                        @endforeach

                                                                @endforeach


                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- <div class="col-12 text-right">
                                            <button class="btn btn-primary btn-lg">Bank to Allocation</button>
                                        </div> --}}
                                    </div>
                                </div>
                                @php
                                    $j++;
                                @endphp
                            @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@elseif ($portfolio->fund_category == 'SWP' && $client->type == 'SWP')
<div class="modal fade" id="view-logic-{{$portfolio->fund_category}}-{{$client->type}}" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">View the calculation logic for allocation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <div class="card small-card option-2 mb-4">
                        <div class="card-header">
                            <h6 class="card-title">Trade Status</h6>
                        </div>
                        <div class="card-body">
                            @php
                                //dd($portfolio);
                            @endphp
                                @if($portfolio->trans_status == 1 && count($portfolio->swp_allocated) > 0)
                                    <div class="tab-pane fade show  @if($j == 1){{'active'}}@endif" id="{{$portfolio->fund_category}}-{{ $client->type }}" role="tabpanel">
                                        <!-- Step 1  -->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card small-card option-2 mb-4">
                                                    <div class="card-body">
                                                        <div class="card-header" style="border-bottom:none">
                                                            <h6 class="card-title">STEP 1</h6>
                                                        </div>
                                                        <div class="card small-card option-2">
                                                            <div class="card-body">
                                                                <div class="table-responsive">
                                                                    <table class="table normal-table sortable">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Scheme Name</th>
                                                                                <th>No of Withdrawal</th>
                                                                                <th>Withdrawal Amount</th>
                                                                                <th>Calculation</th>
                                                                                <th>Total Amount</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            @php
                                                                                $swp_month_vl = 0;
                                                                                $swp_amount_vl = 0;
                                                                            @endphp
                                                                            @foreach ($portfolio->swp_allocated_data as $single_swp)
                                                                            @php
                                                                                $swp_month_vl = $swp_month_vl + $single_swp->months;
                                                                                $swp_amount_vl = $swp_amount_vl + ($single_swp->months * $portfolio->withdrawal_amount);
                                                                            @endphp
                                                                            <tr>
                                                                                <td>{{ $single_swp->scheme_name }}</td>
                                                                                <td>{{ $single_swp->months }}</td>
                                                                                <td>₹{{ $portfolio->withdrawal_amount }}</td>
                                                                                <td>{{ $single_swp->months }} x {{ $portfolio->withdrawal_amount }}</td>
                                                                                <td>₹{{ $single_swp->months * $portfolio->withdrawal_amount }}</td>
                                                                            </tr>
                                                                            @endforeach
                                                                            <tr class="border-top">
                                                                                <td>Total</td>
                                                                                <td>{{ $swp_month_vl }}</td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td>₹{{ $swp_amount_vl }}</td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Step 2 -->
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="card small-card option-2 mb-4">
                                                    <div class="card-body">
                                                        <div class="card-header" style="border-bottom: none !important;">
                                                            <h6 class="card-title">STEP 2 <span class="text-capitalize">(Invest remaining amount of total investment amount in desired ratio {{ $portfolio->equity }}:{{ $portfolio->debt }})</span></h6>

                                                        </div>
                                                        <div class="row mt-2">
                                                            <div class="col-4">
                                                              <div class="card small-card option-2">
                                                                <div class="card-body">
                                                                    <div class="table-responsive">
                                                                        @php
                                                                            $fund_amount = $portfolio->amount;
                                                                            $remaining_amount = $fund_amount - $swp_amount_vl
                                                                        @endphp
                                                                        <table class="table normal-table sortable mt-2">
                                                                            <thead>
                                                                                <tr class="text-center">
                                                                                    <th colspan="2">Remaining Amount Calculator</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <tr>
                                                                                    <th>Fund Amount :</th>
                                                                                    <th>₹{{ $portfolio->amount }}</th>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Step 1 Total Amount :</th>
                                                                                    <th>₹{{ $swp_amount_vl }}</th>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Remaining amount :</th>
                                                                                    <th>₹{{ $remaining_amount }}</th>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                              </div>
                                                            </div>
                                                            <div class="col-8">
                                                              <div class="card small-card option-2">
                                                                <div class="card-body">
                                                                    <div class="table-responsive">
                                                                        @php
                                                                            $equity_amount = ($remaining_amount * $portfolio->equity) / 100;
                                                                            $debt_amount = ($remaining_amount * $portfolio->debt) / 100;
                                                                            $total_amount = $equity_amount + $debt_amount;
                                                                            $total_percentage = $portfolio->equity + $portfolio->debt;
                                                                        @endphp
                                                                        <table class="table normal-table sortable mt-2">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>Allocation</th>
                                                                                    <th>Ratio</th>
                                                                                    <th>Investment</th>
                                                                                    <th>Amount</th>
                                                                                    <th>Action</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <tr>
                                                                                    <th>Equity</th>
                                                                                    <th>{{ $portfolio->equity }}%</th>
                                                                                    <th>{{ $remaining_amount }} x {{ $portfolio->equity }}%</th>
                                                                                    <th>₹{{ $equity_amount }}</th>
                                                                                    <th><button type="button" class="btn btn-primary" onclick="view_step_modal('1')">View</button></th>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Debt</th>
                                                                                    <th>{{ $portfolio->debt }}%</th>
                                                                                    <th>{{ $remaining_amount }} x {{ $portfolio->debt }}%</th>
                                                                                    <th>₹{{ $debt_amount }}</th>
                                                                                    <th><button type="button" class="btn btn-primary" onclick="view_step_modal('2')">View</button></th>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Total</th>
                                                                                    <th>{{ $total_percentage }}%</th>
                                                                                    <th></th>
                                                                                    <th>₹{{ $total_amount }}</th>
                                                                                    <th><button type="button" class="btn btn-primary" onclick="view_step_modal('')">View</button></th>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                              </div>
                                                            </div>
                                                          </div>
                                                        {{-- <div class="table table-responsive table-bordered col-md-4">
                                                            <table class="table normal-table sortable mt-2 border-top">
                                                                <thead>
                                                                    <tr class="text-center">
                                                                        <th colspan="2">Remaining Amount</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <th>Fund Amount</th>
                                                                        <td>₹{{ $portfolio->amount }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Step 1 Total Amount</th>
                                                                        <td>₹{{ $swp_amount_vl }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Remaining amount</th>
                                                                        <td>₹{{ $portfolio->amount - $swp_amount_vl }}</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="table table-responsive table-bordered col-md-8">
                                                            <table class="table normal-table sortable mt-2 border-top">
                                                                <thead>
                                                                    <tr class="text-center">
                                                                        <th colspan="2">Remaining Amount</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <th>Fund Amount</th>
                                                                        <td>₹{{ $portfolio->amount }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Step 1 Total Amount</th>
                                                                        <td>₹{{ $swp_amount_vl }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Remaining amount</th>
                                                                        <td>₹{{ $portfolio->amount - $swp_amount_vl }}</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Step 3 -->
                                        <div class="modal fade" id="view-step-modal" data-backdrop="static" data-keyboard="false" tabindex="-1"
                                            aria-labelledby="staticBackdropLabelInner" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabelInner">View the calculation logic for allocation</h5>
                                                        <button type="button" class="close" id="close_view_step_modal">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card small-card option-2 mb-0">
                                                            {{-- <div class="card-header">
                                                                <h6 class="card-title"></h6>
                                                            </div> --}}
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <div class="row mt-2">
                                                                            <div class="col-12">
                                                                                <div class="card small-card option-2">
                                                                                    <div class="card-body">
                                                                                        <div class="table-responsive">
                                                                                            <table class="table normal-table sortable mt-2">
                                                                                                <thead>
                                                                                                    <tr>
                                                                                                        <th>Scheme Name</th>
                                                                                                        <th>Ratio</th>
                                                                                                        <th>Calculator</th>
                                                                                                        <th>Amount</th>
                                                                                                    </tr>
                                                                                                </thead>
                                                                                                <tbody>


                                                                                                    @foreach ($portfolio->modelportfolios as $mportfolio_data)
                                                                                                        @if($mportfolio_data->main_category == 'Equity')
                                                                                                            <tr class="text-center target-equity" style="background-color:rgba(54, 91, 88, 0.1)">
                                                                                                                <th colspan="4">Equity</th>
                                                                                                            </tr>
                                                                                                            @php
                                                                                                                $equity_amount_new = 0;
                                                                                                                $equity_ratio_new = 0;
                                                                                                            @endphp
                                                                                                            @foreach ($mportfolio_data->asset_model_portfolios as $amportfolio_data)
                                                                                                            @php
                                                                                                                $equity_amount_new = $equity_amount_new + ($equity_amount * $amportfolio_data->allocation_ratio) / 100;
                                                                                                                $equity_ratio_new = $equity_ratio_new + $amportfolio_data->allocation_ratio;
                                                                                                            @endphp
                                                                                                            <tr class="target-equity">
                                                                                                                <td>{{ $amportfolio_data->master_scheme->scheme_nav_name }}</td>
                                                                                                                <td>{{ $amportfolio_data->allocation_ratio }}%</td>
                                                                                                                <td>{{ $equity_amount }} x {{ $amportfolio_data->allocation_ratio }}%</td>
                                                                                                                <td>₹{{ ($equity_amount * $amportfolio_data->allocation_ratio) / 100 }}</td>
                                                                                                            </tr>
                                                                                                            @endforeach
                                                                                                            <tr class="border-top target-equity">
                                                                                                                <td>Total</td>
                                                                                                                <td>{{ $equity_ratio_new }}</td>
                                                                                                                <td></td>
                                                                                                                <td>₹{{ $equity_amount_new }}</td>
                                                                                                            </tr>
                                                                                                        @endif

                                                                                                        @if($mportfolio_data->main_category == 'Debt')
                                                                                                        <tr class="text-center target-debt" style="background-color:rgba(54, 91, 88, 0.1)">
                                                                                                            <th colspan="4">Debt</th>
                                                                                                        </tr>
                                                                                                            @php
                                                                                                                $debt_amount_new = 0;
                                                                                                                $debt_ratio_new = 0;
                                                                                                            @endphp
                                                                                                            @foreach ($mportfolio_data->asset_model_portfolios as $amportfolio_data)
                                                                                                            @php
                                                                                                                $debt_amount_new = $debt_amount_new + ($debt_amount * $amportfolio_data->allocation_ratio) / 100;
                                                                                                                $debt_ratio_new = $debt_ratio_new + $amportfolio_data->allocation_ratio;
                                                                                                            @endphp
                                                                                                            <tr class="target-debt">
                                                                                                                <td>{{ $amportfolio_data->master_scheme->scheme_nav_name }}</td>
                                                                                                                <td>{{ $amportfolio_data->allocation_ratio }}%</td>
                                                                                                                <td>{{ $debt_amount }} x {{ $amportfolio_data->allocation_ratio }}%</td>
                                                                                                                <td>₹{{ ($debt_amount * $amportfolio_data->allocation_ratio) / 100 }}</td>
                                                                                                            </tr>
                                                                                                            @endforeach
                                                                                                            <tr class="border-top target-debt">
                                                                                                                <td>Total</td>
                                                                                                                <td>{{ $debt_ratio_new }}%</td>
                                                                                                                <td></td>
                                                                                                                <td>₹{{ $debt_amount_new }}</td>
                                                                                                            </tr>
                                                                                                        @endif
                                                                                                    @endforeach

                                                                                                    {{-- @php
                                                                                                    // dd($portfolio);
                                                                                                    @endphp
                                                                                                    <tr class="text-center">
                                                                                                        <th colspan="4">Debt</th>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <th>Total</th>
                                                                                                        <th></th>
                                                                                                        <th></th>
                                                                                                        <th></th>
                                                                                                    </tr> --}}
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Step 4 -->
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="card small-card option-2 mb-4">
                                                    <div class="card-body">
                                                        <div class="card-header" style="border-bottom: none !important;">
                                                            <h6 class="card-title">STEP 3 :- <span class="text-capitalize">Add withdrawal amount shown in Step 1 to Step 2 for deriving the final investment amount in each scheme</span></h6>
                                                        </div>
                                                        <div class="row mt-2">
                                                            <div class="col-12">
                                                                <div class="card small-card option-2">
                                                                    <div class="card-body">
                                                                        <div class="table-responsive">
                                                                            <table class="table normal-table sortable mt-2">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>Scheme Name</th>
                                                                                        <th>Fund Ratio</th>
                                                                                        <th>Amount</th>
                                                                                        <th>Additional Amount</th>
                                                                                        <th>Total Amount</th>
                                                                                        <th>Ratio</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>


                                                                                    @foreach ($portfolio->modelportfolios as $mportfolio_data)
                                                                                        @if($mportfolio_data->main_category == 'Equity')
                                                                                            <tr class="text-center" style="background-color:rgba(54, 91, 88, 0.1)">
                                                                                                <th colspan="6">Equity</th>
                                                                                            </tr>
                                                                                            @php
                                                                                                $equity_amount_new = 0;
                                                                                                $equity_ratio_new = 0;
                                                                                                $equity_additional_amount_total = 0;
                                                                                                $equity_final_amount_total = 0;
                                                                                                $equity_final_ratio_total = 0;
                                                                                            @endphp
                                                                                            @foreach ($mportfolio_data->asset_model_portfolios as $amportfolio_data)
                                                                                            @php
                                                                                                $equity_amount_calc = ($equity_amount * $amportfolio_data->allocation_ratio) / 100;
                                                                                                $equity_amount_new = $equity_amount_new + $equity_amount_calc;
                                                                                                $equity_ratio_new = $equity_ratio_new + $amportfolio_data->allocation_ratio;
                                                                                                $equity_additional_amount = 0;
                                                                                                $equity_total_amount = 0;
                                                                                                $equity_final_ratio = 0;
                                                                                                if($e_swp_alc = $amportfolio_data->swp_allocation)
                                                                                                {
                                                                                                    $equity_additional_amount = $e_swp_alc->fund_amount;
                                                                                                    $equity_additional_amount_total = $equity_additional_amount_total + $equity_additional_amount;
                                                                                                }
                                                                                                $equity_total_amount = $equity_amount_calc + $equity_additional_amount;
                                                                                                $equity_final_amount_total = $equity_final_amount_total + $equity_total_amount;
                                                                                                $equity_final_ratio_calc = ($equity_total_amount / $portfolio->amount) * 100;
                                                                                                $equity_final_ratio = round($equity_final_ratio_calc, 2);
                                                                                                $equity_final_ratio_total = $equity_final_ratio + $equity_final_ratio_total;
                                                                                            @endphp
                                                                                            <tr>
                                                                                                <td>{{ $amportfolio_data->master_scheme->scheme_nav_name }}</td>
                                                                                                <td>{{ $amportfolio_data->allocation_ratio }}%</td>
                                                                                                <td>₹{{ ($equity_amount * $amportfolio_data->allocation_ratio) / 100 }}</td>
                                                                                                <td>₹{{$equity_additional_amount}}</td>
                                                                                                <td>₹{{$equity_total_amount}}</td>
                                                                                                <td>{{$equity_final_ratio}}%</td>
                                                                                            </tr>
                                                                                            @endforeach
                                                                                            <tr class="border-top">
                                                                                                <td>Total</td>
                                                                                                <td>{{ $equity_ratio_new }}</td>
                                                                                                <td>₹{{ $equity_amount_new }}</td>
                                                                                                <td>₹{{ $equity_additional_amount_total }}</td>
                                                                                                <td>₹{{ $equity_final_amount_total }}</td>
                                                                                                <td>{{ round($equity_final_ratio_total) }}%</td>
                                                                                            </tr>
                                                                                        @endif

                                                                                        @if($mportfolio_data->main_category == 'Debt')
                                                                                        <tr class="text-center" style="background-color:rgba(54, 91, 88, 0.1)">
                                                                                            <th colspan="6">Debt</th>
                                                                                        </tr>
                                                                                            @php
                                                                                                $debt_amount_new = 0;
                                                                                                $debt_ratio_new = 0;
                                                                                                $debt_additional_amount_total = 0;
                                                                                                $debt_final_amount_total = 0;
                                                                                                $debt_final_ratio_total = 0;
                                                                                            @endphp
                                                                                            @foreach ($mportfolio_data->asset_model_portfolios as $amportfolio_data)
                                                                                            @php
                                                                                                $debt_amount_calc = ($debt_amount * $amportfolio_data->allocation_ratio) / 100;
                                                                                                $debt_amount_new = $debt_amount_new + $debt_amount_calc;
                                                                                                $debt_ratio_new = $debt_ratio_new + $amportfolio_data->allocation_ratio;
                                                                                                $debt_additional_amount = 0;
                                                                                                $debt_total_amount = 0;
                                                                                                $debt_final_ratio = 0;
                                                                                                if($d_swp_alc = $amportfolio_data->swp_allocation)
                                                                                                {
                                                                                                    $debt_additional_amount = $d_swp_alc->fund_amount;
                                                                                                    $debt_additional_amount_total = $debt_additional_amount_total + $debt_additional_amount;
                                                                                                }
                                                                                                $debt_total_amount = $debt_amount_calc + $debt_additional_amount;
                                                                                                $debt_final_amount_total = $debt_final_amount_total + $debt_total_amount;
                                                                                                $debt_final_ratio_calc = ($debt_total_amount / $portfolio->amount) * 100;
                                                                                                $debt_final_ratio = round($debt_final_ratio_calc, 2);
                                                                                                $debt_final_ratio_total = $debt_final_ratio + $debt_final_ratio_total;
                                                                                            @endphp
                                                                                            <tr>
                                                                                                <td>{{ $amportfolio_data->master_scheme->scheme_nav_name }}</td>
                                                                                                <td>{{ $amportfolio_data->allocation_ratio }}%</td>
                                                                                                <td>₹{{ $debt_amount_calc }}</td>
                                                                                                <td>₹{{$debt_additional_amount}}</td>
                                                                                                <td>₹{{$debt_total_amount}}</td>
                                                                                                <td>{{$debt_final_ratio}}%</td>
                                                                                            </tr>
                                                                                            @endforeach
                                                                                            <tr class="border-top">
                                                                                                <td>Total</td>
                                                                                                <td>{{ $debt_ratio_new }}%</td>
                                                                                                <td>₹{{ $debt_amount_new }}</td>
                                                                                                <td>₹{{ $debt_additional_amount_total }}</td>
                                                                                                <td>₹{{ $debt_final_amount_total }}</td>
                                                                                                <td>{{ round($debt_final_ratio_total) }}%</td>
                                                                                            </tr>
                                                                                        @endif
                                                                                    @endforeach
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </div>


                                    @php
                                        $j++;
                                    @endphp
                                @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endforeach
@php
    //dd('stop');
@endphp
@endsection


@section('script')
<script type="text/javascript" src="{{ asset('assets/javascript/sorttable.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/javascript/allocation.js') }}"></script>
<script>








</script>
@endsection
