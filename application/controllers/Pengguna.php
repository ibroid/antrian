<?php

class Pengguna extends R_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->library("Addons");
    $this->addons->init([
      "js" => [
        "<script src=\"https://cdn.jsdelivr.net/npm/sweetalert2@11\"></script>\n",
        "<script src=\"https://js.pusher.com/8.2.0/pusher.min.js\"></script>\n",
        "<script type=\"text/javascript\" src=\"https://cdn.jsdelivr.net/npm/toastify-js\"></script>\n"
      ],
      "css" => [
        "<link rel=\"stylesheet\" type=\"text/css\" href=\"https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css\">\n"
      ]
    ]);
  }
  public function index()
  {
    /**
     * Menampilkan daftar pengguna dengan hak akses admin dan mengirimkan judul "Pengguna" dan komponen nav_admin untuk dashboard layout.
     * Url : /admin/pengguna
     * @return void
     */
    $this->load->page("admin/pengguna/daftar_pengguna", [
      "pengguna" => Users::where("role_id", ">", 1)->latest()->get()
    ])->layout("dashboard_layout", [
      "title" => "Pengguna",
      "nav" => $this->load->component("layout/nav_admin")
    ]);
  }

  /**
   * Menampilkan halaman tambah pengguna dan mengirimkan judul "Pengguna" dan komponen nav_admin untuk dashboard layout.
   * Url : /admin/pengguna/tambah
   * @return void
   */
  public function tambah()
  {
    $this->load->page("admin/pengguna/tambah_pengguna", [
      "roles" => Roles::where("id", ">", 1)->get()
    ])->layout("dashboard_layout", [
      "title" => "Pengguna",
      "nav" => $this->load->component("layout/nav_admin")
    ]);
  }
}
