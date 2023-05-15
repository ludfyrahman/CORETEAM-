<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // cek_session();
    }

    public function index()
    {
        $data['mainurl'] = 'Login';

        $this->load->view('login', $data);
        $this->load->view('script');
    }

    public function login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $user = $this->db->get_where('user', ['username' => $username])->row_array();

        if ($user) {
            if ($user['is_active'] != 0) {
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'id_user'       => $user['id_user'],
                        'username'      => $user['username'],
                        'nama'          => $user['nama'],
                        'role'          => $user['role'],
                        'status'        => $user['status'],
                        'is_active'     => $user['is_active'],
                    ];
                    $this->session->set_userdata($data);
                    echo 1;
                } else {
                    echo 0;
                }
            } else {
                echo 2;
            }
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('Auth');
    }
}
