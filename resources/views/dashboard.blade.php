@extends('layouts.master')

@section('style')

@endsection

@section('content')

<div class="container-fluid">
    <div class="section-header mb-4">
        <div class="dropdown text-right">
            <a class="dropdown-toggle profile-img" type="button" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
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
                <use xlink:href="#notification"></use>
            </svg>
        </button>

    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="welcome-card mb-4">
                <div class="welcome-text">
                    Welcome Back,
                    <h2 class="mb-0">{{ Auth::user()->name }}</h2>
                </div>
            </div>
            <div class="card card-sm mb-4">
                <div class="card-body pt-2">
                    <div class="card-title pb-1 border-bottom d-flex align-items-center">
                        <svg width="40" height="40" viewBox="5 5 50 50">
                            <use xlink:href="#icon-clients"></use>
                        </svg>
                        <h5 class="mb-0">Clients</h5>
                    </div>
                    <div class="row">
                        <div class="col-md-7">

                            <!-- <figure class="highcharts-figure">
                                <div id="vanchart"></div>
                            </figure> -->
                            <canvas id="vanchart"></canvas>
                        </div>
                        <div class="col-md-5">
                            <ul class="chart-data">
                                <li>
                                    <div class="left-section">
                                        <div class="circle-indicator"></div>
                                        <h6 class="mb-0">Individual</h6>
                                    </div>
                                    <div class="right-section">
                                        91
                                    </div>
                                </li>
                                <li>
                                    <div class="left-section">
                                        <div class="circle-indicator warning "></div>
                                        <h6 class="mb-0">NRI</h6>
                                    </div>
                                    <div class="right-section">
                                        91
                                    </div>
                                </li>
                                <li>
                                    <div class="left-section">
                                        <div class="circle-indicator info"></div>
                                        <h6 class="mb-0">Corporate</h6>
                                    </div>
                                    <div class="right-section">
                                        91
                                    </div>
                                </li>
                                <li>
                                    <div class="left-section">
                                        <div class="circle-indicator purple"></div>
                                        <h6 class="mb-0">Minor</h6>
                                    </div>
                                    <div class="right-section">
                                        91
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card allocation-card card-sm">
                <div class="card-body pt-2 pb-0">
                    <div
                        class="card-title pb-1 border-bottom d-sm-flex justify-content-between align-items-center mb-0">
                        <div class="d-flex align-items-center">
                            <svg width="40" height="40" viewBox="5 5 50 50">
                                <use xlink:href="#calendar"></use>
                            </svg>
                            <h5 class="mb-0"> Calendar</h5>
                        </div>
                        <div class="action-btns mt-3 mt-sm-0">
                            <button class="btn btn-link">
                                <svg width="30" height="30" viewBox="-2 -2 28 28" class="mr-0">
                                    <use xlink:href="#add-btn"></use>
                                </svg>
                                Add Event</button>
                            <button class="btn btn-link">
                                <svg width="30" height="30" viewBox="5 5 50 50" class="mr-0">
                                    <use xlink:href="#calendar"></use>
                                </svg> View in Calendar</button>
                        </div>
                    </div>
                    <div class="extended-body">
                        <div class="calendar-slider-wrapper">
                            <div class="calendar-slider">
                            </div>
                        </div>
                        <div class="calendar-events mb-0">
                            <a href="#" class="events birthdays">
                                <span class="circle"></span>3 birthdays<i class="icon-right-arrow"></i>
                            </a>
                            <a href="#" class="events tasks ">
                                <span class="circle"></span>3 tasks<i class="icon-right-arrow"></i>
                            </a>
                            <a href="#" class="events reminders ">
                                <span class="circle"></span>3 reminders<i class="icon-right-arrow"></i>
                            </a>
                        </div>
                        <div class="calendar-wrapper">
                            <div id='single-calendar-main'></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card allocation-card card-sm">
                <div class="card-body pt-2">
                    <div class="card-title pb-1 border-bottom d-flex align-items-center">
                        <svg width="40" height="40" viewBox="5 5 50 50">
                            <use xlink:href="#logs"></use>
                        </svg>
                        <h5 class="mb-0"> Trade Logs</h5>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-md-5">
                            <canvas id="trade-chart" height="200"></canvas>
                        </div>
                        <div class="col-md-7 mt-3 mt-md-0">
                            <ul class="chart-data">
                                <li>
                                    <div class="left-section">
                                        <div class="circle-indicator"></div>
                                        <h6 class="mb-0">Pending Trades</h6>
                                    </div>
                                    <div class="right-section">
                                        91<i class="icon-link-arrow"></i>
                                    </div>
                                </li>
                                <li>
                                    <div class="left-section">
                                        <div class="circle-indicator warning"></div>
                                        <h6 class="mb-0">Processing Trades</h6>
                                    </div>
                                    <div class="right-section">
                                        91<i class="icon-link-arrow"></i>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card allocation-card card-sm">
                <div class="card-body pt-2">
                    <div class="card-title pb-1 border-bottom d-flex align-items-center">
                        <svg width="40" height="40" viewBox="0 0 50 50">
                            <use xlink:href="#cron-job"></use>
                        </svg>
                        <h5 class="mb-0"> Cron Job Analysis</h5>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-md-5">
                            <canvas id="job-chart" height="200"></canvas>
                        </div>
                        <div class="col-md-7 mt-3 mt-md-0">
                            <ul class="chart-data">
                                <li>
                                    <div class="left-section">
                                        <div class="circle-indicator"></div>
                                        <h6 class="mb-0">Online</h6>
                                    </div>
                                    <div class="right-section">
                                        91<i class="icon-link-arrow"></i>
                                    </div>
                                </li>
                                <li>
                                    <div class="left-section">
                                        <div class="circle-indicator info"></div>
                                        <h6 class="mb-0">Offline</h6>
                                    </div>
                                    <div class="right-section">
                                        91<i class="icon-link-arrow"></i>
                                    </div>
                                </li>
                                <li>
                                    <div class="left-section">
                                        <div class="circle-indicator warning"></div>
                                        <h6 class="mb-0">Needs Attention</h6>
                                    </div>
                                    <div class="right-section">
                                        91<i class="icon-link-arrow"></i>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card allocation-card card-sm">
                <div class="card-body pt-2">
                    <div
                        class="card-title pb-1 border-bottom d-flex align-items-center justify-content-between">
                        <div class=" d-flex align-items-center">
                            <svg width="40" height="40" viewBox="-5 -5 35 35">
                                <use xlink:href="#notification"></use>
                            </svg>
                            <h5 class="mb-0"> Notifications</h5>
                        </div>
                        <a href="#" class="btn btn-link">View All</a>
                    </div>
                    <ul class="nav nav-tabs mb-3" id="notification-tabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" data-toggle="tab" href="#general" role="tab"
                                aria-selected="true">General</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-toggle="tab" href="#reminder" role="tab"
                                aria-selected="false">Reminders</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="general" role="tabpanel">
                            <ul class="alerts-lists">
                                <li>
                                    <h5>The SIP trade for Rakesh Sharma has been approved by RTA</h5>
                                    <div class="info">
                                        <span>02:10 AM</span>
                                        <span>Tuesday, 23rd Mar 2020</span>
                                    </div>
                                </li>
                                <li>
                                    <h5>The SIP trade for Rakesh Sharma has been approved by RTA</h5>
                                    <div class="info">
                                        <span>02:10 AM</span>
                                        <span>Tuesday, 23rd Mar 2020</span>
                                    </div>
                                </li>
                                <li>
                                    <h5>The SIP trade for Rakesh Sharma has been approved by RTA</h5>
                                    <div class="info">
                                        <span>02:10 AM</span>
                                        <span>Tuesday, 23rd Mar 2020</span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-pane fade" id="reminder" role="tabpanel">
                            <ul class="alerts-lists">
                                <li>
                                    <h5>The SIP trade for Rakesh Sharma has been approved by RTA</h5>
                                    <div class="info">
                                        <span>02:10 AM</span>
                                        <span>Tuesday, 23rd Mar 2020</span>
                                    </div>
                                </li>
                                <li>
                                    <h5>The SIP trade for Rakesh Sharma has been approved by RTA</h5>
                                    <div class="info">
                                        <span>02:10 AM</span>
                                        <span>Tuesday, 23rd Mar 2020</span>
                                    </div>
                                </li>
                                <li>
                                    <h5>The SIP trade for Rakesh Sharma has been approved by RTA</h5>
                                    <div class="info">
                                        <span>02:10 AM</span>
                                        <span>Tuesday, 23rd Mar 2020</span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card allocation-card card-sm">
                <div class="card-body pt-2">
                    <div
                        class="card-title pb-1 border-bottom d-flex align-items-center justify-content-between">
                        <div class=" d-flex align-items-center">
                            <svg width="40" height="40" viewBox="8 8 35 35">
                                <use xlink:href="#alert-icon"></use>
                            </svg>
                            <h5 class="mb-0"> Alerts</h5>
                        </div>
                        <a href="#" class="btn btn-link" data-toggle="modal" data-target="#attention">View
                            All</a>
                    </div>
                    <ul class="alerts-lists">
                        <li>
                            <h5>The SIP trade for Rakesh Sharma has been approved by RTA</h5>
                            <div class="info">
                                <span>02:10 AM</span>
                                <span>Tuesday, 23rd Mar 2020</span>
                            </div>
                        </li>
                        <li>
                            <h5>The SIP trade for Rakesh Sharma has been approved by RTA</h5>
                            <div class="info">
                                <span>02:10 AM</span>
                                <span>Tuesday, 23rd Mar 2020</span>
                            </div>
                        </li>
                        <li>
                            <h5>The SIP trade for Rakesh Sharma has been approved by RTA</h5>
                            <div class="info">
                                <span>02:10 AM</span>
                                <span>Tuesday, 23rd Mar 2020</span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('modal')
