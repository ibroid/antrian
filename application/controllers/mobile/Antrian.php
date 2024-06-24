<?php

class Antrian extends R_MobileController
{
  public function page()
  {
    $this->pageRender("antrian_page", [
      "allowed_ambil_ptsp" => (function () {
        if (date('H') < $this->settings->jam_ambil_antrian_ptsp) {
          return false;
        }

        $antrian = AntrianPtsp::find($this->visitor->antrian_ptsp_id);

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

        $antrian = AntrianPersidangan::find($this->visitor->antrian_sidang_id);

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

      $antrian = AntrianPtsp::find($this->visitor->antrian_ptsp_id);
      if ($antrian->status == 0) {
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
      : Visitors::find(Cypher::urlsafe_decrypt($par['visitor']))->antrian_ptsp_id;

    $antrian = AntrianPtsp::find($antrian_id);
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
      : Visitors::find(Cypher::urlsafe_decrypt($par['visitor']))->antrian_sidang_id;

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

  public function ambil_sidang()
  {
    echo "Maaf untuk saat ini pengambilan antrian persidangan hanya bisa dilakukan secara manual.";
  }
}
