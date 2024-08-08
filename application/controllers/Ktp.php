<?php

use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;

class Ktp extends R_Controller
{
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
        "<script src=\"https://js.pusher.com/8.2.0/pusher.min.js\"></script>"
      ]
    ]);

    $data["daftar_sidang"] = PerkaraJadwalSidang::where("tanggal_sidang", isset($_POST["tanggal_sidang"]) ? $_POST["tanggal_sidang"] : date("Y-m-d"))->get();
    $this->load->page("ktp/ambil_antrian", $data)->layout("auth_layout");
  }

  public function fetch_form()
  {
    if (!R_Input::isPost()) {
      show_404();
    }

    try {
      $temp = $this->eloquent->table('temporary_data')->where('temp_photo', R_Input::pos('photo'))->first();

      $data = json_decode($temp->temp_data);
      $data->photo = $temp->temp_photo;
      $data->img = $temp->temp_img;

      echo $this->load->component('pengunjung/form_pengunjung', [
        'data' => $data
      ]);
    } catch (\Throwable $th) {
      set_status_header(400);
      echo $th->getMessage();
    }
  }

  public function file($filename)
  {
    return read_uploaded_file("temp", $filename);
  }

  public function simpan()
  {
    if (!R_Input::isPost()) {
      show_404();
    }
    try {
      if (R_Input::pos()->count() < 2) {
        throw new Exception("KTP Pengunjung tidak terdeteksi", 1);
      }

      $this->eloquent->connection("default")->transaction(function () {
        $pengunjung = Pengunjung::firstOrCreate([
          "nik" => R_Input::pos('nik')
        ], [
          'nama_lengkap' => R_Input::pos('nama_lengkap'),
          'jenis_kelamin' => R_Input::pos('jenis_kelamin'),
          'nik' => R_Input::pos('nik'),
          'pekerjaan' => R_Input::pos('pekerjaan'),
          'pendidikan' => R_Input::pos('pendidikan'),
          'tempat_lahir' => R_Input::pos('tempat'),
          'tanggal_lahir' => R_Input::pos('tanggal_lahir'),
          'provinsi' => R_Input::pos('provinsi'),
          'kota' => R_Input::pos('kota'),
          'kecamatan' => R_Input::pos('kecamatan'),
          'kelurahan' => R_Input::pos('kelurahan'),
          'alamat' => R_Input::pos('alamat')
        ]);

        $pengunjung->kunjungan()->create([
          "tanggal_kunjungan" => date('Y-m-d'),
          "status_pengunjung" => R_Input::pos("status_pengunjung"),
          "tujuan_kunjungan" => R_Input::pos("tujuan_kunjungan")
        ]);

        $daftarTujuan = [
          "PENDAFTARAN" => "A",
          "ECOURT" => "A",
          "INFORMASI" => "A",
          "KASIR" => "B",
          "POSBAKUM" => "C",
          "PRODUK" => "A",
        ];

        if (isset($daftarTujuan[R_Input::pos('tujuan')])) {
          $this->ambil_antrian_ptsp(
            $daftarTujuan[R_Input::pos('tujuan')],
            R_Input::pos('tujuan'),
            $pengunjung->id
          );
        } else {
          if (R_Input::pos('tujuan') == 'SIDANG') {
            $antrianSidang = $this->ambil_antrian_sidang($pengunjung);
            $this->eloquent->table('pengunjung_sidang')->insert([
              'pengunjung_id' =>  $pengunjung->id,
              'antrian_sidang_id' => $antrianSidang->id
            ]);
          }
        }
      });
    } catch (\Throwable $th) {
      Redirect::wfe($th->getMessage())->to("ktp");
    }

    Redirect::wfa(['message' => "Berhasil menyimpan data pengunjung"])->to("/ktp");
  }


  private function ambil_antrian_ptsp($kode, $tujuan, $id)
  {
    $lastNomorAntrianPtsp = AntrianPtsp::where([
      "kode" => $kode,
    ])->whereDate("created_at", date("Y-m-d"))->max("nomor_urutan");

    $newAntrianPtsp = AntrianPtsp::create([
      "tujuan" => $tujuan,
      "kode" => $kode,
      "nomor_urutan" => $lastNomorAntrianPtsp ? $lastNomorAntrianPtsp + 1 : 1,
      "status" => 0,
      "pengunjung_id" => $id
    ]);

    $this->print_antrian_ptsp($newAntrianPtsp);

    return $newAntrianPtsp;
  }

  private function print_antrian_ptsp($data, $ip = "192.168.0.188")
  {
    if ($_ENV["DEBUG_PRINT"] == "false") {
      return [true, "Antrian tidak akan dicetak jika dalam mode debug print."];
    }
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
  }

  private function ambil_antrian_sidang($pengunjung)
  {
    $pihakPerkara = Pihak::where('nomor_indentitas', $pengunjung->nik)->first();

    if (!$pihakPerkara) {
      throw new Exception("KTP Tidak Ditemukan DI SIPP", 1);
    }

    $perkara = $pihakPerkara->pihak_satu->perkara;

    $lastSidang = $perkara->jadwal_sidang->last();

    if ($lastSidang->tanggal_sidang !== date("Y-m-d")) {
      throw new Exception("Tidak ada jadwal sidang untuk perkara ini");
    }

    $data = AntrianPersidangan::firstOrCreate([
      "nomor_perkara" => $perkara->nomor_perkara,
      "tanggal_sidang" => date("Y-m-d"),
    ],  [
      'status' => 0,
      'nomor_urutan' =>  floatval($this->nomor_urut_sidang_terakhir(
        $lastSidang->ruangan_id
      ))  + 1,
      'nomor_ruang' => $lastSidang->ruangan_id,
      'nama_ruang' => $lastSidang->ruangan,
      'nomor_perkara' => $perkara->nomor_perkara,
      'tanggal_sidang' => $lastSidang->tanggal_sidang,
      'majelis_hakim' => $perkara->penetapan->majelis_hakim_nama,
      'jadwal_sidang_id' => $lastSidang->id,
    ]);



    $this->print_antrian_sidang($data);

    return $data;
  }

  private function nomor_urut_sidang_terakhir($ruang)
  {
    $qrcMaxAntrian = AntrianPersidangan::whereDate("created_at", date("Y-m-d"))->where("nomor_ruang", $ruang)->max('nomor_urutan');

    return $qrcMaxAntrian;
  }

  private function print_antrian_sidang($data, $ip = "192.168.0.188")
  {
    if ($_ENV["DEBUG_PRINT"] == "false") {
      return [true, "Antrian tidak akan dicetak jika dalam mode debug print."];
    }

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
  }
}
