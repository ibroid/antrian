<?php

class Admin extends R_Controller
{
  public function __construct()
  {
    parent::__construct();
    $baseUrl = base_url();
    $this->addons->init([
      "js" => [
        "<script src=\"$baseUrl/assets/js/chart/apex-chart/apex-chart.js\"></script>
        <script src=\"$baseUrl/assets/js/chart/apex-chart/stock-prices.js\"></script>"
      ]
    ]);
  }

  public function index()
  {
    $this->load->page("admin/admin_dashboard")->layout("dashboard_layout", [
      "title" => "Dashboard Admin",
      "nav" => $this->load->component("layout/nav_admin")
    ]);
  }
}
