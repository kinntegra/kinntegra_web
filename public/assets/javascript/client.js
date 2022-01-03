$(".back-btn").click(function () {
    //back_to_intro
    $("#loading").show();
    let client_id = $('#client_id').val();
    if($(this).hasClass('back_to_kycdetail'))
    {
        if($("#is_verify").val() == 1 || $("#is_verify").val() == 2)
        {
            window.location.href = '/client/kycdetail/'+client_id+'?is_verify='+$("#is_verify").val();
        }else{
            window.location.href = '/client/kycdetail/'+client_id;
        }
        return false;
    }
    if($(this).hasClass('back_to_intro'))
    {
        if($("#is_verify").val() == 1 || $("#is_verify").val() == 2)
        {
            window.location.href = '/client/introduction/'+client_id+'?is_verify='+$("#is_verify").val();
        }else{
            window.location.href = '/client/introduction/'+client_id;
        }
        return false;
    }
    if($(this).hasClass('back_to_allocation'))
    {
        if($("#is_verify").val() == 1 || $("#is_verify").val() == 2)
        {
            window.location.href = '/client/assetallocation/'+client_id+'?is_verify='+$("#is_verify").val();
        }else{
            window.location.href = '/client/assetallocation/'+client_id;
        }
        return false;
    }
    if($(this).hasClass('back_to_creation'))
    {
        if($("#is_verify").val() == 1 || $("#is_verify").val() == 2)
        {
            window.location.href = '/client/creation/'+client_id+'?is_verify='+$("#is_verify").val();
        }else{
            window.location.href = '/client/creation/'+client_id;
        }

        return false;
    }
    if($(this).hasClass('back_to_mandate'))
    {
        if($("#is_verify").val() == 1 || $("#is_verify").val() == 2)
        {
            window.location.href = '/client/mandate/'+client_id+'?is_verify='+$("#is_verify").val();
        }else{
            window.location.href = '/client/mandate/'+client_id;
        }

        return false;
    }
    if($(this).hasClass('back_to_download'))
    {
        if($("#is_verify").val() == 1 || $("#is_verify").val() == 2)
        {
            window.location.href = '/client/download/'+client_id+'?is_verify='+$("#is_verify").val();
        }else{
            window.location.href = '/client/download/'+client_id;
        }

        return false;
    }
    let current = $(this).parent().closest('section.trial');
    let currentCount = parseInt(current.attr('data-step'));
    let prev = $(".trial[data-step=" + (currentCount - 1) + "]");
    let currentstep = current.attr('data-step');
    let currentid = current.attr('id');


    let prevstep = prev.attr('data-step');
    let prevpid = prev.attr('data-pid');
    let previd = prev.attr('id');
    let currentLink = "[data-form=" + currentid + "]";
    let prevLink = "[data-form=" + previd + "]";
    $('#current_step_id').val(prevstep);
    $('#current_pid').val(prevpid);

    current.removeClass('active');
    prev.addClass('active');
    let prevFirstInputHiddenId = $("#"+previd+" input:hidden").first().attr('id');
    let prevFirstInputHiddenValue = $("#"+prevFirstInputHiddenId).val();
    if(prevFirstInputHiddenValue == 1)
    {
        $('#step_edit').val('0');
    }else{
        $('#step_edit').val('1');
    }
    $('input[name=step]').val(prevstep);
    if ($('.form-lists li' + prevLink).hasClass('completed')) {
        $('.form-lists li' + prevLink).addClass('active ');
        $('.form-lists li' + prevLink).removeClass('completed');
    } else if ($('.form-lists li' + prevLink).hasClass('isChild')) {
        $('.form-lists li' + prevLink).addClass('sub-active');
    }
    $('.form-lists li' + currentLink).removeClass('active ');
    $('.form-lists li' + currentLink).removeClass('sub-active');
    $("#loading").hide();
});

