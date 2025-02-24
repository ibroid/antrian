<div class="header-large-title">
  <h1 class="title">Ambil Antrian</h1>
  <h4 class="subtitle">Silahkan Ambil Antrian Sesuai Kebutuhan Anda</h4>
</div>

<div class="section mt-5">
  <div class="text-center">
    <h4 class="text-danger">Mohon maaf untuk sementara pengambilan secara online belum bisa dilakukan.</h4>
  </div>
  <!-- <div class="card bg-dark text-white mt-3">
    <img src="<?= base_url('static/img/m_img_sidang.png') ?>" class="card-img overlay-img" alt="image">
    <div id="card-body-antrian-sidang" class="card-img-overlay d-flex flex-column justify-content-between">
      <div>
        <h5 class="card-title">Antrian Persidangan</h5>
        <p class="card-text" style="font-size: larger;">Khusus yang akan bersidang hari ini. Untuk melihat jadwal sidang silahkan ke menu jadwal sidang</p>
      </div>
      <?php if ($allowed_ambil_sidang) { ?>
        <form hx-post="<?= base_url("mobile/antrian/set_nomor_perkara") ?>" hx-indicator=".htmx-indicator" hx-target="#card-body-antrian-sidang">
          <input type="hidden" name="post_url" value="/mobile/antrian/ambil_sidang">
          <button type="submit" class="btn btn-light">Ambil Antrian</button>
        </form>
      <?php } else { ?>
        <p>Anda belum bisa mengambil antrian sidang</p>
      <?php } ?>
    </div>
  </div>

  <div class="card bg-dark text-white mt-3">
    <img src="<?= base_url('static/img/m_img_informasi.png') ?>" class="card-img overlay-img" alt="image">
    <div class="card-img-overlay d-flex flex-column justify-content-between">
      <div>
        <h5 class="card-title">Antrian Informasi</h5>
        <p class="card-text" style="font-size: larger;">Bingung harus mulai darimana ? Kesini dulu biar jelas informasi pendaftaran nya.</p>
      </div>
      <?php if ($allowed_ambil_ptsp) { ?>
        <form hx-post="<?= base_url("mobile/antrian/ambil_ptsp") ?>" hx-indicator=".htmx-indicator" hx-swap="outerHTML">
          <input type="hidden" name="kode" value="A">
          <input type="hidden" name="tujuan" value="INFORMASI">
          <button type="submit" class="btn btn-light">Ambil Antrian</button>
        </form>
      <?php } else { ?>
        <p>Anda belum bisa mengambil antrian pelayanan</p>
      <?php } ?>
    </div>
  </div>

  <div class="card bg-dark text-white mt-3">
    <img src="<?= base_url('static/img/m_img_gugatan.png') ?>" class="card-img overlay-img" alt="image">
    <div class="card-img-overlay d-flex flex-column justify-content-between">
      <div>
        <h5 class="card-title">Antrian Posbakum</h5>
        <p class="card-text" style="font-size: larger;">Buat gugatan kamu disni. Gratis</p>
      </div>
      <?php if ($allowed_ambil_ptsp) { ?>
        <form hx-post="<?= base_url("mobile/antrian/ambil_ptsp") ?>" hx-indicator=".htmx-indicator" hx-swap="outerHTML">
          <input type="hidden" name="kode" value="C">
          <input type="hidden" name="tujuan" value="POSBAKUM">
          <button type="submit" class="btn btn-light">Ambil Antrian</button>
        </form>
      <?php } else { ?>
        <p>Anda belum bisa mengambil antrian pelayanan</p>
      <?php } ?>
    </div>
  </div>

  <div class="card bg-dark text-white mt-3">
    <img src="<?= base_url('static/img/m_img_pendaftaran.png') ?>" class="card-img overlay-img" alt="image">
    <div class="card-img-overlay d-flex flex-column justify-content-between">
      <div>
        <h5 class="card-title">Antrian Pendaftaran</h5>
        <p class="card-text" style="font-size: larger;">Berkas kamu sudah siap ?. Lanjut mendaftar dengan antrian ini.</p>
      </div>
      <?php if ($allowed_ambil_ptsp) { ?>
        <form hx-post="<?= base_url("mobile/antrian/ambil_ptsp") ?>" hx-indicator=".htmx-indicator" hx-swap="outerHTML">
          <input type="hidden" name="kode" value="A">
          <input type="hidden" name="tujuan" value="PENDAFTARAN">
          <button type="submit" class="btn btn-light">Ambil Antrian</button>
        </form>
      <?php } else { ?>
        <p>Anda belum bisa mengambil antrian pelayanan</p>
      <?php } ?>
    </div>
  </div>

  <div class="card bg-dark text-white mt-3">
    <img src="<?= base_url('static/img/m_img_bayar.png') ?>" class="card-img overlay-img" alt="image">
    <div class="card-img-overlay d-flex flex-column justify-content-between">
      <div>
        <h5 class="card-title">Antrian Kasir</h5>
        <p class="card-text" style="font-size: larger;">Bayar atau Ambil Kembalian kamu disini</p>
      </div>
      <?php if ($allowed_ambil_ptsp) { ?>
        <form hx-post="<?= base_url("mobile/antrian/ambil_ptsp") ?>" hx-indicator=".htmx-indicator" hx-swap="outerHTML">
          <input type="hidden" name="kode" value="B">
          <input type="hidden" name="tujuan" value="KASIR">
          <button type="submit" class="btn btn-light">Ambil Antrian</button>
        </form>
      <?php } else { ?>
        <p>Anda belum bisa mengambil antrian pelayanan</p>
      <?php } ?>
    </div>
  </div>

  <div class="card bg-dark text-white mt-3">
    <img src="<?= base_url('static/img/m_img_produk.png') ?>" class="card-img overlay-img" alt="image">
    <div class="card-img-overlay d-flex flex-column justify-content-between">
      <div>
        <h5 class="card-title">Antrian Produk</h5>
        <p class="card-text" style="font-size: larger;">Mau ngmabil akte/surat cerai ?. Ambil disini ya</p>
      </div>
      <?php if ($allowed_ambil_ptsp) { ?>
        <form hx-post="<?= base_url("mobile/antrian/ambil_ptsp") ?>" hx-indicator=".htmx-indicator" hx-swap="outerHTML">
          <input type="hidden" name="kode" value="D">
          <input type="hidden" name="tujuan" value="PRODUK">
          <button type="submit" class="btn btn-light">Ambil Antrian</button>
        </form>
      <?php } else { ?>
        <p>Anda belum bisa mengambil antrian pelayanan</p>
      <?php } ?>
    </div>
  </div> -->
</div>