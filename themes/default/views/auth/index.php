<?php (defined('BASEPATH')) OR exit('No direct script access allowed'); ?>

<script type="text/javascript">
    $(document).ready(function() {
        $('#UTable').dataTable();
    });
</script>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title"><?= lang('list_results'); ?></h3>
                </div>
                <div class="box-body">
                    <table id="UTable" class="table table-bordered table-striped table-hover">
                        <thead class="cf">
                        <tr>
                            <th><?php echo lang('first_name'); ?></th>
                            <th><?php echo lang('last_name'); ?></th>
                            <th><?php echo lang('email'); ?></th>
                            <th><?php echo lang('group'); ?></th>
                            <th style="width:100px;"><?php echo lang('status'); ?></th>
                            <th style="width:80px;"><?php echo lang('actions'); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($users as $user) {
                            echo '<tr>';
                            echo '<td>' . $user->first_name . '</td>';
                            echo '<td>' . $user->last_name . '</td>';
                            echo '<td>' . $user->email . '</td>';
                            echo '<td>' . $user->group . '</td>';
                            echo '<td class="text-center" style="padding:6px;">' . ($user->active ? '<span class="label label-success">' . lang('active') . '</span' : '<span class="label label-danger">' . lang('inactive') . '</span>') . '</td>';
                            echo '<td class="text-center" style="padding:6px;"><div class="btn-group btn-group-justified" role="group"><div class="btn-group btn-group-xs" role="group"><a class="tip btn btn-warning btn-xs" title="' . lang("profile") . '" href="' . site_url('users/profile/' . $user->id) . '"><i class="fa fa-edit"></i></a></div>
                            <div class="btn-group btn-group-xs" role="group"><a class="tip btn btn-danger btn-xs" title="' . lang("delete_user") . '" href="' . site_url('auth/delete/' . $user->id) . '" onclick="return confirm(\''.lang('alert_x_user').'\')"><i class="fa fa-trash-o"></i></a></div></div></td>';
                            echo '</tr>';
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
