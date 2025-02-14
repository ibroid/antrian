<?php

class R_Exceptions extends CI_Exceptions
{

  public function __construct()
  {
    parent::__construct();
  }

  public function show_404($page = '', $log_error = TRUE)
  {
    set_status_header(404);
    echo "The page was not found";
  }
}
