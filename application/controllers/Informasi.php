<?php

class Informasi extends R_Controller
{
  private function perkara_data_umum($perkara_id)
  {
    return Perkara::find($perkara_id);
  }

  public function perkara_data_umum_w_view($perkara_id)
  {
    echo $this->load->component("table/perkara_data_umum", ["data" => $this->perkara_data_umum($perkara_id)]);
  }

  public function perkara_jadwal_sidang_w_view($perkara_id)
  {
    echo $this->load->component("table/perkara_jadwal_sidang", ["data" => $this->perkara_data_umum($perkara_id)->jadwal_sidang]);
  }

  public function perkara_biaya_w_view($perkara_id)
  {
    echo $this->load->component("table/perkara_biaya", ["data" => PerkaraBiaya::where("perkara_id", $perkara_id)->get()]);
  }

  public function para_pihak_perkara()
  {
    R_Input::mustPost();
    try {
      $perkara = Perkara::where("nomor_perkara", R_Input::json('nomor_perkara'))->with('pihak_satu')->with('pihak_dua')->first();
      if (!$perkara) {
        throw new Exception("Data tidak ditemukan", 1);
      }
      if (R_Input::ci()->request_headers()["Accept"] == "application/json") {
        echo json_encode([
          "data" => $perkara,
          "timestamp" => date("Y-m-d H:i:s"),
          "message" => "Data perkara berhasil diambil",
        ]);
      }
    } catch (\Throwable $th) {
      set_status_header(400);
      echo json_encode([
        "data" => null,
        "timestamp" => date("Y-m-d H:i:s"),
        "message" => $th->getMessage(),
      ]);
    }
  }
}
