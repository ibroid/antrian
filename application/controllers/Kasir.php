<?php

class Kasir extends R_Controller
{
  public function index()
  {
    $this->load->page("kasir/putus_hari_ini")->layout("dashboard_layout", [
      "nav" => $this->load->component("layout/nav_persidangan"),
      "title" => "Monitor Petugas Sidang",
    ]);
  }
}
