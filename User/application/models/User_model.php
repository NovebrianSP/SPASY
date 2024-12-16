<?php
class User_model extends CI_Model
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

    $q = $this->db->get('pengguna');
    $cek = $q->row_array();

    if (!empty($cek)) {
      if ($this->passwordhash->verify_password($password, $cek['password'])) {
        $this->session->set_userdata('id_pengguna', $cek['nik']);
        $this->session->set_userdata('email', $cek['email']);
        $this->session->set_userdata('nama', $cek['nama']);
        $this->session->set_userdata('status_pengguna', $cek['status']);
        $this->session->set_userdata('alamat_pengguna', $cek['alamat']);
        $this->session->set_userdata('telp_pengguna', $cek['no_telp']);
        return "ada";
      } else {
        return "invalid_password";
      }
    } else {
      return "kosong";
    }
  }

  function register($v)
  {
    $hashed_password = $this->passwordhash->create_hash($v['password']);
    $data = array(
      'nik' => $v['nik'],
      'email' => $v['email'],
      'password' => $hashed_password,
      'nama' => $v['nama'],
      'alamat' => $v['alamat'],
      'no_telp' => $v['no_telp']
    );

    return $this->db->insert('pengguna', $data);
  }

  public function update_subscription($nik, $data)
  {
    $this->db->where('nik', $nik);
    return $this->db->update('pengguna', $data);
  }
}
