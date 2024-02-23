<div class="card">
  <div class="card-body">
    <div class="deposit-wrap">
      <h4>Control Panel</h4>
      <?php if (isset($data)) { ?>
        <div class="d-flex p-2 gap-2">
          <button class="btn btn-outline-success btn-panggil" data-pihak="semua_pihak">
            <i class="fa fa-volume-up btn-lg"></i> Panggil Para Pihak
          </button>
          <button class="btn btn-outline-success btn-panggil" data-pihak="saksi_saksi_p">
            <i class="fa fa-volume-up btn-lg"></i> Panggil Saksi P
          </button>
          <button class="btn btn-outline-success btn-panggil" data-pihak="saksi_saksi_t">
            <i class="fa fa-volume-up btn-lg"></i> Panggil Saksi T
          </button>
        </div>
        <hr>
        <div class="d-flex p-2 gap-2">
          <button class="btn btn-outline-secondary">
            <i class="fa fa-undo btn-lg"></i>
            Skors Sidang
          </button>
          <button class="btn btn-outline-secondary">
            <i class="fa fa-arrow-left btn-lg"></i>
            keluarkan Dari Ruang Sidang
          </button>
        </div>
        <hr>
      <?php } else { ?>
        <div class="text-center">Belum ada perkara yang di panggil</div>
      <?php } ?>
      <div class="d-flex p-2 gap-2">
        <button class="btn btn-outline-primary btn-pengumuman" data-jenis-pengumuman="pembukaan-sidang">
          <i class="fa fa-volume-up btn-lg"></i>
          Pembukaan Sidang
        </button>
        <button class="btn btn-outline-primary btn-pengumuman" data-jenis-pengumuman="istirahat-sidang">
          <i class="fa fa-volume-up btn-lg"></i>
          Pengumuman Istirahat
        </button>
        <button class="btn btn-outline-primary btn-pengumuman" data-jenis-pengumuman="panggil-petugas">
          <i class="fa fa-volume-up btn-lg"></i>
          Panggil Petugas
        </button>
      </div>
    </div>
  </div>
</div>

<script>
  window.addEventListener('load', function() {

    $(".btn-pengumuman").each((i, e) => {
      let jenisPengumuman = $(e).data("jenis-pengumuman")
      $(e).click(function() {

        Swal.fire({
          title: "Sedang memutar pengumuman",
          willOpen: () => Swal.showLoading(),
          allowOutsideClick: false,
          backdrop: true,
          showConfirmButton: false,
        })

        $.ajax({
          url: "<?= base_url("/persidangan/pengumuman") ?>",
          method: "POST",
          data: {
            "judul": jenisPengumuman,
            "nama_ruang": "<?= $nama_ruang ?>",
          },
          success: function(data) {
            Swal.close()
          },
          error: function(xhr, status, error) {
            Swal.fire({
              title: "Pengumuman gagal diputar",
              text: xhr.responseText ?? error,
              icon: "error",
              confirmButtonText: "OK",
              confirmButtonColor: "#46b654",
              showConfirmButton: true,
            })
          }
        })
      })
    })

    $(".btn-panggil").each((i, e) => {

      $(e).click(function() {
        let pihak = $(e).data("pihak")

        Swal.fire({
          title: "Sedang memtuar panggilan pihak",
          willOpen: () => Swal.showLoading(),
          allowOutsideClick: false,
          backdrop: true,
          showConfirmButton: false,
        })

        $.ajax({
          url: "<?= base_url("ruangsidang/panggil_pihak") ?>",
          method: "POST",
          data: {
            pihak: pihak,
            nomor_ruang: "<?= $nomor_ruang ?>",
            nama_ruang: "<?= $nama_ruang ?>",
          },
          success(data) {
            Swal.close()
          },
          error(err) {
            Swal.fire({
              title: "Pengumuman gagal diputar",
              text: err.responseText ?? err.message,
              icon: "error",
              confirmButtonText: "OK",
              confirmButtonColor: "#46b654",
              showConfirmButton: true,
            })
          }
        })
      })
    })
  })
</script>