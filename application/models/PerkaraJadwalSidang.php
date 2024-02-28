<?php

use Illuminate\Database\Eloquent\Model;

class PerkaraJadwalSidang extends Model
{
  protected $connection = "sipp";
  protected $table = "perkara_jadwal_sidang";

  public function perkara()
  {
    return $this->belongsTo(Perkara::class, "perkara_id", "perkara_id");
  }

  public function antrian_sidang()
  {
    return $this->hasMany(AntrianPersidangan::class, "jadwal_sidang_id", "id");
  }
}
