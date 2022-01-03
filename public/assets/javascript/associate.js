$('input[name=entity_name],input[name=authorised_person1],input[name=authorised_person2],input[name=authorised_person3]').keypress(validateName);
$('input[name=aadhar_no]').keypress(validateAadharNumber);
$('input[name=mobile],input[name=nominee_mobile],input[name=guardian_mobile]').keypress(validateMobile);
$('input[name=mobile],input[name=nominee_mobile],input[name=guardian_mobile]').keyup(validateMobileFirst);
$('input[name=telephone],input[name=nominee_telephone],input[name=guardian_telephone]').keypress(validatePhone);
$('input[name=address1],input[name=address2],input[name=address3],input[name=nominee_address1],input[name=nominee_address2],input[name=nominee_address3],input[name=guardian_address1],input[name=guardian_address2],input[name=guardian_address3]').keypress(validateAddress);
$('input[name=pincode],input[name=nominee_pincode],input[name=guardian_pincode]').keypress(validatePincode);
$(".entity_name,.authorised_person1,.authorised_email1,.authorised_person2,.authorised_email2,.authorised_person3,.authorised_email3").hide();
$('input[name=account_no],input[name=mfd_ria_account_no]').keypress(validateAccountNumber);
$('input[name=arn_rgn_no],input[name=euin_no]').keypress(validateARN_EUIN);
$('input[name=ria_rgn_no]').keypress(validateSEBI_RIA);
$('input[name=pan_no],input[name=guardian_pan_no]').keypress(validatePanNo);
$('input[name=nism_va_no],input[name=nism_xa_no],input[name=nism_xb_no]').keypress(validateTenNo);
$('#reject').hide();
$('input[name=gst_no]').keypress(validateGstNo);
$(".aadhar_no,.aadhar_upload,.photo_upload").hide();
var formLength = $('.step-forms .trial').length;
$(window).on('load', function () {
    //$('#loading').show();
    // let height = $('.step-forms .active').height();
    // $('.step-forms').css('height', height + 'px');
    console.log($('#associate_edit').val());
    $('input[name="birth_incorp_date"],input[name="nominee_birth_date"],input[name="gst_validity"],input[name="shop_est_validity"]').datepicker({
        autoclose: true,
        format: "dd-mm-yyyy"
    });
    $('input[name="arn_validity"],input[name="euin_validity"],input[name="ria_validity"]').datepicker({
        autoclose: true,
        format: "dd-mm-yyyy"
    });
    $('input[name="nism_va_validity"],input[name="nism_xa_validity"],input[name="nism_xb_validity"],input[name="cfp_validity"],input[name="cwm_validity"]').datepicker({
        autoclose: true,
        format: "dd-mm-yyyy"
    });

    $('input[name="ca_validity"],input[name="cs_validity"],input[name="course_validity"]').datepicker({
        autoclose: true,
        format: "dd-mm-yyyy"
    });
    $('#loading').hide();
});

$(".back-btn").click(function () {
    //let current = $(this).parent().parent().parent().parent();
    let current = $(this).parent().closest('section.trial');
    let currentCount = parseInt(current.attr('data-step'));
    let edit = $("#associate_edit").val();
    let count = 0;
    let step_count = 0;
    if(edit == 1)
    {
        if(current.prev('section').hasClass('completed'))
        {
            count = count+1;
        }else if(current.prev('section').prev('section').hasClass('completed')){
            count = count+2;
        }else if(current.prev('section').prev('section').prev('section').hasClass('completed')){
            count = count+3;
        }else if(current.prev('section').prev('section').prev('section').prev('section').hasClass('completed')){
            count = count+4;
        }else if(current.prev('section').prev('section').prev('section').prev('section').prev('section').hasClass('completed')){
            count = count+5;
        }else{
            count = count+1;
        }
    }else{
        count = count+1;
    }

    let prev = $(".trial[data-step=" + (currentCount - count) + "]");
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

    //Logic if User click on Prev Icon then set disable
    $edit = $("#associate_edit").val();
    if($edit == 1)
    {
        $('#step_edit').val('0');
        $('#'+ previd +' input, #'+ previd +' select').attr('readonly', 'readonly');
        $('#'+ previd +' input[type=file]').parent("label").attr('readonly', 'readonly');
    }
});


// $(".form-lists li").on("click", function () {

//     if ($(this).hasClass('completed')) {
//         let current = $(this).attr('data-form');
//         let height;
//         $('.step-forms form').removeClass('active');
//         $(".form-lists li").removeClass('active');
//         if ($(this).hasClass('isParent')) {
//             let child = $(this).children('.isChild');
//             child = $(this).children('ul').children(':first-child');
//             $(this).addClass('active');
//             let childLink = child.attr('data-form');
//             $("#" + childLink).addClass('active');
//             height = $("#" + childLink).height();
//         } else {
//             $("#" + current).addClass('active');
//             $(this).addClass('active');
//             height = $("#" + current).height();
//         }
//         $('.step-forms').css('height', height + 'px');
//     }
// });

