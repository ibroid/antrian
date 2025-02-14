<?php

class Pengguna extends R_Controller
{
  /**
   * Inisialisasi fungsi construct.
   * Inisialisasi library Addons untuk menambahkan plugin css dan js.
   * 
   * @return void
   */
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
    $this->load->library("form_validation");
  }

  /**
   * Menampilkan daftar pengguna dengan hak akses admin dan mengirimkan judul "Pengguna" dan komponen nav_admin untuk dashboard layout.
   * Url : /pengguna
   * @return page
   */
  public function index()
  {

    if (!$this->is_admin) {
      Redirect::wfe("Halaman khusus admin")->go($_SERVER["HTTP_REFERER"]);
    }

    $this->load->page("admin/pengguna/daftar_pengguna", [
      "pengguna" => Users::where("role_id", ">", 1)->latest()->get()
    ])->layout("dashboard_layout", [
      "title" => "Pengguna",
      "nav" => $this->load->component("layout/nav_admin")
    ]);
  }

  /**
   * Menampilkan halaman tambah pengguna dan mengirimkan judul "Pengguna" dan komponen nav_admin untuk dashboard layout.
   * Url : /pengguna/tambah
   * @return page
   */
  public function tambah()
  {

    if (!$this->is_admin) {
      Redirect::wfe("Halaman khusus admin")->go($_SERVER["HTTP_REFERER"]);
    }

    $this->load->page("admin/pengguna/tambah_pengguna", [
      "roles" => Roles::where("id", ">", 1)->get()
    ])->layout("dashboard_layout", [
      "title" => "Pengguna",
      "nav" => $this->load->component("layout/nav_admin")
    ]);
  }

  /**
   * Fungsi untuk menyimpan data pengguna.
   * Url : /pengguna/save.
   * Method : POST.
   * @return Redirect|JSON
   */
  public function save()
  {
    R_Input::mustPost();
    try {
      $userExists = Users::where("identifier", R_Input::pos("identifier"))->first();
      if ($userExists) {
        throw new Exception("Pengguna sudah ada");
      }

      $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required|min_length[5]|max_length[16]');
      $this->form_validation->set_rules('identifier', 'Identifikasi', 'trim|required|min_length[5]|max_length[16]');
      $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|max_length[191]');
      $this->form_validation->set_rules('avatar', 'Avatar', 'trim|required|max_length[24]');

      if ($this->form_validation->run() == false) {
        throw new Exception(validation_errors("Kesalahan pengisian form"), 1);
      }

      $salt = bin2hex(random_bytes(4));

      $dto = [
        "identifier" => R_Input::pos("identifier"),
        "salt" => $salt,
        "name" => R_Input::pos("nama_lengkap"),
        "role_id" => R_Input::pos("level"),
        // Password hashed from model.
        "password" => R_Input::pos("password"),
        "avatar" => R_Input::pos("avatar"),
        "status" => R_Input::pos("status")
      ];

      $user = Users::create($dto);

      if (R_Input::ci()->request_headers()["Accept"] == "application/json") {
        echo json_encode([
          "status" => true,
          "message" => "Pengguna ditambahkan",
          "data" => $user
        ]);

        return set_status_header(200);
      }

      Redirect::wfa([
        "message" => "Pengguna ditambahkan",
        "text" => "Berhasil",
        "type" => "success",
      ])->go($this->is_admin ? "/pengguna" : "/pelayanan");
    } catch (\Throwable $th) {
      if (R_Input::ci()->request_headers()["Accept"] == "application/json") {
        echo json_encode([
          "status" => false,
          "message" => $th->getMessage()
        ]);
        return set_status_header(400);
      }
      Redirect::wfe($th->getMessage())->go($_SERVER["HTTP_REFERER"]);
    }
  }

  /**
   * Menampilkan halaman edit pengguna dan mengirimkan judul "Pengguna" dan komponen nav_admin untuk dashboard layout.
   * Url : /pengguna/edit/$user_id. Method : GET
   * Parameter Terenkripsi.
   * @param string $user_id
   * @return page
   */
  public function edit($user_id)
  {
    $this->load->page("admin/pengguna/edit_pengguna", [
      "roles" => Roles::where("id", ">", 1)->get(),
      "pengguna" => Users::findOrFail(Cypher::urlsafe_decrypt($user_id))
    ])->layout("dashboard_layout", [
      "title" => "Pengguna",
      "nav" => $this->load->component("layout/nav_admin")
    ]);
  }

  /**
   * Fungsi untuk mengupdate data pengguna. Parameter harus terenkripsi.
   * Url : /pengguna/update/$user_id.
   * Method : POST.
   * @param string $user_id
   * @return Redirect|JSON
   */
  public function update($user_id)
  {
    R_Input::mustPost();
    try {
      $user = Users::findOrFail(Cypher::urlsafe_decrypt($user_id));

      $user->update([
        "identifier" => R_Input::pos("identifier"),
        "name" => R_Input::pos("nama_lengkap"),
        "role_id" => R_Input::pos("level"),
        "avatar" => R_Input::pos("avatar")
      ]);

      $user->petugas()->update([
        "jenis_petugas" => R_Input::pos("jenis_petugas")
      ]);

      if (R_Input::ci()->request_headers()["Accept"] == "application/json") {
        echo json_encode([
          "status" => true,
          "message" => "Pengguna ditambahkan",
          "data" => $user
        ]);
        return set_status_header(200);
      }

      return Redirect::wfa([
        "message" => "Pengguna diupdate",
        "text" => "Berhasil",
        "type" => "success",
      ])->go($this->is_admin ? "/pengguna" : $_SERVER['HTTP_REFERER']);
    } catch (\Throwable $th) {
      if (R_Input::ci()->request_headers()["Accept"] == "application/json") {
        echo json_encode([
          "status" => false,
          "message" => $th->getMessage()
        ]);
        return set_status_header(400);
      }
      Redirect::wfe($th->getMessage())->go($_SERVER["HTTP_REFERER"]);
    }
  }


  /**
   * Fungsi untuk menghapus data pengguna. Parameter harus terenkripsi.
   * Url : /pengguna/delete/$user_id.
   * Method : POST.
   * @param string $user_id
   * @return Redirect|JSON
   */
  public function delete($user_id)
  {
    if (!$this->is_admin) {
      Redirect::wfe("Halaman khusus admin")->go($_SERVER["HTTP_REFERER"]);
    }

    R_Input::mustPost();
    try {
      $user = Users::findOrFail(Cypher::urlsafe_decrypt($user_id));

      if (!password_verify(R_Input::pos("password_hapus") . $user->salt, $user->password)) {
        throw new Exception("Password Tidak Sama", 1);
      }

      $user->delete();

      if (R_Input::ci()->request_headers()["Accept"] == "application/json") {
        echo json_encode([
          "status" => true,
          "message" => "Pengguna dihapus",
          "data" => $user
        ]);
        return set_status_header(200);
      }
      return Redirect::wfa([
        "message" => "Pengguna dihapus",
        "text" => "Berhasil",
        "type" => "success",
      ])->go("/pengguna");
    } catch (\Throwable $th) {
      if (R_Input::ci()->request_headers()["Accept"] == "application/json") {
        echo json_encode([
          "status" => false,
          "message" => $th->getMessage()
        ]);
        return set_status_header(400);
      }
      return Redirect::wfe($th->getMessage())->go($_SERVER["HTTP_REFERER"]);
    }
  }

  /**
   * Fungsi untuk merubah password pengguna. Parameter harus terenkripsi.
   * Url : /pengguna/change_password/$user_id.
   * Method : POST.
   * @param string $user_id
   * @return Redirect|JSON
   */
  public function change_password($user_id)
  {
    R_Input::mustPost();
    try {
      $user = Users::findOrFail(Cypher::urlsafe_decrypt($user_id));
      if (!password_verify(R_Input::pos('password_lama') . $user->salt, $user->password)) {
        throw new Exception("Password Lama Salah", 1);
      }

      $user->update([
        "password" => R_Input::pos('password_baru'),
        "salt" => $user->salt
      ]);

      if (R_Input::ci()->request_headers()["Accept"] == "application/json") {
        echo json_encode([
          "status" => true,
          "message" => "Password diubah",
          "data" => $user
        ]);
        return set_status_header(200);
      }

      return Redirect::wfa([
        "message" => "Password diubah",
        "text" => "Berhasil",
        "type" => "success",
      ])->go("/pengguna");
    } catch (\Throwable $th) {
      if (R_Input::ci()->request_headers()["Accept"] == "application/json") {
        echo json_encode([
          "status" => false,
          "message" => $th->getMessage()
        ]);
        return set_status_header(400);
      }
      return Redirect::wfe($th->getMessage())->go($_SERVER["HTTP_REFERER"]);
    }
  }

  public function setting($id = null)
  {
    $user = Users::findOrFail(Cypher::urlsafe_decrypt($id));

    $this->load->page("admin/pengguna/edit_pengguna", [
      "roles" => Roles::where("id", ">", 1)->get(),
      "pengguna" => $user
    ])->layout("dashboard_layout", [
      "title" => "Pengguna",
      "nav" => $this->load->component("layout/nav_admin")
    ]);
  }
}
