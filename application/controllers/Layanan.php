<?php

defined("BASEPATH") or exit("Exit");


class Layanan extends R_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->library("form_validation");

    if (!$this->is_admin) {
      Redirect::wfe("Halaman khusus admin")->go($_SERVER["HTTP_REFERER"]);
    }

    $baseurl = base_url();

    $this->addons->init([
      "js" => [
        "<script src=\"$baseurl/package/htmx/htm.js\"></script>\n",
        "<script src='https://unpkg.com/htmx.org/dist/ext/response-targets.js'></script>",
        "<script src=\"https://cdn.jsdelivr.net/npm/sweetalert2@11\"></script>"
      ],
      "css" => [
        "<link rel=\"stylesheet\" type=\"text/css\" href=\"$baseurl/assets/css/vendors/sweetalert2.css\">"
      ]
    ]);
  }

  public function index()
  {
    if ($this->input->method() == "get") {
      return $this->page();
    }
  }

  private function page()
  {
    $this->load->page("admin/layanan/daftar_layanan", [
      'daftar_jenis_layanan' => JenisPelayanan::get()
    ])->layout("dashboard_layout", [
      'nav' => $this->load->component('layout/nav_admin')
    ]);
  }

  public function check_kode()
  {
    if ($this->input->method() != "post") {
      show_404();
      exit;
    }

    $kode = R_Input::pos("kode_layanan");
    if (!$kode) {
      echo "Kode Kosong";
      return;
    }

    try {
      $layanan = JenisPelayanan::where("kode_layanan", $kode)->first();

      if ($layanan) {
        throw new Exception("Kode ini sudah digunakan oleh layanan $layanan->nama_layanan", 1);
      }

      $event = json_encode(["allowSubmit" => true]);
      header("HX-Trigger-After-Swap: $event");
      echo "Kode ini bisa digunakan";
    } catch (\Throwable $th) {

      if (isset($this->input->request_headers()["Hx-Request"])) {
        $event = json_encode(["allowSubmit" => false]);
        echo "Terjadi kesalahan. " . $th->getMessage();
        return;
      }
    }
  }

  public function simpan($id = null)
  {
    if ($this->input->method() != "post") {
      show_404();
      exit;
    }

    try {
      $this->form_validation->set_rules('nama_layanan', 'Nama Layanan', 'required|max_length[32]');
      $this->form_validation->set_rules('kode_layanan', 'Kode Layanan', 'trim|required|max_length[1]');

      if ($this->form_validation->run() == FALSE) {
        set_status_header(400);
        throw new Exception(validation_errors("Kesalahan Isi Form :"), 1);
      }

      $dto = [
        "nama_layanan" => $this->input->post("nama_layanan", true),
        "kode_layanan" => $this->input->post("kode_layanan", true)
      ];

      if (!$id) {
        $data = JenisPelayanan::create($dto);
      } else {
        $data = JenisPelayanan::where("id", Cypher::urlsafe_decrypt($id))->update($dto);
      }


      if (isset($this->input->request_headers()["Hx-Request"])) {
        header("HX-Refresh: true");
        echo "Simpan Berhasil";
        return;
      }

      Redirect::wfa(["message" => "Layanan baru berhasil ditambahkan"])->go("/layanan");
    } catch (\Throwable $th) {
      if (isset(
        $this->input->request_headers()["Hx-Request"]
      )) {
        echo "Terjadi Kesalahan. " . $th->getMessage();
      }

      Redirect::wfe($th->getMessage())->go("/layanan");
    }
  }

  public function form_edit($encId = null)
  {
    if (!isset($this->input->request_headers()["Hx-Request"])) {
      show_404();
    }

    $id = Cypher::urlsafe_decrypt($encId);
    $jenis_layanan = JenisPelayanan::findOrFail($id);
    $this->load->view("admin/layanan/form_edit_layanan", ["jenis_layanan" => $jenis_layanan]);
  }


  public function form_create()
  {
    if (!isset($this->input->request_headers()["Hx-Request"])) {
      show_404();
    }
    $this->load->view("admin/layanan/form_create_layanan");
  }

  public function delete($id = null)
  {
    if ($this->input->method() != "delete") {
      show_404();
    }

    try {
      JenisPelayanan::where("id", Cypher::urlsafe_decrypt($id))->delete();

      $this->session->set_flashdata("flash_alert", $this->load->component("alert/alert_info", ["message" => "Jenis layanan berhasil dihapus"]));
      header("HX-Refresh: true");
    } catch (\Throwable $th) {
      $this->session->set_flashdata("flash_error", $this->load->component("alert/alert_error", ["message" => $th->getMessage()]));
      header("HX-Refresh: true");
    }
  }
}
