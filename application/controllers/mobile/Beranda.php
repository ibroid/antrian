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
      if (R_Input::gett("kode") == "C") {
        $kode = ["C"];
      } else {
        $kode = ["A", "B", "D", "E", "F"];
      }

      $this->pageRender("components/detail_list_antrian_ptsp", [
        "antrian" => AntrianPtsp::whereIn('kode', $kode)->whereDate("created_at", "2025-05-21")->latest()->get()
      ]);
    } catch (\Throwable $th) {
      echo "Terjadi Kesalahan. " . $th->getMessage() . " Silahkan coba lagi nanti";
    }
  }

  public function slide_antrian_sidang()
  {
    echo $this->load->view("mobile/components/slide_antrian_sidang", [
      "data" =>  DalamPersidangan::with("antrian_persidangan.kehadiran_pihak")->whereDate('tanggal_panggil', date("Y-m-d"))->get()
    ], true);
  }

  public function detail_antrian_sidang()
  {
    $this->componentRender("detail_antrian_sidang", [
      "data" => AntrianPersidangan::with('perkara')->whereDate("created_at", date("Y-m-d"))->where("nomor_ruang", R_Input::gett("nomor_ruang"))->latest()->get()
    ]);
  }
}
