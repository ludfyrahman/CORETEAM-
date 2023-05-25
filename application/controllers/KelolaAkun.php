<?php
defined('BASEPATH') or exit('No direct script access allowed');

class KelolaAkun extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_KelolaAkun');
        cek_session();
    }

    public function index()
    {
        $data['mainurl'] = 'Kelola akun';
        $data['user']    = $this->M_KelolaAkun->read();

        $this->load->view('partials/header');
        $this->load->view('partials/sidebar');
        $this->load->view('partials/navbar', $data);
        $this->load->view('user/v_kelolaAkun', $data);
        $this->load->view('partials/footer');
        $this->load->view('user/script');
        $this->load->view('partials/modal_source');
    }

    public function createAccount()
    {
        $data['mainurl'] = 'Add user';

        $this->load->view('partials/header');
        $this->load->view('partials/sidebar');
        $this->load->view('partials/navbar', $data);
        $this->load->view('user/v_formKelolaAkun', $data);
        $this->load->view('partials/footer');
        $this->load->view('partials/modal_source');
        $this->load->view('user/script');
    }

    public function saveAccount()
    {
        $nama       = $this->input->post('nama');
        $username   = $this->input->post('username');
        $role       = $this->input->post('role');
        $status     = $this->input->post('status');
        $password   = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
        $created_at = date('Y-m-d H:i:s');

        $this->M_KelolaAkun->saveAccount($nama, $username, $role, $status, $password, $created_at);

        echo 1;
    }

    public function detailAccount($id)
    {
        $data['mainurl'] = 'Detail user';
        $data['detail']  = $this->M_KelolaAkun->detail($id);

        $this->load->view('partials/header');
        $this->load->view('partials/sidebar');
        $this->load->view('partials/navbar', $data);
        $this->load->view('user/v_detailKelolaAkun', $data);
        $this->load->view('partials/footer');
        $this->load->view('partials/modal_source');
        $this->load->view('user/script');
    }

    public function setEnable() {
        $id_user = $this->input->post('id_user');
        
        $this->M_KelolaAkun->setEnable($id_user);

        echo 1;
    }
    
    public function setDisable() {
        $id_user = $this->input->post('id_user');
        
        $this->M_KelolaAkun->setDisable($id_user);

        echo 1;
    }
    
    public function resetPassword() {
        $id_user = $this->input->post('id_user');
        $password   = password_hash('coreteam', PASSWORD_DEFAULT);
        
        $this->M_KelolaAkun->resetPassword($id_user, $password);

        echo 1;
    }

    public function deleteAccount() {
        $id_user = $this->input->post('id');
        
        $this->M_KelolaAkun->deleteAccount($id_user);

        echo 1;
    }

    public function profile()
    {
        $data['mainurl'] = 'My Profile';
        $data['detail']  = $this->M_KelolaAkun->detail($this->session->userdata('id_user'));

        $this->load->view('partials/header');
        $this->load->view('partials/sidebar');
        $this->load->view('partials/navbar', $data);
        $this->load->view('user/v_profile', $data);
        $this->load->view('partials/footer');
        $this->load->view('user/script');
        $this->load->view('partials/modal_source');
    }

    public function saveUpdateProfile() {
        $id_user    = $this->session->userdata('id_user');
        $nama       = $this->input->post('nama');
        $username   = $this->input->post('username');

        $this->M_KelolaAkun->saveUpdateProfile($id_user, $nama, $username);

        echo 1;
    }

    public function saveUpdatePassword()
	{
		$pwLama = $this->input->post(htmlspecialchars('pwLama'));
		$pwBaru = $this->input->post(htmlspecialchars('pwBaru'));
		$status = 'Password lama tidak sesuai';

		$data['user']	= $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user')])->row_array();
		$pengguna_id    = $this->session->userdata('id_user');

		if (!password_verify($pwLama, $data['user']['password'])) {
			echo json_encode($status);
			return false;
		} else {
			$cekpw = password_hash($pwBaru, PASSWORD_DEFAULT);
			$this->db->set('password', $cekpw);
			$this->db->where('id_user', $pengguna_id);
			$this->db->update('user');
		}

		echo 1;
	}
}
