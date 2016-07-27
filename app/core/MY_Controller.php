<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    function __construct() {
        parent::__construct();
        define("DEMO", 0);
        $this->Settings = $this->site->getSettings();
        $this->lang->load('app', $this->Settings->language);
        $this->Settings->pin_code = $this->Settings->pin_code ? md5($this->Settings->pin_code) : NULL;
        $this->theme = $this->Settings->theme.'/views/';
        $this->data['assets'] = base_url() . 'themes/default/assets/';
        $this->data['Settings'] = $this->Settings;
        $this->loggedIn = $this->tec->logged_in();
        $this->data['loggedIn'] = $this->loggedIn;
        $this->data['categories'] = $this->site->getAllCategories();
        $this->Admin = $this->tec->in_group('admin') ? TRUE : NULL;
        $this->data['Admin'] = $this->Admin;
        $this->m = strtolower($this->router->fetch_class());
        $this->v = strtolower($this->router->fetch_method());
        $this->data['m']= $this->m;
        $this->data['v'] = $this->v;

    }

    function page_construct($page, $data = array(), $meta = array()) {
        if(empty($meta)) { $meta['page_title'] = $data['page_title']; }
        $meta['message'] = isset($data['message']) ? $data['message'] : $this->session->flashdata('message');
        $meta['error'] = isset($data['error']) ? $data['error'] : $this->session->flashdata('error');
        $meta['warning'] = isset($data['warning']) ? $data['warning'] : $this->session->flashdata('warning');
        $meta['ip_address'] = $this->input->ip_address();
        $meta['Admin'] = $data['Admin'];
        $meta['loggedIn'] = $data['loggedIn'];
        $meta['Settings'] = $data['Settings'];
        $meta['assets'] = $data['assets'];
        $meta['suspended_sales'] = $this->site->getUserSuspenedSales();
        $meta['qty_alert_num'] = $this->site->getQtyAlerts();
        $this->load->view($this->theme . 'header', $meta);
        $this->load->view($this->theme . $page, $data);
        $this->load->view($this->theme . 'footer');
    }

}