$(".form-lists li").on("click", function (e) {
    let id = $('#client_id').val();
    let pid = $("#current_pid").val();
    let url = "/client/kycinformation/"+id;

    let current = '';

    if(e.target.nodeName === 'UL')
    {
        return false;
    }else{
        current = $(this).attr('data-form');
    }
    $("#loading").show();
    let currentstep =  $("#"+current).attr("data-step");
    $('input[name=step]').val(currentstep);
    if($(this).attr('data-curr-pid'))
    {
        $("#current_pid").val($(this).attr('data-curr-pid'));
    }
    if($(this).attr('data-curr-step-id'))
    {
        $("#current_step_id").val($(this).attr('data-curr-step-id'));
    }
    if(current == 'introduction' && $(this).hasClass('completed'))
    {

        if($("#is_verify").val() == 1 || $("#is_verify").val() == 2)
        {
            window.location.href = '/client/introduction/'+id+'?is_verify='+$("#is_verify").val();
        }else{
            window.location.href = '/client/introduction/'+id;
        }
        return false;
    }
    if(current == 'comprehensive-plan' && $(this).hasClass('completed'))
    {
        if($("#is_verify").val() == 1 || $("#is_verify").val() == 2)
        {
            window.location.href = '/client/comprehensive/'+id+'?is_verify='+$("#is_verify").val();
        }else{
            window.location.href = '/client/comprehensive/'+id;
        }
        return false;
    }
    if(current == 'kyc-information'  && $(this).hasClass('completed'))
    {
        if($("#is_verify").val() == 1 || $("#is_verify").val() == 2)
        {
            window.location.href = '/client/kycdetail/'+id+'?is_verify='+$("#is_verify").val();
        }else{
            window.location.href = '/client/kycdetail/'+id;
        }
        return false;
    }
    if(current == 'allocation_details'  && $(this).hasClass('completed'))
    {
        if($("#is_verify").val() == 1 || $("#is_verify").val() == 2)
        {
            window.location.href = '/client/assetallocation/'+id+'?is_verify='+$("#is_verify").val();
        }else{
            window.location.href = '/client/assetallocation/'+id;
        }
        return false;
    }

    if(current == 'account_creation'  && $(this).hasClass('completed'))
    {
        if($("#is_verify").val() == 1 || $("#is_verify").val() == 2)
        {
            window.location.href = '/client/creation/'+id+'?is_verify='+$("#is_verify").val();
        }else{
            window.location.href = '/client/creation/'+id;
        }
        return false;
    }

    if(current == 'mandate'  && $(this).hasClass('completed'))
    {
        //window.location.href = '/client/mandate/'+id;
        if($("#is_verify").val() == 1 || $("#is_verify").val() == 2)
        {
            window.location.href = '/client/mandate/'+id+'?is_verify='+$("#is_verify").val();
        }else{
            window.location.href = '/client/mandate/'+id;
        }
        return false;
    }

    if(current == 'download'  && $(this).hasClass('completed'))
    {
        //window.location.href = '/client/dwonload/'+id;
        if($("#is_verify").val() == 1 || $("#is_verify").val() == 2)
        {
            window.location.href = '/client/download/'+id+'?is_verify='+$("#is_verify").val();
        }else{
            window.location.href = '/client/download/'+id;
        }
        return false;
    }

    if(current == 'upload'  && $(this).hasClass('completed'))
    {
        //window.location.href = '/client/upload/'+id;
        if($("#is_verify").val() == 1 || $("#is_verify").val() == 2)
        {
            window.location.href = '/client/upload/'+id+'?is_verify='+$("#is_verify").val();
        }else{
            window.location.href = '/client/upload/'+id;
        }
        return false;
    }

    if ($(this).hasClass('completed')) {
        $('.trial').removeClass('active');
        $(".form-lists li").removeClass('active');
        $("#" + current).addClass('active');
        $(this).addClass('active');

    } else if ($(this).hasClass('isParent') && $(this).hasClass('active')) {
        $('.trial').removeClass('active');
        $("#" + current).addClass('active');
    } else if ($(this).hasClass('sub-active')) {
        e.stopPropagation();
        $('.trial').removeClass('active');
        $("#" + current).addClass('active');
    } else {
        e.stopPropagation();
    }
    $("#loading").hide();
});
