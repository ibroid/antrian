<div class="header-large-title">
  <h1 class="title">Pilih Radius</h1>
  <h4 class="subtitle">Silahkan pilih radius sesuai dengan domisili/alamat anda</h4>
</div>

<button hx-get="<?= base_url('mobile/biaya/page') ?>" class="btn btn-outline-primary ms-2 mt-2" hx-target="#appCapsule" hx-indicator=".htmx-indicator">
  <ion-icon name="return-down-back-outline"></ion-icon>
  Kembali
</button>

<div class="section mt-2">
  <div class="card">
    <div class="card-body">
      <form hx-post="<?= base_url("mobile/biaya/hasil/$perkara->id") ?>" hx-indicator=".htmx-indicator" hx-target="#appCapsule">
        <?php for ($i = 0; $i < $jumlah_p; $i++) { ?>
          <label for="radius_p<?= $i ?>">Alamat Pihak <?= $perkara->nama_p . " " . ($i + 1) ?> :</label>
          <select class="form-control my-3" name="radius_p[]" id="radius_p<?= $i ?>">
            <?php foreach ($radius->items as $n => $r) { ?>
              <option value="<?= $r->biaya ?>"><?= $r->wilayah ?></option>
            <?php } ?>
          </select>
        <?php  } ?>
        <hr>
        <?php for ($i = 0; $i < $jumlah_t; $i++) { ?>
          <label for="radius_t<?= $i ?>">Alamat Pihak <?= $perkara->nama_t . " " . ($i + 1) ?> :</label>
          <select class="form-control my-3" name="radius_t[]" id="radius_t<?= $i ?>">
            <?php foreach ($radius->items as $n => $r) { ?>
              <option value="<?= $r->biaya ?>"><?= $r->wilayah ?></option>
            <?php } ?>
          </select>
        <?php  } ?>
        <button class="btn btn-success mt-2">
          <ion-icon name="send-outline"></ion-icon>
          Lanjutkan
        </button>
      </form>
    </div>
  </div>
</div>