<div class="row">
  <div class="col-xl-12 p-0">
    <div class="login-card login-dark ">
      <div class="login-main" style="width: 1200px;">
        <?= $this->session->flashdata('flash_error') ?>
        <?= $this->session->flashdata('flash_alert') ?>
        <div class="text-center mb-3">
          <a class="btn btn-secondary btn-sm mb-4" href="<?= base_url('ambil') ?>">
            <i class="fa fa-arrow-left"></i>
            Ambil Langsung
          </a>
          <a class="btn btn-primary btn-sm mb-4" href="<?= base_url('ktp/ambil_manual') ?>">
            <i class="fa fa-refresh"></i>
            Reset
          </a>
        </div>
        <div id="form-ambil">
          <form autocomplete="off" id="form-ktp" action="#" method="POST">
            <div class="text-center mb-3">
              <h3>Form Pengunjung.</h3>
            </div>
            <div id="form-container">
              <div class="row">
                <div class="col-5">
                  <div class="container text-center" id="ktp-result" style="height: 200px;">
                    <video id="webcam" width="350" height="200" autoplay>
                    </video>
                    <canvas id="canvas" class="d-none">
                    </canvas>
                    <div class="text-center">
                      <button type="button" id="cekrek" class="btn btn-success">
                        <i class="fa fa-camera"></i>
                        Cekrek
                      </button>
                    </div>
                  </div>
                </div>
                <div class="col-7">
                  <div class="row mb-3">
                    <label class="col-sm-3 col-form-label" for="input-nama-lengkap">Nama Lengkap</label>
                    <div class="col-sm-9">
                      <input type="text" name="nama_lengkap" class="form-control" required id="input-nama-lengkap" placeholder="Sesuai Ktp" value="<?= $data->nama_lengkap ?? null ?>" />
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label class="col-sm-3 col-form-label" for="select-jenis-kelamin">Jenis Kelamin</label>
                    <div class="col-sm-9">
                      <select required name="jenis_kelamin" class="form-select" id="select-jenis-kelamin">
                        <option <?= (strtoupper($data->jenis_kelamin ?? null)) == "PEREMPUAN" ? "selected" : false ?>>Perempuan</option>
                        <option <?= (strtoupper($data->jenis_kelamin ?? null)) == "LAKI-LAKI" ? "selected" : false ?>>Laki-laki</option>
                      </select>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label class="col-sm-3 col-form-label" for="input-nik">NIK</label>
                    <div class="col-sm-9">
                      <div class="input-group input-group-merge">
                        <input required type="text" name="nik" id="input-nik" class="form-control" placeholder="321 ******" aria-describedby="basic-default-nik16" value="<?= $data->nik ?? null ?>" />
                        <span class="input-group-text" id="basic-default-nik16">16 Angka</span>
                      </div>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label class="col-sm-3 col-form-label" for="select-sebagai">Sebagai</label>
                    <div class="col-sm-9">
                      <div class="input-group input-group-merge">
                        <select class="form-select" required name="status_pengunjung" id="select-sebagai">
                          <option value="" selected disabled>--- Pilih Status Pihak ---</option>
                          <option>Pihak Berperkara</option>
                          <option>Pihak Baru</option>
                          <option>Pihak Non Berperkara</option>
                          <option>Kuasa Hukum</option>
                          <option>Saksi</option>
                          <option>Pengantar</option>
                          <option>Tamu</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label class="col-sm-3 col-form-label" for="input-serial-id">Serial ID KTP</label>
                    <div class="col-sm-9">
                      <div class="input-group input-group-merge">
                        <input
                          autofocus
                          type="text"
                          name="serial_id"
                          id="input-serial-id"
                          class="form-control"
                          placeholder="-----"
                          aria-describedby="basic-default-ser-id"
                          value="<?= $data->serial->serial_id ?? null ?>" />
                        <span class="input-group-text" id="basic-default-ser-id">10 Angka</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <hr class="my-6 mx-n6">
              <div class="text-center">
                <p class="text-muted">Opsional</p>
              </div>

              <div class="row">
                <div class="col-6">
                  <div class="row mb-3">
                    <label class="col-sm-4 col-form-label" for="input-pekerjaan">Pekerjaan</label>
                    <div class="col-sm-8">
                      <input type="text" id="input-pekerjaan" class="form-control" name="pekerjaan" value="<?= $data->pekerjaan ?? null ?>" />
                    </div>
                  </div>
                </div>
                <div class="col-6">
                  <div class="row mb-3">
                    <label class="col-sm-4 col-form-label" for="input-pendidikan">Pendidikan</label>
                    <div class="col-sm-8">
                      <input type="text" id="input-pendidikan" class="form-control" name="pendidikan" value="<?= $data->pendidikan ?? null ?>" />
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-6">
                  <div class="row mb-3">
                    <label class="col-sm-4 col-form-label" for="input-tempat">Tempat</label>
                    <div class="col-sm-8">
                      <input type="text" id="input-tempat" class="form-control" name="tempat" value="<?= $data->tempat ?? null ?>" />
                    </div>
                  </div>
                </div>
                <div class="col-6">
                  <div class="row mb-3">
                    <label class="col-sm-4 col-form-label" for="input-tanggal-lahir">Tanggal Lahir</label>
                    <div class="col-sm-8">
                      <input type="date" id="input-tanggal-lahir" class="form-control" name="tanggal_lahir" value="<?= $data->tanggal_lahir ?? null ?>" />
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-6">
                  <div class="row mb-3">
                    <label class="col-sm-4 col-form-label" for="input-provinsi">Provinsi</label>
                    <div class="col-sm-8">
                      <input type="text" id="input-provinsi" class="form-control" name="provinsi" value="<?= $data->provinsi ?? null ?>" />
                    </div>
                  </div>
                </div>
                <div class="col-6">
                  <div class="row mb-3">
                    <label class="col-sm-4 col-form-label" for="input-kota">Kota</label>
                    <div class="col-sm-8">
                      <input type="text" id="input-kota" class="form-control" name="kota" value="<?= $data->kota ?? null ?>" />
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-6">
                  <div class="row mb-3">
                    <label class="col-sm-4 col-form-label" for="input-kecamatan">Kecamatan</label>
                    <div class="col-sm-8">
                      <input type="text" id="input-kecamatan" class="form-control" name="kecamatan" value="<?= $data->kecamatan ?? null ?>" />
                    </div>
                  </div>
                </div>
                <div class="col-6">
                  <div class="row mb-3">
                    <label class="col-sm-4 col-form-label" for="input-keluarahan">Keluarahan</label>
                    <div class="col-sm-8">
                      <input type="text" id="input-keluarahan" class="form-control" name="kelurahan" value="<?= $data->kelurahan ?? null ?>" />
                    </div>
                  </div>
                </div>
              </div>

              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="textarea-alamat">Alamat</label>
                <div class="col-sm-10">
                  <textarea id="textarea-alamat" class="form-control" name="alamat"><?= $data->alamat ?? null ?></textarea>
                </div>
              </div>

            </div>
            <div class="d-flex gap-3 justify-content-center">
              <button name="tujuan" value="POSBAKUM" class="btn card small-widget mb-sm-0 bg-warning card-ambil-antrian-ptsp" data-antrian-tujuan="POSBAKUM">
                <div class="card-body primary"> <span class="f-light text-light">Antrian Sekarang : 0</span>
                  <div class="d-flex align-items-end gap-1">
                    <h4>POSBAKUM</h4>
                  </div>
                  <div class="bg-gradient">
                    <svg class="stroke-icon svg-fill">
                      <use href="../assets/svg/icon-sprite.svg#user-visitor"></use>
                    </svg>
                  </div>
                </div>
              </button>
              <button name="tujuan" value="PENDAFTARAN" class="btn card small-widget mb-sm-0 bg-warning card-ambil-antrian-ptsp" data-antrian-tujuan="PENDAFTARAN">
                <div class="card-body primary"> <span class="f-light text-light">Antrian Sekarang : 0</span>
                  <div class="d-flex align-items-end gap-1">
                    <h4>PENDAFTARAN</h4>
                  </div>
                  <div class="bg-gradient">
                    <svg class="stroke-icon svg-fill">
                      <use href="../assets/svg/icon-sprite.svg#user-visitor"></use>
                    </svg>
                  </div>
                </div>
              </button>
              <button name="tujuan" value="INFORMASI" class="btn card small-widget mb-sm-0 bg-warning card-ambil-antrian-ptsp" data-antrian-tujuan="INFORMASI">
                <div class="card-body primary"> <span class="f-light text-light">Antrian Sekarang : 0</span>
                  <div class="d-flex align-items-end gap-1">
                    <h4>INFORMASI</h4>
                  </div>
                  <div class="bg-gradient">
                    <svg class="stroke-icon svg-fill">
                      <use href="../assets/svg/icon-sprite.svg#user-visitor"></use>
                    </svg>
                  </div>
                </div>
              </button>
              <button name="tujuan" value="ECOURT" class="btn card small-widget mb-sm-0 bg-warning card-ambil-antrian-ptsp" data-antrian-tujuan="E-COURT">
                <div class="card-body primary"> <span class="f-light text-light">Antrian Sekarang : 0</span>
                  <div class="d-flex align-items-end gap-1">
                    <h4>E-COURT</h4>
                  </div>
                  <div class="bg-gradient">
                    <svg class="stroke-icon svg-fill">
                      <use href="../assets/svg/icon-sprite.svg#user-visitor"></use>
                    </svg>
                  </div>
                </div>
              </button>
            </div>
            <div class="d-flex justify-content-center my-4 gap-4">
              <button name="tujuan" value="PRODUK" class="btn card small-widget mb-sm-0 bg-warning" style="width: 260px;">
                <div class="card-body primary"> <span class="f-light text-light">Antrian Sekarang : 0</span>
                  <div class="d-flex align-items-end gap-1">
                    <h4>PRODUK</h4>
                  </div>
                  <div class="bg-gradient">
                    <svg class="stroke-icon svg-fill">
                      <use href="../assets/svg/icon-sprite.svg#user-visitor"></use>
                    </svg>
                  </div>
                </div>
              </button>
              <button name="tujuan" value="KASIR" class="btn card small-widget mb-sm-0 bg-warning card-ambil-antrian-ptsp" style="width: 260px;">
                <div class="card-body primary"> <span class="f-light text-light">Antrian Sekarang : 0</span>
                  <div class="d-flex align-items-end gap-1">
                    <h4>KASIR</h4>
                  </div>
                  <div class="bg-gradient">
                    <svg class="stroke-icon svg-fill">
                      <use href="../assets/svg/icon-sprite.svg#user-visitor"></use>
                    </svg>
                  </div>
                </div>
              </button>
              <button name="tujuan" value="SIDANG" class="btn card small-widget mb-sm-0 bg-warning card-ambil-antrian-ptsp" style="width: 260px;">
                <div class="card-body primary"> <span class="f-light text-light"></span>
                  <div class="d-flex align-items-end gap-1">
                    <h4>SIDANG</h4>
                  </div>
                  <div class="bg-gradient">
                    <svg class="stroke-icon svg-fill">
                      <use href="../assets/svg/icon-sprite.svg#user-visitor"></use>
                    </svg>
                  </div>
                </div>
              </button>
            </div>
            <div class="d-flex gap-3 justify-content-center">
              <button name="tujuan" value="SIDANG" class="btn card small-widget mb-sm-0 bg-secondary card-ambil-antrian-ptsp">
                <div class="card-body light">
                  <div class="d-flex align-items-end gap-1">
                    <h4>SEBAGAI SAKSI</h4>
                  </div>
                  <div class="bg-gradient">
                    <svg class="stroke-icon svg-fill">
                      <use href="../assets/svg/icon-sprite.svg#user-visitor"></use>
                    </svg>
                  </div>
                </div>
              </button>
              <button name="tujuan" value="Mengantar" class="btn card small-widget mb-sm-0 bg-secondary card-ambil-antrian-ptsp">
                <div class="card-body light">
                  <div class="d-flex align-items-end gap-1">
                    <h4>SEBAGAI PENGANTAR</h4>
                  </div>
                  <div class="bg-gradient">
                    <svg class="stroke-icon svg-fill">
                      <use href="../assets/svg/icon-sprite.svg#user-visitor"></use>
                    </svg>
                  </div>
                </div>
              </button>
              <button name="tujuan" value="Kepentingan" class="btn card small-widget mb-sm-0 bg-secondary card-ambil-antrian-ptsp">
                <div class="card-body light">
                  <div class="d-flex align-items-end gap-1">
                    <h4>SEBAGAI TAMU</h4>
                  </div>
                  <div class="bg-gradient">
                    <svg class="stroke-icon svg-fill">
                      <use href="../assets/svg/icon-sprite.svg#user-visitor"></use>
                    </svg>
                  </div>
                </div>
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <p class=" text-center">Crafted By<a class="ms-2" target="_blank" href="https://mmaliki.my.id">Mmaliki</a></p>
  </div>
