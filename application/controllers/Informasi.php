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
}
