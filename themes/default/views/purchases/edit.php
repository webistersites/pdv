<?php (defined('BASEPATH')) OR exit('No direct script access allowed'); ?>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title"><?= lang('update_info'); ?></h3>
                </div>
                <div class="box-body">
                    <div class="col-lg-12">
                        <?php echo form_open_multipart("purchases/edit/".$purchase->id, 'class="validation edit-po-form"'); ?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?= lang('date', 'date'); ?>
                                    <?= form_input('date', set_value('date', $purchase->date), 'class="form-control tip" id="date"  required="required"'); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?= lang('reference', 'reference'); ?>
                                    <?= form_input('reference', $purchase->reference, 'class="form-control tip" id="reference"'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" placeholder="<?= lang('search_product_by_name_code'); ?>" id="add_item" class="form-control">
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table id="poTable" class="table table-striped table-bordered">
                                        <thead>
                                            <tr class="active">
                                                <th><?= lang('product'); ?></th>
                                                <th class="col-xs-2"><?= lang('quantity'); ?></th>
                                                <th class="col-xs-2"><?= lang('unit_cost'); ?></th>
                                                <th class="col-xs-2"><?= lang('subtotal'); ?></th>
                                                <th style="width:25px;"><i class="fa fa-trash-o"></i></th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                        <tfoot>
                                            <tr class="active">
                                                <th><?= lang('total'); ?></th>
                                                <th class="col-xs-2"></th>
                                                <th class="col-xs-2"></th>
                                                <th class="col-xs-2 text-right"><span id="gtotal">0.00</span></th>
                                                <th style="width:25px;"></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <?= lang('attachment', 'attachment'); ?>
                            <input type="file" name="userfile" class="form-control tip" id="attachment">
                        </div>  
                        <div class="form-group">
                            <?= lang("note", 'note'); ?>
                            <?= form_textarea('note', $purchase->note, 'class="form-control redactor" id="note"'); ?>
                        </div>
                        <div class="form-group">
                            <?= form_submit('edit_purchase', lang('edit_purchase'), 'class="btn btn-primary" id="edit_purchase"'); ?>
                            <button type="button" id="reset" class="btn btn-danger"><?= lang('reset'); ?></button>
                        </div>

                        <?php echo form_close();?>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    var spoitems = {};
    var lang = new Array();
    lang['code_error'] = '<?= lang('code_error'); ?>';
    lang['r_u_sure'] = '<?= lang('r_u_sure'); ?>';
    lang['no_match_found'] = '<?= lang('no_match_found'); ?>';

    $(document).ready(function() {
       store('spoitems', JSON.stringify(<?= $items; ?>)); 
    });
    $(window).bind('beforeunload', function (e) {
        localStorage.setItem('remove_spo', true);
        var message = "You will loss data!";
        return message;

    });
    $('#reset').click(function (e) {
        $(window).unbind('beforeunload');
    });
    $('#edit_purchase').click(function () {
        $(window).unbind('beforeunload');
        $('form.edit-po-form').submit();
    });
</script>
<script src="<?= $assets ?>dist/js/jquery-ui.min.js" type="text/javascript"></script>
<script src="<?= $assets ?>plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
<script src="<?= $assets ?>plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
<script src="<?= $assets ?>dist/js/pages/purchases.js" type="text/javascript"></script>