<div class="row g-sm-3 height-equal-2 widget-charts">
  <?php foreach ($ruang_sidangs as $ruang_sidang) { ?>
    <div class="col-sm-12 col-md-4 col-lg-4">
      <div class="card small-widget mb-sm-0">
        <div class="card-body primary">
          <span class="f-light"><?= $ruang_sidang->nama ?> (<?= $ruang_sidang->kode ?>)</span>
          <div class="d-flex align-items-end gap-1">
            <h5>(<?= $dalam_sidang->where("nomor_ruang", $ruang_sidang->kode)->first()->antrian_persidangan->nomor_urutan ?? 0 ?>) <?= $dalam_sidang->where("nomor_ruang", $ruang_sidang->kode)->first()->antrian_persidangan->nomor_perkara ?? "Kosong" ?></h5>
          </div>
          <div class="bg-gradient">
            <svg class="stroke-icon svg-fill">
              <use href="../assets/svg/icon-sprite.svg#new-order"></use>
            </svg>
          </div>
          <div class="flex mt-4">
            <button data-search-column="0" data-search-content="<?= $ruang_sidang->nama ?>" class="btn btn-outline-primary btn-sm btn-search">Lihat Antrian</button>
          </div>
        </div>
      </div>
    </div>
  <?php } ?>
</div>