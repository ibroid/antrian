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


if (!function_exists("penyebut")) {
  function penyebut($nilai)
  {
    $nilai = abs($nilai);
    $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
    $temp = "";
    if ($nilai < 12) {
      $temp = " " . $huruf[$nilai];
    } else if ($nilai < 20) {
      $temp = penyebut($nilai - 10) . " belas";
    } else if ($nilai < 100) {
      $temp = penyebut($nilai / 10) . " puluh" . penyebut($nilai % 10);
    } else if ($nilai < 200) {
      $temp = " seratus" . penyebut($nilai - 100);
    } else if ($nilai < 1000) {
      $temp = penyebut($nilai / 100) . " ratus" . penyebut($nilai % 100);
    } else if ($nilai < 2000) {
      $temp = " seribu" . penyebut($nilai - 1000);
    } else if ($nilai < 1000000) {
      $temp = penyebut($nilai / 1000) . " ribu" . penyebut($nilai % 1000);
    } else if ($nilai < 1000000000) {
      $temp = penyebut($nilai / 1000000) . " juta" . penyebut($nilai % 1000000);
    } else if ($nilai < 1000000000000) {
      $temp = penyebut($nilai / 1000000000) . " milyar" . penyebut(fmod($nilai, 1000000000));
    } else if ($nilai < 1000000000000000) {
      $temp = penyebut($nilai / 1000000000000) . " trilyun" . penyebut(fmod($nilai, 1000000000000));
    }
    return $temp;
  }
}

if (!function_exists("terbilang")) {
  function terbilang($nilai)
  {
    if ($nilai < 0) {
      $hasil = "minus " . trim(penyebut($nilai));
    } else {
      $hasil = trim(penyebut($nilai));
    }
    return $hasil;
  }
}

if (!function_exists("read_uploaded_file")) {
  function read_uploaded_file($folder, $filename)
  {
    $file_path = realpath('./uploads/' . $folder . '/' . $filename);

    if (file_exists($file_path)) {
      header('Content-Type: ' . mime_content_type($file_path));
      header('Content-Length: ' . filesize($file_path));
      readfile($file_path);
      exit;
    } else {
      header("HTTP/1.0 404 Not Found");
      echo "File not found!";
    }
  }
}

if (!function_exists("delete_all_temporary")) {
  function delete_all_temporary()
  {
    try {
      $ci = &get_instance();
      $ci->eloquent->table("temporary_data")->delete();
      $folder_path = "./uploads/temp";

      $files = glob($folder_path . '/*');
      foreach ($files as $file) {

        if (is_file($file))
          unlink($file);
      }
      echo "ok";
    } catch (\Throwable $th) {
      set_status_header(500);
      echo $th->getMessage();
    }
  }
}
