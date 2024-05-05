<?php

class Pesanan_produk extends R_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->addons->init([
      "js" => [
        "<script src=\"https://js.pusher.com/8.2.0/pusher.min.js\"></script>\n",
        "<script type=\"text/javascript\" src=\"https://unpkg.com/toastify-js\"></script>\n",
        "<script src=\"https://unpkg.com/sweetalert2@11\"></script>",
        "<script src=\"https://js.pusher.com/8.2.0/pusher.min.js\"></script>\n",
        "<script src='" . base_url() . "assets/js/form-validation-custom.js'></script>",
      ],
      "css" => [
        "<link rel=\"stylesheet\" type=\"text/css\" href=\"https://unpkg.com/browse/toastify-js@1.12.0/src/toastify.css\">\n"
      ]
    ]);
  }

  public function index()
  {
    $this->load->page("pelayanan/pelayanan_produk", [
      "antrian_produk" => AntrianPtsp::where(
        'kode',
        'D'
      )->whereDate('created_at', date('Y-m-d'))->get(),
      "is_admin" => $this->is_admin,
    ])->layout("dashboard_layout", [
      "title" => "Antrian Pelayanan",
      "nav" => $this->load->component("layout/nav_pelayanan")
    ]);
  }
}
