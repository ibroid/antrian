<?php

class Statistic_pemanggilan_sidang extends R_ApiController
{
  use ApiResponse;
  public function index()
  {
    try {
      $hours = collect(range(6, 15));

      $hoursSqlList = $hours->map(function ($i, $k) {
        return "SELECT $i AS hour";
      })->implode(" UNION ALL ");

      $hoursSubQuery = $this->eloquent::raw("($hoursSqlList) as hours");

      $rawResults = $this->eloquent::table($hoursSubQuery)
        ->crossJoin($this->eloquent::raw('(SELECT DISTINCT nomor_ruang FROM antrian_persidangan WHERE nomor_ruang IN (1, 2, 3)) as rooms'))
        ->leftJoin('antrian_persidangan', function ($join) {
          $join->on($this->eloquent::raw('HOUR(antrian_persidangan.waktu_panggil)'), '=', 'hours.hour')
            ->on('antrian_persidangan.nomor_ruang', '=', 'rooms.nomor_ruang')
            ->whereDate('antrian_persidangan.created_at',  R_Input::pos('date'));
        })
        ->select('hours.hour', 'rooms.nomor_ruang', $this->eloquent::raw('COUNT(antrian_persidangan.id) as count'))
        ->groupBy('hours.hour', 'rooms.nomor_ruang')
        ->orderBy('hours.hour')
        ->orderBy('rooms.nomor_ruang')
        ->get();

      $results = [];

      foreach ($hours as $hour) {
        $hourData = [
          'hour' => $hour,
          'result_1' => 0,
          'result_2' => 0,
          'result_3' => 0
        ];

        foreach ($rawResults as $row) {
          if ($row->hour == $hour) {
            $hourData['result_' . $row->nomor_ruang] = $row->count;
          }
        }

        $results[] = $hourData;
      }


      $this->ok($results);
    } catch (\Throwable $th) {
      $this->fail($th->getMessage(), $th->getTrace());
    }
  }
}
