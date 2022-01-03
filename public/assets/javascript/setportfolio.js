$(window).on('load', function () {
    //let height = $('.step-forms .active').height();
    //$('.step-forms').css('height', height + 'px');
    $('.date').datepicker({
        autoclose: true,
        format: "dd-mm-yyyy"
    });
});

// $('#scheme_code_equity_swp_nri').on('select2:closing', function( event ) {
//     // var $searchfield = $(this).parent().find('.select2-search__field');
//     // $searchfield.prop('disabled', true);
// });



$('#scheme_code_equity_swp_nri').on('select2:closing', function( event ) {

    let type = 'equity';
    let count = $('#admin-equity tbody tr').length;
    let error_count = 0;
    let sce   = $("#scheme_code_equity").val();
    // let acerr = parseInt ($("#amc_code_equity_regular_residence").val(), 10);
    // let scern = parseInt ($("#scheme_code_equity_regular_nri").val(), 10);
    // let acesr = parseInt ($("#amc_code_equity_swp_residence").val(), 10);
    // let scesn = parseInt ($("#scheme_code_equity_swp_nri").val(), 10);
    console.log(type);
    if(sce == null || sce == '')
    {
        error_count++;
    }

    if(error_count > 0)
    {
        return true;
    }
    let allData = false;
    let data = {};
    $('.default_scheme_equity input,.default_scheme_equity select').each(function () {
        console.log($(this).val());
        if ($(this).val() == "" && $(this).val() == "0") {
            allData = false;
            return false;
        } else {
            allData = true;
            data[$(this).attr('id') +'_'+ count] = $(this).val();
        }
    });
    console.log(allData);
    console.log(data);
    if (allData) {
        data['count'] = count;
        data['type'] = type;
        $.get("/admin/modelportfolio/setportfolio/create", data, function(output, status){
           // .find('tr:last').prev().after('<tr><td>&nbsp;</td><td><input type="text" name="item[]" value=""></td></tr>');
            $(".default_scheme_equity").before(output);
            count = count+1;
            setTotalEquity(type);
            checkEquity();
            $("#scheme_code_"+type+"_swp_priority").prop('checked', false);

            setTimeout(() => {
                $('select').select2({
                    width: '100%',
                    //dropdownAutoWidth : true,
                });
            }, 100);
        });
    }
});

function setTotalEquity($type)
{
    let acerr = parseInt (0, 10);
    let scern = parseInt (0, 10);
    let acesr = parseInt (0, 10);
    let scesn = parseInt (0, 10);

    $('select').each(function(){
        let id = $(this).attr('id');

        if(id.startsWith("amc_code_equity_regular_residence_"))
        {
            acerr = acerr + parseInt($(this).val());
        }
        if(id.startsWith("scheme_code_equity_regular_nri_"))
        {
            scern = scern + parseInt($(this).val());
        }
        if(id.startsWith("amc_code_equity_swp_residence_"))
        {
            acesr = acesr + parseInt($(this).val());
        }
        if(id.startsWith("scheme_code_equity_swp_nri_"))
        {
            scesn = scesn + parseInt($(this).val());
        }


    });
    if(acerr < 100){acerr = ('0' + acerr).slice(-2)}
    if(scern < 100){scern = ('0' + scern).slice(-2)}
    if(acesr < 100){acesr = ('0' + acesr).slice(-2)}
    if(scesn < 100){scesn = ('0' + scesn).slice(-2)}
    $("#scheme_code_equity_regular_residence_total").val(acerr);
    $("#scheme_code_equity_regular_nri_total").val(scern);
    $("#amc_code_equity_swp_residence_total").val(acesr);
    $("#scheme_code_equity_swp_nri_total").val(scesn);
}

