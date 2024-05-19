<div class="container-fluid py-3">
  <?= $this->session->flashdata("flash_alert") ?>
  <?= $this->session->flashdata("flash_error") ?>
  <div class="card">
    <div class="card-header">
      <div class="d-flex justify-content-between">
        <h5>Daftar Pengunjung</h5>
        <a href="<?= base_url('/pengunjung/tambah') ?>" class="btn btn-primary">
          <i class="fa fa-plus"></i>
          Tambah Pengunjung
        </a>
      </div>
    </div>
    <div class="card-body">
      <table class="table table-hover table-striped" id="table-pengunjung">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Lengkap</th>
            <th>NIK</th>
            <th>Jenis Kelamin</th>
            <th>Domisili</th>
            <th>Aksi</th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
</div>

<script>
  window.addEventListener("load", function() {
    const datatable = $("#table-pengunjung").DataTable({
      "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
      },
      "processing": true,
      "serverSide": true,
      "order": [],
      "ajax": {
        //panggil method ajax list dengan ajax
        "url": '<?= base_url('pengunjung/datatable_pengunjung'); ?>',
        "type": "POST"
      },
      "columnDefs": [{
          "orderable": false,
          "targets": [0, 5]
        } // Disable search on first and last columns
      ]
    })
  })
</script>