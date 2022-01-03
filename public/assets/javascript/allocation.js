$(document).ready(function() {
    $(".amount").trigger('keyup');
    calculate_pending_amount_tax();
    calculate_pending_amount_shortterm();
    calculate_pending_amount_gold();
    calculate_pending_amount_tax_sip();
    calculate_pending_amount_shortterm_sip();
    calculate_pending_amount_gold_sip();
    check_active_tab();
    let total_swp_count = get_swp_count(0);
    console.log(total_swp_count);
    // if(total_swp_count >= 60)
    // {
    //     $(".swp_view_logic").removeClass('disabled');
    // }else{
    //     $(".swp_view_logic").addClass('disabled');
    // }
    if(total_swp_count > 0)
    {
        $(".swp_view_logic").removeClass('disabled');
    }
    // $('input.scheme_start_date').datepicker({
    //     autoclose: true,
    //     format: "dd-mm-yyyy"
    // });
    $('[data-toggle="tooltip"]').tooltip();
    $('.scheme_custom_date_equity').datepicker({
        autoclose: true,
        format: "dd-mm-yyyy"
    });
    $('.scheme_custom_date_sip').datepicker({
        autoclose: true,
        format: "dd-mm-yyyy"
    });
});


function calculate_pending_amount_tax()
{
    let pending_amount = $("#tax_pending_amount").val();

    if(pending_amount)
    {
        pending_amount = pending_amount.replace(/,/g, "");
        pending_amount = parseInt(pending_amount);
    }
    console.log(pending_amount);
    let total_amount = 0;
    $("#tax_portfolio_details input.scheme_amount_tax").each(function(i){
        let ival = $(this).val();
        ival = ival.replace(/,/g, "");
        ival = parseInt(ival);
        total_amount = total_amount + ival;
    });
    console.log(total_amount,pending_amount);
    pending_amount = pending_amount - total_amount;
    pending_amount = currency(pending_amount);
    $("#tax_pending_amount").val(pending_amount);
}

function calculate_pending_amount_tax_sip()
{
    let pending_amount = $("#tax-sip_portfolio_details").val();
    console.log(pending_amount);
    if(pending_amount)
    {
        pending_amount = pending_amount.replace(/,/g, "");
        pending_amount = parseInt(pending_amount);
    }

    let total_amount = 0;
    $("#tax-sip_portfolio_details input.scheme_amount_tax").each(function(i){
        let ival = $(this).val();
        ival = ival.replace(/,/g, "");
        ival = parseInt(ival);
        total_amount = total_amount + ival;
    });
    console.log(total_amount,pending_amount);
    pending_amount = pending_amount - total_amount;
    pending_amount = currency(pending_amount);
    $("#tax-sip_pending_amount").val(pending_amount);
}

function calculate_pending_amount_shortterm()
{
    let pending_amount = $("#shortterm_pending_amount").val();
    if(pending_amount)
    {
        pending_amount = pending_amount.replace(/,/g, "");
    pending_amount = parseInt(pending_amount);
    }

    let total_amount = 0;
    $("#shortterm_portfolio_details input.scheme_amount_shortterm").each(function(i){
        let ival = $(this).val();
        ival = ival.replace(/,/g, "");
        ival = parseInt(ival);
        total_amount = total_amount + ival;
    });
    console.log(total_amount,pending_amount);
    pending_amount = pending_amount - total_amount;
    pending_amount = currency(pending_amount);
    $("#shortterm_pending_amount").val(pending_amount);
}

function calculate_pending_amount_shortterm_sip()
{
    let pending_amount = $("#shortterm-sip_pending_amount").val();
    if(pending_amount)
    {
        pending_amount = pending_amount.replace(/,/g, "");
    pending_amount = parseInt(pending_amount);
    }

    let total_amount = 0;
    $("#shortterm-sip_portfolio_details input.scheme_amount_shortterm").each(function(i){
        let ival = $(this).val();
        ival = ival.replace(/,/g, "");
        ival = parseInt(ival);
        total_amount = total_amount + ival;
    });
    console.log(total_amount,pending_amount);
    pending_amount = pending_amount - total_amount;
    pending_amount = currency(pending_amount);
    $("#shortterm-sip_pending_amount").val(pending_amount);
}

function calculate_pending_amount_gold()
{
    let pending_amount = $("#gold_pending_amount").val();
    if(pending_amount)
    {
        pending_amount = pending_amount.replace(/,/g, "");
        pending_amount = parseInt(pending_amount);
    }

    let total_amount = 0;
    $("#gold_portfolio_details input.scheme_amount_gold").each(function(i){
        let ival = $(this).val();
        ival = ival.replace(/,/g, "");
        ival = parseInt(ival);
        total_amount = total_amount + ival;
    });
    console.log(total_amount,pending_amount);
    pending_amount = pending_amount - total_amount;
    pending_amount = currency(pending_amount);
    $("#gold_pending_amount").val(pending_amount);
}

function calculate_pending_amount_gold_sip()
{
    let pending_amount = $("#gold-sip_pending_amount").val();
    if(pending_amount)
    {
        pending_amount = pending_amount.replace(/,/g, "");
        pending_amount = parseInt(pending_amount);
    }

    let total_amount = 0;
    $("#gold-sip_portfolio_details input.scheme_amount_gold").each(function(i){
        let ival = $(this).val();
        ival = ival.replace(/,/g, "");
        ival = parseInt(ival);
        total_amount = total_amount + ival;
    });
    console.log(total_amount,pending_amount);
    pending_amount = pending_amount - total_amount;
    pending_amount = currency(pending_amount);
    $("#gold-sip_pending_amount").val(pending_amount);
}

