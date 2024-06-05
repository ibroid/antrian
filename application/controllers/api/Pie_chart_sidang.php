<?php

use Illuminate\Database\Eloquent\Relations\Concerns\AsPivot;

class Pie_chart_sidang extends R_ApiController
{
  use ApiResponse;

  public function index()
  {
    try {
      $sidangList = AntrianPersidangan::whereDate("created_at", R_Input::pos('date'))->get();

      $data["total_sidang"] = $sidangList->count();
      $data["total_umar"] = $sidangList->where("nomor_ruang", 1)->count();
      $data["total_musa"] = $sidangList->where("nomor_ruang", 2)->count();
      $data["total_syuraih"] = $sidangList->where("nomor_ruang", 3)->count();

      $this->ok($data);
    } catch (\Throwable $th) {
      //throw $th;
      $this->fail($th->getMessage(), $th->getTrace());
    }
  }
}
