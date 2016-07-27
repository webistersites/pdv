<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Categories_model extends CI_Model
{

    public function __construct() {
        parent::__construct();

    }

    public function addCategory($data) {
        if ($this->db->insert('categories', $data)) {
            return true;
        }
        return false;
    }

    public function add_categories($data = array()) {
        if ($this->db->insert_batch('categories', $data)) {
            return true;
        }
        return false;
    }

    public function updateCategory($id, $data = NULL) {
        if ($this->db->update('categories', $data, array('id' => $id))) {
            return true;
        }
        return false;
    }

    public function deleteCategory($id) {
        if ($this->db->delete('categories', array('id' => $id))) {
            return true;
        }
        return FALSE;
    }

}
