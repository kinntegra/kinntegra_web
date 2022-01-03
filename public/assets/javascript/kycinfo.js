$('.pan').keypress(validatePanNo);
$('.pan').keyup(validatePanCharacter);
$('.mobile').keypress(validateMobile);
$('.mobile').keyup(validateMobileFirst);
$('.pincode').keypress(validatePincode);
$('.aadhar').keypress(validateAadharNumber);
$('.ckyc_no').keypress(validateNumber);
$(document).on('keypress', '.account_no', function (event) {
    var key = window.event ? event.keyCode : event.which;
    if (event.keyCode === 8 || event.keyCode === 46) {
        return true;
    } else if (key < 48 || key > 57) {
        return false;
    } else {
        if (event.target.value.length < 20) { return true; } else { return false; }
    }
});
var formLength = $('.step-forms .trial').length;
$(window).on('load', function () {
    //let height = $('.step-forms .active').height();
    //$('.step-forms').css('height', height + 'px');
    $('.net_worth_date').datepicker({
        autoclose: true,
        format: "dd-mm-yyyy"
    });
    $('select').select2({
        width: '100%',
        minimumResultsForSearch: 5
    });
});



//$('.step-forms .trial button.proceed').click(function (e) {
$(document).on('click','.step-forms .trial button.proceed',function(e){
    e.preventDefault();
    $(document).scrollTop(0);
    let isAccount = $('#introduction:visible #proceed-to').val() == 'account';
    let current = '';
    $('#loading').show();
    if($(this).parent().hasClass('trial'))
    {
        current = $(this).parent();
    }else{
        current = $(this).parent().closest('section.trial');
    }
    let error_count = 0;
    let step_edit = $('#step_edit').val();
    let client_edit = $('#client_edit').val();
    let client_id = $('#client_id').val();
    // console.log(step_edit,client_edit,client_id);
    if(client_edit == 1 && step_edit == 0)
    {
        $('#loading').show();
        nextSteper(current,isAccount,client_id);
        return false;
    }

    $('.error').removeClass('error');
    $('.err').removeClass('err');
    $('.span_err').remove();
    error_count = checkValidation(error_count,current);
    console.log(error_count);
    if(error_count > 0)
    {
        $('#loading').hide();
        return false;
    }

    let post = $('form#client_kycinformation').attr('method');
    let url = $('form#client_kycinformation').attr('action');
    let formData = new FormData($('#client_kycinformation')[0]);
    console.log(post);
    console.log(url);
    $.ajax({
        type: post,
        url: url,
        data: formData,
        beforeSend: function() {//xhr, type
            $('#loading').show();
        },
        success:function(data) {
            $('#loading').hide();
            console.log(data);
            nextSteper(current,isAccount,client_id);
            return false;
        },
        error: function(xhr, textStatus, thrownError)
        {
            $('#loading').hide();
            console.log(xhr);
            var error = jQuery.parseJSON(xhr.responseText);
        },
        cache: false,
        contentType: false,
        processData: false,
        timeout: 8000,
    });
    nextSteper(current,isAccount,client_id);

});


