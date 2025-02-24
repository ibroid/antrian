<?php

class Running_text extends ControlAdmin
{
  public function __construct()
  {
    parent::__construct();
    $baseUrl = base_url();

    $this->addons->init([
      "js" => [
        "<script type=\"text/javascript\" src=\"https://unpkg.com/toastify-js\"></script>\n",
        "<script src=\"https://unpkg.com/sweetalert2@11\"></script>",
        "<script src='" . base_url() . "assets/js/form-validation-custom.js'></script>",
      ],
      "css" => [
        "<link rel=\"stylesheet\" type=\"text/css\" href=\"https://unpkg.com/toastify-js@1.12.0/src/toastify.css\">\n",
        "<script type=\"text/javascript\" src=\"$baseUrl/package/htmx/htm.js\"></script>\n"
      ]
    ]);
  }

  private function page()
  {

    $this->load->page("admin/rtext/daftar_rtext", [
      "contents" => Eloquent::table("running_text_content")->where('status', 1)->get()
    ])->layout("dashboard_layout", [
      "title" => "Running Text Content",
      "nav" => $this->load->component("layout/nav_admin")
    ]);
  }

  public function index()
  {
    if ($this->input->method() == "get") {
      return $this->page();
    }
  }

  public function create()
  {
    R_Input::mustPost();
    try {
      Eloquent::table("running_text_content")->insert([
        "content" => R_Input::pos("content"),
        "status" => 1
      ]);
      Redirect::wfa(["message" => "Tambah konten berhasil"])->go("/running_text");
    } catch (\Throwable $th) {
      Redirect::wfe($th->getMessage())->go("/running_text");
      header("HX-Refresh: true");
    }
  }

  public function delete($id = null)
  {
    if ($this->input->method() != "delete") {
      echo show_404();
      exit;
    }

    try {
      $banner = Eloquent::table("running_text_content")->where("id", Cypher::urlsafe_decrypt($id))->first();
      if (!$banner) {
        throw new Exception("content tidak ditemukan", 1);
      }

      Eloquent::table("running_text_content")->where("id", Cypher::urlsafe_decrypt($id))->delete();

      Redirect::wfa(["message" => "Konten telah dihapus"]);
      header("HX-Refresh: true");
    } catch (\Throwable $th) {
      Redirect::wfe($th->getMessage());
      header("HX-Refresh: true");
    }
  }
}
