<?php


class Loket_pelayanan extends R_ApiController
{
  public function index()
  {
    try {
      $data = LoketPelayanan::where('status', 1)->get();
      header("Content-Type: application/json");
      echo json_encode($data);
    } catch (\Throwable $th) {
      set_status_header(400);
      echo json_encode(["message" => $th->getMessage()]);
    }
  }
}
