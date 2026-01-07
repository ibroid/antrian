<div class="container-fluid py-3">
  <div class="d-flex justify-content-between">
    <h4>Monitoring PTSP</h4>
    <div class="alert alert-primary p-2 alert-dismissible fade show" role="alert">
      <strong>Guide !</strong> Gunakan button tools untuk kostumisasi tanggal.
    </div>
  </div>
  <?= $this->session->flashdata("flash_alert") ?>
  <?= $this->session->flashdata("flash_error") ?>
  <div class="row">
    <div class="col-12">
      <?= $this->load->component("admin/statistik_monitoring_loket") ?>
    </div>
  </div>
</div>