<?php

use Illuminate\Support\Facades\Redis;

class Bank_gugatan extends R_Controller
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
        "<link rel=\"stylesheet\" type=\"text/css\" href=\"https://unpkg.com/browse/toastify-js@1.12.0/src/toastify.css\">\n"
      ]
    ]);
  }

  public function index()
  {
    $this->load->page("pelayanan/bank_gugatan", [
      "is_admin" => $this->is_admin,
      "data" => BankGugatan::whereDate("created_at", date('Y-m-d'))->latest(),
    ])->layout("dashboard_layout", [
      "title" => "Bank Gugatan",
      "nav" => $this->load->component("layout/nav_pelayanan")
    ]);
  }

  public function simpan()
  {
    R_Input::pos();
    try {
      $data = BankGugatan::create([
        'nama_pihak' => R_Input::pos('nama_pihak'),
        'filename' => $this->upload_file()
      ]);

      if (R_Input::ci()->request_headers(TRUE)["Accept"] == "application/json") {
        echo json_encode([
          'data' => $data, 'message' => 'Berhasil mengupload filename'
        ]);

        return set_status_header(200);
      }

      return Redirect::wfa(['message' => 'Berhasil mengupload', 'status' => 'success', 'text' => 'Mantap'])->go($_SERVER['HTTP_REFERER']);
    } catch (\Throwable $th) {

      if (R_Input::ci()->request_headers(TRUE)["Accept"] == "application/json") {
        echo json_encode([
          "data" => null, "message" => $th->getMessage()
        ]);

        return set_status_header(500);
      }

      return Redirect::wfe($th->getMessage())->go($_SERVER['HTTP_REFERER']);
    }
  }

  private function upload_file()
  {

    $config['upload_path'] = './uploads/gugatan/';
    $config['allowed_types'] = 'doc|docx|pdf|rtf';
    $config['encrypt_name'] = TRUE;

    $this->load->library('upload', $config);

    if (!$this->upload->do_upload('filename')) {
      throw new Exception($this->upload->display_errors(), 1);
    } else {
      return  $this->upload->data('file_name');
    }
  }

  public function datatable_bank_gugatan()
  {
    $bank_gugatan = new BankGugatanDatatable();

    $lists = $bank_gugatan->getData();
    $data = array();
    $no = R_Input::pos('start');
    $n = 1;
    foreach ($lists as $list) {
      $no++;
      $row = array();
      $row[] = $no;
      $row[] = $list->nama_pihak;
      $row[] = $this->load->component("table/download_file_gugatan", ["filename" => $list->filename]);
      $data[] = $row;
    }
    $output = array(
      "draw" => R_Input::pos('draw'),
      "recordsTotal" => $bank_gugatan->countData(),
      "recordsFiltered" => $bank_gugatan->countData(),
      "data" => $data,
    );
    // Output to json format
    echo json_encode($output);
  }
}
