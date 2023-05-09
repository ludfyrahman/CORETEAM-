<?php
defined('BASEPATH') or exit('No direct script access allowed');

class InspeksiTruck extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // $this->load->model('admin/ProfilModel');
        // cek_session();
    }

    public function index()
    {
        $data['mainurl'] = 'Inspeksi Truck';
        $this->load->view('partials/header');
        $this->load->view('partials/sidebar');
        $this->load->view('partials/navbar', $data);
        $this->load->view('inspeksi/truck/v_inspeksiTruck', $data);
        $this->load->view('partials/footer');
        $this->load->view('inspeksi/truck/script');
    }

    public function createInspeksi()
    {
        $data['mainurl'] = 'Add Inspeksi Truck';
        $this->load->view('partials/header');
        $this->load->view('partials/sidebar');
        $this->load->view('partials/navbar', $data);
        $this->load->view('inspeksi/truck/v_formInspeksiTruck', $data);
        $this->load->view('partials/footer');
        $this->load->view('inspeksi/truck/script');
        $this->load->view('partials/modal_source');
    }
}
