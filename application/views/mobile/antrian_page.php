<div class="header-large-title">
  <h1 class="title">Ambil Antrian</h1>
  <h4 class="subtitle">Silahkan Ambil Antrian Sesuai Kebutuhan Anda</h4>
</div>

<div class="section">
  <div class="card bg-dark text-white mt-3">
    <img src="<?= base_url('static/img/m_img_sidang.png') ?>" class="card-img overlay-img" alt="image">
    <div class="card-img-overlay d-flex flex-column">
      <h5 class="card-title">Antrian Persidangan</h5>
      <p class="card-text" style="font-size: larger;">Khusus yang akan bersidang hari ini. Untuk melihat jadwal sidang silahkan ke menu jadwal sidang</p>
      <button class="btn btn-light mt-auto">Ambil Antrian</button>
    </div>
  </div>
  <div class="card bg-dark text-white mt-3">
    <img src="<?= base_url('static/img/m_img_informasi.png') ?>" class="card-img overlay-img" alt="image">
    <div class="card-img-overlay d-flex flex-column">
      <h5 class="card-title">Antrian Informasi</h5>
      <p class="card-text" style="font-size: larger;">Bingung harus mulai darimana ? Kesini dulu biar jelas informasi pendaftaran nya.</p>
      <!-- <form hx-post="<?= base_url("mobile/antrian/ambil_ptsp") ?>"> -->
      <input type="hidden" name="kode" value="A">
      <input type="hidden" name="tujuan" value="INFORMASI">
      <button onclick="toastbox('toast-antrian')" class="btn btn-light mt-auto">Ambil Antrian</button>
      <!-- </form> -->
    </div>
  </div>
  <div class="card bg-dark text-white mt-3">
    <img src="<?= base_url('static/img/m_img_gugatan.png') ?>" class="card-img overlay-img" alt="image">
    <div class="card-img-overlay d-flex flex-column">
      <h5 class="card-title">Antrian Posbakum</h5>
      <p class="card-text" style="font-size: larger;">Buat gugatan kamu disni. Gratis</p>
      <button class="btn btn-light mt-auto">Ambil Antrian</button>
    </div>
  </div>
  <div class="card bg-dark text-white mt-3">
    <img src="<?= base_url('static/img/m_img_bayar.png') ?>" class="card-img overlay-img" alt="image">
    <div class="card-img-overlay d-flex flex-column">
      <h5 class="card-title">Antrian Kasir</h5>
      <p class="card-text" style="font-size: larger;">Bayar atau Ambil Kembalian kamu disini</p>
      <button class="btn btn-light mt-auto">Ambil Antrian</button>
    </div>
  </div>
  <div class="card bg-dark text-white mt-3">
    <img src="<?= base_url('static/img/m_img_produk.png') ?>" class="card-img overlay-img" alt="image">
    <div class="card-img-overlay d-flex flex-column">
      <h5 class="card-title">Antrian Produk</h5>
      <p class="card-text" style="font-size: larger;">Mau ngmabil akte/surat cerai ?. Ambil disini ya</p>
      <button class="btn btn-light mt-auto">Ambil Antrian</button>
    </div>
  </div>
</div>

<div id="toast-antrian" class="toast-box toast-center tap-to-close">
  <div class="in">
    <ion-icon name="checkmark-circle" class="text-success"></ion-icon>
    <div class="text">
      Success Message
    </div>
  </div>
  <button onclick="document.getElementById('toast-antrian').classList.remove('show').add('hide')" type="button" toggle-dismiss="modal" class="btn btn-sm btn-text-light close-button">Tutup</button>
</div>