<div class="modal fade" id="attention" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Needs Attention</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pt-0">
                <div class="table-responsive">
                    <table class="table normal-table mb-0">
                        <thead>
                            <tr>
                                <th>Client Name</th>
                                <th>Remark</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    Jane Doe
                                </td>
                                <td>
                                    Record not found in database
                                </td>
                                <td>
                                    22 Mar 2019
                                </td>
                                <td>
                                    <label for="photo-upload" class="btn upload-btn no-border w-100 mb-0">
                                        <input id="photo-upload" type="file">
                                        <div class="w-100">
                                            <svg class="upload-icon" width="30" height="30" viewBox="0 0 24 24">
                                                <use xlink:href="#upload"></use>
                                            </svg>
                                            <span class="default-text">Upload</span>
                                            <span class="value"></span>
                                        </div>

                                        <a class="delete-icon"><i class="icon-close"></i></a>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Jane Doe
                                </td>
                                <td>
                                    Record not found in database
                                </td>
                                <td>
                                    22 Mar 2019
                                </td>
                                <td>
                                    <label for="photo-upload" class="btn upload-btn no-border w-100 mb-0">
                                        <input id="photo-upload" type="file">
                                        <div class="w-100">
                                            <svg class="upload-icon" width="30" height="30" viewBox="0 0 24 24">
                                                <use xlink:href="#upload"></use>
                                            </svg>
                                            <span class="default-text">Upload</span>
                                            <span class="value"></span>
                                        </div>

                                        <a class="delete-icon"><i class="icon-close"></i></a>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Jane Doe
                                </td>
                                <td>
                                    Record not found in database
                                </td>
                                <td>
                                    22 Mar 2019
                                </td>
                                <td>
                                    <label for="photo-upload" class="btn upload-btn no-border w-100 mb-0">
                                        <input id="photo-upload" type="file">
                                        <div class="w-100">
                                            <svg class="upload-icon" width="30" height="30" viewBox="0 0 24 24">
                                                <use xlink:href="#upload"></use>
                                            </svg>
                                            <span class="default-text">Upload</span>
                                            <span class="value"></span>
                                        </div>

                                        <a class="delete-icon"><i class="icon-close"></i></a>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Jane Doe
                                </td>
                                <td>
                                    Record not found in database
                                </td>
                                <td>
                                    22 Mar 2019
                                </td>
                                <td>
                                    <label for="photo-upload" class="btn upload-btn no-border w-100 mb-0">
                                        <input id="photo-upload" type="file">
                                        <div class="w-100">
                                            <svg class="upload-icon" width="30" height="30" viewBox="0 0 24 24">
                                                <use xlink:href="#upload"></use>
                                            </svg>
                                            <span class="default-text">Upload</span>
                                            <span class="value"></span>
                                        </div>

                                        <a class="delete-icon"><i class="icon-close"></i></a>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Jane Doe
                                </td>
                                <td>
                                    Record not found in database
                                </td>
                                <td>
                                    22 Mar 2019
                                </td>
                                <td>
                                    <label for="photo-upload" class="btn upload-btn no-border w-100 mb-0">
                                        <input id="photo-upload" type="file">
                                        <div class="w-100">
                                            <svg class="upload-icon" width="30" height="30" viewBox="0 0 24 24">
                                                <use xlink:href="#upload"></use>
                                            </svg>
                                            <span class="default-text">Upload</span>
                                            <span class="value"></span>
                                        </div>

                                        <a class="delete-icon"><i class="icon-close"></i></a>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Jane Doe
                                </td>
                                <td>
                                    Record not found in database
                                </td>
                                <td>
                                    22 Mar 2019
                                </td>
                                <td>
                                    <label for="photo-upload" class="btn upload-btn no-border w-100 mb-0">
                                        <input id="photo-upload" type="file">
                                        <div class="w-100">
                                            <svg class="upload-icon" width="30" height="30" viewBox="0 0 24 24">
                                                <use xlink:href="#upload"></use>
                                            </svg>
                                            <span class="default-text">Upload</span>
                                            <span class="value"></span>
                                        </div>

                                        <a class="delete-icon"><i class="icon-close"></i></a>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Jane Doe
                                </td>
                                <td>
                                    Record not found in database
                                </td>
                                <td>
                                    22 Mar 2019
                                </td>
                                <td>
                                    <label for="photo-upload" class="btn upload-btn no-border w-100 mb-0">
                                        <input id="photo-upload" type="file">
                                        <div class="w-100">
                                            <svg class="upload-icon" width="30" height="30" viewBox="0 0 24 24">
                                                <use xlink:href="#upload"></use>
                                            </svg>
                                            <span class="default-text">Upload</span>
                                            <span class="value"></span>
                                        </div>

                                        <a class="delete-icon"><i class="icon-close"></i></a>
                                    </label>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer text-right">
                <button class="btn btn-outline-primary mr-3 btn-lg">Cancel</button>
                <button class="btn btn-primary btn-lg">Save</button>
            </div>
        </div>
    </div>
