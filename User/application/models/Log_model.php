<?php
class Log_model extends CI_Model
{
    public function get_logs_paginated($nik, $limit, $start)
    {
        return $this->db->select()
            ->from('log')
            ->where('nik', $nik)
            ->limit($limit, $start)
            ->get()
            ->result_array();
    }

    public function count_logs($nik)
    {
        return $this->db->where('nik', $nik)->count_all_results('log');
    }
}