function view_step_modal($target)
{
    if($target == 1)
    {
        $(".target-equity").show();
        $(".target-debt").hide();
    }else if($target == 2){
        $(".target-equity").hide();
        $(".target-debt").show();
    }else{
        $(".target-equity").show();
        $(".target-debt").show();
    }
    $('#view-step-modal').modal('show');
}


function get_swp_count($set = 0)
{
    let total_month = 0;
    $("#allocation_swp input.scheme_custom_month").each(function(i){

        if($(this).val())
        {
            let month = $(this).val();

            $("#allocation_swp select.scheme_priority").each(function(i){
                if(!$(this).val())
                {
                    $(this).attr('readonly', false);
                }
            });
            let id = $(this).closest("tr").prop('id');
            let new_end_date_id = id.replace("folio", "swp_end_date");
            let withdrawal_amount = $("#withdrawal_amount").val();
            withdrawal_amount = withdrawal_amount.replace(/,/g, '');
            withdrawal_amount = parseInt(withdrawal_amount);
            let prev_value = $(this).parent().prev().prev().text();
            prev_value = prev_value.replace(/ /g,'');
            prev_value = parseInt(prev_value);
            month = parseInt(month);
            let swp_start_date = $("#swp_manage_date").val();
            var newDate = moment(swp_start_date, "DD-MM-YYYY").add(month, 'months').format('DD-MM-YYYY');
            $("#swp_manage_date").val(newDate);
            newDate = moment(newDate, "DD-MM-YYYY").subtract(1, 'day').format('DD-MM-YYYY');
            $("#"+new_end_date_id).val(newDate);
            let extra_month = month - prev_value;
            let extra_amount = 0;
            id = id.substring(6, id.length);
            if(extra_month > 0)
            {
                extra_amount = extra_month * withdrawal_amount;
                $scheme_name = $(this).parent().parent().children('td.swp_scheme_'+id).children('span.s_info');//
                $scheme_name.removeClass('d-none');
                $scheme_name.attr('title', 'Amount -'+extra_amount+' is needed after '+prev_value+' months');
                $scheme_name = $(this).parent().parent().children('td.swp_scheme_'+id).children('span:first').addClass('s_info_color');
            }
            total_month = parseInt(total_month) + parseInt($(this).val());
            if($set == 1)
            {
                let post = $('form#swp_portfolio_details').attr('method');
                let url = $('form#swp_portfolio_details').attr('action');
                let formData = new FormData($('#swp_portfolio_details')[0]);
                console.log(post,url);
                $.ajax({
                    // headers: {
                    //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    // },
                    type: post,
                    url: url,
                    data: formData,
                    //async: false,
                    beforeSend: function() {//xhr, type
                        //
                    },
                    success:function(data) {
                        console.log(data);

                    },
                    error: function(xhr, textStatus, thrownError)
                    {
                        var error = jQuery.parseJSON(xhr.responseText);
                        console.log(error);

                    },
                    cache: false,
                    contentType: false,
                    processData: false,
                    timeout: 8000,
                });
                location.reload();
            }
        }
    });
    return total_month;
}

