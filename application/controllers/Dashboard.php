<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // $this->load->model('admin/ProfilModel');
        // cek_session();
    }

    public function index()
    {
        $data['mainurl'] = 'Dashboard';
        $this->load->view('dashboard', $data);
    }
}
