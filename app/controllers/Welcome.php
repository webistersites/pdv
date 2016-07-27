<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller
{

    function __construct() {
        parent::__construct();

        if (! $this->loggedIn) {
            redirect('login');
        }
        $this->load->model('welcome_model');
        if ($this->Settings->version < 4) {
            $this->welcome_model->userGroups();
            $this->db->update('settings', array('version' => '4.0'), array('setting_id' => 1));
        }
    }

    function index() {
        $this->data['error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('error');
        $this->data['topProducts'] = $this->welcome_model->topProducts();
        $this->data['chartData'] = $this->welcome_model->getChartData();
        $this->data['page_title'] = lang('dashboard');
        $bc = array(array('link' => '#', 'page' => lang('dashboard')));
        $meta = array('page_title' => lang('dashboard'), 'bc' => $bc);
        $this->page_construct('dashboard', $this->data, $meta);

    }

    function disabled() {
        $this->data['error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('error');
        $this->data['page_title'] = lang('disabled_in_demo');
        $bc = array(array('link' => '#', 'page' => lang('disabled_in_demo')));
        $meta = array('page_title' => lang('disabled_in_demo'), 'bc' => $bc);
        $this->page_construct('disabled', $this->data, $meta);
    }

}
