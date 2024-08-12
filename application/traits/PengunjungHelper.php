<?php

trait PengunjungHelper
{
  private function pengunjung_save_from_post(): Pengunjung
  {
    return Pengunjung::updateOrCreate([
      "nik" => R_Input::pos('nik')
    ], [
      'nama_lengkap' => R_Input::pos('nama_lengkap'),
      'jenis_kelamin' => R_Input::pos('jenis_kelamin'),
      'nik' => R_Input::pos('nik'),
      'pekerjaan' => R_Input::pos('pekerjaan'),
      'pendidikan' => R_Input::pos('pendidikan'),
      'tempat_lahir' => R_Input::pos('tempat'),
      'tanggal_lahir' => R_Input::pos('tanggal_lahir'),
      'provinsi' => R_Input::pos('provinsi'),
      'kota' => R_Input::pos('kota'),
      'kecamatan' => R_Input::pos('kecamatan'),
      'kelurahan' => R_Input::pos('kelurahan'),
      'alamat' => R_Input::pos('alamat'),
      'foto' => R_Input::pos('temp_photo'),
      'ktp' => R_Input::pos('temp_img'),
    ]);
  }

  private function update_serial($pengunjung_id)
  {
    if (strlen(R_Input::pos('serial_id')) > 0) {
      $this->eloquent->table('serial_number')->updateOrInsert(
        [
          'serial_id' => R_Input::pos('serial_id'),
        ],
        [
          'pengunjung_id' => $pengunjung_id
        ]
      );
    }
  }
}
