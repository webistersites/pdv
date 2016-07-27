<script>
    $(document).ready(function () {
        $('#GCData').dataTable({
            "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, '<?= lang('all'); ?>']],
            "aaSorting": [[ 2, "desc" ]], "iDisplayLength": <?= $Settings->rows_per_page ?>,
            'bProcessing': true, 'bServerSide': true,
            'sAjaxSource': '<?= site_url('gift_cards/get_gift_cards') ?>',
            'fnServerData': function (sSource, aoData, fnCallback) {
                aoData.push({
                    "name": "<?= $this->security->get_csrf_token_name() ?>",
                    "value": "<?= $this->security->get_csrf_hash() ?>"
                });
                $.ajax({'dataType': 'json', 'type': 'POST', 'url': sSource, 'data': aoData, 'success': fnCallback});
            },
            "aoColumns": [null, {"mRender":currencyFormat}, {"mRender":currencyFormat}, null, {"mRender":hrsd}, {"bSortable":false, "bSearchable": false}]
        });
    });
</script>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title"><?= lang('list_results'); ?></h3>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                    <table id="GCData" class="table table-bordered table-hover table-striped">
                        <thead>
                        <tr>
                            <th><?php echo $this->lang->line("card_no"); ?></th>
                            <th><?php echo $this->lang->line("value"); ?></th>
                            <th><?php echo $this->lang->line("balance"); ?></th>
                            <th><?php echo $this->lang->line("created_by"); ?></th>
                            <th><?php echo $this->lang->line("expiry"); ?></th>
                            <th style="width:65px;"><?php echo $this->lang->line("actions"); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="6" class="dataTables_empty"><?= lang('loading_data_from_server') ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
</section>
