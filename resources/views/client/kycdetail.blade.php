@extends('layouts.master')

@section('style')
<style>
    div.error {
        font-size: 80%;
        font-weight: 400;
        color: #ce4b4b;
        position: absolute;
        top: 100%;
        left: 0;
        width: 100%;
        text-transform: capitalize;
    }
    .completed.skip{
        cursor: pointer;
    }
    .skip{
        cursor: inherit;
    }

    </style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="table-top-section d-flex justify-content-between align-items-center mb-4">
        <a class="back-btn" href="{{ url()->previous() }}">
            <i class="icon-left-arrow"></i>
            Go Back
        </a>
        <div class="section-header ">

            @include('partials.top')

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

                <form class="col-lg-8 col-xl-9 step-forms col-md-8 pl-0" id="client_kycdetail" method="POST" action="{{ route('kycdetail.store') }}">
                    @csrf
                    <input type="hidden" name="id" id="client_id" value="{{ $client->id }}">
                    <input type="hidden" name="client_edit" id="client_edit" value="0">
                    <input type="hidden" name="is_kyc_detail" id="is_kyc_detail" value="1">
                    <input type="hidden" name="is_verify" id="is_verify" value="{{ $is_verify }}">
                    <section class="trial active" id="account-opening" autocomplete="off">
                        <div class="form-inner-section">
                            <div class="form-header">
                                <h3 class="card-title"><i class="icon-left-arrow back-btn  @if($client->is_comprehensive == 1) {{'back_to_comprehensive'}} @else {{'back_to_introduction'}} @endif"></i> Account Opening</h3>
                            </div>
                            <div class="form-content">
                                <div class="form-sections">
                                    <h4 class="form-section-title text-uppercase">Please select a profile
                                        for
                                        account creation</h4>

                                    <div class="form-inline" id="accountprofile">
                                        @foreach ($client->profiles as $profile)
                                        <div class="form-group custom-checkbox checkbox-2" @if($profile->is_account_profile == 1){{'checked'}} @endif>
                                            <input type="checkbox" id="profile_{{$profile->id}}" name="accountprofile[]" value="{{$profile->id}}" @if($profile->is_account_profile == 1){{'checked'}} @endif @if($profile->is_account_holder == true){{'readonly'}}@endif>
                                            <label for="profile_{{$profile->id}}">{{ $profile->name }}</label>
                                        </div>
                                        @endforeach

                                    </div>
                                </div>

                                <div class="indicators mt-4">
                                    <h4 class="form-section-title text-uppercase">Indicators</h4>
                                    <ul>
                                        <li>
                                            <div class="form-group custom-checkbox  mb-0">
                                                <input type="checkbox" disabled checked>
                                                <label>Profile selected for account creation</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-group custom-checkbox  mb-0">
                                                <input type="checkbox" disabled>
                                                <label>Profile not selected for account creation</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-group custom-checkbox checked mb-0">
                                                <!-- <input type="checkbox" id="neha"> -->
                                                <label for="neha">Account already created</label>
                                            </div>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                            <div class="form-footer">
                                <button type="button" class="btn btn-primary btn-lg proceed">Proceed</button>
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

@endsection
@section('script')
<script type="text/javascript" src="{{ asset('assets/javascript/client.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/javascript/kycdetail.js') }}"></script>

@endsection
