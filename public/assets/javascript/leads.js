$('input[name=mobile]').keypress(validateMobile);
$('input[name=mobile]').keyup(validateMobileFirst);
$('input[name=pincode]').keypress(validatePincode);
$(document).ready(function () {
    //Get State
    let country = $( "select#country option:selected" ).val();
    $('.individual').show();
    //$('.nonindividual').hide();
    //$("#account_type").select2("val", "1");

    getStates(country, 'state', state);

    $('.daterange').daterangepicker();
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

function getStates($id, $name,$value = '')
{
    $('#'+$name).empty();
    $.get("/admin/master/countries/"+$id+"/states", function(data, status){
        console.log(data);
        let emp = '';
        emp += '<option value="" disabled selected>Select States</option>';
        $.each(data, function(i,o){
            emp += '<option value="'+o.id+'">'+o.name+'</option>';
        });
        $('#'+$name).html(emp);
        if($value)
        {   console.log($value);
            $('select#'+$name).val($value).trigger('change');

        }
    });
    return true;
}


$( "form#lead_creation" ).submit(function(e) {
    e.preventDefault();
    var form = $(this);
    var url = form.attr('action');
    var data = new FormData( form[ 0 ] );//form.serialize();
    var post = form.attr('method');
    console.log(data);

    $('.error').removeClass('error');
    $('.err').removeClass('err');
    $('.span_err').remove();
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
            console.log(data);
            if(data.id)
            $('input[name="id"]').val(data.id);
            //Main Data

            $("#new-lead-modal").modal('hide');
            if($('#lead_edit').val() == 0)
            {
                $("#successModal").modal('show');
            }

        },
        error: function(xhr, textStatus, thrownError)
        {

            var response = jQuery.parseJSON(xhr.responseText);

            console.log(response);
            if(response.server_errors)
            {
                let error_data = '<ul class="alerts-lists">';
                //console.log(response.server_errors);
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


  $('#new-lead-modal').on('hidden.bs.modal', function (e) {

    $("#gender").val('').trigger('change');
    $("#state").val('').trigger('change');
    $("#associate_id").val('').trigger('change');
    $("#employee_id").val('').trigger('change');
    $("#employee_id").attr('readonly',true);
    $('form#lead_creation')[0].reset();
    $('#staticLeadLabel').html('New Lead');



  });

  $('#successModal').on('hidden.bs.modal', function (e) {
    location.reload();
  });

  $(document).on('change', '#associate_id', function (e) {
    let value = e.target.value;
    let text = $( "select#associate_id option:selected" ).text();
    getEmployee(value);
});

function getEmployee(value,code = '')
{

    if(value > 0)
    {
        $.get("/associate/"+value+"/employee", function(data, status){

            if(data.length > 0)
            {
                let emp = '';
                $('input[name=has_employee]').val(1);
                emp += '<option value="" disabled selected>Select Employee</option>';
                $.each(data, function(i,o){
                    emp += '<option value="'+o.id+'">'+o.name+'</option>';
                });
                $('#employee_id').empty();
                $('#employee_id').html(emp);
                $('#employee_id').attr('readonly', false);
                if(code)
                {
                    $('select#employee_id').val(code).trigger('change');
                }
            }else{
                $('input[name=has_employee]').val(0);
                $('#employee_id').attr('readonly', true);
            }

        });
    }else{
        $("#employee_id").attr('readonly', false);
        $("#profession_id").attr('readonly', false);
    }
}

$(document).on('change', '#account_type', function () {
    var account_type = $(this).val();
    if(account_type == 1)
    {
        $('.individual').show();
        //$('.nonindividual').hide();
        $('#first_name,#last_name,#gender').attr('disabled',false);
        $('#cname,#cauthname1,#cauthdesignation1').attr('disabled', true);
    }else{
        $('.individual').hide();
        //$('.nonindividual').show();
        $('#first_name,#last_name,#gender').attr('disabled',true);
        $('#cname,#cauthname1,#cauthdesignation1').attr('disabled', false);
    }
});

function editLogs($id)
{
    console.log($id);
    if($id)
    {
        $.get("/leads/"+$id, function(data, status){
            console.log(data);
            $('#staticLeadLabel').html('Update Lead ::'+data.name);
            var account_type = data.account_type;
            var associate_id = data.lead.associate_id;
            var employee_id = data.lead.employee_id;
            $('#lead_edit').val('1');
            $("#lead_id").val(data.id);
            if(data.individual_member_count > 0)
            {
                $("#client_profile_id").val(data.individual_profile_manage[0].id);
            }
            if(data.company_member_count > 0)
            {
                $("#client_profile_id").val(data.company_profile_manage[0].id);
            }

            $("#lead_creation select[name=account_type]").val(account_type).trigger('change');
            $("#lead_creation select[name=associate_id]").val(associate_id).trigger('change');
            $('#employee_code').val(employee_id);
            getEmployee(associate_id, employee_id);
            let user_associate = $('input[name=user_associate]').val();
            let address = '';
            if(user_associate == 1)
            {
                $('#associate_id').val(associate_id);
            }
            address = data.address;
            if(account_type == 1)
            {
                $('.individual').show();
                //$('.nonindividual').hide();
                $('#first_name,#last_name,#gender').attr('disabled',false);
                $('#cname,#cauthname1,#cauthdesignation1').attr('disabled', true);
                $("#lead_creation input[name=first_name]").val(data.individual_profile_manage[0].first_name);
                $("#lead_creation input[name=last_name]").val(data.individual_profile_manage[0].last_name);
                $("#lead_creation select[name=gender]").val(data.individual_profile_manage[0].gender).trigger('change');
                //address = data.individual_profile_manage[0].addresses;
            }
            // else{
            //     $('.individual').hide();
            //     $('.nonindividual').show();
            //     $('#first_name,#last_name,#gender').attr('disabled',true);
            //     $('#cname,#cauthname1,#cauthdesignation1').attr('disabled', false);
            //     $("#lead_creation input[name=cname]").val(data.company_profile_manage[0].cname);
            //     $("#lead_creation input[name=cauthname1]").val(data.company_profile_manage[0].cauthname1);
            //     $("#lead_creation input[name=cauthdesignation1]").val(data.company_profile_manage[0].cauthdesignation1);

            // }
            console.log(address);
            $("#lead_creation input[name=mobile]").val(data.mobile);
            $("#lead_creation input[name=email]").val(data.email);
            let country = '98';//Default for India
            let state = '';
            if(address)
            {
                $("#lead_creation input[name=address1]").val(address.address1);
                $("#lead_creation input[name=address2]").val(address.address2);
                $("#lead_creation input[name=address3]").val(address.address3);
                $("#lead_creation input[name=city]").val(address.city);
                country = address.country;
                state = address.state;
                $("#lead_creation select[name=country]").val(country);
                $("#lead_creation input[name=pincode]").val(address.pincode);
                $("#lead_creation input[name=addresstype_id]").val(address.addresstype_id);
                $("#lead_creation input[name=subtype_id]").val(address.subtype_id);
            }

            getStates(country, 'state', state);
            $('#new-lead-modal').modal('show');
        });
    }
}
