<?php
defined('BASEPATH') or exit('No direct script access allowed');

class KelolaAkun extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // cek_session();
    }

    public function index()
    {
        $data['mainurl'] = 'Kelola akun';

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
