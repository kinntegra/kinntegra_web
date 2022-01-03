$(document).on('change', '#first_holder', function (e) {
    $('.second_holder,.third_holder,.nominee_detail,.default_bank').find(':input,select_tags,label').attr('readonly', true);
    $('.other_bank .customMulti').attr('readonly', true);
    $(".nominee_detail").show();
    $("#second_holder").val("").trigger('change');
    e.preventDefault();
    let val = $(this).val();
    $('#nominee_id_1,#nominee_guardian_1,#nominee_id_2,#nominee_guardian_2,#nominee_id_3,#nominee_guardian_3').children('option[value="'+val+'"]').prop('disabled',true);
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
            let bank = '';
            let otherbank = '';
            let bank_name = '';
            $('#client_account_type').children('option').prop('disabled', false);
            $("#has_new_account").val('1');
            $("#first_holder_account_type").val(output.tax_status);
            let count = output.banks.length;
            if(count > 0)
            {
                bank += '<option value="" selected disabled>Select Bank</option>';
                otherbank += '<div class="data-list">';
                $.each(output.banks, function(i,o){
                    bank_name = o.bank_name + ' - ' +SetAccountOpeningName(o.account_type);
                    bank += '<option value="'+o.id+'">'+bank_name+'</option>';
                    otherbank += '<a class="dropdown-item">';
                        otherbank += '<div class="form-group custom-checkbox m-0">';
                            otherbank += '<input type="checkbox" name="other_bank[]" id="other_bank_'+o.id+'" value="'+o.id+'">';
                            otherbank += '<label for="other_bank_'+o.id+'">'+bank_name+'</label>';
                        otherbank += '</div>';
                    otherbank += '</a>';
                });
                otherbank += '<a class="dropdown-item">';
                    otherbank += '<div class="form-group custom-checkbox m-0">';
                        otherbank += '<input type="checkbox" name="other_bank[]" id="other_bank_0" value="0">';
                        otherbank += '<label for="other_bank_0">NA</label>';
                    otherbank += '</div>';
                otherbank += '</a>';
                otherbank += '</div>';
                $('#default_bank').html(bank);
                $('.default_bank').find(':input,select_tags,label').attr('readonly', false);
                //bank += '<option value="0">NA</option>';
                $('#other_bank').html(otherbank);

            }

            if(output.account_type == 1)
            {
                let second_holder_length = $('#second_holder').children('option').length;
                if(output.age >=18)
                {
                    if(second_holder_length > 2)
                    {
                        //Setting for Second Account holder
                        $('#second_holder').children('option').prop('disabled', false);
                        $('#second_holder').children('option[value="'+val+'"]').prop('disabled',true);
                        $('.second_holder').find(':input,select_tags,label').attr('readonly', false);
                    }

                }else{
                    $(".nominee_detail").hide();
                }
                $('#client_account_type').val('SINGLE'); // Select the option with a value of '1'
                $('#client_account_type').trigger('change'); // Notify any JS components that the value changed
                $(".client_account_type").show();
                $('#client_account_type').attr('readonly', true);
                //Setting for Nominee
                $('#nominee_id').children('option').prop('disabled', false);
                $('#nominee_id').children('option[value="'+val+'"]').prop('disabled',true);
                $('.has_nominee').attr('readonly', false);
                $('.has_nominee').find(':input,select_tags,label').attr('readonly', false);
            }
            if(output.account_type == 2)
            {
                $(".nominee_detail").hide();
                $("#client_account_type").val("NON INDIVIDUAL").trigger('change');
                $(".client_account_type").show();
                $('#client_account_type').attr('readonly', true);
            }
            //$('#first_holder').attr('readonly', true);
        }
    });
});

$(document).on('change', '.account-first_holder', function (e) {
    let id = $(this).attr('id');
    var index = id.lastIndexOf("_");
    var last = id.substr(index + 1);

    e.preventDefault();
    //$('.second_holder,.third_holder,.nominee_detail,.default_bank,.other_banks').find(':input,select_tags,label').attr('readonly', true);
    //$(".nominee_detail").show();
    //$("#second_holder").val("").trigger('change');
    e.preventDefault();
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
            if(output.account_type == 1)
            {
                let second_holder_length = $('#account-second_holder_'+last).children('option').length;
                if(output.age >=18)
                {
                    if(second_holder_length > 2)
                    {
                        //Setting for Second Account holder
                        $('#account-second_holder_'+last).children('option').prop('disabled', false);
                        $('#account-second_holder_'+last).children('option[value="'+val+'"]').prop('disabled',true);
                        $('.account-second_holder_'+last).find(':input,select_tags,label').attr('readonly', false);
                    }
                }
            }
        }
    });
});

