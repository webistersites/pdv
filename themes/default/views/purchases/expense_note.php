<?php (defined('BASEPATH')) OR exit('No direct script access allowed'); ?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?= $page_title.' | '.$Settings->site_name; ?></title>
    <link rel="shortcut icon" href="<?= $assets ?>img/icon.png"/>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link href="<?= $assets ?>bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= $assets ?>plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
    <link href="<?= $assets ?>dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
    body { background-color: #ecf0f5; }
    .table th { text-align: center; }
    </style>
</head>
<body>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <h1><?= $Settings->site_name == 'SimplePOS' ? 'Simple<b>POS</b>' : '<img src="'.base_url('uplaods/'.$Settings->logo).'" alt="'.$Settings->site_name.'" />'; ?></h1>
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title"><?= lang('expense').' # '.$expense->id; ?></h3>
                    </div>
                    <div class="box-body">
                        <div class="well">
                            <table class="table table-borderless" style="margin-bottom:0;">
                                <tbody>
                                    <tr>
                                        <td><strong><?= lang("date"); ?></strong></td>
                                        <td><strong class="text-right"><?php echo $this->tec->hrld($expense->date); ?></strong></td>
                                    </tr>
                                    <tr>
                                        <td><strong><?= lang("reference"); ?></strong></td>
                                        <td><strong class="text-right"><?php echo $expense->reference; ?></strong></td>
                                    </tr>
                                    <tr>
                                        <td><strong><?= lang("amount"); ?></strong></td>
                                        <td><strong class="text-right"><?php echo $this->tec->formatMoney($expense->amount); ?></strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><?php echo $expense->note; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div style="clear: both;"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
