<form class="form" hx-post="<?= base_url($post_url) ?>" hx-indicator=".htmx-indicator">
  <div class="form-group">
    <label for="input-nomor-perkara">Masukan Nomor Perkara Anda</label>
    <input required type="text" class="form-control opacity" name="nomor_perkara" id="input-nomor-perkara" placeholder="Contoh: 123/Pdt.G/2024/PA.JU">
    <p>Nomor perkara anda dapatkan dari petugas saat mendaftarkan perkara.</p>
  </div>
  <button class="btn btn-primary">Ambil Antrian</button>
</form>