function generateCardNo(x) {
    if(!x) { x = 16; }
    chars = "1234567890";
    no = "";
    for (var i=0; i<x; i++) {
        var rnum = Math.floor(Math.random() * chars.length);
        no += chars.substring(rnum,rnum+1);
    }
    return no;
}
function roundNumber(number, toref) {
    switch(toref) {
        case 1:
            var rn = formatDecimal(Math.round(number * 20)/20);
            break;
        case 2:
            var rn = formatDecimal(Math.round(number * 2)/2);
            break;
        case 3:
            var rn = formatDecimal(Math.round(number));
            break;
        case 4:
            var rn = formatDecimal(Math.ceil(number));
            break;
        default:
            var rn = number;
    }
    return rn;
}
function getNumber(x) {
    return accounting.unformat(x);
}
function formatNumber(x) {
    return accounting.formatNumber(x, Settings.decimals, Settings.thousands_sep == 0 ? ' ' : Settings.thousands_sep, Settings.decimals_sep);
}
function formatMoney(x, symbol) {
    if(!symbol) { symbol = ""; }
    return accounting.formatMoney(x, symbol, Settings.decimals, Settings.thousands_sep == 0 ? ' ' : Settings.thousands_sep, Settings.decimals_sep, "%s%v");
}
function formatDecimal(x) {
    return parseFloat(parseFloat(x).toFixed(Settings.decimals));
}
function is_valid_discount(mixed_var) {
    return (is_numeric(mixed_var) || (/([0-9]%)/i.test(mixed_var))) ? true : false;
}
function is_numeric(mixed_var) {
    var whitespace =
        " \n\r\t\f\x0b\xa0\u2000\u2001\u2002\u2003\u2004\u2005\u2006\u2007\u2008\u2009\u200a\u200b\u2028\u2029\u3000";
    return (typeof mixed_var === 'number' || (typeof mixed_var === 'string' && whitespace.indexOf(mixed_var.slice(-1)) === -
            1)) && mixed_var !== '' && !isNaN(mixed_var);
}
function is_float(mixed_var) {
    return +mixed_var === mixed_var && (!isFinite(mixed_var) || !! (mixed_var % 1));
}
function currencyFormat(x) {
    if (x != null) {
        return '<div class="text-right">'+formatMoney(x)+'</div>';
    } else {
        return '<div class="text-right">0</div>';
    }
}

function read_card() {
    $('.swipe').keypress( function (e) {

        var payid = $(this).attr('id'),
            id = payid.substr(payid.length - 1);
        var TrackData = $(this).val();
        if (e.keyCode == 13) {
            e.preventDefault();

            var p = new SwipeParserObj(TrackData);

            if(p.hasTrack1)
            {
                // Populate form fields using track 1 data
                var CardType = null;
                var ccn1 = p.account.charAt(0);
                if(ccn1 == 4)
                    CardType = 'Visa';
                else if(ccn1 == 5)
                    CardType = 'MasterCard';
                else if(ccn1 == 3)
                    CardType = 'Amex';
                else if(ccn1 == 6)
                    CardType = 'Discover';
                else
                    CardType = 'Visa';

                $('#pcc_no_'+id).val(p.account);
                $('#pcc_holder_'+id).val(p.account_name);
                $('#pcc_month_'+id).val(p.exp_month);
                $('#pcc_year_'+id).val(p.exp_year);
                $('#pcc_cvv2_'+id).val('');
                $('#pcc_type_'+id).val(CardType);

            }
            else
            {
                $('#pcc_no_'+id).val('');
                $('#pcc_holder_'+id).val('');
                $('#pcc_month_'+id).val('');
                $('#pcc_year_'+id).val('');
                $('#pcc_cvv2_'+id).val('');
                $('#pcc_type_'+id).val('');
            }

            $('#pcc_cvv2_'+id).focus();
        }

    }).blur(function (e) {
        $(this).val('');
    }).focus( function (e) {
        $(this).val('');
    });
}

function get(name) {
    if (typeof (Storage) !== "undefined") {
        return localStorage.getItem(name);
    } else {
        alert('Please use a modern browser as this site needs localstroage!');
    }
}

function store(name, val) {
    if (typeof (Storage) !== "undefined") {
        localStorage.setItem(name, val);
    } else {
        alert('Please use a modern browser as this site needs localstroage!');
    }
}

function remove(name) {
    if (typeof (Storage) !== "undefined") {
        localStorage.removeItem(name);
    } else {
        alert('Please use a modern browser as this site needs localstroage!');
    }
}

function hrsd(sdate) {
    if (sdate !== null) {
        return date(dateformat, strtotime(sdate));
    }
    return sdate;
}

function hrld(ldate) {
    if (ldate !== null) {
        return date(dateformat+' '+timeformat, strtotime(ldate));
    }
    return ldate;
}

$(document).ajaxStart(function(){
    $('#ajaxCall').show();
}).ajaxStop(function(){
    $('#ajaxCall').hide();
});

$(document).ready(function() {
    $('.load_suspended').click(function(event) {
        event.preventDefault();
        var href = $(this).attr('href');
        if(get('spositems')) {
            bootbox.confirm(lang.r_u_sure, function(result) {
                if(result == true) {
                    window.location.href = href;
                }
            });
            return false;
        } else {
            window.location.href = href;
        }
    });
});
