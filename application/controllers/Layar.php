<?php

defined("BASEPATH") or exit("No direct script access allowed");

class Layar extends R_Controller
{
  /**
   * Mendefinisikan fungsi construct.
   * Menginisialisasi plugin css dan js
   * @return void
   */
  public function __construct()
  {
    parent::__construct();
    $this->addons->init([
      "js" => [
        "<script src=\"https://js.pusher.com/8.2.0/pusher.min.js\"></script>\n",
        "<script type=\"text/javascript\" src=\"https://cdn.jsdelivr.net/npm/toastify-js\"></script>\n",
        "<script src=\"https://cdn.jsdelivr.net/npm/sweetalert2@11\"></script>",
        "<script src=\"https://js.pusher.com/8.2.0/pusher.min.js\"></script>"
      ],
      "css" => [
        "<link rel=\"stylesheet\" type=\"text/css\" href=\"https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css\">\n"
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
    $this->load->page("pelayanan/layar_antrian")->layout("auth_layout");
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
}
