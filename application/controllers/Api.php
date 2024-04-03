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
    header("Access-Control-Allow-Origin: *");
    header('Access-Control-Allow-Credentials: true');
  }

  public function dalam_persidangan()
  {
    $dalamPersidangan = DalamPersidangan::with('antrian_persidangan')->whereDate("tanggal_panggil", date("Y-m-d"))->get();
    echo json_encode($dalamPersidangan);
  }

  public function antrian_sidang()
  {
    if (isset($_GET["ruang"])) {
      echo json_encode(["total" => AntrianPersidangan::where(
        [
          "tanggal_sidang" => date("Y-m-d"),
          "nomor_ruang" => $_GET["ruang"]
        ]
      )->count()]);
    } else {
      echo json_encode(["total" => AntrianPersidangan::where(
        [
          "tanggal_sidang" => date("Y-m-d"),
        ]
      )->count()]);
    }
  }

  public function detail_antrian_sidang()
  {
    if (isset($_GET["ruang"])) {
      echo json_encode(AntrianPersidangan::where(
        [
          "tanggal_sidang" => date("Y-m-d"),
          "nomor_ruang" => $_GET["ruang"]
        ]
      )->get());
    } else {
      echo json_encode(AntrianPersidangan::where(
        [
          "tanggal_sidang" => date("Y-m-d"),
        ]
      )->get());
    }
  }
}
