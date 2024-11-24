<?php
class Home extends CI_Controller
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
    $this->load->view('header');
    $this->load->view('dashboard');
    $this->load->view('footer');
  }
}
