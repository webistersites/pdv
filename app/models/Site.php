<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getQtyAlerts() {
        $this->db->where('quantity < alert_quantity', NULL, FALSE);
        return $this->db->count_all_results('products');
    }

    public function getSettings()
    {
        $q = $this->db->get('settings');
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
    }

    public function getAllCustomers()
    {
        $q = $this->db->get('customers');
        if($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
    }

    public function getAllSuppliers()
    {
        $q = $this->db->get('suppliers');
        if($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
    }

    public function getAllUsers()
    {
        $this->db->select("users.id as id, first_name, last_name, email, company, " . $this->db->dbprefix('groups') . ".name as group, active")
            ->join('groups', 'users.group_id=groups.id', 'left')
            ->group_by('users.id');
        $q = $this->db->get('users');
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
    }

    public function getUser($id = NULL)
    {
        if (!$id) {
            $id = $this->session->userdata('user_id');
        }
        $q = $this->db->get_where('users', array('id' => $id), 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
    }

    public function getProductByID($id)
    {
        $q = $this->db->get_where('products', array('id' => $id), 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
    }

    public function getAllCategories()
    {
        $this->db->order_by('code');
        $q = $this->db->get('categories');
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
    }

    public function getCategoryByID($id)
    {
        $q = $this->db->get_where('categories', array('id' => $id), 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
    }

    public function getCategoryByCode($code)
    {
        $q = $this->db->get_where('categories', array('code' => $code), 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
    }

    public function getGiftCard($no)
    {
        $q = $this->db->get_where('gift_cards', array('card_no' => $no), 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
    }

    public function getUpcomingEvents()
    {
        $dt = date('Y-m-d');
        $this->db->where('date >=', $dt)->order_by('date')->limit(5);
        if ($this->Settings->restrict_calendar) {
            $q = $this->db->get_where('calendar', array('user_id' => $this->session->userdata('iser_id')));
        } else {
            $q = $this->db->get('calendar');
        }
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
    }

    public function getUserGroup($user_id = NULL) {
        if($group_id = $this->getUserGroupID($user_id)) {
            $q = $this->db->get_where('groups', array('id' => $group_id), 1);
            if ($q->num_rows() > 0) {
                return $q->row();
            }
        }
        return FALSE;
    }

    public function getUserGroupID($user_id = NULL) {
        if($user = $this->getUser($user_id)) {
            return $user->group_id;
        }
        return FALSE;
    }

    public function getUserSuspenedSales()
    {
        $user_id = $this->session->userdata('user_id');
        $this->db->select('id, date, customer_name, hold_ref')
        ->order_by('id desc');
        //->limit(10);
        $q = $this->db->get_where('suspended_sales', array('created_by' => $user_id));
        if($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
    }

}
