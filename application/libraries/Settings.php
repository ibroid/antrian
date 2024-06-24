<?php

class Settings
{
  public function __construct()
  {
    $eloquent = new Eloquent();
    foreach ($eloquent->connection("default")->table('settings')->get() as $key => $value) {
      $this->{$value->key} = $value->value;
    }
  }

  static function set(string $key, $val)
  {
    $eloquent = new Eloquent();
    $eloquent->where('key', $key)->update($val);
  }
}
