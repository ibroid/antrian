<div class="header-large-title">
    <h1 class="title">Proses Perkara</h1>
    <h4 class="subtitle">Lihat proses perkara anda disini.</h4>
</div>
<button hx-get="<?= base_url('mobile/informasi/page') ?>" class="btn btn-sm btn-outline-primary ms-2 mt-2" hx-target="#appCapsule" hx-indicator=".htmx-indicator">
    <ion-icon name="return-down-back-outline"></ion-icon>
    Kembali
</button>

<div class="section">
    <form hx-post="<?= base_url('/mobile/time_line/search') ?>" hx-indicator=".htmx-indicator" hx-swap="outerHTML">
        <div class="form-group boxed">
            <div class="input-wrapper">
                <label class="form-label" for="name5">
                    <div class="text-center">
                        Masukan Nomor Perkara
                    </div>
                </label>
                <input type="text" class="form-control" id="input-nomor-perkara" name="nomor_perkara" placeholder="Contoh : 123/Pdt.G/2024/PA.Ju" autocomplete="off">
            </div>
        </div>
        <div class="text-center">
            <button class="btn btn-primary">
                Cari Perkara
            </button>
        </div>
    </form>
</div>