<div class="section mt-2">
  <div class="card">
    <div class="card-body">
      <?php foreach ($data->items as $ps) { ?>
        <div>
          <h3>Persyaratan</h3>
          <?= $ps->isi ?>
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