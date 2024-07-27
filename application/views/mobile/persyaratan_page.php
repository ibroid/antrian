<div class="header-large-title">
  <h1 class="title">Persyaratan Pendaftaran</h1>
</div>
<button hx-get="<?= base_url('mobile/informasi/page') ?>" class="btn btn-outline-primary ms-2 mt-2" hx-target="#appCapsule" hx-indicator=".htmx-indicator">
  <ion-icon name="return-down-back-outline"></ion-icon>
  Kembali
</button>

<div class="section mt-2">
  <?php foreach ($data->items as $k => $d) { ?>
    <div class="card my-2">
      <div class="card-body">
        <div class="card-title">Persyaratan <?= $d->nama_perkara ?></div>
        <div class="card-text">
          <?php print_r($d->expand->persyaratan_via_jenis_perkara_id[0]->isi) ?>
        </div>
      </div>
    </div>
  <?php } ?>
</div>