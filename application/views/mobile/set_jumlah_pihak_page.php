<div class="header-large-title">
  <h1 class="title">Informasi Biaya</h1>
  <h4 class="subtitle">Tentukan jumlah pihak yang akan mendaftar</h4>
</div>

<button hx-get="<?= base_url('mobile/biaya/page') ?>" class="btn btn-outline-primary ms-2 mt-2" hx-target="#appCapsule" hx-indicator=".htmx-indicator">
  <ion-icon name="return-down-back-outline"></ion-icon>
  Kembali
</button>

<div class="section mt-2">
  <div class="card">
    <div class="card-body">
      <form method="POST" hx-post="<?= base_url("mobile/biaya/pilih_multiple_radius/$jenis_perkara_id") ?>" hx-indicator=".htmx-indicator" hx-target="#appCapsule">
        <label for="input-jumlah-p">Jumlah Pihak Pemohon/Penggugat</label>
        <div class="d-flex gap-2 mt-2 align-self-center">
          <input required type="number" id="input-jumlah-p" name="jumlah_p" placeholder="Masukan Jumlah">
          <div>
            <p>: Orang</p>
          </div>
        </div>
        <hr class="m-2">
        <label for="input-jumlah-t">Jumlah Pihak Termohon/Tergugat</label>
        <div class="d-flex gap-2 mt-2 align-self-center">
          <input required type="number" id="input-jumlah-t" name="jumlah_t" placeholder="Masukan Jumlah">
          <div>
            <p>: Orang</p>
          </div>
        </div>
        <div class="text-end">
          <button class="btn btn-success mt-2">
            <ion-icon name="send-outline"></ion-icon>
            Lanjutkan
          </button>
        </div>
      </form>
    </div>
  </div>
</div>