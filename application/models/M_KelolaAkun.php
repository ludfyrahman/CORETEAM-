<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_KelolaAkun extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function read()
    {
        $query = $this->db->query("SELECT * FROM user ORDER BY role ASC");

        if ($query->num_rows() == 0) {
            $query = 0;
        } else {
            $query = $query->result_array();
        }

        return $query;
    }

    public function saveAccount($nama, $username, $role, $status, $password, $created_at)
    {
        $this->db->set('nama', $nama);
        $this->db->set('username', $username);
        $this->db->set('role', $role);
        $this->db->set('status', $status);
        $this->db->set('is_active', 1);
        $this->db->set('password', $password);
        $this->db->set('created_at', $created_at);

        $this->db->insert("user");

        $affectedrows = $this->db->affected_rows();

        if ($affectedrows > 0) {
            $queryinsert = 1;
        } else {
            $queryinsert = 0;
        }

        return $queryinsert;
    }
}
