<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Midtrans {
    public function __construct()
    {
        $CI =& get_instance();
        $CI->config->load('midtrans');

        require_once $CI->config->item('midtrans_sdk_path');

        \Midtrans\Config::$serverKey = $CI->config->item('midtrans_server_key');
        \Midtrans\Config::$isProduction = $CI->config->item('midtrans_is_production');
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;
    }
}