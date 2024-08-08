<?php

class Pihak extends Illuminate\Database\Eloquent\Model
{
  protected $connection = "sipp";
  protected $table = "pihak";

  public function pihak_satu()
  {
    return $this->hasOne(PerkaraPihakSatu::class, 'pihak_id');
  }
}
