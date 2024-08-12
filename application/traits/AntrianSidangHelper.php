<?php

trait AntrianSidangHelper
{
  private function ambil_antrian_sidang(Perkara $perkara)
  {
    $lastSidang = $perkara->jadwal_sidang->last();

    if ($lastSidang->tanggal_sidang !== date("Y-m-d")) {
      throw new Exception("Tidak ada jadwal sidang untuk perkara ini");
    }

    $data = AntrianPersidangan::firstOrCreate([
      "nomor_perkara" => $perkara->nomor_perkara,
      "tanggal_sidang" => date("Y-m-d"),
    ],  [
      'status' => 0,
      'nomor_urutan' =>  floatval($this->nomor_urut_sidang_terakhir(
        $lastSidang->ruangan_id
      ))  + 1,
      'nomor_ruang' => $lastSidang->ruangan_id,
      'nama_ruang' => $lastSidang->ruangan,
      'nomor_perkara' => $perkara->nomor_perkara,
      'tanggal_sidang' => $lastSidang->tanggal_sidang,
      'majelis_hakim' => $perkara->penetapan->majelis_hakim_nama,
      'jadwal_sidang_id' => $lastSidang->id,
    ]);

    return $data;
  }

  private function nomor_urut_sidang_terakhir($ruang)
  {
    $qrcMaxAntrian = AntrianPersidangan::whereDate("created_at", date("Y-m-d"))->where("nomor_ruang", $ruang)->max('nomor_urutan');

    return $qrcMaxAntrian;
  }
}
