<?php

use Illuminate\Support\Facades\Hash;

class Debug extends CI_Controller
{
  public Eloquent $eloquent;

  public function __construct()
  {
    parent::__construct();
    if ($_ENV["DEBUG"] == FALSE) {
      set_status_header(404);
      die;
    }
  }

  function index()
  {
    echo password_hash("dareuek871", PASSWORD_BCRYPT);
  }

  public function init_data()
  {
    $this->eloquent->table("roles")->truncate();
    $this->eloquent->table("roles")->insert([
      ["role_name" => "Admin"],
      ["role_name" => "Petugas Sidang"],
      ["role_name" => "Petugas PTSP"],
      ["role_name" => "Petugas Pegawai"],
      ["role_name" => "Petugas HAKIM"],
    ]);

    $this->eloquent->table("users")->truncate();
    $this->eloquent->table("users")->insert([
      "sipp_user_id" => 1,
      "identifier" => "admin",
      "salt" => "g17i09n15R17",
      "password" => password_hash("admin123g17i09n15R17", PASSWORD_BCRYPT),
      "name" => "Admin Imal",
      "role_id" => 1
    ]);

    echo "ok";
  }
}
