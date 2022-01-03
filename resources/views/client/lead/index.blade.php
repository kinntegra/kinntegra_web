@extends('layouts.master')

@section('style')
<style>
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
@endsection


@section('content')
<div class="container-fluid">
    <div class="table-top-section">
        <div class="section-header mb-4">
            <button class="btn btn-primary btn-width-lg" data-toggle="modal"
                data-target="#new-lead-modal">New
                Lead</button>
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
            <div class="col-xl-6 mb-3 mb-xl-0">
                <ul class="nav nav-tabs " id="lead-generation" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="leads-tab" data-toggle="tab" href="#leads" role="tab"
                            aria-controls="leads" aria-selected="true">Leads</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="introduction-tab" data-toggle="tab" href="#introduction"
                            role="tab" aria-controls="introduction" aria-selected="false">Introduction</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="analysis-tab" data-toggle="tab" href="#analysis" role="tab"
                            aria-controls="analysis" aria-selected="false">Comprehensive Analysis</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="opened-tab" data-toggle="tab" href="#opened" role="tab"
                            aria-controls="opened" aria-selected="false">Account Opened</a>
                    </li>
                </ul>
            </div>
            <div class="col-xl-6 pl-xl-0">
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
                        <input type="text" name="dates" class="form-control daterange text-truncate" />
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

        </div>
    </div>
    <div class="tab-content" id="leadsContent">
        <div class="tab-pane fade show active" id="leads" role="tabpanel" aria-labelledby="leads-tab">
            <table class=" responsive nowrap">
                <thead>
                    <tr>
                        <th>Client Name</th>
                        <th>Advisor Name</th>
                        <th>Location</th>
                        <th>Date</th>
                        <th>Actions</th>
                        <th class="text-right">
                            <!-- <button class="btn btn-secondary btn-sm d-none s-xs-block">
                                <i class="icon-down-arrow"></i>
                                Download
                            </button> -->
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($leads) && !empty($leads))
                        @foreach ($leads as $lead)
                            <tr>
                                <td>
                                    <div class="client-name">
                                        <span class="initials">AV</span>
                                        <div class="name">
                                            {{ $lead->client_name }}
                                            <!--<small>(kbs20325066)</small>-->
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $lead->associate_name }} <small>({{ $lead->associate_code }})</small></td>
                                <td>{{ $lead->location }}</td>
                                <td>{{ $lead->created_day }}
                                    <small>{{ $lead->created_time }}</small>
                                </td>
                                <td>Proceed to: <a class="table-link" href="{{ route('introduction.show', $lead->id) }}">Introduction <i
                                            class="icon-right-arrow"></i></a>
                                </td>
                                <td>
                                    <div class="dropdown text-right">
                                        <a class="dropdown-toggle" type="button" id="dropdownMenuButton"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="icon-dots"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right"
                                            aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="javascript:editLogs('{{$lead->id}}');">Edit Lead</a>
                                            <a class="dropdown-item" href="#">Delete Lead</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif

                </tbody>
            </table>
        </div>
        <div class="tab-pane fade" id="introduction" role="tabpanel" aria-labelledby="introduction-tab">
            <table class=" responsive nowrap">
                <thead>
                    <tr>
                        <th>Client Name</th>
                        <th>Advisor Name</th>
                        <th>Location</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($introleads) && !empty($introleads))
                        @foreach ($introleads as $lead)
                        @php
                        $content = [];
                        $content['introduction'] = $lead->id;
                        if($lead->is_reject == 1)
                        {
                            $content['is_verify'] = 2;
                        }

                        @endphp
                        <tr>
                            <td>
                                <div class="client-name">
                                    <span class="initials">AV</span>
                                    <div class="name">
                                        {{ $lead->client_name }}
                                        {{-- <small>(kbs20325066)</small> --}}
                                    </div>
                                </div>
                            </td>
                            <td>{{ $lead->associate_name }} <small>({{ $lead->associate_code }})</small></td>
                            <td><span data-toggle="tooltip" data-placement="right" data-html="true"
                                title="Type <span>Individual</span>">{{ $lead->location }}</span>
                            </td>
                            <td>{{ $lead->created_day }}
                                <small>{{ $lead->created_time }}</small>
                            </td>
                            <td>Proceed to: <a class="table-link" href="{{ route('introduction.show',$content) }}">Introduction <i
                                        class="icon-right-arrow"></i></a>
                                <a class="table-link" href="{{ route('introduction.show', $lead->id) }}">Comprehensive Analysis <i
                                        class="icon-right-arrow"></i></a>
                            </td>

                        </tr>
                        @endforeach
                    @endif


                    {{--
                    <tr>
                        <td>
                            <div class="client-name">
                                <span class="initials danger">AV</span>
                                <div class="name">
                                    Akash Abau Vaidya
                                    <small>(kbs20325066)</small>
                                </div>
                            </div>
                        </td>
                        <td>Ashish Malhotra <small>(kbs20325066)</small></td>
                        <td>Mumbai</td>
                        <td>22 Mar 2019
                            <small>04:20:00 am</small>
                        </td>
                        <td>Proceed to: <a class="table-link" href="#">Introduction <i
                                    class="icon-right-arrow"></i></a>
                            <a class="table-link" href="#">Comprehensive Analysis <i
                                    class="icon-right-arrow"></i></a>
                        </td>

                    </tr>
                    --}}

                </tbody>
            </table>
        </div>
        <div class="tab-pane fade" id="analysis" role="tabpanel" aria-labelledby="analysis-tab">
            <table class=" responsive nowrap">
                <thead>
                    <tr>
                        <th>Client Name</th>
                        <th>Advisor Name</th>
                        <th>Location</th>
                        <th>Tax</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="client-name">
                                <span class="initials">AV</span>
                                <div class="name">
                                    Akash Abau Vaidya
                                    <small>(kbs20325066)</small>
                                </div>
                            </div>
                        </td>
                        <td>Ashish Malhotra <small>(kbs20325066)</small></td>
                        <td>Mumbai</td>
                        <td>Lorem</td>
                        <td>Proceed to: <a class="table-link" href="#">Account Opening <i
                                    class="icon-right-arrow"></i></a>
                        </td>

                    </tr>
                    <tr>
                        <td>
                            <div class="client-name">
                                <span class="initials danger">AV</span>
                                <div class="name">
                                    Akash Abau Vaidya
                                    <small>(kbs20325066)</small>
                                </div>
                            </div>
                        </td>
                        <td>Ashish Malhotra <small>(kbs20325066)</small></td>
                        <td>Mumbai</td>
                        <td>Lorem</td>
                        <td>Proceed to: <a class="table-link" href="#">Account Opening <i
                                    class="icon-right-arrow"></i></a>
                        </td>

                    </tr>
                    <tr>
                        <td>
                            <div class="client-name">
                                <span class="initials info">AV</span>
                                <div class="name">
                                    Akash Abau Vaidya
                                    <small>(kbs20325066)</small>
                                </div>
                            </div>
                        </td>
                        <td>Ashish Malhotra <small>(kbs20325066)</small></td>
                        <td>Mumbai</td>
                        <td>Lorem</td>
                        <td>Proceed to: <a class="table-link" href="#">Account Opening <i
                                    class="icon-right-arrow"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="client-name">
                                <span class="initials warning">AV</span>
                                <div class="name">
                                    Akash Abau Vaidya
                                    <small>(kbs20325066)</small>
                                </div>
                            </div>
                        </td>
                        <td>Ashish Malhotra <small>(kbs20325066)</small></td>
                        <td>Mumbai</td>
                        <td>Lorem</td>
                        <td>Proceed to: <a class="table-link" href="#">Account Opening <i
                                    class="icon-right-arrow"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="client-name">
                                <span class="initials">AV</span>
                                <div class="name">
                                    Akash Abau Vaidya
                                    <small>(kbs20325066)</small>
                                </div>
                            </div>
                        </td>
                        <td>Ashish Malhotra <small>(kbs20325066)</small></td>
                        <td>Mumbai</td>
                        <td>Lorem</td>
                        <td>Proceed to: <a class="table-link" href="#">Account Opening <i
                                    class="icon-right-arrow"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="client-name">
                                <span class="initials">AV</span>
                                <div class="name">
                                    Akash Abau Vaidya
                                    <small>(kbs20325066)</small>
                                </div>
                            </div>
                        </td>
                        <td>Ashish Malhotra <small>(kbs20325066)</small></td>
                        <td>Mumbai</td>
                        <td>Lorem</td>
                        <td>Proceed to: <a class="table-link" href="#">Account Opening <i
                                    class="icon-right-arrow"></i></a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="tab-pane fade" id="opened" role="tabpanel" aria-labelledby="opened-tab">
            <table class=" responsive nowrap">
                <thead>
                    <tr>
                        <th>Client Name</th>
                        <th>Advisor Name</th>
                        <th>Location</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($accountOpenleads) && !empty($accountOpenleads))
                        @foreach ($accountOpenleads as $lead)
                        @php
                        $content = [];
                        $content['introduction'] = $lead->id;
                        if($lead->is_reject == 1)
                        {
                            $content['is_verify'] = 2;
                        }

                        @endphp
                        <tr>
                            <td>
                                <div class="client-name">
                                    <span class="initials">AV</span>
                                    <div class="name">
                                        {{ $lead->client_name }}
                                        {{-- <small>(kbs20325066)</small> --}}
                                    </div>
                                </div>
                            </td>
                            <td>{{ $lead->associate_name }} <small>({{ $lead->associate_code }})</small></td>
                            <td><span data-toggle="tooltip" data-placement="right" data-html="true"
                                title="Type <span>Individual</span>">{{ $lead->location }}</span>
                            </td>
                            <td>{{ $lead->created_day }}
                                <small>{{ $lead->created_time }}</small>
                            </td>
                            {{-- <td>Proceed to: <a class="table-link" href="{{ route('introduction.show',$content) }}">Introduction <i
                                        class="icon-right-arrow"></i></a>
                                <a class="table-link" href="{{ route('introduction.show', $lead->id) }}">Comprehensive Analysis <i
                                        class="icon-right-arrow"></i></a>
                            </td> --}}
                            <td>Proceed to: <a class="table-link" href="{{ route('transaction.index') }}">Transactions <i
                                class="icon-right-arrow"></i></a>
                                <a class="table-link" href="{{ route('introduction.show', $lead->id) }}">Comprehensive Analysis <i
                                        class="icon-right-arrow"></i></a>
                            </td>

                        </tr>
                        @endforeach
                    @endif
                    {{-- <tr>
                        <td>
                            <div class="client-name">
                                <span class="initials">AV</span>
                                <div class="name">
                                    Akash Abau Vaidya
                                    <small>(kbs20325066)</small>
                                </div>
                            </div>
                        </td>
                        <td>Ashish Malhotra <small>(kbs20325066)</small></td>
                        <td>Mumbai</td>
                        <td>Lorem</td>
                        <td>Proceed to: <a class="table-link" href="#">Transactions <i
                                    class="icon-right-arrow"></i></a>
                            <a class="table-link" href="#">Comprehensive Analysis <i
                                    class="icon-right-arrow"></i></a>
                        </td>

                    </tr>
                    <tr>
                        <td>
                            <div class="client-name">
                                <span class="initials danger">AV</span>
                                <div class="name">
                                    Akash Abau Vaidya
                                    <small>(kbs20325066)</small>
                                </div>
                            </div>
                        </td>
                        <td>Ashish Malhotra <small>(kbs20325066)</small></td>
                        <td>Mumbai</td>
                        <td>Lorem</td>
                        <td>Proceed to: <a class="table-link" href="#">Transactions <i
                                    class="icon-right-arrow"></i></a>
                            <a class="table-link" href="#">Comprehensive Analysis <i
                                    class="icon-right-arrow"></i></a>
                        </td>

                    </tr>
                    <tr>
                        <td>
                            <div class="client-name">
                                <span class="initials info">AV</span>
                                <div class="name">
                                    Akash Abau Vaidya
                                    <small>(kbs20325066)</small>
                                </div>
                            </div>
                        </td>
                        <td>Ashish Malhotra <small>(kbs20325066)</small></td>
                        <td>Mumbai</td>
                        <td>Lorem</td>
                        <td>Proceed to: <a class="table-link" href="#">Transactions <i
                                    class="icon-right-arrow"></i></a>
                            <a class="table-link" href="#">Comprehensive Analysis <i
                                    class="icon-right-arrow"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="client-name">
                                <span class="initials warning">AV</span>
                                <div class="name">
                                    Akash Abau Vaidya
                                    <small>(kbs20325066)</small>
                                </div>
                            </div>
                        </td>
                        <td>Ashish Malhotra <small>(kbs20325066)</small></td>
                        <td>Mumbai</td>
                        <td>Lorem</td>
                        <td>Proceed to: <a class="table-link" href="#">Transactions <i
                                    class="icon-right-arrow"></i></a>
                            <a class="table-link" href="#">Comprehensive Analysis <i
                                    class="icon-right-arrow"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="client-name">
                                <span class="initials">AV</span>
                                <div class="name">
                                    Akash Abau Vaidya
                                    <small>(kbs20325066)</small>
                                </div>
                            </div>
                        </td>
                        <td>Ashish Malhotra <small>(kbs20325066)</small></td>
                        <td>Mumbai</td>
                        <td>Lorem</td>
                        <td>Proceed to: <a class="table-link" href="#">Transactions <i
                                    class="icon-right-arrow"></i></a>
                            <a class="table-link" href="#">Comprehensive Analysis <i
                                    class="icon-right-arrow"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="client-name">
                                <span class="initials">AV</span>
                                <div class="name">
                                    Akash Abau Vaidya
                                    <small>(kbs20325066)</small>
                                </div>
                            </div>
                        </td>
                        <td>Ashish Malhotra <small>(kbs20325066)</small></td>
                        <td>Mumbai</td>
                        <td>Lorem</td>
                        <td>Proceed to: <a class="table-link" href="#">Transactions <i
                                    class="icon-right-arrow"></i></a>
                            <a class="table-link" href="#">Comprehensive Analysis <i
                                    class="icon-right-arrow"></i></a>
                        </td>
                    </tr> --}}
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection


