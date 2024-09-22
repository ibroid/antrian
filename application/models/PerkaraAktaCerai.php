<?php

use Illuminate\Database\Eloquent\Model;

class PerkaraAktaCerai extends Model
{
  protected $connection = "sipp";
  protected $table = "perkara_akta_cerai";

  public function perkara()
  {
    return $this->belongsTo(Perkara::class, "perkara_id", "perkara_id");
  }
}
