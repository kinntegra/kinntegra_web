@extends('layouts.master')

@section('style')

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
        <h3 class="section-title mb-4 d-flex justify-content-between">Introduction
            <button class="btn btn-link d-md-none" id="toggleMenu">Admin Menu</button>
        </h3>
            <div class="card mb-4">
            <div class="card-body">
                <div class="row flex-row-reverse ">

                    <div class="col-lg-9 border-left col-md-7 ">
                        <div class="admin-body">
                            <ul class="nav nav-tabs mb-4" id="lead-generation" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" data-toggle="tab" href="#admin-tax"
                                        role="tab" aria-selected="true">Tax Slab</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="leadsContent">
                                <div class="tab-pane fade show active" id="admin-tax" role="tabpanel">
                                    <div class="card small-card option-2 option-2 mb-4">
                                        <div class="card-header">
                                            <h5 class="card-title mb-0">Add</h5>
                                        </div>
                                        <div class="card-body pt-4 pb-4">
                                            <div class="row">
                                                <div class="col-xl-4 col-sm-12">
                                                    <div class="form-group mb-3 mb-sm-0">
                                                        <label>Tax Slab</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Enter Category">
                                                    </div>
                                                </div>
                                            </div>
                                            <button class="btn btn-primary mt-4">Add</button>
                                        </div>
                                    </div>
                                    <h5 class="card-title">Existing Tax Slabs</h5>
                                    <ul class="existing-lists">
                                        <li>
                                            <a href="javascript(0):void "><i class="icon-close"></i> 50%</a>
                                        </li>
                                        <li>
                                            <a href="javascript(0):void "><i class="icon-close"></i> 50%</a>
                                        </li>
                                        <li>
                                            <a href="javascript(0):void "><i class="icon-close"></i> 50%</a>
                                        </li>
                                        <li>
                                            <a href="javascript(0):void "><i class="icon-close"></i> 50%</a>
                                        </li>
                                        <li>
                                            <a href="javascript(0):void "><i class="icon-close"></i> 50%</a>
                                        </li>
                                        <li>
                                            <a href="javascript(0):void "><i class="icon-close"></i> 50%</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-5">
                        <h5 class="card-title mb-3">Logs</h5>
                        <div class="input-group ">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="table-search">
                                    <svg width="24" height="24" viewBox="0 0 24 24">
                                        <use xlink:href="#search"></use>
                                    </svg>
                                </span>
                            </div>
                            <input type="text" class="form-control" placeholder="Search"
                                aria-label="table-search" aria-describedby="table-search">
                        </div>
                        <ul class="logs-list mt-4">
                            <li>
                                <h4>02 Mar 2020</h4>
                                <span>60%</span>
                                <span>60%</span>
                            </li>
                            <li>
                                <h4>02 Mar 2020</h4>
                                <span>60%</span>
                                <span>60%</span>
                            </li>
                            <li>
                                <h4>02 Mar 2020</h4>
                                <span>60%</span>
                                <span>60%</span>
                            </li>
                            <li>
                                <h4>02 Mar 2020</h4>
                                <span>60%</span>
                                <span>60%</span>
                            </li>
                            <li>
                                <h4>02 Mar 2020</h4>
                                <span>60%</span>
                                <span>60%</span>
                            </li>
                            <li>
                                <h4>02 Mar 2020</h4>
                                <span>60%</span>
                                <span>60%</span>
                            </li>
                            <li>
                                <h4>02 Mar 2020</h4>
                                <span>60%</span>
                                <span>60%</span>
                            </li>
                            <li>
                                <h4>02 Mar 2020</h4>
                                <span>60%</span>
                                <span>60%</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <button class="btn btn-primary btn-lg">Save Changes</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('modal')
{{-- <div class="modal fade" id="plan" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <div class="d-md-flex justify-content-between align-items-start w-100">
                    <h5 class="modal-title" id="staticBackdropLabel">Axis Mid Cap Fund - Growth Plan - Growth
                        <small>
                            <span>ISIN: ING3532623323</span>
                            <span>Scheme Code: NCGP</span>
                        </small>
                    </h5>
                    <div>
                        <a class="btn btn-link"><svg width="30" height="30" viewBox="0 0 24 24">
                                <use xlink:href="#download"></use>
                            </svg>Download Report</a>
                        <a class="btn btn-link"><svg width="30" height="30" viewBox="0 0 24 24">
                                <use xlink:href="#mail"></use>
                            </svg>Email Report</a>
                    </div>
                </div>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs mb-4" id="plan-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" data-toggle="tab" href="#Overview" role="tab"
                            aria-selected="true">Overview</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-toggle="tab" href="#plan-transactions" role="tab"
                            aria-selected="true">Transaction Details</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-toggle="tab" href="#distribution" role="tab"
                            aria-selected="true">Fund Distribution</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="Overview" role="tabpanel">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card allocation-card card-sm">
                                    <div class="allocation-wrap">
                                        <div class="card-body pt-2">
                                            <div class="card-title pb-1 border-bottom d-flex align-items-center">
                                                <svg width="40" height="40" viewBox="5 5 45 45">
                                                    <use xlink:href="#overview"></use>
                                                </svg>
                                                <h5 class="mb-0"> Overview</h5>
                                            </div>
                                            <span class="badge badge-warning badge-pill">Alpha/Benchmark: 24%</span>
                                            <div class="table-wrap mt-3">
                                                <table class="simple-table">
                                                    <tbody>
                                                        <tr>
                                                            <th>Parameters</th>
                                                            <th>Kinntegra</th>
                                                            <th>Benchmark</th>
                                                        </tr>
                                                        <tr>
                                                            <td>Investment</td>
                                                            <td>₹25L</td>
                                                            <td>₹25L</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Market Value</td>
                                                            <td>₹25L</td>
                                                            <td>₹25L</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Profit</td>
                                                            <td>₹25L</td>
                                                            <td>₹25L</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="allocation-chart">
                                            <div class="card small-card option-2 option-2">
                                                <div class="card-header">
                                                    <h6 class="card-title">Allocation</h6>
                                                </div>
                                                <table class="transaction-table">
                                                    <tbody>
                                                        <tr>
                                                            <td class="form-percentage primary-circle pt-3 pb-3">
                                                                <svg viewBox="0 0 36 36" width="60">
                                                                    <path class="circle-bg" d="M18 2.0845
                                                                    a 15.9155 15.9155 0 0 1 0 31.831
                                                                    a 15.9155 15.9155 0 0 1 0 -31.831"></path>
                                                                    <path class="circle" stroke-dasharray="70, 100"
                                                                        d="M18 2.0845
                                                                    a 15.9155 15.9155 0 0 1 0 31.831
                                                                    a 15.9155 15.9155 0 0 1 0 -31.831"></path>
                                                                </svg>
                                                            </td>
                                                            <td>
                                                                <div class="form-group mb-3 mb-sm-0 pl-2">
                                                                    <label>Current</label>
                                                                    <input type="text" readonly=""
                                                                        class="form-control-plaintext font-bold"
                                                                        value="₹25.33L">
                                                                </div>
                                                            </td>
                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="card allocation-card card-sm">
                                    <div class="card-body pt-2">
                                        <div class="card-title pb-1 border-bottom d-flex align-items-center">
                                            <svg width="40" height="40" viewBox="5 5 45 45">
                                                <use xlink:href="#portfolio"></use>
                                            </svg>
                                            <h5 class="mb-0"> Portfolio Benchmark</h5>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="plan-transactions" role="tabpanel">
                        <div class="details-section">
                            <div class="details">
                                <label>Holding Units</label>
                                <span>100.48</span>
                            </div>
                            <div class="details">
                                <label>Holding Units</label>
                                <span>100.48</span>
                            </div>
                        </div>
                        <div class="table-wrap">
                            <table class="simple-table">
                                <tbody>
                                    <tr>
                                        <th>Date</th>
                                        <th>Type</th>
                                        <th>Quantity</th>
                                        <th>NAV</th>
                                        <th>Amount</th>
                                        <th>Balance Qty</th>
                                        <th>Prev. NAV</th>
                                        <th>Curr. Amt.</th>
                                        <th>P&L</th>
                                        <th>Age(Days)</th>
                                        <th>XIRR</th>
                                        <th>Abs Val</th>
                                    </tr>
                                    <tr>
                                        <td>02-11-2020</td>
                                        <td>Buy</td>
                                        <td>10.882</td>
                                        <td>42.27</td>
                                        <td>₹10.42K</td>
                                        <td>25.262</td>
                                        <td>106</td>
                                        <td>₹10.42K</td>
                                        <td>₹10.42K</td>
                                        <td>₹10.42K</td>
                                        <td>22.62%</td>
                                        <td>₹10.42K</td>
                                    </tr>
                                    <tr>
                                        <td>02-11-2020</td>
                                        <td>Buy</td>
                                        <td>10.882</td>
                                        <td>42.27</td>
                                        <td>₹10.42K</td>
                                        <td>25.262</td>
                                        <td>106</td>
                                        <td>₹10.42K</td>
                                        <td>₹10.42K</td>
                                        <td>₹10.42K</td>
                                        <td>22.62%</td>
                                        <td>₹10.42K</td>
                                    </tr>
                                    <tr>
                                        <td>02-11-2020</td>
                                        <td>Buy</td>
                                        <td>10.882</td>
                                        <td>42.27</td>
                                        <td>₹10.42K</td>
                                        <td>25.262</td>
                                        <td>106</td>
                                        <td>₹10.42K</td>
                                        <td>₹10.42K</td>
                                        <td>₹10.42K</td>
                                        <td>22.62%</td>
                                        <td>₹10.42K</td>
                                    </tr>
                                    <tr>
                                        <td>02-11-2020</td>
                                        <td>Buy</td>
                                        <td>10.882</td>
                                        <td>42.27</td>
                                        <td>₹10.42K</td>
                                        <td>25.262</td>
                                        <td>106</td>
                                        <td>₹10.42K</td>
                                        <td>₹10.42K</td>
                                        <td>₹10.42K</td>
                                        <td>22.62%</td>
                                        <td>₹10.42K</td>
                                    </tr>
                                    <tr>
                                        <td>02-11-2020</td>
                                        <td>Buy</td>
                                        <td>10.882</td>
                                        <td>42.27</td>
                                        <td>₹10.42K</td>
                                        <td>25.262</td>
                                        <td>106</td>
                                        <td>₹10.42K</td>
                                        <td>₹10.42K</td>
                                        <td>₹10.42K</td>
                                        <td>22.62%</td>
                                        <td>₹10.42K</td>
                                    </tr>
                                    <tr>
                                        <td>02-11-2020</td>
                                        <td>Buy</td>
                                        <td>10.882</td>
                                        <td>42.27</td>
                                        <td>₹10.42K</td>
                                        <td>25.262</td>
                                        <td>106</td>
                                        <td>₹10.42K</td>
                                        <td>₹10.42K</td>
                                        <td>₹10.42K</td>
                                        <td>22.62%</td>
                                        <td>₹10.42K</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="distribution" role="tabpanel">
                        <div class="row">
                            <div class="col-md-7">
                                <ul class="nav nav-tabs mb-4 income-tab" id="plan-tab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active pr-4" data-toggle="tab" href="#Equity" role="tab"
                                            aria-selected="true">Equity</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link pr-4" data-toggle="tab" href="#Debt" role="tab"
                                            aria-selected="true">Debt</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link pr-4" data-toggle="tab" href="#Other" role="tab"
                                            aria-selected="true">Other</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="Equity" role="tabpanel">
                                        <div class="table-wrap mt-3">
                                            <table class="simple-table">
                                                <tbody>
                                                    <tr>
                                                        <th>Stock Invested In</th>
                                                        <th>Sector</th>
                                                        <th>% of Holdings</th>
                                                    </tr>
                                                    <tr>
                                                        <td>State Bank Of India</td>
                                                        <td>Pharmaceuticals</td>
                                                        <td>7.09% </td>
                                                    </tr>
                                                    <tr>
                                                        <td>State Bank Of India</td>
                                                        <td>Pharmaceuticals</td>
                                                        <td>7.09% </td>
                                                    </tr>
                                                    <tr>
                                                        <td>State Bank Of India</td>
                                                        <td>Pharmaceuticals</td>
                                                        <td>7.09% </td>
                                                    </tr>
                                                    <tr>
                                                        <td>State Bank Of India</td>
                                                        <td>Pharmaceuticals</td>
                                                        <td>7.09% </td>
                                                    </tr>
                                                    <tr>
                                                        <td>State Bank Of India</td>
                                                        <td>Pharmaceuticals</td>
                                                        <td>7.09% </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="Debt" role="tabpanel">
                                        <div class="table-wrap mt-3">
                                            <table class="simple-table">
                                                <tbody>
                                                    <tr>
                                                        <th>Stock Invested In</th>
                                                        <th>Sector</th>
                                                        <th>% of Holdings</th>
                                                    </tr>
                                                    <tr>
                                                        <td>State Bank Of India</td>
                                                        <td>Pharmaceuticals</td>
                                                        <td>7.09% </td>
                                                    </tr>
                                                    <tr>
                                                        <td>State Bank Of India</td>
                                                        <td>Pharmaceuticals</td>
                                                        <td>7.09% </td>
                                                    </tr>
                                                    <tr>
                                                        <td>State Bank Of India</td>
                                                        <td>Pharmaceuticals</td>
                                                        <td>7.09% </td>
                                                    </tr>
                                                    <tr>
                                                        <td>State Bank Of India</td>
                                                        <td>Pharmaceuticals</td>
                                                        <td>7.09% </td>
                                                    </tr>
                                                    <tr>
                                                        <td>State Bank Of India</td>
                                                        <td>Pharmaceuticals</td>
                                                        <td>7.09% </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="Other" role="tabpanel">
                                        <div class="table-wrap mt-3">
                                            <table class="simple-table">
                                                <tbody>
                                                    <tr>
                                                        <th>Stock Invested In</th>
                                                        <th>Sector</th>
                                                        <th>% of Holdings</th>
                                                    </tr>
                                                    <tr>
                                                        <td>State Bank Of India</td>
                                                        <td>Pharmaceuticals</td>
                                                        <td>7.09% </td>
                                                    </tr>
                                                    <tr>
                                                        <td>State Bank Of India</td>
                                                        <td>Pharmaceuticals</td>
                                                        <td>7.09% </td>
                                                    </tr>
                                                    <tr>
                                                        <td>State Bank Of India</td>
                                                        <td>Pharmaceuticals</td>
                                                        <td>7.09% </td>
                                                    </tr>
                                                    <tr>
                                                        <td>State Bank Of India</td>
                                                        <td>Pharmaceuticals</td>
                                                        <td>7.09% </td>
                                                    </tr>
                                                    <tr>
                                                        <td>State Bank Of India</td>
                                                        <td>Pharmaceuticals</td>
                                                        <td>7.09% </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="card card-sm">
                                    <div class="card-body">
                                        <ul class="transaction-details p-0 m-0">
                                            <li>
                                                <label>Equity Holding</label>
                                                <span class="value">99.22%</span>
                                            </li>
                                            <li>
                                                <label>F&O Holdings</label>
                                                <span class="value">99.22%</span>
                                            </li>
                                            <li>
                                                <label>Foreign Equity Holdings</label>
                                                <span class="value">99.22%</span>
                                            </li>
                                            <li>
                                                <label>Total</label>
                                                <span class="value">99.22%</span>
                                            </li>
                                            <li>
                                                <label>No of Stocks</label>
                                                <span class="value">99.22%</span>
                                            </li>
                                            <li>
                                                <label>Large Cap Investments</label>
                                                <span class="value">99.22%</span>
                                            </li>
                                            <li>
                                                <label>Mid Cap Investments</label>
                                                <span class="value">99.22%</span>
                                            </li>
                                            <li>
                                                <label>Small Cap Investments</label>
                                                <span class="value">99.22%</span>
                                            </li>
                                            <li>
                                                <label>Other</label>
                                                <span class="value">99.22%</span>
                                            </li>
                                        </ul>
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

<div class="modal fade" id="selected-cards" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Selected Cards</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="card small-card option-2">
                            <div class="card-header">
                                <div class="form-group mb-0 custom-checkbox">
                                    <input type="checkbox" id="quater1">
                                    <label for="quater1"><span class="light-text">Quater
                                            1</span> <br><span class="d-block mt-2">10 Apr
                                            2020 - 10 Jun 2020</span></label>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <ul class="transaction-details pl-0">
                                    <li>
                                        <label>Opening Balance</label>
                                        <span class="value">₹12.4L</span>
                                    </li>
                                    <li>
                                        <label>Inflows</label>
                                        <span class="value">₹22.30L</span>
                                    </li>
                                    <li>
                                        <label>Outflows</label>
                                        <span class="value">₹2.30L</span>
                                    </li>
                                    <li>
                                        <label>Current PF value</label>
                                        <span class="value">₹25L</span>
                                    </li>
                                    <li>
                                        <label>Benchmark value</label>
                                        <span class="value">₹12.4L</span>
                                    </li>
                                    <li>
                                        <label>Alpha/Benchmark</label>
                                        <span class="value">₹22.30L</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card small-card option-2">
                            <div class="card-header">
                                <div class="form-group mb-0 custom-checkbox">
                                    <input type="checkbox" id="quater1">
                                    <label for="quater1"><span class="light-text">Quater
                                            1</span> <br><span class="d-block mt-2">10 Apr
                                            2020 - 10 Jun 2020</span></label>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <ul class="transaction-details pl-0">
                                    <li>
                                        <label>Opening Balance</label>
                                        <span class="value">₹12.4L</span>
                                    </li>
                                    <li>
                                        <label>Inflows</label>
                                        <span class="value">₹22.30L</span>
                                    </li>
                                    <li>
                                        <label>Outflows</label>
                                        <span class="value">₹2.30L</span>
                                    </li>
                                    <li>
                                        <label>Current PF value</label>
                                        <span class="value">₹25L</span>
                                    </li>
                                    <li>
                                        <label>Benchmark value</label>
                                        <span class="value">₹12.4L</span>
                                    </li>
                                    <li>
                                        <label>Alpha/Benchmark</label>
                                        <span class="value">₹22.30L</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card small-card option-2">
                            <div class="card-header">
                                <div class="form-group mb-0 custom-checkbox">
                                    <input type="checkbox" id="quater1">
                                    <label for="quater1"><span class="light-text">Quater
                                            1</span> <br><span class="d-block mt-2">10 Apr
                                            2020 - 10 Jun 2020</span></label>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <ul class="transaction-details pl-0">
                                    <li>
                                        <label>Opening Balance</label>
                                        <span class="value">₹12.4L</span>
                                    </li>
                                    <li>
                                        <label>Inflows</label>
                                        <span class="value">₹22.30L</span>
                                    </li>
                                    <li>
                                        <label>Outflows</label>
                                        <span class="value">₹2.30L</span>
                                    </li>
                                    <li>
                                        <label>Current PF value</label>
                                        <span class="value">₹25L</span>
                                    </li>
                                    <li>
                                        <label>Benchmark value</label>
                                        <span class="value">₹12.4L</span>
                                    </li>
                                    <li>
                                        <label>Alpha/Benchmark</label>
                                        <span class="value">₹22.30L</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card small-card option-2">
                            <div class="card-header">
                                <div class="form-group mb-0 custom-checkbox">
                                    <input type="checkbox" id="quater1">
                                    <label for="quater1"><span class="light-text">Quater
                                            1</span> <br><span class="d-block mt-2">10 Apr
                                            2020 - 10 Jun 2020</span></label>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <ul class="transaction-details pl-0">
                                    <li>
                                        <label>Opening Balance</label>
                                        <span class="value">₹12.4L</span>
                                    </li>
                                    <li>
                                        <label>Inflows</label>
                                        <span class="value">₹22.30L</span>
                                    </li>
                                    <li>
                                        <label>Outflows</label>
                                        <span class="value">₹2.30L</span>
                                    </li>
                                    <li>
                                        <label>Current PF value</label>
                                        <span class="value">₹25L</span>
                                    </li>
                                    <li>
                                        <label>Benchmark value</label>
                                        <span class="value">₹12.4L</span>
                                    </li>
                                    <li>
                                        <label>Alpha/Benchmark</label>
                                        <span class="value">₹22.30L</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer text-right">
                <button class="btn btn-primary btn-lg">Save Changes</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="commission" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <div class="d-md-flex justify-content-between align-items-start w-100">
                    <h5 class="modal-title" id="staticBackdropLabel">Commision Report</h5>
                    <div>
                        <a class="btn btn-link"><svg width="30" height="30" viewBox="0 0 24 24">
                                <use xlink:href="#download"></use>
                            </svg>Download</a>
                    </div>
                </div>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-wrap">
                    <table class="simple-table table-lg">
                        <tbody>
                            <tr>
                                <th>Client Name</th>
                                <th>Advisor</th>
                                <th>Holding Month</th>
                                <th>Payout Month</th>
                                <th>Avg Holding</th>
                                <th>Commission Amt</th>
                                <th>% of total receivable </th>
                            </tr>
                            <tr>
                                <td>Jane Doe</td>
                                <td>Akash Abhay Vaidya</td>
                                <td>March</td>
                                <td>March</td>
                                <td>₹2.5L</td>
                                <td>₹10.55K</td>
                                <td>10%</td>
                            </tr>
                            <tr>
                                <td>Jane Doe</td>
                                <td>Akash Abhay Vaidya</td>
                                <td>March</td>
                                <td>March</td>
                                <td>₹2.5L</td>
                                <td>₹10.55K</td>
                                <td>10%</td>
                            </tr>
                            <tr>
                                <td>Jane Doe</td>
                                <td>Akash Abhay Vaidya</td>
                                <td>March</td>
                                <td>March</td>
                                <td>₹2.5L</td>
                                <td>₹10.55K</td>
                                <td>10%</td>
                            </tr>
                            <tr>
                                <td>Jane Doe</td>
                                <td>Akash Abhay Vaidya</td>
                                <td>March</td>
                                <td>March</td>
                                <td>₹2.5L</td>
                                <td>₹10.55K</td>
                                <td>10%</td>
                            </tr>
                            <tr>
                                <td>Jane Doe</td>
                                <td>Akash Abhay Vaidya</td>
                                <td>March</td>
                                <td>March</td>
                                <td>₹2.5L</td>
                                <td>₹10.55K</td>
                                <td>10%</td>
                            </tr>
                            <tr>
                                <td>Jane Doe</td>
                                <td>Akash Abhay Vaidya</td>
                                <td>March</td>
                                <td>March</td>
                                <td>₹2.5L</td>
                                <td>₹10.55K</td>
                                <td>10%</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer text-right">
                <button class="btn btn-primary btn-lg">Save Changes</button>
            </div>
        </div>
    </div>
</div> --}}
@endsection

@section('script')
<script>
    $(document).ready(function () {
        $('#toggleMenu').on('click', function () {
            $(".panel-option").toggleClass('open');
        });
        $('#closeMenu').on('click', function () {
            $(".panel-option").removeClass('open');
        });
    });

</script>
@endsection
