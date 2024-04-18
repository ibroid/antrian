<?php

class Admin extends R_Controller
{

  public function index()
  {
    $this->load->page("admin/admin_dashboard")->layout("dashboard_layout", [
      "title" => "Dashboard Admin",
      "nav" => $this->load->component("layout/nav_admin")
    ]);
  }
}
