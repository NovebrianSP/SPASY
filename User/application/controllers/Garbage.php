<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Garbage extends CI_Controller
{
  function __construct()
  {
    parent::__construct();

    if (!$this->session->userdata('id_pengguna')) {
      redirect('/', 'refresh');
    }
  }

  public function index($id_target = null)
  {
    $this->form_validation->set_rules('jenis_sampah', 'Jenis Sampah', 'required');
    $this->form_validation->set_rules('jumlah_berat', 'Berat Sampah', 'required');

    $this->form_validation->set_message('required', '%s wajib diisi');

    $this->load->model('Kategori_model');

    $data['kategori'] = $this->Kategori_model->get();
    $data['id_target'] = $id_target;

    $id_kategori = $this->input->post('jenis_sampah');
    $jumlah_berat = $this->input->post('jumlah_berat');

    if ($this->form_validation->run() == TRUE) {
      $v = [
        'nik' => $this->session->userdata('id_pengguna'),
        'id_kategori' => $id_kategori,
        'tanggal_masuk' => $this->input->post('datetime'),
        'total' => $jumlah_berat,
        'id_target' => $this->input->post('id_target') ?? null
      ];

      $kategori = $this->db->get_where('kategori', ['id_kategori' => $id_kategori])->row();

      $data_log = [
        'nik' => $this->session->userdata('id_pengguna'),
        'aktivitas' => 'Menambahkan ' . $jumlah_berat . ' kg sampah ke kategori ' . $kategori->nama_kategori,
        'timestamps' => date('Y-m-d H:i:s'),
        'id_target' => $v['id_target'] ?? null
      ];

      $this->load->model('Garbage_model');
      if ($this->Garbage_model->insert($v)) {
        $this->Garbage_model->insert_log($data_log);
        $this->session->set_flashdata('pesan_sukses', 'Data Sampah Berhasil Tersimpan');
        redirect('Home', 'refresh');
      } else {
        $this->session->set_flashdata('pesan_gagal', 'Data Sampah Gagal Tersimpan');
      }
    }

    $this->load->view('addons/header');
    $this->load->view('sampah/garbage_view', $data);
    $this->load->view('addons/footer');
  }

  public function add_sampah_from_target($id_target)
  {
    $this->load->model('Target_model');
    $this->load->model('Kategori_model');
    $data['target'] = $this->Target_model->get_target_by_id($id_target);
    $data['kategori'] = $this->Kategori_model->get();

    if (empty($data['target'])) {
      show_404();
    }

    $this->load->model('Kategori_model');
    $data['kategori'] = $this->Kategori_model->get();

    $data['id_target'] = $id_target;

    $this->load->view('addons/header');
    $this->load->view('sampah/garbage_add', $data);
    $this->load->view('addons/footer');
  }

  public function store_sampah()
  {
    $id_target = $this->input->post('id_target');
    $id_kategori = $this->input->post('id_kategori');
    $jumlah_berat = $this->input->post('jumlah_berat');
    $tanggal_masuk = $this->input->post('datetime');

    $data = [
      'nik' => $this->session->userdata('id_pengguna'),
      'id_kategori' => $id_kategori,
      'total' => $jumlah_berat,
      'tanggal_masuk' => $tanggal_masuk,
      'id_target' => $this->input->post('id_target') ?? null
    ];

    if ($this->db->insert('sampah', $data)) {


      $kategori = $this->db->get_where('kategori', ['id_kategori' => $id_kategori])->row();

      $data_log = [
        'nik' => $this->session->userdata('id_pengguna'),
        'aktivitas' => 'Menambahkan ' . $jumlah_berat . ' kg sampah ke kategori ' . $kategori->nama_kategori,
        'timestamps' => date('Y-m-d H:i:s'),
        'id_target' => $id_target
      ];

      $this->db->insert('log', $data_log);

      $this->session->set_flashdata('success', 'Data sampah berhasil disimpan dan log diperbarui.');
    } else {
      $this->session->set_flashdata('error', 'Gagal menyimpan data sampah.');
    }

    redirect('Target/detail/' . $data['id_target']);
  }
}
