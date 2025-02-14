<?php

class Petugas_pelayanan extends R_Controller
{

  public function __construct()
  {
    parent::__construct();

    if (!$this->is_admin) {
      Redirect::wfe("Halaman khusus admin")->go($_SERVER["HTTP_REFERER"]);
    }
    $baseurl = base_url();

    $this->addons->init([
      "js" => [
        "<script src=\"$baseurl/package/htmx/htm.js\"></script>\n",
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
    $useravail = Users::orWhere(function ($query) {
      $query->where("role_id", 2)->orWhere("role_id", 3);
    })->whereNotExists(function ($q) {
      $q->select("*")->from("petugas")->whereColumn('petugas.user_id', 'users.id');
    })->latest()->get();

    $this->load->page("admin/petugas/tambah_petugas", [
      "pengguna_petugas" => $useravail,
      "loket" => LoketPelayanan::where('status', 0)->orWhere('status', 1)->get(),
      "jenis_petugas" => JenisPetugas::all(),
    ])->layout("dashboard_layout", [
      "title" => "Tambah Petugas",
      "nav" => $this->load->component("layout/nav_admin")
    ]);
  }

  public function simpan()
  {
    R_Input::mustPost();
    try {

      $this->form_validation->set_rules('nama_petugas', 'Nama Petugas', 'required|max_length[191]');
      $this->form_validation->set_rules('jenis_petugas', 'Jenis Petugas', 'required|max_length[191]');

      if ($this->form_validation->run() == FALSE) {
        throw new Exception(validation_errors("Kesalahan pengisian form. "), 1);
      }

      $this->eloquent->connection("default")->beginTransaction();
      $dto = [
        "nama_petugas" => R_Input::pos("nama_petugas"),
        "jenis_petugas" => R_Input::pos("jenis_petugas"),
        "user_id" => R_Input::pos("user_id")
      ];

      $petugas = Petugas::create($dto);

      if (isset($_POST["loket_id"])) {
        $petugas->loket_id = R_Input::pos("loket_id");
        $petugas->save();

        $daftarPelayanan = collect(R_Input::pos("jenis_pelayanan"));
        $petugas->jenis_pelayanan()->detach();

        $petugas->jenis_pelayanan()->attach($daftarPelayanan->map(function ($i) use ($petugas) {
          return [
            "jenis_pelayanan_id" => $i,
            "petugas_id" => $petugas->id
          ];
        })->all());
      }

      $this->eloquent->connection("default")->commit();

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
      // "loket" => LoketPelayanan::where('status', 0)->orWhere('status', 1)->get(),
      "data" => $petugas,
      "jenis_petugas" => JenisPetugas::all(),
      // "jenis_pelayanan" => JenisPelayanan::all()
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

      $this->form_validation->set_rules('nama_petugas', 'Nama Petugas', 'required|max_length[191]');
      $this->form_validation->set_rules('jenis_petugas', 'Jenis Petugas', 'required|max_length[191]');


      if ($this->form_validation->run() == FALSE) {
        throw new Exception(validation_errors("Kesalahan pengisian form. "), 1);
      }

      $this->eloquent->connection("default")->beginTransaction();
      $dto = [
        "nama_petugas" => R_Input::pos("nama_petugas"),
        "jenis_petugas" => R_Input::pos("jenis_petugas"),
        "user_id" => R_Input::pos("user_id")
      ];

      if (isset($_POST["loket_id"])) {
        $dto["loket_id"] = R_Input::pos("loket_id");
        $daftarPelayanan = collect(R_Input::pos("jenis_pelayanan"));

        $petugas->jenis_pelayanan()->detach();

        $petugas->jenis_pelayanan()->attach($daftarPelayanan->map(function ($i) use ($petugas) {
          return [
            "jenis_pelayanan_id" => $i,
            "petugas_id" => $petugas->id
          ];
        })->all());
      }

      $petugas->update($dto);

      if (R_Input::ci()->request_headers()["Accept"] == "application/json") {
        echo json_encode([
          "status" => true,
          "message" => "Berhasil menyimpan data",
          "data" => $petugas
        ]);
        return set_status_header(400);
      }

      $this->eloquent->connection("default")->commit();

      return Redirect::wfa([
        "message" => "Berhasil menyimpan data",
        "text" => "Petugas Ditambahkan",
        "type" => "success"
      ])->go($_GET['redirect'] ?? '/petugas_pelayanan');
    } catch (\Throwable $th) {
      $this->eloquent->connection("default")->rollBack();
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

  public function extend_form($id = null)
  {
    if (!isset($this->input->request_headers()["Hx-Request"])) {
      show_404();
    }

    sleep(1);

    if (R_Input::pos("jenis_petugas") !== "Petugas PTSP") {
      echo "";
      return;
    }

    if ($id == null) {
      $data["loket"] = LoketPelayanan::where('status', 0)->orWhere('status', 1)->get();
      $data["jenis_pelayanan"] = JenisPelayanan::all();
      $this->load->view("admin/petugas/form_extend", $data);
      return;
    }

    $petugas = Petugas::findOrFail(Cypher::urlsafe_decrypt($id));

    $data["petugas"] = $petugas;
    $data["loket"] = LoketPelayanan::where('status', 0)->orWhere('status', 1)->get();
    $data["jenis_pelayanan"] = JenisPelayanan::all();
    $this->load->view("admin/petugas/form_extend", $data);
  }
}
