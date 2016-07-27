<?php (defined('BASEPATH')) OR exit('No direct script access allowed'); ?>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title"><?= lang('enter_info'); ?></h3>
                </div>
                <div class="box-body">
                    <div class="col-lg-12">
                        <?= form_open_multipart("products/add", 'class="validation"');?>
                        <div class="row">
                            <div class="col-md-6">
                            <div class="form-group">
                                <?= lang('type', 'type'); ?>
                                <?php $opts = array('standard' => lang('standard'), 'combo' => lang('combo'), 'service' => lang('service')); ?>
                                <?= form_dropdown('type', $opts, set_value('type', 'standard'), 'class="form-control tip select2" id="type"  required="required" style="width:100%;"'); ?>
                            </div>
                                <div class="form-group">
                                    <?= lang('name', 'name'); ?>
                                    <?= form_input('name', set_value('name'), 'class="form-control tip" id="name"  required="required"'); ?>
                                </div>
                                <div class="form-group">
                                    <?= lang('code', 'code'); ?> <?= lang('can_use_barcode'); ?>
                                    <?= form_input('code', set_value('code'), 'class="form-control tip" id="code"  required="required"'); ?>
                                </div>
                                <div class="form-group all">
                                    <?= lang("barcode_symbology", "barcode_symbology") ?>
                                    <?php
                                    $bs = array('code25' => 'Code25', 'code39' => 'Code39', 'code128' => 'Code128', 'ean8' => 'EAN8', 'ean13' => 'EAN13', 'upca ' => 'UPC-A', 'upce' => 'UPC-E');
                                    echo form_dropdown('barcode_symbology', $bs, set_value('barcode_symbology', 'code39'), 'class="form-control select2" id="barcode_symbology" required="required" style="width:100%;"');
                                    ?>
                                </div>

                                <div class="form-group">
                                    <?= lang('category', 'category'); ?>
                                    <?php
                                    $cat[''] = lang("select")." ".lang("category");
                                    foreach($categories as $category) {
                                        $cat[$category->id] = $category->name;
                                    }
                                    ?>
                                    <?= form_dropdown('category', $cat, set_value('category'), 'class="form-control select2 tip" id="category"  required="required" style="width:100%;"'); ?>
                                </div>

                                <div class="form-group">
                                    <?= lang('cost', 'cost'); ?>
                                    <?= form_input('cost', set_value('cost'), 'class="form-control tip" id="cost"  required="required"'); ?>
                                </div>

                                <div class="form-group">
                                    <?= lang('price', 'price'); ?>
                                    <?= form_input('price', set_value('price'), 'class="form-control tip" id="price"  required="required"'); ?>
                                </div>

                                <div class="form-group">
                                    <?= lang('product_tax', 'product_tax'); ?> <?= lang('external_percentage'); ?>
                                    <?= form_input('product_tax', set_value('product_tax', 0), 'class="form-control tip" id="product_tax"  required="required"'); ?>
                                </div>
                                <div class="form-group">
                                    <?= lang('tax_method', 'tax_method'); ?>
                                    <?php $tm = array(0 => lang('inclusive'), 1 => lang('exclusive')); ?>
                                    <?= form_dropdown('tax_method', $tm, set_value('tax_method'), 'class="form-control tip select2" id="tax_method"  required="required" style="width:100%;"'); ?>
                                </div>
                                <div class="form-group" id="st">
                                    <?= lang('quantity', 'quantity'); ?>
                                    <?= form_input('quantity', set_value('quantity', 0), 'class="form-control tip" id="quantity"  required="required"'); ?>
                                </div>
                                <div class="form-group" id="st">
                                    <?= lang('alert_quantity', 'alert_quantity'); ?>
                                    <?= form_input('alert_quantity', set_value('alert_quantity', 0), 'class="form-control tip" id="alert_quantity"  required="required"'); ?>
                                </div>

                                <div class="form-group">
                                    <?= lang('image', 'image'); ?>
                                    <input type="file" name="userfile" id="image">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div id="ct" style="display:none;">

                                    <div class="form-group">
                                        <?= lang("add_product", "add_item"); ?>
                                        <?php echo form_input('add_item', '', 'class="form-control ttip" id="add_item" data-placement="top" data-trigger="focus" data-bv-notEmpty-message="' . lang('please_add_items_below') . '" placeholder="' . $this->lang->line("add_item") . '"'); ?>
                                    </div>
                                    <div class="control-group table-group">
                                        <label class="table-label" for="combo"><?= lang("combo_products"); ?></label>

                                        <div class="controls table-controls">
                                            <table id="prTable"
                                                   class="table items table-striped table-bordered table-condensed table-hover">
                                                <thead>
                                                <tr>
                                                    <th class="col-xs-9"><?= lang("product_name") . " (" . $this->lang->line("product_code") . ")"; ?></th>
                                                    <th class="col-xs-2"><?= lang("quantity"); ?></th>
                                                    <th class=" col-xs-1 text-center"><i class="fa fa-trash-o trash-opacity-50"></i></th>
                                                </tr>
                                                </thead>
                                                <tbody></tbody>
                                            </table>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <?= lang('details', 'details'); ?>
                            <?= form_textarea('details', set_value('details'), 'class="form-control tip redactor" id="details"'); ?>
                        </div>
                        <div class="form-group">
                            <?= form_submit('add_product', lang('add_product'), 'class="btn btn-primary"'); ?>
                        </div>
                        <?= form_close();?>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="<?= $assets ?>dist/js/jquery-ui.min.js" type="text/javascript"></script>
