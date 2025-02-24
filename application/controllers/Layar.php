<?php

use Illuminate\Support\Facades\Redis;

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
    $this->load->library("Sysconf", ["ed" => $this->eloquent]);
    $this->addons->init([
      "js" => [
        "<script src=\"https://js.pusher.com/8.2.0/pusher.min.js\"></script>\n",
        "<script type=\"text/javascript\" src=\"https://unpkg.com/toastify-js\"></script>\n",
        "<script src=\"https://unpkg.com/sweetalert2@11\"></script>",
        "<script src=\"https://js.pusher.com/8.2.0/pusher.min.js\"></script>"
      ],
      "css" => [
        "<link rel=\"stylesheet\" type=\"text/css\" href=\"https://unpkg.com/toastify-js@1.12.0/src/toastify.css\">\n"
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
    $daftar_ruang_sidang = Eloquent::connection('sipp')->table("ruangan_sidang")->where("aktif", "Y")->get();
    $this->load->page("persidangan/layar_antrian",  [
      "daftar_ruang_sidang" => $daftar_ruang_sidang
    ])->layout("auth_layout");
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

  public function audio_pengumuman($id = null)
  {
    if ($id == null) {
      show_404();
    }

    try {
      $check = $this->eloquent->table("audio")->where("is_playing", "yes")->first();
      if ($check) {
        throw new Exception("Audio Pengumuman Sedang Sibuk. Silahkan Coba Lagi", 1);
      }

      $this->eloquent->table("audio")->where('id', Cypher::urlsafe_decrypt($id))->update([
        "is_playing" => "yes"
      ]);

      $audio = $this->eloquent->table("audio")->where('id', Cypher::urlsafe_decrypt($id))->first();
      $audio->id = Cypher::urlsafe_encrypt($audio->id);

      Broadcast::pusher()->trigger("audio-pengumuman", "play", $audio);

      return Redirect::wfa([
        "message" => "Memulai pemutaran pengumuman"
      ])->go($_SERVER["HTTP_REFERER"]);
    } catch (\Throwable $th) {
      return Redirect::wfe($th->getMessage())->go($_SERVER["HTTP_REFERER"]);
    }
  }

  public function pengumuman_selesai()
  {
    R_Input::mustPost();
    try {
      $this->eloquent->table("audio")->where('id', Cypher::urlsafe_decrypt(R_Input::pos('id')))->update([
        "is_playing" => "no"
      ]);

      header("Content-Type: application/json");
      echo json_encode(["message" => "ok"]);
    } catch (\Throwable $th) {
      echo json_encode([
        "status" => false,
        "message" => $th->getMessage()
      ]);
      set_status_header(500);
    }
  }

  /**
   * Fetches the table of loket pelayanan and echoes the component for the table.
   *
   * @throws \Throwable If there is an error fetching the data or rendering the component.
   * @return void
   */
  public function fetch_table_loket_pelayanan()
  {
    R_Input::mustPost();
    try {
      $data = LoketPelayanan::where('status', '!=', 2)->orderBy('urutan')->get();
      echo $this->load->component("table/loket_layar_pelayanan", ["data" => $data]);
    } catch (\Throwable $th) {
      set_status_header(400);
      echo json_encode(["status" => false, "message" => $th->getMessage()]);
    }
  }
}
