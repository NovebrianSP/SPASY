<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Garbage extends CI_Controller
{
  public function index()
  {
    $this->form_validation->set_rules('jenis_sampah', 'Jenis Sampah', 'required');
    $this->form_validation->set_rules('jumlah_berat', 'Berat Sampah', 'required');

    $this->form_validation->set_message('required', '%s wajib diisi');

    $this->load->model('Kategori_model');
    $data['kategori'] = $this->Kategori_model->get();


    if ($this->form_validation->run() == TRUE) {
      $v = [
        'nik' => $this->session->userdata('id_pengguna'),
        'id_kategori' => $this->input->post('jenis_sampah'),
        'tanggal_masuk' => $this->input->post('datetime'),
        'total' => $this->input->post('jumlah_berat')
      ];

      $this->load->model('Garbage_model');
      if ($this->Garbage_model->insert($v)) {
        $this->session->set_flashdata('pesan_sukses', 'Data Sampah Berhasil Tersimpan');
        redirect('Home', 'refresh');
      } else {
        $this->session->set_flashdata('pesan_gagal', 'Data Sampah Gagal Tersimpan');
      }
    }

    $this->load->view('header');
    $this->load->view('garbage_view', $data);
    $this->load->view('footer');
  }
}
