<div class="text-center">
  <h4><?= $data->nomor_perkara ?></h4>
</div>

<div class="d-flex">
  <button onclick="checkIn(<?= $data->id ?>)" class="btn btn-info btn-sm">
    <i class="fa fa-check"></i> Check-In Ruang Tunggu
  </button>
</div>

<table class="table table-hover table-bordered mt-3">
  <thead>
    <tr>
      <th colspan="4">
        <div class="text-center">
          Pihak P dan Kuasa P
        </div>
      </th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($data->perkara->pihak_satu as  $ps) { ?>
      <tr>
        <td><?= $ps->nama; ?></td>
        <td>
          <button class="btn btn-primary btn-sm">
            <i class="fa fa-volume-up"></i>
            Panggil ke Ruang Tunggu
          </button>
        </td>
        <td>
          <div class="form-check checkbox checkbox-primary mb-0">
            <input class="form-check-input" id="checkbox-primary-1" type="checkbox">
            <label class="form-check-label" for="checkbox-primary-1">Check-In Kehadiran</label>
          </div>
        </td>
        <td>
          <button disabled class="btn btn-secondary btn-sm">
            <i class="fa fa-volume-up"></i>
            Panggil ke Ruang Sidang
          </button>
        </td>
      </tr>
    <?php } ?>
    <?php foreach ($data->perkara->pengacara_satu as  $ks) { ?>
      <tr>
        <td><?= $ks->nama; ?></td>
        <td>
          <button class="btn btn-primary btn-sm">
            <i class="fa fa-volume-up"></i>
            Panggil ke Ruang Tunggu
          </button>
        </td>
        <td>
          <div class="form-check checkbox checkbox-primary mb-0">
            <input class="form-check-input" id="checkbox-primary-1" type="checkbox">
            <label class="form-check-label" for="checkbox-primary-1">Check-In Kehadiran</label>
          </div>
        </td>
        <td>
          <button disabled class="btn btn-secondary btn-sm">
            <i class="fa fa-volume-up"></i>
            Panggil ke Ruang Sidang
          </button>
        </td>
      </tr>
    <?php } ?>
  </tbody>
  <thead>
    <tr>
      <th colspan="4">
        <div class="text-center">
          Pihak T dan Kuasa T
        </div>
      </th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($data->perkara->pihak_dua as  $pd) { ?>
      <tr>
        <td><?= $pd->nama; ?></td>
        <td>
          <button class="btn btn-primary btn-sm">
            <i class="fa fa-volume-up"></i>
            Panggil ke Ruang Tunggu
          </button>
        </td>
        <td>
          <div class="form-check checkbox checkbox-primary mb-0">
            <input class="form-check-input" id="checkbox-primary-1" type="checkbox">
            <label class="form-check-label" for="checkbox-primary-1">Check-In Kehadiran</label>
          </div>
        </td>
        <td>
          <button disabled class="btn btn-secondary btn-sm">
            <i class="fa fa-volume-up"></i>
            Panggil ke Ruang Sidang
          </button>
        </td>
      </tr>
    <?php } ?>
    <?php foreach ($data->perkara->pengacara_dua as  $kd) { ?>
      <tr>
        <td><?= $kd->nama; ?></td>
        <td>
          <button class="btn btn-primary btn-sm">
            <i class="fa fa-volume-up"></i>
            Panggil ke Ruang Tunggu
          </button>
        </td>
        <td>
          <div class="form-check checkbox checkbox-primary mb-0">
            <input class="form-check-input" id="checkbox-primary-1" type="checkbox">
            <label class="form-check-label" for="checkbox-primary-1">Check-In Kehadiran</label>
          </div>
        </td>
        <td>
          <button disabled class="btn btn-secondary btn-sm">
            <i class="fa fa-volume-up"></i>
            Panggil ke Ruang Sidang
          </button>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>

<script>
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
</script>