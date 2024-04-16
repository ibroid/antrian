<style>
  .numpad {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    grid-gap: 5px;
    padding: 10px;
  }

  .btn-numpad {
    padding: 50px;
    font-size: 26px;
    border: none;
    outline: none;
    cursor: pointer;
    background-color: #f0f0f0;
    text-align: center;
    justify-content: center;
    align-items: center;
  }

  .btn-numpad:hover {
    background-color: #ddd;
  }
</style>

<div class="row ">
  <div class="col-xl-12 p-0">
    <?= $this->session->flashdata('flash_error') ?>
    <?= $this->session->flashdata('flash_alert') ?>

    <div class="login-card login-dark ">
      <div class="login-main" style="width: 1200px;">
        <div class="text-center my-3">

          <h4>Menu Pengambilan Antrian PTSP.</h4>

        </div>

        <div class="row">
          <div class="col-3">
            <div class="card small-widget mb-sm-0 bg-warning card-ambil-antrian-ptsp" data-antrian-tujuan="POSBAKUM">
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
            </div>
          </div>
          <div class="col-3">
            <div class="card small-widget mb-sm-0 bg-warning card-ambil-antrian-ptsp" data-antrian-tujuan="PENDAFTARAN">
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
            </div>
          </div>
          <div class="col-3">
            <div class="card small-widget mb-sm-0 bg-warning card-ambil-antrian-ptsp" data-antrian-tujuan="INFORMASI">
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
            </div>
          </div>
          <div class="col-3">
            <div class="card small-widget mb-sm-0 bg-warning card-ambil-antrian-ptsp" data-antrian-tujuan="E-COURT">
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
            </div>
          </div>
        </div>

        <div class="d-flex justify-content-center mt-4 gap-4">
          <div class="card small-widget mb-sm-0 bg-warning" style="width: 260px;" onclick="openModalPerkaraProduk()">
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
          </div>
          <div class="card small-widget mb-sm-0 bg-warning card-ambil-antrian-ptsp" data-antrian-tujuan="KASIR" style="width: 260px;">
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
          </div>


        </div>


        <hr>
        <div class="text-center my-4">
          <h4>Apabila akan bersidang. Silahkan cari dan tekan nama anda dibawah ini</h4>
        </div>


        <form action="<?= base_url('/ambil') ?>" style="width: 500px;" class="my-3" method="POST">
          <h6>Cari Berdasarkan Tanggal</h6>
          <div class="input-group mt-2">
            <input class="form-control date-picker" type="text" name="tanggal_sidang" required="Harap Isi Bidang ini">
            <button class="btn btn-outline-warning" id="button-addon2" type="submit">Cari</button>
            <a href="<?= base_url('/ambil') ?>" class="btn btn-outline-danger" id="button-addon3" type="reset">Reset</a>
          </div>
        </form>

        <table class="table table-responsive table-hover " id="table-sidang">
          <thead>
            <tr>
              <th>Pekara</th>
              <th>Pihak P </th>
              <th>Kuasa P</th>
              <th>Pihak T </th>
              <th>Kuasa T</th>
              <th>Ruangan</th>
              <th>Majelis</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($daftar_sidang as $n => $ds) { ?>
              <tr onclick="handleRowClick(<?= $ds->id ?>)">
                <td><?= $ds->perkara->nomor_perkara ?><br><?= $ds->perkara->jenis_perkara_nama ?></td>
                <td>
                  <?= $ds->perkara->pihak_satu[0]->nama ?>
                </td>
                <td>
                  <?php if (count($ds->perkara->pengacara_satu) > 0) {
                    echo  $ds->perkara->pengacara_satu[0]->nama;
                  } ?>
                </td>
                <td>
                  <?php if (count($ds->perkara->pihak_dua) !== 0) {
                    echo  $ds->perkara->pihak_dua[0]->nama;
                  }  ?>
                </td>
                <td>
                  <?php if (count($ds->perkara->pengacara_dua) > 0) {
                    echo  $ds->perkara->pengacara_dua[0]->nama;
                  } ?>
                </td>
                <td><?= $ds->ruangan ?><br><?= str_replace("Panitera Pengganti:", "", $ds->perkara->penetapan->panitera_pengganti_text)  ?></td>
                <td><?= $ds->perkara->penetapan->majelis_hakim_nama ?></td>
                <td><button class="btn btn-xl btn-success">Ambil Antrian</button></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>

      </div>
    </div>
    <p class=" text-center">Crafted By<a class="ms-2" target="_blank" href="https://mmaliki.my.id">Mmaliki</a></p>
  </div>
</div>


<style>
  .btn-floating {
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 99;
  }

  canvas {
    position: absolute;
  }
</style>

<button type="button" data-bs-toggle="modal" data-bs-target="#bantuan-modal" class="btn btn-success btn-floating btn-lg">
  <i class="fa fa-volume-up"></i>
  <h5>Pusat Bantuan</h5>
</button>

<div style="position: fixed; top: 0; left: 0;" class="p-2 bg-white m-2 shadow">

  <ul id="camera-control" hidden class="tg-list common-flex">
    <li class="tg-list-item">
      <input class="tgl tgl-skewed" id="cb3" type="checkbox">
      <label class="tgl-btn" data-tg-off="OFF" data-tg-on="ON" for="cb3"></label>
    </li>
    <li>
      <h6> Camera</h6>
    </li>
    <li class="tg-list-item">
      <input class="tgl tgl-skewed" id="cb5" type="checkbox">
      <label class="tgl-btn" data-tg-off="OFF" data-tg-on="ON" for="cb5"></label>
    </li>
    <li>
      <h6> Detection</h6>
    </li>
  </ul>
  <div id="camera-container" style="display:flex; align-items:center; justify-content:center">
    <video id="webcam" width="200" height="100" autoplay></video>
  </div>
  <div class="text-center" id="text-log">

  </div>
</div>

<template id="swal-produk-antrian-step-2">
  <swal-title>
    Pilih Tahun dan Jenis Perkara
  </swal-title>
  <!-- <swal-html>
    <label for="swal-select-tahun-perkara">Pilih Tahun Perkara</label>
    <select name="tahun-perkara" id="swal-select-tahun-perkara" class="form-control form-control-lg">
      <option value="" selected disabled>--- Tekan Disini Untuk Pilih ---</option>
      <?php foreach ((function () {
        $years = [];
        for ($i = date("Y"); $i >= 2015; $i--) {
          array_push($years, $i);
        }
        return $years;
      })() as $tahun) { ?>
        <option value="<?= $tahun ?>"><?= $tahun ?></option>
      <?php } ?>
    </select>
    <hr>
    <label for="swal-select-jenis-perkara">Pilih Jenis Perkara</label>
    <select name="jenis-perkara" id="swal-select-jenis-perkara" class="form-control form-control-lg">
      <option value="" selected disabled>--- Tekan Disini Untuk Pilih ---</option>
      <option value="Pdt.G">Pdt.G</option>
      <option value="Pdt.P">Pdt.P</option>
      <option value="Pdt.Eks">Pdt.Eks</option>
    </select>
  </swal-html> -->
  <swal-html>
    <h5>Pilih Tahun Perkara</h5>
    <div class="form-check radio radio-primary ps-0">
      <ol class="radio-wrapper">
        <?php foreach ((function () {
          $years = [];
          for ($i = date("Y"); $i >= 2019; $i--) {
            array_push($years, $i);
          }
          return $years;
        })() as $tahun) { ?>
          <li>
            <div class="text-center">
              <input class="form-check-input form-control-lg radio-button-tahun-perkara" id="radio-icon-<?= $tahun ?>" type="radio" name="radio_tahun_perkara" value="<?= $tahun ?>">
              <label class="form-check-label" for="radio-icon-<?= $tahun ?>"><i class="fa fa-calendar"></i><span><?= $tahun ?></span></label>
            </div>
          </li>
        <?php } ?>
      </ol>
    </div>
    <br>
    <br>
    <h5>Pilih Jenis Perkara</h5>
    <div class="form-check radio radio-primary ps-0">
      <ol class="radio-wrapper">
        <li>
          <div class="text-center">
            <input class="form-check-input form-control-lg radio-button-jenis-perkara" id="radio-icon-g" type="radio" name="radio_jenis_perkara" value="Pdt.G">
            <label class="form-check-label" for="radio-icon-g"><i class="fa fa-tag"></i><span>Pdt.G</span></label>
          </div>
        </li>
        <li>
          <div class="text-center">
            <input class="form-check-input form-control-lg radio-button-jenis-perkara" id="radio-icon-p" type="radio" name="radio_jenis_perkara" value="Pdt.P">
            <label class="form-check-label" for="radio-icon-p"><i class="fa fa-tag"></i><span>Pdt.P</span></label>
          </div>
        </li>
        <li>
          <div class="text-center">
            <input class="form-check-input form-control-lg radio-button-jenis-perkara" id="radio-icon-e" type="radio" name="radio_jenis_perkara" value="Pdt.Eks">
            <label class="form-check-label" for="radio-icon-e"><i class="fa fa-tag"></i><span>Pdt.Eks</span></label>
          </div>
        </li>
      </ol>
    </div>
  </swal-html>
  <!-- <swal-input type="text" autofocus="false" id="swal-input-tahun-perkara" /> -->
  <!-- <swal-input type="text" autofocus="false" id="swal-input-jenis-perkara" /> -->
  <swal-button type="confirm">
    Ok, Lanjut..
  </swal-button>
  <swal-button type="cancel">
    Batal
  </swal-button>
</template>

<script src="<?= base_url("/package/face-api.js/dist/face-api.js"); ?>"></script>
<script type="text/javascript" src="https://unpkg.com/webcam-easy/dist/webcam-easy.min.js"></script>
<script>
  const webcamElement = document.getElementById('webcam');
  var faceDetection;
  var displaySize;
  var canvas;

  var globalAudioList = [];

  var globalAudio = new Audio();


  /**@type {Webcam} */
  const webcam = new Webcam(webcamElement, 'user');

  function createCanvas() {
    if (document.getElementsByTagName("canvas").length == 0) {
      canvas = faceapi.createCanvasFromMedia(webcamElement)
      document.getElementById('camera-container').append(canvas)
      faceapi.matchDimensions(canvas, displaySize);
    }
  }

  function startDetection() {
    faceDetection = setInterval(async () => {
      /**@type {FaceDetection[]} */
      const detections = await faceapi.detectAllFaces(webcamElement, new faceapi.TinyFaceDetectorOptions())
      const resizedDetections = faceapi.resizeResults(detections, displaySize)
      canvas.getContext('2d').clearRect(0, 0, canvas.width, canvas.height)
      faceapi.draw.drawDetections(canvas, resizedDetections)
      if (detections.length == 0) {
        $("#text-log").text("Tidak ada orang");
      } else {
        $("#text-log").text("Ada Pengunjung");
        if (globalAudio.paused) {
          changeGlobalAudio("/audio/audio-selamat-datang.mp3");
        } else {
          console.log("audio already playing");
        }
      }
    }, 500)
  }

  window.addEventListener("load", function() {
    $("#webcam").bind("loadedmetadata", function() {
      displaySize = {
        width: this.scrollWidth,
        height: this.scrollHeight
      }
    });

    Promise.all([
        faceapi.nets.tinyFaceDetector.load("/package/face-api.js/weights"),
        faceapi.nets.faceRecognitionNet.load("/package/face-api.js/weights"),
      ])
      .then(() => {
        $("#camera-control").removeAttr("hidden");
        $("#camera-container > .text-center").attr("hidden");

      })
      .catch(err => {
        console.error(err);
        $("#camera-container").html('Error accessing camera: ' + err.message);
      })

    $("#cb3").change(function() {
      if (this.checked) {
        webcam.start()
          .then(result => {
            webcamElement.style.transform = "";
            console.log("webcam started");
          })
          .catch(err => {
            console.error(err)
          });
      } else {
        webcam.stop()
      }
    })

    $("#cb5").change(function() {
      if (this.checked) {
        createCanvas();
        startDetection();
      } else {
        clearInterval(faceDetection);
        if (typeof canvas !== "undefined") {
          setTimeout(function() {
            canvas.getContext('2d').clearRect(0, 0, canvas.width, canvas.height)
          })
        }
      }
    })
  })
</script>


<div class="modal fade" id="checkInModal" tabindex="-1" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTitleId">
          Konfirmasi Kehadiran Pihak
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="checkInModal-body">
        <div class="text-center">
          <h4>Mohon Tunggu ...</h4>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="bantuan-modal" tabindex="-1" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTitleId">
          Jendela Bantuan Antrian
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="bantuan-modal-body">
        <div class="text-center mx-2">
          <h4>Anda Pengunjung Baru ?</h4>
          <button class="btn btn-success btn-audio btn-lg mt-3" data-file-audio="audio-penjelasan-alur-singkat.mp3">
            Penjelasan singkat bagi pengunjung baru
            <i class="fa fa-volume-up"></i>
          </button>
        </div>
        <hr>
        <div class="text-center mx-2">
          <h4>Anda Akan Bersidang ?</h4>
          <button class="btn btn-success btn-audio btn-lg mt-3" data-file-audio="audio-penjelasan-antrian-sidang.mp3">Penjelasan singkat bagi yang bersidang hari ini
            <i class="fa fa-volume-up"></i>
          </button>
        </div>
        <hr>
        <div class="text-center mx-2">
          <h4>Berikut Penjelasan Setiap Loket Pelayanan</h4>
          <button class="btn btn-success btn-audio btn-lg mt-4" data-file-audio="audio-penjelasan-loket-informasi.mp3">Penjelasan Loket Informasi
            <i class="fa fa-volume-up"></i>
          </button>
          <br>
          <button class="btn btn-success btn-audio btn-lg mt-4" data-file-audio="audio-penjelasan-loket-posbakum.mp3">Penjelasan Loket Posbakum
            <i class="fa fa-volume-up"></i>
          </button>
          <br>
          <button class="btn btn-success btn-audio btn-lg mt-4" data-file-audio="audio-penjelasan-loket-pendaftaran.mp3">Penjelasan Loket Pendaftaran
            <i class="fa fa-volume-up"></i>
          </button>
          <br>
          <button class="btn btn-success btn-audio btn-lg mt-4" data-file-audio="audio-penjelasan-loket-kasir.mp3">Penjelasan Loket Kasir
            <i class="fa fa-volume-up"></i>
          </button>
          <br>
          <button class="btn btn-success btn-audio btn-lg mt-4" data-file-audio="audio-penjelasan-loket-produk.mp3">Penjelasan Loket Produk
            <i class="fa fa-volume-up"></i>
          </button>
          <br>
          <button class="btn btn-success btn-audio btn-lg mt-4" data-file-audio="audio-penjelasan-loket-ecourt.mp3">Penjelasan Loket E-Court
            <i class="fa fa-volume-up"></i>
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  function swalLoading() {
    Swal.fire({
      title: "Mohon Tunggu...",
      didOpen: () => Swal.showLoading(),
      allowOutsideClick: false,
      backdrop: true,
      text: "Sedang memproses"
    })
  }

  let checkInModal;
  window.addEventListener("load", function() {
    $(".date-picker").flatpickr();
    $("#table-sidang").DataTable({
      "language": {
        "search": "Pencarian :",
      },
      "pageLength": 50
    });

    checkInModal = new bootstrap.Modal(
      document.getElementById("checkInModal"),
    );

    $(".btn-audio").click(function() {
      const fileAudio = $(this).data("file-audio")
      changeGlobalAudio("<?= base_url('/audio') ?>/" + fileAudio)
    })

    $(".card-ambil-antrian-ptsp").click(function() {

      const tujuan = $(this).data("antrian-tujuan")

      ambilAntrianPelayanan(tujuan);

    })
  })

  function ambilAntrianPelayanan(tujuan, callback = null) {
    swalLoading();
    $.ajax({
      url: "<?= base_url("ambil/ambil_antrian_ptsp") ?>",
      method: "POST",
      headers: {
        "Accept": "application/json",
      },
      data: {
        tujuan: tujuan
      },
      success(data) {
        (async function() {
          changeGlobalAudio("/audio/intruction-antrian-1.mp3")
        })()
        const {
          antrian
        } = JSON.parse(data)

        const nomor_antrian = antrian.kode + "-" + antrian.nomor_urutan;

        Swal.fire({
          title: "Silahkan ambil antrian",
          icon: "success",
          html: "Antrian Anda : " + nomor_antrian + "<br/><b></b>",
          timer: 5000,
          timerProgressBar: true,
          didOpen: () => {
            const timer = Swal.getPopup().querySelector("b");
            let sec = 4;
            timerInterval = setInterval(() => {
              timer.textContent = sec--;
            }, 1000);
          },
        })
      },
      error(err) {
        Swal.fire({
          title: "Terjadi Kesalahan. Silahkan Coba lagi",
          text: err.responseText && err.message,
          icon: "error",
          timer: 6000,
          timerProgressBar: true,
        })
      },
      complete(data) {
        console.log(data)
        if (callback) {
          callback(data)
        }
      }
    })
  }

  function swalLoading() {
    Swal.fire({
      title: "Loading...",
      text: "Please wait",
      showConfirmButton: false,
      allowOutsideClick: false,
      backdrop: true,
      willOpen: () => Swal.showLoading()
    })
  }

  document.getElementById("checkInModal").addEventListener("hide.bs.modal", () => {
    $("#checkInModal-body").html(" <div class=\"text-center\"><h4>Mohon Tunggu ...</h4></div>")
  })

  const handleRowClick = (sidang_id) => {
    checkInModal.show()
    $.ajax({
      url: "<?= base_url("ambil/fetch_table_checkin") ?>",
      method: "POST",
      data: {
        sidang_id: sidang_id
      },
      success(html) {
        $("#checkInModal-body").html(html)
      },
      error(err) {
        $("#checkInModal-body").html(err.responseText && err.message)
      }
    })
  }

  const disableAfterSubmit = (e) => {
    Swal.fire({
      title: "Loading...",
      text: "Please wait",
      showConfirmButton: false,
      allowOutsideClick: false,
      backdrop: true,
      willOpen: () => Swal.showLoading()
    })
  }

  function audioInterval() {
    const audioInterval = setInterval(() => {
      playAudioSelamatDatang(playAudioIntruksiBersidang)
    }, 1000 * 60)
  }

  function playAudioSelamatDatang(callback = null) {
    changeGlobalAudio("/audio/audio-selamat-datang.mp3")
  }

  function playAudioIntruksiBersidang() {
    changeGlobalAudio("/audio/audio-penjelasan-antrian-sidang.mp3")
  }

  async function openModalPerkaraProduk() {
    changeGlobalAudio("<?= base_url("/audio/intruction-antrian-produk-1.mp3") ?>")

    const decissionNomorPerkara = await Swal.fire({
      title: "Input Nomor Perkara Anda",
      html: `<h2><strong></strong></h2><div style="display: grid;grid-template-columns: repeat(3, 1fr);grid-gap: 5px;padding: 10px;">
        <button class="btn-numpad">1</button>
        <button class="btn-numpad">2</button>
        <button class="btn-numpad">3</button>
        <button class="btn-numpad">4</button>
        <button class="btn-numpad">5</button>
        <button class="btn-numpad">6</button>
        <button class="btn-numpad">7</button>
        <button class="btn-numpad">8</button>
        <button class="btn-numpad">9</button>
        <button id="btn-humpad-hapus" class="clear">Hapus</button>
        <button class="btn-numpad">0</button>
        <button id="btn-numpad-clear" class="clear">Bersihkan</button>
      </div>`,
      input: "text",
      confirmButtonText: "Ok, Lanjut..",
      didOpen: () => {
        const strong = Swal.getHtmlContainer().querySelector("strong");
        const buttons = Swal.getHtmlContainer().querySelectorAll("button");
        const input = Swal.getContainer().querySelector("input");

        const btnNumpadHapus = Swal.getHtmlContainer().querySelector("#btn-humpad-hapus")
        btnNumpadHapus.addEventListener("click", function() {
          strong.innerText = strong.innerText.slice(0, -1);
          input.value = strong.innerText.slice(0, -1);
        })

        const btnNumpadClear = Swal.getHtmlContainer().querySelector("#btn-numpad-clear")
        btnNumpadClear.addEventListener("click", function() {
          strong.innerText = ""
          input.value = ""
        })

        buttons.forEach(button => {
          button.addEventListener("click", e => {
            if (String(strong.innerText).length > 4) {
              strong.innerText = ""
              input.value = ""
            }
            if (!isNaN(e.target.innerText)) {
              strong.innerText += e.target.innerText;
              input.value += e.target.innerText;
            }
          })
        })
      },
      showCancelButton: true,
      cancelButtonText: "Lewati",
      cancelButtonColor: "red",
      inputValidator: (value) => {
        if (!value || value == "" || value == null) {
          return "Nomor perkara harus diisi";
        }
      }
    })

    if (!decissionNomorPerkara.isConfirmed) {
      changeGlobalAudio("<?= base_url("/audio/intruction-antrian-produk-2.mp3") ?>")

      const result = await Swal.fire({
        title: "Apa anda yakin ?",
        icon: "warning",
        text: "Jika anda melewati langkah ini, kemungkinan proses pelayanan produk pengadilan akan memakan waktu lebih lama.",
        showCancelButton: true,
        confirmButtonText: "Yakin",
        cancelButtonText: "Batalkan",
      })
      if (!result.isConfirmed) {
        stopGlobalAudio()
        return false
      }
      return ambilAntrianPelayanan("PRODUK")
    }

    changeGlobalAudio("<?= base_url("/audio/intruction-antrian-produk-3.mp3") ?>")
    const decissionTahundanJenisPerkara = await Swal.fire({
      template: "#swal-produk-antrian-step-2",
      preConfirm: async () => {
        const tahunPerkara = Swal.getHtmlContainer().querySelector('input[name="radio_tahun_perkara"]:checked')?.value;
        const jenisPerkara = Swal.getHtmlContainer().querySelector('input[name="radio_jenis_perkara"]:checked')?.value;
        if (jenisPerkara == null || tahunPerkara == null) {
          return Swal.showValidationMessage('Silahkan pilih tahun dan jenis perkara terlebih dahulu');
        }

        const nomorPerkara = `${decissionNomorPerkara.value}/${jenisPerkara}/${tahunPerkara}/<?= $_ENV["NOMOR_PERKARA_IDENTITY"] ?>`

        try {
          const response = await fetch("<?= base_url('informasi/para_pihak_perkara') ?>", {
            method: "POST",
            headers: {
              "Content-Type": "application/json",
              "Accept": "application/json"
            },
            body: JSON.stringify({
              nomor_perkara: nomorPerkara,
            })
          })
          if (!response.ok) {
            const reponseData = await response.json();
            if (reponseData?.message == "Data tidak ditemukan") {
              changeGlobalAudio("<?= base_url('/audio/notification-perkara-tidak-ditemukan.mp3') ?>")
              throw new Error('Perkara tidak ditemukan');
            }
            throw new Error('Terjadi kesalahan: ' + reponseData.message);
          }

          return response.json();
        } catch (error) {
          Swal.showValidationMessage(error);
        }
      },
      allowOutsideClick: () => !Swal.isLoading(),
      showLoaderOnConfirm: true,
      cancelButtonText: "Kembali"
    })

    if (!decissionTahundanJenisPerkara.isConfirmed) {
      return openModalPerkaraProduk()
    }

    if (decissionTahundanJenisPerkara.value == null) {
      changeGlobalAudio("<?= base_url('/audio/notification-perkara-tidak-ditemukan.mp3') ?>")
      const perkaraTidakDitemukanDecission = await Swal.fire({
        title: "Perkara yang anda masukan tidak ditemukan",
        icon: "info",
        showCancelButton: true,
        cancelButtonText: "Batalkan",
        cancelButtonColor: "red",
        confirmButtonText: "Kembali",
      })

      if (!perkaraTidakDitemukanDecission.isConfirmed) {
        return openModalPerkaraProduk();
      }

      return openModalPerkaraProduk()
    }

    let liElementDaftarPihak = '';

    decissionTahundanJenisPerkara.value.data?.pihak_satu.forEach(pihak => {
      liElementDaftarPihak += `<li>
      <div class="text-center">
      <input class="form-check-input form-control-lg" value="${pihak.pihak_id}" id="radio-icon-${pihak.pihak_id}" type="radio" name="radio_pihak">
      <label class="form-check-label" for="radio-icon-${pihak.pihak_id}"><i class="fa fa-user"></i><span>${pihak.nama}</span></label>
      </div>
      </li>`
    })

    decissionTahundanJenisPerkara.value.data?.pihak_dua.forEach(pihak => {
      liElementDaftarPihak += `<li>
      <div class="text-center">
      <input class="form-check-input form-control-lg" value="${pihak.pihak_id}" id="radio-icon-${pihak.pihak_id}" type="radio" name="radio_pihak">
      <label class="form-check-label" for="radio-icon-${pihak.pihak_id}"><i class="fa fa-user"></i><span>${pihak.nama}</span></label>
      </div>
      </li>`
    })

    const olElementDaftarPihak = `<ol class="radio-wrapper">${liElementDaftarPihak}</ol>`



    const decissionPihakPengambil = await Swal.fire({
      title: "Siapa yang akan mengambil antrian",
      html: olElementDaftarPihak,
      confirmButtonText: "Ok, Lanjut..",
      showCancelButton: true,
      cancelButtonText: "Kembali",
      cancelButtonColor: "red",
      showLoaderOnConfirm: true,
      didOpen: () => changeGlobalAudio("<?= base_url('/audio/intruction-antrian-produk-4.mp3') ?>"),
      preConfirm: async () => {
        try {
          const radioPihak = Swal.getHtmlContainer().querySelector('input[name="radio_pihak"]:checked')?.value;
          if (radioPihak == null) {
            return Swal.showValidationMessage('Silahkan pilih pihak terlebih dahulu');
          }

          const {
            nomor_perkara
          } = decissionTahundanJenisPerkara.value?.data

          const body = new FormData()
          body.append('nomor_perkara', nomor_perkara)
          body.append('pihak_id', radioPihak)
          body.append('tujuan', "PRODUK")

          const response = await fetch("<?= base_url('ambil/ambil_antrian_ptsp') ?>", {
            method: "POST",
            headers: {
              "Accept": "application/json"
            },
            body: body
          })

          if (!response.ok) {
            const reponseData = await response.json();

            throw new Error('Terjadi kesalahan: ' + reponseData?.message ?? response.statusText);
          }

          return response.json();
        } catch (error) {
          Swal.showValidationMessage(error);
        }
      }
    })

    if (!decissionPihakPengambil.isConfirmed) {
      return openModalPerkaraProduk()
    }

    const {
      kode,
      nomor_urutan
    } = decissionPihakPengambil.value.antrian

    const nomor_antrian = kode + "-" + nomor_urutan;

    (async function() {
      changeGlobalAudio("<?= base_url("/audio/intruction-antrian-1.mp3") ?>")
    })()

    Swal.fire({
      title: "Silahkan ambil antrian",
      icon: "success",
      html: "Antrian Anda : " + nomor_antrian + "<br/><b></b>",
      timer: 5000,
      timerProgressBar: true,
      didOpen: () => {
        const timer = Swal.getPopup().querySelector("b");
        let sec = 4;
        timerInterval = setInterval(() => {
          timer.textContent = sec--;
        }, 1000);
      },
    })
  }

  function changeGlobalAudio(audioPath) {
    globalAudio.pause();
    globalAudio.currentTime = 0;
    globalAudio.src = audioPath;
    globalAudio.play();
  }

  function stopGlobalAudio() {
    globalAudio.pause();
    globalAudio.currentTime = 0;
  }
</script>