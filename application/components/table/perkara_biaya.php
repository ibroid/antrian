<table class="table table-hover" id="table-perkara-biaya">
  <thead>
    <tr>
      <th>No</th>
      <th>Transaksi</th>
      <th>Jenis</th>
      <th>Tanggal</th>
      <th>Jumlah</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($data as $n => $d) { ?>
      <tr>
        <td><?= ++$n ?></td>
        <td><?= $d->uraian ?></td>
        <td><?= $d->jenis_transaksi == 1 ? "Masuk" : "Keluar" ?></td>
        <td><?= tanggal_indo($d->tanggal_transaksi) ?></td>
        <td><?= rupiah(str_replace(".00", "", $d->jumlah))  ?></td>
      </tr>
    <?php } ?>
  </tbody>
  <thead>
    <tr>
      <th colspan="4" class="text-end">Total Masuk</th>
      <th><?php $masuk = rupiah($data->where("jenis_transaksi", 1)->sum("jumlah"));
          echo $masuk  ?></th>
    </tr>
    <tr>
      <th colspan="4" class="text-end">Total Keluar</th>
      <th><?php $keluar = rupiah($data->where("jenis_transaksi", -1)->sum("jumlah"));
          echo $keluar  ?></th>
    </tr>
    <tr>
      <th colspan="4" class="text-end">Sisa</th>
      <th><?= floatval($masuk)  - floatval($keluar) ?></th>
    </tr>
  </thead>
</table>