$(document).on('change', '#second_holder', function () {

    let val = $(this).val();
    let val1 = $("#first_holder").val();
    let nval = $("#nominee_id").val();
    //
    let third_holder_length = $('#third_holder').children('option').length;
    console.log(third_holder_length);
    if(third_holder_length > 3)
    {
        $('#third_holder').children('option').prop('disabled', false);
        $('#third_holder').children('option[value="'+val+'"],option[value="'+val1+'"]').prop('disabled',true);
        $('.third_holder').find(':input,select_tags,label').attr('readonly', false);
    }
    if(val == nval)
    $("#nominee_id").val("").trigger('change');
    $('#nominee_id').children('option').prop('disabled', false);
    $('#nominee_id').children('option[value="'+val+'"],option[value="'+val1+'"]').prop('disabled',true);
    $('#client_account_type').children('option[value="SINGLE"],option[value="NON INDIVIDUAL"]').prop('disabled',true);
    $("#client_account_type").val("").trigger('change');
    $(".client_account_type").show();
    $('#client_account_type').attr('readonly', false);
});

$(document).on('change', '.account-second_holder', function () {

    let val = $(this).val();

    let id = $(this).attr('id');
    var index = id.lastIndexOf("_");
    var last = id.substr(index + 1);
    let val1 = $("#account-first_holder_"+last).val();
    let nval = $("#account-nominee_id_"+last).val();
    //
    let third_holder_length = $('#account-third_holder_'+last).children('option').length;
    console.log(third_holder_length);
    if(third_holder_length > 3)
    {
        $('#account-third_holder_'+last).children('option').prop('disabled', false);
        $('#account-third_holder_'+last).children('option[value="'+val+'"],option[value="'+val1+'"]').prop('disabled',true);
        $('.account-third_holder_'+last).find(':input,select_tags,label').attr('readonly', false);
    }
    if(val == nval)
    $("#account-nominee_id_"+last).val("").trigger('change');
    $("#account-nominee_id_"+last).children('option').prop('disabled', false);
    $("#account-nominee_id_"+last).children('option[value="'+val+'"],option[value="'+val1+'"]').prop('disabled',true);
    //$('#account-account_type_'+last).children('option[value="SINGLE"],option[value="NON INDIVIDUAL"]').prop('disabled',true);
    //$("#account-account_type_"+last).val("").trigger('change');
    $(".account-account_type_"+last).show();
    $('#account-account_type_'+last).attr('readonly', false);
});


$(document).on('change', '#default_bank', function (e) {
    e.preventDefault();
    let val = $(this).val();
    let tax_status = $("#first_holder_account_type").val();
    let value = '';
    console.log(val);

    $("a.dropdown-item").each(function() {
        if($(this).hasClass('d-none'))
        {
            $(this).removeClass('d-none');
        }
        value = $(this).children().find('input[type=checkbox]').val();
        if(tax_status == "NRI" || tax_status == "On behalf of minor")
        {
            if(value > 0)
            {
                $(this).addClass('d-none');
            }
        }else{
            if(val == value)
            {
                $(this).addClass('d-none');
            }
        }

    });

    $('.other_bank').find(':input,select_tags,label').attr('readonly', false);
    $('.other_bank .customMulti').attr('readonly', false);
});

$(document).on('change', '.account-default_bank', function (e) {
    e.preventDefault();
    let val = $(this).val();
    let id = $(this).attr('id');
    var index = id.lastIndexOf("_");
    var last = id.substr(index + 1);
    console.log(last);
    let length = $('#account-other_bank_'+last).children('option').length;

    if(length > 3)
    {
        $('#account-other_bank_'+last).children('option[value="'+val+'"]').prop('disabled',true);
    }else{
        $('#account-other_bank_'+last).val("0").trigger('change');
    }
    $('.account-other_bank_'+last).find(':input,select_tags,label').attr('readonly', false);
});

