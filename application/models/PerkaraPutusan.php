<?php

use Illuminate\Database\Eloquent\Model;

class PerkaraPutusan extends Model
{
  protected $connection = "sipp";
  protected $table = "perkara_putusan";


  public function perkara()
  {
    return $this->belongsTo(Perkara::class, "perkara_id", "perkara_id");
  }
}
