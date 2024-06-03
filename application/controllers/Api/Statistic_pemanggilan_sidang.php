<?php

class Statistic_pemanggilan_sidang extends R_ApiController
{
  use ApiResponse;
  public function index()
  {
    try {
      $dataSidang = AntrianPersidangan::whereDate("created_at", R_Input::pos('date'))->get();

      $workHour = [
        "06:00",
        "07:00",
        "08:00",
        "09:00",
        "10:00",
        "11:00",
        "12:00",
        "13:00",
        "14:00",
        "15:00",
      ];

      $data = [
        [],
        [],
        [],
      ];

      for ($i = 0; $i < count($data); $i++) {
        foreach ($workHour as $n => $hour) {
          $totalByHour = $dataSidang->where("nomor_ruang", $i + 1)->filter(
            function ($i, $k) use ($hour) {
              return $i->updated_at->hour == $hour;
            }
          )->count();

          $data[$i][$n] = $totalByHour;
        }
      }

      $this->ok($data);
    } catch (\Throwable $th) {
      $this->fail($th->getMessage(), $th->getTrace());
    }
  }
}
