<?php

class Antrian extends R_MobileController
{
  public function index()
  {
    $this->fullRender("antrian_page", [
      "allowed_ambil_ptsp" => (function () {
        if (date('H') < $this->settings->jam_ambil_antrian_ptsp) {
          return false;
        }

        $antrian = AntrianPtsp::where('id', $this->visitor->antrian_ptsp_id)->whereDate('created_at', date('Y-m-d'))->first();

        if (!$antrian) {
          return true;
        }

        if ($antrian->status == 1) {
          return true;
        } else {
          return false;
        }

        return true;
      })(),
      "allowed_ambil_sidang" => (function () {
        if (date('H') < $this->settings->jam_ambil_antrian_sidang) {
          return false;
        }

        $antrian = AntrianPersidangan::where('id', $this->visitor->antrian_sidang_id)->whereDate('created_at', date('Y-m-d'))->first();

        if (!$antrian) {
          return true;
        }

        if ($antrian->status == 1) {
          return true;
        } else {
          return false;
        }

        return true;
      })()
    ]);
  }

  public function page()
  {
    $this->pageRender("antrian_page", [
      "allowed_ambil_ptsp" => (function () {
        if (date('H') < $this->settings->jam_ambil_antrian_ptsp) {
          return false;
        }

        $antrian = AntrianPtsp::where('id', $this->visitor->antrian_ptsp_id)->whereDate('created_at', date('Y-m-d'))->first();

        if (!$antrian) {
          return true;
        }

        if ($antrian->status == 1) {
          return true;
        } else {
          return false;
        }

        return true;
      })(),
      "allowed_ambil_sidang" => (function () {
        if (date('H') < $this->settings->jam_ambil_antrian_sidang) {
          return false;
        }

        $antrian = AntrianPersidangan::where('id', $this->visitor->antrian_sidang_id)->whereDate('created_at', date('Y-m-d'))->first();

        if (!$antrian) {
          return true;
        }

        if ($antrian->status == 1) {
          return true;
        } else {
          return false;
        }

        return true;
      })()
    ]);
  }

  public function ambil_ptsp()
  {
    $this->eloquent->connection("default")->beginTransaction();

    try {
      $antrian = AntrianPtsp::where('id', $this->visitor->antrian_ptsp_id)->whereDate('created_at', date('Y-m-d'))->first();
      if ($antrian && $antrian->status == 0) {
        throw new Exception("Anda sudah mengambil antrian. Silahkan tunggu dipanggil untuk mengambil antrian selanjutnya.", 1);
      }

      $newAntrianPtsp = AntrianPtsp::create([
        "tujuan" => R_Input::pos("tujuan"),
        "kode" => R_Input::pos("kode"),
        "status" => 0,
        "nomor_urutan" => (function () {
          $lastNomorAntrianPtsp = AntrianPtsp::selectRaw("MAX(nomor_urutan) as max")->where("kode", R_Input::pos("kode"))->whereDate("created_at", date("Y-m-d"))->first();
          return $lastNomorAntrianPtsp->max + 1;
        })()
      ]);

      $this->eloquent
        ->table("visitor")
        ->where('id', $this->visitor->id)
        ->update(['antrian_ptsp_id' => $newAntrianPtsp->id]);

      $this->eloquent->connection("default")->commit();

      echo "Sukses Mengambil antrian. Nomor antrian anda : " . $newAntrianPtsp->nomor_antrian . ". Silahkan kembali ke beranda untuk memantau antrian anda";
    } catch (\Throwable $th) {
      $this->eloquent->connection("default")->rollBack();
      // set_status_header(500);
      echo "Terjadi kesalahan. " . $th->getMessage();
    }
  }

  public function my_antrian_ptsp()
  {
    $referer = parse_url(R_Input::ci()->request_headers()["Hx-Current-Url"] ?? null);
    $par = [];

    if ($referer['path'] != null) {
      parse_str($referer['query'] ?? "", $par);
    }

    $antrian_id = isset($par['antrian_ptsp'])
      ? Cypher::urlsafe_decrypt($par['antrian_ptsp'])
      : Visitors::find(Cypher::urlsafe_decrypt($par['visitor'] ?? 0))->antrian_ptsp_id ?? 0;

    $antrian = AntrianPtsp::where('id', $antrian_id)->whereDate('created_at', date("Y-m-d"))->first();

    if (!$antrian) {
      echo null;
    } else {
      $this->componentRender("my_antrian_ptsp", ["data" => $antrian]);
    }
  }

