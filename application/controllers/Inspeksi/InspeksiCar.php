<?php
defined('BASEPATH') or exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;

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
        $data['mainurl'] = 'Rescue Car';
        $this->load->view('partials/header');
        $this->load->view('partials/sidebar');
        $this->load->view('partials/navbar', $data);
        $this->load->view('inspeksi/car/v_inspeksiCar', $data);
        $this->load->view('partials/footer');
        $this->load->view('inspeksi/car/script');
    }

    public function createInspeksi()
    {
        $data['mainurl'] = 'Rescue Car';
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
        $data['mainurl'] = 'Rescue Car';
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
		$idCatCar = $this->M_InspeksiCar->getIDCatCar();
		$uploadImage = ['file_name' => null];
		if ($file != 'undefined') {
			
			$config['file_name']       = $file;
			
			$config['allowed_types']   = 'jpg|jpeg|png';
			$config['source_image']    = $_FILES['file']['tmp_name'];
			$config['upload_path']     = './uploads/';

			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			
			if ($this->upload->do_upload('file')) {
				$uploadImage = $this->upload->data();
				$filePath = $uploadImage['full_path'];
				$imageTemp = $config['source_image']; 
				$imageSize = convert_filesize($uploadImage['file_size']); 
				
				// Compress size and upload image 
				$compressedImage = compressImage($imageTemp, $uploadImage['full_path'], 75); 
				
				if($compressedImage){ 
					$compressedImageSize = filesize($compressedImage); 
					$compressedImageSize = convert_filesize($compressedImageSize); 
					
				}else{ 
					echo json_encode(array('status' => 2, 'type' => 'error', 'msg' => 'Gagal Compress file', 'desc' => 'Gagal Kompress Gambar'));
				} 
			}
			
		}
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
            $config['allowed_types']   = 'jpg|jpeg|png';
            $config['source_image']    = $_FILES['file']['tmp_name'];
            $config['upload_path']     = './uploads/';

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('file')) {
                $uploadImage = $this->upload->data();
				$filePath = $uploadImage['full_path'];
				$imageTemp = $config['source_image']; 
				$imageSize = convert_filesize($uploadImage['file_size']); 
				
				// Compress size and upload image 
				$compressedImage = compressImage($imageTemp, $uploadImage['full_path'], 75); 
				
				if($compressedImage){ 
					$compressedImageSize = filesize($compressedImage); 
					$compressedImageSize = convert_filesize($compressedImageSize); 
					
				}else{ 
					echo json_encode(array('status' => 2, 'type' => 'error', 'msg' => 'Gagal Compress file', 'desc' => 'Gagal Kompress Gambar'));
				} 
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
        $sheet->mergeCells('A1:H1');
        $sheet->setCellValue('A1', 'DAILY RESCUE CAR INSPECTION SHEET');
        $sheet->mergeCells('A2:H2');
        $sheet->setCellValue('A2', '(SMOB-PKUP-217)');

        // SUBKATEGORI 1
        $sheet->mergeCells('A3:H3');
        $sheet->setCellValue('A3', '1. MAN CHASIS / ENGINE');
        $sheet->setCellValue('A4', 'Items');
        $sheet->setCellValue('B4', 'Good');
        $sheet->setCellValue('C4', 'Damage');
        $sheet->setCellValue('D4', 'N/A');
        $sheet->setCellValue('E4', 'Items');
        $sheet->setCellValue('F4', 'Good');
        $sheet->setCellValue('G4', 'Damage');
        $sheet->setCellValue('H4', 'N/A');

        //Implementasi Style
        $sheet->getStyle('A1')->applyFromArray($headerArray);
        $sheet->getStyle('A2')->applyFromArray($headerArray);
        $sheet->getStyle('A3:H3')->applyFromArray($subKategoriArray);
        $sheet->getStyle('A4:H4')->applyFromArray($itemArray);

        // Cek Jumlah Data Item SubKategori 1
        $jumlahDataSubCat1 = COUNT($dataSubCat1);

        

		$kolom = '';
        if ($jumlahDataSubCat1 % 2 == 0) { // tidak ada sisa
            $pecahJumlaSubCat1 = $jumlahDataSubCat1 / 2;
        } else { //ada sisa
            $pecahJumlaSubCat1 = ceil($jumlahDataSubCat1 / 2);
            $kolom = 'kosong'; // kondisi buat kolom kosong untuk data ganjil
        }

        // max lebar kolom
        $maxLengthA = 0;
        $maxLengthE = 0;

        // Data Item SubKategori 1
        $numRowItem1 = 5;
        foreach ($dataSubCat1 as $key => $value) {

            if ($key + 1 <= $pecahJumlaSubCat1) {
                $sheet->setCellValue('A' . $numRowItem1, $value['item']);

                // 0 = checklist N/A, 1 = checklist Damage, 2 = checklist Good
                if ($value['conditions'] == '0') {
                    $sheet->setCellValue('D' . $numRowItem1, '✔');
                } else if ($value['conditions'] == '1') {
                    $sheet->setCellValue('C' . $numRowItem1, '✔');
                } else {
                    $sheet->setCellValue('B' . $numRowItem1, '✔');
                }

                $length = (int)(strlen($value['item']));
                $maxLengthA = $length > $maxLengthA ? $length : $maxLengthA;
            } else {
                if ($key + 1 == $pecahJumlaSubCat1 + 1) {
                    $numRowItem1 = 5;
                }

                $sheet->setCellValue('E' . $numRowItem1, $value['item']);

                // 0 = checklist N/A, 1 = checklist Damage, 2 = checklist Good
                if ($value['conditions'] == '0') {
                    $sheet->setCellValue('H' . $numRowItem1, '✔');
                } else if ($value['conditions'] == '1') {
                    $sheet->setCellValue('G' . $numRowItem1, '✔');
                } else {
                    $sheet->setCellValue('F' . $numRowItem1, '✔');
                }

                if ($kolom != '') {
                    if ($key + 1 == $jumlahDataSubCat1) {
                        $empty = $numRowItem1 + 1;
                        $sheet->setCellValue('E' . $empty, '');

                        // 0 = checklist N/A, 1 = checklist Damage, 2 = checklist Good
                        if ($value['conditions'] == '0') {
                            $sheet->setCellValue('H' . $empty, '');
                        } else if ($value['conditions'] == '1') {
                            $sheet->setCellValue('G' . $empty, '');
                        } else {
                            $sheet->setCellValue('F' . $empty, '');
                        }

                        $numRowItem1++;
                    }
                }

                $length = (int)(strlen($value['item']));
                $maxLengthE = $length > $maxLengthE ? $length : $maxLengthE;
            }

            //text center
            $sheet->getStyle('B' . $numRowItem1 . ':D' . $numRowItem1)->applyFromArray($centerArray);
            $sheet->getStyle('F' . $numRowItem1 . ':H' . $numRowItem1)->applyFromArray($centerArray);

            // style data item
            $sheet->getStyle('A' . $numRowItem1 . ':H' . $numRowItem1)->applyFromArray($borderThinArray);

            if ($key != $jumlahDataSubCat1 - 1) {
                $numRowItem1++;
            }
        }
		
        // Data Item SubKategori 2
         // SUBKATEGORI 2
		$numRowSubCat2 = $numRowItem1 + 1;
		$sheet->mergeCells('A' . $numRowSubCat2 . ':H' . $numRowSubCat2);
        $sheet->setCellValue('A'.$numRowSubCat2.'', '2.TRANSMISSION & BRAKING SYSTEM');
        $sheet->getStyle('A' . $numRowSubCat2 . ':H' . $numRowSubCat2)->applyFromArray($subKategoriArray);

        // header item
        $numRowSubCat2 = $numRowSubCat2 + 1;
        $sheet->setCellValue('A' . $numRowSubCat2, 'Items');
        $sheet->setCellValue('B' . $numRowSubCat2, 'Good');
        $sheet->setCellValue('C' . $numRowSubCat2, 'Damage');
        $sheet->setCellValue('D' . $numRowSubCat2, 'N/A');
        $sheet->setCellValue('E' . $numRowSubCat2, 'Items');
        $sheet->setCellValue('F' . $numRowSubCat2, 'Good');
        $sheet->setCellValue('G' . $numRowSubCat2, 'Damage');
        $sheet->setCellValue('H' . $numRowSubCat2, 'N/A');
        $sheet->getStyle('A' . $numRowSubCat2 . ':H' . $numRowSubCat2)->applyFromArray($itemArray);

        // Cek Jumlah Data Item SubKategori 
        $jumlahDataSubCat2 = COUNT($dataSubCat2);

        $kolom = '';
        if ($jumlahDataSubCat2 % 2 == 0) { // tidak ada sisa
            $pecahJumlah = $jumlahDataSubCat2 / 2;
        } else { //ada sisa
            $pecahJumlah = ceil($jumlahDataSubCat2 / 2);
            $kolom = 'kosong'; // kondisi buat kolom kosong untuk data ganjil
        }

        // Data Item SubKategori 2
        $numRowItem2 = $numRowSubCat2 + 1;

        foreach ($dataSubCat2 as $key => $value) {
            if ($key + 1 <= $pecahJumlah) {
                $sheet->setCellValue('A' . $numRowItem2, $value['item']);

                // 0 = checklist N/A, 1 = checklist Damage, 2 = checklist Good
                if ($value['conditions'] == '0') {
                    $sheet->setCellValue('D' . $numRowItem2, '✔');
                } else if ($value['conditions'] == '1') {
                    $sheet->setCellValue('C' . $numRowItem2, '✔');
                } else {
                    $sheet->setCellValue('B' . $numRowItem2, '✔');
                }

                $length = (int)(strlen($value['item']));
                $maxLengthA = $length > $maxLengthA ? $length : $maxLengthA;
            } else {
                if ($key + 1 == $pecahJumlah + 1) {
                    $numRowItem2 = $numRowSubCat2 + 1;
                }

                $sheet->setCellValue('E' . $numRowItem2, $value['item']);

                // 0 = checklist N/A, 1 = checklist Damage, 2 = checklist Good
                if ($value['conditions'] == '0') {
                    $sheet->setCellValue('H' . $numRowItem2, '✔');
                } else if ($value['conditions'] == '1') {
                    $sheet->setCellValue('G' . $numRowItem2, '✔');
                } else {
                    $sheet->setCellValue('F' . $numRowItem2, '✔');
                }

                if ($kolom != '') {
                    if ($key + 1 == $jumlahDataSubCat2) {
                        $empty = $numRowItem2 + 1;
                        $sheet->setCellValue('E' . $empty, '');

                        // 0 = checklist N/A, 1 = checklist Damage, 2 = checklist Good
                        if ($value['conditions'] == '0') {
                            $sheet->setCellValue('H' . $empty, '');
                        } else if ($value['conditions'] == '1') {
                            $sheet->setCellValue('G' . $empty, '');
                        } else {
                            $sheet->setCellValue('F' . $empty, '');
                        }

                        $numRowItem2++;
                    }
                }

                $length = (int)(strlen($value['item']));
                $maxLengthE = $length > $maxLengthE ? $length : $maxLengthE;
            }

            //text center
            $sheet->getStyle('B' . $numRowItem2 . ':D' . $numRowItem2)->applyFromArray($centerArray);
            $sheet->getStyle('F' . $numRowItem2 . ':H' . $numRowItem2)->applyFromArray($centerArray);

            // style data item
            $sheet->getStyle('A' . $numRowItem2 . ':H' . $numRowItem2)->applyFromArray($borderThinArray);

            if ($key != $jumlahDataSubCat2 - 1) {
                $numRowItem2++;
            }
        }

        // Data Item SubKategori 3
		
		$numRowSubCat3 = $numRowItem2 + 1;
        $sheet->mergeCells('A' . $numRowSubCat3 . ':H' . $numRowSubCat3);
        $sheet->setCellValue('A'.$numRowSubCat3.'', '3. ELECTRICAL SYSTEM');
        $sheet->getStyle('A' . $numRowSubCat3 . ':H' . $numRowSubCat3)->applyFromArray($subKategoriArray);

        // header item
        $numRowSubCat3 = $numRowSubCat3 + 1;
        $sheet->setCellValue('A' . $numRowSubCat3, 'Items');
        $sheet->setCellValue('B' . $numRowSubCat3, 'Good');
        $sheet->setCellValue('C' . $numRowSubCat3, 'Damage');
        $sheet->setCellValue('D' . $numRowSubCat3, 'N/A');
        $sheet->setCellValue('E' . $numRowSubCat3, 'Items');
        $sheet->setCellValue('F' . $numRowSubCat3, 'Good');
        $sheet->setCellValue('G' . $numRowSubCat3, 'Damage');
        $sheet->setCellValue('H' . $numRowSubCat3, 'N/A');
        $sheet->getStyle('A' . $numRowSubCat3 . ':H' . $numRowSubCat3)->applyFromArray($itemArray);

        // Cek Jumlah Data Item SubKategori 
        $jumlahDataSubCat3 = COUNT($dataSubCat3);

        $kolom = '';
        if ($jumlahDataSubCat3 % 2 == 0) { // tidak ada sisa
            $pecahJumlah = $jumlahDataSubCat3 / 2;
        } else { //ada sisa
            $pecahJumlah = ceil($jumlahDataSubCat3 / 2);
            $kolom = 'kosong'; // kondisi buat kolom kosong untuk data ganjil
        }

        // Data Item SubKategori 3
        $numRowItem3 = $numRowSubCat3 + 1;

        foreach ($dataSubCat3 as $key => $value) {
            if ($key + 1 <= $pecahJumlah) {
                $sheet->setCellValue('A' . $numRowItem3, $value['item']);

                // 0 = checklist N/A, 1 = checklist Damage, 2 = checklist Good
                if ($value['conditions'] == '0') {
                    $sheet->setCellValue('D' . $numRowItem3, '✔');
                } else if ($value['conditions'] == '1') {
                    $sheet->setCellValue('C' . $numRowItem3, '✔');
                } else {
                    $sheet->setCellValue('B' . $numRowItem3, '✔');
                }

                $length = (int)(strlen($value['item']));
                $maxLengthA = $length > $maxLengthA ? $length : $maxLengthA;
            } else {
                if ($key + 1 == $pecahJumlah + 1) {
                    $numRowItem3 = $numRowSubCat3 + 1;
                }

                $sheet->setCellValue('E' . $numRowItem3, $value['item']);

                // 0 = checklist N/A, 1 = checklist Damage, 2 = checklist Good
                if ($value['conditions'] == '0') {
                    $sheet->setCellValue('H' . $numRowItem3, '✔');
                } else if ($value['conditions'] == '1') {
                    $sheet->setCellValue('G' . $numRowItem3, '✔');
                } else {
                    $sheet->setCellValue('F' . $numRowItem3, '✔');
                }

                if ($kolom != '') {
                    if ($key + 1 == $jumlahDataSubCat3) {
                        $empty = $numRowItem3 + 1;
                        $sheet->setCellValue('E' . $empty, '');

                        // 0 = checklist N/A, 1 = checklist Damage, 2 = checklist Good
                        if ($value['conditions'] == '0') {
                            $sheet->setCellValue('H' . $empty, '');
                        } else if ($value['conditions'] == '1') {
                            $sheet->setCellValue('G' . $empty, '');
                        } else {
                            $sheet->setCellValue('F' . $empty, '');
                        }

                        $numRowItem3++;
                    }
                }

                $length = (int)(strlen($value['item']));
                $maxLengthE = $length > $maxLengthE ? $length : $maxLengthE;
            }

            //text center
            $sheet->getStyle('B' . $numRowItem3 . ':D' . $numRowItem3)->applyFromArray($centerArray);
            $sheet->getStyle('F' . $numRowItem3 . ':H' . $numRowItem3)->applyFromArray($centerArray);

            // style data item
            $sheet->getStyle('A' . $numRowItem3 . ':H' . $numRowItem3)->applyFromArray($borderThinArray);

            if ($key != $jumlahDataSubCat3 - 1) {
                $numRowItem3++;
            }
        }

        // SUBKATEGORI 4
        $numRowSubCat4 = $numRowItem3 + 1;
        $sheet->mergeCells('A' . $numRowSubCat4 . ':H' . $numRowSubCat4);
        $sheet->setCellValue('A'.$numRowSubCat4.'', '4. RESCUE EQUIPMENTS');
        $sheet->getStyle('A' . $numRowSubCat4 . ':H' . $numRowSubCat4)->applyFromArray($subKategoriArray);

        // header item
        $numRowSubCat4 = $numRowSubCat4 + 1;
        $sheet->setCellValue('A' . $numRowSubCat4, 'Items');
        $sheet->setCellValue('B' . $numRowSubCat4, 'Good');
        $sheet->setCellValue('C' . $numRowSubCat4, 'Damage');
        $sheet->setCellValue('D' . $numRowSubCat4, 'N/A');
        $sheet->setCellValue('E' . $numRowSubCat4, 'Items');
        $sheet->setCellValue('F' . $numRowSubCat4, 'Good');
        $sheet->setCellValue('G' . $numRowSubCat4, 'Damage');
        $sheet->setCellValue('H' . $numRowSubCat4, 'N/A');
        $sheet->getStyle('A' . $numRowSubCat4 . ':H' . $numRowSubCat4)->applyFromArray($itemArray);

        // Cek Jumlah Data Item SubKategori 
        $jumlahDataSubCat4 = COUNT($dataSubCat4);

        $kolom = '';
        if ($jumlahDataSubCat4 % 2 == 0) { // tidak ada sisa
            $pecahJumlah = $jumlahDataSubCat4 / 2;
        } else { //ada sisa
            $pecahJumlah = ceil($jumlahDataSubCat4 / 2);
            $kolom = 'kosong'; // kondisi buat kolom kosong untuk data ganjil
        }

        // Data Item SubKategori 4
        $numRowItem4 = $numRowSubCat4 + 1;
        foreach ($dataSubCat4 as $key => $value) {
            if ($key + 1 <= $pecahJumlah) {
                $sheet->setCellValue('A' . $numRowItem4, $value['item']);

                // 0 = checklist N/A, 1 = checklist Damage, 2 = checklist Good
                if ($value['conditions'] == '0') {
                    $sheet->setCellValue('D' . $numRowItem4, '✔');
                } else if ($value['conditions'] == '1') {
                    $sheet->setCellValue('C' . $numRowItem4, '✔');
                } else {
                    $sheet->setCellValue('B' . $numRowItem4, '✔');
                }

                $length = (int)(strlen($value['item']));
                $maxLengthA = $length > $maxLengthA ? $length : $maxLengthA;
            } else {
                if ($key + 1 == $pecahJumlah + 1) {
                    $numRowItem4 = $numRowSubCat4 + 1;
                }

                $sheet->setCellValue('E' . $numRowItem4, $value['item']);

                // 0 = checklist N/A, 1 = checklist Damage, 2 = checklist Good
                if ($value['conditions'] == '0') {
                    $sheet->setCellValue('H' . $numRowItem4, '✔');
                } else if ($value['conditions'] == '1') {
                    $sheet->setCellValue('G' . $numRowItem4, '✔');
                } else {
                    $sheet->setCellValue('F' . $numRowItem4, '✔');
                }

                if ($kolom != '') {
                    if ($key + 1 == $jumlahDataSubCat4) {
                        $empty = $numRowItem4 + 1;
                        $sheet->setCellValue('E' . $empty, '');

                        // 0 = checklist N/A, 1 = checklist Damage, 2 = checklist Good
                        if ($value['conditions'] == '0') {
                            $sheet->setCellValue('H' . $empty, '');
                        } else if ($value['conditions'] == '1') {
                            $sheet->setCellValue('G' . $empty, '');
                        } else {
                            $sheet->setCellValue('F' . $empty, '');
                        }

                        $numRowItem4++;
                    }
                }

                $length = (int)(strlen($value['item']));
                $maxLengthE = $length > $maxLengthE ? $length : $maxLengthE;
            }

            //text center
            $sheet->getStyle('B' . $numRowItem4 . ':D' . $numRowItem4)->applyFromArray($centerArray);
            $sheet->getStyle('F' . $numRowItem4 . ':H' . $numRowItem4)->applyFromArray($centerArray);

            // style data item
            $sheet->getStyle('A' . $numRowItem4 . ':H' . $numRowItem4)->applyFromArray($borderThinArray);

            if ($key != $jumlahDataSubCat4 - 1) {
                $numRowItem4++;
            }
        }

        // Data Item SubKategori 5
		// SUBKATEGORI 5
        $numRowSubCat5 = $numRowItem4 + 1;
        $sheet->mergeCells('A' . $numRowSubCat5 . ':H' . $numRowSubCat5);
        $sheet->setCellValue('A'.$numRowSubCat5.'', '5. HAZMAT EQUIPMENTS');
        $sheet->getStyle('A' . $numRowSubCat5 . ':H' . $numRowSubCat5)->applyFromArray($subKategoriArray);

        // header item
        $numRowSubCat5 = $numRowSubCat5 + 1;
        $sheet->setCellValue('A' . $numRowSubCat5, 'Items');
        $sheet->setCellValue('B' . $numRowSubCat5, 'Good');
        $sheet->setCellValue('C' . $numRowSubCat5, 'Damage');
        $sheet->setCellValue('D' . $numRowSubCat5, 'N/A');
        $sheet->setCellValue('E' . $numRowSubCat5, 'Items');
        $sheet->setCellValue('F' . $numRowSubCat5, 'Good');
        $sheet->setCellValue('G' . $numRowSubCat5, 'Damage');
        $sheet->setCellValue('H' . $numRowSubCat5, 'N/A');
        $sheet->getStyle('A' . $numRowSubCat5 . ':H' . $numRowSubCat5)->applyFromArray($itemArray);

        // Cek Jumlah Data Item SubKategori 
        $jumlahDataSubCat5 = COUNT($dataSubCat5);

        $kolom = '';
        if ($jumlahDataSubCat5 % 2 == 0) { // tidak ada sisa
            $pecahJumlah = $jumlahDataSubCat5 / 2;
        } else { //ada sisa
            $pecahJumlah = ceil($jumlahDataSubCat5 / 2);
            $kolom = 'kosong'; // kondisi buat kolom kosong untuk data ganjil
        }

        // Data Item SubKategori 5
        $numRowItem5 = $numRowSubCat5 + 1;
        foreach ($dataSubCat5 as $key => $value) {
            if ($key + 1 <= $pecahJumlah) {
                $sheet->setCellValue('A' . $numRowItem5, $value['item']);

                // 0 = checklist N/A, 1 = checklist Damage, 2 = checklist Good
                if ($value['conditions'] == '0') {
                    $sheet->setCellValue('D' . $numRowItem5, '✔');
                } else if ($value['conditions'] == '1') {
                    $sheet->setCellValue('C' . $numRowItem5, '✔');
                } else {
                    $sheet->setCellValue('B' . $numRowItem5, '✔');
                }

                $length = (int)(strlen($value['item']));
                $maxLengthA = $length > $maxLengthA ? $length : $maxLengthA;
            } else {
                if ($key + 1 == $pecahJumlah + 1) {
                    $numRowItem5 = $numRowSubCat5 + 1;
                }

                $sheet->setCellValue('E' . $numRowItem5, $value['item']);

                // 0 = checklist N/A, 1 = checklist Damage, 2 = checklist Good
                if ($value['conditions'] == '0') {
                    $sheet->setCellValue('H' . $numRowItem5, '✔');
                } else if ($value['conditions'] == '1') {
                    $sheet->setCellValue('G' . $numRowItem5, '✔');
                } else {
                    $sheet->setCellValue('F' . $numRowItem5, '✔');
                }

                if ($kolom != '') {
                    if ($key + 1 == $jumlahDataSubCat5) {
                        $empty = $numRowItem5 + 1;
                        $sheet->setCellValue('E' . $empty, '');

                        // 0 = checklist N/A, 1 = checklist Damage, 2 = checklist Good
                        if ($value['conditions'] == '0') {
                            $sheet->setCellValue('H' . $empty, '');
                        } else if ($value['conditions'] == '1') {
                            $sheet->setCellValue('G' . $empty, '');
                        } else {
                            $sheet->setCellValue('F' . $empty, '');
                        }

                        $numRowItem5++;
                    }
                }

                $length = (int)(strlen($value['item']));
                $maxLengthE = $length > $maxLengthE ? $length : $maxLengthE;
            }

            //text center
            $sheet->getStyle('B' . $numRowItem5 . ':D' . $numRowItem5)->applyFromArray($centerArray);
            $sheet->getStyle('F' . $numRowItem5 . ':H' . $numRowItem5)->applyFromArray($centerArray);

            // style data item
            $sheet->getStyle('A' . $numRowItem5 . ':H' . $numRowItem5)->applyFromArray($borderThinArray);

            if ($key != $jumlahDataSubCat5 - 1) {
                $numRowItem5++;
            }
        }

        // Data Item SubKategori 6
		// SUBKATEGORI 6
        $numRowSubCat6 = $numRowItem5 + 1;
        $sheet->mergeCells('A' . $numRowSubCat6 . ':H' . $numRowSubCat6);
        $sheet->setCellValue('A'.$numRowSubCat6.'', '6. FIREMAN TOOLS');
        $sheet->getStyle('A' . $numRowSubCat6 . ':H' . $numRowSubCat6)->applyFromArray($subKategoriArray);

        // header item
        $numRowSubCat6 = $numRowSubCat6 + 1;
        $sheet->setCellValue('A' . $numRowSubCat6, 'Items');
        $sheet->setCellValue('B' . $numRowSubCat6, 'Good');
        $sheet->setCellValue('C' . $numRowSubCat6, 'Damage');
        $sheet->setCellValue('D' . $numRowSubCat6, 'N/A');
        $sheet->setCellValue('E' . $numRowSubCat6, 'Items');
        $sheet->setCellValue('F' . $numRowSubCat6, 'Good');
        $sheet->setCellValue('G' . $numRowSubCat6, 'Damage');
        $sheet->setCellValue('H' . $numRowSubCat6, 'N/A');
        $sheet->getStyle('A' . $numRowSubCat6 . ':H' . $numRowSubCat6)->applyFromArray($itemArray);

        // Cek Jumlah Data Item SubKategori 
        $jumlahDataSubCat6 = COUNT($dataSubCat6);

        $kolom = '';
        if ($jumlahDataSubCat6 % 2 == 0) { // tidak ada sisa
            $pecahJumlah = $jumlahDataSubCat6 / 2;
        } else { //ada sisa
            $pecahJumlah = ceil($jumlahDataSubCat6 / 2);
            $kolom = 'kosong'; // kondisi buat kolom kosong untuk data ganjil
        }

        // Data Item SubKategori 6
        $numRowItem6 = $numRowSubCat6 + 1;
        foreach ($dataSubCat6 as $key => $value) {
            if ($key + 1 <= $pecahJumlah) {
                $sheet->setCellValue('A' . $numRowItem6, $value['item']);

                // 0 = checklist N/A, 1 = checklist Damage, 2 = checklist Good
                if ($value['conditions'] == '0') {
                    $sheet->setCellValue('D' . $numRowItem6, '✔');
                } else if ($value['conditions'] == '1') {
                    $sheet->setCellValue('C' . $numRowItem6, '✔');
                } else {
                    $sheet->setCellValue('B' . $numRowItem6, '✔');
                }

                $length = (int)(strlen($value['item']));
                $maxLengthA = $length > $maxLengthA ? $length : $maxLengthA;
            } else {
                if ($key + 1 == $pecahJumlah + 1) {
                    $numRowItem6 = $numRowSubCat6 + 1;
                }

                $sheet->setCellValue('E' . $numRowItem6, $value['item']);

                // 0 = checklist N/A, 1 = checklist Damage, 2 = checklist Good
                if ($value['conditions'] == '0') {
                    $sheet->setCellValue('H' . $numRowItem6, '✔');
                } else if ($value['conditions'] == '1') {
                    $sheet->setCellValue('G' . $numRowItem6, '✔');
                } else {
                    $sheet->setCellValue('F' . $numRowItem6, '✔');
                }

                if ($kolom != '') {
                    if ($key + 1 == $jumlahDataSubCat6) {
                        $empty = $numRowItem6 + 1;
                        $sheet->setCellValue('E' . $empty, '');

                        // 0 = checklist N/A, 1 = checklist Damage, 2 = checklist Good
                        if ($value['conditions'] == '0') {
                            $sheet->setCellValue('H' . $empty, '');
                        } else if ($value['conditions'] == '1') {
                            $sheet->setCellValue('G' . $empty, '');
                        } else {
                            $sheet->setCellValue('F' . $empty, '');
                        }

                        $numRowItem6++;
                    }
                }

                $length = (int)(strlen($value['item']));
                $maxLengthE = $length > $maxLengthE ? $length : $maxLengthE;
            }

            //text center
            $sheet->getStyle('B' . $numRowItem6 . ':D' . $numRowItem6)->applyFromArray($centerArray);
            $sheet->getStyle('F' . $numRowItem6 . ':H' . $numRowItem6)->applyFromArray($centerArray);

            // style data item
            $sheet->getStyle('A' . $numRowItem6 . ':H' . $numRowItem6)->applyFromArray($borderThinArray);

            if ($key != $jumlahDataSubCat6 - 1) {
                $numRowItem6++;
            }
        }
        $sheet->getColumnDimension('A')->setwidth($maxLengthA);
        $sheet->getColumnDimension('E')->setwidth($maxLengthE);

        // SUBKATEGORI 7
        $numRowSubCat7 = $numRowItem6 + 1;
        $sheet->mergeCells('A' . $numRowSubCat7 . ':H' . $numRowSubCat7);
        $sheet->setCellValue('A' . $numRowSubCat7, '7. ATTACHMENTS');
        $sheet->getStyle('A' . $numRowSubCat7 . ':H' . $numRowSubCat7)->applyFromArray($subKategoriArray);

        // Data Item SubKategori 7
        $numRowSubCat7 = $numRowSubCat7 + 1;
        //merge Kolom Horizontal
        $sheet->mergeCells('A' . $numRowSubCat7 . ':F' . ($numRowSubCat7 + 2));
        $sheet->setCellValue('A' . $numRowSubCat7, $dataInspeksi['remark']);
        $sheet->getStyle('A' . $numRowSubCat7 . ':F' . ($numRowSubCat7 + 2))->applyFromArray($leftArray);

        if ($dataInspeksi['attachment'] != '') {
            $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
            $drawing->setPath('./uploads/' . $dataInspeksi['attachment']);
            $drawing->setCoordinates('G' . $numRowSubCat7);
            $drawing->setWidth(120); // Set lebar gambar dalam satuan pixel
            $drawing->setHeight(50); // Set tinggi gambar dalam satuan pixel
            $drawing->setOffsetX(10); // Set offset gambar pada sumbu X
            $drawing->setOffsetY(5); // Set offset gambar pada sumbu Y
            $sheet->getColumnDimension('G')->setAutoSize(true);
            $drawing->getShadow()->setVisible(true);
            $drawing->setWorksheet($sheet);
        }

        $sheet->mergeCells('G' . $numRowSubCat7 . ':H' . ($numRowSubCat7 + 2));
        $sheet->getStyle('G' . $numRowSubCat7 . ':H' . ($numRowSubCat7 + 2))->applyFromArray($centerArray);
        $sheet->getStyle('A' . $numRowSubCat7 . ':H' . ($numRowSubCat7 + 2))->applyFromArray($borderThinArray);

        //Footer 
        $numRowFooter = $numRowSubCat7 + 3;
        $sheet->mergeCells('A' . $numRowFooter . ':H' . $numRowFooter);
        $sheet->setCellValue('A' . $numRowFooter, 'FUEL LEVEL : ' . $dataInspeksi['fuel_level'] . '%');
        $sheet->getStyle('A' . $numRowFooter . ':H' . $numRowFooter)->applyFromArray($boldArray);

        $numRowFooter = $numRowFooter + 2;
        $sheet->setCellValue('A' . $numRowFooter, 'TANGGAL');
        $sheet->getStyle('A' . $numRowFooter)->applyFromArray($boldArray);
        $sheet->setCellValue('B' . $numRowFooter, ':');
        $sheet->getStyle('B' . $numRowFooter)->applyFromArray($headerArray);
        $sheet->mergeCells('C' . $numRowFooter . ':E' . $numRowFooter);
        $sheet->setCellValue('C' . $numRowFooter, $dataInspeksi['tgl_inspeksi']);
        $sheet->getStyle('C' . $numRowFooter . ':E' . $numRowFooter)->applyFromArray($boldArray);
        $sheet->mergeCells('F' . $numRowFooter . ':H' . $numRowFooter);
        $sheet->setCellValue('F' . $numRowFooter, 'Acknowledge by');
        $sheet->getStyle('F' . $numRowFooter . ':H' . $numRowFooter)->applyFromArray($headerArray);

        $numRowFooter = $numRowFooter + 1;
        $sheet->setCellValue('A' . $numRowFooter, 'SHIFT');
        $sheet->getStyle('A' . $numRowFooter)->applyFromArray($boldArray);
        $sheet->setCellValue('B' . $numRowFooter, ':');
        $sheet->getStyle('B' . $numRowFooter)->applyFromArray($headerArray);
        $sheet->mergeCells('C' . $numRowFooter . ':E' . $numRowFooter);
        $sheet->setCellValue('C' . $numRowFooter, $dataInspeksi['shift']);
        $sheet->getStyle('C' . $numRowFooter . ':E' . $numRowFooter)->applyFromArray($boldArray);

        $numRowFooter = $numRowFooter + 1;
        $sheet->setCellValue('A' . $numRowFooter, 'FIRE INCIDENT COMMANDER');
        $sheet->getStyle('A' . $numRowFooter)->applyFromArray($boldArray);
        $sheet->setCellValue('B' . $numRowFooter, ':');
        $sheet->getStyle('B' . $numRowFooter)->applyFromArray($headerArray);
        $sheet->mergeCells('C' . $numRowFooter . ':E' . $numRowFooter);
        $sheet->setCellValue('C' . $numRowFooter, $dataInspeksi['nama']);
        $sheet->getStyle('C' . $numRowFooter . ':E' . $numRowFooter)->applyFromArray($boldArray);

        $numRowFooter = $numRowFooter + 1;
        $sheet->setCellValue('A' . $numRowFooter, 'FIC ASSISTANT');
        $sheet->getStyle('A' . $numRowFooter)->applyFromArray($boldArray);
        $sheet->mergeCells('F' . ($numRowFooter + 1) . ':H' . ($numRowFooter + 1));
        $sheet->setCellValue('F' . ($numRowFooter + 1), 'HERU PURWANTO');
        $sheet->getStyle('F' . ($numRowFooter + 1) . ':H' . ($numRowFooter + 1))->applyFromArray($headerArray);
        $sheet->getStyle('F' . ($numRowFooter + 1) . ':H' . ($numRowFooter + 1))->applyFromArray($borderThinBottomArray);
        $sheet->mergeCells('F' . ($numRowFooter + 2) . ':H' . ($numRowFooter + 2));
        $sheet->setCellValue('F' . ($numRowFooter + 2), 'CT SUPERVISOR');
        $sheet->getStyle('F' . ($numRowFooter + 2) . ':H' . ($numRowFooter + 2))->applyFromArray($centerArray);

        // Data FIC Assistant
        foreach ($dataAssistant as $value) {
            $sheet->setCellValue('B' . $numRowFooter, ':');
            $sheet->mergeCells('C' . $numRowFooter . ':' . 'E' . $numRowFooter);
            $sheet->setCellValue('C' . $numRowFooter, $value['nama']);

            $sheet->getStyle('B' . $numRowFooter)->applyFromArray($headerArray);
            $sheet->getStyle('C' . $numRowFooter . ':' . 'E' . $numRowFooter)->applyFromArray($boldArray);
            $numRowFooter++;
        }

        // Mengatur ukuran kertas menjadi A4 
        $sheet->getPageSetup()->setPaperSize(PageSetup::PAPERSIZE_A4);
        // Mengatur margin menjadi 0.5 untuk semua sisi 
        $sheet->getPageMargins()->setTop(0.5);
        $sheet->getPageMargins()->setRight(0.5);
        $sheet->getPageMargins()->setLeft(0.5);
        $sheet->getPageMargins()->setBottom(0.5);
        $sheet->getPageMargins()->setHeader(0.5);
        $sheet->getPageMargins()->setFooter(0.5);
        // Mengatur agar lembar cetakan masuk dalam satu halaman 
        $sheet->getPageSetup()->setFitToPage(true);

        // Proses file excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Report Fire Truck check.xlsx"'); // Set nama file excel nya
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }
}
