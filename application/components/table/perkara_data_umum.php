<div class="card">
  <div class="card-body">
    <div class="product-page-details">
      <h3><?= $data->nomor_perkara ?></h3>
    </div>
    <div class="product-price"><?= $data->jenis_perkara_nama ?>
      <del>Didaftarkan :<?= tanggal_indo($data->tanggal_pendaftaran)  ?> </del>
    </div>
    <ul class="product-color">
      <li class="bg-primary"></li>
      <li class="bg-secondary"></li>
      <li class="bg-success"></li>
      <li class="bg-info"></li>
      <li class="bg-warning"></li>
    </ul>
    <hr>
    <p><?= $data->para_pihak ?></p>
    <hr>
    <p><?= $data->penetapan->majelis_hakim_text ?><br><?= $data->penetapan->panitera_pengganti_text ?></p>
    <hr>
    <div>
      <table class="product-page-width">
        <tbody>
          <tr>
            <td> <b>Kuasa Hukum P &nbsp;&nbsp;&nbsp;:</b></td>
            <td>
              <?php foreach ($data->pengacara_satu as $ps) { ?>
                <?= $ps->nama ?>
              <?php } ?>
            </td>
          </tr>
          <tr>
            <td> <b>Kuasa Hukum T &nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;&nbsp;</b></td>
            <td>
              <?php foreach ($data->pengacara_dua as $pd) { ?>
                <?= $pd->nama ?>
              <?php } ?>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>