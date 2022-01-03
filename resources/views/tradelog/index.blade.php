@extends('layouts.master')

@section('style')
@endsection


@section('content')
<div class="container-fluid">
    <div class="table-top-section">
        <div class="section-header mb-4">
            <div class="dropdown text-right">
                <a class="dropdown-toggle profile-img" type="button" data-toggle="dropdown"
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


        <div class="row">
            <div class="col-xl-5 mb-3 mb-xl-0">
                <ul class="nav nav-tabs " id="lead-generation" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="leads-tab" data-toggle="tab" href="#trade-logs"
                            role="tab" aria-selected="true">Trade Logs</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="introduction-tab" data-toggle="tab" href="#other-logs"
                            role="tab" aria-selected="false">Other Logs</a>
                    </li>
                </ul>
            </div>
            <div class="col-xl-7 pl-xl-0">
                <div class="table-options">
                    <div class="searchinput-wrapper mb-3 mb-sm-0">
                        <div class="input-group ">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="table-search">
                                    <svg width="24" height="24" viewBox="0 0 24 24">
                                        <use xlink:href="#search" />
                                    </svg>
                                </span>
                            </div>
                            <input type="text" class="form-control" placeholder="Search"
                                aria-label="table-search" id="tableSearch" aria-describedby="table-search">
                        </div>
                    </div>

                    <div class="input-group mb-3 mb-sm-0">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="month">
                                <svg width="24" height="24" viewBox="0 0 24 24">
                                    <use xlink:href="#month" />
                                </svg>
                            </span>
                        </div>
                        <input type="text" name="dates" class="form-control text-truncate" />
                    </div>

                    <button class="btn btn-icon" data-toggle="modal" data-target="#filterModal">
                        <svg width="40" viewBox="0 0 36 36">
                            <use xlink:href="#filter" />
                        </svg>
                    </button>
                    <div class="table-nav">
                        <button class="btn btn-transparent btn-sm" id="previous" disabled>
                            <i class="icon-left-arrow"></i>
                        </button>
                        <button class="btn btn-transparent btn-sm" id="next">
                            <i class="icon-right-arrow"></i>
                        </button>
                    </div>
                    <button class="btn btn-primary ml-3">
                        <!-- <i class="icon-down-arrow"></i> -->
                        Download
                    </button>
                </div>
            </div>
            @php
                //dd($clients);
            @endphp
        </div>
    </div>
    <div class="tab-content" id="leadsContent">
        <div class="tab-pane fade show active" id="trade-logs" role="tabpanel">
            <table class=" responsive nowrap">
                <thead>
                    <tr>
                        <th>Client Name</th>
                        <th>Portfolio</th>
                        <th>Date</th>
                        <th>Type</th>
                        <th>Amount</th>
                        <th>Payment Mode</th>
                        <th>Advisor</th>
                        <th>Status</th>
                        <th class="text-right">
                            <!-- <button class="btn btn-secondary btn-sm d-none s-xs-block">
                                <i class="icon-down-arrow"></i>
                                Download
                            </button> -->
                        </th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($existingclients as $client)
                        @php
                         //dd($client);
                        @endphp
                        <tr>
                            <td>
                                <div class="client-name">
                                    @php

                                        $name = explode(" ",$client->name);
                                        if(count($name) == 1)
                                        {
                                            $name = $client->name[0].$client->name[1];
                                        }else{
                                            $first = \Arr::First($name);
                                            $last = \Arr::Last($name);
                                            $name = $first[0].$last[0];
                                        }

                                    @endphp
                                    <span class="initials">{{ $name }}</span>
                                    <div class="name">
                                        {{ $client->name }}<br />
                                        <small>({{ $client->ucc }})</small>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $client->fund_category }}</td>
                            <td>{{ $client->new_date }} <br />
                                <small>{{ $client->new_time }}</small>
                            </td>
                            <td class="{{ $client->transaction_type }}">{{ $client->transaction_subtype }}@if($client->client_trade_status == 'Partially Created'){{'*'}}@endif
                            </td>
                            <td>
                                ₹{{ $client->format_amount }}
                            </td>
                            <td>
                                {{ $client->payment_mode }}
                            </td>
                            <td class="text-capitalize">
                                {{ $client->associate_name }}
                            </td>
                            <td class="{{ $client->transaction_status }}">
                                <span class="badge badge-info badge-pill">{{ $client->transaction_substatus }}</span>
                            </td>
                            <td>
                                <div class="dropdown text-right">
                                    <a class="dropdown-toggle" type="button" id="dropdownMenuButton"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="icon-dots"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right"
                                        aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="{{ route('tradelog_group',[App\Services\Security::encryptData($client->trans_buy_clients_id),$client->ucc,$client->trade_type]) }}">View Details</a>
                                        <a class="dropdown-item" href="#">Raise a query</a>
                                        <a class="dropdown-item" href="#">Resend Email</a>
                                        <a class="dropdown-item" href="#">Resend Payment Link</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <div class="tab-pane fade" id="other-logs" role="tabpanel">
            <table class=" responsive nowrap">
                <thead>
                    <tr>
                        <th>Client Name</th>
                        <th>Date</th>
                        <th>Type</th>
                        <th>Serviced by</th>
                        <th>Status</th>
                        <th class="text-right">
                            <!-- <button class="btn btn-secondary btn-sm d-none s-xs-block">
                                <i class="icon-down-arrow"></i>
                                Download
                            </button> -->
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="client-name">
                                <span class="initials">AV</span>
                                <div class="name">
                                    Rakesh Baidya<br />
                                    <small>(kbs20325066)</small>
                                </div>
                            </div>
                        </td>
                        <td>22 Mar 2019 04:20:00 am
                        </td>
                        <td>KYC Update
                        </td>
                        <td>
                            Raghav Swami
                            <small>Advisor</small>
                        </td>
                        <td>
                            <span class="badge badge-success badge-pill">Completed</span>
                        </td>
                        <td>
                            <div class="dropdown text-right">
                                <a class="dropdown-toggle" type="button" id="dropdownMenuButton"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="icon-dots"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right"
                                    aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#">View Details</a>
                                    <a class="dropdown-item" href="#">Raise a query</a>
                                    <a class="dropdown-item" href="#">Resend Email</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="client-name">
                                <span class="initials">AV</span>
                                <div class="name">
                                    Rakesh Baidya<br />
                                    <small>(kbs20325066)</small>
                                </div>
                            </div>
                        </td>
                        <td>22 Mar 2019 04:20:00 am
                        </td>
                        <td>KYC Update
                        </td>
                        <td>
                            Raghav Swami
                            <small>Advisor</small>
                        </td>
                        <td>
                            <span class="badge badge-success badge-pill">Completed</span>
                        </td>
                        <td>
                            <div class="dropdown text-right">
                                <a class="dropdown-toggle" type="button" id="dropdownMenuButton"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="icon-dots"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right"
                                    aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#">View Details</a>
                                    <a class="dropdown-item" href="#">Raise a query</a>
                                    <a class="dropdown-item" href="#">Resend Email</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="client-name">
                                <span class="initials">AV</span>
                                <div class="name">
                                    Rakesh Baidya<br />
                                    <small>(kbs20325066)</small>
                                </div>
                            </div>
                        </td>

                        <td>22 Mar 2019 04:20:00 am
                        </td>
                        <td>KYC Update
                        </td>
                        <td>
                            Raghav Swami
                            <small>Advisor</small>
                        </td>
                        <td>
                            <span class="badge badge-success badge-pill">Completed</span>
                        </td>
                        <td>
                            <div class="dropdown text-right">
                                <a class="dropdown-toggle" type="button" id="dropdownMenuButton"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="icon-dots"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right"
                                    aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#">View Details</a>
                                    <a class="dropdown-item" href="#">Raise a query</a>
                                    <a class="dropdown-item" href="#">Resend Email</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="client-name">
                                <span class="initials">AV</span>
                                <div class="name">
                                    Rakesh Baidya<br />
                                    <small>(kbs20325066)</small>
                                </div>
                            </div>
                        </td>
                        <td>22 Mar 2019 04:20:00 am
                        </td>
                        <td>KYC Update
                        </td>
                        <td>
                            Raghav Swami
                            <small>Advisor</small>
                        </td>
                        <td>
                            <span class="badge badge-success badge-pill">Completed</span>
                        </td>
                        <td>
                            <div class="dropdown text-right">
                                <a class="dropdown-toggle" type="button" id="dropdownMenuButton"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="icon-dots"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right"
                                    aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#">View Details</a>
                                    <a class="dropdown-item" href="#">Raise a query</a>
                                    <a class="dropdown-item" href="#">Resend Email</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="client-name">
                                <span class="initials">AV</span>
                                <div class="name">
                                    Rakesh Baidya<br />
                                    <small>(kbs20325066)</small>
                                </div>
                            </div>
                        </td>
                        <td>22 Mar 2019 04:20:00 am
                        </td>
                        <td>KYC Update
                        </td>
                        <td>
                            Raghav Swami
                            <small>Advisor</small>
                        </td>
                        <td>
                            <span class="badge badge-success badge-pill">Completed</span>
                        </td>
                        <td>
                            <div class="dropdown text-right">
                                <a class="dropdown-toggle" type="button" id="dropdownMenuButton"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="icon-dots"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right"
                                    aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#">View Details</a>
                                    <a class="dropdown-item" href="#">Raise a query</a>
                                    <a class="dropdown-item" href="#">Resend Email</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="client-name">
                                <span class="initials">AV</span>
                                <div class="name">
                                    Rakesh Baidya<br />
                                    <small>(kbs20325066)</small>
                                </div>
                            </div>
                        </td>
                        <td>22 Mar 2019 04:20:00 am
                        </td>
                        <td>KYC Update
                        </td>
                        <td>
                            Raghav Swami
                            <small>Advisor</small>
                        </td>
                        <td>
                            <span class="badge badge-success badge-pill">Completed</span>
                        </td>
                        <td>
                            <div class="dropdown text-right">
                                <a class="dropdown-toggle" type="button" id="dropdownMenuButton"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="icon-dots"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right"
                                    aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#">View Details</a>
                                    <a class="dropdown-item" href="#">Raise a query</a>
                                    <a class="dropdown-item" href="#">Resend Email</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="client-name">
                                <span class="initials">AV</span>
                                <div class="name">
                                    Rakesh Baidya<br />
                                    <small>(kbs20325066)</small>
                                </div>
                            </div>
                        </td>
                        <td>22 Mar 2019 04:20:00 am
                        </td>
                        <td>KYC Update
                        </td>
                        <td>
                            Raghav Swami
                            <small>Advisor</small>
                        </td>
                        <td>
                            <span class="badge badge-success badge-pill">Completed</span>
                        </td>
                        <td>
                            <div class="dropdown text-right">
                                <a class="dropdown-toggle" type="button" id="dropdownMenuButton"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="icon-dots"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right"
                                    aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#">View Details</a>
                                    <a class="dropdown-item" href="#">Raise a query</a>
                                    <a class="dropdown-item" href="#">Resend Email</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="client-name">
                                <span class="initials">AV</span>
                                <div class="name">
                                    Rakesh Baidya<br />
                                    <small>(kbs20325066)</small>
                                </div>
                            </div>
                        </td>
                        <td>22 Mar 2019 04:20:00 am
                        </td>
                        <td>KYC Update
                        </td>
                        <td>
                            Raghav Swami
                            <small>Advisor</small>
                        </td>
                        <td>
                            <span class="badge badge-success badge-pill">Completed</span>
                        </td>
                        <td>
                            <div class="dropdown text-right">
                                <a class="dropdown-toggle" type="button" id="dropdownMenuButton"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="icon-dots"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right"
                                    aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#">View Details</a>
                                    <a class="dropdown-item" href="#">Raise a query</a>
                                    <a class="dropdown-item" href="#">Resend Email</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection


