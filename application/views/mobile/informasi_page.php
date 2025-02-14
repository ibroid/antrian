<div class="header-large-title">
  <h1 class="title">Pusat Informasi</h1>
  <h4 class="subtitle">Memenuhi segala kebutuhan informasi di <?= $this->sysconf->NamaPN ?>rata Utara</h4>
</div>

<div class="section full mt-5">
  <div class="mt-2 p-2 pt-0 pb-0">
    <div class="d-flex justify-content-between mx-2">
      <div class="  p-2 rounded-5" hx-get="<?= base_url("mobile/persyaratan/page") ?>" hx-target="#appCapsule" hx-indicator=".htmx-indicator">
        <div class="text-center">
          <img src="<?= base_url('static/icons/documents.png?r') ?>" alt="">
        </div>
        <div class="text-center">
          Persyaratan
        </div>
      </div>
      <div class="  p-2 rounded-5" hx-get="<?= base_url("mobile/biaya/page") ?>" hx-target="#appCapsule" hx-indicator=".htmx-indicator">
        <div class="text-center">
          <img src="<?= base_url('static/icons/money.png?s') ?>" alt="">
        </div>
        <div class="text-center">
          Biaya
        </div>
      </div>
      <div class="  p-2 rounded-5" hx-get="<?= base_url("mobile/prodeo/page") ?>" hx-target="#appCapsule" hx-indicator=".htmx-indicator">
        <div class="text-center">
          <img src="<?= base_url('static/icons/free.png?s') ?>" alt="">
        </div>
        <div class="text-center">
          Prodeo
        </div>
      </div>
    </div>
    <div class="d-flex justify-content-between mx-2 mt-2">
      <a href="https://filebrowser.pajakartautara.id/share/hW0WrRbR" target="_blank" class=" p-1 rounded-5">
        <div class="text-center">
          <img src="<?= base_url('static/icons/transparansi.png?s') ?>" alt="">
        </div>
        <div class="text-center">
          Transparansi
        </div>
      </a>
      <div class=" p-2 rounded-5" hx-get="<?= base_url("mobile/time_line/page") ?>" hx-target="#appCapsule" hx-indicator=".htmx-indicator">
        <div class="text-center">
          <img src="<?= base_url('static/icons/step.png?s') ?>" alt="">
        </div>
        <div class="text-center">
          Proses Perkara
        </div>
      </div>
      <div class=" p-2 rounded-5" hx-get="<?= base_url("mobile/valak/page") ?>" hx-target="#appCapsule" hx-indicator=".htmx-indicator">
        <div class="text-center">
          <img src="<?= base_url('static/icons/cert.png?s') ?>" alt="">
        </div>
        <div class="text-center">
          Validasi Akta
        </div>
      </div>
    </div>
  </div>
</div>