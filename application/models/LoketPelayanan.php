<?php

use Illuminate\Database\Eloquent\Model;

class LoketPelayanan extends Model
{
  protected $table = 'loket_pelayanan';

  protected $guarded = [];

  /**
   * Run when the model is booted.
   */
  public static function booted()
  {
    static::updated(function ($model) {
      Broadcast::pusher()->trigger('loket-channel', 'update-loket', $model);
    });
  }

  /**
   * Retrieve the antrian_pelayanan record associated with this model.
   * Mengambil antrian yang sedang dipanggil.
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<AntrianPtsp>
   */
  public function antrian()
  {
    return $this->belongsTo(AntrianPtsp::class, "antrian_pelayanan_id", "id");
  }

  /**
   * Retrieve the Petugas record associated with this model.
   * Mengambil petugas yang sedang bertugas di loket tersebut.
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<Petugas>
   */
  public function petugas()
  {
    return $this->hasMany(Petugas::class, "loket_id", "id");
  }
}
