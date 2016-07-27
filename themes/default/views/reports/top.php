<script src="<?= $assets ?>plugins/highchart/highcharts.js"></script>
<script src="<?= $assets ?>plugins/highchart/exporting.js"></script>

<script type="text/javascript">

    $(document).ready(function () {
        <?php 
        if ($topProducts) { 
            ?>

            $('#thisMonth').highcharts({
                chart: {type: 'column'},
                title: {text: ''},
                credits: {enabled: false},
                exporting: { enabled: false },
                xAxis: {type: 'category', labels: {rotation: -60, style: {fontSize: '13px'}}},
                yAxis: {min: 0, title: {text: ''}},
                legend: {enabled: false},
                series: [{
                    name: '<?=lang('sold');?>',
                    data: [<?php
                    foreach ($topProducts as $r) {
                        if($r->quantity > 0) {
                            echo "['".$r->product_name."', ".$r->quantity."],";
                        }
                    }
                    ?>],
                    dataLabels: {
                        enabled: true,
                        rotation: -90,
                        color: '#000',
                        align: 'right',
                        y: -25,
                        style: {fontSize: '12px'}
                    }
                }]
            });

            <?php 
        } if ($topProducts1) { 
            ?>

            $('#lastMonth').highcharts({
                chart: {type: 'column'},
                title: {text: ''},
                credits: {enabled: false},
                exporting: { enabled: false },
                xAxis: {type: 'category', labels: {rotation: -60, style: {fontSize: '13px'}}},
                yAxis: {min: 0, title: {text: ''}},
                legend: {enabled: false},
                series: [{
                    name: '<?=lang('sold');?>',
                    data: [<?php
                    foreach ($topProducts1 as $r) {
                        if($r->quantity > 0) {
                            echo "['".$r->product_name."', ".$r->quantity."],";
                        }
                    }
                    ?>],
                    dataLabels: {
                        enabled: true,
                        rotation: -90,
                        color: '#000',
                        align: 'right',
                        y: -25,
                        style: {fontSize: '12px'}
                    }
                }]
            });

            <?php 
        } if ($topProducts3) { 
            ?>

            $('#lastQ').highcharts({
                chart: {type: 'column'},
                title: {text: ''},
                credits: {enabled: false},
                exporting: { enabled: false },
                xAxis: {type: 'category', labels: {rotation: -60, style: {fontSize: '13px'}}},
                yAxis: {min: 0, title: {text: ''}},
                legend: {enabled: false},
                series: [{
                    name: '<?=lang('sold');?>',
                    data: [<?php
                    foreach ($topProducts3 as $r) {
                        if($r->quantity > 0) {
                            echo "['".$r->product_name."', ".$r->quantity."],";
                        }
                    }
                    ?>],
                    dataLabels: {
                        enabled: true,
                        rotation: -90,
                        color: '#000',
                        align: 'right',
                        y: -25,
                        style: {fontSize: '12px'}
                    }
                }]
            });

            <?php 
        } if ($topProducts12) { 
            ?>

            $('#thisYear').highcharts({
                chart: {type: 'column'},
                title: {text: ''},
                credits: {enabled: false},
                exporting: { enabled: false },
                xAxis: {type: 'category', labels: {rotation: -60, style: {fontSize: '13px'}}},
                yAxis: {min: 0, title: {text: ''}},
                legend: {enabled: false},
                series: [{
                    name: '<?=lang('sold');?>',
                    data: [<?php
                    foreach ($topProducts12 as $r) {
                        if($r->quantity > 0) {
                            echo "['".$r->product_name."', ".$r->quantity."],";
                        }
                    }
                    ?>],
                    dataLabels: {
                        enabled: true,
                        rotation: -90,
                        color: '#000',
                        align: 'right',
                        y: -25,
                        style: {fontSize: '12px'}
                    }
                }]
            });

            <?php 
        } 
        ?>
    });

</script>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title"><?= lang('top_products_heading'); ?></span></h3>
                </div>
                <div class="box-body">

                    <div class="row"> 
                        <div class="col-md-6">   
                            <div class="panel panel-default">
                                <div class="panel-heading"><?= $this->lang->line("this_month").' ('.date('F Y').')'; ?></div>
                                <div class="panel-body">
                                    <div id="thisMonth" style="height:400px;"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">   
                            <div class="panel panel-default">
                                <div class="panel-heading"><?= $this->lang->line("last_month").' ('.date('F Y', strtotime('last month')).')'; ?></div>
                                <div class="panel-body">
                                    <div id="lastMonth" style="height:400px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row"> 

                        <div class="col-md-6">   
                            <div class="panel panel-default" style="margin-bottom:0;">
                                <div class="panel-heading"><?= $this->lang->line("last_3_months").' ('.$this->lang->line("from").' '.date('F Y', strtotime('-3 month')).')'; ?></div>
                                <div class="panel-body">
                                    <div id="lastQ" style="height:400px;"></div>
                                </div>
                            </div>  
                        </div>

                        <div class="col-md-6">   
                            <div class="panel panel-default" style="margin-bottom:0;">
                                <div class="panel-heading"><?= $this->lang->line("last_12_months").' ('.$this->lang->line("from").' '.date('F Y', strtotime('-12 month')).')'; ?></div>
                                <div class="panel-body">
                                    <div id="thisYear" style="height:400px;"></div>
                                </div>
                            </div>    
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
