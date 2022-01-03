var formLength = $('.step-forms .trial').length;
$(window).on('load', function () {
    //let height = $('.step-forms .active').height();
    //$('.step-forms').css('height', height + 'px');
    $('input[name="birthdate"]').datepicker({
        autoclose: true,
        format: "dd-mm-yyyy"
    });
});

// $(".back-btn").click(function () {
//     //back_to_intro
//     $('#loading').show();
//     if($(this).hasClass('back_to_intro'))
//     {
//         let id = $("#client_id").val();
//         window.location.href = '/client/introduction/'+id;
//     }
//     let current = $(this).parent().closest('section.trial');
//     let currentCount = parseInt(current.attr('data-step'));
//     let prev = $(".trial[data-step=" + (currentCount - 1) + "]");
//     let currentstep = current.attr('data-step');
//     let currentid = current.attr('id');
//     let prevstep = prev.attr('data-step');
//     let previd = prev.attr('id');
//     let currentLink = "[data-form=" + currentid + "]";
//     let prevLink = "[data-form=" + previd + "]";

//     current.removeClass('active');
//     prev.addClass('active');
//     $('input[name=step]').val(prevstep);
//     if ($('.form-lists li' + prevLink).hasClass('completed')) {
//         $('.form-lists li' + prevLink).addClass('active ');
//         $('.form-lists li' + prevLink).removeClass('completed');
//     } else if ($('.form-lists li' + prevLink).hasClass('isChild')) {
//         $('.form-lists li' + prevLink).addClass('sub-active');
//     }
//     $('.form-lists li' + currentLink).removeClass('active ');
//     $('.form-lists li' + currentLink).removeClass('sub-active');
//     $('#loading').hide();
// });

// $(".form-lists li").on("click", function (e) {
//     $("#loading").show();
//     let id = $('#client_id').val();
//     let current = $(this).attr('data-form');
//     let currentstep =  $("#"+current).attr("data-step");
//     $('input[name=step]').val(currentstep);
//     if(current == 'introduction')
//     {
//         window.location.href = '/client/introduction/'+id;
//         return false;
//     }
//     if(current == 'comprehensive-plan')
//     {
//         window.location.href = '/client/comprehensive/'+id;
//         return false;
//     }

//     if ($(this).hasClass('completed')) {
//         $('.trial').removeClass('active');
//         $(".form-lists li").removeClass('active');
//         $("#" + current).addClass('active');
//         $(this).addClass('active');

//     } else if ($(this).hasClass('isParent') && $(this).hasClass('active')) {
//         $('.trial').removeClass('active');
//         $("#" + current).addClass('active');
//     } else if ($(this).hasClass('sub-active')) {
//         e.stopPropagation();
//         $('.trial').removeClass('active');
//         $("#" + current).addClass('active');
//     } else {
//         e.stopPropagation();
//     }
//     $("#loading").hide();
// });

$('.step-forms .trial button.proceed').click(function (e) {
    e.preventDefault();
    $(document).scrollTop(0);
    let isAccount = $('#introduction:visible #proceed-to').val() == 'account';
    let current = '';
    let id = $('#client_id').val();
    $('#loading').show();
    if($(this).parent().hasClass('trial'))
    {
        current = $(this).parent();
    }else{
        current = $(this).parent().closest('section.trial');
    }

    nextSteper(current,isAccount,id);

});


function nextSteper(current,isAccount,id)
{
    let currentstep = current.attr('data-step');
    let currentid = current.attr('id');

    let currentLink = "[data-form=" + currentid + "]";
    let currentCount = parseInt(currentstep);

    let next = '';
    if(currentstep == 10)
    {
        window.location.replace('/client/kycdetail/'+id);
        return false;
    }
    next = $(".trial[data-step=" + (currentCount + 1) + "]");
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
        // $('input[name="birth_date"],input[name="anniversary_date"]').datepicker({
        //     autoclose: true
        // });



    }, 500);
}



$(".nominee-checkbox").on('change', function () {
    if ($(this).is(':checked')) {
        $(this).parent().parent().find('.form-sections').show();
    } else {
        $(this).parent().parent().find('.form-sections').hide();
    }
});





