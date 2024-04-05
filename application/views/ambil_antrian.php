<div class="row ">
  <div class="col-xl-12 p-0">
    <?= $this->session->flashdata('flash_error') ?>
    <?= $this->session->flashdata('flash_alert') ?>

    <div class="login-card login-dark ">
      <div class="login-main" style="width: 1200px;">
        <div class="text-center my-3">

          <h4>Menu Pengambilan Antrian PTSP.</h4>

        </div>

        <div class="row">
          <div class="col-3">
            <div class="card small-widget mb-sm-0 bg-warning card-ambil-antrian-ptsp" data-antrian-tujuan="POSBAKUM">
              <div class="card-body primary"> <span class="f-light text-light">Antrian Sekarang : 0</span>
                <div class="d-flex align-items-end gap-1">
                  <h4>POSBAKUM</h4>
                </div>
                <div class="bg-gradient">
                  <svg class="stroke-icon svg-fill">
                    <use href="../assets/svg/icon-sprite.svg#user-visitor"></use>
                  </svg>
                </div>
              </div>
            </div>
          </div>
          <div class="col-3">
            <div class="card small-widget mb-sm-0 bg-warning card-ambil-antrian-ptsp" data-antrian-tujuan="PENDAFTARAN">
              <div class="card-body primary"> <span class="f-light text-light">Antrian Sekarang : 0</span>
                <div class="d-flex align-items-end gap-1">
                  <h4>PENDAFTARAN</h4>
                </div>
                <div class="bg-gradient">
                  <svg class="stroke-icon svg-fill">
                    <use href="../assets/svg/icon-sprite.svg#user-visitor"></use>
                  </svg>
                </div>
              </div>
            </div>
          </div>
          <div class="col-3">
            <div class="card small-widget mb-sm-0 bg-warning card-ambil-antrian-ptsp" data-antrian-tujuan="INFORMASI">
              <div class="card-body primary"> <span class="f-light text-light">Antrian Sekarang : 0</span>
                <div class="d-flex align-items-end gap-1">
                  <h4>INFORMASI</h4>
                </div>
                <div class="bg-gradient">
                  <svg class="stroke-icon svg-fill">
                    <use href="../assets/svg/icon-sprite.svg#user-visitor"></use>
                  </svg>
                </div>
              </div>
            </div>
          </div>
          <div class="col-3">
            <div class="card small-widget mb-sm-0 bg-warning card-ambil-antrian-ptsp" data-antrian-tujuan="E-COURT">
              <div class="card-body primary"> <span class="f-light text-light">Antrian Sekarang : 0</span>
                <div class="d-flex align-items-end gap-1">
                  <h4>E-COURT</h4>
                </div>
                <div class="bg-gradient">
                  <svg class="stroke-icon svg-fill">
                    <use href="../assets/svg/icon-sprite.svg#user-visitor"></use>
                  </svg>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="d-flex justify-content-center mt-4 gap-4">
          <div class="card small-widget mb-sm-0 bg-warning" style="width: 260px;">
            <div class="card-body primary"> <span class="f-light text-light">Antrian Sekarang : 0</span>
              <div class="d-flex align-items-end gap-1">
                <h4>PRODUK</h4>
              </div>
              <div class="bg-gradient">
                <svg class="stroke-icon svg-fill">
                  <use href="../assets/svg/icon-sprite.svg#user-visitor"></use>
                </svg>
              </div>
            </div>
          </div>
          <div class="card small-widget mb-sm-0 bg-warning card-ambil-antrian-ptsp" data-antrian-tujuan="KASIR" style="width: 260px;">
            <div class="card-body primary"> <span class="f-light text-light">Antrian Sekarang : 0</span>
              <div class="d-flex align-items-end gap-1">
                <h4>KASIR</h4>
              </div>
              <div class="bg-gradient">
                <svg class="stroke-icon svg-fill">
                  <use href="../assets/svg/icon-sprite.svg#user-visitor"></use>
                </svg>
              </div>
            </div>
          </div>


        </div>


        <hr>
        <div class="text-center my-4">
          <h4>Apabila akan bersidang. Silahkan cari dan tekan nama anda dibawah ini</h4>
        </div>


        <form action="<?= base_url('/ambil') ?>" style="width: 500px;" class="my-3" method="POST">
          <h6>Cari Berdasarkan Tanggal</h6>
          <div class="input-group mt-2">
            <input class="form-control date-picker" type="text" name="tanggal_sidang" required="Harap Isi Bidang ini">
            <button class="btn btn-outline-warning" id="button-addon2" type="submit">Cari</button>
            <a href="<?= base_url('/ambil') ?>" class="btn btn-outline-danger" id="button-addon3" type="reset">Reset</a>
          </div>
        </form>

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
            <?php foreach ($daftar_sidang as $n => $ds) { ?>
              <tr onclick="handleRowClick(<?= $ds->id ?>)">
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
    </div>
    <p class=" text-center">Crafted By<a class="ms-2" target="_blank" href="https://mmaliki.my.id">Mmaliki</a></p>
  </div>
</div>


<style>
  .btn-floating {
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 99;
  }
</style>

<button type="button" data-bs-toggle="modal" data-bs-target="#bantuan-modal" class="btn btn-success btn-floating btn-lg">
  <i class="fa fa-volume-up"></i>
  <h5>Pusat Bantuan</h5>
</button>




<div class="modal fade" id="checkInModal" tabindex="-1" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTitleId">
          Konfirmasi Kehadiran Pihak
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="checkInModal-body">
        <div class="text-center">
          <h4>Mohon Tunggu ...</h4>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="bantuan-modal" tabindex="-1" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTitleId">
          Jendela Bantuan Antrian
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="bantuan-modal-body">
        <div class="text-center mx-2">
          <h4>Anda Pengunjung Baru ?</h4>
          <button class="btn btn-success btn-audio btn-lg mt-3" data-file-audio="audio-penjelasan-alur-singkat.mp3">
            Penjelasan singkat bagi pengunjung baru
            <i class="fa fa-volume-up"></i>
          </button>
        </div>
        <hr>
        <div class="text-center mx-2">
          <h4>Anda Akan Bersidang ?</h4>
          <button class="btn btn-success btn-audio btn-lg mt-3" data-file-audio="audio-penjelasan-antrian-sidang.mp3">Penjelasan singkat bagi yang bersidang hari ini
            <i class="fa fa-volume-up"></i>
          </button>
        </div>
        <hr>
        <div class="text-center mx-2">
          <h4>Berikut Penjelasan Setiap Loket Pelayanan</h4>
          <button class="btn btn-success btn-audio btn-lg mt-4" data-file-audio="audio-penjelasan-loket-informasi.mp3">Penjelasan Loket Informasi
            <i class="fa fa-volume-up"></i>
          </button>
          <br>
          <button class="btn btn-success btn-audio btn-lg mt-4" data-file-audio="audio-penjelasan-loket-posbakum.mp3">Penjelasan Loket Posbakum
            <i class="fa fa-volume-up"></i>
          </button>
          <br>
          <button class="btn btn-success btn-audio btn-lg mt-4" data-file-audio="audio-penjelasan-loket-pendaftaran.mp3">Penjelasan Loket Pendaftaran
            <i class="fa fa-volume-up"></i>
          </button>
          <br>
          <button class="btn btn-success btn-audio btn-lg mt-4" data-file-audio="audio-penjelasan-loket-kasir.mp3">Penjelasan Loket Kasir
            <i class="fa fa-volume-up"></i>
          </button>
          <br>
          <button class="btn btn-success btn-audio btn-lg mt-4" data-file-audio="audio-penjelasan-loket-produk.mp3">Penjelasan Loket Produk
            <i class="fa fa-volume-up"></i>
          </button>
          <br>
          <button class="btn btn-success btn-audio btn-lg mt-4" data-file-audio="audio-penjelasan-loket-ecourt.mp3">Penjelasan Loket E-Court
            <i class="fa fa-volume-up"></i>
          </button>
        </div>
      </div>
    </div>
  </div>
</div>


<script>
  let checkInModal;
  window.addEventListener("load", function() {
    $(".date-picker").flatpickr();
    $("#table-sidang").DataTable({
      "language": {
        "search": "Pencarian :",
      },
      "pageLength": 50
    });

    checkInModal = new bootstrap.Modal(
      document.getElementById("checkInModal"),
    );

    $(".btn-audio").click(function() {
      const fileAudio = $(this).data("file-audio")
      const audio = new Audio("/audio/" + fileAudio)
      audio.play()
    })

    $(".card-ambil-antrian-ptsp").click(function() {
      const tujuan = $(this).data("antrian-tujuan")
      $.ajax({
        url: "<?= base_url("ambil/ambil_antrian_ptsp") ?>",
        method: "POST",
        data: {
          tujuan: tujuan
        },
        success(data) {
          Swal.fire({
            title: "Silhakan ambil antrian",
            icon: "success",
            html: "Antrian Anda Nomor" + data.nomor_antrian + "<br/><b></b>",
            timer: 3000,
            timerProgressBar: true,
            didOpen: () => {
              const timer = Swal.getPopup().querySelector("b");
              let sec = 3;
              timerInterval = setInterval(() => {
                timer.textContent = sec--;
              }, 1000);
            },
          })
        },
        error(err) {
          Swal.fire({
            title: "Terjadi Kesalahan. Silahkan Coba lagi",
            text: err.responseText && err.message,
            icon: "error",
            timer: 3000,
            timerProgressBar: true,
          })
        }
      })
    })
  })

  function swalLoading() {
    Swal.fire({
      title: "Loading...",
      text: "Please wait",
      showConfirmButton: false,
      allowOutsideClick: false,
      backdrop: true,
      willOpen: () => Swal.showLoading()
    })
  }

  document.getElementById("checkInModal").addEventListener("hide.bs.modal", () => {
    $("#checkInModal-body").html(" <div class=\"text-center\"><h4>Mohon Tunggu ...</h4></div>")
  })

  const handleRowClick = (sidang_id) => {
    checkInModal.show()
    $.ajax({
      url: "<?= base_url("ambil/fetch_table_checkin") ?>",
      method: "POST",
      data: {
        sidang_id: sidang_id
      },
      success(html) {
        $("#checkInModal-body").html(html)
      },
      error(err) {
        $("#checkInModal-body").html(err.responseText && err.message)
      }
    })
  }

  const disableAfterSubmit = (e) => {
    Swal.fire({
      title: "Loading...",
      text: "Please wait",
      showConfirmButton: false,
      allowOutsideClick: false,
      backdrop: true,
      willOpen: () => Swal.showLoading()
    })
  }

  function audioInterval() {
    const audioInterval = setInterval(() => {
      playAudioSelamatDatang(playAudioIntruksiBersidang)
    }, 1000 * 60)
  }

  function playAudioSelamatDatang(callback = null) {
    const audio = new Audio("<?= base_url("/audio/audio-selamat-datang.mp3") ?>");
    console.log("Audio Selamat Datang telah diputar")
    audio.play();
    audio.addEventListener("ended", function() {
      console.log("Audio Selamat Datang telah selesai diputar")
      callback()
    });
  }

  function playAudioIntruksiBersidang() {
    const audio = new Audio("<?= base_url("/audio/audio-penjelasan-antrian-sidang.mp3") ?>");
    console.log("Audio Intruksi Bersidang telah diputar")
    audio.play();
    audio.addEventListener("ended", function() {
      console.log("Audio Intruksi Bersidang telah selesai diputar")
    });
  }

  // audioInterval()
</script>