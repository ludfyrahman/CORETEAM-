<?php
defined('BASEPATH') or exit('No direct script access allowed');

class KelolaAkun extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_KelolaAkun');
        // cek_session();
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
        $this->load->view('user/script');
        $this->load->view('partials/modal_source');
    }

    public function saveAccount()
    {
        $nama       = $this->input->post('nama');
        $username   = $this->input->post('username');
        $role       = $this->input->post('role');
        $status     = $this->input->post('status');
        $password   = password_hash($this->input->post('nama'), PASSWORD_DEFAULT);
        $created_at = date('Y-m-d H:i:s');

        $this->M_KelolaAkun->saveAccount($nama, $username, $role, $status, $password, $created_at);

        echo 1;
    }

    public function detailAccount()
    {
        $data['mainurl'] = 'Detail user';

        $this->load->view('partials/header');
        $this->load->view('partials/sidebar');
        $this->load->view('partials/navbar', $data);
        $this->load->view('user/v_detailKelolaAkun', $data);
        $this->load->view('partials/footer');
        $this->load->view('user/script');
        $this->load->view('partials/modal_source');
    }

    public function profile()
    {
        $data['mainurl'] = 'My Profile';

        $this->load->view('partials/header');
        $this->load->view('partials/sidebar');
        $this->load->view('partials/navbar', $data);
        $this->load->view('user/v_profile', $data);
        $this->load->view('partials/footer');
        $this->load->view('user/script');
        $this->load->view('partials/modal_source');
    }
}
