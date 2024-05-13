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
  public function produk()
  {
    return $this->hasOne(ProdukPengadilan::class, "antrian_pelayanan_id", "id");
  }


  /**
   * Get the nomor_antrian attribute. Combine from nomor_urutan and kode
   * @return string
   */
  public function getNomorAntrianAttribute()
  {
    return $this->kode . "-" . $this->nomor_urutan;
  }

  /**
   * Retrieve the associated IdentitasPihak for the AntrianPtsp.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function pihak()
  {
    return $this->belongsTo(IdentitasPihak::class, 'identitas_pihak_id', 'id');
  }
}
