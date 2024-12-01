<?php
class Garbage_model extends CI_Model
{
  public function insert($value)
  {
    $this->db->insert('sampah', $value);

    return $this->db->affected_rows() > 0;
  }

  public function getDataByJenis($id_jenis)
  {
    $this->db->select('id_kategori, total');
    $this->db->where('id_jenis', $id_jenis);
    return $this->db->get('sampah')->result_array();
  }
}
