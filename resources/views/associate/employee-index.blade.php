@extends('layouts.master')

@section('style')

@endsection

@section('content')
<div class="container-fluid">
    <div class="table-top-section">
        <div class="section-header mb-4">
            <a href="{{ route('employee.create')}}" class="btn btn-primary btn-width-lg" >
                New Employee
            </a>

            @include('partials.top')

        </div>


        <div class="row">
            <div class="col-xl-8 mb-3 mb-xl-0">
                <ul class="nav nav-tabs " id="lead-generation" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="employee-tab" data-toggle="tab" href="#employee"
                            role="tab" aria-controls="employee" aria-selected="true">Employee</a>
                    </li>


                </ul>
            </div>
            <div class="col-xl-4 pl-xl-0">
                <div class="table-options">
                    <div class="input-group mb-3 mb-sm-0">
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

                </div>
            </div>

        </div>
    </div>
    <div class="tab-content" id="leadsContent">
        <div class="tab-pane fade show active" id="employee" role="tabpanel"
            aria-labelledby="employee-tab">
            <table class=" responsive nowrap">
                <thead>
                    <tr>
                        <th>Employee Name</th>
                        @if(Auth::user()->hasRole('superadmin'))
                        <th>Associate Name</th>
                        @endif
                        {{-- <th>Location</th> --}}
                        <th>Department</th>
                        <th>Grade</th>
                        <th>Last Login</th>
                        <th>Status</th>
                        <th class="text-right">

                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employees as $employee)


                    <tr>
                        <td>
                            <div class="client-name">
                                <span class="initials">AV</span>
                                <div class="name">
                                    {{ $employee->name }}

                                </div>
                            </div>
                        </td>
                        @if(Auth::user()->hasRole('superadmin'))
                        <td>{{ $employee->associate_name }}</td>
                        @endif
                        <td>{{ $employee->department_name }}</td>
                        <td>{{ $employee->designation_name }}</td>
                        <td>@if(empty($employee->last_login_at))
                            Not Login Yet
                            @else
                            {{ $employee->last_login_at }}
                            @endif
                        </td>
                        <td>
                            <span class="badge
                            @if($employee->status == 1 || $employee->status == 2)
                            badge-info
                            @elseif($employee->status == 3 || $employee->status == 5 || $employee->status == 10)
                            badge-warning
                            @elseif($employee->status == 4 || $employee->status == 4)
                            badge-danger
                            @elseif($employee->status == 6 || $employee->status == 8)
                            badge-success
                            @else
                            badge-default
                            @endif
                             badge-pill">{{ $employee->status_code }}</span>
                        </td>
                        <td>
                            <div class="dropdown text-right">
                                <a class="dropdown-toggle" type="button" id="dropdownMenuButton"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="icon-dots"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right"
                                    aria-labelledby="dropdownMenuButton">
                                    @if($employee->status > 1)
                                    <a class="dropdown-item" href="{{ route('showEmployeeDetail',[App\Services\MyServices::getencryptNo($employee->associate_id),App\Services\MyServices::getencryptNo($employee->id)]) }}">View Details</a>
                                    @endif
                                    <a class="dropdown-item" href="javascript:showEmployeeLogs('{{App\Services\MyServices::getencryptNo($employee->id)}}');">View Logs</a>
                                    @if($employee->is_active == 0)
                                    <a class="dropdown-item" href="{{ route('associate.employee.edit',[App\Services\MyServices::getencryptNo($employee->associate_id), App\Services\MyServices::getencryptNo($employee->id)]) }}">Edit</a>
                                    @endif
                                    @if($employee->is_active == 1)
                                    <a class="dropdown-item" href="{{ route('associate.employee.edit',[App\Services\MyServices::getencryptNo($employee->associate_id), App\Services\MyServices::getencryptNo($employee->id)]) }}">Update</a>
                                    @endif
                                    @if($employee->status == 8)
                                    <a class="dropdown-item" href="javascript:resetEmployeePassword('{{App\Services\MyServices::getencryptNo($employee->id)}}','{{ $employee->name }}');">Reset Password Link</a>
                                    <a class="dropdown-item text-danger" href="#">Deactivate</a>
                                    @endif
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
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

<div class="modal fade" id="showEmployeeLog" data-backdrop="static" data-keyboard="false" tabindex="-1"
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
                        <h4 class="form-section-title text-uppercase text-grey">Employee Logs</h4>
                    </div>
                    <div class="col-12">
                        <div class="card small-card option-2 mb-4">
                            <div class="card-header">
                                <h6 class="card-title">View Logs</h6>
                            </div>
                            <div class="card-body">
                                <div class="transaction-wrapper trade-status" id="status_log">

                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary col-sm-3"  data-dismiss="modal" aria-label="Close">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="resetPasswordEmployee" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Reset Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="employeeResetPassword">
                @csrf
                <div class="modal-body">
                    <div class="row form-sections">
                        <div class="col-12">
                            <h4 class="form-section-title text-uppercase text-grey" id="employee_password_name"></h4>
                        </div>
                        {{-- <div class="col-12">
                            <div class="card small-card option-2 mb-4">
                                <div class="card-header">
                                    <h6 class="card-title">View Logs</h6>
                                </div>
                                <div class="card-body">
                                    <div class="transaction-wrapper trade-status" id="status_log">

                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        <input type="hidden" name="employee_id" id="employee_password_id" value="">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary col-md-4">Reset Password</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="resetPasswordSuccessEmployee" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Reset Password Link Send Successfully</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

                <div class="modal-body">
                    <div class="row form-sections">

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary col-md-3"  data-dismiss="modal" aria-label="Close">Close</button>
                </div>

        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function () {
        $('input[name="dates"]').daterangepicker();
        var activeTab;
        var table = $('.show table').DataTable({
            bInfo: false,
            sDom: 'lrtip',
            bLengthChange: false,
            retrieve: true,
            autoWidth: false,

            columnDefs: [{
                    responsivePriority: 1,
                    targets: 0
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
                bInfo: false,
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

    function showEmployeeLogs($id)
    {
        $.get("/employee/"+$id+"/logs", function(data, status){
            $("#status_log").empty();
            let emp = '';
            $.each(data, function(i, o){
                emp += '<div class="transaction-steps">';
                emp += '<div class="trade-title mb-2">';
                emp += '<h4 class="mb-0">'+o.user_comment+'</h4>';
                emp += '<div class="info">';
                emp += '<span>'+o.created_time+'</span>';
                emp += '<span>'+o.created_day+'</span>';
                emp += '</div>';
                emp += '</div>';
                emp += '</div>';
            });

            $('#status_log').html(emp);
            $('#showEmployeeLog').modal('show');
        });

    }

    function resetEmployeePassword($id,$name)
    {
        $("#employee_password_id").val($id);
        $("#employee_password_name").html($name);
        $('#resetPasswordEmployee').modal('show');
    }

    $("form#employeeResetPassword").submit(function(e){
        e.preventDefault();

        $id = $('#employee_password_id').val();
        let url = "/employee/"+$id+"/resetpassword";
        //return false;
        // $.get($url, function(data, status){
        //     console.log(data);
        // });
        $.ajax({
            url: url,
            dataType: "json",
            beforeSend: function() {
                $('#loading').show();
            },
            success: function(data) {
                $('#resetPasswordEmployee').modal('hide');
                $('#resetPasswordSuccessEmployee').modal('show');
                $('#loading').hide();
            },
            complete: function() {
                $('#loading').hide();
            }
        });

    return false;
    });
</script>
@endsection
