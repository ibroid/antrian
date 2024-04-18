<?php

class R_Exceptions extends CI_Exceptions
{

  public function __construct()
  {
    parent::__construct();
  }

  public function show_exception($exception)
  {
    if ($exception instanceof Illuminate\Database\QueryException) {
      switch ($exception->errorInfo["1"]) {
        case 2002:
          Redirect::wfe("Error : " . $exception->errorInfo["2"])->go("/menu");
          break;

        default:
          echo "Terjadi error pada database sipp :" . $exception->getMessage();
          break;
      }
    } else {
      parent::show_exception($exception);
    }
  }
}
