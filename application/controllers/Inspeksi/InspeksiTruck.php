<?php
defined('BASEPATH') or exit('No direct script access allowed');

class InspeksiTruck extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // cek_session();
        $this->load->model('M_InspeksiTruck');
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
        $this->load->model('M_InspeksiTruck');

        $data['mainurl'] = 'Add Inspeksi Truck';
        $data['commander'] = $this->M_InspeksiTruck->getFireIncidentCommander();
        $data['assistant'] = $this->M_InspeksiTruck->getFICAssistant();
        $data['subcat1'] = $this->M_InspeksiTruck->getKategoriManChasisEngine();
        $data['subcat2'] = $this->M_InspeksiTruck->getKategoriManCabin();
        $data['subcat3'] = $this->M_InspeksiTruck->getKategoriRunningTest();
        $data['subcat4'] = $this->M_InspeksiTruck->getKategoriManTools();
        $data['subcat5'] = $this->M_InspeksiTruck->getKategoriZieglerSuperStucture();
        $data['subcat6'] = $this->M_InspeksiTruck->getKategoriFiremanToolsEquipments();
        $this->load->view('partials/header');
        $this->load->view('partials/sidebar');
        $this->load->view('partials/navbar', $data);
        $this->load->view('inspeksi/truck/v_formInspeksiTruck', $data);
        $this->load->view('partials/footer');
        $this->load->view('inspeksi/truck/script');
        $this->load->view('partials/modal_source');
    }
}
