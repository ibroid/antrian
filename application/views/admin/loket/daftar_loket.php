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
                <span class="f-light">Kode : <?= $value->kode_loket ?>.</span>
                <span class="f-light"></span>
              </div>
              <div class="me-auto">
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
                <span class="f-light">Kode : <?= $value->kode_loket ?></span>
              </div>
              <div class="me-auto">
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