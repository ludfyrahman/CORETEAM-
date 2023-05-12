<?php
defined('BASEPATH') or exit('No direct script access allowed');

class InspeksiBoat extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_session();
    }

    public function index()
    {
        $data['mainurl'] = 'Inspeksi Boat';
        $this->load->view('partials/header');
        $this->load->view('partials/sidebar');
        $this->load->view('partials/navbar', $data);
        $this->load->view('inspeksi/boat/v_inspeksiBoat', $data);
        $this->load->view('partials/footer');
        $this->load->view('inspeksi/boat/script');
    }

    public function createInspeksi()
    {
        $data['mainurl'] = 'Add Inspeksi Boat';
        $this->load->view('partials/header');
        $this->load->view('partials/sidebar');
        $this->load->view('partials/navbar', $data);
        $this->load->view('inspeksi/boat/v_formInspeksiBoat', $data);
        $this->load->view('partials/footer');
        $this->load->view('inspeksi/boat/script');
        $this->load->view('partials/modal_source');
    }
}
