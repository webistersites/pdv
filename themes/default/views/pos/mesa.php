<?php (defined('BASEPATH')) OR exit('No direct script access allowed'); ?>
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"><i class="fa fa-times"></i></span><span class="sr-only"><?=lang('close');?></span></button>
            <h4 class="modal-title" id="mModalLabel"><?= lang('Mesas') ?></h4>
        </div>
        <div class="modal-body" id="pr_popover_content">
            <table class="table table-bordered table-condensed"
            style="margin-bottom: 0px;">
            <thead>
                <tr>
                    <th>Salão</th>
                </tr>
            </thead>
            <tbody>
            	<img src="<?= $assets ?>images/mesa-free.png">
            </tbody>
        </table>
    </div>
</div>
</div>