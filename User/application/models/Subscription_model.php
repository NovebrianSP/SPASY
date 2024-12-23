<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subscription_model extends CI_Model {

    // Simpan transaksi ke database
    public function insert_transaction($data) {
        $this->db->insert('transaksi', $data);
        return $this->db->insert_id(); // Mengembalikan ID transaksi
    }

    // Update transaksi berdasarkan id_transaksi
    public function update_transaction($id_transaksi, $data) {
        $this->db->where('id_transaksi', $id_transaksi);

        $data_log = array(
            'nik' => $this->session->userdata('id_pengguna'),
            'aktivitas' => "Pengguna atas nama " . $this->session->userdata('nama') . " melakukan pembayaran transaksi dengan id transaksi " . $id_transaksi,
            'timestamps' => date('Y-m-d H:i:s')
        );

        $this->db->update('transaksi', $data);
        return $this->db->insert('log', $data_log);
    }

    public function update_user($nik, $data) {
        $this->db->where('nik', $nik);
        $this->db->update('pengguna', $data);
    }
}