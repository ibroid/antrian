<?php

defined("BASEPATH") or exit("No direct script access allowed");

class Layar extends CI_Controller
{
  /**
   * Mendefinisikan fungsi construct.
   * Menginisialisasi plugin css dan js
   * @return void
   */
  public function __construct()
  {
    parent::__construct();
    $this->load->library("addons");
    $this->addons->init([
      "js" => [
        "<script src=\"https://js.pusher.com/8.2.0/pusher.min.js\"></script>\n",
        "<script type=\"text/javascript\" src=\"https://unpkg.com/toastify-js\"></script>\n",
        "<script src=\"https://unpkg.com/sweetalert2@11\"></script>",
        "<script src=\"https://js.pusher.com/8.2.0/pusher.min.js\"></script>"
      ],
      "css" => [
        "<link rel=\"stylesheet\" type=\"text/css\" href=\"https://unpkg.com/toastify-js/src/toastify.min.css\">\n"
      ]
    ]);
  }

  /**
   * Fungsi untuk menampilkan layar antrian sidang yang berjalan.
   * Url : /layar/sidang. Method : GET
   * @return page
   */
  public function sidang()
  {
    $this->load->page("persidangan/layar_antrian")->layout("auth_layout");
  }

  /**
   * Fungsi untuk menampilkan layar antrian pelayanan sidang yang berjalan.
   * Url : /layar/ptsp. Method : GET
   * @return page
   */
  public function ptsp()
  {
    $this->load->page("pelayanan/layar_antrian", [
      "antrian_hari_ini" => AntrianPtsp::whereDate("created_at", date("Y-m-d"))->get(),
    ])->layout("auth_layout");
  }

  /**
   * Fungsi untuk mengambil data channel tv list.
   * Url : /layar/fetch_data_channel_tv_list. Method : GET
   * @return json
   */
  public function fetch_data_channel_tv_list()
  {
    try {
      $data = Eloquent::table("daftar_channel_tv")->get();
      if (R_Input::ci()->request_headers()["Accept"] == "application/json") {
        echo json_encode(["status" => true, "data" => $data]);
        return set_status_header(200);
      }

      // Redirect::to($_SERVER["HTTP_REFERER"]);
    } catch (\Throwable $th) {
      if (R_Input::ci()->request_headers()["Accept"] == "application/json") {
        echo json_encode(["status" => false, "message" => $th->getMessage()]);
        return set_status_header(400);
      }

      // Redirect::wfe($th->getMessage())->go($_SERVER["HTTP_REFERER"]);
    }
  }

  /**
   * Fungsi untuk mengambil data running text.
   * Url : /layar/fetch_data_running_text. Method : GET
   * @return json
   */
  public function fetch_data_running_text()
  {
    try {
      $data = Eloquent::table("running_text_content")->get();
      if (R_Input::ci()->request_headers()["Accept"] == "application/json") {
        echo json_encode(["status" => true, "data" => $data]);
        return set_status_header(200);
      }
    } catch (\Throwable $th) {
      if (R_Input::ci()->request_headers()["Accept"] == "application/json") {
        echo json_encode(["status" => false, "message" => $th->getMessage()]);
        return set_status_header(400);
      }
    }
  }

  /**
   * Fungsi untuk mengambil data banner.
   * Url : /layar/fetch_data_banner. Method : GET
   * @return json
   */
  public function fetch_data_banner()
  {
    try {
      $data = Eloquent::table("banner_pengumuman")->get();
      if (R_Input::ci()->request_headers()["Accept"] == "application/json") {
        echo json_encode(["status" => true, "data" => $data]);
        return set_status_header(200);
      }
    } catch (\Throwable $th) {
      if (R_Input::ci()->request_headers()["Accept"] == "application/json") {
        echo json_encode(["status" => false, "message" => $th->getMessage()]);
        return set_status_header(400);
      }
    }
  }

  public function jumlah_antrian_ptsp()
  {
    try {
      $sudah_dipanggil = $this->eloquent::table('antrian_pelayanan')
        ->select($this->eloquent::raw('count(*) as sudah_dipanggil'))
        ->where('status', 1)
        ->whereDate('created_at', date('Y-m-d'))
        ->count();

      $belum_dipanggil = $this->eloquent::table('antrian_pelayanan')
        ->select($this->eloquent::raw('count(*) as belum_dipanggil'))
        ->whereDate('created_at', date('Y-m-d'))
        ->where('status', 0)
        ->count();


      echo json_encode(["sudah_dipanggil" => $sudah_dipanggil, "belum_dipanggil" => $belum_dipanggil]);
    } catch (\Throwable $th) {
      echo json_encode([
        "status" => false,
        "message" => $th->getMessage()
      ]);
      set_status_header(500);
    }
  }
}
