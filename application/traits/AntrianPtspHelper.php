<?php

trait AntrianPtspHelper
{
  public  $daftarTujuan = [
    "PENDAFTARAN" => "A",
    "ECOURT" => "A",
    "INFORMASI" => "A",
    "KASIR" => "B",
    "POSBAKUM" => "C",
    "PRODUK" => "A",
  ];

  private function ambil_antrian_ptsp($tujuan, $pengunjung_id = null)
  {
    $kode =  $this->daftarTujuan[R_Input::pos('tujuan')];

    $lastNomorAntrianPtsp = AntrianPtsp::where([
      "kode" => $kode,
    ])->whereDate("created_at", date("Y-m-d"))->max("nomor_urutan");

    $newAntrianPtsp = AntrianPtsp::create([
      "tujuan" => $tujuan,
      "kode" => $kode,
      "nomor_urutan" => $lastNomorAntrianPtsp ? $lastNomorAntrianPtsp + 1 : 1,
      "status" => 0,
      "pengunjung_id" => $pengunjung_id
    ]);

    return $newAntrianPtsp;
  }
}
