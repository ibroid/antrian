<div class="container-fluid py-3">
  <div class="d-flex justify-content-center">
    <div class="card col-md-6 col-lg-6 col-xl-6">
      <?= $this->session->flashdata("flash_alert") ?>
      <?= $this->session->flashdata("flash_error") ?>
      <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
          <h5 class="m-0">Edit Pengunjung</h5>
          <a href="<?= base_url('identitas_pihak') ?>" class="btn btn-sm btn-secondary"><i class="fa fa-arrow-left"></i> Kembali</a>
        </div>
      </div>
      <div class="card-body">
        <form class="form needs-validation" novalidate action="<?= base_url('identitas_pihak/update/' . Cypher::urlsafe_encrypt($data->id)) ?>" method="post" enctype="multipart/form-data">
          <div class="row">
            <div class="col-12">
              <div class="form-group mb-3">
                <label for="name">Nama Lengkap</label>
                <input type="text" required class="form-control" name="nama_lengkap" id="name" value="<?= $data->nama_lengkap  ?>">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="form-group mb-3">
                <label for="nik">NIK</label>
                <input type="text" required class="form-control" name="nik" id="nik" value="<?= $data->nik  ?>">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="form-group mb-3">
                <label for="alamat">Alamat/Domisili</label>
                <input type="text" required class="form-control" name="alamat" id="alamat" value="<?= $data->alamat  ?>">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="form-group mb-3">
                <label for="jenis_kelamin">Jenis Kelamin</label>
                <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                  <option <?= $data->jenis_kelamin == 'Laki-laki' ? 'selected' : null ?>>
                    Laki-laki
                  </option>
                  <option <?= $data->jenis_kelamin == 'Perempuan' ? 'selected' : null ?>>
                    Perempuan
                  </option>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="form-group mb-3">
                <label for="tempat_lahir">Tempat Lahir</label>
                <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" value="<?= $data->tempat_lahir  ?? null ?>" required>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="form-group mb-3">
                <label for="tanggal_lahir">Tanggal Lahir</label>
                <input type="text" class="form-control datepicker" name="tanggal_lahir" id="tanggal_lahir" value="<?= $data->tanggal_lahir ?? null  ?>" required>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="form-group mb-3">
                <label for="pendidikan">Pendidikan</label>
                <select name="pendidikan" class="form-select" id="pendidikan">
                  <option value="" selected disabled>-- Pilih Pendidikan Terakhir ---</option>
                  <?php foreach ([
                    'Tidak Sekolah',
                    'Sekolah Dasar',
                    'Sekolah Menengah Pertama',
                    'Sekolah Menengah Atas/Kejurusan',
                    'Strata 1/Diploma IV',
                    'Lebih dari strata 1/Diploma IV',
                  ] as $d) { ?>
                    <option <?= $d == $data->pendidikan ? 'selected' : null ?>><?= $d ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="form-group mb-3">
                <label for="pekerjaan">Pekerjaan</label>
                <select name="pekerjaan" class="form-select" id="pekerjaan">
                  <option value="" selected disabled>-- Pilih Pekerjaan ---</option>
                  <?php foreach ([
                    'Tidak Bekerja',
                    'Ibu Rumah Tangga',
                    'TNI',
                    'POLRI',
                    'ASN',
                    'BUMN',
                    'Buruh/Harian Lepas',
                    'Karyawan Swasta',
                    'Wirausaha',
                    'Wiraswasta',
                    'Nelayan',
                    'Guru',
                    'Kedokteran',
                    'Supir/Driver',
                  ] as $g) { ?>
                    <option <?= $g == $data->pekerjaan ? 'selected' : null ?>><?= $g ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="form-group">
              <label for="input-foto">Foto Pengambil</label>
              <div class="input-group mb-2">
                <input type="file" class="form-control form-control-file" id="input-foto" name="foto">
              </div>
              <div class="text-center">Atau Capture Disini</div>
              <div style="display: flex; align-items: center; justify-content: center;" class="mb-4">
                <video id="webcam" autoplay playsinline width="480" height="360" style="max-width: 100%; max-height: 100%; object-fit: contain;" class="m-auto"></video>
                <canvas id="canvas" class="d-none"></canvas>
              </div>
              <div style="display: flex; align-items: center; justify-content: center;" class="mb-4">
                <img src="<?= base_url('/uploads/pihak/' . $data->foto) ?>" alt="Preview Image" id="img-capture-preview">
              </div>
              <div class="d-flex justify-content-center mb-4 gap-3">
                <button type="button" id="btn-ganti-kamera" class="btn btn-warning btn-sm">
                  <i class="fa fa-refresh"></i> Ganti Kamera</button>
                <button type="button" id="btn-capture-kamera" class="btn btn-success btn-sm">
                  <i class="fa fa-camera"></i> Ckrek</button>
              </div>
            </div>
          </div>
          <div class="row ">
            <div class="col-12 text-center">
              <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-save"></i> Simpan</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript" src="https://unpkg.com/webcam-easy/dist/webcam-easy.js"></script>

<script>
  window.addEventListener("load", function() {
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


    const webcamElement = document.getElementById('webcam');
    const canvasElement = document.getElementById('canvas');
    const webcam = new Webcam(webcamElement, 'user', canvasElement);

    webcam.start()
      .then(result => {
        console.log("webcam started");
      })
      .catch(err => {
        console.log(err);
      });


    $("#btn-ganti-kamera").click(() => {
      webcam.flip()
      webcam.start();
    })

    $("#btn-capture-kamera").click(() => {
      const fileBase64 = webcam.snap();
      $("#img-capture-preview").attr('src', fileBase64)

      const fileBlob = base64ToBlob(fileBase64, "image/png")

      const file = new File([fileBlob], "capture.png", {
        type: "image/png"
      })

      const fileTransfer = new DataTransfer();
      fileTransfer.items.add(file)

      document.getElementById("input-foto").files = fileTransfer.files
    })

    flatpickr(".datepicker");
  })

  function base64ToBlob(base64, contentType = '', sliceSize = 512) {
    const byteCharacters = atob(base64.split(',')[1]);
    const byteArrays = [];

    for (let offset = 0; offset < byteCharacters.length; offset += sliceSize) {
      const slice = byteCharacters.slice(offset, offset + sliceSize);

      const byteNumbers = new Array(slice.length);
      for (let i = 0; i < slice.length; i++) {
        byteNumbers[i] = slice.charCodeAt(i);
      }

      const byteArray = new Uint8Array(byteNumbers);
      byteArrays.push(byteArray);
    }

    return new Blob(byteArrays, {
      type: contentType
    });
  }
</script>