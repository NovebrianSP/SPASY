<?php
class Kategori_model extends CI_Model
{
  public function get()
  {
    return $this->db->get('kategori')->result_array();
  }
}
