<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main extends CI_Controller
{
  public function index()
  {
    $this->load->view('login');
  }

  function register()
  {
    $this->load->view('register');
  }
}
