var formLength = $('.step-forms .trial').length;
$(window).on('load', function () {
    //let height = $('.step-forms .active').height();
    //$('.step-forms').css('height', height + 'px');
    $('.birth_date, .incorpdate').datepicker({
        autoclose: true,
        format: "dd-mm-yyyy"
    });
});
$(document).ready(function () {

    $cid = '';
    $cname = '';
    getIndividualName($cid,$cname);
    //let account_type = $('#accounttype').children().find('input:checked,readonly').map(function(i, e) {return e.value}).toArray();
    if($('#individual').attr('readonly'))
    {
        $('#individual').parent().addClass('readonly');
    }
    $('input[type="checkbox"][readonly]').on("click.readonly", function(event){event.preventDefault();}).css("opacity", "0.5");
});

function getIndividualName($cid,$cname)
{
    let option_value = '';
    option_value += '<option value="" disabled selected>Select Name</option>';
    $('.member_tab').each(function() {
        var currentElement = $(this).attr('id');
        var id = currentElement.replace('-tab_','');
        var name = currentElement.replace('-tab_','-name_');
        var individual = currentElement.replace('-tab_','-taxstatus_');
        var individual_value = $('#'+individual).val();
        var value = $('#'+name).val();
        if(individual_value == 'Individual')
        option_value += '<option value="'+value+'">'+value+'</option>';

    });

    $('#cauthname1').html(option_value);
    $('#cauthname2').html(option_value);
}

