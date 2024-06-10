<?php

use Illuminate\Database\Eloquent\Model;

class ProdukPengadilan extends Model
{
  protected $table = "produk_pengadilan";
  protected $guarded = [];

  public static function booted()
  {
    static::creating(function ($model) {

      if ($model->perkara_id) {
        return $model;
      }

      $pihak = Pihak::find($model->pihak_id);
      $perkara = Perkara::where("nomor_perkara", $model->nomor_perkara)->first();

      if (!$pihak || !$perkara) {
        $model->perkara_id  = Cypher::urlsafe_decrypt($model->perkara_id);
        return $model;
      }

      $model->nama_pengambil = $pihak->nama;
      $model->nomor_akta_cerai = $perkara->akta_cerai->nomor_akta_cerai ?? null;
      $model->jenis_perkara = $perkara->jenis_perkara_nama;
      $model->tahun_perkara = date("Y", strtotime($perkara->tanggal_pendaftaran));
      $model->perkara_id = $perkara->perkara_id;

      return $model;
    });

    static::saved(function ($model) {
      Broadcast::pusher()->trigger("produk-channel", "saved-produk", $model);
    });
  }

  public function antrian()
  {
    return $this->belongsTo(AntrianPtsp::class, 'antrian_pelayanan_id', 'id');
  }
}