function checkEquity()
{
    let acerr = parseInt ($("#scheme_code_equity_regular_residence_total").val(), 10);
    let scern = parseInt ($("#scheme_code_equity_regular_nri_total").val(), 10);
    let acesr = parseInt ($("#amc_code_equity_swp_residence_total").val(), 10);
    let scesn = parseInt ($("#scheme_code_equity_swp_nri_total").val(), 10);
    let percentage_acerr = 100;
    let percentage_scern = 100;
    let percentage_acesr = 100;
    let percentage_scesn = 100;

    if(acerr == 100)
    {
        $("#amc_code_equity_regular_residence").attr('readonly',true);
        $("#amc_code_equity_regular_residence").val('0').trigger('change');
    }else{
        percentage_acerr = percentage_acerr - parseInt(acerr);
        $("#amc_code_equity_regular_residence").children('option').prop('disabled', false);
        $("#amc_code_equity_regular_residence").val(percentage_acerr).trigger('change');
        var i;
        percentage_acerr = percentage_acerr+1;
        for (i = percentage_acerr; i <= 100; i++) {
            $("#amc_code_equity_regular_residence").children('option[value="'+i+'"]').prop('disabled',true);
        }
    }
    if(scern == 100)
    {
        $("#scheme_code_equity_regular_nri").attr('readonly',true);
        $("#scheme_code_equity_regular_nri").val('0').trigger('change');
    }else{
        percentage_scern = percentage_scern - parseInt(scern);
        $("#scheme_code_equity_regular_nri").children('option').prop('disabled', false);
        $("#scheme_code_equity_regular_nri").val(percentage_scern).trigger('change');
        var i;
        percentage_scern = percentage_scern+1;
        for (i = percentage_scern; i <= 100; i++) {
            $("#scheme_code_equity_regular_nri").children('option[value="'+i+'"]').prop('disabled',true);
        }
    }
    if(acesr == 100)
    {
        $("#amc_code_equity_swp_residence").attr('readonly',true);
        $("#amc_code_equity_swp_residence").val('0').trigger('change');
    }else{
        percentage_acesr = percentage_acesr - parseInt(acesr);
        $("#amc_code_equity_swp_residence").children('option').prop('disabled', false);
        $("#amc_code_equity_swp_residence").val(percentage_acesr).trigger('change');
        var i;
        percentage_acesr = percentage_acesr+1;
        for (i = percentage_acesr; i <= 100; i++) {
            $("#amc_code_equity_swp_residence").children('option[value="'+i+'"]').prop('disabled',true);
        }
    }
    if(scesn == 100)
    {
        //$("#scheme_code_equity_swp_nri").attr('readonly',true);
        $("#scheme_code_equity_swp_nri").val('0').trigger('change');
    }else{
        percentage_scesn = percentage_scesn - parseInt(scesn);
        $("#scheme_code_equity_swp_nri").children('option').prop('disabled', false);
        $("#scheme_code_equity_swp_nri").val(percentage_scesn).trigger('change');
        var i;
        percentage_scesn = percentage_scesn+1;
        for (i = percentage_scesn; i <= 100; i++) {
            $("#scheme_code_equity_swp_nri").children('option[value="'+i+'"]').prop('disabled',true);
        }
    }

    if(acerr == 100 && scern == 100 && acesr == 100 && scesn == 100)
    {
        $("#scheme_code_equity").val('').trigger('change');
        $("#scheme_code_equity").attr('readonly',true);
        $(".default_scheme_equity").hide();
    }else{
        $("#scheme_code_equity").val('').trigger('change');
    }

}

// $(document).on('change',"#amc_code_equity_regular_residence", function() {
//     let val = $(this).val();
//     console.log(val);
// });

// $(document).on('change',"#scheme_code_equity_regular_nri", function() {
//     let val = $(this).val();
//     console.log(val);
// });

// $(document).on('change',"#amc_code_equity_swp_residence", function() {
//     let val = $(this).val();
//     console.log(val);
// });

// $(document).on('change',"#scheme_code_equity_swp_nri", function() {
//     let val = $(this).val();
//     console.log(val);
// });

