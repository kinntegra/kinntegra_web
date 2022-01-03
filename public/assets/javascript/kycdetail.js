var formLength = $('.step-forms .trial').length;
$(window).on('load', function () {
    //let height = $('.step-forms .active').height();
    //$('.step-forms').css('height', height + 'px');
    $('.birth_date, .incorpdate').datepicker({
        autoclose: true,
        format: "dd-mm-yyyy"
    });
});

// $(".form-lists li").on("click", function (e) {
//     $("#loading").show();
//     let id = $('#client_id').val();
//     let current = $(this).attr('data-form');
//     let currentstep =  $("#"+current).attr("data-step");
//     $('input[name=step]').val(currentstep);
//     if(current == 'introduction')
//     {
//         window.location.href = '/client/introduction/'+id;
//         return false;
//     }
//     if(current == 'comprehensive-plan')
//     {
//         window.location.href = '/client/comprehensive/'+id;
//         return false;
//     }

//     if ($(this).hasClass('completed')) {
//         $('.trial').removeClass('active');
//         $(".form-lists li").removeClass('active');
//         $("#" + current).addClass('active');
//         $(this).addClass('active');

//     } else if ($(this).hasClass('isParent') && $(this).hasClass('active')) {
//         $('.trial').removeClass('active');
//         $("#" + current).addClass('active');
//     } else if ($(this).hasClass('sub-active')) {
//         e.stopPropagation();
//         $('.trial').removeClass('active');
//         $("#" + current).addClass('active');
//     } else {
//         e.stopPropagation();
//     }
//     $("#loading").hide();
// });


// $(".back-btn").click(function () {

//     $("#loading").show();
//     if($(this).hasClass('back_to_introduction'))
//     {
//         let client_id = $('#client_id').val();
//         window.location.href = '/client/introduction/'+client_id;
//     }
//     if($(this).hasClass('back_to_comprehensive'))
//     {
//         let client_id = $('#client_id').val();
//         window.location.href = '/client/comprehensive/'+client_id;
//     }
// });


$('.step-forms .trial button.proceed').click(function (e) {
    e.preventDefault();
    $(document).scrollTop(0);
    //disableEnter(e);
    $('#loading').show();
    let error_count = 0;
    $('.error').removeClass('error');
    $('.err').removeClass('err');
    $('.span_err').remove();
    let accountprofile = $('#accountprofile').children().find('input:checked').map(function(i, e) {return e.value}).toArray();
    if(accountprofile.length == 0)
    {
        member_id = 'accountprofile';
        member_error = 'Select Profile';
        $('#'+member_id).children().first().not("label").not("span").append("<div id='"+member_id+"_error' class='error span_err'>"+member_error+"</div>");
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


    let post = $('form#client_kycdetail').attr('method');
    let url = $('form#client_kycdetail').attr('action');
    let formData = new FormData($('#client_kycdetail')[0]);


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
                window.location.href = '/client/kycinformation/'+data.id+'?is_verify='+$("#is_verify").val();
            }else{
                window.location.href = '/client/kycinformation/'+data.id;
            }
        },
        error: function(xhr, textStatus, thrownError)
        {
            $('#loading').hide();
            console.log(xhr);
            var error = jQuery.parseJSON(xhr.responseText);
            //console.log(error);
            // $.each( error.errors, function( k, v ) {
            //     console.log(k);
            //     //$('.'+k).children().closest("label").addClass('err');
            //     //$('.'+k).children().find("div").addClass('error');
            //     //$('.'+k).children().find("label").addClass('err');
            //     if(k == 'bse_upload')
            //     {
            //         $('.'+k).children().not("div.exclude").not("label").not("span").append("<div id='"+k+"_error' class='error span_err'>"+v+"</div>");
            //     }else{
            //         $('.'+k).children().not("div.exclude").not("label").not("span").append("<label id='"+k+"_error' class='error span_err'>"+v+"</label>");
            //     }
            // });

        },
        cache: false,
        contentType: false,
        processData: false,
        timeout: 8000,
    });
    return false;
});


function check_validation()
{

}
