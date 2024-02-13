<?php

class Ambil extends CI_Controller
{
  public Addons $addons;
  public function __construct()
  {
    parent::__construct();
    $this->load->library("addons");
  }

  public function index()
  {
    $base_url = base_url();

    $this->addons->init([
      'css' => [
        "<link rel='stylesheet' type='text/css' href='$base_url/assets/css/vendors/flatpickr/flatpickr.min.css'>\n",
        " <link rel=\"stylesheet\" type=\"text/css\" href=\"$base_url/assets/css/vendors/datatables.css\">",
        "<link rel=\"stylesheet\" type=\"text/css\" href=\"$base_url/assets/css/vendors/sweetalert2.css\">"
      ],
      'js' => [
        "<script src=\"$base_url/assets/js/flat-pickr/flatpickr.js\"></script>\n",
        "<script src=\"$base_url/assets/js/datatable/datatables/jquery.dataTables.min.js\"></script>\n",
        "<script src=\"https://cdn.jsdelivr.net/npm/sweetalert2@11\"></script>",
      ]
    ]);

    $data["daftar_sidang"] = PerkaraJadwalSidangModel::where("tanggal_sidang", isset($_POST["tanggal_sidang"]) ? $_POST["tanggal_sidang"] : date("Y-m-d"))->get();
    $this->load->page("persidangan/ambil_antrian", $data)->layout("auth_layout");
  }

  public function fetch_table_checkin()
  {
    $data = PerkaraModel::find(R_Input::pos("perkara_id"));
    echo $this->load->component("table/checkin_table", compact("data"));
  }
}
