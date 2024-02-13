<?php

use Illuminate\Database\Eloquent\Model;

class UsersModel extends Model
{
  protected $table = "users";
  protected $guarded = [];

  public function role()
  {
    return $this->belongsTo(RolesModel::class);
  }
}
