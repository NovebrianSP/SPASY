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
        $this->db->update('transaksi', $data);
    }

    public function update_user($nik, $data) {
        $this->db->where('nik', $nik);
        $this->db->update('pengguna', $data);
    }
}