@section('modal')
<div class="modal fade" id="filterModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Filters</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row form-sections">
                    <div class="col-12">
                        <h4 class="form-section-title text-uppercase text-grey">Filter by Clients</h4>
                    </div>
                    <div class="col-12 form-group custom-radio-btn mb-0">
                        <div class="form-check form-check-inline m-0">
                            <input class="form-check-input" type="radio" name="allocation" id="Ascending" value="yes"
                                checked>
                            <label class="form-check-label" for="Ascending">
                                <span class="label">Ascending Alphabetical Order </span>
                            </label>
                        </div>
                        <div class="form-check form-check-inline m-0 ml-3">
                            <input class="form-check-input" type="radio" name="allocation" id="Descending" value="no">
                            <label class="form-check-label" for="Descending">
                                <span class="label">Descending Alphabetical Order </span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row form-sections">
                    <div class="col-12">
                        <h4 class="form-section-title text-uppercase text-grey">Filter By Portfolio</h4>
                    </div>
                    <div class="col-12 d-flex flex-wrap">
                        <div class="form-group custom-checkbox mr-3">
                            <input type="checkbox" id="Wealth">
                            <label for="Wealth">Wealth</label>
                        </div>
                        <div class="form-group custom-checkbox mr-3">
                            <input type="checkbox" id="Tax">
                            <label for="Tax">Tax</label>
                        </div>
                        <div class="form-group custom-checkbox mr-3">
                            <input type="checkbox" id="ShortTerm">
                            <label for="ShortTerm">Short Term</label>
                        </div>
                    </div>

                </div>
                <div class="row form-sections">
                    <div class="col-12">
                        <h4 class="form-section-title text-uppercase text-grey">Filter By Transaction Type</h4>
                    </div>
                    <div class="col-12 d-flex flex-wrap">
                        <div class="form-group custom-checkbox mr-3">
                            <input type="checkbox" id="Buy">
                            <label for="Buy">Buy</label>
                        </div>
                        <div class="form-group custom-checkbox mr-3">
                            <input type="checkbox" id="Sell">
                            <label for="Sell">Sell</label>
                        </div>
                        <div class="form-group custom-checkbox mr-3">
                            <input type="checkbox" id="Switch">
                            <label for="Switch">Switch</label>
                        </div>
                        <div class="form-group custom-checkbox mr-3">
                            <input type="checkbox" id="Offline">
                            <label for="Offline">Offline</label>
                        </div>
                    </div>

                </div>
                <div class="row form-sections">
                    <div class="col-12">
                        <h4 class="form-section-title text-uppercase text-grey">Amount Range</h4>
                    </div>
                    <div class="col-12">
                        <div id="slider"></div>
                    </div>

                </div>
                <div class="row form-sections mb-0">
                    <div class="col-12">
                        <h4 class="form-section-title text-uppercase text-grey">Status</h4>
                    </div>
                    <div class="col-12 d-flex flex-wrap">
                        <div class="form-group custom-checkbox mr-3">
                            <input type="checkbox" id="Pending">
                            <label for="Pending">Pending</label>
                        </div>
                        <div class="form-group custom-checkbox mr-3">
                            <input type="checkbox" id="Processing">
                            <label for="Processing">Processing</label>
                        </div>
                        <div class="form-group custom-checkbox mr-3">
                            <input type="checkbox" id="Admin">
                            <label for="Admin">Approved by Admin</label>
                        </div>
                        <div class="form-group custom-checkbox mr-3">
                            <input type="checkbox" id="Client">
                            <label for="Client">Approved by Client</label>
                        </div>
                        <div class="form-group custom-checkbox mr-3">
                            <input type="checkbox" id="Completed">
                            <label for="Completed">Completed</label>
                        </div>
                        <div class="form-group custom-checkbox mr-3">
                            <input type="checkbox" id="Cancelled">
                            <label for="Cancelled">Cancelled</label>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary col-sm-3">Apply</button>
            </div>
        </div>
    </div>
