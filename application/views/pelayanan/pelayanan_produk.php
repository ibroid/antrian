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
                <th>Nomor Antrian</th>
                <th>Nomor Perkara</th>
                <th>Nama Pengambil</th>
                <th>Jenis Produk</th>
                <th>Foto Pengambil</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($antrian_produk as $d) : ?>
                <tr>
                  <td><?= $d->nomor_antrian ?></td>
                  <td><?= $d->produk->nomor_perkara ?></td>
                  <td><?= $d->produk->nama_pengambil ?></td>
                  <td><?= $d->produk->jenis_produk ?></td>
                  <td></td>
                  <td><button class="btn btn-warning">Proses</button></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  window.addEventListener("load", function() {
    $("#table-produk").DataTable()
  })
</script>