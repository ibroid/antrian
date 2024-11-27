<?php

class Dalam_persidangan extends R_ApiController
{
  public function index()
  {
    try {
      $dalamPersidangan = DalamPersidangan::with('antrian_persidangan')->with('kehadiran_pihak')->whereDate("tanggal_panggil", date("Y-m-d"))->get();
      echo json_encode($dalamPersidangan);
    } catch (\Throwable $th) {
      set_status_header(400);
      echo json_encode([
        "message" => $th->getMessage()
      ]);
    }
  }
}
