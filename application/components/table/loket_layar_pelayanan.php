<table style="--bs-table-bg: transparent;" class="table table-bordered background-transparent text-center">
  <thead>
    <tr>
      <?php foreach ($data as $d) : ?>
        <th class="p-0 text-dark" scope="col" style="font-size: 1.2rem"><?= $d->nama_loket ?></th>
      <?php endforeach; ?>
    </tr>
  </thead>
  <tbody>
    <tr>
      <?php foreach ($data as $d) : ?>
        <td style="padding: auto;"><span style="font-size: 5rem" class="badge px-3 py-4 bg-<?= $d->warna_loket ?> <?= $d->status == 0 ? "opacity-50" : null ?>"><?= $d->status == 0 ? "OFF" : $d->antrian->nomor_antrian ?? 0 ?></span></td>
      <?php endforeach; ?>
    </tr>
  </tbody>
</table>