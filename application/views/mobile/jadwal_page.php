<div class="header-large-title">
  <h1 class="title">Jadwal Sidang Hari Ini</h1>
  <h4 class="subtitle"><?= tanggal_indo(date("Y-m-d")) ?></h4>
</div>

<div class="header-large-title mt-2">
  <div class="alert alert-outline-danger" role="alert">
    <div class="d-flex justify-content-between gap-5">
      <h2 class="alert-title">Mohon Perhatian.</h2>
      <h4>
        <ion-icon size="large" color="danger" name="warning-outline"></ion-icon>
      </h4>
    </div>
    <h4>Silahkan periksa kembali surat panggilan sidang yang anda terima. Apabila nama anda tidak ada di bawah ini silahkan hubungi petugas sidang, Atau periksa proses perkara anda pada menu Informasi > Proses Perkara</h4>
  </div>
</div>

<?php
if (count($data) == 0) { ?>
  <div class="text-center mt-3">
    <h3>Tidak ada persidangan hari ini</h3>
  </div>
<?php } else { ?>

  <div class="section my-3 mx-0">
    <table class="table bg-primary table-bordered table-striped">
      <thead>
        <tr>
          <th colspan="2" class="text-center">Ruang Sidang Umar</th>
        </tr>
      </thead>
      <tbody class="bg-light">
        <?php $n = 1; ?>
        <?php foreach ($data->where('ruangan_id', '1')->all() as $d) { ?>
          <tr>
            <td colspan="2">
              <div class="d-flex justify-content-between">
                <p>
                  <?= "$n. " . $d->perkara->nomor_perkara ?>
                </p>
                <div class="badge badge-primary">
                  <?= $d->antrian_sidang->where('tanggal_sidang', date('Y-m-d'))->first()->nomor_urutan ?? "Belum Ambil Antrian" ?>
                </div>
              </div>
            </td>
          </tr>
          <tr>
            <td class="text-light"><?= $d->perkara->pihak1_text ?></td>
            <td class="text-light"><?= $d->perkara->pihak2_text ?></td>
          </tr>
          <?php $n++ ?>
        <?php } ?>
      </tbody>
    </table>
  </div>
  <div class="section my-3 mx-0">
    <table class="table bg-danger table-bordered table-striped">
      <thead>
        <tr>
          <th colspan="2" class="text-center">Ruang Sidang Abu Musa</th>
        </tr>
      </thead>
      <tbody class="bg-light">
        <?php $n = 1; ?>
        <?php foreach ($data->where('ruangan_id', '2')->all() as $d) { ?>
          <tr>
            <td colspan="2">
              <div class="d-flex justify-content-between">
                <p>
                  <?= "$n. " . $d->perkara->nomor_perkara ?>
                </p>
                <div class="badge badge-danger">
                  <?= $d->antrian_sidang->where('tanggal_sidang', date('Y-m-d'))->first()->nomor_urutan ?? "Belum Ambil Antrian" ?>
                </div>
              </div>
            </td>
          </tr>
          <tr>
            <td class="text-light"><?= $d->perkara->pihak1_text ?></td>
            <td class="text-light"><?= $d->perkara->pihak2_text ?></td>
          </tr>
          <?php $n++ ?>
        <?php } ?>
      </tbody>
    </table>
  </div>
  <div class="section my-3 mx-0">
    <table class="table bg-warning table-bordered table-striped">
      <thead>
        <tr>
          <th colspan="2" class="text-center">Ruang Sidang Syuraih</th>
        </tr>
      </thead>
      <tbody class="bg-light">
        <?php $n = 1; ?>
        <?php foreach ($data->where('ruangan_id', '3')->all() as $d) { ?>
          <tr>
            <td colspan="2">
              <div class="d-flex justify-content-between">
                <p>
                  <?= "$n. " . $d->perkara->nomor_perkara ?>
                </p>
                <div class="badge badge-warning">
                  <?= $d->antrian_sidang->where('tanggal_sidang', date('Y-m-d'))->first()->nomor_urutan ?? "Belum Ambil Antrian" ?>
                </div>
              </div>
            </td>
          </tr>
          <tr>
            <td class="text-light"><?= $d->perkara->pihak1_text ?></td>
            <td class="text-light"><?= $d->perkara->pihak2_text ?></td>
          </tr>
          <?php $n++ ?>
        <?php } ?>
      </tbody>
    </table>
  </div>

<?php } ?>