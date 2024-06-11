<table class="table table-hover" id="table-antrian">
  <thead>
    <tr>
      <th>Antrian</th>
      <th>Perkara</th>
      <th>Para Pihak</th>
      <th>Agenda</th>
      <th>Kehadiran <br> Pihak</th>
      <th>Kehadiran <br> Saksi</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($antrian as $a) { ?>
      <tr>
        <td>
          <div class="badge badge-primary">
            <h5>No. <?= $a->nomor_urutan ?></h5>
          </div><br>
          <?= badge_status_antrian_sidang($a->status) ?>
        </td>
        <td>
          <?= $a->nomor_perkara ?>
          <br>
          <?= $a->perkara->jenis_perkara_nama ?>
          <br>
          <?= $a->priority == 1 ? "<div class=\"badge badge-primary\">Prioritas</div>" : null ?>
        </td>
        <td>
          <?= $a->perkara->para_pihak  ?>
        </td>
        <td><strong><?= $a->jadwal_sidang->agenda  ?></strong></td>
        <td><?= ($a->kehadiran_pihak->count("id") == $a->kehadiran_pihak->sum("status")) ? "<div class=\"alert-light-success txt-success text-center p-1 rounded\">Hadir Semua</div" : "<div class=\"event-date alert-light-danger txt-danger text-center p-1 rounded\">Ada yang belum hadir</div>" ?></td>
        <td><?= $a->kehadiran_pihak->where("sebagai", "S")->first()->status == 0 ? "<div class=\"event-date alert-light-secondary txt-secondary text-center p-1 rounded\">Belum hadir</div>" : "<div class=\"alert-light-primary txt-primary text-center p-1 rounded\">Sudah hadir</div>"  ?></td>
        <td>
          <?php
          if ($a->status == 2) { ?>
            <button disabled type="submit" class="btn btn-info">Dalam Persidangan</button>
          <?php } else { ?>
            <form action="<?= base_url("ruangsidang/masukan_ke_ruang_sidang") ?>" method="post">
              <input type="hidden" name="nomor_ruang" value="<?= $nomor_ruang ?>">
              <input type="hidden" name="antrian_sidang_id" value="<?= $a->id ?>">
              <button onclick="disableAfterClick(this)" type="submit" class="btn btn-success"><i class="fa fa-arrow-right"></i>Masukan ke ruang sidang</button>
            </form>
          <?php } ?>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>

<script>
  function disableAfterClick(e) {
    $(e).attr("disabled", true);
    $(e).html("<i class=\"fa fa-spinner fa-spin\"></i>");
    $(e).closest("form").submit()
  }
</script>