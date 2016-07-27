    $(document).ready(function() {
        loadItems();
        $("#date").inputmask("yyyy-mm-dd hh:mm", {"placeholder": "yyyy-mm-dd hh:mm"});
        $("#add_item").autocomplete({
            source: base_url+'purchases/suggestions',
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
                    var row = add_order_item(ui.item);
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
        $('#reset').click(function (e) {
            bootbox.confirm(lang.r_u_sure, function (result) {
                if (result) {
                    if (get('spoitems')) {
                        remove('spoitems');
                    }

                    window.location.reload();
                }
            });
        });

        $(document).on("change", '.rquantity', function () {
            var row = $(this).closest('tr');
            var new_qty = parseFloat($(this).val()),
            item_id = row.attr('data-item-id');
            spoitems[item_id].row.qty = new_qty;
            store('spoitems', JSON.stringify(spoitems));
            loadItems();
        });

        $(document).on("change", '.rcost', function () {
            var row = $(this).closest('tr');
            var new_cost = parseFloat($(this).val()),
            item_id = row.attr('data-item-id');
            spoitems[item_id].row.cost = new_cost;
            store('spoitems', JSON.stringify(spoitems));
            loadItems();
        });
    });

function loadItems() {

    if (get('spoitems')) {
        total = 0;

        $("#poTable tbody").empty();

        spoitems = JSON.parse(get('spoitems'));

        $.each(spoitems, function () {

            var item = this;
            var item_id = Settings.item_addition == 1 ? item.item_id : item.id;
            spoitems[item_id] = item;

            var product_id = item.row.id, item_cost = item.row.cost, item_qty = item.row.qty, item_code = item.row.code,
            item_name = item.row.name.replace(/"/g, "&#034;").replace(/'/g, "&#039;");

            var row_no = (new Date).getTime();
            var newTr = $('<tr id="' + row_no + '" class="' + item_id + '" data-item-id="' + item_id + '"></tr>');
            tr_html = '<td style="min-width:100px;"><input name="product_id[]" type="hidden" class="rid" value="' + product_id + '"><span class="sname" id="name_' + row_no + '">' + item_name + ' (' + item_code + ')</span></td>';
            tr_html += '<td style="padding:2px;"><input class="form-control input-sm kb-pad text-center rquantity" name="quantity[]" type="text" value="' + item_qty + '" data-id="' + row_no + '" data-item="' + item_id + '" id="quantity_' + row_no + '" onClick="this.select();"></td>';
            tr_html += '<td style="padding:2px; min-width:80px;"><input class="form-control input-sm kb-pad text-center rcost" name="cost[]" type="text" value="' + item_cost + '" data-id="' + row_no + '" data-item="' + item_id + '" id="cost_' + row_no + '" onClick="this.select();"></td>';
            tr_html += '<td class="text-right"><span class="text-right ssubtotal" id="subtotal_' + row_no + '">' + formatMoney(parseFloat(item_cost) * parseFloat(item_qty)) + '</span></td>';
            tr_html += '<td class="text-center"><i class="fa fa-trash-o tip pointer spodel" id="' + row_no + '" title="Remove"></i></td>';
            newTr.html(tr_html);
            newTr.prependTo("#poTable");
            total += (parseFloat(item_cost) * parseFloat(item_qty));
            
        });

        grand_total = formatMoney(total);       
        $("#gtotal").text(grand_total);
        $('#add_item').focus();
    }
}

function add_order_item(item) {

    var item_id = Settings.item_addition == 1 ? item.item_id : item.id;
    if (spoitems[item_id]) {
        spoitems[item_id].row.qty = parseFloat(spoitems[item_id].row.qty) + 1;
    } else {
        spoitems[item_id] = item;
    }

    store('spoitems', JSON.stringify(spoitems));
    loadItems();
    return true;
}