<?php

class Antrian_sidang extends R_ApiController
{
  public function index()
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
}
