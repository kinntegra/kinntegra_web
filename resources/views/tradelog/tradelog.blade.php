@extends('layouts.master')

@section('style')
@endsection


@section('content')
<div class="container-fluid">
    <div class="table-top-section d-md-flex justify-content-between align-items-center mb-4">
        <a class="back-btn" href="#">
            <i class="icon-left-arrow"></i>
            {{ $client->name }} - Trade Details <span class="badge badge-info badge-pill ml-3">{{ $client->client_trade_status }}</span>
        </a>
        <div class="section-header mt-3 mt-md-0">
            <a class="btn btn-link" data-toggle="modal" data-target="#resend"><svg width="30" height="30"
                    viewBox="0 0 24 24">
                    <use xlink:href="#payment"></use>
                </svg>Resend Payment</a>
            <a class="btn btn-link"><svg width="30" height="30" viewBox="0 0 24 24">
                    <use xlink:href="#mail"></use>
                </svg>Resend Email</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card small-card option-2 option-2 mb-4">
                <div class="card-header">
                    <h6 class="card-title">Portfolio Details</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-2 col-sm-6">
                            <div class="form-group mb-3 mb-sm-0">
                                <label>Amount</label>
                                <input type="text" readonly class="form-control-plaintext font-bold"
                                    value="₹{{ $client->format_amount }}">
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6">
                            <div class="form-group mb-3 mb-sm-0">
                                <label>Transaction Type</label>
                                <input type="text" readonly class="form-control-plaintext font-bold"
                                    value="{{ $client->trans_type_format }}, {{ $client->transaction_type }}">
                            </div>
                        </div>
                        <div class="col-xl-2 col-sm-6">
                            <div class="form-group mb-3 mb-sm-0">
                                <label>Portfolio</label>
                                <input type="text" readonly class="form-control-plaintext font-bold"
                                    value="{{ $client->fund_category }}">
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6">
                            <div class="form-group mb-3 mb-sm-0">
                                <label>Mode of Payment</label>
                                <input type="text" readonly class="form-control-plaintext font-bold"
                                    value="{{ $client->payment_mode }}">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        @php
            //dd($client);
        @endphp
        <div class="col-md-6">
            <div class="card small-card option-2 mb-4">
                <div class="card-header">
                    <h6 class="card-title">Client Review</h6>
                    <a href="{{ route('transaction.payment.show',['transaction' => $client->trans_session,'payment' => strtolower($client->trade_type)]) }}" class="btn"><svg width="25" height="25" viewBox="0 0 24 24">
                            <use xlink:href="#edit"></use>
                        </svg>Modify </a>
                </div>
                <div class="card-body">
                    <div class="form-group mb-3 mb-sm-0">
                        <label>Remark</label>
                        <input type="text" readonly class="form-control-plaintext font-bold"
                            value="{{ $client->description }}">
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
                                    <th>Reg Id</th>
                                    <th>Scheme Name</th>
                                    <th>Amount</th>
                                    <th>Allocation</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($funds as $fund)
                                    <tr>
                                        <td data-title="Folio Number">
                                            @if ($fund->folio_number)

                                            @else
                                            {{ 'New Folio' }}
                                            @endif

                                        </td>
                                        <td data-title="Reg Id">
                                            {{ $fund->bse_order_id }}
                                        </td>
                                        <td data-title="Scheme Name">
                                            {{ $fund->name }}
                                        </td>
                                        <td data-title="Amount">
                                            ₹{{ $fund->format_amount }}
                                        </td>
                                        <td data-title="Allocation">
                                            {{ $fund->allocation_percentage }}%
                                        </td>
                                        <td data-title="Status" onClick="statusSchemeLog({{$fund->id}})">
                                            @if($fund->trade_status == 'InProcess' || $fund->trade_status == 'Open')
                                                <span class="badge badge-info badge-pill">{{ $fund->trade_status }}  <i class="icon-link-arrow"></i></span>
                                            @elseif ($fund->trade_status == 'Failed')
                                                <span class="badge badge-danger badge-pill">{{ $fund->trade_status }}  <i class="icon-link-arrow"></i></span>
                                            @endif

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
                    <p>{{ $client->traderational->rational }}</p>
                </div>
            </div>
            <div class="card small-card option-2 mb-4">
                <div class="card-header">
                    <h6 class="card-title">Comments</h6>
                </div>
                <div class="card-body">
                    <p>@if($client->comment){{$client->comment}}@else{{'No Comment added by Customer'}} @endif</p>
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
                        @foreach ($client->logs as $log)
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
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="col-12 text-right">
            <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#form-status">Save and
                Next</button>
        </div> --}}
    </div>
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
</script>
@endsection
