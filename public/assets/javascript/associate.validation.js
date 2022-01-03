var formLength = $('.form-lists > li').length;
var exists;

$(window).on('load', function () {
    let height = $('.step-forms .active').height();
    $('.step-forms').css('height', height + 'px');
    $('input[name="singleDate"]').datepicker({
        autoclose: true
    });

});

$(".back-btn").click(function () {
    let current = $(this).parent().parent();
    let prev = current.prev();
    let currentLink = "[data-form=" + current.attr('id') + "]";
    let prevLink = "[data-form=" + prev.attr('id') + "]";
    console.log(currentLink);
    current.removeClass('active');
    prev.addClass('active');
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
        let height;
        $('.step-forms form').removeClass('active');
        $(".form-lists li").removeClass('active');
        // if ($(this).hasClass('isParent')) {
        //     let child = $(this).children('.isChild');
        //     child = $(this).children('ul').children(':first-child');
        //     $(this).addClass('active');
        //     let childLink = child.attr('data-form');
        //     $("#" + childLink).addClass('active');
        //     height = $("#" + childLink).height();
        // } else {
        $("#" + current).addClass('active');
        $(this).addClass('active');
        height = $("#" + current).height();
        // }
        $('.step-forms').css('height', height + 'px');
    } else if ($(this).hasClass('isParent') && $(this).hasClass('active')) {
        let current = $(this).attr('data-form');
        $('.step-forms form').removeClass('active');
        $("#" + current).addClass('active');
    } else if ($(this).hasClass('sub-active')) {
        e.stopPropagation();
        let current = $(this).attr('data-form');
        $('.step-forms form').removeClass('active');
        $("#" + current).addClass('active');
    } else {
        e.stopPropagation();
    }
});

$('.step-forms form').submit(function (e) {

    e.preventDefault();
    let isAccount = $('#introduction:visible #proceed-to').val() == 'account';
    let current = $(this);
    let currentLink = "[data-form=" + current.attr('id') + "]";
    let next = $(this).next();
    let height = next.height();

    let nextLink = "[data-form=" + next.attr('id') + "]";
    let circleAttr = $('.circle').attr('stroke-dasharray');
    let percentage = parseInt(circleAttr.substr(0, circleAttr.indexOf(',')));
    let currentstep = current.attr('step');
    let currentid = current.attr('id');
    let nextstep = next.attr('step');
    let nextid = next.attr('id');
    var step = $(this).attr('step');
    var formData = new FormData($(this)[0]);
    var url = $(this).attr('action');
    var post = $(this).attr('method');
    var tmp = null;
    $('.error').removeClass('error');
    $('.err').removeClass('err');
    $('.span_err').remove();
    var tmp = $.ajax({
        type: post,
        url: url,
        data: formData,
        async: false,
        beforeSend: function() {

        },
        success:function(data) {

            current.removeClass('active');
            current.addClass('completed');
            $('.step-forms form').removeClass('active');
            $(".form-lists li:not(.isParent)").removeClass('active');
            $('.step-forms').css('height', height + 'px');
            //Login To Add Step Input

            if(nextstep){
                $('#'+currentid+' .hidden_step').remove();
                $('#'+nextid).append('<input type="hidden" class="hidden_step" name="step" value="'+nextstep+'" >');

            }
            //End
            if (isAccount) {
                $(nextLink).addClass('skip');
                $("#account-opening").addClass('active');
                $("[data-form=account-opening]").addClass('active');
                $(currentLink).addClass('completed');
                $('.circle').attr('stroke-dasharray', percentage + Math.round(100 / formLength) + ', 100');
                $('.percentage').html(percentage + Math.round(100 / formLength) + '%');
            } else {
                next.addClass('active');

                if ($(currentLink).hasClass('isParent')) {
                    $(nextLink).addClass('sub-active');
                } else if ($(currentLink).hasClass('isChild') && !($(nextLink).hasClass('isChild'))) {
                    $(currentLink).parent().parent().addClass('completed');
                    $(currentLink).parent().parent().removeClass('active');
                    $(nextLink).addClass('active');
                    $('.circle').attr('stroke-dasharray', percentage + Math.round(100 / formLength) + ', 100');
                    $('.percentage').html(percentage + Math.round(100 / formLength) + '%');
                } else if ($(currentLink).hasClass('isChild') && ($(nextLink).hasClass('isChild'))) {
                    $(nextLink).addClass('sub-active');
                }
                else {
                    $(nextLink).addClass('active');
                    $(currentLink).addClass('completed');
                    $('.circle').attr('stroke-dasharray', percentage + Math.round(100 / formLength) + ', 100');
                    $('.percentage').html(percentage + Math.round(100 / formLength) + '%');
                }
            }
            console.log(current.serializeArray());
            setTimeout(() => {
                $(this).hide();

                $('select').select2({
                    width: '100%'
                });
                $('input[name="singleDate"]').datepicker({
                    autoclose: true
                });

                $('input[name="primary_color').ColorPicker();
                $('input[name="secondary_color').ColorPicker();

            }, 500);
            set_exists(true);
        },
        error: function(xhr, textStatus, thrownError)
        {
            set_exists(false);
            var error = jQuery.parseJSON(xhr.responseText);
            console.log(error);
            $.each( error.errors, function( k, v ) {
                console.log(k);
                //$('.'+k).children().closest("label").addClass('err');
                $('.'+k).children().find("div").addClass('error');
                //$('.'+k).children().find("label").addClass('err');
                $('.'+k).children().not("label").not("span").append("<span id='"+k+"_error' class='span_err'>"+v+"</span>");
            });

        },
        cache: false,
        contentType: false,
        processData: false,
    }).status ;

    function set_exists(x){exists = x;}

    $(document).scrollTop(0);
    if(exists == true)
    {
        if(tmp == 200 || tmp == 201)
        {

        }
    }


});


$('.income-tab a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
    let height = $('form.active').height();
    $('.step-forms').css('height', height + 'px');
})

$(document).ready(function(){
    $step = $('form').attr('step');
    $id = $('form').attr('id');
    if($step == 1){
        $('form#'+$id).append('<input type="hidden" class="hidden_step" name="step" value="'+$step+'" >');
    }
});
