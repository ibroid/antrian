<?php

use Illuminate\Database\Eloquent\Model;

class ProdukPengadilan extends Model
{
  protected $table = "produk_pengadilan";
  protected $guarded = [];

  public static function booted()
  {
    static::creating(function ($model) {
      $pihak = Pihak::find($model->pihak_id);
      $perkara = Perkara::where("nomor_perkara", $model->nomor_perkara)->first();

      if (!$pihak || !$perkara) {
        return $model;
      }

      $model->nama_pengambil = $pihak->nama;
      $model->nomor_akta_cerai = $perkara->akta_cerai->nomor_akta_cerai ?? null;
      $model->jenis_perkara = $perkara->jenis_perkara_nama;
      $model->tahun_perkara = date("Y", strtotime($perkara->tanggal_penetapan));

      return $model;
    });
  }
}
