<?php

use Illuminate\Database\Eloquent\Model;

class AntrianPersidangan extends Model
{
  protected $table = "antrian_persidangan";
  protected $guarded = [];

  protected static function booted(): void
  {
    static::created(function (AntrianPersidangan $antrianPersidangan) {
      foreach ($antrianPersidangan->perkara->pihak_satu as $n => $ps) {
        ++$n;
        KehadiranPihak::create([
          "antrian_persidangan_id" => $antrianPersidangan->id,
          "pihak" => $ps->nama,
          "sebagai" => "P$n",
          "status" => 0,
        ]);
      }

      foreach ($antrianPersidangan->perkara->pihak_dua as $y => $pd) {
        ++$y;
        KehadiranPihak::create([
          "antrian_persidangan_id" => $antrianPersidangan->id,
          "pihak" => $pd->nama,
          "sebagai" => "T$y",
          "status" => 0,
        ]);
      }

      foreach ($antrianPersidangan->perkara->pengacara_satu as $x => $ks) {
        ++$x;
        KehadiranPihak::create([
          "antrian_persidangan_id" => $antrianPersidangan->id,
          "pihak" => $ks->nama,
          "sebagai" => "KP$x",
          "status" => 0,
        ]);
      }

      foreach ($antrianPersidangan->perkara->pengacara_dua as $c => $kd) {
        ++$c;
        KehadiranPihak::create([
          "antrian_persidangan_id" => $antrianPersidangan->id,
          "pihak" => $kd->nama,
          "sebagai" => "KT$c",
          "status" => 0,
        ]);
      }
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
