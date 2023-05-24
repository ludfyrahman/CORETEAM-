<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Dashboard extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

	public function getDataDashboard(){
		// kalkulasi
		$allInspection = $this->db->get('inspeksi')->num_rows();
		$carInspection = $this->db->get_where('inspeksi', ['id_category' => 2])->num_rows();
		$truckInspection = $this->db->get_where('inspeksi', ['id_category' => 1])->num_rows();
		$boatInspection = $this->db->get_where('inspeksi', ['id_category' => 3])->num_rows();

		// $charts = $this->db->query("SELECT DATE_FORMAT(tgl_inspeksi, '%M') as bulan, COUNT(*) as jumlah FROM inspeksi GROUP BY bulan")->result_array();
		$labels = $this->db->query("SELECT DATE_FORMAT(tgl_inspeksi, '%Y - %m - %d') as hari FROM inspeksi GROUP BY hari")->result_array();
		$labelData = [];
		foreach ($labels as $key => $label) {
			$labelData[] = $label['hari'];
		}
		$charts = [];
		$categories = $this->db->get('category')->result_array();
		foreach ($categories as $key => $category) {
			$list = $this->db->query("SELECT DATE_FORMAT(tgl_inspeksi, '%Y - %m - %d') as hari, COUNT(*) as jumlah FROM inspeksi where id_category='$category[id_category]' GROUP BY hari")->result_array();
			$data = [];
			foreach ($list as $key => $li) {
				$data[] = $li['jumlah'];
			}
			$attribute = ['label' => $category['category'], 'color' => 'green', 'fill' => false, 'data' => $data];
			$charts[] = $attribute;
		}
		return [$allInspection, $carInspection, $truckInspection, $boatInspection, $charts, $labelData];
	}
}
