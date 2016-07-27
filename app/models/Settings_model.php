<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings_model extends CI_Model
{
	
	public function __construct() {
		parent::__construct();
	}
	
	public function updateSetting($data = array()) {
		
		if($this->db->update('settings', $data, array('setting_id' => 1))) {
			return true;
		}
		return false;
	}
	

}
