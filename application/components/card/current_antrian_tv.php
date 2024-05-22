<div class="row m-3">
  <?php foreach (LoketPelayanan::where('status', '!=', 2)->orderBy('urutan')->get() as $l) { ?>
    <div class="col-4">
      <div class="card text-center p-4 bg-<?= $l->warna_loket ?>">
        <h3><?= $l->nama_loket ?></h3>
        <div class="card-body p-0">
          <h1 style="font-size: 3.7rem;"><?= $l->antrian->nomor_antrian  ?? "000" ?></h1>
        </div>
      </div>
    </div>
  <?php } ?>
</div>