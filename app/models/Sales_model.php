<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sales_model extends CI_Model
{
	
	public function __construct() {
		parent::__construct();

	}

	public function getSaleByID($id)
    {
        $q = $this->db->get_where('sales', array('id' => $id), 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
    }
	
	public function deleteInvoice($id) {
		if($this->db->delete('sale_items', array('sale_id' => $id)) && $this->db->delete('sales', array('id' => $id))) {
			return true;
		}
		return FALSE;
	}

	public function deleteOpenedSale($id) {
		if($this->db->delete('suspended_items', array('suspend_id' => $id)) && $this->db->delete('suspended_sales', array('id' => $id))) {
			return true;
		}
		return FALSE;
	}
	
	public function getSalePayments($sale_id)
    {
        $this->db->order_by('id', 'asc');
        $q = $this->db->get_where('payments', array('sale_id' => $sale_id));
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }

    public function getPaymentByID($id)
    {
        $q = $this->db->get_where('payments', array('id' => $id), 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
    }

    public function addPayment($data = array())
    {
        if ($this->db->insert('payments', $data)) {
            if ($data['paid_by'] == 'gift_card') {
                $gc = $this->site->getGiftCardByNO($data['gc_no']);
                $this->db->update('gift_cards', array('balance' => ($gc->balance - $data['amount'])), array('card_no' => $data['gc_no']));
            }
            $this->syncSalePayments($data['sale_id']);
            return true;
        }
        return false;
    }

    public function updatePayment($id, $data = array())
    {
        if ($this->db->update('payments', $data, array('id' => $id))) {
            $this->syncSalePayments($data['sale_id']);
            return true;
        }
        return false;
    }

    public function deletePayment($id)
    {
        $opay = $this->getPaymentByID($id);
        if ($this->db->delete('payments', array('id' => $id))) {
            $this->syncSalePayments($opay->sale_id);
            return true;
        }
        return FALSE;
    }

    public function syncSalePayments($id)
    {
        $sale = $this->getSaleByID($id);
        $payments = $this->getSalePayments($id);
        $paid = 0;
        if($payments) {
        	foreach ($payments as $payment) {
        		$paid += $payment->amount;
        	}
        }
        $status = $paid <= 0 ? 'due' : $sale->status;
	    if ($this->tec->formatDecimal($sale->grand_total) > $this->tec->formatDecimal($paid) && $paid > 0) {
            $status = 'partial';
        } elseif ($this->tec->formatDecimal($sale->grand_total) <= $this->tec->formatDecimal($paid)) {
            $status = 'paid';
        }

        if ($this->db->update('sales', array('paid' => $paid, 'status' => $status), array('id' => $id))) {
            return true;
        }

        return FALSE;
    }
}