  public function my_antrian_sidang()
  {
    $referer = parse_url(R_Input::ci()->request_headers()["Hx-Current-Url"] ?? null);
    $par = [];

    if ($referer['path'] != null) {
      parse_str($referer['query'] ?? "", $par);
    }

    $antrian_id = isset($par['antrian_sidang'])
      ? Cypher::urlsafe_decrypt($par['antrian_sidang'])
      : Visitors::find(Cypher::urlsafe_decrypt($par['visitor'] ?? 0))->antrian_sidang_id ?? 0;

    $antrian = AntrianPersidangan::find($antrian_id);
    if (!$antrian) {
      echo null;
    } else {
      $this->componentRender("my_antrian_sidang", ["data" => $antrian]);
    }
  }

  public function ambil_produk()
  {
    echo "Maaf untuk saat ini pengambilan antrian produk hanya bisa dilakukan secara manual.";
  }

  public function set_nomor_perkara()
  {
    try {
      if (!isset($_POST['post_url'])) {
        throw new Exception("Post URL tidak ada");
      }

      $this->componentRender("input_nomor_perkara", ["post_url" => '/mobile/antrian/ambil_sidang']);
    } catch (\Throwable $th) {
      echo "Terjadi kesalahan. " . $th->getMessage();
    }
  }

  public function ambil_sidang()
  {
    try {
      $perkara = Perkara::where("nomor_perkara", htmlspecialchars(R_Input::pos("nomor_perkara")))->first();

      if (!$perkara) {
        throw new Exception("Nomor perkara yang anda masukan tidak ditemukan. Pastikan format sesuai contoh");
      }

      $this->eloquent->connection("default")->beginTransaction();

      $lastSidang = $perkara->jadwal_sidang->last();

      if ($lastSidang->tanggal_sidang !== date("Y-m-d")) {
        throw new Exception("Tidak ada jadwal sidang untuk perkara ini");
      }

      $antrianSidang = AntrianPersidangan::firstOrCreate([
        "nomor_perkara" => $perkara->nomor_perkara,
        "tanggal_sidang" => date("Y-m-d"),
      ],  [
        'status' => 0,
        'nomor_urutan' =>  floatval($this->nomor_urut_sidang_terakhir(
          $lastSidang->ruangan_id
        ))  + 1,
        'nomor_ruang' => $lastSidang->ruangan_id,
        'nama_ruang' => $lastSidang->ruangan,
        'nomor_perkara' => $perkara->nomor_perkara,
        'tanggal_sidang' => $lastSidang->tanggal_sidang,
        'majelis_hakim' => $perkara->penetapan->majelis_hakim_nama,
        'jadwal_sidang_id' => $lastSidang->id,
      ]);

      $this->eloquent->table("visitor")->where('id', $this->visitor->id)->update([
        'antrian_sidang_id' => $antrianSidang->id
      ]);

      $this->eloquent->table("mobile_notification")->insert([
        "visitor_id" => $this->visitor->id,
        "title" => "Antrian Sidang Notification",
        "body" => "Berhasil. Nomor Antrian Anda : $antrianSidang->nomor_urutan. Anda memiliki waktu 15 menit dari sejak pertama kali anda dipanggil. Jadi pastikan selalu memeriksa antrian. Antrian ini hanya berlaku pada tanggal " . tanggal_indo($antrianSidang->tanggal_sidang),
        "action" => "none",
        "action_param" => null,
      ]);

      $this->eloquent->connection("default")->commit();

      echo "<h3 class='text-white'>Berhasil. Nomor Antrian Anda : $antrianSidang->nomor_urutan Anda memiliki waktu 15 menit dari sejak pertama kali anda dipanggil. Jadi pastikan selalu memeriksa antrian</h3>";
    } catch (\Throwable $th) {

      $this->eloquent->connection("default")->rollback();

      $this->componentRender(
        "error_input_nomor_perkara",
        [
          "repost_url" => '/mobile/antrian/set_nomor_perkara',
          "error_message" => 'Terjadi Kesalahan. ' . $th->getMessage(),
          "past_value" => R_Input::pos()->toArray()
        ]
      );
    }
  }

  public function nomor_urut_sidang_terakhir($ruang)
  {
    $qrcMaxAntrian = AntrianPersidangan::whereDate("created_at", date("Y-m-d"))->where("nomor_ruang", $ruang)->max('nomor_urutan');

    return $qrcMaxAntrian;
  }
}
