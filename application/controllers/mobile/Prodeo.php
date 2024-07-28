<?php

class Prodeo extends R_MobileController
{
  public function page()
  {
    $penggunaProdeo = $this->eloquent->connection('sipp')->table("perkara")
      ->selectRaw('COUNT(*) as total')->where('prodeo', 1)->whereYear('tanggal_pendaftaran', date("Y"))->first();

    $this->load->library('InformasiApi');

    $infoApi = $this->informasiapi::make("kuota_prodeo/records?filter=(tahun='2024')");

    $this->pageRender("prodeo_page", [
      'total_pengguna_prodeo' => $penggunaProdeo->total,
      'total_kuota_prodeo' => $infoApi->response->parseJson()->items[0]->jumlah,
    ]);
  }
}
