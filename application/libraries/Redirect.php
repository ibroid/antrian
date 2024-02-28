<?php

class Redirect
{
  public $url;

  public $ci;

  public function __construct()
  {
    $this->ci = &get_instance();
  }


  public static function wfa($data = [])
  {
    $red = new static;
    $red->ci->session->set_flashdata('flash_alert', $red->ci->load->component(Constanta::ALERT_INFO, $data));
    return $red;
  }

  public static function wfe($message)
  {
    $red = new static;
    $red->ci->session->set_flashdata('flash_error', $red->ci->load->component(Constanta::ALERT_ERROR, [
      'message' => "Terjadi Kesalahan. $message"
    ]));

    return $red;
  }

  public function go($url = '/')
  {
    redirect($url);
  }
}
