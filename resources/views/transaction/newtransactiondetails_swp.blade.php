@extends('layouts.master')

@section('style')
<style>
    .dynamic .transaction-steps.current::before {
    background: var(--secondary, #ffd8b3);
}
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
                    $amount = '';
                    $status = $client->trans_status;
                    $withdrawal_amount = '';
                    $swp_start_date = '';
                    $available = 0;
                    if($client->amount > 0)
                    {
                        $amount = $client->amount;
                        $available++;
                    }
                    if($client->withdrawal_amount > 0)
                    {
                        $withdrawal_amount = $client->withdrawal_amount;
                        $available++;
                    }
                    if($client->swp_start_date)
                    {
                        $swp_start_date = \Carbon\Carbon::parse($client->swp_start_date)->format('d-m-Y');
                        $available++;
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
                        <input type="hidden" name="transaction_plan" id="transaction_plan" value="{{ $client->type }}">
                        <input type="hidden" name="transaction_status" id="transaction_status" value="{{ $status }}">
                        <div class="form-inner-section">
                            <div class="form-header">
                                <h3 class="card-title">Portfolio 1: <span class="text-uppercase">{{ $client->fund_category }}</span></h3>
                            </div>
                            <div class="form-content">
                                <div class="transaction-wrapper dynamic">
                                    <div class="transaction-steps @if($available > 0) {{'current line'}} @endif">
                                        <div class="row">
                                            <div class="col-xl-4 col-md-6 amount1">
                                                <div class="form-group">
                                                    <label>Enter Amount</label>
                                                    <input type="text" class="form-control amount" id="amount" name="amount" placeholder="Enter Amount" value="{{ $amount }}">
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-md-6 withdrawal_amount1">
                                                <div class="form-group">
                                                    <label>Enter Withdrawal Amount</label>
                                                    <input type="text" class="form-control amount" id="withdrawal_amount" name="withdrawal_amount" placeholder="Enter Amount" value="{{ $withdrawal_amount }}">
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-md-6 swp_start_date1">
                                                <div class="form-group">
                                                    <label>SWP Start date</label>
                                                    <input type="text" class="form-control" id="swp_start_date" name="swp_start_date" placeholder="Select Date" value="{{ $swp_start_date }}">
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-md-6 allocation1">
                                                <div class="form-group">
                                                    <label>Allocation</label>
                                                    <select class="form-control" name="allocation" id="swp_allocation">
                                                        <option value="" selected disabled>- Select -</option>
                                                        <option value="Recommended" @if($allocation_type == 'Recommended'){{ 'selected' }} @endif>Recommended ({{ $client->client_profile->equity_ratio_lumpsum }}:{{ $client->client_profile->debt_ratio_lumpsum }})</option>
                                                        <option value="Custom" @if($allocation_type == 'Custom') {{ 'selected' }} @endif>Custom</option>
                                                    </select>
                                                    {{-- <select class="form-control" name="sip_frequency" id="sip_frequency">
                                                        <option value="" selected disabled>- Select -</option>
                                                        <option value="daily">DAILY</option>
                                                        <option value="monthly">MONTHLY</option>
                                                        <option value="quarterly">QUARTERLY</option>
                                                        <option value="annually">ANNUALLY</option>
                                                    </select> --}}
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-md-6 equity_ratio1">
                                                <div class="form-group">
                                                    <label>Equity Ratio</label>
                                                    <select class="form-control" id="equity_ratio" name="equity_ratio" @if($allocation_type != 'Custom') {{ 'readonly' }} @endif>
                                                        @include('transaction.transaction_ratio', ['val' => $equity_ratio])
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-footer ">
                                <a href="{{ route('transaction.index',['allocation_id' => $client->buy_id,'type' => 'details', 'subtype' => 'allocation', 'maintype' => $client->fund_category, 'status' => 0]) }}" class="btn btn-link view_allocation @if($available == 0) {{'disabled'}} @endif"><svg width="30" height="30" viewBox="0 0 24 24">
                                    <use xlink:href="#allocation"></use>
                                </svg>View Allocation</a>
                                <button type="submit" class="btn btn-primary btn-lg ml-4 proceed @if($available == 0) {{'disabled'}} @endif">Proceed</button>
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
    $(document).ready(function() {
    $(".amount").trigger('keyup');
});
    $('input[name="swp_start_date"]').datepicker({
        autoclose: true,
        format: "dd-mm-yyyy"
    });
    // $('#allocation').select2({
    //         width: '100%',
    //         minimumResultsForSearch: 5
    //     });
    $('form input').keydown(function (e) {
    if (e.keyCode == 13) {
        e.preventDefault();
        return false;
    }
});

$('form input').on('keyup', function(e) {
    let val = e.target.value;
    let status = $("#transaction_status").val();
    if(val && status == 1)
    {
        savetempfile();
    }
});

$('form input[name="swp_start_date"]').on('change', function(e) {
    let val = e.target.value;
    //console.log(val);
    let status = $("#transaction_status").val();
    if(val && status == 1)
    {
        savetempfile();
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
    $(document).on('change', '#swp_allocation', function (e) {
        let val = e.target.value;

        if(val)
        {
            let error = 0;
            $('.error').removeClass('error');
            $('.span_err').remove();

            error = validatestep1(error);

            if(error > 0)
            {
                //$("#sip_frequency").val("").trigger('change');
                $("#swp_allocation").val("").trigger('change');
                return false;
            }

            if(val == 'Custom')
            {
                $(".view_allocation").addClass('disabled');
                $(".proceed").addClass('disabled');
                $("#equity_ratio").attr('readonly', false);
            }else{
                $(".view_allocation").removeClass('disabled');
                $(".proceed").removeClass('disabled');
                let text = $(this).find('option:selected').text();
                let pos = text.indexOf("(") + 1;
                text.slice(pos, -1);
                let ratio = text.slice(pos, text.lastIndexOf(")"));
                let split_ratio = ratio.split(":");
                $("#equity").val(split_ratio[0]);
                $("#debt").val(split_ratio[1]);
                $("#equity_ratio").val("").trigger('change');
                $("#equity_ratio").attr('readonly', true);
                savetempfile();
            }
        }
    });

    $(document).on('change', '#equity_ratio', function (e) {
        let equity_val = e.target.value;
        if(equity_val != '')
        {
            $(".view_allocation").removeClass('disabled');
            $(".proceed").removeClass('disabled');
            let debt_val = 100 - equity_val;
            $("#equity").val(equity_val);
            $("#debt").val(debt_val);
            savetempfile();
        }
    });

    function savetempfile()
    {
        let post = $('form#portfolio_details').attr('method');
        let url = $('form#portfolio_details').attr('action');
        let formData = new FormData($('#portfolio_details')[0]);
        console.log(post,url);
        ////return false;
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

    function validatestep1(error)
    {
        let amount = $("#amount").val();
        if(!amount || amount <= 0)
        {
            error++;
            $('.amount1').children().not("label").not("span").append("<label id='amount_error' class='error span_err'>Please enter amount</label>");
        }
        let withdrawal_amount = $("#withdrawal_amount").val();

        if(!withdrawal_amount || withdrawal_amount <= 0)
        {
            error++;
            $('.withdrawal_amount1').children().not("label").not("span").append("<label id='amount_error' class='error span_err'>Please enter amount</label>");
        }

        let swp_start_date = $("#swp_start_date").val();

        if(!swp_start_date)
        {
            error++;
            $('.swp_start_date1').children().not("label").not("span").append("<label id='amount_error' class='error span_err'>Select Date</label>");
        }

        return error;
    }



    //sip_start_date_fixed

</script>
@endsection
