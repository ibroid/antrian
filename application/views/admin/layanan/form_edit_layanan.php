<form
  method="post"
  autocomplete="off"
  class="needs-validation"
  action="<?= base_url("layanan/simpan/" . Cypher::urlsafe_encrypt($jenis_layanan->id)) ?>"
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
      value="<?= $jenis_layanan->nama_layanan ?>"
      aria-describedby="input1" />
  </div>
  <div class="input-group mb-3">
    <span class="input-group-text" id="input1">Kode Layanan : </span>
    <input
      required
      value="<?= $jenis_layanan->kode_layanan ?>"
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