<script type="text/javascript" charset="utf-8">
    var price = 0; cost = 0; items = {};
    $(document).ready(function() {
        $('#type').change(function(e) {
            var type = $(this).val();
            if(type == 'combo') {
                $('#st').slideUp();
                $('#ct').slideDown();
                //$('#cost').attr('readonly', true);
            } else if(type == 'service') {
                $('#st').slideUp();
                $('#ct').slideUp();
                //$('#cost').attr('readonly', false);
            } else {
                $('#ct').slideUp();
                $('#st').slideDown();
                //$('#cost').attr('readonly', false);
            }
        });

        $("#add_item").autocomplete({
            source: '<?= site_url('products/suggestions'); ?>',
            minLength: 1,
            autoFocus: false,
            delay: 200,
            response: function (event, ui) {
                if ($(this).val().length >= 16 && ui.content[0].id == 0) {
                    bootbox.alert('<?= lang('no_product_found') ?>', function () {
                        $('#add_item').focus();
                    });
                    $(this).val('');
                }
                else if (ui.content.length == 1 && ui.content[0].id != 0) {
                    ui.item = ui.content[0];
                    $(this).data('ui-autocomplete')._trigger('select', 'autocompleteselect', ui);
                    $(this).autocomplete('close');
                    $(this).removeClass('ui-autocomplete-loading');
                }
                else if (ui.content.length == 1 && ui.content[0].id == 0) {
                    bootbox.alert('<?= lang('no_product_found') ?>', function () {
                        $('#add_item').focus();
                    });
                    $(this).val('');

                }
            },
            select: function (event, ui) {
                event.preventDefault();
                if (ui.item.id !== 0) {
                    var row = add_product_item(ui.item);
                    if (row) {
                        $(this).val('');
                    }
                } else {
                    bootbox.alert('<?= lang('no_product_found') ?>');
                }
            }
        });
        $('#add_item').bind('keypress', function (e) {
            if (e.keyCode == 13) {
                e.preventDefault();
                $(this).autocomplete("search");
            }
        });

        $(document).on('click', '.del', function () {
            var id = $(this).attr('id');
            delete items[id];
            $(this).closest('#row_' + id).remove();
        });


        $(document).on('change', '.rqty', function () {
            var item_id = $(this).attr('data-item');
            items[item_id].row.qty = (parseFloat($(this).val())).toFixed(2);
            add_product_item(null, 1);
        });

        $(document).on('change', '.rprice', function () {
            var item_id = $(this).attr('data-item');
            items[item_id].row.price = (parseFloat($(this).val())).toFixed(2);
            add_product_item(null, 1);
        });

        function add_product_item(item, noitem) {
            if (item == null && noitem == null) {
                return false;
            }
            if(noitem != 1) {
                item_id = item.row.id;
                if (items[item_id]) {
                    items[item_id].row.qty = (parseFloat(items[item_id].row.qty) + 1).toFixed(2);
                } else {
                    items[item_id] = item;
                }
            }
            price = 0;
            cost = 0;

            $("#prTable tbody").empty();
            $.each(items, function () {
                var item = this.row;
                var row_no = item.id;
                var newTr = $('<tr id="row_' + row_no + '" class="item_' + item.id + '"></tr>');
                tr_html = '<td><input name="combo_item_id[]" type="hidden" value="' + item.id + '"><input name="combo_item_code[]" type="hidden" value="' + item.code + '"><input name="combo_item_name[]" type="hidden" value="' + item.name + '"><input name="combo_item_cost[]" type="hidden" value="' + item.cost + '"><span id="name_' + row_no + '">' + item.name + ' (' + item.code + ')</span></td>';
                tr_html += '<td><input class="form-control text-center rqty" name="combo_item_quantity[]" type="text" value="' + formatDecimal(item.qty) + '" data-id="' + row_no + '" data-item="' + item.id + '" id="quantity_' + row_no + '" onClick="this.select();"></td>';
                //tr_html += '<td><input class="form-control text-center rprice" name="combo_item_price[]" type="text" value="' + formatDecimal(item.price) + '" data-id="' + row_no + '" data-item="' + item.id + '" id="combo_item_price_' + row_no + '" onClick="this.select();"></td>';
                tr_html += '<td class="text-center"><i class="fa fa-times tip del" id="' + row_no + '" title="Remove" style="cursor:pointer;"></i></td>';
                newTr.html(tr_html);
                newTr.prependTo("#prTable");
                //price += formatDecimal(item.price*item.qty);
                cost += formatDecimal(item.cost*item.qty);
            });
            $('#cost').val(cost);
            return true;

        }
        <?php
        if($this->input->post('type') == 'combo') {
            $c = sizeof($_POST['combo_item_code']);
            $items = array();
            for ($r = 0; $r <= $c; $r++) {
                if(isset($_POST['combo_item_code'][$r]) && isset($_POST['combo_item_quantity'][$r])) {
                    $items[] = array('id' => $_POST['combo_item_id'][$r], 'row' => array('id' => $_POST['combo_item_id'][$r], 'name' => $_POST['combo_item_name'][$r], 'code' => $_POST['combo_item_code'][$r], 'qty' => $_POST['combo_item_quantity'][$r], 'cost' => $_POST['combo_item_cost'][$r]));
                }
            }
            echo '
            var ci = '.json_encode($items).';
            $.each(ci, function() { add_product_item(this); });
            ';
        }
        if($this->input->post('type')) {
            ?>
            var type = '<?= $this->input->post('type'); ?>';
            if(type == 'combo') {
                $('#st').slideUp();
                $('#ct').slideDown();
                //$('#cost').attr('readonly', true);
            } else if(type == 'service') {
                $('#st').slideUp();
                $('#ct').slideUp();
                //$('#cost').attr('readonly', false);
            } else {
                $('#ct').slideUp();
                $('#st').slideDown();
                //$('#cost').attr('readonly', false);
            }

<?php }
        ?>
    });




</script>