/***************************************************************/
/**************** DEBT *****************************************/
/***************************************************************/
$('#scheme_code_debt_swp_nri').on('select2:closing', function( event ) {

    let type = 'debt';
    let count = $('#admin-debt tbody tr').length;

    let error_count = 0;
    // $('#family_detail .error').removeClass('error');
    // $('#family_detail .err').removeClass('err');
    // $('#family_detail .span_err').remove();
    let sce   = $("#scheme_code_debt").val();


    if(sce == null || sce == '')
    {
        error_count++;
    }

    if(error_count > 0)
    {
        return true;
    }

    let allData = false;
    let data = {};
    $('.default_scheme_debt input,.default_scheme_debt select').each(function () {
        //console.log($(this).val());
        if ($(this).val() == "" && $(this).val() == "0") {
            allData = false;
            return false;
        } else {
            allData = true;
            data[$(this).attr('id') +'_'+ count] = $(this).val();
        }
    });
    // console.log(allData);
    // console.log(data);
    if (allData) {
        data['count'] = count;
        data['type'] = type;
        $.get("/admin/modelportfolio/setportfolio/create", data, function(output, status){
           // .find('tr:last').prev().after('<tr><td>&nbsp;</td><td><input type="text" name="item[]" value=""></td></tr>');
            $(".default_scheme_debt").before(output);
            count = count+1;
            setTotalDebt(type);
            checkDebt();
            $("#scheme_code_"+type+"_swp_priority").prop('checked', false);
            setTimeout(() => {
                $('select').select2({
                    width: '100%'
                });

            }, 100);
        });
    }
});

function setTotalDebt($type)
{
    let acerr = parseInt (0, 10);
    let scern = parseInt (0, 10);
    let acesr = parseInt (0, 10);
    let scesn = parseInt (0, 10);

    $('select').each(function(){
        let id = $(this).attr('id');

        if(id.startsWith("amc_code_debt_regular_residence_"))
        {
            acerr = acerr + parseInt($(this).val());
        }
        if(id.startsWith("scheme_code_debt_regular_nri_"))
        {
            scern = scern + parseInt($(this).val());
        }
        if(id.startsWith("amc_code_debt_swp_residence_"))
        {
            acesr = acesr + parseInt($(this).val());
        }
        if(id.startsWith("scheme_code_debt_swp_nri_"))
        {
            scesn = scesn + parseInt($(this).val());
        }


    });
    if(acerr < 100){acerr = ('0' + acerr).slice(-2)}
    if(scern < 100){scern = ('0' + scern).slice(-2)}
    if(acesr < 100){acesr = ('0' + acesr).slice(-2)}
    if(scesn < 100){scesn = ('0' + scesn).slice(-2)}
    $("#scheme_code_debt_regular_residence_total").val(acerr);
    $("#scheme_code_debt_regular_nri_total").val(scern);
    $("#amc_code_debt_swp_residence_total").val(acesr);
    $("#scheme_code_debt_swp_nri_total").val(scesn);
}

