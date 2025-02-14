<table class="table table-hover table-striped" id="table-antrian-selesai">
  <thead>
    <tr>
      <th>No.</th>
      <th>Antrian</th>
      <th>Tujuan</th>
      <th>Durasi Layanan</th>
      <th>Waktu Tunggu</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($data as $n => $d) { ?>
      <tr>
        <td><?= ++$n ?></td>
        <td><?= $d->nomor_antrian ?></td>
        <td><?= $d->tujuan ?></td>
        <td><?= $d->durasi_pelayanan ?></td>
        <td><?= $d->waktu_tunggu ?></td>
      </tr>
    <?php } ?>
  </tbody>
</table>

<script>
  window.addEventListener('load', function() {
    const datatable = $("#table-antrian-selesai").DataTable()
  })
</script>