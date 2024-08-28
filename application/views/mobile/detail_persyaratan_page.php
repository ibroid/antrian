<style>
  /* Ensure the image takes up the full width of its container */
  .responsive-image {
    width: 100%;
    height: auto;
    /* Maintains aspect ratio */
    display: block;
  }

  /* Optional: style the image container */
  .image-container {
    max-width: 100%;
    /* This can be adjusted to limit the max size of the image */
    margin: 0 auto;
    /* Center the image container */
  }
</style>

<button hx-get="<?= base_url('mobile/persyaratan/page') ?>" class="btn btn-outline-primary ms-2 mt-2" hx-target="#appCapsule" hx-indicator=".htmx-indicator">
  <ion-icon name="return-down-back-outline"></ion-icon>
  Kembali
</button>


<div class="section mt-2">
  <div class="card">
    <div class="card-body">
      <?php foreach ($data->items as $ps) { ?>
        <div>
          <h3>Persyaratan</h3>
          <div class="image-container">
            <img class="responsive-image" src=" <?= base_url("mobile/persyaratan/get_icon/$ps->collectionId/$ps->id/$ps->poster") ?>" alt="poster">
          </div>
          <h3>Contoh-contoh Berkas dalam Persyaratan</h3>
          <?php foreach ($ps->contoh as $c) { ?>
            <a href="<?= base_url("mobile/persyaratan/get_icon/$ps->collectionId/$ps->id/$c") ?>" target="_blank">
              <img width="100" src="<?= base_url("mobile/persyaratan/get_icon/$ps->collectionId/$ps->id/$c") ?>" alt="contoh berkas">
            </a>
          <?php } ?>
        </div>
      <?php } ?>
    </div>
  </div>
</div>