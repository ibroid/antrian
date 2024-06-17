<div class="header-large-title">
  <h1 class="title">Beranda</h1>
  <h4 class="subtitle">Selamat Datang di Pelayanan mobile Pengadilan Agama Jakarta Utara</h4>
</div>

<div class="section my-3">
  <?= $this->load->view("mobile/components/carousel", null, TRUE) ?>
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
  <div class="text-center m-4" class="htmx-indicator">
    <div class="spinner-border text-primary" role="status"></div>
  </div>
</div>

<div class="header-large-title">
  <div class="alert alert-outline-danger" role="alert">
    <div class="d-flex justify-content-between gap-5">
      <h4 class="alert-title">Antrian Persidangan yang sedang berjalan.</h4>
      <h4>
        <ion-icon size="large" color="danger" name="alert-circle-outline"></ion-icon>
      </h4>
    </div>
    <h5>Pastikan nomor antrian anda tidak terlewat. Apabila terlewat silahkan melapor ke petugas. Mohon untuk diperhatikan nama ruang sidang dan nomor ruang sidang yang tertera pada bagian atas karcis antrian anda</h5>
  </div>
</div>

<div hx-get="<?= base_url("mobile/beranda/slide_antrian_sidang") ?>" hx-trigger="load" class="section full mb-3">
  <div class="text-center m-4" class="htmx-indicator">
    <div class="spinner-border text-primary" role="status"></div>
  </div>
</div>