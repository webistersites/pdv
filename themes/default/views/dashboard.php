<?php (defined('BASEPATH')) OR exit('No direct script access allowed'); ?>
<script src="<?= $assets ?>plugins/highchart/highcharts.js"></script>
<script src="<?= $assets ?>plugins/highchart/exporting.js"></script>
<?php
if($chartData) {
    foreach ($chartData as $month_sale) {
        $months[] = date('M-Y', strtotime($month_sale->month));
        $sales[] = $month_sale->total;
        $tax[] = $month_sale->tax;
        $discount[] = $month_sale->discount;
    }
} else {
    $months[] = '';
    $sales[] = '';
    $tax[] = '';
    $discount[] = '';
}
?>

<script type="text/javascript">

    $(document).ready(function () {
        Highcharts.getOptions().colors = Highcharts.map(Highcharts.getOptions().colors, function (color) {
            return {
                radialGradient: {cx: 0.5, cy: 0.3, r: 0.7},
                stops: [[0, color], [1, Highcharts.Color(color).brighten(-0.3).get('rgb')]]
            };
        });
        <?php if($chartData) { ?>
        $('#chart').highcharts({
            chart: { },
            credits: { enabled: false },
            exporting: { enabled: false },
            title: { text: '' },
            xAxis: { categories: [<?php foreach($months as $month) { echo "'".$month."', "; } ?>] },
            yAxis: { min: 0, title: "" },
            tooltip: {
                shared: true,
                followPointer: true,
                headerFormat: '<div class="well well-sm" style="margin-bottom:0;"><span style="font-size:12px">{point.key}</span><table class="table table-striped" style="margin-bottom:0;">',
                pointFormat: '<tr><td style="color:{series.color};padding:4px">{series.name}: </td>' +
                '<td style="color:{series.color};padding:4px;text-align:right;"> <b>{point.y}</b></td></tr>',
                footerFormat: '</table></div>',
                useHTML: true, borderWidth: 0, shadow: false,
                style: {fontSize: '14px', padding: '0', color: '#000000'}
            },
            plotOptions: {
                series: { stacking: 'normal' }
            },
            series: [{
                type: 'column',
                name: '<?= $this->lang->line("tax"); ?>',
                data: [<?= implode(', ', $tax); ?>]
            },
            {
                type: 'column',
                name: '<?= $this->lang->line("discount"); ?>',
                data: [<?= implode(', ', $discount); ?>]
            },
            {
                type: 'column',
                name: '<?= $this->lang->line("sales"); ?>',
                data: [<?= implode(', ', $sales); ?>]
            }
            ]
        });
        <?php } ?>
        <?php if ($topProducts) { ?>
$('#chart2').highcharts({
    chart: { },
    title: { text: '' },
    credits: { enabled: false },
    exporting: { enabled: false },
    tooltip: {
        shared: true,
        followPointer: true,
        headerFormat: '<div class="well well-sm" style="margin-bottom:0;"><span style="font-size:12px">{point.key}</span><table class="table table-striped" style="margin-bottom:0;">',
        pointFormat: '<tr><td style="color:{series.color};padding:4px">{series.name}: </td>' +
        '<td style="color:{series.color};padding:4px;text-align:right;"> <b>{point.y}</b></td></tr>',
        footerFormat: '</table></div>',
        useHTML: true, borderWidth: 0, shadow: false,
        style: {fontSize: '14px', padding: '0', color: '#000000'}
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: false
            },
            showInLegend: false
        }
    },

    series: [{
        type: 'pie',
        name: '<?=$this->lang->line('total_sold')?>',
        data: [
        <?php
        foreach($topProducts as $tp) {
            echo "['".$tp->product_name." (".$tp->product_code.")', ".$tp->quantity."],";

        } ?>
        ]
    }]
});
<?php } ?>
});

</script>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title"><?= lang('quick_links'); ?></h3>
                </div>
                <div class="box-body">

                    <a class="btn btn-app" href="<?= site_url('pos'); ?>">
                        <i class="fa fa-th"></i> <?= lang('pos'); ?>
                    </a>
                    <a class="btn btn-app" href="<?= site_url('products'); ?>">
                        <i class="fa fa-barcode"></i> <?= lang('products'); ?>
                    </a>
                    <a class="btn btn-app" href="<?= site_url('sales'); ?>">
                        <i class="fa fa-shopping-cart"></i> <?= lang('sales'); ?>
                    </a>
                    <a class="btn btn-app" href="<?= site_url('sales/opened'); ?>">
                        <!-- <span class="badge bg-yellow"><?=sizeof($suspended_sales);?></span> -->
                        <i class="fa fa-bell-o"></i> <?= lang('opened_bills'); ?>
                    </a>
                    <a class="btn btn-app" href="<?= site_url('categories'); ?>">
                        <i class="fa fa-folder-open"></i> <?= lang('categories'); ?>
                    </a>
                    <a class="btn btn-app" href="<?= site_url('gift_cards'); ?>">
                        <i class="fa fa-credit-card"></i> <?= lang('gift_cards'); ?>
                    </a>
                    <a class="btn btn-app" href="<?= site_url('customers'); ?>">
                        <i class="fa fa-users"></i> <?= lang('customers'); ?>
                    </a>
                    <?php if($Admin) { ?>
                    <a class="btn btn-app" href="<?= site_url('settings'); ?>">
                        <i class="fa fa-cogs"></i> <?= lang('settings'); ?>
                    </a>
                    <a class="btn btn-app" href="<?= site_url('reports'); ?>">
                        <i class="fa fa-bar-chart-o"></i> <?= lang('reports'); ?>
                    </a>
                    <a class="btn btn-app" href="<?= site_url('users'); ?>">
                        <i class="fa fa-users"></i> <?= lang('users'); ?>
                    </a>
                    <a class="btn btn-app" href="<?= site_url('settings/backups'); ?>">
                        <i class="fa fa-database"></i> <?= lang('backups'); ?>
                    </a>
                    <a class="btn btn-app" href="<?= site_url('settings/updates'); ?>">
                        <i class="fa fa-upload"></i> <?= lang('updates'); ?>
                    </a>
                    <?php } ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title"><?= lang('sales_chart'); ?></h3>
                        </div>
                        <div class="box-body">
                            <div id="chart" style="height:300px;"></div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title"><?= lang('top_products').' ('.date('F Y').')'; ?></h3>
                        </div>
                        <div class="box-body">
                            <div id="chart2" style="height:300px;"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
