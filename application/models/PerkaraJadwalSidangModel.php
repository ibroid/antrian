<?php

use Illuminate\Database\Eloquent\Model;

class PerkaraJadwalSidangModel extends Model
{
  protected $connection = "sipp";
  protected $table = "perkara_jadwal_sidang";

  public function perkara()
  {
    return $this->belongsTo(PerkaraModel::class, "perkara_id", "perkara_id");
  }
}
