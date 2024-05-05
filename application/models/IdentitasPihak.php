<?php

use Illuminate\Database\Eloquent\Model;

class IdentitasPihak extends Model
{
  protected $table = "identitas_pihak";

  protected $guarded  = [];

  public function antrian()
  {
    return $this->hasMany(AntrianPtsp::class, 'identitas_pihak_id', 'id');
  }
}
