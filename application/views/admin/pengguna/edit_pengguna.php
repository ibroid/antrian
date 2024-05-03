<div class="container py-3">
  <div class="row justify-content-center ">
    <div class="col-md-6">
      <?= $this->session->flashdata("flash_alert") ?>
      <?= $this->session->flashdata("flash_error") ?>
      <div class="card mt-3 shadow" style="max-width: 50rem;">
        <div class="card-header">
          <h6 class="m-0 font-weight-bold text-primary">Form Edit Pengguna</h6>
        </div>
        <div class="card-body">
          <form class="needs-validation" action="<?= base_url('pengguna/update/' . Cypher::urlsafe_encrypt($pengguna->id)) ?>" method="post" novalidate autocomplete="off">
            <div class="form-group">
              <label for="nama_lengkap">Nama lengkap</label>
              <input value="<?= $pengguna->name ?>" type="text" name="nama_lengkap" id="nama_lengkap" class="form-control" style="margin-bottom:10px;" required>
            </div>
            <div class="form-group">
              <label for="identifier">Identifier</label>
              <input value="<?= $pengguna->identifier ?>" type="text" name="identifier" id="identifier" class="form-control" minlength="5" style="margin-bottom:10px;" required>
            </div>
            <div class="form-group">
              <label for="level">Level</label>
              <select name="level" id="level" class="form-control" style="margin-bottom:10px;" required>
                <option value="<?= $pengguna->role_id ?>"><?= $pengguna->role->role_name ?></option>
                <?php foreach ($roles as $r) : ?>
                  <option value="<?= $r->id ?>"><?= $r->role_name ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group">
              <label for="jenis_petugas">Jenis Petugas</label>
              <select name="jenis_petugas" id="jenis_petugas" class="form-control" style="margin-bottom:10px;" required>
                <option value="<?= $pengguna->petugas->id ?>"><?= $pengguna->petugas->jenis_petugas ?></option>
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
                <option value="<?= $pengguna->status ?>"><?= $pengguna->status == "active" ? "Aktif" : "Tidak Aktif" ?></option>
                <option value="active">Aktif</option>
                <option value="inactive">Tidak Aktif</option>
              </select>
            </div>
            <div class="form-group">
              <label for="avatar">Avatar</label>
              <input value="<?= $pengguna->avatar ?>" placeholder="Tulis nickname user" type="text" name="avatar" id="avatar" class="form-control" style="margin-bottom:10px;" required>
              <img width="200" src="https://api.dicebear.com/8.x/adventurer/svg?seed=<?= $pengguna->avatar ?>" alt="avatar" />
              <script>
                window.addEventListener('load', function() {
                  $('#avatar').keyup(function(e) {
                    if (e.which == 13) {
                      e.preventDefault();
                      return false;
                    }

                    console.log('ok')

                    $("#avatar").next("img").attr("src", "https://api.dicebear.com/8.x/adventurer/svg?seed=" + $(this).val());
                  })
                })
              </script>
            </div>
            <div class="form-group text-end mt-4">
              <a href="<?= base_url("/pengguna") ?>" class="btn btn-secondary btn-block" style="margin-bottom:10px;">Kembali</a>
              <button type="submit" class="btn btn-primary btn-block" style="margin-bottom:10px;">Simpan</button>
            </div>
          </form>
        </div>
      </div>
      <div class="card mt-3 shadow" style="max-width: 50rem;">
        <div class="card-header">
          <h6 class="m-0 font-weight-bold text-primary">Form Ubah Password</h6>
        </div>
        <div class="card-body">
          <form class="needs-validation" action="<?= base_url('pengguna/change_password/' . Cypher::urlsafe_encrypt($pengguna->id)) ?>" method="post" novalidate autocomplete="off">
            <div class="form-group">
              <label for="password_lama">Password Lama</label>
              <input type="password" name="password_lama" id="password_lama" class="form-control" style="margin-bottom:10px;" required>
            </div>
            <div class="form-group">
              <label for="password_baru">Password Baru</label>
              <input type="password" name="password_baru" id="password_baru" class="form-control" style="margin-bottom:10px;" required>
            </div>
            <div class="form-group text-end mt-4">
              <button type="submit" class="btn btn-primary btn-block" style="margin-bottom:10px;">Simpan</button>
            </div>
          </form>
        </div>
      </div>
      <div class="card mt-3 shadow" style="max-width: 50rem;">
        <div class="card-header">
          <h6 class="m-0 font-weight-bold">Form Hapus Data Pengguna</h6>
        </div>
        <div class="card-body">
          <div class="alert alert-secondary">
            <div class="text-center">
              <i class="fa fa-warning"></i>
            </div>
            <h5 class="text-center">Anda yakin ingin menghapus user ini?</h5>
            <p class="text-center">Masukan password untuk menghapus user</p>
          </div>
          <form action="<?= base_url('pengguna/delete/' . Cypher::urlsafe_encrypt($pengguna->id)) ?>" method="post" novalidate autocomplete="off">
            <div class="form-group">
              <label for="password_hapus">Password</label>
              <input type="password" name="password_hapus" id="password_hapus" class="form-control" style="margin-bottom:10px;" required>
            </div>
            <div class="form-group text-end mt-4">
              <button type="submit" class="btn btn-danger btn-block" style="margin-bottom:10px;">Hapus</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  window.addEventListener("load", () => {
    (() => {
      'use strict'

      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      const forms = document.querySelectorAll('.needs-validation')

      // Loop over them and prevent submission
      Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
          if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
          }

          form.classList.add('was-validated')
        }, false)
      })
    })()
  })
</script>