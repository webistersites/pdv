function add_invoice_item(item) {

    if (count == 1) {
        spositems = {};
    }
    if (item == null) {
        return;
    }

    var item_id = Settings.item_addition == 1 ? item.item_id : item.id;
    if (spositems[item_id]) {
        spositems[item_id].row.qty = parseFloat(spositems[item_id].row.qty) + 1;
    } else {
        spositems[item_id] = item;
    }

    store('spositems', JSON.stringify(spositems));
    loadItems();
    return true;
}

function loadItems() {
    if (count == 1) {
        spositems = {};
    }
    if (get('spositems')) {
        total = 0;
        count = 1;
        an = 1;
        product_tax = 0;
        invoice_tax = 0;
        product_discount = 0;
        order_discount = 0;
        total_discount = 0;

        $("#posTable tbody").empty();
        var time = ((new Date).getTime())/1000;
        if(Settings.java_applet == 1) {
            order_data = '';
            bill_data = '';
            bill_data += chr(27) + chr(69) + "\r" + chr(27) + "\x61" + "\x31\r";
            bill_data += Settings.site_name + "\n\n";
            order_data = bill_data;
            bill_data += "Bill" + "\n";
            order_data += "Order" + "\n";
            bill_data += date(Settings.dateformat+' '+Settings.timeformat, time)+ "\n";
            order_data += date(Settings.dateformat+' '+Settings.timeformat, time)+ "\n";
            //bill_data += $('#select2-chosen-1').text() + "\n\n";
            bill_data += " \x1B\x45\x0A\r\n ";
            //order_data += $('#select2-chosen-1').text() + "\n\n";
            order_data += " \x1B\x45\x0A\r\n ";
            bill_data += "\x1B\x61\x30";
            order_data += "\x1B\x61\x30";
        } else {
            $("#order_span").empty(); $("#bill_span").empty();
            var pos_head1 = '<span style="text-align:center;"><h3>'+Settings.site_name+'</h3>'
            //var pos_head2 = '</h4><h5>'+$('#select2-chosen-1').text()+'</h5></span>';
            var pos_head2 = '<h5>'+date(Settings.dateformat+' '+Settings.timeformat, time)+'</h5></span>'; //'</h4><h5>'+$('#select2-chosen-1').text()+'</h5></span>';
            $("#order_span").prepend(pos_head1+'<h4>Order</h4><h5>By: '+username+'</h5>'+pos_head2);
            $("#bill_span").prepend(pos_head1+'<h4>Bill</h4><h5>By: '+username+'</h5>'+pos_head2);
            $("#order-table").empty(); $("#bill-table").empty();
        }
        spositems = JSON.parse(get('spositems'));

        $.each(spositems, function () {

            var item = this;
            var item_id = Settings.item_addition == 1 ? item.item_id : item.id;
            spositems[item_id] = item;

            var product_id = item.row.id, item_type = item.row.type, item_tax_method = parseFloat(item.row.tax_method), combo_items = item.combo_items, item_qty = item.row.qty, item_aqty = parseFloat(item.row.quantity), item_type = item.row.type, item_ds = item.row.discount, item_code = item.row.code, item_name = item.row.name.replace(/"/g, "&#034;").replace(/'/g, "&#039;");
            var unit_price = parseFloat(item.row.real_unit_price);
            var net_price = unit_price;

            var ds = item_ds ? item_ds : '0';
            var item_discount = formatDecimal(ds);
            if (ds.indexOf("%") !== -1) {
                var pds = ds.split("%");
                if (!isNaN(pds[0])) {
                    item_discount = formatDecimal(parseFloat(((net_price) * parseFloat(pds[0])) / 100));
                }
            }
            product_discount += formatDecimal(item_discount * item_qty);
            net_price = formatDecimal(net_price-item_discount);

            var pr_tax = parseInt(item.row.tax), pr_tax_val = 0;
            if (pr_tax !== null && pr_tax != 0) {
                if(item_tax_method == 0) {
                    pr_tax_val = formatDecimal((net_price * parseFloat(pr_tax)) / (100+parseFloat(pr_tax)));
                    net_price -= pr_tax_val;
                    tax = lang.inclusive;
                } else {
                    pr_tax_val = formatDecimal((net_price * parseFloat(pr_tax)) / 100);
                    tax = lang.exclusive;
                }
            }
            product_tax += formatDecimal(pr_tax_val * item_qty);

            var row_no = (new Date).getTime();
            var newTr = $('<tr id="' + row_no + '" class="' + item_id + '" data-item-id="' + item_id + '"></tr>');
            tr_html = '<td><input name="product_id[]" type="hidden" class="rid" value="' + product_id + '"><button type="button" class="btn bg-purple btn-block btn-xs edit" id="' + row_no + '" data-item="' + item_id + '"><span class="sname" id="name_' + row_no + '">' + item_name + ' (' + item_code + ')</span></button></td>';
            // <input class="rprice" name="net_price[]" type="hidden" id="price_' + row_no + '" value="' + formatDecimal(item_price) + '">
            tr_html += '<td class="text-right"><input class="realuprice" name="real_unit_price[]" type="hidden" value="' + item.row.real_unit_price + '"><input class="rdiscount" name="product_discount[]" type="hidden" id="discount_' + row_no + '" value="' + ds + '"><span class="text-right sprice" id="sprice_' + row_no + '">' + formatMoney(parseFloat(net_price) + parseFloat(pr_tax_val)) + '</span></td>';
            tr_html += '<td><input class="form-control input-qty kb-pad text-center rquantity" name="quantity[]" type="text" value="' + formatDecimal(item_qty) + '" data-id="' + row_no + '" data-item="' + item_id + '" id="quantity_' + row_no + '" onClick="this.select();"></td>';
            tr_html += '<td class="text-right"><span class="text-right ssubtotal" id="subtotal_' + row_no + '">' + formatMoney(((parseFloat(net_price) + parseFloat(pr_tax_val)) * parseFloat(item_qty))) + '</span></td>';
            tr_html += '<td class="text-center"><i class="fa fa-trash-o tip pointer posdel" id="' + row_no + '" title="Remove"></i></td>';
            newTr.html(tr_html);
            newTr.prependTo("#posTable");
            total += formatDecimal((parseFloat(net_price) + parseFloat(pr_tax_val)) * parseFloat(item_qty));
            count += parseFloat(item_qty);
            an++;
            $('#list-table-div').scrollTop(0);
            if(item_type == 'standard' && item_qty > item_aqty) {
                $('#' + row_no).addClass('danger');
                $('#' + row_no).find('.edit').removeClass('bg-purple').addClass('btn-warning');
            }
            else if (item_type == 'combo') {
                if(combo_items === false) {
                    $('#' + row_no).addClass('danger');
                } else {
                    $.each(combo_items, function(){
                        if(parseFloat(this.quantity) < (parseFloat(this.qty)*item_qty)) {
                            $('#' + row_no).addClass('danger');
                            $('#' + row_no).find('.edit').removeClass('bg-purple').addClass('btn-warning');
                        }
                    });
                }
            }
            if(Settings.java_applet == 1) {
                bill_data += "#"+(an-1)+" "+ item_name + " (" + item_code + ")" + "\n";
                bill_data += printLine(item_qty + " x " + formatMoney(parseFloat(net_price) + parseFloat(pr_tax_val))+": "+ formatMoney(((parseFloat(net_price) + parseFloat(pr_tax_val)) * parseFloat(item_qty)))) + "\n";
                order_data += printLine("#"+(an-1)+" "+ item_name + " (" + item_code + "):"+ item_qty) + "\n";
            } else {
                var bprTr = '<tr class="row_' + item_id + '" data-item-id="' + item_id + '"><td colspan="2">#'+(an-1)+' '+ item_name + ' (' + item_code + ')</td></tr>';
                bprTr += '<tr class="row_' + item_id + '" data-item-id="' + item_id + '"><td>(' + item_qty + ' x ' + formatMoney(parseFloat(net_price) + parseFloat(pr_tax_val))+ ')</td><td style="text-align:right;">'+ formatMoney(((parseFloat(net_price) + parseFloat(pr_tax_val)) * parseFloat(item_qty))) +'</td></tr>';
                var oprTr = '<tr class="row_' + item_id + '" data-item-id="' + item_id + '"><td>#'+(an-1)+' ' + item_name + ' (' + item_code + ')</td><td>' + item_qty +'</td></tr>';
                $("#order-table").append(oprTr);
                $("#bill-table").append(bprTr);
            }
        });

        var ds = get('spos_discount') ? get('spos_discount') :
        ($('#discount_val').val() ? $('#discount_val').val() : '0');
        order_discount = parseFloat(ds);
        if(ds.indexOf("%") !== -1) {
            var pds = ds.split("%");
            order_discount = parseFloat((total*parseFloat(pds[0]))/100);
        }

        var ts = get('spos_tax') ? get('spos_tax') :
        ($('#tax_val').val() ? $('#tax_val').val() : '0');
        order_tax = parseFloat(ts);
        if(ts.indexOf("%") !== -1) {
            var pts = ts.split("%");
            order_tax = ((total-order_discount)*parseFloat(pts[0]))/100;
        }

        var g_total = total - parseFloat(order_discount) + parseFloat(order_tax);
        grand_total = formatMoney(g_total);
        $("#ds_con").text('('+formatMoney(product_discount)+') '+formatMoney(order_discount));
        $("#ts_con").text(formatMoney(order_tax));
        $("#total-payable").text(grand_total);
        $("#total").text(formatMoney(total));
        $("#count").text((an-1)+' ('+formatMoney(count-1)+')');

        if(Settings.java_applet == 1) {
            bill_data += "\n"+ printLine(lang.total+': '+ formatMoney(total)) +"\n";
            bill_data += printLine(lang.total_items+': '+ (an - 1) + ' (' + (parseFloat(count) - 1) + ')') +"\n";
            if(order_discount > 0) {
                bill_data += printLine(lang.discount+': '+ formatMoney(order_discount)) +"\n";
            }
            if (order_tax != 0) {
                bill_data += printLine(lang.order_tax+': '+ formatMoney(order_tax)) +"\n";
            }
            bill_data += printLine(lang.grand_total+': '+ formatMoney(g_total)) +"\n";
            if(Settings.rounding != 0) {
                round_total = roundNumber(g_total, parseInt(Settings.rounding));
                var rounding = formatDecimal(round_total - g_total);
                bill_data += printLine(lang.rounding+': '+ formatMoney(rounding)) +"\n";
                bill_data += printLine(lang.total_payable+': '+ formatMoney(round_total)) +"\n";
            }
        } else {
            var bill_totals = '';
            bill_totals += '<tr><td>'+lang.total+'</td><td style="text-align:right;">'+formatMoney(total)+'</td></tr>';
            bill_totals += '<tr><td>'+lang.total_items+'</td><td style="text-align:right;">'+(an - 1) + ' (' + (parseFloat(count) - 1) + ')</td></tr>';
            if(order_discount > 0) {
                bill_totals += '<tr><td>'+lang.order_discount+'</td><td style="text-align:right;">'+formatMoney(order_discount)+'</td></tr>';
            }
            if (order_tax != 0) {
                bill_totals += '<tr><td>'+lang.order_tax+'</td><td style="text-align:right;">'+formatMoney(order_tax)+'</td></tr>';
            }
            bill_totals += '<tr><td>'+lang.grand_total+'</td><td style="text-align:right;">'+formatMoney(g_total)+'</td></tr>';
            if(Settings.rounding != 0) {
                round_total = roundNumber(g_total, parseInt(Settings.rounding));
                var rounding = formatDecimal(round_total - g_total);
                bill_totals += '<tr><td>'+lang.rounding+'</td><td style="text-align:right;">'+formatMoney(rounding)+'</td></tr>';
                bill_totals += '<tr><td>'+lang.total_payable+'</td><td style="text-align:right;">'+formatMoney(round_total)+'</td></tr>';
            }
            $('#bill-total-table').empty();
            $('#bill-total-table').append(bill_totals);
        }

        if (Settings.display_kb == 1) { display_keyboards(); }
        $('#add_item').focus();
    }
}

$(document).ready(function(){

    /* =============================
    Edit Item Modal
    ============================= */

    $("#posTable").on("click", '.edit', function() {
        var row = $(this).closest('tr');
        var id = row.attr('id');
        var item_id = row.attr('data-item-id');
        var item = spositems[item_id];
        //var unit_price = parseFloat(item.row.real_unit_price);
        var unit_price = formatDecimal(row.find('.realuprice').val());
        var net_price = unit_price;
        var ds = item.row.discount ? item.row.discount : '0';
        item_discount = formatDecimal(parseFloat(ds));
        if (ds.indexOf("%") !== -1) {
            var pds = ds.split("%");
            if (!isNaN(pds[0])) {
                item_discount = formatDecimal((net_price * parseFloat(pds[0])) / 100);
            }
        }
        net_price -= item_discount;
        var pr_tax = parseFloat(item.row.tax), pr_tax_val = 0, tax = '';
        if (pr_tax !== null && pr_tax != 0) {
            if(parseFloat(item.row.tax_method) == 0) {
                pr_tax_val = formatDecimal((net_price * parseFloat(pr_tax)) / (100+parseFloat(pr_tax)));
                net_price -= pr_tax_val;
                tax = lang.inclusive;
            } else {
                pr_tax_val = formatDecimal((net_price * parseFloat(pr_tax)) / 100);
                tax = lang.exclusive;
            }
        }
        $('#proModalLabel').text(item.label);
        $('#net_price').text(formatMoney(net_price));
        $('#pro_tax').text(formatMoney(pr_tax_val));
        $('#pro_tax_method').text('('+tax+')');
        $('#row_id').val(row_id);
        $('#item_id').val(item_id);
        $('#nPrice').val(unit_price);
        $('#nQuantity').val(item.row.qty);
        $('#nDiscount').val(ds);
        $('#proModal').modal({backdrop:'static'});
    });

    $(document).on('change', '#nPrice, #nDiscount', function () {
        var item_id = $('#item_id').val();
        var unit_price = parseFloat($('#nPrice').val());
        var net_price = unit_price;
        var item = spositems[item_id];
        var ds = $('#nDiscount').val() ? $('#nDiscount').val() : '0';
        item_discount = formatDecimal(parseFloat(ds));
        if (ds.indexOf("%") !== -1) {
            var pds = ds.split("%");
            if (!isNaN(pds[0])) {
                item_discount = formatDecimal((unit_price * parseFloat(pds[0])) / 100);
            }
        }
        net_price -= item_discount;
        var pr_tax = parseFloat(item.row.tax), pr_tax_val = 0;
        if (pr_tax !== null && pr_tax != 0) {
            if(parseFloat(item.row.tax_method) == 0) {
                pr_tax_val = formatDecimal((net_price * parseFloat(pr_tax)) / (100+parseFloat(pr_tax)));
                net_price -= pr_tax_val;
                tax = lang.inclusive;
            } else {
                pr_tax_val = formatDecimal((net_price * parseFloat(pr_tax)) / 100);
                tax = lang.exclusive;
            }
        }

        $('#net_price').text(formatMoney(net_price));
        $('#pro_tax').text(formatMoney(pr_tax_val));
    });

    /* =============================
    Edit Item Method
    ============================= */
     $(document).on('click', '#editItem', function () {
        var item_id = $('#item_id').val();
        var price = parseFloat($('#nPrice').val());
        if(!is_valid_discount($('#nDiscount').val())) {
            bootbox.alert(lang.unexpected_value);
            return false;
        }
        spositems[item_id].row.qty = parseFloat($('#nQuantity').val()),
        spositems[item_id].row.real_unit_price = price,
        spositems[item_id].row.discount = $('#nDiscount').val() ? $('#nDiscount').val() : '0',
        localStorage.setItem('spositems', JSON.stringify(spositems));
        $('#proModal').modal('hide');

        loadItems();
        return;
    });

    /* =============================
    Row quantity change
    ============================= */
    $(document).on("change", '.rquantity', function () {
        var row = $(this).closest('tr');
        if (!is_numeric($(this).val()) || $(this).val() == 0) {
            loadItems();
            bootbox.alert(lang.unexpected_value);
            return false;
        }
        var new_qty = parseFloat($(this).val()),
        item_id = row.attr('data-item-id');
        spositems[item_id].row.qty = new_qty;
        localStorage.setItem('spositems', JSON.stringify(spositems));
        loadItems();
    });

    $('#reset').click(function (e) {
        if (count <= 1) {
            return false;
        }
        bootbox.confirm(lang.r_u_sure, function (result) {
            if (result) {
                if (get('spositems')) {
                    remove('spositems');
                }
                if (get('spos_tax')) {
                    remove('spos_tax');
                }
                if (get('spos_discount')) {
                    remove('spos_discount');
                }
                if (get('spos_customer')) {
                    remove('spos_customer');
                }

                window.location.href = base_url+"pos";
            }
        });
    });

    if(Settings.java_applet == 1) {
        $(document).ready(function () {
            $('#print_order').click(function () {
                if (count <= 1) {
                    bootbox.alert(lang.please_add_product);
                    return false;
                } else {
                    printBill(order_data);
                }
            });
            $('#print_bill').click(function () {
                if (count <= 1) {
                    bootbox.alert(lang.please_add_product);
                    return false;
                } else {
                    printBill(bill_data);
                }
            });
        });
    } else {
        $(document).ready(function () {
            $('#print_order').click(function () {
                if (count <= 1) {
                    bootbox.alert(lang.please_add_product);
                    return false;
                } else {
                    Popup($('#order_tbl').html());
                }
            });
            $('#print_bill').click(function () {
                if (count <= 1) {
                    bootbox.alert(lang.please_add_product);
                    return false;
                } else {
                    Popup($('#bill_tbl').html());
                }
            });
        });
    }

    $("#updateDiscount").click(function() {
        var ds = $('#get_ds').val() ? $('#get_ds').val() : '0';
        var apply_to = $('input[name=apply_to]:checked').val();
        if (ds.length != 0) {
        if (apply_to == 'order') {
            $('#discount_val').val(ds);
            store('spos_discount', ds);
            if(ds.indexOf("%") !== -1) {
                var pds = ds.split("%");

                    order_discount = (total*parseFloat(pds[0]))/100;
                    order_tax = calTax();
                    var g_total = total + order_tax - order_discount;
                    grand_total = parseFloat(g_total);
                    $("#ds_con").text('('+formatMoney(product_discount)+') '+formatMoney(order_discount));
                    $("#total-payable").text(formatMoney(grand_total));

            } else {

                    order_discount = ds;
                    order_tax = calTax();
                    var g_total = (total + order_tax) - parseFloat(order_discount);
                    grand_total = parseFloat(g_total);
                    $("#ds_con").text('('+formatMoney(product_discount)+') '+formatMoney(order_discount));
                    $("#total-payable").text(formatMoney(grand_total));
            }
        } else if (apply_to == 'products') {
            var items = {};
            spositems = JSON.parse(get('spositems'));
            $.each(spositems, function () {
                this.row.discount = ds;
            });
            store('spositems', JSON.stringify(spositems));
            loadItems();
        }
        $('#dsModal').modal('hide');
    }
    });

    $("#add_discount").click(function() {
        var dval = $('#discount_val').val();
        $('#get_ds').val(dval);
        $('#dsModal').modal({backdrop:'static'});
        return false;
    });

    $("#updateTax").click(function() {
        var ts = $('#get_ts').val();
        if (ts.length != 0) {
            $('#tax_val').val(ts);
            store('spos_tax', ts);
            if(ts.indexOf("%") !== -1) {
                var pts = ts.split("%");
                if(! isNaN(pts[0])){
                    order_tax = ((total-order_discount)*parseFloat(pts[0]))/100;
                    var g_total = (total + order_tax) - order_discount;
                    grand_total = parseFloat(g_total);
                    $("#ts_con").text(formatMoney(order_tax));
                    $("#total-payable").text(formatMoney(grand_total));
                } else {
                    $('#get_ts').val('0'); $('#tax_val').val('0');
                    var g_total = total - order_discount;
                    grand_total = parseFloat(g_total);
                    $("#ts_con").text('0');
                    $("#total-payable").text(formatMoney(grand_total));
                }
            } else {
                if(! isNaN(ts) && ts != 0){
                    order_tax = ts;
                    var g_total = (total + parseFloat(ts)) - order_discount;
                    grand_total = parseFloat(g_total);
                    $("#ts_con").text(formatMoney(order_tax));
                    $("#total-payable").text(formatMoney(grand_total));
                } else {
                    $('#get_ts').val('0'); $('#tax_val').val('0');
                    var g_total = total - order_discount;
                    grand_total = parseFloat(g_total);
                    $("#ts_con").text('0');
                    $("#total-payable").text(formatMoney(grand_total));
                }
            }
            $('#tsModal').modal('hide');
        }
    });

    $("#add_tax").click(function() {
        var tval = $('#tax_val').val();
        $('#get_ts').val(tval);
        $('#tsModal').modal({backdrop:'static'});
        return false;
    });

    $(document).on('click', '.product', function (e) {
        code = $(this).val();
        $.ajax({
            type: "get",
            url: base_url+'pos/get_product/'+code,
            dataType: "json",
            success: function (data) {
                if (data !== null) {
                    add_invoice_item(data);
                } else {
                    bootbox.alert(lang.no_match_found);
                }
            }
        });
    });

    $(document).on('click', '.category', function () {
        var cid = $(this).attr('id');
        if (cat_id != cid) {
            cat_id = cid;
            $.ajax({
                type: "get",
                url: base_url+'pos/ajaxproducts',
                data: {category_id: cat_id, tcp: 1},
                dataType: "json",
                success: function (data) {
                    p_page = 'n';
                    $('[data-toggle="control-sidebar"]').click();
                    //ocat_id = cat_id;
                    tcp = data.tcp;
                    $('.items').html(data.products);
                    $('.category').removeClass('active');
                    $('#' + cat_id).addClass('active');
                    nav_pointer();
                }
            });
        }
        return false;
    });
    $('#category-' + cat_id).addClass('active');

    $('#next').click(function () {
        if (p_page == 'n') { p_page = 0; }
        p_page += pro_limit;
        if (tcp >= pro_limit && p_page < tcp) {
            $.ajax({
                type: "get",
                url: base_url+'pos/ajaxproducts',
                data: {category_id: cat_id, per_page: p_page},
                dataType: "html",
                success: function (data) {
                    $('.items').html(data);
                    nav_pointer();
                }
            });
        } else {
            p_page -= pro_limit;
        }
    });

    $('#previous').click(function () {
        if (p_page == 'n') { p_page = 0; }
        if (p_page != 0) {
            p_page -= pro_limit;
            if (p_page == 0) { p_page = 'n'; }
            $.ajax({
                type: "get",
                url: base_url+'pos/ajaxproducts',
                data: {category_id: cat_id, per_page: p_page},
                dataType: "html",
                success: function (data) {
                    $('.items').html(data);
                    nav_pointer();
                }
            });
        }
    });

    $("#add_item").autocomplete({
        source: base_url+'pos/suggestions',
        minLength: 1,
        autoFocus: false,
        delay: 200,
        response: function (event, ui) {
            if ($(this).val().length >= 16 && ui.content[0].id == 0) {
                bootbox.alert(lang.no_match_found, function () {
                    $('#add_item').focus();
                });
                $(this).val('');
            }
            else if (ui.content.length == 1 && ui.content[0].id != 0) {
                ui.item = ui.content[0];
                $(this).data('ui-autocomplete')._trigger('select', 'autocompleteselect', ui);
                $(this).autocomplete('close');
            }
            else if (ui.content.length == 1 && ui.content[0].id == 0) {
                bootbox.alert(lang.no_match_found, function () {
                    $('#add_item').focus();
                });
                $(this).val('');
            }
        },
        select: function (event, ui) {
            event.preventDefault();
            if (ui.item.id !== 0) {
                var row = add_invoice_item(ui.item);
                if (row)
                    $(this).val('');
            } else {
                bootbox.alert(lang.no_match_found);
            }
        }
    });

    $('#add_item').bind('keypress', function (e) {
        if (e.keyCode == 13) {
            e.preventDefault();
            $(this).autocomplete("search");
        }
    });

    $('#add_item').focus();
    $('#gccard_no').inputmask("9999 9999 9999 9999");
    $('#gift_card_no').inputmask("9999 9999 9999 9999");
    $('#genNo').click(function () {
        var no = generateCardNo();
        $(this).parent().parent('.input-group').children('input').val(no);
        return false;
    });

    $(document).on('click', '#sellGiftCard', function (e) {
        if (count == 1) {
            spositems = {};
        }
        $('#gcModal').modal({backdrop:'static'});
     });

    $(document).on('click', '#addGiftCard', function (e) {
        var mid = (new Date).getTime(),
        gccode = $('#gccard_no').val(),
        gcname = $('#gcname').val(),
        gcvalue = $('#gcvalue').val(),
        gcprice = parseFloat($('#gcprice').val());
        if(gccode == '' || gcvalue == '' || gcprice == '' || gcvalue == 0 || gcprice == 0) {
            $('#gcerror').text(lang.file_required_fields);
            $('.gcerror-con').show();
            return false;
        }
        var gc_data = new Array();
        gc_data[0] = gccode;
        gc_data[1] = gcvalue;

        $.ajax({
            type: 'get',
            url: base_url+'gift_cards/sell_gift_card',
            dataType: "json",
            data: { gcdata: gc_data },
            success: function (data) {
                if(data.result === 'success') {
                    spositems[mid] = {"id": mid, "item_id": mid, "label": gcname + ' (' + gccode + ')', "row": {"id": mid, "code": gccode, "name": gcname, "quantity": 1, "price": gcprice, "real_unit_price": gcprice, "tax": 0, "qty": 1, "type": "manual", "discount": "0"}};
                    store('spositems', JSON.stringify(spositems));
                    loadItems();
                    $('#gcModal').modal('hide');
                    $('#gccard_no').val('');
                    $('#gcvalue').val('');
                    $('#gcprice').val('');
                } else {
                    $('#gcerror').text(data.message);
                    $('.gcerror-con').show();
                }
            }
        });
    });

    // $('#opModal').bind().on('click', 'a', function(){
    //     var pg = $.url($(this).attr("href")).param("per_page");
    //     $.get( base_url+'pos/ob_page&per_page='+pg, function( data ) {
    //         $( ".html_con" ).html( data.pd );
    //         $( ".page_con" ).html( data.page );
    //     }, "json");

    //     return false;
    // });


        var pwacc = false;
        $(document).on('click', '.posdel', function () {
            var row = $(this).closest('tr');
            var item_id = row.attr('data-item-id');
            if(protect_delete == 1) {
                var boxd = bootbox.dialog({
                    title: lang.enter_pin_code,
                    closeButton: true,
                    message: '<input id="pos_pin" name="pos_pin" type="password" placeholder="Pin Code" class="form-control kb-pad"> ',
                    buttons: {
                        danger: {
                          label: lang.close,
                          className: "btn-default pull-left",
                          callback: function() { }
                        },
                        success: {
                            label: "<i class='fa fa-tick'></i> "+lang.delete,
                            className: "btn-warning verify_pin",
                            callback: function () {
                                var pos_pin = md5($('#pos_pin').val());
                                if(pos_pin == Settings.pin_code) {
                                    delete spositems[item_id];
                                    row.remove();
                                    if(spositems.hasOwnProperty(item_id)) { } else {
                                        localStorage.setItem('spositems', JSON.stringify(spositems));
                                        loadItems();
                                    }
                                } else {
                                    bootbox.alert(lang.wrong_pin);
                                }
                            }
                        }
                    }
                });
            boxd.on("shown.bs.modal", function() {
                if (Settings.display_kb == 1) { display_keyboards(); }
                $( "#pos_pin" ).focus().keypress(function(e) {
                    if (e.keyCode == 13) {
                        e.preventDefault();
                        $('.verify_pin').trigger('click');
                        return false;
                    }
                });
            });
        } else {
            delete spositems[item_id];
            row.remove();
            if(spositems.hasOwnProperty(item_id)) { } else {
                localStorage.setItem('spositems', JSON.stringify(spositems));
                loadItems();
            }
        }
        return false;
    });

    $('#suspend').click(function () {
        if (count <= 1) {
            bootbox.alert(lang.please_add_product);
            return false;
        } else {
            $('#susModal').modal({backdrop:'static'});
        }
    });

    $('#suspend_sale').click(function () {
        ref = $('#reference_note').val();
        if (!ref || ref == '') {
            bootbox.alert(lang.type_reference_note);
            return false;
        } else {
            suspend = $('<span></span>');
            if (sid !== 0) {
                suspend.html('<input type="hidden" name="delete_id" value="'+sid+'" /><input type="hidden" name="suspend" value="yes" /><input type="hidden" name="suspend_note" value="' + ref + '" />');
            } else {
                suspend.html('<input type="hidden" name="suspend" value="yes" /><input type="hidden" name="suspend_note" value="' + ref + '" />');
            }
            suspend.appendTo("#hidesuspend");
            $('#pos-sale-form').submit();
        }
    });

    $('#payment').click(function () {
        if (count <= 1) {
            bootbox.alert(lang.please_add_product);
            return false;
        } else {

            if (sid) {
            suspend = $('<span></span>');
            suspend.html('<input type="hidden" name="delete_id" value="'+sid+'" />');
            suspend.appendTo("#hidesuspend");
            }

            gtotal = formatDecimal(total - order_discount + order_tax);
            if(Settings.rounding != 0) {
                round_total = roundNumber(gtotal, parseInt(Settings.rounding));
                var rounding = formatDecimal(round_total - gtotal);
                $('#twt').text(formatMoney(round_total) + ' (' + formatMoney(rounding) + ')');
                $('#quick-payable').text(round_total);
            } else {
                $('#twt').text(formatMoney(gtotal));
                $('#quick-payable').text(gtotal);
            }
            $('#item_count').text((an-1)+' ('+(count-1)+')');
            $("#order_quantity").val(count-1);
            $("#order_items").val(an-1);
            $('#balance').text('0.00');
            $('#payModal').modal({backdrop:'static'});

        }
    });
    $('#payModal').on('shown.bs.modal', function (e) {
        $('#amount').focus();
    });
    $('#payModal').on('hidden.bs.modal', function (e) {
        $('#amount').val('').change();
    });

    $('#amount').change(function(e) {
        var total_paying = $(".amount").val();
        $('#total_paying').text(formatMoney(total_paying));
        if(Settings.rounding != 0) {
            $('#balance').text(formatMoney(total_paying - round_total));
            $('#balance_val').val(formatDecimal(total_paying - round_total));
            total_paid = total_paying;
            grand_total = round_total;
        } else {
            $('#balance').text(formatMoney(total_paying - gtotal));
            $('#balance_val').val(formatDecimal(total_paying - gtotal));
            total_paid = total_paying;
            grand_total = gtotal;
        }
    });

    $('#add-customer').click(function () {
        $('#customerModal').modal({backdrop:'static'});
    });

    $('#payModal').on('change', '#paid_by', function () {
        var p_val = $(this).val();
        $('#paid_by_val').val(p_val);
        var gtotal = formatDecimal(total - order_discount + order_tax);
        if(Settings.rounding != 0) {
            var rounded_total = formatDecimal(roundNumber(gtotal, parseInt(Settings.rounding)));
        } else {
            var rounded_total = formatDecimal(gtotal);
        }
        $('#rpaidby').val(p_val);
        if (p_val == 'gift_card') {
            $('.gc').slideDown();
            $('.ngc').slideUp('fast');
            setTimeout(function(){ $('#gift_card_no').focus(); }, 10);
            $('#amount').attr('readonly', true);
        } else {
            $('.ngc').slideDown();
            $('.gc').slideUp('fast');
            $('#gc_details').html('');
            $('#amount').attr('readonly', false);
        }
        if (p_val == 'cash' || p_val == 'other') {
            $('.pcash').slideDown();
            $('.pcheque').slideUp('fast');
            $('.pcc').slideUp('fast');
            setTimeout(function(){ $('#amount').focus(); }, 10);
        } else if (p_val == 'CC' || p_val == 'stripe') {
            $('.pcc').slideDown();
            $('.pcheque').slideUp('fast');
            $('.pcash').slideUp('fast');
            $('#amount').val(rounded_total);
            setTimeout(function(){ $('#swipe').val('').focus(); }, 10);
        } else if (p_val == 'Cheque') {
            $('.pcheque').slideDown();
            $('.pcc').slideUp('fast');
            $('.pcash').slideUp('fast');
            $('#amount').val(rounded_total);
            setTimeout(function(){ $('#cheque_no').focus(); }, 10);
        } else {
            $('.pcheque').hide();
            $('.pcc').hide();
            $('.pcash').hide();
        }
    });

    $(document).on('change', '.gift_card_no', function () {
        var cn = $(this).val() ? $(this).val() : '';
        if (cn != '') {
            $.ajax({
                type: "get", async: false,
                url: base_url + "pos/validate_gift_card/" + cn,
                dataType: "json",
                success: function (data) {
                    if (data === false || data.balance < 0) {
                        $('#gift_card_no').parent('.form-group').addClass('has-error');
                        bootbox.alert(lang.incorrect_gift_card);
                    } else {
                        $('#gc_details').html(lang.card_no+': ' + data.card_no + '<br>'+lang.value+': ' + data.value + ' - '+lang.balance+': ' + data.balance);
                        $('#gift_card_no').parent('.form-group').removeClass('has-error');
                        var paying = (gtotal > data.balance) ? data.balance : gtotal;
                        $('#amount_val').val(paying);
                        $('#amount').val(paying);
                    }
                }
            });
        }
        return false;
    });

    $(document).on('click', '.quick-cash', function () {
        var $quick_cash = $(this);
        var amt = $quick_cash.contents().filter(function () {
            return this.nodeType == 3;
        }).text();
        var th = Settings.thousands_sep == 0 ? '' : Settings.thousands_sep;
        var $pi = $('#amount');
        amt = formatDecimal(amt.split(th).join("")) * 1 + $pi.val() * 1;
        $pi.val(formatDecimal(amt)).change().focus();
        var note_count = $quick_cash.find('span');
        if (note_count.length == 0) {
            $quick_cash.append('<span class="badge">1</span>');
        } else {
            note_count.text(parseInt(note_count.text()) + 1);
        }
    });

    $(document).on('click', '#clear-cash-notes', function () {
        $('.quick-cash').find('.badge').remove();
        $('#amount').val('').change().focus();
    });

    $('#payModal').on('change', '#amount', function (e) {
        $('#amount_val').val($(this).val());
    });
    $('#payModal').on('blur', '#amount', function (e) {
        $('#amount_val').val($(this).val());
    });
    $('#payModal').on('select2-close', '#paid_by', function (e) {
        $('#paid_by_val').val($(this).val());
    });
    $('#payModal').on('change', '#pcc_no', function (e) {
        $('#cc_no_val').val($(this).val());
    });
    $('#payModal').on('change', '#pcc_holder', function (e) {
        $('#cc_holder_val').val($(this).val());
    });
    $('#payModal').on('change', '#gift_card_no', function (e) {
        $('#paying_gift_card_no_val').val($(this).val());
    });
    $('#payModal').on('change', '#pcc_month', function (e) {
        $('#cc_month_val').val($(this).val());
    });
    $('#payModal').on('change', '#pcc_year', function (e) {
        $('#cc_year_val').val($(this).val());
    });
    $('#payModal').on('change', '#pcc_type', function (e) {
        $('#cc_type_val').val($(this).val());
    });
    $('#payModal').on('change', '#pcc_cvv2', function (e) {
        $('#cc_cvv2_val').val($(this).val());
    });
    $('#payModal').on('change', '#cheque_no', function (e) {
        $('#cheque_no_val').val($(this).val());
    });
    $('#payModal').on('change', '#payment_note', function (e) {
        $('#payment_note_val').val($(this).val());
    });
    $('#payModal').on('change', '#note', function (e) {
        var n = $(this).val();
        store('spos_note', n);
        $('#spos_note').val(n);
    });
    if(spos_note = get('spos_note')) {
        $('#note').val(spos_note);
    }
    $('#spos_customer').change( function (e) {
        store('spos_customer', $(this).val());
    });
    if(spos_customer = get('spos_customer')) {
        $('#spos_customer').select2('val', spos_customer);
    }

    $( ".modal" ).each(function(index) {
        $(this).on('show.bs.modal', function (e) {
            var open = $(this).attr('data-easein');
            $('.modal-dialog').velocity('transition.' + open);
        });
    });

    $('[data-toggle="ajax"]').click(function(event) {
        event.preventDefault();
        var href = $(this).attr('href');
        $.get(href, function( data ) {
          $("#posModal").html(data);
          $("#posModal").modal({backdrop:'static'});
          return false;
      });
    });

    $('#submit-sale').click(function() {
        $('#total_items').val(an - 1);
        $('#total_quantity').val(count - 1);
        console.log($('#amount_val').val());
        $('#submit').click();
    });

    $('#suspend_sale').click(function() {
        if($('#reference_note').val()) {
            $('#hold_ref').val($('#reference_note').val());
            $('#total_items').val(an - 1);
            $('#total_quantity').val(count - 1);
            $('#submit').click();
        }
        return false;
    });

    $("#customer-form").on("submit", function(e) {
        e.preventDefault();
        $.ajax({
            type: "post",
            url: base_url+'customers/add',
            data: $( this ).serialize(),
            dataType: "json",
            success: function(res) {
                if(res.status == 'success') {
                    $('#spos_customer').append($("<option></option>").attr("value",res.id).text(res.val));
                    $('#spos_customer').select2('val', res.id);
                    $('#customerModal').modal('hide');
                } else {
                    $('#c-alert').html(res.msg);
                    $('#c-alert').show();
                }
            },
            error: function(){
                bootbox.alert(lang.customer_request_failed);
                return false;
            }
        });
        return false;
    });

    $('#customerModal').on('hidden.bs.modal', function (e) {
        $('#c-alert').hide();
        $('#cname').val('');
        $('#cemail').val('');
        $('#cphone').val('');
        $('#cf1').val('');
        $('#cf2').val('');
    });

});


function display_keyboards() {

    $('.kb-text').keyboard({
        autoAccept: true,
        alwaysOpen: false,
        openOn: 'focus',
        usePreview: false,
        // layout: 'qwerty',
        layout: 'custom',
        display: {
            'bksp': "\u2190",
            'accept': 'return',
            'default': 'ABC',
            'meta1': '123',
            'meta2': '#+='
        },
        customLayout: {
            'default': [
                'q w e r t y u i o p {bksp}',
                'a s d f g h j k l {enter}',
                '{s} z x c v b n m , . {s}',
                '{meta1} {space} {cancel} {accept}'
            ],
            'shift': [
                'Q W E R T Y U I O P {bksp}',
                'A S D F G H J K L {enter}',
                '{s} Z X C V B N M / ? {s}',
                '{meta1} {space} {meta1} {accept}'
            ],
            'meta1': [
                '1 2 3 4 5 6 7 8 9 0 {bksp}',
                '- / : ; ( ) \u20ac & @ {enter}',
                '{meta2} . , ? ! \' " {meta2}',
                '{default} {space} {default} {accept}'
            ],
            'meta2': [
                '[ ] { } # % ^ * + = {bksp}',
                '_ \\ | &lt; &gt; $ \u00a3 \u00a5 {enter}',
                '{meta1} ~ . , ? ! \' " {meta1}',
                '{default} {space} {default} {accept}'
            ]}
    });

    $('.kb-pad').keyboard({
        restrictInput: true,
        preventPaste: true,
        autoAccept: true,
        alwaysOpen: false,
        openOn: 'click',
        usePreview: false,
        layout: 'costom',
        display: {
            'b': '\u2190:Backspace'
        },
        customLayout: {
            'default': [
                '1 2 3 {b}',
                '4 5 6 . {clear}',
                '7 8 9 0 %',
                '{accept} {cancel}'
            ]
        }
    });

}

function calTax() {
    var ts = get('spos_tax') ? get('spos_tax') : $('#tax_val').val();
    if(ts.indexOf("%") !== -1) {
        var pts = ts.split("%");
        order_tax = ((total-order_discount)*parseFloat(pts[0]))/100;
        $("#ts_con").text(formatMoney(order_tax));
    } else {
        order_tax = parseFloat(ts);
        $("#ts_con").text(formatMoney(order_tax));
    }
    return order_tax;
}

function nav_pointer() {
    var pp = p_page == 'n' ? 0 : p_page;
    (pp == 0) ? $('#previous').attr('disabled', true) : $('#previous').attr('disabled', false);
    ((pp+pro_limit) > tcp) ? $('#next').attr('disabled', true) : $('#next').attr('disabled', false);
}

function Popup(data) {
    var mywindow = window.open('', 'spos_print', 'height=500,width=300');
    mywindow.document.write('<!DOCTYPE html><html><head><title>Print</title>');
    mywindow.document.write('<link rel="stylesheet" href="'+assets+'bootstrap/css/bootstrap.min.css" type="text/css" />');
    mywindow.document.write('<style>a {color: #333;} #totaltbl td, #totaltbl th { vertical-align: middle; }</style>');
    mywindow.document.write('</head><body >');
    mywindow.document.write(data);
    mywindow.document.write('</body></html>');
    mywindow.print();
    mywindow.close();
    return true;
}

$(document).ready(function($) {
    window.setTimeout(function() {
        $('.alerts').slideUp();
    }, 15000);
    $('.alerts').on('click',function(e) {
        $(this).slideUp();
    });
    $('html').perfectScrollbar();
    $('.navbar .menu').perfectScrollbar({suppressScrollX: true});
    $('.control-sidebar').perfectScrollbar({suppressScrollX: true});
    $('#list-table-div').perfectScrollbar({suppressScrollX: true});
    $('.items').perfectScrollbar({suppressScrollX: true});
});

function posScreen() {
    var wh = $(window).height(),
    total_dh = $('#totaldiv').height(),
    buttons_dh = $('.botbuttons').height();
    var items_dh = wh-120, list_table_dh = wh-258-total_dh-buttons_dh;
    $('#right-col').height(wh-100);
    $('.items').height((items_dh > 400 ? items_dh : 400));
    $('#list-table-div').height(list_table_dh);
    $('html').perfectScrollbar('update');
    $('.items').perfectScrollbar('update');
    $('#list-table-div').perfectScrollbar('update');
}

function printLine(str) {
    var size = Settings.char_per_line;
    var len = str.length;
    var res = str.split(":");
    var newd = res[0];
    for(i=1; i<(size-len); i++) {
        newd += " ";
    }
    newd += res[1];
    return newd;
}

$(window).bind("resize", posScreen);

function read_card() {

}

$.extend($.keyboard.keyaction, {
    enter : function(base) {
        base.accept();
    }
});

$(document).ready(function(){

    $('.swipe').keypress( function (e) {
        var TrackData = $(this).val() ? $(this).val() : '';
        if(TrackData != '') {
            if (e.keyCode == 13) {
                e.preventDefault();
                var p = new SwipeParserObj(TrackData);

                if(p.hasTrack1)
                {

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

                    $('#pcc_no').val(p.account).change();
                    $('#pcc_holder').val(p.account_name).change();
                    $('#pcc_month').val(p.exp_month).change();
                    $('#pcc_year').val(p.exp_year).change();
                    $('#pcc_cvv2').val('');
                    $('#pcc_type').select2('val', CardType);

                } else {
                    $('#pcc_no').val('').change();
                    $('#pcc_holder').val('').change();
                    $('#pcc_month').val('').change();
                    $('#pcc_year').val('').change();
                    $('#pcc_cvv2').val('').change();
                    $('#pcc_type').val('').change();
                }

                $('#pcc_cvv2').focus();
            }
        }

    }).blur(function (e) {
        $(this).val('');
    }).focus( function (e) {
        $(this).val('');
    });

    $(document).on('blur', '#pcc_no', function () {
        var cn = $(this).val();
        var ccn1 = cn.charAt(0);
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

        $('#pcc_type').select2('val', CardType);
    });

    $('.modal').on('hidden.bs.modal', function() {
        $(this).removeData('bs.modal');
    });
    $('#clearLS').click(function(event) {
        bootbox.confirm(lang.r_u_sure, function(result) {
            if(result == true) {
                localStorage.clear();
                location.reload();
            }
        });
        return false;
    });

    if(Settings.focus_add_item != '') {
        shortcut.add(Settings.focus_add_item, function() { $("#add_item").focus(); }, { 'type':'keydown', 'propagate':false, 'target':document} );
    }
    if(Settings.add_customer != '') {
        shortcut.add(Settings.add_customer, function() { $("#add-customer").trigger('click'); }, { 'type':'keydown', 'propagate':false, 'target':document} );
    }
    if(Settings.toggle_category_slider != '') {
        shortcut.add(Settings.toggle_category_slider, function() { $('[data-toggle="control-sidebar"]').trigger('click'); }, { 'type':'keydown', 'propagate':false, 'target':document} );
    }
    if(Settings.cancel_sale != '') {
        shortcut.add(Settings.cancel_sale, function() { $("#reset").click(); }, { 'type':'keydown', 'propagate':false, 'target':document} );
    }
    if(Settings.suspend_sale != '') {
       shortcut.add(Settings.suspend_sale, function() { $("#suspend").trigger('click'); }, { 'type':'keydown', 'propagate':false, 'target':document} );
   }
   if(Settings.print_order != '') {
       shortcut.add(Settings.print_order, function() { $("#print_order").click(); }, { 'type':'keydown', 'propagate':false, 'target':document} );
   }
   if(Settings.print_bill != '') {
       shortcut.add(Settings.print_bill, function() { $("#print_bill").click(); }, { 'type':'keydown', 'propagate':false, 'target':document} );
   }
   if(Settings.finalize_sale != '') {
       shortcut.add(Settings.finalize_sale, function() { $("#payment").trigger('click'); }, { 'type':'keydown', 'propagate':false, 'target':document} );
   }
   if(Settings.today_sale != '') {
       shortcut.add(Settings.today_sale, function() { $("#today_sale").click(); }, { 'type':'keydown', 'propagate':false, 'target':document} );
   }
   if(Settings.open_hold_bills != '') {
       shortcut.add(Settings.open_hold_bills, function() { $("#opened_bills").trigger('click'); }, { 'type':'keydown', 'propagate':false, 'target':document} );
   }
   if(Settings.close_register != '') {
       shortcut.add(Settings.close_register, function() { $("#close_register").click(); }, { 'type':'keydown', 'propagate':false, 'target':document} );
   }

});

$.ajaxSetup ({ cache: false, headers: { "cache-control": "no-cache" } });
