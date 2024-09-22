<div class="header-large-title">
  <h1 class="title">Validasi Akta</h1>
  <h4 class="subtitle">Lihat Keaslian dari Akta Cerai anda disini.</h4>
</div>
<button hx-get="<?= base_url('mobile/informasi/page') ?>" class="btn btn-sm btn-outline-primary ms-2 mt-2" hx-target="#appCapsule" hx-indicator=".htmx-indicator">
  <ion-icon name="return-down-back-outline"></ion-icon>
  Kembali
</button>

<div class="section">
  <form hx-post="<?= base_url('/mobile/valak/search') ?>" hx-indicator=".htmx-indicator" hx-swap="outerHTML">
    <div class="form-group boxed">
      <div class="input-wrapper">
        <label class="form-label" for="name5">
          <div class="text-center">
            Masukan Nomor Akta Cerai
          </div>
        </label>
        <input type="text" class="form-control" id="input-nomor-akta" name="nomor_akta" placeholder="Contoh : 123/AC/2024/PA.JU" autocomplete="off">
      </div>
    </div>
    <div class="text-center">
      <button class="btn btn-primary">
        Cari Akta
      </button>
    </div>
  </form>
</div>