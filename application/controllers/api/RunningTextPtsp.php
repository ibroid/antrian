<?php

class RunningTextPtsp extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
  }

  public function index($id = null)
  {
    if (!$id) {
      show_404();
    }

    $loket = LoketPelayanan::findOrFail($id);
    if (!$loket->antrian) {
      $antrian = "0000";
    } else {
      $antrian = $loket->antrian->kode . "-" . $loket->antrian->nomor_urutan;
    }
    $this->output
      ->set_content_type("application/json")
      ->set_output(json_encode([
        "status" => true,
        "data" => [
          // "loket" => $loket->nama_loket,
          "antrian" => $antrian
        ]
      ]));
  }
}