function nextSteper(current,isAccount,id='')
{
    let currentstep = current.attr('data-step');
    let currentid = current.attr('id');

    let currentLink = "[data-form=" + currentid + "]";
    let currentCount = parseInt(currentstep);

    let next = '';

    next = $(".trial[data-step=" + (currentCount + 1) + "]");
    //let height = next.height();

    let nextstep = next.attr('data-step');
    let nextid = next.attr('id');
    let nextpid = next.attr('data-pid');
    let nextLink = "[data-form=" + nextid + "]";
    let circleAttr = $('.circle').attr('stroke-dasharray');
    let percentage = parseInt(circleAttr.substr(0, circleAttr.indexOf(',')));

    current.removeClass('active');
    current.addClass('completed');
    $('#current_pid').val(nextpid);
    $('#current_step_id').val(nextstep);
    $('.step-forms form').removeClass('active');
    $(".form-lists li:not(.isParent)").removeClass('active');
    //$('.step-forms').css('height', height + 'px');
    //
    if (isAccount) {
        $(nextLink).addClass('skip');
        $("#account-opening").addClass('active');
        $("[data-form=account-opening]").addClass('active');
        $(currentLink).addClass('completed');
    } else {
        next.addClass('active');
        if(next.hasClass('completed'))
        {
            $('#step_edit').val('0');
        }else{
            $('#step_edit').val('1');
        }
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

    if(next.length == 0)
    {
        $('#loading').show();
        if($("#is_verify").val() == 1 || $("#is_verify").val() == 2)
        {
            window.location.href = '/client/assetallocation/'+id+'?is_verify='+$("#is_verify").val();
        }else{
            window.location.href = '/client/assetallocation/'+id;
        }

        return false;
    }
    $('#loading').hide();
    setTimeout(() => {
        current.hide();
        // if(nextstep == 6)
        // {
        //     $('#step_edit').val('1');
        // }else{
        //     $('#step_edit').val('0');
        // }
        $('#loading').hide();
        $('select').select2({
            width: '100%'
        });
        $('.net_worth_date').datepicker({
            autoclose: true,
            format: "dd-mm-yyyy"
        });



    }, 500);
}

function checkValidation(error_count,current)
{
    let pid = $("#current_pid").val();
    //let step_id = $("#current_step_id").val();
    let current_step_id = current.attr('data-step');

    let current_pid_id = current.attr('data-pid');
    console.log(current_pid_id);
    let member_id = '';
    let member_error = '';
    let active_step = 3;
    let fixed = 3;
    var rem = parseInt(current_step_id) % parseInt(fixed);
    if(rem > 0)
    {
        active_step = rem;
    }
    if(active_step == 1)
    {
        let is_profile = $('#is_profile_'+current_pid_id).val();
        let account_type = $('#account_type_'+current_pid_id).val();
        let has_guardian = $('#has_guardian_'+current_pid_id).val();
        console.log(has_guardian);
        if(has_guardian == 1)
        {
            //Validation for Guardian

            var client_guardian_id = 'client_guardian_id_'+pid;
            var client_guardian_val = $( "select#"+client_guardian_id+" option:selected" ).val();
            member_id = client_guardian_id;
            member_error = 'Select guardian';
            if(!client_guardian_val)
            {
                error_count++;
                $('.'+member_id).children().not("div.exclude").not("label").not("span").append("<label id='"+member_id+"_error' class='error span_err'>"+member_error+"</label>");
            }
            if(is_profile == 0)
            {
                //Validation for birth_upload
                var birth_upload_id = 'birth_upload_'+pid;
                var birth_upload_val = $('#'+ birth_upload_id).val();
                member_id = birth_upload_id;
                member_error = 'Upload certificate';
                if(!birth_upload_val)
                {
                    error_count++;
                    $('.'+member_id).children().not("div.exclude").not("label").not("span").append("<label id='"+member_id+"_error' class='error span_err'>"+member_error+"</label>");
                }else{
                    let kyc_size = $("#"+birth_upload_id)[0].files[0].size;
                    if(kyc_size > 500000)
                    {
                        member_error = 'Max file Size 500kb';
                        error_count++;
                        $('.'+member_id).children().not("div.exclude").not("label").not("span").append("<label id='"+member_id+"_error' class='error span_err'>"+member_error+"</label>");
                    }
                }
            }
        }
        //Validation for Pan No
        var panid = 'pan_'+pid;
        var panval = $('#'+ panid).val();
        var PAN_Card_No = panval.toUpperCase();
        var regex = /([A-Z]){5}([0-9]){4}([A-Z]){1}$/;
        member_id = panid;
        if(!panval)
        {
            member_error = 'Enter Valid Pan No';
            error_count++;
            $('.'+member_id).children().not("div.exclude").not("label").not("span").append("<label id='"+member_id+"_error' class='error span_err'>"+member_error+"</label>");
        }
        else{
            member_error = 'Enter Valid Pan No';
            if (!PAN_Card_No.match(regex)) {
                error_count++;
                $('.'+member_id).children().not("div.exclude").not("label").not("span").append("<label id='"+member_id+"_error' class='error span_err'>"+member_error+"</label>");
            }
        }
        if(is_profile == 0 && has_guardian == 0)
        {
            //Validation for pan_upload
            var pan_upload_id = 'pan_upload_'+pid;
            var pan_upload_val = $('#'+ pan_upload_id).val();
            member_id = pan_upload_id;
            member_error = 'Upload Pancard';
            if(!pan_upload_val)
            {
                error_count++;
                $('.'+member_id).children().not("div.exclude").not("label").not("span").append("<label id='"+member_id+"_error' class='error span_err'>"+member_error+"</label>");
            }else{
                let pan_size = $("#"+pan_upload_id)[0].files[0].size;
                if(pan_size > 500000)
                {
                    member_error = 'Max file Size 500kb';
                    error_count++;
                    $('.'+member_id).children().not("div.exclude").not("label").not("span").append("<label id='"+member_id+"_error' class='error span_err'>"+member_error+"</label>");
                }
            }
        }
        //Validation for kyc_status
        var kyc_status_id = 'kyc_status_'+pid;
        var kyc_status_val = $('#'+ kyc_status_id).val();
        member_id = kyc_status_id;
        member_error = 'Select Kyc Status';
        if(!kyc_status_val)
        {
            error_count++;
            $('.'+member_id).children().not("div.exclude").not("label").not("span").append("<label id='"+member_id+"_error' class='error span_err'>"+member_error+"</label>");
        }

        if(is_profile == 0 && has_guardian == 0)
        {
            //Validation for kyc_upload
            var kyc_upload_id = 'kyc_upload_'+pid;
            var kyc_upload_val = $('#'+ kyc_upload_id).val();
            member_id = kyc_upload_id;
            member_error = 'Upload kyc';
            if(!kyc_upload_val)
            {
                error_count++;
                $('.'+member_id).children().not("div.exclude").not("label").not("span").append("<label id='"+member_id+"_error' class='error span_err'>"+member_error+"</label>");
            }else{
                let kyc_size = $("#"+kyc_upload_id)[0].files[0].size;
                if(kyc_size > 500000)
                {
                    member_error = 'Max file Size 500kb';
                    error_count++;
                    $('.'+member_id).children().not("div.exclude").not("label").not("span").append("<label id='"+member_id+"_error' class='error span_err'>"+member_error+"</label>");
                }
            }
        }
        //Validation for country_code
        var country_code_id = 'country_code_'+pid;
        var country_code_val = $('#'+ country_code_id).val();
        member_id = country_code_id;
        member_error = 'Enter Country Code';
        if(!country_code_val)
        {
            error_count++;
            $('.'+member_id).children().not("div.exclude").not("label").not("span").append("<label id='"+member_id+"_error' class='error span_err'>"+member_error+"</label>");
        }

        if(account_type == 1)
        {
            //Validation for Aadhar No
            var aadhar_id = 'aadhar_'+pid;
            var aadhar_val = $('#'+ aadhar_id).val();
            member_id = aadhar_id;
            member_error = 'Enter Aadhar No';
            if(!aadhar_val)
            {
                //error_count++;
                //$('.'+member_id).children().not("div.exclude").not("label").not("span").append("<label id='"+member_id+"_error' class='error span_err'>"+member_error+"</label>");
            }else{
                member_error = 'Enter valid aadhar no';
                var aadhar_len = aadhar_val.length;
                if(aadhar_len < 12)
                {
                    error_count++;
                    $('.'+member_id).children().not("div.exclude").not("label").not("span").append("<label id='"+member_id+"_error' class='error span_err'>"+member_error+"</label>");
                }
            }
        }


        //Validation for mobile
        var mobile_id = 'mobile_'+pid;
        var mobile_val = $('#'+ mobile_id).val();
        member_id = mobile_id;
        member_error = 'Enter mobile no';
        if(!mobile_val)
        {
            error_count++;
            $('.'+member_id).children().not("div.exclude").not("label").not("span").append("<label id='"+member_id+"_error' class='error span_err'>"+member_error+"</label>");
        }else{
            member_error = 'Enter valid mobile no';
            var mobile_len = mobile_val.length;
            if(mobile_len < 10)
            {
                error_count++;
                $('.'+member_id).children().not("div.exclude").not("label").not("span").append("<label id='"+member_id+"_error' class='error span_err'>"+member_error+"</label>");
            }
        }

        //Validation for email
        var email_id = 'email_'+pid;
        var email_val = $('#'+ email_id).val();
        member_id = email_id;
        member_error = 'Enter email Address';
        if(!email_val)
        {
            error_count++;
            $('.'+member_id).children().not("div.exclude").not("label").not("span").append("<label id='"+member_id+"_error' class='error span_err'>"+member_error+"</label>");
        }else{
            member_error = 'Enter valid email address';
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if(!regex.test(email_val))
            {
                error_count++;
                $('.'+member_id).children().not("div.exclude").not("label").not("span").append("<label id='"+member_id+"_error' class='error span_err'>"+member_error+"</label>");
            }
        }
        if(account_type == 1)
        {
            //Validation for Gender
            var gender_id = 'gender_'+pid;
            var gender_val = $( "select#"+gender_id+" option:selected" ).val();
            member_id = gender_id;
            member_error = 'Select gender';
            if(!gender_val)
            {
                error_count++;
                $('.'+member_id).children().not("div.exclude").not("label").not("span").append("<label id='"+member_id+"_error' class='error span_err'>"+member_error+"</label>");
            }
        }
        if(account_type == 2)
        {
            //Validation for Gender
            var business_nature_id = 'business_nature_'+pid;
            var business_nature_val = $('#'+ business_nature_id).val();
            member_id = business_nature_id;
            member_error = 'Enter business nature';
            if(!business_nature_val)
            {
                error_count++;
                $('.'+member_id).children().not("div.exclude").not("label").not("span").append("<label id='"+member_id+"_error' class='error span_err'>"+member_error+"</label>");
            }

            //
            //Validation for tax status
            // var ubo_count_id = 'ubo_count_'+pid;
            // var ubo_count_val = $('#'+ ubo_count_id).val();
            // member_id = ubo_count_id;
            // member_error = 'Select ubo count';
            // if(!ubo_count_val)
            // {
            //     error_count++;
            //     $('.'+member_id).children().not("div.exclude").not("label").not("span").append("<label id='"+member_id+"_error' class='error span_err'>"+member_error+"</label>");
            // }

            var ubo_name_id = 'ubo_name_'+pid;
            var ubo_name_val = $("#"+ubo_name_id+" input:checkbox:checked").map(function(){
                return $(this).val();
            }).toArray();

            member_id = ubo_name_id;
            member_error = 'Select ubo name';
            if(ubo_name_val.length == 0)
            {
                error_count++;
                $('.'+member_id).children().not("div.exclude").not("label").not("span").append("<label id='"+member_id+"_error' class='error span_err'>"+member_error+"</label>");
            }

            // var ubo_length = ubo_name_val.length;
            // console.log(ubo_count_val,ubo_length);
            // if(ubo_count_val){
            //     if(ubo_count_val != ubo_length)
            //     {
            //         member_id = ubo_count_id;
            //         member_error = 'Ubo count not matched';
            //         error_count++;
            //         $('.'+member_id).children().not("div.exclude").not("label").not("span").append("<label id='"+member_id+"_error' class='error span_err'>"+member_error+"</label>");
            //     }
            // }
        }

        //Validation for birth place
        var birth_place_id = 'birth_incorp_place_'+pid;
        var birth_place_val = $('#'+ birth_place_id).val();
        member_id = birth_place_id;
        member_error = 'Select birth place';
        if(!birth_place_val)
        {
            error_count++;
            $('.'+member_id).children().not("div.exclude").not("label").not("span").append("<label id='"+member_id+"_error' class='error span_err'>"+member_error+"</label>");
        }

        //Validation for birth country
        var birth_country_id = 'birth_incorp_country_'+pid;
        var birth_country_val = $('#'+ birth_country_id).val();
        member_id = birth_country_id;
        member_error = 'Select birth place';
        if(!birth_country_val)
        {
            error_count++;
            $('.'+member_id).children().not("div.exclude").not("label").not("span").append("<label id='"+member_id+"_error' class='error span_err'>"+member_error+"</label>");
        }

        //Validation for tax status
        var tax_status_id = 'tax_status_'+pid;
        var tax_status_val = $('#'+ tax_status_id).val();
        member_id = tax_status_id;
        member_error = 'Select tax status';
        if(!tax_status_val)
        {
            error_count++;
            $('.'+member_id).children().not("div.exclude").not("label").not("span").append("<label id='"+member_id+"_error' class='error span_err'>"+member_error+"</label>");
        }

        //Validation for occupation
        var occupation_id = 'occupation_'+pid;
        var occupation_val = $('#'+ occupation_id).val();
        member_id = occupation_id;
        member_error = 'Select occupation';
        if(!occupation_val)
        {
            error_count++;
            $('.'+member_id).children().not("div.exclude").not("label").not("span").append("<label id='"+member_id+"_error' class='error span_err'>"+member_error+"</label>");
        }

        //Validation for gross annual income
        var gross_annual_income_id = 'gross_annual_income_'+pid;
        var gross_annual_income_val = $( "select#"+gross_annual_income_id+" option:selected" ).val();
        member_id = gross_annual_income_id;
        member_error = 'Select gross annual income';
        if(!gross_annual_income_val)
        {
            error_count++;
            $('.'+member_id).children().not("div.exclude").not("label").not("span").append("<label id='"+member_id+"_error' class='error span_err'>"+member_error+"</label>");
        }

        //Validation for source of wealth
        var wealth_source_id = 'wealth_source_'+pid;
        var wealth_source_val = $( "select#"+wealth_source_id+" option:selected" ).val();
        member_id = wealth_source_id;
        member_error = 'Select wealth source';
        if(!wealth_source_val)
        {
            error_count++;
            $('.'+member_id).children().not("div.exclude").not("label").not("span").append("<label id='"+member_id+"_error' class='error span_err'>"+member_error+"</label>");
        }

        //Validation for net_worth
        var net_worth_id = 'net_worth_'+pid;
        var net_worth_val = $('#'+ net_worth_id).val();
        member_id = net_worth_id;
        member_error = 'Enter amount';
        if(!net_worth_val || net_worth_val == 0)
        {
            error_count++;
            $('.'+member_id).children().not("div.exclude").not("label").not("span").append("<label id='"+member_id+"_error' class='error span_err'>"+member_error+"</label>");
        }

        //Validation for net_worth
        var net_worth_date_id = 'net_worth_date_'+pid;
        var net_worth_date_val = $('#'+ net_worth_date_id).val();
        member_id = net_worth_date_id;
        member_error = 'Select date';
        if(!net_worth_date_val)
        {
            error_count++;
            $('.'+member_id).children().not("div.exclude").not("label").not("span").append("<label id='"+member_id+"_error' class='error span_err'>"+member_error+"</label>");
        }


        // //Validation for politically exposed or related
        // var politically_exposed_id = 'politically_exposed_'+pid;
        // var politically_exposed_val = $('#'+ politically_exposed_id).val();
        // member_id = politically_exposed_id;
        // member_error = 'Select politically exposed';
        // if(!politically_exposed_val)
        // {
        //     error_count++;
        //     $('.'+member_id).children().not("div.exclude").not("label").not("span").append("<label id='"+member_id+"_error' class='error span_err'>"+member_error+"</label>");
        // }
    }

    if(active_step == 2)
    {
        let is_communication = $('#is_communication_'+current_pid_id).val();
        let is_nri = $('#client_is_nri_'+current_pid_id).val();
        let is_guardian_address = 0;
        if($('#is_guardian_address_'+pid).is(':checked'))
        {
            is_guardian_address++;
        }
        //console.log(is_guardian_address);
        //Validation for Address type
        var address_type_id = 'address_type_'+pid;
        var address_type_val = $('#'+ address_type_id).val();
        member_id = address_type_id;
        member_error = 'Select address type';
        if(!address_type_val)
        {
            error_count++;
            $('.'+member_id).children().not("div.exclude").not("label").not("span").append("<label id='"+member_id+"_error' class='error span_err'>"+member_error+"</label>");
        }
        //Foreign Validation for Address type
        if(is_nri == 1)
        {
            var foreign_address_type_id = 'foreign_address_type_'+pid;
            var foreign_address_type_val = $('#'+ foreign_address_type_id).val();
            member_id = foreign_address_type_id;
            member_error = 'Select address type';
            if(!foreign_address_type_val)
            {
                error_count++;
                $('.'+member_id).children().not("div.exclude").not("label").not("span").append("<label id='"+member_id+"_error' class='error span_err'>"+member_error+"</label>");
            }
        }

        //Validation for Address 1
        var address1_id = 'address1_'+pid;
        var address1_val = $('#'+ address1_id).val();
        member_id = address1_id;
        member_error = 'Enter address';
        if(!address1_val)
        {
            error_count++;
            $('.'+member_id).children().not("div.exclude").not("label").not("span").append("<label id='"+member_id+"_error' class='error span_err'>"+member_error+"</label>");
        }

        //Foreign Validation for Address 1
        if(is_nri == 1)
        {
            var foreign_address1_id = 'foreign_address1_'+pid;
            var foreign_address1_val = $('#'+ foreign_address1_id).val();
            member_id = foreign_address1_id;
            member_error = 'Enter address';
            if(!foreign_address1_val)
            {
                error_count++;
                $('.'+member_id).children().not("div.exclude").not("label").not("span").append("<label id='"+member_id+"_error' class='error span_err'>"+member_error+"</label>");
            }
        }

        //Validation for Address 2
        var address2_id = 'address2_'+pid;
        var address2_val = $('#'+ address2_id).val();
        member_id = address2_id;
        member_error = 'Enter address';
        if(!address2_val)
        {
            error_count++;
            $('.'+member_id).children().not("div.exclude").not("label").not("span").append("<label id='"+member_id+"_error' class='error span_err'>"+member_error+"</label>");
        }

        //Foreign Validation for Address 2
        if(is_nri == 1)
        {
            var foreign_address2_id = 'foreign_address2_'+pid;
            var foreign_address2_val = $('#'+ foreign_address2_id).val();
            member_id = foreign_address2_id;
            member_error = 'Enter address';
            if(!foreign_address2_val)
            {
                error_count++;
                $('.'+member_id).children().not("div.exclude").not("label").not("span").append("<label id='"+member_id+"_error' class='error span_err'>"+member_error+"</label>");
            }
        }

        if(is_guardian_address == 0)
        {
            //Validation for address upload
            var address_upload_id = 'address_upload_'+pid;
            var address_upload_val = $('#'+ address_upload_id).val();
            member_id = address_upload_id;
            member_error = 'Upload address';
            if(!address_upload_val)
            {
                if(is_communication == 0)
                {
                    error_count++;
                    $('.'+member_id).children().not("div.exclude").not("label").not("span").append("<label id='"+member_id+"_error' class='error span_err'>"+member_error+"</label>");
                }
            }else{
                let address_size = $("#"+address_upload_id)[0].files[0].size;
                if(address_size > 500000)
                {
                    member_error = 'Max file Size 500kb';
                    error_count++;
                    $('.'+member_id).children().not("div.exclude").not("label").not("span").append("<label id='"+member_id+"_error' class='error span_err'>"+member_error+"</label>");
                }
            }

            //Foreign Validation for Address upload
            if(is_nri == 1)
            {
                var foreign_address_upload_id = 'foreign_address_upload_'+pid;
                var foreign_address_upload_val = $('#'+ foreign_address_upload_id).val();
                member_id = foreign_address_upload_id;
                member_error = 'Upload address';
                if(!foreign_address_upload_val)
                {
                    if(is_communication == 0)
                    {
                        error_count++;
                        $('.'+member_id).children().not("div.exclude").not("label").not("span").append("<label id='"+member_id+"_error' class='error span_err'>"+member_error+"</label>");
                    }
                }else{
                    let foreign_address_size = $("#"+foreign_address_upload_id)[0].files[0].size;
                    if(foreign_address_size > 500000)
                    {
                        member_error = 'Max file Size 500kb';
                        error_count++;
                        $('.'+member_id).children().not("div.exclude").not("label").not("span").append("<label id='"+member_id+"_error' class='error span_err'>"+member_error+"</label>");
                    }
                }
            }

        }


        //Validation for city
        var city_id = 'city_'+pid;
        var city_val = $('#'+ city_id).val();
        member_id = city_id;
        member_error = 'Enter city';
        if(!city_val)
        {
            error_count++;
            $('.'+member_id).children().not("div.exclude").not("label").not("span").append("<label id='"+member_id+"_error' class='error span_err'>"+member_error+"</label>");
        }


        //Foreign Validation for city
        if(is_nri == 1)
        {
            var foreign_city_id = 'foreign_city_'+pid;
            var foreign_city_val = $('#'+ foreign_city_id).val();
            member_id = foreign_city_id;
            member_error = 'Enter city';
            if(!foreign_city_val)
            {
                error_count++;
                $('.'+member_id).children().not("div.exclude").not("label").not("span").append("<label id='"+member_id+"_error' class='error span_err'>"+member_error+"</label>");
            }
        }

        //Validation for state
        var state_id = 'state_'+pid;
        var state_val = $('#'+ state_id).val();
        member_id = state_id;
        member_error = 'Select state';
        if(!state_val)
        {
            error_count++;
            $('.'+member_id).children().not("div.exclude").not("label").not("span").append("<label id='"+member_id+"_error' class='error span_err'>"+member_error+"</label>");
        }

        //Foreign Validation for state
        if(is_nri == 1)
        {
            var foreign_state_id = 'foreign_state_'+pid;
            var foreign_state_val = $('#'+ foreign_state_id).val();
            member_id = foreign_state_id;
            member_error = 'Select state';
            if(!foreign_state_val)
            {
                error_count++;
                $('.'+member_id).children().not("div.exclude").not("label").not("span").append("<label id='"+member_id+"_error' class='error span_err'>"+member_error+"</label>");
            }
        }

        //Validation for country
        var country_id = 'country_'+pid;
        var country_val = $('#'+ country_id).val();
        member_id = country_id;
        member_error = 'Select country';
        if(!country_val)
        {
            error_count++;
            $('.'+member_id).children().not("div.exclude").not("label").not("span").append("<label id='"+member_id+"_error' class='error span_err'>"+member_error+"</label>");
        }

        //Foreign Validation for country
        if(is_nri == 1)
        {
            var foreign_country_id = 'foreign_country_'+pid;
            var foreign_country_val = $('#'+ foreign_country_id).val();
            member_id = foreign_country_id;
            member_error = 'Select country';
            if(!foreign_country_val)
            {
                error_count++;
                $('.'+member_id).children().not("div.exclude").not("label").not("span").append("<label id='"+member_id+"_error' class='error span_err'>"+member_error+"</label>");
            }
        }

        //Validation for pincode
        var pincode_id = 'pincode_'+pid;
        var pincode_val = $('#'+ pincode_id).val();
        member_id = pincode_id;
        member_error = 'Enter pincode';
        if(!pincode_val)
        {
            error_count++;
            $('.'+member_id).children().not("div.exclude").not("label").not("span").append("<label id='"+member_id+"_error' class='error span_err'>"+member_error+"</label>");
        }

        //Foreign Validation for pincode
        if(is_nri == 1)
        {
            var foreign_pincode_id = 'foreign_pincode_'+pid;
            var foreign_pincode_val = $('#'+ foreign_pincode_id).val();
            member_id = foreign_pincode_id;
            member_error = 'Enter pincode';
            if(!foreign_pincode_val)
            {
                error_count++;
                $('.'+member_id).children().not("div.exclude").not("label").not("span").append("<label id='"+member_id+"_error' class='error span_err'>"+member_error+"</label>");
            }
        }
    }
    if(active_step == 3)
    {
        let bank_count = $(".add-bank.active").first().attr('data-bank_count');
        let bank_added_count = $('.bank_added').length;
        if(bank_added_count == 0)
        {
            error_count++;
            error_count = ValidateBank(error_count,pid,bank_count);
            alert('Please add atleast one bank');
        }

        let count = 0;
        $('.addBankTab_'+pid+'_'+bank_count+' input,.addBankTab_'+pid+'_'+bank_count+' select').each(function () {

            if ($(this).val() != "") {
                if($(this).val() != null)
                {
                    count++;
                    if(count == 1)
                    error_count = ValidateBank(error_count,pid,bank_count);
                }

            }
        });
        console.log(error_count);
    }
    return error_count;
}

//var client_id = $("#client_id").val();
function ValidateBank(error_count,pid,bank_count)
{
    let member_id = '';
    let member_error = '';
    let current_id = "addbank_"+pid+"_"+bank_count;
    let ifsc_no = "bank-ifsc_no_"+pid+"_"+bank_count;
    let bank_name = "bank-bank_name_"+pid+"_"+bank_count;
    let branch_name = "bank-branch_name_"+pid+"_"+bank_count;
    let micr = "bank-micr_"+pid+"_"+bank_count;
    let account_type = "bank-account_type_"+pid+"_"+bank_count;
    let account_no = "bank-account_no_"+pid+"_"+bank_count;
    let cheque_upload = "bank-cheque_upload_"+pid+"_"+bank_count;
    console.log(account_no);
    if ($("#"+current_id).hasClass("active")) {
        if($("#"+ifsc_no).val() == '')
        {
            error_count++;
            member_id = ifsc_no;
            member_error = 'Enter ifsc no';
            $('.'+member_id).children().not("div.exclude").not("label").not("span").append("<label id='"+member_id+"_error' class='error span_err'>"+member_error+"</label>");
        }
        if($("#"+bank_name).val() == '')
        {
            error_count++;
            member_id = bank_name;
            member_error = 'Enter bank name';
            $('.'+member_id).children().not("div.exclude").not("label").not("span").append("<label id='"+member_id+"_error' class='error span_err'>"+member_error+"</label>");
        }
        if($("#"+branch_name).val() == '')
        {
            error_count++;
            member_id = branch_name;
            member_error = 'Enter branch name';
            $('.'+member_id).children().not("div.exclude").not("label").not("span").append("<label id='"+member_id+"_error' class='error span_err'>"+member_error+"</label>");
        }
        if($("#"+micr).val() == '')
        {
            error_count++;
            member_id = micr;
            member_error = 'Enter micr';
            $('.'+member_id).children().not("div.exclude").not("label").not("span").append("<label id='"+member_id+"_error' class='error span_err'>"+member_error+"</label>");
        }

        if($("select#"+account_type+ " option:selected").val() == '')
        {
            error_count++;
            member_id = account_type;
            member_error = 'Select account type';
            $('.'+member_id).children().not("div.exclude").not("label").not("span").append("<label id='"+member_id+"_error' class='error span_err'>"+member_error+"</label>");
        }
        if($("#"+account_no).val() == '')
        {
            error_count++;
            member_id = account_no;
            member_error = 'Enter account no';
            $('.'+member_id).children().not("div.exclude").not("label").not("span").append("<label id='"+member_id+"_error' class='error span_err'>"+member_error+"</label>");
        }
        if($("#"+cheque_upload).val() == '')
        {
            if($("#bank-bankid_"+pid+"_"+bank_count).val() == 0)
            {
                error_count++;
                member_id = cheque_upload;
                member_error = 'Upload Check';
                $('.'+member_id).children().not("div.exclude").not("label").not("span").append("<label id='"+member_id+"_error' class='error span_err'>"+member_error+"</label>");
            }
        }else{
            let cheque_size = $("#"+cheque_upload)[0].files[0].size;
            if(cheque_size > 500000)
            {
                error_count++;
                member_id = cheque_upload;
                member_error = 'Max file Size 500kb';
                $('.'+member_id).children().not("div.exclude").not("label").not("span").append("<label id='"+member_id+"_error' class='error span_err'>"+member_error+"</label>");
            }
        }
    }
    return error_count;
}

$('form').each(function () {
    $(this).validate();
});
//$('.add-bank').click(function (e) {
  //  edit-bank-button
$(document).on('click', '.edit-bank-button', function (e) {
    let pid =  $(this).attr('data-pid');
    let bank_count = $(this).attr('data-bank_count');
    let account_type = $('#client_profile_accounttype_'+pid).val();
    let is_nri = $('#client_is_nri_'+pid).val();
    let current_id = 'addbank_'+pid+'_'+bank_count;
    $('#'+current_id+' input, #'+current_id+' select, #'+current_id+' label').attr('readonly', false);
    $('#step_edit').val(1);

});

$('.add-bank').click(function (e) {
    e.preventDefault();
    let error_count = 0;
    let pid = $("#current_pid").val();
    if($('#bank_detail_'+pid+' .bank_added').hasClass('active'))
    {
        let bank_pid = $('#bank_detail_'+pid+' .bank_added.active').attr('id');
        let bank_count = $('#bank_detail_'+pid+' .bank_added.active').attr('data-bank_count');
        error_count = ValidateBank(error_count,pid,bank_count);

        if(error_count > 0)
        {
            return false;
        }
    }else{
        $("#step_edit").val(1);
    }


});
$(document).on('click', '.add-bank-button', function (e) {
    //e.preventDefault();
    let pid =  $(this).attr('data-pid');
    let bank_count = $(this).attr('data-bank_count');
    let account_type = $('#client_profile_accounttype_'+pid).val();
    let is_nri = $('#client_is_nri_'+pid).val();
    let is_minor = $('#client_is_minor_'+pid).val();
    console.log(bank_count);
    let allBankData = false;
    let data = {};
    let bank_name;
    let short_account_type;

    let error_count = 0;
    $('#addbank_'+pid+'_'+bank_count+' .error').removeClass('error');
    $('#addbank_'+pid+'_'+bank_count+' .err').removeClass('err');
    $('#addbank_'+pid+'_'+bank_count+' .span_err').remove();
    console.log(bank_count);

    // if ($("a.nav-link.add-bank.active").hasClass("bank_added")) {
    // //if($(".tab-pane"))
    //     console.log('sdsdsd');
    // }

    // if(error_count > 0)
    // {
    //     return false;
    // }
    if($(this).hasClass('bank_added'))
    {
        //console.log('abcd');
        return true;
    }
    $('.addBankTab_'+pid+'_'+bank_count+' input,.addBankTab_'+pid+'_'+bank_count+' select').each(function () {

        if ($(this).val() == "") {
            error_count = ValidateBank(error_count,pid,bank_count);
            allBankData = false;
            return false;
        } else {
            allBankData = true;

            if($(this).hasClass('bank_name'))
            {
                bank_name = $(this).val();
            }
            if($(this).hasClass('account_type'))
            {
                bank_name += ' - ';
                bank_name += SetAccountOpeningName($(this).val());
            }
            data[$(this).attr('id')+ '_' + bank_count] = $(this).val();
        }
    });
    // console.log(bank_count);
    // console.log(data);
    // console.log(allBankData);
    // console.log(pid);
    let url = '/client/kycinformation';
    // let get = 'GET';
    if (allBankData) {
        console.log(is_nri,is_minor);
        let bankcount = bank_count;
        $("#bank_count_"+pid).val(bankcount);
        let currentBankCount = parseInt(bank_count) + 1;
        let max_count = 0;
        if(is_nri == 1){
            max_count = 2;
        }else if(is_minor == 1){
            max_count = 1;
        }else{
            max_count = 5;
        }
        if(currentBankCount > max_count)
        {
            // if($(this).addClass('bank_added'))
            // {
                //console.log(pid,bankcount,bank_name);
                $("#add-bank-tab-"+pid+"_"+bankcount).text(bank_name);
                $("#add-bank-tab-"+pid+"_"+bankcount).addClass('bank_added');
                $("#bank_created_"+pid+"_"+bankcount).addClass('bank_added');
                return false;
            //}
        }
        data['bank_count'] = currentBankCount;
        data['pid'] = pid;
        //console.log(bank_count);
        data['account_type'] = account_type;
        data['is_nri'] = is_nri;

        $.ajax({
            type:     "GET",
            cache:    false,
            url:      url,
            data: data,
            dataType: "json",
            error: function (xhr) {
                var error = jQuery.parseJSON(xhr.responseText);

                //alert('IFSC code not found');
            },
            success: function (output, status) {
                console.log(output);
                console.log(bankcount);

                let bank_item_id =  'bank-item_'+pid+'_'+bankcount;
                $("#add-bank-tab-"+pid+"_"+bankcount).removeClass('active');
                $("#addbank_"+pid+"_"+bankcount).removeClass('active');
                $("#add-bank-tab-"+pid+"_"+bankcount).addClass('bank_added');
                $("#bank_created_"+pid+"_"+bankcount).addClass('bank_added');
                // $('<span class="remove-bank"><i class="icon-close"></i></span>').insertAfter('a#add-bank-tab-"+pid+"_"+bankcount');
                // $("#add-bank-tab-"+pid+"_"+bankcount).text('Already Ul=ploaded');
                $(output[1]).insertAfter('#'+bank_item_id);
                console.log(bank_item_id);
                $("#bank-tab_"+pid).append(output[0]);
                $("#add-bank-tab-"+pid+"_"+bankcount).text(bank_name);
                $('#'+bank_item_id+ ' a').removeClass('description');
                //$('<span class="remove-bank"><i class="icon-close"></i></span>').insertAfter('#'+bank_item_id+ ' a');
                // $('.addBankTab_'+pid+' input,.addBankTab_'+pid+' select').each(function () {
                //     $(this).val("");
                // });
                // $("#account_type_"+pid).val('').trigger('change');
                // $("#bank-taxstatus_" + pid + "_" + bank_count).select2().trigger('change');
            }
        });
        // $.get("/client/kycinformation", data, function(output, status){
        //     console.log(data);
        //     $(output[1]).insertBefore('#bank-item_'+pid);
        //     $("#bank-tab_"+pid).prepend(output[0]);

        //     $('.addBankTab_'+pid+' input,.addBankTab_'+pid+' select').each(function () {
        //         $(this).val("");
        //     });
        //     $("#account_type_"+pid).val('').trigger('change');
        //     $("#bank-taxstatus_" + pid + "_" + bank_count).select2().trigger('change');

        // });

        bank_count = bank_count++;
        $('#step_edit').val(1);
        input();
        setTimeout(() => {
            $('select').select2({
                width: '100%',
                minimumResultsForSearch: 5
            });
            $('.net_worth_date').datepicker({
                autoclose: true,
                format: "dd-mm-yyyy"
            });

        }, 500);
    }
});
// $("#bankname").blur(function () {
//     $(".add-bank"+client_id).trigger('click');
// });
function input() {
    // $(".bank-name").blur(function () {
    //     let targerid = $(this).data('target');
    //     $('#' + targerid + '-tab').html($(this).val());
    // });
    // $('#introduction .remove-bank').click(function () {
    //     let count = $(this).parent().data('count');

    //     $('#bank_' + count).remove();
    //     $('#bank-tab_' + count).parent().remove();
    //     $('#addbank').tab('show')
    // });

    // $('input[name="date"]').daterangepicker({
    //     singleDatePicker: true,
    // });
    // $('input[name="birthdate"], input[name="cincorpdate"]').datepicker({
    //     autoclose: true
    // });
}

$(document).ready(function() {

    let current = $(document).find('section.trial.active');
    let current_step_id = current.attr('data-step');
    let current_pid_id = current.attr('data-pid');
    $(".amount").trigger('keyup');
    console.log(current_pid_id);
    $('#current_pid').val(current_pid_id);
    $(".country").each(function() {
        let country_id = $(this).attr('id');
        let country = $( "select#"+country_id+" option:selected" ).val();
        let statecode = country_id.replace("country", "statecode");
        let state = $("#"+statecode).val();
        let state_id = country_id.replace("country", "state");
        getStates(country, state_id, state);
    });
    $(".foreign_country").each(function() {
        let country_id = $(this).attr('id');
        let country = $( "select#"+country_id+" option:selected" ).val();
        let statecode = country_id.replace("country", "statecode");
        let state = $("#"+statecode).val();
        let state_id = country_id.replace("country", "state");
        getStates(country, state_id, state);
    });
    $(".customMulti .data-list a").trigger('click');
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

$(document).on('change', '.country,.foreign_country', function (e) {
    let country_id = e.target.id;
    let country = $( "select#"+country_id+" option:selected" ).val();
    let state_id = country_id.replace("country", "state");
    getStates(country, state_id);
});

$(document).on('click', '.bank_clear', function (e) {
    let pid = $(this).attr('data-pid');
    let bank_count = $(this).attr('data-bank_count');

    $('#addbank_'+pid+'_'+bank_count+' input,#addbank_'+pid+'_'+bank_count+' select').each(function () {
        $(this).val("");
    });
    //$("bank-cheque_upload_"+pid+"_"+bank_count).
    if($(".bank-cheque_upload_"+pid+"_"+bank_count+" label div.value-wrap span.value").text().length > 0)
    $(".bank-cheque_upload_"+pid+"_"+bank_count+" label div.value-wrap span.value").html('Upload');
    return true;
});

$(document).on('click', '.delete-bank-button', function (e) {
    let pid = $(this).attr('data-pid');
    let bank_count = $(this).attr('data-bank_count');
    //$('#bank-is_active_'+pid+'_'+bank_count).val(0);
    // let value = $(this).parent().closest('section.trial').attr('id');
    // $('input[name=step_edit]').val(1);
    // $('#'+value+' input, #'+value+' select, #'+value+' label').attr('readonly', false);
    $('#deleteModal').modal('show');
    $('#deleteModal input[name=delete_pid]').val(pid);
    $('#deleteModal input[name=delete_bank_count]').val(bank_count);
    return true;
});

$(document).on('click', '.delete_bank_confirmed', function (e) {
    let pid = $('#deleteModal input[name=delete_pid]').val();
    let bank_count = $('#deleteModal input[name=delete_bank_count]').val();
    $('#bank-is_active_'+pid+'_'+bank_count).val(0);
    $('input[name=step_edit]').val(1);
    $('#deleteModal').modal('hide');
});

$(document).on('click', '.ifsc_search', function (e) {

    let ifsc_id = $(this).attr('id');
    let ifsc_code_id = ifsc_id.replace("table-search", "");
    let value = $('#bank-ifsc_no'+ifsc_code_id).val();
    $('input[name=step_edit]').val(1);
    //let value = e.target.value;

    //let ifsc_code_id = ifsc_id.replace("bank-ifsc_no", "");

    let url = "/admin/master/bankcode/"+value;
    $.ajax({
        type:     "GET",
        cache:    false,
        url:      url,
        dataType: "json",
        error: function (xhr) {
            //var error = jQuery.parseJSON(xhr.responseText);
            $('.bank-bank_name'+ifsc_code_id+' .error').removeClass('error');
            $('.bank-bank_name'+ifsc_code_id+' .span_err').remove();

            $('.bank-branch_name'+ifsc_code_id+' .error').removeClass('error');
            $('.bank-branch_name'+ifsc_code_id+' .span_err').remove();

            $('.bank-micr'+ifsc_code_id+' .error').removeClass('error');
            $('.bank-micr'+ifsc_code_id+' .span_err').remove();
            $('#bank-bank_name'+ifsc_code_id).val('').prop('readonly', false);
            $('#bank-branch_name'+ifsc_code_id).val('').prop('readonly', false);
            $('#bank-micr'+ifsc_code_id).val('').prop('readonly', false);
            alert('IFSC code not found');
        },
        success: function (data, status) {
            console.log(data);
            if(data){
                $('#bank-bank_name'+ifsc_code_id).val(data.bank).prop('readonly', true);
                $('#bank-branch_name'+ifsc_code_id).val(data.branch).prop('readonly', true);
                $('#bank-micr'+ifsc_code_id).val(data.micr_code).prop('readonly', true);
                console.log(ifsc_code_id);
                $('.bank-bank_name'+ifsc_code_id+' .error').removeClass('error');
                $('.bank-bank_name'+ifsc_code_id+' .span_err').remove();

                $('.bank-branch_name'+ifsc_code_id+' .error').removeClass('error');
                $('.bank-branch_name'+ifsc_code_id+' .span_err').remove();

                $('.bank-micr'+ifsc_code_id+' .error').removeClass('error');
                $('.bank-micr'+ifsc_code_id+' .span_err').remove();

            }else{
                $('#bank-bank_name'+ifsc_code_id).val('').prop('readonly', false);
                $('#bank-branch_name'+ifsc_code_id).val('').prop('readonly', false);
                $('#bank-micr'+ifsc_code_id).val('').prop('readonly', false);
            }
        }
    });

    // $.get("/master/bankcode/"+value, function(data, status){
    //     //console.log($.session.get('errors'));
    //     if(data){
    //         $('#bank_name'+ifsc_code_id).val(data.bank).prop('readonly', true);
    //         $('#branch_name'+ifsc_code_id).val(data.branch).prop('readonly', true);
    //         $('#micr'+ifsc_code_id).val(data.micr_code).prop('readonly', true);
    //     }else{
    //         $('#bank_name').val('').prop('readonly', false);
    //         $('#branch_name').val('').prop('readonly', false);
    //         $('#micr').val('').prop('readonly', false);
    //     }
    // });
});



$(document).on('click', '.is_address_same_all', function (e) {
    if($(this).is(":checked")){
        $(this).val('1');
        let name = $(this).attr('name');
        let name_array = name.split("_");
        let id = $(name_array).last()[0];

        addressMapping(id);


    }else{
        $(this).val('0');
    }
});

function addressMapping(id)
{
    let address_type = $("select#address_type_"+id+" option:selected").val();
    let address1 = $("#address1_"+id).val();
    let address2 = $("#address2_"+id).val();
    let address3 = $("#address3_"+id).val();
    let city = $("#city_"+id).val();
    let state = $("select#state_"+id+" option:selected").val();
    let country = $("select#country_"+id+" option:selected").val();
    let pincode = $("#pincode_"+id).val();

    $(".address_type").val(address_type);$('.address_type').trigger('change');
    $(".address1").val(address1);
    $(".address2").val(address2);
    $(".address3").val(address3);
    $(".city").val(city);
    //$(".country").val(country);$('.country').trigger('change');
    $(".state").val(state);$('.state').trigger('change');
    $(".pincode").val(pincode);
    console.log(address_type,address1);
}

//$(":input,select_tags").on("keyup change", function(e) {
$(document).on('keyup change', ':input,select_tags', function (e) {
    $val = $(this).val();

    if($val){
        $name = e.target.name;

        $name = $name.replace(/[\[\]']+/g, '');

        if($('.'+$name).find('label.span_err').length !== 0)
        {
            $('.'+$name).find('label.span_err').remove();
        }
    }
});

// function validateEmail(email) {
//     var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;

//   }
$(document).on('change', 'input[type="file"]', function (e) {

    const fileName = e.target.files[0].name;
    // $(this).parent().after(function () {
    //     return '<small class="form-text text-muted">' + fileName + '</small>';
    // })
    $(this).parent().addClass('hasValue');
    $(this).next().find('.value').html(fileName);

});

function showImage($image)
{
    console.log($image);

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

$(".edit-now").on("click", function(e) {

    let value = $(this).parent().closest('section.trial').attr('id');

    $('input[name=step_edit]').val(1);
    if($(this).parent().closest('section.trial').hasClass('edit_bank_detail'))
    {
        let pid = $(this).parent().closest('section.trial').attr('data-pid');
        $(".bank_added_"+pid).each(function() {
            if($(this).attr('data-active') == 1)
            {
                let id = $(this);
                //input.attr('type')
                //$('#addbank_3_2'+value+' input, #'+value+' select, #'+value+' label').attr('readonly', false);
                $(this).find(':input,select_tags,label').attr('readonly', false);
            }
        });

    }else{
        $('#'+value+' input, #'+value+' select, #'+value+' label , #'+value+' div.customMulti').attr('readonly', false);
    }
    // {
    //     //let edit = $("#associate_edit").val();
    //     let profession = $( "select#profession_id option:selected" ).val();

    //     if(profession < 3)
    //     {
    //         $(".arn_upload,.euin_upload").show();
    //         $(".arn_view,.euin_view").hide();
    //         $(".ria_upload").show();
    //         $(".ria_view").hide();
    //         $('#'+value+' input, #'+value+' select, #'+value+' label').attr('readonly', false);
    //     }
    // }
    //else{

        //$('#'+value)
    //}

});


$(document).on('change', '.ubo_name', function (e) {
    $pid = $('#current_pid').val();
    $id = 'ubo_name_'+$pid;
    let types = $('#'+$id).children().find('input:checked').map(function(i, e) {return e.value}).toArray();
    $count = types.length;
    $("#ubo_count_"+$pid).val($count);


});


$(document).on('change', '.is_guardian_address', function (e) {
    e.preventDefault();
    if($(this).is(':checked'))
    {
        $(this).val(1);
        let str = $(this).attr('name');
        let arr = str.split('_');
        let aid = arr[arr.length-1];

        let val = $(this).val();
        let client_id = $("#client_id").val();
        let url = '/client/creation';
        let data = [];
        data['client_id'] = client_id;
        data['profile_id'] = $("#client_guardian_id_"+aid).val();
        let gval = $("#client_guardian_id_"+aid).val();;
        console.log(data);
        $.ajax({
            type:     "GET",
            url:      url,
            data: { client_id : client_id, profile_id : gval },
            error: function (xhr) {
                var error = jQuery.parseJSON(xhr.responseText);
            },
            success: function (output, status) {
                console.log(output);
                $("#address_type_"+aid).val(output.address_type).trigger('change');
                $("#address1_"+aid).val(output.address1);
                $("#address2_"+aid).val(output.address2);
                $("#address3_"+aid).val(output.address3);
                $("#city_"+aid).val(output.city);
                let address_upload = output.address_upload;
                $(".address_upload_"+aid+ " div.form-group").append('<label class="w-100"><span class="text-lowercase font-italic"><a id="dynamic_address_upload" data-src="'+output.address_upload+'">Preview</a></span></label>');
                document.getElementById('dynamic_address_upload').setAttribute('href','javascript:showImage("'+address_upload+'")');
                $("#address_upload_path_"+aid).val(address_upload);
                $("#country_"+aid).val(output.country);//.trigger('change');
                $("#state_"+aid).val(output.state).trigger('change');
                $("#pincode_"+aid).val(output.pincode);
            }
        });

    }

});


$(document).on('change', '.client_guardian_id', function (e) {
    e.preventDefault();

    let str = $(this).attr('name');
    let arr = str.split('_');
    let aid = arr[arr.length-1];

    let val = $(this).val();
    let client_id = $("#client_id").val();
    let url = '/client/creation';
    let data = [];
    data['client_id'] = client_id;
    data['profile_id'] = val;
    $.ajax({
        type:     "GET",
        url:      url,
        data: { client_id : client_id, profile_id : val },
        error: function (xhr) {
            var error = jQuery.parseJSON(xhr.responseText);
        },
        success: function (output, status) {
            console.log(output);
            $("#pan_"+aid).val(output.pan);
            let pan_upload = output.pan_upload;
            let kyc_upload = output.kyc_upload;
            $("#dynamic_pan_upload").remove();
            $(".dynamic_pan_upload").remove();
            $(".pan_upload_"+aid+ " div.form-group").append('<label class="w-100 dynamic_pan_upload"><span class="text-lowercase font-italic"><a id="dynamic_pan_upload" data-src="'+output.pan_upload+'">Preview</a></span></label>');
            document.getElementById('dynamic_pan_upload').setAttribute('href','javascript:showImage("'+pan_upload+'")');
            $("#pan_upload_path_"+aid).val(pan_upload);
            $("#dynamic_kyc_upload").remove();
            $(".dynamic_kyc_upload").remove();
            $(".kyc_upload_"+aid+ " div.form-group").append('<label class="w-100 dynamic_kyc_upload"><span class="text-lowercase font-italic"><a id="dynamic_kyc_upload" data-src="'+output.pan_upload+'">Preview</a></span></label>');
            document.getElementById('dynamic_kyc_upload').setAttribute('href','javascript:showImage("'+kyc_upload+'")');
            $("#kyc_upload_path_"+aid).val(kyc_upload);
            $("#kyc_status_"+aid).val(output.kyc_status).trigger('change');
            $("#country_code_"+aid).val(output.country_code);
            $("#mobile_"+aid).val(output.mobile);
            $("#email_"+aid).val(output.email);
            $("#occupation_"+aid).val(output.occupation).trigger('change');
            $("#employer_name_"+aid).val(output.employer_name);
            $("#gross_annual_income_"+aid).val(output.gross_annual_income).trigger('change');
            $("#wealth_source_"+aid).val(output.wealth_source).trigger('change');
            $("#net_worth_"+aid).val(output.net_worth);
            $("#net_worth_date_"+aid).val(output.net_worth_date);
            $(".amount").trigger('keyup');
        }
    });
});

function SetAccountOpeningName(name)
{
    if(name == 'Saving')
    {
        return 'SB';
    }else if(name == 'Non-resident external'){
        return 'NRE';
    }else if(name == 'Non-resident ordinary'){
        return 'NRO';
    }else if(name == 'Current'){
        return 'CB';
    }
}
