<?php
class Logout extends CI_Controller
{
  function __construct()
  {
    parent::__construct();

    if (!$this->session->userdata('id_pengguna')) {
      redirect('/', 'refresh');
    }
  }

  function index()
  {
    $this->session->unset_userdata('id_pengguna');
    $this->session->unset_userdata('email');
    $this->session->unset_userdata('nama');

    $this->session->set_flashdata('pesan_sukses', 'Anda telah logout');
    redirect('/', 'refresh');
  }
}
