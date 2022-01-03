$('input[name=name]').keypress(validateName);
$('input[name=aadhar_no]').keypress(validateAadharNumber);
$('input[name=mobile],input[name=contact_mobile1],input[name=contact_mobile2]').keypress(validateMobile);
$('input[name=mobile],input[name=contact_mobile1],input[name=contact_mobile2]').keyup(validateMobileFirst);
$('input[name=telephone]').keypress(validatePhone);
$('input[name=c_address1],input[name=c_address2],input[name=c_address3]').keypress(validateAddress);
$('input[name=p_address1],input[name=p_address2],input[name=p_address3]').keypress(validateAddress);
$('input[name=c_pincode],input[name=p_pincode]').keypress(validatePincode);
$('input[name=account_no]').keypress(validateAccountNumber);
$('#mfd_ria_type,#nism_va_details,#euin_details').hide();
$('#ria_type,#nism_xa_details,#nism_xb_details,#cfp_details,#cwm_details').hide();
$('#ca_cs_type,#ca_details,#cs_details,#course_details').hide();
$('input[name=nism_va_no],input[name=nism_xa_no],input[name=nism_xb_no]').keypress(validateTenNo);
$('input[name=pan_no]').keypress(validatePanNo);
$('input[name=arn_rgn_no],input[name=euin_no]').keypress(validateARN_EUIN);
$('input[name=ria_rgn_no]').keypress(validateSEBI_RIA);
var formLength = $('.step-forms .trial').length;
$(window).on('load', function () {
    //let height = $('.step-forms .active').height();
    //$('.step-forms').css('height', height + 'px');
    $('input[name="birth_date"],input[name="anniversary_date"]').datepicker({
        autoclose: true,
        format: "dd-mm-yyyy"
    });
    $('input[name="nism_va_validity"],input[name="nism_xa_validity"],input[name="nism_xb_validity"],input[name="cfp_validity"],input[name="cwm_validity"],input[name="euin_validity"]').datepicker({
        autoclose: true,
        format: "dd-mm-yyyy"
    });

    $('input[name="ca_validity"],input[name="cs_validity"],input[name="course_validity"]').datepicker({
        autoclose: true,
        format: "dd-mm-yyyy"
    });

});

$(".back-btn").click(function () {
    //let current = $(this).parent().parent().parent().parent();
    let current = $(this).parent().closest('section.trial');
    let currentCount = parseInt(current.attr('data-step'));
    let edit = $("#employee_edit").val();
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

    if(edit == 1)
    {
        $('#step_edit').val('0');
        $('#'+ previd +' input, #'+ previd +' select').attr('readonly', 'readonly');
        $('#'+ previd +' input[type=file]').parent("label").attr('readonly', 'readonly');
    }
});


$(".form-lists li").on("click", function (e) {
    let current = $(this).attr('data-form');
    let currentstep =  $("#"+current).attr("data-step");
    $('input[name=step]').val(currentstep);
    $('.trial').removeClass('active');
    let currentid = $("#"+current).attr('id');
    let status = $('#status').val();
    console.log(currentid);
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

    if(document.location.pathname.indexOf("/details") != -1){
        $('#step_edit').val('0');
    }else{
            if ($('#'+currentid).hasClass("completed"))
            {
                if(currentstep == 6)
                {
                    if((status == 10 || status == 8) && department_id == 1)
                    {
                        $('#step_edit').val('0');
                    }else{

                        $('#step_edit').val('1');
                    }
                }else if(currentstep == 7) {
                    $('#step_edit').val('1');
                }else{
                    $('#step_edit').val('0');
                }
            }else{
                $('#step_edit').val('1');
            }
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
    let associate_id = $('#associate_id').val();
    let employee_id = $('#employee_id').val();
    console.log(employee_edit, step_edit);
    if(employee_edit == 1 && step_edit == 0)
    {
        $('#loading').show();
        nextSteper(current,isAccount,associate_id,employee_id);
        return false;
    }

    let post = $('form#form-information').attr('method');
    let url = $('form#form-information').attr('action');
    let formData = new FormData($('#form-information')[0]);

    $('.error').removeClass('error');
    $('.err').removeClass('err');
    $('.span_err').remove();


    $.ajax({
        type: post,
        url: url,
        data: formData,
        //async: false,
        beforeSend: function() {
            $('#loading').show();
        },
        success:function(data) {
            $('#loading').show();
            //console.log(data);
            if(data.id)
            $('input[name="employee_id"]').val(data.id);
            //Main Data
            //return false;
            nextSteper(current,isAccount,data.associate_id,data.id);

        },
        error: function(xhr, textStatus, thrownError)
        {
            $('#loading').hide();
            var error = jQuery.parseJSON(xhr.responseText);
            console.log(error);
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
                    //$('.'+k).children().not("div.exclude").not("label").not("span").append("<label id='"+k+"_error' class='error span_err'>"+v+"</label>");
            });

        },
        cache: false,
        contentType: false,
        processData: false,
    });

    return false;
});


