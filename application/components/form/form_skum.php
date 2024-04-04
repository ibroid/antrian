<form action="<?= base_url("kasir/cetak_psp") ?>" method="post">
  <input type="hidden" value="<?= $perkara_id ?>" name="perkara_id">
  <div class="row mb-3">
    <div class="col">
      <select name="penandatangan" required class="form-control form-control-select form-select" id="select-penandatangan">
        <option value="" disabled selected>--- Pilih Penandatangan ---</option>
        <?php foreach ($penandatangan as $p) { ?>
          <option><?= $p->nama ?></option>
        <?php } ?>
      </select>
    </div>
    <div class="col">
      <button class="btn btn-success">Cetak SKUM</button>
    </div>
  </div>
</form>