<?php

use Illuminate\Database\Eloquent\Model;

class KehadiranPihak extends Model
{
  protected $table = "kehadiran_pihak";
  protected $guarded = [];

  public function antrian_persidangan()
  {
    return $this->belongsTo(AntrianPersidangan::class);
  }
}
