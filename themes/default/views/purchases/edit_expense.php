
<?php (defined('BASEPATH')) OR exit('No direct script access allowed'); ?>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title"><?= lang('update_info'); ?></h3>
                </div>
                <div class="box-body">
                    <div class="col-md-6">
                        <?= form_open_multipart("purchases/edit_expense/".$expense->id); ?>

                        <?php if ($Admin) { ?>
                            <div class="form-group">
                                <?= lang("date", "date"); ?>
                                <?= form_input('date', (isset($_POST['date']) ? $_POST['date'] : $expense->date), 'class="form-control datetimepicker" id="date" required="required"'); ?>
                            </div>
                            <?php } ?>

                            <div class="form-group">
                                <?= lang("reference", "reference"); ?>
                                <?= form_input('reference', (isset($_POST['reference']) ? $_POST['reference'] : $expense->reference), 'class="form-control tip" id="reference"'); ?>
                            </div>

                            <div class="form-group">
                                <?= lang("amount", "amount"); ?>
                                <?= form_input('amount', (isset($_POST['amount']) ? $_POST['amount'] : $expense->amount), 'class="form-control tip" id="amount"'); ?>
                            </div>

                            <div class="form-group">
                                <?= lang("attachment", "attachment") ?>
                                <input type="file" name="userfile" class="form-control file">
                            </div>

                            <div class="form-group">
                                <?= lang("note", "note"); ?>
                                <?php echo form_textarea('note', (isset($_POST['note']) ? $_POST['note'] : $expense->note), 'class="form-control redactor" id="note"'); ?>
                            </div>

                            <div class="form-group">
                                <?php echo form_submit('edit_expense', lang('edit_expense'), 'class="btn btn-primary"'); ?>
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
</section>

<script src="<?= $assets ?>plugins/bootstrap-datetimepicker/js/moment.min.js" type="text/javascript"></script>
<script src="<?= $assets ?>plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function () {
        $('.datetimepicker').datetimepicker({
            format: 'YYYY-MM-DD HH:mm'
        });
    });
</script>
