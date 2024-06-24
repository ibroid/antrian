<?php

use Illuminate\Database\Eloquent\Model;

class Visitors extends Model
{
  protected $connection = "default";
  protected $table = "visitor";
  protected $guarded = [];

  public function mobile_notification()
  {
    return $this->hasMany(MobileNotificaion::class, "visitor_id", "id");
  }
}
