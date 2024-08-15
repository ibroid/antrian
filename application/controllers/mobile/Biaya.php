<?php

use Illuminate\Support\Str;

class Biaya extends R_MobileController
{
  public function __construct()
  {
    parent::__construct();
    $this->load->library("InformasiApi");
  }

  public function page()
  {
    $infoApi = $this->informasiapi::make("jenis_perkara/records?expand=biaya_perkara_via_jenis_perkara");

    $this->pageRender("biaya_page", [
      "data" => $infoApi->response->parseJson()
    ]);
  }

  public function pilih_radius($id = null)
  {
    if (!$id) {
      echo "Jenis perkara Tidak Dipilih";
      return;
    }
    $infoPerkara = $this->informasiapi::make("jenis_perkara/records/$id");

    if ($infoPerkara->response->parseJson()->jumlah_p == 99) {
      $this->pageRender("set_jumlah_pihak_page", [
        "jenis_perkara_id" => $id
      ]);
      return;
    }

    $infoRadius = $this->informasiapi::make("radius/records");


    $this->pageRender("pilih_radius_page", [
      "radius" => $infoRadius->response->parseJson(),
      "perkara" => $infoPerkara->response->parseJson()
    ]);
  }

  public function hasil($id = null)
  {
    if (!$id) {
      echo "Jenis perkara Tidak Dipilih";
      return;
    }

    $infoPerkaraRequest = $this->informasiapi::make("jenis_perkara/records/$id");
    $infoPerkara = $infoPerkaraRequest->response->parseJson();


    $infoBiayaRequest = $this->informasiapi::make("biaya_perkara/records?expand=jenis_biaya&filter=(jenis_perkara='$id')");

    $biaya = $infoBiayaRequest->response->parseJson();

    if (isset($biaya->code) && $biaya->code == 400) {
      echo "Terjadi kesalahan saat memuat data. Silahkan kembali lagi nanti.";
      return;
    }

    $items = collect($biaya->items);

    $rincianUtama = $items->filter(function ($item) use ($infoPerkara) {
      if (isset($item->expand)) {
        return $item;
      }
    })->map(fn($item) => $item->expand->jenis_biaya);

    $rincianPanggilan = $items->filter(function ($item) use ($infoPerkara) {
      if (!isset($item->expand)) {
        return $item;
      }
    })->map(fn($item) => $item);

    $rincianPanggilanP = collect($_POST['radius_p'] ?? [])
      ->map(function ($biaya, $index) use ($infoPerkara, $rincianPanggilan) {

        $namaP = $infoPerkara->nama_p;

        return $rincianPanggilan
          ->filter(function ($item, $index) use ($namaP) {
            $checkContainP = Str::contains($item->kebutuhan, $namaP);
            if ($checkContainP) {
              return $item;
            }
          })
          ->map(function ($item, $index) use ($biaya) {
            return [
              "kebutuhan" => "Biaya $item->kebutuhan $biaya x $item->jumlah",
              "biaya" => $biaya * $item->jumlah
            ];
          });
      });

    $rincianPanggilanT = collect($_POST['radius_t'] ?? [])->map(function ($biaya, $index) use ($infoPerkara, $rincianPanggilan) {

      $namaT = $infoPerkara->nama_t;

      return $rincianPanggilan
        ->filter(function ($item, $index) use ($namaT) {
          $checkContainP = Str::contains($item->kebutuhan, $namaT);
          if ($checkContainP) {
            return $item;
          }
        })
        ->map(function ($item, $index) use ($biaya) {
          return [
            "kebutuhan" => "Biaya $item->kebutuhan $biaya x $item->jumlah",
            "biaya" => $biaya * $item->jumlah
          ];
        });
    });

    $this->pageRender("hasil_hitung_page", [
      "rincian_utama" => $rincianUtama,
      "perkara" => $infoPerkara,
      "rincian_panggilan_p" => $rincianPanggilanP,
      "rincian_panggilan_t" => $rincianPanggilanT,
    ]);
  }

  public function pilih_multiple_radius($id = null)
  {
    if (!$id) {
      echo "Jenis perkara Tidak Dipilih";
      return;
    }

    $infoPerkara = $this->informasiapi::make("jenis_perkara/records/$id");

    $infoRadius = $this->informasiapi::make("radius/records");

    $this->pageRender("pilih_multiple_radius_page", [
      "radius" => $infoRadius->response->parseJson(),
      "perkara" => $infoPerkara->response->parseJson(),
      "jumlah_p" => R_Input::pos('jumlah_p'),
      "jumlah_t" => R_Input::pos('jumlah_t'),
    ]);
  }
}
