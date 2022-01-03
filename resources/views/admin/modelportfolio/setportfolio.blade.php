@extends('layouts.master')

@section('style')
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    .table-fix{
        table-layout: fixed;
    }
    .success-title
    {
        color: #365b58;
    }
    .add-more-scheme {
    border: 1px dashed #a3a3a3;
    padding-top: 0.7rem;
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

</style>
<style>
    .modal-confirm {
	color: #636363;
	width: 400px;
}
.modal-confirm .modal-content {
	padding: 20px;
	border-radius: 5px;
	border: none;
	text-align: center;
	font-size: 14px;
}
.modal-confirm .modal-header {
	border-bottom: none;
	position: relative;
}
.modal-confirm h4 {
	text-align: center;
	font-size: 26px;
	margin: 30px 0 -10px;
}
.modal-confirm .close {
	position: absolute;
	top: -5px;
	right: -2px;
}
.modal-confirm .modal-body {
	color: #999;
}
.modal-confirm .modal-footer {
	border: none;
	text-align: center;
	border-radius: 5px;
	font-size: 13px;
	padding: 10px 15px 25px;
}
.modal-confirm .modal-footer a {
	color: #999;
}
.modal-confirm .icon-box {
	width: 80px;
	height: 80px;
	margin: 0 auto;
	border-radius: 50%;
	z-index: 9;
	text-align: center;
	border: 3px solid #20aa14;
}
.modal-confirm .icon-box i {
	color: #20aa14;
	font-size: 46px;
	display: inline-block;
	margin-top: 13px;
}
.modal-confirm .btn, .modal-confirm .btn:active {
	color: #fff;
	border-radius: 4px;
	background: #365b58;
	text-decoration: none;
	transition: all 0.4s;
	line-height: normal;
	min-width: 120px;
	border: none;
	min-height: 40px;
	border-radius: 3px;
	margin: 0 5px;
}
.modal-confirm .btn-secondary {
	background: #c1c1c1;
}
.modal-confirm .btn-secondary:hover, .modal-confirm .btn-secondary:focus {
	background: #a8a8a8;
}
.modal-confirm .btn-danger {
	background: #f15e5e;
}
.modal-confirm .btn-danger:hover, .modal-confirm .btn-danger:focus {
	background: #ee3535;
}
.trigger-btn {
	display: inline-block;
	margin: 100px auto;
}
</style>
@endsection

@section('content')
<div class="panel-wrapper">
    @include('admin.adminmenu')
    <div class="container-fluid">
        <div class="table-top-section">
            <div class="section-header mb-4">
                @include('partials.top')
            </div>
        </div>
        <h3 class="section-title mb-4 d-flex justify-content-between">Set PortFolio
            <button class="btn btn-link d-md-none" id="toggleMenu">Admin Menu</button>
        </h3>
            <div class="card mb-4">
            <form id="add-update-data" method="POST" action="{{ route('setportfolio.store') }}">
                @csrf
                <div class="card-body">
                    <div class="row flex-row-reverse">

                        <div class="col-lg-12">
                            <div class="admin-body">
                                <div class="row">
                                    <div class="col-xl-9 mb-3 mb-xl-0">

                                        <ul class="nav nav-tabs mb-4" id="lead-generation" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link add-equity active" data-toggle="tab" data-type="equity" href="#admin-equity"
                                                    role="tab" aria-selected="true">Wealth-Equity</a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link add-debt" data-toggle="tab" data-type="debt" href="#admin-debt"
                                                    role="tab" aria-selected="true">Wealth-Debt</a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link add-shortterm" data-toggle="tab" data-type="shortterm" href="#admin-shortterm"
                                                    role="tab" aria-selected="true">Short Term</a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link add-tax" data-toggle="tab" data-type="tax" href="#admin-tax"
                                                    role="tab" aria-selected="true">Tax</a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link add-gold" data-toggle="tab" data-type="gold" href="#admin-gold"
                                                    role="tab" aria-selected="true">Gold</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-xl-3 pl-xl-0">
                                        {{-- <div class="table-options w-40 float-right">
                                            <input type="text" class="form-control wef_date w-100" id="wef_date" placeholder="Select start date" data-type="date" name="wef_date">
                                        </div> --}}
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="month">
                                                    <svg width="24" height="24" viewBox="0 0 24 24">
                                                        <use xlink:href="#month" />
                                                    </svg>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control text-truncate wef_date" id="wef_date" placeholder="Select start date" data-type="date" name="wef_date">
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-content" id="leadsContent">
                                    <div class="tab-pane fade show active" id="admin-equity" role="tabpanel">
                                        {{-- <h5 class="card-title mb-4 d-flex justify-content-between">Equity</h5> --}}
                                        <div class="card small-card option-2 mb-4">
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table normal-table table-fix">
                                                        <thead>
                                                            <tr class="text-center">
                                                                <th width="45%" rowspan="2" class="align-middle border-right">Scheme Name</th>
                                                                <th width="25%" colspan="2" class="border-right">Regular(Wealth & SIP)</th>
                                                                <th width="30%" colspan="3">SWP</th>
                                                            </tr>
                                                            <tr class="text-center">

                                                                <th width="10%">Residence %</th>
                                                                <th width="10%" class="border-right">NRI %</th>
                                                                <th width="10%">Priority</th>
                                                                <th width="10%">Residence %</th>
                                                                <th width="10%">NRI %</th>

                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr class="default_scheme_equity">
                                                                <td data-title="Scheme Name">
                                                                    <select class="form-control schemecode" id="scheme_code_equity" data-type="equity" name="scheme_code_equity">
                                                                        <option value="" selected disabled>Select Scheme Name</option>
                                                                        @foreach ($equity_scheme_codes as $code)
                                                                            <option value="{{$code->id}}-{{$code->isin}}">{{$code->scheme_nav_name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </td>
                                                                <td data-title="Amc Code Equity Regular Residence">
                                                                    <select class="form-control amc_code_equity_regular_residence" data-type="equity_residence" id="amc_code_equity_regular_residence" name="amc_code_equity_regular_residence">
                                                                        @include('client.percentage', ['val' => ''])
                                                                    </select>
                                                                </td>
                                                                <td data-title="Scheme Code Equity Regular NRI">
                                                                    <select class="form-control scheme_code_equity_regular_nri" id="scheme_code_equity_regular_nri" data-type="equity_nri" name="scheme_code_equity_regular_nri">
                                                                        @include('client.percentage', ['val' => ''])
                                                                    </select>
                                                                </td>
                                                                <td data-title="Scheme Code Equity SWP Priority" class="border-left">
                                                                    <div class="custom-checkbox mr-3 text-center">
                                                                        <input type="checkbox" class="form-control scheme_code_equity_swp_priority swp_priority" id="scheme_code_equity_swp_priority" data-type="swp_priority" name="scheme_code_equity_swp_priority" value="0">
                                                                        <label for="scheme_code_equity_swp_priority">&nbsp;</label>
                                                                    </div>
                                                                </td>
                                                                <td data-title="Amc Code Equity SWP Residence">
                                                                    <select class="form-control amc_code_equity_swp_residence" data-type="equity_residence" id="amc_code_equity_swp_residence" name="amc_code_equity_swp_residence">
                                                                        @include('client.percentage', ['val' => ''])
                                                                    </select>
                                                                </td>
                                                                <td data-title="Scheme Code Equity SWP NRI">
                                                                    <select class="form-control scheme_code_equity_swp_nri" id="scheme_code_equity_swp_nri" data-type="equity_nri" name="scheme_code_equity_swp_nri">
                                                                        @include('client.percentage', ['val' => ''])
                                                                    </select>
                                                                </td>

                                                            </tr>
                                                        </tbody>
                                                        <tfoot>
                                                            <tr class="default_scheme_equity_total">
                                                                <td data-title="Total" class="text-center bold">
                                                                    <h5>Total</h5>
                                                                </td>
                                                                <td data-title="Amc Code Equity Regular Residence Total">
                                                                    <input type="text" class="form-control schemecode_regular_residence_total" id="scheme_code_equity_regular_residence_total" data-type="equity_residence_total" name="scheme_code_equity_regular_residence_total" value="0" readonly>
                                                                </td>
                                                                <td data-title="Scheme Code Equity Regular NRI Total">
                                                                    <input type="text" class="form-control schemecode_regular_nri_total" id="scheme_code_equity_regular_nri_total" data-type="equity_nri_total" name="scheme_code_equity_regular_nri_total" value="0" readonly>
                                                                </td>
                                                                <td>
                                                                </td>
                                                                <td data-title="Amc Code Equity SWP Residence Total">
                                                                    <input type="text" class="form-control amccode_swp_residence_total" data-type="equity_residence_total" id="amc_code_equity_swp_residence_total" name="amc_code_equity_swp_residence_total" value="0" readonly>
                                                                </td>
                                                                <td data-title="Scheme Code Equity SWP NRI Total">
                                                                    <input type="text" class="form-control schemecode_swp_nri_total" id="scheme_code_equity_swp_nri_total" data-type="equity_nri_total" name="scheme_code_equity_swp_nri_total" value="0" readonly>
                                                                </td>

                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card small-card option-2 mb-4">
                                            <div class="card-header">
                                                <h6 class="card-title">RATIONAL FOR TRADE</h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group mb-3">
                                                    <textarea class="form-control" id="rational_trade_equity" name="rational_trade_equity" placeholder="Add Rational for trade"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade show" id="admin-debt" role="tabpanel">
                                        {{-- <h5 class="card-title mb-4 d-flex justify-content-between">Debt</h5> --}}
                                        <div class="card small-card option-2 mb-4">
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table normal-table">
                                                        <thead>
                                                            <tr class="text-center">
                                                                <th width="45%" rowspan="2" class="align-middle border-right">Scheme Name</th>
                                                                <th width="25%" colspan="2" class="border-right">Regular(Wealth & SIP)</th>
                                                                <th width="30%" colspan="3">SWP</th>
                                                            </tr>
                                                            <tr class="text-center">
                                                                <th width="10%">Residence %</th>
                                                                <th width="10%" class="border-right">NRI %</th>
                                                                <th width="10%">Priority</th>
                                                                <th width="10%">Residence %</th>
                                                                <th width="10%">NRI %</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr class="default_scheme_debt">
                                                                <td data-title="Scheme Name">
                                                                    <select class="form-control schemecode" id="scheme_code_debt" data-type="debt" name="scheme_code_debt">
                                                                        <option value="" selected disabled>Select Scheme Name</option>
                                                                        @foreach ($debt_scheme_codes as $code)
                                                                            <option value="{{$code->id}}">{{$code->scheme_nav_name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </td>
                                                                <td data-title="Amc Code Debt Regular Residence">
                                                                    <select class="form-control amc_code_debt_regular_residence" data-type="debt_residence" id="amc_code_debt_regular_residence" name="amc_code_debt_regular_residence">
                                                                        @include('client.percentage', ['val' => ''])
                                                                    </select>
                                                                </td>
                                                                <td data-title="Scheme Code Debt Regular NRI">
                                                                    <select class="form-control scheme_code_debt_regular_nri" id="scheme_code_debt_regular_nri" data-type="debt_nri" name="scheme_code_debt_regular_nri">
                                                                        @include('client.percentage', ['val' => ''])
                                                                    </select>
                                                                </td>
                                                                <td data-title="Scheme Code Debt SWP Priority" class="border-left">
                                                                    <div class="custom-checkbox mr-3 text-center">
                                                                        <input type="checkbox" class="form-control scheme_code_debt_swp_priority swp_priority" id="scheme_code_debt_swp_priority" data-type="swp_priority" name="scheme_code_debt_swp_priority" value="0">
                                                                        <label for="scheme_code_debt_swp_priority">&nbsp;</label>
                                                                    </div>
                                                                </td>
                                                                <td data-title="Amc Code Debt SWP Residence">
                                                                    <select class="form-control amc_code_debt_swp_residence" data-type="debt_residence" id="amc_code_debt_swp_residence" name="amc_code_debt_swp_residence">
                                                                        @include('client.percentage', ['val' => ''])
                                                                    </select>
                                                                </td>
                                                                <td data-title="Scheme Code Debt SWP NRI">
                                                                    <select class="form-control scheme_code_debt_swp_nri" id="scheme_code_debt_swp_nri" data-type="debt_nri" name="scheme_code_debt_swp_nri">
                                                                        @include('client.percentage', ['val' => ''])
                                                                    </select>
                                                                </td>
                                                            </tr>

                                                        </tbody>
                                                        <tfoot>
                                                            <tr class="default_scheme_debt_total">
                                                                <td data-title="Total" class="text-center bold">
                                                                    <h5>Total</h5>
                                                                </td>

                                                                <td data-title="Amc Code Debt Regular Residence Total">
                                                                    <input type="text" class="form-control schemecode_regular_residence_total" id="scheme_code_debt_regular_residence_total" data-type="debt_residence_total" name="scheme_code_debt_regular_residence_total" value="0" readonly>
                                                                </td>
                                                                <td data-title="Scheme Code Debt Regular NRI Total">
                                                                    <input type="text" class="form-control schemecode_regular_nri_total" id="scheme_code_debt_regular_nri_total" data-type="debt_nri_total" name="scheme_code_debt_regular_nri_total" value="0" readonly>
                                                                </td>
                                                                <td></td>
                                                                <td data-title="Amc Code Debt SWP Residence Total">
                                                                    <input type="text" class="form-control amccode_swp_residence_total" data-type="debt_residence_total" id="amc_code_debt_swp_residence_total" name="amc_code_debt_swp_residence_total" value="0" readonly>
                                                                </td>
                                                                <td data-title="Scheme Code Debt SWP NRI Total">
                                                                    <input type="text" class="form-control schemecode_swp_nri_total" id="scheme_code_debt_swp_nri_total" data-type="debt_nri_total" name="scheme_code_debt_swp_nri_total" value="0" readonly>
                                                                </td>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card small-card option-2 mb-4">
                                            <div class="card-header">
                                                <h6 class="card-title">RATIONAL FOR TRADE</h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group mb-3">
                                                    <textarea class="form-control" id="rational_trade_debt" name="rational_trade_debt" placeholder="Add Rational for trade"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade show" id="admin-shortterm" role="tabpanel">
                                        {{-- <h5 class="card-title mb-4 d-flex flex-row-reverse">

                                            <button type="button" class="btn btn-link" id="add_new_data_shortterm" style="padding: 0px">Add New</button>
                                        </h5> --}}
                                        <div class="card small-card option-2 mb-4">
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table normal-table">
                                                        <thead>
                                                            <tr class="text-center">
                                                                <th width="50%" rowspan="2" class="align-middle border-right">Scheme Name</th>
                                                                <th width="50%" colspan="2" class="border-right">Regular(Wealth & SIP)</th>

                                                            </tr>
                                                            <tr class="text-center">

                                                                <th width="25%">Residence %</th>
                                                                <th width="25%" class="border-right">NRI %</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr class="default_scheme_shortterm">
                                                                <td data-title="Scheme Name">
                                                                    <select class="form-control schemecode" id="scheme_code_shortterm" data-type="shortterm" name="scheme_code_shortterm">
                                                                        <option value="" selected disabled>Select Scheme Name</option>
                                                                        @foreach ($shortterm_scheme_codes as $code)
                                                                            <option value="{{$code->id}}">{{$code->scheme_nav_name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </td>
                                                                <td data-title="Amc Code Short Term Regular Residence">
                                                                    <select class="form-control amc_code_shortterm_regular_residence" data-type="shortterm_residence" id="amc_code_shortterm_regular_residence" name="amc_code_shortterm_regular_residence">
                                                                        <option value="" selected disabled>-- Select --</option>
                                                                        <option value="1">Yes</option>
                                                                        <option value="2">No</option>
                                                                    </select>
                                                                </td>
                                                                <td data-title="Scheme Code Short Term Regular NRI">
                                                                    <select class="form-control scheme_code_shortterm_regular_nri" id="scheme_code_shortterm_regular_nri" data-type="shortterm_nri" name="scheme_code_shortterm_regular_nri">
                                                                        <option value="" selected disabled>-- Select --</option>
                                                                        <option value="1">Yes</option>
                                                                        <option value="2">No</option>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <a class="btn btn-link d-block m-auto add-more-scheme" id="add_new_data_shortterm">
                                                    <svg width="30" height="30" viewBox="-2 -2 28 28" class="mr-0">
                                                        <use xlink:href="#add-btn"></use>
                                                    </svg>
                                                    Add More
                                                </a>
                                            </div>
                                        </div>
                                        <div class="card small-card option-2 mb-4">
                                            <div class="card-header">
                                                <h6 class="card-title">RATIONAL FOR TRADE</h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group mb-3">
                                                    <textarea class="form-control" id="rational_trade_shortterm" name="rational_trade_shortterm" placeholder="Add Rational for trade"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade show" id="admin-tax" role="tabpanel">
                                        {{-- <h5 class="card-title mb-4 d-flex justify-content-between">Tax
                                            <button type="button" class="btn btn-link" id="add_new_data_tax" style="padding: 0px">Add New</button>
                                        </h5> --}}
                                        <div class="card small-card option-2 mb-4">
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table normal-table">
                                                        <thead>
                                                            <tr class="text-center">
                                                                <th width="50%" rowspan="2" class="align-middle border-right">Scheme Name</th>
                                                                <th width="50%" colspan="2" class="border-right">Regular(Wealth & SIP)</th>

                                                            </tr>
                                                            <tr class="text-center">

                                                                <th width="25%">Residence %</th>
                                                                <th width="25%" class="border-right">NRI %</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr class="default_scheme_tax">
                                                                <td data-title="Scheme Name">
                                                                    <select class="form-control schemecode" id="scheme_code_tax" data-type="tax" name="scheme_code_tax">
                                                                        <option value="" selected disabled>Select Scheme Name</option>
                                                                        @foreach ($tax_scheme_codes as $code)
                                                                            <option value="{{$code->id}}">{{$code->scheme_nav_name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </td>
                                                                <td data-title="Amc Code Short Term Regular Residence">
                                                                    <select class="form-control amc_code_tax_regular_residence" data-type="tax_residence" id="amc_code_tax_regular_residence" name="amc_code_tax_regular_residence">
                                                                        <option value="" selected disabled>-- Select --</option>
                                                                        <option value="1">Yes</option>
                                                                        <option value="2">No</option>
                                                                    </select>
                                                                </td>
                                                                <td data-title="Scheme Code Short Term Regular NRI">
                                                                    <select class="form-control scheme_code_tax_regular_nri" id="scheme_code_tax_regular_nri" data-type="tax_nri" name="scheme_code_tax_regular_nri">
                                                                        <option value="" selected disabled>-- Select --</option>
                                                                        <option value="1">Yes</option>
                                                                        <option value="2">No</option>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <a class="btn btn-link d-block m-auto add-more-scheme" id="add_new_data_tax">
                                                    <svg width="30" height="30" viewBox="-2 -2 28 28" class="mr-0">
                                                        <use xlink:href="#add-btn"></use>
                                                    </svg>
                                                    Add More
                                                </a>
                                            </div>
                                        </div>
                                        <div class="card small-card option-2 mb-4">
                                            <div class="card-header">
                                                <h6 class="card-title">RATIONAL FOR TRADE</h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group mb-3">
                                                    <textarea class="form-control" id="rational_trade_tax" name="rational_trade_tax" placeholder="Add Rational for trade"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade show" id="admin-gold" role="tabpanel">
                                        {{-- <h5 class="card-title mb-4 d-flex justify-content-between">Short Term
                                            <button type="button" class="btn btn-link" id="add_new_data_gold" style="padding: 0px">Add New</button>
                                        </h5> --}}
                                        <div class="card small-card option-2 mb-4">
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table normal-table">
                                                        <thead>
                                                            <tr class="text-center">
                                                                <th width="50%" rowspan="2" class="align-middle border-right">Scheme Name</th>
                                                                <th width="50%" colspan="2" class="border-right">Regular(Wealth & SIP)</th>

                                                            </tr>
                                                            <tr class="text-center">

                                                                <th width="25%">Residence %</th>
                                                                <th width="25%" class="border-right">NRI %</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr class="default_scheme_gold">
                                                                <td data-title="Scheme Name">
                                                                    <select class="form-control schemecode" id="scheme_code_gold" data-type="gold" name="scheme_code_gold">
                                                                        <option value="" selected disabled>Select Scheme Name</option>
                                                                        @foreach ($gold_scheme_codes as $code)
                                                                            <option value="{{$code->id}}">{{$code->scheme_nav_name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </td>
                                                                <td data-title="Amc Code Short Term Regular Residence">
                                                                    <select class="form-control amc_code_gold_regular_residence" data-type="gold_residence" id="amc_code_gold_regular_residence" name="amc_code_gold_regular_residence">
                                                                        <option value="" selected disabled>-- Select --</option>
                                                                        <option value="1">Yes</option>
                                                                        <option value="2">No</option>
                                                                    </select>
                                                                </td>
                                                                <td data-title="Scheme Code Short Term Regular NRI">
                                                                    <select class="form-control scheme_code_gold_regular_nri" id="scheme_code_gold_regular_nri" data-type="gold_nri" name="scheme_code_gold_regular_nri">
                                                                        <option value="" selected disabled>-- Select --</option>
                                                                        <option value="1">Yes</option>
                                                                        <option value="2">No</option>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <a class="btn btn-link d-block m-auto add-more-scheme" id="add_new_data_gold">
                                                    <svg width="30" height="30" viewBox="-2 -2 28 28" class="mr-0">
                                                        <use xlink:href="#add-btn"></use>
                                                    </svg>
                                                    Add More
                                                </a>
                                            </div>
                                        </div>
                                        <div class="card small-card option-2 mb-4">
                                            <div class="card-header">
                                                <h6 class="card-title">RATIONAL FOR TRADE</h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group mb-3">
                                                    <textarea class="form-control" id="rational_trade_gold" name="rational_trade_gold" placeholder="Add Rational for trade"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary btn-lg">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('modal')
<div id="successModal" class="modal fade">
	<div class="modal-dialog modal-confirm">
		<div class="modal-content">
			<div class="modal-header flex-column">
				<div class="icon-box">
					<i class="material-icons">check</i>
				</div>
				<h4 class="modal-title success-title w-100">Portfolio added successfully</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">
				{{-- <p>Do you really want to inative these bank details?</p>
                <p>Note: For activation required Superadmin Approval</p>
                <input type="hidden" name="delete_pid" value="">
                <input type="hidden" name="delete_bank_count" value=""> --}}
			</div>
			<div class="modal-footer justify-content-center mt-3">
				<button type="button" class="btn btn-primary btn-lg" data-dismiss="modal">OK</button>
			</div>
		</div>
	</div>
</div>
@endsection

@section('script')
<script type="text/javascript" src="{{ asset('assets/javascript/setportfolio.js') }}"></script>
<script>
    $(document).ready(function () {

        $('#toggleMenu').on('click', function () {
            $(".panel-option").toggleClass('open');
        });
        $('#closeMenu').on('click', function () {
            $(".panel-option").removeClass('open');
        });
        $('input[name="wef_date"]').datepicker({
            autoclose: true,
            format: "dd-mm-yyyy",
            startDate: new Date(),
        });
    });
    $(document).on('change', '.swp_priority', function (e) {
        let value = e.target.value;
        console.log(value);
        if($(this).is(":checked"))
        {
            $(this).val('1');
        }else{
            $(this).val('0');
        }
    });
    $(document).on('change', '.amccode', function (e) {
        let value = e.target.value;
        let id = e.target.id;
        let scheme_id = id.replace("amc", "scheme");
        console.log(id);
        let type = $(this).attr('data-type');
        console.log(type);
        let data = '';
        data += '<option value="" disabled selected>Select Scheme Name</option>';
        $.get("/admin/modelportfolio/setportfolio/"+value+"?type="+type, function(output, status){
            console.log(output);
            $.each(output, function(i,o){
                data += '<option value="'+o.scheme_code+'">'+o.scheme_name+'</option>';
            });
            console.log(data);
            $('#'+scheme_id).html(data);
        });
    });
</script>
@endsection
