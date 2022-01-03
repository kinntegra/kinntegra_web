@extends('layouts.master')

@section('style')
<style>
    .disabledbutton {
    pointer-events: none;
    opacity: 0.4;
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

                <div class="dropdown text-right">
                    <a class="dropdown-toggle profile-img d-none d-md-flex" type="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <img src="assets/images/analytics.svg">
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
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-xl-3 col-lg-4 col-md-4">
                        <div class="custom-wrapper">
                            <h3 class="card-title">New Transaction</h3>
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
                            <div class="transaction-table-wrap">
                                <div class="title">
                                    <svg width="40" height="40" viewBox="0 0 60 60">
                                        <use xlink:href="#transactions"></use>
                                    </svg>
                                    <h6>Trade for Ashish Mehta</h6>
                                </div>
                                <div class="table-wrap">
                                    <table class="transaction-table">
                                        <tr>
                                            <th>Type</th>
                                            <td>Buy</td>
                                        </tr>
                                        <tr>
                                            <th>Plan</th>
                                            <td>Lumpsum</td>
                                        </tr>
                                        <tr>
                                            <th>Portfolio</th>
                                            <td>Wealth, Tax</td>
                                        </tr>
                                        <tr>
                                            <th>Market Value</th>
                                            <td>₹0</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-xl-9 step-forms col-md-8 pl-0 pr-0 pr-sm-3">
                        <div class="trial active">
                            <div class="form-inner-section">
                                <div class="form-header">
                                    <h3 class="card-title">Portfolio 1: Wealth</h3>
                                </div>
                                <div class="form-content">
                                    <div class="transaction-wrapper dynamic">
                                        <div class="transaction-steps">
                                            <div class="row">
                                                <div class="col-xl-4 col-md-6">
                                                    <div class="form-group">
                                                        <label>Enter Amount</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Enter Amount">
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-md-6">
                                                    <div class="form-group">
                                                        <label>Allocation</label>
                                                        <select class="form-control">
                                                            <option>Recommended (60:40)</option>
                                                            <option>Recommended (60:40)</option>
                                                            <option>Recommended (60:40)</option>
                                                            <option>Recommended (60:40)</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-xl-2 col-md-4">
                                                    <div class="form-group last-form-group">
                                                        <label>Add SIP?</label>
                                                        <select class="form-control">
                                                            <option>Yes</option>
                                                            <option>No</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="transaction-steps" style="display:none">
                                            <div class="row">
                                                <div class="col-xl-4 col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label>SIP Amount</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Enter Amount">
                                                    </div>
                                                    <div class="form-inline">
                                                        <div class="form-group custom-radio-btn">
                                                            <label>Mandate: </label>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    name="mandate" id="mandate1"
                                                                    value="mandate1">
                                                                <label class="form-check-label"
                                                                    for="mandate1">293598237598732</label>
                                                            </div>
                                                        </div>
                                                    </div>


                                                </div>
                                                <div class="col-xl-4 col-md-6">
                                                    <div class="form-group">
                                                        <label>Allocation</label>
                                                        <select class="form-control">
                                                            <option>Recommended (60:40)</option>
                                                            <option>Recommended (60:40)</option>
                                                            <option>Recommended (60:40)</option>
                                                            <option>Recommended (60:40)</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-xl-2 col-md-4">
                                                    <div class="form-group">
                                                        <label>Tenure</label>
                                                        <select class="form-control">
                                                            <option>1 Y</option>
                                                            <option>2 Y</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-xl-2 col-md-4">
                                                    <div class="form-group last-form-group">
                                                        <label>Frequency</label>
                                                        <select class="form-control">
                                                            <option>Monthly</option>
                                                            <option>Monthly</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="transaction-steps" style="display:none">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group custom-radio-btn">
                                                        <label class="text-uppercase">Do you wish to increment
                                                            your
                                                            SIP?
                                                        </label>
                                                        <div class="form-inline mt-2">
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    name="increment" id="increment1"
                                                                    value="increment1">
                                                                <label class="form-check-label"
                                                                    for="increment1">Yes</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    name="increment" id="increment2"
                                                                    value="increment2">
                                                                <label class="form-check-label"
                                                                    for="increment2">No</label>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="col-xl-2 col-md-4">
                                                    <div class="form-group">
                                                        <label>Frequency</label>
                                                        <select class="form-control">
                                                            <option>Monthly</option>
                                                            <option>Monthly</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-md-6">
                                                    <div class="form-group last-form-group">
                                                        <label>Increment by</label>
                                                        <div class="multi-input">

                                                            <input type="text" class="form-control mr-0"
                                                                placeholder="Percent">

                                                            <span class="or">OR</span>

                                                            <input type="text" class="form-control"
                                                                placeholder="Amount">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="transaction-steps" style="display:none">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group custom-radio-btn">
                                                        <label class="text-uppercase">Select SIP Start Date
                                                        </label>
                                                        <div class="form-inline mt-2">
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    name="sip" id="Fixed" value="Fixed">
                                                                <label class="form-check-label"
                                                                    for="Fixed">Fixed</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    name="sip" id="spread" value="spread">
                                                                <label class="form-check-label"
                                                                    for="spread"><span class="text">Spread
                                                                        Across Month</span>
                                                                    <span
                                                                        class="badge badge-success badge-pill ml-2">Recommended</span></label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    name="sip" id="Custom" value="Custom">
                                                                <label class="form-check-label"
                                                                    for="Custom">Custom</label>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-md-6">
                                                    <div class="form-group">
                                                        <label>Fixed Date</label>
                                                        <select class="form-control">
                                                            <option>23rd Mar 2020</option>
                                                            <option>23rd Mar 2020</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-footer disabledbutton">

                                    <a class="btn btn-link"><svg width="30" height="30" viewBox="0 0 24 24">
                                            <use xlink:href="#allocation"></use>
                                        </svg>View Allocation</a>

                                    <button class="btn btn-primary btn-lg ml-4">Proceed</button>

                                </div>
                            </div>
                        </div>

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
        $('.last-form-group .form-control').on('select2:select', function (e) {
            let parent = $(this).parentsUntil(".transaction-steps").parent();
            parent.addClass('current');
            parent.next().show();
        });
        $(".last-form-group .form-control").blur(function () {
            let parent = $(this).parentsUntil(".transaction-steps").parent();
            parent.addClass('current');
            parent.next().show();
        })
    </script>
@endsection
