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
    /* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
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
        <h3 class="section-title mb-4 d-flex justify-content-between">Gross Annual Income
            <button class="btn btn-link" id="add_new_data">Add New</button>
        </h3>
            <div class="card mb-4">
            <div class="card-body">

                <div id="success_alert" class="alert alert-success alert-dismissible fade show" style="display: none" role="alert">
                    <div class="alert-text">
                        <strong>Hooray !</strong> <span class="message"></span>
                    </div>
                    <button type="button" id="success_alert_close" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="row flex-row-reverse ">

                    <div class="col-lg-9 border-left col-md-7 ">
                        <div class="admin-body">
                            <ul class="nav nav-tabs mb-4" id="lead-generation" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" data-toggle="tab" href="#admin-tax"
                                        role="tab" aria-selected="true">Gross Annual Income</a>
                                </li>
                            </ul>

                            <div class="tab-content" id="leadsContent">
                                <div class="tab-pane fade show active" id="admin-tax" role="tabpanel">
                                    <div class="card small-card option-2 option-2 mb-4">
                                        <div class="card-header">
                                            <h5 class="card-title mb-0 status">Add</h5>
                                            <span class="edit-now float-right mt-1" style="display: none">Edit</span>
                                        </div>
                                        <div class="card-body pt-4 pb-4">
                                            <form id="add-update-data" method="POST" action="{{ route('taxslab.store') }}">
                                            @csrf
                                                <input type="hidden" name="id" value="">

                                                <div class="row">
                                                    <div class="col-xl-4 col-sm-12 name">
                                                        <div class="form-group mb-3 mb-sm-0">
                                                            <label>Name</label>
                                                            <input type="text" name="name" class="form-control" placeholder="Enter Name">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-4 col-sm-12 code">
                                                        <div class="form-group mb-3 mb-sm-0">
                                                            <label>Code</label>
                                                            <input type="text" name="code" class="form-control" placeholder="Enter Code">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-4 col-sm-12 type">
                                                        <div class="form-group mb-3 mb-sm-0">
                                                            <label>Code</label>
                                                            <div class="select-wrapper exclude">
                                                                <select class="form-control" name="type">
                                                                    <option value="" disabled>Select Type</option>
                                                                    <option value="0" selected>Not Selected</option>
                                                                    <option value="1">Individual</option>
                                                                    <option value="2">Non-Individual</option>
                                                                    <option value="3">Both</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-primary mt-4">Save</button>
                                            </form>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-5">
                        <h5 class="card-title mb-3">Lists</h5>
                        <div class="input-group ">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="table-search">
                                    <svg width="24" height="24" viewBox="0 0 24 24">
                                        <use xlink:href="#search"></use>
                                    </svg>
                                </span>
                            </div>
                            <input type="text" name="master_search" id="master_search" class="form-control" placeholder="Search"
                                aria-label="table-search" aria-describedby="table-search">
                        </div>
                        <ul class="logs-list mt-4">
                            @foreach ($slabs as $type)
                            <li>
                                <a href="javascript:void(0)" onclick="return viewEditFunction({{$type->id}});"><h4>{{$type->name}}</h4></a>
                            </li>
                            @endforeach
                        </ul>
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
<script>
    $(document).ready(function () {
        $('#toggleMenu').on('click', function () {
            $(".panel-option").toggleClass('open');
        });
        $('#closeMenu').on('click', function () {
            $(".panel-option").removeClass('open');
        });
    });

    $(document).on('keyup', '#master_search', function (e) {
        let value = e.target.value;
        master_search(value);
    });

    function viewEditFunction($id)
    {
        $.get("/admin/master/taxslab?id="+$id, function(output, status){
            $('form#add-update-data').find("input[type=text], input[type=number],select[name=type]").val("");
            $('select[name=type]').select2().trigger('change');
            $('form#add-update-data').find("input[type=text], input[type=number],select[name=type]").attr('readonly',false);
            $(".edit-now").show();
            $(".status").html('Update');
            let data = output[0];
            let id = data['id'];
            let name = data['name'];
            let code = data['code'];
            let type = 0;
            if(data['individual'] == 1 && data['nonindividual'] == 1)
            {
                type = 3;
            }
            if(data['individual'] == 1 && data['nonindividual'] == 0)
            {
                type = 1;
            }
            if(data['individual'] == 0 && data['nonindividual'] == 1)
            {
                type = 2;
            }
            $("input[name=id]").val(id);
            $("input[name=name]").val(name);
            $("input[name=code]").val(code);
            $('select[name=type]').val(type);
            $('select[name=type]').select2().trigger('change');
            $('form#add-update-data').find("input[type=text], input[type=number],select[name=type]").attr('readonly',true);
        });
    }
    $(document).on('click', '#add_new_data', function (e) {
        $('form#add-update-data').find("input[type=text], input[type=number],select[name=type]").val("");
        $('select[name=type]').select2().trigger('change');
        $('form#add-update-data').find("input[type=text], input[type=number],select[name=type]").attr('readonly',false);
        $("input[name=id]").val('');
        $(".status").html('Add');
        $(".edit-now").hide();
    });

    $(document).on('click', '.edit-now', function (e) {
        $('form#add-update-data').find("input[type=text], input[type=number],select[name=type]").attr('readonly',false);
    });


    $(document).on('click', '#success_alert_close', function (e) {
        $("#success_alert").hide();
    });

    function master_search(value)
    {
        let data = '';
        $.get("/admin/master/taxslab?name="+value, function(output, status){
            console.log(output);
            $.each(output, function(i,o){
                data += '<li><a href="javascript:void(0)" onclick="return viewEditFunction('+o.id+');"><h4>'+o.name+'</h4></a></li>';
            });
            $('.logs-list').html(data);
        });
        return true;
    }

    $( "form#add-update-data" ).submit(function(e) {
        e.preventDefault();
        var form = $(this);
        var url = form.attr('action');
        var data = new FormData( form[ 0 ] );//form.serialize();
        var post = form.attr('method');

        $('.error').removeClass('error');
        $('.err').removeClass('err');
        $('.span_err').remove();

        if($('input[name=name],input[name=code]').prop('readonly')){ return false;}
        $.ajax({
            type: post,
            url: url,
            data: data,
            //async: false,
            beforeSend: function() {
                //$('#loading').show();
            },
            success:function(data) {
                //$('#loading').show();

                $("#success_alert .alert-text .message").html(data);
                $("#success_alert").show();
                master_search('');
                $('form#add-update-data').find("input[type=text], input[type=number],select[name=type]").attr('readonly',true);
            },
            error: function(xhr, textStatus, thrownError)
            {
                var response = jQuery.parseJSON(xhr.responseText);

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
                if(response.errors)
                {
                    $.each( response.errors, function( k, v ) {
                        $('.'+k).children().not("div.exclude").not("label").not("span").append("<label id='"+k+"_error' class='error span_err'>"+v+"</label>");
                    });
                }

            },
            cache: false,
            contentType: false,
            processData: false,
        });
        return false;
    });

</script>
@endsection
