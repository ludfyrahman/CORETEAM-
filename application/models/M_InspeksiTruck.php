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

  public function getCountKategori()
  {
    $query = $this->db->query("SELECT COUNT(a.item) as total, b.subcategory FROM item a LEFT JOIN subcategory b on a.id_subcategory = b.id_subcategory LEFT JOIN category c on b.id_category = c.id_category WHERE c.category = 'Fire Truck' GROUP BY b.subcategory ORDER BY b.id_subcategory asc");

    if ($query->num_rows() == 0) {
      $query = [];
    } else {
      $query = $query->result_array();
    }

    return $query;
  }

  public function getKodeInspeksi()
  {
    $query = $this->db->query("SELECT COUNT(*) as jml FROM inspeksi");

    if ($query->num_rows() == 0) {
      $query = 0;
    } else {
      $query = $query->row_array();
    }

    return $query;
  }

  public function getIDCatFireTruck()
  {
    $query = $this->db->query("SELECT id_category FROM category WHERE category = 'Fire Truck'");

    if ($query->num_rows() == 0) {
      $query = 0;
    } else {
      $query = $query->row_array();
    }

    return $query;
  }

  public function insertInspeksi($id_user, $tglWaktu, $shift, $commander, $fuelLevel, $kodeFile, $uploadImage, $remark, $date_now, $idCategory)
  {
    $this->db->set('inspected_by', $id_user);
    $this->db->set('tgl_inspeksi', $tglWaktu);
    $this->db->set('shift', $shift);
    $this->db->set('fire_incident_commander', $commander);
    $this->db->set('fuel_level', $fuelLevel);
    $this->db->set('kode_inspeksi', $kodeFile);
    $this->db->set('attachment', $uploadImage);
    $this->db->set('remark', $remark);
    $this->db->set('created_at', $date_now);
    $this->db->set('id_category', $idCategory);
    $this->db->insert('inspeksi');

    $affectedrows = $this->db->affected_rows();

    if ($affectedrows > 0) {
      $queryinsert = 1;
    } else {
      $queryinsert = 0;
    }

    return $queryinsert;
  }

  public function getIDInspeksi()
  {
    $query = $this->db->query('SELECT id_inspeksi FROM inspeksi ORDER BY id_inspeksi DESC');

    if ($query->num_rows() == 0) {
      $query = 0;
    } else {
      $query = $query->row_array();
    }

    return $query;
  }

  public function insertInspeksiDetail($id_inspeksi, $id_item, $conditions)
  {
    $this->db->set('id_inspeksi', $id_inspeksi);
    $this->db->set('id_item', $id_item);
    $this->db->set('conditions', $conditions);
    $this->db->insert('inspeksi_detail');

    $affectedrows = $this->db->affected_rows();

    if ($affectedrows > 0) {
      $queryinsert = 1;
    } else {
      $queryinsert = 0;
    }

    return $queryinsert;
  }

  public function insertFICAssistant($id_inspeksi, $ficAssistant)
  {
    $this->db->set('id_inspeksi', $id_inspeksi);
    $this->db->set('fic_assistant', $ficAssistant);
    $this->db->insert('fic_assistant');

    $affectedrows = $this->db->affected_rows();

    if ($affectedrows > 0) {
      $queryinsert = 1;
    } else {
      $queryinsert = 0;
    }

    return $queryinsert;
  }

  // public function getInspeksi()
  // {
  //   $query = $this->db->query("")
  // }
}
