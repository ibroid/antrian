<table class="table table-hover table-striped" id="table-antrian-selesai">
  <thead>
    <tr>
      <th>No.</th>
      <th>Antrian</th>
      <th>Tujuan</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($data as $n => $d) { ?>
      <tr>
        <td><?= ++$n ?></td>
        <td><?= $d->nomor_antrian ?></td>
        <td><?= $d->tujuan ?></td>
        <td>
          <?= $this->load->component('table/pilihan_antrian_pelayanan') ?>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>

<script>
  window.addEventListener('load', function() {
    const datatable = $("#table-antrian-selesai").DataTable()
  })
</script>