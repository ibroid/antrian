<div class="contrainer-fluid py-3">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <?= $this->session->flashdata('flash_error') ?>
      <?= $this->session->flashdata('flash_alert') ?>
      <div class="card">
        <div class="card-header">
          <div class="d-flex justify-content-between align-items-center">
            <div class="text-header">
              <h5>Tambah Petugas Baru</h5>
            </div>
            <div class="text-end">
              <a href="<?= base_url('/petugas_pelayanan') ?>" class="btn btn-secondary">
                <i class="fa fa-arrow-left"></i>
                Kembali</a>
            </div>
          </div>
        </div>
        <div class="card-body">
          <form class="needs-validation" novalidate action="<?= base_url('/petugas_pelayanan/update/' . Cypher::urlsafe_encrypt($data->id)) ?>" method="post">
            <div class="form-group mb-4">
              <label for="nama_petugas" class="form-label">Nama Petugas</label>
              <input value="<?= $data->nama_petugas ?>" type="text" class="form-control" name="nama_petugas" id="nama_petugas" required maxlength="92">
            </div>
            <div class="form-group mb-4">
              <label for="user_id" class="form-label">Pilih User</label>
              <select class="form-select" name="user_id" id="user_id" required>
                <?php foreach ($pengguna_petugas as $p) { ?>
                  <option value="<?= $p->id ?>" <?= $p->id == $data->user_id ? "selected" : null ?>><?= $p->name ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group mb-4">
              <label for="jenis_petugas" class="form-label">Jenis Petugas</label>
              <select class="form-select" name="jenis_petugas" id="jenis_petugas" required>
                <option selected><?= $data->jenis_petugas ?></option>
                <option value="Petugas PTSP">Petugas PTSP</option>
                <option value="Petugas Sidang">Petugas Sidang</option>
                <option value="Petugas Produk">Petugas Produk</option>
                <option value="Kasir">Kasir</option>
                <option value="Petugas Antrian">Petugas Antrian</option>
                <option value="Petugas Akta">Petugas Akta</option>
                <option value="Petugas Posbakum">Petugas Posbakum</option>
              </select>
            </div>
            <div class="form-group mb-4">
              <label for="loket_id" class="form-label">Penempatan Loket</label>
              <select class="form-select" name="loket_id" id="loket_id">
                <?php foreach ($loket as $l) { ?>
                  <option value="<?= $l->id  ?>" <?= $l->id == $data->loket_id ? "selected" : null ?>> <?= $l->nama_loket ?></option>
                <?php } ?>

              </select>
            </div>
            <div class="form-group mb-4">
              <label for="loket_id" class="form-label">Jenis Layanan</label>
              <div class="overflow-auto" style="height: 250px;">
                <ol>
                  <li>asdasdas</li>
                  <li>asdasdas</li>
                  <li>asdasdas</li>
                  <li>asdasdas</li>
                  <li>asdasdas</li>
                  <li>asdasdas</li>
                  <li>asdasdas</li>
                  <li>asdasdas</li>
                  <li>asdasdas</li>
                  <li>asdasdas</li>
                </ol>
              </div>
              <small>Jenis layanan antrian yang bisa dipanggil oleh Petugas</small>

            </div>
            <div class="text-center">
              <button type="submit" class="btn btn-primary">Update Petugas</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  window.addEventListener("load", () => {
    (() => {
      'use strict'

      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      const forms = document.querySelectorAll('.needs-validation')

      // Loop over them and prevent submission
      Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
          if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
          }

          form.classList.add('was-validated')
        }, false)
      })
    })()
  })
</script>