<div class="p-4 mb-3 bg-primary" id="card-antrian-saat-ini">
  <div class="card-body">
    <h4 class="card-title">Nomor Saat Ini</h4>
    <h1 class="card-text"><?= $data->nomor_antrian ?> <?= $this->session->flashdata('nomor_antrian') ?></h1>
    <p>-------- <br> Nama : <?= $data->pihak->nama_lengkap ?? null ?></p>
    <div class="text-center">
      <p>Durasi Pelayanan : <a class="text-light" href="javascript:void(0)" data-bs-title="Menghitung durasi pelayanan." data-bs-toggle="tooltip" data-bs-placement="bottom" id="timer">00:00:00</a></p>
      <script>
        let startTime = new Date().getTime();
        let x = setInterval(function() {
          let now = new Date().getTime();
          let distance = now - startTime;
          let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
          let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
          let seconds = Math.floor((distance % (1000 * 60)) / 1000);
          document.getElementById("timer").innerHTML = ("0" + hours).slice(-2) + ":" +
            ("0" + minutes).slice(-2) + ":" +
            ("0" + seconds).slice(-2);
        }, 1000);
      </script>
    </div>
    <div class="text-center">
      <p>Jenis Pelayanan : <a class="text-light" href="javascript:void(0)" data-bs-title="Jenis pelayanan yang dipanggil." data-bs-toggle="tooltip" data-bs-placement="bottom" id="layanan"><?= $data->tujuan ?></a></p>
    </div>

    <div class="d-flex gap-2">
      <button class="btn btn-warning flex-grow-1" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-html="true" data-bs-title="<strong>Memindahkan antrian ini ke antrian lain seperti ke antrian posbakum atau ke antrian produk.</strong>">Pindahkan <i class="fa fa-share"></i></button>
      <div data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-html="true" data-bs-title="<strong>Mengisi data pelayanan dari nomor antrian.</strong>">
        <button data-bs-target="#modalPihak" data-bs-toggle="modal" class="btn btn-success">Isi Data <i class="fa fa-plus"></i></button>
      </div>
    </div>

    <form hidden action="<?= base_url('/pelayanan/pindahkan') ?>" method="POST" class="my-3 bg-warning p-2 rounded">
      <select required name="tujuan" id="select-tujuan" class="form-control form-control-sm form-select">
        <option value="" selected disabled>-- Pindahkan Ke --</option>
        <option>POSBAKUM</option>
        <option>PENDAFTARAN</option>
        <option>INFORMASI</option>
        <option>PRODUK</option>
        <option>KASIR</option>
      </select>
      <div class="text-end">
        <button class="btn btn-white mt-3">Kirim</button>
      </div>
    </form>
  </div>
</div>

<div class="modal fade" id="modalPihak" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTitleId">
          Isi data diri pihak
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="row g-3 needs-validation mt-4" novalidate method="POST" action="<?= base_url('identitas/tambah') ?>">
          <input type="hidden" name="antrian_pelayanan_id" value="<?= $data->id ?>">
          <div class="row mb-3">
            <label for="input-nama-lengkap" class="col-sm-2 col-form-label">Nama Lengkap</label>
            <div class="col-sm-10">
              <input value="<?= $data->pihak->nama_lengkap ?? null ?>" required name="nama_lengkap" type="text" class="form-control was-validated" id="input-nama-lengkap">
            </div>
          </div>
          <div class="row mb-3">
            <label for="input-nik" class="col-sm-2 col-form-label">NIK</label>
            <div class="col-sm-10">
              <input value="<?= $data->pihak->nik ?? null ?>" required name="nik" maxlength="16" type="text" class="form-control" id="input-nik">
            </div>
          </div>
          <div class="row mb-3">
            <label for="input-alamat" class="col-sm-2 col-form-label">Alamat Domisili</label>
            <div class="col-sm-10">
              <input value="<?= $data->pihak->alamat ?>" required name="alamat" type="text" class="form-control" id="input-alamat">
            </div>
          </div>
          <div class="row mb-3">
            <label required for="select-jk" class="col-sm-2 col-form-label">Jenis Kelamin</label>
            <div class="col-sm-10">
              <select required name="jenis_kelamin" id="select-jenis-kelamin" class="form-control form-selct form-control-select">
                <option value="" selected disabled>-- Pilih --</option>
                <option <?= $data->pihak->jenis_kelamin == "Perempuan" ? "selected" : "" ?>>Perempuan</option>
                <option <?= $data->pihak->jenis_kelamin == "Laki-laki" ? "selected" : "" ?>>Laki-laki</option>
              </select>
            </div>
          </div>
          <div class="col-12">
            <button class="btn btn-primary" type="submit">Submit form</button>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
          Close
        </button>
      </div>
    </div>
  </div>
</div>


<script>
  window.addEventListener('load', function() {
    $(".btn.btn-warning.flex-grow-1").click(() => {
      $(".my-3.bg-warning.p-2.rounded").attr("hidden", false);
    });

  })
</script>