<?php

defined("BASEPATH") or exit("No direct script access allowed");

class Layar extends R_Controller
{

  public function sidang()
  {
    $this->addons->init([
      "js" => [
        "<script src=\"https://js.pusher.com/8.2.0/pusher.min.js\"></script>\n",
        "<script type=\"text/javascript\" src=\"https://cdn.jsdelivr.net/npm/toastify-js\"></script>\n"
      ],
      "css" => [
        "<link rel=\"stylesheet\" type=\"text/css\" href=\"https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css\">\n"
      ]
    ]);
    $this->load->page("persidangan/layar_antrian")->layout("auth_layout");
  }
}
