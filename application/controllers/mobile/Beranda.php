<?php

defined("BASEPATH") or exit("🍆");

class Beranda extends R_MobileController
{
  public function index()
  {
    $this->load->page("mobile/beranda_page")->layout("mobile_layout");
  }

  public function page()
  {
    echo $this->load->view("mobile/beranda_page",  null, true);
  }

  public function carousel_component()
  {
    echo $this->load->view("mobile/components/carousel", null, true);
  }

  public function slide_loket_pelayanan()
  {
    echo $this->load->view("mobile/components/slide_loket_pelayanan", [
      "loket_pelayanan" => LoketPelayanan::with("antrian")->where("status", "!=", 2)->get()
    ], true);
  }

  public function detail_list_antrian_ptsp()
  {
    try {
      echo $this->load->view("mobile/components/detail_list_antrian_ptsp", [
        "antrian" => AntrianPtsp::whereDate("created_at", date("Y-m-d"))->get()
      ], true);
    } catch (\Throwable $th) {
      echo "Terjadi Kesalahan. " . $th->getMessage() . " Silahkan coba lagi nanti";
    }
  }
}
