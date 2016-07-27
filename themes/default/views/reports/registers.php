<?php

$v = "?v=1";

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
        function total_cash(x) {
            if(x !== null) {
                var y = x.split(' (');
                    var z = y[1].split(')');
                    return currencyFormat(y[0])+'<span class="text-success">'+currencyFormat(z[0])+'</span><span class="text-danger topborder">'+currencyFormat(y[0]-z[0])+'</span>';
                }
                return '';
            }
            function total_sub(x) {
                if(x !== null) {
                    var y = x.split(' (');
                        var z = y[0].split(')');
                        return y[0]+'<br><span class="text-success">'+z[0]+'</span><span class="text-danger topborder"><div>'+(y[0]-z[0])+'</div></span>';
                    }
                    return '';
                }
                function closed_at(x) {
                        return (x !== null) ? hrld(x) : '';
                }
        $('#registerTable').dataTable({
            "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, '<?= lang('all'); ?>']],
            "aaSorting": [[ 0, "desc" ]], "iDisplayLength": <?= $Settings->rows_per_page ?>,
            'bProcessing': true, 'bServerSide': true,
            'sAjaxSource': '<?= site_url('reports/get_register_logs/'. $v) ?>',
            'fnServerData': function (sSource, aoData, fnCallback) {
                aoData.push({
                    "name": "<?= $this->security->get_csrf_token_name() ?>",
                    "value": "<?= $this->security->get_csrf_hash() ?>"
                });
                $.ajax({'dataType': 'json', 'type': 'POST', 'url': sSource, 'data': aoData, 'success': fnCallback});
            },
            "aoColumns": [{"mRender":hrld}, {"mRender":closed_at}, null,  {"mRender":currencyFormat}, {"mRender":total_sub}, {"mRender":total_sub}, {"mRender":total_cash}, null]
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
    .table td:nth-child(5), .table td:nth-child(6) { text-align: center; }
    .topborder div { border-top: 1px solid #CCC; }
</style>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
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

                                <?= form_open("reports/registers"); ?>
                                <div class="row">

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="control-label" for="user"><?= lang("user"); ?></label>
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
                                            <?= lang("start_date", "start_date"); ?>
                                            <?= form_input('start_date', set_value('start_date'), 'class="form-control datetime datetimepicker" id="start_date"'); ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <?= lang("end_date", "end_date"); ?>
                                            <?= form_input('end_date', set_value('end_date', date('Y-m-d H:i')), 'class="form-control datetime datetimepicker" id="end_date"'); ?>
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
                            <table id="registerTable" cellpadding="0" cellspacing="0" border="0"
                            class="table table-bordered table-hover table-striped reports-table">
                            <thead>
                                <tr>
                                    <th class="col-xs-2"><?= lang('open_time'); ?></th>
                                    <th class="col-xs-2"><?= lang('close_time'); ?></th>
                                    <th class="col-xs-1"><?= lang('user'); ?></th>
                                    <th class="col-xs-1"><?= lang('cash_in_hand'); ?></th>
                                    <th class="col-xs-1"><?= lang('cc_slips'); ?></th>
                                    <th class="col-xs-1"><?= lang('Cheques'); ?></th>
                                    <th class="col-xs-1"><?= lang('total_cash'); ?></th>
                                    <th class="col-xs-3"><?= lang('note'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="8" class="dataTables_empty"><?= lang('loading_data_from_server') ?></td>
                                </tr>
                            </tbody>
                        </table>
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
