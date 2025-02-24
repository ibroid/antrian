<div class="container-fluid py-3">
  <?= $this->session->flashdata('flash_alert') ?>
  <?= $this->session->flashdata('flash_error') ?>
  <div class="card">
    <div class="card-header">
      <div class="d-flex justify-content-between align-items-center">
        <div class="text-header">
          <h5>Daftar Running Text Content</h5>
        </div>
        <div class="text-end">
          <button
            class="btn btn-primary"
            data-bs-toggle="modal"
            data-bs-target="#staticBackdrop">
            <i class="fa fa-plus"></i>
            Tambah Content
          </button>

          <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="staticBackdropLabel">Tambah Content Baru</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form
                    autocomplete="off"
                    action="<?= base_url('running_text/create') ?>"
                    method="POST"
                    class="needs-validation"
                    enctype="multipart/form-data"
                    novalidate>
                    <div class="input-group mb-3">
                      <span class="input-group-text" id="input1">
                        Deskripsi
                      </span>
                      <textarea type="text" class="form-control" placeholder="Tulis informasi disini .." aria-label="Username" maxlength="191" required aria-describedby="input1" name="content"></textarea>
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
            <th>Desc</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($contents as $n => $content) { ?>
            <tr>
              <th><?= ++$n  ?></th>
              <th><?= $content->content  ?></th>
              <th>
                <button
                  class="btn btn-sm btn-secondary"
                  hx-delete="<?= base_url('running_text/delete/' . Cypher::urlsafe_encrypt($content->id)) ?>"
                  hx-trigger='confirmed'
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
    $("#table-petugas").DataTable()
  })
</script>