function validateNumber(event) {
    var key = window.event ? event.keyCode : event.which;

    if (event.keyCode === 8 || event.keyCode === 46) {
        return true;
    } else if (key < 48 || key > 57) {
        return false;
    } else {
        return true;
    }
};

function validateAadharNumber(event)
{
    var key = window.event ? event.keyCode : event.which;
    if (event.keyCode === 8 || event.keyCode === 46) {
        return true;
    } else if (key < 48 || key > 57) {
        return false;
    } else {
        if (event.target.value.length < 12) { return true; } else { return false; }
    }
}

function validatePincode(event) {
    var key = window.event ? event.keyCode : event.which;
    if (event.keyCode === 8 || event.keyCode === 46) {
        return true;
    } else if (key < 48 || key > 57) {
        return false;
    } else {
        if (event.target.value.length < 6) { return true; } else { return false; }
    }
};

function validateChequeNo(event) {
    var key = window.event ? event.keyCode : event.which;
    if (event.keyCode === 8 || event.keyCode === 46) {
        return true;
    } else if (key < 48 || key > 57) {
        return false;
    } else {
        if (event.target.value.length < 6) { return true; } else { return false; }
    }
};

function validateARN_EUIN(event) {
    var key = window.event ? event.keyCode : event.which;
    if (event.keyCode === 8 || event.keyCode === 46) {
        return true;
    } else if (key < 48 || key > 57) {
        return false;
    } else {
        if (event.target.value.length < 6) { return true; } else { return false; }
    }
};

function validatePhone(event) {
    var key = window.event ? event.keyCode : event.which;
    if (event.keyCode === 8 || event.keyCode === 46) {
        return true;
    } else if (key < 48 || key > 57) {
        return false;
    } else {
        if (event.target.value.length < 12) { return true; } else { return false; }
    }
};

function validateAccountNumber(event) {
    var key = window.event ? event.keyCode : event.which;

    if (event.keyCode === 8 || event.keyCode === 46) {console.log('1');
        return true;
    } else if (key < 48 || key > 57) {console.log('2');
        return false;
    } else {console.log('3');
        if (event.target.value.length < 20) { return true; } else { return false; }
    }
};

function validateName(event) {

    var key = window.event ? event.keyCode : event.which;

    if (event.keyCode === 8 || event.keyCode === 46) {
        return false;
    } else if (key < 48 || key > 57) {
        return true;
    } else {
        return false;
    }
};

function validateMobile(event) {

    var key = window.event ? event.keyCode : event.which;
    var length = event.target.value.length;
    var value = event.target.value;
    if (event.keyCode === 8 || event.keyCode === 46) {
        return true;
    } else if (key < 48 || key > 57) {
        return false;
    } else {
        if (length < 10) {
            if (length == 1) {
                if (value == 0 || value == 1 || value == 2 || value == 3 || value == 4 || value == 5) {
                    return false;
                }
            }
            return true;
        } else { return false; }
    }
}

function validateMobileFirst(event) {

    var key = window.event ? event.keyCode : event.which;
    var length = event.target.value.length;
    var value = event.target.value;
    if(length == 1)
    {
        if(value == 0 || value == 1 || value == 2 || value == 3 || value == 4 || value == 5)
        {
            $(this).val('');
            return false;
        }
        return true;
    }
}
function validateAddress(e) {
    var tval = e.target.value,
        tlength = e.target.value.length,
        set = 40,
        remain = parseInt(set - tlength);

    if (remain <= 0 && e.which !== 0 && e.charCode !== 0) {
        return false;
    }
}

function calculateAge($date)
{
    console.log($date);
    var GivenDate = $date;
    var date = GivenDate.substring(0, 2);
    var month = GivenDate.substring(3, 5);
    var year = GivenDate.substring(6, 10);
    var today = new Date();
    var birthDate = new Date(year, month - 1, date);
    var age = today.getFullYear() - birthDate.getFullYear();
    var m = today.getMonth() - birthDate.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }
    return age
}

function validatePanNo(e)
{
    var tval = e.target.value,
        tlength = e.target.value.length,
        set = 10,
        remain = parseInt(set - tlength);

    if (remain <= 0 && e.which !== 0 && e.charCode !== 0) {
        return false;
    }
}

