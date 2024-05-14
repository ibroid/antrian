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
      return false;
    }

    if ($exception instanceof  Illuminate\Database\Eloquent\ModelNotFoundException) {
      if (R_Input::ci()->request_headers()["Accept"] == "application/json") {
        echo json_encode([
          "message" => "Data not found: " . $exception->getMessage(),
          "status" => false
        ]);
        return set_status_header(404);
      }

      show_404();
    }
    return parent::show_exception($exception);
  }
}
