<?php

class Antrian extends R_MobileController
{
  public function page()
  {
    $this->pageRender("antrian_page");
  }

  public function ambil_ptsp()
  {
    try {
      $newAntrianPtsp = AntrianPtsp::create([
        "tujuan" => R_Input::pos("tujuan"),
        "kode" => R_Input::pos("kode"),
        "status" => 0,
        "nomor_urutan" => (function () {
          $lastNomorAntrianPtsp = AntrianPtsp::selectRaw("MAX(nomor_urutan) as max")->where("kode", R_Input::pos("kode"))->whereDate("created_at", date("Y-m-d"))->first();
          return $lastNomorAntrianPtsp->last + 1;
        })()
      ]);
      echo Cypher::urlsafe_encrypt($newAntrianPtsp->id);
    } catch (\Throwable $th) {
      echo "Terjadi kesalahan. " . $th->getMessage();
    }
  }
}
