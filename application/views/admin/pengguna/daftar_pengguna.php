<div class="container-fluid py-3">
  <div class="row">
    <div class="col-md-12">
      <div class="card shadow">
        <div class="card-header">
          <h6 class="m-0 font-weight-bold text-primary">Daftar Pengguna</h6>
        </div>
        <div class="card-body">
          <div class="text-end mb-2">
            <a href="<?= base_url('pengguna/tambah'); ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>
          </div>
          <div class="table-responsive">
            <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Username</th>
                  <th>Email</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                if (isset($pengguna)) foreach ($pengguna as $p) :
                ?>
                  <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $p->username; ?></td>
                    <td><?= $p->email; ?></td>
                    <td>
                      <?php if ($p->is_active == 1) : ?>
                        <span class="badge badge-success">Aktif</span>
                      <?php else : ?>
                        <span class="badge badge-danger">Tidak Aktif</span>
                      <?php endif; ?>
                    </td>
                    <td>
                      <a href="<?= base_url('admin/pengguna/edit/') . $p->id_user; ?>" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                      <a href="<?= base_url('admin/pengguna/hapus/') . $p->id_user; ?>" class="btn btn-sm btn-danger tombol-hapus"><i class="fas fa-trash"></i></a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>