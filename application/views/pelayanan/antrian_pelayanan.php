<style>
  .widget-with-chart {
    background-image: none;
  }

  .widget-1 {
    background-image: none;
  }
</style>
<div class="container-fluid py-3">
  <div class="row">
    <?= $this->session->flashdata('flash_alert') ?>
    <?= $this->session->flashdata('flash_error') ?>
    <div class="col-3">
      <?php if (!$is_admin && $currentLoket) :
        if ($currentLoket->status == 0 || !$currentLoket->antrian) { ?>
          <div class="p-4 mb-3 bg-primary">
            <div class="card-body">
              <h4 class="card-title">Nomor Saat Ini</h4>
              <h1 class="card-text">0000</h1>
              <p>--------</p>
            </div>
          </div>
        <?php } else { ?>
          <?= $this->load->component('card/antrian_ptsp_saat_ini', ['data' => $currentLoket->antrian]) ?>
      <?php }
      endif; ?>
      <div class="card">
        <div class="card-body">
          <h6 class="card-title text-center">Control Center</h6>
          <?php if ($is_admin or !$currentLoket) { ?>
            <div class="alert alert-warning" role="alert">
              <div class="text-center">
                <i class="fa fa-warning"></i>
                <strong>PEMANGGILAN TIDAK BISA JIKA ANDA MEMAKAI AKUN ADMIN, ATAU PENEMPATAN LOKET BELUM DITENTUKAN. SILAHKAN KLIK TUJUAN LOKET PADA MENU DI KANAN BAWAH</strong>
              </div>
            </div>
          <?php } else { ?>
            <form action="<?= base_url('/pelayanan/panggil') ?>" method="POST">
              <input type="hidden" name="kode" value="<?= $kode ?>">
              <div class="d-grid gap-2">
                <button name="panggil" value="baru" class="btn btn-primary btn-lg btn-block" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-html="true" data-bs-title="<b>Memanggil antrian  baru dari antrian yang berjalan</b>">
                  Panggil Antrian Baru <i class="fa fa-volume-up"></i>
                </button>
                <button name="panggil" value="kembali" class="btn btn-secondary btn-lg" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Memanggil antrian kembali yang sebelum nya tidak menjawab.">
                  Panggil Antrian Kembali <i class="fa fa-volume-up"></i>
                </button>
              </div>
            </form>
            <hr>
            <form action="<?= base_url('/pelayanan/stop') ?>" method="POST">
              <input type="hidden" name="kode" value="<?= $kode ?>">
              <div class="d-grid gap-2">
                <button name="panggil" value="baru" class="btn btn-outline-warning btn-lg btn-block" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Mengumumkan bahwa loket pelayanan ini akan berhenti/istirahat">
                  Isitrahat <i class="fa fa-volume-up"></i>
                </button>
              </div>
            </form>
          <?php } ?>
        </div>
      </div>
      <div id="appCapsule">
        <div class="htmx-indicator">
          <p>Mohon Tunggu</p>
        </div>
        <div hx-get="<?= base_url('mobile/biaya/page') ?>" hx-trigger="load">

        </div>
      </div>
    </div>
    <div class="col-6">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Daftar Antrian Pelayanan</h4>
          <ul class="simple-wrapper nav nav-tabs mt-3" id="myTab" role="tablist">
            <li class="nav-item" role="presentation"><a class="nav-link txt-primary active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Antrian Berjalan</a></li>
            <li class="nav-item" role="presentation"><a class="nav-link txt-primary" id="profile-tabs" data-bs-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false" tabindex="-1">Antrian Sudah Selesai</a></li>
          </ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade active show py-5" id="home" role="tabpanel" aria-labelledby="home-tab">
              <?= $this->load->component("table/antrian_pelayanan_berjalan") ?>
            </div>
            <div class="tab-pane fade py-5" id="profile" role="tabpanel" aria-labelledby="profile-tabs">
              <?= $this->load->component("table/antrian_pelayanan_selesai", ['data' => $antrian_berjalan->filter(
                function ($value, $key) {
                  return $value->petugas_id == $this->user["petugas"]["id"];
                }
              )->all()]) ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-3">
      <div class="card social-profile" style="background-image: none;">
        <div class="card-body">
          <div class="social-img-wrap">
            <div class="social-img"><img class="img-fluid" src="https://api.dicebear.com/6.x/adventurer/svg?seed=<?= $this->user["avatar"] ?>&backgroundColor=b6e3f4" alt="profile"></div>
            <div class="edit-icon">
              <svg>
                <use href="../assets/svg/icon-sprite.svg#profile-check"></use>
              </svg>
            </div>
          </div>
          <div class="social-details">
            <h5 class="mb-1"><a href="social-app.html"><?= $this->user["petugas"]['nama_petugas'] ?? $this->user["name"]  ?></a></h5><span class="f-light"><?= $this->user["petugas"]['jenis_petugas'] ?? $this->user['role']['role_name'] ?></span>
            <ul class="card-social">
              <li><a href="https://www.facebook.com/" target="_blank"><i class="fa fa-facebook"></i></a></li>
              <li><a href="https://accounts.google.com/" target="_blank"><i class="fa fa-google-plus"></i></a></li>
              <li><a href="https://twitter.com/" target="_blank"><i class="fa fa-twitter"></i></a></li>
              <li><a href="https://www.instagram.com/" target="_blank"><i class="fa fa-instagram"></i></a></li>
              <li><a href="https://rss.app/" target="_blank"><i class="fa fa-rss"></i></a></li>
            </ul>
            <ul class="social-follow">
              <li>
                <a class="text-dark" href="javacript:void(0)" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-html="true" data-bs-title="<strong>Total antrian yang dipanggil hari ini</strong>">
                  <h5 class="mb-0"> <?= $antrian_berjalan->where('petugas_id', $this->user["petugas"]["id"] ?? 'admin')->count() ?> </h5>
                </a><span class="f-light">Hari Ini</span>
              </li>
              <li>
                <a class="text-dark" href="javacript:void(0)" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-html="true" data-bs-title="<strong>Total antrian yang dipanggil bulan ini</strong>">
                  <h5 class="mb-0"><i class="fa fa-users"></i> <?= $total_bulan_ini ?> </h5>
                </a><span class="f-light"> Bulan Ini</span>
              </li>
              <li>
                <a class="text-warning" href="javacript:void(0)" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-html="true" data-bs-title="<strong>Penilaian dari para pihak</strong>">
                  <h5 class="mb-0"> <i class="fa fa-star"></i> 0 </h5>
                </a><span class="f-light">Rating</span>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="card bg-primary">
        <div class="card-body">
          <div class="text-center">
            <i class="fa fa-warning" style="font-size: xx-large;"></i>
            <h5 class="text-kelap-kelip">Perhatian</h5>
          </div>
          <?php if ($this->is_admin) { ?>
            <p>Selain PTSP tidak bisa mengganti Loket</p>
          <?php } else { ?>
            <?php if (!$currentLoket) { ?>
              <div class="bg-white rounded rounded-2 p-3 text-center">
                <h6 class="text-danger">
                  <div class="text-warning text-kelap-kelip"> Anda Belum Menentukan Loket. Silahkan pilih loket yang anda tempati saat ini</div>
                </h6>
              </div>
            <?php } else { ?>
              <div class="bg-white rounded rounded-2 p-3 text-center">
                <h6 class="text-danger">Anda Berada di loket
                  <div class="text-warning text-kelap-kelip"> <?= $currentLoket->nama_loket ?></div>
                </h6>
                <span class="text-dark"><strong>Apabila anda tidak/bukan berada di loket tersebut di atas</strong> silahkan ubah tujuan loket dibawah ini</span>
              </div>
            <?php } ?>
            <form action="<?= base_url("pelayanan/ganti_loket/" . Cypher::urlsafe_encrypt($this->user['petugas']['id'] ?? null)) ?>" method="post" class="mt-3">
              <label for="select-loket">Pilih Tujuan Loket Disini</label>
              <select name="loket_id" id="select-loket" class="form-select">
                <?php foreach ($loket as $l) { ?>
                  <option <?= $l->id == $this->user['petugas']['loket_id'] ? 'selected' : null ?> value="<?= $l->id ?>"><?= $l->nama_loket ?></option>
                <?php } ?>
              </select>
              <div class="text-center">
                <button class="btn btn-block btn-success mt-3">
                  <i class="fa fa-arrow-right"></i>
                  Pindah</button>
              </div>
            </form>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  window.addEventListener("load", function() {
    btnlengkapiDataKelapKelip()
  })

  function btnlengkapiDataKelapKelip() {
    $(".text-kelap-kelip").each((i, e) => {
      let cls = "text-danger";
      setInterval(() => {
        cls = cls === "text-danger" ? "text-warning" : "text-danger";
        e.classList.remove("text-danger", "text-warning");
        e.classList.add(cls);
      }, 500);
    })
  }
</script>