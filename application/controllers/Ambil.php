<?php


use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;

include_once APPPATH . "/traits/CetakThermalHelper.php";

class Ambil extends R_Controller
{
  use CetakThermalHelper;
  public Addons $addons;

  public function index()
  {
    $base_url = base_url();

    if (!$this->is_admin) {
      if (floatval(date("H")) < 7) {
        die("Khusus Jumat, Antrian Dibuka Pukul 8");
      }
    }

    $this->addons->init([
      'css' => [
        "<link rel='stylesheet' type='text/css' href='$base_url/assets/css/vendors/flatpickr/flatpickr.min.css'>\n",
        " <link rel=\"stylesheet\" type=\"text/css\" href=\"$base_url/assets/css/vendors/datatables.css\">",
        "<link rel=\"stylesheet\" type=\"text/css\" href=\"$base_url/assets/css/vendors/sweetalert2.css\">"
      ],
      'js' => [
        "<script src=\"$base_url/package/htmx/htm.js\"></script>\n",
        "<script src=\"$base_url/assets/js/flat-pickr/flatpickr.js\"></script>\n",
        "<script src=\"$base_url/assets/js/datatable/datatables/jquery.dataTables.min.js\"></script>\n",
        "<script src=\"https://cdn.jsdelivr.net/npm/sweetalert2@11\"></script>",
      ]
    ]);

    $data["daftar_sidang"] = PerkaraJadwalSidang::where("tanggal_sidang", isset($_POST["tanggal_sidang"]) ? $_POST["tanggal_sidang"] : date("Y-m-d"))->get();
    $data["jenis_pelayanan"] = JenisPelayanan::all();
    $this->load->page("ambil_antrian", $data)->layout("auth_layout");
  }

  public function fetch_table_checkin()
  {
    R_Input::mustPost();
    try {
      $data = PerkaraJadwalSidang::find(R_Input::pos("sidang_id"));
      if (isset($_GET["secondary_print"])) {
        echo $this->load->component("table/checkin_table_secondary", ["data" => $data]);
      } else {
        echo $this->load->component("table/checkin_table", ["data" => $data]);
      }
    } catch (\Throwable $th) {
      echo $th->getMessage();
    }
  }

  public function ambil_antrian_sidang()
  {
    try {
      if (!R_Input::isPost()) {
        throw new Exception("Tidak bisa akses halaman ini");
      }

      $data = AntrianPersidangan::where('nomor_perkara', R_Input::pos("nomor_perkara"))->whereDate('created_at', date("Y-m-d"))->first();

      if (!$data) {
        $data = AntrianPersidangan::create(
          [
            'status' => 0,
            'nomor_urutan' =>  floatval($this->nomor_urut_sidang_terakhir(R_Input::pos("nomor_ruang")))  + 1,
            'nomor_ruang' => R_Input::pos("nomor_ruang"),
            'nama_ruang' => R_Input::pos("nama_ruang"),
            'nomor_perkara' => R_Input::pos("nomor_perkara"),
            'tanggal_sidang' => R_Input::pos("tanggal_sidang"),
            'majelis_hakim' => R_Input::pos("majelis_hakim"),
            'jadwal_sidang_id' => R_Input::pos("jadwal_sidang_id"),
          ]
        );
      } else {
        $data->setKehadiranSetelahAmbilAntrian();
      }


      $this->session->set_flashdata("flash_alert", $this->load->component(Constanta::ALERT_SUCCESS, ["message" => "Nomor Antrian Anda : $data->nomor_urutan. Di ruangan : $data->nama_ruang. Silahkan Ambil Tiket Antrian nya"]));

      $printer = Eloquent::table('thermal_printer_list')->where("active", 1)->first();
      $res = $this->print_antrian_sidang($data, $printer->ip_address, $printer->port);
      if ($res[0] == false) {
        $this->session->set_flashdata("print_error", $this->load->component("print_sidang_error", ["data" => $data]));
      }
    } catch (\Throwable $th) {

      $this->session->set_flashdata("flash_error", $this->load->component(Constanta::ALERT_ERROR, ["message" => $th->getMessage()]));
    }

    redirect($_SERVER["HTTP_REFERER"]);
  }

  public function nomor_urut_sidang_terakhir($ruang)
  {
    $qrcMaxAntrian = AntrianPersidangan::whereDate("created_at", date("Y-m-d"))->where("nomor_ruang", $ruang)->max('nomor_urutan');

    return $qrcMaxAntrian;
  }

  public function ambil_antrian_ptsp()
  {
    R_Input::mustPost();

    try {
      $id = R_Input::pos("id");
      $this->eloquent->connection("default")->beginTransaction();
      $selectedLayanan = JenisPelayanan::findOrFail(Cypher::urlsafe_decrypt($id));

      $lastNomorAntrianPtsp = AntrianPtsp::where([
        "kode" => $selectedLayanan->kode_layanan
      ])->whereDate("created_at", date("Y-m-d"))->max("nomor_urutan");

      $newAntrianPtsp = AntrianPtsp::create([
        "tujuan" => $selectedLayanan->nama_layanan,
        "kode" => $selectedLayanan->kode_layanan,
        "nomor_urutan" => $lastNomorAntrianPtsp ? $lastNomorAntrianPtsp + 1 : 1,
        "status" => 0,
        "jenis_pelayanan_id" => Cypher::urlsafe_decrypt($id)
      ]);

      if (isset($_POST["nomor_perkara"])) {
        ProdukPengadilan::create([
          "nomor_perkara" => R_Input::pos("nomor_perkara"),
          "pihak_id" => R_Input::pos("pihak_id"),
          "antrian_pelayanan_id" => $newAntrianPtsp->id
        ]);
      }

      $printer = Eloquent::table('thermal_printer_list')->where("active", 1)->first();
      $cetak = $this->print_antrian_ptsp(
        $newAntrianPtsp,
        $printer->ip_address,
        $printer->port
      );

      $this->eloquent->connection("default")->commit();

      if ($this->input->request_headers()["Accept"] == "application/json") {
        echo json_encode([
          "message" => $cetak[1],
          "antrian" => $newAntrianPtsp,
          "print_status" => $cetak[0]
        ]);
        exit;
      }

      Redirect::wfa([
        "mesg" => $cetak[1],
        "text" => "Nomor antrian Anda " . $newAntrianPtsp->nomor_urutan . " di loket " . $newAntrianPtsp->tujuan,
        "type" => "success"
      ])->go($_SERVER["HTTP_REFERER"]);
    } catch (\Throwable $th) {
      $this->eloquent->connection("default")->rollBack();

      if ($this->input->request_headers()["Accept"] == "application/json") {
        set_status_header(400);
        echo json_encode(
          [
            "message" => $th->getMessage(),
            "stack" => $th->getTrace()
          ]
        );
        exit;
      }

      Redirect::wfe($th->getMessage())->go($_SERVER["HTTP_REFERER"]);
    }
  }
  public function cetak_antrian()
  {
    if (!isset($_GET['type'])) {
      show_404();
    }

    if ($this->input->get('type') == "ptsp") {
      $antrian = AntrianPtsp::findOrFail($this->input->get('id'));
    } else {
      $antrian = AntrianPersidangan::findOrFail($this->input->get('id'));
    }

    $this->load->view("cetak", [
      "kertas_content" => $this->load->view("public/kertas_antrian_" . $this->input->get('type'), [
        'data' => $antrian
      ], true)
    ]);
  }
}
