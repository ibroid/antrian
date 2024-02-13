<?php

use Illuminate\Database\Eloquent\Model;

class PerkaraModel extends Model
{
  protected $connection = "sipp";
  protected $table = "perkara";
  protected $primaryKey = "perkara_id";

  public function penetapan()
  {
    return $this->hasOne(PerkaraPenetapanModel::class, "perkara_id", "perkara_id");
  }

  public function pengacara()
  {
    return $this->hasMany(PerkaraPengacaraModel::class, "perkara_id", "perkara_id");
  }

  public function jadwal_sidang()
  {
    return $this->hasOne(PerkaraJadwalSidangModel::class, "perkara_id");
  }

  public function pihak_satu()
  {
    return $this->hasMany(PerkaraPihakSatuModel::class, "perkara_id", "perkara_id");
  }

  public function pihak_dua()
  {
    return $this->hasMany(PerkaraPihakDuaModel::class, "perkara_id", "perkara_id");
  }
}
