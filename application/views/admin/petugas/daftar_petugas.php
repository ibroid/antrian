<div class="container-fluid py-3">
  <?= $this->session->flashdata('flash_alert') ?>
  <?= $this->session->flashdata('flash_error') ?>
  <div class="card">
    <div class="card-header">
      <div class="d-flex justify-content-between align-items-center">
        <div class="text-header">
          <h5>Daftar Petugas</h5>
        </div>
        <div class="text-end">
          <a href="<?= base_url('/petugas_pelayanan/tambah') ?>" class="btn btn-primary">
            <i class="fa fa-plus"></i>
            Tambah Petugas</a>
        </div>
      </div>
    </div>
    <div class="card-body">
      <table class="table table-hover table-striped" id="table-petugas">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Petugas</th>
            <th>Jenis Petugas</th>
            <th>Penempatan</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $n = 1;
          foreach ($petugas as $p) { ?>
            <tr>
              <td><?= $n++ ?></td>
              <td><?= $p->nama_petugas ?></td>
              <td><?= $p->jenis_petugas ?></td>
              <td><?= $p->loket->nama_loket ?? null ?></td>
              <td>
                <a class="btn btn-warning btn-sm" href="<?= base_url('/petugas_pelayanan/edit/' . Cypher::urlsafe_encrypt($p->id)) ?>">
                  <i class="fa fa-pencil"></i> Ubah</a>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<script>
  window.addEventListener("load", function() {
    $("#table-petugas").DataTable()
  })
</script>