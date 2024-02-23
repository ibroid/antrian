<?php

use Illuminate\Database\Eloquent\Model;

class AntrianPersidangan extends Model
{
  protected $table = "antrian_persidangan";
  protected $guarded = [];

  protected static function booted(): void
  {
    static::created(function (AntrianPersidangan $antrianPersidangan) {
      self::broadcast_new_antrian($antrianPersidangan);

      self::tambahKehadiranSetelahAmbilAntrian($antrianPersidangan);
    });

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

  public function jadwal_sidang()
  {
    return $this->belongsTo(PerkaraJadwalSidang::class, "jadwal_sidang_id", "id");
  }

  private static function broadcast_new_antrian(AntrianPersidangan $antrianPersidangan)
  {
    $pusher = new Pusher\Pusher(
      'a360f9f6cfefca4c383b',
      'f6262d370d723734da60',
      '1758369',
      [
        'cluster' => 'ap1',
        'useTLS' => true
      ]
    );

    $data['message'] = 'hello world';
    $pusher->trigger('antrian-channel', 'new-antrian', $antrianPersidangan);
  }

  private static function tambahKehadiranSetelahAmbilAntrian(AntrianPersidangan $antrianPersidangan)
  {
    foreach ($antrianPersidangan->perkara->pihak_satu as $n => $ps) {
      ++$n;
      KehadiranPihak::create([
        "antrian_persidangan_id" => $antrianPersidangan->id,
        "pihak" => $ps->nama,
        "sebagai" => "P$n",
        "status" => (R_Input::pos("yang_ambil") == "P$n") ? 1 : 0,
      ]);
    }

    foreach ($antrianPersidangan->perkara->pihak_dua as $y => $pd) {
      ++$y;
      KehadiranPihak::create([
        "antrian_persidangan_id" => $antrianPersidangan->id,
        "pihak" => $pd->nama,
        "sebagai" => "T$y",
        "status" => (R_Input::pos("yang_ambil") == "T$y") ? 1 : 0,
      ]);
    }

    foreach ($antrianPersidangan->perkara->pengacara_satu as $x => $ks) {
      ++$x;
      KehadiranPihak::create([
        "antrian_persidangan_id" => $antrianPersidangan->id,
        "pihak" => $ks->nama,
        "sebagai" => "KP$x",
        "status" => (R_Input::pos("yang_ambil") == "KP$x") ? 1 : 0,
      ]);
    }

    foreach ($antrianPersidangan->perkara->pengacara_dua as $c => $kd) {
      ++$c;
      KehadiranPihak::create([
        "antrian_persidangan_id" => $antrianPersidangan->id,
        "pihak" => $kd->nama,
        "sebagai" => "KT$c",
        "status" => (R_Input::pos("yang_ambil") == "KT$c") ? 1 : 0,
      ]);
    }

    KehadiranPihak::create([
      "antrian_persidangan_id" => $antrianPersidangan->id,
      "pihak" => "SAKSI-SAKSI",
      "sebagai" => "S",
      "status" => 0,
    ]);
  }

  public function setKehadiranSetelahAmbilAntrian()
  {
    KehadiranPihak::where([
      "antrian_persidangan_id" => $this->id,
      "sebagai" => R_Input::pos("yang_ambil"),
    ])->update(["status" => 1]);
  }
}
