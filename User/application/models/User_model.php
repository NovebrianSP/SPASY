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
    $nik = $v['nik'];
    $nama = $v['nama'];

    $data = array(
      'nik' => $nik,
      'email' => $v['email'],
      'password' => $hashed_password,
      'nama' => $nama,
      'alamat' => $v['alamat'],
      'no_telp' => $v['no_telp']
    );

    $data_log = array(
      'nik' => $nik,
      'aktivitas' => "Pengguna atas nama ".$nama." melakukan registrasi sebagai pengguna baru",
      'timestamps' => date('Y-m-d H:i:s')
    );

    $this->db->insert('pengguna', $data);
    return $this->db->insert('log', $data_log);
  }

  public function update_subscription($nik, $data)
  {
    $this->db->where('nik', $nik);
    return $this->db->update('pengguna', $data);
  }
}
