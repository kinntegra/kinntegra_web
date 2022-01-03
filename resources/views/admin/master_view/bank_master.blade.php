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
                                    <a class="nav-link active" data-toggle="tab" href="#bank-master"
                                        role="tab" aria-selected="true">Bank Master</a>
                                </li>
                            </ul>
                        </div>

                        <div class="admin-body">

                            <div class="tab-content" id="master_uploads_view">
                                <div class="tab-pane fade active show" id="bank-master" role="tabpanel">
                                    <table class="no-shadow responsive nowrap">
                                        <thead>
                                            <tr>
                                                <th>Bank Name</th>
                                                <th>Ifsc</th>
                                                <th>Mirc</th>
                                                <th>Branch</th>
                                                <th>City</th>
                                                <th>District</th>
                                                <th>State</th>
                                                <th class="text-right">action</th>
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

@endsection

@section('script')
<script>
    $(function () {

    var table = $('#bank-master table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('bank_upload.index') }}",
        columns: [
            {data: 'bank', name: 'bank'},
            {data: 'ifsc', name: 'ifsc'},
            {data: 'micr_code', name: 'micr_code'},
            {data: 'branch', name: 'branch'},
            {data: 'city', name: 'city'},
            {data: 'district', name: 'district'},
            {data: 'state', name: 'state'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
  });
</script>
@endsection
