<?php

class Visitor extends R_MobileController
{
  public function index()
  {
    if (R_Input::isPost()) {
      $visitor = $this->eloquent
        ->table("visitor")
        ->whereDate("visit_date", date("Y-m-d"))
        ->find(Cypher::urlsafe_decrypt(R_Input::pos("visitor_id") ?? 'XZS'));

      if (!$visitor) {
        $id = $this->eloquent->table("visitor")->insertGetId([
          "visit_date" => date("Y-m-d"),
          "remote_ip" => $_SERVER['HTTP_CF_CONNECTING_IP'] ?? $_SERVER['REMOTE_ADDR'],
          "user_agent" => $_SERVER['HTTP_USER_AGENT'],
          "country_id"  => $_SERVER['HTTP_CF_IPCOUNTRY'] ?? "UKWN",
          "device" => R_Input::pos("device")
        ]);
      }

      if (isset($_POST['need_notification'])) {
        $checkNotiv = $this->eloquent::table("mobile_notification")->where("visitor_id", $id ?? $visitor->id)->whereDate('created_at', date('Y-m-d'))->first();

        if (!$checkNotiv) {
          $this->eloquent::table("mobile_notification")->insert([
            "visitor_id" => $id ?? $visitor->id,
            "title" => "System Notification",
            "body" => "Kami tidak bisa mengirim pemberitahuan panggilan antrian kepada anda. Klik untuk mendapatkan pemberitahuan dan layanan yang lebih banyak.",
            "action" => "call_function",
            "action_param" => "data-bs-dismiss=\"modal\" onclick=\" notification('no-antrian-notif')\"",
          ]);
        }
      }

      echo Cypher::urlsafe_encrypt($id ?? $visitor->id);
      exit;
    }

    $todayCount = $this->eloquent->table("visitor")->selectRaw("COUNT(*) as total")->whereDate("visit_date", date("Y-m-d"))->first();

    echo "Pengunjung hari ini : $todayCount->total";
  }
}
