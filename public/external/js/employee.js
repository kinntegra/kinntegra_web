//$(".aadhar_no,.aadhar_upload,.photo_upload").hide();
var formLength = $('.step-forms .trial').length;
$(window).on('load', function () {
    //$('#loading').show();
    // let height = $('.step-forms .active').height();
    // $('.step-forms').css('height', height + 'px');

    $('#loading').hide();
});

$(".back-btn").click(function () {
    let current = $(this).parent().parent();
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
        //$('.form-lists li' + prevLink).removeClass('completed');
    } else if ($('.form-lists li' + prevLink).hasClass('isChild')) {
        $('.form-lists li' + prevLink).addClass('sub-active');
    }
    $('.form-lists li' + currentLink).removeClass('active ');
    //$('.form-lists li' + currentLink).removeClass('sub-active');
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
    e.preventDefault();
    $(document).scrollTop(0);
    //disableEnter(e);
    let isAccount = $('#introduction:visible #proceed-to').val() == 'account';
    let current = '';
    if($(this).parent().hasClass('trial'))
    {
        current = $(this).parent();
    }else{
        current = $(this).parent().closest('section.trial');
    }

    let step_edit = $('#step_edit').val();
    let employee_edit = $('#employee_edit').val();
    let employee_id = $('#employee_id').val();
    $('#loading').show();
    nextSteper(current,isAccount,employee_id);
    return false;

    // let post = $('form#form-information').attr('method');
    // let url = $('form#form-information').attr('action');
    // let formData = new FormData($('#form-information')[0]);


    return false;
});


function nextSteper(current,isAccount,id='')
{
    let currentstep = current.attr('data-step');
    let currentid = current.attr('id');
    console.log(current);
    let currentLink = "[data-form=" + currentid + "]";
    let currentCount = parseInt(currentstep);
    let entitytype = $('#entitytype_id').val();
    let profession = $('#profession_id').val();
    let minor = $('#is_minor').val();
    let next = '';
    let aid = $('#associate_id').val();
    let eid = $('#employee_id').val();
    let nextcount = 0;
    let userstatus = $("#userstatus").val();
    //
    if(currentstep == 6)
    {

        $.get("/encrypt?data="+eid, function(data, status){

            let data_id = data;
            let post = $('form#form-information').attr('method');
            let url = $('form#form-information').attr('action');
            let formData = new FormData($('#form-information')[0]);
            $.ajax({
                type: post,
                url: url,
                data: formData,
                //async: false,
                beforeSend: function() {
                    $('#loading').show();
                },
                success:function(data) {

                   if(data.status == 7)
                    {
                        window.location.replace("/external-employee/"+data_id+"/rejected");
                    }else{
                        window.location.replace('/external-employee/create?id='+data_id);
                    }

                },
                error: function(xhr, textStatus, thrownError)
                {
                    $('#loading').hide();
                    var error = jQuery.parseJSON(xhr.responseText);
                    console.log(error);
                    $.each( error.errors, function( k, v ) {
                        console.log(v);
                        $('.'+k).children().not("label").not("span").append("<div id='"+k+"_error' class='error span_err'>"+v+"</div>");
                    });
                },
                cache: false,
                contentType: false,
                processData: false,
                });
            return false;
        });

        return true;
    }
    else{
        nextcount = currentCount + 1;
    }
    //
    //console.log(nextcount);
    next = $(".trial[data-step=" + nextcount + "]");

    // let height = next.height();

    let nextstep = next.attr('data-step');
    let nextid = next.attr('id');

    let nextLink = "[data-form=" + nextid + "]";
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
        console.log(formLength)
        $('.circle').attr('stroke-dasharray', Math.round((currentCount / (formLength+1)) * 100) + ', 100');
        $('.percentage').html(Math.round((currentCount / (formLength+1)) * 100) + '%');
    }
    //console.log(current.serializeArray());
    setTimeout(() => {
        current.hide();
        if(nextstep == 11)
        {
            $('#step_edit').val('1');
        }else{
            $('#step_edit').val('0');
        }

        $('#loading').hide();
    }, 500);
    return true;
}

$(".reject-now").on("click", function(e) {
    $("#userstatus").val('1');
    $('#RejectModal').modal('show');
});

$('#RejectModal').on('hidden.bs.modal', function () {
    $("#userstatus").val('0');
});

function showImage($image)
{
    $("img#show_img").attr("src", $image);
    $("a#download_img").attr("href", $image);
    $('#uploadModal').modal('show');
    return true;
}


