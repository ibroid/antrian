<?php


use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;

class Ambil extends R_Controller
{
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

      $cetak = $this->print_antrian_sidang($data);
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

  public function print_antrian_sidang($data, $ip = "192.168.0.187")
  {
    if ($_ENV["DEBUG_PRINT"] == "false") {
      return [true, "Antrian tidak akan dicetak jika dalam mode debug print."];
    }

    try {
      if ($_ENV["DEBUG"] == "true" || isset($_GET["secondary"])) {
        $ip = "192.168.0.187";
      }

      $connector = new NetworkPrintConnector($ip, 9100, 5);
      $printer = new Printer($connector);
      $printer->initialize();

      $printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
      $printer->setJustification(Printer::JUSTIFY_CENTER);

      if ($_ENV["DEBUG"] == "true") {
        $printer->text("TEST UJI COBA\n");
      }
      $printer->text("Pengadilan Agama\n Jakarta Utara \n");
      $printer->text("------------------------\n");
      $printer->setTextSize(1, 1);
      $printer->text("Persidangan di " . $data->nama_ruang);
      $printer->text("\n");
      $printer->text("Nomor Antrian");
      $printer->text("\n");
      $printer->setTextSize(5, 4);
      $printer->text($data->nomor_urutan);
      $printer->text("\n");
      $printer->setTextSize(1, 1);
      $printer->text($data->nomor_perkara);
      $printer->text("\n");
      $printer->text("Yang Mengambil Antrian : " . R_Input::pos("nama_yang_ambil")) . "(" . R_Input::pos("yang_ambil") . ")\n";
      $printer->text("\n");

      $printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
      $printer->setJustification(Printer::JUSTIFY_CENTER);
      $printer->setTextSize(1, 1);
      $printer->text("Di ambil:" . date('Y-m-d H:i:S') . " \n");

      $printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
      $printer->setJustification(Printer::JUSTIFY_CENTER);
      $printer->setFont(Printer::FONT_A);
      $printer->text("------------------------\n");

      $printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
      $printer->setJustification(Printer::JUSTIFY_CENTER);
      $printer->qrCode(base_url("/mobile?antrian_sidang=" . Cypher::urlsafe_encrypt($data->id)), Printer::QR_ECLEVEL_L, 7, Printer::QR_MODEL_2);
      $printer->text("\n");
      $printer->setTextSize(1, 1);
      $printer->text("Scan QR Code di atas untuk mengetahui antrian berjalan secara online\n");

      $printer->cut();
      /* Pulse */
      $printer->pulse();

      $printer->close();

      return [true, "Antrian Berhasil dicetak"];
    } catch (\Throwable $th) {
      return [false, "Gagal cetak antrian. Masin antrian mati/tidak terhubung. " . $th->getMessage()];
    }
  }