$(".form-lists li").on("click", function (e) {
    let current = $(this).attr('data-form');
    let currentstep =  $("#"+current).attr("data-step");
    let status = $('#status').val();
    let currentid = $("#"+current).attr('id');
    $('input[name=step]').val(currentstep);
    $('.trial').removeClass('active');

    if ($(this).hasClass('completed')) {
        $(".form-lists li").removeClass('active');
        $("#" + current).addClass('active');
        $(this).addClass('active');
    } else if ($(this).hasClass('isParent') && $(this).hasClass('active')) {
        $("#" + current).addClass('active');
    } else if ($(this).hasClass('sub-active')) {
        e.stopPropagation();
        $("#" + current).addClass('active');
    } else {
        e.stopPropagation();
    }
    //Addition Logic
    if(document.location.pathname.indexOf("/details") != -1){
        $('#step_edit').val('0');
    }else{
    if ($('#'+currentid).hasClass("completed"))
    {
            if(currentstep == 11)
            {
                if(status == 10 || status == 8)
                {
                    $('#step_edit').val('0');
                }else{

                    $('#step_edit').val('1');
                }
            }else if(currentstep == 12) {
                $('#step_edit').val('1');
            }else{
                $('#step_edit').val('0');
            }
        }else{
            $('#step_edit').val('1');
        }
    }
    // if(currentstep == 11 || currentstep == 12)
    // {
    //     if(status != 10)
    //     {
    //         if(currentstep == 12){$('#step_edit').val('1');}
    //         else{$('#step_edit').val('0');}
    //     }else{$('#step_edit').val('1');}
    // }else{$('#step_edit').val('0');}

});


