<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_session();
    }

    public function index()
    {
        $data['mainurl'] = 'Dashboard';
        $this->load->view('partials/header');
        $this->load->view('partials/sidebar');
        $this->load->view('partials/navbar', $data);
        $this->load->view('dashboard', $data);
        $this->load->view('partials/footer');
    }
}
