<?php

class Pelayanan_produk extends R_Controller
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
        "<script src='" . base_url() . "assets/js/form-validation-custom.js'></script>\n",
        "<script type=\"text/javascript\" src=\"https://unpkg.com/webcam-easy/dist/webcam-easy.js\"></script>\n",
        "<script type=\"text/javascript\" src='" . base_url() . "assets/js/typeahead/typeahead.bundle.js'></script>\n",
      ],
      "css" => [
        "<link rel=\"stylesheet\" type=\"text/css\" href=\"https://unpkg.com/toastify-js@1.12.0/src/toastify.css\">\n"
      ]
    ]);
  }

  public function index()
  {
    $this->load->page("pelayanan/pesanan_produk", [
      "is_admin" => $this->is_admin,
    ])->layout("dashboard_layout", [
      "title" => "Pelayanan Produk",
      "nav" => $this->load->component($this->is_admin ? "layout/nav_admin" : "layout/nav_pelayanan")
    ]);
  }

  public function datatable_pesanan_produk()
  {
    $produk = new PesananProdukDatatable();

    $lists = $produk->getData();
    $data = array();
    $no = R_Input::pos('start');
    $n = 1;
    foreach ($lists as $list) {
      $no++;
      $row = array();
      $row[] = $no;
      $row[] = $list->nomor_perkara;
      $row[] = $list->nomor_akta_cerai;
      $row[] = $list->nama_pengambil . "<br>(" . $list->jenis_pihak . ")";
      $row[] = $list->jenis_produk;
      $row[] = $list->jenis_perkara;
      $row[] = $this->load->component("table/pilihan_pesanan_produk", ["data" => $list]);
      $data[] = $row;
    }
    $output = array(
      "draw" => R_Input::pos('draw'),
      "recordsTotal" => $produk->countData(),
      "recordsFiltered" => $produk->countData(),
      "data" => $data,
    );
    // Output to json format
    echo json_encode($output);
  }

  public function edit($id = null)
  {
    $this->load->page("pelayanan/edit_produk", [
      "is_admin" => $this->is_admin,
      "data" => ProdukPengadilan::findOrFail(Cypher::urlsafe_decrypt($id))

    ])->layout("dashboard_layout", [

      "title" => "Pelayana Produk",
      "nav" => $this->load->component($this->is_admin ? "layout/nav_admin" : "layout/nav_pelayanan")
    ]);
  }

  public function update($id = null)
  {
    R_Input::mustPost();

    try {

      $produk = ProdukPengadilan::findOrFail(Cypher::urlsafe_decrypt($id));

      $filename = !$produk->foto_pengambil ? $this->save_foto_pengambil() : $produk->foto_pengambil;

      $produk->update(
        R_Input::pos()->except('foto_pengambil')->all() +
          ['foto_pengambil' => $filename, 'status' => 1]
      );


      if (R_Input::ci()->request_headers()["Accept"] == "application/json") {
        echo json_encode(["status" => true, "message" => "Produk Updated"]);
        return set_status_header(200);
      }

      return Redirect::wfa([
        "message" => "Update Produk Success",
        "text" => "😎",
        "type" => "success",
      ])->go('/pelayanan_produk');
    } catch (\Throwable $th) {
      if (R_Input::ci()->request_headers()["Accept"] == "application/json") {
        echo json_encode(["status" => false, "message" => $th->getMessage()]);
        return set_status_header(400);
      }

      return Redirect::wfe($th->getMessage())->go($_SERVER['HTTP_REFERER']);
    }
  }

  private function save_foto_pengambil()
  {

    $config['upload_path'] = './uploads/pengambil/';
    $config['allowed_types'] = 'gif|jpg|png|jpeg';
    $config['encrypt_name'] = true;

    $this->load->library('upload', $config);

    if (!$this->upload->do_upload('foto_pengambil')) {
      throw new Exception($this->upload->display_errors(), 1);
    }

    return $this->upload->data('file_name');
  }

  public function panggil_pihak()
  {
    R_Input::mustPost();
    try {
      $pengumuman = Pengumuman::where("judul", "pihak-ke-ruang-tunggu")->first();
      if (!$pengumuman) {
        set_status_header(404);
        throw new \Exception("Pengumuman tidak ditemukan");
      }

      $textPengumuman = str_replace("{nama_pihak}", R_Input::pos("pihak"), $pengumuman->template);


      $textPengumuman = str_replace("ruang tunggu persidangan", "loket produk", $textPengumuman);
      $textPengumuman = str_replace("masuk ", "", $textPengumuman);


      Broadcast::pusher()->trigger("produk-channel", "panggil-pihak", $textPengumuman);

      echo json_encode(["status" => true, "message" => "Panggilan berhasil dikirim. Silahkan tunggu sampai panggilan selesai dibacakan"]);

      Redirect::wfa(["message" => "Sedang memanggil", "text" => "mohon tunggu", "type" => "info"])->go("/pelayanan_produk");
    } catch (\Throwable $th) {
      echo $th->getMessage();
    }
  }

  public function tambah()
  {
    $this->load->page("pelayanan/tambah_produk")->layout("dashboard_layout", [
      "title" => "Pelayana Produk | Tambah Produk",
      "nav" => $this->load->component($this->is_admin ? "layout/nav_admin" : "layout/nav_pelayanan")
    ]);
  }

  public function save()
  {
    R_Input::mustPost();
    try {

      $data = R_Input::pos()->toArray();

      $data["tahun_perkara"] = explode("/", $data["nomor_perkara"])[2];
      $data["foto_pengambil"] = $this->save_foto_pengambil();
      $data["perkara_id"] = Cypher::urlsafe_decrypt($data["perkara_id"]);

      $produk = ProdukPengadilan::create($data);

      if (R_Input::ci()->request_headers()["Accept"] == "application/json") {
        echo json_encode(
          ["status" => true, "message" => "Produk Created", "data" => $produk]
        );

        return set_status_header(200);
      }

      return Redirect::wfa([
        "message" => "Create Produk Success",
        "text" => "😎",
        "type" => "success",
      ])->go('/pelayanan_produk');
    } catch (\Throwable $th) {
      if (R_Input::ci()->request_headers()["Accept"] == "application/json") {
        echo json_encode(["status" => false, "message" => $th->getMessage()]);
        return set_status_header(400);
      }

      return Redirect::wfe($th->getMessage())->go($_SERVER['HTTP_REFERER']);
    }
  }

  public function nomor_perkara_autocomplete()
  {
    $params = R_Input::gett("query");

    $nomorPerkaraResults = $this->eloquent
      ->connection("sipp")
      ->table("perkara")
      ->select(["perkara.perkara_id", "perkara.jenis_perkara_text", "nomor_perkara", "nomor_akta_cerai"])
      ->leftJoin("perkara_akta_cerai", "perkara_akta_cerai.perkara_id", "=", "perkara.perkara_id")
      ->where("nomor_perkara", "LIKE", "$params%")
      ->limit(10)
      ->latest("perkara.diinput_tanggal")
      ->get();

    $dataParseResult = $nomorPerkaraResults->map(function ($item) {
      $item->perkara_id = Cypher::urlsafe_encrypt($item->perkara_id);
      return $item;
    })->all();

    header("Content-Type: application/json");
    echo json_encode($dataParseResult);
  }
}
