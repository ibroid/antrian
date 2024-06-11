<?php

defined("BASEPATH") or exit("🍆");

class Beranda extends R_MobileController
{
  public function index()
  {
    $this->load->page("mobile/beranda_page")->layout("mobile_layout");
  }
}
