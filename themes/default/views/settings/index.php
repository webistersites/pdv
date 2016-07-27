<?php (defined('BASEPATH')) OR exit('No direct script access allowed'); ?>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title"><?= lang('update_info'); ?></h3>
                </div>
                <div class="box-body">
                    <div class="col-lg-12">
                        <?= form_open_multipart("settings", 'class="validation"'); ?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?= lang("site_name", 'site_name'); ?>
                                    <?= form_input('site_name', $settings->site_name, 'class="form-control" id="site_name" required="required"'); ?>
                                </div>
                                <div class="form-group">
                                    <?= lang("tel", 'tel'); ?>
                                    <?= form_input('tel', $settings->tel, 'class="form-control" id="tel" required="required"'); ?>
                                </div>
                                <div class="form-group">
                                    <?= lang('language', 'language'); ?>
                                    <?php $available_langs = array(
                                        'english' => 'English'
                                    ); ?>
                                    <?= form_dropdown('language', $available_langs, $settings->language, 'class="form-control tip select2" id="language"  required="required" style="width:100%;"'); ?>
                                </div>
                                <div class="form-group">
                                    <?= lang("currency_code", 'currency_code'); ?>
                                    <?= form_input('currency_prefix', $settings->currency_prefix, 'class="form-control" id="currency_code" required="required"'); ?>
                                </div>

                                <div class="form-group">
                                    <?= lang("default_discount", 'default_discount'); ?>
                                    <?= form_input('default_discount', $settings->default_discount, 'class="form-control" id="default_discount" required="required"'); ?>
                                </div>
                                <div class="form-group">
                                    <?= lang("default_order_tax", 'default_tax_rate'); ?>
                                    <?= form_input('tax_rate', $settings->default_tax_rate, 'class="form-control" id="default_tax_rate" required="required"'); ?>
                                </div>
                                <div class="form-group">
                                    <?= lang('row_per_page', 'rows_per_page') ?>
                                    <?php
                                    $rw = array('10' => '10', '25' => '25', '50' => '50', '100' => '100');
                                    echo form_dropdown('rows_per_page', $rw, $settings->rows_per_page, 'class="form-control select2" id="rows_per_page" style="width:100%;" required="required"') ?>
                                </div>
                                <div class="form-group">
                                    <?= lang('rounding', 'rounding'); ?>
                                    <?php
                                    $rnd = array('0' => lang('disable'), '1' => lang('to_nearest_005'), '2' => lang('to_nearest_050'), '3' => lang('to_nearest_number'), '4' => lang('to_next_number'));
                                    echo form_dropdown('rounding', $rnd, $settings->rounding, 'class="form-control select2" id="rounding" required="required"');
                                    ?>
                                </div>
                                <div class="form-group">
                                    <?= lang('display_product', 'display_product') ?>
                                    <?php
                                    $dprv = array('1' => 'Name', '2' => 'Photo', '3' => 'Both');
                                    echo form_dropdown('display_product', $dprv, $settings->bsty, 'class="form-control select2" id="display_product" style="width:100%;" required="required"') ?>
                                </div>
                                <div class="form-group">
                                    <?= lang('pro_limit', 'pro_limit') ?>
                                    <?= form_input('pro_limit', $settings->pro_limit, 'class="form-control" id="pro_limit" required="required"') ?>
                                </div>

                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <?= lang('delete_code', 'pin_code'); ?>
                                    <?php echo form_password('pin_code', $settings->pin_code, 'class="form-control" pattern="[0-9]{4,8}"id="pin_code"'); ?>
                                </div>
                                <div class="form-group">
                                    <?= lang('display_kb', 'display_kb') ?>
                                    <?php
                                    $dtime = array('1' => lang('yes'), '0' => lang('no'));
                                    echo form_dropdown('display_kb', $dtime, $settings->display_kb, 'class="form-control select2" id="display_kb" style="width:100%;" required="required"') ?>
                                </div>
                                <div class="form-group">
                                    <?= lang("item_addition", "item_addition"); ?>
                                    <?php
                                    $ia = array(0 => lang('add_new_item'), 1 => lang('increase_quantity_if_item_exist'));
                                    echo form_dropdown('item_addition', $ia, $Settings->item_addition, 'id="item_addition" class="form-control tip select2" required="required" style="width:100%;"');
                                    ?>
                                </div>
                                <div class="form-group">
                                    <?= lang('default_category', 'default_category') ?>
                                    <?php
                                    foreach ($categories as $catrgory) {
                                        $ct[$catrgory->id] = $catrgory->name;
                                    }
                                    echo form_dropdown('default_category', $ct, $settings->default_category, 'class="form-control select2" style="width:100%;" id="default_category" required="required"') ?>
                                </div>

                                <div class="form-group">
                                    <?= lang("default_customer", 'default_customer'); ?>
                                    <?php
                                    foreach ($customers as $customer) {
                                        $cu[$customer->id] = $customer->name;
                                    }
                                    echo form_dropdown('default_customer', $cu, $settings->default_customer, 'class="form-control select2" style="width:100%;" id="default_customer" required="required"'); ?>
                                </div>

                                <div class="form-group">
                                    <div class="form-group">
                                        <?= lang('dateformat', 'dateformat'); ?> <a href="http://php.net/manual/en/function.date.php" target="_blank"><i class="fa fa-external-link"></i></a>
                                        <?= form_input('dateformat', $settings->dateformat, 'class="form-control tip" id="dateformat"  required="required"'); ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <?= lang('timeformat', 'timeformat'); ?>
                                    <?= form_input('timeformat', $settings->timeformat, 'class="form-control tip" id="timeformat"  required="required"'); ?>
                                </div>

                                <div class="form-group">
                                    <?= lang('default_email', 'default_email'); ?>
                                    <?= form_input('default_email', $settings->default_email, 'class="form-control tip" id="default_email" required="required"'); ?>
                                </div>

                                <div class="form-group">
                                    <?= lang("email_protocol", 'protocol'); ?>
                                    <div class="controls">
                                        <?php
                                        $popt = array('mail' => 'PHP Mail Function', 'sendmail' => 'Send Mail', 'smtp' => 'SMTP');
                                        echo form_dropdown('protocol', $popt, $Settings->protocol, 'class="form-control tip select2" id="protocol" style="width:100%;" required="required"');
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="row" id="sendmail_config" style="display: none;">
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?= lang("mailpath", 'mailpath'); ?>
                                            <div class="controls"> <?php echo form_input('mailpath', $Settings->mailpath, 'class="form-control tip" id="mailpath"'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="row" id="smtp_config" style="display: none;">
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?= lang("smtp_host", 'smtp_host'); ?>
                                            <div class="controls"> <?php echo form_input('smtp_host', $Settings->smtp_host, 'class="form-control tip" id="smtp_host"'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?= lang("smtp_user", 'smtp_user'); ?>
                                            <div class="controls"> <?php echo form_input('smtp_user', $Settings->smtp_user, 'class="form-control tip" id="smtp_user"'); ?> </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?= lang("smtp_pass", 'smtp_pass'); ?>
                                            <div class="controls"> <?php echo form_password('smtp_pass', $smtp_pass, 'class="form-control tip" id="smtp_pass"'); ?> </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?= lang("smtp_port", 'smtp_port'); ?>
                                            <div class="controls"> <?php echo form_input('smtp_port', $Settings->smtp_port, 'class="form-control tip" id="smtp_port"'); ?> </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?= lang("smtp_crypto", 'smtp_crypto'); ?>
                                            <?php
                                            $crypto_opt = array('' => lang('none'), 'tls' => 'TLS', 'ssl' => 'SSL');
                                            echo form_dropdown('smtp_crypto', $crypto_opt, $Settings->smtp_crypto, 'class="form-control tip select2" id="smtp_crypto" style="width:100%;"');
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="well well-sm">
                                    <div class="col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <?= lang('enable_java_applet', 'enable_java_applet'); ?>
                                            <?php $yn = array('1' => lang('yes'), '0' => lang('no')); ?>
                                            <?= form_dropdown('enable_java_applet', $yn, $Settings->java_applet, 'class="form-control select2" id="enable_java_applet" required="required" style="width:100%;"');
                                            ?>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div id="jac" class="col-md-12" style="display: none;">
                                        <div class="row">
                                            <div class="col-md-3 col-sm-3">
                                                <div class="form-group">
                                                    <?= lang('receipt_printer', 'rec1'); ?>
                                                    <?php echo form_input('receipt_printer', $Settings->receipt_printer, 'class="form-control tip" id="rec1"'); ?>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-sm-3">
                                                <div class="form-group">
                                                    <?= lang('char_per_line', 'char_per_line'); ?>
                                                    <?php echo form_input('char_per_line', $Settings->char_per_line, 'class="form-control tip" id="char_per_line" placeholder="' . lang('char_per_line') . '"'); ?>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-sm-3">
                                                <div class="form-group">
                                                    <?= lang('cash_drawer_codes', 'cash1'); ?>
                                                    <?php echo form_input('cash_drawer_codes', $Settings->cash_drawer_codes, 'class="form-control tip" id="cash1" placeholder="Hex value (x1C)"'); ?>
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-sm-3">
                                                <div class="form-group">
                                                    <?= lang('pos_list_printers', 'pos_printers'); ?>
                                                    <?php echo form_input('pos_printers', $Settings->pos_printers, 'class="form-control tip" id="pos_printers"'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="well well-sm">
                                            <p>Please add <strong><?= base_url() ?></strong> to your java Exception Site List under
                                                Security tab.</p>

                                                <p><strong>Access Java Control Panel</strong></p>
                                                <pre><strong>Windows:</strong> Control Panel > (Java Icon) Java > Security tab > Exception Site List > Edit Site List > add<br><strong>Mac:</strong> System Preferences > (Java Icon) Java > Security tab > Exception Site List > Edit Site List > add</pre>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="well well-sm">
                                        <?php
                                        if (isset($stripe_balance)) {
                                            echo '<div class="alert alert-success"><button data-dismiss="alert" class="close" type="button">×</button><h2>' . lang('stripe_balance') . '</h2>';
                                            echo '<p>' . lang('pending_amount') . ': ' . $stripe_balance['pending_amount'] . ' (' . $stripe_balance['pending_currency'] . ')';
                                            echo ', ' . lang('available_amount') . ': ' . $stripe_balance['available_amount'] . ' (' . $stripe_balance['available_currency'] . ')</p>';
                                            echo '</div>';
                                        }
                                        ?>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <?= lang('stripe', 'stripe'); ?>
                                                <?php $ed = array('0' => lang('disable'), '1' => lang('enable')); ?>
                                                <?= form_dropdown('stripe', $ed, $Settings->stripe, 'class="form-control select2" id="stripe" required="required"'); ?>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div id="stripe_con">
                                            <div class="col-md-6 col-sm-6">
                                                <div class="form-group">
                                                    <?= lang('stripe_secret_key', 'stripe_secret_key'); ?>
                                                    <?php echo form_input('stripe_secret_key', $Settings->stripe_secret_key, 'class="form-control tip" id="stripe_secret_key"'); ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-6">
                                                <div class="form-group">
                                                    <?= lang('stripe_publishable_key', 'stripe_publishable_key'); ?>
                                                    <?php echo form_input('stripe_publishable_key', $Settings->stripe_publishable_key, 'class="form-control tip" id="stripe_publishable_key"'); ?>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="well well-sm">
                                        <p><?= lang('shortcut_heading') ?></p>

                                        <div class="col-md-4 col-sm-4">
                                            <div class="form-group">
                                                <?= lang('focus_add_item', 'focus_add_item'); ?>
                                                <?php echo form_input('focus_add_item', $Settings->focus_add_item, 'class="form-control tip" id="focus_add_item"'); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-4">
                                            <div class="form-group">
                                                <?= lang('add_customer', 'add_customer'); ?>
                                                <?php echo form_input('add_customer', $Settings->add_customer, 'class="form-control tip" id="add_customer"'); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-4">
                                            <div class="form-group">
                                                <?= lang('toggle_category_slider', 'toggle_category_slider'); ?>
                                                <?php echo form_input('toggle_category_slider', $Settings->toggle_category_slider, 'class="form-control tip" id="toggle_category_slider"'); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-4">
                                            <div class="form-group">
                                                <?= lang('cancel_sale', 'cancel_sale'); ?>
                                                <?php echo form_input('cancel_sale', $Settings->cancel_sale, 'class="form-control tip" id="cancel_sale"'); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-4">
                                            <div class="form-group">
                                                <?= lang('suspend_sale', 'suspend_sale'); ?>
                                                <?php echo form_input('suspend_sale', $Settings->suspend_sale, 'class="form-control tip" id="suspend_sale"'); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-4">
                                            <div class="form-group">
                                                <?= lang('print_order', 'print_order'); ?>
                                                <?php echo form_input('print_order', $Settings->print_order, 'class="form-control tip" id="print_order"'); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-4">
                                            <div class="form-group">
                                                <?= lang('print_bill', 'print_bill'); ?>
                                                <?php echo form_input('print_bill', $Settings->print_bill, 'class="form-control tip" id="print_bill"'); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-4">
                                            <div class="form-group">
                                                <?= lang('finalize_sale', 'finalize_sale'); ?>
                                                <?php echo form_input('finalize_sale', $Settings->finalize_sale, 'class="form-control tip" id="finalize_sale"'); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-4">
                                            <div class="form-group">
                                                <?= lang('today_sale', 'today_sale'); ?>
                                                <?php echo form_input('today_sale', $Settings->today_sale, 'class="form-control tip" id="today_sale"'); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-4">
                                            <div class="form-group">
                                                <?= lang('open_hold_bills', 'open_hold_bills'); ?>
                                                <?php echo form_input('open_hold_bills', $Settings->open_hold_bills, 'class="form-control tip" id="open_hold_bills"'); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-4">
                                            <div class="form-group">
                                                <?= lang('close_register', 'close_register'); ?>
                                                <?php echo form_input('close_register', $Settings->close_register, 'class="form-control tip" id="close_register"'); ?>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <?= lang('login_logo', 'logo'); ?>
                                        <input type="file" name="userfile" id="logo">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?= lang("bill_header", 'bill_header'); ?>
                                        <?= form_textarea('bill_header', $settings->header, 'class="form-control redactor" id="bill_header"'); ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?= lang("bill_footer", 'bill_footer'); ?>
                                        <?= form_textarea('bill_footer', $settings->footer, 'class="form-control redactor" id="bill_footer"'); ?>
                                    </div>
                                </div>
                            </div>
                            <?= form_submit('update', lang('update_settings'), 'class="btn btn-primary"'); ?>
                            <?= form_close(); ?>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script type="text/javascript">
        $(document).ready(function() {
            if ($('#protocol').val() == 'smtp') {
                $('#smtp_config').slideDown();
            } else if ($('#protocol').val() == 'sendmail') {
                $('#sendmail_config').slideDown();
            }
            $('#protocol').change(function () {
                if ($(this).val() == 'smtp') {
                    $('#sendmail_config').slideUp();
                    $('#smtp_config').slideDown();
                } else if ($(this).val() == 'sendmail') {
                    $('#smtp_config').slideUp();
                    $('#sendmail_config').slideDown();
                } else {
                    $('#smtp_config').slideUp();
                    $('#sendmail_config').slideUp();
                }
            });
            if ($('#stripe').val() == 0) {
                $('#stripe_con').slideUp();
            } else {
                $('#stripe_con').slideDown();
            }
            $('#stripe').change(function () {
                if ($(this).val() == 0) {
                    $('#stripe_con').slideUp();
                } else {
                    $('#stripe_con').slideDown();
                }
            });

            $('#enable_java_applet').change(function () {
                var ja = $(this).val();
                if (ja == 1) {
                    $('#jac').slideDown();
                } else {
                    $('#jac').slideUp();
                }
            });
            var ja = '<?=$Settings->java_applet?>';
            if (ja == 1) {
                $('#jac').slideDown();
            } else {
                $('#jac').slideUp();
            }
        });
    </script>