function checkDebt()
{
    let acdrr = parseInt ($("#scheme_code_debt_regular_residence_total").val(), 10);
    let scdrn = parseInt ($("#scheme_code_debt_regular_nri_total").val(), 10);
    let acdsr = parseInt ($("#amc_code_debt_swp_residence_total").val(), 10);
    let scdsn = parseInt ($("#scheme_code_debt_swp_nri_total").val(), 10);
    let percentage_acdrr = 100;
    let percentage_scdrn = 100;
    let percentage_acdsr = 100;
    let percentage_scdsn = 100;

    if(acdrr == 100)
    {
        $("#amc_code_debt_regular_residence").attr('readonly',true);
        $("#amc_code_debt_regular_residence").val('0').trigger('change');
    }else{
        percentage_acdrr = percentage_acdrr - parseInt(acdrr);
        $("#amc_code_debt_regular_residence").children('option').prop('disabled', false);
        $("#amc_code_debt_regular_residence").val(percentage_acdrr).trigger('change');
        var i;
        percentage_acdrr = percentage_acdrr+1;
        for (i = percentage_acdrr; i <= 100; i++) {
            $("#amc_code_debt_regular_residence").children('option[value="'+i+'"]').prop('disabled',true);
        }
    }
    if(scdrn == 100)
    {
        $("#scheme_code_debt_regular_nri").attr('readonly',true);
        $("#scheme_code_debt_regular_nri").val('0').trigger('change');
    }else{
        percentage_scdrn = percentage_scdrn - parseInt(scdrn);
        $("#scheme_code_debt_regular_nri").children('option').prop('disabled', false);
        $("#scheme_code_debt_regular_nri").val(percentage_scdrn).trigger('change');
        var i;
        percentage_scdrn = percentage_scdrn+1;
        for (i = percentage_scdrn; i <= 100; i++) {
            $("#scheme_code_debt_regular_nri").children('option[value="'+i+'"]').prop('disabled',true);
        }
    }
    if(acdsr == 100)
    {
        $("#amc_code_debt_swp_residence").attr('readonly',true);
        $("#amc_code_debt_swp_residence").val('0').trigger('change');
    }else{
        percentage_acdsr = percentage_acdsr - parseInt(acdsr);
        $("#amc_code_debt_swp_residence").children('option').prop('disabled', false);
        $("#amc_code_debt_swp_residence").val(percentage_acdsr).trigger('change');
        var i;
        percentage_acdsr = percentage_acdsr+1;
        for (i = percentage_acdsr; i <= 100; i++) {
            $("#amc_code_debt_swp_residence").children('option[value="'+i+'"]').prop('disabled',true);
        }
    }
    if(scdsn == 100)
    {
        //$("#scheme_code_debt_swp_nri").attr('readonly',true);
        $("#scheme_code_debt_swp_nri").val('0').trigger('change');
    }else{
        percentage_scdsn = percentage_scdsn - parseInt(scdsn);
        $("#scheme_code_debt_swp_nri").children('option').prop('disabled', false);
        $("#scheme_code_debt_swp_nri").val(percentage_scdsn).trigger('change');
        var i;
        percentage_scdsn = percentage_scdsn+1;
        for (i = percentage_scdsn; i <= 100; i++) {
            $("#scheme_code_debt_swp_nri").children('option[value="'+i+'"]').prop('disabled',true);
        }
    }

    if(acdrr == 100 && scdrn == 100 && acdsr == 100 && scdsn == 100)
    {
        $("#scheme_code_debt").val('').trigger('change');
        $("#scheme_code_debt").attr('readonly',true);
        $(".default_scheme_debt").hide();
    }else{
        $("#scheme_code_debt").val('').trigger('change');
    }

}

$('#scheme_code_shortterm_regular_nri').on('select2:closing', function( event ) {

    let type = 'shortterm';
    let count = $('#admin-shortterm tbody tr').length;

    let error_count = 0;
    let sce   = $("#scheme_code_shortterm").val();


    if(sce == null || sce == '')
    {
        error_count++;
    }

    if(error_count > 0)
    {
        return true;
    }
    let allData = false;
    let data = {};
    $('.default_scheme_shortterm input,.default_scheme_shortterm select').each(function () {
        //console.log($(this).val());
        if ($(this).val() == "" && $(this).val() == "0") {
            allData = false;
            return false;
        } else {
            allData = true;
            data[$(this).attr('id') +'_'+ count] = $(this).val();
        }
    });
    // console.log(allData);
    // console.log(data);
    if (allData) {
        data['count'] = count;
        data['type'] = type;
        $.get("/admin/modelportfolio/setportfolio/create", data, function(output, status){
           // .find('tr:last').prev().after('<tr><td>&nbsp;</td><td><input type="text" name="item[]" value=""></td></tr>');
            $(".default_scheme_shortterm").before(output);
            count = count+1;
            $("#scheme_code_shortterm").val('').trigger('change');
            $(".default_scheme_shortterm").hide();
            $("#amc_code_shortterm_regular_residence").val('').trigger('change');
            $("#scheme_code_shortterm_regular_nri").val('').trigger('change');

            // setTotalDebt(type);
            // checkDebt();
            setTimeout(() => {
                $('select').select2({
                    width: '100%'
                });

            }, 100);
        });
    }
});

