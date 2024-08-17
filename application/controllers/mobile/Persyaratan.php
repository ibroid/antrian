<?php

class Persyaratan extends R_MobileController
{
  public function __construct()
  {
    parent::__construct();
    $this->load->library("InformasiApi");
  }

  public function index()
  {
    $infoApi = $this->informasiapi::make("jenis_perkara/records?filter=(icon!='')");
    $this->fullRender("persyaratan_page", [
      "data" => $infoApi->response->parseJson()
    ]);
  }

  public function page()
  {
    $infoApi = $this->informasiapi::make("jenis_perkara/records?filter=(icon!='')");
    $this->pageRender("persyaratan_page", [
      "data" => $infoApi->response->parseJson()
    ]);
  }

  public function get_icon($collId, $id, $filename)
  {
    return $this->informasiapi->fileUrl($collId, $id, $filename);
  }

  public function get($id)
  {
    $persyaratan = $this->informasiapi::make("persyaratan/records?filter=(jenis_perkara='$id')");
    $this->pageRender("detail_persyaratan_page", [
      "data" =>  $persyaratan->response->parseJson()
    ]);
  }
}
