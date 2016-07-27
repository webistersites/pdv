<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-users"></i><?= lang('edit_user_heading'); ?></h2>
    </div>
    <div class="box-content">
        <div class="row">
            <div class="col-lg-12">

                <p class="introtext"><?= lang('edit_user_subheading'); ?></p>

                <?php echo form_open(uri_string(), 'class="form-horizontal" role="form"'); ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-5">
                            <div class="form-group">
                                <?php echo lang('edit_user_fname_label', 'first_name'); ?>
                                <div class="controls">
                                    <?php echo form_input($first_name); ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <?php echo lang('edit_user_lname_label', 'last_name'); ?>
                                <div class="controls">
                                    <?php echo form_input($last_name); ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <?php echo lang('edit_user_company_label', 'company'); ?>
                                <div class="controls">
                                    <?php echo form_input($company); ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <?php echo lang('edit_user_phone_label', 'phone'); ?>
                                <div class="controls">
                                    <?php echo form_input($phone); ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 col-md-offset-1">
                            <div class="form-group">
                                <?php echo lang('edit_user_password_label', 'password'); ?>
                                <div class="controls">
                                    <?php echo form_input($password); ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <?php echo lang('edit_user_password_confirm_label', 'password_confirm'); ?>
                                <div class="controls">
                                    <?php echo form_input($password_confirm); ?>
                                </div>
                            </div>

                            <h3><?php echo lang('edit_user_groups_heading'); ?></h3>
                            <?php foreach ($groups as $group): ?>
                                <label class="checkbox">
                                    <?php
                                    $gID = $group['id'];
                                    $checked = null;
                                    $item = null;
                                    foreach ($currentGroups as $grp) {
                                        if ($gID == $grp->id) {
                                            $checked = ' checked="checked"';
                                            break;
                                        }
                                    }
                                    ?>
                                    <input type="checkbox" name="groups[]"
                                           value="<?php echo $group['id']; ?>"<?php echo $checked; ?> checked
                                           data-on-label="Yes" data-off-label="No">
                                    <?php echo $group['name']; ?>
                                </label>
                            <?php endforeach ?>
                            <p>
                                <?php echo form_hidden('id', $user->id); ?>
                                <?php echo form_hidden($csrf); ?>
                            </p>
                        </div>
                    </div>
                </div>
                <p><?php echo form_submit('submit', lang('edit_user_submit_btn'), 'class="btn btn-lg btn-theme03"'); ?></p>

                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>