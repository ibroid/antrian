<div class="text-center">
  <h4><?= $data->nomor_perkara ?></h4>
</div>

<div class="d-flex d-spacing-2 p-2 gap-3">
  <button onclick="checkIn(<?= $data->id ?>)" class="btn btn-info btn-sm">
    <i class="fa fa-check"></i> Check-In Ruang Tunggu
  </button>
  <button class="btn btn-warning btn-sm btn-panggil" data-tujuan="semua-pihak-ke-ruang-tunggu">
    <i class="fa fa-volume-up"></i> Panggil Semua Pihak Ke Ruang Tunggu
  </button>
  <button class="btn btn-danger btn-sm btn-panggil" data-tujuan="semua-pihak-ke-ruang-sidang">
    <i class="fa fa-volume-up"></i> Panggil Semua Pihak Ke Ruang Sidang
  </button>
</div>

<table class="table table-hover table-bordered mt-3">
  <thead>
    <tr>
      <th colspan="4">
        <div class="text-center">
          Para Pihak
        </div>
      </th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($data->kehadiran_pihak as  $kp) { ?>
      <tr>
        <td><?= $kp->pihak; ?></td>
        <td>

          <button class="btn btn-primary btn-sm btn-panggil" data-tujuan="<?= $kp->sebagai == "S" ? "saksi-saksi-ke-ruang-tunggu" : "pihak-ke-ruang-tunggu" ?>" data-nama="<?= $kp->pihak ?>">
            <i class="fa fa-volume-up"></i>
            Panggil ke Ruang Tunggu
          </button>
        </td>
        <td>
          <div class="form-check checkbox checkbox-primary mb-0">
            <input <?= ($kp->status == 1) ? "checked" : "" ?> class="form-check-input" onclick="changeKehadiran(this, <?= $kp->id ?>)" id="checkbox-primary-<?= $kp->id ?>" type="checkbox">
            <label class="form-check-label" for="checkbox-primary-<?= $kp->id ?>">Check-In Kehadiran</label>
          </div>
        </td>
        <td>
          <button data-tujuan="<?= $kp->sebagai == "S" ? "saksi-saksi-ke-ruang-sidang" : "pihak-ke-ruang-sidang" ?>" data-nama="<?= $kp->pihak ?>" class="btn btn-secondary btn-sm btn-panggil">
            <i class="fa fa-volume-up"></i>
            Panggil ke Ruang Sidang
          </button>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>


<script>
  $(".btn-panggil").each((i, e) => {
    $(e).click(() => {
      Swal.fire({
        title: "Mohon tunggu ...",
        showConfirmButton: false,
        willOpen: () => Swal.showLoading(),
        backdrop: true,
        allowOutsideClick: false
      })

      $.ajax({
        url: "<?= base_url("/persidangan/panggil") ?>",
        method: "POST",
        data: {
          judul: $(e).data("tujuan"),
          nama_ruang: "<?= $data->nama_ruang ?>",
          pihak_satu: "<?= $data->kehadiran_pihak->where("sebagai", "P1")->first()->pihak ?>",
          pihak_dua: "<?= $data->kehadiran_pihak->where("sebagai", "T1")->first()->pihak ?? null ?>",
          nama_pihak: $(e).data("nama") ?? null
        },
        success: (res) => {
          Swal.close()
        },
        error: (err) => {
          Swal.fire({
            icon: "error",
            title: "Oops...",
            text: err.responseText && err.message
          })
        }
      })
    })
  })
</script>