<?php


class Detail_antrian_sidang extends R_ApiController
{
  public function index()
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
