<?php
class M_InspeksiTruck extends CI_Model
{
    public function getFireIncidentCommander()
    {
        $query = $this->db->query("SELECT id_user as id, nama FROM user WHERE status = 1 AND is_active = 1");

        if ($query->num_rows() == 0) {
            $query = [];
        } else {
            $query = $query->result_array();
        }

        return $query;
    }

    public function getFICAssistant()
    {
        $query = $this->db->query("SELECT id_user as id, nama FROM user WHERE status = 0 AND is_active = 1");

        if ($query->num_rows() == 0) {
            $query = [];
        } else {
            $query = $query->result_array();
        }

        return $query;
    }

    public function getKategoriManChasisEngine()
    {
        $query = $this->db->query("SELECT
        a.id_item,
        a.item,
        b.subcategory,
        c.category
      FROM item a
      LEFT JOIN subcategory b
        ON a.id_subcategory = b.id_subcategory
      LEFT JOIN category c
        ON b.id_category = c.id_category
      WHERE b.subcategory = 'MAN CHASIS / ENGINE'
      AND c.category = 'Fire Truck'
      AND a.is_active = '1'
      AND b.is_active = '1'
      AND c.is_active = '1'");

        if ($query->num_rows() == 0) {
            $query = [];
        } else {
            $query = $query->result_array();
        }

        return $query;
    }

    public function getKategoriManCabin()
    {
        $query = $this->db->query("SELECT
        a.id_item,
        a.item,
        b.subcategory,
        c.category
      FROM item a
      LEFT JOIN subcategory b
        ON a.id_subcategory = b.id_subcategory
      LEFT JOIN category c
        ON b.id_category = c.id_category
      WHERE b.subcategory = 'MAN CABIN'
      AND c.category = 'Fire Truck'
      AND a.is_active = '1'
      AND b.is_active = '1'
      AND c.is_active = '1'");

        if ($query->num_rows() == 0) {
            $query = [];
        } else {
            $query = $query->result_array();
        }

        return $query;
    }

    public function getKategoriRunningTest()
    {
        $query = $this->db->query("SELECT
        a.id_item,
        a.item,
        b.subcategory,
        c.category
      FROM item a
      LEFT JOIN subcategory b
        ON a.id_subcategory = b.id_subcategory
      LEFT JOIN category c
        ON b.id_category = c.id_category
      WHERE b.subcategory = 'RUNNING TEST'
      AND c.category = 'Fire Truck'
      AND a.is_active = '1'
      AND b.is_active = '1'
      AND c.is_active = '1'");

        if ($query->num_rows() == 0) {
            $query = [];
        } else {
            $query = $query->result_array();
        }

        return $query;
    }

    public function getKategoriManTools()
    {
        $query = $this->db->query("SELECT
        a.id_item,
        a.item,
        b.subcategory,
        c.category
      FROM item a
      LEFT JOIN subcategory b
        ON a.id_subcategory = b.id_subcategory
      LEFT JOIN category c
        ON b.id_category = c.id_category
      WHERE b.subcategory = 'MAN TOOLS'
      AND c.category = 'Fire Truck'
      AND a.is_active = '1'
      AND b.is_active = '1'
      AND c.is_active = '1'");

        if ($query->num_rows() == 0) {
            $query = [];
        } else {
            $query = $query->result_array();
        }

        return $query;
    }

    public function getKategoriZieglerSuperStucture()
    {
        $query = $this->db->query("SELECT
        a.id_item,
        a.item,
        b.subcategory,
        c.category
      FROM item a
      LEFT JOIN subcategory b
        ON a.id_subcategory = b.id_subcategory
      LEFT JOIN category c
        ON b.id_category = c.id_category
      WHERE b.subcategory = 'ZIEGLER SUPERSTUCTURE ( PUMP COMPARTMENT )'
      AND c.category = 'Fire Truck'
      AND a.is_active = '1'
      AND b.is_active = '1'
      AND c.is_active = '1'");

        if ($query->num_rows() == 0) {
            $query = [];
        } else {
            $query = $query->result_array();
        }

        return $query;
    }

    public function getKategoriFiremanToolsEquipments()
    {
        $query = $this->db->query("SELECT
        a.id_item,
        a.item,
        b.subcategory,
        c.category
      FROM item a
      LEFT JOIN subcategory b
        ON a.id_subcategory = b.id_subcategory
      LEFT JOIN category c
        ON b.id_category = c.id_category
      WHERE b.subcategory = 'FIREMAN TOOLS & EQUIPMENTS'
      AND c.category = 'Fire Truck'
      AND a.is_active = '1'
      AND b.is_active = '1'
      AND c.is_active = '1'");

        if ($query->num_rows() == 0) {
            $query = [];
        } else {
            $query = $query->result_array();
        }

        return $query;
    }
}
