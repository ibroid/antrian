<?php

class Petugas_pelayanan extends R_Controller
{

  public function __construct()
  {
    parent::__construct();

    if (!$this->is_admin) {
      Redirect::wfe("Halaman khusus admin")->go($_SERVER["HTTP_REFERER"]);
    }

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
    $this->load->page("admin/petugas/daftar_petugas", [
      "petugas" => Petugas::latest()->get(),
    ])->layout("dashboard_layout", [
      "title" => "Daftar Petugas",
      "nav" => $this->load->component("layout/nav_admin")
    ]);
  }

  public function tambah()
  {
    $this->load->page("admin/petugas/tambah_petugas", [
      "pengguna_petugas" => Users::where("role_id", 2)->orWhere("role_id", 3)->latest()->get(),
      "loket" => LoketPelayanan::where('status', 0)->orWhere('status', 1)->get()
    ])->layout("dashboard_layout", [
      "title" => "Tambah Petugas",
      "nav" => $this->load->component("layout/nav_admin")
    ]);
  }

  public function simpan()
  {
    R_Input::mustPost();
    try {
      $petugas = Petugas::create(R_Input::pos()->toArray());

      if (R_Input::ci()->request_headers()["Accept"] == "application/json") {
        echo json_encode([
          "status" => true,
          "message" => "Berhasil menyimpan data",
          "data" => $petugas
        ]);
        return set_status_header(400);
      }

      return Redirect::wfa([
        "message" => "Berhasil menyimpan data",
        "text" => "Petugas Ditambahkan",
        "type" => "success"
      ])->go('/petugas_pelayanan');
    } catch (\Throwable $th) {

      if (R_Input::ci()->request_headers()["Accept"] == "application/json") {
        echo json_encode([
          "status" => false,
          "message" => $th->errorInfo[1] == 1062 ? "Data sudah ada" : $th->getMessage()
        ]);
        return set_status_header(400);
      }

      return Redirect::wfe($th->errorInfo[1] == 1062 ? "Data sudah ada" : $th->getMessage())->go($_SERVER["HTTP_REFERER"]);
    }
  }

  public function edit($id = null)
  {
    $petugas = Petugas::findOrFail(Cypher::urlsafe_decrypt($id));

    $this->load->page("admin/petugas/edit_petugas", [
      "pengguna_petugas" => Users::where("role_id", 2)->orWhere("role_id", 3)->latest()->get(),
      "loket" => LoketPelayanan::where('status', 0)->orWhere('status', 1)->get(),
      "data" => $petugas
    ])->layout("dashboard_layout", [
      "title" => "Edit Petugas",
      "nav" => $this->load->component("layout/nav_admin")
    ]);
  }

  public function update($id = null)
  {
    R_Input::mustPost();
    try {
      $petugas = Petugas::findOrFail(Cypher::urlsafe_decrypt($id));

      $petugas->update(R_Input::pos()->toArray());

      if (R_Input::ci()->request_headers()["Accept"] == "application/json") {
        echo json_encode([
          "status" => true,
          "message" => "Berhasil menyimpan data",
          "data" => $petugas
        ]);
        return set_status_header(400);
      }

      return Redirect::wfa([
        "message" => "Berhasil menyimpan data",
        "text" => "Petugas Ditambahkan",
        "type" => "success"
      ])->go($_GET['redirect'] ?? '/petugas_pelayanan');
    } catch (\Throwable $th) {
      if (R_Input::ci()->request_headers()["Accept"] == "application/json") {
        echo json_encode([
          "status" => false,
          "message" => $th->errorInfo[1] == 1062 ? "Data sudah ada" : $th->getMessage()
        ]);
        return set_status_header(400);
      }

      return Redirect::wfe($th->errorInfo[1] == 1062 ? "Data sudah ada" : $th->getMessage())->go($_SERVER["HTTP_REFERER"]);
    }
  }
}
