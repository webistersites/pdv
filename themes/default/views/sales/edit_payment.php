<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
            <h4 class="modal-title" id="myModalLabel"><?php echo lang('edit_payment'); ?></h4>
        </div>
        <?= form_open_multipart("sales/edit_payment/" . $payment->id ."/".$payment->sale_id); ?>
        <div class="modal-body">
            <p><?= lang('enter_info'); ?></p>

            <div class="row">
                <?php if ($Admin) { ?>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <?= lang("date", "date"); ?>
                            <?= form_input('date', (isset($_POST['date']) ? $_POST['date'] : $payment->date), 'class="form-control datetimepicker" id="date" required="required"'); ?>
                        </div>
                    </div>
                <?php } ?>
                <div class="col-sm-6">
                    <div class="form-group">
                        <?= lang("reference", "reference"); ?>
                        <?= form_input('reference', (isset($_POST['reference']) ? $_POST['reference'] : $payment->reference), 'class="form-control tip" id="reference"'); ?>
                    </div>
                </div>

                <input type="hidden" value="<?php echo $payment->sale_id; ?>" name="sale_id"/>
            </div>
            <div class="clearfix"></div>
            <div id="payments">

                <div class="well well-sm well">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="payment">
                                    <div class="form-group">
                                        <?= lang("amount", "amount"); ?>
                                        <input name="amount-paid"
                                               value="<?= $this->tec->formatDecimal($payment->amount); ?>" type="text"
                                               id="amount" class="pa form-control kb-pad amount"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <?= lang("paying_by", "paid_by"); ?>
                                    <select name="paid_by" id="paid_by" class="form-control paid_by select2" style="width:100%;">
                                        <option  value="cash"<?= $payment->paid_by == 'cash' ? ' checked="checcked"' : '' ?>><?= lang("cash"); ?></option>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>

            </div>

            <div class="form-group">
                <?= lang("attachment", "attachment") ?>
                <input id="attachment" type="file" name="userfile" data-show-upload="false" data-show-preview="false"
                       class="form-control file">
            </div>

            <div class="form-group">
                <?= lang("note", "note"); ?>
                <?php echo form_textarea('note', (isset($_POST['note']) ? $_POST['note'] : $payment->note), 'class="form-control redactor" id="note"'); ?>
            </div>

        </div>
        <div class="modal-footer">
            <?php echo form_submit('edit_payment', lang('edit_payment'), 'class="btn btn-primary"'); ?>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>

<script src="<?= $assets ?>dist/js/pages/modal.js" type="text/javascript"></script>
<script src="<?= $assets ?>plugins/bootstrap-datetimepicker/js/moment.min.js" type="text/javascript"></script>
<script src="<?= $assets ?>plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function () {
        $('.datetimepicker').datetimepicker({
            format: 'YYYY-MM-DD HH:mm'
        });
    });
</script>
