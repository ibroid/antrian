<?php

class Pie_chart_ptsp extends R_ApiController
{
  use ApiResponse;
  public function index()
  {
    try {
      $results = $this->eloquent->table("antrian_pelayanan")
        ->selectRaw("SUM(CASE WHEN tujuan = 'POSBAKUM' THEN 1 ELSE 0 END) AS posbakum")
        ->selectRaw("SUM(CASE WHEN tujuan = 'INFORMASI' THEN 1 ELSE 0 END) AS informasi")
        ->selectRaw("SUM(CASE WHEN tujuan = 'PENDAFTARAN' THEN 1 ELSE 0 END) AS pendaftaran")
        ->selectRaw("SUM(CASE WHEN tujuan = 'E-COURT' THEN 1 ELSE 0 END) AS ecourt")
        ->selectRaw("SUM(CASE WHEN tujuan = 'PRODUK' THEN 1 ELSE 0 END) AS produk")
        ->selectRaw("SUM(CASE WHEN tujuan = 'KASIR' THEN 1 ELSE 0 END) AS kasir")
        ->whereDate("created_at", R_Input::pos('date'))
        ->first();

      $this->ok($results);
    } catch (\Throwable $th) {
      $this->fail($th->getMessage(), $th->getTrace());
    }
  }
}
