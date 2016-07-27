<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title"><?= lang('enter_info'); ?></h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="well well-sm col-sm-6">
                                <?php $attrib = array('data-toggle' => 'validator', 'role' => 'form', 'id' => 'open-register-form');
                                echo form_open_multipart("pos/open_register", $attrib); ?>
                                <div class="form-group">
                                    <?= lang('cash_in_hand', 'cash_in_hand') ?>
                                    <?= form_input('cash_in_hand', '', 'id="cash_in_hand" class="form-control"'); ?>
                                </div>
                                <?php echo form_submit('open_register', lang('open_register'), 'class="btn btn-primary"'); ?>
                                <?php echo form_close(); ?>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>