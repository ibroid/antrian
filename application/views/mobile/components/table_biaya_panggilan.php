<div class="section mt-2">
  <table class="table table-border shadow p-3 mb-5 rounded">
    <thead class="<?= $bg_color ?? 'bg-warning' ?>">
      <tr>
        <th colspan="2" class="text-center">
          <h3 class="text-dark">Biaya Panggilan Pihak <?= $jenis_pihak ?></h3>
        </th>
      </tr>
    </thead>
    <thead>
      <tr>
        <th>Rincian</th>
        <th>Biaya</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($data as $n => $dt) { ?>
        <tr>
          <td colspan="2">Pihak Ke <?= $n + 1 ?></td>
        </tr>
        <?php foreach ($dt as $d) { ?>
          <tr>
            <td><?= $d['kebutuhan'] ?></td>
            <td><?= rupiah($d['biaya'])  ?></td>
          </tr>
        <?php } ?>
        <tr>
          <td>Total</td>
          <td class="text-end"><?= rupiah($dt->sum('biaya')) ?></td>
        </tr>
      <?php } ?>
      <thead>
        <tr>
          <th class="text-end">Total Biaya Semua Panggilan Pihak <?= $jenis_pihak ?></th>
          <th><?= rupiah($data->map(fn($item) => $item->sum('biaya'))->sum()) ?></th>
        </tr>
      </thead>
    </tbody>
  </table>
</div>