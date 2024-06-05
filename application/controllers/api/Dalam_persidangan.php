<?php

class Dalam_persidangan extends R_ApiController
{
  public function index()
  {
    $dalamPersidangan = DalamPersidangan::with('antrian_persidangan')->whereDate("tanggal_panggil", date("Y-m-d"))->get();
    echo json_encode($dalamPersidangan);
  }
}
