<?php

/**
 * Using Controller Layanan.php
 * Method Page
 */
?>

<div class="container-fluid py-3" hx-ext='response-targets'>
  <?= $this->session->flashdata("flash_alert") ?>
  <?= $this->session->flashdata("flash_error") ?>
  <!-- <div class="row">
    <div class="col-xl-3">
      <div class="card widget-1" style="background-image: none;">
        <div class="card-body">
          <div class="widget-content">
            <div class="widget-round warning">
              <div class="bg-round">
                <svg class="svg-fill">
                  <use href="../assets/svg/icon-sprite.svg#rate"> </use>
                </svg>
                <svg class="half-circle svg-fill">
                  <use href="../assets/svg/icon-sprite.svg#halfcircle"></use>
                </svg>
              </div>
            </div>
            <div>
              <h4>0</h4><span class="f-light">Total Layanan</span>
            </div>
          </div>
          <div class="font-warning f-w-500"></div>
        </div>
      </div>
    </div>
    <div class="col-xl-3">
      <div class="card widget-1" style="background-image: none;">
        <div class="card-body">
          <div class="widget-content">
            <div class="widget-round secondary">
              <div class="bg-round">
                <svg class="svg-fill">
                  <use href="../assets/svg/icon-sprite.svg#rate"> </use>
                </svg>
                <svg class="half-circle svg-fill">
                  <use href="../assets/svg/icon-sprite.svg#halfcircle"></use>
                </svg>
              </div>
            </div>
            <div>
              <h4>0</h4><span class="f-light">Loket Tidak Aktif</span>
            </div>
          </div>
          <div class="font-secondary f-w-500"></div>
        </div>
      </div>
    </div>
    <div class="col-xl-3">
      <div class="card widget-1" style="background-image: none;">
        <div class="card-body">
          <div class="widget-content">
            <div class="widget-round primary">
              <div class="bg-round">
                <svg class="svg-fill">
                  <use href="../assets/svg/icon-sprite.svg#rate"> </use>
                </svg>
                <svg class="half-circle svg-fill">
                  <use href="../assets/svg/icon-sprite.svg#halfcircle"></use>
                </svg>
              </div>
            </div>
            <div>
              <h4>0</h4><span class="f-light">Loket Aktif</span>
            </div>
          </div>
          <div class="font-primary f-w-500"></div>
        </div>
      </div>
    </div>
  </div> -->
  <div class="row mx-1">
    <div class="d-flex justify-content-center">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Daftar Jenis Layanan</h5>
          <p class="card-text">Berikut adalah layanan yang diseduakan oleh loket PTSP.</p>
          <div class="d-flex flex-row justify-content-center gap-3">
            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
              <i class="fas fa-add"></i>
              Tambah Layanan Baru
            </button>

            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Form tambah jenis layanan baru</h5>
                    <button
                      type="button"
                      class="btn-close"
                      data-bs-dismiss="modal"
                      aria-label="Close"
                      hx-post="<?= base_url("layanan/form_create") ?>"
                      hx-target="#form-container"
                      hx-indicator="#form-indicator">
                    </button>
                  </div>
                  <div class="modal-body" id="form-container">
                    <form
                      method="post"
                      autocomplete="off"
                      class="needs-validation"
                      id="form-jenis-layanan"
                      action="<?= base_url("layanan/simpan") ?>"
                      onsubmit="disableSubmitButton()"
                      novalidate>
                      <div class="input-group mb-3">
                        <span class="input-group-text" id="input1">Nama Layanan : </span>
                        <input
                          required
                          name="nama_layanan"
                          type="text"
                          class="form-control"
                          placeholder="Jenis Layanan Loket"
                          aria-label="Username"
                          aria-describedby="input1" />
                      </div>
                      <div class="input-group mb-3">
                        <span class="input-group-text" id="input1">Kode Layanan : </span>
                        <input
                          required
                          name="kode_layanan"
                          type="text"
                          maxlength="1"
                          class="form-control"
                          placeholder="A, B, C"
                          aria-label="Username"
                          hx-indicator="#form-indicator"
                          aria-describedby="input1"
                          hx-post="<?= base_url("layanan/check_kode") ?>"
                          hx-trigger="keyup changed"
                          hx-target="#check-kode-result"
                          hx-on::before-request="beforeRequest()" />
                      </div>

                      <p id="check-kode-result" class="text-small small text-info m-2">)* Pastikan menggunakan kode yang belum digunakan sebelumnya</p>
                      <p id="err-result" class="text-small small text-danger m-2">

                      </p>
                      <div class="d-flex flex-row justify-content-between">
                        <button
                          type="submit"
                          disabled
                          id="submit-button"
                          class="btn btn-success">
                          <i class="fa fa-save"></i>
                          Simpan
                        </button>

                        <div class="htmx-indicatior" id="submit-indicator"></div>
                      </div>
                    </form>
                    <script>
                      (function() {
                        'use strict'
                        var forms = document.querySelectorAll('.needs-validation')
                        Array.prototype.slice.call(forms)
                          .forEach(function(form) {
                            form.addEventListener('submit', function(event) {
                              if (!form.checkValidity()) {
                                event.preventDefault()
                                event.stopPropagation()
                              }

                              form.classList.add('was-validated')
                            }, false)
                          })
                      })()
                    </script>
                  </div>
                  <div class="modal-footer">
                    <div id="form-indicator" class="htmx-indicator">Mohon Tunggu ...</div>
                    <button
                      type="button"
                      class="btn btn-secondary"
                      hx-post="<?= base_url("layanan/form_create") ?>"
                      hx-target="#form-container"
                      hx-indicator="#form-indicator"
                      data-bs-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <table class="table table-hover mt-3">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Nama Layanan</th>
                <th scope="col">Kode</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($daftar_jenis_layanan as $n => $jenis_layanan) { ?>
                <tr>
                  <th scope="row"><?= ++$n ?></th>
                  <td><?= $jenis_layanan->nama_layanan ?></td>
                  <td><?= $jenis_layanan->kode_layanan ?></td>
                  <td>
                    <div class="d-flex gap-3">
                      <a
                        href="javascript:void(0)"
                        data-bs-toggle="modal"
                        data-bs-target="#staticBackdrop"
                        hx-indicator="#form-indicator"
                        hx-post="<?= base_url('layanan/form_edit/' . Cypher::urlsafe_encrypt($jenis_layanan->id)) ?>"
                        hx-target="#form-container">
                        <i class="fa fa-pencil"></i>
                        Ubah
                      </a>
                      <a
                        href="javascript:void(0)"
                        hx-trigger='confirmed'
                        hx-delete="<?= base_url('layanan/delete/' . Cypher::urlsafe_encrypt($jenis_layanan->id)) ?>"
                        onClick="deleteConfirmation(this)">
                        <p class="text-small text-danger">
                          <i class="fa fa-trash"></i>
                          Hapus
                        </p>
                      </a>
                    </div>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>


<script>
  function disableSubmitButton(y = true) {
    $("#submit-button").attr("disabled", y)
  }

  function beforeRequest() {
    disableSubmitButton();
    $("#err-result").empty()
  }

  document.body.addEventListener("allowSubmit", function(evt) {
    disableSubmitButton(!evt.detail.value)
  })

  function deleteConfirmation(el) {
    Swal.fire({
      title: 'Anda Yakin ?',
      icon: "warning",
      text: 'Data yang dihapus tidak bisa kembali ?',
      showCancelButton: true,
      confirmButtonText: "Yakin",
      cancelButtonText: "Batal"
    }).then((result) => {
      if (result.isConfirmed) {
        htmx.trigger(el, 'confirmed');
      }
    })
  }
</script>