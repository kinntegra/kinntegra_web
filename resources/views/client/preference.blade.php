@extends('layouts.master')

@section('style')

@endsection


@section('content')
<div class="container-fluid">
    <div class="table-top-section d-flex justify-content-between align-items-center mb-4">
        <a class="back-btn" href="#">
            <i class="icon-left-arrow"></i>
            Go Back
        </a>
        <div class="section-header ">

            <div class="dropdown text-right">
                <a class="dropdown-toggle profile-img" type="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <img src="/assets/images/analytics.svg">
                    <span>Ashton Maxwell</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="#">View Profile</a>
                    <a class="dropdown-item" href="#">Logout</a>
                </div>
            </div>
            <button class="btn btn-icon outline-dark notification-bell">
                <span class="count">2</span>
                <svg width="30" height="30" viewBox="0 -1 17 25">
                    <use xlink:href="#notification" />
                </svg>
            </button>

        </div>
    </div>
    <div class="card w-100">
        <div class="card-body">
            <div class="row">
                <div class="col-xl-3 col-lg-4 col-md-4">
                    <h3 class="card-title">Create New Client</h3>
                    <div class="form-percentage">
                        <svg viewBox="0 0 36 36" class="circular-chart orange">
                            <path class="circle-bg" d="M18 2.0845
                                a 15.9155 15.9155 0 0 1 0 31.831
                                a 15.9155 15.9155 0 0 1 0 -31.831" />
                            <path class="circle" stroke-dasharray="00, 100" d="M18 2.0845
                                a 15.9155 15.9155 0 0 1 0 31.831
                                a 15.9155 15.9155 0 0 1 0 -31.831" />
                            <text x="18" y="20.35" class="percentage">0%</text>
                        </svg>
                    </div>
                    <ul class="form-lists">
                        <li data-form="introduction" class="">
                            <div class="indicator">
                                <div class="check"></div>
                            </div>
                            Introduction

                        </li>
                        <li data-form="comprehensive-plan" class="isParent">
                            <div class="indicator">
                                <div class="check"></div>
                            </div>
                            Comprehensive plan
                            <ul>
                                <li class="isChild" data-form="income-details">Income Details</li>
                                <li class="isChild" data-form="goal-details">Goal Details</li>
                                <li class="isChild" data-form="expense">Expense</li>
                                <!-- <li class="isChild" data-form="lifestyle-expense">Lifestyle Expense</li>
                                <li class="isChild" data-form="dependent">Dependent</li> -->
                                <li class="isChild" data-form="insurance">Insurance Premium</li>
                                <li class="isChild" data-form="liability">Liability</li>
                            </ul>
                        </li>
                        <li data-form="account-creation" class="">
                            <div class="indicator">
                                <div class="check"></div>
                            </div>
                            Account Creation

                        </li>
                        <li data-form="mandate" class="active">
                            <div class="indicator">
                                <div class="check"></div>
                            </div>
                            Mandate

                        </li>
                        <li data-form="download" class="">
                            <div class="indicator">
                                <div class="check"></div>
                            </div>
                            Account Creation

                        </li>
                        <li data-form="login-preference" class="">
                            <div class="indicator">
                                <div class="check"></div>
                            </div>
                            Login Preference
                        </li>
                        <li data-form="report-preference" class="">
                            <div class="indicator">
                                <div class="check"></div>
                            </div>
                            Report Preference
                        </li>
                    </ul>
                </div>
                <form class="col-lg-8 col-xl-9 step-forms col-md-8">
                    @csrf
                    <section class="trial active" id="preference" data-step="1"  autocomplete="off">
                        <h3 class="card-title">Login Preferences</h3>
                        <div class="form-sections">
                            <h4 class="form-section-title text-uppercase mb-2">Buy</h4>
                            <table class="table normal-table">
                                <thead>
                                    <tr>
                                        <th>Transaction</th>
                                        <th class="text-center">Ashish Jaiswal</th>
                                        <th class="text-center">Neha Jaiswal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            Wealth
                                        </td>
                                        <td>
                                            <div class="form-group custom-checkbox mb-0 text-center">
                                                <input type="checkbox" id="Wealth1">
                                                <label for="Wealth1"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group custom-checkbox mb-0 text-center">
                                                <input type="checkbox" id="Wealth2">
                                                <label for="Wealth2"></label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Tax
                                        </td>
                                        <td>
                                            <div class="form-group custom-checkbox mb-0 text-center">
                                                <input type="checkbox" id="Tax1">
                                                <label for="Tax1"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group custom-checkbox mb-0 text-center">
                                                <input type="checkbox" id="Tax2">
                                                <label for="Tax2"></label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Short Term
                                        </td>
                                        <td>
                                            <div class="form-group custom-checkbox mb-0 text-center">
                                                <input type="checkbox" id="Short-Term1">
                                                <label for="Short-Term1"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group custom-checkbox mb-0 text-center">
                                                <input type="checkbox" id="Short-Term2">
                                                <label for="Short-Term2"></label>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="form-sections">
                            <h4 class="form-section-title text-uppercase mb-2">Sell</h4>
                            <table class="table normal-table">
                                <thead>
                                    <tr>
                                        <th>Transaction</th>
                                        <th class="text-center">Ashish Jaiswal</th>
                                        <th class="text-center">Neha Jaiswal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            Wealth
                                        </td>
                                        <td>
                                            <div class="form-group custom-checkbox mb-0 text-center">
                                                <input type="checkbox" id="Wealth1">
                                                <label for="Wealth1"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group custom-checkbox mb-0 text-center">
                                                <input type="checkbox" id="Wealth2">
                                                <label for="Wealth2"></label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Tax
                                        </td>
                                        <td>
                                            <div class="form-group custom-checkbox mb-0 text-center">
                                                <input type="checkbox" id="Tax1">
                                                <label for="Tax1"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group custom-checkbox mb-0 text-center">
                                                <input type="checkbox" id="Tax2">
                                                <label for="Tax2"></label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Short Term
                                        </td>
                                        <td>
                                            <div class="form-group custom-checkbox mb-0 text-center">
                                                <input type="checkbox" id="Short-Term1">
                                                <label for="Short-Term1"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group custom-checkbox mb-0 text-center">
                                                <input type="checkbox" id="Short-Term2">
                                                <label for="Short-Term2"></label>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="form-sections">
                            <h4 class="form-section-title text-uppercase mb-2">Report</h4>
                            <table class="table normal-table">
                                <thead>
                                    <tr>
                                        <th>Transaction</th>
                                        <th class="text-center">Ashish Jaiswal</th>
                                        <th class="text-center">Neha Jaiswal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            Realised
                                        </td>
                                        <td>
                                            <div class="form-group custom-checkbox mb-0 text-center">
                                                <input type="checkbox" id="Realised1">
                                                <label for="Realised1"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group custom-checkbox mb-0 text-center">
                                                <input type="checkbox" id="Realised2">
                                                <label for="Realised2"></label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Unrealised
                                        </td>
                                        <td>
                                            <div class="form-group custom-checkbox mb-0 text-center">
                                                <input type="checkbox" id="Unrealised1">
                                                <label for="Unrealised1"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group custom-checkbox mb-0 text-center">
                                                <input type="checkbox" id="Unrealised2">
                                                <label for="Unrealised2"></label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Payout
                                        </td>
                                        <td>
                                            <div class="form-group custom-checkbox mb-0 text-center">
                                                <input type="checkbox" id="Payout1">
                                                <label for="Payout1"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group custom-checkbox mb-0 text-center">
                                                <input type="checkbox" id="Payout2">
                                                <label for="Payout2"></label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            SIP
                                        </td>
                                        <td>
                                            <div class="form-group custom-checkbox mb-0 text-center">
                                                <input type="checkbox" id="SIP1">
                                                <label for="SIP1"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group custom-checkbox mb-0 text-center">
                                                <input type="checkbox" id="SIP2">
                                                <label for="SIP2"></label>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="form-sections">
                            <h4 class="form-section-title text-uppercase mb-2">Holding</h4>
                            <table class="table normal-table">
                                <thead>
                                    <tr>
                                        <th>Transaction</th>
                                        <th class="text-center">Ashish Jaiswal</th>
                                        <th class="text-center">Neha Jaiswal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            Portfolio
                                        </td>
                                        <td>
                                            <div class="form-group custom-checkbox mb-0 text-center">
                                                <input type="checkbox" id="Portfolio1">
                                                <label for="Portfolio1"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group custom-checkbox mb-0 text-center">
                                                <input type="checkbox" id="Portfolio2">
                                                <label for="Portfolio2"></label>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg">Proceed</button>
                    </section>
                    <section class="trial" id="report-preference" data-step="2"  autocomplete="off">
                        <h3 class="card-title">Report Preferences</h3>

                        <table class="table normal-table">
                            <thead>
                                <tr>
                                    <th>Investment Value</th>
                                    <th>Ashish Jaiswal</th>
                                    <th>Neha Jaiswal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        Realised
                                    </td>
                                    <td>
                                        <select class="form-control">
                                            <option>12412526347457</option>
                                            <option>12412526347457</option>
                                            <option>12412526347457</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-control">
                                            <option>12412526347457</option>
                                            <option>12412526347457</option>
                                            <option>12412526347457</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Unrealised
                                    </td>
                                    <td>
                                        <select class="form-control">
                                            <option>12412526347457</option>
                                            <option>12412526347457</option>
                                            <option>12412526347457</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-control">
                                            <option>12412526347457</option>
                                            <option>12412526347457</option>
                                            <option>12412526347457</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Portfolio
                                    </td>
                                    <td>
                                        <select class="form-control">
                                            <option>12412526347457</option>
                                            <option>12412526347457</option>
                                            <option>12412526347457</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-control">
                                            <option>12412526347457</option>
                                            <option>12412526347457</option>
                                            <option>12412526347457</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Holdings
                                    </td>
                                    <td>
                                        <select class="form-control">
                                            <option>12412526347457</option>
                                            <option>12412526347457</option>
                                            <option>12412526347457</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-control">
                                            <option>12412526347457</option>
                                            <option>12412526347457</option>
                                            <option>12412526347457</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Payout
                                    </td>
                                    <td>
                                        <select class="form-control">
                                            <option>12412526347457</option>
                                            <option>12412526347457</option>
                                            <option>12412526347457</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-control">
                                            <option>12412526347457</option>
                                            <option>12412526347457</option>
                                            <option>12412526347457</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Trade Logs
                                    </td>
                                    <td>
                                        <select class="form-control">
                                            <option>12412526347457</option>
                                            <option>12412526347457</option>
                                            <option>12412526347457</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-control">
                                            <option>12412526347457</option>
                                            <option>12412526347457</option>
                                            <option>12412526347457</option>
                                        </select>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <button type="submit" class="btn btn-primary btn-lg">Proceed</button>
                    </section>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection

