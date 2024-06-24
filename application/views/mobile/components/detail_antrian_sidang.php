<?php foreach ($data as $d) { ?>
  <li class="item">
    <div class="d-flex justify-content-between">
      <div class="badge badge-success">Antrian Nomor : <?= $d->nomor_urutan ?></div>
      <div class="badge badge-<?= warna_ruang_sidang($d->nomor_ruang) ?>">
        <?= $d->nomor_perkara ?>
      </div>
    </div>
    <?= $d->perkara->para_pihak ?>
    <p> Dipanggil : <?= $d->waktu_panggil ?? "Belum dipanggil" ?></p>
  </li>
<?php } ?>