$('.step-forms .trial button.proceed').click(function (e) {
    e.preventDefault();
    $(document).scrollTop(0);
    //disableEnter(e);
    $('#loading').show();
    let error_count = 0;
    $('.error').removeClass('error');
    $('.err').removeClass('err');
    $('.span_err').remove();
    error_count = check_validation(error_count);
    console.log(error_count, 'final');
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


    let post = $('form#client_introduction').attr('method');
    let url = $('form#client_introduction').attr('action');
    let formData = new FormData($('#client_introduction')[0]);
    let proceedto = $( "select#proceedto option:selected" ).val();
    $.ajax({
        type: post,
        url: url,
        data: formData,
        //async: false,
        beforeSend: function() {//xhr, type
            $('#loading').show();
        },
        success:function(data) {
            console.log(proceedto);
            if(proceedto == 'Comprehensive plan')
            {
                if($("#is_verify").val() == 1 || $("#is_verify").val() == 2)
                {
                    window.location.href = '/client/comprehensive/'+id+'?is_verify='+$("#is_verify").val();
                }else{
                    window.location.href = '/client/comprehensive/'+id;
                }

            }

            if(proceedto == 'Account Opening')
            {
                if($("#is_verify").val() == 1 || $("#is_verify").val() == 2)
                {
                    window.location.href = '/client/kycdetail/'+id+'?is_verify='+$("#is_verify").val();
                }else{
                    window.location.href = '/client/kycdetail/'+id;
                }
            }


            console.log(data);
            //return false;
            // if(data.id)
            // $('input[name="associate_id"]').val(data.id);
            //Main Data

            //nextSteper(current,isAccount,data.id);

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

function check_validation(error_count)
{
    let user_associate = $('input[name=user_associate]').val();
    let proceedto = $( "select#proceedto option:selected" ).val();
    let has_employee = $('input[name=has_employee]').val();
    let account_type = $('#accounttype').children().find('input:checked').map(function(i, e) {return e.value}).toArray();
    console.log(error_count,0);


    let member_id = '';
    let member_error = '';
    let non_ind = 0;
    if(account_type.includes("individual"))
    {
        let numFamily = $('.member-profileid').length;
        if(numFamily == 0)
        {
            //error_count++;
            console.log(error_count,1);
            //Validation if Company details are filled and Individual option is clicked
            error_count = addIndividualMember(error_count);
        }
    }console.log(error_count);
    if(account_type.includes("nonindividual"))
    {
        let numCompany = $('.company-profileid').length;
        if(numCompany == 0)
        {
            //error_count++;
            console.log(error_count,2);
            non_ind++;
            //Validation if Company details are filled and Individual option is clicked
            error_count = addMoreCompany(error_count);
        }
    }
    // else{
    //     console.log('not matched for individual');
    // }

    //Validation for Associate
    if(user_associate == 0)
    {
        member_id = 'associate_id';
        member_error = 'Select Associate';

        if(!$('#associate_id').val())
        {
            error_count++;
            console.log(error_count,3);
            $('.'+member_id).children().not("div.exclude").not("label").not("span").append("<label id='"+member_id+"_error' class='error span_err'>"+member_error+"</label>");
        }
    }

    //Validation for Employee
    if(has_employee == 1)
    {
        member_id = 'employee_id';
        member_error = 'Select Employee';
        if(!$('#employee_id').val())
        {
            error_count++;
            console.log(error_count,4);
            $('.'+member_id).children().not("div.exclude").not("label").not("span").append("<label id='"+member_id+"_error' class='error span_err'>"+member_error+"</label>");
        }
    }

    //Validation for Account Type
    if(account_type.length == 0)
    {
        error_count++;
        console.log(error_count,5);
        member_id = 'accounttype';
        member_error = 'Select account type';
        $('#'+member_id).children().not("div.exclude").not("label").not("span").append("<label id='"+member_id+"_error' class='error span_err'>"+member_error+"</label>");
    }

    //Validation for Proceed To
    if(!proceedto)
    {
        error_count++;
        console.log(error_count,6);
        member_id = 'proceedto';
        member_error = 'Select proceed To';
        $('.'+member_id).children().not("div.exclude").not("label").not("span").append("<label id='"+member_id+"_error' class='error span_err'>"+member_error+"</label>");
    }

    //Validation for addition of new famliy member
    error_count = checkActiveIndividualMember(error_count);
    console.log(error_count,7);
    //Validation for add new member details are partially filled
    $('.addTab input,.addTab select').each(function () {

        if ($(this).val() != "") {
            error_count++;
            console.log(error_count,8);
            error_count = addIndividualMember(error_count);
            if($(this).attr('id') == 'birthdate')
            {
                error_count = checkDate($(this).attr('id'),$(this).val(),error_count);
            }
        }
    });
    console.log(error_count);
    //Validation for Company
    error_count = checkActiveCompanyDetail(error_count);
    console.log(error_count,9);
    let non_ind_empty = 0;
    $('.addCompanyTab input,.addCompanyTab select').each(function () {
        if ($(this).val() != "") {
            console.log(error_count,10);
            non_ind_empty++;
            if(non_ind == 0 && $(this).val() != null && non_ind_empty == 1)
            error_count = addMoreCompany(error_count);
            if($(this).attr('id') == 'cincorpdate')
            {
                error_count = checkDate($(this).attr('id'),$(this).val(),error_count);
            }
        }
    });

    return error_count;
}

function addIndividualMember(error_count)
{
    let member_id = '';
    let member_error = '';
    if ($("a.nav-link.add-member").hasClass("active")) {

        if($('#name').val() == '')
        {
            error_count++;
            member_id = 'name';
            member_error = 'Enter name';
            $('.'+member_id).children().not("div.exclude").not("label").not("span").append("<label id='"+member_id+"_error' class='error span_err'>"+member_error+"</label>");
        }

        if($('#birthdate').val() == '')
        { console.log('ddd');
            error_count++;
            member_id = 'birthdate';
            member_error = 'Select date of birth';
            $('.'+member_id).children().not("div.exclude").not("label").not("span").append("<label id='"+member_id+"_error' class='error span_err'>"+member_error+"</label>");
        }

        if($('#relation').val() == '')
        {
            error_count++;
            member_id = 'relation';
            member_error = 'Select relationship';
            $('.'+member_id).children().not("div.exclude").not("label").not("span").append("<label id='"+member_id+"_error' class='error span_err'>"+member_error+"</label>");
        }

        if($('#taxstatus').val() == '')
        {
            error_count++;
            member_id = 'taxstatus';
            member_error = 'Select Tax Status';
            $('.'+member_id).children().not("div.exclude").not("label").not("span").append("<label id='"+member_id+"_error' class='error span_err'>"+member_error+"</label>");
        }

        if($('#taxslab').val() == '' || $('#taxslab').val() == null)
        {
            error_count++;
            member_id = 'taxslab';
            member_error = 'Select Tax Slab';
            $('.'+member_id).children().not("div.exclude").not("label").not("span").append("<label id='"+member_id+"_error' class='error span_err'>"+member_error+"</label>");
        }

        if($('#lifeexpectancy').val() == '')
        {
            error_count++;
            member_id = 'lifeexpectancy';
            member_error = 'Enter Life Expectancy';
            $('.'+member_id).children().not("div.exclude").not("label").not("span").append("<label id='"+member_id+"_error' class='error span_err'>"+member_error+"</label>");
        }

    }
    return error_count;
}


function addMoreCompany(error_count)
{
    let company_id = '';
    let company_error = '';
    if ($("a.nav-link.add-company").hasClass("active")) {

        if($('#cname').val() == '')
        {
            error_count++;
            company_id = 'cname';
            company_error = 'Enter name';
            $('.'+company_id).children().not("div.exclude").not("label").not("span").append("<label id='"+company_id+"_error' class='error span_err'>"+company_error+"</label>");
        }

        if($('#cincorpdate').val() == '')
        {
            error_count++;
            company_id = 'cincorpdate';
            company_error = 'Select date';
            $('.'+company_id).children().not("div.exclude").not("label").not("span").append("<label id='"+company_id+"_error' class='error span_err'>"+company_error+"</label>");
        }

        if($('#ctaxstatus').val() == '' || $('#ctaxstatus').val() == null)
        {
            error_count++;
            company_id = 'ctaxstatus';
            company_error = 'Select tax status';
            $('.'+company_id).children().find("div.exclude").not("label").not("span").append("<label id='"+company_id+"_error' class='error span_err'>"+company_error+"</label>");
        }

        if($('#ctaxslab').val() == '' || $('#ctaxslab').val() == null)
        {
            error_count++;
            company_id = 'ctaxslab';
            company_error = 'Select Tax Slab';
            $('.'+company_id).children().not("div.exclude").not("label").not("span").append("<label id='"+company_id+"_error' class='error span_err'>"+company_error+"</label>");
        }

        if($('#cauthname1').val() == '' || $('#cauthname1').val() == null)
        {
            error_count++;
            company_id = 'cauthname1';
            company_error = 'Select name';
            $('.'+company_id).children().not("div.exclude").not("label").not("span").append("<label id='"+company_id+"_error' class='error span_err'>"+company_error+"</label>");
        }
        if($('#cauthdesignation1').val() == '')
        {
            error_count++;
            company_id = 'cauthdesignation1';
            company_error = 'Enter designation';
            $('.'+company_id).children().not("div.exclude").not("label").not("span").append("<label id='"+company_id+"_error' class='error span_err'>"+company_error+"</label>");
        }
        if($('#ctaxstatus').val() == '')
        {
            console.log($('#ctaxstatus').val());
            if($('#cauthname2').val() == '' || $('#cauthname2').val() == null)
            {
                error_count++;
                company_id = 'cauthname2';
                company_error = 'Select name';
                $('.'+company_id).children().not("div.exclude").not("label").not("span").append("<label id='"+company_id+"_error' class='error span_err'>"+company_error+"</label>");
            }

            if($('#cauthdesignation2').val() == '')
            {
                error_count++;
                company_id = 'cauthdesignation2';
                company_error = 'Enter designation';
                $('.'+company_id).children().not("div.exclude").not("label").not("span").append("<label id='"+company_id+"_error' class='error span_err'>"+company_error+"</label>");
            }
        }else{
            singleIndividualCompany = new Array("Sole Proprietorship", "HUF");
            if(!singleIndividualCompany.includes($('#ctaxstatus').val()))
            {
                if($('#cauthname2').val() == '' || $('#cauthname2').val() == null)
                {
                    error_count++;
                    company_id = 'cauthname2';
                    company_error = 'Select name';
                    $('.'+company_id).children().not("div.exclude").not("label").not("span").append("<label id='"+company_id+"_error' class='error span_err'>"+company_error+"</label>");
                }

                if($('#cauthdesignation2').val() == '')
                {
                    error_count++;
                    company_id = 'cauthdesignation2';
                    company_error = 'Enter designation';
                    $('.'+company_id).children().not("div.exclude").not("label").not("span").append("<label id='"+company_id+"_error' class='error span_err'>"+company_error+"</label>");
                }
            }
            // if( $.inArray("HUF", singleIndividualCompany) !== -1 )
            // {
            //     console.log('saa');
            // }
            //$('#ctaxstatus').val() != 'Sole Proprietorship' || $('#ctaxstatus').val() != 'HUF' ||
        }



    }
    return error_count;
}
//accounttype
$('#accounttype input[type=checkbox]').change(function () {
    $val = $(this).val();
    if ($(this).is (':checked'))
    {
        if($val == 'individual'){$("#family_detail").show();}
        if($val == 'nonindividual'){$("#company_detail").show();}
    }else{
        if($val == 'individual'){$("#family_detail").hide();}
        if($val == 'nonindividual'){$("#company_detail").hide();}
    }
    return true;
    // let types = $('#accounttype').children().find('input:checked').map(function(i, e) {return e.value}).toArray();
    // console.log(types);
});
//
function checkActiveIndividualMember(error_count = 0)
{
    if ($("a.nav-link.member_tab").hasClass("active")) {
        let current = $("a.nav-link.member_tab.active").parent();
        let currentCount = parseInt(current.attr('data-count'));

        $('#member'+currentCount+' input,#member'+currentCount+' select').each(function () {
            let member_id = $(this).attr('id');
            let member_error = '';

            if ($(this).val() == "") {

                error_count++;
                if(member_id == 'member-name_'+currentCount)
                member_error = 'Enter name';
                else if(member_id == 'member-birthdate_'+currentCount)
                member_error = 'Select date of birth';
                else if(member_id == 'member-relation_'+currentCount)
                member_error = 'Select relationship';
                else if(member_id == 'member-taxstatus_'+currentCount)
                member_error = 'Select Tax Status';
                else if(member_id == 'member-taxslab_'+currentCount)
                member_error = 'Select Tax Slab';
                else if(member_id == 'member-lifeexpectancy_'+currentCount)
                member_error = 'Enter Life Expectancy';

                $('.'+member_id).children().not("div.exclude").not("label").not("span").append("<label id='"+member_id+"_error' class='error span_err'>"+member_error+"</label>");
            }else{
                if(member_id == 'member-taxstatus_'+currentCount)
                {
                    if($(this).val() == null)
                    {
                        member_error = 'Select Tax Status';
                        $('.'+member_id).children().not("div.exclude").not("label").not("span").append("<label id='"+member_id+"_error' class='error span_err'>"+member_error+"</label>");
                    }
                }
                if(member_id == 'member-lifeexpectancy_'+currentCount)
                {
                    member_error = 'Age should not be 0';
                    if ($(this).val() == 0) {
                        error_count++;
                        $('.'+member_id).children().not("div.exclude").not("label").not("span").append("<label id='"+member_id+"_error' class='error span_err'>"+member_error+"</label>");
                    }
                    member_error = 'Must be less then 150 Yrs';
                    if ($(this).val() > 150) {
                        error_count++;
                        $('.'+member_id).children().not("div.exclude").not("label").not("span").append("<label id='"+member_id+"_error' class='error span_err'>"+member_error+"</label>");
                    }
                }
                if(member_id == 'member-birthdate_'+currentCount)
                {
                    $date = $(this).val();
                    var age = calculateAge($date);
                    if(currentCount == 1 && age < 18)
                    {
                        member_error = 'First User age must be greater then 18 yrs';
                        error_count++;
                        $('.'+member_id).children().not("div.exclude").not("label").not("span").append("<label id='"+member_id+"_error' class='error span_err'>"+member_error+"</label>");

                    }else{
                        var GivenDate = $(this).val();
                        var CurrentDate = new Date();
                        GivenDate = new Date(GivenDate);
                        member_error = 'Date must be less then currrent date';
                        if(GivenDate > CurrentDate){
                            error_count++;
                            $('.'+member_id).children().not("div.exclude").not("label").not("span").append("<label id='"+member_id+"_error' class='error span_err'>"+member_error+"</label>");
                        }
                    }

                }
            }

        });
    }
    return error_count;
}

function checkActiveCompanyDetail(error_count = 0)
{
    if ($("a.nav-link.company_tab").hasClass("active")) {
        let current = $("a.nav-link.company_tab.active").parent();
        let currentCount = parseInt(current.attr('data-count'));

        $('#company'+currentCount+' input,#company'+currentCount+' select').each(function () {
            let company_id = $(this).attr('id');
            let company_error = '';
            if ($(this).val() == "" && ($('#company-ctaxstatus_'+currentCount).val() != 'Sole Proprietorship' || $('#company-ctaxstatus_'+currentCount).val() != 'HUF') && ($(this).attr('id') != 'company-cauthname2_'+currentCount || $(this).attr('id') != 'company-cauthdesignation2_'+currentCount)) {

                error_count++;
                if(company_id == 'company-cname_'+currentCount)
                company_error = 'Enter company name';
                else if(company_id == 'company-cincorpdate_'+currentCount)
                company_error = 'Select date';
                else if(company_id == 'company-ctaxstatus_'+currentCount)
                company_error = 'Select tax status';
                else if(company_id == 'company-ctaxslab_'+currentCount)
                company_error = 'Select tax slab';
                else if(company_id == 'company-cauthname1_'+currentCount)
                company_error = 'Enter name';
                else if(company_id == 'company-cauthdesignation1_'+currentCount)
                company_error = 'Enter designation';
                else if(company_id == 'company-cauthname2_'+currentCount)
                company_error = 'Enter name';
                else if(company_id == 'company-cauthdesignation2_'+currentCount)
                company_error = 'Enter designation';

                $('.'+company_id).children().not("div.exclude").not("label").not("span").append("<label id='"+company_id+"_error' class='error span_err'>"+company_error+"</label>");
            }
            else{
                if(company_id == 'company-cincorpdate_'+currentCount)
                {

                    var GivenDate = $(this).val();
                    var CurrentDate = new Date();
                    GivenDate = new Date(GivenDate);
                    console.log(GivenDate,CurrentDate);
                    company_error = 'Date must be less then currrent date';
                    if(GivenDate > CurrentDate){
                        error_count++;
                        $('.'+company_id).children().not("div.exclude").not("label").not("span").append("<label id='"+company_id+"_error' class='error span_err'>"+company_error+"</label>");
                    }
                }
            }

        });
    }
    return error_count;
}

function checkDate(id,val,error_count)
{
    console.log(id,val,error_count);
    var GivenDate = val;
    var date = GivenDate.substring(0, 2);
    var month = GivenDate.substring(3, 5);
    var year = GivenDate.substring(6, 10);
    var CurrentDate = new Date();
    GivenDate = new Date(year, month - 1, date);
    error = 'Date must be less then currrent date';
    if(GivenDate > CurrentDate){
        error_count++;
        $('.'+id).children().not("div.exclude").not("label").not("span").append("<label id='"+id+"_error' class='error span_err'>"+error+"</label>");
    }
    return error_count;
}

let count = parseInt($('#individual_lead_count').val(), 10) + 1;
let company_count = parseInt($('#company_lead_count').val(), 10) + 1;

        $('form').each(function () {
            $(this).validate();
        });
        $('.add-member').click(function () {
            let error_count = 0;
            $('#family_detail .error').removeClass('error');
            $('#family_detail .err').removeClass('err');
            $('#family_detail .span_err').remove();
            error_count = checkActiveIndividualMember(error_count);
            console.log(error_count);
            if(error_count > 0)
            {
                return false;
            }
            let allData = false;
            let data = {};
            $('.addTab input,.addTab select').each(function () {


                if ($(this).val() == "") {
                    error_count = addIndividualMember(error_count);
                    allData = false;
                    return false;
                } else {

                    if($(this).attr('id') == 'birthdate')
                    {
                        error_count = checkDate($(this).attr('id'),$(this).val(),error_count);
                    }
                    if(error_count == 0)
                    {
                        allData = true;
                        data[$(this).attr('id') + count] = $(this).val();
                    }else{
                        allData = false;
                        return false;
                    }
                    // allData = true;
                    // data[$(this).attr('id') + count] = $(this).val();
                }
            });

            if (allData) {
                data['member_count'] = count;
                data['family_detail'] = 1;
                $.get("/client/introduction", data, function(output, status){
                    $(output[1]).insertBefore('.add-member-item');
                    $("#family-tab").prepend(output[0]);

                    $('.addTab input,.addTab select').each(function () {
                        $(this).val("");
                    });
                    $("#taxstatus").val('').trigger('change');
                    $("#taxslab").val('').trigger('change');
                    $("#relation").val('').trigger('change');
                    $('#member-taxstatus_' + count).select2().trigger('change');
                    $('#member-taxslab_' + count).select2().trigger('change');
                    $('#member-relation_' + count).select2().trigger('change');

                    count = count + 1;
                    input();
                    setTimeout(() => {
                        $('select').select2({
                            width: '100%'
                        });
                        $('.birth_date, .incorpdate').datepicker({
                            autoclose: true,
                            format: "dd-mm-yyyy"
                        });

                    }, 500);
                });

            }
        });

        $('.add-company').click(function () {
            let error_count = 0;
            $('#company_detail .error').removeClass('error');
            $('#company_detail .err').removeClass('err');
            $('#company_detail .span_err').remove();

            error_count = checkActiveCompanyDetail(error_count);
            if(error_count > 0)
            {
                return false;
            }
            let allCompanyData = false;
            let data = {};
            $('.addCompanyTab input,.addCompanyTab select').each(function () {
                console.log($('#ctaxstatus').val());
                // && ($('#ctaxstatus').val() != 'Sole Proprietorship' || $('#ctaxstatus').val() != 'HUF') && ($(this).attr('id') != 'cauthname1' || $(this).attr('id') != 'cauthdesignation1')
                singleIndividualCompany = new Array("Sole Proprietorship", "HUF");
                singleauthmember = new Array("cauthname2", "cauthdesignation2");
                console.log($(this).val(),$('#ctaxstatus').val(),$(this).attr('id'));
                // && ($(this).attr('id') != 'cauthname2' || $(this).attr('id') != 'cauthdesignation2')
                if (($(this).val() == "" || $(this).val() == null) && !singleIndividualCompany.includes($('#ctaxstatus').val())) {

                    error_count = addMoreCompany(error_count);
                    console.log(error_count);
                    allCompanyData = false;
                    return false;
                }else if(($(this).val() == "" || $(this).val() == null) && singleIndividualCompany.includes($('#ctaxstatus').val())){
                    error_count = addMoreCompany(error_count);
                    if(error_count == 0)
                    {
                        allCompanyData = true;
                        data[$(this).attr('id') + company_count] = $(this).val();
                    }else{
                        allCompanyData = false;
                        return false;
                    }
                }
                else {
                    console.log('out');
                    if($(this).attr('id') == 'cincorpdate')
                    { console.log('sdjsjd');
                        error_count = checkDate($(this).attr('id'),$(this).val(),error_count);
                        console.log(error_count);
                    }
                    if(error_count == 0)
                    {
                        allCompanyData = true;
                        data[$(this).attr('id') + company_count] = $(this).val();
                    }else{
                        allCompanyData = false;
                        return false;
                    }

                }
            });
            console.log(allCompanyData);

            if (allCompanyData)
            {
                data['company_count'] = company_count;
                data['company_detail'] = 1;
                $.get("/client/introduction", data, function(output, status){
                    $(output[1]).insertBefore('.add-company-item');
                    $("#company-tab").prepend(output[0]);
                    // $('#company-taxslab_' + company_count).val(data['ctaxslab' + company_count]);
                    // $('#company-entitytype_' + company_count).val(data['ctaxstatus' + company_count]);
                    company_count = company_count + 1;
                    $('.addCompanyTab input,.addCompanyTab select').each(function () {
                        $(this).val("");
                    });
                    $("#ctaxslab").val('').trigger('change');
                    $("#ctaxstatus").val('').trigger('change');
                    $('#company-ctaxstatus_' + count).select2().trigger('change');
                    $('#company-ctaxslab_' + count).select2().trigger('change');
                    input();
                    setTimeout(() => {
                        // $(this).hide();

                        $('select').select2({
                            width: '100%'
                        });
                        $('.birth_date, incorpdate').datepicker({
                            autoclose: true,
                            format: "dd-mm-yyyy"
                        });

                    }, 500);
                });
            }



        });

        // var table = $('table').DataTable({
        //     bInfo: false,
        //     sDom: 'lrtip',
        //     bLengthChange: false,
        //     retrieve: true,
        //     autoWidth: false,
        // });
        $('.incorpdate , .birth_date').datepicker({
            autoclose: true,
            format: "dd-mm-yyyy"
        });

        $(document).on('blur',"input.member_lifeexpectancy", function() {
            $(".add-member").trigger('click');
        });

        // $(document).on('blur',"#addcompany input, #addcompany select", function() {
        //     $('.addCompanyTab input,.addCompanyTab select').each(function () {
        //         if ($(this).val() != "") {
        //             console.log('sdsd');
        //         }
        //     });
        // });
        $(document).on('change',"#ctaxstatus", function(e){
            let id = e.target.id;
            let auth2 = 'cauthname2';
            let authdesign2 = 'cauthdesignation2';
            if(e.target.value == 'Sole Proprietorship' || e.target.value == 'HUF')
            {
                if(id.startsWith("company-"))
                {
                    auth2 = id.replace("ctaxstatus", "cauthname2");
                    authdesign2 = id.replace("ctaxstatus", "cauthdesignation2");
                }
                $('#'+auth2).val('').trigger('change');
                $('#'+authdesign2).val('');
                $('.'+auth2).hide()
                $('.'+authdesign2).hide();
                //console.log(authdesign2);
            }else{
                $('.'+auth2).show()
                $('.'+authdesign2).show();
                var member_count = $('.member-profileid').length;
                console.log(member_count);
                if(member_count < 2)
                {
                    $('.addCompanyTab input,.addCompanyTab select').each(function () {
                        $(this).val("");
                    });
                    $("#company_detail").hide();
                    $('#nonindividual').prop('checked', false);
                    let member_id = 'accounttype';
                    let member_error = 'Must required 2 Individual member';
                    $('#'+member_id).children().not("div.exclude").not("label").not("span").append("<label id='"+member_id+"_error' class='error span_err'><b>Note :: </b>"+member_error+"</label>");
                }
                // if(member_count < 3)
                // {
                //     console.log('shashi');
                //     $("#cname").val('');
                //     $("cincorpdate").val('');
                //     $("cauthdesignation1").val('');
                //     $("cauthdesignation2").val('');

                //     $("#ctaxslab").val('').trigger('change');
                //     $("#ctaxstatus").val('').trigger('change');
                //     $("#cauthname1").val('').trigger('change');
                //     $("#cauthname2").val('').trigger('change');
                //     // $("#company_detail").hide();
                //     // $('#nonindividual').attr('checked', true); // Checks it
                //     //$('#myCheckbox').attr('checked', false); // Unchecks it
                // }

                console.log(member_count);
            }
        });

        $(document).on('change',".birth_date", function(e){
            let id = e.target.id;

            let tax_status_id = id.replace("birthdate", "taxstatus");

            if(e.target.value)
            {
                $date = e.target.value;
                var age = calculateAge($date);
                console.log(age);
                if(age >= 18){
                    $('#'+tax_status_id).val("").trigger('change');
                    $('#'+tax_status_id).children('option').prop('disabled', true);
                    $('#'+tax_status_id).children('option[value=""],option[value="Individual"],option[value="NRI"]').prop('disabled',false);
                }else{
                    $('#'+tax_status_id).val("").trigger('change');
                    $('#'+tax_status_id).children('option').prop('disabled', true);
                    $('#'+tax_status_id).children('option[value=""],option[value="On behalf of minor"],option[value="NRI - Minor"]').prop('disabled',false);
                }
            }
        });

        $(document).on('blur',"input.cauthdesignation", function() {
            $(".add-company").trigger('click');
        });

        $("#lifeexpectancy").blur(function () {
            $(".add-member").trigger('click');
        });
        $("#cauthdesignation1").blur(function () {
            if($('#ctaxstatus').val() == 'Sole Proprietorship' || $('#ctaxstatus').val() == 'HUF')
            {
                $(".add-company").trigger('click');
            }

        });
        $("#cauthdesignation2").blur(function () {
            $(".add-company").trigger('click');
        });

        function input() {
            $(".member-name").blur(function () {
                let targerid = $(this).data('target');
                $('#' + targerid + '-tab').html($(this).val());
            });
            $('#introduction .remove-member').click(function () {
                let count = $(this).parent().data('count');

                $('#member' + count).remove();
                $('#member-tab_' + count).parent().remove();
                $('#add').tab('show')
            });
            $('#introduction .remove-company').click(function () {
                let count = $(this).parent().data('count');

                $('#company' + count).remove();
                $('#company-tab_' + count).parent().remove();
                $('#addcompany').tab('show')
            });
            // $('input[name="date"]').daterangepicker({
            //     singleDatePicker: true,
            // });
            $('.incorpdate, .birth_date').datepicker({
                autoclose: true,
                format: "dd-mm-yyyy"
            });
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

        //ctaxstatus
        $(document).on('change',"#cauthname1", function(e) {
            let value = e.target.value;
            let tax_val = $('#ctaxstatus').val();
            if(tax_val != 'HUF' || tax_val != 'Sole Proprietorship')
            {
                $('#cauthname2').children('option').prop('disabled', false);
                $('#cauthname2').children('option[value="'+value+'"]').prop('disabled',true);
            }
        });

        // $(document).on('change',"#cauthname2", function(e) {
        //     let value = e.target.value;
        //     $('#cauthname2').children('option').prop('disabled', false);
        //     $('#cauthname2').children('option[value="'+value+'"]').prop('disabled',true);
        // });

        $(".edit-now").on("click", function(e) {
            let value = $(this).parent().closest('section.trial').attr('id');
            console.log(value);
            $('input[name=step_edit]').val(1);
            $(".add-member-item,.add-company-item").removeClass('readonly');
            $.each($('#'+value+' input, #'+value+' select'),function(){
                console.log($(this).attr('id'));
                // if ($(this).prop('readonly',true)) {
                //     $(this).prop('readonly',false);
                // }else{
                //     console.log($(this).attr('id'));
                // }
                //proceedto
                //employee_id
                //associate_id
                // if($.inArray( $(this).attr('id'), [ "associate_id", "employee_id", "proceedto"] ))
                // {
                if($(this).attr('id') != 'associate_id')
                {
                    console.log($(this).attr('id'));
                    $(this).attr('readonly', false);
                }

                // }


            });

        });
