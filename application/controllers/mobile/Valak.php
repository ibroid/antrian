<?php

class Valak extends R_MobileController
{
  public function index()
  {
    $this->fullRender("valak_page");
  }

  public function page()
  {
    $this->pageRender("valak_page");
  }

  public function search()
  {
    try {
      $akta = PerkaraAktaCerai::where("nomor_akta_cerai", R_Input::pos("nomor_akta"))->first();
      if (!$akta) {
        throw new Exception("Nomor akta cerai tidak ditemukan");
      }

      echo $this->pageRender("components/akta_cerai_found", ["akta" => $akta]);
    } catch (\Throwable $th) {
      echo "Terjadi Kesalahan : " . $th->getMessage();
    }
  }
}
