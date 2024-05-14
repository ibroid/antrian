<?php

class Pesanan_produk extends R_Controller
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

  public function index()
  {
    $this->load->page("pelayanan/pelayanan_produk", [
      "is_admin" => $this->is_admin,
    ])->layout("dashboard_layout", [
      "title" => "Antrian Pelayanan",
      "nav" => $this->load->component("layout/nav_pelayanan")
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
      $row[] = $list->nama_pengambil;
      $row[] = $list->jenis_produk;
      $row[] = "";
      $row[] = "";
      // $row[] = $this->load->component("table/pilihan_antrian_pelayanan", ["data" => $list]);
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
}
