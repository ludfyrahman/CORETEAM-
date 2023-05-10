<?php
defined('BASEPATH') or exit('No direct script access allowed');

class InspeksiCar extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // cek_session();
    }

    public function index()
    {
        $data['mainurl'] = 'Inspeksi Car';
        $this->load->view('partials/header');
        $this->load->view('partials/sidebar');
        $this->load->view('partials/navbar', $data);
        $this->load->view('inspeksi/car/v_inspeksiCar', $data);
        $this->load->view('partials/footer');
        $this->load->view('inspeksi/car/script');
    }

    public function createInspeksi()
    {
        $data['mainurl'] = 'Add Inspeksi Car';
        $this->load->view('partials/header');
        $this->load->view('partials/sidebar');
        $this->load->view('partials/navbar', $data);
        $this->load->view('inspeksi/car/v_formInspeksiCar', $data);
        $this->load->view('partials/footer');
        $this->load->view('inspeksi/car/script');
        $this->load->view('partials/modal_source');
    }
}
