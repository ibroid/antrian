<style>
  .widget-with-chart {
    background-image: none;
  }

  .widget-1 {
    background-image: none;
  }
</style>

<div class="container-fluid py-3">
  <?= $this->session->flashdata("flash_alert") ?>
  <?= $this->session->flashdata("flash_error") ?>
  <?= $this->load->component("card/widget_current_persidangan") ?>
  <div class="row mt-3">
    <!-- Widget Total Antrian -->
    <div class="col-xl-3 col-md-6 col-sm-12">
      <div class="card widget-1" onclick="document.location.href='<?= base_url('persidangan') ?>'">
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
              <h4><?= $antrian->count() ?></h4><span class="f-light">Total Antrian</span>
            </div>
          </div>
          <div class="font-success f-w-500"></div>
        </div>
      </div>
    </div>
    <!-- Widget Menunggu Di ruang tunggu sidang utama -->
    <div class="col-xl-3 col-md-6 col-sm-12">
      <div class="card widget-1 btn-search" data-search-column="5" data-search-content="Menunggu Di Ruang Tunggu">
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
              <h4><?= $antrian->where("status", 1)->count() ?></h4><span class="f-light">Di ruang tunggu sidang</span>
            </div>
          </div>
          <div class="font-success f-w-500"></div>
        </div>
      </div>
    </div>
    <!-- Widget Sudah dipanggil -->
    <div class="col-xl-3 col-md-6 col-sm-12">
      <div class="card widget-1 btn-search" data-search-column="5" data-search-content="Sudah Di Panggil">
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
              <h4><?= $antrian->where("status", 3)->count() ?></h4><span class="f-light">Sudah Di Panggil</span>
            </div>
          </div>
          <div class="font-success f-w-500"></div>
        </div>
      </div>
    </div>
    <!-- Widget Total Skors -->
    <div class="col-xl-3 col-md-6 col-sm-12">
      <div class="card widget-1 btn-search" data-search-column="5" data-search-content="Di Skors">
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
              <h4><?= $antrian->where("status", 4)->count() ?></h4><span class="f-light">Di Skors/Lewati</span>
            </div>
          </div>
          <div class="font-success f-w-500"></div>
        </div>
      </div>
    </div>
    <!-- Widget Belum ambil antrian -->
    <div class="col-xl-3 col-md-6 col-sm-12">
      <div class="card widget-1" data-bs-toggle="modal" data-bs-target="#modalBelumAmbilAntrian">
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
              <h4><?= $jadwal_sidang->whereNotIn("id", $antrian->pluck("jadwal_sidang_id"))->count() ?></h4><span class="f-light">Belum mengambil antrian</span>
            </div>
          </div>
          <div class="font-success f-w-500"></div>
        </div>
      </div>
    </div>
    <!-- Widget Belum di panggil kedalam  -->
    <div class="col-xl-3 col-md-6 col-sm-12">
      <div class="card widget-1 btn-search" data-search-column="5" data-search-content="Belum Dipanggil">
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
              <h4><?= $antrian->where("status", 0)->count() ?></h4><span class="f-light">Belum di panggil ke dalam</span>
            </div>
          </div>
          <div class="font-success f-w-500"></div>
        </div>
      </div>
    </div>
    <!-- Total Sidang Hari Ini -->
    <?= $this->load->component("card/widget_total_sidang") ?>
    <!-- Lahan Kosong -->
    <div class="col-xl-3 col-md-6 col-sm-12">
      <div class="card widget-1">
        <div class="card-body ">
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
              <h4><?= $antrian->where("priority", 1)->count() ?></h4><span class="f-light">Antrian Prioritas</span>
            </div>
          </div>
          <div class="font-warning f-w-500"></div>
        </div>
      </div>
    </div>
  </div>
  <div class="row mx-1">
    <div class="card">
      <div class="card-body">
        <div class="text-center">
          <button class="btn btn-reset-search btn-secondary">
            <i class="fa fa-refresh"></i>
            Reset Pencarian</button>
        </div>
        <div class="table-responsive">

          <table class="table table-hover table-striped table-responsive" id="table-antrian">
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
                  <td>

                    <h6> <strong>No. <?= $a->nomor_urutan ?> </strong></h6>

                  </td>
                  <td>
                    <?= $a->nomor_perkara ?>
                    <br>
                    <details>
                      <div class="badge badge-secondary">
                        <?= $a->perkara->jenis_perkara_nama ?>
                      </div>
                      <br>
                      <?= $a->jadwal_sidang->agenda ?? "" ?>
                    </details>
                  </td>
                  <td>
                    <?= $a->perkara->para_pihak  ?>
                  </td>
                  <td><?= $a->majelis_hakim  ?></td>
                  <td>
                    <?= badge_status_antrian_sidang($a->status) ?>
                    <br>
                    <?= $a->priority == 1 ? "<div class=\"badge badge-primary\">Prioritas</div>" : null ?>
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



