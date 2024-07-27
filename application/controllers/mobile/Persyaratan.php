<?php

class Persyaratan extends R_MobileController
{
  public function page()
  {
    $this->load->library("InformasiApi");
    $infoApi = $this->informasiapi::make("jenis_perkara/records?expand=persyaratan_via_jenis_perkara_id");

    $this->pageRender("persyaratan_page", [
      "data" => $infoApi->response->parseJson()
    ]);
  }
}
