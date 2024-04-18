<?php

class Pelayanan extends R_Controller
{
  public function index()
  {
    $this->load->page("pelayanan/antrian_pelayanan")->layout("dashboard_layout", [
      "title" => "Antrian Pelayanan",
      "nav" => $this->load->component("layout/nav_pelayanan")
    ]);
  }
}
