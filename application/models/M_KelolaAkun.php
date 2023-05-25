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
            $query = [];
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
        $this->db->set('updated_at', $created_at);

        $this->db->insert("user");

        $affectedrows = $this->db->affected_rows();

        if ($affectedrows > 0) {
            $queryinsert = 1;
        } else {
            $queryinsert = 0;
        }

        return $queryinsert;
    }

    public function detail($id)
    {
        $query = $this->db->query("SELECT * FROM user WHERE id_user = '$id'");

        if ($query->num_rows() == 0) {
            $query = 0;
        } else {
            $query = $query->row_array();
        }

        return $query;
    }

    public function setEnable($id) {
        $this->db->set('is_active', 1);
        $this->db->set('updated_at', date('Y-m-d H:i:s'));
        $this->db->where('id_user', $id);

        $this->db->update('user');

        $affectedrows = $this->db->affected_rows();

        if ($affectedrows > 0) {
            $queryupdate = 1;
        } else {
            $queryupdate = 0;
        }

        return $queryupdate;
    }
    
    public function setDisable($id) {
        $this->db->set('is_active', 0);
        $this->db->set('updated_at', date('Y-m-d H:i:s'));
        $this->db->where('id_user', $id);

        $this->db->update('user');

        $affectedrows = $this->db->affected_rows();

        if ($affectedrows > 0) {
            $queryupdate = 1;
        } else {
            $queryupdate = 0;
        }

        return $queryupdate;
    }
   
    public function resetPassword($id_user, $password) {
        $this->db->set('password', $password);
        $this->db->set('updated_at', date('Y-m-d H:i:s'));
        $this->db->where('id_user', $id_user);

        $this->db->update('user');

        $affectedrows = $this->db->affected_rows();

        if ($affectedrows > 0) {
            $queryupdate = 1;
        } else {
            $queryupdate = 0;
        }

        return $queryupdate;
    }
    
    public function deleteAccount($id) {
        $this->db->where('id_user', $id);

        $this->db->delete('user');

        $affectedrows = $this->db->affected_rows();

        if ($affectedrows > 0) {
            $querydelete = 1;
        } else {
            $querydelete = 0;
        }

        return $querydelete;
    }

    public function saveUpdateProfile($id_user, $nama, $username) {
        $this->db->set('nama', $nama);
        $this->db->set('username', $username);
        $this->db->set('updated_at', date('Y-m-d H:i:s'));
        $this->db->where('id_user', $id_user);

        $this->db->update('user');

        $affectedrows = $this->db->affected_rows();

        if ($affectedrows > 0) {
            $queryupdate = 1;
        } else {
            $queryupdate = 0;
        }

        return $queryupdate;
    }
}
