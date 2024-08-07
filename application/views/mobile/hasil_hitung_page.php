<div class="header-large-title">
  <h1 class="title">Rincian Biaya Perkara</h1>
  <h4 class="subtitle">Rincian biaya perkara sewaktu waktu dapat berubah.</h4>
</div>

<button hx-get="<?= base_url('mobile/biaya/page') ?>" class="btn btn-outline-primary ms-2 mt-2" hx-target="#appCapsule" hx-indicator=".htmx-indicator">
  <ion-icon name="return-down-back-outline"></ion-icon>
  Kembali
</button>

<div class="section mt-2">
  <h3>Jenis Perkara : <?= $perkara->nama_perkara ?? "" ?></h3>
  <table class="table table-border bg-white">
    <thead>
      <tr>
        <th colspan="2" class="text-center">Biaya Administrasi</th>
      </tr>
    </thead>
    <thead>
      <tr>
        <th>Rincian</th>
        <th>Biaya</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($rincian_utama as $n => $d) { ?>
        <tr>
          <td><?= $d->nama_item ?></td>
          <td><?= rupiah($d->biaya)  ?></td>
        </tr>
      <?php  } ?>
      <tr>
        <td class="text-end">Total</td>
        <td><?= rupiah($rincian_utama->sum("biaya"))  ?></td>
      </tr>
    </tbody>
  </table>
</div>

<div class="section mt-2">
  <table class="table table-border bg-white">
    <thead>
      <tr>
        <th colspan="2" class="text-center">Biaya Panggilan Pihak <?= $perkara->nama_p ?></th>
      </tr>
    </thead>
    <thead>
      <tr>
        <th>Rincian</th>
        <th>Biaya</th>
      </tr>
    </thead>
    <tbody></tbody>
  </table>
</div>
<div class="section mt-2">
  <table class="table table-border bg-white">
    <thead>
      <tr>
        <th colspan="2" class="text-center">Biaya Panggilan Pihak <?= $perkara->nama_t ?></th>
      </tr>
    </thead>
    <thead>
      <tr>
        <th>Rincian</th>
        <th>Biaya</th>
      </tr>
    </thead>
    <tbody>

    </tbody>
  </table>
</div>