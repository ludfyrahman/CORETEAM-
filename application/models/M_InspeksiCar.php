<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_InspeksiCar extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
    $this->load->database();
    $this->category = 'Rescue Car';
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
  public function getInspeksiAssistant($id_inspeksi)
  {
    $query = $this->db->query("SELECT b.nama, a.fic_assistant FROM fic_assistant a
		LEFT JOIN user b ON a.fic_assistant = b.id_user
		WHERE id_inspeksi = '$id_inspeksi'");

    if ($query->num_rows() == 0) {
      $query = 0;
    } else {
      $query = $query->result_array();
    };

    return $query;
  }
  public function getInspeksiByIDInspeksi($id_inspeksi)
  {
    $query = $this->db->query("SELECT
		DATE_FORMAT(tgl_inspeksi, '%Y-%m-%dT%H:%i') as tgl_inspeksi,
		shift,
		fire_incident_commander,
		fuel_level,
		attachment,
		remark
	FROM inspeksi 
	WHERE id_inspeksi = '$id_inspeksi'");

    if ($query->num_rows() == 0) {
      $query = 0;
    } else {
      $query = $query->row_array();
    }

    return $query;
  }

  public function getInspeksi()
  {
    $query = $this->db->query("SELECT
                                  a.id_inspeksi,
                                  a.kode_inspeksi,
                                  a.inspected_by,
                                  DATE_FORMAT(a.tgl_inspeksi, '%d-%m-%Y (%H:%i:%s)') as tgl_inspeksi,
                                  b.nama
                                FROM inspeksi a
                                LEFT JOIN user b
                                  ON a.inspected_by = b.id_user
                                LEFT JOIN category c
                                  ON a.id_category = c.id_category
                                WHERE c.category = '$this->category'");

    if ($query->num_rows() == 0) {
      $query = 0;
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

  public function updateInspeksiDetail($idInspeksiDetail, $id_item, $conditions)
  {
    $this->db->set('id_item', $id_item);
    $this->db->set('conditions', $conditions);
    $this->db->where('id_inspeksi_detail', $idInspeksiDetail);
    $this->db->update('inspeksi_detail');

    $affectedrows = $this->db->affected_rows();

    if ($affectedrows > 0) {
      $queryinsert = 1;
    } else {
      $queryinsert = 0;
    }

    return $queryinsert;
  }

  public function updateInspeksi($id_user, $tglWaktu, $shift, $commander, $fuelLevel, $file, $remark, $date_now, $idInspeksi)
  {
    if ($file != '') {
      $this->db->set('attachment', $file);
    }

    $this->db->set('inspected_by', $id_user);
    $this->db->set('tgl_inspeksi', $tglWaktu);
    $this->db->set('shift', $shift);
    $this->db->set('fire_incident_commander', $commander);
    $this->db->set('fuel_level', $fuelLevel);
    $this->db->set('remark', $remark);
    $this->db->set('updated_at', $date_now);
    $this->db->where('id_inspeksi', $idInspeksi);
    $this->db->update('inspeksi');

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

  public function updateFICAssistant($id_inspeksi, $ficAssistant)
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

  //export excel
  public function getInspeksiLaporan($id_inspeksi)
  {
    $query = $this->db->query("SELECT a.attachment, a.remark, a.fuel_level, DATE_FORMAT(a.tgl_inspeksi, '%d-%m-%Y') as tgl_inspeksi, 
    CASE
      WHEN a.shift = 0 THEN 'pagi'
      WHEN a.shift = 1 THEN 'siang'
      WHEN a.shift = 2 THEN 'malam'
    END AS shift, b.nama  FROM inspeksi a
    LEFT JOIN user b ON a.fire_incident_commander = b.id_user
    WHERE id_inspeksi = '$id_inspeksi'");

    if ($query->num_rows() == 0) {
      $query = 0;
    } else {
      $query = $query->row_array();
    };

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

  public function getIDCatCar()
  {
    $query = $this->db->query("SELECT id_category FROM category WHERE category = 'Rescue Car'");

    if ($query->num_rows() == 0) {
      $query = 0;
    } else {
      $query = $query->row_array();
    }

    return $query;
  }

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

  public function getKategoriEngine()
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
		WHERE b.subcategory = 'ENGINE'
		AND c.category = '$this->category'
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

  public function getKategoriTransmissionBreakingSystem()
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
      WHERE b.subcategory = 'TRANSMISSION & BRAKING SYSTEM'
      AND c.category = '$this->category'
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

  public function getKategoriElectricalSystem()
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
      WHERE b.subcategory = 'ELECTRICAL SYSTEM'
      AND c.category = '$this->category'
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

  public function getKategoriRescueEquipment()
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
      WHERE b.subcategory = 'RESCUE EQUIPMENTS'
      AND c.category = '$this->category'
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

  public function getKategoriHazmatEquipments()
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
      WHERE b.subcategory = 'HAZMAT EQUIPMENTS'
      AND c.category = '$this->category'
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

  public function getKategoriFiremanTools()
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
      WHERE b.subcategory = 'FIREMAN TOOLS'
      AND c.category = '$this->category'
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
    $query = $this->db->query("SELECT COUNT(a.item) as total, b.subcategory FROM item a 
	LEFT JOIN subcategory b on a.id_subcategory = b.id_subcategory 
	LEFT JOIN category c on b.id_category = c.id_category 
	WHERE c.category = '$this->category' GROUP BY b.subcategory ORDER BY b.id_subcategory asc");

    if ($query->num_rows() == 0) {
      $query = [];
    } else {
      $query = $query->result_array();
    }

    return $query;
  }

  public function getInspeksiDetailSubCat1($id_inspeksi)
  {
    $query = $this->db->query("SELECT a.id_inspeksi_detail, a.id_item, c.item, a.conditions FROM inspeksi_detail a
    LEFT JOIN inspeksi b ON a.id_inspeksi = b.id_inspeksi
    LEFT JOIN item c ON a.id_item = c.id_item
    LEFT JOIN subcategory d ON c.id_subcategory = d.id_subcategory
    WHERE a.id_inspeksi = '$id_inspeksi' AND d.subcategory = 'ENGINE'");

    if ($query->num_rows() == 0) {
      $query = 0;
    } else {
      $query = $query->result_array();
    };

    return $query;
  }

  public function getInspeksiDetailSubCat2($id_inspeksi)
  {
    $query = $this->db->query("SELECT a.id_inspeksi_detail, a.id_item, c.item, a.conditions FROM inspeksi_detail a
    LEFT JOIN inspeksi b ON a.id_inspeksi = b.id_inspeksi
    LEFT JOIN item c ON a.id_item = c.id_item
    LEFT JOIN subcategory d ON c.id_subcategory = d.id_subcategory
    WHERE a.id_inspeksi = '$id_inspeksi' AND d.subcategory = 'TRANSMISSION & BRAKING SYSTEM'");

    if ($query->num_rows() == 0) {
      $query = 0;
    } else {
      $query = $query->result_array();
    };

    return $query;
  }

  public function getInspeksiDetailSubCat3($id_inspeksi)
  {
    $query = $this->db->query("SELECT a.id_inspeksi_detail, a.id_item, c.item, a.conditions FROM inspeksi_detail a
    LEFT JOIN inspeksi b ON a.id_inspeksi = b.id_inspeksi
    LEFT JOIN item c ON a.id_item = c.id_item
    LEFT JOIN subcategory d ON c.id_subcategory = d.id_subcategory
    WHERE a.id_inspeksi = '$id_inspeksi' AND d.subcategory = 'ELECTRICAL SYSTEM'");

    if ($query->num_rows() == 0) {
      $query = 0;
    } else {
      $query = $query->result_array();
    };

    return $query;
  }

  public function getInspeksiDetailSubCat4($id_inspeksi)
  {
    $query = $this->db->query("SELECT a.id_inspeksi_detail, a.id_item, c.item, a.conditions FROM inspeksi_detail a
    LEFT JOIN inspeksi b ON a.id_inspeksi = b.id_inspeksi
    LEFT JOIN item c ON a.id_item = c.id_item
    LEFT JOIN subcategory d ON c.id_subcategory = d.id_subcategory
    WHERE a.id_inspeksi = '$id_inspeksi' AND d.subcategory = 'RESCUE EQUIPMENTS'");

    if ($query->num_rows() == 0) {
      $query = 0;
    } else {
      $query = $query->result_array();
    };

    return $query;
  }

  public function getInspeksiDetailSubCat5($id_inspeksi)
  {
    $query = $this->db->query("SELECT a.id_inspeksi_detail, a.id_item, c.item, a.conditions FROM inspeksi_detail a
    LEFT JOIN inspeksi b ON a.id_inspeksi = b.id_inspeksi
    LEFT JOIN item c ON a.id_item = c.id_item
    LEFT JOIN subcategory d ON c.id_subcategory = d.id_subcategory
    WHERE a.id_inspeksi = '$id_inspeksi' AND d.subcategory = 'HAZMAT EQUIPMENTS'");

    if ($query->num_rows() == 0) {
      $query = 0;
    } else {
      $query = $query->result_array();
    };

    return $query;
  }

  public function getInspeksiDetailSubCat6($id_inspeksi)
  {
    $query = $this->db->query("SELECT a.id_inspeksi_detail, a.id_item, c.item, a.conditions FROM inspeksi_detail a
    LEFT JOIN inspeksi b ON a.id_inspeksi = b.id_inspeksi
    LEFT JOIN item c ON a.id_item = c.id_item
    LEFT JOIN subcategory d ON c.id_subcategory = d.id_subcategory
    WHERE a.id_inspeksi = '$id_inspeksi' AND d.subcategory = 'FIREMAN TOOLS'");

    if ($query->num_rows() == 0) {
      $query = 0;
    } else {
      $query = $query->result_array();
    };

    return $query;
  }
  public function deleteInspeksiAssistant($idInspeksi)
  {
    $this->db->where('id_inspeksi', $idInspeksi);
    $this->db->delete('fic_assistant');

    $affectedrows = $this->db->affected_rows();

    if ($affectedrows > 0) {
      $querydelete = 1;
    } else {
      $querydelete = 0;
    };

    return $querydelete;
  }

  public function hapusInspeksi($id_inspeksi)
  {
    $this->db->trans_begin();

    $this->db->where('id_inspeksi', $id_inspeksi);
    $this->db->delete('inspeksi_detail');

    $this->db->where('id_inspeksi', $id_inspeksi);
    $this->db->delete('fic_assistant');

    $this->db->where('id_inspeksi', $id_inspeksi);
    $this->db->delete('inspeksi');

    if ($this->db->trans_status() == false) {
      $this->db->trans_rollback();
      return 0;
    } else {
      $this->db->trans_commit();
      return 1;
    }
  }
}
