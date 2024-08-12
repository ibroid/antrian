<?php

use Illuminate\Database\Eloquent\Model;

class SerialNumber extends Model
{
  protected $table = 'serial_number';
  protected $guraded = [];

  public function pengunjung()
  {
    return $this->belongsTo(Pengunjung::class, 'pengunjung_id');
  }
}
