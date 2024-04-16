<?php

use Illuminate\Database\Eloquent\Model;

class AntrianPtsp extends Model
{
  protected $table = "antrian_pelayanan";
  protected $guarded = [];

  static function boot()
  {
    parent::boot();

    static::created(function ($antrian) {
      $pusher = new Pusher\Pusher(
        'a360f9f6cfefca4c383b',
        'f6262d370d723734da60',
        '1758369',
        [
          'cluster' => 'ap1',
          'useTLS' => true
        ]
      );

      $pusher->trigger('antrian-channel', 'new-antrian-ptsp', $antrian);
    });
  }

  public function pesanan_produk()
  {
    return $this->hasOne(ProdukPengadilan::class, "antrian_pelayanan_id", "id");
  }
}