function accountsinput() {
    $('select').select2({
        width: '100%'
    });
    // if ($('#Nominee' + accountCount).is(':checked')) {
    //     $($('#Nominee' + accountCount)).parent().parent().find('.form-sections').show();
    // } else {
    //     $($('#Nominee' + accountCount)).parent().parent().find('.form-sections').hide();
    // }
    $('.remove-accounts').click(function () {
        let count = $(this).parent().data('count');

        $('#add-account-' + accountCount).remove();
        $($(this)).parent().remove();
        $('#add-account').tab('show');
    });
    $(".nominee-checkbox").on('change', function () {
        if ($(this).is(':checked')) {
            $(this).parent().parent().find('.form-sections').show();
        } else {
            $(this).parent().parent().find('.form-sections').hide();
        }
    });
}

$(" .income-tab .nav-item .remove-member").click(function () {
    $(this).parent().find('.nav-link').removeAttr('data-toggle');
    $(this).parent().find('.nav-link').removeClass('active');
    $(this).parent().addClass("disabled");
    $($(this).parent()).detach().prependTo('.active .family-tab > .active .disabled-wrapper');
    if ($(this).parent().next().length != 0) {
        $(this).parent().next().find('.nav-link').trigger('click');
    } else {
        $(".family-tab > .active .income-tab .nav-item:first-child .nav-link").trigger('click');
    }
});

$(" .income-tab .nav-item .add-income").click(function () {
    $(this).parent().find('.nav-link').attr('data-toggle', "tab");
    $(this).parent().removeClass("disabled");
    $(".active .family-tab > .active .income-tab .nav-item .nav-link").removeClass('active');
    $(this).parent().find('.nav-link').trigger('click');
    $($(this).parent()).detach().insertBefore('.active .family-tab > .active .disabled-wrapper');

});

