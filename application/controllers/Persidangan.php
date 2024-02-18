<?php

class Persidangan extends R_Controller
{
  public function index()
  {
    $this->antrian_sidang();
    $this->load->library("addons");
  }

  public function antrian_sidang()
  {
    $this->addons->init([
      "js" => [
        "<script src=\"https://cdn.jsdelivr.net/npm/sweetalert2@11\"></script>\n"
      ]
    ]);

    $this->load->page("persidangan/antrian_sidang", [
      "pagename" => "Monitor Petugas Sidang",
      "antrian" => AntrianPersidangan::whereDate("created_at", date("Y-m-d"))->latest()->get()
    ])->layout("dashboard_layout");
  }

  public function fetch_modal_antrian()
  {
    R_Input::mustPost();

    $data = AntrianPersidangan::find(R_Input::pos("id"));

    echo $this->load->component("modal/antrian_sidang", compact("data"));
  }

  public function update_antrian($id)
  {
    R_Input::mustPost();
    try {
      $data = AntrianPersidangan::find($id);
      $data->update(R_Input::pos());
      echo json_encode(["status" => true, "message" => "Berhasil mengubah data"]);
    } catch (\Throwable $th) {
      set_status_header(400);
      echo json_encode(["status" => false, "message" => $th->getMessage()]);
    }
  }
}
