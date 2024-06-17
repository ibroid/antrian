<?php

defined("BASEPATH") or exit("🍆");

class Beranda extends R_MobileController
{
  public function index()
  {
    $this->fullRender("beranda_page");
  }

  public function page()
  {
    $this->pageRender("beranda_page",  null, true);
  }

  public function carousel_component()
  {
    $this->pageRender("components/carousel", null, true);
  }

  public function slide_loket_pelayanan()
  {
    $this->pageRender("components/slide_loket_pelayanan", [
      "loket_pelayanan" => LoketPelayanan::with("antrian")->where("status", "!=", 2)->get()
    ], true);
  }

  public function detail_list_antrian_ptsp()
  {
    try {
      echo $this->load->view("components/detail_list_antrian_ptsp", [
        "antrian" => AntrianPtsp::whereDate("created_at", date("Y-m-d"))->get()
      ], true);
    } catch (\Throwable $th) {
      echo "Terjadi Kesalahan. " . $th->getMessage() . " Silahkan coba lagi nanti";
    }
  }
}
