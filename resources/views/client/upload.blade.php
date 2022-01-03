@extends('layouts.master')

@section('style')

<style>
.upload_error{
    font-size: 80%;
    font-weight: 400;
    color: #dc3a3a;
    position: absolute;

}

.mandate-list .row:first-child .delete-mandate {
    display: block;
}
.upload-btn.readonly{
    border: 1px soild;
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
    input[readonly] {
        background-color: #f6f6f6 !important;
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

    label[readonly] {
        background-color: #f6f6f6 !important;
        border: 1px solid #a3a3a3 !important;
        cursor: auto;
        pointer-events: none;
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
                //dd($url_components);
                @endphp

                <div class="col-xl-3 col-lg-4 col-md-4">
                    <div class="custom-wrapper">
                        @include('client.leftbar', ['is_verify' => $is_verify])
                    </div>
                </div>
                @php
                    $individual_count = 0;
                    $nonindividual_count = 0;
                    $is_verified = 0;
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

                <form class="col-lg-8 col-xl-9 step-forms col-md-8 pl-0" id="client_upload" method="POST" action="{{ route('upload.store') }}" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="id" id="client_id" value="{{ @$client_id }}">
                    <input type="hidden" name="client_edit" id="client_edit" value="1">
                    <input type="hidden" name="step_edit" id="step_edit" value="1">
                    <input type="hidden" name="is_upload" id="is_upload" value="1">
                    <input type="hidden" name="is_verify" id="is_verify" value="{{ $is_verify }}">
                    <input type="hidden" name="is_reject" id="is_reject" value="0">
                    <input type="hidden" name="has_new_upload" id="has_new_upload" value="0">
                    <input type="hidden" name="individual_count" id="individual_count" value="{{ $individual_count }}">
                    <input type="hidden" name="nonindividual_count" id="nonindividual_count" value="{{ $nonindividual_count }}">
                    <input type="hidden" name="active_account" id="active_account" value="">
                    <input type="hidden" name="account_count" id="account_count" value="{{ $client->accountsdata_count }}">
                    <section class="trial active" id="upload" data-step="1" autocomplete="off">
                        <div class="form-inner-section">
                            <div class="form-header">
                                <h3 class="card-title"><i class="icon-left-arrow back-btn back_to_upload"></i>Upload</h3>
                            </div>
                            <div class="form-content">

                                <ul class="nav nav-tabs accounts-tab no-wrap" id="account-upload" role="tablist">
                                    @if(isset($client->accountsdata) && !empty($client->accountsdata))
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($client->accountsdata as $headaccount)
                                        {{-- @if($headaccount->mandates_count > 0) --}}
                                            @php
                                                $name = '';
                                                if($headaccount->is_verified_two == 0)
                                                {
                                                    $is_verified++;
                                                }
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
                                            <li class="nav-item  mb-3" role="presentation">
                                                <a class="nav-link @if($i == 1){{ 'active' }}@endif upload-link" data-toggle="tab" href="#upload_account{{ $headaccount->id }}"
                                                    role="tab" aria-controls="member{{$i}}" aria-selected="true">{{ $name }}</a>
                                            </li>
                                            @endif
                                            @php
                                                $i++;
                                            @endphp
                                        {{-- @endif --}}
                                    @endforeach
                                    @endif
                                </ul>
                                <div class="tab-content upload-tab">
                                    @if(isset($client->accountsdata) && !empty($client->accountsdata))
                                    @php
                                        $j = 1;
                                        $k = 1;
                                    @endphp
                                    @foreach ($client->accountsdata as $bodyaccount)
                                    @php
                                        //dd($bodyaccount);
                                    @endphp
                                    {{-- @if($bodyaccount->mandates_count > 0) --}}
                                    <div class="tab-pane fade show @if($j == 1){{ 'active' }}@endif" id="upload_account{{ $bodyaccount->id }}"
                                        role="tabpanel" aria-labelledby="goal-member{{$j}}-tab">
                                        <input type="hidden" name="client_account_id_{{ $j }}" value="{{ $bodyaccount->id }}">
                                        <div class="row flex-column">
                                            <div class="col-xl-3 col-sm-6">
                                                <div class="form-group">
                                                    <label for="aof_{{ $bodyaccount->id }}_upload">Upload AOF</label>
                                                    <label for="aof_{{ $bodyaccount->id }}_upload" class="btn upload-btn w-100" @if($is_verify == 1){{'readonly=true'}}@endif @if($bodyaccount->is_aof_uploaded == 1 && $is_verify == 0) @if(Auth::user()->hasRole(App\Models\User::KINNTEGRA_ADMIN) != 1){{'readonly=true'}}@endif @endif>
                                                        <input id="aof_{{ $bodyaccount->id }}_upload" name="aof_{{ $bodyaccount->id }}_upload" type="file" />
                                                        <div class="left-side">
                                                            <svg width="40" height="40" viewBox="0 0 38 38">
                                                                <use xlink:href="#xls" />
                                                            </svg>
                                                            <span class="default-text">Upload (.tiff)</span>
                                                            <span class="value"></span>
                                                        </div>
                                                        <svg class="upload-icon" width="30" height="30"
                                                            viewBox="0 0 24 24">
                                                            <use xlink:href="#upload" />
                                                        </svg>
                                                        <a class="delete-icon"><i
                                                                class="icon-close"></i></a>
                                                    </label>
                                                    @if (isset($bodyaccount->aof_upload_url) && $bodyaccount->aof_upload_url != '#')
                                                        <label class="w-100">
                                                            <span class="text-lowercase font-italic"><a href="javascript:showImage('{{ $bodyaccount->aof_upload_url }}')" data-src="{{ $bodyaccount->aof_upload_url }}">Preview</a></span>
                                                        </label>
                                                    @endif
                                                </div>
                                            </div>
                                            @if($bodyaccount->mandates_count > 0)
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="upload-mandate-{{$k}}">Upload Mandate</label>
                                                    <div class="row">
                                                        @foreach ($bodyaccount->mandates as $mandate)
                                                        @php
                                                            $url = url('/client/upload?url='.$mandate->mandate_file_url);
                                                            $filename = basename($url, '.pdf')."(.jpg)";
                                                            //dd($filename);
                                                            //dd($mandate);
                                                        @endphp

                                                        <div class="col-xl-3 col-sm-6 mb-3 mb-md-4">
                                                            <label for="mandate{{$k}}_{{ $bodyaccount->id }}_upload"
                                                                class="btn upload-btn w-100" @if($is_verify == 1){{'readonly=true'}}@endif @if($mandate->is_mandate_scan_uploaded == 1 && $is_verify == 0) {{'readonly=true'}} @endif>
                                                                <input id="mandate{{$k}}_{{ $bodyaccount->id }}_upload" name="mandate{{$k}}_{{ $bodyaccount->id }}_upload" type="file" />
                                                                <div class="left-side">
                                                                    <svg width="40" height="40" viewBox="0 0 38 38">
                                                                        <use xlink:href="#xls" />
                                                                    </svg>
                                                                    <span class="default-text">{{ $filename }}</span>
                                                                    <span class="value"></span>
                                                                </div>
                                                                <svg class="upload-icon" width="30" height="30" viewBox="0 0 24 24">
                                                                    <use xlink:href="#upload" />
                                                                </svg>
                                                                <a class="delete-icon"><i class="icon-close"></i></a>
                                                            </label>
                                                            @if (isset($mandate->mandate_upload_url) && $mandate->mandate_upload_url != '#')
                                                                <label class="w-100">
                                                                    <span class="text-lowercase font-italic"><a href="javascript:showImage('{{ $mandate->mandate_upload_url }}')" data-src="{{ $mandate->mandate_upload_url }}">Preview</a></span>
                                                                </label>
                                                            @endif
                                                        </div>
                                                        @php
                                                            $k++;
                                                        @endphp
                                                        @endforeach

                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            <div class="col-xl-3 col-lg-6 col-sm-6">
                                                <div class="form-group">
                                                    <label for="loe_{{ $bodyaccount->id }}_upload">Upload Letter of Engagement</label>
                                                    <label for="loe_{{ $bodyaccount->id }}_upload" class="btn upload-btn w-100" @if($is_verify == 1){{'readonly=true'}}@endif @if($bodyaccount->is_loe_uploaded == 1) @if(Auth::user()->hasRole(App\Models\User::KINNTEGRA_ADMIN) != 1){{'readonly=true'}}@endif @endif>
                                                        <input id="loe_{{ $bodyaccount->id }}_upload" name="loe_{{ $bodyaccount->id }}_upload" type="file" />
                                                        <div class="left-side">
                                                            <svg width="40" height="40" viewBox="0 0 38 38">
                                                                <use xlink:href="#xls" />
                                                            </svg>
                                                            <span class="default-text">Upload (.pdf)</span>
                                                            <span class="value"></span>
                                                        </div>
                                                        <svg class="upload-icon" width="30" height="30"
                                                            viewBox="0 0 24 24">
                                                            <use xlink:href="#upload" />
                                                        </svg>
                                                        <a class="delete-icon"><i
                                                                class="icon-close"></i></a>
                                                    </label>
                                                    @if (isset($bodyaccount->letter_engagement_url) && $bodyaccount->letter_engagement_url != '#')
                                                        <label class="w-100">
                                                            <span class="text-lowercase font-italic"><a href="javascript:showImage('{{ $bodyaccount->letter_engagement_url }}')" data-src="{{ $bodyaccount->letter_engagement_url }}">Preview</a></span>
                                                        </label>
                                                    @endif
                                                </div>
                                            </div>
                                            {{-- <div class="col-xl-3 col-lg-6 col-sm-6">
                                                <div class="form-group">
                                                    <label for="upload-letter">Upload Letter of Engagement</label>

                                                    <label for="upload-letter"
                                                        class="btn upload-btn w-100">
                                                        <div class="left-side">
                                                            <svg width="40" height="40" viewBox="0 0 38 38">
                                                                <use xlink:href="#xls" />
                                                            </svg>
                                                            <span class="value">w3t3266.pdf</span>
                                                        </div>
                                                        <svg class="upload-icon" width="30" height="30"
                                                            viewBox="0 0 24 24">
                                                            <use xlink:href="#upload" />
                                                        </svg>
                                                    </label>
                                                </div>
                                            </div> --}}
                                        </div>
                                        @if(!empty($bodyaccount->rejected_remarks_2))
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="card small-card option-2 mb-4">
                                                        <div class="card-header">
                                                            <h6 class="card-title">Client Rejected Reason</h6>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="transaction-wrapper trade-status">
                                                                @foreach ($bodyaccount->rejected_remarks_2 as $remark)
                                                                    @if($remark->status == 'rejected')
                                                                    <div class="transaction-steps regected">
                                                                        <div class="trade-title mb-1">
                                                                            <h4 class="mb-0">{{$remark->remarks}}</h4>
                                                                            <div class="info">
                                                                                <span>{{ Carbon\Carbon::parse($remark->verified_on)->format('h:i:s A') }}</span>
                                                                                <span>{{ Carbon\Carbon::parse($remark->verified_on)->format('l, jS F Y') }}</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
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
                                @if($is_verify == 0 || $is_verify == 2)
                                    <button type="button" class="btn btn-primary btn-lg proceed">Proceed</button>
                                @endif
                                @if($is_verify == 1)
                                    @if($is_verified > 0)
                                    <button type="button" class="btn btn-danger btn-lg mr-3" data-toggle="modal" data-target="#RejectionModal">Reject</button>
                                    <button type="button" class="btn btn-primary btn-lg proceed">Approved</button>
                                    @else
                                    <button type="button" class="btn btn-primary btn-lg proceed">Proceed</button>
                                    @endif
                                @endif
                                <div class="modal fade" id="RejectionModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
                                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Define the resaon to reject</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                @foreach ($client->accountsdata as $footaccount)
                                                @php
                                                $name = '';
                                                    if (in_array($footaccount->account_type, $accounttype))
                                                    {

                                                        if(!empty($footaccount->first_holder_name)){
                                                            $name .=  $footaccount->first_holder_name;
                                                        }
                                                        if(!empty($footaccount->second_holder_name)){
                                                            $name .= ' + ';
                                                            $name .=  $footaccount->second_holder_name;
                                                        }
                                                        if(!empty($footaccount->third_holder_name)){
                                                            $name .= ' + ';
                                                            $name .=  $footaccount->third_holder_name;
                                                        }
                                                    }else{
                                                        $name .=  $footaccount->first_holder_name;
                                                    }
                                                @endphp
                                                <div class="row form-sections">
                                                    <div class="col-12">
                                                        <h4 class="form-section-title text-uppercase text-grey">{{ $name }}</h4>
                                                    </div>
                                                    <div class="col-12 d-flex flex-wrap">
                                                        <div class="col-md-12 profile_{{$footaccount->id}}">
                                                            <div class="form-group mb-3">
                                                                <label>Reject Reason</label>
                                                                <textarea class="form-control" name="account-reason_{{$footaccount->id}}" rows="4" placeholder="Add Comment"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary col-sm-3 proceed">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
<div class="modal fade" id="uploadModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <!-- modal-lg-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">View Proof</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row form-sections">
                    <div class="col-12 d-flex justify-content-center" id="show_doc">
                        {{-- <img src="" id="show_img" alt="image" class="img-fluid"> --}}
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="" id="download_img" class="btn btn-primary col-sm-3" download target="_blank">Download</a>
            </div>
        </div>
    </div>
</div>




@endsection

@section('script')
<script type="text/javascript" src="{{ asset('assets/javascript/client.js') }}"></script>
{{-- <script type="text/javascript" src="{{ asset('assets/javascript/clientupload.js') }}"></script> --}}

<script>
    $('a.upload').click(function(e) {
        e.preventDefault();  //stop the browser from following
        var link = $(this).attr('href');
        // $.get('/client/upload', {url:link}, function (data, textStatus, jqXHR) {
        //     console.log(data);
        // });
    });

    $('input[type="file"]').change(function(e) {
    //     let fileName = e.target.files[0].name;
    //    alert('The file name is : "' + fileName);
        $("#has_new_upload").val(1);
      });

      function showImage($image)
    {
        console.log($image);

        if($image.split('.').pop() == 'pdf')
        {
            $pdf = "<embed src='"+$image+"' id='show_pdf' alt='pdf' class='img-fluid'></embed>";
            $("#show_doc").html($pdf);
        }else if($image.split('.').pop() == 'tif' || $image.split('.').pop() == 'tiff')
        {
            $img = "Not able to preview Tiff images. Please download the same.";
            $("#show_doc").html($img);
        }
        else{
            $img = "<img src='"+$image+"' id='show_img' alt='image' class='img-fluid'></img>";
            $("#show_doc").html($img);
        }
        //$("img#show_img").attr("src", $image);
        $("a#download_img").attr("href", $image);
        $('#uploadModal').modal('show');
        return true;
    }


// $(":file").on("change", function(e) {
// let file = this.files[0];
// $(".upload_error").remove();

// let file_type = file.type;
// let file_name = file.name;
// let validAOFTypes = ["image/tiff"];
// let validMANDATETypes = ["image/jpeg"];
// let validLOETypes = ["application/pdf"];
// let id = this.id;
// let error = 0;
// let file_length = $("#"+id)[0].files.length;
// let id_ary  = id.split("_");
// let id_first = id_ary[0];
// if(id_first.startsWith("aof"))
// {
//     if ($.inArray(file_type, validAOFTypes) < 0 && file_length > 0) {
//        $(this).parent().parent().append('<span class="upload_error">Upload only .tiff format</span>');
//         error++;
//     }
// }
// if(id_first.startsWith("mandate"))
// {
//     if ($.inArray(file_type, validMANDATETypes) < 0 && file_length > 0) {
//         $(this).parent().parent().append('<span class="upload_error">Upload only .jpg format</span>');
//         error++;
//     }
// }
// if(id_first.startsWith("loe"))
// {
//     if ($.inArray(file_type, validLOETypes) < 0 && file_length > 0) {
//         $(this).parent().parent().append('<span class="upload_error">Upload only .pdf format</span>');
//         error++;
//     }
// }
// if(error > 0)
// {
//     $(this).val('');
//     $(this).parent().removeClass('hasValue');
//     $(this).next().find('.value').html('');
//     return false;
// }
// });

function check_validation(error)
{


    $('input[type="file"]').each(function() {
        let id = this.id;
        let file_length = $("#"+id)[0].files.length;

        if (file_length > 0) {
            let file = this.files[0];
            let file_type = file.type;
            let file_name = file.name;
            let validAOFTypes = ["image/tiff"];
            let validMANDATETypes = ["image/jpeg"];
            let validLOETypes = ["application/pdf"];

            let id_ary  = id.split("_");
            let id_first = id_ary[0];
            if(id_first.startsWith("aof"))
            {
                if ($.inArray(file_type, validAOFTypes) < 0 && file_length > 0) {
                    $(this).parent().parent().append('<span class="upload_error">Upload only .tiff format</span>');
                    error++;
                }
            }
            if(id_first.startsWith("mandate"))
            {
                if ($.inArray(file_type, validMANDATETypes) < 0 && file_length > 0) {
                    $(this).parent().parent().append('<span class="upload_error">Upload only .jpg format</span>');
                    error++;
                }
            }
            if(id_first.startsWith("loe"))
            {
                if ($.inArray(file_type, validLOETypes) < 0 && file_length > 0) {
                    $(this).parent().parent().append('<span class="upload_error">Upload only .pdf format</span>');
                    error++;
                }
            }
            // if(error > 0)
            // {
            //     // $(this).val('');
            //     // $(this).parent().removeClass('hasValue');
            //     // $(this).next().find('.value').html('');
            //     return false;
            // }
        }
    });

    return error;
}

    $('#client_upload .trial button.proceed').click(function (e) {
        e.preventDefault();
        let error = 0;
        $(".upload_error").remove();
        error = check_validation(error);
        if(error > 0)
        {
            return false;
        }
        let id = $('#client_id').val();
        let post = $('form#client_upload').attr('method');
        let url = $('form#client_upload').attr('action');
        let formData = new FormData($('#client_upload')[0]);
        $.ajax({
            type: post,
            url: url,
            data: formData,
            //async: false,
            beforeSend: function() {
                $('#loading').show();
            },
            success:function(data) {
                //console.log(data);//return false;
                if(data.status == 1 || data.status == 2 || data.status == 4)
                {
                    window.location.href = '/client/upload';
                }

                if(data.status == 3)
                {
                    window.location.href = '/leads';
                }


                // if($("#is_verify").val() == 1 || $("#is_verify").val() == 2)
                // {
                //     window.location.href = '/client/upload/'+id+'?is_verify='+$("#is_verify").val();
                // }else{
                //     window.location.href = '/client/upload/'+id;
                // }
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

$('#RejectionModal').on('shown.bs.modal', function () {
    $("#is_reject").val(1);
});

$('#RejectionModal').on('hidden.bs.modal', function (e) {
    $("#is_reject").val(0);
});
</script>
@endsection
