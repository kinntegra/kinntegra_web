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
                        <div class="admin-body">
                            <ul class="nav nav-tabs mb-4" id="master_uploads_tabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" data-toggle="tab" href="#nav-master"
                                        role="tab" aria-selected="true">Nav Master</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="master_uploads">
                                <div class="tab-pane fade active show" id="nav-master" role="tabpanel">
                                    <div class="card small-card option-2 option-2 mb-4">
                                        <div class="card-header">
                                            <h5 class="card-title mb-0">UPLOAD NEW - NAV MASTER</h5>
                                            @if(isset($date))
                                            <div class="float-right mb-0">
                                                <label>Last Updated date : {{ $date }}<label>
                                            </div>
                                            @endif
                                        </div>
                                        <div class="card-body pt-4 pb-4">
                                            <form enctype="multipart/form-data" id="upload-nav" method="POST" action="{{ route('nav_upload.store') }}">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-xl-4 col-sm-12">
                                                        <div class="form-group mb-3 mb-sm-0">
                                                            <label for="nav_upload">Upload</label>
                                                            <label for="nav_upload" class="btn input-btn w-100">
                                                                <svg width="24" height="24" viewBox="0 0 24 24">
                                                                    <use xlink:href="#upload"></use>
                                                                </svg>
                                                                <input id="nav_upload" type="file" name="nav_upload">
                                                                <div class="value-wrap">
                                                                    <span class="default-text">Upload</span>
                                                                    <span class="value"></span>
                                                                </div>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-primary mt-4">Upload</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            {{-- <div class="card-footer text-right">
                <button class="btn btn-primary btn-lg">Save Changes</button>
            </div> --}}
        </div>
    </div>
</div>

@endsection

@section('modal')

@endsection

@section('script')

@endsection