@section('modal')
<div class="modal fade" id="new-lead-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticLeadLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticLeadLabel">New Lead</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="lead_creation" method="post" action="{{ route('leads.store') }}">
                @csrf
                <input type="hidden" name="id" id="lead_id">
                <input type="hidden" name="client_profile_id" id="client_profile_id">

                <div class="modal-body">
                    <div class="row form-sections mb-0">
                        <input type="hidden" name="lead_edit" id="lead_edit" value="0">
                        <input type="hidden" name="employee_code" id="employee_code" value="">
                        <input type="hidden" name="has_employee" value="{{ isset($employees) && !empty($employees) ? 1 : 0}}">
                        <input type="hidden" name="user_associate" value="{{ isset($user_associate) && !empty($user_associate) ? 1 : 0}}">
                        <input type="hidden" name="account_type" id="account_type" value="1">
                        <div class="col-12">
                            <h4 class="form-section-title text-primary text-uppercase">Other Details</h4>
                        </div>
                        @if(Auth::user()->in_house == 1)

                        <div class="col-md-4 col-sm-6 associate_id">
                            <div class="form-group">
                                <!--List of Employee for Selected Associate-->
                                <label for="associate_id">Associate Name <span
                                        class="required-sign">*</span></label>
                                <div class="select-wrapper exclude">
                                    <select class="form-control" id="associate_id"name="associate_id">
                                        <option value=""  @if(!isset($data->associate_id)) {{'disabled selected'}} @endif >Select Associate</option>
                                        @foreach ($associates as $associate)
                                            <option value="{{$associate->id}}">{{ $associate->entity_name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 employee_id">
                            <div class="form-group">
                                <!--List of Employee for Selected Associate-->
                                <label for="employee_id">Employee Name <span
                                        class="required-sign">*</span></label>
                                <div class="select-wrapper exclude">
                                    <select class="form-control" id="employee_id" name="employee_id" readonly="true">
                                        <option value="" disabled selected>Select Employee</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        @else

                        <input type="hidden" name="associate_id" id="associate_id" value="{{ $user_associate->id }}">
                        @if(isset($employees) && !empty($employees))

                        <div class="col-md-4 col-sm-6 employee_id">
                            <div class="form-group">
                                <!--List of Employee for Selected Associate-->
                                <label for="employee_id">Employee Name <span
                                        class="required-sign">*</span></label>
                                <div class="select-wrapper exclude">
                                    <select class="form-control" id="employee_id" name="employee_id">
                                        <option value="" disabled selected>Select Employee</option>
                                        @foreach ($employees as $employee)
                                            <option value="{{$employee->id}}">{{ $employee->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="col-md-4 col-sm-6 account_type">
                            <div class="form-group">
                                <!--List of Employee for Selected Associate-->
                                <label for="account_type">Account Type <span
                                        class="required-sign">*</span></label>
                                <div class="select-wrapper exclude">
                                    <select class="form-control" id="account_type" name="account_type">
                                        <option value="" disabled selected>Select Account Type</option>
                                        <option value="1">Individual</option>
                                        <option value="2">Non Individual</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        @endif

                    </div>
                    <div class="row form-sections">
                        <div class="col-12">
                            <h4 class="form-section-title text-primary text-uppercase">Personal Information</h4>
                        </div>
                        <div class="col-md-4 col-sm-6 first_name individual">
                            <div class="form-group">
                                <label for="first_name">First Name</label>
                                <input type="text" class="form-control" id="first_name" name="first_name" autocomplete="first_name"/>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 last_name individual">
                            <div class="form-group">
                                <label for="last_name">Last Name</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" autocomplete="last_name"/>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 gender individual">
                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <div class="select-wrapper">
                                    <select class="form-control" id="gender" name="gender">
                                        <option value="" disabled selected>Select Gender</option>
                                        <option value="MALE">Male</option>
                                        <option value="FEMALE">Female</option>
                                        <option value="OTHER">Other</option>
                                    </select>
                                </div>

                            </div>
                        </div>
                        {{-- <div class="col-md-4 col-sm-6 cname nonindividual">
                            <div class="form-group">
                                <label for="cname">COMPANY NAME</label>
                                <input type="text" class="form-control" id="cname" name="cname" autocomplete="cname"/>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 cauthname1 nonindividual">
                            <div class="form-group">
                                <label for="cauthname1">AUTHORIZED SIGNITORY NAME</label>
                                <input type="text" class="form-control" id="cauthname1" name="cauthname1" autocomplete="cauthname1"/>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 cauthdesignation1 nonindividual">
                            <div class="form-group">
                                <label for="cauthdesignation1">DESIGNATION</label>
                                <input type="text" class="form-control" id="cauthdesignation1" name="cauthdesignation1" autocomplete="cauthdesignation1"/>
                            </div>
                        </div> --}}
                        <div class="col-md-4 col-sm-6 mobile">
                            <div class="form-group">
                                <label for="mobile">Mobile Number</label>
                                <input type="text" class="form-control" id="mobile" name="mobile" />
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 email">
                            <div class="form-group">
                                <label for="email">Email ID</label>
                                <input type="text" class="form-control" id="email" name="email" />
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 country">
                            <div class="form-group">
                                <label for="country">Country</label>
                                <div class="select-wrapper">
                                    <select class="form-control" id="country" name="country">
                                        <option value="" disabled selected>Select Country</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}" @if(isset($data->address->country) && $country->id == $data->address->country) {{'selected'}} @elseif($country->id == 98) {{'selected'}} @endif>{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row form-sections mb-0">
                        <div class="col-12">
                            <h4 class="form-section-title text-primary text-uppercase">Address Details</h4>
                        </div>
                        <input type="hidden" name="addresstype_id" value="2" id="addresstype_id">
                        <input type="hidden" name="subtype_id" value="1" id="subtype_id">
                        <div class="col-md-4 col-sm-6 address1">
                            <div class="form-group">
                                <label for="address1">Address Line 1</label>
                                <input type="text" class="form-control" id="address1" name="address1" />
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 address2">
                            <div class="form-group">
                                <label for="address2">Address Line 2</label>
                                <input type="text" class="form-control" id="address2" name="address2" />
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 address3">
                            <div class="form-group">
                                <label for="address3">Address Line 3</label>
                                <input type="text" class="form-control" id="address3" name="address3" />
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 city">
                            <div class="form-group">
                                <label for="city">City</label>
                                <input type="text" class="form-control" id="city" name="city" />
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 state">
                            <div class="form-group">
                                <label for="validity">State</label>
                                <div class="select-wrapper exclude">
                                    <select class="form-control" id="state" name="state">
                                        <option value="" disabled selected>Select State</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 pincode">
                            <div class="form-group">
                                <label for="pincode">Pincode</label>
                                <input type="text" class="form-control" id="pincode" name="pincode" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="d-flex justify-content-between d-sm-block w-100 text-right">
                        <button type="button" class="btn btn-outline-primary col-sm-2 col-5"
                            data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary col-sm-3 col-6 ml-sm-3">Save Changes</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>


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
                            <h4 class="form-section-title text-uppercase text-grey">Filter By Location</h4>
                        </div>
                        <div class="col-12 d-flex flex-wrap">
                            <div class="form-group custom-checkbox mr-3">
                                <input type="checkbox" id="Mumbai">
                                <label for="Mumbai">Mumbai</label>
                            </div>
                            <div class="form-group custom-checkbox mr-3">
                                <input type="checkbox" id="Mumbai">
                                <label for="Mumbai">Mumbai</label>
                            </div>
                            <div class="form-group custom-checkbox mr-3">
                                <input type="checkbox" id="Mumbai">
                                <label for="Mumbai">Mumbai</label>
                            </div>
                            <div class="form-group custom-checkbox mr-3">
                                <input type="checkbox" id="Mumbai">
                                <label for="Mumbai">Mumbai</label>
                            </div>
                            <div class="form-group custom-checkbox mr-3">
                                <input type="checkbox" id="Mumbai">
                                <label for="Mumbai">Mumbai</label>
                            </div>
                            <div class="form-group custom-checkbox mr-3">
                                <input type="checkbox" id="Mumbai">
                                <label for="Mumbai">Mumbai</label>
                            </div>
                        </div>

                    </div>
                    <div class="row form-sections">
                        <div class="col-12">
                            <h4 class="form-section-title text-uppercase text-grey">Filter By Location</h4>
                        </div>
                        <div class="col-12 d-flex flex-wrap">
                            <div class="form-group custom-checkbox mr-3">
                                <input type="checkbox" id="Mumbai">
                                <label for="Mumbai">Mumbai</label>
                            </div>
                            <div class="form-group custom-checkbox mr-3">
                                <input type="checkbox" id="Mumbai">
                                <label for="Mumbai">Mumbai</label>
                            </div>
                            <div class="form-group custom-checkbox mr-3">
                                <input type="checkbox" id="Mumbai">
                                <label for="Mumbai">Mumbai</label>
                            </div>
                            <div class="form-group custom-checkbox mr-3">
                                <input type="checkbox" id="Mumbai">
                                <label for="Mumbai">Mumbai</label>
                            </div>
                            <div class="form-group custom-checkbox mr-3">
                                <input type="checkbox" id="Mumbai">
                                <label for="Mumbai">Mumbai</label>
                            </div>
                            <div class="form-group custom-checkbox mr-3">
                                <input type="checkbox" id="Mumbai">
                                <label for="Mumbai">Mumbai</label>
                            </div>
                        </div>

                    </div>
                    <div class="row form-sections mb-0">
                        <div class="col-12">
                            <h4 class="form-section-title text-uppercase text-grey">Filter By Location</h4>
                        </div>
                        <div class="col-12 d-flex flex-wrap">
                            <div class="form-group custom-checkbox mr-3">
                                <input type="checkbox" id="Mumbai">
                                <label for="Mumbai">Mumbai</label>
                            </div>
                            <div class="form-group custom-checkbox mr-3">
                                <input type="checkbox" id="Mumbai">
                                <label for="Mumbai">Mumbai</label>
                            </div>
                            <div class="form-group custom-checkbox mr-3">
                                <input type="checkbox" id="Mumbai">
                                <label for="Mumbai">Mumbai</label>
                            </div>
                            <div class="form-group custom-checkbox mr-3">
                                <input type="checkbox" id="Mumbai">
                                <label for="Mumbai">Mumbai</label>
                            </div>
                            <div class="form-group custom-checkbox mr-3">
                                <input type="checkbox" id="Mumbai">
                                <label for="Mumbai">Mumbai</label>
                            </div>
                            <div class="form-group custom-checkbox mr-3">
                                <input type="checkbox" id="Mumbai">
                                <label for="Mumbai">Mumbai</label>
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

    <div class="modal fade" id="successModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel1" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content  text-center">

                <div class="modal-body">
                    <div class="row form-sections">

                        <div class="col-12">
                            <h1>Hooray!!!</h1>
                            <h4 class="form-section-title text-uppercase text-grey">New Lead Created Successfully</h4>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="display: block">
                    <button type="button" class="btn btn-outline-primary"
                            data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')

<script type="text/javascript" src="{{ asset('assets/javascript/leads.js') }}"></script>

@endsection