$(document).on('change', '.scheme_custom_month', function () {
    let month = $(this).val();
    let total_month = 0;
    $("#allocation_swp select.scheme_priority").each(function(i){
        if(!$(this).val())
        {
            $(this).attr('readonly', false);
        }
    });
    let id = $(this).closest("tr").prop('id');
    let new_end_date_id = id.replace("folio", "swp_end_date");
    let withdrawal_amount = $("#withdrawal_amount").val();
    withdrawal_amount = withdrawal_amount.replace(/,/g, '');
    withdrawal_amount = parseInt(withdrawal_amount);
    let prev_value = $(this).parent().prev().prev().text();
    prev_value = prev_value.replace(/ /g,'');
    prev_value = parseInt(prev_value);
    month = parseInt(month);
    let swp_start_date = $("#swp_manage_date").val();
    var newDate = moment(swp_start_date, "DD-MM-YYYY").add(month, 'months').format('DD-MM-YYYY');
    $("#swp_manage_date").val(newDate);
    newDate = moment(newDate, "DD-MM-YYYY").subtract(1, 'day').format('DD-MM-YYYY');
    $("#"+new_end_date_id).val(newDate);
    let extra_month = month - prev_value;
    let extra_amount = 0;
    id = id.substring(6, id.length);
    if(extra_month > 0)
    {
        extra_amount = extra_month * withdrawal_amount;
        $scheme_name = $(this).parent().parent().children('td.swp_scheme_'+id).children('span.s_info');//
        $scheme_name.removeClass('d-none');
        $scheme_name.attr('title', 'Amount -'+extra_amount+' is needed after '+prev_value+' months');
        $scheme_name = $(this).parent().parent().children('td.swp_scheme_'+id).children('span:first').addClass('s_info_color');
    }

    //$("#future_amount_"+id).html(extra_amount);
    //$(this).parent().next().next().next().html(extra_amount);
    //Get Total Month
    $("#allocation_swp input.scheme_custom_month").each(function(i){
        if($(this).val())
        {
            total_month = parseInt(total_month) + parseInt($(this).val());
        }
    });
    if(total_month >= 60)
    {
        $('.swp_view_logic').removeClass('disabled');
    }else{
        $('.swp_view_logic').addClass('disabled');
    }

    let post = $('form#swp_portfolio_details').attr('method');
    let url = $('form#swp_portfolio_details').attr('action');
    console.log(post,url);
    let formData = new FormData($('#swp_portfolio_details')[0]);
    $.ajax({
        // headers: {
        //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        // },
        type: post,
        url: url,
        data: formData,
        //async: false,
        beforeSend: function() {//xhr, type
            //
        },
        success:function(data) {
            console.log(data);

        },
        error: function(xhr, textStatus, thrownError)
        {
            var error = jQuery.parseJSON(xhr.responseText);
            console.log(error);

        },
        cache: false,
        contentType: false,
        processData: false,
        timeout: 8000,
    });
});
$(document).on('change', '.scheme_priority', function () {
    var priority = $(this).val();
    var oldValue = $(this).attr('data-val');
    let id = $(this).closest("tr").prop('id');

    if(oldValue)
    {
        if(oldValue != priority)
        {
            let scheme_pri_id = id.replace("folio", "scheme_priority");
            $("#"+scheme_pri_id).val(oldValue).trigger('change');
        }
        return false;
    }
    //console.log(priority);
    if(priority)
    {
        $(".scheme_priority").attr('readonly',true);
        let new_id = id.replace("folio", "scheme_priority");
        let arrNumber = new Array();
        let arrval = '';
        $('select.scheme_priority').each(function(){
            if($(this).val())
            {
                arrNumber.push($(this).val());
                //arrval += $(this).val();
            }
        });
        for(var i=1; i<=arrNumber.length; i++)
        {
            if($.inArray(i.toString(), arrNumber) == -1) {
                //alert('Please manage the sequence');
                $(this).val("").trigger('change');
                $(".scheme_priority").attr('readonly',false);
                return false;
            }
        }
        $("#allocation_swp select.scheme_priority").each(function(i){
            if(!$(this).val())
            {
                let cid = $(this).closest("tr").prop('id');
                let cnew_id = cid.replace("folio", "scheme_priority");
                $.each( arrNumber, function( i, o ) {
                    //console.log(i,o);

                    $("#"+cnew_id).children('option[value="'+o+'"]').prop('disabled',true);
                });
            }
        });
        //Excel
        //$(this).parent().next().next().children('input').prop('readonly', false);
        let swp_start_date = $("#swp_manage_date").val();
        let swp_end_date = '';
        let swp_count = 0;
        for(var i=1; i<=arrNumber.length; i++)
        {
            if($.inArray(i.toString(), arrNumber) != -1) {
                if(priority == i)
                {
                    // if(swp_count == 0)
                    // {
                        $('select.scheme_priority').each(function(e){

                            if($(this).val() == i)
                            {
                                let nid = $(this).closest("tr").prop('id');
                                let new_nid = nid.replace("folio", "swp_start_end_date");
                                let new_start_date_id = id.replace("folio", "swp_start_date");
                                let new_end_date_id = id.replace("folio", "swp_end_date");
                                let new_scheme_month_id = id.replace("folio", "scheme_month");
                                let new_start_date = $("#"+new_start_date_id).val();
                                let new_end_date = $("#"+new_end_date_id).val();
                                let new_scheme_month = $("#"+new_scheme_month_id).val();
                                // if(i == 1)
                                // {
                                $("#"+new_nid).val(swp_start_date);
                                $("#"+new_start_date_id).val(swp_start_date);
                                if(new_scheme_month != '')
                                {
                                    new_scheme_month = parseInt(new_scheme_month);
                                    var newDate = moment(swp_start_date, "DD-MM-YYYY").add(new_scheme_month, 'months').format('DD-MM-YYYY');
                                    newDate = moment(newDate, "DD-MM-YYYY").subtract(1, 'day').format('DD-MM-YYYY');
                                    $("#"+new_end_date_id).val(newDate);
                                    swp_start_date = newDate;
                                }

                                // }else{

                                // }
                            }


                            //console.log(id);

                            // if(new_scheme_month)
                            // {

                            // }
                            // if($(this).val() == i && i == 1)
                            // {
                            //     $("#"+new_id).val(swp_start_date);
                            //     $("#"+new_start_date_id).val(swp_start_date);
                            //     //if()
                            //     $("#"+new_end_date_id).val();
                            // }else{

                            // }
                        });
                    }
                    // swp_count++;

                    //console.log(i);
                // }else{
                //     console.log(i);
                // }
            }
        }
        $(this).parent().next().next().next().children('input').prop('readonly', false);
        $(this).attr('data-val',priority)
    }
});

$(document).on('click', '#close_view_step_modal', function(e){
    $("#view-step-modal").modal('hide');
});

$(document).on('click', '.edit-now', function (e) {
    $(this).addClass('d-none');
    $(this).next().removeClass('d-none');
    $(this).parent().next().children().find('input.showhide').attr('readonly',false).removeClass('form-control-plaintext').addClass('form-control');
});

