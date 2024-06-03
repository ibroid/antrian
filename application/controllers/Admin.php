<?php

class Admin extends R_Controller
{
  public function __construct()
  {
    parent::__construct();
    $baseUrl = base_url();
    $flatpickerResourceJs = base_url('/assets/js/flat-pickr/flatpickr.js');
    $flatpickerResourceCss = base_url('/assets/css/vendors/flatpickr/flatpickr.min.css');

    $this->addons->init([
      "js" => [
        "<script src=\"$flatpickerResourceJs\"></script>\n"
      ],
      "css" => [
        "<link rel=\"stylesheet\"  type=\"text/css\" href=\"$flatpickerResourceCss\">"
      ]
    ]);

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
