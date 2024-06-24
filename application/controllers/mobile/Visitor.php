<?php

class Visitor extends R_MobileController
{
  public function index()
  {
    if (R_Input::isPost()) {
      echo $this->visitor_register();
      exit;
    }

    $todayCount = $this->eloquent->table("visitor")->selectRaw("COUNT(*) as total")->whereDate("visit_date", date("Y-m-d"))->first();

    echo "Pengunjung hari ini : $todayCount->total";
  }
}