<!-- Modal -->
<div class="modal fade" id="modalAntrian" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
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

<div class="modal fade" id="modalSidangHariIni" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTitleId">
          Daftar Sidang Hari Ini
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <table class="table table-responsive table-hover table-bordered" id="table-sidang">
          <thead>
            <tr>
              <th>No</th>
              <th>Pekara</th>
              <th>Pihak P </th>
              <th>Kuasa P</th>
              <th>Pihak T </th>
              <th>Kuasa T</th>
              <th>Ruangan</th>
              <th>Majelis</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($jadwal_sidang as $n => $ds) { ?>
              <tr onclick="handleRowClickSidang(<?= $ds->id ?>)">
                <td><?= ++$n ?></td>
                <td><?= $ds->perkara->nomor_perkara ?><br><?= $ds->perkara->jenis_perkara_nama ?></td>
                <td>
                  <?= $ds->perkara->pihak_satu[0]->nama ?>
                </td>
                <td>
                  <?php if (count($ds->perkara->pengacara_satu) > 0) {
                    echo  $ds->perkara->pengacara_satu[0]->nama;
                  } ?>
                </td>
                <td>
                  <?php if (count($ds->perkara->pihak_dua) !== 0) {
                    echo  $ds->perkara->pihak_dua[0]->nama;
                  }  ?>
                </td>
                <td>
                  <?php if (count($ds->perkara->pengacara_dua) > 0) {
                    echo  $ds->perkara->pengacara_dua[0]->nama;
                  } ?>
                </td>
                <td><?= $ds->ruangan ?><br><?= str_replace("Panitera Pengganti:", "", $ds->perkara->penetapan->panitera_pengganti_text)  ?></td>
                <td><?= $ds->perkara->penetapan->majelis_hakim_nama ?></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
          Close
        </button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="modalBelumAmbilAntrian" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTitleId">
          Daftar Sidang Hari Ini
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <table class="table table-responsive table-hover table-bordered" id="table-sidang">
          <thead>
            <tr>
              <th>No</th>
              <th>Pekara</th>
              <th>Pihak P </th>
              <th>Kuasa P</th>
              <th>Pihak T </th>
              <th>Kuasa T</th>
              <th>Ruangan</th>
              <th>Majelis</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($jadwal_sidang->whereNotIn("id", $antrian->pluck("jadwal_sidang_id"))->all() as $n => $ds) { ?>
              <tr onclick="handleRowClickSidang(<?= $ds->id ?>)">
                <td><?= ++$n ?></td>
                <td><?= $ds->perkara->nomor_perkara ?><br><?= $ds->perkara->jenis_perkara_nama ?></td>
                <td>
                  <?= $ds->perkara->pihak_satu[0]->nama ?>
                </td>
                <td>
                  <?php if (count($ds->perkara->pengacara_satu) > 0) {
                    echo  $ds->perkara->pengacara_satu[0]->nama;
                  } ?>
                </td>
                <td>
                  <?php if (count($ds->perkara->pihak_dua) !== 0) {
                    echo  $ds->perkara->pihak_dua[0]->nama;
                  }  ?>
                </td>
                <td>
                  <?php if (count($ds->perkara->pengacara_dua) > 0) {
                    echo  $ds->perkara->pengacara_dua[0]->nama;
                  } ?>
                </td>
                <td><?= $ds->ruangan ?><br><?= str_replace("Panitera Pengganti:", "", $ds->perkara->penetapan->panitera_pengganti_text)  ?></td>
                <td><?= $ds->perkara->penetapan->majelis_hakim_nama ?></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
          Close
        </button>
      </div>
    </div>
  </div>
</div>

<script>
  let modalAntrian
  let modalSidang
  let modalBelumAmbilAntrian

  window.addEventListener('load', function() {

    const pusher = new Pusher('a360f9f6cfefca4c383b', {
      cluster: 'ap1'
    });

    const channel = pusher.subscribe('antrian-channel');

    channel.bind('new-antrian', function(data) {
      notifToas("Ada antrian baru. Silahkan refresh halaman ini")
    });

    modalAntrian = new bootstrap.Modal(document.getElementById('modalAntrian'))
    modalSidang = new bootstrap.Modal(document.getElementById('modalSidangHariIni'))
    modalBelumAmbilAntrian = new bootstrap.Modal(document.getElementById('modalBelumAmbilAntrian'))

    const tableSidang = $('#table-antrian').DataTable()
    $('#table-sidang').DataTable()

    $(".btn-search").each((i, e) => {
      $(e).click(function() {
        tableSidang.column($(e).data('search-column')).search($(e).data('search-content')).draw();
      })
    })

    $(".btn-reset-search").click(() => {
      tableSidang.search('').columns().search('').draw();
    })

  });

  const modalAntrianElement = document.getElementById('modalAntrian');

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

  const handleRowClickSidang = (sidang_id) => {
    modalAntrian.show()
    modalSidang.hide()
    $.ajax({
      url: "<?= base_url("ambil/fetch_table_checkin?secondary_print=true") ?>",
      method: "POST",
      data: {
        sidang_id: sidang_id
      },
      success(html) {
        $("#modalAntrian-body").html(html)
      },
      error(err) {
        $("#modalAntrian-body").html(err.responseText && err.message)
      }
    })
  }

  const changeKehadiran = (e, id) => {
    Swal.fire({
      title: "Loading...",
      showConfirmButton: false,
      backdrop: true,
      allowOutsideClick: false,
      willOpen: () => Swal.showLoading()
    })

    $.ajax({
      url: "<?= base_url("persidangan/update_kehadiran_pihak") ?>/" + id,
      method: "POST",
      data: {
        status: e.checked ? 1 : 0
      },
      success: function(data) {
        Swal.close()
      },
      error: function(err) {
        Swal.fire({
          icon: "error",
          title: "Oops...",
          text: err.responseText ?? err.message,
        })
        e.checked = false
      }
    })
  }

  async function checkIn(id) {
    const {
      isConfirmed
    } = await Swal.fire({
      title: 'Check-In Ke Ruang Tunggu',
      text: "Apakah salah satu pihak yang di panggil sudah hadir ?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya, Check-In!'
    })

    if (isConfirmed) {
      $.ajax({
        url: "<?= base_url("persidangan/update_antrian") ?>/" + id,
        method: "POST",
        data: {
          status: 1,
        },
        success: function(data) {
          Swal.fire("Sukses", "Berhasil Check-In", "success").then(() => {
            location.reload()
          })
        },
        error: function(err) {
          Swal.fire("Terjadi Kesalahan", err.responseText && err.message, "error")
        }
      })
    }
  }

  function notifToas(message = "") {
    Toastify({
      text: message,
      duration: 5000,
      destination: "<?= base_url("persidangan") ?>",
      close: true,
      gravity: "top", // `top` or `bottom`
      position: "center", // `left`, `center` or `right`
      stopOnFocus: true, // Prevents dismissing of toast on hover
      onClick: function() {} // Callback after click
    }).showToast();
  }
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>