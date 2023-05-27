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
		// kalkulasi filter by date now
		$allInspection = $this->db->query('SELECT * FROM inspeksi where date(tgl_inspeksi)  = date(NOW())')->num_rows();
		$carInspection = $this->db->get_where('inspeksi', ['id_category' => 2])->num_rows();
		$truckInspection = $this->db->get_where('inspeksi', ['id_category' => 1])->num_rows();
		$boatInspection = $this->db->get_where('inspeksi', ['id_category' => 3])->num_rows();
		
		// query for get all data in chart
		$charts = [];
		// query for get all category
		$categories = $this->db->get('category')->result_array();
		// query for get all data in chart
		$lists = $this->db->query("SELECT u.nama,COUNT(*) as jumlah,u.id_user FROM inspeksi i JOIN user u on i.inspected_by=u.id_user where  date(tgl_inspeksi)  = date(NOW()) GROUP BY inspected_by")->result_array();
		// define color for chart
		$category_color = ['rgba(167,225,185,0.5)', 'rgba(54, 162, 235, 0.5)', 'rgba(192, 75, 140, 0.5)'];
		$labels = [];
		// loop for get all label
		foreach ($lists as $key => $cat) {
			$labels[] = $cat['nama'];
		}
		// loop for get all data in chart
		foreach ($categories as $key => $cat) {
				$data = [];
				// loop for get all data in chart
				foreach ($lists as $childKey => $l) {
					// query for get calculate data per use
					$li = $this->db->query("SELECT u.nama,COUNT(*) as jumlah FROM inspeksi i JOIN user u on i.inspected_by=u.id_user where inspected_by='$l[id_user]' and id_category='$cat[id_category]' and  date(tgl_inspeksi)  = date(NOW()) GROUP BY inspected_by")->row_array();
					$data[] = $li['jumlah'] ?? 0;
				}
			// define attribute for chart
			$attribute = ['label' => $cat['category'], 'color' => $category_color[$key], 'fill' => false, 'data' => $data];
			// set value for array value charts
			$charts[] = $attribute;
		}
		return [$allInspection, $carInspection, $truckInspection, $boatInspection, $charts,$labels, $category_color];
	}
}
