<?php

defined("BASEPATH") or exit("🍆");

class Beranda extends R_MobileController
{
  public function index()
  {
    $this->eloquent->table("visitor")->insert([
      "visit_date" => date("Y-m-d"),
      "remote_ip" => $_SERVER['HTTP_CF_CONNECTING_IP'] ?? $_SERVER['REMOTE_ADDR'],
      "user_agent" => $_SERVER['HTTP_USER_AGENT'] ?? "UNKNOWN",
      "country_id" => $_SERVER['HTTP_CF_IPCOUNTRY'] ?? "UKNW",
    ]);
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
    $this->eloquent->table("visitor")->insert([
      "visit_date" => date("Y-m-d"),
    ]);
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
