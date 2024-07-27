<form hx-post="<?= base_url("mobile/antrian/set_nomor_perkara") ?>" hx-indicator=".htmx-indicator" hx-swap="outerHTML">
  <h4 class="text-white"><?= $error_message ?></h4>
  <input type="hidden" name="post_url" value="/mobile/antrian/ambil_sidang">
  <button type="submit" class="btn btn-light">Coba Lagi</button>
</form>