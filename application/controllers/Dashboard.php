<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_session();
		$this->load->model('M_Dashboard');
    }

    public function index()
    {
        $data['mainurl'] = 'Dashboard';
		$data['data'] =  $this->M_Dashboard->getDataDashboard();
		// echo "<pre>";
		// print_r($data);
		// die;
        $this->load->view('partials/header');
        $this->load->view('partials/sidebar');
        $this->load->view('partials/navbar', $data);
        $this->load->view('dashboard', $data);
        $this->load->view('partials/footer');
    }
}
