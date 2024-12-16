<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    $login = $this->input->post();

    $this->form_validation->set_rules('email', 'Email', 'required');
    $this->form_validation->set_rules('password', 'Password', 'required');
    
    $this->form_validation->set_message('required', '%s wajib diisi');
    
    if ($this->form_validation->run() == TRUE) {
      $this->load->model('User_model');
      $output = $this->User_model->login($login);

      if($output == "ada"){
        $this->session->set_flashdata('pesan_sukses', 'Berhasil Login');
        redirect('Home', 'refresh');
      } else if($output == "invalid_password") {
        $this->session->set_flashdata('pesan_gagal', 'Password Yang Anda Masukkan Salah');
        redirect('/', 'refresh');
      }
      else {
        $this->session->set_flashdata('pesan_gagal', 'User Tidak Ditemukan');
        redirect('/', 'refresh');
      }
    }
    
    $this->load->view('auth/login');
    $this->load->view('addons/footer');
  }
}
