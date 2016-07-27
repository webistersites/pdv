<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome_model extends CI_Model
{

    public function __construct() {
        parent::__construct();
    }

    public function topProducts($user_id = NULL)
    {
        $m = date('Y-m');
        if(!$this->Admin) {
            $user_id = $this->session->userdata('user_id');
        }
        $this->db->select($this->db->dbprefix('products').".code as product_code, ".$this->db->dbprefix('products').".name as product_name, sum(".$this->db->dbprefix('sale_items').".quantity) as quantity")
        ->join('products', 'products.id=sale_items.product_id', 'left')
        ->join('sales', 'sales.id=sale_items.sale_id', 'left')
        ->order_by("sum(".$this->db->dbprefix('sale_items').".quantity)", 'desc')
        ->group_by('sale_items.product_id')
        ->limit(10)
        ->like('sales.date', $m, 'both');
        if($user_id) {
            $this->db->where('created_by', $user_id);
        }
        $q = $this->db->get('sale_items');
        if($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }

    public function getChartData($user_id = NULL) {
        if(!$this->Admin) {
            $user_id = $this->session->userdata('user_id');
        }
        $myQuery = "SELECT S.month, S.total, S.tax, S.discount
            FROM (	SELECT	date_format(date, '%Y-%m') Month, SUM(total) total, SUM(total_tax) tax, SUM(total_discount) discount
                FROM ".$this->db->dbprefix('sales')."
                WHERE ".$this->db->dbprefix('sales').".date >= date_sub( now( ) , INTERVAL 12 MONTH ) ";
        if($user_id) {
            $myQuery .= " AND created_by = ".$user_id." ";
        }
		$myQuery .= "GROUP BY date_format(date, '%Y-%m')) S
					GROUP BY S.Month
					ORDER BY S.Month";
        $q = $this->db->query($myQuery);
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
    }

    public function getUserGroups() {
        $this->db->order_by('id', 'desc');
        $q = $this->db->get("users_groups");
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
    }

    public function userGroups() {
        $ugs = $this->getUserGroups();
        if ($ugs) {
            foreach ($ugs as $ug) {
                $this->db->update('users', array('group_id' => $ug->group_id), array('id' => $ug->user_id));
            }
            return true;
        }
        return false;
    }

}
