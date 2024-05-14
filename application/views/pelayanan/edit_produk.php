<div class="container-fluid py-3">
  <div class="d-flex justify-content-center">
    <div class="card col-md-6 col-lg-6 col-xl-6">
      <?= $this->session->flashdata("flash_alert") ?>
      <?= $this->session->flashdata("flash_error") ?>
      <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
          <h5 class="m-0">Edit Produk</h5>
          <a href="<?= base_url('pelayanan_produk') ?>" class="btn btn-sm btn-secondary"><i class="fa fa-arrow-left"></i> Kembali</a>
        </div>
      </div>
      <div class="card-body">
        <form class="form needs-validation" novalidate action="<?= base_url('pelayanan_produk/update/' . Cypher::urlsafe_encrypt($data->id)) ?>" method="post" enctype="multipart/form-data">
          <div class="row">
            <div class="col-12">
              <div class="form-group mb-3">
                <label for="name">Nama Pengambil</label>
                <input type="text" required class="form-control" name="nama_pengambil" id="name" value="<?= $data->nama_pengambil ?>">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="form-group">
              <label for="input-nomor-perkara">Nomor Perkara</label>
              <div class="input-group mb-3">
                <input class="form-control" value="<?= $data->nomor_perkara ?>" required name="nomor_perkara" id="input-nomor-perkara" />
              </div>
            </div>
          </div>
          <div class="row">
            <div class="form-group">
              <label for="input-nomor-akta-cerai">Nomor Akta Cerai</label>
              <div class="input-group mb-3">
                <input class="form-control" value="<?= $data->nomor_akta_cerai ?>" name="nomor_akta_cerai" id="input-nomor-akta-cerai" />
              </div>
            </div>
          </div>
          <div class="row">
            <div class="form-group">
              <label for="select-jenis-pihak">Jenis Pihak Yang Mengambil</label>
              <div class="input-group mb-3">
                <select name="jenis_pihak" required id="select-jenis-pihak" class="form-control form-select">
                  <option value="" selected disabled>-- Pilih Disini ---</option>
                  <option value="P">Penggugat/Pemohon</option>
                  <option value="T">Tergugat/Termohon</option>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="form-group">
              <label for="select-jenis-produk">Jenis Produk Yang Diambil</label>
              <div class="input-group mb-3">
                <select name="jenis_produk" required id="select-jenis-produk" class="form-control form-select">
                  <option value="" selected disabled>-- Pilih Disini ---</option>
                  <option>Salinan Putusan dan Akta Cerai</option>
                  <option>Salinan Putusan</option>
                  <option>Akta Cerai</option>
                  <option>Legalisir Salinan Putusan</option>
                  <option>Legalisir Akta Cerai</option>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="form-group">
              <label for="input-foto">Foto Pengambil</label>
              <div class="input-group mb-2">
                <input required type="file" class="form-control form-control-file" id="input-foto" name="foto_pengambil">
              </div>
              <div class="text-center">Atau Capture Disini</div>
              <div style="display: flex; align-items: center; justify-content: center;" class="mb-4">
                <video id="webcam" autoplay playsinline width="480" height="360" style="max-width: 100%; max-height: 100%; object-fit: contain;" class="m-auto"></video>
                <canvas id="canvas" class="d-none"></canvas>
              </div>
              <div style="display: flex; align-items: center; justify-content: center;" class="mb-4">
                <img src="" alt="Preview Image" id="img-capture-preview">
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