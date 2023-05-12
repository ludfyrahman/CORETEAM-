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
        $data['countsub'] = $this->M_InspeksiTruck->getCountKategori();
        $this->load->view('partials/header');
        $this->load->view('partials/sidebar');
        $this->load->view('partials/navbar', $data);
        $this->load->view('inspeksi/truck/v_formInspeksiTruck', $data);
        $this->load->view('partials/footer');
        $this->load->view('inspeksi/truck/script');
        $this->load->view('partials/modal_source');
    }

    public function saveInspeksi()
    {
        $tglWaktu = $this->input->post('tglWaktu');
        $shift = $this->input->post('shift');
        $commander = $this->input->post('commander');
        $arrAssistant = $this->input->post('assistant');
        $fuelLevel = $this->input->post('fuelLevel');
        $arrItem = $this->input->post('arrItem');
        $remark = $this->input->post('remark');
        $file = $_FILES['file']['name'];
        $date_now = date('Y-m-d H:i:s');
        $id_user = $this->session->userdata('id_user');

        $config['file_name']       = $file;
        $config['max_size']        = '2048';
        $config['allowed_types']   = 'jpg|jpeg|png';
        $config['source_image']    = $_FILES['file']['tmp_name'];
        $config['upload_path']     = './uploads/';

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if ($this->upload->do_upload('file')) {
            $uploadImage = $this->upload->data();

            // get jumlah data
            $kodeInspeksi = $this->M_InspeksiTruck->getKodeInspeksi();

            $angka = $kodeInspeksi['jml'] + 1;
            if ($angka >= 0 and $angka < 10) {
                $kodeFile = 'FT' . "-000000" . $angka;
            } else if ($angka >= 10 and $angka < 100) {
                $kodeFile = 'FT' . "-00000" . $angka;
            } else if ($angka >= 100 and $angka < 1000) {
                $kodeFile = 'FT' . "-0000" . $angka;
            } else if ($angka >= 1000 and $angka < 10000) {
                $kodeFile = 'FT' . "-000" . $angka;
            } else if ($angka >= 10000 and $angka < 100000) {
                $kodeFile = 'FT' . "-00" . $angka;
            } else if ($angka >= 100000 and $angka < 1000000) {
                $kodeFile = 'FT' . "-0" . $angka;
            } else if ($angka >= 1000000) {
                $kodeFile = 'FT' . "-" . $angka;
            }

            $this->db->trans_begin();

            // insert ke table inspeksi
            $insert = $this->M_InspeksiTruck->insertInspeksi($id_user, $tglWaktu, $shift, $commander, $fuelLevel, $kodeFile, $uploadImage['file_name'], $remark, $date_now);

            // get id_inspeksi di tabel inspeksi
            $id = $this->M_InspeksiTruck->getIDInspeksi();

            // insert ke table inspeksi_detail
            $data_item = json_decode($arrItem);
            foreach ($data_item as $row) {
                $insert = $this->M_InspeksiTruck->insertInspeksiDetail($id['id_inspeksi'], $row->id_item, $row->conditions);
            }

            // insert ke table fic_assistant
            $data_assistant = json_decode($arrAssistant);
            foreach ($data_assistant as $row) {
                $insert = $this->M_InspeksiTruck->insertFICAssistant($id['id_inspeksi'], $row);
            }

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                echo json_encode(array('status' => false, 'message' => 'Gagal Menyimpan Data Inspeksi'));
            } else {
                $this->db->trans_commit();
                echo json_encode(array('status' => true, 'message' => 'Data Berhasil Disimpan'));
            }
        } else {
            echo json_encode(array('status' => 'error', 'message' => $this->upload->display_errors()));
        }
    }
}
