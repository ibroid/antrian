<?php

class Statistic_penambahan_sidang extends R_ApiController
{

  use ApiResponse;

  public function index()
  {
    try {
      $hours = range(6, 15);

      $hoursCollection = collect($hours);

      $hoursSql = $hoursCollection->map(function ($hour) {
        return "SELECT $hour AS hour";
      })->implode(' UNION ALL ');

      $hoursSubQuery = $this->eloquent::raw("($hoursSql) as hours");

      $results = $this->eloquent::table($hoursSubQuery)
        ->leftJoin('antrian_persidangan', function ($join) {
          $join->on($this->eloquent::raw('HOUR(antrian_persidangan.created_at)'), '=', 'hours.hour')
            ->whereDate('antrian_persidangan.created_at', '=', R_Input::pos('date'));
        })
        ->select('hours.hour', $this->eloquent::raw('COALESCE(COUNT(antrian_persidangan.created_at), 0) as count'))
        ->groupBy('hours.hour')
        ->orderBy('hours.hour')
        ->get();


      $this->ok($results);
    } catch (\Throwable $th) {

      $this->fail($th->getMessage(), $th->getTrace());
    }
  }
}
