@extends('layouts.master')

@section('style')

<style>

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

                <form class="col-lg-8 col-xl-9 step-forms col-md-8 pl-0" id="client_assetallocation" method="POST" action="{{ route('assetallocation.store') }}">
                    @csrf
                    <input type="hidden" name="id" id="client_id" value="{{ @$client_id }}">
                    <input type="hidden" name="client_edit" id="client_edit" value="">
                    <input type="hidden" name="step_edit" id="step_edit" value="">
                    <input type="hidden" name="is_verify" id="is_verify" value="{{ $is_verify }}">
                    <section class="trial active" id="allocation_details" data-step="1" autocomplete="off">
                        <div class="form-inner-section">
                            <div class="form-header">
                                <h3 class="card-title"><i class="icon-left-arrow back-btn back_to_kycdetail"></i>Asset Allocation

                                    @if ($client->is_allocation == 1)
                                        <span class="edit-now float-right mt-1">Edit</span>
                                    @endif
                                </h3>
                            </div>
                            <div class="form-content">
                                <div class="table-responsive mb-4">
                                    <table class="table normal-table">
                                        <thead>
                                            <tr>
                                                <th rowspan="2">Name</th>
                                                <th colspan="2" class="top-title">LUMPSUM</th>
                                                <th class="bb-0"></th>
                                                <th colspan="2" class="top-title">SIP</th>
                                                <th class="bb-0"></th>
                                            </tr>
                                            <tr>
                                                <th>Equity</th>
                                                <th>Debt</th>
                                                <th></th>
                                                <th>Equity</th>
                                                <th>Debt</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($client->client_profiles as $aclient)
                                                @if($aclient->is_account_profile == 1)
                                                <tr id="profile_id_{{$aclient->id}}" class="aprofile">
                                                    <td>
                                                        {{$aclient->name}}<br> <small>{{$aclient->tax_status}}</small>
                                                    </td>
                                                    <td class="select">
                                                        <select class="form-control equity_ratio_lumpsum" id="equity_ratio_lumpsum-{{$aclient->id}}" name="equity_ratio_lumpsum-{{$aclient->id}}" @if($aclient->equity_ratio_lumpsum != 0) {{'readonly'}} @endif>
                                                            @include('client.percentage', ['val' => $aclient->equity_ratio_lumpsum])
                                                        </select>
                                                    </td>
                                                    <td class="select">
                                                        <select class="form-control debt_ratio_lumpsum" id="debt_ratio_lumpsum-{{$aclient->id}}" name="debt_ratio_lumpsum-{{$aclient->id}}" @if($aclient->debt_ratio_lumpsum != 0) {{'readonly'}} @endif>
                                                            @include('client.percentage', ['val' => $aclient->debt_ratio_lumpsum])
                                                        </select>
                                                    </td>
                                                    <td></td>
                                                    <td class="select">
                                                        <select class="form-control equity_ratio_sip" id="equity_ratio_sip-{{$aclient->id}}" name="equity_ratio_sip-{{$aclient->id}}" @if($aclient->equity_ratio_sip != 0) {{'readonly'}} @endif>
                                                            @include('client.percentage', ['val' => $aclient->equity_ratio_sip])
                                                        </select>
                                                    </td>
                                                    <td class="select">
                                                        <select class="form-control debt_ratio_sip" id="debt_ratio_sip-{{$aclient->id}}" name="debt_ratio_sip-{{$aclient->id}}" @if($aclient->debt_ratio_sip != 0) {{'readonly'}} @endif>
                                                            @include('client.percentage', ['val' => $aclient->debt_ratio_sip])
                                                        </select>
                                                    </td>
                                                    <td>

                                                    </td>
                                                </tr>
                                                @endif
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                                @php
                                     $aremark = 0;
                                @endphp
                                @foreach ($client->account_profiles as $profile)
                                    @if(isset($profile->vrejectionremarks) && !empty($profile->vrejectionremarks))
                                        @php

                                            foreach($profile->vrejectionremarks as $profileremark)
                                            {
                                                if($profileremark->type == 'allocation')
                                                {
                                                    $aremark++;
                                                }
                                            }
                                        @endphp
                                    @endif
                                @endforeach
                                @if($aremark > 0)
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card small-card option-2 mb-4">
                                                <div class="card-header">
                                                    <h6 class="card-title">Rejected Reason</h6>
                                                </div>
                                                <div class="card-body">
                                                    <div class="transaction-wrapper trade-status">
                                                        @foreach ($client->account_profiles as $aprofile)

                                                            @if(isset($aprofile->vrejectionremarks) && !empty($aprofile->vrejectionremarks))
                                                                @foreach ($aprofile->vrejectionremarks as $profile_remark)

                                                                    @if($profile_remark->type == 'allocation')
                                                                    <div class="transaction-steps regected">
                                                                        <div class="trade-title mb-1">
                                                                            <h4 class="mb-0">{{$profile_remark->remarks}}</h4>
                                                                            <div class="info">
                                                                                <span>{{ Carbon\Carbon::parse($profile_remark->created_at)->format('h:i:s A') }}</span>
                                                                                <span>{{ Carbon\Carbon::parse($profile_remark->created_at)->format('l, jS F Y') }}</span>
                                                                            </div>
                                                                        </div>
                                                                        <div >

                                                                            <span class="badge badge-default badge-pill">{{ $aprofile->name }}</span>
                                                                        </div>
                                                                    </div>
                                                                    @endif
                                                                @endforeach
                                                            @endif

                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                @endif
                            </div>
                            <div class="form-footer">
                                <button type="button" class="proceed btn btn-primary btn-lg">Proceed</button>
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
{{-- <script type="text/javascript" src="{{ asset('assets/javascript/assetallocation.js') }}"></script> --}}
<script>

