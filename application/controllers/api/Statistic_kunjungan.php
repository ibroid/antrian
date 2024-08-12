<?php

class Statistic_kunjungan extends R_ApiController
{
  use ApiResponse;

  public function tahun()
  {
    if (R_Input::pos('tahun') == 2022) {
      try {
        $pihakBaru = $this->eloquent->connection('old')->table('kunjungan')
          ->selectRaw('MONTH(`tanggal_kunjungan`) AS month, count(*) as total')
          ->where('tujuan_id', 1)->orWhere('tujuan_id', 3)
          ->whereYear('tanggal_kunjungan', R_Input::pos('tahun'))
          ->groupByRaw('MONTH(`tanggal_kunjungan`)')->get();

        $pihakLama = $this->eloquent->connection('old')->table('kunjungan')
          ->selectRaw('MONTH(`tanggal_kunjungan`) AS month, count(*) as total')
          ->where('tujuan_id', '!=', 1)->where('tujuan_id', '!=', 3)
          ->whereYear('tanggal_kunjungan', R_Input::pos('tahun'))
          ->groupByRaw('MONTH(`tanggal_kunjungan`)')->get();

        $this->ok(compact('pihakBaru', 'pihakLama'));
      } catch (\Throwable $th) {
        throw $th;
      }

      return;
    }

    try {
      $pihakBaru = $this->eloquent->table('kunjungan')
        ->selectRaw('MONTH(`tanggal_kunjungan`) AS month, count(*) as total')
        ->where('status_pengunjung', 'Pihak Baru')
        ->whereYear('tanggal_kunjungan', R_Input::pos('tahun'))
        ->groupByRaw('MONTH(`tanggal_kunjungan`)')->get();

      $pihakLama = $this->eloquent->table('kunjungan')
        ->selectRaw('MONTH(`tanggal_kunjungan`) AS month, count(*) as total')
        ->where('status_pengunjung', '!=', 'Pihak Baru')
        ->whereYear('tanggal_kunjungan', R_Input::pos('tahun'))
        ->groupByRaw('MONTH(`tanggal_kunjungan`)')->get();

      $this->ok(compact('pihakBaru', 'pihakLama'));
    } catch (\Throwable $th) {
      throw $th;
    }
  }
}
