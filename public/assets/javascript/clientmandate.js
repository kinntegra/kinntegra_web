$( document ).ready(function() {
    $aid = $(".account-link.active").attr('data-accountid');
    $("#active_account").val($aid);

});

$('.add-more-mandate').on('click', function () {

    let data = {};
    let hasdata = $(this);
    let cid = $("#client_id").val();
    data['cid'] = cid;
    let aid = $("#active_account").val();
    data['aid'] = aid;
    let sr_no = $("#mandate-accountid_"+data['aid']+"_count").val();
    sr_no = parseInt(sr_no);
    sr_no = sr_no+1;
    data['sr_no'] = sr_no;
    $.get("/client/mandate", data, function(output, status){
        //console.log(output);
        $(output).insertBefore(hasdata);
        //console.log(sr_no+1);
        $("#mandate-accountid_"+aid+"_count").val(sr_no);
        let has_new_mandate = $("#has_new_mandate").val();
        has_new_mandate = parseInt(has_new_mandate);
        $("#has_new_mandate").val(has_new_mandate+1);
        refreshElement();
    });

});

function refreshElement() {
    $('select').select2({
        width: '100%',
        minimumResultsForSearch: 5
    });
    $('.delete-element').on('click', function () {
        $(this).parent().remove();
    });
    $('.delete-mandate').on('click', function () {
        let has_new_mandate = $("#has_new_mandate").val();
        has_new_mandate = parseInt(has_new_mandate);
        if(has_new_mandate > 0){
        $("#has_new_mandate").val(has_new_mandate-1);}

        $(this).parent().parent().remove();
    });
}

    $('.account-link').click(function () {
    let active_id = $(this).attr('data-accountid');
    let error_count = 0;
    error_count =  check_validation(error_count);
    if(error_count > 0)
    {
        return false;
    }
      //  return true;

    $("#active_account").val(active_id);
});

$('#client_mandate_creation .trial button.proceed').click(function (e) {
    e.preventDefault();
    $(document).scrollTop(0);
    //disableEnter(e);
    $('#loading').show();
    let error_count = 0;
    let id = $('#client_id').val();
    error_count = check_validation(error_count);
    if(error_count > 0)
    {
        $('#loading').hide();
        return false;
    }
    let step_edit = $("#step_edit").val();
    let has_new_mandate = $("#has_new_mandate").val();

    if(has_new_mandate > 0)
    {
        let post = $('form#client_mandate_creation').attr('method');
        let url = $('form#client_mandate_creation').attr('action');
        let formData = new FormData($('#client_mandate_creation')[0]);
    $.ajax({
        type: post,
        url: url,
        data: formData,
        //async: false,
        beforeSend: function() {
            $('#loading').show();
        },
        success:function(data) {
            console.log(data);
            if($("#is_verify").val() == 1 || $("#is_verify").val() == 2)
            {
                window.location.href = '/client/download/'+id+'?is_verify='+$("#is_verify").val();
            }else{
                window.location.href = '/client/download/'+id;
            }
            //window.location.href = '/client/download/'+id;

        },
        error: function(xhr, textStatus, thrownError)
        {
            $('#loading').hide();
            console.log(xhr);
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
        },
        cache: false,
        contentType: false,
        processData: false,
        //timeout: 8000,
    });
    return false;
    }else{
        if($("#is_verify").val() == 1 || $("#is_verify").val() == 2)
        {
            window.location.href = '/client/download/'+id+'?is_verify='+$("#is_verify").val();
        }else{
            window.location.href = '/client/download/'+id;
        }
        return false;
    }
});

function check_validation(error_count)
{
    let current_id = $("#active_account").val();
    //console.log(active_id,current_id);
    let member_id = '';
    let member_error = '';
    $('.error').removeClass('error');
    $('.err').removeClass('err');
    $('.span_err').remove();
    //let error_count = 0;
    $('#account'+current_id+ ' .mandate-list :input').each(function () {


        if($(this).is('input'))
        {
            $inputname  = $(this).attr('name');
            $input = $("#"+$inputname).val();
            if($input == null || $input == '')
            {
                error_count++;
                member_id = $inputname;
                member_error = 'Enter amount';
                $('.'+member_id).children().not("div.exclude").not("label").not("span").append("<label id='"+member_id+"_error' class='error span_err'>"+member_error+"</label>");
            }

        }else{
            $selectname = $(this).attr('name');
            $select = $( "select#"+$selectname+" option:selected" ).val();
            if($select == null || $select == '')
            {
                error_count++;
                member_id = $selectname;
                member_error = 'Select bank';
                $('.'+member_id).children().not("div.exclude").not("label").not("span").append("<label id='"+member_id+"_error' class='error span_err'>"+member_error+"</label>");
            }
        }

    });
    return error_count;
}
