<div class="appBottomMenu">
  <a href="javascript:void(0)" hx-get="<?= base_url("mobile/beranda/page") ?>" class="item" hx-target="#appCapsule" hx-indicator=".htmx-indicator">
    <div class="col">
      <ion-icon name="home-outline"></ion-icon>
      Beranda
    </div>
  </a>
  <a href="javascript:void(0)" hx-get="<?= base_url("mobile/antrian/page") ?>" class="item" hx-target="#appCapsule" hx-indicator=".htmx-indicator">
    <div class="col">
      <ion-icon name="apps-outline"></ion-icon>
      Ambil Antrian
    </div>
  </a>
  <a href="javascript:void(0)" hx-get="<?= base_url("mobile/jadwal/page") ?>" class="item" hx-target="#appCapsule" hx-indicator=".htmx-indicator">
    <div class="col">
      <ion-icon name="calendar-outline"></ion-icon>
      <span class="badge badge-danger"></span>
      Jadwal Sidang
    </div>
  </a>
  <a href="javascript:void(0)" hx-get="<?= base_url("mobile/informasi/page") ?>" class="item" hx-target="#appCapsule" hx-indicator=".htmx-indicator">
    <div class="col">
      <ion-icon name="easel-outline"></ion-icon>
      <span class="badge badge-danger"></span>
      Informasi
    </div>
  </a>
</div>

<div class="htmx-indicator toast-box toast-center show">
  <div class="in">
    <div class="text">
      Mohon tunggu ...
    </div>
  </div>
</div>