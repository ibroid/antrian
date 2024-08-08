<?php

use Illuminate\Database\Eloquent\Model;

class Kunjungan extends Model
{
  protected $table = "kunjungan";

  protected $guarded = [];

  public function pengunjung()
  {
    return $this->belongsTo(Pengunjung::class, 'pengunjung_id');
  }
}
