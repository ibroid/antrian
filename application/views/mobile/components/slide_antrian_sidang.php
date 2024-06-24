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
      <div class="card-footer d-flex justify-content-between">
        <p>Detail untuk melihat antrian yang sudah/belum dipanggil</p>
        <button hx-get="<?= base_url('mobile/beranda/detail_antrian_sidang?nomor_ruang=' . $d->nomor_ruang) ?>" hx-trigger="click" hx-target="#modalDetailAntrianSidang > .modal-dialog > .modal-content > .modal-body > ul.listview" hx-indicator=".htmx-indicator" data-bs-toggle="modal" data-bs-target="#modalDetailAntrianSidang" class="btn btn-outline-<?= warna_ruang_sidang($d->nomor_ruang) ?>">
          <ion-icon name="information-circle-outline"></ion-icon>
          Detail
        </button>
      </div>
    </div>
  <?php } ?>
<?php } ?>

<div class="modal fade modalbox" id="modalDetailAntrianSidang" data-bs-backdrop="static" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Detail Antrian</h5>
        <a href="#" data-bs-dismiss="modal">Tutup</a>
      </div>
      <div class="modal-body p-0">
        <ul class="listview flush mb-2">

        </ul>
      </div>
    </div>
  </div>
</div>