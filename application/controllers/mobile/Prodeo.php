<?php

class Prodeo extends R_MobileController
{
  public function index()
  {
    $data = $this->getPenggunaanKuotaProdeo();

    $this->load->library('InformasiApi');

    $infoApi = $this->informasiapi::make("kuota_prodeo/records?filter=(tahun='" . date("Y") . "')");

    $this->fullRender("prodeo_page", [
      'kuota' => $data,
      'info' => $infoApi->response->parseJson(),
      'color' => [
        'Darat' => 'bg-primary',
        'Pulau' => 'bg-info',
      ]
    ]);
  }

  public function page()
  {
    $data = $this->getPenggunaanKuotaProdeo();

    $this->load->library('InformasiApi');

    $infoApi = $this->informasiapi::make("kuota_prodeo/records?filter=(tahun='" . date("Y") . "')");

    $this->pageRender("prodeo_page", [
      'kuota' => $data,
      'info' => $infoApi->response->parseJson(),
      'color' => [
        'Darat' => 'bg-warning',
        'Pulau' => 'bg-success',
      ]
    ]);
  }

  private function getPenggunaanKuotaProdeo()
  {
    $kuotaPulau = $this->eloquent->connection('sipp')
      ->table('pihak')
      ->selectRaw("COUNT(DISTINCT perkara.perkara_id) as total")
      ->leftJoin("perkara_pihak1", "perkara_pihak1.pihak_id", '=', 'pihak.id')
      ->leftJoin('perkara', 'perkara.perkara_id', '=', 'perkara_pihak1.perkara_id')
      ->where('pihak.kabupaten', 31.01)
      ->where('perkara.prodeo', 1)
      ->whereYear("perkara.tanggal_pendaftaran", date('Y'))
      ->first();

    $kuotaDarat = $this->eloquent->connection('sipp')
      ->table('pihak')
      ->selectRaw("COUNT(DISTINCT perkara.perkara_id) as total")
      ->leftJoin("perkara_pihak1", "perkara_pihak1.pihak_id", '=', 'pihak.id')
      ->leftJoin('perkara', 'perkara.perkara_id', '=', 'perkara_pihak1.perkara_id')
      ->where('pihak.kabupaten', 31.72)
      ->where('perkara.prodeo', 1)
      ->whereYear("perkara.tanggal_pendaftaran", date('Y'))
      ->first();

    return [
      'Pulau' => $kuotaPulau,
      'Darat' => $kuotaDarat,
    ];
  }
}