$(document).on('click', '.save-now', function (e) {
    let type = $("input[name=transaction_type]").val();
    let category = $(this).attr('data-category').toLowerCase();
    let maincategory = $(this).attr('data-maincategory').toLowerCase();
    console.log(category,maincategory);

    if(category == 'swp' && maincategory == 'swp')
    {
        swp_change();
        get_swp_count(1);
        location.reload();
    }
    else if((category == 'wealth' || category == 'tax' || category == 'shortterm' || category == 'gold' || category == 'tax-sip' || category == 'shortterm-sip' || category == 'gold-sip') && maincategory == 'lumpsum')
    {
        let portfolio_id = $("#"+category+"-portfolio").val();
        let amount = $("#"+category+"-amount").val();
        console.log(amount);
        amount = amount.replace(/,/g, "");
        amount = parseInt(amount);
        $.get("/transaction/create?id="+portfolio_id+"&amount="+amount, function(data, status){
            location.reload();
        });
    }
    else if((category == 'tax-sip' || category == 'shortterm-sip' || category == 'gold-sip') && maincategory == 'sip')
    {
        let portfolio_id = $("#"+category+"-portfolio").val();
        let amount = $("#"+category+"-amount").val();
        console.log(amount);
        amount = amount.replace(/,/g, "");
        amount = parseInt(amount);
        $.get("/transaction/create?id="+portfolio_id+"&amount="+amount, function(data, status){
            location.reload();
        });
    }
    else if((category == 'wealth' && maincategory == 'sip') || (category == 'wealth-sip' && maincategory == 'lumpsum'))
    {
        let portfolio_id = $("#sip-portfolio").val();
        let amount = $("#sip-amount").val();
        amount = amount.replace(/,/g, "");
        amount = parseInt(amount);

        $.get("/transaction/create?id="+portfolio_id+"&amount="+amount, function(data, status){
            location.reload();
        });
    }
    return false;
    // else if((category == 'tax' && maincategory == 'lumpsum') || (category == 'shortterm' && maincategory == 'lumpsum') || (category == 'gold' && maincategory == 'lumpsum'))
    // {

    // }
    // else if((category == 'wealth-sip' && maincategory == 'lumpsum'))
    // {

    // }
    if(type == 'swp')
    {

    }
    if (type === undefined || type === null) {
        if($(this).hasClass('wealth'))
        {
            wealth_change();
        }
        if($(this).hasClass('sip'))
        {
            //console.log('dsd');
            wealthsip_change();
        }
        // if($(this).hasClass('tax'))
        // {

        // }
   }
    //if(type == 'wealth-sip')
});

function wealth_change() {
    //console.log();
    $portfolio_id = $("#wealth-portfolio").val();
    $amount = $("#wealth-amount").val();
    $.get("/transaction/create?id="+$portfolio_id+"&amount="+$amount, function(data, status){
        location.reload();
    });
}

function wealthsip_change() {
    //console.log();
    $portfolio_id = $("#sip-portfolio").val();
    $amount = $("#sip-amount").val();
    $.get("/transaction/create?id="+$portfolio_id+"&amount="+$amount, function(data, status){
        location.reload();
    });
}


$(".reset-now").click(function(e){
    let id = $("input[name=transaction_id]").val();
    $.get("/transaction/"+id, function(data, status){
        location.reload();
    });
});
/**
 *  SWP Amount Change Function
 */
function swp_change()
{
    $portfolio_id = $("#swp-portfolio").val();
    $amount = $("#swp-amount").val();
    $withdrawal_amount = $("#withdrawal_amount").val();
    if($withdrawal_amount == 0)
    {
        $("#mismatch_amount").removeClass('d-none');
        //$('#mismatch_amount label.error').delay(5000).fadeOut('slow');
        $previous_value = $("#previous_withdrawal_amount").val();

        $("#withdrawal_amount").val($previous_value);
        setTimeout(function(){
            fadeout();
        }, 4000);
        return false;
    }else{
        $("#mismatch_amount").addClass('d-none');
    }

    //return false;
    $.get("/transaction/create?id="+$portfolio_id+"&amount="+$amount+"&withdrawal_amount="+$withdrawal_amount, function(data, status){
        //location.reload();
        console.log(data);
        get_swp_count(1);
    });
}

function fadeout()
{
    $('#mismatch_amount label.error').fadeOut('slow');
    //$("#mismatch_amount").addClass('d-none');
}
/**
 *
 *
 */

 $('input[type=radio][name=allocation_wealth_swp]').change(function() {
     console.log('sdshi');
    if (this.value == 'recommended') {
        $("#custom_equity_ratio_swp").attr('readonly',true);
        let portfolio_id = $("#swp-portfolio").val();
        let base_amount = $("#swp-amount").val();
        base_amount = base_amount.replace(/,/g, '');
        let type = 'Recommended';
        let equity = $("#swp_allocation_equity_ratio_recommended").val();
        $.get("/transaction/create?id="+portfolio_id+"&equity="+equity+"&type="+type, function(data, status){
            location.reload();
           // console.log(data);
        });
    }
    else if (this.value == 'custom') {
        $("#custom_equity_ratio_swp").attr('readonly',false);
    }
});


 $(document).on('change', '#custom_equity_ratio_swp', function (e) {

    let portfolio_id = $("#swp-portfolio").val();
    let base_amount = $("#swp-amount").val();
    //console.log($portfolio_id,base_amount);
    base_amount = base_amount.replace(/,/g, '');
    let type = 'Custom';
    let equity = e.target.value;
    let equity_amount = base_amount * equity / 100;
    let debt = 100 - equity;
    let debt_amount = base_amount * debt / 100;
    let ratio = equity+":"+debt;
    $(".custom_swp").html(ratio);
    $("#equity-swp-amount").val(equity_amount);
    //$(".scheme_custom_amount_equity_swp").val(0);
    $(".scheme_custom_amount_equity_swp").attr('readonly',false);
    $(".scheme_percentage_swp").html("0%");
    $(".equity-swp-amount").show();
    $("#debt-swp-amount").val(debt_amount);
    $(".debt-swp-amount").show();
    //$(".scheme_custom_amount_debt_swp").val(0);
    $(".scheme_custom_amount_debt_swp").attr('readonly',false);
    console.log(equity,debt);
    $.get("/transaction/create?id="+portfolio_id+"&equity="+equity+"&type="+type, function(data, status){
        location.reload();
       // console.log(data);
    });
});


