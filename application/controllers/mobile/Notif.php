<?php

class Notif extends R_MobileController
{
  public function index()
  {
    $totalNotif = $this->eloquent
      ->table('mobile_notification')
      ->selectRaw("COUNT(*) as total")
      ->where('visitor_id', Cypher::urlsafe_decrypt(R_Input::gett('visitor')))
      ->whereDate('created_at', date('Y-m-d'))
      ->first();

    echo $totalNotif->total;
  }

  public function list()
  {
    $notifications = $this->eloquent
      ->table('mobile_notification')
      ->where('visitor_id', Cypher::urlsafe_decrypt(R_Input::gett('visitor')))
      ->whereDate('created_at', date('Y-m-d'))
      ->orderBy('created_at', 'desc')
      ->get();

    echo $this->load->view("mobile/components/notif_list", [
      "data" => $notifications
    ], true);
  }
}
