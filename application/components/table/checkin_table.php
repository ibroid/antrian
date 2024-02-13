<div class="text-center">
  <h4>Pilih Nama Anda</h4>
</div>

<table class="table table-bordered">
  <thead>
    <tr>
      <th>Penggugat</th>
      <th>Tergugat</th>
      <th>Kuasa Hukum</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>
        <?php foreach ($data->pihak_satu as $p1) { ?>
          <form action="<?= base_url('/ambil') ?>" style="width: 500px;" class="my-3" method="POST">
            <input type="hidden" name="perkara_id" value="<?= $data->perkara_id ?>">
            <input type="hidden" name="perkara" value="<?= $data->perkara_id ?>">
            <button class="btn btn-success m-2"><?= $p1->nama ?></button>
          </form>
        <?php } ?>
      </td>
      <td>
        <?php foreach ($data->pihak_dua as $p2) { ?>
          <button class="btn btn-success m-2"><?= $p2->nama ?></button>
        <?php } ?>
      </td>
      <td>
        <?php foreach ($data->pengacara as $pc) { ?>
          <button class="btn btn-success m-2"><?= $pc->nama ?></button>
        <?php } ?>
      </td>
    </tr>
  </tbody>
</table>