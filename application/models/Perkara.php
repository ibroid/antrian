<?php


class Perkara extends Illuminate\Database\Eloquent\Model
{
  protected $connection = "sipp";
  protected $table = "perkara";
  protected $primaryKey = "perkara_id";

  public function penetapan()
  {
    return $this->hasOne(PerkaraPenetapan::class, "perkara_id", "perkara_id");
  }

  public function pengacara_satu()
  {
    return $this->hasMany(PerkaraPengacara::class, "perkara_id", "perkara_id")->where('pihak_ke', 1);
  }

  public function pengacara_dua()
  {
    return $this->hasMany(PerkaraPengacara::class, "perkara_id", "perkara_id")->where('pihak_ke', 2);
  }

  public function jadwal_sidang()
  {
    return $this->hasOne(PerkaraJadwalSidang::class, "perkara_id");
  }

  public function pihak_satu()
  {
    return $this->hasMany(PerkaraPihakSatu::class, "perkara_id", "perkara_id");
  }

  public function pihak_dua()
  {
    return $this->hasMany(PerkaraPihakDua::class, "perkara_id", "perkara_id");
  }
}
