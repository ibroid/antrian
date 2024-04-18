<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card  mt-5 shadow" style="max-width: 50rem;">
        <div class="card-header">
          <h6 class="m-0 font-weight-bold text-primary">Form Tambah Pengguna</h6>
        </div>
        <div class="card-body">
          <form class="needs-validation" action="<?= base_url('admin/pengguna/tambah') ?>" method="post" novalidate>
            <div class="form-group">
              <label for="nama_lengkap">Nama lengkap</label>
              <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control" style="margin-bottom:10px;" required>
            </div>
            <div class="form-group">
              <label for="identifier">Identifier</label>
              <input type="text" name="identifier" id="identifier" class="form-control" style="margin-bottom:10px;" required>
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" name="password" id="password" class="form-control" style="margin-bottom:10px;" required>
            </div>
            <div class="form-group">
              <label for="level">Level</label>
              <select name="level" id="level" class="form-control" style="margin-bottom:10px;" required>
                <?php foreach ($roles as $r) : ?>
                  <option value="<?= $r->id ?>"><?= $r->role_name ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group">
              <label for="jenis_petugas">Jenis Petugas</label>
              <select name="jenis_petugas" id="jenis_petugas" class="form-control" style="margin-bottom:10px;" required>
                <option value="-">--- Pilih hanya jika level adalah petugas ---</option>
                <?php foreach ((function () {
                  return [
                    'Petugas PTSP',
                    'Petugas Sidang',
                    'Petugas Produk',
                    'Kasir',
                    'Petugas Antrian',
                    'Petugas Akta'
                  ];
                })() as $p) : ?>
                  <option><?= $p ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group">
              <label for="status">Status</label>
              <select name="status" id="status" class="form-control" style="margin-bottom:10px;" required>
                <option value="active">Aktif</option>
                <option value="inactive">Tidak Aktif</option>
              </select>
            </div>
            <div class="form-group text-end mt-4">
              <button type="submit" class="btn btn-primary btn-block" style="margin-bottom:10px;">Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>