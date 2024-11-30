<?php
class Muser extends CI_Model
{
  function show()
  {
    $q = $this->db->get('pengguna');
    return $q->result_array();
  }

  function login($login)
  {
    $email = $login['email'];
    $password = $login['password'];

    $this->db->where('email', $email);
    $this->db->where('password', $password);
    
    $q = $this->db->get('pengguna');
    $cek = $q->row_array();
    
    if (!empty($cek)) { 
      $this->session->set_userdata('id_pengguna', $cek['nik']);
      $this->session->set_userdata('email', $cek['email']);
      $this->session->set_userdata('nama', $cek['nama']);
      $this->session->set_userdata('status_pengguna', $cek['status']);
      $this->session->set_userdata('alamat_pengguna', $cek['alamat']);
      $this->session->set_userdata('telp_pengguna', $cek['no_telp']);

      return "ada";
    } else {
      return "kosong";
    }
  }

  function register($v)
  {
    $this->db->insert('pengguna', $v);
  }
}
