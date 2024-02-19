<style>
  .widget-with-chart {
    background-image: none;
  }
</style>

<div class="container-fluid py-3">
  <div class="row g-sm-3 height-equal-2 widget-charts">
    <div class="col-sm-12 col-md-4 col-lg-4">
      <div class="card small-widget mb-sm-0">
        <div class="card-body primary">
          <span class="f-light">Ruang Sidang Satu : Umar Bin Khatab (1)</span>
          <div class="d-flex align-items-end gap-1">
            <span class="font-secondary f-12 f-w-500">
              <span>(22)</span>
              <i class="icon-arrow-left"></i>
            </span>
            <h5>(23) 123/Pdt.G/2022</h5>
            <span class="font-primary f-12 f-w-500">
              <i class="icon-arrow-right"></i>
              <span>(24)</span>
            </span>
          </div>
          <div class="bg-gradient">
            <svg class="stroke-icon svg-fill">
              <use href="../assets/svg/icon-sprite.svg#new-order"></use>
            </svg>
          </div>
          <div class="flex mt-4">
            <!-- <button class="btn btn-outline-primary btn-sm">Lihat Antrian</button> -->
            <button class="btn btn-outline-primary btn-sm">Lihat CCTV</button>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-12 col-md-4 col-lg-4">
      <div class="card small-widget mb-sm-0">
        <div class="card-body warning"><span class="f-light">Ruang Sidang Dua : Abu Musa (2)</span>
          <div class="d-flex align-items-end gap-1">
            <h4>2,908</h4><span class="font-warning f-12 f-w-500"><i class="icon-arrow-up"></i><span>+20%</span></span>
          </div>
          <div class="bg-gradient">
            <svg class="stroke-icon svg-fill">
              <use href="../assets/svg/icon-sprite.svg#customers"></use>
            </svg>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-12 col-md-4 col-lg-4">
      <div class="card small-widget mb-sm-0">
        <div class="card-body secondary"><span class="f-light">Ruang Sidang Tiga : Asyuraih (3)</span>
          <div class="d-flex align-items-end gap-1">
            <h4>$389k</h4><span class="font-secondary f-12 f-w-500"><i class="icon-arrow-down"></i><span>-10%</span></span>
          </div>
          <div class="bg-gradient">
            <svg class="stroke-icon svg-fill">
              <use href="../assets/svg/icon-sprite.svg#sale"></use>
            </svg>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?= $this->session->flashdata("flash_alert") ?>
  <?= $this->session->flashdata("flash_error") ?>
  <div class="row mt-3">
    <div class="card">
      <div class="card-body">
        <table class="table table-hover" id="table-antrian">
          <thead>
            <tr>
              <th>Ruangan</th>
              <th>Antrian</th>
              <th>Perkara</th>
              <th>Para Pihak</th>
              <th>Majelis</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($antrian as $a) { ?>
              <tr onclick='handleRowClick(<?= $a->id ?>)'>
                <td> <?= badge_nama_ruang_sidang($a->nomor_ruang) ?></td>
                <td>No. <?= $a->nomor_urutan ?></td>
                <td><?= $a->nomor_perkara ?><br><?= $a->perkara->jenis_perkara_nama ?></td>
                <td>
                  <?= $a->perkara->para_pihak  ?>
                </td>
                <td><?= $a->majelis_hakim  ?></td>
                <td><?= badge_status_antrian_sidang($a->status) ?></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>



<!-- Modal -->
<div class="modal fade" id="modalAntrian" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTitleId">
          Menu Panggilan
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="modalAntrian-body">
        <div class="container-fluid">
          <div class="text-center">
            <h4>Mohon Tunggu</h4>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



<script>
  let modalAntrian
  window.addEventListener('load', function() {
    modalAntrian = new bootstrap.Modal(document.getElementById('modalAntrian'))

    $('#table-antrian').DataTable()
  });
  var modalAntrianElement = document.getElementById('modalAntrian');

  modalAntrianElement.addEventListener('hide.bs.modal', function(event) {
    $("#modalAntrian-body").html(" <div class=\"container-fluid\"><div class=\"text-center\"><h4>Mohon Tunggu ...</h4></div></div>")
  });

  const handleRowClick = (id) => {
    modalAntrian.show()
    $.ajax({
      url: "<?= base_url("persidangan/fetch_modal_antrian") ?>",
      method: "POST",
      data: {
        id: id
      },
      success: function(data) {
        $("#modalAntrian-body").html(data)
      },
      error: function(err) {
        $("#modalAntrian-body").html(`<div class=\"container-fluid\"><div class=\"text-center\"><h4>${err.responseText ?? err.message}</h4></div></div>`)
      }
    })
  }
</script>