$('select.equity_ratio_lumpsum,select.equity_ratio_sip').on('change', function(e) {
  //alert( this.id );
  e.preventDefault();
    let id = this.id;
    console.log(id);
    let val = this.value;
    let new_id = '';
    let new_val = 100 - val;
    if(id.startsWith("equity"))
    {
        if($(this).closest('td').hasClass('invalid'))
        {
            $(this).closest('td').removeClass('invalid');
        }
        $id = $(this).closest('td').next().find('select').attr('id');
        $("#"+$id).val(new_val).trigger('change');
    }
    update_validation($id);
});

$('select.debt_ratio_lumpsum,select.debt_ratio_sip').on('change', function(e) {
    e.preventDefault();
    let id = this.id;
    console.log(id);
    let val = this.value;
    let new_id = '';
    let new_val = 100 - val;
    if(id.startsWith("debt"))
    {
        if($(this).closest('td').hasClass('invalid'))
        {
            $(this).closest('td').removeClass('invalid');
        }

        //$id = $(this).closest('td').prev().find('select').attr('id');
        //$("#"+$id).val(new_val).trigger('change');
    }
    update_validation($id);
});

function update_validation(id)
{
    let new_id = id.split("-");
    let prof_id = new_id[1];
    var numItems = $('td.select.invalid').length;
    console.log(numItems);
    if(numItems == 0)
    {
        $("#profile_id_"+prof_id).hasClass('invalid')
        {
            $("#profile_id_"+prof_id).removeClass('invalid');
            $('#profile_id_'+prof_id+' label.error').remove();
        }
    }
}

function check_validation(error_count)
{

    $('table > tbody  > tr.aprofile').each(function(index, tr) {
        let id = $(this).attr('id');
        let index1 = 0;
        let index2 = 0;
        let index3 = 0;
        let index4 = 0;
        let text = '<br><label class="error">Please select';
        let count = 0;
        $('table > tbody  > tr#'+id+' > td.select').each(function(index, td) {
            var select = $(this).find("select");
            var selval = select.val();
            if(index == 0){
                index1 = selval;
            }else if(index == 1){
                index2 = selval;
            }else if(index == 2){
                index3 = selval;
            }else if(index == 3){
                index4 = selval;
            }

        });
        if(index1 == 0 && index2 == 0)
        {
            text += ' lumpsum';
            count++;
            $( "tr#"+id+" td:nth-child(2)" ).addClass('invalid');
            $( "tr#"+id+" td:nth-child(3)" ).addClass('invalid');
        }

        if(index1 == 0 && index2 == 0)
        {
            text += ' & sip';
            count++;
            $( "tr#"+id+" td:nth-child(5)" ).addClass('invalid');
            $( "tr#"+id+" td:nth-child(6)" ).addClass('invalid');
        }
        text += ' ratio</label>';
        if(count > 0)
        {
            error_count++;
            $('table > tbody  > tr#'+id).find('td:first').append(text);
            $('table > tbody  > tr#'+id).addClass('invalid');
        }


    });
    return error_count;
}

$('.step-forms .trial button.proceed').click(function (e) {
    e.preventDefault();
    $(document).scrollTop(0);
    //disableEnter(e);
    $('#loading').show();
    let error_count = 0;
    $('.error').removeClass('error');
    $('.err').removeClass('err');
    $('.span_err').remove();
    error_count = check_validation(error_count);
    $('#loading').hide();
    //return false;
    console.log(error_count, 'final');
    if(error_count > 0)
    {
        $('#loading').hide();
        return false;
    }

    let isAccount = $('#introduction:visible #proceed-to').val() == 'account';
    let current = '';
    let id = $('#client_id').val();
    if($(this).parent().hasClass('trial'))
    {
        current = $(this).parent();
    }else{
        current = $(this).parent().closest('section.trial');
    }


    let post = $('form#client_assetallocation').attr('method');
    let url = $('form#client_assetallocation').attr('action');
    let formData = new FormData($('#client_assetallocation')[0]);
    let proceedto = $( "select#proceedto option:selected" ).val();
    $.ajax({
        type: post,
        url: url,
        data: formData,
        //async: false,
        beforeSend: function() {//xhr, type
            $('#loading').show();
        },
        success:function(data) {
            if($("#is_verify").val() == 1 || $("#is_verify").val() == 2)
            {
                window.location.href = '/client/creation/'+id+'?is_verify='+$("#is_verify").val();
            }else{
                window.location.href = '/client/creation/'+id;
            }

        },
        error: function(xhr, textStatus, thrownError)
        {
            $('#loading').hide();
            console.log(xhr);
            var error = jQuery.parseJSON(xhr.responseText);

        },
        cache: false,
        contentType: false,
        processData: false,
        timeout: 8000,
    });
    return false;
});

$(".edit-now").on("click", function(e) {
    let value = $(this).parent().closest('section.trial').attr('id');
    $('input[name=step_edit]').val(1);
    $('#'+value+' input, #'+value+' select, #'+value+' label , #'+value+' div.customMulti').attr('readonly', false);
});
</script>
@endsection
