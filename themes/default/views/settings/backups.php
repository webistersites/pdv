<?php (defined('BASEPATH')) OR exit('No direct script access allowed'); ?>

<section class="content" style="min-height: auto;">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <a href="<?= site_url('settings/backup_database'); ?>" id="backup_files" class="pull-right btn btn-primary"><i class="icon fa fa-database"></i> <?= lang('backup_database'); ?></a>
                    <h3 class="box-title"><strong><?= lang('database_backups'); ?></strong>: <?= lang('restore_heading'); ?></h3>
                </div>
                <div class="box-body">

                    <div class="row">
                        <div class="col-md-12">
                            <?php
                            if(! empty($dbs)) {
                                echo '<ul class="list-group">';
                                foreach ($dbs as $file) {
                                    $file = basename($file);
                                    echo '<li class="list-group-item">';
                                    $date_string = substr($file, 13, 10);
                                    $time_string = substr($file, 24, 8);
                                    $date = $date_string . ' ' . str_replace('-', ':', $time_string);
                                    $bkdate = $this->tec->hrld($date);
                                    echo '<strong>' . lang('backup_on') . ' <span class="text-primary">' . $bkdate . '</span><div class="btn-group pull-right" style="margin-top:-7px;">' . anchor('settings/download_database/' . substr($file, 0, -4), '<i class="fa fa-download"></i> ' . lang('download'), 'class="btn btn-primary"') . ' ' . anchor('settings/restore_database/' . substr($file, 0, -4), '<i class="fa fa-database"></i> ' . lang('restore'), 'class="btn btn-warning restore_db"') . ' ' . anchor('settings/delete_database/' . substr($file, 0, -4), '<i class="fa fa-trash-o"></i> ' . lang('delete'), 'class="btn btn-danger delete_file"') . ' </div></strong>';
                                    echo '</li>';
                                }
                                echo '</ul>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="content" style="min-height: auto;">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <a href="#" id="backup_files" class="pull-right btn btn-primary"><i class="icon fa fa-file-zip-o"></i> <?= lang('backup_files'); ?></a>
                    <h3 class="box-title"><strong><?= lang('file_backups'); ?></strong>: <?= lang('restore_heading'); ?></h3>
                </div>
                <div class="box-body">

                    <div class="row">
                        <div class="col-md-12">
                            <?php
                            if(! empty($files)) {
                                echo '<ul class="list-group">';
                                foreach ($files as $file) {
                                    $file = basename($file);
                                    echo '<li class="list-group-item">';
                                    $date_string = substr($file, 12, 10);
                                    $time_string = substr($file, 23, 8);
                                    $date = $date_string . ' ' . str_replace('-', ':', $time_string);
                                    $bkdate = $this->tec->hrld($date);
                                    echo '<strong>' . lang('backup_on') . ' <span class="text-primary">' . $bkdate . '</span><div class="btn-group pull-right" style="margin-top:-7px;">' . anchor('settings/download_backup/' . substr($file, 0, -4), '<i class="fa fa-download"></i> ' . lang('download'), 'class="btn btn-primary"') . ' ' . anchor('settings/restore_backup/' . substr($file, 0, -4), '<i class="fa fa-database"></i> ' . lang('restore'), 'class="btn btn-warning restore_backup"') . ' ' . anchor('settings/delete_backup/' . substr($file, 0, -4), '<i class="fa fa-trash-o"></i> ' . lang('delete'), 'class="btn btn-danger delete_file"') . ' </div></strong>';
                                    echo '</li>';
                                }
                                echo '</ul>';
                            }
                            ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="wModal" tabindex="-1" role="dialog" aria-labelledby="wModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="wModalLabel"><?= lang('please_wait'); ?></h4>
            </div>
            <div class="modal-body">
                <?= lang('backup_modal_msg'); ?>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#backup_files').click(function (e) {
            e.preventDefault();
            $('#wModalLabel').text('<?=lang('backup_modal_heading');?>');
            $('#wModal').modal({backdrop: 'static', keyboard: true}).appendTo('body').modal('show');
            window.location.href = '<?= site_url('settings/backup_files'); ?>';
        });
        $('.restore_backup').click(function (e) {
            e.preventDefault();
            var href = $(this).attr('href');
            bootbox.confirm("<?=lang('restore_confirm');?>", function (result) {
                if (result) {
                    $('#wModalLabel').text('<?=lang('restore_modal_heading');?>');
                    $('#wModal').modal({backdrop: 'static', keyboard: true}).appendTo('body').modal('show');
                    window.location.href = href;
                }
            });
        });
        $('.restore_db').click(function (e) {
            e.preventDefault();
            var href = $(this).attr('href');
            bootbox.confirm("<?=lang('restore_confirm');?>", function (result) {
                if (result) {
                    window.location.href = href;
                }
            });
        });
        $('.delete_file').click(function (e) {
            e.preventDefault();
            var href = $(this).attr('href');
            bootbox.confirm("<?=lang('delete_confirm');?>", function (result) {
                if (result) {
                    window.location.href = href;
                }
            });
        });
    });
</script>