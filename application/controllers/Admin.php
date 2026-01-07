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
        "<link rel=\"stylesheet\"  type=\"text/css\" href=\"$flatpickerResourceCss\">",
        "<link rel=\"stylesheet\" type=\"text/css\" href=\"https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css\" />",
      ]
    ]);

    $this->addons->init([
      "js" => [
        "<script src=\"$baseUrl/assets/js/chart/apex-chart/apex-chart.js\"></script>
        <script src=\"$baseUrl/assets/js/chart/apex-chart/stock-prices.js\"></script>",
        "<script type=\"text/javascript\" src=\"https://cdn.jsdelivr.net/momentjs/latest/moment.min.js\"></script>",
        "<script type=\"text/javascript\" src=\"https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js\"></script>",
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

  public function monitoring_ptsp()
  {
    $this->load->page("admin/monitoring_ptsp")->layout("dashboard_layout", [
      "title" => "Monitoring PTSP",
      "nav" => $this->load->component("layout/nav_admin")
    ]);
  }

  public function statistik_monitoring_loket()
  {
    $jenisPelayanan = JenisPelayanan::all();
    // prindie($jenisPelayanan);
    $q = AntrianPtsp::select('*');
    if ($this->input->post('dateend')) {
      $q->whereBetween('created_at', [
        $this->input->post('datestart') . ' 00:00:00',
        $this->input->post('dateend') . ' 23:59:59'
      ]);
    } else {
      $q->whereDate('created_at', $this->input->post('datestart'));
    }
    $antrian = $q->get();
    $dataContainer = $jenisPelayanan->map(function ($item) use ($antrian) {
      $jenisAntrian = $antrian->where('jenis_pelayanan_id', $item->id);
      return [
        'nama_loket' => $item->nama_layanan,
        'total_antrian' => $jenisAntrian->count(),
      ];
    });
    $this->output->set_content_type('application/json')->set_output(json_encode($dataContainer));
  }
}
