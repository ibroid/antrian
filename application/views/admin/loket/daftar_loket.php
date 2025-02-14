<div class="container-fluid py-3">
  <?= $this->session->flashdata("flash_alert") ?>
  <?= $this->session->flashdata("flash_error") ?>
  <div class="row">
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
              <h4><?= $lokets->count() ?></h4><span class="f-light">Total Loket</span>
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
              <h4><?= $lokets->where('status', 2)->count() ?></h4><span class="f-light">Loket Tidak Aktif</span>
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
              <h4><?= $lokets->where('status', '!=', 2)->count() ?></h4><span class="f-light">Loket Aktif</span>
            </div>
          </div>
          <div class="font-primary f-w-500"></div>
        </div>
      </div>
    </div>
    <div class="col-xl-3">
      <div class="card widget-1" style="background-image: none;">
        <div class="card-body">
          <div class="widget-content">
            <div class="widget-round success">
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
              <h4><?= $lokets->where('status',  1)->count() ?></h4><span class="f-light">Loket Online</span>
            </div>
          </div>
          <div class="font-success f-w-500"></div>
        </div>
      </div>
    </div>
  </div>
  <div class="row mx-1">
    <div class="d-flex justify-content-center">
      <div class="center">
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
          Tambah Loket Baru
          <i class="fa fa-plus"></i>
        </button>
      </div>
      <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel">Form Tambah Loket Baru</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form
                action="<?= base_url('loket/create') ?>"
                method="post"
                enctype="multipart/form-data"
                class="needs-validation"
                novalidate>
                <div class="row">
                  <div class="col-12">
                    <div class="form-group mb-3">
                      <label for="name">Nama</label>
                      <input type="text" required class="form-control" name="nama_loket" placeholder="Customer Service ... " id="name">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-8">
                    <div class="form-group">
                      <label for="warna">Warna</label>
                      <div class="input-group mb-3">
                        <select class="form-control" required name="warna_loket" id="warna">
                          <option value="dark">Dark</option>
                          <option value="primary">Primary</option>
                          <option value="success">Success</option>
                          <option value="danger">Danger</option>
                          <option value="info">Info</option>
                          <option value="secondary">Secondary</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-4">
                    <label for="warna">Contoh Warna</label>
                    <div id="contoh-warna" class="text-center p-2 bg-dark">
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
                        <option value="0">Aktif</option>
                        <option value="2">Tidak
                          Aktif</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12">
                    <div class="form-group mb-3">
                      <label for="input-audio-loket">Audio Loket</label>
                      <input type="file" required class="form-control" name="audio_file" id="input-audio-loket">
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="alert alert-warning">
                      <h6>Petunjuk membuat audio loket !</h6>
                      <p>1. Silahkan masuk ke https://ttsmaker.com</p>
                      <p>2. Pilih language indonesia</p>
                      <p>3. Pilih voice Unilimited Dewi Indonesia Female</p>
                      <p>4. Masukan isi text berikut "ke loket $nama_loket_anda"</p>
                      <p>5. Isi captha lalu klik Convert To Speech</p>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12 text-center">
                    <button type="submit" class="btn btn-sm btn-primary">
                      <i class="fa fa-save"></i>
                      Simpan
                    </button>
                  </div>
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
          </div>
        </div>
      </div>
    </div>
    <div class="row mx-1">
      <div class="col-6 col-sm-6">
        <div class="text-center mb-4">
          <h5>Loket Aktif</h5>
        </div>
        <div class="p-2 border border-2 border-primary rounded-4" id="sortable-1">
          <?php foreach ($lokets->where('status', '!=', 2)->all() as $key => $value) : ?>
            <div class="bg-white p-3 mb-3 shadow-sm" data-id="<?= $value->id ?>">
              <div class="d-flex">
                <i class="fa fa-list" style="font-size: 2.5rem;"></i>
                <div class="mx-4 flex-grow-1">
                  <h5 class="mb-0"><?= $value->nama_loket ?></h5>
                  <span class="f-light"></span>
                </div>
                <div class="me-auto">
                  <a
                    href="javascript:void(0)"
                    onclick="playAudio('<?= $value->file_audio ?>')"
                    class="h5">
                    <i class="fa fa-volume-up"></i>
                  </a>
                  <a data-bs-toggle="tooltip" data-bs-title="Ubah data loket ini" href="<?= base_url('/loket/edit/' . Cypher::urlsafe_encrypt($value->id)) ?>" class="text-warning h5"><i class="fa fa-edit"></i></a>
                  <a data-bs-toggle="tooltip" data-bs-title="Loket ini sedang <?= $value->status == 1 ? "online" : "offline" ?>" href="javascript:void(0)" class="text-<?= $value->status == 1 ? "success" : "danger" ?> h5">
                    <i class="fa fa-circle"></i></a>
                </div>
              </div>
            </div>
          <?php endforeach ?>
        </div>
      </div>
      <div class="col-6 col-sm-6">
        <div class="text-center mb-4">
          <h5>Loket Tidak Aktif</h5>
        </div>
        <div class="p-2 border border-2 border-secondary rounded-4" id="sortable-2">
          <?php foreach ($lokets->where('status',  2)->all() as $key => $value) : ?>
            <div class="bg-white p-3 mb-3 shadow-sm" data-id="<?= $value->id ?>">
              <div class="d-flex">
                <i class="fa fa-list" style="font-size: 2.5rem;"></i>
                <div class="mx-4 flex-grow-1">
                  <h5 class="mb-0"><?= $value->nama_loket ?></h5>
                </div>
                <div class="me-auto">
                  <a
                    href="javascript:void(0)"
                    onclick="playAudio('<?= $value->file_audio ?>')"
                    class="h5">
                    <i class="fa fa-volume-up"></i>
                  </a>
                  <a data-bs-toggle="tooltip" data-bs-title="Ubah data loket ini" href="<?= base_url('/loket/edit/' . Cypher::urlsafe_encrypt($value->id)) ?>" class="text-warning h5"><i class="fa fa-edit"></i></a>
                  <a data-bs-toggle="tooltip" data-bs-title="Loket ini sedang <?= $value->status == 1 ? "online" : "offline" ?>" href="javascript:void(0)" class="text-<?= $value->status == 1 ? "success" : "danger" ?> h5">
                    <i class="fa fa-circle"></i></a>
                </div>
              </div>
            </div>
          <?php endforeach ?>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  var globalAudio;
  var isPlayed = false;

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
      onUpdate: function(evt) {
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

  /**
   * @param {string} audioFileName  
   */
  function playAudio(audioFileName) {
    if (isPlayed) {
      showToast("Sedang memutar audio lain")
      return;
    }

    globalAudio = new Audio("/audio/nomor_antrian/" + audioFileName)

    isPlayed = true;
    globalAudio.play()

    globalAudio.addEventListener("ended", () => {
      isPlayed = false;
    })
  }
</script>