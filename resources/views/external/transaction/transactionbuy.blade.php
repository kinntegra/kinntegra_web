@extends('layouts.external')

@section('style')
<style>
    .pointer {cursor: pointer;}
    div[readonly] textarea{
    background-color: #eee;
}
input[type="checkbox"][readonly],div[readonly] {
  pointer-events: none;
}
.form-sections .form-section-title {
    margin-bottom: 1.25rem;
    color: #545454;
}
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="table-top-section d-flex justify-content-between align-items-center mb-4">
        <div class="back-btn" style="cursor: auto">
            {{-- <i class="icon-left-arrow"></i> --}}

            {{ $client->name }} - Trade Details <span
                class="badge badge-primary badge-pill ml-2">{{ $client->client_trade_status }}</span>
        </div>
        <div class="section-header ">
            {{-- <a class="btn btn-link"><svg width="30" height="30" viewBox="0 0 24 24">
                    <use xlink:href="#allocation"></use>
                </svg>View Logic</a> --}}
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
                $count = count($client->portfolios);

                //dd($portfolio);

                if($portfolio->payment_mode == "OTM")
                {
                    $bank_name_otm = '';
                    $account_no_otm = '';
                    $mandate_id = $portfolio->client_account_mandate_id;
                    foreach ($portfolio->mandates as $mandate) {
                        if($mandate->bse_mandate_id == $mandate_id)
                        {
                            $bank_name_otm = $mandate->bank_name;
                            $account_no_otm = $mandate->account_no;
                        }
                    }
                }

                if($portfolio->payment_mode == "NEFT/RTGS")
                {

                }

                if($portfolio->payment_mode == "Net Banking")
                {
                    $bank_name_net = '';
                    foreach ($portfolio->banks as $bank) {
                        if($bank->id == $portfolio->bank_id)
                        {
                            $bank_name_net = $bank->bank_name;
                        }
                    }
                }

                if($portfolio->payment_mode == "Cheque")
                {
                    $bank_name_cheque = '';
                    foreach ($portfolio->banks as $bank) {
                        if($bank->id == $portfolio->bank_id)
                        {
                            $bank_name_cheque = $bank->bank_name;
                        }
                    }
                }

            @endphp
            <li class="nav-item" role="presentation">
                <a class="nav-link @if($i == 1){{'active'}}@endif text-uppercase" data-count={{$i}} data-toggle="tab" href="#{{$portfolio->fund_category}}-{{ $client->type }}" role="tab">{{$portfolio->fund_category}}</a>
            </li>

            @endif
        @endforeach
    </ul>
    <form action="{{ route('confirmorderbuy.store') }}" id="buy_portfolio_details" method="POST">
        @csrf
        <input type="hidden" name="trans_param" value="{{ $trans_param }}">
        <input type="hidden" name="is_reject" id="is_reject" value="0">
        <div class="tab-content" id="transactions" data-total-count={{$i}}>
            @php
                $j = 1;
            @endphp
            @foreach ($client->portfolios as $portfolio)
            <div class="tab-pane fade show @if($j == 1){{'active'}}@endif" id="{{$portfolio->fund_category}}-{{ $client->type }}" role="tabpanel">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card small-card option-2 option-2 mb-4">
                            <div class="card-header">
                                <h6 class="card-title">Portfolio Details</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-xl-3 col-sm-4">
                                        <div class="form-group mb-3 mb-sm-0">
                                            <label>Amount</label>
                                            {{-- <input type="text" readonly class="form-control-plaintext font-bold"
                                                value="₹ 50.32K"> --}}
                                            <span class="form-control-plaintext font-bold">
                                                {{ $portfolio->amount }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-sm-4">
                                        <div class="form-group mb-3 mb-sm-0">
                                            <label>Mode Of Payment</label>
                                            {{-- <input type="text" readonly class="form-control-plaintext font-bold"
                                                value="₹ 50.32K"> --}}
                                            <span class="form-control-plaintext font-bold text-capitalize">
                                                {{ $portfolio->payment_mode }}
                                            </span>
                                        </div>
                                    </div>
                                    {{-- <div class="col-xl-3 col-sm-4">
                                        <div class="form-group mb-3 mb-sm-0">
                                            <label>Transaction Type</label>
                                            <span class="form-control-plaintext font-bold text-capitalize">
                                                {{ $client->type }}
                                            </span>
                                        </div>
                                    </div> --}}

                                    @if ($portfolio->payment_mode == "OTM")
                                    <div class="col-xl-3 col-sm-4">
                                        <div class="form-group mb-3 mb-sm-0">
                                            <label>Mandate ID</label>
                                            {{-- <input type="text" readonly class="form-control-plaintext font-bold"
                                                value="₹ 50.32K"> --}}
                                            <span class="form-control-plaintext font-bold text-capitalize">
                                                {{ $portfolio->client_account_mandate_id }}
                                            </span>
                                        </div>
                                    </div>
                                    @elseif($portfolio->payment_mode == "NEFT/RTGS")
                                    <div class="col-xl-3 col-sm-4">
                                        <div class="form-group mb-3 mb-sm-0">
                                            <label>UTR NUMBER</label>
                                            <span class="form-control-plaintext font-bold text-capitalize">
                                                {{ $portfolio->utr_number }}
                                            </span>
                                        </div>
                                    </div>
                                    @elseif($portfolio->payment_mode == "Net Banking")

                                    @elseif($portfolio->payment_mode == "Cheque")

                                    @endif

                                    @if ($portfolio->payment_mode == "OTM" || $portfolio->payment_mode == "Net Banking" || $portfolio->payment_mode == "Cheque")
                                    <div class="col-xl-3 col-sm-4">
                                        <div class="form-group mb-3 mb-sm-0">
                                            <label>Transaction Bank</label>
                                            @php
                                                //dd($portfolio);
                                            @endphp
                                            <span class="form-control-plaintext font-bold text-capitalize">
                                                @if ($portfolio->payment_mode == "OTM")
                                                {{ $bank_name_otm }}
                                                @elseif ($portfolio->payment_mode == "Net Banking")
                                                {{ $bank_name_net }}
                                                @elseif ($portfolio->payment_mode == "Cheque")
                                                {{ $bank_name_cheque }}
                                                @endif

                                            </span>
                                        </div>
                                    </div>
                                    @endif
                                    @if($portfolio->payment_mode == "Cheque")
                                    <div class="col-xl-3 col-sm-4">
                                        <div class="form-group mb-3 mb-sm-0">
                                            <label>&nbsp;&nbsp;</label>
                                            <button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#viewChequeModal_{{$portfolio->id}}">Cheque Copy</button>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="viewChequeModal_{{$portfolio->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1"
                                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog"><!-- modal-lg-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">View Cheque Details</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row form-sections">

                                                        <div class="col-6">
                                                            <div class="form-group mb-3 mb-sm-0">
                                                                <label>Cheque Number</label>
                                                                <span class="form-control-plaintext font-bold">
                                                                    {{ $portfolio->cheque_number }}
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group mb-3 mb-sm-0">
                                                                <label>Cheque Date</label>
                                                                <span class="form-control-plaintext font-bold">
                                                                    {{ Carbon\Carbon::parse($portfolio->cheque_date)->format('d-m-Y') }}
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row form-sections">
                                                        <div class="col-12 d-flex justify-content-center" id="show_doc">
                                                            <img src="{{env('APP_API_URL')}}/{{env('APP_STORE')}}/{{ $portfolio->cheque_upload }}" id="show_img" alt="image" class="img-fluid">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card small-card option-2 mb-4">
                            <div class="card-header">
                                <h6 class="card-title">Client Review</h6>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-xl-12 col-sm-12">
                                        <div class="form-group mb-3 mb-sm-0">
                                            <label>Remark</label>
                                            <span class="form-control-plaintext font-bold">
                                                {{-- Change in payment mode to netbanking for the further status --}}
                                                {{ $portfolio->log_last->remark }}
                                            </span>
                                            {{-- <input type="text" readonly class="form-control-plaintext font-bold"
                                                value="Change in payment mode to netbanking for the further status. Change in payment mode to netbanking for the further status"> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card small-card option-2 mb-4">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table normal-table">
                                        <thead>
                                            <tr>
                                                <th>Folio Number</th>
                                                <th>Scheme Name</th>
                                                <th>Amount</th>
                                                <th>Allocation</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($portfolio->funds as $fund)
                                            {{-- @php
                                                dd($portfolio->client_trade_status);
                                            @endphp --}}
                                            <tr>
                                                <td data-title="Folio Number">
                                                    @if($fund->folio_number == '')
                                                    New Folio
                                                    @else
                                                    {{$fund->folio_number}}
                                                    @endif
                                                </td>
                                                <td data-title="Scheme Name">
                                                    {{$fund->name}}
                                                </td>
                                                <td data-title="Amount">
                                                    ₹{{$fund->fund_amount}}
                                                </td>
                                                <td data-title="Allocation">
                                                    {{$fund->allocation_percentage}}%
                                                </td>
                                                <td data-title="Status">
                                                    <div onClick="statusSchemeLog({{$fund->id}})" class="pointer">
                                                        @if ($fund->trade_status == 'Open')
                                                            <span class="badge badge-info badge-pill">
                                                                Pending
                                                                <i class="icon-link-arrow"></i>
                                                            </span>
                                                        @elseif($fund->trade_status == 'Failed')
                                                            <span class="badge badge-danger badge-pill">
                                                                Failed
                                                                <i class="icon-link-arrow"></i>
                                                            </span>
                                                        @elseif($fund->trade_status == 'InProcess')
                                                            <span class="badge badge-warning badge-pill">
                                                                InProcess
                                                                <i class="icon-link-arrow"></i>
                                                            </span>
                                                        @elseif($fund->trade_status == 'Complete')
                                                            <span class="badge badge-primary badge-pill">
                                                                Complete
                                                                <i class="icon-link-arrow"></i>
                                                            </span>
                                                        @elseif($fund->trade_status == 'Canceled')
                                                            <span class="badge badge-default badge-pill">
                                                                Canceled
                                                                <i class="icon-link-arrow"></i>
                                                            </span>
                                                        @elseif($fund->trade_status == 'AutoCanceled')
                                                            <span class="badge badge-default badge-pill">
                                                                AutoCanceled
                                                                <i class="icon-link-arrow"></i>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card small-card option-2 mb-4">
                            <div class="card-header">
                                <h6 class="card-title">Rational For Trade</h6>
                            </div>
                            <div class="card-body">
                                <p>{{ $portfolio->traderational->rational }}</p>
                            </div>
                        </div>
                        <div class="card small-card option-2 mb-4">
                            <div class="card-header">
                                <h6 class="card-title">Comments</h6>
                            </div>
                            <div class="card-body">
                                <p>{{ $portfolio->description }}</p>
                                <div class="form-group mb-3">
                                    <textarea class="form-control" name="{{ strtolower($portfolio->fund_category) }}_comment" placeholder="Add Comment if any"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card small-card option-2 mb-4">
                            <div class="card-header">
                                <h6 class="card-title">Trade Status</h6>
                            </div>
                            <div class="card-body">
                                <div class="transaction-wrapper trade-status">
                                    @foreach ($portfolio->logs as $log)
                                    <div class="transaction-steps">
                                        <div class="trade-title mb-2">
                                            <h4 class="mb-0">{{ $log->remark }}</h4>
                                            <div class="info">
                                                <span>{{ Carbon\Carbon::parse($log->log_time)->format('h:m A') }}</span>
                                                <span>{{ Carbon\Carbon::parse($log->log_date)->format('l, jS F Y') }}</span>
                                            </div>
                                        </div>
                                        {{-- <div >
                                            <span class="badge badge-default badge-pill">00:15 Hours</span>
                                        </div> --}}
                                    </div>
                                    @endforeach

                                    {{-- <div class="transaction-steps ">
                                        <div class="trade-title mb-2">
                                            <h4 class="mb-0">Client Confirmed Trade</h4>
                                            <div class="info">
                                                <span>02:10 AM</span>
                                                <span>Tuesday, 23rd Mar 2020</span>
                                            </div>
                                        </div>
                                        <div >
                                            <span class="badge badge-default badge-pill">00:15 Hours</span>
                                        </div>
                                    </div>
                                    <div class="transaction-steps">
                                        <div class="trade-title mb-2">
                                            <h4 class="mb-0">Sent to BSE for validation</h4>
                                            <div class="info">
                                                <span>02:10 AM</span>
                                                <span>Tuesday, 23rd Mar 2020</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="transaction-steps inactive">
                                        <div class="trade-title mb-2">
                                            <h4 class="mb-0">Validated/Rejected by RTA</h4>
                                        </div>
                                    </div>
                                    <div class="transaction-steps inactive">
                                        <div class="trade-title mb-2">
                                            <h4 class="mb-0">Validated/Rejected by RTA</h4>
                                        </div>
                                    </div>
                                    <div class="transaction-steps inactive">
                                        <div class="trade-title mb-2">
                                            <h4 class="mb-0">Validated/Rejected by RTA</h4>
                                        </div>
                                    </div>
                                    <div class="transaction-steps inactive">
                                        <div class="trade-title mb-2">
                                            <h4 class="mb-0">Validated/Rejected by RTA</h4>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <button type="@if($j == $total_portfolio_count){{'submit'}}@else{{ 'button' }}@endif" @if($j != $total_portfolio_count) onclick="goto_next()" @endif class="btn btn-primary btn-lg float-right">
                            @if($j == $total_portfolio_count)
                            Accept
                            @else
                            Save and Next
                            @endif
                        </button>
                        @if($j == $total_portfolio_count)

                            <button type="button" class="btn btn-danger float-right btn-lg mr-3" data-toggle="modal" data-target="#RejectionModal">Reject</button>
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
                                            @foreach ($client->portfolios as $portfolio)
                                            <div class="row form-sections">
                                                <div class="col-12">
                                                    <h4 class="form-section-title text-uppercase text-grey ml-3">{{ $portfolio->fund_category }}</h4>
                                                </div>
                                                <div class="col-12 d-flex flex-wrap ml-3">

                                                        <div class="form-group custom-checkbox mr-3">
                                                            <input type="checkbox" id="order_creation_{{$portfolio->id}}" name="reject-order_creation_{{$portfolio->id}}" value="0">
                                                            <label for="order_creation_{{$portfolio->id}}">Issue in Order Creation</label>
                                                        </div>

                                                        <div class="form-group custom-checkbox mr-10">
                                                            <input type="checkbox" id="order_payment_{{$portfolio->id}}" name="reject-order_payment_{{$portfolio->id}}" value="0">
                                                            <label for="order_payment_{{$portfolio->id}}">Issue in Payment</label>
                                                        </div>



                                                </div>
                                                <div class="col-12 d-flex flex-wrap">
                                                    <div class="col-md-6 order_creation_{{$portfolio->id}}" readonly>
                                                        <div class="form-group mb-3">
                                                            <label>Issue in Order Creation :: Reject Reason</label>
                                                            <textarea class="form-control reject_reason" name="order_creation-reason_{{$portfolio->id}}" rows="4" placeholder="Add Comment"></textarea>

                                                        </div>

                                                    </div>
                                                    <div class="col-md-6 order_payment_{{$portfolio->id}}" readonly>
                                                        <div class="form-group mb-3">
                                                            <label>Issue in Payment :: Reject Reason</label>
                                                            <textarea class="form-control reject_reason" name="order_payment-reason_{{$portfolio->id}}" rows="4" placeholder="Add Comment"></textarea>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary col-sm-3 proceed reject_button" disabled>Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="modal fade" id="RejectModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
                                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog  modal-lg"><!-- modal-lg-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Rejection Reason</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            @foreach ($client->portfolios as $portfolio)
                                            <div class="row mb-3">
                                                <div class="col-12">
                                                    <h4 class="form-section-title float-left text-uppercase text-grey ml-3">{{ $portfolio->fund_category }}</h4>
                                                </div>
                                                <div class="col-12 d-flex flex-wrap">
                                                    <div class="col-md-6">
                                                        <div class="form-group custom-checkbox float-left ml-3">
                                                            <input type="checkbox" id="issue_order_{{ $portfolio->id }}" name="reject-issue_order_{{ $portfolio->id }}" value="0">
                                                            <label for="issue_order_{{ $portfolio->id }}">Issue in Order Creation</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group custom-checkbox float-left ml-3">
                                                            <input type="checkbox" id="issue_payment_{{ $portfolio->id }}" name="reject-issue_payment_{{ $portfolio->id }}" value="0">
                                                            <label for="issue_payment_{{ $portfolio->id }}">Issue in Payment</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 d-flex flex-wrap">
                                                    <div class="col-md-6 order-issue_order_{{ $portfolio->id }}" readonly>
                                                        <div class="form-group mb-3">
                                                            <textarea class="form-control" name="order-issue_order_{{ $portfolio->id }}" rows="4" placeholder="Add Comment"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 order-issue_payment_{{ $portfolio->id }}" readonly>
                                                        <div class="form-group mb-3">
                                                            <textarea class="form-control" name="order-issue_payment_{{ $portfolio->id }}" rows="4" placeholder="Add Comment"></textarea>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                            @endforeach
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="proceed btn btn-primary btn-lg" style="min-width: 11rem">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        @endif
                    </div>
                </div>
            </div>
            @php
                $j++;
            @endphp
            @endforeach
        </div>
    </form>
</div>
@endsection

@section('modal')
<div class="modal fade" id="showSchemeLog" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"><span id="scheme_log_name"></span> </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row form-sections">
                    {{-- <div class="col-12">
                        <h4 class="form-section-title text-uppercase text-grey">Associate Logs</h4>
                    </div> --}}
                    <div class="col-12">
                        <div class="card small-card option-2 mb-4">
                            <div class="card-header">
                                <h6 class="card-title">View Logs</h6>
                            </div>
                            <div class="card-body">
                                <div class="transaction-wrapper trade-status" id="status_log">

                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary col-sm-3"  data-dismiss="modal" aria-label="Close">Close</button>
            </div>
        </div>
    </div>
</div>


@endsection

@section('script')
<script>
    $(".reject-now").on("click", function(e) {
        $("#userstatus").val('1');
        $('#RejectModal').modal('show');
    });

    $('#RejectModal').on('hidden.bs.modal', function () {
        $("#userstatus").val('0');
    });

    function statusSchemeLog(id)
    {
        $.get("/confirmorderbuy?log_id="+id, function(data, status){
            console.log(data.kbs_scheme.name);
            $("#status_log").empty();
            //$("#scheme_log_name").html(data.kbs_scheme.name);
            let log = '';
            $.each(data.trade_scheme_logs, function(i, o){

                var todaydate = new Date(o.log_date);  //pass val varible in Date(val)
                var dd = todaydate .getDate();
                var mm = todaydate .getMonth()+1; //January is 0!
                var yyyy = todaydate .getFullYear();
                if(dd<10){  dd='0'+dd }
                if(mm<10){  mm='0'+mm }
                var date = dd+'-'+mm+'-'+yyyy;

                log += '<div class="transaction-steps">';
                log += '<div class="trade-title mb-2">';
                log += '<h4 class="mb-0">'+o.remark+'</h4>';
                log += '<div class="info">';
                log += '<span>'+date+'</span>';
                log += '<span>'+o.log_time+'</span>';
                log += '</div>';
                log += '</div>';
                log += '</div>';
            });
            $("#scheme_log_name").html(data.kbs_scheme.name);
            $('#status_log').html(log);
            $('#showSchemeLog').modal('show');
        });
    }

    function goto_next()
    {
        let active_count = $("#transaction_nav li a.active").attr('data-count');
        let total_count = $("#transaction_content").attr('data-total-count');
        let new_active_count = parseInt(active_count) + 1;
        let href = '';
        if(active_count != total_count)
        {
            $("#transaction_nav li").each(function(i){
                //console.log($(this).find('a').attr('data-count'), new_active_count);
                $a_attr = $(this).find('a');
                if($a_attr.attr('data-count') == new_active_count)
                {
                    href = $a_attr.attr('href');
                    $('[href="'+href+'"]').tab('show');
                }
            });
        }
    }


</script>
<script>

$('#RejectionModal input[type="checkbox"]').change(function() {
    let id =  $(this).attr('id');
    if($(this).is(":checked")) {
        $(this).val(1);
        //$('#is_reject').val(1);
        $('.'+id).attr('readonly', false);
    }else{

        $(this).val(0);
        $('.'+id).attr('readonly', true);
    }
    $checked_count = $('#RejectionModal input[type="checkbox"]:checked').length;
    //console.log($checked_count);
    if($checked_count != 0)
    {
        $('#is_reject').val(1);
    }else{
        $('#is_reject').val(0);
    }
    $('#textbox1').val($(this).is(':checked'));
});

$(".reject_reason").on("keyup", function(e) {
    let text = $(this).val();
    let count = 0;
    if(text.length == 0)
    {
        $("textarea.reject_reason").each(function(){

            if(!$(this).parent().parent().attr('readonly'))
            {
                //$(this).parent().parent().addClass('sddd');
                if(this.value)
                {
                    count++;
                }
            }


        });
        if(count > 0)
        {
            $(".reject_button").attr('disabled', false);
        }else{
            $(".reject_button").attr('disabled', true);
        }
    }
    else{
        $(".reject_button").attr('disabled', false);
    }

});

$('#RejectionModal').on('hidden.bs.modal', function () {
    $('#is_reject').val(0);
});
    $( "form#buy_portfolio_details" ).submit(function(e) {
        e.preventDefault();
        let form = $(this);
        let url = form.attr('action');
        let data = new FormData( form[ 0 ] );//form.serialize();
        let post = form.attr('method');
        let url_payment = url+'/'+$("input[name=trans_param]").val();
        let data_payment = $("#buy_portfolio_details :input[name!='_token']").serialize();
        $(".error").remove();
        let count = 0;

        $("textarea.reject_reason").each(function(){

            if(!$(this).parent().parent().attr('readonly'))
            {
                //$(this).parent().parent().addClass('sddd');
                if(!this.value)
                {
                    count++;
                    $(this).parent().append('<label class="error">Please add reject reason</label>');
                }
            }

        });
        if(count > 0)
        {
            return false;
        }
        return false;

        $('.error').removeClass('error');
        $('.err').removeClass('err');
        $('.span_err').remove();
        $.ajax({
            type: post,
            url: url,
            data: data,
            //async: false,
            beforeSend: function() {
                $("#loading p.message_target").html('Please wait, Order Creation in process');
                $('#loading').show();
            },
            success:function(data) {
                //$('#loading').show();
                $('#loading').hide();
                console.log(data);
                return false;
                if(data.status == 'order_failed')
                {
                    window.location.replace("/confirmorderbuy/failed/message");
                    $('#loading').hide();
                }
                if(data.status == 'order_created')
                {
                    $.ajax({

                        type: "PATCH",
                        url: url_payment,

                        headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            'trans_param': $("input[name='trans_param']").val()
                        },
                        //async: false,
                        beforeSend: function() {
                            $("#loading p.message_target").html('Please wait, Order processed and initiating the payment');
                            $('#loading').show();
                        },
                        success:function(data) {
                            //$('#loading').show();
                            console.log(data);

                            // if(data.status == 'order_created')
                            // {
                            //     $("#loading p.message_target").html('Please wait, Order processed and initiating the payment');

                            // }

                            return false;
                        },
                        error: function(xhr, textStatus, thrownError)
                        {

                            var response = jQuery.parseJSON(xhr.responseText);

                            console.log(response);
                            if(response.server_errors)
                            {
                                let error_data = '<ul class="alerts-lists">';
                                //console.log(response.server_errors);
                                if (response.server_errors.length === undefined || response.server_errors.length === null) {
                                    $.each( response.server_errors, function( k, v ) {
                                        error_data += '<li>'+v+'</li>';
                                    });
                                }else{
                                    error_data += response.server_errors;
                                }

                                error_data += '</ul>';
                                $("#error_modal .card .card-body").html(error_data);
                                $('#error_modal').modal('show');
                            }
                            if(response.errors)
                            {
                                $.each( response.errors, function( k, v ) {
                                    $('.'+k).children().not("div.exclude").not("label").not("span").append("<label id='"+k+"_error' class='error span_err'>"+v+"</label>");
                                });
                            }

                        },
                        cache: false,
                        contentType: false,
                        processData: false,
                    });
                }

                return false;
            },
            error: function(xhr, textStatus, thrownError)
            {
                $('#loading').hide();
                var response = jQuery.parseJSON(xhr.responseText);

                console.log(response);

                if(response.server_errors)
                {
                    let error_data = '<ul class="alerts-lists">';
                    //console.log(response.server_errors);
                    if (response.server_errors.length === undefined || response.server_errors.length === null) {
                        $.each( response.server_errors, function( k, v ) {
                            error_data += '<li>'+v+'</li>';
                        });
                    }else{
                        error_data += response.server_errors;
                    }

                    error_data += '</ul>';
                    //console.log(error_data);
                    $("#error_modal .card .card-body").html(error_data);
                    $('#error_modal').modal('show');
                }
                if(response.errors)
                {
                    $.each( response.errors, function( k, v ) {
                        $('.'+k).children().not("div.exclude").not("label").not("span").append("<label id='"+k+"_error' class='error span_err'>"+v+"</label>");
                    });
                }
                return false;
            },
            cache: false,
            contentType: false,
            processData: false,
        });
        return false;
    });
</script>
@endsection
