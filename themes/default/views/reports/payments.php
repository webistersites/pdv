<?php
$v = "?v=1";

if ($this->input->post('payment_ref')) {
    $v .= "&payment_ref=" . $this->input->post('payment_ref');
}
if ($this->input->post('sale_no')) {
    $v .= "&sale_no=" . $this->input->post('sale_no');
}
if ($this->input->post('customer')) {
    $v .= "&customer=" . $this->input->post('customer');
}
if ($this->input->post('paid_by')) {
    $v .= "&paid_by=" . $this->input->post('paid_by');
}
if ($this->input->post('user')) {
    $v .= "&user=" . $this->input->post('user');
}
if ($this->input->post('start_date')) {
    $v .= "&start_date=" . $this->input->post('start_date');
}
if ($this->input->post('end_date')) {
    $v .= "&end_date=" . $this->input->post('end_date');
}
?>
<script>
    $(document).ready(function () {
        var pb = ['<?=lang('cash')?>', '<?=lang('CC')?>', '<?=lang('Cheque')?>', '<?=lang('stripe')?>', '<?=lang('gift_card')?>'];

        function paid_by(x) {
            if (x == 'cash') {
                return pb[0];
            } else if (x == 'CC') {
                return pb[1];
            } else if (x == 'Cheque') {
                return pb[2];
            } else if (x == 'stripe') {
                return pb[3];
            } else if (x == 'gift_card') {
                return pb[4];
            } else {
                return x;
            }
        }

        $('#PayRData').dataTable({
            "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, '<?= lang('all'); ?>']],
            "aaSorting": [[ 0, "desc" ]], "iDisplayLength": <?= $Settings->rows_per_page ?>,
            'bProcessing': true, 'bServerSide': true,
            'sAjaxSource': '<?= site_url('reports/get_payments/'. $v) ?>',
            'fnServerData': function (sSource, aoData, fnCallback) {
                aoData.push({
                    "name": "<?= $this->security->get_csrf_token_name() ?>",
                    "value": "<?= $this->security->get_csrf_hash() ?>"
                });
                $.ajax({'dataType': 'json', 'type': 'POST', 'url': sSource, 'data': aoData, 'success': fnCallback});
            },
            "aoColumns": [{"mRender":hrld}, null, null, {"mRender":paid_by}, {"mRender":currencyFormat}]
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $('#form').hide();
        $('.toggle_form').click(function(){
            $("#form").slideToggle();
            return false;
        });
    });
</script>
<style type="text/css">
    .table td:nth-child(3) { text-align: center; }
</style>
<section class="content">
    <div class="row">
        <div class="col-sm-12">
            <div class="box box-primary">
                <div class="box-header">
                    <a href="#" class="btn btn-default btn-sm toggle_form pull-right"><?= lang("show_hide"); ?></a>
                    <h3 class="box-title"><?= lang('customize_report'); ?><?php
                        if ($this->input->post('start_date')) {
                            echo "From " . $this->input->post('start_date') . " to " . $this->input->post('end_date');
                        }
                        ?></h3>
                    </div>
                    <div class="box-body">
                        <div id="form" class="panel panel-warning">
                            <div class="panel-body">

                                <?= form_open("reports/payments"); ?>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <?= lang("payment_ref", "payment_ref"); ?>
                                            <?= form_input('payment_ref', (isset($_POST['payment_ref']) ? $_POST['payment_ref'] : ""), 'class="form-control tip" id="payment_ref"'); ?>

                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <?= lang("sale_no", "sale_no"); ?>
                                            <?= form_input('sale_no', (isset($_POST['sale_no']) ? $_POST['sale_no'] : ""), 'class="form-control tip" id="sale_no"'); ?>

                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="control-label" for="customer"><?= lang("customer"); ?></label>
                                            <?php
                                            $cu[0] = lang("select")." ".lang("customer");
                                            foreach($customers as $customer){
                                                $cu[$customer->id] = $customer->name;
                                            }
                                            echo form_dropdown('customer', $cu, set_value('customer'), 'class="form-control select2" style="width:100%" id="customer"'); ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="control-label" for="user"><?= lang("created_by"); ?></label>
                                            <?php
                                            $us[""] = "";
                                            foreach ($users as $user) {
                                                $us[$user->id] = $user->first_name . " " . $user->last_name;
                                            }
                                            echo form_dropdown('user', $us, (isset($_POST['user']) ? $_POST['user'] : ""), 'class="form-control select2" id="user" data-placeholder="' . lang("select") . " " . lang("user") . '" style="width:100%;"');
                                            ?>
                                        </div>
                                    </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <?= lang("paid_by", "paid_by"); ?>
                                                <select name="paid_by" id="paid_by" class="form-control paid_by select2" style="width:100%"
                                                required="required">
                                                <option value="cash"><?= lang("cash"); ?></option>
                                                <option value="CC"><?= lang("cc"); ?></option>
                                                <option value="Cheque"><?= lang("cheque"); ?></option>
                                                <option value="gift_card"><?= lang("gift_card"); ?></option>
                                                <?= isset($Settings->stripe) ? '<option value="stripe">' . lang("stripe") . '</option>' : ''; ?>
                                                <option value="other"><?= lang("other"); ?></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <?= lang("start_date", "start_date"); ?>
                                            <?= form_input('start_date', (isset($_POST['start_date']) ? $_POST['start_date'] : ""), 'class="form-control datetimepicker" id="start_date"'); ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <?= lang("end_date", "end_date"); ?>
                                            <?= form_input('end_date', (isset($_POST['end_date']) ? $_POST['end_date'] : ""), 'class="form-control datetimepicker" id="end_date"'); ?>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-primary"><?= lang("submit"); ?></button>
                                    </div>
                                </div>
                                <?= form_close(); ?>

                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="table-responsive">
                            <table id="PayRData"
                            class="table table-bordered table-hover table-striped table-condensed reports-table">
                            <thead>
                                <tr>
                                    <th class="col-xs-3"><?= lang("date"); ?></th>
                                    <th class="col-xs-3"><?= lang("payment_ref"); ?></th>
                                    <th class="col-xs-2"><?= lang("sale_no"); ?></th>
                                    <th class="col-xs-2"><?= lang("paid_by"); ?></th>
                                    <th class="col-xs-2"><?= lang("amount"); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="5" class="dataTables_empty"><?= lang('loading_data_from_server') ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
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
