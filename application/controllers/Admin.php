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
        <script src=\"$baseUrl/assets/js/chart/apex-chart/stock-prices.js\"></script>",
        "<script src=\"$baseUrl/package/htmx/htm.js\"></script>"
      ]
    ]);

    if (!$this->is_admin) {
      redirect($_SERVER["HTTP_REFERER"] ?? "menu");
    }
  }

  public function index()
  {
    $totalPengunjungMobile = [
      'tahun_ini' => $this->eloquent->table('visitor')->selectRaw("count(*) as total")->whereYear('created_at', date('Y'))->first(),
      'bulan_ini' => $this->eloquent->table('visitor')->selectRaw("count(*) as total")->whereMonth('created_at', date('m'))->first(),
      'hari_ini' => $this->eloquent->table('visitor')->selectRaw("count(*) as total")->whereDate('created_at', date('Y-m-d'))->first(),
    ];

    $this->load->page("admin/admin_dashboard", [
      "pengunjung_mobile" => $totalPengunjungMobile
    ])->layout("dashboard_layout", [
      "title" => "Dashboard Admin",
      "nav" => $this->load->component("layout/nav_admin")
    ]);
  }
}