$('.step-forms .trial button.proceed').click(function (e) {
    e.preventDefault();
    $(document).scrollTop(0);
    disableEnter(e);
    let isAccount = $('#introduction:visible #proceed-to').val() == 'account';
    let current = '';
    if($(this).parent().hasClass('trial'))
    {
        current = $(this).parent();
    }else{
        current = $(this).parent().closest('section.trial');
    }
    //let current = $(this).parent().closest('section');//.parent().parent().parent().parent().parent();

    let step_edit = $('#step_edit').val();
    let associate_edit = $('#associate_edit').val();
    let associate_id = $('#associate_id').val();
    console.log(associate_edit, step_edit);
    //return false;
    if(associate_edit == 1 && step_edit == 0)
    {
        $('#loading').show();
        nextSteper(current,isAccount,associate_id);
        return false;
    }

    let post = $('form#form-information').attr('method');
    let url = $('form#form-information').attr('action');
    let formData = new FormData($('#form-information')[0]);
    console.log('sasa');
    $('.error').removeClass('error');
    $('.err').removeClass('err');
    $('.span_err').remove();
    //console.log('shashi reached');
    $.ajax({
        // headers: {
        //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        // },
        type: post,
        url: url,
        data: formData,
        //async: false,
        beforeSend: function() {//xhr, type
            // if (!type.crossDomain) {
            //     xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
            // }
            $('#loading').show();
        },
        success:function(data) {
            $('#loading').show();
            console.log(data);
            //return false;
            if(data.id)
            $('input[name="associate_id"]').val(data.id);
            //Main Data

            nextSteper(current,isAccount,data.id);

        },
        error: function(xhr, textStatus, thrownError)
        {
            $('#loading').hide();
            console.log(xhr);
            var error = jQuery.parseJSON(xhr.responseText);
            //console.log(error);
            $.each( error.errors, function( k, v ) {
                console.log(k);
                //$('.'+k).children().closest("label").addClass('err');
                //$('.'+k).children().find("div").addClass('error');
                //$('.'+k).children().find("label").addClass('err');
                if(k == 'bse_upload')
                {
                    $('.'+k).children().not("div.exclude").not("label").not("span").append("<div id='"+k+"_error' class='error span_err'>"+v+"</div>");
                }else{
                    $('.'+k).children().not("div.exclude").not("label").not("span").append("<label id='"+k+"_error' class='error span_err'>"+v+"</label>");
                }
            });

        },
        cache: false,
        contentType: false,
        processData: false,
        //timeout: 8000,
    });

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
    let status = $('input[name=status]').val();
    let minor = $('#is_minor').val();
    let next = '';
    if(currentstep == 7)
    {
        if(profession == 1 || profession == 2 || profession == 3)
        {
            if(entitytype == 1 || entitytype == 2 || entitytype ==3)
            {
                next = $(".trial[data-step=" + (currentCount + 4) + "]");
            }
            else{
                next = $(".trial[data-step=" + (currentCount + 1) + "]");
            }
        }else{
            next = $(".trial[data-step=" + (currentCount + 1) + "]");
        }
    }else if(currentstep == 8)
    {
        if(entitytype == 1 || entitytype == 2 || entitytype ==3)
        {
            next = $(".trial[data-step=" + (currentCount + 3) + "]");
        }
        else{
            next = $(".trial[data-step=" + (currentCount + 1) + "]");
        }
    }else if(currentstep == 9)
    {
        if(minor == 0)
        {
            next = $(".trial[data-step=" + (currentCount + 2) + "]");
        }
        else{
            next = $(".trial[data-step=" + (currentCount + 1) + "]");
        }
    }else if(currentstep == 11)
    {
        if(document.location.pathname.indexOf("/details") != -1){
            next = $(".trial[data-step=" + (currentCount + 1) + "]");
        }else{
            if(status == 10 || status == 8)
            {
                next = $(".trial[data-step=" + (currentCount + 1) + "]");
            }else{
                $.get("/encrypt?data="+id, function(data, status){
                    //window.location.href = '/associate/'+data;
                    window.location.replace('/associate/'+data);
                });
                return true;
            }
        }
       //
    }else if(currentstep == 12){
        $.get("/encrypt?data="+id, function(data, status){
            //window.location.href = '/associate/'+data;
            window.location.replace('/associate/'+data+'/message');
        });
        return true;
    }else{
        next = $(".trial[data-step=" + (currentCount + 1) + "]");
    }

    // let height = next.height();
    //console.log(next);
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
        $('#'+nextid+' select').select2({
            width: '100%',
            minimumResultsForSearch: 5
        });
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
        $('.circle').attr('stroke-dasharray', Math.round((currentCount / formLength) * 100) + ', 100');
        $('.percentage').html(Math.round((currentCount / formLength) * 100) + '%');
    }
    //console.log(current.serializeArray());
    setTimeout(() => {
        current.hide();
        console.log(nextid);
        //var pathname = window.location.pathname; // Returns path only (/path/example.html)
        if(document.location.pathname.indexOf("/details") != -1){
            $('#step_edit').val('0');
        }else{
            if ($('#'+nextid).hasClass("completed"))
            {
                if(nextstep == 11)
                {
                    if(status == 10 || status == 8)
                    {
                        $('#step_edit').val('0');
                    }else{

                        $('#step_edit').val('1');
                    }
                }else if(nextstep == 12) {
                    $('#step_edit').val('1');
                }else{
                    $('#step_edit').val('0');
                }
            }else{
                $('#step_edit').val('1');
            }
        }

        $('#loading').hide();
        $('select').select2({
            width: '100%',
            minimumResultsForSearch: 5
        });
        $('input[name="birth_incorp_date"],input[name="nominee_birth_date"],input[name="gst_validity"],input[name="shop_est_validity"]').datepicker({
            autoclose: true
        });
        $('input[name="arn_validity"],input[name="euin_validity"],input[name="ria_validity"]').datepicker({
            autoclose: true
        });
        $('input[name="nism_va_validity"],input[name="nism_xa_validity"],input[name="nism_xb_validity"],input[name="cfp_validity"],input[name="cwm_validity"]').datepicker({
            autoclose: true
        });

        $('input[name="ca_validity"],input[name="cs_validity"],input[name="course_validity"]').datepicker({
            autoclose: true
        });

        //cs_validity
        $('input[name="primary_color').ColorPicker();
        $('input[name="secondary_color').ColorPicker();

    }, 500);
    return true;
}
// $('.income-tab a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
//     let height = $('form.active').height();
//     $('.step-forms').css('height', height + 'px');
// });

//Start

$(document).on('change', '#business_tag', function () {

    let business = $(this).val();
    businesstag_cs_ca_other(business);

});

function businesstag_cs_ca_other(business)
{
    let associate = $( "select#introducer_id option:selected" ).val();
    let employee = $( "select#employee_id option:selected" ).val();
    let profession = $( "select#profession_id option:selected" ).val();
    let url = '';
    if(profession == 4 || profession == 5 || profession == 6)
    {
        if(associate)
        {
            $.get("/encrypt?data="+associate, function(data, status){
                url += "/associate/"+data;
                if(employee)
                {
                    $.get("/encrypt?data="+employee, function(data, status){
                        url += "/employee/"+data;
                        getProfessionDetails(url);
                    });
                }else{
                    getProfessionDetails(url);
                }
            });
        }

    }

}