$('#scheme_code_tax_regular_nri').on('select2:closing', function( event ) {

    let type = 'tax';
    let count = $('#admin-tax tbody tr').length;

    let error_count = 0;
    let sce   = $("#scheme_code_tax").val();


    if(sce == null || sce == '')
    {
        error_count++;
    }

    if(error_count > 0)
    {
        return true;
    }
    let allData = false;
    let data = {};
    $('.default_scheme_tax input,.default_scheme_tax select').each(function () {
        //console.log($(this).val());
        if ($(this).val() == "" && $(this).val() == "0") {
            allData = false;
            return false;
        } else {
            allData = true;
            data[$(this).attr('id') +'_'+ count] = $(this).val();
        }
    });
    // console.log(allData);
    // console.log(data);
    if (allData) {
        data['count'] = count;
        data['type'] = type;
        $.get("/admin/modelportfolio/setportfolio/create", data, function(output, status){
           // .find('tr:last').prev().after('<tr><td>&nbsp;</td><td><input type="text" name="item[]" value=""></td></tr>');
            $(".default_scheme_tax").before(output);
            count = count+1;
            $("#scheme_code_tax").val('').trigger('change');
            $(".default_scheme_tax").hide();
            $("#amc_code_tax_regular_residence").val('').trigger('change');
            $("#scheme_code_tax_regular_nri").val('').trigger('change');

            // setTotalDebt(type);
            // checkDebt();
            setTimeout(() => {
                $('select').select2({
                    width: '100%'
                });

            }, 100);
        });
    }
});

$('#scheme_code_gold_regular_nri').on('select2:closing', function( event ) {

    let type = 'gold';
    let count = $('#admin-gold tbody tr').length;

    let error_count = 0;
    let sce   = $("#scheme_code_gold").val();


    if(sce == null || sce == '')
    {
        error_count++;
    }

    if(error_count > 0)
    {
        return true;
    }
    let allData = false;
    let data = {};
    $('.default_scheme_gold input,.default_scheme_gold select').each(function () {
        //console.log($(this).val());
        if ($(this).val() == "" && $(this).val() == "0") {
            allData = false;
            return false;
        } else {
            allData = true;
            data[$(this).attr('id') +'_'+ count] = $(this).val();
        }
    });
    // console.log(allData);
    // console.log(data);
    if (allData) {
        data['count'] = count;
        data['type'] = type;
        $.get("/admin/modelportfolio/setportfolio/create", data, function(output, status){
           // .find('tr:last').prev().after('<tr><td>&nbsp;</td><td><input type="text" name="item[]" value=""></td></tr>');
            $(".default_scheme_gold").before(output);
            count = count+1;
            $("#scheme_code_gold").val('').trigger('change');
            $(".default_scheme_gold").hide();
            $("#amc_code_gold_regular_residence").val('').trigger('change');
            $("#scheme_code_gold_regular_nri").val('').trigger('change');

            // setTotalDebt(type);
            // checkDebt();
            setTimeout(() => {
                $('select').select2({
                    width: '100%'
                });

            }, 100);
        });
    }
});

$(document).on('click', '#add_new_data_shortterm', function (e) {
    $(".default_scheme_shortterm").show();
});

$(document).on('click', '#add_new_data_tax', function (e) {
    $(".default_scheme_tax").show();
});

$(document).on('click', '#add_new_data_gold', function (e) {
    $(".default_scheme_gold").show();
});
$('#successModal').on('hidden.bs.modal', function (e) {
    location.reload();
  })
$( "form#add-update-data" ).submit(function( event ) {
    event.preventDefault();
    let post = $(this).attr('method');
    let url = $(this).attr('action');
    let formData = new FormData($(this)[0]);

    $.ajax({
        type: post,
        url: url,
        data: formData,
        beforeSend: function() {
            $('#loading').show();
        },
        success:function(data) {
            $('#loading').hide();
            $('#successModal').modal('show');
            //console.log(data);
            //return false;
            // if(data.id)
            // $('input[name="associate_id"]').val(data.id);
            //Main Data

            //nextSteper(current,isAccount,data.id);

        },
        error: function(xhr, textStatus, thrownError)
        {
            console.log('reach');
            $('#loading').hide();
            //console.log(xhr);
            let response = jQuery.parseJSON(xhr.responseText);
            console.log(response.length);

            let error_data = '<ul class="alerts-lists">';
            //console.log(response.server_errors);
            if (response.length === undefined || response.length === null) {
                $.each( response.errors, function( k, v ) {
                    error_data += '<li>'+v+'</li>';
                });
            }

            error_data += '</ul>';
            console.log(error_data);
            //return false;
            $("#error_modal .card .card-body").html(error_data);
            $('#error_modal').modal('show');
        },
        cache: false,
        contentType: false,
        processData: false,
        //timeout: 8000,
    });
});

// $('#selected_date').on('change', function(e){
//     console.log(e.target.value());
//     //$(this).closest('form').submit();
// });