  public function print_antrian_ptsp($data, $ip = "192.168.0.187")
  {
    if ($_ENV["DEBUG_PRINT"] == "false") {
      return [true, "Antrian tidak akan dicetak jika dalam mode debug print."];
    }

    try {
      if ($_ENV["DEBUG"] == "true" || isset($_GET["secondary"])) {
        $ip = "192.168.0.187";
      }

      $connector = new NetworkPrintConnector($ip, 9100, 5);
      $printer = new Printer($connector);
      $printer->initialize();

      $printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
      $printer->setJustification(Printer::JUSTIFY_CENTER);
      $printer->setFont(Printer::FONT_A);

      if ($_ENV["DEBUG"] == "true") {
        $printer->text("TEST UJI COBA\n");
      }

      $printer->text("Pengadilan Agama\n Jakarta Utara \n");
      $printer->text("------------------------\n");
      $printer->text($data->tujuan);
      $printer->text("\n");
      $printer->setTextSize(5, 4);
      $printer->text($data->kode . "-" . $data->nomor_urutan);
      $printer->text("\n");
      $printer->setTextSize(1, 1);

      if ($data->pesanan_produk) {
        $printer->text("Yang Mengambil Antrian : " . $data->pesanan_produk->nama_pengambil ?? "");
      }
      $printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
      $printer->setJustification(Printer::JUSTIFY_CENTER);
      $printer->setTextSize(1, 1);
      $printer->text("Di ambil:" . date('Y-m-d H:i:S') . " \n");

      $printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
      $printer->setJustification(Printer::JUSTIFY_CENTER);
      $printer->setFont(Printer::FONT_A);
      $printer->text("------------------------\n");

      $printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
      $printer->setJustification(Printer::JUSTIFY_CENTER);
      $printer->qrCode(base_url("/mobile?antrian_ptsp=" . Cypher::urlsafe_encrypt($data->id)), Printer::QR_ECLEVEL_L, 7, Printer::QR_MODEL_2);
      $printer->text("\n");
      $printer->setTextSize(1, 1);
      $printer->text("Scan QR Code di atas untuk mengetahui antrian berjalan secara online\n");



      $printer->cut();
      /* Pulse */
      $printer->pulse();

      $printer->close();

      return [true, "Antrian berhasil dicetak"];
    } catch (\Throwable $th) {
      return [false, "Gagal cetak antrian. Masin antrian mati/tidak terhubung. " . $th->getMessage()];
    }
  }

  public function ambil_antrian_ptsp()
  {
    R_Input::mustPost();
    try {
      $id = R_Input::pos("id");
      $this->eloquent->connection("default")->beginTransaction();
      $selectedLayanan = JenisPelayanan::find($id);
      $lastNomorAntrianPtsp = AntrianPtsp::where([
        "kode" => $selectedLayanan->kode_layanan
      ])->whereDate("created_at", date("Y-m-d"))->max("nomor_urutan");

      $newAntrianPtsp = AntrianPtsp::create([
        "tujuan" => $selectedLayanan->nama_layanan,
        "kode" => $selectedLayanan->kode_layanan,
        "nomor_urutan" => $lastNomorAntrianPtsp ? $lastNomorAntrianPtsp + 1 : 1,
        "status" => 0,
        "jenis_pelayanan_id" => $id
      ]);

      if (isset($_POST["nomor_perkara"])) {
        $produk = ProdukPengadilan::create([
          "nomor_perkara" => R_Input::pos("nomor_perkara"),
          "pihak_id" => R_Input::pos("pihak_id"),
          "antrian_pelayanan_id" => $newAntrianPtsp->id
        ]);
      }

      $cetak = $this->print_antrian_ptsp($newAntrianPtsp);
      $this->eloquent->connection("default")->commit();

      if ($this->input->request_headers()["Accept"] == "application/json") {
        echo json_encode(["message" => $cetak[1], "antrian" => $newAntrianPtsp]);
      } else {
        Redirect::wfa([
          "mesg" => $cetak[1],
          "text" => "Nomor antrian Anda " . $newAntrianPtsp->nomor_urutan . " di loket " . $newAntrianPtsp->tujuan,
          "type" => "success"
        ])->go($_SERVER["HTTP_REFERER"]);
      }
    } catch (\Throwable $th) {
      $this->eloquent->connection("default")->rollBack();
      if ($this->input->request_headers()["Accept"] == "application/json") {
        set_status_header(400);
        echo json_encode(["message" => $th->getMessage(), "stack" => $th->getTrace()]);
      } else {
        Redirect::wfe($th->getMessage())->go($_SERVER["HTTP_REFERER"]);
      }
    }
  }

  private function tujuanToKode($tujuan)
  {
    $daftarTujuan = [
      "PENDAFTARAN" => "A",
      "E-COURT" => "A",
      "INFORMASI" => "A",
      "KASIR" => "B",
      "POSBAKUM" => "C",
      "PRODUK" => "D",
    ];

    return $daftarTujuan[$tujuan] ?? null;
  }
}