function getProfessionDetails(url)
{
    $.get(url, function(data, status){
        let prof = data.profession_id;
        console.log(data);
        if(prof == 1 || prof == 3)
        {
            $("#arn_details").show();
            $("#euin_details").show();
            $("#arn_name").val(data.arn_name);
            $("#arn_rgn_no").val(data.arn_rgn_no);
            $("#arn_validity").val(data.arn_validity);
            $(".arn_upload,.euin_upload").hide();
            $(".arn_view,.euin_view").show();
            $("#euin_name").val(data.euin_name);
            $("#euin_no").val(data.euin_no);
            $("#euin_validity").val(data.euin_validity);
            if(data.arn_upload)
            {
                $(".arn_view span.default-text").html('View Copy');
                $("#arn_view").attr("onclick","showImage('"+data.arn_upload+"')");
                $("#arn_name,#arn_rgn_no,#arn_validity").attr('readonly', true);
            }else{
                $(".arn_view span.default-text").html('Not Uploaded');
            }
            if(data.euin_upload)
            {
                $(".euin_view span.default-text").html('View Copy');
                $("#euin_view").attr("onclick","showImage('"+data.euin_upload+"')");
                $("#euin_name,#euin_no,#euin_validity").attr('readonly', true);
            }else{
                $(".euin_view span.default-text").html('Not Uploaded');
            }
        }else if(prof == 2 || prof == 3){
            $("#ria_details").show();
            $("#ria_name").val(data.ria_name);
            $("#ria_rgn_no").val(data.ria_rgn_no);
            $("#ria_validity").val(data.ria_validity);
            $(".ria_upload").hide();
            $(".ria_view").show();
            if(data.ria_upload)
            {
                $(".ria_view span.default-text").html('View Copy');
                $("#ria_view").attr("onclick","showImage('"+data.ria_upload+"')");
                $("#ria_name,#ria_rgn_no,#ria_validity").attr('readonly', true);
            }else{
                $(".ria_view span.default-text").html('Not Uploaded');
            }
        }else{
            $('#business_tag').val(null).trigger('change');
            $('.business_tag').children().not("div.exclude").not("label").not("span").append("<label id='business_tag_error' class='error span_err'>Please select differeent Introducer</label>");
        }
    });
}

$(document).on('change', '#profession_id', function () {

    var profession = $(this).val();//alert(profession);
    let edit = $("#associate_edit").val();
    set_Profession(profession);
    set_bussinesstag(profession);
    if(edit == 0)
    {
        $('#entitytype_id').val(null).trigger('change');
        $('#entity-detail').find('input').val('');
    }

});

function set_Profession(profession)
{
    if(!profession)
    {
        return false;
    }
    let edit = $("#associate_edit").val();
    let entitytype = $( "select#entitytype_id option:selected" ).val();
    $("#arn_details,#euin_details,#ria_details").hide();
    $("#nism_va_details,#ria_type,#nism_xa_details,#nism_xb_details,#cfp_details,#cwm_details,#ca_details,#cs_details,#course_details").hide();
    if(profession == 1){
        //step1
        $("#business_tag").select2("val", "0");
        //step2
        $('#entitytype_id').children('option').prop('disabled', false);
        //step5
        $("#mfd_ria_bank,.mdf_ria").hide();
        //step7
        $("#arn_details").show();
        $("#euin_details").show();
        //step8
        if(entitytype && entitytype == 4){
            $("#nism_va_details").show();
        }else{
            $("#nism_va_details").hide();
        }

    }else if(profession == 2){
        //step1
        $("#business_tag").select2("val", "0");
        //step2
        $('#entitytype_id').children('option').prop('disabled', false);
        //step5
        $("#mfd_ria_bank,.mdf_ria").hide();
        //step7
        $("#ria_details").show();
        //step8
        if(entitytype && entitytype == 4){
            $("#ria_type").show();
        }else{
            $("#ria_type").hide();
        }

    }else if(profession == 3){
        //step1
        $("#business_tag").select2("val", "0");
        //step2
        $('#entitytype_id').children('option').prop('disabled', true);
        $('#entitytype_id').children('option[value="2"],option[value="3"]').prop('disabled',false);
        //step5
        $("#mfd_ria_bank,.mdf_ria").show();
        //step7
        $("#arn_details").show();
        $("#euin_details").show();
        $("#ria_details").show();
        //step8
        if(entitytype && entitytype == 4){
            $("#nism_va_details").show();
            $("#ria_type").show();
        }else{
            $("#nism_va_details").hide();
            $("#ria_type").hide();
        }
    }else{
        //step2
        $('#entitytype_id').children('option').prop('disabled', false);
        $("#mfd_ria_bank,.mdf_ria").hide();
        if(profession == 4){
            $("#ca_details").show();
        }else if(profession == 5){
            $("#cs_details").show();
        }else if(profession == 6){
            $("#course_details").show();
        }
        // let introducer_id_val = $( "select#introducer_id option:selected" ).val();
        // let employee = $( "select#employee_id option:selected" ).val();

        // let val = introducer_id_val+'.'+employee;
        // if(val)
        // {
        //     $('#business_tag').val(val);
        //     $('#business_tag').select2().trigger('change');
        // }

        // $.get("/master/bankcode/"+value, function(data, status){

        // });
        // let id = $('#in').val();
        // $.get("/encrypt?data="+id, function(data, status){

        // });

        // $("#arn_details").show();
        // $("#euin_details").show();
        // $("#ria_details").show();
    }
}

