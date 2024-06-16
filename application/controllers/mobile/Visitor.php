<?php

class Visitor extends R_MobileController
{
  public function index()
  {
    $todayCount = $this->eloquent->table("visitor")->selectRaw("COUNT(*) as total")->whereDate("visit_date", date("Y-m-d"))->first();

    echo "Visitor hari ini : $todayCount->total";
  }
}
