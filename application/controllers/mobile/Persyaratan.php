<?php

class Persyaratan extends R_MobileController
{
  public function __construct()
  {
    parent::__construct();
    $this->load->library("InformasiApi");
    $this->infoApi = $this->informasiapi::make("jenis_perkara/records?expand=persyaratan_via_jenis_perkara");
  }

  public function index()
  {
    $this->fullRender("persyaratan_page", [
      "data" => $this->infoApi->response->parseJson()
    ]);
  }

  public function page()
  {
    $this->pageRender("persyaratan_page", [
      "data" => $this->infoApi->response->parseJson()
    ]);
  }
}