$('input[type=radio][name=allocation_wealth]').change(function() {
    if (this.value == 'recommended') {
        let type = 'Recommended';
        $portfolio_id = $("#wealth-portfolio").val();
        let equity = $('#wealth_allocation_equity_ratio_recommended').val();
        console.log(equity);
        $.get("/transaction/create?id="+$portfolio_id+"&equity="+equity+"&type="+type, function(data, status){
            location.reload();
            //console.log(data);
        });
        $("#custom_equity_ratio").attr('readonly',true);
    }
    else if (this.value == 'custom') {
        $("#custom_equity_ratio").attr('readonly',false);
    }
});

$(document).on('change', '#custom_equity_ratio', function (e) {

    $portfolio_id = $("#wealth-portfolio").val();
    let base_amount = $("#wealth-amount").val();
    base_amount = base_amount.replace(/,/g, '');
    let type = 'Custom';
    let equity = e.target.value;
    let equity_amount = base_amount * equity / 100;
    let debt = 100 - equity;
    let debt_amount = base_amount * debt / 100;
    let ratio = equity+":"+debt;
    $(".custom_wealth").html(ratio);
    $("#equity-wealth-amount").val(equity_amount);
    //$(".scheme_custom_amount_equity").val(0);
    $(".scheme_custom_amount_equity").attr('readonly',false);
    //$(".scheme_percentage").html("0%");
    $(".equity-wealth-amount").hide();
    $("#debt-wealth-amount").val(debt_amount);
    $(".debt-wealth-amount").hide();
    //$(".scheme_custom_amount_debt").val(0);
    $(".scheme_custom_amount_debt").attr('readonly',false);
    //console.log($equity,$debt);
    $.get("/transaction/create?id="+$portfolio_id+"&equity="+equity+"&type="+type, function(data, status){
            location.reload();
            console.log(data);
    });
});

$('input[type=radio][name=allocation_sip]').change(function() {
    if (this.value == 'recommended') {
        let type = 'Recommended';
        $portfolio_id = $("#sip-portfolio").val();
        let equity = $('#sip_allocation_equity_ratio_recommended').val();
        console.log(equity);
        $.get("/transaction/create?id="+$portfolio_id+"&equity="+equity+"&type="+type, function(data, status){
            location.reload();
            console.log(data);
        });
        $("#custom_equity_ratio_sip").attr('readonly',true);
    }
    else if (this.value == 'custom') {
        $("#custom_equity_ratio_sip").attr('readonly',false);
    }
});

$('input[type=radio][name=allocation_wealth_sip]').change(function() {
    if (this.value == 'recommended') {
        $("#custom_equity_ratio_sip").attr('readonly',true);
    }
    else if (this.value == 'custom') {
        $("#custom_equity_ratio_sip").attr('readonly',false);
    }
});

$(document).on('change', '#custom_equity_ratio_sip', function (e) {

    $portfolio_id = $("#sip-portfolio").val();
    let base_amount = $("#sip-amount").val();
    base_amount = base_amount.replace(/,/g, '');
    let type = 'Custom';
    let equity = e.target.value;
    let equity_amount = base_amount * equity / 100;
    let debt = 100 - equity;
    let debt_amount = base_amount * debt / 100;
    let ratio = equity+":"+debt;
    $(".custom_wealth").html(ratio);
    $("#equity-wealth-amount").val(equity_amount);
    //$(".scheme_custom_amount_equity").val(0);
    $(".scheme_custom_amount_equity").attr('readonly',false);
    $(".scheme_percentage").html("0%");
    $(".equity-wealth-amount").hide();
    $("#debt-wealth-amount").val(debt_amount);
    $(".debt-wealth-amount").hide();
    //$(".scheme_custom_amount_debt").val(0);
    $(".scheme_custom_amount_debt").attr('readonly',false);
    //console.log($equity,$debt);
    //return false;
    $.get("/transaction/create?id="+$portfolio_id+"&equity="+equity+"&type="+type, function(data, status){
        location.reload();
       // console.log(data);
    });
});


$(document).on('change', '.scheme_amount_common', function (e) {
    let type = $(this).closest('tr').attr('data-type');
    console.log(type);
    let count = $('.scheme_amount_'+type).length;
    let percentage = 0;
    let pending_amount = $("#"+type+"_pending_amount").val();
    pending_amount = pending_amount.replace(/,/g, "");
    pending_amount = parseInt(pending_amount);
    let total_amount = 0;
    console.log(type,count);
    let og_val = $("#"+type+"-amount").val();
    og_val = og_val.replace(/,/g, "");
    og_val = parseInt(og_val);
    let val = $(this).val();
    val = val.replace(/,/g, "");
    val = parseInt(val);
    console.log(og_val,val);
    if(og_val >= val)
    {
        $("#"+type+"_portfolio_details input.scheme_amount_"+type).each(function(i){
            let ival = $(this).val();
            ival = ival.replace(/,/g, "");
            ival = parseInt(ival);
            total_amount = total_amount + ival;
        });

        if(total_amount > 0)
        {
            pending_amount = og_val - total_amount;
            pending_amount = currency(pending_amount);
            $("#"+type+"_pending_amount").val(pending_amount);
        }
        if(count == 1 && pending_amount != 0)
        {
            alert('Please add total amount to text box');
            return false;
        }
        if(pending_amount == 0 && count > 1)
        {
            $("#"+type+"_portfolio_details input.scheme_amount_"+type).each(function(i){
                let jval = $(this).val();
                if(jval == 0)
                {
                    $(this).attr('readonly',true);
                }
            });
        }
        //calculate %
        console.log(og_val,val);
        if(og_val != 0 && val != 0)
        {
            percentage = (val * 100) / og_val;
            percentage = round(percentage, 2);
            $(this).parent().next().html(percentage+"%");
            //Saving data to database
            let post = $("form#"+type+"_portfolio_details").attr('method');

            let url = $("form#"+type+"_portfolio_details").attr('action');
            console.log(url);
            let formData = new FormData($("form#"+type+"_portfolio_details")[0]);
            $.ajax({
                // headers: {
                //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                // },
                type: post,
                url: url,
                data: formData,
                //async: false,
                beforeSend: function() {//xhr, type
                    //
                },
                success:function(data) {
                    console.log(data);

                },
                error: function(xhr, textStatus, thrownError)
                {
                    var error = jQuery.parseJSON(xhr.responseText);
                    console.log(error);

                },
                cache: false,
                contentType: false,
                processData: false,
                timeout: 8000,
            });
        }

    }else{
        $(this).val(0);
    }
});

