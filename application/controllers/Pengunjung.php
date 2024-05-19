<?php

class Pengunjung extends R_Controller
{

  public function __construct()
  {
    parent::__construct();
    $flatpickerResourceJs = base_url('/assets/js/flat-pickr/flatpickr.js');
    $flatpickerResourceCss = base_url('/assets/css/vendors/flatpickr/flatpickr.min.css');

    $this->addons->init([
      "js" => [
        "<script src=\"$flatpickerResourceJs\"></script>\n"
      ],
      "css" => [
        "<link rel=\"stylesheet\"  type=\"text/css\" href=\"$flatpickerResourceCss\">"
      ]
    ]);
  }

  public function index()
  {
    $this->load->page("pengunjung/daftar_pengunjung")->layout("dashboard_layout", [
      "title" => "Daftar Pengunjung",
      "nav" => $this->load->component($this->is_admin ? "layout/nav_admin" : "layout/nav_pelayanan")
    ]);
  }

  public function datatable_pengunjung()
  {
    $pengunjungDatatable = new PengunjungDatatable();


    $lists = $pengunjungDatatable->getData();
    $data = array();
    $no = R_Input::pos('start');
    $n = 1;
    foreach ($lists as $list) {
      $no++;
      $row = array();
      $row[] = $no;
      $row[] = $list->nama_lengkap;
      $row[] = $list->nik;
      $row[] = $list->jenis_kelamin;
      $row[] = $list->alamat;
      $row[] = $this->load->component("table/pilihan_data_pengunjung", ["data" => $list]);
      $data[] = $row;
    }
    $output = array(
      "draw" => R_Input::pos('draw'),
      "recordsTotal" => $pengunjungDatatable->countData(),
      "recordsFiltered" => $pengunjungDatatable->countData(),
      "data" => $data,
    );
    // Output to json format
    echo json_encode($output);
  }

  public function edit($id = null)
  {
    $data = IdentitasPihak::findOrFail(Cypher::urlsafe_decrypt($id));

    $this->load->page("pengunjung/edit_pengunjung", compact("data"))->layout("dashboard_layout", [
      "title" => "Edit Pengunjung",
      "nav" => $this->load->component($this->is_admin ? "layout/nav_admin" : "layout/nav_pelayanan")
    ]);
  }

  public function update($id = null)
  {

    R_Input::mustPost();

    try {
      if (!R_Input::pos('tanggal_lahir')) {
        throw new Exception("Tanggal Lahir Kosong");
      }

      $pihak = IdentitasPihak::findOrFail(Cypher::urlsafe_decrypt($id));

      if (!$_FILES['foto']['name']) {
        $pihak->update(R_Input::pos()->toArray());
      } else {
        $foto = $this->save_foto_pihak();
        $pihak->update(R_Input::pos()->except("foto")->all() + ['foto' => $foto]);
      }


      if (R_Input::ci()->request_headers()["Accept"] == "application/json") {
        echo json_encode([
          "status" => true,
          "message" => "Berhasil mengubah data pengunjung",
          "data" => $pihak
        ]);
        return set_status_header(200);
      }

      return Redirect::wfa([
        "message" => "Berhasil mengubah data pengunjung",
        "text" => "Berhasil",
        "type" => "success",
      ])->go("/pengunjung");
    } catch (\Throwable $th) {
      if (R_Input::ci()->request_headers()["Accept"] == "application/json") {
        echo json_encode([
          "status" => false,
          "message" => $th->getMessage()
        ]);
        return set_status_header(400);
      }
      return Redirect::wfe($th->getMessage())->go($_SERVER["HTTP_REFERER"]);
    }
  }


  private function save_foto_pihak()
  {

    $config['upload_path'] = './uploads/pihak/';
    $config['allowed_types'] = 'gif|jpg|png|jpeg';
    $config['encrypt_name'] = true;

    $this->load->library('upload', $config);

    if (!$this->upload->do_upload('foto')) {
      throw new Exception("Upload Error : " . $this->upload->display_errors(), 1);
    }

    return $this->upload->data('file_name');
  }

  public function tambah()
  {
    $this->load->page("pengunjung/tambah_pengunjung")->layout("dashboard_layout", [
      "title" => "Tambah Pengunjung",
      "nav" => $this->load->component($this->is_admin ? "layout/nav_admin" : "layout/nav_pelayanan")
    ]);
  }

  public function save()
  {
    R_Input::mustPost();

    try {
      if (!R_Input::pos('tanggal_lahir')) {
        throw new Exception("Tanggal Lahir Kosong");
      }


      if (!$_FILES['foto']['name']) {
        $pihak = IdentitasPihak::create(R_Input::pos()->toArray());
      } else {
        $foto = $this->save_foto_pihak();
        $pihak = IdentitasPihak::create(R_Input::pos()->except("foto")->all() + ['foto' => $foto]);
      }


      if (R_Input::ci()->request_headers()["Accept"] == "application/json") {
        echo json_encode([
          "status" => true,
          "message" => "Berhasil menambah data pengunjung",
          "data" => $pihak
        ]);
        return set_status_header(200);
      }

      return Redirect::wfa([
        "message" => "Berhasil menambah data pengunjung",
        "text" => "Berhasil",
        "type" => "success",
      ])->go("/pengunjung");
    } catch (\Throwable $th) {
      if (R_Input::ci()->request_headers()["Accept"] == "application/json") {
        echo json_encode([
          "status" => false,
          "message" => $th->getMessage()
        ]);
        return set_status_header(400);
      }
      return Redirect::wfe($th->getMessage())->go($_SERVER["HTTP_REFERER"]);
    }
  }
}
