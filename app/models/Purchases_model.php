<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Purchases_model extends CI_Model
{

    public function __construct() {
        parent::__construct();
    }

    public function getPurchaseByID($id) {
        $q = $this->db->get_where('purchases', array('id' => $id), 1);
        if( $q->num_rows() > 0 ) {
            return $q->row();
        }
        return FALSE;
    }

    public function getAllPurchaseItems($purchase_id) {
        $this->db->select('purchase_items.*, products.code as product_code, products.name as product_name')
            ->join('products', 'products.id=purchase_items.product_id', 'left')
            ->group_by('purchase_items.id')
            ->order_by('id', 'asc');
        $q = $this->db->get_where('purchase_items', array('purchase_id' => $purchase_id));
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
    }

    public function addPurchase($data, $items) {
        if ($this->db->insert('purchases', $data)) {
            $purchase_id = $this->db->insert_id();
            foreach ($items as $item) {
                $item['purchase_id'] = $purchase_id;
                if($this->db->insert('purchase_items', $item)) {
                    $product = $this->site->getProductByID($item['product_id']);
                    $this->db->update('products', array('cost' => $item['cost'], 'quantity' => ($product->quantity+$item['quantity'])), array('id' => $product->id));
                }
            }
            return true;
        }
        return false;
    }

    public function updatePurchase($id, $data = NULL, $items = array()) {
        $oitems = $this->getAllPurchaseItems($id);
        foreach ($oitems as $oitem) {
            $product = $this->site->getProductByID($oitem->product_id);
            $this->db->update('products', array('quantity' => ($product->quantity-$oitem->quantity)), array('id' => $product->id));
        }
        if ($this->db->update('purchases', $data, array('id' => $id)) && $this->db->delete('purchase_items', array('purchase_id' => $id))) {
            foreach ($items as $item) {
                $item['purchase_id'] = $id;
                if($this->db->insert('purchase_items', $item)) {
                    $product = $this->site->getProductByID($item['product_id']);
                    $this->db->update('products', array('quantity' => ($product->quantity+$item['quantity'])), array('id' => $product->id));
                }
            }
            return true;
        }
        return false;
    }

    public function deletePurchase($id) {
        $oitems = $this->getAllPurchaseItems($id);
        foreach ($oitems as $oitem) {
            $product = $this->site->getProductByID($oitem->product_id);
            $this->db->update('products', array('quantity' => ($product->quantity-$oitem->quantity)), array('id' => $product->id));
        }
        if ($this->db->delete('purchases', array('id' => $id)) && $this->db->delete('purchase_items', array('purchase_id' => $id))) {
            return true;
        }
        return FALSE;
    }

    public function getProductNames($term, $limit = 10) {
        $this->db->where("type != 'combo' AND (name LIKE '%" . $term . "%' OR code LIKE '%" . $term . "%' OR  concat(name, ' (', code, ')') LIKE '%" . $term . "%')");
        $this->db->limit($limit);
        $q = $this->db->get('products');
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
    }

    public function getExpenseByID($id) {
        $q = $this->db->get_where('expenses', array('id' => $id), 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
    }

    public function addExpense($data = array()) {
        if ($this->db->insert('expenses', $data)) {
            return true;
        }
        return false;
    }

    public function updateExpense($id, $data = array()) {
        if ($this->db->update('expenses', $data, array('id' => $id))) {
            return true;
        }
        return false;
    }

    public function deleteExpense($id) {
        if ($this->db->delete('expenses', array('id' => $id))) {
            return true;
        }
        return FALSE;
    }

}
