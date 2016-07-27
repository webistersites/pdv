<?php
$v = "?v=1";

    if($this->input->post('product')){
        $v .= "&product=".$this->input->post('product');
    }
    if($this->input->post('start_date')){
        $v .= "&start_date=".$this->input->post('start_date');
    }
    if($this->input->post('end_date')) {
        $v .= "&end_date=".$this->input->post('end_date');
    }


?>

<script>
    $(document).ready(function() {
        function image(n) {
            if(n !== null) {
                return '<div style="width:32px; margin: 0 auto;"><a href="<?=base_url();?>uploads/'+n+'" class="open-image"><img src="<?=base_url();?>uploads/thumbs/'+n+'" alt="" class="img-responsive"></a></div>';
            }
            return '';
        }
        function method(n) {
            return (n == 0) ? '<span class="label label-primary"><?= lang('inclusive'); ?></span>' : '<span class="label label-warning"><?= lang('exclusive'); ?></span>';
        }
        $('#fileData').dataTable( {
            "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, '<?= lang('all'); ?>']],
            "aaSorting": [[ 1, "asc" ]], "iDisplayLength": <?= $Settings->rows_per_page ?>,
            'bProcessing': true, 'bServerSide': true,
            'sAjaxSource': '<?= site_url('reports/get_products/'. $v) ?>',
            'fnServerData': function (sSource, aoData, fnCallback) {
                aoData.push({
                    "name": "<?= $this->security->get_csrf_token_name() ?>",
                    "value": "<?= $this->security->get_csrf_hash() ?>"
                });
                $.ajax({'dataType': 'json', 'type': 'POST', 'url': sSource, 'data': aoData, 'success': fnCallback});
            },
            "aoColumns": [null, null, {"bSearchable": false}, {"mRender":currencyFormat, "bSearchable": false}, {"mRender":currencyFormat, "bSearchable": false}, {"mRender":currencyFormat, "bSearchable": false}, {"mRender":currencyFormat, "bSearchable": false}]
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

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <a href="#" class="btn btn-default btn-sm toggle_form pull-right"><?= lang("show_hide"); ?></a>
                    <h3 class="box-title"><?= lang('customize_report'); ?></h3>
                </div>
                <div class="box-body">
                    <div id="form" class="panel panel-warning">
                        <div class="panel-body">
                        <?= form_open("reports/products");?>

                        <div class="row">
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <label class="control-label" for="product"><?= lang("product"); ?></label>
                                    <?php
                                    $pr[0] = lang("select")." ".lang("product");
                                    foreach($products as $product){
                                        $pr[$product->id] = $product->name;
                                    }
                                    echo form_dropdown('product', $pr, set_value('product'), 'class="form-control select2" style="width:100%" id="product"');
                                    ?>
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <label class="control-label" for="start_date"><?= lang("start_date"); ?></label>
                                    <?= form_input('start_date', set_value('start_date'), 'class="form-control" id="start_date"');?>
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <label class="control-label" for="end_date"><?= lang("end_date"); ?></label>
                                    <?= form_input('end_date', set_value('end_date'), 'class="form-control" id="end_date"');?>
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <button type="submit" class="btn btn-primary"><?= lang("submit"); ?></button>
                            </div>
                        </div>
                        <?= form_close();?>
                    </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="row">
                        <div class="col-xs-12">
                            <div class="table-responsive">
                                <table id="fileData" class="table table-striped table-bordered table-hover" style="margin-bottom:5px;">
                                    <thead>
                                        <tr class="active">
                                            <th><?= lang("name"); ?></th>
                                            <th class="col-xs-2"><?= lang("code"); ?></th>
                                            <th class="col-xs-1"><?= lang("sold"); ?></th>
                                            <th class="col-xs-1"><?= lang("tax"); ?></th>
                                            <th class="col-xs-1"><?= lang("cost"); ?></th>
                                            <th class="col-xs-1"><?= lang("income"); ?></th>
                                            <th class="col-xs-1"><?= lang("profit"); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="9" class="dataTables_empty"><?= lang('loading_data_from_server'); ?></td>
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
