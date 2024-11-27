<?php

class Antrian_pelayanan extends R_ApiController
{
  public function index()
  {
    try {
      $data = AntrianPtsp::whereDate("created_at", date("Y-m-d"))->get();
      header("Content-Type: application/json");
      echo json_encode($data);
    } catch (\Throwable $th) {
      set_status_header(400);
      echo json_encode([
        "message" => $th->getMessage()
      ]);
    }
  }
}
