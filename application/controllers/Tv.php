<?php

class Tv extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->library("addons");
    $this->addons->init([
      "js" => [
        "<script src=\"https://js.pusher.com/8.2.0/pusher.min.js\"></script>\n",
        "<script type=\"text/javascript\" src=\"https://unpkg.com/toastify-js\"></script>\n",
        "<script src=\"https://unpkg.com/sweetalert2@11\"></script>",
        "<script src=\"https://js.pusher.com/8.2.0/pusher.min.js\"></script>"
      ],
      "css" => [
        "<link rel=\"stylesheet\" type=\"text/css\" href=\"https://unpkg.com/toastify-js/src/toastify.min.css\">\n"
      ]
    ]);
    $this->load->library("Sysconf", ["ed" => $this->eloquent]);
  }

  /**
   * Menampilkan antrian berjalan dengan layar TV tanpa otentikasi.
   * Url : /tv. Method : GET
   * @return page
   */
  public function index()
  {
    $this->load->page("public/tv", [
      "antrian_hari_ini" => AntrianPtsp::whereDate("created_at", date("Y-m-d"))->get(),
    ])->layout("auth_layout");
  }


  public function fetch_loket_antrian()
  {
    echo $this->load->component("card/current_antrian_tv");
  }
}
