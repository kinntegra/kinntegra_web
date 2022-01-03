var formLength = $('.step-forms .trial').length;
$(window).on('load', function () {
    //let height = $('.step-forms .active').height();
    //$('.step-forms').css('height', height + 'px');
    $('input[name="birthdate"]').datepicker({
        autoclose: true,
        format: "dd-mm-yyyy"
    });
});

$('.step-forms .trial button.proceed').click(function (e) {
    e.preventDefault();
    $('#loading').show();
    //$(document).scrollTop(0);
    let isAccount = $('#introduction:visible #proceed-to').val() == 'account';
    let current = '';

    if($(this).parent().hasClass('trial'))
    {
        current = $(this).parent();
    }else{
        current = $(this).parent().closest('section.trial');
    }

    let proceedto = $( "select#proceedto option:selected" ).val();
    if(proceedto == 1)
    {
        window.location.href = '/client/comprehensive';
    }
    if(proceedto == 2)
    {
        window.location.href = '/client/kycinformation';
    }

    $('#loading').hide();
    return false;
});

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
    // let types = $('#accounttype').children().find('input:checked').map(function(i, e) {return e.value}).toArray();
    // console.log(types);
});
//

let count = 1;
var company_count = 1;

        $('form').each(function () {
            $(this).validate();
        });
        $('.add-member').click(function () {
            let allData = false;
            let data = {};
            $('.addTab input,.addTab select').each(function () {
                if ($(this).val() == "") {

                    allData = false;
                    return false;
                } else {
                    allData = true;
                    data[$(this).attr('id') + count] = $(this).val();
                }
            });
            //console.log(data);
            if (allData) {
                data['member_count'] = count;
                let prependData = $.get("/client/introduction", data, function(data1, status){
                    //console.log(data);
                    // let headData = '<li class="nav-item mb-3" role="presentation" data-count="' + count + '">\
                    //                 <a class="nav-link"  id="member-tab_' + count + '"\
                    //                     data-toggle="tab"  href="#member' + count + '" role="tab"\
                    //                      aria-selected="false">' + data[
                    // 'name' + count] + '</a>\
                    // <span class="remove-member"><i class="icon-close"></i></span></li>';
                    $(data1[1]).insertBefore('.add-member-item');
                    $("#family-tab").prepend(data1[0]);
                    $('#member-taxstatus_' + count).val(data['taxstatus' + count]);
                    $('#member-taxslab_' + count).val(data['taxslab' + count]);
                    $('#member-relation_' + count).val(data['relation' + count]);
                    count = count + 1;
                    $('.addTab input,.addTab select').each(function () {
                        $(this).val("");
                    });
                    $("#relation").val('').trigger('change');
                    $("#taxstatus").val('').trigger('change');
                    $("#taxslab").val('').trigger('change');
                    input();
            });
                //   $.get(
                //     "result.php",
                //     { name: "Zara" },
                //     function(data) {
                //        $('#stage').html(data);
                //     }
                //  );
                // let prependData = '<div class="tab-pane fade" id="member' + count +
                //     '" role="tabpanel" aria-labelledby="member-tab_' + count + '">\
                //     <div class="row">\
                //         <div class="col-sm-4 member-name_' + count + '">\
                //             <div class="form-group">\
                //                 <label for="member-name_' + count + '">Name</label>\
                //                 <input type="text" class="form-control member-name" data-count="' + count +
                //     '" data-target="member' + count +
                //     '" id="member-name_' + count + '" name="member-name_' + count + '"\
                //                     placeholder="Enter Name" value="' + data['name' + count] + '" />\
                //             </div>\
                //         </div>\
                //         <div class="col-sm-4 member-birthdate_' + count + '">\
                //             <div class="form-group">\
                //                 <label for="member-birthdate_' + count + '">Date of Birth</label>\
                //                 <input type="text" name="member-birthdate_' + count + '" class="form-control" id="member-birthdate_' + count + '"\
                //                     placeholder="Enter Name" value="' + data['birthdate' + count] + '" />\
                //             </div>\
                //         </div>\
                //         <div class="col-sm-4 member-relation_' + count + '">\
                //             <div class="form-group">\
                //                 <label for="member-relation_' + count + '">Relation</label>\
                //                 <div class="select-wrapper">\
                //                     <select class="form-control" id="member-relation_' + count + '" name="member-relation_' + count + '" >\
                //                         <option value="" disabled selected>Select Relation</option>\
                //                         <option value="Brother">Brother</option>\
                //                         <option value="Father">Father</option>\
                //                     </select>\
                //                 </div>\
                //             </div>\
                //         </div>\
                //         <div class="col-sm-4 member-taxstatus_' + count + '">\
                //             <div class="form-group">\
                //                 <label for="member-taxstatus_' + count + '">Tax Status</label>\
                //                 <div class="select-wrapper">\
                //                     <select class="form-control tax-slab" id="member-taxstatus_' + count + '" name="member-taxstatus_' + count + '">\
                //                         <option value="" disabled selected>Select Tax Status</option>\
                //                         <option value="50">50%</option>\
                //                     </select>\
                //                 </div>\
                //             </div>\
                //         </div>\
                //         <div class="col-sm-4 member-taxslab_' + count + '">\
                //             <div class="form-group">\
                //                 <label for="member-taxslab_' + count + '">Tax Slab</label>\
                //                 <div class="select-wrapper">\
                //                     <select class="form-control tax-slab" id="member-taxslab_' + count + '" name="member-taxslab_' + count + '">\
                //                         <option value="" disabled selected>Select Tax Slab</option>\
                //                         <option value="50">50%</option>\
                //                     </select>\
                //                 </div>\
                //             </div>\
                //         </div>\
                //         <div class="col-sm-4 member-lifeexpectancy_' + count + '">\
                //             <div class="form-group">\
                //                 <label for="member-lifeexpectancy_' + count + '">Life Expectancy</label>\
                //                 <input type="text" class="form-control"\
                //                 id="member-lifeexpectancy_' + count + '" name="member-lifeexpectancy_' + count + '" placeholder="Enter Life Expectancy" value="' +
                //     data['lifeexpectancy' + count] + '" />\
                //             </div>\
                //         </div>\
                //     </div>\
                // </div>';



                // let headData = '<li class="nav-item mb-3" role="presentation" data-count="' + count + '">\
                //                     <a class="nav-link"  id="member-tab_' + count + '"\
                //                         data-toggle="tab"  href="#member' + count + '" role="tab"\
                //                          aria-selected="false">' + data[
                //     'name' + count] + '</a>\
                //     <span class="remove-member"><i class="icon-close"></i></span></li>';
                // $(headData).insertBefore('.add-member-item');
                // $("#family-tab").prepend(prependData);
                // $('#member-taxstatus_' + count).val(data['taxstatus' + count]);
                // $('#member-taxslab_' + count).val(data['taxslab' + count]);
                // $('#member-relation_' + count).val(data['relation' + count]);
                // count = count + 1;
                // $('.addTab input,.addTab select').each(function () {
                //     $(this).val("");
                // });
                // $("#relation").val('').trigger('change');
                // $("#taxstatus").val('').trigger('change');
                // $("#taxslab").val('').trigger('change');
                // input();
            }
        });

        $('.add-company').click(function () {
            let allCompanyData = false;
            let data = {};
            $('.addCompanyTab input,.addCompanyTab select').each(function () {
                if ($(this).val() == "") {

                    allCompanyData = false;
                    return false;
                } else {
                    allCompanyData = true;
                    data[$(this).attr('id') + company_count] = $(this).val();
                }
            });
            console.log(data);

            if (allCompanyData) {
                let prependData = '<div class="tab-pane fade" id="company' + company_count +
                    '" role="tabpanel" aria-labelledby="company-tab_' + company_count + '">\
                    <div class="row">\
                        <div class="col-sm-4 company-name_' + company_count + '">\
                            <div class="form-group">\
                                <label for="company-name_' + company_count + '">Name</label>\
                                <input type="text" class="form-control company-name" data-count="' + company_count +
                    '" data-target="company' + company_count +
                    '" id="company-name_' + company_count + '" name="company-name_' + company_count + '"\
                                    placeholder="Enter Name" value="' + data['cname' + company_count] + '" />\
                            </div>\
                        </div>\
                        <div class="col-sm-4 company-incorpdate_' + company_count + '">\
                            <div class="form-group">\
                                <label for="company-incorpdate_' + company_count + '">Date of Incorporation</label>\
                                <input type="text" name="company-incorpdate_' + company_count + '" class="form-control" id="company-incorpdate_' + company_count + '"\
                                    placeholder="Enter Name" value="' + data['cincorpdate' + company_count] + '" />\
                            </div>\
                        </div>\
                        <div class="col-sm-4 company-entitytype_' + company_count + '">\
                            <div class="form-group">\
                                <label for="company-entitytype_' + company_count + '">Entity Type</label>\
                                <div class="select-wrapper">\
                                    <select class="form-control" id="company-entitytype_' + company_count + '" name="company-entitytype_' + company_count + '" >\
                                        <option value="" disabled selected>Select Entity Type</option>\
                                        <option value="huf">HUF</option>\
                                        <option value="trust">Trust</option>\
                                    </select>\
                                </div>\
                            </div>\
                        </div>\
                        <div class="col-sm-4 company-taxslab_' + company_count + '">\
                            <div class="form-group">\
                                <label for="company-taxslab_' + company_count + '">Tax Slab</label>\
                                <div class="select-wrapper">\
                                    <select class="form-control tax-slab" id="company-taxslab_' + company_count + '" name="company-taxslab_' + company_count + '">\
                                        <option value="" disabled selected>Select Tax Slab</option>\
                                        <option value="50">50%</option>\
                                    </select>\
                                </div>\
                            </div>\
                        </div>\
                        <div class="col-sm-12">\
                            <h4 class="form-section-title text-uppercase">AUTHORIZED Personel Details</h4>\
                        </div>\
                        <div class="col-sm-4 company-authname1_' + company_count + '">\
                            <div class="form-group">\
                                <label for="company-authname1_' + company_count + '">AUTHORIZED SIGNITORY NAME - 1</label>\
                                <input type="text" class="form-control"\
                                id="company-authname1_' + company_count + '" name="company-authname1_' + company_count + '" placeholder="Enter Life Expectancy" value="' +
                    data['cauthname1' + company_count] + '" />\
                            </div>\
                        </div>\
                        <div class="col-sm-4 company-authdesignation1_' + company_count + '">\
                            <div class="form-group">\
                                <label for="company-authdesignation1_' + company_count + '">Designation</label>\
                                <input type="text" class="form-control"\
                                id="company-authdesignation1_' + company_count + '" name="company-authdesignation1_' + company_count + '" placeholder="Enter Life Expectancy" value="' +
                    data['cauthdesignation1' + company_count] + '" />\
                            </div>\
                        </div>\
                        <div class="col-sm-12"></div>\
                        <div class="col-sm-4 company-authname2_' + company_count + '">\
                            <div class="form-group">\
                                <label for="company-authname2_' + company_count + '">AUTHORIZED SIGNITORY NAME - 2</label>\
                                <input type="text" class="form-control"\
                                id="company-authname2_' + company_count + '" name="company-authname2_' + company_count + '" placeholder="Enter Life Expectancy" value="' +
                    data['cauthname2' + company_count] + '" />\
                            </div>\
                        </div>\
                        <div class="col-sm-4 company-authdesignation2_' + company_count + '">\
                            <div class="form-group">\
                                <label for="company-authdesignation2_' + company_count + '">Designation</label>\
                                <input type="text" class="form-control"\
                                id="company-authdesignation2_' + company_count + '" name="company-authdesignation2_' + company_count + '" placeholder="Enter Life Expectancy" value="' +
                    data['cauthdesignation2' + company_count] + '" />\
                            </div>\
                        </div>\
                    </div>\
                </div>';
                let headData = '<li class="nav-item mb-3" role="presentation" data-count="' + company_count + '">\
                                    <a class="nav-link"  id="company-tab_' + company_count + '"\
                                        data-toggle="tab"  href="#company' + company_count + '" role="tab"\
                                         aria-selected="false">' + data[
                    'cname' + company_count] + '</a>\
                    <span class="remove-company"><i class="icon-close"></i></span></li>';
                $(headData).insertBefore('.add-company-item');
                console.log(data['ctaxstatus' + company_count]);
                $("#company-tab").prepend(prependData);
                $('#company-taxslab_' + company_count).val(data['ctaxslab' + company_count]);
                $('#company-entitytype_' + company_count).val(data['ctaxstatus' + company_count]);
                company_count = company_count + 1;
                $('.addCompanyTab input,.addCompanyTab select').each(function () {
                    $(this).val("");
                });
                $("#ctaxslab").val('').trigger('change');
                $("#ctaxstatus").val('').trigger('change');
                input();
            }
        });

        // var table = $('table').DataTable({
        //     bInfo: false,
        //     sDom: 'lrtip',
        //     bLengthChange: false,
        //     retrieve: true,
        //     autoWidth: false,
        // });
        $('input[name="birthdate"], input[name="cincorpdate"]').datepicker({
            autoclose: true
        });

        $("#lifeexpectancy").blur(function () {
            $(".add-member").trigger('click');
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
            $('input[name="birthdate"], input[name="cincorpdate"]').datepicker({
                autoclose: true
            });
        }


        //==============================================================================================//
        //OLD
        //==============================================================================================//
        var formLength = $('.step-forms .trial').length;
$(window).on('load', function () {
    //let height = $('.step-forms .active').height();
    //$('.step-forms').css('height', height + 'px');
    $('input[name="birthdate"]').datepicker({
        autoclose: true,
        format: "dd-mm-yyyy"
    });
});

$('.step-forms .trial button.proceed').click(function (e) {
    e.preventDefault();
    $('#loading').show();
    //$(document).scrollTop(0);
    let isAccount = $('#introduction:visible #proceed-to').val() == 'account';
    let current = '';

    if($(this).parent().hasClass('trial'))
    {
        current = $(this).parent();
    }else{
        current = $(this).parent().closest('section.trial');
    }

    let proceedto = $( "select#proceedto option:selected" ).val();
    if(proceedto == 1)
    {
        window.location.href = '/client/comprehensive';
    }
    if(proceedto == 2)
    {
        window.location.href = '/client/kycinformation';
    }

    $('#loading').hide();
    return false;
});

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
    // let types = $('#accounttype').children().find('input:checked').map(function(i, e) {return e.value}).toArray();
    // console.log(types);
});
//

