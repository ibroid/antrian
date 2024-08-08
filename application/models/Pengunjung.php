<?php

use Illuminate\Database\Eloquent\Model;

class Pengunjung extends Model
{
  protected $table = "pengunjung";
  protected $guarded = [];

  public function kunjungan()
  {
    return $this->hasMany(Kunjungan::class, 'pengunjung_id');
  }
}
