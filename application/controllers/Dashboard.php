<?php

class Dashboard extends R_Controller
{
  public function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    redirect('/admin');
  }
}
