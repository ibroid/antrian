<?php if (count($data) == 0) { ?>
  <div class="text-center my-3">
    <h2>Persidangan Belum Dimulai</h2>
  </div>
<?php } else { ?>
  <?php foreach ($data as $d) { ?>
    <div class="card m-2">
      <div class="card-header text-center">
        <h3>Ruang Sidang <?= $d->nomor_ruang ?> - <?= $d->antrian_persidangan->nama_ruang ?? '' ?></h3>
      </div>
      <div class="card-body bg-<?= warna_ruang_sidang($d->nomor_ruang) ?> p-0">
        <div class="text-center">
          <h1 class="p-0 text-light" style="font-size: 5rem;"><?= $d->antrian_persidangan->nomor_urutan ?></h1>
          <h3 class="text-light"><?= $d->antrian_persidangan->nomor_perkara ?></h3>
        </div>
        <table class="table table-bordered">
          <thead>
            <tr class="bg-light text-center">
              <th>Para Pihak</th>
              <th>Sebagai</th>
            </tr>
          </thead>
          <tbody class="bg-light">
            <?php foreach ($d->antrian_persidangan->kehadiran_pihak  as $kp) { ?>
              <tr>
                <td><?= $kp->pihak ?></td>
                <td><?= $kp->sebagai ?></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  <?php } ?>
<?php } ?>