let width = $(window).width();
// document.documentElement.style.setProperty("--primary", "#FF0000");
$(window).resize(function () {
    width = $(window).width();
});

// Side Menu
$('header').hover(
    function () {
        if (width > 990) {
            $(this).addClass('extended');
            $(this).parent().addClass('open-menu');
            $('.menu-backdrop').addClass('visible');
        }
    },
    function () {
        if (width > 990) {
            $(this).removeClass('extended');
            $(this).parent().removeClass('open-menu');
            $('.menu-backdrop').removeClass('visible');
        }
    }
);
$('.parent').hover(function () {
    $(this).toggleClass('sub-active');
});

// Mobile Menu Js
$('.hamburger').click(function () {
    $(this).toggleClass('open');
    $('header').toggleClass('active');
    $('.menu-backdrop').toggleClass('visible');
});

// On Menu Backdrop Click
$('.menu-backdrop').click(function () {
    $('.menu-backdrop').removeClass('visible');
    $('header').removeClass('active');
    $('.hamburger').removeClass('open');
});

// On Input file click
$('input[type="file"]').change(function (e) {
    const fileName = e.target.files[0].name;
    // $(this).parent().after(function () {
    //     return '<small class="form-text text-muted">' + fileName + '</small>';
    // })
    $(this).parent().addClass('hasValue');
    $(this).next().find('.value').html(fileName);

});

$(".delete-icon").on("click", function (e) {
    e.preventDefault();
    $(this).parent().removeClass('hasValue');
    $(this).parent().find('input').val('');
    $(this).next().find('.value').html("");
})

$('input[name="date"]').daterangepicker({
    singleDatePicker: true,
});

$('select').select2({
    width: '100%',
    minimumResultsForSearch: 5,
    //dropdownAutoWidth: true, width: 'auto'
});



$('.add-more-btn').on('click', function () {
    $('select').select2('destroy');
    let formFields = $(this).parent().find('.inline-form').html();
    $('<div class="inline-form">' + formFields + '</div>').insertBefore($(this));
    setTimeout(() => {
        let height = $('form.active').height();
        $('.step-forms').css('height', height + 'px');
    }, 500);

    refreshElement()
});




var a = ['', 'one ', 'two ', 'three ', 'four ', 'five ', 'six ', 'seven ', 'eight ', 'nine ', 'ten ', 'eleven ', 'twelve ', 'thirteen ', 'fourteen ', 'fifteen ', 'sixteen ', 'seventeen ', 'eighteen ', 'nineteen '];
var b = ['', '', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety'];

function inWords(num) {
    if ((num = num.toString()).length > 9) return 'overflow';
    n = ('000000000' + num).substr(-9).match(/^(\d{2})(\d{2})(\d{2})(\d{1})(\d{2})$/);
    if (!n) return; var str = '';
    str += (n[1] != 0) ? (a[Number(n[1])] || b[n[1][0]] + ' ' + a[n[1][1]]) + 'crore ' : '';
    str += (n[2] != 0) ? (a[Number(n[2])] || b[n[2][0]] + ' ' + a[n[2][1]]) + 'lakh ' : '';
    str += (n[3] != 0) ? (a[Number(n[3])] || b[n[3][0]] + ' ' + a[n[3][1]]) + 'thousand ' : '';
    str += (n[4] != 0) ? (a[Number(n[4])] || b[n[4][0]] + ' ' + a[n[4][1]]) + 'hundred ' : '';
    str += (n[5] != 0) ? ((str != '') ? 'and ' : '') + (a[Number(n[5])] || b[n[5][0]] + ' ' + a[n[5][1]]) : '';
    return str;
}


// $('.amount').on('keyup', function (event) {
//     // skip for arrow keys
//     if (event.which >= 37 && event.which <= 40) {
//         event.preventDefault();
//     }
//     $(this).val(function (index, value) {
//         return value
//             .replace(/\D/g, "")
//             .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",")
//             ;
//     });
//     let value = $(this).val().replace(/,/g, "");
//     let editedvalue = inWords(value);
//     $(this).next().html(editedvalue);
// });

// Custom Single Select
$('.customSingle .data-list a').on('click', function () {
    $(this).parent().find('a').removeClass('selected');
    $(this).addClass('selected');
    let text = $(this).html();
    $(this).parent().parent().prev().html(text);
});
// Custom Single Select Search
$(".search-input").on("keyup", function () {
    var value = $(this).val().toLowerCase();
    $(this).next().find('a').filter(function () {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
});

$(".customMulti .data-list a").on('click', function (e) {
    e.stopPropagation();
    var selected = [];
    var list = $(this).parent();
    var origOrder = list.children().not('hr');;
    var i;
    var checked = document.createDocumentFragment();
    var unchecked = document.createDocumentFragment();
    for (i = 0; i < origOrder.length; i++) {
        if (origOrder[i].getElementsByTagName("input")[0].checked) {
            checked.appendChild(origOrder[i]);
            selected.push(origOrder[i].getElementsByTagName("input")[0].value);
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


$('.table-options .searchinput-wrapper input').on('focus', function () {
    $(this).parent().parent().addClass('active');
});

$('.table-options .searchinput-wrapper input').on('blur', function () {
    $(this).parent().parent().removeClass('active');
})
