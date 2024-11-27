<table class="table table-responsive table-hover " id="table-sidang">
  <thead>
    <tr>
      <th>Pekara</th>
      <th>Pihak P </th>
      <th>Kuasa P</th>
      <th>Pihak T </th>
      <th>Kuasa T</th>
      <th>Ruangan</th>
      <th>Majelis</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($daftar_sidang as $n => $ds) { ?>
      <tr onclick="handleRowClick(<?= $ds->id ?>)">
        <td><?= $ds->perkara->nomor_perkara ?><br><?= $ds->perkara->jenis_perkara_nama ?></td>
        <td>
          <?= $ds->perkara->pihak_satu[0]->nama ?>
        </td>
        <td>
          <?php if (count($ds->perkara->pengacara_satu) > 0) {
            echo  $ds->perkara->pengacara_satu[0]->nama;
          } ?>
        </td>
        <td>
          <?php if (count($ds->perkara->pihak_dua) !== 0) {
            echo  $ds->perkara->pihak_dua[0]->nama;
          }  ?>
        </td>
        <td>
          <?php if (count($ds->perkara->pengacara_dua) > 0) {
            echo  $ds->perkara->pengacara_dua[0]->nama;
          } ?>
        </td>
        <td><?= $ds->ruangan ?><br><?= str_replace("Panitera Pengganti:", "", $ds->perkara->penetapan->panitera_pengganti_text)  ?></td>
        <td><?= $ds->perkara->penetapan->majelis_hakim_nama ?></td>
        <td>
          <form action="<?= base_url('ktp/simpan_from_sidang') ?>" method="POST">
            <input type="hidden" name="pengunjung_id" value="<?= $ds->id ?>">
            <button class="btn btn-xl btn-success">Ambil Antrian</button>
          </form>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>