//wealth-description
$('textarea.description').blur(function() {
    if($.trim($('textarea').val()).length){
        // Added () around $this
        //$(this).css('background-image', 'none');
        //console.log('shash');
        let id = $(this).attr('id');
        let val = $(this).val();
        let pid = $(this).parent().attr('data-des-id');

        $.get("/transaction/create?id="+pid+"&description="+val, function(data, status){
            //location.reload();
            console.log(data);
        });
        console.log(id,val,pid);
    }
  });

$(document).on('click', '.scheme_custom_amount_equity,.scheme_custom_amount_debt', function (e) {
    $type = $("input[name=wealth-transaction_custom]").val();
    if($type == 1)
    {
        $(this).removeClass('form-control-plaintext');
        $(this).addClass('form-control');
    }
    if(e.target.value == 0)
    {
        $(this).val('');
    }
});

$(document).on('click', '.scheme_custom_date_equity', function (e) {
    $type = $("input[name=sip-transaction_custom]").val();
    console.log($type);
    $(this).removeClass('form-control-plaintext');
        $(this).addClass('form-control');
    // if($type == 1)
    // {
    //     $(this).removeClass('form-control-plaintext');
    //     $(this).addClass('form-control');

    // }else{
    //     $(this).datepicker("hide");
    //     $(this).prop('readonly',true);
    //     return false;
    // }
    if(e.target.value == '')
    {
        $(this).val(null);
    }
});


// $(document).on('click', '.scheme_custom_amount_debt', function (e) {
//     $type = $("input[name=wealth-transaction_custom]").val();
//     if(e.target.value == 0)
//     {
//         $(this).val('');
//     }
// });

$(document).on('blur', '.scheme_custom_amount_equity,.scheme_custom_amount_debt', function (e) {
    console.log(e.target.value);
    $type = $("input[name=wealth-transaction_custom]").val();
    if($type == 1)
    {
        $(this).addClass('form-control-plaintext');
        $(this).removeClass('form-control');
    }
    if(e.target.value == '')
    {
        $(this).val('0');
    }
});



$(document).on('click', '.scheme_custom_date_sip', function (e) {
    $type_id = $(this).closest("tr").attr('data-type');

    $type = $("input[name="+$type_id+"-transaction_custom]").val();
    $(this).removeClass('form-control-plaintext');
    $(this).addClass('form-control');

    if(e.target.value == '')
    {
        $(this).val(null);
    }
});

$(document).on('blur', '.scheme_custom_date_equity', function (e) {
    console.log(e.target.value);
    $type = $("input[name=sip-transaction_custom]").val();
    if($type == 1)
    {
        $(this).addClass('form-control-plaintext');
        $(this).removeClass('form-control');
    }
    if(e.target.value == '')
    {
        $(this).val(null);
    }
});

$(document).on('blur', '.scheme_custom_date_sip', function (e) {
    $type_id = $(this).closest("tr").attr('data-type');

    $type = $("input[name="+$type_id+"-transaction_custom]").val();
    $(this).addClass('form-control-plaintext');
    $(this).removeClass('form-control');
    if(e.target.value == '')
    {
        $(this).val(null);
    }
});

$(document).on('change', '.scheme_custom_date_equity', function (e) {
    save_wealth_sip_tab_data();
});

$(document).on('change', '.scheme_custom_date_sip', function (e) {
    $type_id = $(this).closest("tr").attr('data-type');
    console.log($type_id);
    save_other_sip_tab_data($type_id);
});

// $(document).on('blur', '.scheme_custom_amount_debt', function (e) {
//     console.log(e.target.value);
//     if(e.target.value == '')
//     {
//         $(this).val('0');
//     }
// });

