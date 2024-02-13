<?php

class Debug extends CI_Controller
{
  function index()
  {
    echo password_hash("dareuek871", PASSWORD_BCRYPT);
  }
}