@section('modal')
<div class="modal fade" id="assetsModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Restructure Assets</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul class="nav nav-tabs mb-4" id="lead-generation" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" data-toggle="tab" href="#fixed-income" role="tab"
                                aria-selected="true">Fixed Asset Income</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-toggle="tab" href="#sustainable-assets" role="tab"
                                aria-selected="false">Wealth Sustainability Assets</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-toggle="tab" href="#wealth-assets" role="tab"
                                aria-selected="false">Wealth Creation Assets</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="fixed-income" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table normal-table">
                                    <thead>
                                        <tr>
                                            <th>Category</th>
                                            <th>Family Member</th>
                                            <th>Description</th>
                                            <th>Investment Value</th>
                                            <th>Current Market Value</th>
                                            <th>Restruturable Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                Residential
                                            </td>
                                            <td>
                                                Ashish Jaiswal
                                            </td>
                                            <td>
                                                Self Occupied Property
                                            </td>
                                            <td>
                                                ₹17.88L
                                            </td>
                                            <td>
                                                ₹17.88L
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" value="12412526347457">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Residential
                                            </td>
                                            <td>
                                                Ashish Jaiswal
                                            </td>
                                            <td>
                                                Self Occupied Property
                                            </td>
                                            <td>
                                                ₹17.88L
                                            </td>
                                            <td>
                                                ₹17.88L
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" value="12412526347457">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade show" id="sustainable-assets" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table normal-table">
                                    <thead>
                                        <tr>
                                            <th>Category</th>
                                            <th>Family Member</th>
                                            <th>Description</th>
                                            <th>Investment Value</th>
                                            <th>Current Market Value</th>
                                            <th>Restruturable Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                Residential
                                            </td>
                                            <td>
                                                Ashish Jaiswal
                                            </td>
                                            <td>
                                                Self Occupied Property
                                            </td>
                                            <td>
                                                ₹17.88L
                                            </td>
                                            <td>
                                                ₹17.88L
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" value="12412526347457">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Residential
                                            </td>
                                            <td>
                                                Ashish Jaiswal
                                            </td>
                                            <td>
                                                Self Occupied Property
                                            </td>
                                            <td>
                                                ₹17.88L
                                            </td>
                                            <td>
                                                ₹17.88L
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" value="12412526347457">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade show" id="wealth-assets" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table normal-table">
                                    <thead>
                                        <tr>
                                            <th>Category</th>
                                            <th>Family Member</th>
                                            <th>Description</th>
                                            <th>Investment Value</th>
                                            <th>Current Market Value</th>
                                            <th>Restruturable Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                Residential
                                            </td>
                                            <td>
                                                Ashish Jaiswal
                                            </td>
                                            <td>
                                                Self Occupied Property
                                            </td>
                                            <td>
                                                ₹17.88L
                                            </td>
                                            <td>
                                                ₹17.88L
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" value="12412526347457">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Residential
                                            </td>
                                            <td>
                                                Ashish Jaiswal
                                            </td>
                                            <td>
                                                Self Occupied Property
                                            </td>
                                            <td>
                                                ₹17.88L
                                            </td>
                                            <td>
                                                ₹17.88L
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" value="12412526347457">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer text-right">
                    <button type="button" class="btn btn-primary col-sm-3">Calculate</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="emailModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Email</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="add-email">Add Email</label>
                        <input type="text" class="form-control" id="add-email" placeholder="Add Email">
                        <small class="text-muted">Seperate multiple Email IDs with comma</small>
                    </div>
                    <div class="form-group">
                        <label for="add-cc">CC</label>
                        <input type="text" class="form-control" id="add-cc" placeholder="Add CC">
                        <small class="text-muted">Seperate multiple Email IDs with comma</small>
                    </div>
                </div>
                <div class="modal-footer text-right">
                    <button type="button" class="btn btn-primary col-sm-3">Email</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
<script type="text/javascript" src="{{ asset('assets/javascript/colorpicker.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/javascript/client.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/javascript/clientcreation.js') }}"></script>
@endsection
