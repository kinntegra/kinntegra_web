var formLength = $('.step-forms .trial').length;
$(".back-btn").click(function () {
    let current = $(this).parent().closest('section.trial');
    let currentCount = parseInt(current.attr('data-step'));
    let prev = $(".trial[data-step=" + (currentCount - 1) + "]");
    let currentstep = current.attr('data-step');
    let currentid = current.attr('id');
    let prevstep = prev.attr('data-step');
    let previd = prev.attr('id');
    let currentLink = "[data-form=" + currentid + "]";
    let prevLink = "[data-form=" + previd + "]";


    current.removeClass('active');
    prev.addClass('active');
    $('input[name=step]').val(prevstep);
    if ($('.form-lists li' + prevLink).hasClass('completed')) {
        $('.form-lists li' + prevLink).addClass('active ');
        $('.form-lists li' + prevLink).removeClass('completed');
    } else if ($('.form-lists li' + prevLink).hasClass('isChild')) {
        $('.form-lists li' + prevLink).addClass('sub-active');
    }
    $('.form-lists li' + currentLink).removeClass('active ');
    $('.form-lists li' + currentLink).removeClass('sub-active');
});

$(".form-lists li").on("click", function (e) {

    if ($(this).hasClass('completed')) {
        let current = $(this).attr('data-form');
        let currentstep =  $("#"+current).attr("data-step");
        $('input[name=step]').val(currentstep);
        // let height;
        $('.trial').removeClass('active');
        $(".form-lists li").removeClass('active');

        $("#" + current).addClass('active');
        $(this).addClass('active');
        // height = $("#" + current).height();

        // $('.step-forms').css('height', height + 'px');
    } else if ($(this).hasClass('isParent') && $(this).hasClass('active')) {
        let current = $(this).attr('data-form');
        let currentstep =  $("#"+current).attr("data-step");
        $('input[name=step]').val(currentstep);
        $('.trial').removeClass('active');
        $("#" + current).addClass('active');
    } else if ($(this).hasClass('sub-active')) {
        e.stopPropagation();
        let current = $(this).attr('data-form');
        let currentstep =  $("#"+current).attr("data-step");
        $('input[name=step]').val(currentstep);
        $('.trial').removeClass('active');
        $("#" + current).addClass('active');
    } else {
        e.stopPropagation();
    }


});


$('.step-forms .trial button.proceed').click(function (e) {
    // e.preventDefault();
    // var formvalidate;
    // formvalidate = $(this).valid();
    $(document).scrollTop(0);
    let status = $("#userstatus").val();
    let origin   = window.location.pathname;
    let reject_origin = origin.replace("verify", "rejected");
    let approved_origin = origin.replace("verify", "approved");

    let isAccount = $('#introduction:visible #proceed-to').val() == 'account';
    let current = $(this).parent().closest('section.trial');
    let currentstep = current.attr('data-step');
    let currentid = current.attr('id');
    let currentLink = "[data-form=" + current.attr('id') + "]";
    let currentCount = parseInt(currentstep);
    let next = current.next();
    let account_count = $('#account_count').val();
    if(account_count == currentstep)
    {
        let post = $('form#client_external_account_approval').attr('method');
        let url = $('form#client_external_account_approval').attr('action');
        let formData = new FormData($('#client_external_account_approval')[0]);
        $.ajax({
            type: post,
            url: url,
            data: formData,
            //async: false,
            beforeSend: function() {
                $('#loading').show();
            },
            success:function(data) {
               // console.log(data);
               // return false;
                if(status == 1)
                {
                    window.location.replace(reject_origin);
                    return false;
                }else{
                    window.location.replace(approved_origin);
                    return false;
                }
            },
            error: function(xhr, textStatus, thrownError)
            {
                $('#loading').hide();
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
                        $('.'+k).children().not("label").not("span").append("<div id='"+k+"_error' class='error span_err'>"+v+"</div>");
                    });
                }



            },
            cache: false,
            contentType: false,
            processData: false,
            });
        return false;
    }
    // let height = next.height();
    nextcount = currentCount + 1;
    let nextLink = "[data-form=" + next.attr('id') + "]";
    let circleAttr = $('.circle').attr('stroke-dasharray');
    let percentage = parseInt(circleAttr.substr(0, circleAttr.indexOf(',')));
    current.removeClass('active');

    current.addClass('completed');
    $('.step-forms form').removeClass('active');
    $(".form-lists li:not(.isParent)").removeClass('active');
    // $('.step-forms').css('height', height + 'px');

    if (isAccount) {
        $(nextLink).addClass('skip');
        $("#account-opening").addClass('active');
        $("[data-form=account-opening]").addClass('active');
        $(currentLink).addClass('completed');
    } else {
        next.addClass('active');
        let nextstep = next.attr('data-step');

        //Login to change the Step Value
        $('input[name=step]').val(nextstep);
        //End to Change Logic
        if ($(currentLink).hasClass('isParent')) {
            $(nextLink).addClass('sub-active');
        } else if ($(currentLink).hasClass('isChild') && !($(nextLink).hasClass('isChild'))) {
            $(currentLink).parent().parent().addClass('completed');
            $(currentLink).parent().parent().removeClass('active');
            $(nextLink).addClass('active');

        } else if ($(currentLink).hasClass('isChild') && ($(nextLink).hasClass('isChild'))) {
            $(nextLink).addClass('sub-active');
            $(currentLink).addClass("sub-completed");
        }
        else {
            $(nextLink).addClass('active');
            $(currentLink).addClass('completed');
        }

        $('.circle').attr('stroke-dasharray', Math.round((currentCount / (formLength)) * 100) + ', 100');
        $('.percentage').html(Math.round((currentCount / (formLength)) * 100) + '%');
    }
    console.log(current.serializeArray());
    setTimeout(() => {
        // $(this).hide();

        // $('select').select2({
        //     width: '100%'
        // });
        // $('input[name="singleDate"]').datepicker({
        //     autoclose: true
        // });

    }, 500);

});

$(".reject-now").on("click", function(e) {
    $("#userstatus").val('1');
    $('#RejectModal').modal('show');
});

$('#RejectModal').on('hidden.bs.modal', function () {
    $("#userstatus").val('0');
});


function showImage($image)
{
    if($image.split('.').pop() == 'pdf')
    {
        $pdf = "<embed src='"+$image+"' id='show_pdf' alt='pdf' class='img-fluid'></embed>";
        $("#show_doc").html($pdf);
    }else{
        $img = "<img src='"+$image+"' id='show_img' alt='image' class='img-fluid'></img>";
        $("#show_doc").html($img);
    }
    //$("#show_img").attr("src", $image);
    $("a#download_img").attr("href", $image);
    $('#uploadModal').modal('show');
    return true;
}
