<div class="header-large-title">
  <h1 class="title">Rincian Biaya Perkara</h1>
  <h4 class="subtitle">Rincian biaya perkara sewaktu waktu dapat berubah.</h4>
</div>

<button hx-get="<?= base_url('mobile/biaya/page') ?>" class="btn btn-outline-primary ms-2 mt-2" hx-target="#appCapsule" hx-indicator=".htmx-indicator">
  <ion-icon name="return-down-back-outline"></ion-icon>
  Kembali
</button>
<?php
$totalAdmin =  $rincian_utama->sum("biaya");
$totalPanggilanP = $rincian_panggilan_p->map(fn($item) => $item->sum('biaya'))->sum();
$totalPanggilanT = $rincian_panggilan_t->map(fn($item) => $item->sum('biaya'))->sum();

?>
<div class="section mt-2 border">
  <h3>Jenis Perkara : <?= $perkara->nama_perkara ?? "" ?></h3>
  <table class="table table-border shadow p-3 mb-5 rounded">
    <thead class="bg-primary">
      <tr>
        <th colspan="2" class="text-center">
          <h3 class="text-dark">Biaya Administrasi</h3>
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
      <?php foreach ($rincian_utama as $n => $d) { ?>
        <tr>
          <td><?= $d->nama_item ?></td>
          <td><?= rupiah($d->biaya)  ?></td>
        </tr>
      <?php  } ?>
    </tbody>
    <thead>
      <tr>
        <th class="text-end">Total</th>
        <th><?= rupiah($rincian_utama->sum("biaya"))  ?></th>
        <?php $totalAdmin = floatval($rincian_utama->sum("biaya")) ?>
      </tr>
    </thead>
  </table>
</div>

<?= $this->load->view('mobile/components/table_biaya_panggilan', [
  'data' => $rincian_panggilan_p,
  'jenis_pihak' => $perkara->nama_p,
], TRUE) ?>

<?php if ($perkara->jumlah_t !== 0) {
  echo $this->load->view('mobile/components/table_biaya_panggilan', [
    'data' => $rincian_panggilan_t,
    'jenis_pihak' => $perkara->nama_t,
    'bg_color' => 'bg-info'
  ], TRUE);
} ?>

<div class="section mt-2">
  <div class="card">
    <div class="card-body">
      <div class="text-center">
        <h4>Total Panjar Biaya</h4>
        <h1><?= rupiah($totalAdmin + $totalPanggilanP + $totalPanggilanT) ?> </h1>
      </div>
    </div>
  </div>
</div>