function set_bussinesstag(profession, code = '')
{
    let associate = $( "select#introducer_id option:selected" ).val();
    let text = '';
    let value = '';
    let atext = $( "select#introducer_id option:selected" ).text();
    let employee = $( "select#employee_id option:selected" ).val();
    let business = $("#business_code").val();
    let edit = $("#associate_edit").val();
    if(atext != 'Self')
    {
        text += atext
    }
    if(!employee)
    {
        employee = 0;

    }else{
        let etext = $( "select#employee_id option:selected" ).text();
        text +='-';
        text +=etext
    }
    value = associate+'-'+employee;
    let business_value = '';
    business_value += '<option value="" disabled selected>Select Business Tag</option>';
    if(profession == 1 || profession == 2 || profession == 3)
    {
        business_value += '<option value="0">Self</option>';
    }

    business_value += '<option value="'+value+'">'+text+'</option>';
    $('#business_tag').html(business_value);
    if(edit == 0)
    {
        $("#business_tag").attr('readonly', false);
        if(profession == 1 || profession == 2 || profession == 3)
        {
            $('select#business_tag').val('0').trigger('change');
        }
    }
    if(code)
    {
        $('select#business_tag').val(code).trigger('change');
    }

}

$(document).on('change', '#entitytype_id', function () {
    var entityType = $(this).val();
    set_entitytype(entityType);
});

function set_entitytype(entityType)
{
    let profession = $( "select#profession_id option:selected" ).val();
    //Step 2 Show And Hide
    $(".entity_name,.authorised_person1,.authorised_email1,.authorised_person2,.authorised_email2,.authorised_person3,.authorised_email3").hide();
    // //Step 3
    $(".aadhar_no,.aadhar_upload,.photo_upload").hide();
    // //Step 4
    $("#co_details, #pd_details, #shop_est_details").hide();
    // //
    if(entityType == 1){
        //Step 2
        $(".entity_name,.authorised_person1,.authorised_email1").show();
        $('label[for="authorised_person1"]').html('Authorised Person <span class="required-sign">*</span>');
        $('label[for="authorised_email1"]').html('Email <span class="required-sign">*</span>');
        $(".authorised_person2,.authorised_email2,.authorised_person3,.authorised_email3").hide();
        //Step 3
        $("#birth_incorp_date").html("Date of Incorporation");
        $(".aadhar_no,.aadhar_upload").show();
        $(".photo_upload").hide();
        //Step 6
        $("#shop_est_details").show();
        //step 8
        if(profession == 1 || profession == 2 || profession ==3)
        {
            $("#nism_va_details").hide();
            $("#ria_type").hide();
            $('li[data-form=euin-detail]').hide();
        }
        //Left Menu
        $('li[data-form=nominee-detail]').hide();


    }else if(entityType == 2){
        //Step 2
        $(".entity_name,.authorised_person1,.authorised_email1,.authorised_person2,.authorised_email2,.authorised_person3,.authorised_email3").show();
        $('label[for="authorised_person1"]').html('Authorised Person 1 <span class="required-sign">*</span>');
        $('label[for="authorised_email1"]').html('Email 1 <span class="required-sign">*</span>');
        //Step 3
        $("#birth_incorp_date").html("Date of Incorporation");
        $(".aadhar_no,.aadhar_upload,.photo_upload").hide();
        //step6
        $("#pd_details").show();
        //step 8
        if(profession == 1 || profession == 2 || profession ==3)
        {
            $("#nism_va_details").hide();
            $("#ria_type").hide();
            $('li[data-form=euin-detail]').hide();
        }
        //Left Menu
        $('li[data-form=nominee-detail]').hide();

    }else if(entityType == 3){
        //Step 2
        $(".entity_name,.authorised_person1,.authorised_email1,.authorised_person2,.authorised_email2,.authorised_person3,.authorised_email3").show();
        $('label[for="authorised_person1"]').html('Authorised Person 1 <span class="required-sign">*</span>');
        $('label[for="authorised_email1"]').html('Email 1 <span class="required-sign">*</span>');
        //Step 3
        $("#birth_incorp_date").html("Date of Incorporation");
        $(".aadhar_no,.aadhar_upload,.photo_upload").hide();
        //step 6
        $("#co_details").show();
        //step 8
        if(profession == 1 || profession == 2 || profession ==3)
        {
            $("#nism_va_details").hide();
            $("#ria_type").hide();
            $('li[data-form=euin-detail]').hide();
        }
        //Left Menu
        $('li[data-form=nominee-detail]').hide();

    }else if(entityType == 4){
        //Step 2
        $(".authorised_person1,.authorised_email1").show();
        $('label[for="authorised_person1"]').html('Authorised Person <span class="required-sign">*</span>');
        $('label[for="authorised_email1"]').html('Email <span class="required-sign">*</span>');
        $(".entity_name,.authorised_person2,.authorised_email2,.authorised_person3,.authorised_email3").hide();
        //Step 3
        $("#birth_incorp_date").html("Date of Birth");
        $(".aadhar_no,.aadhar_upload,.photo_upload").show();
        //step 4

        //step 8
        if(profession == 1)
        {
            $("#nism_va_details").show();
            $('li[data-form=euin-detail]').show();
        }
        if(profession == 2)
        {
            $("#ria_type").show();
            $('li[data-form=euin-detail]').show();
        }
        //Left Menu
        $('li[data-form=nominee-detail]').show();

    }

    if(profession == 4){
        $("#ca_details").show();
        $('li[data-form=euin-detail]').show();
    }else if(profession == 5){
        $("#cs_details").show();
        $('li[data-form=euin-detail]').show();
    }else if(profession == 6){
        $("#course_details").show();
        $('li[data-form=euin-detail]').show();
    }
}

