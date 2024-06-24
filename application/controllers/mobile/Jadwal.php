<?php
class Jadwal extends R_MobileController
{
  public function page()
  {
    $this->pageRender("jadwal_page", [
      "data" => PerkaraJadwalSidang::with(['perkara', 'antrian_sidang'])->whereDate('tanggal_sidang', date('Y-m-d'))->get(),
      "title" => "Jadwal Sidang"
    ]);
  }
}
