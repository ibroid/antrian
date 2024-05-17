<?php

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class Debug extends R_Controller
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
    $original = "Gembel";
    $encrypted = Cypher::encrypt($original);

    prindie(
      $encrypted,
      Cypher::urlsafe_decrypt(Cypher::safe($encrypted))
    );
  }
}