$(document).on('change', '.scheme_custom_amount_equity', function (e) {
    let current_amount = e.target.value;
    current_amount = current_amount.replace(/,/g, '');

    let equity_amount = 0;
    let base_amount = $("#wealth-amount").val();
    base_amount = base_amount.replace(/,/g, '');

    let custom_wealth = $(".custom_wealth").html();
    let ratio = custom_wealth.split(":");
    let equity_ratio = ratio[0];
    let debt_ratio = ratio[1];

    let equity_base_amount = base_amount * equity_ratio / 100;
    let debt_base_amount = base_amount * debt_ratio / 100;

    equity_base_amount = parseInt(equity_base_amount);
    debt_base_amount = parseInt(debt_base_amount);

    let percentage = 0;
    let total_percentage = 0;
    $('form#wealth_portfolio_details input[type=text].scheme_custom_amount_equity').each(function(){
        amount = $(this).val().replace(/,/g, '');
        equity_amount = parseInt(equity_amount) + parseInt(amount);
    });

    //console.log(equity_amount);
    total_percentage = (equity_amount * 100) / base_amount;
    total_percentage = round(total_percentage,2);
    let total_equity_amount = $(".total_equity_amount").html();
    total_equity_amount = total_equity_amount.replace(/,/g, '');
    total_equity_amount = parseInt(total_equity_amount);
    console.log(equity_amount , total_equity_amount);
    if(equity_amount > total_equity_amount)
    {
        $("#errormodal").modal('show');
        //$(this).val(0);
        return false;
    }
    $(".total_equity_amount").html(equity_amount);
    $(".total_equity_percentage").html(total_percentage);
    total_percentage = round(total_percentage,0);
    remaning_percentage = 100 - total_percentage;
    $('.custom_wealth').html(total_percentage + ':' +  remaning_percentage);
    console.log(total_percentage);
    //let equity_wealth_amount = $("#equity-wealth-amount").val();
    let equity_wealth_amount = 0;//.replace(/,/g, '');
    equity_wealth_amount = equity_base_amount - equity_amount;
    let debt_amount = base_amount - equity_amount;
    //console.log(equity_wealth_amount);
    $("#equity-wealth-amount").val(equity_amount);
    $("#debt-wealth-amount").val(debt_amount);
    percentage = current_amount * 100 / base_amount;
    percentage = round2Fixed(percentage)+"%";
    $(this).parent().next().html(percentage);
    check_wealth_ratio(total_percentage , remaning_percentage);
});

$(document).on('change', '.scheme_custom_amount_debt', function (e) {
    let current_amount = e.target.value;
    current_amount = current_amount.replace(/,/g, '');

    let debt_amount = 0;
    let base_amount = $("#wealth-amount").val();
    base_amount = base_amount.replace(/,/g, '');
    console.log(base_amount);
    let custom_wealth = $(".custom_wealth").html();
    let ratio = custom_wealth.split(":");
    let equity_ratio = ratio[0];
    let debt_ratio = ratio[1];

    let equity_base_amount = base_amount * equity_ratio / 100;
    let debt_base_amount = base_amount * debt_ratio / 100;

    equity_base_amount = parseInt(equity_base_amount);
    debt_base_amount = parseInt(debt_base_amount);

    let percentage = 0;
    let total_percentage = 0;
    $('form#wealth_portfolio_details input[type=text].scheme_custom_amount_debt').each(function(){
        amount = $(this).val().replace(/,/g, '');
        debt_amount = parseInt(debt_amount) + parseInt(amount);
    });

    total_percentage = (debt_amount * 100) / base_amount;
    total_percentage = round(total_percentage,2);

    let total_debt_amount = $(".total_debt_amount").html();
    total_debt_amount = parseInt(total_debt_amount);
    console.log(debt_amount , total_debt_amount);
    if(debt_amount > total_debt_amount)
    {
        $("#errormodal").modal('show');
        $(this).val(0);
        return false;
    }

    $(".total_debt_amount").html(debt_amount);
    $(".total_debt_percentage").html(total_percentage);
    total_percentage = round(total_percentage,0);
    remaning_percentage = 100 - total_percentage;
    $('.custom_wealth').html(remaning_percentage + ':' +  total_percentage);
    //let equity_wealth_amount = $("#equity-wealth-amount").val();
    let debt_wealth_amount = 0;//.replace(/,/g, '');
    debt_wealth_amount = debt_base_amount - debt_amount;
    //console.log(equity_wealth_amount);
    let equity_amount = base_amount - debt_amount;
    $("#debt-wealth-amount").val(debt_amount);
    $("#equity-wealth-amount").val(equity_amount);
    percentage = current_amount * 100 / base_amount;
    percentage = round2Fixed(percentage)+"%";
    $(this).parent().next().html(percentage);
    check_wealth_ratio(remaning_percentage,total_percentage);

});


