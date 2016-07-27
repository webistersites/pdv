<script>
	$(document).ready(function () {
		$('#OBData').dataTable({
			"aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, '<?= lang('all'); ?>']],
            "aaSorting": [[ 0, "desc" ]], "iDisplayLength": <?= $Settings->rows_per_page ?>,
			'bProcessing': true, 'bServerSide': true,
            'sAjaxSource': '<?= site_url('sales/get_opened_list') ?>',
            'fnServerData': function (sSource, aoData, fnCallback) {
                aoData.push({
                    "name": "<?= $this->security->get_csrf_token_name() ?>",
                    "value": "<?= $this->security->get_csrf_hash() ?>"
                });
                $.ajax({'dataType': 'json', 'type': 'POST', 'url': sSource, 'data': aoData, 'success': fnCallback});
            },
            "aoColumns": [{"mRender":hrld}, null, null, null, {"mRender":currencyFormat}, {"bSortable":false, "bSearchable": false}]
		});
	});
</script>
<style type="text/css">.table td:nth-child(4), .table td:nth-child(5) { text-align: right; }</style>
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title"><?= lang('list_results'); ?></h3>
				</div>
				<div class="box-body">
					<div class="table-responsive">
						<table id="OBData" class="table table-striped table-bordered table-condensed table-hover" style="margin-bottom:5px;">
							<thead>
								<tr class="active">
									<th class="col-xs-2"><?php echo $this->lang->line("date"); ?></th>
									<th class="col-xs-2"><?php echo $this->lang->line("customer"); ?></th>
									<th><?php echo $this->lang->line("reference_note"); ?></th>
									<th class="col-xs-1"><?php echo $this->lang->line("total_items"); ?></th>
									<th class="col-xs-1"><?php echo $this->lang->line("grand_total"); ?></th>
									<th style="width:85px; text-align:center;"><?php echo $this->lang->line("actions"); ?></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td colspan="6" class="dataTables_empty"><?= lang('loading_data_from_server'); ?></td>
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
