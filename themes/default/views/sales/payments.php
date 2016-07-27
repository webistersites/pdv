<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
            <h4 class="modal-title" id="myModalLabel"><?php echo lang('view_payments'); ?></h4>
        </div>
        <div class="modal-body">
            <div class="table-responsive">
                <table id="CompTable" cellpadding="0" cellspacing="0" border="0"
                       class="table table-bordered table-hover table-striped">
                    <thead>
                    <tr>
                        <th style="width:30%;"><?= lang("date"); ?></th>
                        <th style="width:30%;"><?= lang("reference"); ?></th>
                        <th style="width:15%;"><?= lang("amount"); ?></th>
                        <th style="width:15%;"><?= lang("paid_by"); ?></th>
                        <th style="width:10%;"><?= lang("actions"); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if (!empty($payments)) {
                        foreach ($payments as $payment) { ?>
                            <tr class="row<?= $payment->id ?>">
                                <td><?= $this->tec->hrld($payment->date); ?></td>
                                <td><?= lang($payment->reference); ?></td>
                                <td class="text-right"><?= $this->tec->formatMoney($payment->amount) . ' ' . (($payment->attachment) ? '<a href="' . base_url('assets/uploads/' . $payment->attachment) . '" target="_blank"><i class="fa fa-chain"></i></a>' : ''); ?></td>
                                <td><?= lang($payment->paid_by); ?></td>
                                <td>
                                    <div class="text-center">
                                        <!-- <a href="<?= site_url('sales/payment_note/' . $payment->id) ?>"><i class="fa fa-file-text-o"></i></a> -->
                                        <?php if ($payment->paid_by != 'gift_card') { ?>
                                            <a class="tip" href="<?= site_url('sales/edit_payment/' . $payment->id) ?>" data-toggle="ajax"><i class="fa fa-edit"></i></a>
                                            <a class="tip" title="<?= lang("delete_payment") ?>" href="<?= site_url('sales/delete_payment/' . $payment->id) ?>" onclick="return confirm('<?= lang('alert_x_payment') ?>')"><i class="fa fa-trash-o"></i></a>
                                        <?php } ?>
                                    </div>
                                </td>
                            </tr>
                        <?php }
                    } else {
                        echo "<tr><td colspan='4'>" . lang('no_data_available') . "</td></tr>";
                    } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" charset="UTF-8">
    $(document).ready(function () {
        $(document).on('click', '.po-delete', function () {
            var id = $(this).attr('id');
            $(this).closest('tr').remove();
        });
    });
</script>    