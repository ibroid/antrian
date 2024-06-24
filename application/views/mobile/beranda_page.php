<div class="header-large-title">
  <h1 class="title">Beranda</h1>
  <h4 class="subtitle">Selamat Datang di Pelayanan mobile Pengadilan Agama Jakarta Utara</h4>
</div>

<div class="section my-3">
  <?= $this->load->view("mobile/components/carousel", null, TRUE) ?>
</div>

<div hx-get="<?= base_url("mobile/antrian/my_antrian_ptsp") ?>" hx-trigger="load, every 10s" class="section" id="my-antrian-ptsp">
  <div class="text-center m-4 htmx-indicator">
    <div class="spinner-border text-primary" role="status"></div>
  </div>
</div>

<div hx-get="<?= base_url("mobile/antrian/my_antrian_sidang") ?>" hx-trigger="load, every 9s" class="section" id="my-antrian-sidang">
  <div class="text-center m-4 htmx-indicator">
    <div class="spinner-border text-primary" role="status"></div>
  </div>
</div>

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

<div hx-get="<?= base_url("mobile/beranda/slide_loket_pelayanan") ?>" hx-trigger="load" class="section full mb-3">
  <div class="text-center m-4 htmx-indicator">
    <div class="spinner-border text-primary" role="status"></div>
  </div>
</div>

<div class="header-large-title">
  <div class="alert alert-outline-info" role="alert">
    <div class="d-flex justify-content-between gap-5">
      <h4 class="alert-title">Antrian Persidangan yang sedang berjalan.</h4>
      <h4>
        <ion-icon size="large" color="info" name="alert-circle-outline"></ion-icon>
      </h4>
    </div>
    <h5>Pastikan nomor antrian anda tidak terlewat. Apabila terlewat silahkan melapor ke petugas. Mohon untuk diperhatikan nama ruang sidang dan nomor ruang sidang yang tertera pada bagian atas karcis antrian anda</h5>
  </div>
</div>

<div hx-get="<?= base_url("mobile/beranda/slide_antrian_sidang") ?>" hx-trigger="load" class="section full mb-3">
  <div class="text-center m-4 htmx-indicator">
    <div class="spinner-border text-primary" role="status"></div>
  </div>
</div>

<div class="section">
  <hr>
  <div class="card bg-dark text-light">
    <img src="<?= base_url('static/img/free_wifi.png') ?>" class="card-img overlay-img" alt="image">
    <div class="card-img-overlay text-center d-flex flex-column justify-content-center">
      <h4 class="text-light">Password Wifi Pengadilan Agama Jakarta Utara</h4>
      <p>Nama Wifi : SMARTPAJU_PUBLIK <br> Password : wbbmpasti</p>
      <button onclick="copyPassWifi()" class="btn btn-light">
        <ion-icon name="copy-outline"></ion-icon>
        Salin Password
      </button>
    </div>
  </div>
</div>

<div class="section">
  <div class="alert alert-outline-danger my-4">
    <div class="d-flex align-items-center justify-content-between p-1">
      <img src="<?= base_url('static/vector/stop.png') ?>" alt="Stop Sign" width="200">
      <h3 class="text-end text-start ">STOP ! <br> Sebelum anda meninggalkan gedung pengadilan <?= ucwords(strtolower($this->settings->satker_name)) ?>, Pastikan anda mengembalikan barang berikut.</h3>
    </div>
    <ol>
      <li class="h6">Kalung Identitas Pengunjung yang dibagikan petugas saat memasuki gedung pengadilan</li>
      <li class="h6">Kartu parkir kendaraan anda yang diberikan security</li>
    </ol>
  </div>
</div>