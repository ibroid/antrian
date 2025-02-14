<div class="form-group mb-4">
  <label for="loket_id" class="form-label">Penempatan Loket</label>
  <select class="form-select" name="loket_id" id="loket_id">
    <?php foreach ($loket as $l) { ?>
      <option value="<?= $l->id  ?>"
        <?php
        if (isset($petugas)) {
          echo $l->id == $petugas->loket_id ? "selected" : null;
        }
        ?>> <?= $l->nama_loket ?></option>
    <?php } ?>

  </select>
</div>
<div class="form-group mb-4">
  <label for="loket_id" class="form-label">Jenis Layanan</label>
  <div class="overflow-auto border" style="height: 200px;">
    <ol class="mt-3">
      <?php foreach ($jenis_pelayanan as $jpl) { ?>
        <li>
          <div class=" form-check">
            <input
              name="jenis_pelayanan[]"
              type="checkbox"
              value="<?= $jpl->id ?>"
              class="form-check-input"
              id="check<?= $jpl->id ?>"
              <?php
              if (isset($petugas)) {
                if ($petugas->jenis_pelayanan->where("id", $jpl->id)->first()) {
                  echo "checked";
                }
              }
              ?> />
            <label class="form-check-label" for="check<?= $jpl->id ?>"><?= $jpl->nama_layanan ?></label>
          </div>
        </li>
      <?php } ?>
    </ol>
  </div>
  <div class="alert alert-info" role="alert">
    <small>Ceklis Jenis layanan antrian yang ingin dipanggil oleh Petugas</small>
  </div>

</div>