<?php

use Illuminate\Database\Eloquent\Model;

class PetugasJenisPelayanan extends Model
{

  protected $table = "petugas_jenis_pelayanan";

  public function petugas()
  {
    return $this->morphedByMany(Petugas::class, "petugas_id");
  }

  public function jenis_pelayanan()
  {
    return $this->morphedByMany(JenisPelayanan::class, "jenis_pelayanan_id");
  }
}