function nextSteper(current,isAccount,aid,eid)
{
    let currentstep = current.attr('data-step');
    let currentid = current.attr('id');

    let currentLink = "[data-form=" + currentid + "]";
    let currentCount = parseInt(currentstep);

    let status = $('input[name=status]').val();
    let department_id = $( "select#department_id option:selected" ).val();
    let next = '';
    console.log(status);
    if(currentstep == 6)
    {
        if(document.location.pathname.indexOf("/details") != -1)
        {
            if((status == 10 || status == 8) &&  department_id == 1)
            next = $(".trial[data-step=" + (currentCount + 1) + "]");
        }else{
            if((status == 10 || status == 8) &&  department_id == 1)
            {
                next = $(".trial[data-step=" + (currentCount + 1) + "]");
            }else{
                $.get("/encrypt?data="+aid+"&data1="+eid, function(data, status){
                    //window.location.href = '/associate/'+data;
                   window.location.replace('/associate/'+data[0]+'/employee/'+data[1]);
                });
                return true;
            }
        }
    }else if(currentstep == 7)
    {
        $.get("/encrypt?data="+eid, function(data, status){
            //window.location.href = '/associate/'+data;
            window.location.replace('/employee/'+data+'/message');
        });
        return true;
    }
    else{
        next = $(".trial[data-step=" + (currentCount + 1) + "]");
    }

    //let height = next.height();

    let nextstep = next.attr('data-step');
    let nextid = next.attr('id');

    let nextLink = "[data-form=" + nextid + "]";
    let circleAttr = $('.circle').attr('stroke-dasharray');
    let percentage = parseInt(circleAttr.substr(0, circleAttr.indexOf(',')));

    current.removeClass('active');
    current.addClass('completed');
    $('.step-forms form').removeClass('active');
    $(".form-lists li:not(.isParent)").removeClass('active');
    //$('.step-forms').css('height', height + 'px');
    $('#loading').hide();
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
        }else {
            $(nextLink).addClass('active');
            $(currentLink).addClass('completed');
        }
        $('.circle').attr('stroke-dasharray', Math.round((currentCount / formLength) * 100) + ', 100');
        $('.percentage').html(Math.round((currentCount / formLength) * 100) + '%');
    }
    //console.log(current.serializeArray());
    setTimeout(() => {
        current.hide();
        var pathname = window.location.pathname;
        //console.log(pathname);
        //return false;
        if(document.location.pathname.indexOf("/details") != -1){
            $('#step_edit').val('0');
        }else{
                if ($('#'+nextid).hasClass("completed"))
                {
                    if(nextstep == 6)
                    {
                        if((status == 10 || status == 8) && department_id == 1)
                        {
                            $('#step_edit').val('0');
                        }else{

                            $('#step_edit').val('1');
                        }
                    }else if(nextstep == 7) {
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
            width: '100%'
        });
        $('input[name="birth_date"],input[name="anniversary_date"]').datepicker({
            autoclose: true
        });
        $('input[name="nism_va_validity"],input[name="nism_xa_validity"],input[name="nism_xb_validity"],input[name="cfp_validity"],input[name="cwm_validity"]').datepicker({
            autoclose: true
        });

        $('input[name="ca_validity"],input[name="cs_validity"],input[name="course_validity"]').datepicker({
            autoclose: true
        });


    }, 500);
}

// $('.income-tab a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
//     let height = $('form.active').height();
//     $('.step-forms').css('height', height + 'px');
// });

$(document).on('change', '#department_id', function (e) {
    let value = e.target.value;
    if(value > 0)
    {
        getSubDepartment(value);

        setCertification(value);
    }
});

function setCertification(value)
{
    let profession = $('#profession_id').val();
    $("#mfd_ria_type").hide();
    $("#nism_va_details").hide();
    $("#euin_details").hide();
    $("#ria_type").hide();
    $("#ca_cs_type").hide();
    console.log(profession);
    if(value == 1)
    {
        if(profession == 1)
        {
            $("#nism_va_details").show();
            $("#euin_details").show();
        }else if(profession == 2){
            $("#ria_type").show();
        }else if(profession == 3){
            $("#mfd_ria_type").show();
        }else{
            $('#ca_cs_type').show();
        }

    }else{
        $('#ca_cs_type').show();
    }
}

$(document).on('change', '#associate_id', function (e) {
    let value = e.target.value;
    if(value)
    {
        getProfessionId(value);
        $("#name,#department_id,#designation_id").attr('readonly', false);
    }

});

