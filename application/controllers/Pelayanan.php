<?php

use Illuminate\Support\Facades\Date;

class Pelayanan extends ControlPetugasPelayanan
{

  public function __construct()
  {
    parent::__construct();
    $baseUrl = base_url();

    $this->addons->init([
      "js" => [
        "<script src=\"https://js.pusher.com/8.2.0/pusher.min.js\"></script>\n",
        "<script type=\"text/javascript\" src=\"https://unpkg.com/toastify-js\"></script>\n",
        "<script src=\"https://unpkg.com/sweetalert2@11\"></script>",
        "<script src=\"https://js.pusher.com/8.2.0/pusher.min.js\"></script>\n",
        "<script src='" . base_url() . "assets/js/form-validation-custom.js'></script>",
      ],
      "css" => [
        "<link rel=\"stylesheet\" type=\"text/css\" href=\"https://unpkg.com/toastify-js@1.12.0/src/toastify.css\">\n",
        "<script type=\"text/javascript\" src=\"$baseUrl/package/htmx/htm.js\"></script>\n"
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
    $currentLoket = LoketPelayanan::where('id', $this->user['petugas']['loket_id'] ?? null)->first();

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
      "loket" => LoketPelayanan::where("status", "!=", 2)->get(),
      "jenis_pelayanan" => JenisPelayanan::all()
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
      // $antrianPtspDatatable->condition = collect([
      //   "kode" => $this->getAntrianByJenisPetugas($this->user['petugas']['jenis_petugas'] ?? "*"),
      //   "status" => 0
      // ]);
      $inCond = [];
      if (count($this->user["petugas"]["jenis_pelayanan"]) > 0) {
        $inCond = array_map(function ($i) {
          return $i["id"];
        }, $this->user["petugas"]["jenis_pelayanan"]);
      } else {
        $inCond = ["none"];
      }
      $antrianPtspDatatable->allowedServiceCode = $inCond;
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
      $row[] = (function ($list) {
        if ($this->is_admin) {
          return $this->load->component("table/pilihan_antrian_pelayanan", ["data" => $list]);
        }
        return $this->load->component("table/wait_counter_antrian_pelayanan", ["data" => $list]);
      })($list);
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
      $this->eloquent->connection("default")->beginTransaction();

      $inCond = [];
      if (count($this->user["petugas"]["jenis_pelayanan"]) > 0) {
        $inCond = array_map(function ($i) {
          return $i["id"];
        }, $this->user["petugas"]["jenis_pelayanan"]);
      } else {
        $inCond = ["none"];
      }

      $callableId = $inCond;

      if (R_Input::pos('panggil') == "baru") {
        $currentLoket = LoketPelayanan::find($this->user["petugas"]['loket_id']);
        if ($currentLoket->antrian_pelayanan_id) {
          if ($currentLoket->antrian->jenis_pelayanan->need_identity == 1) {
            if (!$currentLoket->antrian->identitas_pihak_id) {
              $red = Redirect::wfe("Identitas pihak harus diisi sebelum melanjutkan antrian");
              if (isset($this->input->request_headers()["Hx-Request"])) {
                header("HX-Refresh: true");
                exit;
              }
              $red->go("/pelayanan");
            }
          }

          $waktuTadiDipanggil = new DateTime($currentLoket->antrian->mulai_panggil);
          $waktuPanggilSelanjutnya = new Date(date("Y-m-d H:i:s"));
          $durasiPelayanan = $waktuTadiDipanggil->diff($waktuPanggilSelanjutnya);
          $currentLoket->antrian()->update([
            "durasi_pelayanan" => sprintf(
              '%02d:%02d:%02d',
              ($durasiPelayanan->days * 24) + $durasiPelayanan->h,
              $durasiPelayanan->i,
              $durasiPelayanan->s
            ),
            "selesai_panggil" => date("Y-m-d H:i:s")
          ]);
        }

        $lastNomorAntrianPtsp = AntrianPtsp::where("status", 0)->where(
          function ($q) use ($callableId) {
            $q->whereIn("jenis_pelayanan_id", $callableId);
          }
        )->whereDate("created_at", date("Y-m-d"))->first();


        if (!$lastNomorAntrianPtsp) {
          throw new Error("Antrian Sudah Habis");
        }

        $waktuDiAmbil = new DateTime($lastNomorAntrianPtsp->created_at);
        $waktuDiPanggil = new DateTime(date("Y-m-d H:i:s"));
        $diff = $waktuDiAmbil->diff($waktuDiPanggil);
        $formattedTime = sprintf(
          '%02d:%02d:%02d',
          ($diff->days * 24) + $diff->h,
          $diff->i,
          $diff->s
        );

        $lastNomorAntrianPtsp->update([
          'status' => 1,
          'petugas_id' => $this->user['petugas']['id'],
          'waktu_tunggu' => $formattedTime,
          'mulai_panggil' => date("Y-m-d H:i:s")
        ]);

        $loket = LoketPelayanan::where("id", $this->user['petugas']['loket_id'])->first();
        $loket->update(['antrian_pelayanan_id' => $lastNomorAntrianPtsp->id, 'status' => 1]);

        $loket->antrian;
        $loket->petugas;
      } else {
        $loket = LoketPelayanan::where("id", $this->user['petugas']['loket_id'])->first();
        if (!$loket->antrian) {
          throw new Exception("Anda Belum Memanggil Antrian");
        }
        $loket->antrian;
        $loket->petugas;
      }

      Broadcast::pusher()->trigger("antrian-channel", "panggil-antrian-ptsp", $loket ?? null);

      $this->eloquent->connection("default")->commit();

      if (isset($this->input->request_headers()["Hx-Request"])) {
        echo $this->load->component('card/antrian_ptsp_saat_ini', ['data' => $loket->antrian]);
        return;
      }

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

      $this->eloquent->connection("default")->rollback();
      if (isset($this->input->request_headers()["Hx-Request"])) {
        echo "Terjadi kesalahan : " . $th->getMessage();
        return;
      }

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
    if ($this->input->request_headers()) {
      # code...
    }
    try {
      $selected_pelayanan = JenisPelayanan::findOrFail(Cypher::urlsafe_decrypt(R_Input::pos("id_pelayanan")));

      $lastNomorAntrianPtsp = AntrianPtsp::where([
        "kode" => $selected_pelayanan->kode_layanan,
      ])->whereDate("created_at", date("Y-m-d"))->max("nomor_urutan");

      $newAntrianPtsp = AntrianPtsp::create([
        "tujuan" => $selected_pelayanan->nama_layanan,
        "kode" => $selected_pelayanan->kode_layanan,
        "nomor_urutan" => $lastNomorAntrianPtsp ? $lastNomorAntrianPtsp + 1 : 1,
        "status" => 0,
        "jenis_pelayanan_id" => $selected_pelayanan->id
      ]);

      echo "Nomor antrian baru : " . $newAntrianPtsp->nomor_antrian;
    } catch (\Throwable $th) {
      echo $th->getMessage();
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

  private function kodeToTujuan($kode)
  {
    $daftarTujuan = [
      "A" => "PENDAFTARAN",
      "A" => "E-COURT",
      "A" => "INFORMASI",
      "B" => "KASIR",
      "C" => "POSBAKUM",
      "D" => "PRODUK",
    ];

    return $daftarTujuan[$kode] ?? null;
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

  public function user_setting($id)
  {
    $user = Users::findOrFail(Cypher::urlsafe_decrypt($id));

    $this->load->page("admin/pengguna/edit_pengguna", [
      "roles" => Roles::where("id", ">", 1)->get(),
      "pengguna" => $user
    ])->layout("dashboard_layout", [
      "title" => "Pengguna",
      "nav" => $this->user["petugas"]["jenis_petugas"] == "Petugas Sidang" ?  $this->load->component("layout/nav_persidangan") : $this->load->component("layout/nav_pelayanan")
    ]);
  }

  public function akhiri()
  {
    R_Input::mustPost();
    try {
      $this->eloquent->connection("default")->beginTransaction();
      $antrianId = Cypher::urlsafe_decrypt(R_Input::pos("id_antrian"));
      $antrian = AntrianPtsp::findOrFail(
        $antrianId
      );

      if ($antrian->jenis_pelayanan->need_identity == 1) {
        if (!$antrian->identitas_pihak_id) {
          Redirect::wfe("Silahkan isi identitas pihak sebelum melanjutkan antrian");
          header("HX-Refresh: true");
          exit;
        }
      }

      $waktuDiPanggil = new DateTime($antrian->mulai_panggil);
      $waktuSelesai = new DateTime(date("Y-m-d H:i:s"));
      $diff = $waktuDiPanggil->diff($waktuSelesai);
      $formattedTime = sprintf(
        '%02d:%02d:%02d',
        ($diff->days * 24) + $diff->h,
        $diff->i,
        $diff->s
      );

      $antrian->update([
        'selesai_panggil' => date("Y-m-d H:i:s"),
        'durasi_pelayanan' => $formattedTime
      ]);

      $loket = LoketPelayanan::where("antrian_pelayanan_id", $antrianId)->first();
      $loket->update(['antrian_pelayanan_id' => null, 'status' => 0]);

      $this->eloquent->connection("default")->commit();

      header("HX-Refresh: true");
      set_status_header(201);
    } catch (\Throwable $th) {
      $this->eloquent->connection("default")->rollBack();
      echo "Terjadi kesalahan : " . $th->getMessage();
    }
  }
}
