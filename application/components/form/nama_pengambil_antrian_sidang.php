<form
  hx-post=<?= base_url('/ambil/ambil_antrian_sidang?secondary=true') ?>"
  hx-targe="#hasil-print"
  style="width: 500px;"
  class="my-3">
  <input type="hidden" name="perkara_id" value="<?= $data->perkara_id ?>">
  <input type="hidden" name="nomor_ruang" value="<?= $data->ruangan_id ?>">
  <input type="hidden" name="nama_ruang" value="<?= $data->ruangan ?>">
  <input type="hidden" name="nomor_perkara" value="<?= $data->perkara->nomor_perkara ?>">
  <input type="hidden" name="tanggal_sidang" value="<?= $data->tanggal_sidang ?>">
  <input type="hidden" name="jadwal_sidang_id" value="<?= $data->id ?>">
  <input type="hidden" name="nama_yang_ambil" value="<?= $nama ?>">
  <input type="hidden" name="majelis_hakim" value="<?= $data->perkara->penetapan->majelis_hakim_nama ?>">
  <button type="submit" name="yang_ambil" value="<?= $pos ?>" class="btn btn-success">
    <h3><?= $nama ?></h3>
  </button>
</form>
<div id="hasil-print"></div>