function getSubDepartment(value, $code = '')
{
    $.get("/admin/master/department?id="+value, function(data, status){

        $('#subdepartment_id').empty();
        if(data.length > 0)
        {
            let sub = '';
            let acode = $("#employee_edit").val();
            sub += '<option value="" disabled selected>Select Sub Department</option>';
            $.each(data, function(i,o){
                sub += '<option value="'+o.id+'">'+o.name+'</option>';
            });
            $('#subdepartment_id').html(sub);

            if(acode == 0)
            {
                $("#subdepartment_id").attr('readonly', false);
            }

            if($code)
            {
                console.log($code);
                $('select#subdepartment_id').val($code).trigger('change');
            }
        }
    });
}

function getProfessionId(id)
{
    $.get("/associate/"+id+"/user", function(data, status){
        console.log(data);
        $("#profession_id").val(data.profession_id);
    });
}

$(document).on('click', '#is_permanent_address', function (e) {
    if($(this).is(":checked")){
        $(this).val('1');
        $('#permanent_address').addClass('permanent');
    }else if($(this).is(":not(:checked)")){
        $(this).val('0');
        $('#permanent_address').removeClass('permanent');
    }
});

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

$(document).ready(function() {

    $edit = $("#employee_edit").val();
    $("#supervisor_id,#subdepartment_id").attr('readonly', true);
    $associate_id = $("#associate_id").val();
    $employee_id = $("#employee_id").val();
    $department_id = $("#department_id").val();
    $department_code = $("#department_code").val();
    $supervisor_code = $("#supervisor_code").val();
    $designation_id = $( "select#designation_id option:selected" ).val();
    let mobile = $( "#mobile" ).val();
    let cmobile1 = $( "#contact_mobile1" ).val();
    let cmobile2 = $( "#contact_mobile2" ).val();
    let c_state = $("#c_state_code").val();
    let p_state = $("#p_state_code").val();
    let c_country = $( "select#c_country option:selected" ).val();
    getStates(c_country, 'c_state', c_state);
    let p_country = $( "select#p_country option:selected" ).val();
    getStates(p_country, 'p_state', p_state);
    if(p_state){
        $('#is_permanent_address').val('0');
        $('#is_permanent_address').attr('checked', false);
        $('#permanent_address').removeClass('permanent');
    }
    console.log($department_id)
    if($edit == 0)
    {
        if($associate_id)
        {
            getProfessionId($associate_id);
        }else{
            $("#name,#department_id,#designation_id").attr('readonly', true);
        }

    }else{

        $( "section" ).each(function() {

            if($(this).hasClass('completed'))
            {
                var section_id = $(this).attr('id');
                $('#'+section_id+' input, #'+section_id+' select, #'+section_id+' textarea').attr('readonly', 'readonly');
                $('#'+section_id+' input[type=file]').parent("label").attr('readonly', 'readonly');
                if(section_id == 'certification-detail')
                {
                    $(".customMulti").attr('readonly', 'readonly');
                }
                //console.log($(this).attr('id'));
            }else{
                if($(this).attr('id') == 'employee-detail')
                {

                    if(mobile && cmobile1 && cmobile2)
                    {
                        var section_id = $(this).attr('id');
                        $('#'+section_id+' input, #'+section_id+' select, #'+section_id+' textarea').attr('readonly', 'readonly');
                        $('#'+section_id+' input[type=file]').parent("label").attr('readonly', 'readonly');
                    }
                }
            }
        });
        getSubDepartment($department_id, $department_code);
        setCertification($department_id);
        getSupervisiorId($designation_id, $supervisor_code);
        certificate_type();
        mfd_ria_certificate_type();
        ca_cs_certificate_type();
        $(".customMulti .data-list a").trigger('click');
        //$('#form-information input, #form-information select, #form-information textarea').attr('readonly', 'readonly');


    }


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

$(document).on('change', '#ria_certificate_type', function (e) {
    certificate_type();
});

function certificate_type()
{
    let types = $('#ria_certificate_type').children().find('input:checked').map(function(i, e) {return e.value}).toArray();

    $("#nism_xa_details,#nism_xb_details,#cfp_details,#cwm_details").hide();
    $('input[name=ria_type_nism]').val('1');
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

$(document).on('change', '#mfd_ria_certificate_type', function (e) {
    mfd_ria_certificate_type();
});

function mfd_ria_certificate_type()
{
    let types = $('#mfd_ria_certificate_type').children().find('input:checked').map(function(i, e) {return e.value}).toArray();
    let ntype = $('#mfd_ria_certificate_type').children().find('input:unchecked').map(function(i, e) {return e.value}).toArray();

    $('input[name=mfd_ria_type_mfd]').val('0');
    $('input[name=mfd_ria_type_ria]').val('0');
    $("#ria_type").hide();
    //$("#nism_va_details").hide();

    if(types)
    {
        $.each(types, function(i, val){
            if(val){
                if(val == "mfd"){
                    $("#nism_va_details").show();
                    $("#euin_details").show();
                    $('input[name=mfd_ria_type_mfd]').val('1');
                }else if(val == "ria"){

                    $("#ria_type").show();
                    $('input[name=mfd_ria_type_ria]').val('1');
                }
            }
        });
    }
}

$(document).on('change', '#ca_cs_certificate_type', function (e) {
    ca_cs_certificate_type();
});

function ca_cs_certificate_type()
{
    let types = $('#ca_cs_certificate_type').children().find('input:checked').map(function(i, e) {return e.value}).toArray();
    let ntype = $('#ca_cs_certificate_type').children().find('input:unchecked').map(function(i, e) {return e.value}).toArray();

    $('input[name=ca_type]').val('0');
    $('input[name=cs_type]').val('0');
    $('input[name=ot_type]').val('0');
    $("#ca_details").hide();
    $("#cs_details").hide();
    $("#course_details").hide();
    if(types)
    {
        $.each(types, function(i, val){
            if(val){
                if(val == "ca"){
                    $("#ca_details").show();
                    $('input[name=ca_type]').val('1');
                }else if(val == "cs"){
                    $("#cs_details").show();
                    $('input[name=cs_type]').val('1');
                }else{
                    $("#course_details").show();
                    $('input[name=ot_type]').val('1');
                }
            }
        });
    }
}

$(document).on('change', 'select#c_country,select#p_country', function (e) {
    let name = e.target.name;
    if(name == 'c_country')
    {
        let country = $( "select#c_country option:selected" ).val();
        getStates(country, 'c_state');
    }
    else if(name == 'p_country')
    {
        let nominee_country = $( "select#p_country option:selected" ).val();
        getStates(nominee_country, 'p_state');
    }

    return true;
});

function showImage($image)
{
    // $("img#show_img").attr("src", $image);

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
    console.log($val);
    if($val){
        $name = e.target.name;
        //$('.span_err').remove();
        if($('.'+$name).find('label.span_err').length !== 0)
        {
            $('.'+$name).find('label.span_err').remove();
        }
    }
});

$(document).on('change', '#designation_id', function (e) {
    let value = e.target.value;
    if(value)
    {
        getSupervisiorId(value);
    }

});

function getSupervisiorId(value,code = '')
{
    $id = $('#associate_id').val();
    console.log($id);
    console.log(value);
    $.get("/associate/"+$id+"/employee/create?designation_id="+value, function(data, status){
        if(data.length > 0)
        {
            let sub = '';
            let acode = $("#employee_edit").val();
            sub += '<option value="" disabled selected>Select Supervisor Id</option>';
            $.each(data, function(i,o){
                sub += '<option value="'+o.id+'">'+o.name+'</option>';
            });
            $('#supervisor_id').html(sub);
            if(acode == 0)
            {
                $("#supervisor_id").attr('readonly', false);
            }

            if(code)
            {
                $('select#supervisor_id').val(code).trigger('change');
            }
        }
    });

}

$(".edit-now").on("click", function(e) {

    //let value = $(this).parent().parent().attr('id');
    let value = $(this).parent().closest('section.trial').attr('id');
    $('input[name=step_edit]').val(1);

    if(value == 'general-information')
    {
        $('#'+value+' input, #'+value+' select, #'+value+' textarea, #'+value+' label').attr('readonly', false);
        $('#associate_id').attr('readonly', true);
    }else if(value == 'certification-detail'){
        $('#'+value+' input, #'+value+' select, #'+value+' textarea, #'+value+' label').attr('readonly', false);
        $('.customMulti').attr('readonly', false);
    }else{
        $('#'+value+' input, #'+value+' select, #'+value+' textarea, #'+value+' label').attr('readonly', false);
    }
});

$(".reject-now").on("click", function(e) {
    $("#userstatus").val('1');
    $("#reject_reason").attr('readonly', false);
    $('#RejectModal').modal('show');
});

$('#RejectModal').on('hidden.bs.modal', function (e) {
    $("#userstatus").val('0');
});

$(document).on('click', '#bse_upload', function (e) {
    let id = $('input[name=employee_id]').val()
    if($(this).is(":checked")){
        $(this).val('1');
        $('#bse_send_email').attr('disabled',false);
    }
    else if($(this).is(":not(:checked)")){
        $(this).val('0');
        $('#bse_send_email').attr('disabled',true);
    }
  });
