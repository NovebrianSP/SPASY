<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Target extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    if (!$this->session->userdata('id_pengguna')) {
      redirect('auth/login');
    }
    $this->load->model('Target_model');
  }

  public function index()
  {
    $data['targets'] = $this->Target_model->get_targets();

    $this->load->view('header');
    $this->load->view('target', $data);
    $this->load->view('footer');
  }

  public function tambah()
  {
    $this->load->model('Kategori_model');

    $data['kategori'] = $this->Kategori_model->get();

    if ($this->input->post()) {
      $value = [
        'nik' => $this->session->userdata('id_pengguna'),
        'id_kategori' => $this->input->post('id_kategori'),
        'target_total' => $this->input->post('target_total'),
        'tanggal_target' => $this->input->post('tanggal_target')
      ];
      $this->Target_model->add_target($value);
      redirect('target');
    }
    $this->load->view('header');
    $this->load->view('target_add', $data);
    $this->load->view('footer');
  }

  public function hapus($id)
  {
    $this->load->model('Target_model');
    $this->Target_model->delete_target($id);
    redirect('target');
  }

  public function detail($id_target)
  {
    $nik = $this->session->userdata('id_pengguna');
    $data['target'] = $this->Target_model->get_targets();
    $data['target_total'] = $this->Target_model->get_target_total($nik);
    $data['total_terkumpul'] = $this->Target_model->get_total_terkumpul($nik, $id_target);
    $data['logs'] = $this->Target_model->get_logs($nik, $id_target);

    $this->load->view('header');
    $this->load->view('target_detail', $data);
    $this->load->view('footer');
  }
}