$(document).on('change', '#has_nominee', function (e) {
    if($(this).is(":checked")){
        $(this).val('1');
        $(".nominee_set").show();
        $(".nominee_1").addClass('valid');
        //$('#nominee_id_1 option disabled').length;
        $nominee_id_1_count = 0;
        let first = 0;
        $('select#nominee_id_1 > option:enabled').each(function() {
            $nominee_age = $(this).attr('data-age');
            // if($nominee_age > 18)
            // {
                $nominee_id_1_count++;
                if($nominee_id_1_count == 1){first = $(this).val();}
                $('.nominee_id_'+$nominee_id_1_count).find(':input,select_tags,label').attr('readonly', false);
                $('.nominee_guardian_'+$nominee_id_1_count).find(':input,select_tags,label').attr('readonly', false);
                $('.nominee_relationship_'+$nominee_id_1_count).find(':input,select_tags,label').attr('readonly', false);
                $('.nominee_applicable_'+$nominee_id_1_count).find(':input,select_tags,label').attr('readonly', false);
            //}

        });
        if($nominee_id_1_count == 1){
            $("#nominee_id_"+$nominee_id_1_count).val(first).trigger('change');
            $('.nominee_id_'+$nominee_id_1_count).find(':input,select_tags,label').attr('readonly', true);
            $("#nominee_applicable_"+$nominee_id_1_count).val("100").trigger('change');
            $('.nominee_applicable_'+$nominee_id_1_count).find(':input,select_tags,label').attr('readonly', true);
        }
        console.log($nominee_id_1_count);


    }else if($(this).is(":not(:checked)")){
        $(this).val('0');
        $(".nominee_set").hide();
        $("#nominee_id_1,#nominee_id_2,#nominee_id_3").val("").trigger('change');
        $("#nominee_id_1,#nominee_id_2,#nominee_id_3").attr('readonly', true);

        $('.nominee_guardian_1,.nominee_guardian_2,.nominee_guardian_3').find(':input,select_tags,label').attr('readonly', true);
        $("#nominee_relationship_1,#nominee_relationship_2,#nominee_relationship_3").val("").trigger('change');
        $("#nominee_relationship_1,#nominee_relationship_2,#nominee_relationship_3").attr('readonly', true);
    }
});

$(document).on('change', '#nominee_applicable_1,#nominee_applicable_2,#nominee_applicable_3', function (e) {
    let id = $(this).attr('id');
    let val = $(this).val();
    let count = id.split("_").pop();
    let percentage = 100;
    //let show = 0;
    console.log(count);
    if(count == 1)
    {
        percentage = percentage - parseInt(val);
    }
    if(count == 2)
    {
        percentage = percentage - parseInt($("#nominee_applicable_1").val());
        percentage = percentage - parseInt(val);
    }
    if(percentage > 0)
    {
        count = parseInt(count)+1;
        if(count <= 3)
        $(".nominee_"+count).show();
        $("#nominee_applicable_"+count).children('option').prop('disabled', false);
        $("#nominee_applicable_"+count).val(percentage).trigger('change');
        var i;
        percentage = percentage+1;
        for (i = percentage; i <= 100; i++) {
            $("#nominee_applicable_"+count).children('option[value="'+i+'"]').prop('disabled',true);
        }

    }

    return true;
});

$(document).on('change', '.account-has_nominee', function (e) {
    let id = $(this).attr('id');
    var index = id.lastIndexOf("_");
    var last = id.substr(index + 1);
    var parent_id = "account-nominee_detail_"+last;

    if($(this).is(":checked")){
        $(this).val('1');
        $("."+parent_id+" .nominee_reset").show();
        $('.account-nominee_id_'+last).find(':input,select_tags,label').attr('readonly', false);
        $('.account-nominee_relationship_'+last).find(':input,select_tags,label').attr('readonly', false);
    }else if($(this).is(":not(:checked)")){
        $(this).val('0');
        $("."+parent_id+" .nominee_reset").hide();
        $("#account-nominee_id_"+last).val("").trigger('change');
        $('#account-nominee_id_'+last).attr('readonly', true);
        $('#account-nominee_name_'+last).val('');
        $("#account-nominee_relationship_"+last).val("").trigger('change');
        $('#account-nominee_relationship_'+last).attr('readonly', true);
    }
});

