<?php

use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;

trait BridgeThermalHelper
{
  private function bridge_antrian_ptsp($data, $ip, $port)
  {
    try {
      $curl = curl_init();

      $body = [
        "type" => "pelayanan",
        "tujuan" => $data->tujuan,
        "nomor_urutan" => $data->nomor_urutan,
        "kode" => $data->kode
      ];

      if ($data->pesanan_produk) {
        $body["pesanan_produl"] = $data->pesanan_produk;
        $body["nama_pengambil"] = $data->pesanan_produk->nama_pengambil;
      }

      curl_setopt_array($curl, [
        // CURLOPT_PORT => "8080",
        CURLOPT_URL => "http://$ip:$port/",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS =>  http_build_query($body),
        CURLOPT_HTTPHEADER => [
          "Content-Type: application/x-www-form-urlencoded",
          "User-Agent: insomnia/10.3.1"
        ],
      ]);

      curl_exec($curl);
      $err = curl_error($curl);
      curl_close($curl);

      if ($err) {
        throw new Exception($err, 1);
      }
    } catch (\Throwable $th) {
      return [false, "Gagal cetak antrian. Masin antrian mati/tidak terhubung. " . $th->getMessage()];
    }

    return [true, "Antrian berhasil dicetak"];
  }

  private function bridge_antrian_sidang($data, $ip, $port)
  {
    try {
      $curl = curl_init();

      $body = [
        'type' => 'persidangan',
        'nama_ruang' => $data->nama_ruang,
        'nomor_urutan' => $data->nomor_urutan,
        'nomor_perkara' => $data->nomor_perkara,
        'nama_yang_ambil' => R_Input::pos("nama_yang_ambil"),
        'yang_ambil' => R_Input::pos("yang_ambil")
      ];

      curl_setopt_array($curl, [
        // CURLOPT_PORT => "8080",
        CURLOPT_URL => "http://$ip:$port/",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => http_build_query($body),
        CURLOPT_HTTPHEADER => [
          "Content-Type: application/x-www-form-urlencoded",
          "User-Agent: insomnia/10.3.1"
        ],
      ]);

      curl_exec($curl);
      $err = curl_error($curl);
      curl_close($curl);

      if ($err) {
        throw new Exception($err, 1);
      }

      return [true, "Berhasil mencetak antrian sidang"];
    } catch (\Throwable $th) {
      return [false, "Terjadi kesalahan saat mencetak antrian sidang. " . $th->getMessage()];
    }
  }
}
