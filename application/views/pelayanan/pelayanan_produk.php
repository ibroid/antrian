<div class="container-fluid py-3">
  <div class="row">
    <?= $this->session->flashdata('flash_alert') ?>
    <?= $this->session->flashdata('flash_error') ?>
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Pesanan Produk Pengadilan</h4>
          <table class="table table-hovered table" id="table-produk">
            <thead>
              <tr>
                <th>No</th>
                <th>Nomor Perkara</th>
                <th>Nama Pengambil</th>
                <th>Jenis Produk</th>
                <th>Jenis Perkara</th>
                <th>Aksi</th>
              </tr>
            </thead>

          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  window.addEventListener("load", function() {
    $("#table-produk").DataTable({
      "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
      },
      "processing": true,
      "serverSide": true,
      "order": [],
      "ajax": {
        //panggil method ajax list dengan ajax
        "url": '<?= base_url('pesanan_produk/datatable_pesanan_produk'); ?>',
        "type": "POST"
      }
    })
  })
</script>