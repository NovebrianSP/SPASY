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

  public function getTotalGarbage()
  {
    $this->db->select('kategori.id_kategori, kategori.nama_kategori, COALESCE(SUM(sampah.total), 0) as total')
    ->from('kategori')
    ->join('sampah', 'kategori.id_kategori = sampah.id_kategori', 'left')
    ->group_by('kategori.id_kategori');
    
    return $this->db->get()->result_array();
  }

  public function insert_log($value)
  {
    $this->db->insert('log', $value);
  }
}
