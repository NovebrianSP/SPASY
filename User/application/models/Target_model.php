<?php
class Target_model extends CI_Model
{

    public function get_targets()
    {
        $this->db->select('t.id_target, t.target_total, t.tanggal_target, k.nama_kategori, 
                       COALESCE(SUM(s.total), 0) AS total_terkumpul, 
                       (COALESCE(SUM(s.total), 0) / t.target_total) * 100 AS persentase');
        $this->db->from('target_sampah t');
        $this->db->join('kategori k', 'k.id_kategori = t.id_kategori');
        $this->db->join('sampah s', 't.id_kategori = s.id_kategori AND t.nik = s.nik AND t.id_target = s.id_target', 'left');
        $this->db->where('t.nik', $this->session->userdata('id_pengguna'));
        $this->db->group_by('t.id_target, t.target_total, t.tanggal_target, k.nama_kategori'); // Menambahkan semua kolom yang ada di SELECT untuk GROUP BY
        return $this->db->get()->result();
    }

    public function add_target($data)
    {
        $this->db->insert('target_sampah', $data);
    }

    public function delete_target($id)
    {
        $this->db->delete('target_sampah', array('id_target' => $id));
    }

    public function get_target_total($nik)
    {
        $this->db->select_sum('target_total');
        $this->db->where('nik', $nik);
        $result = $this->db->get('target_sampah')->row();
        return $result->target_total ?? 0;
    }

    public function get_total_terkumpul($nik, $id_target = null)
    {
        $this->db->select_sum('total');
        $this->db->where('nik', $nik)
            ->where('id_target', $id_target);

        $result = $this->db->get('sampah')->row();

        return $result->total ?? 0;
    }


    public function get_logs($nik, $id_target = null)
    {
        $this->db->where('nik', $nik)
            ->where('id_target', $id_target);

        $this->db->order_by('timestamps', 'DESC');
        return $this->db->get('log')->result();
    }


    public function get_target_by_id($id)
    {
        $this->db->where('id_target', $id);
        return $this->db->get('target_sampah')->row();
    }
}
