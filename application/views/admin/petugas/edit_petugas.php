<?php

/**
 * Used by Petugas_pelayanan.php Controller
 */
?>

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
              <select
                hx-post="<?= base_url("petugas_pelayanan/extend_form/" . Cypher::urlsafe_encrypt($data->id)) ?>"
                hx-trigger="load, change"
                hx-target="#form-extend"
                hx-indicator="#form-extend-indicator"
                hx-on::before-request="$('#submit-button').attr('disabled', true)"
                hx-on::after-request="$('#submit-button').attr('disabled', false)"
                class="form-select"
                name="jenis_petugas"
                id="jenis_petugas"
                required>
                <?php foreach ($jenis_petugas as $jp) { ?>
                  <option
                    <?php
                    if ($data->jenis_petugas == $jp->nama_jenis) {
                      echo "selected";
                    }
                    ?>>
                    <?= $jp->nama_jenis ?>
                  </option>

                <?php } ?>
              </select>
            </div>
            <div id="form-extend-indicator" class="text-center htmx-indicator">
              <p>Mohon Tunggu ...</p>
            </div>
            <div id="form-extend"></div>
            <div class="text-center">
              <button id="submit-button" type="submit" class="btn btn-primary">Update Petugas</button>
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