<?php

if (!function_exists("form_ambil_antrian_sidang")) {
  function form_ambil_antrian_sidang($ds, $yang_ambil, $nama_pihak)
  {
    $actionUrl = base_url('/ambil/ambil_antrian_sidang');
    return ' <form onsubmit="disableAfterSubmit(this)" action="' . $actionUrl . '" style="width: 500px;" class="my-3" method="POST">
    <input type="hidden" name="perkara_id" value="' . $ds->perkara_id . '">
    <input type="hidden" name="nomor_ruang" value="' . $ds->ruangan_id . '">
    <input type="hidden" name="nama_ruang" value="' . $ds->ruangan . '">
    <input type="hidden" name="nomor_perkara" value="' . $ds->perkara->nomor_perkara . '">
    <input type="hidden" name="tanggal_sidang" value="' . $ds->tanggal_sidang . '">
    <input type="hidden" name="jadwal_sidang_id" value="' . $ds->id . '">
    <input type="hidden" name="nama_yang_ambil" value="' . $nama_pihak . '">
    <input type="hidden" name="majelis_hakim" value="' . $ds->perkara->penetapan->majelis_hakim_nama . '">
    <button type="submit" name="yang_ambil" value="' . $yang_ambil . '" class="btn btn-success">' . $nama_pihak . '</button></form>';
  }
}

if (!function_exists("form_ambil_antrian_sidang_secondary")) {
  function form_ambil_antrian_sidang_secondary($ds, $yang_ambil, $nama_pihak)
  {
    $actionUrl = base_url('/ambil/ambil_antrian_sidang?secondary=true');
    return ' <form onsubmit="disableAfterSubmit(this)" action="' . $actionUrl . '" style="width: 500px;" class="my-3" method="POST">
    <input type="hidden" name="perkara_id" value="' . $ds->perkara_id . '">
    <input type="hidden" name="nomor_ruang" value="' . $ds->ruangan_id . '">
    <input type="hidden" name="nama_ruang" value="' . $ds->ruangan . '">
    <input type="hidden" name="nomor_perkara" value="' . $ds->perkara->nomor_perkara . '">
    <input type="hidden" name="tanggal_sidang" value="' . $ds->tanggal_sidang . '">
    <input type="hidden" name="jadwal_sidang_id" value="' . $ds->id . '">
    <input type="hidden" name="nama_yang_ambil" value="' . $nama_pihak . '">
    <input type="hidden" name="majelis_hakim" value="' . $ds->perkara->penetapan->majelis_hakim_nama . '">
    <button type="submit" name="yang_ambil" value="' . $yang_ambil . '" class="btn btn-success">' . $nama_pihak . '</button></form>';
  }
}

if (!function_exists("badge_status_antrian_sidang")) {
  function badge_status_antrian_sidang($status)
  {
    $typeAndMessage = [
      ["type" => "danger", "message" => "Belum Dipanggil"],
      ["type" => "danger", "message" => "Menunggu Di Ruang Tunggu"],
      ["type" => "info", "message" => "Di Ruang Sidang"],
      ["type" => "success", "message" => "Sudah Di Panggil"],
      ["type" => "dark", "message" => "Di Skors"],
    ];
    $ci = &get_instance();
    return  $ci->load->component("badge/badge_status_antrian_sidang", $typeAndMessage[$status]);
  }
}

if (!function_exists("badge_nama_ruang_sidang")) {
  function badge_nama_ruang_sidang($ruang_id)
  {
    $typeAndName = [
      ["type" => "primary", "name" => "Ruang Umar"],
      ["type" => "warning", "name" => "Ruang Abu Musa"],
      ["type" => "secondary", "name" => "Ruang Syuarih"],
    ];
    $ci = &get_instance();
    return  $ci->load->component("badge/badge_nama_ruang_sidang", $typeAndName[$ruang_id - 1]);
  }
}
