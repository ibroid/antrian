<?php

class Persidangan extends R_Controller
{
  public function index()
  {
    $this->antrian_sidang();
  }

  public function antrian_sidang()
  {
    $this->load->page("persidangan/antrian_sidang", [
      "pagename" => "Monitor Petugas Sidang",
      "antrian" => AntrianPersidangan::whereDate("created_at", date("Y-m-d"))->latest()->get()
    ])->layout("dashboard_layout");
  }
}
