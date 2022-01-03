var formLength = $('.form-lists > li').length;
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


$(".form-lists li").on("click", function () {

    if ($(this).hasClass('completed')) {
        let current = $(this).attr('data-form');
        let height;
        $('.step-forms section').removeClass('active');
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
        $('.step-forms section').removeClass('active');
        $("#" + current).addClass('active');
    } else if ($(this).hasClass('sub-active')) {
        e.stopPropagation();
        let current = $(this).attr('data-form');
        $('.step-forms section').removeClass('active');
        $("#" + current).addClass('active');
    } else {
        e.stopPropagation();
    }
});

$('.step-forms .trial button').click(function (e) {
    // e.preventDefault();
    // var formvalidate;
    // formvalidate = $(this).valid();
    $(document).scrollTop(0);

    let isAccount = $('#introduction:visible #proceed-to').val() == 'account';
    let current = $(this).parent();
    let currentLink = "[data-form=" + current.attr('id') + "]";
    let next = current.next();
    let height = next.height();

    let nextLink = "[data-form=" + next.attr('id') + "]";
    let circleAttr = $('.circle').attr('stroke-dasharray');
    let percentage = parseInt(circleAttr.substr(0, circleAttr.indexOf(',')));
    current.removeClass('active');
    current.addClass('completed');
    $('.step-forms form').removeClass('active');
    $(".form-lists li:not(.isParent)").removeClass('active');
    $('.step-forms').css('height', height + 'px');

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
            $('.circle').attr('stroke-dasharray', Math.round(100 / formLength) + ', 100');
            $('.percentage').html(percentage + Math.round(100 / formLength) + '%');
        } else if ($(currentLink).hasClass('isChild') && ($(nextLink).hasClass('isChild'))) {
            $(nextLink).addClass('sub-active');
        }
        else {
            $(nextLink).addClass('active');
            $(currentLink).addClass('completed');
            $('.circle').attr('stroke-dasharray', Math.round(100 / formLength) + ', 100');
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

});


$('.income-tab a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
    let height = $('form.active').height();
    $('.step-forms').css('height', height + 'px');
})