$(document).on('change', '#nominee_id_1,#nominee_id_2,#nominee_id_3', function (e) {
    e.preventDefault();
    let id = $(this).attr('id');
    //$( "select#introducer_id option:selected" ).val();
    let val = $(this).val();
    let age = $('#'+id).children('option[value="'+val+'"]').attr('data-age');//$("select#"+id+" option:selected").prop('data-age');

    let og_id = id.split("_").pop();
    let nominee_no = parseInt(og_id);

    if(nominee_no == 1)
    {
        nominee_no = nominee_no+1;
        let nominee_id = id.replace(og_id, nominee_no);
        $('#'+nominee_id).children('option[value="'+val+'"]').prop('disabled',true);
    }
    if(nominee_no == 2)
    {
        nominee_no = nominee_no+1;
        let nominee_id = id.replace(og_id, nominee_no);
        $('#'+nominee_id).children('option[value="'+val+'"]').prop('disabled',true);
    }

    let class_name = id.replace("_id_", "_");
    $("."+class_name).addClass('valid');
    let guardian_id = id.replace("id", "guardian");
    console.log(guardian_id);
    if(age < 18)
    {
        $('.'+guardian_id).find(':input,select_tags,label').attr('readonly', false);
        //$("#"+guardian_id).prop('readonly',false);
    }else{
        $('.'+guardian_id).find(':input,select_tags,label').attr('readonly', true);
    }



    // if(val != '' && val == 0)
    // {
    //     $("#"+name).attr('readonly', false);
    // }else{
    //     $("#"+name).attr('readonly', true);
    // }
});

$(document).on('change', '.account-nominee_id', function (e) {
    e.preventDefault();
    let val = $(this).val();
    let id = $(this).attr('id');
    var index = id.lastIndexOf("_");
    var last = id.substr(index + 1);
    if(val != '' && val == 0)
    {
        $("#account-nominee_name_"+last).attr('readonly', false);
    }else{
        $("#account-nominee_name_"+last).attr('readonly', true);
    }
});

let count = parseInt($('#account_count').val(), 10) + 1;
//$('.add-account').click(function () {
$(document).on('click', '.add-account', function () {
    let error_count = 0;
    $('#account_detail .error').removeClass('error');
    $('#account_detail .err').removeClass('err');
    $('#account_detail .span_err').remove();
    //error_count = checkActiveIndividualMember(error_count);
    //console.log(error_count);
    if(error_count > 0)
    {
        return false;
    }

    let allData = false;
    let data = {};

    $('.addAccountTab input,.addAccountTab select').each(function () {

        if($(this).val() == "" || $(this).val() == null)
        {
            error_count = addNewAccountValidation(error_count);
        }
        // if ($(this).val() == "") {
        //     //error_count = addIndividualMember(error_count);
        //     allData = false;
        //     return false;
        // } else {
        //     allData = true;
        //     data[$(this).attr('id') + count] = $(this).val();
        // }
        //console.log(error_count);
        if(error_count > 0)
        {
            allData = false;
            return false;
        }else{
            if($(this).attr('id') == 'first_holder')
            {
                data[$(this).attr('id')] = $(this).val();
            }
            data[$(this).attr('id') + count] = $(this).val();
            allData = true;
        }



    });
    console.log(data);
    //return false;
    if (allData) {
        //if(!data.first_holder1){return false;}
        data['account_count'] = count;
        data['client_id'] = $("#client_id").val();
        console.log(data.first_holder);
        if(data.first_holder != null)
        {
            let other_bank_id = $('#other_bank').children().find('input:checked').map(function(i, e) {return e.value}).toArray();
            data['other_bank'+count] = other_bank_id;
            $.get("/client/creation/create", data, function(output, status){
                console.log(output);
                $(output[1]).insertBefore('.add-account-item');
                $("#account-tab").prepend(output[0]);
                $('#add-account').remove();
                $("#account-tab").append(output[2]);
                // $('.addAccountTab input,.addAccountTab select').each(function () {
                //     $(this).val("");
                // });
                //$('#other_bank input[type="checkbox"]').prop('checked', false);
                //$('.other_bank .customMulti').attr('readonly',true);
                // $("#taxstatus").val('').trigger('change');
                // $("#taxslab").val('').trigger('change');
                // $("#relation").val('').trigger('change');


                $('#account-first_holder_' + count).select2().trigger('change');
                $('#account-second_holder_' + count).select2().trigger('change');
                $('#account-third_holder_' + count).select2().trigger('change');
                $('#account-account_type_' + count).select2().trigger('change');
                $('#account-nominee_id_' + count).select2().trigger('change');
                $('#account-nominee_relationship_' + count).select2().trigger('change');
                //$('#account-default_bank_' + count).select2().trigger('change');
                //$('#account-other_bank_' + count).select2().trigger('change');
                //$('.second_holder,.third_holder,.default_bank,.other_bank').find(':input,select_tags,label').attr('readonly', true);
                //$("#account_type,#second_holder,#third_holder,#nominee_id,#nominee_name,#nominee_relationship").val("").trigger('change');
                //$(".account_type").hide();
                //$("#has_nominee").val('0');
                //$("#has_nominee").prop('checked', false)
                //$('.has_nominee').find(':input,select_tags,label').attr('readonly', false);
                //$(".nominee_set").hide();
                $("#account_count").val(count);
                //$(".customMulti .data-list a").trigger('click');
                count = count + 1;

                //input();
                setTimeout(() => {
                    $('select').select2({
                        width: '100%',
                        minimumResultsForSearch: 10
                    });
                    $(".account-default_bank").trigger('change');
                    $('.birth_date, .incorpdate').datepicker({
                        autoclose: true,
                        format: "dd-mm-yyyy"
                    });
                    $('.nominee_2,.nominee_3').hide();
                }, 500);
            });
        }
    }
});


