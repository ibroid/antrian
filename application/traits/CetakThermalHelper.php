<?php

use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;

trait CetakThermalHelper
{
  private function print_antrian_ptsp($data, $ip, $port)
  {
    if ($_ENV["DEBUG_PRINT"] == "true") {
      return [true, "Antrian tidak akan dicetak jika dalam mode debug print."];
    }

    try {
      $connector = new NetworkPrintConnector($ip, $port, 2);
      $printer = new Printer($connector);
      $printer->initialize();

      $printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
      $printer->setJustification(Printer::JUSTIFY_CENTER);
      $printer->setFont(Printer::FONT_A);

      if ($_ENV["DEBUG"] == "true") {
        $printer->text("TEST UJI COBA\n");
      }

      $printer->text("Pengadilan Agama\n Jakarta Utara \n");
      $printer->text("------------------------\n");
      $printer->text($data->tujuan);
      $printer->text("\n");
      $printer->setTextSize(5, 4);
      $printer->text($data->kode . "-" . $data->nomor_urutan);
      $printer->text("\n");
      $printer->setTextSize(1, 1);

      if ($data->pesanan_produk) {
        $printer->text("Yang Mengambil Antrian : " . $data->pesanan_produk->nama_pengambil ?? "");
      }

      $printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
      $printer->setJustification(Printer::JUSTIFY_CENTER);
      $printer->setTextSize(1, 1);
      $printer->text("Di ambil:" . date('Y-m-d H:i:S') . " \n");

      // $printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
      // $printer->setJustification(Printer::JUSTIFY_CENTER);
      // $printer->setFont(Printer::FONT_A);
      // $printer->text("------------------------\n");

      // $printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
      // $printer->setJustification(Printer::JUSTIFY_CENTER);
      // $printer->qrCode(base_url("/mobile?antrian_ptsp=" . Cypher::urlsafe_encrypt($data->id)), Printer::QR_ECLEVEL_L, 7, Printer::QR_MODEL_2);
      // $printer->text("\n");
      // $printer->setTextSize(1, 1);
      // $printer->text("Scan QR Code di atas untuk mengetahui antrian berjalan secara online\n");

      $printer->cut();
      $printer->pulse();
      $printer->close();
    } catch (\Throwable $th) {
      return [false, "Gagal cetak antrian. Masin antrian mati/tidak terhubung. " . $th->getMessage()];
    }

    return [true, "Antrian berhasil dicetak"];
  }

  private function print_antrian_sidang($data, $ip, $port)
  {
    if ($_ENV["DEBUG_PRINT"] == "true") {
      return [true, "Antrian tidak akan dicetak jika dalam mode debug print."];
    }

    try {
      $connector = new NetworkPrintConnector($ip, $port, 2);
      $printer = new Printer($connector);
      $printer->initialize();

      $printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
      $printer->setJustification(Printer::JUSTIFY_CENTER);

      if ($_ENV["DEBUG"] == "true") {
        $printer->text("TEST UJI COBA\n");
      }
      $printer->text("Pengadilan Agama\n Jakarta Utara \n");
      $printer->text("------------------------\n");
      $printer->setTextSize(1, 1);
      $printer->text("Persidangan di " . $data->nama_ruang);
      $printer->text("\n");
      $printer->text("Nomor Antrian");
      $printer->text("\n");
      $printer->setTextSize(5, 4);
      $printer->text($data->nomor_urutan);
      $printer->text("\n");
      $printer->setTextSize(1, 1);
      $printer->text($data->nomor_perkara);
      $printer->text("\n");
      $printer->text("Yang Mengambil Antrian : " . R_Input::pos("nama_yang_ambil")) . "(" . R_Input::pos("yang_ambil") . ")\n";
      $printer->text("\n");

      $printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
      $printer->setJustification(Printer::JUSTIFY_CENTER);
      $printer->setTextSize(1, 1);
      $printer->text("Di ambil:" . date('Y-m-d H:i:S') . " \n");

      // $printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
      // $printer->setJustification(Printer::JUSTIFY_CENTER);
      // $printer->setFont(Printer::FONT_A);
      // $printer->text("------------------------\n");

      // $printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
      // $printer->setJustification(Printer::JUSTIFY_CENTER);
      // $printer->qrCode(base_url("/mobile?antrian_sidang=" . Cypher::urlsafe_encrypt($data->id)), Printer::QR_ECLEVEL_L, 7, Printer::QR_MODEL_2);
      // $printer->text("\n");
      // $printer->setTextSize(1, 1);
      // $printer->text("Scan QR Code di atas untuk mengetahui antrian berjalan secara online\n");

      $printer->cut();
      /* Pulse */
      $printer->pulse();

      $printer->close();

      return [true, "Berhasil mencetak antrian sidang"];
    } catch (\Throwable $th) {
      return [false, "Terjadi kesalahan saat mencetak antrian sidang. " . $th->getMessage()];
    }
  }
}
