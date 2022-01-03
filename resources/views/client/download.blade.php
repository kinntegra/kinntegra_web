@extends('layouts.master')

@section('style')

<style>

.mandate-list .row:first-child .delete-mandate {
    display: block;
}

    input[type="checkbox"][readonly],div[readonly] {
  pointer-events: none;
}
    .account_type {
        display: none;
    }
    .edit-now {
        font-size: 12px;
        font-weight: 600;
        font-style: italic;
    }
    .edit-now:hover {
        cursor: pointer;
        color: #1a2b2a;
        text-decoration: underline;
    }
    .normal-table tbody tr td{
        padding: 0.75rem;
    }
    .aprofile.invalid td:nth-child(1) {
    color:#dc3a3a;}

    .aprofile.invalid td.select.invalid .select2-selection--single {
    border: 1px solid #c44d4d !important;
    }
td label.error {
    font-size: 80%;
    font-weight: 400;
    color: #dc3a3a;
    position: absolute;
    /* top: 100%;
    left: 0;
    width: 100%; */
    text-transform: capitalize;
}

/*Select2 ReadOnly Start*/
        select[readonly].select2-hidden-accessible+.select2-container {
           touch-action: none;pointer-events: none;
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

        .readonly {
            pointer-events: none;
        }
        .bb-0{
            border-bottom : 0 !important;
        }
    /* #company_detail .remove-company .icon-close{
        color: #ffffff;
    } */
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
                @php
                    $individual_count = 0;
                    $nonindividual_count = 0;
                    foreach ($client->account_profiles as $profile) {
                        if($profile->account_type == 1)
                        {
                            $individual_count++;
                        }else{
                            $nonindividual_count++;
                        }
                    }
                    //dd( $individual_count,$nonindividual_count);
                    //dd($client);
                @endphp

                <form class="col-lg-8 col-xl-9 step-forms col-md-8 pl-0" id="client_download" method="POST" action="{{ route('download.store') }}">
                    @csrf
                    <input type="hidden" name="id" id="client_id" value="{{ @$client_id }}">
                    <input type="hidden" name="client_edit" id="client_edit" value="1">
                    <input type="hidden" name="is_verify" id="is_verify" value="{{ $is_verify }}">
                    <input type="hidden" name="step_edit" id="step_edit" value="1">
                    <input type="hidden" name="is_download" id="is_download" value="1">
                    <input type="hidden" name="individual_count" id="individual_count" value="{{ $individual_count }}">
                    <input type="hidden" name="nonindividual_count" id="nonindividual_count" value="{{ $nonindividual_count }}">
                    <input type="hidden" name="active_account" id="active_account" value="">

                    <section class="trial active" id="download" data-step="1" autocomplete="off">
                        <div class="form-inner-section">
                            <div class="form-header">
                                <h3 class="card-title"><i class="icon-left-arrow back-btn back_to_mandate"></i>Download</h3>
                            </div>
                            <div class="form-content">
                                {{-- <ul class="nav nav-tabs download-tabs mb-5" id="account-download" role="tablist"> --}}
                                <ul class="nav nav-tabs accounts-tab no-wrap" id="account-download" role="tablist">
                                    @if(isset($client->accountsdata) && !empty($client->accountsdata))
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($client->accountsdata as $headaccount)
                                        {{-- @if($headaccount->mandates_count > 0) --}}
                                            @php
                                                $name = '';

                                                $accounttype = ['JOINT','ANYONE OR SURVIVOR'];
                                                if (in_array($headaccount->account_type, $accounttype))
                                                {

                                                    if(!empty($headaccount->first_holder_name)){
                                                        $name .=  $headaccount->first_holder_name;
                                                    }
                                                    if(!empty($headaccount->second_holder_name)){
                                                        $name .= ' + ';
                                                        $name .=  $headaccount->second_holder_name;
                                                    }
                                                    if(!empty($headaccount->third_holder_name)){
                                                        $name .= ' + ';
                                                        $name .=  $headaccount->third_holder_name;
                                                    }
                                                }else{
                                                    $name .=  $headaccount->first_holder_name;
                                                }

                                            @endphp
                                            @if($headaccount->bse_export_status == 1)
                                            {{-- <li class="nav-item" role="presentation">
                                                <a class="nav-link @if($i == 1){{ 'active' }}@endif download-link" data-toggle="tab" href="#download_account{{ $headaccount->id }}"
                                                    role="tab" aria-controls="member{{$i}}" aria-selected="true">{{ $name }}</a>
                                            </li> --}}
                                            <li class="nav-item mb-3" role="presentation">
                                                <a class="nav-link @if($i == 1) {{'active'}} @endif pr-4 download-link" data-toggle="tab"
                                                    href="#download_account{{ $headaccount->id }}" data-accountid="{{ $headaccount->id }}" role="tab" aria-selected="true">{{ $name }}</a>
                                            </li>
                                            @endif
                                            @php
                                                $i++;
                                            @endphp
                                        {{-- @endif --}}
                                    @endforeach
                                    @endif
                                </ul>
                                <div class="tab-content download-tab">
                                    @if(isset($client->accountsdata) && !empty($client->accountsdata))
                                    @php
                                        $j = 1;
                                    @endphp
                                    @foreach ($client->accountsdata as $bodyaccount)
                                    {{-- @if($bodyaccount->mandates_count > 0) --}}
                                    <div class="tab-pane fade show @if($j == 1){{ 'active' }}@endif" id="download_account{{ $bodyaccount->id }}"
                                        role="tabpanel" aria-labelledby="goal-member{{$j}}-tab">
                                        <div class="row flex-column">
                                            <div class="col-xl-3 col-lg-6 col-sm-6">
                                                <div class="form-group">
                                                    <label for="download-aof-{{$j}}">Download AOF</label>
                                                    @php
                                                        $url = url('/client/download?url='.$bodyaccount->aof_file_url);
                                                        $filename = basename($url);
                                                        $letter_engagement_url = url('/client/download?url='.$bodyaccount->letter_engagement_url);
                                                        //$url = env('APP_URL').'/client/download?url='.$url;
                                                        //dd($url);
                                                    @endphp
                                                    <a href="{{ $url }}">
                                                        <label for="download-aof-{{$j}}" class="btn download-btn w-100">

                                                                <div class="left-side">
                                                                    <svg width="40" height="40" viewBox="0 0 38 38">
                                                                        <use xlink:href="#xls" />
                                                                    </svg>

                                                                    <span class="value">{{$bodyaccount->aof_pdf_file_name}}</span>

                                                                </div>
                                                                <svg class="upload-icon" width="30" height="30" viewBox="0 0 24 24">
                                                                    <use xlink:href="#download" />
                                                                </svg>

                                                        </label>
                                                    </a>
                                                </div>
                                            </div>
                                            @if($bodyaccount->mandates_count > 0)
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="download-mandate-{{$j}}">Download Mandate</label>
                                                    <div class="row">

                                                        @foreach ($bodyaccount->mandates as $mandate)
                                                        @php
                                                            $url = url('/client/download?url='.$mandate->mandate_file_url);
                                                            $filename = basename($url);
                                                        @endphp
                                                        <div class="col-xl-3 col-lg-6 col-sm-6 mb-3 mb-md-0">
                                                            <a href="{{ $url }}">
                                                                <label for="download-mandate-{{$j}}" class="btn download-btn w-100">
                                                                    <div class="left-side">
                                                                        <svg width="40" height="40"
                                                                            viewBox="0 0 38 38">
                                                                            <use xlink:href="#xls" />
                                                                        </svg>
                                                                        <span class="value">{{ $filename }}</span>
                                                                    </div>
                                                                    <svg class="upload-icon" width="30"
                                                                        height="30" viewBox="0 0 24 24">
                                                                        <use xlink:href="#download" />
                                                                    </svg>
                                                                </label>
                                                            </a>
                                                        </div>
                                                        @endforeach
                                                        {{-- <div class="col-xl-3 col-lg-6 col-sm-6  mb-3 mb-md-0">
                                                            <label for="download-mandate"
                                                                class="btn download-btn w-100">
                                                                <div class="left-side">
                                                                    <svg width="40" height="40"
                                                                        viewBox="0 0 38 38">
                                                                        <use xlink:href="#xls" />
                                                                    </svg>
                                                                    <span class="value">w3t3266.pdf</span>
                                                                </div>
                                                                <svg class="upload-icon" width="30"
                                                                    height="30" viewBox="0 0 24 24">
                                                                    <use xlink:href="#download" />
                                                                </svg>
                                                            </label>
                                                        </div> --}}
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            <div class="col-xl-3 col-lg-6 col-sm-6">
                                                <div class="form-group">
                                                    <label for="download-letter-{{$j}}">Download Letter of Engagement</label>
                                                    <a href="{{ $letter_engagement_url }}">
                                                    <label for="download-letter-{{$j}}"
                                                        class="btn download-btn w-100">
                                                        <div class="left-side">
                                                            <svg width="40" height="40" viewBox="0 0 38 38">
                                                                <use xlink:href="#xls" />
                                                            </svg>
                                                            <span class="value">letterofengagement.pdf</span>
                                                        </div>
                                                        <svg class="upload-icon" width="30" height="30"
                                                            viewBox="0 0 24 24">
                                                            <use xlink:href="#download" />
                                                        </svg>
                                                    </label>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @php
                                        $j++;
                                    @endphp
                                    {{-- @endif --}}
                                    @endforeach
                                    @endif

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
@php
   // dd($client);
@endphp

@endsection

@section('script')
<script type="text/javascript" src="{{ asset('assets/javascript/client.js') }}"></script>
{{-- <script type="text/javascript" src="{{ asset('assets/javascript/clientdownload.js') }}"></script> --}}

<script>
    $('a.download').click(function(e) {
        e.preventDefault();  //stop the browser from following
        var link = $(this).attr('href');
        // $.get('/client/download', {url:link}, function (data, textStatus, jqXHR) {
        //     console.log(data);
        // });
    });
    $('#client_download .trial button.proceed').click(function (e) {
        let id = $('#client_id').val();
        let post = $('form#client_download').attr('method');
        let url = $('form#client_download').attr('action');
        let formData = new FormData($('#client_download')[0]);
        $.ajax({
            type: post,
            url: url,
            data: formData,
            //async: false,
            beforeSend: function() {
                $('#loading').show();
            },
            success:function(data) {
                console.log(data);//return false;
                if($("#is_verify").val() == 1 || $("#is_verify").val() == 2)
                {
                    window.location.href = '/client/upload/'+id+'?is_verify='+$("#is_verify").val();
                }else{
                    window.location.href = '/client/upload/'+id;
                }
                //window.location.href = '/client/upload/'+data.id;

            },
            error: function(xhr, textStatus, thrownError)
            {
                $('#loading').hide();
                //console.log(xhr);
                var response = jQuery.parseJSON(xhr.responseText);
                console.log(response);
                if(response.server_errors)
                {
                    let error_data = '<ul class="alerts-lists">';
                    console.log(response.server_errors);
                    if (response.server_errors.length === undefined || response.server_errors.length === null) {
                        $.each( response.server_errors, function( k, v ) {
                            error_data += '<li>'+v+'</li>';
                        });
                    }else{
                        error_data += response.server_errors;
                    }

                    error_data += '</ul>';
                    $("#error_modal .card .card-body").html(error_data);
                    $('#error_modal').modal('show');
                }
            },
            cache: false,
            contentType: false,
            processData: false,
            //timeout: 8000,
        });
    });

</script>
@endsection