// $(".other_bank").bind("change", function(){
//     console.log('shashi');
// });
// $('.customMulti').on('hidden.bs.dropdown', function () {
//     $(".add-account").trigger('click');
// });
$(document).on('hidden.bs.dropdown', '.customMulti', function () {
    $(".add-account").trigger('click');
});

function addNewAccountValidation(error_count)
{
    let member_id = '';
    let member_error = '';
    let empty_count = 0;
    let non_empty_count = 0;
    let nominee_applicant = 0;
    //let first_holder = $("select#first_holder option").filter(":selected").val();
    let second_holder = $("select#first_holder option").filter(":selected").val();
    let third_holder = $("select#first_holder option").filter(":selected").val();
    let account_type = $("select#account_type option").filter(":selected").val();
    let default_bank = $("select#default_bank option").filter(":selected").val();
    let other_bank = $("select#other_bank option").filter(":selected").val();
    let has_nominee = $("#has_nominee").val();
    let nominee_id = $("select#nominee_id option").filter(":selected").val();
    let nominee_relationship = $("select#nominee_relationship option").filter(":selected").val();
    let nominee_name = $("#nominee_name").val();
    let account_count = $("#account_count").val();
    let has_new_account = $("#has_new_account").val();
    //console.log(error_count);
    if ($("a.nav-link.add-account").hasClass("active")) {

        //Check if one account is created and current active all field are enpty or not
        $('#add-account input,#add-account  select').each(function () {
            //console.log($(this).attr('id'),$(this).val());
            if ($(this).val() == "" || $(this).val() == null) {empty_count++;}
            else{
                if($(this).attr('id') == 'has_nominee' || $(this).attr('id') == 'nominee_applicable_1' || $(this).attr('id') == 'nominee_applicable_2' || $(this).attr('id') == 'nominee_applicable_3')
                {
                    if($(this).val() == 0){empty_count++;}
                }else{
                    console.log($(this).attr('id'),$(this).val());
                    non_empty_count++;
                }
            }
            //if($(this).attr('id') == 'has_nominee' && $(this).val() == 0){empty_count++;}else{non_empty_count++;}
        });

        if(non_empty_count == 0 && $("#account_count").val() > 0)//&& $("#has_new_account").val() == 0
        {
            return error_count;
        }
        //Check if any single account created or Not
        if($("#account_count").val() == 0 && $("#has_new_account").val() == 0)
        {
            error_count++;
            member_id = 'addAccountTab';
            member_error = 'Please create atleast one account';
            $( ".addAccountTab" ).prepend( "<div id='"+member_id+"_error' class='col-sm-12 span_err'><label class='error'>"+member_error+"</label></div>" );
        }
        //First Account Holder
        if($('#first_holder').val() == '' || $('#first_holder').val() == null)
        {
            error_count++;
            member_id = 'first_holder';
            member_error = 'Select first holder name';
            $('.'+member_id).children().not("div.exclude").not("label").not("span").append("<label id='"+member_id+"_error' class='error span_err'>"+member_error+"</label>");
        }else{
            //Validation for Default Bank
            // if(account_type == "SINGLE")
            // {

            // }
        }

        if(has_nominee == 1)
        {
            //nominee_applicant = 0;
            if($('.nominee_1').hasClass('valid'))
            {
                if($('#nominee_id_1').val() == '' || $('#nominee_id_1').val() == null)
                {
                    error_count++;
                    member_id = 'nominee_id_1';
                    member_error = 'Select nominee name';
                    $('.'+member_id).children().not("div.exclude").not("label").not("span").append("<label id='"+member_id+"_error' class='error span_err'>"+member_error+"</label>");
                }else{
                    if($('#nominee_id_1').val() == 0)
                    {
                        if(!$('#nominee_name_1').val())
                        {
                            error_count++;
                            member_id = 'nominee_name_1';
                            member_error = 'Enter nominee name';
                            $('.'+member_id).children().not("div.exclude").not("label").not("span").append("<label id='"+member_id+"_error' class='error span_err'>"+member_error+"</label>");
                        }
                    }
                }

                if($('#nominee_relationship_1').val() == '' || $('#nominee_relationship_1').val() == null)
                {
                    error_count++;
                    member_id = 'nominee_relationship_1';
                    member_error = 'Select nominee relationship';
                    $('.'+member_id).children().not("div.exclude").not("label").not("span").append("<label id='"+member_id+"_error' class='error span_err'>"+member_error+"</label>");
                }

                if($('#nominee_applicable_1').val() == '' || $('#nominee_applicable_1').val() == null || $('#nominee_applicable_1').val() == 0)
                {
                    error_count++;
                    member_id = 'nominee_applicable_1';
                    member_error = 'Select nominee relationship';
                    $('.'+member_id).children().not("div.exclude").not("label").not("span").append("<label id='"+member_id+"_error' class='error span_err'>"+member_error+"</label>");
                }else{
                    nominee_applicant = nominee_applicant + parseInt($('#nominee_applicable_1').val());
                }
            }

            if($('.nominee_2').hasClass('valid'))
            {
                if($('#nominee_id_2').val() == '' || $('#nominee_id_2').val() == null)
                {
                    error_count++;
                    member_id = 'nominee_id_2';
                    member_error = 'Select nominee name';
                    $('.'+member_id).children().not("div.exclude").not("label").not("span").append("<label id='"+member_id+"_error' class='error span_err'>"+member_error+"</label>");
                }else{
                    if($('#nominee_id_2').val() == 0)
                    {
                        if(!$('#nominee_name_2').val())
                        {
                            error_count++;
                            member_id = 'nominee_name_2';
                            member_error = 'Enter nominee name';
                            $('.'+member_id).children().not("div.exclude").not("label").not("span").append("<label id='"+member_id+"_error' class='error span_err'>"+member_error+"</label>");
                        }
                    }
                }

                if($('#nominee_relationship_2').val() == '' || $('#nominee_relationship_2').val() == null)
                {
                    error_count++;
                    member_id = 'nominee_relationship_2';
                    member_error = 'Select nominee relationship';
                    $('.'+member_id).children().not("div.exclude").not("label").not("span").append("<label id='"+member_id+"_error' class='error span_err'>"+member_error+"</label>");
                }

                if($('#nominee_applicable_2').val() == '' || $('#nominee_applicable_2').val() == null || $('#nominee_applicable_2').val() == 0)
                {
                    error_count++;
                    member_id = 'nominee_applicable_2';
                    member_error = 'Select nominee relationship';
                    $('.'+member_id).children().not("div.exclude").not("label").not("span").append("<label id='"+member_id+"_error' class='error span_err'>"+member_error+"</label>");
                }
                else{
                    nominee_applicant = nominee_applicant + parseInt($('#nominee_applicable_2').val());
                }
            }

            if($('.nominee_3').hasClass('valid'))
            {
                if($('#nominee_id_3').val() == '' || $('#nominee_id_3').val() == null)
                {
                    error_count++;
                    member_id = 'nominee_id_3';
                    member_error = 'Select nominee name';
                    $('.'+member_id).children().not("div.exclude").not("label").not("span").append("<label id='"+member_id+"_error' class='error span_err'>"+member_error+"</label>");
                }else{
                    if($('#nominee_id_3').val() == 0)
                    {
                        if(!$('#nominee_name_3').val())
                        {
                            error_count++;
                            member_id = 'nominee_name_3';
                            member_error = 'Enter nominee name';
                            $('.'+member_id).children().not("div.exclude").not("label").not("span").append("<label id='"+member_id+"_error' class='error span_err'>"+member_error+"</label>");
                        }
                    }
                }

                if($('#nominee_relationship_3').val() == '' || $('#nominee_relationship_3').val() == null)
                {
                    error_count++;
                    member_id = 'nominee_relationship_3';
                    member_error = 'Select nominee relationship';
                    $('.'+member_id).children().not("div.exclude").not("label").not("span").append("<label id='"+member_id+"_error' class='error span_err'>"+member_error+"</label>");
                }

                if($('#nominee_applicable_3').val() == '' || $('#nominee_applicable_3').val() == null || $('#nominee_applicable_3').val() == 0)
                {
                    error_count++;
                    member_id = 'nominee_applicable_3';
                    member_error = 'Select nominee relationship';
                    $('.'+member_id).children().not("div.exclude").not("label").not("span").append("<label id='"+member_id+"_error' class='error span_err'>"+member_error+"</label>");
                }
                else{
                    nominee_applicant = nominee_applicant + parseInt($('#nominee_applicable_3').val());
                }
            }
            if(nominee_applicant != 100)
            {
                error_count++;
                member_id = 'nominee_applicable_1';
                member_error = 'Total 100% required';
                $('.'+member_id).children().not("div.exclude").not("label").not("span").append("<label id='"+member_id+"_error' class='error span_err'>"+member_error+"</label>");
            }
        }

        if($('#default_bank').val() == '' || $('#default_bank').val() == null)
        {
            error_count++;
            member_id = 'default_bank';
            member_error = 'Select default bank';
            $('.'+member_id).children().not("div.exclude").not("label").not("span").append("<label id='"+member_id+"_error' class='error span_err'>"+member_error+"</label>");
        }

    }

    return error_count;
}

