<?php (defined('BASEPATH')) OR exit('No direct script access allowed'); ?>
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
            <h4 class="modal-title" id="myModalLabel"><?= lang('register_details').' ('.lang('opened_at').': '.$this->tec->hrld($this->session->userdata('register_open_time')).')'; ?></h4>
        </div>
        <?= form_open("pos/close_register/" . $user_id); ?>
        <div class="modal-body">
            <table width="100%" class="stable">
                <tr>
                    <td style="border-bottom: 1px solid #EEE;"><h4><?= lang('cash_in_hand'); ?>:</h4></td>
                    <td style="text-align:right; border-bottom: 1px solid #EEE;"><h4>
                            <span><?= $this->tec->formatMoney($this->session->userdata('cash_in_hand')); ?></span></h4>
                    </td>
                </tr>
                <tr>
                    <td style="border-bottom: 1px solid #EEE;"><h4><?= lang('cash_sale'); ?>:</h4></td>
                    <td style="text-align:right; border-bottom: 1px solid #EEE;"><h4>
                            <span><?= $this->tec->formatMoney($cashsales->paid ? $cashsales->paid : '0.00') . ' (' . $this->tec->formatMoney($cashsales->total ? $cashsales->total : '0.00') . ')'; ?></span>
                        </h4></td>
                </tr>
                <tr>
                    <td style="border-bottom: 1px solid #EEE;"><h4><?= lang('ch_sale'); ?>:</h4></td>
                    <td style="text-align:right;border-bottom: 1px solid #EEE;"><h4>
                            <span><?= $this->tec->formatMoney($chsales->paid ? $chsales->paid : '0.00') . ' (' . $this->tec->formatMoney($chsales->total ? $chsales->total : '0.00') . ')'; ?></span>
                        </h4></td>
                </tr>
                <tr>
                    <td style="border-bottom: 1px solid <?= (!isset($Settings->stripe)) ? '#DDD' : '#EEE'; ?>;"><h4><?= lang('cc_sale'); ?>:</h4></td>
                    <td style="text-align:right;border-bottom: 1px solid <?= (!isset($Settings->stripe)) ? '#DDD' : '#EEE'; ?>;"><h4>
                            <span><?= $this->tec->formatMoney($ccsales->paid ? $ccsales->paid : '0.00') . ' (' . $this->tec->formatMoney($ccsales->total ? $ccsales->total : '0.00') . ')'; ?></span>
                        </h4></td>
                </tr>

                <?php if (isset($Settings->stripe)) { ?>
                    <tr>
                        <td style="border-bottom: 1px solid #DDD;"><h4><?= lang('stripe'); ?>:</h4></td>
                        <td style="text-align:right;border-bottom: 1px solid #DDD;"><h4>
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

                <tr>
                    <td width="300px;" style="font-weight:bold;"><h4><?= lang('expenses'); ?>:</h4></td>
                    <td width="200px;" style="font-weight:bold;text-align:right;"><h4>
                            <span><?= $this->tec->formatMoney($expenses->total ? $expenses->total : '0.00'); ?></span>
                        </h4></td>
                </tr>
                <?php $total_cash = ($cashsales->paid ? $cashsales->paid + ($cash_in_hand ? $cash_in_hand : $this->session->userdata('cash_in_hand')) : (($cash_in_hand ? $cash_in_hand : $this->session->userdata('cash_in_hand'))));
                $total_cash -= ($expenses->total ? $expenses->total : 0.00);
                ?>
                <tr>
                    <td width="300px;" style="font-weight:bold;"><h4><strong><?= lang('total_cash'); ?></strong>:</h4>
                    </td>
                    <td style="text-align:right;"><h4>
                            <span><strong><?= $this->tec->formatMoney($total_cash); ?></strong></span>
                        </h4></td>
                </tr>
            </table>


                <?php

                if ($suspended_bills) {
                    echo '<hr><h4>' . lang('opened_bills') . '</h4><table class="table table-hovered table-bordered"><thead><tr><th>' . lang('customer') . '</th><th>' . lang('date') . '</th><th>' . lang('reference') . '</th><th>' . lang('amount') . '</th><th><i class="fa fa-trash-o"></i></th></tr></thead><tbody>';
                    foreach ($suspended_bills as $bill) {
                        echo '<tr><td>' . $bill->customer_name . '</td><td>' . $this->tec->hrld($bill->date) . '</td><td class="col-xs-4">' . $bill->hold_ref . '</td><td class="text-right">' . $bill->grand_total . '</td><td class="text-center"><a class="tip" title="' . lang("delete_bill") . '" href="' . site_url('sales/delete_holded/' . $bill->id) . '" onclick="return confirm(\''.lang('alert_x_holded').'\')"><i class="fa fa-trash-o"></i></a></td></tr>';
                    }
                    echo '</tbody></table>';
                }

                ?>
                <hr>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <?= lang("total_cash", "total_cash_submitted"); ?>
                            <?= form_hidden('total_cash', $total_cash); ?>
                            <?= form_input('total_cash_submitted', (isset($_POST['total_cash_submitted']) ? $_POST['total_cash_submitted'] : $total_cash), 'class="form-control input-tip" id="total_cash_submitted" required="required"'); ?>
                        </div>
                        <div class="form-group">
                            <?= lang("total_cheques", "total_cheques_submitted"); ?>
                            <?= form_hidden('total_cheques', $chsales->total_cheques); ?>
                            <?= form_input('total_cheques_submitted', (isset($_POST['total_cheques_submitted']) ? $_POST['total_cheques_submitted'] : $chsales->total_cheques), 'class="form-control input-tip" id="total_cheques_submitted" required="required"'); ?>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <?php if ($suspended_bills) { ?>
                            <div class="form-group">
                                <?= lang("transfer_opened_bills", "transfer_opened_bills"); ?>
                                <?php $u = $user_id ? $user_id : $this->session->userdata('user_id');
                                $usrs[-1] = lang('delete_all');
                                $usrs[0] = lang('leave_opened');
                                foreach ($users as $user) {
                                    if ($user->id != $u) {
                                        $usrs[$user->id] = $user->first_name . ' ' . $user->last_name;
                                    }
                                }
                                ?>
                                <div class="clearfix"></div>
                                <?= form_dropdown('transfer_opened_bills', $usrs, (isset($_POST['transfer_opened_bills']) ? $_POST['transfer_opened_bills'] : 0), 'class="form-control input-tip select2" id="transfer_opened_bills" required="required" style="width:100%;"'); ?>
                            </div>
                        <?php } ?>
                        <div class="form-group">
                            <?= lang("total_cc_slips", "total_cc_slips_submitted"); ?>
                            <?= form_hidden('total_cc_slips', $ccsales->total_cc_slips); ?>
                            <?= form_input('total_cc_slips_submitted', (isset($_POST['total_cc_slips_submitted']) ? $_POST['total_cc_slips_submitted'] : $ccsales->total_cc_slips), 'class="form-control input-tip" id="total_cc_slips_submitted" required="required"'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="note"><?= lang("note"); ?></label>
                    <?= form_textarea('note', (isset($_POST['note']) ? $_POST['note'] : ""), 'class="form-control redactor" id="note" style="margin-top: 10px; height: 100px;"'); ?>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-sm pull-left" data-dismiss="modal"><?=lang('close')?></button>
                <?= form_submit('close_register', lang('close_register'), 'class="btn btn-primary"'); ?>
            </div>
        </div>
        <?= form_close(); ?>
    </div>

</div>
<script type="text/javascript">
    $(document).ready(function() {
        $(".select2").select2({minimumResultsForSearch:6});
    });
</script>
