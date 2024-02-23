<?php

if (!function_exists('tanggal_indo')) {
  function tanggal_indo($YmdDate = null)
  {
    if ($YmdDate == null) return null;

    $bulan = array(
      1 =>   'Januari',
      'Februari',
      'Maret',
      'April',
      'Mei',
      'Juni',
      'Juli',
      'Agustus',
      'September',
      'Oktober',
      'November',
      'Desember'
    );
    $pecahkan = explode('-', $YmdDate);

    // variabel pecahkan 0 = tanggal
    // variabel pecahkan 1 = bulan
    // variabel pecahkan 2 = tahun

    return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
  }
}


if (!function_exists('rupiah')) {
  function rupiah($angka = null)
  {
    if ($angka == null) {
      return null;
    }
    $hasil_rupiah = "Rp " . number_format($angka, 0, ',', '.');
    return $hasil_rupiah;
  }
}