</div>


<script src="<?= base_url("/package/face-api.js/dist/face-api.js"); ?>"></script>
<script type="text/javascript" src="https://unpkg.com/webcam-easy/dist/webcam-easy.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/hammer.js/2.0.8/hammer.min.js"></script>
<script>

</script>
<script>
  const webcamElement = document.getElementById('webcam');
  const canvasElement = document.getElementById('canvas');

  var faceDetection;
  var displaySize;
  var canvas;

  var globalAudioList = [];

  var globalAudio = new Audio();


  /**@type {Webcam} */
  const webcam = new Webcam(webcamElement, 'user', canvasElement);

  window.addEventListener("load", function() {
    $("#webcam").bind("loadedmetadata", function() {
      displaySize = {
        width: this.scrollWidth,
        height: this.scrollHeight
      }
    });

    var searchData = new Bloodhound({
      datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
      queryTokenizer: Bloodhound.tokenizers.whitespace,
      remote: {
        url: '<?= base_url('ktp/suggest_nik') ?>?q=%QUERY',
        wildcard: '%QUERY'
      }
    });

    // Initialize Typeahead
    $('#input-nik').typeahead(null, {
      name: 'search-results',
      display: 'nik',
      source: searchData
    });

    webcam.start()
      .then(result => {
        webcamElement.style.transform = "";
        console.log("webcam started");
      })
      .catch(err => {
        console.error(err)
      });

    $("#cekrek").on("click", function() {
      const fileBase64 = webcam.snap();
      const imgElement = document.createElement("img");
      $("#ktp-result").html(imgElement)

      imgElement.setAttribute("src", fileBase64);

      const imgInputElement = document.createElement("input")
      imgInputElement.setAttribute("type", "file")
      imgInputElement.setAttribute("name", "temp_img")

      $("#ktp-result").append(imgInputElement);

      const fileBlob = base64ToBlob(fileBase64, "image/png")

      const file = new File([fileBlob], "capture.png", {
        type: "image/png"
      })

      const fileTransfer = new DataTransfer();
      fileTransfer.items.add(file)

      imgInputElement.files = fileTransfer.files
    });


    var pusher = new Pusher('<?= $_ENV['PUSHER_APP_KEY'] ?>', {
      cluster: 'ap1'
    });

    var channel = pusher.subscribe('scan-data');
    channel.bind('recive', function(data) {
      $.ajax({
        url: "<?= base_url('ktp/fetch_form_manual') ?>",
        method: "POST",
        data: {
          photo: data
        },
        success(form) {
          $("#form-container").html(form)
        }
      })
    });

    $("#form-ktp").on("submit", function(e) {
      Swal.fire({
        title: "Mohon Tunggu...",
        allowOutsideClick: false,
        backdrop: true,
        text: "Sedang memproses"
      })
      e.preventDefault()

      const formData = new FormData(e.target)

      if (formData.get("temp_img") == null) {
        Swal.close();
        Swal.fire("Foto belum di ambil", "", "error")
        return;
      }

      console.log("kesiini");
      return;

      $.ajax({
        url: "<?= base_url('ktp/simpan_manual') ?>",
        method: "POST",
        data: formData,
        success(data) {
          console.log(data)
        },
        error(error) {
          $("#form-ambil").html(error);
          Swal.close();
        }
      })
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