function check_wealth_ratio($equityratio,$debtratio)
{
    //equity-wealth-amount
    //$(".equity-wealth-amount,.debt-wealth-amount").show();
    let equity_amount = 0;
    let debt_amount = 0;

    $('form#wealth_portfolio_details input[type=text].scheme_custom_amount_equity').each(function(){
        amount = $(this).val().replace(/,/g, '');
        equity_amount = parseInt(equity_amount) + parseInt(amount);
    });

    $('form#wealth_portfolio_details input[type=text].scheme_custom_amount_debt').each(function(){
        amount = $(this).val().replace(/,/g, '');
        debt_amount = parseInt(debt_amount) + parseInt(amount);
    });

    let total_equity_percentage = $(".total_equity_percentage").text();
    total_equity_percentage = parseFloat(total_equity_percentage);
    total_equity_percentage = round(total_equity_percentage,0);

    let total_debt_percentage = $(".total_debt_percentage").text();
    total_debt_percentage = parseFloat(total_debt_percentage);
    total_debt_percentage = round(total_debt_percentage,0);

    let total_percentage = total_equity_percentage + total_debt_percentage;
    //console.log(total_equity_percentage,total_debt_percentage);
    let equityamount = $("#equity-wealth-amount").val();
    equityamount = parseInt(equityamount.replace(/,/g, ''));
    let debtamount = $("#debt-wealth-amount").val();
    debtamount = parseInt(debtamount.replace(/,/g, ''));
    let total_amount = equityamount + debtamount;
    let base_amount = $("#wealth-amount").val();
    base_amount = parseInt(base_amount.replace(/,/g, ''));

    console.log(equityamount,debtamount,base_amount,equity_amount,debt_amount);
    if($equityratio > total_equity_percentage)
    {
        $("#equity-wealth-amount").addClass('text-error');
    }else{
        $("#equity-wealth-amount").removeClass('text-error');
    }
    if($debtratio > total_debt_percentage)
    {
        $("#debt-wealth-amount").addClass('text-error');
    }else{
        $("#debt-wealth-amount").removeClass('text-error');
    }
    // if(equityamount < equity_amount)
    // {
    //     $("#equity-wealth-amount").addClass('text-error');
    // }else{
    //     $("#equity-wealth-amount").removeClass('text-error');
    // }

    // if(debtamount < debt_amount)
    // {
    //     $("#debt-wealth-amount").addClass('text-error');
    // }else{
    //     $("#debt-wealth-amount").removeClass('text-error');
    // }
    // if(total_percentage == 100)
    // {
    //     $("#mismatch_equity_debt").hide();
    // }else{
    //     $("#mismatch_equity_debt").show();
    // }

}

function wealth_save()
{
    active_next_tab();
    save_wealth_tab_data();
    //console.log(active_count,total_count);
    //
}

function save_next(id)
{
    active_next_tab();
    console.log(id);
    if(id == 'wealth')
    {
        save_wealth_sip_tab_data()
    }else{
        save_other_sip_tab_data(id);
    }

}

function save_wealth_sip_tab_data()
{
    let post = $('form#sip_portfolio_details').attr('method');
    let url = $('form#sip_portfolio_details').attr('action');
    let formData = new FormData($('#sip_portfolio_details')[0]);
    $.ajax({
        // headers: {
        //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        // },
        type: post,
        url: url,
        data: formData,
        //async: false,
        beforeSend: function() {//xhr, type
            //
        },
        success:function(data) {
            console.log(data);
        },
        error: function(xhr, textStatus, thrownError)
        {
            var error = jQuery.parseJSON(xhr.responseText);
            console.log(error);

        },
        cache: false,
        contentType: false,
        processData: false,
        timeout: 8000,
    });
}

function save_other_sip_tab_data($id)
{
    //console.log($id);
    let post = $('form#'+$id+'_portfolio_details').attr('method');
    let url = $('form#'+$id+'_portfolio_details').attr('action');
    let formData = new FormData($('#'+$id+'_portfolio_details')[0]);
    $.ajax({
        // headers: {
        //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        // },
        type: post,
        url: url,
        data: formData,
        //async: false,
        beforeSend: function() {//xhr, type
            //
        },
        success:function(data) {
            console.log(data);
        },
        error: function(xhr, textStatus, thrownError)
        {
            var error = jQuery.parseJSON(xhr.responseText);
            console.log(error);

        },
        cache: false,
        contentType: false,
        processData: false,
        timeout: 8000,
    });
}

function save_wealth_tab_data()
{
    let post = $('form#wealth_portfolio_details').attr('method');
    let url = $('form#wealth_portfolio_details').attr('action');
    let formData = new FormData($('#wealth_portfolio_details')[0]);
    $.ajax({
        // headers: {
        //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        // },
        type: post,
        url: url,
        data: formData,
        //async: false,
        beforeSend: function() {//xhr, type
            //
        },
        success:function(data) {
            console.log(data);
        },
        error: function(xhr, textStatus, thrownError)
        {
            var error = jQuery.parseJSON(xhr.responseText);
            console.log(error);

        },
        cache: false,
        contentType: false,
        processData: false,
        timeout: 8000,
    });
}

function active_next_tab()
{
    let active_count = $("#transaction_nav li a.active").attr('data-count');
    let total_count = $("#transaction_content").attr('data-total-count');
    let new_active_count = parseInt(active_count) + 1;
    let href = '';
    if(active_count != total_count)
    {
        $("#transaction_nav li").each(function(i){
            //console.log($(this).find('a').attr('data-count'), new_active_count);
            $a_attr = $(this).find('a');
            if($a_attr.attr('data-count') == new_active_count)
            {
                href = $a_attr.attr('href');
                $('[href="'+href+'"]').tab('show');
            }
        });
    }
}

$('#transaction_nav .nav-item [data-toggle=tab]').click(function () {
    let click_id = $(this).attr('href');
    if(click_id == '#wealth-lumpsum'){
        $("a#view_logic_wealth").show();
    }else{
        $("a#view_logic_wealth").hide();
    }
    if(click_id == '#wealth-sip-lumpsum'){
        $("a#view_logic_wealth_sip").show();
    }else{
        $("a#view_logic_wealth_sip").hide();
    }
    //let active_id = $("#transaction_nav li a.active").attr('href');
    //console.log(click_id,active_id);
    return true;});

function check_active_tab()
{
    let active_id = $("#transaction_nav li a.active").attr('href');
    if(active_id == '#wealth-lumpsum'){
        $("a#view_logic_wealth").show();
    }else{
        $("a#view_logic_wealth").hide();
    }
    if(active_id == '#wealth-sip-lumpsum'){
        $("a#view_logic_wealth_sip").show();
    }else{
        $("a#view_logic_wealth_sip").hide();
    }
    return true;
}
