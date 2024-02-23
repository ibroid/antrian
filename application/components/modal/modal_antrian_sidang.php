<div class="text-center">
  <h4><?= $data->nomor_perkara ?></h4>
</div>

<div class="d-flex d-spacing-2 p-2 gap-3">
  <button onclick="checkIn(<?= $data->id ?>)" class="btn btn-info btn-sm">
    <i class="fa fa-check"></i> Check-In Ruang Tunggu
  </button>
  <button class="btn btn-warning btn-sm btn-panggil" data-tujuan="ruang_tunggu">
    <i class="fa fa-volume-up"></i> Panggil Semua Pihak Ke Ruang Tunggu
  </button>
  <button class="btn btn-danger btn-sm btn-panggil" data-tujuan="ruang_sidang">
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
          <button class="btn btn-primary btn-sm">
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
          <button disabled class="btn btn-secondary btn-sm">
            <i class="fa fa-volume-up"></i>
            Panggil ke Ruang Sidang
          </button>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>

<div class="d-flex d-spacing-2 p-2 gap-3">
  <button class="btn btn-success btn-sm">
    <i class="fa fa-volume-up"></i> Panggil Semua Saksi Ke Ruang Tunggu
  </button>
  <button class="btn btn-danger btn-sm">
    <i class="fa fa-volume-up"></i> Panggil Semua Saksi Ke Ruang Sidang
  </button>
</div>

<script>
  $(".btn-panggil").each((i, e) => {
    $(e).click(() => {
      console.log("clicked");
    })
  })
</script>