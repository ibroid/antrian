<?php

class Visitor extends R_MobileController
{
  public function index()
  {
    if (R_Input::isPost()) {
      $visitor = $this->eloquent->table("visitor")->where('remote_ip', $_SERVER['HTTP_CF_CONNECTING_IP'] ?? $_SERVER['REMOTE_ADDR'])->whereDate("visit_date", date("Y-m-d"))->first();
      if (!$visitor) {
        $visitor = $this->eloquent->table("visitor")->insert([
          "visit_date" => date("Y-m-d"),
          "remote_ip" => $_SERVER['HTTP_CF_CONNECTING_IP'] ?? $_SERVER['REMOTE_ADDR'],
          "user_agent" => $_SERVER['HTTP_USER_AGENT'],
          "country_id"  => $_SERVER['HTTP_CF_IPCOUNTRY'] ?? "UKWN",
          "device" => R_Input::pos("device")
        ]);
      }
    }

    $todayCount = $this->eloquent->table("visitor")->selectRaw("COUNT(*) as total")->whereDate("visit_date", date("Y-m-d"))->first();

    echo "Visitor hari ini : $todayCount->total";
  }
}
