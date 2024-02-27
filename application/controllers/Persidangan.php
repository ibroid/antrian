<?php

class Persidangan extends R_Controller
{
  public function index()
  {
    $this->antrian_sidang();
    $this->load->library("addons");
  }

  public function antrian_sidang()
  {
    $this->addons->init([
      "js" => [
        "<script src=\"https://cdn.jsdelivr.net/npm/sweetalert2@11\"></script>\n",
        "<script src=\"https://js.pusher.com/8.2.0/pusher.min.js\"></script>\n",
        "<script type=\"text/javascript\" src=\"https://cdn.jsdelivr.net/npm/toastify-js\"></script>\n"
      ],
      "css" => [
        "<link rel=\"stylesheet\" type=\"text/css\" href=\"https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css\">\n"
      ]
    ]);

    $this->load->page("persidangan/antrian_sidang", [
      "pagename" => "Monitor Petugas Sidang",
      "antrian" => AntrianPersidangan::whereDate("created_at", date("Y-m-d"))->latest()->get(),
      "jadwal_sidang" => PerkaraJadwalSidang::where("tanggal_sidang", date("Y-m-d"))->get(),
      "dalam_sidang" => DalamPersidangan::whereDate("tanggal_panggil", date("Y-m-d"))->get()
    ])->layout("dashboard_layout", [
      "nav" => $this->load->component("layout/nav_persidangan"),
      "title" => "Monitor Petugas Sidang",
    ]);
  }

  public function fetch_modal_antrian()
  {
    R_Input::mustPost();

    $data = AntrianPersidangan::find(R_Input::pos("id"));

    echo $this->load->component("modal/modal_antrian_sidang", compact("data"));
  }

  public function update_antrian($id)
  {
    R_Input::mustPost();
    try {
      $data = AntrianPersidangan::find($id);
      $data->update(R_Input::pos());
      echo json_encode(["status" => true, "message" => "Berhasil mengubah data"]);
    } catch (\Throwable $th) {
      set_status_header(400);
      echo json_encode(["status" => false, "message" => $th->getMessage()]);
    }
  }

  public function update_kehadiran_pihak($id)
  {
    R_Input::mustPost();
    try {
      $data = KehadiranPihak::find($id);
      $data->update(R_Input::pos());
      echo json_encode(["status" => true, "message" => "Berhasil mengubah data"]);
    } catch (\Throwable $th) {
      set_status_header(400);
      echo json_encode(["status" => false, "message" => $th->getMessage()]);
    }
  }

  public function pengumuman()
  {
    R_Input::mustPost();
    try {
      $pengumuman = Pengumuman::where("judul", R_Input::pos("judul"))->first();
      if (!$pengumuman) {
        throw new \Exception("Pengumuman tidak ditemukan");
      }

      $textPengumuman = str_replace("{ruang_sidang}", R_Input::pos("nama_ruang"), $pengumuman->template);

      $this->pusher->trigger("antrian-channel", "pengumuman", $textPengumuman);

      echo json_encode(["status" => true, "message" => "Pengumumanm berhasil dikirim. Silahkan tunggu sampai pengumuman selesai dibacakan"]);
    } catch (\Throwable $th) {
      set_status_header(400);
      echo $th->getMessage();
    }
  }

  public function panggil()
  {
    R_Input::mustPost();
    try {
      $pengumuman = Pengumuman::where("judul", R_Input::pos("judul"))->first();
      if (!$pengumuman) {
        set_status_header(404);
        throw new \Exception("Pengumuman tidak ditemukan");
      }

      $textPengumuman = str_replace("{pihak_satu}", R_Input::pos("pihak_satu"), $pengumuman->template);

      if (R_Input::pos("pihak_dua")) {
        $textPengumuman = str_replace("{condition_pihak_dua}", "dan " . R_Input::pos("pihak_dua"), $textPengumuman);
      } else {
        $textPengumuman = str_replace("{condition_pihak_dua}", "", $textPengumuman);
      }

      $textPengumuman = str_replace("{ruang_sidang}", R_Input::pos("nama_ruang"), $textPengumuman);
      $textPengumuman = str_replace("{nama_pihak}", R_Input::pos("nama_pihak"), $textPengumuman);
      $this->pusher->trigger("antrian-channel", "panggil-pihak", $textPengumuman);

      echo json_encode(["status" => true, "message" => "Panggilan berhasil dikirim. Silahkan tunggu sampai panggilan selesai dibacakan"]);
    } catch (\Throwable $th) {
      echo $th->getMessage();
    }
  }
}
