<div class="container-fluid py-3">
  <?= $this->session->flashdata('flash_alert') ?>
  <?= $this->session->flashdata('flash_error') ?>
  <div class="card">
    <div class="card-header">
      <div class="d-flex justify-content-between align-items-center">
        <div class="text-header">
          <h5>Daftar Banner</h5>
        </div>
        <div class="text-end">
          <button
            class="btn btn-primary"
            data-bs-toggle="modal"
            data-bs-target="#staticBackdrop">
            <i class="fa fa-plus"></i>
            Tambah Printer
          </button>

          <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="staticBackdropLabel">Tambah Printer Baru</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form
                    autocomplete="off"
                    action="<?= base_url('printer/create') ?>"
                    method="POST"
                    class="needs-validation"
                    novalidate>
                    <div class="input-group mb-3">
                      <span class="input-group-text" id="input1">
                        IP Address
                      </span>
                      <input
                        type="text"
                        class="form-control"
                        placeholder="192 ..."
                        aria-label="Username"
                        maxlength="15"
                        required
                        aria-describedby="input1"
                        name="ip_address" />
                    </div>
                    <div class="input-group mb-3">
                      <span class="input-group-text" id="input2">
                        Port
                      </span>
                      <input
                        type="text"
                        class="form-control"
                        placeholder="3200"
                        aria-label="3200"
                        maxlength="6"
                        required
                        aria-describedby="input2"
                        name="port" />
                    </div>
                    <div class="input-group mb-3">
                      <span class="input-group-text" id="input2">
                        Type
                      </span>
                      <select name="type" class="form-select" aria-label="Default select printer">
                        <option selected>native</option>
                        <option>bridge</option>
                      </select>
                    </div>
                    <div class="input-group mb-3">
                      <span class="input-group-text" id="input2">
                        Desc
                      </span>
                      <textarea class="form-control" placeholder="Tulis informasi disini .." aria-label="Username" maxlength="191" required aria-describedby="input1" name="desc"></textarea>
                    </div>
                    <button class="btn btn-primary" type="submit">
                      Simpan
                    </button>
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
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="card-body">
      <table class="table table-hover table-striped" id="table-banner">
        <thead>
          <tr>
            <th>No</th>
            <th>IP Address</th>
            <th>Port</th>
            <th>Desc</th>
            <th>Status</th>
            <th>Type</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($printers as $n => $printer) { ?>
            <tr>
              <th><?= ++$n  ?></th>
              <th><?= $printer->ip_address  ?></th>
              <th><?= $printer->port  ?></th>
              <th><?= $printer->desc  ?></th>
              <th>
                <ul class="tg-list common-flex">
                  <li class="tg-list-item">
                    <input
                      hx-post="<?= base_url("/printer/set_active/" . Cypher::urlsafe_encrypt($printer->id)) ?>"
                      hx-trigger="change"
                      hx-on::before-request="$(this).attr('disabled', true)"
                      hx-on::after-request="$(this).attr('disabled', false)"
                      hx-swap="none"
                      hx-vals='js:{status: $("#cb3<?= Cypher::urlsafe_encrypt($printer->id) ?>").is(":checked") }'
                      <?php if ($printer->active == 1) {
                        echo "checked";
                      } ?>
                      class="tgl tgl-skewed checked"
                      id="cb3<?= Cypher::urlsafe_encrypt($printer->id) ?>"
                      type="checkbox">
                    <label class="tgl-btn" data-tg-off="OFF" data-tg-on="ON" for="cb3<?= Cypher::urlsafe_encrypt($printer->id) ?>"></label>
                  </li>
                </ul>
              </th>
              <th><?= $printer->type  ?></th>
              <th>
                <button
                  class="btn btn-sm btn-secondary"
                  hx-delete="<?= base_url('printer/delete/' . Cypher::urlsafe_encrypt($printer->id)) ?>"
                  hx-trigger='confirmed'
                  hx-swap="none"
                  onClick="Swal.fire({title: 'Apa anda yakin ?', text:'Banner akan dihapus. Data yang hilang tidak bisa kembali',icon : 'warning', showCancelButton: true }).then((result)=>{ if(result.isConfirmed) { $(this).attr('disabled',true); htmx.trigger(this, 'confirmed'); } })">
                  Hapus</button>
              </th>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<script>
  window.addEventListener("load", function() {
    $("#table-banner").DataTable()
  })

  document.body.addEventListener("failSetActive", function(evt) {
    $(evt.detail.elt).prop('checked', false);
  })

  document.addEventListener("htmx:afterRequest", (evt) => {
    Toastify({
      text: evt.detail.xhr.responseText,
      duration: 4500,
      gravity: "top",
      position: 'center',
    }).showToast();
  })
</script>