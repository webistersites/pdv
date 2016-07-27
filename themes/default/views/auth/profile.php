<?php (defined('BASEPATH')) OR exit('No direct script access allowed'); ?>

<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#edit_profile"><?= lang('edit'); ?></a></li>
                    <li><a data-toggle="tab" href="#cpassword"><?= lang('change_password'); ?></a></li>
                </ul>
                <div class="tab-content">
                    <div id="edit_profile" class="tab-pane active">
                        <div class="col-lg-6">
                            <p><?= lang('update_info'); ?></p>
                            <?=form_open('auth/edit_user/' . $user->id);?>
                            <div class="form-group">
                                <?= lang('first_name', 'first_name'); ?>
                                <?= form_input('first_name', $user->first_name, 'class="form-control tip" id="first_name"  required="required"'); ?>
                            </div>
                            <div class="form-group">
                                <?= lang('last_name', 'last_name'); ?>
                                <?= form_input('last_name', $user->last_name, 'class="form-control tip" id="last_name"  required="required"'); ?>
                            </div>
                            <div class="form-group">
                                <?= lang('phone', 'phone'); ?>
                                <?= form_input('phone', $user->phone, 'class="form-control tip" id="phone"  required="required"'); ?>
                            </div>
                            <div class="form-group">
                                <?= lang('gender', 'gender'); ?>
                                <?php $gnders = array('male' => lang('male'), 'female' => lang('female')); ?>
                                <?= form_dropdown('gender', $gnders, $user->gender, 'class="form-control tip select2" style="width:100%;" id="gender"  required="required"'); ?>
                            </div>

                            <?php if ($Admin && $id != $this->session->userdata('user_id')) { ?>

                                <div class="form-group">
                                    <?= lang("group", "group"); ?>
                                    <?php
                                    $gp[""] = "";
                                    foreach ($groups as $group) {
                                        $gp[$group['id']] = $group['name'];
                                    }
                                    echo form_dropdown('group', $gp, $user->group_id, 'id="group" data-placeholder="' . lang("select") . ' ' . lang("group") . '" class="form-control input-tip select2" style="width:100%;"');
                                    ?>
                                </div>

                                <div class="form-group">
                                    <?= lang('username', 'username'); ?>
                                    <?= form_input('username', $user->username, 'class="form-control tip" id="username"  required="required"'); ?>
                                </div>
                                <div class="form-group">
                                    <?= lang('email', 'email'); ?>
                                    <?= form_input('email', $user->email, 'class="form-control tip" id="email"  required="required"'); ?>
                                </div>

                                <div class="panel panel-warning">
                                    <div class="panel-heading"><?= lang('if_you_need_to_rest_password_for_user') ?></div>
                                    <div class="panel-body" style="padding: 5px;">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <?php echo lang('password', 'password'); ?>
                                                    <?php echo form_input($password); ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <?php echo lang('confirm_password', 'password_confirm'); ?>
                                                    <?php echo form_input($password_confirm); ?>
                                                </div>
                                            </div>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <?= lang('status', 'status'); ?>
                                    <?php
                                    $opt = array('' => '', 1 => lang('active'), 0 => lang('inactive'));
                                    echo form_dropdown('status', $opt, $user->active, 'id="status" data-placeholder="' . lang("select") . ' ' . lang("status") . '" class="form-control input-tip select2" style="width:100%;"');
                                    ?>
                                </div>
                            <?php } ?>

                            <?php echo form_hidden('id', $id); ?>
                            <?php echo form_hidden($csrf); ?>
                            <div class="form-group">
                                <?= form_submit('update_user', lang('update'), 'class="btn btn-primary"'); ?>
                            </div>
                            <?= form_close(); ?>
                            <div class="clearfix"></div>
                        </div>
                    </div>

                    <div id="cpassword" class="tab-pane">
                        <div class="col-lg-6">
                            <div class="white-panel">
                                <p><?= lang('update_info'); ?></p>
                                <?php echo form_open("auth/change_password"); ?>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <?php echo lang('old_password', 'curr_password'); ?> <br/>
                                            <?php echo form_password('old_password', '', 'class="form-control" id="curr_password"'); ?>
                                        </div>
                                        <div class="form-group">
                                            <label
                                                for="new_password"><?php echo sprintf(lang('new_password'), $min_password_length); ?></label>
                                            <br/>
                                            <?php echo form_password('new_password', '', 'class="form-control" id="new_password" pattern=".{8,}"'); ?>
                                        </div>

                                        <div class="form-group">
                                            <?php echo lang('confirm_password', 'new_password_confirm'); ?> <br/>
                                            <?php echo form_password('new_password_confirm', '', 'class="form-control" id="new_password_confirm" pattern=".{8,}"'); ?>

                                        </div>

                                        <?php echo form_input($user_id); ?>
                                        <div class="form-group">
                                            <?php echo form_submit('change_password', lang('change_password'), 'class="btn btn-primary"'); ?>
                                        </div>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</section>

