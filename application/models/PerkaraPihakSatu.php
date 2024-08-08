<?php


class PerkaraPihakSatu extends Illuminate\Database\Eloquent\Model
{
  protected $connection = "sipp";
  protected $table = "perkara_pihak1";

  public function pihak()
  {
    return $this->belongsTo(Pihak::class, 'pihak_id');
  }

  public function perkara()
  {
    return $this->belongsTo(Perkara::class, 'perkara_id');
  }
}
