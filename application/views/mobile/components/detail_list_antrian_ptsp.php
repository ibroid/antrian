<div class="listview-title">
  <h3>Daftar Antrian</h3>
</div>
<ul class="listview simple-listview">
  <?php foreach ($antrian as $a) { ?>
    <li>
      <div class="item d-flex">
        <div class="mx-3">
          <h3 class="text-center"><?= $a->nomor_antrian ?></h3>
        </div>
        <div class="in">
          <?= $a->tujuan ?>
          <div class="text-muted"><?= $a->status == 1 ? "Sudah dipanggil pada jam " . $a->updated_at->format("H:i") : "Belum dipanggil"  ?></div>
        </div>
      </div>
    </li>
  <?php } ?>
</ul>