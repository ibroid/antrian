<?php

use Illuminate\Database\Eloquent\Model;

class DalamPersidangan extends Model
{
  protected $table = "dalam_persidangan";
  protected $guarded = [];

  public static function booted(): void
  {
    static::created(
      function (DalamPersidangan $dalamPersidangan) {
        $dalamPersidangan->antrian_persidangan->update([
          "status" => 2,
          "waktu_panggil" => date("H:i:s")
        ]);
      }
    );

    static::updated(
      function (DalamPersidangan $dalamPersidangan) {
        $dalamPersidangan->antrian_persidangan->update(["status" => 2]);
      }
    );

    static::updating(
      function (DalamPersidangan $dalamPersidangan) {
        AntrianPersidangan::where("id", $dalamPersidangan->getOriginal("nomor_antrian_id"))->update(["status" => 3]);;
      }
    );
  }

  public function antrian_persidangan()
  {
    return $this->belongsTo(AntrianPersidangan::class, "nomor_antrian_id", "id");
  }
}
