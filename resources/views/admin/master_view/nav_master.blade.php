@extends('layouts.master')

@section('style')
<style>
    .dataTables_length,.dataTables_filter{
        display: none;
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
        {{-- <h3 class="section-title mb-4 d-flex justify-content-between">Introduction
            <button class="btn btn-link d-md-none" id="toggleMenu">Admin Menu</button>
        </h3> --}}
        <div class="card mb-4">
            {{-- <div class="card-header">
                <h5 class="card-title mb-0">Add</h5>
            </div> --}}
            <div class="card-body">
                @if(session()->has('success'))
                    <div class="alert alert-success fade show tr-position" role="alert">
                        <div class="alert-icon"><i class="flaticon-warning"></i></div>
                        @foreach(session()->get('success') as $message)
                        <div class="alert-text">{{ $message }}</div>
                        @endforeach
                        <div class="alert-close">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true"><i class="la la-close"></i></span>
                            </button>
                        </div>
                    </div>
                @endif
                <div class="row">
                    <div class="col-lg-12 col-md-12 ">
                        <div class="table-top-section">
                            <ul class="nav nav-tabs mb-4" id="master_uploads_tabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" data-toggle="tab" href="#scheme-master"
                                        role="tab" aria-selected="true">Master Net Asset Value(NAV)</a>
                                </li>
                            </ul>
                        </div>
                        <div class="admin-body">
                            <div class="tab-content" id="master_uploads_view">
                                <div class="tab-pane fade active show" id="scheme-master" role="tabpanel">
                                    <table class="no-shadow responsive nowrap">
                                        <thead>
                                            <tr>
                                                <th>Nav Date</th>
                                                <th>Scheme Code</th>
                                                <th>Scheme Name</th>
                                                <th>RTA Scheme Code</th>
                                                <th>Div Reinvestflag</th>
                                                <th>ISIN</th>
                                                <th>Nav Value</th>
                                                <th>RTA Code</th>
                                                <th class="text-right">
                                                    action
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>


                                        </tbody>
                                    </table>
                                </div>
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
<div class="modal fade" id="ViewUpdateModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
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
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group mb-3 mb-sm-0">
                                        <label>Account type*</label>
                                        <input type="text" readonly
                                            class="form-control-plaintext font-bold"
                                            value="Single">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group mb-3 mb-sm-0">
                                        <label>First Holder</label>
                                        <input type="text" readonly
                                            class="form-control-plaintext font-bold"
                                            value="Ashish Jaiswal">
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-sm-12 ">

                                    <div class="form-sections mt-5 mb-0">
                                        <h4 class="form-section-title text-uppercase">
                                            NOMINEE
                                            DETAILS</h4>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div
                                                    class="form-group mb-3 mb-sm-0">
                                                    <label>First Holder</label>
                                                    <input type="text" readonly
                                                        class="form-control-plaintext font-bold"
                                                        value="Dinesh Jaiswal">
                                                </div>
                                            </div>
                                            <div class="col-sm-4">

                                                <div
                                                    class="form-group mb-3 mb-sm-0">
                                                    <label>First Holder</label>
                                                    <input type="text" readonly
                                                        class="form-control-plaintext font-bold"
                                                        value="Father">
                                                </div>

                                            </div>
                                            <div class="col-sm-4">
                                                <div
                                                    class="form-group mb-3 mb-sm-0">
                                                    <label>First Holder</label>
                                                    <input type="text" readonly
                                                        class="form-control-plaintext font-bold"
                                                        value="Manjit Singh">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group mb-3 mb-sm-0">
                                        <label>First Holder</label>
                                        <input type="text" readonly
                                            class="form-control-plaintext font-bold"
                                            value="HDFC Bank Ltd">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group mb-3 mb-sm-0">
                                        <label>First Holder</label>
                                        <input type="text" readonly
                                            class="form-control-plaintext font-bold"
                                            value="Axis Bank Ltd">
                                    </div>
                                </div>
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
<script>
    $(function () {

var table = $('#scheme-master table').DataTable({
    processing: true,
    serverSide: true,
    ajax: "{{ route('nav_upload.index') }}",
    columns: [
        {data: 'nav_date', name: 'nav_date'},
        {data: 'scheme_code', name: 'scheme_code'},
        {data: 'scheme_name', name: 'scheme_name'},
        {data: 'rta_scheme_code', name: 'rta_scheme_code'},
        {data: 'div_reinvestflag', name: 'div_reinvestflag'},
        {data: 'isin', name: 'isin'},
        {data: 'nav_value', name: 'nav_value'},
        {data: 'rta_code', name: 'rta_code'},
        {data: 'action', name: 'action', orderable: false, searchable: false},
    ]
});
});

function viewEditFunction($id,$target)
{
    $("#ViewUpdateModal").modal('show');
}


</script>
@endsection