</div>
@endsection


@section('script')
<script src="{{ asset('modules/nouislider/distribute/nouislider.min.js') }}"></script>
<script>
    var slider = document.getElementById('slider');
    noUiSlider.create(slider, {
        start: [20, 80],
        connect: true,
        tooltips: true,
        range: {
            'min': 0,
            'max': 100
        },
        pips: {
            mode: 'steps',
            density: 2
        }
    });
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
        $('input[name="dates"]').daterangepicker();
        var activeTab;
        var table = $('.show table').DataTable({
            bInfo: true,
            sDom: 'lrtip',
            bLengthChange: false,
            retrieve: true,
            autoWidth: false,
            ordering:false,
            columnDefs: [{
                responsivePriority: 1,
                targets: 0,
            },
            {
                responsivePriority: 1,
                targets: -1,
                orderable: false
            }
            ]
        });
        $('#next').on('click', function () {
            table.page('next').draw('page');
        });
        $('#tableSearch').on('keyup', function () {

            table.search(this.value).draw();
            let info = table.page.info();
            if (info.pages <= 1) {
                $('#next').attr("disabled", true);
                $('#previous').attr("disabled", true);
            } else {
                $('#next').attr("disabled", false);
                $('#previous').attr("disabled", true);
            }
        });
        $('#previous').on('click', function () {
            table.page('previous').draw('page');
        });
        $('.nav-tabs a').on('shown.bs.tab', function (e) {
            $('#tableSearch').val('');
            $('#previous').attr("disabled", true);
            table.destroy();
            table = $(".show table").DataTable({
                bInfo: true,
                sDom: 'lrtip',
                bLengthChange: false,
                retrieve: true,
                autoWidth: false,
                columnDefs: [{
                    responsivePriority: 1,
                    targets: 0,
                    searchable: true
                },
                {
                    responsivePriority: 2,
                    targets: 1,
                    searchable: true
                },
                {
                    responsivePriority: 3,
                    targets: 2,
                    searchable: true
                },
                {
                    responsivePriority: 1,
                    targets: -1,
                    orderable: false
                }
                ]
            });
            let info = table.page.info();
            info.pages == 1 ? $('#next').attr("disabled", true) : $('#next').attr("disabled",
                false);

        })
        $('table').on('page.dt', function () {
            let info = table.page.info();
            if (info.pages - 1 == info.page) {
                $('#next').attr("disabled", true);
                $('#previous').attr("disabled", false);
            } else if (info.page == 0) {
                $('#next').attr("disabled", false);
                $('#previous').attr("disabled", true);
            } else {
                $('#next').attr("disabled", false);
                $('#previous').attr("disabled", false);
            }
        });
    });
</script>
@endsection
