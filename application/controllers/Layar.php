<?php

defined("BASEPATH") or exit("No direct script access allowed");

class Layar extends R_Controller
{
  /**
   * Mendefinisikan fungsi construct.
   * Menginisialisasi plugin css dan js
   * @return void
   */
  public function __construct()
  {
    parent::__construct();
    $this->addons->init([
      "js" => [
        "<script src=\"https://js.pusher.com/8.2.0/pusher.min.js\"></script>\n",
        "<script type=\"text/javascript\" src=\"https://cdn.jsdelivr.net/npm/toastify-js\"></script>\n"
      ],
      "css" => [
        "<link rel=\"stylesheet\" type=\"text/css\" href=\"https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css\">\n"
      ]
    ]);
  }

  /**
   * Fungsi untuk menampilkan layar antrian sidang yang berjalan.
   * Url : /layar/sidang. Method : GET
   * @return page
   */
  public function sidang()
  {
    $this->load->page("persidangan/layar_antrian")->layout("auth_layout");
  }

  /**
   * Fungsi untuk menampilkan layar antrian pelayanan sidang yang berjalan.
   * Url : /layar/ptsp. Method : GET
   * @return page
   */
  public function ptsp()
  {
    $this->load->page("pelayanan/layar_antrian")->layout("auth_layout");
  }
}
