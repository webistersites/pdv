<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-2x">&times;</i>
            </button>
            <h4 class="modal-title" id="myModalLabel"><?php echo lang('deactivate'); ?></h4>
        </div>
        <?php $attrib = array('data-toggle' => 'validator', 'role' => 'form');
        echo form_open("auth/deactivate/" . $user->id, $attrib); ?>
        <div class="modal-body">
            <p><?php echo sprintf(lang('deactivate_heading'), $user->username); ?></p>

            <div class="form-group">
                <label class="checkbox" for="confirm"><input type="checkbox" name="confirm" value="yes"
                                                             checked="checked" id="confirm"/> <?= lang('yes') ?></label>
            </div>

            <?php echo form_hidden($csrf); ?>
            <?php echo form_hidden(array('id' => $user->id)); ?>

        </div>
        <div class="modal-footer">
            <?php echo form_submit('deactivate', lang('deactivate'), 'class="btn btn-theme03"'); ?>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>
<?= $modal_js ?>
