<?php

class R_ApiController extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    header('Access-Control-Allow-Origin: pajakartautara.id');
    header('Access-Control-Allow-Methods: GET, POST');
    header('Access-Control-Allow-Headers: X-Requested-With,Authorization,Content-Type');
    header('Access-Control-Max-Age: 86400');

    $apikey = $this->generateApiKey();
    $user_id = "17121701";
  }

  public function generateApiKey($length = 32)
  {
    return bin2hex(random_bytes($length / 2));
  }
}
