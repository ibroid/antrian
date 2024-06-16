<div class="header-large-title">
  <h1 class="title">Beranda</h1>
  <h4 class="subtitle">Selamat Datang di Pelayanan mobile Pengadilan Agama Jakarta Utara</h4>
</div>

<div class="section my-3">
  <?= $this->load->view("mobile/components/carousel", null, TRUE) ?>
</div>

<div class="divider bg-primary m-2"></div>
<div class="header-large-title">
  <div class="alert alert-outline-primary" role="alert">
    <div class="d-flex justify-content-between gap-5">
      <h4 class="alert-title">Antrian Pelayanan (PTSP) yang sedang dipanggil.</h4>
      <h4>
        <ion-icon size="large" color="primary" name="alert-circle-outline"></ion-icon>
      </h4>
    </div>
    <h5>Pastikan nomor antrian anda tidak terlewat. Apabila terlewat silahkan ambil antrian kembali</h5>
  </div>
</div>

<div hx-get="<?= base_url("mobile/beranda/slide_loket_pelayanan") ?>" hx-trigger="load delay:2s" class="section full mb-3">
  <div class="text-center m-4" class="htmx-indicator">
    <div class="spinner-border text-primary" role="status"></div>
  </div>
</div>


<div class="notification-box" id="no-antrian-notif">
  <div class="notification-dialog android-style">
    <div class="notification-header">
      <div class="in">
        <img src="<?= base_url('/assets/mobile/favicon_io/android-chrome-192x192.png') ?>" alt="image" class="imaged w24">
        <strong>Notifikasi</strong>
        <span>just now</span>
      </div>
      <a href="#" class="close-button">
        <ion-icon name="close"></ion-icon>
      </a>
    </div>
    <div class="notification-content">
      <div class="in">
        <h3 class="subtitle">Selamat Datang</h3>
        <div class="text">
          Sepertinya anda tidak/belum mendapatkan antrian. Silahkan klik dibawah ini untuk memulai dengan antrian anda.
        </div>
        <br>
        <div class="tetx">
          Pilih Ambil Antrian apabila anda belum mendapat antrian, apabila sudah silahkan klik Masukan Antrian.
        </div>
        <div class="d-flex my-3 gap-2">
          <button class="btn btn-sm btn-outline-primary">Ambil Antrian</button>
          <button class="btn btn-sm btn-outline-success">Masukan Antrian</button>
        </div>
      </div>
    </div>
  </div>
</div>



<script>
  htmx.onLoad(function(content) {
    // console.log("from htmx")

  })
</script>