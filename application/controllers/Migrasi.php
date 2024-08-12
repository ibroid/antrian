<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Migrasi extends R_Controller
{
  public function index()
  {
    echo "disable";
    die;
    $data = $this->getDataPihakProduk(8, 2024);
    $this->execPihakProduk($data);
  }

  private function execPihakBaru($data)
  {
    try {
      foreach ($data as $n => $d) {
        if ($d->nomor_indentitas && strlen($d->nomor_indentitas) < 17) {
          $pengunjung = Pengunjung::updateOrCreate(
            [
              'nik' => $d->nomor_indentitas,
            ],
            [
              'nama_lengkap' => $this->removeBinBinti($d->nama),
              'jenis_kelamin' => $d->jenis_kelamin,
              'pekerjaan' => $d->pekerjaan,
              'pendidikan' => $d->pendidikan,
              'tempat_lahir' => $d->tempat_lahir,
              'tanggal_lahir' => $d->tanggal_lahir == '0000-00-00' ? null : $d->tanggal_lahir,
              'provinsi' => $d->provinsi,
              'kota' => $d->kabupaten,
              'kecamatan' => $d->kecamatan,
              'kelurahan' => $d->kelurahan,
              'alamat' => $d->alamat
            ]
          );

          $pengunjung->kunjungan()->create([
            "tanggal_kunjungan" => $d->tanggal_pendaftaran,
            "status_pengunjung" => 'Pihak Baru',
            "tujuan_kunjungan" => 'Pendaftaran'
          ]);
        }

        echo "Insert OK. Pihak_ID : $d->id. Perkara_ID : $d->perkara_id. Tanggal Daftar : $d->tanggal_pendaftaran. Nama : $d->nama <br>";
      }
      $this->eloquent->connection("default")->commit();
    } catch (\Throwable $th) {
      $this->eloquent->connection("default")->rollback();
      throw $th;
    }
  }

  private function execPihakSidang($data)
  {
    try {
      foreach ($data as $n => $d) {
        if ($d->nomor_indentitas && strlen($d->nomor_indentitas) < 17) {
          $pengunjung = Pengunjung::updateOrCreate(
            [
              'nik' => $d->nomor_indentitas,
            ],
            [
              'nama_lengkap' => $this->removeBinBinti($d->nama),
              'jenis_kelamin' => $d->jenis_kelamin,
              'pekerjaan' => $d->pekerjaan,
              'pendidikan' => $d->pendidikan,
              'tempat_lahir' => $d->tempat_lahir,
              'tanggal_lahir' => $d->tanggal_lahir == '0000-00-00' ? null : $d->tanggal_lahir,
              'provinsi' => $d->provinsi,
              'kota' => $d->kabupaten,
              'kecamatan' => $d->kecamatan,
              'kelurahan' => $d->kelurahan,
              'alamat' => $d->alamat
            ]
          );

          $pengunjung->kunjungan()->create([
            "tanggal_kunjungan" => $d->tanggal_sidang,
            "status_pengunjung" => 'Pihak Berperkara',
            "tujuan_kunjungan" => 'Sidang'
          ]);
        }

        echo "Insert OK. Pihak_ID : $d->id. Perkara_ID : $d->perkara_id. Tanggal Sidang : $d->tanggal_sidang. Nama : $d->nama <br>";
      }
      $this->eloquent->connection("default")->commit();
    } catch (\Throwable $th) {
      $this->eloquent->connection("default")->rollback();
      throw $th;
    }
  }

  private function execPihakProduk($data)
  {
    try {
      foreach ($data as $n => $d) {
        if ($d->nomor_indentitas && strlen($d->nomor_indentitas) < 17) {
          $pengunjung = Pengunjung::updateOrCreate(
            [
              'nik' => $d->nomor_indentitas,
            ],
            [
              'nama_lengkap' => $this->removeBinBinti($d->nama),
              'jenis_kelamin' => $d->jenis_kelamin,
              'pekerjaan' => $d->pekerjaan,
              'pendidikan' => $d->pendidikan,
              'tempat_lahir' => $d->tempat_lahir,
              'tanggal_lahir' => $d->tanggal_lahir == '0000-00-00' ? null : $d->tanggal_lahir,
              'provinsi' => $d->provinsi,
              'kota' => $d->kabupaten,
              'kecamatan' => $d->kecamatan,
              'kelurahan' => $d->kelurahan,
              'alamat' => $d->alamat
            ]
          );

          $pengunjung->kunjungan()->create([
            "tanggal_kunjungan" => $d->tgl_penyerahan_akta_cerai,
            "status_pengunjung" => 'Pihak Berperkara',
            "tujuan_kunjungan" => 'PRODUK'
          ]);
        }

        echo "Insert OK. Pihak_ID : $d->id. Perkara_ID : $d->perkara_id. Tanggal Penyerahan : $d->tgl_penyerahan_akta_cerai. Nama : $d->nama <br>";
      }
      $this->eloquent->connection("default")->commit();
    } catch (\Throwable $th) {
      $this->eloquent->connection("default")->rollback();
      throw $th;
    }
  }

  private function removeBinBinti($nama)
  {
    $nama = strtoupper($nama);
    if (Str::contains($nama, 'BIN')) {
      return explode('BIN', $nama)[0];
    }
    return explode('BINTI', $nama)[0];
  }

  private function  getDataPihakMendaftar($bulan, $tahun)
  {
    $data = $this->eloquent->connection('sipp')
      ->table('perkara')
      ->select(
        'perkara.perkara_id',
        'tanggal_pendaftaran',
        'pihak.*',
        $this->eloquent::raw('(select nama_provinsi from ref_provinsi where id_provinsi = pihak.propinsi) as provinsi'),

        $this->eloquent::raw('(select kabupaten_nama from ref_kabupaten_new where kabupaten_kode = pihak.kabupaten) as kabupaten'),

        $this->eloquent::raw('(select kecamatan_nama from ref_kecamatan_new where kecamatan_kode = pihak.kecamatan) as kecamatan'),

        $this->eloquent::raw('(select kelurahan_nama from ref_kelurahan_new where kelurahan_kode = pihak.kelurahan) as kecamatan'),
      )
      ->leftJoin('perkara_pihak1', 'perkara_pihak1.perkara_id', '=', 'perkara.perkara_id')
      ->leftJoin('pihak', 'pihak.id', '=', 'perkara_pihak1.pihak_id')
      ->whereMonth('tanggal_pendaftaran', $bulan)
      ->whereYear('tanggal_pendaftaran', $tahun)->get();
    return $data;
  }

  private function getDataPihakBersidang($bulan, $tahun)
  {

    $data = $this->eloquent->connection('sipp')
      ->table('perkara_jadwal_sidang')
      ->select(
        'perkara_jadwal_sidang.perkara_id',
        'tanggal_sidang',
        'pihak.*',
        $this->eloquent::raw('(select nama_provinsi from ref_provinsi where id_provinsi = pihak.propinsi) as provinsi'),

        $this->eloquent::raw('(select kabupaten_nama from ref_kabupaten_new where kabupaten_kode = pihak.kabupaten) as kabupaten'),

        $this->eloquent::raw('(select kecamatan_nama from ref_kecamatan_new where kecamatan_kode = pihak.kecamatan) as kecamatan'),

        $this->eloquent::raw('(select kelurahan_nama from ref_kelurahan_new where kelurahan_kode = pihak.kelurahan) as kecamatan'),
      )
      ->leftJoin('perkara_pihak1', 'perkara_pihak1.perkara_id', '=', 'perkara_jadwal_sidang.perkara_id')
      ->leftJoin('pihak', 'pihak.id', '=', 'perkara_pihak1.pihak_id')
      ->whereMonth('tanggal_sidang', $bulan)
      ->whereYear('tanggal_sidang', $tahun)->get();
    return $data;
  }

  private function getDataPihakProduk($bulan, $tahun)
  {
    $data = $this->eloquent->connection('sipp')
      ->table('perkara_akta_cerai')
      ->select(
        'perkara_akta_cerai.perkara_id',
        'tgl_penyerahan_akta_cerai',
        'pihak.*',
        $this->eloquent::raw('(select nama_provinsi from ref_provinsi where id_provinsi = pihak.propinsi) as provinsi'),

        $this->eloquent::raw('(select kabupaten_nama from ref_kabupaten_new where kabupaten_kode = pihak.kabupaten) as kabupaten'),

        $this->eloquent::raw('(select kecamatan_nama from ref_kecamatan_new where kecamatan_kode = pihak.kecamatan) as kecamatan'),

        $this->eloquent::raw('(select kelurahan_nama from ref_kelurahan_new where kelurahan_kode = pihak.kelurahan) as kecamatan'),
      )
      ->leftJoin('perkara_pihak1', 'perkara_pihak1.perkara_id', '=', 'perkara_akta_cerai.perkara_id')
      ->leftJoin('pihak', 'pihak.id', '=', 'perkara_pihak1.pihak_id')
      ->whereMonth('tgl_penyerahan_akta_cerai', $bulan)
      ->whereYear('tgl_penyerahan_akta_cerai', $tahun)->get();
    return $data;
  }
}