var accountCount = 1;
$('.add-account').click(function () {
    $(this).tab('show');
    let allData = false;
    let data = {};
    let checkedValue = $('#Nominee').is(':checked') ? true : false;

    let title;
    if ($("#accountType").val() == "Single" && $("#firstHolder").val() != "") {
        $('#add-account input,#add-account select').each(function () {
            allData = true;
            data[$(this).attr('id') + count] = $(this).val();
        });

        title = count + ' - ' + $("#firstHolder").val();

    } else if ($("#accountType").val() == "Joint" && $("#firstHolder").val() != "" && $(
        "#secondHolder").val() != "") {
        $('#add-account input,#add-account select').each(function () {
            allData = true;
            data[$(this).attr('id') + count] = $(this).val();
        });
        title = count + ' - ' + $("#firstHolder").val() + ' + ' + $("#secondHolder").val();
    } else {
        allData = false;
        return false;
    }

    console.log(data);
    if (allData) {
        let prependData = '<div class="tab-pane fade" id="add-account-' + accountCount + '" role="tabpanel" aria-labelledby="add-tab">\
            <div class="form-sections">\
                <h4 class="form-section-title text-uppercase">Account\
                    Details</h4>\
                <div class="row">\
                    <div class="col-sm-4">\
                        <div class="form-group">\
                            <label for="accountType' + accountCount + '"> Account type*</label>\
                            <select class="form-control" id="accountType' + accountCount + '">\
                                <option value="" disabled selected>Select\
                                    Account type</option>\
                                <option value="Single">Single</option>\
                                <option value="Joint">Joint</option>\
                            </select>\
                        </div>\
                    </div>\
                </div>\
                <div class="row">\
                    <div class="col-sm-4">\
                        <div class="form-group">\
                            <label id="firstHolder' + accountCount + '">First Holder</label>\
                            <input type="text" class="form-control"\
                                id="firstHolder' + accountCount + '" value="' + data['firstHolder' +
            accountCount] + '"\
                                placeholder="Enter First Holder Name" />\
                        </div>\
                    </div>\
                    <div class="col-sm-4">\
                        <div class="form-group">\
                            <label for="secondHolder' + accountCount + '">Second Holder</label>\
                            <input type="text" class="form-control"\
                                id="secondHolder' + accountCount + '" value="' + data['secondHolder' +
            accountCount] + '"\
                                placeholder="Enter Second Holder Name" />\
                        </div>\
                    </div>\
                    <div class="col-sm-4">\
                        <div class="form-group">\
                            <label for="thirdHolder' + accountCount + '">Third holder</label>\
                            <input type="text" class="form-control"\
                                id="thirdHolder' + accountCount + '" value="' + data['thirdHolder' +
            accountCount] + '"\
                                placeholder="Enter Third holder Name" />\
                        </div>\
                    </div>\
                    <div class="col-sm-12 ">\
                        <div class="form-group custom-checkbox ">\
                            <input type="checkbox" id="Nominee' + accountCount + '"\
                                class="nominee-checkbox" checked>\
                            <label for="Nominee' + accountCount + '">Nominee?</label>\
                        </div>\
                                  <div class="form-sections mt-5 mb-0"\
                            style="display: none;">\
                            <h4 class="form-section-title text-uppercase">NOMINEE DETAILS</h4>\
                            <div class="row">\
                                <div class="col-sm-4">\
                                    <div class="form-group">\
                                        <label for="nomineeName' + accountCount + '">Nominee Name</label>\
                                        <input type="text" class="form-control" id="nomineeName' +
            accountCount + '"\
                                            placeholder="Enter Nominee Name" value="' + data['nomineeName' +
            accountCount] + '" />\
                                    </div>\
                                </div>\
                                <div class="col-sm-4">\
                                    <div class="form-group">\
                                        <label for="relationship' + accountCount + '"> Relationship</label>\
                                        <select class="form-control"\
                                            id="relationship' + accountCount + '">\
                                            <option value="" disabled\
                                                selected>Select\
                                                Relationship</option>\
                                            <option>Mother</option>\
                                            <option>Father</option>\
                                        </select>\
                                    </div>\
                                </div>\
                                <div class="col-sm-4">\
                                    <div class="form-group">\
                                        <label for="guardian-name' + accountCount + '"> Guardian Name</label>\
                                        <input type="text" class="form-control" id="guardian-name' +
            accountCount + '"\
                                            placeholder="Enter Guardian Name" value="' + data['guardian-name' +
            accountCount] + '" />\
                                    </div>\
                                </div>\
                            </div>\
                        </div>\
                    </div>\
                </div>\
            </div>\
            <div class="form-sections">\
                <h4 class="form-section-title text-uppercase">Bank Details</h4>\
                <div class="row">\
                    <div class="col-sm-4">\
                        <div class="form-group">\
                            <label for="defaultBank' + accountCount + '"> Default Bank</label>\
                            <select id="defaultBank' + accountCount + '" class="form-control">\
                                <option value="" disabled selected>Select Default Bank</option>\
                                <option>Mother</option>\
                                <option>Father</option>\
                            </select>\
                        </div>\
                    </div>\
                    <div class="col-sm-4">\
                        <div class="form-group">\
                            <label for="otherBank' + accountCount + '"> Other Bank</label>\
                            <select id="otherBank' + accountCount + '" class="form-control">\
                                <option value="" disabled selected>Select Other Bank</option>\
                                <option>Mother</option>\
                                <option>Father</option>\
                            </select>\
                        </div>\
                    </div>\
                </div>\
            </div>\
        </div>\
        ';
        let headData = '<li class="nav-item mb-3" role="presentation" data-count="' + accountCount + '">\
                            <a class="nav-link"  \
                                data-toggle="tab"  href="#add-account-' + accountCount + '" role="tab"\
                                 aria-selected="false">' + title + '</a>\
            <span class="remove-accounts"><i class="icon-close"></i></span></li>';
        $(headData).insertBefore('.add-account-item');
        $("#bank-opening-tab").prepend(prependData);
        $('#add-account-' + accountCount + ' select').each(function () {
            let value = $(this).attr('id');
            $(this).val(data[value]);
        });
        count = count + 1;
        checkedValue == false ? $("#Nominee" + accountCount).removeAttr('checked') : '';
        $('#add-account input,#add-account select').each(function () {
            $(this).val("");
        });
        accountsinput();
    }
});

$('.add-more-mandate').on('click', function () {
    let formFields = `<div class=" row">

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Type</label>
                                <select class="form-control">
                                    <option value="" disabled selected>Select Type
                                    </option>
                                    <option>ICICI Bank - 32796578235</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Amount</label>
                                <input type="text" class="form-control"
                                    placeholder="Enter Amount">
                            </div>
                        </div>
                        <div class="col-sm-1">
                            <a class="btn delete-mandate btn-danger mt-4"><i
                                    class="icon-close"></i></a>
                        </div> `
    // let formFields = $(this).parent().find('.row').html();
    $(formFields).insertBefore($(this));
    refreshElement()
});

function refreshElement() {
    $('select').select2({
        width: '100%'
    });
    $('.delete-element').on('click', function () {
        $(this).parent().remove();
    });
    $('.delete-mandate').on('click', function () {
        $(this).parent().parent().remove();
    });
}