$(":input,select_tags").on("keyup change", function(e) {
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

$(document).on('click',".customMulti .data-list a", function(e) {
    e.stopPropagation();
    //console.log('shashi');
    var selected = [];
    var list = $(this).parent();
    var origOrder = list.children().not('hr');;
    var i;
    var checked = document.createDocumentFragment();
    var unchecked = document.createDocumentFragment();
    for (i = 0; i < origOrder.length; i++) {
        if (origOrder[i].getElementsByTagName("input")[0].checked) {
            checked.appendChild(origOrder[i]);
            selected.push(origOrder[i].getElementsByTagName("label")[0].innerHTML);
        } else {
            unchecked.appendChild(origOrder[i]);
        }
    }
    list.html('');
    list.append(checked).append('<hr>').append(unchecked);
    if (selected.length < 1) {
        let text = "<span class='text-grey'>Select Option</span>"
        $(this).parent().parent().prev().html(text);
    } else if (selected.length == 1) {
        $(this).parent().parent().prev().html(selected[0]);
    } else {
        let text = selected[0] + ' + ' + (selected.length - 1) + ' Others';
        $(this).parent().parent().prev().html(text);
    }
});

$(document).on('click',".acustomMulti .data-list a", function(e) {
    e.stopPropagation();
    //console.log('shashi');
    var selected = [];
    var list = $(this).parent();
    var origOrder = list.children().not('hr');;
    var i;
    var checked = document.createDocumentFragment();
    var unchecked = document.createDocumentFragment();
    for (i = 0; i < origOrder.length; i++) {
        if (origOrder[i].getElementsByTagName("input")[0].checked) {
            checked.appendChild(origOrder[i]);
            selected.push(origOrder[i].getElementsByTagName("label")[0].innerHTML);
        } else {
            unchecked.appendChild(origOrder[i]);
        }
    }
    list.html('');
    list.append(checked).append('<hr>').append(unchecked);
    if (selected.length < 1) {
        let text = "<span class='text-grey'>Select Option</span>"
        $(this).parent().parent().prev().html(text);
    } else if (selected.length == 1) {
        $(this).parent().parent().prev().html(selected[0]);
    } else {
        let text = selected[0] + ' + ' + (selected.length - 1) + ' Others';
        $(this).parent().parent().prev().html(text);
    }
});

$('.acc-default_bank').select2().next().hide();
$('.acc-other_bank').hide();

$(".edit-now").on("click", function(e) {

    $aid = $("a.nav-link.active").attr('href');

    if($('.account-created').hasClass('active'))
    {
        $('#step_edit').val('1');
        let account_id = $('.account-created.active').attr('id');
        //console.log(account_id);
        $('#'+account_id+' .acc-default_bank').select2().next().show();
        $('#'+account_id+' .acc-default_bank_opp').hide();
        $('#'+account_id+' .acc-other_bank').show();
        $('#'+account_id+' .acc-other_bank_opp').hide();
        $('#'+account_id+' .acustomMulti .data-list a').trigger('click');
       return true;
    }

});

$(".acc-default_bank").change(function(e){
    let name = $(this).attr('name');
    let value = $(this).val();
    let account_id = $('.account-created.active').attr('id');
    console.log(account_id);
    let other_bank_check_id = name.replace("default_bank", "other_bank")+"_"+value;
    let other_bank_default_id = name.replace("default_bank", "other_bank")+"_0";
    console.log(other_bank_check_id);
    let has_update = name.replace("default_bank", "has_updated");
    if($("#"+other_bank_check_id).is(":checked")){
        $("#"+other_bank_check_id).prop('checked',false);
        var searchIDs = $('#account-other_bank_1 input:checked').map(function(){
            return $(this).val();
        });
        if(searchIDs.length == 0)
        {
            $("#"+other_bank_default_id).prop('checked',true);
        }
        $('#'+account_id+' .acustomMulti .data-list a').trigger('click');
    }

    $("input[name='"+has_update+"']").val(1);
});

$('#RejectionModal input[type="checkbox"]').change(function() {
    let id =  $(this).attr('id');
    if($(this).is(":checked")) {
        $(this).val(1);
        $('#is_reject').val(1);
        $('.'+id).attr('readonly', false);
    }else{
        $(this).val(0);
        $('.'+id).attr('readonly', true);
    }
    $('#textbox1').val($(this).is(':checked'));
});

$('#client_creation .trial button.proceeds').click(function (e) {
    e.preventDefault();
    $(document).scrollTop(0);
    //disableEnter(e);
    $('#loading').show();
    let error_count = 0;
    $('.error').removeClass('error');
    $('.err').removeClass('err');
    $('.span_err').remove();
    error_count = addNewAccountValidation(error_count);
    // console.log(error_count, 'final');
    // return false;
    if(error_count > 0)
    {
        $('#loading').hide();
        return false;
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
    let has_new_account = $("#has_new_account").val();
    let step_edit = $("#step_edit").val();
    let is_verify = $("#is_verify").val();
    let is_reject = $("#is_reject").val();
    // console.log(has_new_account,step_edit);
    // return false;
    if(has_new_account == 0 && step_edit == 0 && is_verify == 0 && is_reject == 0)
    {
        window.location.href = '/client/mandate/'+id;
        return false;
    }

    let post = $('form#client_creation').attr('method');
    let url = $('form#client_creation').attr('action');
    let formData = new FormData($('#client_creation')[0]);
    $.ajax({
        type: post,
        url: url,
        data: formData,
        //async: false,
        beforeSend: function() {
            $('#loading').show();
        },
        success:function(data) {
            console.log(data);//return false;
            if(data['status'] != 1)
            {
                window.location.href = '/client/creation?title='+data['title']+'&message='+data['message'];
            }else{
                //window.location.href
                if($("#is_verify").val() == 1 || $("#is_verify").val() == 2)
                {
                    window.location.href = '/client/mandate/'+id+'?is_verify='+$("#is_verify").val();
                }else{
                    window.location.href = '/client/mandate/'+id;
                }
                //window.location.href = '/client/mandate/'+id;
            }
        },
        error: function(xhr, textStatus, thrownError)
        {
            $('#loading').hide();
            //console.log(xhr);
            var response = jQuery.parseJSON(xhr.responseText);
            console.log(response);
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


$( document ).ready(function() {
    $('.nominee_2,.nominee_3').hide();
});