$(document).on('change', '#ria_certificate_type', function (e) {
    certificate_type();
});

function certificate_type()
{
    let types = $('#ria_certificate_type').children().find('input:checked').map(function(i, e) {return e.value}).toArray();
    $("#nism_xa_details,#nism_xb_details,#cfp_details,#cwm_details").hide();
    $('input[name=ria_type_nism]').val('0');
    $('input[name=ria_type_cfp]').val('0');
    $('input[name=ria_type_cwm]').val('0');
    if(types)
    {
        $.each(types, function(i, val){
            if(val){
                if(val == "nism"){
                    $("#nism_xa_details,#nism_xb_details").show();
                    $('input[name=ria_type_nism]').val('1');
                }else if(val == "cfp"){
                    $("#cfp_details").show();
                    $('input[name=ria_type_cfp]').val('1');
                }else{
                    $("#cwm_details").show();
                    $('input[name=ria_type_cwm]').val('1');
                }
            }
        });
    }
}

$(document).on('blur', '#ifsc_no', function (e) {
    let value = e.target.value;
    $.get("/admin/master/bankcode/"+value, function(data, status){
        if(data){
            $('#bank_name').val(data.bank).prop('readonly', true);
            $('#branch_name').val(data.branch).prop('readonly', true);
            $('#micr').val(data.micr_code).prop('readonly', true);
        }else{
            $('#bank_name').val('').prop('readonly', false);
            $('#branch_name').val('').prop('readonly', false);
            $('#micr').val('').prop('readonly', false);
        }
    });
});
$(document).on('blur', '#mfd_ria_ifsc_no', function (e) {
    let value = e.target.value;
    $.get("/admin/master/bankcode/"+value, function(data, status){
        if(data){
            $('#mfd_ria_bank_name').val(data.bank).prop('readonly', true);
            $('#mfd_ria_branch_name').val(data.branch).prop('readonly', true);
            $('#mfd_ria_micr').val(data.micr_code).prop('readonly', true);
        }else{
            $('#mfd_ria_bank_name').val('').prop('readonly', false);
            $('#mfd_ria_branch_name').val('').prop('readonly', false);
            $('#mfd_ria_micr').val('').prop('readonly', false);
        }
    });
});

$("input[name=entity_name]").keyup(function(e){
    let value = e.target.value;
    $("input[name=name]").val(value).prop('readonly', true);
});

$("input[name=authorised_person1]").keyup(function(e){
    let value = e.target.value;
    let etype = $( "select#entitytype_id option:selected" ).val();
    let profession = $( "select#profession_id option:selected" ).val();
    if(etype == 4){
        $("input[name=name]").val(value).prop('readonly', true);
        $("input[name=entity_name]").val(value);
        if(profession == 1)
        {
            $("input[name=arn_name]").val(value);
            $("input[name=euin_name]").val(value);
        }else if(profession == 2){
            $("input[name=ria_name]").val(value);
        }
    }
});

$("input[name=authorised_email1]").keyup(function(e){
    let value = e.target.value;
    let etype = $( "select#entitytype_id option:selected" ).val();
    if(etype == 4){
        $("input[name=email]").val(value);
        $("input[name=email]").attr('readonly', true);
    };

});

$(document).on('change', '#introducer_id', function (e) {
    let value = e.target.value;
    let text = $( "select#introducer_id option:selected" ).text();
    getEmployee(value);
});

function getEmployee(value,code = '')
{
    $('#employee_id').empty();
    let edit = $("#associate_edit").val();

    if(value > 0)
    {
        $.get("/associate/"+value+"/employee", function(data, status){
            console.log(data);

            if(data.length > 0)
            {
                let emp = '';
                $('input[name=has_employee]').val(1);
                emp += '<option value="" disabled selected>Select Employee</option>';
                $.each(data, function(i,o){
                    emp += '<option value="'+o.id+'">'+o.name+'</option>';
                });
                $('#employee_id').html(emp);
                $('.employee_id').show();
                if(edit == 0)
                {
                    $("#employee_id").attr('readonly', false);
                    $("#profession_id").attr('readonly', false);
                }
                if(code)
                {
                    $('select#employee_id').val(code).trigger('change');
                }
            }else{
                $('input[name=has_employee]').val(0);
                $('.employee_id').hide();
                if(edit == 0)
                {
                    $("#employee_id").attr('readonly', true);
                    $("#profession_id").attr('readonly', false);
                    let text = $( "select#introducer_id option:selected" ).text();
                    if(value == 1 && text == 'Self')
                    {
                        $('#profession_id').children('option').prop('disabled', true);
                        $('#profession_id').children('option[value="1"],option[value="2"],option[value="3"]').prop('disabled',false);
                    }
                }
            }

        });
    }else{
        $("#employee_id").attr('readonly', false);
        $("#profession_id").attr('readonly', false);
    }
}

