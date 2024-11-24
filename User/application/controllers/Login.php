<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
  public function index()
  {
    $login = $this->input->post();

    $this->form_validation->set_rules('email', 'Email', 'required');
    $this->form_validation->set_rules('password', 'Password', 'required');
    
    $this->form_validation->set_message('required', '%s wajib diisi');
    
    if ($this->form_validation->run() == TRUE) {
      $this->load->model('Muser');
      $output = $this->Muser->login($login);

      if($output == "ada"){
        $this->session->set_flashdata('pesan_sukses', 'Berhasil Login');
        redirect('Home', 'refresh');
      } else {
        $this->session->set_flashdata('pesan_gagal', 'Gagal Login');
        redirect('/', 'refresh');
      }
    }
    
    $this->load->view('login');
  }
}
