<?php

class Pelayanan extends R_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->addons->init([
      "js" => [
        "<script src=\"https://js.pusher.com/8.2.0/pusher.min.js\"></script>\n",
        "<script type=\"text/javascript\" src=\"https://unpkg.com/toastify-js\"></script>\n",
        "<script src=\"https://unpkg.com/sweetalert2@11\"></script>",
        "<script src=\"https://js.pusher.com/8.2.0/pusher.min.js\"></script>\n",
        "<script src='" . base_url() . "assets/js/form-validation-custom.js'></script>",
      ],
      "css" => [
        "<link rel=\"stylesheet\" type=\"text/css\" href=\"https://unpkg.com/toastify-js@1.12.0/src/toastify.css\">\n"
      ]
    ]);
  }

  /**
   * A function that loads the page for "Antrian Pelayanan" with specific data and layout.
   *
   * @return page The result of loading the page.
   */
  public function index()
  {
    $currentLoket = LoketPelayanan::where('id', $this->user['petugas']['loket_id'])->first();

    if ($currentLoket && $currentLoket->antrian && \Carbon\Carbon::today()->gt($currentLoket->antrian->created_at)) {
      $currentLoket->update([
        'status' => 0,
        'antrian_pelayanan_id' => null
      ]);
    }

    $this->load->page("pelayanan/antrian_pelayanan", [
      "antrian_berjalan" => AntrianPtsp::whereDate('created_at', date('Y-m-d'))->get(),
      "total_bulan_ini" =>  $this->eloquent->table("antrian_pelayanan")->where('petugas_id', $this->user['petugas']['id'] ?? 'admin')->whereMonth('created_at', date('m'))->count(),
      "is_admin" => $this->is_admin,
      "kode" => $this->getAntrianByJenisPetugas(
        $this->user['petugas']['jenis_petugas'] ?? 'admin'
      ),
      "currentLoket" => $currentLoket,
      "loket" => LoketPelayanan::where("status", "!=", 2)->get()
    ])->layout("dashboard_layout", [
      "title" => "Antrian Pelayanan",
      "nav" => $this->load->component("layout/nav_pelayanan")
    ]);
  }

  /**
   * A function that retrieves the antrian based on the jenis petugas provided.
   *
   * @param string|bool  $jenisPetugas The jenis petugas to retrieve the antrian for.
   * @return string The corresponding antrian based on the jenis petugas.
   */
  private function getAntrianByJenisPetugas($jenisPetugas)
  {
    if ($jenisPetugas == 'admin') {
      return "*";
    }

    $jenisAntrian = [
      "Petugas PTSP" => "A",
      "Petugas Produk" => "D",
      "Petugas Akta" => "D",
      "Petugas Posbakum" => "C",
      "Kasir" => "B"
    ];

    return $jenisAntrian[$jenisPetugas];
  }

  public function ambil_antrian_baru()
  {
    R_Input::mustPost();
    try {
    } catch (\Throwable $th) {
      //throw $th;
    }
  }


  public function datatable_antrian_pelayanan()
  {
    $antrianPtspDatatable = new AntrianPtspDatatable();

    if (!$this->is_admin) {
      $antrianPtspDatatable->condition = collect([
        "kode" => $this->getAntrianByJenisPetugas($this->user['petugas']['jenis_petugas'] ?? "*"),
        "status" => 0
      ]);
    }

    $lists = $antrianPtspDatatable->getData();
    $data = array();
    $no = R_Input::pos('start');
    $n = 1;
    foreach ($lists as $list) {
      $no++;
      $row = array();
      $row[] = $no;
      $row[] = $list->kode . "-" . $list->nomor_urutan;
      $row[] = $list->tujuan;
      $row[] = $this->load->component("table/pilihan_antrian_pelayanan", ["data" => $list]);
      $data[] = $row;
    }
    $output = array(
      "draw" => R_Input::pos('draw'),
      "recordsTotal" => $antrianPtspDatatable->countData(),
      "recordsFiltered" => $antrianPtspDatatable->countData(),
      "data" => $data,
    );
    // Output to json format
    echo json_encode($output);
  }

  public function panggil()
  {
    // prindie($_POST);
    R_Input::mustPost();
    try {
      if (R_Input::pos('panggil') == "baru") {
        $lastNomorAntrianPtsp = AntrianPtsp::where("status", 0)->where(
          function ($q) {
            if ($this->user['petugas']['jenis_petugas'] == 'Petugas PTSP') {
              $q->where("kode", 'A')->orWhere('kode', 'D');
            } else {
              $q->where("kode", R_Input::pos("kode"));
            }
          }
        )->whereDate("created_at", date("Y-m-d"))->first();

        if (!$lastNomorAntrianPtsp) {
          throw new Error("Antrian Sudah Habis");
        }

        $lastNomorAntrianPtsp->update(['status' => 1, 'petugas_id' => $this->user['petugas']['id']]);

        $loket = LoketPelayanan::where("id", $this->user['petugas']['loket_id'])->first();
        $loket->update(['antrian_pelayanan_id' => $lastNomorAntrianPtsp->id, 'status' => 1]);

        $loket->antrian;
        $loket->petugas;
      }

      if (R_Input::pos('panggil') == "kembali") {
        $loket = LoketPelayanan::where("id", $this->user['petugas']['loket_id'])->first();
        if (!$loket->antrian) {
          throw new Exception("Anda Belum Memanggil Antrian");
        }
        $loket->antrian;
        $loket->petugas;
      }

      Broadcast::pusher()->trigger("antrian-channel", "panggil-antrian-ptsp", $loket ?? null);

      if (R_Input::ci()->request_headers()["Accept"] == "application/json") {
        echo  json_encode(["status" => true, 'messsage' => 'Berhasil memanggil']);
        return set_status_header(200);
      }

      return Redirect::wfa([
        "message" => "Berhasil memanggil",
        "type" => "success",
        "text" => "Berhasil memanggil"
      ])->go($_SERVER['HTTP_REFERER']);
    } catch (\Throwable $th) {

      if (R_Input::ci()->request_headers()["Accept"] == "application/json") {
        echo  json_encode(["status" => false, 'messsage' => $th->getMessage()]);
        return set_status_header(400);
      }

      return Redirect::wfe($th->getMessage())->go($_SERVER["HTTP_REFERER"]);
    }
  }

  public function stop()
  {
    R_Input::mustPost();
    try {
      $loket = LoketPelayanan::where("id", $this->user['petugas']['loket_id'])->first();

      if (!$loket) {
        throw new Exception("Anda bukan petugas PTSP", 1);
      }

      $loket->update(['status' => 0]);

      Broadcast::pusher()->trigger("antrian-channel", "stop-antrian-ptsp", $loket);

      if (R_Input::ci()->request_headers()["Accept"] == "application/json") {
        echo  json_encode(["status" => true, 'messsage' => 'Berhasil memanggil']);
        return set_status_header(200);
      }

      return Redirect::wfa([
        "message" => "Berhasil memanggil",
        "type" => "success",
        "text" => "Berlangsung"
      ])->go($_SERVER['HTTP_REFERER']);
    } catch (\Throwable $th) {

      if (R_Input::ci()->request_headers()["Accept"] == "application/json") {
        echo  json_encode(["status" => false, 'messsage' => $th->getMessage()]);
        return set_status_header(400);
      }

      return Redirect::wfe($th->getMessage())->go($_SERVER["HTTP_REFERER"]);
    }
  }

  public function pindahkan()
  {
    R_Input::mustPost();
    try {
      $lastNomorAntrianPtsp = AntrianPtsp::where([
        "kode" => $this->tujuanToKode(R_Input::pos("tujuan")),
      ])->whereDate("created_at", date("Y-m-d"))->max("nomor_urutan");

      $newAntrianPtsp = AntrianPtsp::create([
        "tujuan" => R_Input::pos("tujuan"),
        "kode" => $this->tujuanToKode(R_Input::pos("tujuan")),
        "nomor_urutan" => $lastNomorAntrianPtsp ? $lastNomorAntrianPtsp + 1 : 1,
        "status" => 0,
      ]);

      if (R_Input::ci()->request_headers()["Accept"] == "application/json") {
        echo json_encode([
          "message" => "Berhasil memindahkan ke antrian : " . $newAntrianPtsp->nomor_antrian,
          "data" => $newAntrianPtsp
        ]);

        return set_status_header(200);
      }

      $this->session->set_flashdata("nomor_antrian", " -> " . $newAntrianPtsp->nomor_antrian);

      return Redirect::wfa(["message" => "Berhasil memindahkan ke antrian : " . $newAntrianPtsp->nomor_antrian])->go($_SERVER['HTTP_REFERER']);
    } catch (\Throwable $th) {
      if (R_Input::ci()->request_headers(true)['Accept'] == 'application/json') {
        echo json_encode([
          'message' => $th->getMessage(),
          'data' => null
        ]);

        return set_status_header(400);
      }

      return Redirect::wfe($th->getMessage())->go($_SERVER['HTTP_REFERER']);
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

  public function ganti_loket($id)
  {
    R_Input::mustPost();
    try {
      $petugas = Petugas::findOrFail(Cypher::urlsafe_decrypt($id));

      $petugas->update([
        'loket_id' => R_Input::pos('loket_id')
      ]);

      $this->user['petugas']['loket_id'] =  R_Input::pos('loket_id');
      $this->session->set_userdata("user_login", $this->user);

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
      ])->go('pelayanan');
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
}