</div>


@endsection

@section('script')




    <script src="{{ asset('modules/chart.js/dist/chart.min.js') }}"></script>
    <script src="{{ asset('https://unpkg.com/chartjs-chart-venn@next') }}"></script>
    <script src="{{ asset('https://cdn.zingchart.com/zingchart.min.js') }}"></script>
    <script src="{{ asset('modules/tiny-slider/dist/min/tiny-slider.js') }}"></script>
    <script src="{{ asset('modules/fullcalendar/main.js') }}"></script>

    <script>
        $introduction = 91;
		$comprehensive_analysis = 47;
		$account_opening = 25;
		$introduction_comprehensive_analysis = 12;
		$introduction_account_opening = 10;
		$comprehensive_analysis_account_opening = 1;
		$introduction_comprehensive_analysis_account_opening = 41;

        var setdata = [30, 10];
        var data = {
            datasets: [{
                data: setdata,
                backgroundColor: [
                    '#365b58',
                    '#ffd8b3'
                ],
                borderWidth: 4,
                hoverBorderColor: [
                    '#365b58',
                    '#ffd8b3'
                ]
            }],

            // These labels appear in the legend and in the tooltips when hovering different arcs
            labels: [
                'Pending Trades',
                'Processing Trades'
            ],

        };
        var setjobdata = [
            $introduction,$comprehensive_analysis,$account_opening
        ];
        // setjobdata.push($introduction);
        // setjobdata.push($comprehensive_analysis);
        // setjobdata.push($account_opening);

        var jobdata = {
            datasets: [{
                data: setjobdata,
                backgroundColor: [
                    '#365b58',
                    '#28a7c7',
                    '#ffd8b3'
                ],
                borderWidth: 4,
                hoverBorderColor: [
                    '#365b58',
                    '#28a7c7',
                    '#ffd8b3'
                ]
            }],

            // These labels appear in the legend and in the tooltips when hovering different arcs
            labels: [
                'Online',
                'Offline',
                'Needs Attention'
            ],

        };
        var options = {
            onClick: (e) => {
                alert('hello');
            },
            cutoutPercentage: 70,
            plugins: {
                legend: {
                    display: false,
                    fontsize: 1
                }
            }
        }
        var ctx = document.getElementById('trade-chart');
        var myDoughnutChart = new Chart(ctx, {
            type: 'doughnut',
            data: data,
            options: options
        });

        var jobchart = document.getElementById('job-chart');
        var myDoughnutChart = new Chart(jobchart, {
            type: 'doughnut',
            data: jobdata,
            options: options
        });

        var vennData = {
            labels: [
                'Introduction',
                'Comprehensive',
                'Account Opening',
                'Introduction ~ Comprehensive Analysis',
                'Introduction ~ Account Opening',
                'Comprehensive Analysis ~ Account Opening',
                'Introduction ~ Comprehensive Analysis ~ Account Opening',
            ],
            datasets: [
                {
                    label: 'Sports',
                    data: [
                        { sets: ['Introduction'], value: 91, title: 'Introduction' },
                        { sets: ['Comprehensive Analysis'], value: 47 },
                        { sets: ['Account Opening'], value: 25 },
                        { sets: ['Introduction', 'Comprehensive Analysis'], value: 12 },
                        { sets: ['Introduction', 'Account Opening'], value: 10 },
                        { sets: ['Comprehensive Analysis', 'Account Opening'], value: 1 },
                        { sets: ['Introduction', 'Comprehensive Analysis', 'Account Opening'], value: 41 },
                    ],
                    backgroundColor: [
                        '#548989',
                        '#28a7c7',
                        '#edcda6',
                        '#4dafc0',
                        '#8dcac8',
                        '#b1bea5',
                        '#87c0be'
                    ],
                    borderColor: '#ffffff'
                },
            ],
        };

        const vanchart = document.getElementById('vanchart').getContext('2d');

        const chart = new Chart(vanchart, {
            type: 'venn',
            data: vennData,
            options: {
                onClick: (e) => {
                    alert('hello');
                },
                title: {
                    display: true,
                    text: 'Chart.js Venn Diagram Chart',
                },
                plugins: {
                    legend: {
                        display: false,
                        fontsize: 1
                    },
                },
                layout: {
                    padding: {
                        left: 0,
                        right: 0,
                        top: 0,
                        bottom: 0
                    }
                }
            },
        });
        // chart.color.backgroundColor = ['red','blue','green'];

    </script>

    <script>
        function getDaysInMonthUTC(month, year) {
            let date = new Date(Date.UTC(year, month, 1));
            let days = [];
            while (date.getUTCMonth() === month) {
                let data = {
                    date: moment(new Date(date)).format('DD'),
                    month: moment(new Date(date)).format('MMM'),
                    day: moment(new Date(date)).format('ddd'),
                    numericMonth : moment(new Date(date)).format('M')
                }
                days.push(data);
                date.setUTCDate(date.getUTCDate() + 1);
            }
            return days;
        }
        let month = moment(new Date()).format('M');

        let year = moment(new Date()).format('YYYY');
        let date = moment(new Date()).format('DD');
        let monthData = getDaysInMonthUTC(parseInt(month)-1, parseInt(year));

        let sliderData = "";

        monthData.forEach(x => {
            (date + month) == (x.date + x.numericMonth) ? sliderData += '<div class="item active"><strong>' + x.date + ' ' + x.month + '</strong>' + x.day + '</div>' : sliderData += '<div class="item"><strong>' + x.date + ' ' + x.month + '</strong>' + x.day + '</div>';
        });
        $('.calendar-slider').html(sliderData);

    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('single-calendar-main');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                timeZone: 'UTC',
                initialView: 'timeGridDay',
                headerToolbar: {
                    left: '',
                    center: '',
                    right: '',
                },
                views: {
                    timeGridFourDay: {
                        type: 'timeGrid',
                        duration: { days: 1 }
                    },
                },
                events: [
                    {
                        title: 'Trade: Conduct Buy Lumpsum for Ms Rashika Dev',
                        start: '2021-01-16T12:00:00+00:00',
                        end: '2021-01-16T12:30:00+00:00',
                        className: 'tasks'
                    },
                    {
                        title: 'Trade: Conduct Buy Lumpsum for Ms Rashika Dev',
                        start: '2021-01-16T11:00:00+00:00',
                        className: 'reminders'
                    },
                    {
                        title: 'Trade: Conduct Buy Lumpsum for Ms Rashika Dev',
                        start: '2021-01-16T14:00:00+00:00',
                        className: 'request',
                    },
                    {
                        title: 'Trade: Conduct Buy Lumpsum for Ms Rashika Dev',
                        start: '2021-01-16T1208:00:00+00:00',
                        className: 'holidays'
                    },
                    {
                        title: 'Trade: Conduct Buy Lumpsum for Ms Rashika Dev',
                        start: '2021-01-16T15:00:00+00:00',
                        className: 'birthdays'
                    },
                    {
                        title: 'Trade: Conduct Buy Lumpsum for Ms Rashika Dev',
                        start: '2021-01-16T12:30:00+00:00',
                        className: 'reminders'
                    },
                    {
                        title: 'Trade: Conduct Buy Lumpsum for Ms Rashika Dev',
                        start: '2021-01-16',
                        className: 'tasks'
                    },
                    {
                        title: 'Trade: Conduct Buy Lumpsum for Ms Rashika Dev',
                        start: '2021-01-16',
                        className: 'birthdays'
                    },
                    {
                        title: 'Trade: Conduct Buy Lumpsum for Ms Rashika Dev',
                        start: '2021-01-16T17:00:00+00:00',
                        className: 'birthdays'
                    },
                    {
                        title: 'Trade: Conduct Buy Lumpsum for Ms Rashika Dev',
                        start: '2021-01-16T18:00:00+00:00',
                        className: 'tasks'
                    }
                ], eventClick: function (info) {
                    alert('Event: ' + info.event.title + 'Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY + 'View: ' + info.view.type);
                }
            });

            calendar.render();
        });
        var slider = tns({
            "container": ".calendar-slider",
            "items": 7,
            "center": true,
            "loop": false,
            "swipeAngle": false,
            "speed": 400,
            "controls": true,
            "nav": false,
            "slideBy": 1,
            "controlsText": ["<i class='icon-left-arrow'></i>", "<i class='icon-right-arrow'></i>"],
            responsive: {
                320: {
                    items: 4
                },
                500: {
                    items: 7
                }
            }
        });
        slider.goTo(date);
    </script>
@endsection
