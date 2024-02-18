<div class="row">
  <div class="col-xl-12 p-0">
    <div class="login-card login-dark">
      <div class="login-main" style="width: fit-content;">
        <?= $this->session->flashdata('flash_error') ?>
        <?= $this->session->flashdata('flash_notif') ?>
        <h4>Halaman Utama. Silahkan Pilih Menu</h4>
        <p>Aplikasi Antrian Persidangan dan Pelayanan Pengadilan Agama Jakarta Utara</p>
        <div class="row">
          <div class="col-xl-4">
            <div class="card widget-1" style="background-image: none;" onclick="window.location.href='<?= base_url('/ambil') ?>'">
              <div class="card-body">
                <div class="widget-content">
                  <div class="widget-round secondary">
                    <div class="bg-round">
                      <svg class="svg-fill">
                        <use href="../assets/svg/icon-sprite.svg#person-group"> </use>
                      </svg>
                      <svg class="half-circle svg-fill">
                        <use href="../assets/svg/icon-sprite.svg#halfcircle"></use>
                      </svg>
                    </div>
                  </div>
                  <div>
                    <h4>Ambil Antrian</h4><span>Ambil Antrian Sidang dan PTSP</span>
                  </div>
                </div>
                <div class="font-secondary f-w-500"><span>+50</span></div>
              </div>
            </div>
          </div>
          <div class="col-xl-4">
            <div class="card widget-1" style="background-image: none;">
              <div class="card-body">
                <div class="widget-content">
                  <div class="widget-round primary">
                    <div class="bg-round">
                      <svg class="svg-fill">
                        <use href="../assets/svg/icon-sprite.svg#stroke-board"> </use>
                      </svg>
                      <svg class="half-circle svg-fill">
                        <use href="../assets/svg/icon-sprite.svg#halfcircle"></use>
                      </svg>
                    </div>
                  </div>
                  <div>
                    <h4>Layar Antrian Sidang</h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-4">
            <div class="card widget-1" style="background-image: none;">
              <div class="card-body">
                <div class="widget-content">
                  <div class="widget-round primary">
                    <div class="bg-round">
                      <svg class="svg-fill">
                        <use href="../assets/svg/icon-sprite.svg#stroke-board"> </use>
                      </svg>
                      <svg class="half-circle svg-fill">
                        <use href="../assets/svg/icon-sprite.svg#halfcircle"></use>
                      </svg>
                    </div>
                  </div>
                  <div>
                    <h4>Audio Antrian PTSP</h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">

          <div class="col-xl-6">
            <div class="card widget-1" style="background-image: none;">
              <div class="card-body">
                <div class="widget-content">
                  <div class="widget-round secondary">
                    <div class="bg-round">
                      <svg class="svg-fill">
                        <use href="../assets/svg/icon-sprite.svg#stroke-project"> </use>
                      </svg>
                      <svg class="half-circle svg-fill">
                        <use href="../assets/svg/icon-sprite.svg#halfcircle"></use>
                      </svg>
                    </div>
                  </div>
                  <div>
                    <h4>Kasir</h4><span class="f-light">Pengembalian Sisa Panjar</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-6">
            <div class="card widget-1" style="background-image: none;" onclick="window.location.href='<?= base_url('/auth') ?>'">
              <div class="card-body">
                <div class="widget-content">
                  <div class="widget-round primary">
                    <div class="bg-round">
                      <svg class="svg-fill">
                        <use href="../assets/svg/icon-sprite.svg#tag"> </use>
                      </svg>
                      <svg class="half-circle svg-fill">
                        <use href="../assets/svg/icon-sprite.svg#halfcircle"></use>
                      </svg>
                    </div>
                  </div>
                  <div>
                    <h4>Ruang Sidang</h4><span class="f-light">Khusu Panitera Pengganti</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xl-6">
            <div class="card widget-1" style="background-image: none;" onclick="window.location.href='<?= base_url('/persidangan') ?>'">
              <div class="card-body">
                <div class="widget-content">
                  <div class="widget-round secondary">
                    <div class="bg-round">
                      <svg class="svg-fill">
                        <use href="../assets/svg/icon-sprite.svg#stroke-project"> </use>
                      </svg>
                      <svg class="half-circle svg-fill">
                        <use href="../assets/svg/icon-sprite.svg#halfcircle"></use>
                      </svg>
                    </div>
                  </div>
                  <div>
                    <h4>Petugas Sidang</h4><span class="f-light"></span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-6">
            <div class="card widget-1" style="background-image: none;" onclick="window.location.href='<?= base_url('/pelayanan') ?>'">
              <div class="card-body">
                <div class="widget-content">
                  <div class="widget-round primary">
                    <div class="bg-round">
                      <svg class="svg-fill">
                        <use href="../assets/svg/icon-sprite.svg#tag"> </use>
                      </svg>
                      <svg class="half-circle svg-fill">
                        <use href="../assets/svg/icon-sprite.svg#halfcircle"></use>
                      </svg>
                    </div>
                  </div>
                  <div>
                    <h4>Petugas PTSP</h4><span class="f-light"></span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
    <p class=" text-center">Crafted By<a class="ms-2" target="_blank" href="https://mmaliki.my.id">Mmaliki</a></p>
  </div>
</div>