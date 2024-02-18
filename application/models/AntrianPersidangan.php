<?php

use Illuminate\Database\Eloquent\Model;

class AntrianPersidangan extends Model
{
  protected $table = "antrian_persidangan";
  protected $guarded = [];

  protected static function booted(): void
  {
    static::created(function (AntrianPersidangan $antrianPersidangan) {
    });
  }

  public function kehadiran_pihak()
  {
    return $this->hasMany(KehadiranPihak::class);
  }

  public function perkara()
  {
    return $this->belongsTo(Perkara::class, "nomor_perkara", "nomor_perkara");
  }
}
