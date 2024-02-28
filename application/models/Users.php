<?php

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
  protected $table = "users";
  protected $guarded = [];

  public function role()
  {
    return $this->belongsTo(Roles::class);
  }
}
