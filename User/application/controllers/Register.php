<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Register extends CI_Controller
{
  public function index()
  {
    $this->load->model('User_model');

    # Validasi form
    $this->form_validation->set_rules('nik', 'NIK', 'required|is_unique[pengguna.nik]');
    $this->form_validation->set_rules('nama', 'Nama', 'required');
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
    $this->form_validation->set_rules('password', 'Password', 'required');

    # Pesan error
    $this->form_validation->set_message('required', '%s wajib diisi');
    $this->form_validation->set_message('is_unique', '%s ini sudah terdaftar');
    $this->form_validation->set_message('valid_email', '%s harus berupa email yang valid');

    if ($this->form_validation->run() == TRUE) {
      $v = [
        'nik' => $this->input->post('nik'),
        'nama' => $this->input->post('nama'),
        'email' => $this->input->post('email'),
        'password' => $this->input->post('password'),
        'status' => 'Inactive',
        'alamat' => 'empty',
        'no_telp' => 'empty',
      ];

      if ($this->User_model->register($v)) {
        $this->session->set_flashdata('pesan_sukses', 'Berhasil mendaftar!');
      }
      redirect('Login', 'refresh');
    }

    $data['errors'] = validation_errors();
    $this->load->view('auth/register', $data);
    $this->load->view('addons/footer');
  }
}
