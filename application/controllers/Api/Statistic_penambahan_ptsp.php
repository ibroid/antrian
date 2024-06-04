<?php

class Statistic_penambahan_ptsp extends R_ApiController
{

  use ApiResponse;
  public function index()
  {
    $hoursCollection = collect(range(6, 15));

    $hoursSql = $hoursCollection->map(function ($hour) {
      return "SELECT $hour AS hour";
    })->implode(' UNION ALL ');

    $hoursSubQuery = $this->eloquent::raw("($hoursSql) as hours");

    $results = $this->eloquent::table($hoursSubQuery)
      ->leftJoin('antrian_pelayanan', function ($join) {
        $join->on($this->eloquent::raw('HOUR(antrian_pelayanan.created_at)'), '=', 'hours.hour')
          ->whereDate('antrian_pelayanan.created_at', '=', R_Input::pos('date'));
      })
      ->select('hours.hour', $this->eloquent::raw('COALESCE(COUNT(antrian_pelayanan.created_at), 0) as count'))
      ->groupBy('hours.hour')
      ->orderBy('hours.hour')
      ->get();

    $this->ok($results);
  }
}
