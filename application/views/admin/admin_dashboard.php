<div class="container-fluid py-3">
  <div class="d-flex justify-content-between">
    <h4>Monitoring Persidangan</h4>
    <div class="alert alert-primary p-2 alert-dismissible fade show" role="alert">
      <strong>Guide !</strong> Gunakan button tools untuk kostumisasi tanggal.
    </div>
  </div>
  <?= $this->session->flashdata("flash_alert") ?>
  <?= $this->session->flashdata("flash_error") ?>
  <div class="row">
    <div class="col-xxl-3 col-md-12 col-sm-12 box-col-6">
      <?= $this->load->component("admin/sidang_today_chart_pie") ?>
    </div>
    <div class="col-xxl-9 col-xl-9 col-sm-12 col-md-12 box-col-12">
      <?= $this->load->component("admin/statistic_pengambilan_sidang") ?>
    </div>
  </div>
  <div class="row">
    <div class="col-xxl-6 col-xl-6 col-md-12 col-sm-12">
      <?= $this->load->component("admin/statistic_penambahan_sidang_dan_ptsp") ?>
    </div>
    <div class="col-xxl-3 col-xl-3 col-md-12 col-sm-12">
      <?= $this->load->component("admin/pie_chart_antrian_ptsp") ?>
    </div>
    <div class="col-xxl-3 col-xl-3 col-md-12 col-sm-12">
      <?= $this->load->component("admin/online_user") ?>
    </div>
  </div>
</div>

<script>
  window.addEventListener("load", function() {
    flatpickr(".date-picker")
  })
</script>