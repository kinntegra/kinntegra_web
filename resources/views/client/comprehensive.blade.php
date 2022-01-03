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
        <div class="card-body p-0">
            <div class="row">
                @php
                $is_verify = 0;
                $url = Request::fullurl();
                $url_components = parse_url($url);
                if(isset($url_components['query']))
                {
                    parse_str($url_components['query'], $params);
                    $is_verify = $params['is_verify'];
                }
                @endphp
                <div class="col-xl-3 col-lg-4 col-md-4">
                    <div class="custom-wrapper">
                        @include('client.leftbar', ['is_verify' => $is_verify])
                    </div>
                </div>

                <form class="col-lg-8 col-xl-9 step-forms col-md-8 pl-0" enctype="multipart/form-data" id="comprehensive" method="POST" action="{{ route('comprehensive.store') }}">
                    @csrf
                    <input type="hidden" name="id" id="client_id" value="{{ @$client_id }}">
                    <input type="hidden" name="client_edit" id="client_edit" value="">
                    <input type="hidden" name="step_edit" id="step_edit" value="">
                    <input type="hidden" name="current_pid" id="current_pid" value="">
                    <input type="hidden" name="current_step_id" id="current_step_id" value="">
                    <input type="hidden" name="is_verify" id="is_verify" value="{{ $is_verify }}">
                    <section class="trial active" id="comprehensive-plan" data-step="1" autocomplete="off">
                        <div class="form-inner-section">
                            <div class="form-header">
                                <h3 class="card-title"><i class="icon-left-arrow back-btn back_to_intro"></i> Comprehensive plan</h3>
                            </div>
                            <div class="form-content">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-sections">
                                            <h4 class="form-section-title text-uppercase">WHY DO THIS
                                                EXERCISE?</h4>
                                            <ul class="info-lists">
                                                <li>Objectifying the purpose of investment.</li>
                                                <li>Help our investors understand what is the minimum return
                                                    they
                                                    should earn on their entire portfolio to make sure that
                                                    it at
                                                    least lasts long till their life expectancy or meet
                                                    their
                                                    lifestyle inflation.</li>
                                                <li>What is the real return each of their financial and
                                                    physical
                                                    assets have given them over years of investments.</li>
                                                <li>How much risk one should take to achieve minimum return
                                                    requirement and what asset class has the highest
                                                    probability to
                                                    achieve it.</li>
                                                <li>On one single sheet you will be able to assess you
                                                    current and
                                                    future cash flows (both inflow and outflow).</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <lottie-player src="assets/images/client.json"
                                            background="transparent" speed="1" style="height: 300px;" loop
                                            autoplay></lottie-player>
                                    </div>
                                </div>
                            </div>
                            <div class="form-footer">
                                <button type="button" class="btn btn-primary btn-lg proceed">Proceed</button>
                            </div>
                        </div>
                    </section>
                    <section class="trial" id="income-details" data-step="2" autocomplete="off">
                        <div class="form-inner-section">
                            <div class="form-header">
                                <h3 class="card-title"><i class="icon-left-arrow back-btn"></i> Income Details</h3>
                            </div>
                            <div class="form-content">
                                <ul class="nav nav-tabs mb-5" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" data-toggle="tab" href="#member-tab1"
                                            role="tab" aria-selected="true">Ashish Jaiswal</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" data-toggle="tab" href="#member-tab2" role="tab"
                                            aria-selected="true">Neha Jaiswal</a>
                                    </li>
                                </ul>
                                <div class="tab-content family-tab">
                                    <div class="tab-pane fade show active" id="member-tab1" role="tabpanel"
                                        aria-labelledby="member1-tab">
                                        <div class="form-sections">
                                            <h4 class="form-section-title text-uppercase">Enter Details for
                                                Categories</h4>
                                            <ul class="nav nav-tabs income-tab mb-3" role="tablist">

                                                <div class="disabled-wrapper">
                                                    <li class="nav-item disabled" role="presentation">
                                                        <a class="nav-link active" data-toggle="tab"
                                                            href="#salary-income" role="tab"
                                                            aria-selected="true">Salary
                                                            Income</a>
                                                        <span class="remove-member"><i
                                                                class="icon-close"></i></span>
                                                        <span class="add-income">+</span>
                                                    </li>
                                                    <li class="nav-item disabled" role="presentation">
                                                        <a class="nav-link" data-toggle="tab"
                                                            href="#business-income" role="tab"
                                                            aria-selected="true">Business Income</a>
                                                        <span class="remove-member"><i
                                                                class="icon-close"></i></span>
                                                        <span class="add-income">+</span>
                                                    </li>
                                                    <li class="nav-item disabled" role="presentation">
                                                        <a class="nav-link" data-toggle="tab" href="#rent"
                                                            role="tab" aria-selected="true">Rental
                                                            Income</a>
                                                        <span class="remove-member"><i
                                                                class="icon-close"></i></span>
                                                        <span class="add-income">+</span>
                                                    </li>
                                                    <li class="nav-item disabled" role="presentation">
                                                        <a class="nav-link" data-toggle="tab" href="#ppf"
                                                            role="tab" aria-selected="true">PPF (Public
                                                            Provident Fund)</a>
                                                        <span class="remove-member"><i
                                                                class="icon-close"></i></span>
                                                        <span class="add-income">+</span>
                                                    </li>
                                                    <li class="nav-item disabled" role="presentation">
                                                        <a class="nav-link" data-toggle="tab" href="#epf"
                                                            role="tab" aria-selected="true">EPF(Employee
                                                            Provident Fund)</a>
                                                        <span class="remove-member"><i
                                                                class="icon-close"></i></span>
                                                        <span class="add-income">+</span>
                                                    </li>
                                                    <li class="nav-item disabled" role="presentation">
                                                        <a class="nav-link" data-toggle="tab"
                                                            href="#gratuity" role="tab"
                                                            aria-selected="true">Gratuity</a>
                                                        <span class="remove-member"><i
                                                                class="icon-close"></i></span>
                                                        <span class="add-income">+</span>
                                                    </li>
                                                    <li class="nav-item disabled" role="presentation">
                                                        <a class="nav-link" data-toggle="tab" href="#fd"
                                                            role="tab" aria-selected="true">FD</a>
                                                        <span class="remove-member"><i
                                                                class="icon-close"></i></span>
                                                        <span class="add-income">+</span>
                                                    </li>
                                                    <li class="nav-item disabled" role="presentation">
                                                        <a class="nav-link" data-toggle="tab" href="#rd"
                                                            role="tab" aria-selected="true">RD (Recurring
                                                            deposit) / PIS
                                                            (Postal
                                                            Investment Scheme)</a>
                                                        <span class="remove-member"><i
                                                                class="icon-close"></i></span>
                                                        <span class="add-income">+</span>
                                                    </li>
                                                    <li class="nav-item disabled" role="presentation">
                                                        <a class="nav-link" data-toggle="tab"
                                                            href="#pension" role="tab"
                                                            aria-selected="true">Pension Income</a>
                                                        <span class="remove-member"><i
                                                                class="icon-close"></i></span>
                                                        <span class="add-income">+</span>
                                                    </li>
                                                    <li class="nav-item disabled" role="presentation">
                                                        <a class="nav-link" data-toggle="tab" href="#bond"
                                                            role="tab" aria-selected="true">Bond</a>
                                                        <span class="remove-member"><i
                                                                class="icon-close"></i></span>
                                                        <span class="add-income">+</span>
                                                    </li>
                                                    <li class="nav-item disabled" role="presentation">
                                                        <a class="nav-link" data-toggle="tab"
                                                            href="#insurance" role="tab"
                                                            aria-selected="true">Insurance</a>
                                                        <span class="remove-member"><i
                                                                class="icon-close"></i></span>
                                                        <span class="add-income">+</span>
                                                    </li>
                                                    <li class="nav-item disabled" role="presentation">
                                                        <a class="nav-link" data-toggle="tab" href="#mf"
                                                            role="tab" aria-selected="true">Mutual Fund</a>
                                                        <span class="remove-member"><i
                                                                class="icon-close"></i></span>
                                                        <span class="add-income">+</span>
                                                    </li>
                                                    <li class="nav-item disabled" role="presentation">
                                                        <a class="nav-link" data-toggle="tab" href="#cash"
                                                            role="tab" aria-selected="true">Cash In Hand</a>
                                                        <span class="remove-member"><i
                                                                class="icon-close"></i></span>
                                                        <span class="add-income">+</span>
                                                    </li>
                                                    <li class="nav-item disabled" role="presentation">
                                                        <a class="nav-link" data-toggle="tab" href="#gold"
                                                            role="tab" aria-selected="true">Gold</a>
                                                        <span class="remove-member"><i
                                                                class="icon-close"></i></span>
                                                        <span class="add-income">+</span>
                                                    </li>
                                                    <li class="nav-item disabled" role="presentation">
                                                        <a class="nav-link" data-toggle="tab" href="#shares"
                                                            role="tab" aria-selected="true">Shares / PMS
                                                            (Portfolio
                                                            Management
                                                            Services)</a>
                                                        <span class="remove-member"><i
                                                                class="icon-close"></i></span>
                                                        <span class="add-income">+</span>
                                                    </li>
                                                    <li class="nav-item disabled" role="presentation">
                                                        <a class="nav-link" data-toggle="tab" href="#other"
                                                            role="tab" aria-selected="true">Other</a>
                                                        <span class="remove-member"><i
                                                                class="icon-close"></i></span>
                                                        <span class="add-income">+</span>
                                                    </li>
                                                </div>
                                                <a href="javascript:void(0)" class="leftTabArrow"><i
                                                        class="icon-left-arrow"></i></a>
                                                <a href="javascript:void(0)" class="rightTabArrow"><i
                                                        class="icon-right-arrow"></i></a>
                                            </ul>
                                            <div class="tab-content">
                                                <div class="tab-pane fade" id="salary-income"
                                                    role="tabpanel">
                                                    <div class="inline-form">
                                                        <div class="form-group">
                                                            <label>Net Income(Monthly)</label>
                                                            <input type="text" class="form-control amount">
                                                            <small class="text-muted inwords"></small>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Increment Month</label>
                                                            <select class="form-control">
                                                                <option>January</option>
                                                                <option>Febraury</option>
                                                                <option>March</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Average Growth Rate (%)</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Retirement Age</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Year of Retirement</label>
                                                            <input type="text" class="form-control"
                                                                disabled>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Net Income(Yearly)</label>
                                                            <input type="text" class="form-control"
                                                                disabled>
                                                        </div>
                                                        <a class="btn delete-element btn-link mt-0 mt-md-4">
                                                            <svg width="30" height="30"
                                                                viewBox="0 -1 17 25">
                                                                <use xlink:href="#delete-icon"></use>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                    <a class="btn btn-link d-block m-auto add-more-btn">
                                                        <svg width="30" height="30" viewBox="-2 -2 28 28"
                                                            class="mr-0">
                                                            <use xlink:href="#add-btn"></use>
                                                        </svg>
                                                        Add More
                                                    </a>
                                                </div>
                                                <div class="tab-pane fade" id="business-income"
                                                    role="tabpanel">
                                                    <div class="inline-form">
                                                        <div class="form-group">
                                                            <label>Net Income(Yearly)</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Average Growth Rate (%)</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Retirement Age</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Year of Retirement</label>
                                                            <input type="text" class="form-control"
                                                                disabled>
                                                        </div>
                                                        <a class="btn delete-element btn-link mt-0 mt-md-4">
                                                            <svg width="30" height="30"
                                                                viewBox="0 -1 17 25">
                                                                <use xlink:href="#delete-icon"></use>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                    <a class="btn btn-link d-block m-auto add-more-btn">
                                                        <svg width="30" height="30" viewBox="-2 -2 28 28"
                                                            class="mr-0">
                                                            <use xlink:href="#add-btn"></use>
                                                        </svg>
                                                        Add More
                                                    </a>
                                                </div>
                                                <div class="tab-pane fade show" id="rent" role="tabpanel"
                                                    aria-labelledby="rent-tab">
                                                    <div class="inline-form">

                                                        <div class="form-group">
                                                            <label>Property Details</label>
                                                            <input type="text" class="form-control">
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Property Type</label>
                                                            <select class="form-control">
                                                                <option>Property Type</option>
                                                                <option>Property Type</option>
                                                                <option>Property Type</option>
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Property Purchase Value</label>
                                                            <input type="text" class="form-control">
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Property Market Value</label>
                                                            <input type="text" class="form-control">
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Description</label>
                                                            <input type="text" class="form-control">
                                                        </div>

                                                        <div class="form-group custom-radio-btn mb-0">
                                                            <label
                                                                class="text-light text-uppercase mb-2 d-block">Is
                                                                on Rent</label>
                                                            <div class="form-check form-check-inline m-0">
                                                                <input class="form-check-input" type="radio"
                                                                    name="allocation" id="yes" value="yes"
                                                                    checked>
                                                                <label class="form-check-label" for="yes">
                                                                    <span class="label">Yes </span>
                                                                </label>
                                                            </div>
                                                            <div
                                                                class="form-check form-check-inline m-0 ml-3">
                                                                <input class="form-check-input" type="radio"
                                                                    name="allocation" id="no" value="no">
                                                                <label class="form-check-label" for="no">
                                                                    <span class="label">No </span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <a class="btn delete-element btn-link mt-0 mt-md-4">
                                                            <svg width="30" height="30"
                                                                viewBox="0 -1 17 25">
                                                                <use xlink:href="#delete-icon"></use>
                                                            </svg>
                                                        </a>
                                                        <div>
                                                            <div class="d-flex flex-wrap">

                                                                <div class="form-group">
                                                                    <label>Rental Details</label>
                                                                    <input type="text" class="form-control">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>Income - Per Month</label>
                                                                    <input type="text" class="form-control">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>Start Date</label>
                                                                    <input type="text" name="singleDate"
                                                                        class="form-control">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>End Date</label>
                                                                    <input type="text" name="singleDate"
                                                                        class="form-control">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>Tenure (In Month)</label>
                                                                    <input type="text" class="form-control"
                                                                        disabled>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>Pay Date</label>
                                                                    <select class="form-control">
                                                                        <option>1</option>
                                                                        <option>2</option>
                                                                        <option>3</option>
                                                                    </select>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label> Annual Income</label>
                                                                    <input type="text" class="form-control"
                                                                        disabled>
                                                                </div>

                                                                <div
                                                                    class="form-group custom-radio-btn mb-0">
                                                                    <label
                                                                        class="text-light text-uppercase mb-2 d-block">
                                                                        Auto Renew</label>
                                                                    <div
                                                                        class="form-check form-check-inline m-0">
                                                                        <input class="form-check-input"
                                                                            type="radio" name="allocation"
                                                                            id="renewyes" value="renewyes"
                                                                            checked>
                                                                        <label class="form-check-label"
                                                                            for="renewyes">
                                                                            <span class="label">Yes
                                                                            </span>
                                                                        </label>
                                                                    </div>
                                                                    <div
                                                                        class="form-check form-check-inline m-0 ml-3">
                                                                        <input class="form-check-input"
                                                                            type="radio" name="allocation"
                                                                            id="renewno" value="renewno">
                                                                        <label class="form-check-label"
                                                                            for="renewno">
                                                                            <span class="label">No
                                                                            </span>
                                                                        </label>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>Rental Increment %</label>
                                                                    <input type="text" class="form-control">
                                                                </div>

                                                            </div>
                                                        </div>

                                                    </div>
                                                    <a class="btn btn-link d-block m-auto add-more-btn">
                                                        <svg width="30" height="30" viewBox="-2 -2 28 28"
                                                            class="mr-0">
                                                            <use xlink:href="#add-btn"></use>
                                                        </svg>
                                                        Add More
                                                    </a>
                                                </div>
                                                <div class="tab-pane fade show" id="ppf" role="tabpanel"
                                                    aria-labelledby="rent-tab">
                                                    <div class="inline-form">
                                                        <div class="form-group">
                                                            <label>Amount</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Maturity Date</label>
                                                            <input type="text" name="singleDate"
                                                                class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Year to Mature</label>
                                                            <input type="text" class="form-control"
                                                                disabled>
                                                        </div>
                                                        <a class="btn delete-element btn-link mt-0 mt-md-4">
                                                            <svg width="30" height="30"
                                                                viewBox="0 -1 17 25">
                                                                <use xlink:href="#delete-icon"></use>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                    <a class="btn btn-link d-block m-auto add-more-btn">
                                                        <svg width="30" height="30" viewBox="-2 -2 28 28"
                                                            class="mr-0">
                                                            <use xlink:href="#add-btn"></use>
                                                        </svg>
                                                        Add More
                                                    </a>
                                                </div>
                                                <div class="tab-pane fade show" id="epf" role="tabpanel"
                                                    aria-labelledby="rent-tab">
                                                    <div class="inline-form">
                                                        <div class="form-group">
                                                            <label>Amount</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Maturity Date</label>
                                                            <input type="text" class="form-control"
                                                                disabled>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Year to Mature</label>
                                                            <input type="text" class="form-control"
                                                                disabled>
                                                        </div>
                                                        <a class="btn delete-element btn-link mt-0 mt-md-4">
                                                            <svg width="30" height="30"
                                                                viewBox="0 -1 17 25">
                                                                <use xlink:href="#delete-icon"></use>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                    <a class="btn btn-link d-block m-auto add-more-btn">
                                                        <svg width="30" height="30" viewBox="-2 -2 28 28"
                                                            class="mr-0">
                                                            <use xlink:href="#add-btn"></use>
                                                        </svg>
                                                        Add More
                                                    </a>
                                                </div>
                                                <div class="tab-pane fade show" id="gratuity"
                                                    role="tabpanel">
                                                    <div class="inline-form">
                                                        <div class="form-group">
                                                            <label>Amount</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Maturity Date</label>
                                                            <input type="text" class="form-control"
                                                                disabled>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Year to Mature</label>
                                                            <input type="text" class="form-control"
                                                                disabled>
                                                        </div>
                                                        <a class="btn delete-element btn-link mt-0 mt-md-4">
                                                            <svg width="30" height="30"
                                                                viewBox="0 -1 17 25">
                                                                <use xlink:href="#delete-icon"></use>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                    <a class="btn btn-link d-block m-auto add-more-btn">
                                                        <svg width="30" height="30" viewBox="-2 -2 28 28"
                                                            class="mr-0">
                                                            <use xlink:href="#add-btn"></use>
                                                        </svg>
                                                        Add More
                                                    </a>
                                                </div>
                                                <div class="tab-pane fade show" id="fd" role="tabpanel">
                                                    <div class="inline-form">
                                                        <div class="form-group">
                                                            <label>Description</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Principal Amount </label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Maturity Amount </label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Interest Rate</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Start Date </label>
                                                            <input type="text" name="singleDate"
                                                                class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Maturity Date</label>
                                                            <input type="text" name="singleDate"
                                                                class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Payable Cycle</label>
                                                            <select>
                                                                <option>Monthly</option>
                                                                <option>Quaterly</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Principal Amount </label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Payment Date</label>
                                                            <input type="text" name="singleDate"
                                                                class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Payment Amount(Yearly)</label>
                                                            <input type="text" class="form-control"
                                                                disabled>
                                                        </div>
                                                        <a class="btn delete-element btn-link mt-0 mt-md-4">
                                                            <svg width="30" height="30"
                                                                viewBox="0 -1 17 25">
                                                                <use xlink:href="#delete-icon"></use>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                    <a class="btn btn-link d-block m-auto add-more-btn">
                                                        <svg width="30" height="30" viewBox="-2 -2 28 28"
                                                            class="mr-0">
                                                            <use xlink:href="#add-btn"></use>
                                                        </svg>
                                                        Add More
                                                    </a>
                                                </div>
                                                <div class="tab-pane fade show" id="rd" role="tabpanel">
                                                    <div class="inline-form">
                                                        <div class="form-group">
                                                            <label>Description</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Principal Amount (Monthly)</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Payable Cycle</label>
                                                            <select>
                                                                <option>Monthly</option>
                                                                <option>Quaterly</option>
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Start Date </label>
                                                            <input type="text" name="singleDate"
                                                                class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>End Date</label>
                                                            <input type="text" name="singleDate"
                                                                class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>No of Installments</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Principal Amount </label>
                                                            <input type="text" class="form-control"
                                                                disabled>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Maturity Amount </label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Interest Rate</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Maturity Date</label>
                                                            <input type="text" name="singleDate"
                                                                class="form-control">
                                                        </div>
                                                        <a class="btn delete-element btn-link mt-0 mt-md-4">
                                                            <svg width="30" height="30"
                                                                viewBox="0 -1 17 25">
                                                                <use xlink:href="#delete-icon"></use>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                    <a class="btn btn-link d-block m-auto add-more-btn">
                                                        <svg width="30" height="30" viewBox="-2 -2 28 28"
                                                            class="mr-0">
                                                            <use xlink:href="#add-btn"></use>
                                                        </svg>
                                                        Add More
                                                    </a>
                                                </div>
                                                <div class="tab-pane fade show" id="pension"
                                                    role="tabpanel">
                                                    <div class="inline-form">
                                                        <div class="form-group">
                                                            <label>Description</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Amount </label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Payable</label>
                                                            <select>
                                                                <option>Monthly</option>
                                                                <option>Quaterly</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Amount(Yearly)</label>
                                                            <input type="text" class="form-control"
                                                                disabled>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Start Date </label>
                                                            <input type="text" name="singleDate"
                                                                class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="mb-2">Uptil life</label>
                                                            <div class="form-group custom-checkbox">
                                                                <input type="checkbox" id="uptilLife">
                                                                <label for="uptilLife">Uptil life</label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="mb-2">Payable To Relation</label>
                                                            <div class="d-flex ">
                                                                <div
                                                                    class="form-group custom-checkbox mb-0">
                                                                    <input type="checkbox" id="self">
                                                                    <label for="self">Self</label>
                                                                </div>
                                                                <div
                                                                    class="form-group custom-checkbox mb-0">
                                                                    <input type="checkbox" id="spouse">
                                                                    <label for="spouse">Spouse</label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label>End Date</label>
                                                            <input type="text" name="singleDate"
                                                                class="form-control">
                                                        </div>
                                                        <a class="btn delete-element btn-link mt-0 mt-md-4">
                                                            <svg width="30" height="30"
                                                                viewBox="0 -1 17 25">
                                                                <use xlink:href="#delete-icon"></use>
                                                            </svg>
                                                        </a>
                                                    </div>

                                                    <a class="btn btn-link d-block m-auto add-more-btn">
                                                        <svg width="30" height="30" viewBox="-2 -2 28 28"
                                                            class="mr-0">
                                                            <use xlink:href="#add-btn"></use>
                                                        </svg>
                                                        Add More
                                                    </a>
                                                </div>
                                                <div class="tab-pane fade show" id="bond" role="tabpanel">
                                                    <div class="inline-form">
                                                        <div class="form-group">
                                                            <label>Description</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Principal Amount </label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Maturity Amount </label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Interest Rate</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Start Date </label>
                                                            <input type="text" name="singleDate"
                                                                class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Maturity Date</label>
                                                            <input type="text" name="singleDate"
                                                                class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Payable Cycle</label>
                                                            <select>
                                                                <option>Monthly</option>
                                                                <option>Quaterly</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Principal Amount </label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Payment Date</label>
                                                            <input type="text" name="singleDate"
                                                                class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Payment Amount(Yearly)</label>
                                                            <input type="text" class="form-control"
                                                                disabled>
                                                        </div>
                                                        <a class="btn delete-element btn-link mt-0 mt-md-4">
                                                            <svg width="30" height="30"
                                                                viewBox="0 -1 17 25">
                                                                <use xlink:href="#delete-icon"></use>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                    <a class="btn btn-link d-block m-auto add-more-btn">
                                                        <svg width="30" height="30" viewBox="-2 -2 28 28"
                                                            class="mr-0">
                                                            <use xlink:href="#add-btn"></use>
                                                        </svg>
                                                        Add More
                                                    </a>
                                                </div>
                                                <div class="tab-pane fade show" id="insurance"
                                                    role="tabpanel" aria-labelledby="rent-tab">
                                                    <div class="inline-form">
                                                        <div class="form-group">
                                                            <label>Description</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Principal Amount </label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Maturity Amount </label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Interest Rate</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Start Date </label>
                                                            <input type="text" name="singleDate"
                                                                class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Maturity Date</label>
                                                            <input type="text" name="singleDate"
                                                                class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Payable Cycle</label>
                                                            <select>
                                                                <option>Monthly</option>
                                                                <option>Quaterly</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Principal Amount </label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Payment Date</label>
                                                            <input type="text" name="singleDate"
                                                                class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Payment Amount(Yearly)</label>
                                                            <input type="text" class="form-control"
                                                                disabled>
                                                        </div>
                                                        <a class="btn delete-element btn-link mt-0 mt-md-4">
                                                            <svg width="30" height="30"
                                                                viewBox="0 -1 17 25">
                                                                <use xlink:href="#delete-icon"></use>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                    <a class="btn btn-link d-block m-auto add-more-btn">
                                                        <svg width="30" height="30" viewBox="-2 -2 28 28"
                                                            class="mr-0">
                                                            <use xlink:href="#add-btn"></use>
                                                        </svg>
                                                        Add More
                                                    </a>
                                                </div>
                                                <div class="tab-pane fade show" id="mf" role="tabpanel"
                                                    aria-labelledby="rent-tab">
                                                    <div class="inline-form">
                                                        <div class="form-group">
                                                            <label>Market Value</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>SIP Amount</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <a class="btn delete-element btn-link mt-0 mt-md-4">
                                                            <svg width="30" height="30"
                                                                viewBox="0 -1 17 25">
                                                                <use xlink:href="#delete-icon"></use>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                    <a class="btn btn-link d-block m-auto add-more-btn">
                                                        <svg width="30" height="30" viewBox="-2 -2 28 28"
                                                            class="mr-0">
                                                            <use xlink:href="#add-btn"></use>
                                                        </svg>
                                                        Add More
                                                    </a>
                                                </div>
                                                <div class="tab-pane fade show" id="cash" role="tabpanel"
                                                    aria-labelledby="rent-tab">
                                                    <div class="inline-form">
                                                        <div class="form-group">
                                                            <label>Bank Balance</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <a class="btn delete-element btn-link mt-0 mt-md-4">
                                                            <svg width="30" height="30"
                                                                viewBox="0 -1 17 25">
                                                                <use xlink:href="#delete-icon"></use>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                    <a class="btn btn-link d-block m-auto add-more-btn">
                                                        <svg width="30" height="30" viewBox="-2 -2 28 28"
                                                            class="mr-0">
                                                            <use xlink:href="#add-btn"></use>
                                                        </svg>
                                                        Add More
                                                    </a>
                                                </div>
                                                <div class="tab-pane fade show" id="gold" role="tabpanel"
                                                    aria-labelledby="rent-tab">
                                                    <div class="inline-form">
                                                        <div class="form-group">
                                                            <label>Market Value</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <a class="btn delete-element btn-link mt-0 mt-md-4">
                                                            <svg width="30" height="30"
                                                                viewBox="0 -1 17 25">
                                                                <use xlink:href="#delete-icon"></use>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                    <a class="btn btn-link d-block m-auto add-more-btn">
                                                        <svg width="30" height="30" viewBox="-2 -2 28 28"
                                                            class="mr-0">
                                                            <use xlink:href="#add-btn"></use>
                                                        </svg>
                                                        Add More
                                                    </a>
                                                </div>
                                                <div class="tab-pane fade show" id="shares" role="tabpanel"
                                                    aria-labelledby="rent-tab">
                                                    <div class="inline-form">
                                                        <div class="form-group">
                                                            <label>Market Value</label>
                                                            <input type="text" class="form-control">

                                                        </div>
                                                        <a class="btn delete-element btn-link mt-0 mt-md-4">
                                                            <svg width="30" height="30"
                                                                viewBox="0 -1 17 25">
                                                                <use xlink:href="#delete-icon"></use>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                    <a class="btn btn-link d-block m-auto add-more-btn">
                                                        <svg width="30" height="30" viewBox="-2 -2 28 28"
                                                            class="mr-0">
                                                            <use xlink:href="#add-btn"></use>
                                                        </svg>
                                                        Add More
                                                    </a>
                                                </div>
                                                <div class="tab-pane fade show" id="other" role="tabpanel"
                                                    aria-labelledby="rent-tab">
                                                    <div class="inline-form">
                                                        <div class="form-group">
                                                            <label>Market Value</label>
                                                            <input type="text" class="form-control">

                                                        </div>
                                                        <a class="btn delete-element btn-link mt-0 mt-md-4">
                                                            <svg width="30" height="30"
                                                                viewBox="0 -1 17 25">
                                                                <use xlink:href="#delete-icon"></use>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                    <a class="btn btn-link d-block m-auto add-more-btn">
                                                        <svg width="30" height="30" viewBox="-2 -2 28 28"
                                                            class="mr-0">
                                                            <use xlink:href="#add-btn"></use>
                                                        </svg>
                                                        Add More
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade show" id="member-tab2" role="tabpanel"
                                        aria-labelledby="member2-tab">
                                        <div class="form-sections">
                                            <h4 class="form-section-title text-uppercase">Enter Details for
                                                Categories</h4>
                                            <ul class="nav nav-tabs income-tab" role="tablist">
                                                <div class="disabled-wrapper">
                                                    <li class="nav-item mb-3 disabled" role="presentation">
                                                        <a class="nav-link active" data-toggle="tab"
                                                            href="#salary-income" role="tab"
                                                            aria-selected="true">Salary
                                                            Income</a>
                                                        <span class="remove-member"><i
                                                                class="icon-close"></i></span>
                                                        <span class="add-income">+</span>
                                                    </li>
                                                    <li class="nav-item mb-3 disabled" role="presentation">
                                                        <a class="nav-link" data-toggle="tab"
                                                            href="#business-income" role="tab"
                                                            aria-selected="true">Business Income</a>
                                                        <span class="remove-member"><i
                                                                class="icon-close"></i></span>
                                                        <span class="add-income">+</span>
                                                    </li>
                                                    <li class="nav-item mb-3 disabled" role="presentation">
                                                        <a class="nav-link" data-toggle="tab" href="#rent"
                                                            role="tab" aria-selected="true">Rental
                                                            Income</a>
                                                        <span class="remove-member"><i
                                                                class="icon-close"></i></span>
                                                        <span class="add-income">+</span>
                                                    </li>
                                                    <li class="nav-item mb-3 disabled" role="presentation">
                                                        <a class="nav-link" data-toggle="tab" href="#ppf"
                                                            role="tab" aria-selected="true">PPF (Public
                                                            Provident Fund)</a>
                                                        <span class="remove-member"><i
                                                                class="icon-close"></i></span>
                                                        <span class="add-income">+</span>
                                                    </li>
                                                    <li class="nav-item mb-3 disabled" role="presentation">
                                                        <a class="nav-link" data-toggle="tab" href="#epf"
                                                            role="tab" aria-selected="true">EPF(Employee
                                                            Provident Fund)</a>
                                                        <span class="remove-member"><i
                                                                class="icon-close"></i></span>
                                                        <span class="add-income">+</span>
                                                    </li>
                                                    <li class="nav-item mb-3 disabled" role="presentation">
                                                        <a class="nav-link" data-toggle="tab"
                                                            href="#gratuity" role="tab"
                                                            aria-selected="true">Gratuity</a>
                                                        <span class="remove-member"><i
                                                                class="icon-close"></i></span>
                                                        <span class="add-income">+</span>
                                                    </li>
                                                    <li class="nav-item mb-3 disabled" role="presentation">
                                                        <a class="nav-link" data-toggle="tab" href="#fd"
                                                            role="tab" aria-selected="true">FD</a>
                                                        <span class="remove-member"><i
                                                                class="icon-close"></i></span>
                                                        <span class="add-income">+</span>
                                                    </li>
                                                    <li class="nav-item mb-3 disabled" role="presentation">
                                                        <a class="nav-link" data-toggle="tab" href="#rd"
                                                            role="tab" aria-selected="true">RD (Recurring
                                                            deposit) / PIS
                                                            (Postal
                                                            Investment Scheme)</a>
                                                        <span class="remove-member"><i
                                                                class="icon-close"></i></span>
                                                        <span class="add-income">+</span>
                                                    </li>
                                                    <li class="nav-item mb-3 disabled" role="presentation">
                                                        <a class="nav-link" data-toggle="tab"
                                                            href="#pension" role="tab"
                                                            aria-selected="true">Pension Income</a>
                                                        <span class="remove-member"><i
                                                                class="icon-close"></i></span>
                                                        <span class="add-income">+</span>
                                                    </li>
                                                    <li class="nav-item mb-3 disabled" role="presentation">
                                                        <a class="nav-link" data-toggle="tab" href="#bond"
                                                            role="tab" aria-selected="true">Bond</a>
                                                        <span class="remove-member"><i
                                                                class="icon-close"></i></span>
                                                        <span class="add-income">+</span>
                                                    </li>
                                                    <li class="nav-item mb-3 disabled" role="presentation">
                                                        <a class="nav-link" data-toggle="tab"
                                                            href="#insurance" role="tab"
                                                            aria-selected="true">Insurance</a>
                                                        <span class="remove-member"><i
                                                                class="icon-close"></i></span>
                                                        <span class="add-income">+</span>
                                                    </li>
                                                    <li class="nav-item mb-3 disabled" role="presentation">
                                                        <a class="nav-link" data-toggle="tab" href="#mf"
                                                            role="tab" aria-selected="true">Mutual Fund</a>
                                                        <span class="remove-member"><i
                                                                class="icon-close"></i></span>
                                                        <span class="add-income">+</span>
                                                    </li>
                                                    <li class="nav-item mb-3 disabled" role="presentation">
                                                        <a class="nav-link" data-toggle="tab" href="#cash"
                                                            role="tab" aria-selected="true">Cash In Hand</a>
                                                        <span class="remove-member"><i
                                                                class="icon-close"></i></span>
                                                        <span class="add-income">+</span>
                                                    </li>
                                                    <li class="nav-item mb-3 disabled" role="presentation">
                                                        <a class="nav-link" data-toggle="tab" href="#gold"
                                                            role="tab" aria-selected="true">Gold</a>
                                                        <span class="remove-member"><i
                                                                class="icon-close"></i></span>
                                                        <span class="add-income">+</span>
                                                    </li>
                                                    <li class="nav-item mb-3 disabled" role="presentation">
                                                        <a class="nav-link" data-toggle="tab" href="#shares"
                                                            role="tab" aria-selected="true">Shares / PMS
                                                            (Portfolio
                                                            Management
                                                            Services)</a>
                                                        <span class="remove-member"><i
                                                                class="icon-close"></i></span>
                                                        <span class="add-income">+</span>
                                                    </li>
                                                    <li class="nav-item mb-3 disabled" role="presentation">
                                                        <a class="nav-link" data-toggle="tab" href="#other"
                                                            role="tab" aria-selected="true">Other</a>
                                                        <span class="remove-member"><i
                                                                class="icon-close"></i></span>
                                                        <span class="add-income">+</span>
                                                    </li>
                                                </div>
                                            </ul>
                                            <div class="tab-content">
                                                <div class="tab-pane fade" id="salary-income"
                                                    role="tabpanel">
                                                    <div class="inline-form">
                                                        <div class="form-group">
                                                            <label>Net Income(Monthly)</label>
                                                            <input type="text" class="form-control amount">
                                                            <small class="text-muted inwords"></small>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Increment Month</label>
                                                            <select class="form-control">
                                                                <option>January</option>
                                                                <option>Febraury</option>
                                                                <option>March</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Average Growth Rate (%)</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Retirement Age</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Year of Retirement</label>
                                                            <input type="text" class="form-control"
                                                                disabled>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Net Income(Yearly)</label>
                                                            <input type="text" class="form-control"
                                                                disabled>
                                                        </div>
                                                        <a class="btn delete-element btn-link mt-0 mt-md-4">
                                                            <svg width="30" height="30"
                                                                viewBox="0 -1 17 25">
                                                                <use xlink:href="#delete-icon"></use>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                    <a class="btn btn-link d-block m-auto add-more-btn">
                                                        <svg width="30" height="30" viewBox="-2 -2 28 28"
                                                            class="mr-0">
                                                            <use xlink:href="#add-btn"></use>
                                                        </svg>
                                                        Add More
                                                    </a>
                                                </div>
                                                <div class="tab-pane fade" id="business-income"
                                                    role="tabpanel">
                                                    <div class="inline-form">
                                                        <div class="form-group">
                                                            <label>Net Income(Yearly)</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Average Growth Rate (%)</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Retirement Age</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Year of Retirement</label>
                                                            <input type="text" class="form-control"
                                                                disabled>
                                                        </div>
                                                        <a class="btn delete-element btn-link mt-0 mt-md-4">
                                                            <svg width="30" height="30"
                                                                viewBox="0 -1 17 25">
                                                                <use xlink:href="#delete-icon"></use>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                    <a class="btn btn-link d-block m-auto add-more-btn">
                                                        <svg width="30" height="30" viewBox="-2 -2 28 28"
                                                            class="mr-0">
                                                            <use xlink:href="#add-btn"></use>
                                                        </svg>
                                                        Add More
                                                    </a>
                                                </div>
                                                <div class="tab-pane fade show" id="rent" role="tabpanel"
                                                    aria-labelledby="rent-tab">
                                                    <div class="inline-form">

                                                        <div class="form-group">
                                                            <label>Property Details</label>
                                                            <input type="text" class="form-control">
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Property Type</label>
                                                            <select class="form-control">
                                                                <option>Property Type</option>
                                                                <option>Property Type</option>
                                                                <option>Property Type</option>
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Property Purchase Value</label>
                                                            <input type="text" class="form-control">
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Property Market Value</label>
                                                            <input type="text" class="form-control">
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Description</label>
                                                            <input type="text" class="form-control">
                                                        </div>

                                                        <div class="form-group custom-radio-btn mb-0">
                                                            <label
                                                                class="text-light text-uppercase mb-2 d-block">Is
                                                                on Rent</label>
                                                            <div class="form-check form-check-inline m-0">
                                                                <input class="form-check-input" type="radio"
                                                                    name="allocation" id="yes" value="yes"
                                                                    checked>
                                                                <label class="form-check-label" for="yes">
                                                                    <span class="label">Yes </span>
                                                                </label>
                                                            </div>
                                                            <div
                                                                class="form-check form-check-inline m-0 ml-3">
                                                                <input class="form-check-input" type="radio"
                                                                    name="allocation" id="no" value="no">
                                                                <label class="form-check-label" for="no">
                                                                    <span class="label">No </span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <a class="btn delete-element btn-link mt-0 mt-md-4">
                                                            <svg width="30" height="30"
                                                                viewBox="0 -1 17 25">
                                                                <use xlink:href="#delete-icon"></use>
                                                            </svg>
                                                        </a>
                                                        <div>
                                                            <div class="d-flex flex-wrap">

                                                                <div class="form-group">
                                                                    <label>Rental Details</label>
                                                                    <input type="text" class="form-control">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>Income - Per Month</label>
                                                                    <input type="text" class="form-control">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>Start Date</label>
                                                                    <input type="text" name="singleDate"
                                                                        class="form-control">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>End Date</label>
                                                                    <input type="text" name="singleDate"
                                                                        class="form-control">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>Tenure (In Month)</label>
                                                                    <input type="text" class="form-control"
                                                                        disabled>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>Pay Date</label>
                                                                    <select class="form-control">
                                                                        <option>1</option>
                                                                        <option>2</option>
                                                                        <option>3</option>
                                                                    </select>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label> Annual Income</label>
                                                                    <input type="text" class="form-control"
                                                                        disabled>
                                                                </div>

                                                                <div
                                                                    class="form-group custom-radio-btn mb-0">
                                                                    <label
                                                                        class="text-light text-uppercase mb-2 d-block">
                                                                        Auto Renew</label>
                                                                    <div
                                                                        class="form-check form-check-inline m-0">
                                                                        <input class="form-check-input"
                                                                            type="radio" name="allocation"
                                                                            id="renewyes" value="renewyes"
                                                                            checked>
                                                                        <label class="form-check-label"
                                                                            for="renewyes">
                                                                            <span class="label">Yes
                                                                            </span>
                                                                        </label>
                                                                    </div>
                                                                    <div
                                                                        class="form-check form-check-inline m-0 ml-3">
                                                                        <input class="form-check-input"
                                                                            type="radio" name="allocation"
                                                                            id="renewno" value="renewno">
                                                                        <label class="form-check-label"
                                                                            for="renewno">
                                                                            <span class="label">No
                                                                            </span>
                                                                        </label>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>Rental Increment %</label>
                                                                    <input type="text" class="form-control">
                                                                </div>

                                                            </div>
                                                        </div>

                                                    </div>
                                                    <a class="btn btn-link d-block m-auto add-more-btn">
                                                        <svg width="30" height="30" viewBox="-2 -2 28 28"
                                                            class="mr-0">
                                                            <use xlink:href="#add-btn"></use>
                                                        </svg>
                                                        Add More
                                                    </a>
                                                </div>
                                                <div class="tab-pane fade show" id="ppf" role="tabpanel"
                                                    aria-labelledby="rent-tab">
                                                    <div class="inline-form">
                                                        <div class="form-group">
                                                            <label>Amount</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Maturity Date</label>
                                                            <input type="text" name="singleDate"
                                                                class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Year to Mature</label>
                                                            <input type="text" class="form-control"
                                                                disabled>
                                                        </div>
                                                        <a class="btn delete-element btn-link mt-0 mt-md-4">
                                                            <svg width="30" height="30"
                                                                viewBox="0 -1 17 25">
                                                                <use xlink:href="#delete-icon"></use>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                    <a class="btn btn-link d-block m-auto add-more-btn">
                                                        <svg width="30" height="30" viewBox="-2 -2 28 28"
                                                            class="mr-0">
                                                            <use xlink:href="#add-btn"></use>
                                                        </svg>
                                                        Add More
                                                    </a>
                                                </div>
                                                <div class="tab-pane fade show" id="epf" role="tabpanel"
                                                    aria-labelledby="rent-tab">
                                                    <div class="inline-form">
                                                        <div class="form-group">
                                                            <label>Amount</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Maturity Date</label>
                                                            <input type="text" class="form-control"
                                                                disabled>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Year to Mature</label>
                                                            <input type="text" class="form-control"
                                                                disabled>
                                                        </div>
                                                        <a class="btn delete-element btn-link mt-0 mt-md-4">
                                                            <svg width="30" height="30"
                                                                viewBox="0 -1 17 25">
                                                                <use xlink:href="#delete-icon"></use>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                    <a class="btn btn-link d-block m-auto add-more-btn">
                                                        <svg width="30" height="30" viewBox="-2 -2 28 28"
                                                            class="mr-0">
                                                            <use xlink:href="#add-btn"></use>
                                                        </svg>
                                                        Add More
                                                    </a>
                                                </div>
                                                <div class="tab-pane fade show" id="gratuity"
                                                    role="tabpanel">
                                                    <div class="inline-form">
                                                        <div class="form-group">
                                                            <label>Amount</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Maturity Date</label>
                                                            <input type="text" class="form-control"
                                                                disabled>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Year to Mature</label>
                                                            <input type="text" class="form-control"
                                                                disabled>
                                                        </div>
                                                        <a class="btn delete-element btn-link mt-0 mt-md-4">
                                                            <svg width="30" height="30"
                                                                viewBox="0 -1 17 25">
                                                                <use xlink:href="#delete-icon"></use>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                    <a class="btn btn-link d-block m-auto add-more-btn">
                                                        <svg width="30" height="30" viewBox="-2 -2 28 28"
                                                            class="mr-0">
                                                            <use xlink:href="#add-btn"></use>
                                                        </svg>
                                                        Add More
                                                    </a>
                                                </div>
                                                <div class="tab-pane fade show" id="fd" role="tabpanel">
                                                    <div class="inline-form">
                                                        <div class="form-group">
                                                            <label>Description</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Principal Amount </label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Maturity Amount </label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Interest Rate</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Start Date </label>
                                                            <input type="text" name="singleDate"
                                                                class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Maturity Date</label>
                                                            <input type="text" name="singleDate"
                                                                class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Payable Cycle</label>
                                                            <select>
                                                                <option>Monthly</option>
                                                                <option>Quaterly</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Principal Amount </label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Payment Date</label>
                                                            <input type="text" name="singleDate"
                                                                class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Payment Amount(Yearly)</label>
                                                            <input type="text" class="form-control"
                                                                disabled>
                                                        </div>
                                                        <a class="btn delete-element btn-link mt-0 mt-md-4">
                                                            <svg width="30" height="30"
                                                                viewBox="0 -1 17 25">
                                                                <use xlink:href="#delete-icon"></use>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                    <a class="btn btn-link d-block m-auto add-more-btn">
                                                        <svg width="30" height="30" viewBox="-2 -2 28 28"
                                                            class="mr-0">
                                                            <use xlink:href="#add-btn"></use>
                                                        </svg>
                                                        Add More
                                                    </a>
                                                </div>
                                                <div class="tab-pane fade show" id="rd" role="tabpanel">
                                                    <div class="inline-form">
                                                        <div class="form-group">
                                                            <label>Description</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Principal Amount (Monthly)</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Payable Cycle</label>
                                                            <select>
                                                                <option>Monthly</option>
                                                                <option>Quaterly</option>
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Start Date </label>
                                                            <input type="text" name="singleDate"
                                                                class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>End Date</label>
                                                            <input type="text" name="singleDate"
                                                                class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>No of Installments</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Principal Amount </label>
                                                            <input type="text" class="form-control"
                                                                disabled>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Maturity Amount </label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Interest Rate</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Maturity Date</label>
                                                            <input type="text" name="singleDate"
                                                                class="form-control">
                                                        </div>
                                                        <a class="btn delete-element btn-link mt-0 mt-md-4">
                                                            <svg width="30" height="30"
                                                                viewBox="0 -1 17 25">
                                                                <use xlink:href="#delete-icon"></use>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                    <a class="btn btn-link d-block m-auto add-more-btn">
                                                        <svg width="30" height="30" viewBox="-2 -2 28 28"
                                                            class="mr-0">
                                                            <use xlink:href="#add-btn"></use>
                                                        </svg>
                                                        Add More
                                                    </a>
                                                </div>
                                                <div class="tab-pane fade show" id="pension"
                                                    role="tabpanel">
                                                    <div class="inline-form">
                                                        <div class="form-group">
                                                            <label>Description</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Amount </label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Payable</label>
                                                            <select>
                                                                <option>Monthly</option>
                                                                <option>Quaterly</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Amount(Yearly)</label>
                                                            <input type="text" class="form-control"
                                                                disabled>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Start Date </label>
                                                            <input type="text" name="singleDate"
                                                                class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="mb-2">Uptil life</label>
                                                            <div class="form-group custom-checkbox">
                                                                <input type="checkbox" id="uptilLife">
                                                                <label for="uptilLife">Uptil life</label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="mb-2">Payable To Relation</label>
                                                            <div class="d-flex ">
                                                                <div
                                                                    class="form-group custom-checkbox mb-0">
                                                                    <input type="checkbox" id="self">
                                                                    <label for="self">Self</label>
                                                                </div>
                                                                <div
                                                                    class="form-group custom-checkbox mb-0">
                                                                    <input type="checkbox" id="spouse">
                                                                    <label for="spouse">Spouse</label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label>End Date</label>
                                                            <input type="text" name="singleDate"
                                                                class="form-control">
                                                        </div>
                                                        <a class="btn delete-element btn-link mt-0 mt-md-4">
                                                            <svg width="30" height="30"
                                                                viewBox="0 -1 17 25">
                                                                <use xlink:href="#delete-icon"></use>
                                                            </svg>
                                                        </a>
                                                    </div>

                                                    <a class="btn btn-link d-block m-auto add-more-btn">
                                                        <svg width="30" height="30" viewBox="-2 -2 28 28"
                                                            class="mr-0">
                                                            <use xlink:href="#add-btn"></use>
                                                        </svg>
                                                        Add More
                                                    </a>
                                                </div>
                                                <div class="tab-pane fade show" id="bond" role="tabpanel">
                                                    <div class="inline-form">
                                                        <div class="form-group">
                                                            <label>Description</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Principal Amount </label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Maturity Amount </label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Interest Rate</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Start Date </label>
                                                            <input type="text" name="singleDate"
                                                                class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Maturity Date</label>
                                                            <input type="text" name="singleDate"
                                                                class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Payable Cycle</label>
                                                            <select>
                                                                <option>Monthly</option>
                                                                <option>Quaterly</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Principal Amount </label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Payment Date</label>
                                                            <input type="text" name="singleDate"
                                                                class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Payment Amount(Yearly)</label>
                                                            <input type="text" class="form-control"
                                                                disabled>
                                                        </div>
                                                        <a class="btn delete-element btn-link mt-0 mt-md-4">
                                                            <svg width="30" height="30"
                                                                viewBox="0 -1 17 25">
                                                                <use xlink:href="#delete-icon"></use>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                    <a class="btn btn-link d-block m-auto add-more-btn">
                                                        <svg width="30" height="30" viewBox="-2 -2 28 28"
                                                            class="mr-0">
                                                            <use xlink:href="#add-btn"></use>
                                                        </svg>
                                                        Add More
                                                    </a>
                                                </div>
                                                <div class="tab-pane fade show" id="insurance"
                                                    role="tabpanel" aria-labelledby="rent-tab">
                                                    <div class="inline-form">
                                                        <div class="form-group">
                                                            <label>Description</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Principal Amount </label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Maturity Amount </label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Interest Rate</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Start Date </label>
                                                            <input type="text" name="singleDate"
                                                                class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Maturity Date</label>
                                                            <input type="text" name="singleDate"
                                                                class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Payable Cycle</label>
                                                            <select>
                                                                <option>Monthly</option>
                                                                <option>Quaterly</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Principal Amount </label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Payment Date</label>
                                                            <input type="text" name="singleDate"
                                                                class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Payment Amount(Yearly)</label>
                                                            <input type="text" class="form-control"
                                                                disabled>
                                                        </div>
                                                        <a class="btn delete-element btn-link mt-0 mt-md-4">
                                                            <svg width="30" height="30"
                                                                viewBox="0 -1 17 25">
                                                                <use xlink:href="#delete-icon"></use>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                    <a class="btn btn-link d-block m-auto add-more-btn">
                                                        <svg width="30" height="30" viewBox="-2 -2 28 28"
                                                            class="mr-0">
                                                            <use xlink:href="#add-btn"></use>
                                                        </svg>
                                                        Add More
                                                    </a>
                                                </div>
                                                <div class="tab-pane fade show" id="mf" role="tabpanel"
                                                    aria-labelledby="rent-tab">
                                                    <div class="inline-form">
                                                        <div class="form-group">
                                                            <label>Market Value</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>SIP Amount</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <a class="btn delete-element btn-link mt-0 mt-md-4">
                                                            <svg width="30" height="30"
                                                                viewBox="0 -1 17 25">
                                                                <use xlink:href="#delete-icon"></use>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                    <a class="btn btn-link d-block m-auto add-more-btn">
                                                        <svg width="30" height="30" viewBox="-2 -2 28 28"
                                                            class="mr-0">
                                                            <use xlink:href="#add-btn"></use>
                                                        </svg>
                                                        Add More
                                                    </a>
                                                </div>
                                                <div class="tab-pane fade show" id="cash" role="tabpanel"
                                                    aria-labelledby="rent-tab">
                                                    <div class="inline-form">
                                                        <div class="form-group">
                                                            <label>Bank Balance</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <a class="btn delete-element btn-link mt-0 mt-md-4">
                                                            <svg width="30" height="30"
                                                                viewBox="0 -1 17 25">
                                                                <use xlink:href="#delete-icon"></use>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                    <a class="btn btn-link d-block m-auto add-more-btn">
                                                        <svg width="30" height="30" viewBox="-2 -2 28 28"
                                                            class="mr-0">
                                                            <use xlink:href="#add-btn"></use>
                                                        </svg>
                                                        Add More
                                                    </a>
                                                </div>
                                                <div class="tab-pane fade show" id="gold" role="tabpanel"
                                                    aria-labelledby="rent-tab">
                                                    <div class="inline-form">
                                                        <div class="form-group">
                                                            <label>Market Value</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <a class="btn delete-element btn-link mt-0 mt-md-4">
                                                            <svg width="30" height="30"
                                                                viewBox="0 -1 17 25">
                                                                <use xlink:href="#delete-icon"></use>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                    <a class="btn btn-link d-block m-auto add-more-btn">
                                                        <svg width="30" height="30" viewBox="-2 -2 28 28"
                                                            class="mr-0">
                                                            <use xlink:href="#add-btn"></use>
                                                        </svg>
                                                        Add More
                                                    </a>
                                                </div>
                                                <div class="tab-pane fade show" id="shares" role="tabpanel"
                                                    aria-labelledby="rent-tab">
                                                    <div class="form-group">
                                                        <label>Market Value</label>
                                                        <input type="text" class="form-control">
                                                    </div>
                                                    <a class="btn btn-link d-block m-auto add-more-btn">
                                                        <svg width="30" height="30" viewBox="-2 -2 28 28"
                                                            class="mr-0">
                                                            <use xlink:href="#add-btn"></use>
                                                        </svg>
                                                        Add More
                                                    </a>
                                                </div>
                                                <div class="tab-pane fade show" id="other" role="tabpanel"
                                                    aria-labelledby="rent-tab">
                                                    <div class="form-group">
                                                        <label>Market Value</label>
                                                        <input type="text" class="form-control">
                                                    </div>
                                                    <a class="btn btn-link d-block m-auto add-more-btn">
                                                        <svg width="30" height="30" viewBox="-2 -2 28 28"
                                                            class="mr-0">
                                                            <use xlink:href="#add-btn"></use>
                                                        </svg>
                                                        Add More
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-footer">
                                <button type="button" class="btn btn-primary btn-lg proceed">Proceed</button>
                            </div>
                        </div>
                    </section>
                    <section class="trial" id="goal-details" data-step="3" autocomplete="off">
                        <div class="form-inner-section">
                            <div class="form-header">
                                <h3 class="card-title"><i class="icon-left-arrow back-btn"></i> Goals</h3>
                            </div>
                            <div class="form-content">
                                <ul class="nav nav-tabs mb-5" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" data-toggle="tab" href="#goal-member1"
                                            role="tab" aria-controls="member1" aria-selected="true">Ashish
                                            Jaiswal</a>
                                    </li>

                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" data-toggle="tab" href="#family-goal" role="tab"
                                            aria-selected="true">Family Goal</a>
                                    </li>
                                </ul>
                                <div class="tab-content family-tab">
                                    <div class="tab-pane fade show active" id="goal-member1" role="tabpanel"
                                        aria-labelledby="goal-member1-tab">
                                        <div class="form-sections">
                                            <h4 class="form-section-title text-uppercase">Enter Details for
                                                Categories</h4>
                                            <ul class="nav nav-tabs income-tab" role="tablist">
                                                <div class="disabled-wrapper">
                                                    <li class="nav-item mb-3" role="presentation">
                                                        <a class="nav-link" data-toggle="tab"
                                                            href="#income1" role="tab"
                                                            aria-selected="true">Charity</a>
                                                        <span class="remove-member"><i
                                                                class="icon-close"></i></span>
                                                        <span class="add-income">+</span>
                                                    </li>
                                                    <li class="nav-item mb-3" role="presentation">
                                                        <a class="nav-link" data-toggle="tab"
                                                            href="#income2" role="tab"
                                                            aria-selected="true">Child Birth
                                                            Expense</a>
                                                        <span class="remove-member"><i
                                                                class="icon-close"></i></span>
                                                        <span class="add-income">+</span>
                                                    </li>
                                                    <li class="nav-item mb-3" role="presentation">
                                                        <a class="nav-link" data-toggle="tab"
                                                            href="#income3" role="tab"
                                                            aria-selected="true">Education</a>
                                                        <span class="remove-member"><i
                                                                class="icon-close"></i></span>
                                                        <span class="add-income">+</span>
                                                    </li>
                                                    <li class="nav-item mb-3" role="presentation">
                                                        <a class="nav-link" data-toggle="tab"
                                                            href="#income4" role="tab"
                                                            aria-selected="true">Family Gifting</a>
                                                        <span class="remove-member"><i
                                                                class="icon-close"></i></span>
                                                        <span class="add-income">+</span>
                                                    </li>
                                                    <li class="nav-item mb-3" role="presentation">
                                                        <a class="nav-link" data-toggle="tab"
                                                            href="#income5" role="tab"
                                                            aria-selected="true">Gadgets</a>
                                                        <span class="remove-member"><i
                                                                class="icon-close"></i></span>
                                                        <span class="add-income">+</span>
                                                    </li>
                                                    <li class="nav-item mb-3" role="presentation">
                                                        <a class="nav-link" data-toggle="tab"
                                                            href="#income6" role="tab"
                                                            aria-selected="true">Home Renovation</a>
                                                        <span class="remove-member"><i
                                                                class="icon-close"></i></span>
                                                        <span class="add-income">+</span>
                                                    </li>
                                                    <li class="nav-item mb-3" role="presentation">
                                                        <a class="nav-link" data-toggle="tab"
                                                            href="#income7" role="tab"
                                                            aria-selected="true">Jewellery</a>
                                                        <span class="remove-member"><i
                                                                class="icon-close"></i></span>
                                                        <span class="add-income">+</span>
                                                    </li>
                                                    <li class="nav-item mb-3" role="presentation">
                                                        <a class="nav-link" data-toggle="tab"
                                                            href="#income8" role="tab"
                                                            aria-selected="true">Family Gifting</a>
                                                        <span class="remove-member"><i
                                                                class="icon-close"></i></span>
                                                        <span class="add-income">+</span>
                                                    </li>
                                                    <li class="nav-item mb-3" role="presentation">
                                                        <a class="nav-link" data-toggle="tab"
                                                            href="#income9" role="tab"
                                                            aria-selected="true">Marriage</a>
                                                        <span class="remove-member"><i
                                                                class="icon-close"></i></span>
                                                        <span class="add-income">+</span>
                                                    </li>
                                                    <li class="nav-item mb-3" role="presentation">
                                                        <a class="nav-link" data-toggle="tab"
                                                            href="#income10" role="tab"
                                                            aria-selected="true">New Car</a>
                                                        <span class="remove-member"><i
                                                                class="icon-close"></i></span>
                                                        <span class="add-income">+</span>
                                                    </li>
                                                    <li class="nav-item mb-3" role="presentation">
                                                        <a class="nav-link" data-toggle="tab"
                                                            href="#income11" role="tab"
                                                            aria-selected="true">New Home</a>
                                                        <span class="remove-member"><i
                                                                class="icon-close"></i></span>
                                                        <span class="add-income">+</span>
                                                    </li>
                                                    <li class="nav-item mb-3" role="presentation">
                                                        <a class="nav-link" data-toggle="tab"
                                                            href="#income12" role="tab"
                                                            aria-selected="true">Post Graduation</a>
                                                        <span class="remove-member"><i
                                                                class="icon-close"></i></span>
                                                        <span class="add-income">+</span>
                                                    </li>
                                                    <li class="nav-item mb-3" role="presentation">
                                                        <a class="nav-link" data-toggle="tab"
                                                            href="#income13" role="tab"
                                                            aria-selected="true">Startup</a>
                                                        <span class="remove-member"><i
                                                                class="icon-close"></i></span>
                                                        <span class="add-income">+</span>
                                                    </li>
                                                    <li class="nav-item mb-3" role="presentation">
                                                        <a class="nav-link" data-toggle="tab"
                                                            href="#income14" role="tab"
                                                            aria-selected="true">Vacation</a>
                                                        <span class="remove-member"><i
                                                                class="icon-close"></i></span>
                                                        <span class="add-income">+</span>
                                                    </li>
                                                </div>
                                                <a href="javascript:void(0)" class="leftTabArrow"><i
                                                        class="icon-left-arrow"></i></a>
                                                <a href="javascript:void(0)" class="rightTabArrow"><i
                                                        class="icon-right-arrow"></i></a>
                                            </ul>
                                            <div class="tab-content">
                                                <div class="tab-pane fade" id="income1"
                                                    role="tabpanel">
                                                    <div class="inline-form">
                                                        <div class="form-group">
                                                            <label>Amount Today</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Inflation %</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="client">Client</label>
                                                            <div class="dropdown customMulti">
                                                                <a class="dropdown-toggle select-dropdown"
                                                                    type="button" data-toggle="dropdown"
                                                                    aria-haspopup="true"
                                                                    aria-expanded="false">
                                                                    <span class="text-grey">Select
                                                                        Year</span>
                                                                </a>
                                                                <div
                                                                    class="dropdown-menu dropdown-menu-left select-dropdown-list">

                                                                    <div class="data-list">
                                                                        <a class="dropdown-item">
                                                                            <div
                                                                                class="form-group custom-checkbox m-0">
                                                                                <input type="checkbox"
                                                                                    id="2020">
                                                                                <label
                                                                                    for="2020">2020</label>
                                                                            </div>
                                                                        </a>
                                                                        <a class="dropdown-item">
                                                                            <div
                                                                                class="form-group custom-checkbox m-0">
                                                                                <input type="checkbox"
                                                                                    id="2021">
                                                                                <label
                                                                                    for="2021">2021</label>
                                                                            </div>
                                                                        </a>
                                                                        <a class="dropdown-item">
                                                                            <div
                                                                                class="form-group custom-checkbox m-0">
                                                                                <input type="checkbox"
                                                                                    id="2022">
                                                                                <label
                                                                                    for="2022">2022</label>
                                                                            </div>
                                                                        </a>
                                                                        <a class="dropdown-item">
                                                                            <div
                                                                                class="form-group custom-checkbox m-0">
                                                                                <input type="checkbox"
                                                                                    id="2023">
                                                                                <label
                                                                                    for="2023">2023</label>
                                                                            </div>
                                                                        </a>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="income2" role="tabpanel">
                                                    <div class="inline-form">
                                                        <div class="form-group">
                                                            <label>Amount Today</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Inflation %</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Goal Year</label>
                                                            <div class="select-wrapper">
                                                                <select class="form-control"
                                                                    multiple="multiple">
                                                                    <option>2020</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="income3" role="tabpanel">
                                                    <div class="inline-form">
                                                        <div class="form-group">
                                                            <label>Amount Today</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Inflation %</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Goal Year</label>
                                                            <div class="select-wrapper">
                                                                <select class="form-control"
                                                                    multiple="multiple">
                                                                    <option>2020</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="income4" role="tabpanel">
                                                    <div class="inline-form">
                                                        <div class="form-group">
                                                            <label>Amount Today</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Inflation %</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Goal Year</label>
                                                            <div class="select-wrapper">
                                                                <select class="form-control"
                                                                    multiple="multiple">
                                                                    <option>2020</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="income5" role="tabpanel">
                                                    <div class="inline-form">
                                                        <div class="form-group">
                                                            <label>Amount Today</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Inflation %</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Goal Year</label>
                                                            <div class="select-wrapper">
                                                                <select class="form-control"
                                                                    multiple="multiple">
                                                                    <option>2020</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="income6" role="tabpanel">
                                                    <div class="inline-form">
                                                        <div class="form-group">
                                                            <label>Amount Today</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Inflation %</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Goal Year</label>
                                                            <div class="select-wrapper">
                                                                <select class="form-control"
                                                                    multiple="multiple">
                                                                    <option>2020</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="income7" role="tabpanel">
                                                    <div class="inline-form">
                                                        <div class="form-group">
                                                            <label>Amount Today</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Inflation %</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Goal Year</label>
                                                            <div class="select-wrapper">
                                                                <select class="form-control"
                                                                    multiple="multiple">
                                                                    <option>2020</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="income8" role="tabpanel">
                                                    <div class="inline-form">
                                                        <div class="form-group">
                                                            <label>Amount Today</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Inflation %</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Goal Year</label>
                                                            <div class="select-wrapper">
                                                                <select class="form-control"
                                                                    multiple="multiple">
                                                                    <option>2020</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="income9" role="tabpanel">
                                                    <div class="inline-form">
                                                        <div class="form-group">
                                                            <label>Amount Today</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Inflation %</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Goal Year</label>
                                                            <div class="select-wrapper">
                                                                <select class="form-control"
                                                                    multiple="multiple">
                                                                    <option>2020</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="income10" role="tabpanel">
                                                    <div class="inline-form">
                                                        <div class="form-group">
                                                            <label>Amount Today</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Inflation %</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Goal Year</label>
                                                            <div class="select-wrapper">
                                                                <select class="form-control"
                                                                    multiple="multiple">
                                                                    <option>2020</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="income11" role="tabpanel">
                                                    <div class="inline-form">
                                                        <div class="form-group">
                                                            <label>Amount Today</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Inflation %</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Goal Year</label>
                                                            <div class="select-wrapper">
                                                                <select class="form-control"
                                                                    multiple="multiple">
                                                                    <option>2020</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="income12" role="tabpanel">
                                                    <div class="inline-form">
                                                        <div class="form-group">
                                                            <label>Amount Today</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Inflation %</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Goal Year</label>
                                                            <div class="select-wrapper">
                                                                <select class="form-control"
                                                                    multiple="multiple">
                                                                    <option>2020</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="income13" role="tabpanel">
                                                    <div class="inline-form">
                                                        <div class="form-group">
                                                            <label>Amount Today</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Inflation %</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Goal Year</label>
                                                            <div class="select-wrapper">
                                                                <select class="form-control"
                                                                    multiple="multiple">
                                                                    <option>2020</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="income14" role="tabpanel">
                                                    <div class="inline-form">
                                                        <div class="form-group">
                                                            <label>Amount Today</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Inflation %</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Goal Year</label>
                                                            <div class="select-wrapper">
                                                                <select class="form-control"
                                                                    multiple="multiple">
                                                                    <option>2020</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade show" id="family-goal" role="tabpanel"
                                        aria-labelledby="family-goal-tab">
                                        <div class="form-sections">
                                            <h4 class="form-section-title text-uppercase">Enter Details for
                                                Categories</h4>
                                            <ul class="nav nav-tabs income-tab" role="tablist">

                                                <div class="disabled-wrapper">
                                                    <li class="nav-item mb-3" role="presentation">
                                                        <a class="nav-link" data-toggle="tab"
                                                            href="#income1" role="tab"
                                                            aria-selected="true">Charity</a>
                                                        <span class="remove-member"><i
                                                                class="icon-close"></i></span>
                                                        <span class="add-income">+</span>
                                                    </li>
                                                    <li class="nav-item mb-3" role="presentation">
                                                        <a class="nav-link" data-toggle="tab"
                                                            href="#income2" role="tab"
                                                            aria-selected="true">Child Birth
                                                            Expense</a>
                                                        <span class="remove-member"><i
                                                                class="icon-close"></i></span>
                                                        <span class="add-income">+</span>
                                                    </li>
                                                    <li class="nav-item mb-3" role="presentation">
                                                        <a class="nav-link" data-toggle="tab"
                                                            href="#income3" role="tab"
                                                            aria-selected="true">Education</a>
                                                        <span class="remove-member"><i
                                                                class="icon-close"></i></span>
                                                        <span class="add-income">+</span>
                                                    </li>
                                                    <li class="nav-item mb-3" role="presentation">
                                                        <a class="nav-link" data-toggle="tab"
                                                            href="#income4" role="tab"
                                                            aria-selected="true">Family Gifting</a>
                                                        <span class="remove-member"><i
                                                                class="icon-close"></i></span>
                                                        <span class="add-income">+</span>
                                                    </li>
                                                    <li class="nav-item mb-3" role="presentation">
                                                        <a class="nav-link" data-toggle="tab"
                                                            href="#income5" role="tab"
                                                            aria-selected="true">Gadgets</a>
                                                        <span class="remove-member"><i
                                                                class="icon-close"></i></span>
                                                        <span class="add-income">+</span>
                                                    </li>
                                                    <li class="nav-item mb-3" role="presentation">
                                                        <a class="nav-link" data-toggle="tab"
                                                            href="#income6" role="tab"
                                                            aria-selected="true">Home Renovation</a>
                                                        <span class="remove-member"><i
                                                                class="icon-close"></i></span>
                                                        <span class="add-income">+</span>
                                                    </li>
                                                    <li class="nav-item mb-3" role="presentation">
                                                        <a class="nav-link" data-toggle="tab"
                                                            href="#income7" role="tab"
                                                            aria-selected="true">Jewellery</a>
                                                        <span class="remove-member"><i
                                                                class="icon-close"></i></span>
                                                        <span class="add-income">+</span>
                                                    </li>
                                                    <li class="nav-item mb-3" role="presentation">
                                                        <a class="nav-link" data-toggle="tab"
                                                            href="#income8" role="tab"
                                                            aria-selected="true">Family Gifting</a>
                                                        <span class="remove-member"><i
                                                                class="icon-close"></i></span>
                                                        <span class="add-income">+</span>
                                                    </li>
                                                    <li class="nav-item mb-3" role="presentation">
                                                        <a class="nav-link" data-toggle="tab"
                                                            href="#income9" role="tab"
                                                            aria-selected="true">Marriage</a>
                                                        <span class="remove-member"><i
                                                                class="icon-close"></i></span>
                                                        <span class="add-income">+</span>
                                                    </li>
                                                    <li class="nav-item mb-3" role="presentation">
                                                        <a class="nav-link" data-toggle="tab"
                                                            href="#income10" role="tab"
                                                            aria-selected="true">New Car</a>
                                                        <span class="remove-member"><i
                                                                class="icon-close"></i></span>
                                                        <span class="add-income">+</span>
                                                    </li>
                                                    <li class="nav-item mb-3" role="presentation">
                                                        <a class="nav-link" data-toggle="tab"
                                                            href="#income11" role="tab"
                                                            aria-selected="true">New Home</a>
                                                        <span class="remove-member"><i
                                                                class="icon-close"></i></span>
                                                        <span class="add-income">+</span>
                                                    </li>
                                                    <li class="nav-item mb-3" role="presentation">
                                                        <a class="nav-link" data-toggle="tab"
                                                            href="#income12" role="tab"
                                                            aria-selected="true">Post Graduation</a>
                                                        <span class="remove-member"><i
                                                                class="icon-close"></i></span>
                                                        <span class="add-income">+</span>
                                                    </li>
                                                    <li class="nav-item mb-3" role="presentation">
                                                        <a class="nav-link" data-toggle="tab"
                                                            href="#income13" role="tab"
                                                            aria-selected="true">Startup</a>
                                                        <span class="remove-member"><i
                                                                class="icon-close"></i></span>
                                                        <span class="add-income">+</span>
                                                    </li>
                                                    <li class="nav-item mb-3" role="presentation">
                                                        <a class="nav-link" data-toggle="tab"
                                                            href="#income14" role="tab"
                                                            aria-selected="true">Vacation</a>
                                                        <span class="remove-member"><i
                                                                class="icon-close"></i></span>
                                                        <span class="add-income">+</span>
                                                    </li>
                                                </div>
                                                <a href="javascript:void(0)" class="leftTabArrow"><i
                                                        class="icon-left-arrow"></i></a>
                                                <a href="javascript:void(0)" class="rightTabArrow"><i
                                                        class="icon-right-arrow"></i></a>
                                            </ul>
                                            <div class="tab-content">
                                                <div class="tab-pane fade" id="income1"
                                                    role="tabpanel">
                                                    <div class="inline-form">
                                                        <div class="form-group">
                                                            <label>Amount Today</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Inflation %</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Goal Year</label>
                                                            <div class="select-wrapper">
                                                                <select class="form-control"
                                                                    multiple="multiple">
                                                                    <option>2020</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="income2" role="tabpanel">
                                                    <div class="inline-form">
                                                        <div class="form-group">
                                                            <label>Amount Today</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Inflation %</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Goal Year</label>
                                                            <div class="select-wrapper">
                                                                <select class="form-control"
                                                                    multiple="multiple">
                                                                    <option>2020</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="income3" role="tabpanel">
                                                    <div class="inline-form">
                                                        <div class="form-group">
                                                            <label>Amount Today</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Inflation %</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Goal Year</label>
                                                            <div class="select-wrapper">
                                                                <select class="form-control"
                                                                    multiple="multiple">
                                                                    <option>2020</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="income4" role="tabpanel">
                                                    <div class="inline-form">
                                                        <div class="form-group">
                                                            <label>Amount Today</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Inflation %</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Goal Year</label>
                                                            <div class="select-wrapper">
                                                                <select class="form-control"
                                                                    multiple="multiple">
                                                                    <option>2020</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="income5" role="tabpanel">
                                                    <div class="inline-form">
                                                        <div class="form-group">
                                                            <label>Amount Today</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Inflation %</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Goal Year</label>
                                                            <div class="select-wrapper">
                                                                <select class="form-control"
                                                                    multiple="multiple">
                                                                    <option>2020</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="income6" role="tabpanel">
                                                    <div class="inline-form">
                                                        <div class="form-group">
                                                            <label>Amount Today</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Inflation %</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Goal Year</label>
                                                            <div class="select-wrapper">
                                                                <select class="form-control"
                                                                    multiple="multiple">
                                                                    <option>2020</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="income7" role="tabpanel">
                                                    <div class="inline-form">
                                                        <div class="form-group">
                                                            <label>Amount Today</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Inflation %</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Goal Year</label>
                                                            <div class="select-wrapper">
                                                                <select class="form-control"
                                                                    multiple="multiple">
                                                                    <option>2020</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="income8" role="tabpanel">
                                                    <div class="inline-form">
                                                        <div class="form-group">
                                                            <label>Amount Today</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Inflation %</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Goal Year</label>
                                                            <div class="select-wrapper">
                                                                <select class="form-control"
                                                                    multiple="multiple">
                                                                    <option>2020</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="income9" role="tabpanel">
                                                    <div class="inline-form">
                                                        <div class="form-group">
                                                            <label>Amount Today</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Inflation %</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Goal Year</label>
                                                            <div class="select-wrapper">
                                                                <select class="form-control"
                                                                    multiple="multiple">
                                                                    <option>2020</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="income10" role="tabpanel">
                                                    <div class="inline-form">
                                                        <div class="form-group">
                                                            <label>Amount Today</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Inflation %</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Goal Year</label>
                                                            <div class="select-wrapper">
                                                                <select class="form-control"
                                                                    multiple="multiple">
                                                                    <option>2020</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="income11" role="tabpanel">
                                                    <div class="inline-form">
                                                        <div class="form-group">
                                                            <label>Amount Today</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Inflation %</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Goal Year</label>
                                                            <div class="select-wrapper">
                                                                <select class="form-control"
                                                                    multiple="multiple">
                                                                    <option>2020</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="income12" role="tabpanel">
                                                    <div class="inline-form">
                                                        <div class="form-group">
                                                            <label>Amount Today</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Inflation %</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Goal Year</label>
                                                            <div class="select-wrapper">
                                                                <select class="form-control"
                                                                    multiple="multiple">
                                                                    <option>2020</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="income13" role="tabpanel">
                                                    <div class="inline-form">
                                                        <div class="form-group">
                                                            <label>Amount Today</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Inflation %</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Goal Year</label>
                                                            <div class="select-wrapper">
                                                                <select class="form-control"
                                                                    multiple="multiple">
                                                                    <option>2020</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="income14" role="tabpanel">
                                                    <div class="inline-form">
                                                        <div class="form-group">
                                                            <label>Amount Today</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Inflation %</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Goal Year</label>
                                                            <div class="select-wrapper">
                                                                <select class="form-control"
                                                                    multiple="multiple">
                                                                    <option>2020</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-footer">
                                <button type="button" class="btn btn-primary btn-lg proceed">Proceed</button>
                            </div>
                        </div>
                    </section>
                    <section class="trial" id="expense-details" data-step="4" autocomplete="off">
                        <div class="form-inner-section">
                            <div class="form-header">
                                <h3 class="card-title"><i class="icon-left-arrow back-btn"></i> Expense</h3>
                            </div>
                            <div class="form-content">
                                <div class="form-sections">
                                    <h4 class="form-section-title text-uppercase">Enter Details for
                                        Categories</h4>
                                    <ul class="nav nav-tabs income-tab" role="tablist">
                                        <li class="nav-item mb-3" role="presentation">
                                            <a class="nav-link active" data-toggle="tab"
                                                href="#household-expense1" role="tab"
                                                aria-selected="true">Food & Grocery</a>
                                            <span class="remove-member"><i class="icon-close"></i></span>
                                            <span class="add-income">+</span>
                                        </li>
                                        <li class="nav-item mb-3" role="presentation">
                                            <a class="nav-link" data-toggle="tab" href="#household-expense2"
                                                role="tab" aria-selected="true">House
                                                Rent/Maintenance/Repair</a>
                                            <span class="remove-member"><i class="icon-close"></i></span>
                                            <span class="add-income">+</span>
                                        </li>
                                        <li class="nav-item mb-3" role="presentation">
                                            <a class="nav-link" data-toggle="tab" href="#household-expense3"
                                                role="tab" aria-selected="true">Conveyance, Fuel and
                                                Maintenance
                                            </a>
                                            <span class="remove-member"><i class="icon-close"></i></span>
                                            <span class="add-income">+</span>
                                        </li>
                                        <li class="nav-item mb-3" role="presentation">
                                            <a class="nav-link" data-toggle="tab" href="#household-expense4"
                                                role="tab" aria-selected="true">Medicines / Doctor /
                                                Healthcare</a>
                                            <span class="remove-member"><i class="icon-close"></i></span>
                                            <span class="add-income">+</span>
                                        </li>
                                        <li class="nav-item mb-3" role="presentation">
                                            <a class="nav-link" data-toggle="tab" href="#household-expense5"
                                                role="tab" aria-selected="true">Electricity / Water / Labour
                                                /
                                                AMC</a>
                                            <span class="remove-member"><i class="icon-close"></i></span>
                                            <span class="add-income">+</span>
                                        </li>
                                        <li class="nav-item mb-3" role="presentation">
                                            <a class="nav-link" data-toggle="tab" href="#household-expense6"
                                                role="tab" aria-selected="true">Mobile</a>
                                            <span class="remove-member"><i class="icon-close"></i></span>
                                            <span class="add-income">+</span>
                                        </li>
                                        <li class="nav-item mb-3" role="presentation">
                                            <a class="nav-link" data-toggle="tab" href="#household-expense7"
                                                role="tab" aria-selected="true">GasLine/Telephone/Internet
                                                /Cable</a>
                                            <span class="remove-member"><i class="icon-close"></i></span>
                                            <span class="add-income">+</span>
                                        </li>
                                        <li class="nav-item mb-3" role="presentation">
                                            <a class="nav-link" data-toggle="tab" href="#household-expense8"
                                                role="tab" aria-selected="true">Cloths and Accessories</a>
                                            <span class="remove-member"><i class="icon-close"></i></span>
                                            <span class="add-income">+</span>
                                        </li>
                                        <li class="nav-item mb-3" role="presentation">
                                            <a class="nav-link" data-toggle="tab" href="#household-expense9"
                                                role="tab" aria-selected="true">Shopping, Gifts, Whitegoods,
                                                Gadgets</a>
                                            <span class="remove-member"><i class="icon-close"></i></span>
                                            <span class="add-income">+</span>
                                        </li>
                                        <li class="nav-item mb-3" role="presentation">
                                            <a class="nav-link" data-toggle="tab"
                                                href="#household-expense10" role="tab"
                                                aria-selected="true">Dining/Movies/Sports</a>
                                            <span class="remove-member"><i class="icon-close"></i></span>
                                            <span class="add-income">+</span>
                                        </li>
                                        <li class="nav-item mb-3" role="presentation">
                                            <a class="nav-link" data-toggle="tab"
                                                href="#household-expense11" role="tab"
                                                aria-selected="true">Personal Care/Others</a>
                                            <span class="remove-member"><i class="icon-close"></i></span>
                                            <span class="add-income">+</span>
                                        </li>
                                        <li class="nav-item mb-3" role="presentation">
                                            <a class="nav-link" data-toggle="tab"
                                                href="#household-expense12" role="tab"
                                                aria-selected="true">Mediclaim/PA/CI</a>
                                            <span class="remove-member"><i class="icon-close"></i></span>
                                            <span class="add-income">+</span>
                                        </li>
                                        <li class="nav-item mb-3" role="presentation">
                                            <a class="nav-link" data-toggle="tab"
                                                href="#household-expense13" role="tab"
                                                aria-selected="true">Children's Schooling/College
                                                Expenses
                                            </a>
                                            <span class="remove-member"><i class="icon-close"></i></span>
                                            <span class="add-income">+</span>
                                        </li>
                                        <li class="nav-item mb-3" role="presentation">
                                            <a class="nav-link" data-toggle="tab"
                                                href="#household-expense14" role="tab"
                                                aria-selected="true">Contribution to Parents/Siblings</a>
                                            <span class="remove-member"><i class="icon-close"></i></span>
                                            <span class="add-income">+</span>
                                        </li>
                                        <li class="nav-item mb-3" role="presentation">
                                            <a class="nav-link" data-toggle="tab"
                                                href="#household-expense15" role="tab"
                                                aria-selected="true">Motor Insurance</a>
                                            <span class="remove-member"><i class="icon-close"></i></span>
                                            <span class="add-income">+</span>
                                        </li>
                                        <li class="nav-item mb-3" role="presentation">
                                            <a class="nav-link" data-toggle="tab"
                                                href="#household-expense16" role="tab"
                                                aria-selected="true">Life Insurance -Term Plan</a>
                                            <span class="remove-member"><i class="icon-close"></i></span>
                                            <span class="add-income">+</span>
                                        </li>
                                        <li class="nav-item mb-3" role="presentation">
                                            <a class="nav-link" data-toggle="tab"
                                                href="#household-expense17" role="tab"
                                                aria-selected="true">EMI</a>
                                            <span class="remove-member"><i class="icon-close"></i></span>
                                            <span class="add-income">+</span>
                                        </li>
                                        <div class="disabled-wrapper"></div>
                                        <a href="javascript:void(0)" class="leftTabArrow"><i
                                                class="icon-left-arrow"></i></a>
                                        <a href="javascript:void(0)" class="rightTabArrow"><i
                                                class="icon-right-arrow"></i></a>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane fade show active" id="household-expense1"
                                            role="tabpanel">
                                            <div class="inline-form">
                                                <div class="form-group">
                                                    <label>Annual Amount</label>
                                                    <input type="text" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>Upto -Year -Select</label>
                                                    <div class="select-wrapper">
                                                        <select class="form-control">
                                                            <option>2020</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Inflation</label>
                                                    <input type="text" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label class="mb-2">
                                                        Consider Post Retirenment</label>
                                                    <div class="d-flex ">
                                                        <div class="form-group custom-checkbox mb-0">
                                                            <input type="checkbox" id="yes">
                                                            <label for="yes">Self</label>
                                                        </div>
                                                        <div class="form-group custom-checkbox mb-0">
                                                            <input type="checkbox" id="no">
                                                            <label for="no">Spouse</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>% of Current Expense </label>
                                                    <input type="text" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="household-expense1" role="tabpanel">
                                            <div class="inline-form">
                                                <div class="form-group">
                                                    <label>Annual Amount</label>
                                                    <input type="text" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>Upto -Year -Select</label>
                                                    <div class="select-wrapper">
                                                        <select class="form-control">
                                                            <option>2020</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Inflation</label>
                                                    <input type="text" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label class="mb-2">
                                                        Consider Post Retirenment</label>
                                                    <div class="d-flex ">
                                                        <div class="form-group custom-checkbox mb-0">
                                                            <input type="checkbox" id="yes">
                                                            <label for="yes">Self</label>
                                                        </div>
                                                        <div class="form-group custom-checkbox mb-0">
                                                            <input type="checkbox" id="no">
                                                            <label for="no">Spouse</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>% of Current Expense </label>
                                                    <input type="text" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="household-expense2" role="tabpanel">
                                            <div class="inline-form">
                                                <div class="form-group">
                                                    <label>Annual Amount</label>
                                                    <input type="text" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>Upto -Year -Select</label>
                                                    <div class="select-wrapper">
                                                        <select class="form-control">
                                                            <option>2020</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Inflation</label>
                                                    <input type="text" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label class="mb-2">
                                                        Consider Post Retirenment</label>
                                                    <div class="d-flex ">
                                                        <div class="form-group custom-checkbox mb-0">
                                                            <input type="checkbox" id="yes">
                                                            <label for="yes">Self</label>
                                                        </div>
                                                        <div class="form-group custom-checkbox mb-0">
                                                            <input type="checkbox" id="no">
                                                            <label for="no">Spouse</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>% of Current Expense </label>
                                                    <input type="text" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="household-expense3" role="tabpanel">
                                            <div class="inline-form">
                                                <div class="form-group">
                                                    <label>Annual Amount</label>
                                                    <input type="text" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>Upto -Year -Select</label>
                                                    <div class="select-wrapper">
                                                        <select class="form-control">
                                                            <option>2020</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Inflation</label>
                                                    <input type="text" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label class="mb-2">
                                                        Consider Post Retirenment</label>
                                                    <div class="d-flex ">
                                                        <div class="form-group custom-checkbox mb-0">
                                                            <input type="checkbox" id="yes">
                                                            <label for="yes">Self</label>
                                                        </div>
                                                        <div class="form-group custom-checkbox mb-0">
                                                            <input type="checkbox" id="no">
                                                            <label for="no">Spouse</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>% of Current Expense </label>
                                                    <input type="text" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="household-expense4" role="tabpanel">
                                            <div class="inline-form">
                                                <div class="form-group">
                                                    <label>Annual Amount</label>
                                                    <input type="text" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>Upto -Year -Select</label>
                                                    <div class="select-wrapper">
                                                        <select class="form-control">
                                                            <option>2020</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Inflation</label>
                                                    <input type="text" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label class="mb-2">
                                                        Consider Post Retirenment</label>
                                                    <div class="d-flex ">
                                                        <div class="form-group custom-checkbox mb-0">
                                                            <input type="checkbox" id="yes">
                                                            <label for="yes">Self</label>
                                                        </div>
                                                        <div class="form-group custom-checkbox mb-0">
                                                            <input type="checkbox" id="no">
                                                            <label for="no">Spouse</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>% of Current Expense </label>
                                                    <input type="text" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="household-expense5" role="tabpanel">
                                            <div class="inline-form">
                                                <div class="form-group">
                                                    <label>Annual Amount</label>
                                                    <input type="text" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>Upto -Year -Select</label>
                                                    <div class="select-wrapper">
                                                        <select class="form-control">
                                                            <option>2020</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Inflation</label>
                                                    <input type="text" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label class="mb-2">
                                                        Consider Post Retirenment</label>
                                                    <div class="d-flex ">
                                                        <div class="form-group custom-checkbox mb-0">
                                                            <input type="checkbox" id="yes">
                                                            <label for="yes">Self</label>
                                                        </div>
                                                        <div class="form-group custom-checkbox mb-0">
                                                            <input type="checkbox" id="no">
                                                            <label for="no">Spouse</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>% of Current Expense </label>
                                                    <input type="text" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="household-expense6" role="tabpanel">
                                            <div class="inline-form">
                                                <div class="form-group">
                                                    <label>Annual Amount</label>
                                                    <input type="text" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>Upto -Year -Select</label>
                                                    <div class="select-wrapper">
                                                        <select class="form-control">
                                                            <option>2020</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Inflation</label>
                                                    <input type="text" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label class="mb-2">
                                                        Consider Post Retirenment</label>
                                                    <div class="d-flex ">
                                                        <div class="form-group custom-checkbox mb-0">
                                                            <input type="checkbox" id="yes">
                                                            <label for="yes">Self</label>
                                                        </div>
                                                        <div class="form-group custom-checkbox mb-0">
                                                            <input type="checkbox" id="no">
                                                            <label for="no">Spouse</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>% of Current Expense </label>
                                                    <input type="text" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="household-expense7" role="tabpanel">
                                            <div class="inline-form">
                                                <div class="form-group">
                                                    <label>Annual Amount</label>
                                                    <input type="text" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>Upto -Year -Select</label>
                                                    <div class="select-wrapper">
                                                        <select class="form-control">
                                                            <option>2020</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Inflation</label>
                                                    <input type="text" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label class="mb-2">
                                                        Consider Post Retirenment</label>
                                                    <div class="d-flex ">
                                                        <div class="form-group custom-checkbox mb-0">
                                                            <input type="checkbox" id="yes">
                                                            <label for="yes">Self</label>
                                                        </div>
                                                        <div class="form-group custom-checkbox mb-0">
                                                            <input type="checkbox" id="no">
                                                            <label for="no">Spouse</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>% of Current Expense </label>
                                                    <input type="text" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="household-expense8" role="tabpanel">
                                            <div class="inline-form">
                                                <div class="form-group">
                                                    <label>Annual Amount</label>
                                                    <input type="text" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>Upto -Year -Select</label>
                                                    <div class="select-wrapper">
                                                        <select class="form-control">
                                                            <option>2020</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Inflation</label>
                                                    <input type="text" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label class="mb-2">
                                                        Consider Post Retirenment</label>
                                                    <div class="d-flex ">
                                                        <div class="form-group custom-checkbox mb-0">
                                                            <input type="checkbox" id="yes">
                                                            <label for="yes">Self</label>
                                                        </div>
                                                        <div class="form-group custom-checkbox mb-0">
                                                            <input type="checkbox" id="no">
                                                            <label for="no">Spouse</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>% of Current Expense </label>
                                                    <input type="text" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="household-expense9" role="tabpanel">
                                            <div class="inline-form">
                                                <div class="form-group">
                                                    <label>Annual Amount</label>
                                                    <input type="text" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>Upto -Year -Select</label>
                                                    <div class="select-wrapper">
                                                        <select class="form-control">
                                                            <option>2020</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Inflation</label>
                                                    <input type="text" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label class="mb-2">
                                                        Consider Post Retirenment</label>
                                                    <div class="d-flex ">
                                                        <div class="form-group custom-checkbox mb-0">
                                                            <input type="checkbox" id="yes">
                                                            <label for="yes">Self</label>
                                                        </div>
                                                        <div class="form-group custom-checkbox mb-0">
                                                            <input type="checkbox" id="no">
                                                            <label for="no">Spouse</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>% of Current Expense </label>
                                                    <input type="text" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="household-expense10" role="tabpanel">
                                            <div class="inline-form">
                                                <div class="form-group">
                                                    <label>Annual Amount</label>
                                                    <input type="text" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>Upto -Year -Select</label>
                                                    <div class="select-wrapper">
                                                        <select class="form-control">
                                                            <option>2020</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Inflation</label>
                                                    <input type="text" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label class="mb-2">
                                                        Consider Post Retirenment</label>
                                                    <div class="d-flex ">
                                                        <div class="form-group custom-checkbox mb-0">
                                                            <input type="checkbox" id="yes">
                                                            <label for="yes">Self</label>
                                                        </div>
                                                        <div class="form-group custom-checkbox mb-0">
                                                            <input type="checkbox" id="no">
                                                            <label for="no">Spouse</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>% of Current Expense </label>
                                                    <input type="text" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="household-expense11" role="tabpanel">
                                            <div class="inline-form">
                                                <div class="form-group">
                                                    <label>Annual Amount</label>
                                                    <input type="text" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>Upto -Year -Select</label>
                                                    <div class="select-wrapper">
                                                        <select class="form-control">
                                                            <option>2020</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Inflation</label>
                                                    <input type="text" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label class="mb-2">
                                                        Consider Post Retirenment</label>
                                                    <div class="d-flex ">
                                                        <div class="form-group custom-checkbox mb-0">
                                                            <input type="checkbox" id="yes">
                                                            <label for="yes">Self</label>
                                                        </div>
                                                        <div class="form-group custom-checkbox mb-0">
                                                            <input type="checkbox" id="no">
                                                            <label for="no">Spouse</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>% of Current Expense </label>
                                                    <input type="text" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="household-expense12" role="tabpanel">
                                            <div class="inline-form">
                                                <div class="form-group">
                                                    <label>Annual Amount</label>
                                                    <input type="text" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>Upto -Year -Select</label>
                                                    <div class="select-wrapper">
                                                        <select class="form-control">
                                                            <option>2020</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Inflation</label>
                                                    <input type="text" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label class="mb-2">
                                                        Consider Post Retirenment</label>
                                                    <div class="d-flex ">
                                                        <div class="form-group custom-checkbox mb-0">
                                                            <input type="checkbox" id="yes">
                                                            <label for="yes">Self</label>
                                                        </div>
                                                        <div class="form-group custom-checkbox mb-0">
                                                            <input type="checkbox" id="no">
                                                            <label for="no">Spouse</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>% of Current Expense </label>
                                                    <input type="text" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="household-expense13" role="tabpanel">
                                            <div class="inline-form">
                                                <div class="form-group">
                                                    <label>Annual Amount</label>
                                                    <input type="text" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>Upto -Year -Select</label>
                                                    <div class="select-wrapper">
                                                        <select class="form-control">
                                                            <option>2020</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Inflation</label>
                                                    <input type="text" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label class="mb-2">
                                                        Consider Post Retirenment</label>
                                                    <div class="d-flex ">
                                                        <div class="form-group custom-checkbox mb-0">
                                                            <input type="checkbox" id="yes">
                                                            <label for="yes">Self</label>
                                                        </div>
                                                        <div class="form-group custom-checkbox mb-0">
                                                            <input type="checkbox" id="no">
                                                            <label for="no">Spouse</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>% of Current Expense </label>
                                                    <input type="text" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="household-expense14" role="tabpanel">
                                            <div class="inline-form">
                                                <div class="form-group">
                                                    <label>Annual Amount</label>
                                                    <input type="text" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>Upto -Year -Select</label>
                                                    <div class="select-wrapper">
                                                        <select class="form-control">
                                                            <option>2020</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Inflation</label>
                                                    <input type="text" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label class="mb-2">
                                                        Consider Post Retirenment</label>
                                                    <div class="d-flex ">
                                                        <div class="form-group custom-checkbox mb-0">
                                                            <input type="checkbox" id="yes">
                                                            <label for="yes">Self</label>
                                                        </div>
                                                        <div class="form-group custom-checkbox mb-0">
                                                            <input type="checkbox" id="no">
                                                            <label for="no">Spouse</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>% of Current Expense </label>
                                                    <input type="text" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="household-expense15" role="tabpanel">
                                            <div class="inline-form">
                                                <div class="form-group">
                                                    <label>Annual Amount</label>
                                                    <input type="text" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>Upto -Year -Select</label>
                                                    <div class="select-wrapper">
                                                        <select class="form-control">
                                                            <option>2020</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Inflation</label>
                                                    <input type="text" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label class="mb-2">
                                                        Consider Post Retirenment</label>
                                                    <div class="d-flex ">
                                                        <div class="form-group custom-checkbox mb-0">
                                                            <input type="checkbox" id="yes">
                                                            <label for="yes">Self</label>
                                                        </div>
                                                        <div class="form-group custom-checkbox mb-0">
                                                            <input type="checkbox" id="no">
                                                            <label for="no">Spouse</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>% of Current Expense </label>
                                                    <input type="text" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="household-expense16" role="tabpanel">
                                            <div class="inline-form">
                                                <div class="form-group">
                                                    <label>Annual Amount</label>
                                                    <input type="text" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>Upto -Year -Select</label>
                                                    <div class="select-wrapper">
                                                        <select class="form-control">
                                                            <option>2020</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Inflation</label>
                                                    <input type="text" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label class="mb-2">
                                                        Consider Post Retirenment</label>
                                                    <div class="d-flex ">
                                                        <div class="form-group custom-checkbox mb-0">
                                                            <input type="checkbox" id="yes">
                                                            <label for="yes">Self</label>
                                                        </div>
                                                        <div class="form-group custom-checkbox mb-0">
                                                            <input type="checkbox" id="no">
                                                            <label for="no">Spouse</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>% of Current Expense </label>
                                                    <input type="text" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="household-expense17" role="tabpanel">
                                            <div class="inline-form">
                                                <div class="form-group">
                                                    <label>Annual Amount</label>
                                                    <input type="text" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>Upto -Year -Select</label>
                                                    <div class="select-wrapper">
                                                        <select class="form-control">
                                                            <option>2020</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Inflation</label>
                                                    <input type="text" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label class="mb-2">
                                                        Consider Post Retirenment</label>
                                                    <div class="d-flex ">
                                                        <div class="form-group custom-checkbox mb-0">
                                                            <input type="checkbox" id="yes">
                                                            <label for="yes">Self</label>
                                                        </div>
                                                        <div class="form-group custom-checkbox mb-0">
                                                            <input type="checkbox" id="no">
                                                            <label for="no">Spouse</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>% of Current Expense </label>
                                                    <input type="text" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-footer">
                                <button type="button" class="btn btn-primary btn-lg proceed">Proceed</button>
                            </div>
                        </div>
                    </section>
                    <section class="trial" id="insurance-details" data-step="5" autocomplete="off">
                        <div class="form-inner-section">
                            <div class="form-header">
                                <h3 class="card-title"><i class="icon-left-arrow back-btn"></i> Insurance Premium</h3>
                            </div>
                            <div class="form-content">
                                <ul class="nav nav-tabs mb-5" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" data-toggle="tab"
                                            href="#insurance-member1" role="tab" aria-controls="member1"
                                            aria-selected="true">Ashish
                                            Jaiswal</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" data-toggle="tab" href="#insurance-member2"
                                            role="tab" aria-selected="true">Neha Jaiswal</a>
                                    </li>
                                </ul>
                                <div class="tab-content family-tab">
                                    <div class="tab-pane fade show active" id="insurance-member1"
                                        role="tabpanel" aria-labelledby="goal-member1-tab">
                                        <div class="form-sections">
                                            <h4 class="form-section-title text-uppercase">Enter Details for
                                                Categories</h4>
                                            <ul class="nav nav-tabs income-tab" role="tablist">
                                                <li class="nav-item mb-3" role="presentation">
                                                    <a class="nav-link active" data-toggle="tab"
                                                        href="#insurance-expense1" role="tab"
                                                        aria-selected="true">Motor
                                                        Insurance</a>
                                                    <span class="remove-member"><i
                                                            class="icon-close"></i></span>
                                                    <span class="add-income">+</span>
                                                </li>
                                                <li class="nav-item mb-3" role="presentation">
                                                    <a class="nav-link" data-toggle="tab"
                                                        href="#insurance-expense2" role="tab"
                                                        aria-selected="true">Life Insurance</a>
                                                    <span class="remove-member"><i
                                                            class="icon-close"></i></span>
                                                    <span class="add-income">+</span>
                                                </li>
                                                <div class="disabled-wrapper"></div>
                                            </ul>
                                            <div class="tab-content">
                                                <div class="tab-pane fade show active"
                                                    id="insurance-expense1" role="tabpanel">
                                                    <div class="inline-form">
                                                        <div class="form-group">
                                                            <label for="inflation-percent">Inflation
                                                                Percent</label>
                                                            <input type="text" class="form-control"
                                                                id="inflation-percent">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Goal Year</label>
                                                            <div class="select-wrapper">
                                                                <select class="form-control">
                                                                    <option>2020</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="goal-amt">Amount Today</label>
                                                            <input type="text" class="form-control"
                                                                id="goal-amt">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade show " id="insurance-expense2"
                                                    role="tabpanel">
                                                    <div class="inline-form">
                                                        <div class="form-group">
                                                            <label for="inflation-percent">Inflation
                                                                Percent</label>
                                                            <input type="text" class="form-control"
                                                                id="inflation-percent">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Goal Year</label>
                                                            <div class="select-wrapper">
                                                                <select class="form-control">
                                                                    <option>2020</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="goal-amt">Amount Today</label>
                                                            <input type="text" class="form-control"
                                                                id="goal-amt">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade show" id="insurance-member2" role="tabpanel"
                                        aria-labelledby="goal-member2-tab">
                                        <div class="form-sections">
                                            <h4 class="form-section-title text-uppercase">Enter Details for
                                                Categories</h4>
                                            <ul class="nav nav-tabs income-tab" role="tablist">
                                                <li class="nav-item mb-3" role="presentation">
                                                    <a class="nav-link active" data-toggle="tab"
                                                        href="#insurance-expense1" role="tab"
                                                        aria-selected="true">Motor
                                                        Insurance</a>
                                                    <span class="remove-member"><i
                                                            class="icon-close"></i></span>
                                                    <span class="add-income">+</span>
                                                </li>
                                                <li class="nav-item mb-3" role="presentation">
                                                    <a class="nav-link" data-toggle="tab"
                                                        href="#insurance-expense2" role="tab"
                                                        aria-selected="true">Life Insurance</a>
                                                    <span class="remove-member"><i
                                                            class="icon-close"></i></span>
                                                    <span class="add-income">+</span>
                                                </li>
                                                <div class="disabled-wrapper"></div>
                                            </ul>
                                            <div class="tab-content">
                                                <div class="tab-pane fade show active"
                                                    id="insurance-expense1" role="tabpanel">
                                                    <div class="inline-form">
                                                        <div class="form-group">
                                                            <label for="inflation-percent">Inflation
                                                                Percent</label>
                                                            <input type="text" class="form-control"
                                                                id="inflation-percent">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Goal Year</label>
                                                            <div class="select-wrapper">
                                                                <select class="form-control">
                                                                    <option>2020</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="goal-amt">Amount Today</label>
                                                            <input type="text" class="form-control"
                                                                id="goal-amt">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade show " id="insurance-expense2"
                                                    role="tabpanel">
                                                    <div class="inline-form">
                                                        <div class="form-group">
                                                            <label for="inflation-percent">Inflation
                                                                Percent</label>
                                                            <input type="text" class="form-control"
                                                                id="inflation-percent">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Goal Year</label>
                                                            <div class="select-wrapper">
                                                                <select class="form-control">
                                                                    <option>2020</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="goal-amt">Amount Today</label>
                                                            <input type="text" class="form-control"
                                                                id="goal-amt">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-footer">
                                <button type="button" class="btn btn-primary btn-lg proceed">Proceed</button>
                            </div>
                        </div>
                    </section>
                    <section class="trial" id="liability-details" data-step="6" autocomplete="off">
                        <div class="form-inner-section">
                            <div class="form-header">
                                <h3 class="card-title"><i class="icon-left-arrow back-btn"></i> Liability</h3>
                            </div>
                            <div class="form-content">
                                <ul class="nav nav-tabs mb-5" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" data-toggle="tab"
                                            href="#liability-member1" role="tab" aria-controls="member1"
                                            aria-selected="true">Ashish
                                            Jaiswal</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" data-toggle="tab" href="#liability-member2"
                                            role="tab" aria-selected="true">Neha Jaiswal</a>
                                    </li>
                                </ul>
                                <div class="tab-content family-tab">
                                    <div class="tab-pane fade show active" id="liability-member1"
                                        role="tabpanel" aria-labelledby="goal-member1-tab">
                                        <div class="form-sections">
                                            <h4 class="form-section-title text-uppercase">Enter Details for
                                                Categories</h4>
                                            <ul class="nav nav-tabs income-tab" role="tablist">
                                                <li class="nav-item mb-3" role="presentation">
                                                    <a class="nav-link active" data-toggle="tab"
                                                        href="#liability-expense1" role="tab"
                                                        aria-selected="true">Home
                                                        Loan</a>
                                                    <span class="remove-member"><i
                                                            class="icon-close"></i></span>
                                                    <span class="add-income">+</span>
                                                </li>
                                                <li class="nav-item mb-3" role="presentation">
                                                    <a class="nav-link" data-toggle="tab"
                                                        href="#liability-expense2" role="tab"
                                                        aria-selected="true">Vehicle Loan</a>
                                                    <span class="remove-member"><i
                                                            class="icon-close"></i></span>
                                                    <span class="add-income">+</span>
                                                </li>
                                                <li class="nav-item mb-3" role="presentation">
                                                    <a class="nav-link" data-toggle="tab"
                                                        href="#liability-expense3" role="tab"
                                                        aria-selected="true">Personal Loan</a>
                                                    <span class="remove-member"><i
                                                            class="icon-close"></i></span>
                                                    <span class="add-income">+</span>
                                                </li>
                                                <li class="nav-item mb-3" role="presentation">
                                                    <a class="nav-link" data-toggle="tab"
                                                        href="#liability-expense4" role="tab"
                                                        aria-selected="true">Consumer Durable</a>
                                                    <span class="remove-member"><i
                                                            class="icon-close"></i></span>
                                                    <span class="add-income">+</span>
                                                </li>
                                                <div class="disabled-wrapper"></div>
                                            </ul>
                                            <div class="tab-content">
                                                <div class="tab-pane fade show active"
                                                    id="liability-expense1" role="tabpanel">
                                                    <div class="inline-form">
                                                        <div class="form-group">
                                                            <label for="inflation-percent">Inflation
                                                                Percent</label>
                                                            <input type="text" class="form-control"
                                                                id="inflation-percent">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Goal Year</label>
                                                            <div class="select-wrapper">
                                                                <select class="form-control">
                                                                    <option>2020</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="goal-amt">Amount Today</label>
                                                            <input type="text" class="form-control"
                                                                id="goal-amt">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade show " id="liability-expense2"
                                                    role="tabpanel">
                                                    <div class="inline-form">
                                                        <div class="form-group">
                                                            <label for="inflation-percent">Inflation
                                                                Percent</label>
                                                            <input type="text" class="form-control"
                                                                id="inflation-percent">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Goal Year</label>
                                                            <div class="select-wrapper">
                                                                <select class="form-control">
                                                                    <option>2020</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="goal-amt">Amount Today</label>
                                                            <input type="text" class="form-control"
                                                                id="goal-amt">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade show " id="liability-expense3"
                                                    role="tabpanel">
                                                    <div class="inline-form">
                                                        <div class="form-group">
                                                            <label for="inflation-percent">Inflation
                                                                Percent</label>
                                                            <input type="text" class="form-control"
                                                                id="inflation-percent">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Goal Year</label>
                                                            <div class="select-wrapper">
                                                                <select class="form-control">
                                                                    <option>2020</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="goal-amt">Amount Today</label>
                                                            <input type="text" class="form-control"
                                                                id="goal-amt">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade show " id="liability-expense4"
                                                    role="tabpanel">
                                                    <div class="inline-form">
                                                        <div class="form-group">
                                                            <label for="inflation-percent">Inflation
                                                                Percent</label>
                                                            <input type="text" class="form-control"
                                                                id="inflation-percent">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Goal Year</label>
                                                            <div class="select-wrapper">
                                                                <select class="form-control">
                                                                    <option>2020</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="goal-amt">Amount Today</label>
                                                            <input type="text" class="form-control"
                                                                id="goal-amt">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade show" id="liability-member2" role="tabpanel"
                                        aria-labelledby="goal-member2-tab">
                                        <div class="form-sections">
                                            <h4 class="form-section-title text-uppercase">Enter Details for
                                                Categories</h4>
                                            <ul class="nav nav-tabs income-tab" role="tablist">
                                                <li class="nav-item mb-3" role="presentation">
                                                    <a class="nav-link active" data-toggle="tab"
                                                        href="#liability-expense1" role="tab"
                                                        aria-selected="true">Home
                                                        Loan</a>
                                                    <span class="remove-member"><i
                                                            class="icon-close"></i></span>
                                                    <span class="add-income">+</span>
                                                </li>
                                                <li class="nav-item mb-3" role="presentation">
                                                    <a class="nav-link" data-toggle="tab"
                                                        href="#liability-expense2" role="tab"
                                                        aria-selected="true">Vehicle Loan</a>
                                                    <span class="remove-member"><i
                                                            class="icon-close"></i></span>
                                                    <span class="add-income">+</span>
                                                </li>
                                                <li class="nav-item mb-3" role="presentation">
                                                    <a class="nav-link" data-toggle="tab"
                                                        href="#liability-expense3" role="tab"
                                                        aria-selected="true">Personal Loan</a>
                                                    <span class="remove-member"><i
                                                            class="icon-close"></i></span>
                                                    <span class="add-income">+</span>
                                                </li>
                                                <li class="nav-item mb-3" role="presentation">
                                                    <a class="nav-link" data-toggle="tab"
                                                        href="#liability-expense4" role="tab"
                                                        aria-selected="true">Consumer Durable</a>
                                                    <span class="remove-member"><i
                                                            class="icon-close"></i></span>
                                                    <span class="add-income">+</span>
                                                </li>
                                                <div class="disabled-wrapper"></div>
                                            </ul>
                                            <div class="tab-content">
                                                <div class="tab-pane fade show active"
                                                    id="liability-expense1" role="tabpanel">
                                                    <div class="inline-form">
                                                        <div class="form-group">
                                                            <label for="inflation-percent">Inflation
                                                                Percent</label>
                                                            <input type="text" class="form-control"
                                                                id="inflation-percent">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Goal Year</label>
                                                            <div class="select-wrapper">
                                                                <select class="form-control">
                                                                    <option>2020</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="goal-amt">Amount Today</label>
                                                            <input type="text" class="form-control"
                                                                id="goal-amt">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade show " id="liability-expense2"
                                                    role="tabpanel">
                                                    <div class="inline-form">
                                                        <div class="form-group">
                                                            <label for="inflation-percent">Inflation
                                                                Percent</label>
                                                            <input type="text" class="form-control"
                                                                id="inflation-percent">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Goal Year</label>
                                                            <div class="select-wrapper">
                                                                <select class="form-control">
                                                                    <option>2020</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="goal-amt">Amount Today</label>
                                                            <input type="text" class="form-control"
                                                                id="goal-amt">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade show " id="liability-expense3"
                                                    role="tabpanel">
                                                    <div class="inline-form">
                                                        <div class="form-group">
                                                            <label for="inflation-percent">Inflation
                                                                Percent</label>
                                                            <input type="text" class="form-control"
                                                                id="inflation-percent">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Goal Year</label>
                                                            <div class="select-wrapper">
                                                                <select class="form-control">
                                                                    <option>2020</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="goal-amt">Amount Today</label>
                                                            <input type="text" class="form-control"
                                                                id="goal-amt">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade show " id="liability-expense4"
                                                    role="tabpanel">
                                                    <div class="inline-form">
                                                        <div class="form-group">
                                                            <label for="inflation-percent">Inflation
                                                                Percent</label>
                                                            <input type="text" class="form-control"
                                                                id="inflation-percent">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Goal Year</label>
                                                            <div class="select-wrapper">
                                                                <select class="form-control">
                                                                    <option>2020</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="goal-amt">Amount Today</label>
                                                            <input type="text" class="form-control"
                                                                id="goal-amt">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-footer">
                                <button type="button" class="btn btn-primary btn-lg proceed">Proceed</button>
                            </div>
                        </div>
                    </section>
                    <section class="trial" id="surplus-details" data-step="7" autocomplete="off">
                        <div class="form-inner-section">
                            <div class="form-header">
                                <h3 class="card-title"><i class="icon-left-arrow back-btn"></i> Surplus</h3>
                            </div>
                            <div class="form-content">
                                <ul class="nav nav-tabs mb-5" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" data-toggle="tab" href="#surplus-member1"
                                            role="tab" aria-controls="member1"
                                            aria-selected="true">Savings</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" data-toggle="tab" href="#surplus-member2"
                                            role="tab" aria-selected="true">Investments</a>
                                    </li>
                                </ul>
                                <div class="tab-content family-tab">
                                    <div class="tab-pane fade show active" id="surplus-member1"
                                        role="tabpanel">
                                        <div class="table-responsive mb-4">
                                            <table class="table normal-table">
                                                <thead>
                                                    <tr>
                                                        <th>Parameter</th>
                                                        <th>Ashish Jaiswal</th>
                                                        <th>Neha Jaiswal</th>
                                                        <th>Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            Income
                                                        </td>
                                                        <td>
                                                            ₹10.56K
                                                        </td>
                                                        <td>
                                                            ₹10.56K
                                                        </td>
                                                        <td>
                                                            ₹10.56K
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            Expense weightage
                                                        </td>
                                                        <td>
                                                            <input type="text" value="₹10.56K"
                                                                class="form-control">
                                                        </td>
                                                        <td>
                                                            ₹10.56K
                                                        </td>
                                                        <td>
                                                            ₹10.56K
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            Expense
                                                        </td>
                                                        <td>
                                                            ₹10.56K
                                                        </td>
                                                        <td>
                                                            ₹10.56K
                                                        </td>
                                                        <td>
                                                            ₹10.56K
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            Savings
                                                        </td>
                                                        <td>
                                                            ₹10.56K
                                                        </td>
                                                        <td>
                                                            ₹10.56K
                                                        </td>
                                                        <td>
                                                            ₹10.56K
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade show" id="surplus-member2" role="tabpanel">
                                        <div class="table-responsive mb-4">
                                            <table class="table normal-table">
                                                <thead>
                                                    <tr>
                                                        <th>Parameter</th>
                                                        <th>Ashish Jaiswal</th>
                                                        <th>Neha Jaiswal</th>
                                                        <th>Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            Income
                                                        </td>
                                                        <td>
                                                            ₹10.56K
                                                        </td>
                                                        <td>
                                                            ₹10.56K
                                                        </td>
                                                        <td>
                                                            ₹10.56K
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            Reccuring Deposit
                                                        </td>
                                                        <td>
                                                            ₹10.56K
                                                        </td>
                                                        <td>
                                                            100/100%
                                                        </td>
                                                        <td>
                                                            ₹10.56K
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            ULIP
                                                        </td>
                                                        <td>
                                                            ₹10.56K
                                                        </td>
                                                        <td>
                                                            ₹10.56K
                                                        </td>
                                                        <td>
                                                            ₹10.56K
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            Cash
                                                        </td>
                                                        <td>
                                                            ₹10.56K
                                                        </td>
                                                        <td>
                                                            ₹10.56K
                                                        </td>
                                                        <td>
                                                            ₹10.56K
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            Debt Mutual Fund
                                                        </td>
                                                        <td>
                                                            ₹10.56K
                                                        </td>
                                                        <td>
                                                            ₹10.56K
                                                        </td>
                                                        <td>
                                                            ₹10.56K
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            ELSS
                                                        </td>
                                                        <td>
                                                            ₹10.56K
                                                        </td>
                                                        <td>
                                                            ₹10.56K
                                                        </td>
                                                        <td>
                                                            ₹10.56K
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            Equity Mutual Fund
                                                        </td>
                                                        <td>
                                                            ₹10.56K
                                                        </td>
                                                        <td>
                                                            ₹10.56K
                                                        </td>
                                                        <td>
                                                            ₹10.56K
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            PPF
                                                        </td>
                                                        <td>
                                                            ₹10.56K
                                                        </td>
                                                        <td>
                                                            ₹10.56K
                                                        </td>
                                                        <td>
                                                            ₹10.56K
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            Stock
                                                        </td>
                                                        <td>
                                                            ₹10.56K
                                                        </td>
                                                        <td>
                                                            ₹10.56K
                                                        </td>
                                                        <td>
                                                            ₹10.56K
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            Savings
                                                        </td>
                                                        <td>
                                                            ₹10.56K
                                                        </td>
                                                        <td>
                                                            ₹10.56K
                                                        </td>
                                                        <td>
                                                            ₹10.56K
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-footer">
                                <button type="button" class="btn btn-primary btn-lg proceed">Proceed</button>
                                <a href="javascript:void(0)"
                                    class="btn btn-outline-primary btn-lg ml-3">Download</a>
                                <a href="javascript:void(0)" data-toggle="modal" data-target="#emailModal"
                                    class="btn  btn-outline-primary btn-lg ml-3">Email</a>
                            </div>
                        </div>
                    </section>
                    <section class="trial" id="allocation-details" data-step="8" autocomplete="off">
                        <div class="form-inner-section">
                            <div class="form-header">
                                <h3 class="card-title"><i class="icon-left-arrow back-btn"></i> Allocation</h3>
                            </div>
                            <div class="form-content">
                                <div class="table-responsive mb-4">
                                    <table class="table normal-table">
                                        <thead>
                                            <tr>
                                                <th rowspan="2">Name</th>
                                                <th colspan="2" class="top-title">Asset Allocation</th>
                                                <th colspan="2" class="top-title">Expected Returns</th>
                                                <th rowspan="2"></th>
                                            </tr>
                                            <tr>
                                                <th>Equity</th>
                                                <th>Debt</th>
                                                <th>Equity</th>
                                                <th>Debt</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    Ashish Malhotra <br> <small>(kbs20325066)</small>
                                                </td>
                                                <td>
                                                    <select class="form-control">
                                                        <option>₹10.56K</option>
                                                        <option>₹10.56K</option>
                                                        <option>₹10.56K</option>
                                                        <option>₹10.56K</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select class="form-control">
                                                        <option>₹10.56K</option>
                                                        <option>₹10.56K</option>
                                                        <option>₹10.56K</option>
                                                        <option>₹10.56K</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text" value="₹10.56K" class="form-control">
                                                </td>
                                                <td>
                                                    <input type="text" value="₹10.56K" class="form-control">
                                                </td>
                                                <td>
                                                    <a class="btn btn-link"> <svg width="24" height="24"
                                                            viewBox="0 0 24 24">
                                                            <use xlink:href="#month"></use>
                                                        </svg>Calculate</a>
                                                </td>
                                            </tr>
                                            <tr class="info">
                                                <td colspan="6">
                                                    The money will last till year 2026. <span
                                                        class="text-danger">Your
                                                        money
                                                        will exhaust 30 years before
                                                        your living expectancy. </span>
                                                    <a class="btn btn-link" data-toggle="modal"
                                                        data-target="#assetsModal">Restructure Assets <i
                                                            class="icon-right-arrow"></i></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Neha Jaiswal <br><small>(kbs20325066)</small>
                                                </td>
                                                <td>
                                                    <select class="form-control">
                                                        <option>₹10.56K</option>
                                                        <option>₹10.56K</option>
                                                        <option>₹10.56K</option>
                                                        <option>₹10.56K</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select class="form-control">
                                                        <option>₹10.56K</option>
                                                        <option>₹10.56K</option>
                                                        <option>₹10.56K</option>
                                                        <option>₹10.56K</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text" value="₹10.56K" class="form-control">
                                                </td>
                                                <td>
                                                    <input type="text" value="₹10.56K" class="form-control">
                                                </td>
                                                <td>
                                                    <a class="btn btn-link"> <svg width="24" height="24"
                                                            viewBox="0 0 24 24">
                                                            <use xlink:href="#month"></use>
                                                        </svg>Calculate</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Ashish & Family <br><small>(kbs20325066)</small>
                                                </td>
                                                <td>
                                                    <select class="form-control">
                                                        <option>₹10.56K</option>
                                                        <option>₹10.56K</option>
                                                        <option>₹10.56K</option>
                                                        <option>₹10.56K</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select class="form-control">
                                                        <option>₹10.56K</option>
                                                        <option>₹10.56K</option>
                                                        <option>₹10.56K</option>
                                                        <option>₹10.56K</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text" value="₹10.56K" class="form-control">
                                                </td>
                                                <td>
                                                    <input type="text" value="₹10.56K" class="form-control">
                                                </td>
                                                <td>
                                                    <a class="btn btn-link"> <svg width="24" height="24"
                                                            viewBox="0 0 24 24">
                                                            <use xlink:href="#month"></use>
                                                        </svg>Calculate</a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="form-footer">
                                <button type="button" class="btn btn-primary btn-lg proceed">Proceed</button>
                                <a href="javascript:void(0)" data-toggle="modal" data-target="#assetsModal"
                                    class="btn btn-outline-primary btn-lg ml-3">Restructure
                                    Assets</a>
                            </div>
                        </div>

                    </section>
                    <section class="trial" id="cash-flow-details" data-step="9" autocomplete="off">
                        <div class="form-inner-section">
                            <div class="form-header">
                                <h3 class="card-title"><i class="icon-left-arrow back-btn"></i> Projected Cash Flow</h3>
                            </div>
                            <div class="form-content">
                                <div class="row ">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="cash-name">Name</label>
                                            <select class="form-control" id="cash-name"
                                                style="width: 100%;">
                                                <option value="" disabled selected>Select Member</option>
                                                <option>O+</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="cash-year">Cashflow Year</label>
                                            <select class="form-control" id="cash-year" multiple="multiple"
                                                style="width: 100%;">
                                                <option>2020</option>
                                                <option>2021</option>
                                                <option>2022</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item mb-3" role="presentation">
                                        <a class="nav-link active" data-toggle="tab" href="#inflow"
                                            role="tab" aria-selected="true">Projected Inflow</a>
                                    </li>
                                    <li class="nav-item mb-3" role="presentation">
                                        <a class="nav-link" data-toggle="tab" href="#outflow" role="tab"
                                            aria-selected="true">Projected Outflow</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="inflow" role="tabpanel">
                                        <div class="form-group line-success mb-2">
                                            <label for="inflow">Projected Inflow</label>
                                            <input type="text" readonly="" class="form-control-plaintext"
                                                id="inflow" value="₹17.88L">
                                        </div>
                                        <table class="table normal-table w-50">
                                            <thead>
                                                <tr>
                                                    <th>Parameters</th>
                                                    <th>Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        Annual Savings
                                                    </td>
                                                    <td>
                                                        ₹10.56K
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Lumpsum
                                                    </td>
                                                    <td>
                                                        ₹10.56K
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Total
                                                    </td>
                                                    <td>
                                                        ₹10.56K
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade show" id="outflow" role="tabpanel">
                                        <div class="form-group line-danger mb-2">
                                            <label for="outflow">Projected outflow</label>
                                            <input type="text" readonly="" class="form-control-plaintext"
                                                id="outflow" value="₹17.88L">
                                        </div>
                                        <table class="table normal-table w-50">
                                            <thead>
                                                <tr>
                                                    <th>Parameters</th>
                                                    <th>Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        Annual Savings
                                                    </td>
                                                    <td>
                                                        ₹10.56K
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Lumpsum
                                                    </td>
                                                    <td>
                                                        ₹10.56K
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Total
                                                    </td>
                                                    <td>
                                                        ₹10.56K
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="form-footer">
                                <button type="button" class="btn btn-primary btn-lg proceed">Proceed</button>
                            </div>
                        </div>
                    </section>
                    <section class="trial" id="recommendation-details" data-step="10" autocomplete="off">
                        <div class="form-inner-section">
                            <div class="form-header">
                                <h3 class="card-title"><i class="icon-left-arrow back-btn"></i> Recommendations</h3>
                            </div>
                            <div class="form-content">
                                <ul class="nav nav-tabs mb-5" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" data-toggle="tab" href="#buy" role="tab"
                                            aria-controls="member1" aria-selected="true">Buy</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" data-toggle="tab" href="#sell" role="tab"
                                            aria-selected="true">Sell</a>
                                    </li>
                                </ul>
                                <div class="tab-content family-tab">
                                    <div class="tab-pane fade show active" id="buy" role="tabpanel">
                                        <div class="table-responsive mb-4">
                                            <table class="table normal-table">
                                                <thead>
                                                    <tr>
                                                        <th>Parameters</th>
                                                        <th>Ashish Jaiswal</th>
                                                        <th>Neha Jaiswal</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            Tax
                                                        </td>
                                                        <td>
                                                            ₹10.56K
                                                        </td>
                                                        <td>
                                                            ₹10.56K
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            Lumpsum
                                                        </td>
                                                        <td>
                                                            ₹10.56K (60:40)
                                                        </td>
                                                        <td>
                                                            ₹10.56K (60:40)
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            SIP
                                                        </td>
                                                        <td>
                                                            ₹10.56K
                                                        </td>
                                                        <td>
                                                            ₹10.56K
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade show" id="sell" role="tabpanel">
                                        <div class="table-responsive mb-4">
                                            <table class="table normal-table">
                                                <thead>
                                                    <tr>
                                                        <th>Parameters</th>
                                                        <th>Ashish Jaiswal</th>
                                                        <th>Neha Jaiswal</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            Fixed Assets
                                                        </td>
                                                        <td>
                                                            ₹10.56K
                                                        </td>
                                                        <td>
                                                            ₹10.56K
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            Fixed Deposit
                                                        </td>
                                                        <td>
                                                            ₹10.56K
                                                        </td>
                                                        <td>
                                                            ₹10.56K
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            Insurance
                                                        </td>
                                                        <td>
                                                            ₹10.56K
                                                        </td>
                                                        <td>
                                                            ₹10.56K
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            Reccuring Deposit
                                                        </td>
                                                        <td>
                                                            ₹10.56K
                                                        </td>
                                                        <td>
                                                            ₹10.56K
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            ULIP
                                                        </td>
                                                        <td>
                                                            ₹1.56K
                                                        </td>
                                                        <td>
                                                            ₹10.56K
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            Cash
                                                        </td>
                                                        <td>
                                                            ₹10.56K
                                                        </td>
                                                        <td>
                                                            ₹10.56K
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            Debt Mutual Fund
                                                        </td>
                                                        <td>
                                                            ₹10.56K
                                                        </td>
                                                        <td>
                                                            ₹10.56K
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            Equity Mutual Fund
                                                        </td>
                                                        <td>
                                                            ₹10.56K (60:40)
                                                        </td>
                                                        <td>
                                                            ₹10.56K
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            Stock
                                                        </td>
                                                        <td>
                                                            ₹10.56K
                                                        </td>
                                                        <td>
                                                            ₹10.56K
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-footer">
                                <button type="button" class="btn btn-primary btn-lg proceed">Proceed</button>
                                <a href="javascript:void(0)"
                                    class="btn btn-outline-primary btn-lg ml-3">Download</a>
                                <a href="javascript:void(0)" data-toggle="modal" data-target="#emailModal"
                                    class="btn  btn-outline-primary btn-lg ml-3">Email</a>
                            </div>
                        </div>
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
<script type="text/javascript" src="{{ asset('assets/javascript/comprehensive.js') }}"></script>

@endsection
