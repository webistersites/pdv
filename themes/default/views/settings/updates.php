<?php (defined('BASEPATH')) OR exit('No direct script access allowed'); ?>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title"><?= lang('update_heading'); ?></h3>
                </div>
                <div class="box-body">

                    <div class="row">
                        <div class="col-md-12">
                            <?php
                            if(!$this->Settings->purchase_code || !$this->Settings->envato_username){
                                echo form_open('system_settings/updates');
                                ?>
                                <div class="form-group">
                                    <?= lang('purchase_code', 'purchase_code'); ?>
                                    <?= form_input('purchase_code', '', 'class="form-control tip" id="purchase_code"  required="required"'); ?>
                                </div>
                                <div class="form-group">
                                    <?= lang('envato_username', 'envato_username'); ?>
                                    <?= form_input('envato_username', '', 'class="form-control tip" id="envato_username"  required="required"'); ?>
                                </div>
                                <div class="form-group">
                                    <?= form_submit('update', lang('update'), 'class="btn btn-primary"'); ?>
                                </div>
                                <?php
                                echo form_close();
                            } else {
                                if (!empty($updates->data->updates)) {
                                    foreach ($updates->data->updates as $update) {
                                        echo '<ul class="list-group"><li class="list-group-item">';
                                        echo '<h3><strong>' . lang('version') . ' ' . $update->version . '</strong> ';
                                        echo anchor('system_settings/install_update/' . substr($update->filename, 0, -4) . '/' . (!empty($update->mversion) ? $update->mversion : 0) . '/' . $update->version, '<i class="fa fa-upload"></i> ' . lang('install'), 'class="btn btn-xs btn-primary"') . '</h3>';
                                        echo '<h3>' . lang('changelog') . '<h3><pre>' . $update->changelog . '</pre>';
                                        echo '</li></ul>';
                                    }
                                } else {
                                    echo '<div class="well"><strong>' . lang('using_latest_update') . '</strong></div>';
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>