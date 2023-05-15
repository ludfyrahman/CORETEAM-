<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class InspeksiTruck extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_session();
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

    public function editInspeksi($id_inspeksi)
    {
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

        //get data by id inspeksi
        $data['inspeksi'] = $this->M_InspeksiTruck->getInspeksiByIDInspeksi($id_inspeksi);
        $data['inspeksiAssistant'] = $this->M_InspeksiTruck->getInspeksiAssistant($id_inspeksi);

        $data['id_inspeksi'] = $id_inspeksi;

        // Get Data Inspeksi Detail
        $data['subcat1byid'] = $this->M_InspeksiTruck->getInspeksiDetailSubCat1($id_inspeksi);
        $data['subcat2byid'] = $this->M_InspeksiTruck->getInspeksiDetailSubCat2($id_inspeksi);
        $data['subcat3byid'] = $this->M_InspeksiTruck->getInspeksiDetailSubCat3($id_inspeksi);
        $data['subcat4byid'] = $this->M_InspeksiTruck->getInspeksiDetailSubCat4($id_inspeksi);
        $data['subcat5byid'] = $this->M_InspeksiTruck->getInspeksiDetailSubCat5($id_inspeksi);
        $data['subcat6byid'] = $this->M_InspeksiTruck->getInspeksiDetailSubCat6($id_inspeksi);

        $this->load->view('partials/header');
        $this->load->view('partials/sidebar');
        $this->load->view('partials/navbar', $data);
        $this->load->view('inspeksi/truck/v_editInspeksiTruck', $data);
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

            // get id category truck
            $idCatFireTruck = $this->M_InspeksiTruck->getIDCatFireTruck();

            $this->db->trans_begin();

            // insert ke table inspeksi
            $insert = $this->M_InspeksiTruck->insertInspeksi($id_user, $tglWaktu, $shift, $commander, $fuelLevel, $kodeFile, $uploadImage['file_name'], $remark, $date_now, $idCatFireTruck['id_category']);

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
                echo json_encode(array('status' => 0, 'type' => 'error', 'msg' => 'Error', 'desc' => 'Gagal Menyimpan Data Inspeksi'));
            } else {
                $this->db->trans_commit();
                echo json_encode(array('status' => 1, 'type' => 'success', 'msg' => 'Sukses', 'desc' => 'Data Berhasil Disimpan'));
            }
        } else {
            echo json_encode(array('status' => 2, 'type' => 'error', 'msg' => 'Sukses', 'desc' => $this->upload->display_errors()));
        }
    }

    public function updateInspeksi()
    {
        $tglWaktu = $this->input->post('tglWaktu');
        $shift = $this->input->post('shift');
        $commander = $this->input->post('commander');
        $arrAssistant = $this->input->post('assistant');
        $fuelLevel = $this->input->post('fuelLevel');
        $arrItem = $this->input->post('arrItem');
        $remark = $this->input->post('remark');
        $filePertama = $this->input->post('filePertama');
        $date_now = date('Y-m-d H:i:s');
        $id_user = $this->session->userdata('id_user');
        $idInspeksi = $this->input->post('idInspeksi');

        if (isset($_FILES['file']['name']) && !empty($_FILES['file']['name'])) {
            $file = $_FILES['file']['name'];
        } else {
            $file = '';
        }

        if ($file != '') {
            $config['file_name']       = $file;
            $config['max_size']        = '2048';
            $config['allowed_types']   = 'jpg|jpeg|png';
            $config['source_image']    = $_FILES['file']['tmp_name'];
            $config['upload_path']     = './uploads/';

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('file')) {
                $uploadImage = $this->upload->data();

                $this->db->trans_begin();

                // menghapus file lama
                $file_path = "./uploads/" . $filePertama;
                if (file_exists($file_path)) {
                    unlink($file_path);
                }

                // update ke table inspeksi
                $update = $this->M_InspeksiTruck->updateInspeksi($id_user, $tglWaktu, $shift, $commander, $fuelLevel, $uploadImage['file_name'], $remark, $date_now, $idInspeksi);

                // update ke table inspeksi_detail
                $data_item = json_decode($arrItem);
                foreach ($data_item as $row) {
                    $update = $this->M_InspeksiTruck->updateInspeksiDetail($row->id_inspeksi_detail, $row->id_item, $row->conditions);
                }

                // delete table fic_assistant by id_inspeksi
                $delete = $this->M_InspeksiTruck->deleteInspeksiAssistant($idInspeksi);

                // insert ke table fic_assistant
                $data_assistant = json_decode($arrAssistant);
                foreach ($data_assistant as $row) {
                    $update = $this->M_InspeksiTruck->insertFICAssistant($idInspeksi, $row);
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
        } else {
            $this->db->trans_begin();

            // update ke table inspeksi
            $update = $this->M_InspeksiTruck->updateInspeksi($id_user, $tglWaktu, $shift, $commander, $fuelLevel, $file, $remark, $date_now, $idInspeksi);

            // update ke table inspeksi_detail
            $data_item = json_decode($arrItem);
            foreach ($data_item as $row) {
                $update = $this->M_InspeksiTruck->updateInspeksiDetail($row->id_inspeksi_detail, $row->id_item, $row->conditions);
            }

            // delete table fic_assistant by id_inspeksi
            $delete = $this->M_InspeksiTruck->deleteInspeksiAssistant($idInspeksi);

            // insert ke table fic_assistant
            $data_assistant = json_decode($arrAssistant);
            foreach ($data_assistant as $row) {
                $update = $this->M_InspeksiTruck->insertFICAssistant($idInspeksi, $row);
            }

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                echo json_encode(array('status' => 0, 'type' => 'error', 'msg' => 'Error', 'desc' => 'Gagal Menyimpan Data Inspeksi'));
            } else {
                $this->db->trans_commit();
                echo json_encode(array('status' => 1, 'type' => 'success', 'msg' => 'Sukses', 'desc' => 'Data Berhasil Disimpan'));
            }
        }
    }

    public function getInspeksi()
    {
        $result = $this->M_InspeksiTruck->getInspeksi();

        echo json_encode($result);
    }

    public function exportLaporanInspeksi($id_inspeksi)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Get Data Inspeksi
        $dataInspeksi = $this->M_InspeksiTruck->getInspeksiLaporan($id_inspeksi);

        // Get Data Inspeksi Detail
        $dataSubCat1 = $this->M_InspeksiTruck->getInspeksiDetailSubCat1($id_inspeksi);
        $dataSubCat2 = $this->M_InspeksiTruck->getInspeksiDetailSubCat2($id_inspeksi);
        $dataSubCat3 = $this->M_InspeksiTruck->getInspeksiDetailSubCat3($id_inspeksi);
        $dataSubCat4 = $this->M_InspeksiTruck->getInspeksiDetailSubCat4($id_inspeksi);
        $dataSubCat5 = $this->M_InspeksiTruck->getInspeksiDetailSubCat5($id_inspeksi);
        $dataSubCat6 = $this->M_InspeksiTruck->getInspeksiDetailSubCat6($id_inspeksi);

        // Get Data FIC Assistant
        $dataAssistant = $this->M_InspeksiTruck->getInspeksiAssistant($id_inspeksi);

        // Style Excel
        $headerArray = [
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'font' => [
                'bold' => true,
            ]
        ];

        $subKategoriArray = [
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'font' => [
                'bold' => true,
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => [
                    'argb' => 'ACB9CA',
                ],
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                ],
            ],
        ];

        $itemArray = [
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'font' => [
                'bold' => true,
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => [
                    'argb' => 'D6DCE4',
                ],
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];

        $centerArray = [
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
        ];

        $leftArray = [
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
        ];

        $boldArray = [
            'font' => [
                'bold' => true,
            ],
        ];

        $borderThinArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];

        $borderThinBottomArray = [
            'borders' => [
                'bottom' => [
                    'borderStyle' => PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];

        // Merge Kolom
        $sheet->mergeCells('A1:H1');
        $sheet->setCellValue('A1', 'DAILY FIRE TRUCK INSPECTION SHEET');
        $sheet->mergeCells('A2:H2');
        $sheet->setCellValue('A2', '(SMOB-164)');

        // SUBKATEGORI 1
        $sheet->mergeCells('A3:D3');
        $sheet->setCellValue('A3', '1. MAN CHASIS / ENGINE');
        $sheet->setCellValue('A4', 'Items');
        $sheet->setCellValue('B4', 'Good');
        $sheet->setCellValue('C4', 'Damage');
        $sheet->setCellValue('D4', 'N/A');

        //SUBKATEGORI 2
        $sheet->mergeCells('E3:H3');
        $sheet->setCellValue('E3', '2. MAN CABIN');
        $sheet->setCellValue('E4', 'Items');
        $sheet->setCellValue('F4', 'Good');
        $sheet->setCellValue('G4', 'Damage');
        $sheet->setCellValue('H4', 'N/A');

        //SUBKATEGORI 3
        $sheet->mergeCells('A16:D16');
        $sheet->setCellValue('A16', '3. RUNNING TEST');
        $sheet->setCellValue('A17', 'Items');
        $sheet->setCellValue('B17', 'Good');
        $sheet->setCellValue('C17', 'Damage');
        $sheet->setCellValue('D17', 'N/A');

        //SUBKATEGORI 4
        $sheet->mergeCells('A21:D21');
        $sheet->setCellValue('A21', '4. MAN TOOLS');
        $sheet->setCellValue('A22', 'Items');
        $sheet->setCellValue('B22', 'Good');
        $sheet->setCellValue('C22', 'Damage');
        $sheet->setCellValue('D22', 'N/A');

        //SUBKATEGORI 5
        $sheet->mergeCells('A26:H26');
        $sheet->setCellValue('A26', '5. ZIEGLER SUPERSTUCTURE ( PUMP COMPARTMENT )');
        $sheet->setCellValue('A27', 'Items');
        $sheet->setCellValue('B27', 'Good');
        $sheet->setCellValue('C27', 'Damage');
        $sheet->setCellValue('D27', 'N/A');
        $sheet->setCellValue('E27', 'Items');
        $sheet->setCellValue('F27', 'Good');
        $sheet->setCellValue('G27', 'Damage');
        $sheet->setCellValue('H27', 'N/A');

        //SUBKATEGORI 6
        $sheet->mergeCells('A32:H32');
        $sheet->setCellValue('A32', '6. FIREMAN TOOLS & EQUIPMENTS');
        $sheet->setCellValue('A33', 'Items');
        $sheet->setCellValue('B33', 'Good');
        $sheet->setCellValue('C33', 'Damage');
        $sheet->setCellValue('D33', 'N/A');
        $sheet->setCellValue('E33', 'Items');
        $sheet->setCellValue('F33', 'Good');
        $sheet->setCellValue('G33', 'Damage');
        $sheet->setCellValue('H33', 'N/A');

        //SUBKATEGORI 7
        $sheet->mergeCells('A52:H52');
        $sheet->setCellValue('A52', '7. ATTACHMENTS');

        // Implementasi Style
        $sheet->getStyle('A1')->applyFromArray($headerArray);
        $sheet->getStyle('A2')->applyFromArray($headerArray);
        $sheet->getStyle('A3:D3')->applyFromArray($subKategoriArray);
        $sheet->getStyle('E3:H3')->applyFromArray($subKategoriArray);
        $sheet->getStyle('A16:D16')->applyFromArray($subKategoriArray);
        $sheet->getStyle('A21:D21')->applyFromArray($subKategoriArray);
        $sheet->getStyle('A26:H26')->applyFromArray($subKategoriArray);
        $sheet->getStyle('A32:H32')->applyFromArray($subKategoriArray);
        $sheet->getStyle('A52:H52')->applyFromArray($subKategoriArray);
        $sheet->getStyle('A4:D4')->applyFromArray($itemArray);
        $sheet->getStyle('E4:H4')->applyFromArray($itemArray);
        $sheet->getStyle('A17:D17')->applyFromArray($itemArray);
        $sheet->getStyle('A22:D22')->applyFromArray($itemArray);
        $sheet->getStyle('A27:H27')->applyFromArray($itemArray);
        $sheet->getStyle('A33:H33')->applyFromArray($itemArray);

        // Data Item SubKategori 1
        $numrow = 5;
        foreach ($dataSubCat1 as $value) {
            $sheet->setCellValue('A' . $numrow, $value['item']);

            // 0 = checklist N/A, 1 = checklist Damage, 2 = checklist Good
            if ($value['conditions'] == '0') {
                $sheet->setCellValue('D' . $numrow, '✔');
            } else if ($value['conditions'] == '1') {
                $sheet->setCellValue('C' . $numrow, '✔');
            } else {
                $sheet->setCellValue('B' . $numrow, '✔');
            }

            $sheet->getStyle('D' . $numrow)->applyFromArray($centerArray);
            $sheet->getStyle('C' . $numrow)->applyFromArray($centerArray);
            $sheet->getStyle('B' . $numrow)->applyFromArray($centerArray);

            $numrow++;
        }

        // Data Item SubKategori 2
        $numrow = 5;
        foreach ($dataSubCat2 as $value) {
            $sheet->setCellValue('E' . $numrow, $value['item']);

            // 0 = checklist N/A, 1 = checklist Damage, 2 = checklist Good
            if ($value['conditions'] == '0') {
                $sheet->setCellValue('H' . $numrow, '✔');
            } else if ($value['conditions'] == '1') {
                $sheet->setCellValue('G' . $numrow, '✔');
            } else {
                $sheet->setCellValue('F' . $numrow, '✔');
            }

            $sheet->getStyle('H' . $numrow)->applyFromArray($centerArray);
            $sheet->getStyle('G' . $numrow)->applyFromArray($centerArray);
            $sheet->getStyle('F' . $numrow)->applyFromArray($centerArray);

            $numrow++;
        }

        // Data Item SubKategori 3
        $numrow = 18;
        foreach ($dataSubCat3 as $value) {
            $sheet->setCellValue('A' . $numrow, $value['item']);

            // 0 = checklist N/A, 1 = checklist Damage, 2 = checklist Good
            if ($value['conditions'] == '0') {
                $sheet->setCellValue('D' . $numrow, '✔');
            } else if ($value['conditions'] == '1') {
                $sheet->setCellValue('C' . $numrow, '✔');
            } else {
                $sheet->setCellValue('B' . $numrow, '✔');
            }

            $sheet->getStyle('D' . $numrow)->applyFromArray($centerArray);
            $sheet->getStyle('C' . $numrow)->applyFromArray($centerArray);
            $sheet->getStyle('B' . $numrow)->applyFromArray($centerArray);

            $numrow++;
        }

        // Data Item SubKategori 4
        $numrow = 23;
        foreach ($dataSubCat4 as $value) {
            $sheet->setCellValue('A' . $numrow, $value['item']);

            // 0 = checklist N/A, 1 = checklist Damage, 2 = checklist Good
            if ($value['conditions'] == '0') {
                $sheet->setCellValue('D' . $numrow, '✔');
            } else if ($value['conditions'] == '1') {
                $sheet->setCellValue('C' . $numrow, '✔');
            } else {
                $sheet->setCellValue('B' . $numrow, '✔');
            }

            $sheet->getStyle('D' . $numrow)->applyFromArray($centerArray);
            $sheet->getStyle('C' . $numrow)->applyFromArray($centerArray);
            $sheet->getStyle('B' . $numrow)->applyFromArray($centerArray);

            $numrow++;
        }

        // Data Item SubKategori 5
        $numrow = 28;
        foreach ($dataSubCat5 as $key => $value) {
            if ($key <= 3) {
                $sheet->setCellValue('A' . $numrow, $value['item']);

                // 0 = checklist N/A, 1 = checklist Damage, 2 = checklist Good
                if ($value['conditions'] == '0') {
                    $sheet->setCellValue('D' . $numrow, '✔');
                } else if ($value['conditions'] == '1') {
                    $sheet->setCellValue('C' . $numrow, '✔');
                } else {
                    $sheet->setCellValue('B' . $numrow, '✔');
                }

                $sheet->getStyle('D' . $numrow)->applyFromArray($centerArray);
                $sheet->getStyle('C' . $numrow)->applyFromArray($centerArray);
                $sheet->getStyle('B' . $numrow)->applyFromArray($centerArray);

                $numrow++;

                if ($key == 3) {
                    $numrow = 28;
                }
            } else {
                $sheet->setCellValue('E' . $numrow, $value['item']);

                // 0 = checklist N/A, 1 = checklist Damage, 2 = checklist Good
                if ($value['conditions'] == '0') {
                    $sheet->setCellValue('H' . $numrow, '✔');
                } else if ($value['conditions'] == '1') {
                    $sheet->setCellValue('G' . $numrow, '✔');
                } else {
                    $sheet->setCellValue('F' . $numrow, '✔');
                }

                $sheet->getStyle('H' . $numrow)->applyFromArray($centerArray);
                $sheet->getStyle('G' . $numrow)->applyFromArray($centerArray);
                $sheet->getStyle('F' . $numrow)->applyFromArray($centerArray);

                $numrow++;
            }
        }

        // Data Item SubKategori 6
        $numrow = 34;
        foreach ($dataSubCat6 as $key => $value) {
            if ($key <= 17) {
                $sheet->setCellValue('A' . $numrow, $value['item']);

                // 0 = checklist N/A, 1 = checklist Damage, 2 = checklist Good
                if ($value['conditions'] == '0') {
                    $sheet->setCellValue('D' . $numrow, '✔');
                } else if ($value['conditions'] == '1') {
                    $sheet->setCellValue('C' . $numrow, '✔');
                } else {
                    $sheet->setCellValue('B' . $numrow, '✔');
                }

                $sheet->getStyle('D' . $numrow)->applyFromArray($centerArray);
                $sheet->getStyle('C' . $numrow)->applyFromArray($centerArray);
                $sheet->getStyle('B' . $numrow)->applyFromArray($centerArray);

                $numrow++;

                if ($key == 17) {
                    $numrow = 34;
                }
            } else {
                $sheet->setCellValue('E' . $numrow, $value['item']);

                // 0 = checklist N/A, 1 = checklist Damage, 2 = checklist Good
                if ($value['conditions'] == '0') {
                    $sheet->setCellValue('H' . $numrow, '✔');
                } else if ($value['conditions'] == '1') {
                    $sheet->setCellValue('G' . $numrow, '✔');
                } else {
                    $sheet->setCellValue('F' . $numrow, '✔');
                }

                $sheet->getStyle('H' . $numrow)->applyFromArray($centerArray);
                $sheet->getStyle('G' . $numrow)->applyFromArray($centerArray);
                $sheet->getStyle('F' . $numrow)->applyFromArray($centerArray);

                $numrow++;
            }
        }

        // Data Item SubKategori 7
        //merge Kolom Horizontal
        $sheet->mergeCells('A53:F55');
        $sheet->setCellValue('A53', $dataInspeksi['remark']);
        $sheet->getStyle('A53:F55')->applyFromArray($leftArray);

        $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
        $sheet->mergeCells('G53:H55');
        $drawing->setPath('./uploads/' . $dataInspeksi['attachment']);
        $drawing->setCoordinates('G53');
        $drawing->setWidth(120); // Set lebar gambar dalam satuan pixel
        $drawing->setHeight(50); // Set tinggi gambar dalam satuan pixel
        $drawing->setOffsetX(10); // Set offset gambar pada sumbu X
        $drawing->setOffsetY(5); // Set offset gambar pada sumbu Y
        $sheet->getColumnDimension('G')->setAutoSize(true);
        $drawing->getShadow()->setVisible(true);
        $sheet->getStyle('G53:H55')->applyFromArray($centerArray);
        $drawing->setWorksheet($sheet);

        //Style Data Item
        $sheet->getStyle('A5:D15')->applyFromArray($borderThinArray);
        $sheet->getStyle('E5:H25')->applyFromArray($borderThinArray);
        $sheet->getStyle('A18:D20')->applyFromArray($borderThinArray);
        $sheet->getStyle('A23:D25')->applyFromArray($borderThinArray);
        $sheet->getStyle('A28:H31')->applyFromArray($borderThinArray);
        $sheet->getStyle('A34:H51')->applyFromArray($borderThinArray);
        $sheet->getStyle('A53:H55')->applyFromArray($borderThinArray);

        //Footer 
        $sheet->mergeCells('A56:H56');
        $sheet->setCellValue('A56', 'FUEL LEVEL : ' . $dataInspeksi['fuel_level']);
        $sheet->mergeCells('C58:E58');
        $sheet->setCellValue('C58', $dataInspeksi['tgl_inspeksi']);
        $sheet->mergeCells('C59:D59');
        $sheet->setCellValue('C59', $dataInspeksi['shift']);
        $sheet->mergeCells('C60:E60');
        $sheet->setCellValue('C60', 'ARIS ARIYANTO');
        $sheet->mergeCells('F58:H58');
        $sheet->setCellValue('F58', 'Acknowledge by');
        $sheet->mergeCells('F62:H62');
        $sheet->setCellValue('F62', 'HERU PURWANTO');
        $sheet->mergeCells('F63:H63');
        $sheet->setCellValue('F63', 'CT SUPERVISOR');

        $sheet->setCellValue('A58', 'TANGGAL');
        $sheet->setCellValue('A59', 'SHIFT');
        $sheet->setCellValue('A60', 'FIRE INCIDENT COMMANDER');
        $sheet->setCellValue('A61', 'FIC ASSISTANT');
        $sheet->setCellValue('B58', ':');
        $sheet->setCellValue('B59', ':');
        $sheet->setCellValue('B60', ':');

        // style kolom
        $sheet->getStyle('A56:H56')->applyFromArray($boldArray);
        $sheet->getStyle('C58:E58')->applyFromArray($boldArray);
        $sheet->getStyle('C59:E59')->applyFromArray($boldArray);
        $sheet->getStyle('C60:E60')->applyFromArray($boldArray);
        $sheet->getStyle('F58:H58')->applyFromArray($headerArray);
        $sheet->getStyle('F62:H62')->applyFromArray($headerArray);
        $sheet->getStyle('F63:H63')->applyFromArray($centerArray);
        $sheet->getStyle('A58')->applyFromArray($boldArray);
        $sheet->getStyle('A59')->applyFromArray($boldArray);
        $sheet->getStyle('A60')->applyFromArray($boldArray);
        $sheet->getStyle('A61')->applyFromArray($boldArray);
        $sheet->getStyle('B58')->applyFromArray($headerArray);
        $sheet->getStyle('B59')->applyFromArray($headerArray);
        $sheet->getStyle('B60')->applyFromArray($headerArray);
        $sheet->getStyle('F62:H62')->applyFromArray($borderThinBottomArray);

        // panggil laporanDetailSingle
        $num = 61;
        foreach ($dataAssistant as $value) {
            $sheet->setCellValue('B' . $num, ':');
            $sheet->mergeCells('C' . $num . ':' . 'E' . $num);
            $sheet->setCellValue('C' . $num, $value['nama']);

            $sheet->getStyle('B' . $num)->applyFromArray($headerArray);
            $sheet->getStyle('C' . $num . ':' . 'E' . $num)->applyFromArray($boldArray);
            $num++;
        }

        // Proses file excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Report Fire Truck check.xlsx"'); // Set nama file excel nya
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }
}
