<?php (defined('BASEPATH')) OR exit('No direct script access allowed'); ?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?= $page_title.' | '.$Settings->site_name; ?></title>
    <link rel="shortcut icon" href="<?= $assets ?>images/icon.png"/>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link href="<?= $assets ?>bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= $assets ?>dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= $assets ?>plugins/iCheck/square/green.css" rel="stylesheet" type="text/css" />
</head>
<body class="login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="<?=base_url();?>"><?= $Settings->site_name == 'SimplePOS' ? 'Simple<b>POS</b>' : '<img src="'.base_url('uplaods/'.$Settings->logo).'" alt="'.$Settings->site_name.'" />'; ?></a>
        </div>
        <div class="login-box-body">
            <?php if($error)  { ?>
            <div class="alert alert-danger alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                <?= $error; ?>
            </div>
            <?php } if($message) { ?>
            <div class="alert alert-success alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                <?= $message; ?>
            </div>
            <?php } ?>
            <?= form_open('auth/reset_password/' . $code); ?>
            <p><?php echo sprintf(lang('reset_password_email'), $identity_label); ?></p>
            <!-- <input type="text" class="form-control" name="identity" placeholder="<?= lang('email'); ?>" autofocus> -->
            <?php echo form_input($new_password, '', 'placeholder="'.lang('new_password').'"'); ?>
            <br>
            <!-- <input type="password" class="form-control" name="password" placeholder="<?= lang('password'); ?>"> -->
            <?php echo form_input($new_password_confirm, '', 'placeholder="'.lang('confirm_password').'"'); ?>
            <?php echo form_input($user_id); ?>
            <?php echo form_hidden($csrf); ?>
            <br>
            <!-- <div class="form-group has-feedback">
                <input type="email" name="identity" value="<?= set_value('identity'); ?>" class="form-control" placeholder="<?= lang('email'); ?>" />
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" name="password" class="form-control" placeholder="<?= lang('password'); ?>" />
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div> -->

            <button type="submit" class="btn btn-primary btn-block btn-flat"><?= lang('submit'); ?></button>

            <?= form_close(); ?>

            <div class="">
                <p>&nbsp;</p>
                <p><span class="text-success"><a href="<?= site_url('login'); ?>"><?= lang('back_to_login'); ?></a></span></p>

                </div>

            </div>
        </div>

</body>
</html>
