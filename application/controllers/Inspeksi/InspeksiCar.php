<?php
defined('BASEPATH') or exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class InspeksiCar extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_session();
		$this->load->model('M_InspeksiCar');
		$this->category = 'Rescue Car';
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
		$data['commander'] = $this->M_InspeksiCar->getFireIncidentCommander();
        $data['assistant'] = $this->M_InspeksiCar->getFICAssistant();
		$data['subcat1'] = $this->M_InspeksiCar->getKategoriEngine();
        $data['subcat2'] = $this->M_InspeksiCar->getKategoriTransmissionBreakingSystem();
        $data['subcat3'] = $this->M_InspeksiCar->getKategoriElectricalSystem();
        $data['subcat4'] = $this->M_InspeksiCar->getKategoriRescueEquipment();
        $data['subcat5'] = $this->M_InspeksiCar->getKategoriHazmatEquipments();
        $data['subcat6'] = $this->M_InspeksiCar->getKategoriFiremanTools();
        $data['countsub'] = $this->M_InspeksiCar->getCountKategori();
        $this->load->view('partials/header');
        $this->load->view('partials/sidebar');
        $this->load->view('partials/navbar', $data);
        $this->load->view('inspeksi/car/v_formInspeksiCar', $data);
        $this->load->view('partials/footer');
        $this->load->view('inspeksi/car/script');
        $this->load->view('partials/modal_source');
    }

	public function editInspeksi($id_inspeksi)
    {
        $data['mainurl'] = 'Edit Inspeksi Car';
        $data['commander'] = $this->M_InspeksiCar->getFireIncidentCommander();
        $data['assistant'] = $this->M_InspeksiCar->getFICAssistant();
        $data['subcat1'] = $this->M_InspeksiCar->getKategoriEngine();
        $data['subcat2'] = $this->M_InspeksiCar->getKategoriTransmissionBreakingSystem();
        $data['subcat3'] = $this->M_InspeksiCar->getKategoriElectricalSystem();
        $data['subcat4'] = $this->M_InspeksiCar->getKategoriRescueEquipment();
        $data['subcat5'] = $this->M_InspeksiCar->getKategoriHazmatEquipments();
        $data['subcat6'] = $this->M_InspeksiCar->getKategoriFiremanTools();
        $data['countsub'] = $this->M_InspeksiCar->getCountKategori();

        //get data by id inspeksi
        $data['inspeksi'] = $this->M_InspeksiCar->getInspeksiByIDInspeksi($id_inspeksi);
        $data['inspeksiAssistant'] = $this->M_InspeksiCar->getInspeksiAssistant($id_inspeksi);

        $data['id_inspeksi'] = $id_inspeksi;

        // Get Data Inspeksi Detail
        $data['subcat1byid'] = $this->M_InspeksiCar->getInspeksiDetailSubCat1($id_inspeksi);
        $data['subcat2byid'] = $this->M_InspeksiCar->getInspeksiDetailSubCat2($id_inspeksi);
        $data['subcat3byid'] = $this->M_InspeksiCar->getInspeksiDetailSubCat3($id_inspeksi);
        $data['subcat4byid'] = $this->M_InspeksiCar->getInspeksiDetailSubCat4($id_inspeksi);
        $data['subcat5byid'] = $this->M_InspeksiCar->getInspeksiDetailSubCat5($id_inspeksi);
        $data['subcat6byid'] = $this->M_InspeksiCar->getInspeksiDetailSubCat6($id_inspeksi);

        $this->load->view('partials/header');
        $this->load->view('partials/sidebar');
        $this->load->view('partials/navbar', $data);
        $this->load->view('inspeksi/car/v_editInspeksiCar', $data);
        $this->load->view('partials/footer');
        $this->load->view('inspeksi/car/script');
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
            $kodeInspeksi = $this->M_InspeksiCar->getKodeInspeksi();

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
            $idCatCar = $this->M_InspeksiCar->getIDCatCar();

            $this->db->trans_begin();

            // insert ke table inspeksi
            $insert = $this->M_InspeksiCar->insertInspeksi($id_user, $tglWaktu, $shift, $commander, $fuelLevel, $kodeFile, $uploadImage['file_name'], $remark, $date_now, $idCatCar['id_category']);

            // get id_inspeksi di tabel inspeksi
            $id = $this->M_InspeksiCar->getIDInspeksi();

            // insert ke table inspeksi_detail
            $data_item = json_decode($arrItem);
            foreach ($data_item as $row) {
                $insert = $this->M_InspeksiCar->insertInspeksiDetail($id['id_inspeksi'], $row->id_item, $row->conditions);
            }

            // insert ke table fic_assistant
            $data_assistant = json_decode($arrAssistant);
            foreach ($data_assistant as $row) {
                $insert = $this->M_InspeksiCar->insertFICAssistant($id['id_inspeksi'], $row);
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

	public function getInspeksi()
    {
        $result = $this->M_InspeksiCar->getInspeksi();

        echo json_encode($result);
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
                $update = $this->M_InspeksiCar->updateInspeksi($id_user, $tglWaktu, $shift, $commander, $fuelLevel, $uploadImage['file_name'], $remark, $date_now, $idInspeksi);

                // update ke table inspeksi_detail
                $data_item = json_decode($arrItem);
                foreach ($data_item as $row) {
                    $update = $this->M_InspeksiCar->updateInspeksiDetail($row->id_inspeksi_detail, $row->id_item, $row->conditions);
                }

                // delete table fic_assistant by id_inspeksi
                $delete = $this->M_InspeksiCar->deleteInspeksiAssistant($idInspeksi);

                // insert ke table fic_assistant
                $data_assistant = json_decode($arrAssistant);
                foreach ($data_assistant as $row) {
                    $update = $this->M_InspeksiCar->insertFICAssistant($idInspeksi, $row);
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
            $update = $this->M_InspeksiCar->updateInspeksi($id_user, $tglWaktu, $shift, $commander, $fuelLevel, $file, $remark, $date_now, $idInspeksi);

            // update ke table inspeksi_detail
            $data_item = json_decode($arrItem);
            foreach ($data_item as $row) {
                $update = $this->M_InspeksiCar->updateInspeksiDetail($row->id_inspeksi_detail, $row->id_item, $row->conditions);
            }

            // delete table fic_assistant by id_inspeksi
            $delete = $this->M_InspeksiCar->deleteInspeksiAssistant($idInspeksi);

            // insert ke table fic_assistant
            $data_assistant = json_decode($arrAssistant);
            foreach ($data_assistant as $row) {
                $update = $this->M_InspeksiCar->insertFICAssistant($idInspeksi, $row);
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

	public function exportLaporanInspeksi($id_inspeksi)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Get Data Inspeksi
        $dataInspeksi = $this->M_InspeksiCar->getInspeksiLaporan($id_inspeksi);

        // Get Data Inspeksi Detail
        $dataSubCat1 = $this->M_InspeksiCar->getInspeksiDetailSubCat1($id_inspeksi);
        $dataSubCat2 = $this->M_InspeksiCar->getInspeksiDetailSubCat2($id_inspeksi);
        $dataSubCat3 = $this->M_InspeksiCar->getInspeksiDetailSubCat3($id_inspeksi);
        $dataSubCat4 = $this->M_InspeksiCar->getInspeksiDetailSubCat4($id_inspeksi);
        $dataSubCat5 = $this->M_InspeksiCar->getInspeksiDetailSubCat5($id_inspeksi);
        $dataSubCat6 = $this->M_InspeksiCar->getInspeksiDetailSubCat6($id_inspeksi);

        // Get Data FIC Assistant
        $dataAssistant = $this->M_InspeksiCar->getInspeksiAssistant($id_inspeksi);

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
                    'argb' => 'E2EFDA',
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
                    'argb' => 'E2EFDA',
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
        $sheet->mergeCells('A1:L1');
        $sheet->setCellValue('A1', 'DAILY RESCUE CAR INSPECTION SHEET');
        $sheet->mergeCells('A2:L2');
        $sheet->setCellValue('A2', '(SMOB-PKUP-217)');

        // SUBKATEGORI 1
        $sheet->mergeCells('A3:D3');
        $sheet->setCellValue('A3', '1. ENGINE');
        $sheet->setCellValue('A4', 'Items');
        $sheet->setCellValue('B4', 'Good');
        $sheet->setCellValue('C4', 'Damage');
        $sheet->setCellValue('D4', 'N/A');

        //SUBKATEGORI 2
        $sheet->mergeCells('A10:D10');
        $sheet->setCellValue('A10', '2.TRANSMISSION & BRAKING SYSTEM');
        $sheet->setCellValue('A11', 'Items');
        $sheet->setCellValue('B11', 'Good');
        $sheet->setCellValue('C11', 'Damage');
        $sheet->setCellValue('D11', 'N/A');

        //SUBKATEGORI 3
        $sheet->mergeCells('A18:D18');
        $sheet->setCellValue('A18', '3. ELECTRICAL SYSTEM');
        $sheet->setCellValue('A19', 'Items');
        $sheet->setCellValue('B19', 'Good');
        $sheet->setCellValue('C19', 'Damage');
        $sheet->setCellValue('D19', 'N/A');

        //SUBKATEGORI 4
        $sheet->mergeCells('E3:H3');
        $sheet->setCellValue('E3', '4. RESCUE EQUIPMENTS');
        $sheet->setCellValue('E4', 'Items');
        $sheet->setCellValue('F4', 'Yes');
        $sheet->setCellValue('G4', 'No');
        $sheet->setCellValue('H4', 'N/A');

        //SUBKATEGORI 5
        $sheet->mergeCells('I3:L3');
        $sheet->setCellValue('I3', '5. HAZMAT EQUIPMENTS');
        $sheet->setCellValue('I4', 'Items');
        $sheet->setCellValue('J4', 'Yes');
        $sheet->setCellValue('K4', 'No');
        $sheet->setCellValue('L4', 'N/A');

        //SUBKATEGORI 6
        $sheet->mergeCells('I17:L17');
        $sheet->setCellValue('I17', '6. FIREMAN TOOLS');
        $sheet->setCellValue('I18', 'Items');
        $sheet->setCellValue('J18', 'Yes');
        $sheet->setCellValue('K18', 'No');
        $sheet->setCellValue('L18', 'N/A');

        //SUBKATEGORI 7
        $sheet->mergeCells('A28:L28');
        $sheet->setCellValue('A28', '7. ATTACHMENTS');

        // Implementasi Style
        $sheet->getStyle('A1')->applyFromArray($headerArray);
        $sheet->getStyle('A2')->applyFromArray($headerArray);
        $sheet->getStyle('A3:D3')->applyFromArray($subKategoriArray);
        $sheet->getStyle('A10:D10')->applyFromArray($subKategoriArray);
        $sheet->getStyle('A18:D18')->applyFromArray($subKategoriArray);
        $sheet->getStyle('E3:H3')->applyFromArray($subKategoriArray);
        $sheet->getStyle('I3:L3')->applyFromArray($subKategoriArray);
        $sheet->getStyle('I17:L17')->applyFromArray($subKategoriArray);
        $sheet->getStyle('A28:L28')->applyFromArray($subKategoriArray);
        $sheet->getStyle('A4:D4')->applyFromArray($itemArray);
        $sheet->getStyle('A11:D11')->applyFromArray($itemArray);
        $sheet->getStyle('A19:D19')->applyFromArray($itemArray);
        $sheet->getStyle('E4:H4')->applyFromArray($itemArray);
        $sheet->getStyle('I4:L4')->applyFromArray($itemArray);
        $sheet->getStyle('I18:L18')->applyFromArray($itemArray);

        // Data Item SubKategori 1
        $numrow = 5;
        foreach ($dataSubCat1 as $value) {
			$sheet->getColumnDimension('A')->setAutoSize(true);
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
        $numrow = 12;
        foreach ($dataSubCat2 as $value) {
			
            $sheet->setCellValue('A' . $numrow, $value['item']);

            // 0 = checklist N/A, 1 = checklist Damage, 2 = checklist Good
            if ($value['conditions'] == '0') {
                $sheet->setCellValue('D' . $numrow, '✔');
            } else if ($value['conditions'] == '2') {
                $sheet->setCellValue('C' . $numrow, '✔');
            } else {
                $sheet->setCellValue('B' . $numrow, '✔');
            }

            $sheet->getStyle('D' . $numrow)->applyFromArray($centerArray);
            $sheet->getStyle('C' . $numrow)->applyFromArray($centerArray);
            $sheet->getStyle('B' . $numrow)->applyFromArray($centerArray);

            $numrow++;
        }

        // Data Item SubKategori 3
        $numrow = 20;
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
        $numrow = 5;
        foreach ($dataSubCat4 as $value) {
			$sheet->getColumnDimension('E')->setAutoSize(true);
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

        // Data Item SubKategori 5
        $numrow = 5;
        foreach ($dataSubCat5 as $value) {
			$sheet->getColumnDimension('I')->setAutoSize(true);
            $sheet->setCellValue('I' . $numrow, $value['item']);

            // 0 = checklist N/A, 1 = checklist Damage, 2 = checklist Good
            if ($value['conditions'] == '0') {
                $sheet->setCellValue('L' . $numrow, '✔');
            } else if ($value['conditions'] == '1') {
                $sheet->setCellValue('K' . $numrow, '✔');
            } else {
                $sheet->setCellValue('J' . $numrow, '✔');
            }

            $sheet->getStyle('L' . $numrow)->applyFromArray($centerArray);
            $sheet->getStyle('K' . $numrow)->applyFromArray($centerArray);
            $sheet->getStyle('J' . $numrow)->applyFromArray($centerArray);

            $numrow++;
        }

        // Data Item SubKategori 6
        $numrow = 19;
        foreach ($dataSubCat6 as $value) {
			$sheet->getColumnDimension('I')->setAutoSize(true);
            $sheet->setCellValue('I' . $numrow, $value['item']);

            // 0 = checklist N/A, 1 = checklist Damage, 2 = checklist Good
            if ($value['conditions'] == '0') {
                $sheet->setCellValue('L' . $numrow, '✔');
            } else if ($value['conditions'] == '1') {
                $sheet->setCellValue('K' . $numrow, '✔');
            } else {
                $sheet->setCellValue('J' . $numrow, '✔');
            }

            $sheet->getStyle('L' . $numrow)->applyFromArray($centerArray);
            $sheet->getStyle('K' . $numrow)->applyFromArray($centerArray);
            $sheet->getStyle('J' . $numrow)->applyFromArray($centerArray);

            $numrow++;
        }

        // Data Item SubKategori 7
        //merge Kolom Horizontal
        $sheet->mergeCells('A29:J31');
        $sheet->setCellValue('A29', $dataInspeksi['remark']);
        $sheet->getStyle('A29:J31')->applyFromArray($leftArray);

        $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
        $sheet->mergeCells('K29:L31');
        $drawing->setPath('./uploads/' . $dataInspeksi['attachment']);
        $drawing->setCoordinates('K29');
        $drawing->setWidth(120); // Set lebar gambar dalam satuan pixel
        $drawing->setHeight(50); // Set tinggi gambar dalam satuan pixel
        $drawing->setOffsetX(10); // Set offset gambar pada sumbu X
        $drawing->setOffsetY(5); // Set offset gambar pada sumbu Y
        $sheet->getColumnDimension('K')->setAutoSize(true);
        $drawing->getShadow()->setVisible(true);
        $sheet->getStyle('K29:L31')->applyFromArray($centerArray);
        $drawing->setWorksheet($sheet);

        //Style Data Item
        $sheet->getStyle('A5:D9')->applyFromArray($borderThinArray);
        $sheet->getStyle('A12:D17')->applyFromArray($borderThinArray);
        $sheet->getStyle('A20:D27')->applyFromArray($borderThinArray);
        $sheet->getStyle('E5:H27')->applyFromArray($borderThinArray);
        $sheet->getStyle('I5:L16')->applyFromArray($borderThinArray);
        $sheet->getStyle('I19:L27')->applyFromArray($borderThinArray);
        $sheet->getStyle('A29:L31')->applyFromArray($borderThinArray);

        //Footer 
        $sheet->mergeCells('A32:L32');
        $sheet->setCellValue('A32', 'FUEL LEVEL : ' . $dataInspeksi['fuel_level'] . '%');
        $sheet->mergeCells('C34:E34');
        $sheet->setCellValue('C34', $dataInspeksi['tgl_inspeksi']);
        $sheet->mergeCells('C35:E35');
        $sheet->setCellValue('C35', $dataInspeksi['shift']);
        $sheet->mergeCells('C36:E36');
        $sheet->setCellValue('C36', $dataInspeksi['nama']);
        $sheet->mergeCells('J34:L34');
        $sheet->setCellValue('J34', 'Acknowledge by');
        $sheet->mergeCells('J38:L38');
        $sheet->setCellValue('J38', 'HERU PURWANTO');
        $sheet->mergeCells('J39:L39');
        $sheet->setCellValue('J39', 'CT SUPERVISOR');

        $sheet->setCellValue('A34', 'TANGGAL');
        $sheet->setCellValue('A35', 'SHIFT');
        $sheet->setCellValue('A36', 'FIRE INCIDENT COMMANDER');
        $sheet->setCellValue('A37', 'FIC ASSISTANT');
        $sheet->setCellValue('B34', ':');
        $sheet->setCellValue('B35', ':');
        $sheet->setCellValue('B36', ':');

        // style kolom
        $sheet->getStyle('A32:L32')->applyFromArray($boldArray);
        $sheet->getStyle('C34:E34')->applyFromArray($boldArray);
        $sheet->getStyle('C35:E35')->applyFromArray($boldArray);
        $sheet->getStyle('C36:E36')->applyFromArray($boldArray);
        $sheet->getStyle('J34:L34')->applyFromArray($headerArray);
        $sheet->getStyle('J38:L38')->applyFromArray($headerArray);
        $sheet->getStyle('J39:L39')->applyFromArray($centerArray);
        $sheet->getStyle('A34')->applyFromArray($boldArray);
        $sheet->getStyle('A35')->applyFromArray($boldArray);
        $sheet->getStyle('A36')->applyFromArray($boldArray);
        $sheet->getStyle('A37')->applyFromArray($boldArray);
        $sheet->getStyle('B34')->applyFromArray($headerArray);
        $sheet->getStyle('B35')->applyFromArray($headerArray);
        $sheet->getStyle('B36')->applyFromArray($headerArray);
        $sheet->getStyle('J38:L38')->applyFromArray($borderThinBottomArray);

        // panggil laporanDetailSingle
        $num = 37;
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
        header('Content-Disposition: attachment; filename="Report Resque Car Check.xlsx"'); // Set nama file excel nya
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }
}
