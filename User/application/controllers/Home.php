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
    $this->load->model('Garbage_model');

    // Query data Organik
    $data['organik'] = $this->db->select('kategori.nama_kategori, SUM(sampah.total) as total')
      ->from('sampah')
      ->join('kategori', 'sampah.id_kategori = kategori.id_kategori')
      ->where('kategori.id_jenis', 1) // 1 = Organik
      ->where('sampah.nik', $this->session->userdata('id_pengguna'))
      ->group_by('kategori.nama_kategori')
      ->get()
      ->result_array();

    // Query data Anorganik
    $data['anorganik'] = $this->db->select('kategori.nama_kategori, SUM(sampah.total) as total')
      ->from('sampah')
      ->join('kategori', 'sampah.id_kategori = kategori.id_kategori')
      ->where('kategori.id_jenis', 2) // 2 = Anorganik
      ->where('sampah.nik', $this->session->userdata('id_pengguna'))
      ->group_by('kategori.nama_kategori')
      ->get()
      ->result_array();

    $this->load->view('header');
    $this->load->view('dashboard', $data);
    $this->load->view('footer');
  }
}
