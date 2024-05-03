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
        "<script src=\"https://js.pusher.com/8.2.0/pusher.min.js\"></script>"
      ],
      "css" => [
        "<link rel=\"stylesheet\" type=\"text/css\" href=\"https://unpkg.com/toastify-js/src/toastify.min.css\">\n"
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
    $this->load->page("pelayanan/antrian_pelayanan", [
      "antrian_berjalan" => AntrianPtsp::whereDate('created_at', date('Y-m-d'))->get(),
      "is_admin" => $this->is_admin,
      "kode" => $this->getAntrianByJenisPetugas(
        $this->user['petugas']['jenis_petugas'] ?? 'admin'
      ),
      "lokets" => LoketPelayanan::where('status', '!=', 2)->get(),
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
      $antrianPtspDatatable->condition = [
        "kode" => $this->getAntrianByJenisPetugas($this->user['petugas']['jenis_petugas'] ?? "*"),
        "status" => 0
      ];
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
    R_Input::mustPost();
    try {
      if (R_Input::pos('panggil') == "baru") {
        $lastNomorAntrianPtsp = AntrianPtsp::where([
          "kode" => R_Input::pos('kode'),
          "status" => 0
        ])->whereDate("created_at", date("Y-m-d"))->first();

        if (!$lastNomorAntrianPtsp) {
          throw new Error("Antrian Sudah Habis");
        }

        $lastNomorAntrianPtsp->update(['status' => 1]);

        $loket = LoketPelayanan::where("petugas_id", $this->user['petugas']['id'])->first();
        $loket->update(['antrian_pelayanan_id' => $lastNomorAntrianPtsp->id]);

        $loket->antrian;
        $loket->petugas;
      }

      if (R_Input::pos('panggil') == "kembali") {
        $loket = LoketPelayanan::where("petugas_id", $this->user['petugas']['id'])->first();
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
}
