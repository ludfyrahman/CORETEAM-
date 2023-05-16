<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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

    public function editInspeksi($id)
    {
        $data['mainurl']    = 'Add Inspeksi Boat';
        $data['commander']  = $this->M_InspeksiBoat->getFireIncidentCommander();
        $data['assistant']  = $this->M_InspeksiBoat->getFICAssistant();
        $data['item']       = $this->M_InspeksiBoat->getItemRescueBoat();
        $data['countsub']   = $this->M_InspeksiBoat->getCountKategori();

        //get data by id inspeksi
        $data['inspeksi']           = $this->M_InspeksiBoat->getInspeksiByIDInspeksi($id);
        $data['inspeksiAssistant']  = $this->M_InspeksiBoat->getInspeksiAssistant($id);

        // Get Data Inspeksi Detail
        $data['listItemById'] = $this->M_InspeksiBoat->getInspeksiDetailRescueBoat($id);

        $data['id_inspeksi'] = $id;

        $this->load->view('partials/header');
        $this->load->view('partials/sidebar');
        $this->load->view('partials/navbar', $data);
        $this->load->view('inspeksi/boat/v_editInspeksiBoat', $data);
        $this->load->view('partials/footer');
        $this->load->view('inspeksi/boat/script');
        $this->load->view('partials/modal_source');
    }

    public function saveUpdateInspeksi()
    {
        $tglWaktu       = $this->input->post('tglWaktu');
        $shift          = $this->input->post('shift');
        $commander      = $this->input->post('commander');
        $arrAssistant   = $this->input->post('assistant');
        $fuelLevel      = $this->input->post('fuelLevel');
        $arrItem        = $this->input->post('arrItem');
        $remark         = $this->input->post('remark');
        $filePertama    = $this->input->post('filePertama');
        $date_now       = date('Y-m-d H:i:s');
        $id_user        = $this->session->userdata('id_user');
        $idInspeksi     = $this->input->post('idInspeksi');

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
                $this->M_InspeksiBoat->saveUpdateInspeksi($id_user, $tglWaktu, $shift, $commander, $fuelLevel, $uploadImage['file_name'], $remark, $date_now, $idInspeksi);

                // update ke table inspeksi_detail
                $data_item = json_decode($arrItem);
                foreach ($data_item as $row) {
                    $this->M_InspeksiBoat->saveUpdateInspeksiDetail($row->id_inspeksi_detail, $row->id_item, $row->conditions);
                }

                // delete table fic_assistant by id_inspeksi
                $this->M_InspeksiBoat->deleteInspeksiAssistant($idInspeksi);

                // insert ke table fic_assistant
                $data_assistant = json_decode($arrAssistant);
                foreach ($data_assistant as $row) {
                    $this->M_InspeksiBoat->insertFICAssistant($idInspeksi, $row);
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
            $this->M_InspeksiBoat->saveUpdateInspeksi($id_user, $tglWaktu, $shift, $commander, $fuelLevel, $file, $remark, $date_now, $idInspeksi);

            // update ke table inspeksi_detail
            $data_item = json_decode($arrItem);
            foreach ($data_item as $row) {
                $this->M_InspeksiBoat->saveUpdateInspeksiDetail($row->id_inspeksi_detail, $row->id_item, $row->conditions);
            }

            // delete table fic_assistant by id_inspeksi
            $this->M_InspeksiBoat->deleteInspeksiAssistant($idInspeksi);

            // insert ke table fic_assistant
            $data_assistant = json_decode($arrAssistant);
            foreach ($data_assistant as $row) {
                $this->M_InspeksiBoat->insertFICAssistant($idInspeksi, $row);
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
        $dataInspeksi = $this->M_InspeksiBoat->getInspeksiLaporan($id_inspeksi);

        // Get Data Inspeksi Detail
        $dataSubKategoriBoat = $this->M_InspeksiBoat->getInspeksiDetailSubCatBoat($id_inspeksi);

        // Get Data FIC Assistant
        $dataAssistant = $this->M_InspeksiBoat->getInspeksiAssistant($id_inspeksi);

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
        $sheet->mergeCells('A2:G2');
        $sheet->setCellValue('A2', 'DAILY RESCUE BOAT INSPECTION SHEET');
        $sheet->mergeCells('A3:G3');
        $sheet->setCellValue('A3', '( SMOB-BOAT-49 )');

        // Header
        $sheet->mergeCells('A4:C5');
        $sheet->setCellValue('A4', 'DESCRIPTION');
        $sheet->mergeCells('D4:D5');
        $sheet->setCellValue('D4', 'QTY');
        $sheet->mergeCells('E4:G4');
        $sheet->setCellValue('E4', 'CONDITION');
        $sheet->setCellValue('E5', 'Yes');
        $sheet->setCellValue('F5', 'No');
        $sheet->setCellValue('G5', 'N/A');
        $sheet->mergeCells('A16:G16');
        $sheet->setCellValue('A16', 'ATTACHMENT');

        // Data Item
        $numrow = 6;
        foreach ($dataSubKategoriBoat as $value) {
            $sheet->mergeCells('A' . $numrow . ':' . 'C' . $numrow);
            $sheet->setCellValue('A' . $numrow, $value['item']);
            $sheet->setCellValue('D' . $numrow, $value['qty']);

            // 0 = checklist N/A, 1 = checklist Damage, 2 = checklist Good
            if ($value['conditions'] == 0) {
                $sheet->setCellValue('G' . $numrow, '✔');
            } else if ($value['conditions'] == 1) {
                $sheet->setCellValue('F' . $numrow, '✔');
            } else {
                $sheet->setCellValue('E' . $numrow, '✔');
            }

            $sheet->getStyle('G' . $numrow)->applyFromArray($centerArray);
            $sheet->getStyle('F' . $numrow)->applyFromArray($centerArray);
            $sheet->getStyle('E' . $numrow)->applyFromArray($centerArray);

            $numrow++;
        }

        // Attachment
        $sheet->mergeCells('A17:E19');
        $sheet->setCellValue('A17', $dataInspeksi['remark']);
        $sheet->getStyle('A17:E19')->applyFromArray($leftArray);

        $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
        //gambar header
        $drawing->setPath('./uploads/Paiton.png');
        $drawing->setCoordinates('A1');
        $drawing->setWidthAndHeight(100, 100);
        $drawing->setOffsetY(10);
        $drawing->getShadow()->setVisible(true);
        $drawing->setWorksheet($sheet);

        $drawing1 = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
        // gambar item
        $sheet->mergeCells('F17:G19');
        $drawing1->setPath('./uploads/' . $dataInspeksi['attachment']);
        $drawing1->setCoordinates('F17');
        $drawing1->setWidth(120); // Set lebar gambar dalam satuan pixel
        $drawing1->setHeight(50); // Set tinggi gambar dalam satuan pixel
        $drawing1->setOffsetX(10); // Set offset gambar pada sumbu X
        $drawing1->setOffsetY(5); // Set offset gambar pada sumbu Y
        $drawing1->getShadow()->setVisible(true);
        $sheet->getStyle('F17:G19')->applyFromArray($centerArray);
        $drawing1->setWorksheet($sheet);

        //implementasi style header
        $sheet->getStyle('A2')->applyFromArray($headerArray);
        $sheet->getStyle('A3')->applyFromArray($headerArray);
        $sheet->getStyle('A4:C5')->applyFromArray($subKategoriArray);
        $sheet->getStyle('D4:D5')->applyFromArray($subKategoriArray);
        $sheet->getStyle('E4:G4')->applyFromArray($subKategoriArray);
        $sheet->getStyle('E5:G5')->applyFromArray($subKategoriArray);
        $sheet->getStyle('A16:G16')->applyFromArray($subKategoriArray);

        //implementasi style item
        $sheet->getStyle('A6:G15')->applyFromArray($borderThinArray);
        $sheet->getStyle('A17:G19')->applyFromArray($borderThinArray);

        //Footer 
        $sheet->mergeCells('A20:G20');
        $sheet->setCellValue('A20', 'FUEL LEVEL : ' . $dataInspeksi['fuel_level'] . '%');
        $sheet->mergeCells('E22:G22');
        $sheet->setCellValue('E22', 'Acknowledge by');
        $sheet->mergeCells('E26:G26');
        $sheet->setCellValue('E26', 'HERU PURWANTO');
        $sheet->mergeCells('E27:G27');
        $sheet->setCellValue('E27', 'CT SUPERVISOR');

        $sheet->setCellValue('A22', 'TANGGAL');
        $sheet->setCellValue('A23', 'SHIFT');
        $sheet->setCellValue('A24', 'FIRE INCIDENT COMMANDER');
        $sheet->setCellValue('A25', 'FIC ASSISTANT');
        $sheet->setCellValue('B22', ':');
        $sheet->setCellValue('B23', ':');
        $sheet->setCellValue('B24', ':');
        $sheet->setCellValue('C22', $dataInspeksi['tgl_inspeksi']);
        $sheet->setCellValue('C23', $dataInspeksi['shift']);
        $sheet->setCellValue('C24', $dataInspeksi['nama']);

        // style kolom
        $sheet->getStyle('A20:G20')->applyFromArray($boldArray);
        $sheet->getStyle('C22:C24')->applyFromArray($boldArray);
        $sheet->getStyle('C34:E34')->applyFromArray($boldArray);
        $sheet->getStyle('C35:E35')->applyFromArray($boldArray);
        $sheet->getStyle('C36:E36')->applyFromArray($boldArray);
        $sheet->getStyle('E22:G22')->applyFromArray($headerArray);
        $sheet->getStyle('E26:G26')->applyFromArray($headerArray);
        $sheet->getStyle('E27:G27')->applyFromArray($centerArray);
        $sheet->getStyle('A22:A25')->applyFromArray($boldArray);
        $sheet->getStyle('B22:B24')->applyFromArray($headerArray);
        $sheet->getStyle('E26:G26')->applyFromArray($borderThinBottomArray);
        $sheet->getColumnDimension('C')->setWidth(20);

        // Kolom Assistant
        $num = 25;
        foreach ($dataAssistant as $value) {
            $sheet->setCellValue('B' . $num, ':');
            $sheet->mergeCells('C' . $num);
            $sheet->setCellValue('C' . $num, $value['nama']);

            $sheet->getStyle('B' . $num)->applyFromArray($headerArray);
            $sheet->getStyle('C' . $num)->applyFromArray($boldArray);
            $num++;
        }

        // Proses file excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Report Rescue Boat check.xlsx"'); // Set nama file excel nya
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }
}
