<div class="container-fluid py-3">
  <div class="row">
    <?= $this->session->flashdata('flash_alert') ?>
    <?= $this->session->flashdata('flash_error') ?>
    <div class="col-12">
      <div class="card text-start">
        <div class="card-body">
          <h4 class="card-title">Olah Bank Gugatan Disini</h4>
          <form class="form my-5" enctype="multipart/form-data" method="POST" action="<?= base_url('/bank_gugatan/simpan') ?>">
            <div class="row g-3">
              <div class="col-4">
                <input type="text" name="nama_pihak" required class="form-control" placeholder="Nama Pihak" aria-label="First name">
              </div>
              <div class="col-6">
                <input required type="file" name="filename" class="form-control" placeholder="File Name" aria-label="Last name">
              </div>
              <div class="col">
                <button class="btn btn-primary"><i class="fa fa-cloud"></i> Upload</button>
              </div>
            </div>
          </form>
          <table class="table table-hovered table-striped" id="table-bank-gugatan">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Pihak</th>
                <th>Nama File</th>
              </tr>
            </thead>
          </table>
          <tbody></tbody>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  window.addEventListener("load", function() {
    $("#table-bank-gugatan").DataTable({
      processing: true,
      serverSide: true,
      "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
      },
      "order": [],
      "ajax": {
        "url": '<?= base_url('bank_gugatan/datatable_bank_gugatan'); ?>',
        "type": "POST"
      }
    })
  })
</script>