<div class="row g-sm-3 height-equal-2 widget-charts">
  <div class="col-sm-12 col-md-4 col-lg-4">
    <div class="card small-widget mb-sm-0">
      <div class="card-body primary">
        <span class="f-light">Umar Bin Khatab (1)</span>
        <div class="d-flex align-items-end gap-1">
          <h5>(<?= $dalam_sidang->where("nomor_ruang", 1)->first()->antrian_persidangan->nomor_urutan ?? 0 ?>) <?= $dalam_sidang->where("nomor_ruang", 1)->first()->antrian_persidangan->nomor_perkara ?? "Kosong" ?></h5>
        </div>
        <div class="bg-gradient">
          <svg class="stroke-icon svg-fill">
            <use href="../assets/svg/icon-sprite.svg#new-order"></use>
          </svg>
        </div>
        <div class="flex mt-4">
          <button data-search-column="0" data-search-content="Umar" class="btn btn-outline-primary btn-sm btn-search">Lihat Antrian</button>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-12 col-md-4 col-lg-4">
    <div class="card small-widget mb-sm-0">
      <div class="card-body warning"><span class="f-light">Abu Musa (2)</span>
        <div class="d-flex align-items-end gap-1">
          <h5>(<?= $dalam_sidang->where("nomor_ruang", 2)->first()->antrian_persidangan->nomor_urutan ?? 0 ?>) <?= $dalam_sidang->where("nomor_ruang", 1)->first()->antrian_persidangan->nomor_perkara ?? "Kosong" ?></h5>
        </div>
        <div class="bg-gradient">
          <svg class="stroke-icon svg-fill">
            <use href="../assets/svg/icon-sprite.svg#customers"></use>
          </svg>
        </div>
        <div class="flex mt-4">
          <button data-search-column="0" data-search-content="Abu Musa" class="btn btn-search btn-outline-warning btn-sm">Lihat Antrian</button>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-12 col-md-4 col-lg-4">
    <div class="card small-widget mb-sm-0">
      <div class="card-body secondary"><span class="f-light">Asyuraih (3)</span>
        <div class="d-flex align-items-end gap-1">
          <h5>(<?= $dalam_sidang->where("nomor_ruang", 3)->first()->antrian_persidangan->nomor_urutan ?? 0 ?>) <?= $dalam_sidang->where("nomor_ruang", 3)->first()->antrian_persidangan->nomor_perkara ?? "Kosong" ?></h5>
        </div>
        <div class="bg-gradient">
          <svg class="stroke-icon svg-fill">
            <use href="../assets/svg/icon-sprite.svg#sale"></use>
          </svg>
        </div>
        <div class="flex mt-4">
          <button data-search-column="0" data-search-content="Syuraih" class="btn btn-search btn-outline-secondary btn-sm">Lihat Antrian</button>
        </div>
      </div>
    </div>
  </div>
</div>