<?php


use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;

class Ambil extends R_Controller
{
  public Addons $addons;

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

    $data["daftar_sidang"] = PerkaraJadwalSidang::where("tanggal_sidang", isset($_POST["tanggal_sidang"]) ? $_POST["tanggal_sidang"] : date("Y-m-d"))->get();
    $this->load->page("persidangan/ambil_antrian", $data)->layout("auth_layout");
  }

  public function fetch_table_checkin()
  {
    $data = PerkaraJadwalSidang::find(R_Input::pos("sidang_id"));
    echo $this->load->component("table/checkin_table", compact("data"));
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
            'nomor_urutan' =>  floatval($this->nomor_urut_terakhir(R_Input::pos("nomor_ruang")))  + 1,
            'nomor_ruang' => R_Input::pos("nomor_ruang"),
            'nama_ruang' => R_Input::pos("nama_ruang"),
            'nomor_perkara' => R_Input::pos("nomor_perkara"),
            'pihak_satu' => R_Input::pos("pihak_satu"),
            'pihak_dua' => R_Input::pos("pihak_dua"),
            'tanggal_sidang' => R_Input::pos("tanggal_sidang"),
            'majelis_hakim' => R_Input::pos("majelis_hakim"),
            'jadwal_sidang_id' => R_Input::pos("jadwal_sidang_id"),
          ]
        );
      }

      KehadiranPihak::updateOrCreate([
        "pihak" => R_Input::pos("nama_yang_ambil"),
        "sebagai" => R_Input::pos("yang_ambil")
      ], ["antrian_persidangan_id" => $data->id]);

      $this->session->set_flashdata("flash_alert", $this->load->component(Constanta::ALERT_SUCCESS, ["message" => "Nomor Antrian Anda : $data->nomor_urutan. Di ruangan : $data->nama_ruang. Silahkan Ambil Tiket Antrian nya"]));

      $this->print($data);
    } catch (\Throwable $th) {

      $this->session->set_flashdata("flash_error", $this->load->component(Constanta::ALERT_ERROR, ["message" => $th->getMessage()]));
    }

    redirect("/ambil");
  }

  public function nomor_urut_terakhir($ruang)
  {
    $qrcMaxAntrian = AntrianPersidangan::whereDate("created_at", date("Y-m-d"))->where("nomor_ruang", $ruang)->max('nomor_urutan');

    return $qrcMaxAntrian;
  }

  public function print($data)
  {
    try {
      //code...
      $connector = new NetworkPrintConnector("192.168.0.188", 9100, 3000);
      $printer = new Printer($connector);
      $printer->initialize();

      $printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
      $printer->setJustification(Printer::JUSTIFY_CENTER);
      $printer->setFont(Printer::FONT_A);

      $printer->text("ANTRIAN SIDANG \n");
      $printer->text("Pengadilan Agama\n Jakarta Utara \n");
      $printer->text("------------------------\n");
      $printer->text($data->nama_ruang);
      $printer->text("\n");
      $printer->setTextSize(5, 4);
      $printer->text($data->nomor_urutan);
      $printer->text("\n");
      $printer->setTextSize(1, 1);
      $printer->text($data->nomor_perkara);
      $printer->text("\n");
      $printer->text($data->pihak_satu);
      $printer->text("\n");

      $printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
      $printer->setJustification(Printer::JUSTIFY_CENTER);
      $printer->setFont(Printer::FONT_A);
      $printer->text("------------------------\n");
      $printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
      $printer->setJustification(Printer::JUSTIFY_CENTER);
      $printer->setFont(Printer::FONT_A);
      $printer->text("Di ambil:" . date('Y-m-d H:i:S') . " \n");
      $printer->text("Silahkan Menunggu Di Tempat Yg Telah Disediakan\n");

      $printer->cut();
      /* Pulse */
      $printer->pulse();

      $printer->close();
    } catch (\Throwable $th) {
      throw new Exception("Gagal cetak antrian. Masin antrian mati/tidak terhubung. " . $th->getMessage(), $th->getCode());
    }
  }

  public function print_belakang($data)
  {
    $connector = new NetworkPrintConnector("192.168.0.187", 9100, 3000);
    $printer = new Printer($connector);
    $printer->initialize();

    $printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
    $printer->setJustification(Printer::JUSTIFY_CENTER);
    $printer->setFont(Printer::FONT_A);

    $printer->text("ANTRIAN SIDANG \n");
    $printer->text("Pengadilan Agama\n Jakarta Utara \n");
    $printer->text("------------------------\n");
    $printer->text($data->nama_ruang);
    $printer->text("\n");
    $printer->setTextSize(5, 4);
    $printer->text($data->nomor_urutan);
    $printer->text("\n");
    $printer->setTextSize(1, 1);
    $printer->text($data->nomor_perkara);
    $printer->text("\n");
    $printer->text($data->pihak_satu);
    $printer->text("\n");

    $printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
    $printer->setJustification(Printer::JUSTIFY_CENTER);
    $printer->setFont(Printer::FONT_A);
    $printer->text("------------------------\n");
    $printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
    $printer->setJustification(Printer::JUSTIFY_CENTER);
    $printer->setFont(Printer::FONT_A);
    $printer->text("Di ambil:" . date('Y-m-d H:i:S') . " \n");
    $printer->text("Silahkan Menunggu Di Tempat Yg Telah Disediakan\n");

    $printer->cut();
    /* Pulse */
    $printer->pulse();

    $printer->close();
  }
}