$(document).on('click', '#nominee_primary_address', function (e) {
    let id = $('input[name=associate_id]').val()
    if($(this).is(":checked")){
        $(this).val('1');
        let minor = $("#is_minor").val();
        if(minor == 1){
            $('li[data-form=guardian-detail]').show();
        }else{
            $('li[data-form=guardian-detail]').hide();
        }
        $.get("/associate/"+id+"/address", function(data, status){
            if(data)
            {
                $("#nominee_address1").val(data.address1);
                $("#nominee_address2").val(data.address2);
                $("#nominee_address3").val(data.address3);
                $("#nominee_city").val(data.city);
                $("#nominee_country").val(data.country);
                $('#nominee_country').select2().trigger('change');
                getStates(data.country, 'nominee_state',data.state);
                $("#nominee_pincode").val(data.pincode);
            }
        });
    }
    else if($(this).is(":not(:checked)")){
        $(this).val('0');
        $("#nominee_address1").val('');
        $("#nominee_address2").val('');
        $("#nominee_address3").val('');
        $("#nominee_city").val('');
        $("#nominee_country").val('98');
        $('#nominee_country').select2().trigger('change');
        $("#nominee_pincode").val('');
    }
});

$(document).on('click', '#guardian_primary_address', function (e) {
    let id = $('input[name=associate_id]').val()
    if($(this).is(":checked")){
        $(this).val('1');

        $.get("/associate/"+id+"/address", function(data, status){
            if(data)
            {
                $("#guardian_address1").val(data.address1);
                $("#guardian_address2").val(data.address2);
                $("#guardian_address3").val(data.address3);
                $("#guardian_city").val(data.city);
                $("#guardian_country").val(data.country);
                $('#guardian_country').select2().trigger('change');
                getStates(data.country, 'guardian_state',data.state);
                $("#guardian_pincode").val(data.pincode);
            }
        });
    }
    else if($(this).is(":not(:checked)")){
        $(this).val('0');
        $("#guardian_address1").val('');
        $("#guardian_address2").val('');
        $("#guardian_address3").val('');
        $("#guardian_city").val('');
        $("#guardian_country").val('98');
        $('#guardian_country').select2().trigger('change');
        $("#guardian_pincode").val('');
    }
});


$(document).on('change', '#employee_id', function (e) {
    let value = e.target.value;
    // let introducer_id_text = $( "select#introducer_id option:selected" ).text();
    // let employee_text = $( "select#employee_id option:selected" ).text();
    // let introducer_id_val = $( "select#introducer_id option:selected" ).val();
    // let business_value = '';
    // business_value += '<option value="" disabled selected>Select Business Tag</option>';
    // business_value += '<option value="0">Self</option>';
    // business_value += '<option value="'+introducer_id_val+'">'+introducer_id_text+'</option>';
    // business_value += '<option value="'+value+'">'+employee_text+'</option>';
    // //business_value += '<option value="'+value+'">'+employee_text+'</option>';
    // $('#business_tag').html(business_value);
});
$('form').each(function () {
    $(this).validate();
});



function disableEnter(e)
{
    let keyCode = e.keyCode || e.which;
    if (keyCode === 13) {
        e.preventDefault();
        return false;
    }
}

