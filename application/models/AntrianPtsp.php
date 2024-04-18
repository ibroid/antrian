<?php

use Illuminate\Database\Eloquent\Model;

class AntrianPtsp extends Model
{
  protected $table = "antrian_pelayanan";
  protected $guarded = [];

  /**
   * Perform actions when the AntrianPtsp model is booted.
   */
  public static function booted()
  {
    static::created(function ($antrian) {
      Broadcast::pusher()->trigger('antrian-channel', 'new-antrian-ptsp', $antrian);
    });

    static::updated(function ($antrian) {
      Broadcast::pusher()->trigger('antrian-channel', 'update-antrian-ptsp', $antrian);
    });
  }

  /**
   * Retrieve the associated ProdukPengadilan for the AntrianPtsp.
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasOne
   */
  public function pesanan_produk()
  {
    return $this->hasOne(ProdukPengadilan::class, "antrian_pelayanan_id", "id");
  }
}