var count = 1;
var company_count = 1;

        $('form').each(function () {
            $(this).validate();
        });
        $('.add-member').click(function () {
            let allData = false;
            let data = {};
            $('.addTab input,.addTab select').each(function () {
                if ($(this).val() == "") {

                    allData = false;
                    return false;
                } else {
                    allData = true;
                    data[$(this).attr('id') + count] = $(this).val();
                }
            });
            console.log(data);
            if (allData) {
                let prependData = '<div class="tab-pane fade" id="member' + count +
                    '" role="tabpanel" aria-labelledby="member-tab_' + count + '">\
                    <div class="row">\
                        <div class="col-sm-4 member-name_' + count + '">\
                            <div class="form-group">\
                                <label for="member-name_' + count + '">Name</label>\
                                <input type="text" class="form-control member-name" data-count="' + count +
                    '" data-target="member' + count +
                    '" id="member-name_' + count + '" name="member-name_' + count + '"\
                                    placeholder="Enter Name" value="' + data['name' + count] + '" />\
                            </div>\
                        </div>\
                        <div class="col-sm-4 member-birthdate_' + count + '">\
                            <div class="form-group">\
                                <label for="member-birthdate_' + count + '">Date of Birth</label>\
                                <input type="text" name="member-birthdate_' + count + '" class="form-control" id="member-birthdate_' + count + '"\
                                    placeholder="Enter Name" value="' + data['birthdate' + count] + '" />\
                            </div>\
                        </div>\
                        <div class="col-sm-4 member-relation_' + count + '">\
                            <div class="form-group">\
                                <label for="member-relation_' + count + '">Relation</label>\
                                <div class="select-wrapper">\
                                    <select class="form-control" id="member-relation_' + count + '" name="member-relation_' + count + '" >\
                                        <option value="" disabled selected>Select Relation</option>\
                                        <option value="Brother">Brother</option>\
                                        <option value="Father">Father</option>\
                                    </select>\
                                </div>\
                            </div>\
                        </div>\
                        <div class="col-sm-4 member-taxstatus_' + count + '">\
                            <div class="form-group">\
                                <label for="member-taxstatus_' + count + '">Tax Status</label>\
                                <div class="select-wrapper">\
                                    <select class="form-control tax-slab" id="member-taxstatus_' + count + '" name="member-taxstatus_' + count + '">\
                                        <option value="" disabled selected>Select Tax Status</option>\
                                        <option value="50">50%</option>\
                                    </select>\
                                </div>\
                            </div>\
                        </div>\
                        <div class="col-sm-4 member-taxslab_' + count + '">\
                            <div class="form-group">\
                                <label for="member-taxslab_' + count + '">Tax Slab</label>\
                                <div class="select-wrapper">\
                                    <select class="form-control tax-slab" id="member-taxslab_' + count + '" name="member-taxslab_' + count + '">\
                                        <option value="" disabled selected>Select Tax Slab</option>\
                                        <option value="50">50%</option>\
                                    </select>\
                                </div>\
                            </div>\
                        </div>\
                        <div class="col-sm-4 member-lifeexpectancy_' + count + '">\
                            <div class="form-group">\
                                <label for="member-lifeexpectancy_' + count + '">Life Expectancy</label>\
                                <input type="text" class="form-control"\
                                id="member-lifeexpectancy_' + count + '" name="member-lifeexpectancy_' + count + '" placeholder="Enter Life Expectancy" value="' +
                    data['lifeexpectancy' + count] + '" />\
                            </div>\
                        </div>\
                    </div>\
                </div>';
                let headData = '<li class="nav-item mb-3" role="presentation" data-count="' + count + '">\
                                    <a class="nav-link"  id="member-tab_' + count + '"\
                                        data-toggle="tab"  href="#member' + count + '" role="tab"\
                                         aria-selected="false">' + data[
                    'name' + count] + '</a>\
                    <span class="remove-member"><i class="icon-close"></i></span></li>';
                $(headData).insertBefore('.add-member-item');
                $("#family-tab").prepend(prependData);
                $('#member-taxstatus_' + count).val(data['taxstatus' + count]);
                $('#member-taxslab_' + count).val(data['taxslab' + count]);
                $('#member-relation_' + count).val(data['relation' + count]);
                count = count + 1;
                $('.addTab input,.addTab select').each(function () {
                    $(this).val("");
                });
                $("#relation").val('').trigger('change');
                $("#taxstatus").val('').trigger('change');
                $("#taxslab").val('').trigger('change');
                input();
            }
        });

        $('.add-company').click(function () {
            let allCompanyData = false;
            let data = {};
            $('.addCompanyTab input,.addCompanyTab select').each(function () {
                if ($(this).val() == "") {

                    allCompanyData = false;
                    return false;
                } else {
                    allCompanyData = true;
                    data[$(this).attr('id') + company_count] = $(this).val();
                }
            });
            console.log(data);

            if (allCompanyData) {
                let prependData = '<div class="tab-pane fade" id="company' + company_count +
                    '" role="tabpanel" aria-labelledby="company-tab_' + company_count + '">\
                    <div class="row">\
                        <div class="col-sm-4 company-name_' + company_count + '">\
                            <div class="form-group">\
                                <label for="company-name_' + company_count + '">Name</label>\
                                <input type="text" class="form-control company-name" data-count="' + company_count +
                    '" data-target="company' + company_count +
                    '" id="company-name_' + company_count + '" name="company-name_' + company_count + '"\
                                    placeholder="Enter Name" value="' + data['cname' + company_count] + '" />\
                            </div>\
                        </div>\
                        <div class="col-sm-4 company-incorpdate_' + company_count + '">\
                            <div class="form-group">\
                                <label for="company-incorpdate_' + company_count + '">Date of Incorporation</label>\
                                <input type="text" name="company-incorpdate_' + company_count + '" class="form-control" id="company-incorpdate_' + company_count + '"\
                                    placeholder="Enter Name" value="' + data['cincorpdate' + company_count] + '" />\
                            </div>\
                        </div>\
                        <div class="col-sm-4 company-entitytype_' + company_count + '">\
                            <div class="form-group">\
                                <label for="company-entitytype_' + company_count + '">Entity Type</label>\
                                <div class="select-wrapper">\
                                    <select class="form-control" id="company-entitytype_' + company_count + '" name="company-entitytype_' + company_count + '" >\
                                        <option value="" disabled selected>Select Entity Type</option>\
                                        <option value="huf">HUF</option>\
                                        <option value="trust">Trust</option>\
                                    </select>\
                                </div>\
                            </div>\
                        </div>\
                        <div class="col-sm-4 company-taxslab_' + company_count + '">\
                            <div class="form-group">\
                                <label for="company-taxslab_' + company_count + '">Tax Slab</label>\
                                <div class="select-wrapper">\
                                    <select class="form-control tax-slab" id="company-taxslab_' + company_count + '" name="company-taxslab_' + company_count + '">\
                                        <option value="" disabled selected>Select Tax Slab</option>\
                                        <option value="50">50%</option>\
                                    </select>\
                                </div>\
                            </div>\
                        </div>\
                        <div class="col-sm-12">\
                            <h4 class="form-section-title text-uppercase">AUTHORIZED Personel Details</h4>\
                        </div>\
                        <div class="col-sm-4 company-authname1_' + company_count + '">\
                            <div class="form-group">\
                                <label for="company-authname1_' + company_count + '">AUTHORIZED SIGNITORY NAME - 1</label>\
                                <input type="text" class="form-control"\
                                id="company-authname1_' + company_count + '" name="company-authname1_' + company_count + '" placeholder="Enter Life Expectancy" value="' +
                    data['cauthname1' + company_count] + '" />\
                            </div>\
                        </div>\
                        <div class="col-sm-4 company-authdesignation1_' + company_count + '">\
                            <div class="form-group">\
                                <label for="company-authdesignation1_' + company_count + '">Designation</label>\
                                <input type="text" class="form-control"\
                                id="company-authdesignation1_' + company_count + '" name="company-authdesignation1_' + company_count + '" placeholder="Enter Life Expectancy" value="' +
                    data['cauthdesignation1' + company_count] + '" />\
                            </div>\
                        </div>\
                        <div class="col-sm-12"></div>\
                        <div class="col-sm-4 company-authname2_' + company_count + '">\
                            <div class="form-group">\
                                <label for="company-authname2_' + company_count + '">AUTHORIZED SIGNITORY NAME - 2</label>\
                                <input type="text" class="form-control"\
                                id="company-authname2_' + company_count + '" name="company-authname2_' + company_count + '" placeholder="Enter Life Expectancy" value="' +
                    data['cauthname2' + company_count] + '" />\
                            </div>\
                        </div>\
                        <div class="col-sm-4 company-authdesignation2_' + company_count + '">\
                            <div class="form-group">\
                                <label for="company-authdesignation2_' + company_count + '">Designation</label>\
                                <input type="text" class="form-control"\
                                id="company-authdesignation2_' + company_count + '" name="company-authdesignation2_' + company_count + '" placeholder="Enter Life Expectancy" value="' +
                    data['cauthdesignation2' + company_count] + '" />\
                            </div>\
                        </div>\
                    </div>\
                </div>';
                let headData = '<li class="nav-item mb-3" role="presentation" data-count="' + company_count + '">\
                                    <a class="nav-link"  id="company-tab_' + company_count + '"\
                                        data-toggle="tab"  href="#company' + company_count + '" role="tab"\
                                         aria-selected="false">' + data[
                    'cname' + company_count] + '</a>\
                    <span class="remove-company"><i class="icon-close"></i></span></li>';
                $(headData).insertBefore('.add-company-item');
                console.log(data['ctaxstatus' + company_count]);
                $("#company-tab").prepend(prependData);
                $('#company-taxslab_' + company_count).val(data['ctaxslab' + company_count]);
                $('#company-entitytype_' + company_count).val(data['ctaxstatus' + company_count]);
                company_count = company_count + 1;
                $('.addCompanyTab input,.addCompanyTab select').each(function () {
                    $(this).val("");
                });
                $("#ctaxslab").val('').trigger('change');
                $("#ctaxstatus").val('').trigger('change');
                input();
            }
        });

        // var table = $('table').DataTable({
        //     bInfo: false,
        //     sDom: 'lrtip',
        //     bLengthChange: false,
        //     retrieve: true,
        //     autoWidth: false,
        // });
        $('input[name="birthdate"], input[name="cincorpdate"]').datepicker({
            autoclose: true
        });

        $("#lifeexpectancy").blur(function () {
            $(".add-member").trigger('click');
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
            $('input[name="birthdate"], input[name="cincorpdate"]').datepicker({
                autoclose: true
            });
        }
