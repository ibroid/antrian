<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kartu extends R_Controller
{
  public function __construct()
  {
    parent::__construct();
  }


  public function index()
  {
    $this->load->page("admin/kartu/beranda")->layout("dashboard_layout", [
      "title" => "Daftar Kartu ",
      "nav" => $this->load->component("layout/nav_admin")
    ]);
  }
}
