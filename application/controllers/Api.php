<?php

class Api extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();

    if (!password_verify($_ENV["API_PASSWORD"], R_Input::pos("password"))) {
      set_status_header(403);
      exit('Access denied');
    }
  }

  public function dalam_persidangan()
  {
    $dalamPersidangan = DalamPersidangan::with('antrian_persidangan')->whereDate("tanggal_panggil", date("Y-m-d"))->get();
    echo json_encode($dalamPersidangan);
  }
}