function validatePanCharacter(e)
{
    // var regex = /[A-Z]{5}[0-9]{4}[A-Z]{1}$/;
    //return regex.test(pan);

    var tval = e.target.value;
    var tlength = e.target.value.length;
    var PAN_Card_No = tval.toUpperCase();
    var regex6 = /([A-Z]){5}([0-9]){1}$/;
    var regex7 = /([A-Z]){5}([0-9]){2}$/;
    var regex8 = /([A-Z]){5}([0-9]){3}$/;
    var regex9 = /([A-Z]){5}([0-9]){4}$/;
    var regex = /([A-Z]){5}([0-9]){4}([A-Z]){1}$/;

    if(tlength <=5)
    {
        var regexp = /[^a-zA-Z]/g;
        if($(this).val().match(regexp)){
            $(this).val( $(this).val().replace(regexp,'') );
        }

    }else if(tlength > 5 && tlength < 10){
        if(tlength == 6)
        {
            if (!PAN_Card_No.match(regex6)) {
                $(this).val(tval.slice(0, -1));
            }
        }
        if(tlength == 7)
        {
            if (!PAN_Card_No.match(regex7)) {
                $(this).val(tval.slice(0, -1));
            }
        }
        if(tlength == 8)
        {
            if (!PAN_Card_No.match(regex8)) {
                $(this).val(tval.slice(0, -1));
            }
        }
        if(tlength == 9)
        {
            if (!PAN_Card_No.match(regex9)) {
                $(this).val(tval.slice(0, -1));
            }
        }


    }else if(tlength == 10){
        if (!PAN_Card_No.match(regex)) {
            $(this).val(tval.slice(0, -1));
        }
    }

}

function validateGstNo(e)
{
    var tval = e.target.value,
        tlength = e.target.value.length,
        set = 15,
        remain = parseInt(set - tlength);

    if (remain <= 0 && e.which !== 0 && e.charCode !== 0) {
        return false;
    }
}

function validateTenNo(event) {

    var key = window.event ? event.keyCode : event.which;
    if (event.keyCode === 8 || event.keyCode === 46) {
        return true;
    } else if (key < 48 || key > 57) {
        return false;
    } else {
        if (event.target.value.length < 10) { return true; } else { return false; }
    }
}

function validateSEBI_RIA(event) {

    var key = window.event ? event.keyCode : event.which;
    if (event.keyCode === 8 || event.keyCode === 46) {
        return true;
    } else if (key < 48 || key > 57) {
        return false;
    } else {
        if (event.target.value.length < 9) { return true; } else { return false; }
    }
}

$('.amount').on('keyup', function (event) {
    // skip for arrow keys
    if (event.which >= 37 && event.which <= 40) {
        event.preventDefault();
    }
    $(this).val(function (index, value) {
        return value
            .replace(/\D/g, "")
            .replace(/(\d)(?=(\d\d)+\d$)/g, "$1,");
    });
    let value = $(this).val().replace(/,/g, "");
    let editedvalue = inWords(value);

    //$(this).next().html(editedvalue);
});


function currency(amt)
{
    amt=amt.toString();
    var lastThree = amt.substring(amt.length-3);
    var otherNumbers = amt.substring(0,amt.length-3);
    if(otherNumbers != '')
        lastThree = ',' + lastThree;
    var res = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree;
    return res;
}

function round(value, exp)
{
    if (typeof exp === 'undefined' || +exp === 0)
      return Math.round(value);

    value = +value;
    exp = +exp;

    if (isNaN(value) || !(typeof exp === 'number' && exp % 1 === 0))
      return NaN;

    // Shift
    value = value.toString().split('e');
    value = Math.round(+(value[0] + 'e' + (value[1] ? (+value[1] + exp) : exp)));

    // Shift back
    value = value.toString().split('e');
    return +(value[0] + 'e' + (value[1] ? (+value[1] - exp) : -exp));
}

function round2Fixed(value)
{
    value = +value;

    if (isNaN(value))
        return NaN;

    // Shift
    value = value.toString().split('e');
    value = Math.round(+(value[0] + 'e' + (value[1] ? (+value[1] + 2) : 2)));

    // Shift back
    value = value.toString().split('e');
    return (+(value[0] + 'e' + (value[1] ? (+value[1] - 2) : -2))).toFixed(2);
}
