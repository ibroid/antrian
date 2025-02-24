<?php

class Printer extends ControlAdmin
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
        "<script type=\"text/javascript\" src=\"$baseUrl/package/htmx/htm.js\"></script>\n",
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
    $this->load->page("admin/printer/daftar_printer", [
      "printers" => Eloquent::table("thermal_printer_list")->get()
    ])->layout("dashboard_layout", [
      "title" => "Daftar Printer",
      "nav" => $this->load->component("layout/nav_admin")
    ]);
  }

  public function create()
  {
    R_Input::mustPost();
    try {
      Eloquent::table("thermal_printer_list")->insert([
        "ip_address" => R_Input::pos('ip_address'),
        "port" => R_Input::pos('port'),
        "desc" => R_Input::pos("desc"),
        "active" => 0
      ]);

      Redirect::wfa(["message" => "Printer berhasil ditambahkan"])->go("/printer");
    } catch (\Throwable $th) {
      Redirect::wfa($th->getMessage())->go("/printer");
    }
  }

  public function set_active($id = null)
  {
    R_Input::mustPost();
    try {
      $printer = Eloquent::table("thermal_printer_list")->where("id", Cypher::urlsafe_decrypt($id))->first();
      if (!$printer) {
        throw new Exception("Printer tidak ditemukan", 1);
      }

      $activedPrinter = Eloquent::table("thermal_printer_list")->where("active", 1)->first();
      $status = R_Input::pos('status') == 'false' ? 0 : 1;
      if ($activedPrinter && $status == 1) {
        throw new Exception("Tidak bisa mengaktifkan lebih dari 1 printer", 1);
      }

      Eloquent::table("thermal_printer_list")->where("id", Cypher::urlsafe_decrypt($id))->update(["active" => $status]);

      echo $status == 1 ? "Berhasil mengaktifkan printer" : "Berhasil menonaktifkan printer";
    } catch (\Throwable $th) {
      header("HX-Trigger: {\"failSetActive\":\"$id\"}");
      echo $th->getMessage();
    }
  }

  public function delete($id = null)
  {
    if ($this->input->method() != "delete") {
      return show_404();
    }

    try {
      $printer = Eloquent::table("thermal_printer_list")->where('id', Cypher::urlsafe_decrypt($id))->where('active', 1)->first();
      if ($printer) {
        throw new Exception("Printer aktif tidak bisa dihapus", 1);
      }
      Eloquent::table("thermal_printer_list")->where('id', Cypher::urlsafe_decrypt($id))->delete();

      Redirect::wfa(["message" => "Data priter berhasil dihapus"]);
      header("HX-Refresh: true");
    } catch (\Throwable $th) {
      Redirect::wfe($th->getMessage());
      header("HX-Refresh: true");
    }
  }
}
