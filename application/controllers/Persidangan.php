<?php

class Persidangan extends R_Controller
{
  public function index()
  {
    $this->load->page("persidangan/beranda")->layout("dashboard_layout");
  }
}
