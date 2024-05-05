<?php

class RuangSidang extends R_Controller
{
  public function __construct()
  {
    parent::__construct();
  }

  public function umar()
  {
    $this->dashboard_ruang_sidang(1);
  }

  public function abumusa()
  {
    $this->dashboard_ruang_sidang(2);
  }

  public function syuraih()
  {
    $this->dashboard_ruang_sidang(3);
  }

  private function dashboard_ruang_sidang($id)
  {
    $base_url = base_url();
    $this->addons->init([
      "js" => [
        "<script src=\"$base_url/assets/js/timeline/timeline-v-1/main.js\"></script>\n",
        "<script src=\"https://js.pusher.com/8.2.0/pusher.min.js\"></script>\n",
        "<script src=\"https://unpkg.com/browse/sweetalert2@11.10.8/dist/sweetalert2.all.min.js\"></script>\n"
      ]
    ]);

    $nama_ruang = [
      "Ruang Sidang Umar",
      "Ruang Sidang Abumusa",
      "Ruang Sidang Syuraih",
    ];

    if (!isset($nama_ruang[$id - 1])) {
      show_404();
      die;
    }

    $this->load->page("persidangan/ruang_sidang", [
      "pagename" => "Dashboard Ruang Sidang",
      "antrian" => AntrianPersidangan::where("nomor_ruang", $id)->whereDate("created_at", date("Y-m-d"))->get(),
      "dalam_panggilan" => DalamPersidangan::where("nomor_ruang", $id)->whereDate("created_at", date("Y-m-d"))->first(),
      "nama_ruang" => $nama_ruang[$id - 1],
      "nomor_ruang" => $id,
      "dalam_persidangan" => DalamPersidangan::where("nomor_ruang", $id)->whereDate("created_at", date("Y-m-d"))->first(),
    ])->layout("dashboard_layout", [
      "nav" => $this->load->component("layout/nav_persidangan"),
      "title" => "Dashboard Ruang Sidang"
    ]);
  }

  public function fetch_table_antrian()
  {
    $data["antrian"] = AntrianPersidangan::where("nomor_ruang", R_Input::pos("nomor_ruang"))->whereDate("created_at", date("Y-m-d"))->get();
    $data["nomor_ruang"] = R_Input::pos("nomor_ruang");
    echo $this->load->component("table/antrian_ruang_sidang", $data);
  }

  public function masukan_ke_ruang_sidang()
  {
    R_Input::mustPost();
    try {
      $dalamPanggilan = DalamPersidangan::firstOrNew([
        "nomor_ruang" => R_Input::pos("nomor_ruang"),
        "tanggal_panggil" => date("Y-m-d"),
      ]);

      $dalamPanggilan->nomor_antrian_id = R_Input::pos("antrian_sidang_id");

      $dalamPanggilan->save();

      $this->pusher->trigger("antrian-channel", "update-persidangan", null);

      $this->session->set_flashdata("flash_alert", $this->load->component(
        Constanta::ALERT_SUCCESS,
        ["message" => "Berhasil memasukkan ke dalam ruang sidang"]
      ));
    } catch (\Throwable $th) {
      $this->session->set_flashdata("flash_error", $this->load->component(
        Constanta::ALERT_ERROR,
        ["message" => $th->getMessage()]
      ));
    }

    redirect($_SERVER["HTTP_REFERER"]);
  }

  public function keluarkan_dari_ruang_sidang()
  {
    R_Input::mustPost();
    try {
      $dalamPanggilan = DalamPersidangan::where("nomor_antrian_id", R_Input::pos("nomor_antrian_id"))->first();

      if (isset($_GET["skors"])) {
        $dalamPanggilan->antrian_persidangan->update(["status" => 4]);

        $pengumuman = Pengumuman::where("judul", "perkara-diskors")->first();
        $pihakSatu = $dalamPanggilan->antrian_persidangan->kehadiran_pihak->where("sebagai", "P1")->first();

        $pihakDua = $dalamPanggilan->antrian_persidangan->kehadiran_pihak->where("sebagai", "P2")->first();
        $textPengumuman = str_replace("{pihak_satu}", $pihakSatu->pihak, $pengumuman->template);

        if ($pihakDua) {
          $textPengumuman = str_replace("{condition_pihak_dua}", $pihakDua->pihak, $textPengumuman);
        } else {
          $textPengumuman = str_replace("{condition_pihak_dua}", "", $textPengumuman);
        }

        $this->pusher->trigger("antrian-channel", "pengumuman", $textPengumuman);
      } else {
        $dalamPanggilan->antrian_persidangan->update(["status" => 3]);
      }

      $dalamPanggilan->delete();

      $this->session->set_flashdata("flash_alert", $this->load->component(
        Constanta::ALERT_SUCCESS,
        ["message" => "Perkara berhasil dikeluarkan dari ruang sidang"]
      ));
    } catch (\Throwable $th) {
      $this->session->set_flashdata("flash_error", $this->load->component(
        Constanta::ALERT_ERROR,
        ["message" => $th->getMessage()]
      ));
    }

    redirect($_SERVER["HTTP_REFERER"]);
  }

  public function panggil_pihak()
  {
    R_Input::mustPost();

    try {
      $dalamPanggilan = DalamPersidangan::where("nomor_ruang", R_Input::pos("nomor_ruang"))->whereDate("created_at", date("Y-m-d"))->first();
      $pihakSatu = $dalamPanggilan->antrian_persidangan->kehadiran_pihak->where("sebagai", "P1")->first();
      $pihakDua = $dalamPanggilan->antrian_persidangan->kehadiran_pihak->where("sebagai", "T1")->first();

      switch (R_Input::pos("pihak")) {
        case "semua_pihak":

          $textPanggil = "Para pihak dari $pihakSatu->pihak ";
          if ($pihakDua) {
            $textPanggil .= "dan para pihak dari $pihakDua->pihak,";
          }

          $textPanggil .= ", dipanggil masuk kedalam " . R_Input::pos("nama_ruang");
          break;
        case "saksi_saksi_p":
          $textPanggil = "Saksi saksi dari pihak $pihakSatu->pihak" . ", dipanggil masuk kedalam " . R_Input::pos("nama_ruang");;
          break;
        case "saksi_saksi_t":
          $textPanggil = "saksi saksi dari pihak $pihakDua->pihak  dipanggil masuk kedalam " . R_Input::pos("nama_ruang");
          break;
        default:
          throw new Exception("Pihak tidak ditemukan");
          break;
      }

      $this->pusher->trigger("antrian-channel", "panggil-pihak", $textPanggil);
      echo json_encode(["status" => true, "message" => "Berhasil memanggil pihak"]);
    } catch (\Throwable $th) {
      set_status_header(400);
      echo $th->getMessage();
    }
  }
}
