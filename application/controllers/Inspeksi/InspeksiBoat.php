<?php
defined('BASEPATH') or exit('No direct script access allowed');

class InspeksiBoat extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_InspeksiBoat');
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

    public function getInspeksi()
    {
        $data = $this->M_InspeksiBoat->getInspeksi();

        echo json_encode($data);
    }

    public function createInspeksi()
    {
        $data['mainurl']    = 'Add Inspeksi Boat';
        $data['commander']  = $this->M_InspeksiBoat->getFireIncidentCommander();
        $data['assistant']  = $this->M_InspeksiBoat->getFICAssistant();
        $data['item']       = $this->M_InspeksiBoat->getItemRescueBoat();
        $data['countsub']   = $this->M_InspeksiBoat->getCountKategori();

        $this->load->view('partials/header');
        $this->load->view('partials/sidebar');
        $this->load->view('partials/navbar', $data);
        $this->load->view('inspeksi/boat/v_formInspeksiBoat', $data);
        $this->load->view('partials/footer');
        $this->load->view('inspeksi/boat/script');
        $this->load->view('partials/modal_source');
    }

    public function saveInspeksi()
    {
        $tglWaktu       = $this->input->post('tglWaktu');
        $shift          = $this->input->post('shift');
        $commander      = $this->input->post('commander');
        $arrAssistant   = $this->input->post('assistant');
        $fuelLevel      = $this->input->post('fuelLevel');
        $arrItem        = $this->input->post('arrItem');
        $remark         = $this->input->post('remark');
        $file           = $_FILES['file']['name'];
        $date_now       = date('Y-m-d H:i:s');
        $id_user        = $this->session->userdata('id_user');

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
            $kodeInspeksi = $this->M_InspeksiBoat->getKodeInspeksi();

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

            // get id category truck
            $idCatRescueBoat = $this->M_InspeksiBoat->getIDCatRescueBoat();

            $this->db->trans_begin();

            // insert ke table inspeksi
            $insert = $this->M_InspeksiBoat->insertInspeksi($id_user, $tglWaktu, $shift, $commander, $fuelLevel, $kodeFile, $uploadImage['file_name'], $remark, $date_now, $idCatRescueBoat['id_category']);

            // get id_inspeksi di tabel inspeksi
            $id = $this->M_InspeksiBoat->getIDInspeksi();

            // insert ke table inspeksi_detail
            $data_item = json_decode($arrItem);
            foreach ($data_item as $row) {
                $insert = $this->M_InspeksiBoat->insertInspeksiDetail($id['id_inspeksi'], $row->id_item, $row->conditions);
            }

            // insert ke table fic_assistant
            $data_assistant = json_decode($arrAssistant);
            foreach ($data_assistant as $row) {
                $insert = $this->M_InspeksiBoat->insertFICAssistant($id['id_inspeksi'], $row);
            }

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                echo json_encode(array('status' => 0, 'type' => 'error', 'msg' => 'Error', 'desc' => 'Gagal Menyimpan Data Inspeksi'));
            } else {
                $this->db->trans_commit();
                echo json_encode(array('status' => 1, 'type' => 'success', 'msg' => 'Sukses', 'desc' => 'Data Berhasil Disimpan'));
            }
        } else {
            echo json_encode(array('status' => 2, 'type' => 'error', 'msg' => 'Sukses', 'desc' => $this->upload->display_errors()));
        }
    }
}
