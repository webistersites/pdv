<?php (defined('BASEPATH')) OR exit('No direct script access allowed'); ?>
<div class="modal-dialog modal-success">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
            <h4 class="modal-title" id="myModalLabel"><?= lang('today_sale').' ('.date($Settings->dateformat).')'; ?></h4>
        </div>
        <div class="modal-body">
            <table width="100%" class="stable">
                <tr>
                    <td style="border-bottom: 1px solid #008d4c;"><h4><?= lang('cash_sale'); ?>:</h4></td>
                    <td style="text-align:right; border-bottom: 1px solid #008d4c;"><h4>
                            <span><?= $this->tec->formatMoney($cashsales->paid ? $cashsales->paid : '0.00') . ' (' . $this->tec->formatMoney($cashsales->total ? $cashsales->total : '0.00') . ')'; ?></span>
                        </h4></td>
                </tr>
                <tr>
                    <td style="border-bottom: 1px solid #008d4c;"><h4><?= lang('ch_sale'); ?>:</h4></td>
                    <td style="text-align:right;border-bottom: 1px solid #008d4c;"><h4>
                            <span><?= $this->tec->formatMoney($chsales->paid ? $chsales->paid : '0.00') . ' (' . $this->tec->formatMoney($chsales->total ? $chsales->total : '0.00') . ')'; ?></span>
                        </h4></td>
                </tr>
                <tr>
                    <td style="border-bottom: 1px solid #008d4c;"><h4><?= lang('cc_sale'); ?>:</h4></td>
                    <td style="text-align:right;border-bottom: 1px solid #008d4c;"><h4>
                            <span><?= $this->tec->formatMoney($ccsales->paid ? $ccsales->paid : '0.00') . ' (' . $this->tec->formatMoney($ccsales->total ? $ccsales->total : '0.00') . ')'; ?></span>
                        </h4></td>
                </tr>

                <?php if (isset($Settings->stripe)) { ?>
                    <tr>
                        <td style="border-bottom: 1px solid #008d4c;"><h4><?= lang('stripe'); ?>:</h4></td>
                        <td style="text-align:right;border-bottom: 1px solid #008d4c;"><h4>
                                <span><?= $this->tec->formatMoney($stripesales->paid ? $stripesales->paid : '0.00') . ' (' . $this->tec->formatMoney($stripesales->total ? $stripesales->total : '0.00') . ')'; ?></span>
                            </h4></td>
                    </tr>
                <?php } ?>
                <tr>
                    <td width="300px;" style="font-weight:bold;"><h4><?= lang('total_sales'); ?>:</h4></td>
                    <td width="200px;" style="font-weight:bold;text-align:right;"><h4>
                            <span><?= $this->tec->formatMoney($totalsales->paid ? $totalsales->paid : '0.00') . ' (' . $this->tec->formatMoney($totalsales->total ? $totalsales->total : '0.00') . ')'; ?></span>
                        </h4></td>
                </tr>

            </table>
        </div>
    </div>

</div>
