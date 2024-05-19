<div class="container-fluid py-3">
  <div class="row mx-1">
    <div class="col-12">
      <?= $this->session->flashdata("flash_alert") ?>
      <?= $this->session->flashdata("flash_error") ?>
      <div class="d-flex justify-content-center">
        <div class="card col-md-6 col-lg-6 col-xl-6">
          <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
              <h5 class="m-0">Edit Loket</h5>
              <a href="<?= base_url('loket') ?>" class="btn btn-sm btn-secondary"><i class="fa fa-arrow-left"></i> Kembali</a>
            </div>
          </div>
          <div class="card-body">
            <form action="<?= base_url('loket/update') ?>" method="post">
              <input type="hidden" name="id" value="<?= Cypher::urlsafe_encrypt($loket->id) ?>">
              <div class="row">
                <div class="col-12">
                  <div class="form-group mb-3">
                    <label for="name">Nama</label>
                    <input type="text" required class="form-control" name="nama_loket" id="name" value="<?= $loket->nama_loket ?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-8">
                  <div class="form-group">
                    <label for="warna">Warna</label>
                    <div class="input-group mb-3">
                      <select class="form-control" required name="warna_loket" id="warna">
                        <option value="primary" <?= $loket->warna_loket == 'primary' ? 'selected' : '' ?>>Primary</option>
                        <option value="success" <?= $loket->warna_loket == 'success' ? 'selected' : '' ?>>Success</option>
                        <option value="danger" <?= $loket->warna_loket == 'danger' ? 'selected' : '' ?>>Danger</option>
                        <option value="info" <?= $loket->warna_loket == 'info' ? 'selected' : '' ?>>Info</option>
                        <option value="secondary" <?= $loket->warna_loket == 'secondary' ? 'selected' : '' ?>>Secondary</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-4">
                  <label for="warna">Contoh Warna</label>
                  <div id="contoh-warna" class="text-center p-2 bg-<?= $loket->warna_loket ?>">
                    <span>Warna Disini</span>
                  </div>
                </div>
              </div>
              <script>
                window.addEventListener('load', function() {
                  $('#warna').on('change', function() {
                    $('#contoh-warna').attr('class', 'rounded-2 text-center p-2 bg-' + $(this).val());
                  });
                })
              </script>
              <div class="row">
                <div class="col-12">
                  <div class="form-group mb-3">
                    <label for="status">Status</label>
                    <select class="form-control" name="status" id="status">
                      <option value="1" <?= $loket->status == 0 ? 'selected' : '' ?>>Aktif</option>
                      <option value="0" <?= $loket->status == 2 ? 'selected' : '' ?>>Tidak
                        Aktif</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12 text-center">
                  <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-save"></i> Simpan</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<script>
  function sortable(evt, status = 0, parentSelector = "#sortable-1 > .bg-white") {
    const toast = Toastify({
      text: 'Sedang menyimpan. Mohon tunggu ...',
      duration: -1,
      close: false,
      gravity: "top", // `top` or `bottom`
      position: "center", // `left`, `center` or `right`
      stopOnFocus: true, // Prevents dismissing of toast on hover
    }).showToast();

    const body = new FormData()
    $(parentSelector).map(function(i, e) {
      body.append('id[]', $(e).data('id'))
      body.append('urutan[]', i + 1)
    });

    body.append('panjang', $(parentSelector).length)
    body.append('status', status)

    $.ajax({
      url: "<?= base_url('loket/reorder') ?>",
      method: "POST",
      data: body,
      processData: false,
      contentType: false,
      success: function(data) {
        showToast("Data loket berhasil disimpan")
      },
      error(err) {
        showToast("Terjadi Kesalahan. Silahkan coba kembali. " +
          err.responseText ?? err.message)
      },
      complete() {
        toast.hideToast()
      }
    })
  }

  window.addEventListener("load", function() {
    const el1 = document.getElementById('sortable-1');
    const el2 = document.getElementById('sortable-2');

    Sortable.create(el1, {
      group: 'shared',
      animation: 150,
      ghostClass: 'bg-dark',
      onAdd: sortable,
      onUpdate: sortable,

    });

    Sortable.create(el2, {
      group: 'shared',
      animation: 150,
      ghostClass: 'bg-dark',
      onAdd: function(evt) {
        sortable(evt, 2, "#sortable-2 > .bg-white")
      },
      onUpdate: function() {
        sortable(evt, 2, "#sortable-2 > .bg-white")
      }
    });

  })

  function showToast(message = "") {
    Toastify({
      text: message,
      duration: 3000,
      close: true,
      gravity: "top", // `top` or `bottom`
      position: "center", // `left`, `center` or `right`
      stopOnFocus: true, // Prevents dismissing of toast on hover
    }).showToast();
  }
</script>