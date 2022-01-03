@extends('layouts.master')

@section('style')
<style>
    .selected_otm,.selected_neft_rtgs,.selected_net_banking,.selected_cheque{
        display: none;
    }
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
                    $portfolio_count = 0;
                    $trans_type = '';
                    $transaction_client_ids = [];
                    $pending_status = $client->status == 'completed' ? 0 : 1;
                    if ($client->trans_type == "P")
                    $trans_type = 'Buy';
                    elseif ($client->trans_type == "R")
                    $trans_type = 'Sell';
                    elseif ($client->trans_type == "S")
                    $trans_type = 'Switch';
                    $pfcount = count($client->portfolios);
                    //dd($pcount);
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
                                        <td  class="text-capitalize">{{ $client->type }}</td>
                                    </tr>
                                    <tr>
                                        <th>Portfolio</th>
                                        <td  class="text-capitalize">{{ $client->view_portfolio }}</td>
                                    </tr>
                                    <tr>
                                        <th>Market Value</th>
                                        <td>₹{{ $client->total_amount }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-xl-9 step-forms col-md-8 pl-0 pr-0 pr-sm-3">
                    <form class="trial active" enctype="multipart/form-data" id="form-information" method="POST" action="{{ route('transaction.payment.store', $client->trans_session) }}">
                        @csrf
                        <input type="hidden" name="type" value="payment">
                        <input type="hidden" name="id" value="{{ $client->id }}">
                        <input type="hidden" name="transaction_client" value="{{ $client->client_id }}">
                        <input type="hidden" name="transactionsession" value="{{ $client->trans_session }}">
                        <input type="hidden" name="transaction_plan" value="{{ $client->type }}">


                        <div class="form-inner-section">
                            <div class="form-header">
                                <h3 class="card-title">Make Payment</h3>
                            </div>
                            <div class="form-content">
                                @php

                                @endphp
                                @foreach ($client->portfolios as $portfolio)
                                @if($portfolio->trans_status == 1 && $portfolio->sip_added_parent_id == 0)
                                @php
                                    $transaction_client_ids[$portfolio->id] = $portfolio->fund_category;
                                    $portfolio_count++;
                                @endphp
                                <div class="card small-card mb-4">
                                    <div class="card-header">
                                        <h6 class="card-title">Portfolio 1: <span class="text-capitalize">{{ $portfolio->fund_category }}</span></h6>
                                        <div>
                                            <a href="{{ route('transaction.type.show',['transaction'=>strtolower($client->type),'type'=>strtolower($portfolio->fund_category),'id' => \App\Services\Security::encryptData($portfolio->id)]) }}" class="btn btn-link"><svg width="30" height="30"
                                                viewBox="0 0 24 24">
                                                <use xlink:href="#edit"></use>
                                            </svg>Edit </a>
                                            <a href="#" onclick="deletetransaction({{$portfolio->id}})" class="btn btn-link"><svg width="30" height="30"
                                                viewBox="0 0 24 24">
                                                <use xlink:href="#delete-icon"></use>
                                            </svg>Delete </a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <div class="form-group mb-3 mb-sm-0">
                                                    <label>Amount</label>
                                                    <input type="text" readonly class="form-control-plaintext font-bold"
                                                        value="₹ {{ $portfolio->amount }} ({{ $portfolio->equity }}: {{$portfolio->debt}})">
                                                </div>
                                            </div>
                                            @if($portfolio->sip_added == true)
                                            <div class="col-sm-3">
                                                <div class="form-group mb-3 mb-sm-0">
                                                    <label>Added SIP</label>
                                                    <input type="text" readonly
                                                        class="form-control-plaintext font-bold"
                                                        value="R 10,000 (80:20)">
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group mb-3 mb-sm-0">
                                                    <label>SIP Start Date</label>
                                                    <input type="text" readonly
                                                        class="form-control-plaintext font-bold"
                                                        value="22 Mar 2020">
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @endforeach

                                <input type="hidden" name="portfolio_count" value="{{ $portfolio_count }}">
                                <div class="radio-collapse">
                                    <div class="payment-section @if(old('payment') == null) {{'selected'}} @else @if(old('payment') == 'OTM') {{'selected'}} @endif @endif mb-2">
                                        <div class="form-group custom-radio-btn mb-0">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="payment" id="otm" value="OTM" {{ (old('payment') == 'OTM') ? 'checked' : '' }} @if(old('payment') == null) {{'checked'}} @endif>
                                                <label class="form-check-label" for="otm">OTM <span class="badge badge-success badge-pill ml-2">Recommended</span></label>
                                            </div>
                                        </div>
                                        <div class="payment-form">
                                            <div class="row">
                                                <div class="col-xl-4 col-md-6 mb-3">
                                                    <div class="form-group mb-0">
                                                        <label>Mandate</label>
                                                        <select class="form-control" name="otm_mandate" id="otm_mandate">
                                                            <option value="" disabled selected>Select OTM</option>
                                                            @foreach ($client->mandates as $mandate)
                                                                <option value="{{ $mandate->bse_mandate_id }}" @if(old('otm_mandate') == $mandate->bse_mandate_id) {{'selected'}} @endif>{{ $mandate->bse_mandate_id }} - {{$mandate->amount}} ({{$mandate->client_bank->bank_name}})</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="payment-section mb-2">
                                        <div class="form-group custom-radio-btn mb-0">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="payment"
                                                    id="emandate" value="emandate">
                                                <label class="form-check-label" for="emandate">E-Mandate</label>
                                            </div>
                                        </div>
                                    </div> --}}
                                    <div class="payment-section @if(old('payment') == 'NEFT/RTGS') {{'selected'}} @endif mb-2">
                                        <div class="form-group custom-radio-btn mb-0">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="payment"
                                                    id="NEFT/RTGS" value="NEFT/RTGS" {{ (old('payment') == 'NEFT/RTGS') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="NEFT/RTGS">NEFT & RTGS</label>
                                            </div>
                                        </div>
                                        <div class="payment-form">
                                            <div class="row">
                                                <div class="col-xl-4 col-md-6 mb-3">
                                                    <div class="form-group mb-0">
                                                        <label>UTR NO</label>
                                                        <input type="text" class="form-control" name="utr_number" id="utr_number" placeholder="Enter UTR Number" value="{{ old('utr_number', '') }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="payment-section @if(old('payment') == 'Net Banking') {{'selected'}} @endif mb-2">
                                        <div class="form-group custom-radio-btn mb-0">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="payment"
                                                    id="Net Banking" value="Net Banking" {{ (old('payment') == 'Net Banking') ? 'checked' : '' }}>
                                                <label class="form-check-label"
                                                    for="Net Banking">Net Banking</label>
                                            </div>
                                        </div>
                                        <div class="payment-form">
                                            <div class="row">
                                                <div class="col-xl-4 col-md-6">
                                                    <div class="form-group mb-0">
                                                        <label>Bank</label>
                                                        <select class="form-control" name="net_bank_id" id="net_bank_id">
                                                            <option value="" disabled selected>Select Bank</option>
                                                            @foreach ($client->client_profile->banks as $bank)
                                                                <option value="{{ $bank->id }}" @if(old('net_bank_id') == $bank->id) {{'selected'}} @endif>{{ $bank->bank_name }} ({{ $bank->account_no }})</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="payment-section @if(old('payment') == 'Cheque') {{'selected'}} @endif mb-2">
                                        <div class="form-group custom-radio-btn mb-0">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="payment" id="Cheque" value="Cheque" {{ (old('payment') == 'Cheque') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="Cheque">Cheque</label>
                                            </div>
                                        </div>
                                        <div class="payment-form">
                                            <div class="row">
                                                <div class="col-xl-4 col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label>Amount</label>
                                                        <input type="text" class="form-control amount" name="cheque_amount" id="cheque_amount" placeholder="Enter Amount" value="{{ $client->total_amount }}" readonly>
                                                        <small class="text-muted inwords"></small>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label>Cheque Number</label>
                                                        <input type="text" class="form-control" name="cheque_number" id="cheque_number" placeholder="Enter Cheque Number" value="{{ old('cheque_number', '') }}">
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label>Cheque Date</label>
                                                        <input type="text" class="form-control cheque_date" name="cheque_date" id="cheque_date" placeholder="Enter Cheque Date" value="{{ old('cheque_date', '') }}">
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-md-6">
                                                    <div class="form-group mb-0">
                                                        <label>Bank</label>
                                                        <select class="form-control" name="cheque_bank_id" id="cheque_bank_id">
                                                            <option value="" disabled selected>Select Bank</option>
                                                            @foreach ($client->client_profile->banks as $bank)
                                                                <option value="{{ $bank->id }}" @if(old('cheque_bank_id') == $bank->id) {{'selected'}} @endif>{{ $bank->bank_name }} ({{ $bank->account_no }})</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-md-6">
                                                    <div class="form-group mb-0">
                                                        <label for="cheque_upload">Investment Cheque</label>
                                                        <label for="cheque_upload"
                                                            class="btn upload-btn w-100">
                                                            <input name="cheque_upload" id="cheque_upload" type="file" />
                                                            <div class="left-side">
                                                                <span class="default-text">Upload Investment Cheque</span>
                                                                <span class="value"></span>
                                                            </div>
                                                            <svg class="upload-icon" width="30" height="30"
                                                                viewBox="0 0 24 24">
                                                                <use xlink:href="#upload" />
                                                            </svg>
                                                            <a class="delete-icon"><i class="icon-close"></i></a>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if($pfcount > 1)
                                    <div class="payment-section @if(old('payment') == 'multiple_payment') {{'selected'}} @endif mb-2" id="multiple_payment">
                                        <div class="form-group custom-radio-btn mb-0">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="payment"
                                                    id="multiple" value="multiple_payment" {{ (old('payment') == 'multiple_payment') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="multiple">Multiple Payment Modes</label>
                                            </div>
                                        </div>
                                        <div class="payment-form">
                                            @php
                                                $portfolios_ids = json_encode($transaction_client_ids);
                                            @endphp
                                            <input type="hidden" name="multiple_payment_ids" value="{{ $portfolios_ids }}">
                                            @foreach ($client->portfolios as $portfolio)
                                            @if($portfolio->trans_status == 1 && $portfolio->sip_added_parent_id == 0)
                                            <div class="row mb-4">
                                                <div class="col-xl-4 col-md-6">
                                                    <div class="form-group mb-0">
                                                        <label>Payment Mode for <span class="text-capitalize">{{ $portfolio->fund_category }}</span></label>
                                                        @php
                                                            $multi_payment = 'multi_payment_'.$portfolio->id;
                                                        @endphp
                                                        <select class="form-control multi_payment" name="multi_payment_{{ $portfolio->id }}" id="multi_payment_{{ $portfolio->id }}">
                                                            <option value="" disabled selected>Select Payment Type</option>
                                                            <option value="OTM" @if(old($multi_payment) == 'OTM') {{'selected'}} @endif>OTM</option>
                                                            {{-- <option value="EMANDATE" @if(old($multi_payment) == 'EMANDATE') {{'selected'}} @endif>EMandate</option> --}}
                                                            <option value="NEFT/RTGS" @if(old($multi_payment) == 'NEFT/RTGS') {{'selected'}} @endif>NEFT & RTGS</option>
                                                            <option value="Net Banking" @if(old($multi_payment) == 'Net Banking') {{'selected'}} @endif>Net Banking</option>
                                                            <option value="Cheque" @if(old($multi_payment) == 'Cheque') {{'selected'}} @endif>Cheque</option>
                                                            {{-- <option value="Direct Credit">Direct Credit</option> --}}
                                                        </select>
                                                    </div>
                                                </div>
                                                <!-- OTM Mandate -->
                                                <div class="col-xl-4 col-md-6 @if(old($multi_payment) != 'OTM'){{'d-none'}}@endif selected_otm_{{ $portfolio->id }}">
                                                    <div class="form-group mb-0">
                                                        <label>Mandate</label>
                                                        <select class="form-control" name="otm_mandate_{{ $portfolio->id }}" id="otm_mandate_{{ $portfolio->id }}">
                                                            <option value="" disabled selected>Select OTM</option>
                                                            @foreach ($client->mandates as $mandate)
                                                                <option value="{{ $mandate->bse_mandate_id }}">{{ $mandate->bse_mandate_id }} - {{$mandate->amount}} ({{$mandate->client_bank->bank_name}})</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <!-- End -->
                                                <!-- NEFT/RTGS -->
                                                <div class="col-xl-4 col-md-6 @if(old($multi_payment) != 'NEFT/RTGS'){{'d-none'}}@endif selected_neft_rtgs_{{ $portfolio->id }}">
                                                    <div class="form-group mb-0">
                                                        <label>UTR NO</label>
                                                        <input type="text" class="form-control" name="utr_number_{{ $portfolio->id }}" id="utr_number_{{ $portfolio->id }}" placeholder="Enter UTR Number">
                                                    </div>
                                                </div>
                                                <!-- End -->
                                                <!-- Net Banking -->
                                                <div class="col-xl-4 col-md-6 @if(old($multi_payment) != 'Net Banking'){{'d-none'}}@endif selected_net_banking_{{ $portfolio->id }}">
                                                    <div class="form-group mb-0">
                                                        <label>Bank</label>
                                                        <select class="form-control" name="net_bank_id_{{ $portfolio->id }}" id="net_bank_id_{{ $portfolio->id }}">
                                                            <option value="" disabled selected>Select Bank</option>
                                                            @foreach ($client->client_profile->banks as $bank)
                                                                <option value="{{ $bank->id }}">{{ $bank->bank_name }} ({{ $bank->account_no }})</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <!-- End -->
                                                <!-- Cheque -->
                                                <div class="col-xl-4 col-md-6 @if(old($multi_payment) != 'Cheque'){{'d-none'}}@endif selected_cheque_{{ $portfolio->id }}">
                                                    <div class="form-group mb-0">
                                                        <label>Amount</label>
                                                        <input type="text" class="form-control amount" name="cheque_amount_{{ $portfolio->id }}" id="cheque_amount_{{ $portfolio->id }}" placeholder="Enter Amount" value="{{ $portfolio->amount }}" readonly>
                                                        <small class="text-muted inwords"></small>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-md-6 @if(old($multi_payment) != 'Cheque'){{'d-none'}}@endif selected_cheque_{{ $portfolio->id }}">
                                                    <div class="form-group mb-0">
                                                        <label>Cheque Number</label>
                                                        <input type="text" class="form-control multi_cheque_number" name="cheque_number_{{ $portfolio->id }}" id="cheque_number_{{ $portfolio->id }}" placeholder="Enter Cheque Number">
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-md-6 @if(old($multi_payment) != 'Cheque'){{'d-none'}}@endif selected_cheque_{{ $portfolio->id }}">
                                                    <div class="form-group mb-0">
                                                        <label>Cheque Date</label>
                                                        <input type="text" class="form-control cheque_date" name="cheque_date_{{ $portfolio->id }}" id="cheque_date_{{ $portfolio->id }}" placeholder="Enter Cheque Date">
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-md-6 @if(old($multi_payment) != 'Cheque'){{'d-none'}}@endif selected_cheque_{{ $portfolio->id }}">
                                                    <div class="form-group mb-0">
                                                        <label>Bank</label>
                                                        <select class="form-control" name="cheque_bank_id_{{ $portfolio->id }}" id="cheque_bank_id_{{ $portfolio->id }}">
                                                            <option value="" disabled selected>Select Bank</option>
                                                            @foreach ($client->client_profile->banks as $bank)
                                                                <option value="{{ $bank->id }}">{{ $bank->bank_name }} ({{ $bank->account_no }})</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-md-6 @if(old($multi_payment) != 'Cheque'){{'d-none'}}@endif selected_cheque_{{ $portfolio->id }}">
                                                    <div class="form-group mb-0">
                                                        <label for="cheque_upload_{{ $portfolio->id }}">Investment Cheque</label>
                                                        <label for="cheque_upload_{{ $portfolio->id }}" class="btn upload-btn w-100">
                                                            <input id="cheque_upload_{{ $portfolio->id }}" name="cheque_upload_{{ $portfolio->id }}" type="file" />
                                                            <div class="left-side">
                                                                <span class="default-text">Upload Investment Cheque</span>
                                                                <span class="value"></span>
                                                            </div>
                                                            <svg class="upload-icon" width="30" height="30"
                                                                viewBox="0 0 24 24">
                                                                <use xlink:href="#upload" />
                                                            </svg>
                                                            <a class="delete-icon"><i class="icon-close"></i></a>
                                                        </label>
                                                    </div>
                                                </div>
                                                <!-- End -->

                                            </div>
                                            @endif
                                            @endforeach

                                            {{-- <div class="row">
                                                <div class="col-xl-4 col-md-6">
                                                    <div class="form-group mb-0">
                                                        <label>Payment Mode for Wealth</label>
                                                        <select class="form-control">
                                                            <option>OTM</option>
                                                            <option>OTM</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-md-6">
                                                    <div class="form-group mb-0">
                                                        <label>Mandate for Wealth</label>
                                                        <select class="form-control">
                                                            <option>557892 (State Bank of I..</option>
                                                            <option>557892 (State Bank of I..</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div> --}}
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-footer">
                                {{-- @php
                                    dd($client);
                                @endphp --}}
                                <a href="{{ route('transaction.index',['allocation_id' => $client->id,'type' => 'details', 'subtype' => 'allocation', 'maintype' => $client->view_portfolio, 'status' => 0]) }}" class="btn btn-link"><svg width="30" height="30" viewBox="0 0 24 24">
                                        <use xlink:href="#allocation"></use>
                                    </svg>View Allocation</a>

                                <button type="submit" class="btn btn-primary btn-lg ml-4">Proceed</button>
                                {{-- <button class="btn btn-primary btn-lg ml-4" data-toggle="modal"
                                    data-target="#errormodal">Proceed</button> --}}
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

                    <p>Couldn’t process transaction.
                        Please try again</p>
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

<div class="modal fade confirmation-modal" id="transaction" tabindex="-1" aria-hidden="true">
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
                    <div class="status-icon success">
                        <div class="check"></div>
                    </div>

                    <p>Trade Initiated for Admin approval!
                        Do you want to make another transaction?</p>
                </div>

                <div class="row justify-content-center">
                    <div class="col-6 ">
                        <button type="button" class="btn btn-outline-primary w-100">Yes</button>
                    </div>
                    <div class="col-6">
                        <button type="button" class="btn btn-primary w-100" data-dismiss="modal">No</button>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>

<div class="modal fade confirmation-modal" id="delete_transaction_confirm" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> -->
            <div class="modal-body text-center">
                <input type="hidden" name="delete_portfolio_id" id="delete_portfolio_id" value="">
                <div class="confirmation-popup">
                    <div class="status-icon error">
                        <i class="icon-close"></i>
                    </div>
                    @if($portfolio_count == 1)
                    <p>This is the only transaction that you are trying to instiate,  would you like to delete this transaction?</p>
                    @else
                    <p>Are you sure you want to delete this transaction?</p>
                    @endif
                </div>

                <div class="row justify-content-center">
                    <div class="col-6 ">
                        <button type="button" class="btn btn-outline-primary w-100" id="delete_transaction_send" >
                            @if($portfolio_count == 1)
                            Delete and create new transaction
                            @else
                            Yes
                            @endif
                        </button>
                    </div>
                    <div class="col-6">
                        <button type="button" class="btn btn-primary w-100" data-dismiss="modal">No</button>
                    </div>
                </div>

                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade confirmation-modal" id="delete_transaction_message" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">

            <div class="modal-body text-center">
                <div class="confirmation-popup">
                    <div class="status-icon error">
                        <i class="icon-close"></i>
                    </div>

                    <p>Transaction deleted successfully</p>
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
@endsection


@section('script')
<script>
    $( document ).ready(function() {
        //$("#delete_transaction_message").modal('show');

    });
    function deletetransaction(id)
    {
        $("#delete_portfolio_id").val(id);
        $("#delete_transaction_confirm").modal('show');

        $("#delete_transaction_send").attr('onClick', 'deletetransaction_trade('+id+');');
    }

    function deletetransaction_trade(id)
    {
        let tid = $('input[name=id]').val();
        //console.log(tid);
        let method = 'DELETE';
        let url = '/transaction/'+tid+'/payment/'+id;
        // var id = $(this).data("id");
        var token = $("meta[name='csrf-token']").attr("content");
        //console.log(method,url);
        ////return false;
        $.ajax({
            type: method,
            url: url,
            data: {
                "tid": tid,
                "id": id,
                "_token": token,
            },
            //async: false,
            beforeSend: function() {
                $('#loading').show();
            },
            success:function(data) {
                //
                console.log(data);
                //return false;
                //$('#loading').hide();
                if(data.status == 1)
                {
                    $("#delete_transaction_confirm").modal('hide');
                    $("#delete_transaction_message").modal('show');


                        //setTimeout(function() {
                            let pcount = $("input[name=portfolio_count]").val();
                            if(pcount == 1)
                            {
                                window.location.replace('/transaction');
                            }else{
                                location.reload();
                            }


                        //}, 2000);


                }
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
    $("#cheque_number").keypress(validateChequeNo);
    $(".multi_cheque_number").keypress(validateChequeNo);

    $(".payment-section input[type='radio']").on('change', function () {
        let val = $(this).val();
        let id = '';
        if(val != 'multiple_payment')
        {
            $( "select.multi_payment" ).each(function(o) {
                id = $(this).attr('id');
                let val_id = id.split("_");
                val_id = val_id.reverse()[0];
                $("#"+id).val('').trigger('change');
                multi_payment_hide(val_id);
                //multi_payment_82
            });
        }
        $('.payment-section').removeClass('selected');
        $(this).parentsUntil('.payment-section').parent().addClass('selected');
    });
// $('.cheque_date').datepicker({
//     autoclose: true
// });
        //var start_date = new Date();
        var today = new Date();
        //dd(start_date);
        $('.cheque_date').datepicker({
            format: 'd-mm-yyyy',
            autoclose: true,
            startDate: '-85d',
            endDate: "today",
            maxDate: today
        }).on('changeDate', function (ev) {
                $(this).datepicker('hide');
            });


        $('.cheque_date').keyup(function () {
            if (this.value.match(/[^0-9]/g)) {
                this.value = this.value.replace(/[^0-9^-]/g, '');
            }
        });

    $(document).on('change', '.multi_payment', function () {
        //$( "select#entitytype_id option:selected" ).val();
        let type = $(this).val();
        if(type)
        {
            console.log('1');
            let id = $(this).attr('id');
            let val_id = id.split("_");
            val_id = val_id.reverse()[0];
            if(type == 'OTM')
            {
                $(".selected_otm_"+val_id).removeClass('d-none');
                //OTM
                $(".selected_otm_"+val_id).show();

                //Neft and RTGS
                $("#utr_number_"+val_id).val('');
                $(".selected_neft_rtgs_"+val_id).hide();

                //Net Banking
                $("#net_bank_id_"+val_id).val('').trigger('change');
                $(".selected_net_banking_"+val_id).hide();

                //Cheque
                //cheque_amount_
                $("#cheque_number_"+val_id).val('');
                $("#cheque_date_"+val_id).val('');
                $("#cheque_bank_id_"+val_id).val('').trigger('change');
                $("#cheque_upload_"+val_id).val('');
                $(".selected_cheque_"+val_id).hide();
            }

            if(type == 'NEFT/RTGS')
            {
                $(".selected_neft_rtgs_"+val_id).removeClass('d-none');
                //OTM
                $("#otm_mandate_"+val_id).val('').trigger('change');
                $(".selected_otm_"+val_id).hide();

                //Neft and RTGS
                //$("#utr_number_"+val_id).val('');
                $(".selected_neft_rtgs_"+val_id).show();

                //Net Banking
                $("#net_bank_id_"+val_id).val('').trigger('change');
                $(".selected_net_banking_"+val_id).hide();

                //Cheque
                //cheque_amount_
                $("#cheque_number_"+val_id).val('');
                $("#cheque_date_"+val_id).val('');
                $("#cheque_bank_id_"+val_id).val('').trigger('change');
                $("#cheque_upload_"+val_id).val('');
                $(".selected_cheque_"+val_id).hide();
            }

            if(type == 'Net Banking')
            {
                $(".selected_net_banking_"+val_id).removeClass('d-none');
                //OTM
                $("#otm_mandate_"+val_id).val('').trigger('change');
                $(".selected_otm_"+val_id).hide();

                //Neft and RTGS
                $("#utr_number_"+val_id).val('');
                $(".selected_neft_rtgs_"+val_id).hide();

                //Net Banking
                //$("#net_bank_id_"+val_id).val('').trigger('change');
                $(".selected_net_banking_"+val_id).show();

                //Cheque
                //cheque_amount_
                $("#cheque_number_"+val_id).val('');
                $("#cheque_date_"+val_id).val('');
                $("#cheque_bank_id_"+val_id).val('').trigger('change');
                $("#cheque_upload_"+val_id).val('');
                $(".selected_cheque_"+val_id).hide();
            }

            if(type == 'Cheque')
            {
                $(".selected_cheque_"+val_id).removeClass('d-none');
                //OTM
                $("#otm_mandate_"+val_id).val('').trigger('change');
                $(".selected_otm_"+val_id).hide();

                //Neft and RTGS
                $("#utr_number_"+val_id).val('');
                $(".selected_neft_rtgs_"+val_id).hide();

                //Net Banking
                $("#net_bank_id_"+val_id).val('').trigger('change');
                $(".selected_net_banking_"+val_id).hide();

                //Cheque
                //cheque_amount_
                // $("#cheque_number_"+val_id).val('');
                // $("#cheque_date_"+val_id).val('');
                // $("#cheque_bank_id_"+val_id).val('').trigger('change');
                // $("#cheque_upload_"+val_id).val('');
                $(".selected_cheque_"+val_id).show();
            }
        }

    });
    //$( "select#entitytype_id option:selected" ).val();

function multi_payment_hide(val_id)
{
    //OTM
    $(".selected_otm_"+val_id).addClass('d-none');
    $("#otm_mandate_"+val_id).val('').trigger('change');
    $(".selected_otm_"+val_id).hide();

    //Neft and RTGS
    $(".selected_neft_rtgs_"+val_id).addClass('d-none');
    $("#utr_number_"+val_id).val('');
    $(".selected_neft_rtgs_"+val_id).hide();

    //Net Banking
    $(".selected_net_banking_"+val_id).addClass('d-none');
    $("#net_bank_id_"+val_id).val('').trigger('change');
    $(".selected_net_banking_"+val_id).hide();

    //Cheque
    $(".selected_cheque_"+val_id).addClass('d-none');
    $("#cheque_number_"+val_id).val('');
    $("#cheque_date_"+val_id).val('');
    $("#cheque_bank_id_"+val_id).val('').trigger('change');
    $("#cheque_upload_"+val_id).val('');
    $(".selected_cheque_"+val_id).show();
}
</script>
@endsection
