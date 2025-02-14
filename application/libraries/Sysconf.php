<?php

class Sysconf
{
  /**
   * @param array $par
   */
  public function __construct($par)
  {
    /**
     * @var Eloquent $ed
     */
    $ed = $par["ed"];

    $sysdata = $ed->connection("sipp")->table("sys_config")->whereBetween("id", [61, 103])->get();
    foreach ($sysdata as $key => $value) {
      $this->{$value->name} = $value->value;
    }
  }
}
