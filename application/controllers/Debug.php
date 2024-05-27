<?php


class Debug extends R_ApiController
{
  public Eloquent $eloquent;

  public function __construct()
  {
    parent::__construct();
    if ($_ENV["DEBUG"] == FALSE) {
      set_status_header(404);
      die;
    }
  }

  public function index()
  {
    prindie($this->generateApiKey(32));
  }
}