$(document).ready(function() {
    //$('#loading').show();
    $edit = $("#associate_edit").val();
    let state = $("#state_code").val();
    let nominee_state = $("#nominee_state_code").val();
    let guardian_state = $("#guardian_state_code").val();
    let country = $( "select#country option:selected" ).val();
    getStates(country, 'state', state);
    let nominee_country = $( "select#nominee_country option:selected" ).val();
    getStates(nominee_country, 'nominee_state', nominee_state);
    let guardian_country = $( "select#guardian_country option:selected" ).val();
    getStates(guardian_country, 'guardian_state', guardian_state);
    let entityType = $( "select#entitytype_id option:selected" ).val();
    let profession = $( "select#profession_id option:selected" ).val();
    let introducer = $( "select#introducer_id option:selected" ).val();
    let employee = $( "select#employee_id option:selected" ).val();
    let business = $("#business_code").val();
    let minor = $('#is_minor').val();
    $(".arn_view,.euin_view,.ria_view").hide();
    $('#profession_id, #business_tag').attr('readonly', 'readonly');
    if($edit == 1)
    {
        if(profession == 4 || profession == 5 || profession == 6)
        {
            $(".arn_view,.euin_view,.ria_view").show();
            $(".arn_upload,.euin_upload,.ria_upload").show();
        }
        //$('#form-information input, #form-information select').attr('readonly', 'readonly');
        //$('#form-information input[type=file]').parent("label").attr('readonly', 'readonly');
        $( "section" ).each(function() {

            if($(this).hasClass('completed'))
            {
                var section_id = $(this).attr('id');
                $('#'+section_id+' input, #'+section_id+' select').attr('readonly', 'readonly');
                $('#'+section_id+' input[type=file]').parent("label").attr('readonly', 'readonly');
                console.log($(this).attr('id'));
            }else{
                if($(this).attr('id') == 'entity-detail')
                {
                    if(entityType)
                    {
                        var section_id = $(this).attr('id');
                        $('#'+section_id+' input, #'+section_id+' select').attr('readonly', 'readonly');
                        $('#'+section_id+' input[type=file]').parent("label").attr('readonly', 'readonly');
                    }
                }
            }
          });
        if(minor == 1){
            $('li[data-form=guardian-detail]').show();
        }else{
            $('li[data-form=guardian-detail]').hide();
        }
        //getEmployee(introducer,employee);
        if(employee)
        {
            $('#employee_id').attr('readonly', true);
        }
        if(profession)
        {
            set_Profession(profession);
            set_bussinesstag(profession,business);
            businesstag_cs_ca_other(business);
        }

        if(entityType)
        set_entitytype(entityType);
        certificate_type();
        $(".customMulti .data-list a").trigger('click');
        $("#commercial-detail.completed div#commercials :input").each(function(e) {
            if(!$(this).val())
            {
                $(this).prop('readonly', true);
            }
        });

    }
    return true;
});

function getStates($id, $name,$value = '')
{
    $('#'+$name).empty();
    $.get("/admin/master/countries/"+$id+"/states", function(data, status){

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

$(document).on('change', 'select#country,select#nominee_country,select#guardian_country', function (e) {
    let name = e.target.name;
    if(name == 'country')
    {
        let country = $( "select#country option:selected" ).val();
        getStates(country, 'state');
    }
    else if(name == 'nominee_country')
    {
        let nominee_country = $( "select#nominee_country option:selected" ).val();
        getStates(nominee_country, 'nominee_state');
    }
    else if(name == 'guardian_country')
    {
        let guardian_country = $( "select#guardian_country option:selected" ).val();
        getStates(guardian_country, 'guardian_state');
    }

    return true;
});

$(document).on('change', '#nominee_birth_date', function (e) {
    $date = e.target.value;
    var age = calculateAge($date);
    console.log(age);
    if(age >= 18){
        $('#is_minor').val('0');
        $('li[data-form=guardian-detail]').hide();
    }else{$('#is_minor').val('1');$('li[data-form=guardian-detail]').show();}

    return true;
});

$(document).on('keyup', '#commercials input', function (e) {
    let name = e.target.name;
    let val  = e.target.value;
    if(val > 0)
    {
        $('.'+name).parent().children().not("div."+name).find('input[type=number]').prop('readonly', true).val('');
    }
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
    //$("img#show_img").attr("src", $image);
    $("a#download_img").attr("href", $image);
    $('#uploadModal').modal('show');
    return true;
}

$(":input,select_tags").on("keyup change", function(e) {
    $val = $(this).val();
    //console.log($val);
    if($val){
        $name = e.target.name;
        //$('.span_err').remove();
        if($('.'+$name).find('label.span_err').length !== 0)
        {
            $('.'+$name).find('label.span_err').remove();
        }
    }
});

$(".edit-now").on("click", function(e) {

    let value = $(this).parent().closest('section.trial').attr('id');
    $('input[name=step_edit]').val(1);
    if(value == 'license-detail')
    {
        //let edit = $("#associate_edit").val();
        let profession = $( "select#profession_id option:selected" ).val();

        if(profession < 3)
        {
            $(".arn_upload,.euin_upload").show();
            $(".arn_view,.euin_view").hide();
            $(".ria_upload").show();
            $(".ria_view").hide();
            $('#'+value+' input, #'+value+' select, #'+value+' label').attr('readonly', false);
        }
    }
    else{
        $('#'+value+' input, #'+value+' select, #'+value+' label').attr('readonly', false);
        //$('#'+value)
    }

});

$(".reject-now").on("click", function(e) {
    $("#userstatus").val('1');
    $('#RejectModal').modal('show');
});

$('input[type=radio][name=userstatus]').change(function(e) {

    $val = $('[name=userstatus]').val();
    console.log($val);

    if(this.value == '1')
    {
        $('#reject').show();
    }else if(this.value == '0')
    {
        $('#reject').hide();
    }
//     if (this.value == 'upi') {
//      //write your logic here

//      }
//    else if (this.value == 'bankAcc') {
//      //write your logic here
//   }
  });

  $(document).on('click', '#bse_upload', function (e) {
    let id = $('input[name=associate_id]').val()
    if($(this).is(":checked")){
        $(this).val('1');
        $('#bse_send_email').attr('disabled',false);
    }
    else if($(this).is(":not(:checked)")){
        $(this).val('0');
        $('#bse_send_email').attr('disabled',true);
    }
  });
