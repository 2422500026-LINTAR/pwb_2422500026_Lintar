<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_dashboard_controller extends CI_Controller {
    public function index() {
        $data['title'] = 'Delphi Pet Shop';
        $this->load->view('administrator/templates/header', $data);
        $this->load->view('administrator/templates/sidebar');
        $this->load->view('administrator/dashboard');
        $this->load->view('administrator/templates/footer');
    }
}