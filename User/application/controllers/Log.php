<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Log extends CI_Controller
{
    public function index()
    {
        $this->load->model('Log_model');

        // Konfigurasi pagination
        $limit = 10; // Jumlah data per halaman
        $page = $this->input->get('page'); // Tangkap parameter halaman dari URL
        $page = isset($page) && is_numeric($page) ? (int)$page : 1; // Default halaman 1
        $start = ($page - 1) * $limit;

        // Ambil data log dengan pagination
        $nik = $this->session->userdata('id_pengguna');
        $data['logs'] = $this->Log_model->get_logs_paginated($nik, $limit, $start);

        // Hitung total data untuk pagination
        $data['total_pages'] = ceil($this->Log_model->count_logs($nik) / $limit);
        $data['current_page'] = $page;
        $data['limit'] = $limit; // Kirim limit ke view untuk perhitungan

        // Load views
        $this->load->view('addons/header');
        $this->load->view('log/index', $data);
        $this->load->view('addons/footer');
    }
}