<div class="header-large-title">
  <h1 class="title">Persyaratan Pendaftaran</h1>
</div>
<button hx-get="<?= base_url('mobile/informasi/page') ?>" class="btn btn-outline-primary ms-2 mt-2" hx-target="#appCapsule" hx-indicator=".htmx-indicator">
  <ion-icon name="return-down-back-outline"></ion-icon>
  Kembali
</button>

<div class="section mt-2">
  <div class="card my-2">
    <div class="card-body">
      <div class="row">
        <?php foreach ($data->items as $jp) { ?>
          <div class="col-4">
            <div class="border border-5 rounded-5 py-4 my-3" hx-get="<?= base_url("mobile/persyaratan/get/$jp->id") ?>" hx-target="#appCapsule" hx-indicator=".htmx-indicator">
              <div class="text-center">
                <img width="30" src="<?= base_url("mobile/persyaratan/get_icon/$jp->collectionId/$jp->id/$jp->icon") ?>" alt="icon" class="mb-3">
              </div>
              <div class="text-center">
                <?= $jp->nama_perkara ?>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
  </div>
</div>