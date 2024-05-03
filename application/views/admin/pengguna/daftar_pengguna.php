<div class="container-fluid py-3">
  <div class="row">
    <div class="col-md-12">
      <?= $this->session->flashdata("flash_alert") ?>
      <?= $this->session->flashdata("flash_error") ?>
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
                  <th>Nama</th>
                  <th>Posisi</th>
                  <th>Bagian</th>
                  <th>Status</th>
                  <th>Aksi</th>
                  <th></th>
                  <th>Username</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                if (isset($pengguna)) foreach ($pengguna as $p) :
                ?>
                  <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $p->name; ?></td>
                    <td><?= $p->role->role_name; ?></td>
                    <td><?= $p->petugas->jenis_petugas ?? "-"; ?></td>
                    <td>
                      <?php if ($p->status == "active") : ?>
                        <span class="badge badge-success">Aktif</span>
                      <?php else : ?>
                        <span class="badge badge-danger">Tidak Aktif</span>
                      <?php endif; ?>
                    </td>
                    <td>
                      <a href="<?= base_url('pengguna/edit/' . Cypher::urlsafe_encrypt($p->id)); ?>" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                    </td>
                    <td>
                      <img width="50" src="https://api.dicebear.com/8.x/adventurer/svg?seed=<?= $p->avatar ?>" alt="avatar" />
                    </td>
                    <td><?= $p->identifier ?></td>
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