<div class="row">
  <div class="col-xl-12 p-0">
    <div class="login-card login-dark ">
      <div class="login-main" style="width: 1200px;">
        <?= $this->session->flashdata('flash_error') ?>
        <?= $this->session->flashdata('flash_alert') ?>
        <form action="<?= base_url('ktp/simpan') ?>" method="POST">
          <div class="text-center mb-3">
            <a class="btn btn-secondary btn-sm mb-4" href="<?= base_url('ambil') ?>">
              <i class="fa fa-arrow-left"></i>
              Ambil Langsung
            </a>
            <h3>Menu Pengambilan Antrian.</h3>
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
          <div class="d-flex justify-content-center mt-4 gap-4">
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
          <hr>
          <div class="text-center mb-3">
            <h3>Identitas Pengunjung.</h3>
          </div>
          <div id="form-container">

          </div>

        </form>
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


<script src="<?= base_url("/package/face-api.js/dist/face-api.js"); ?>"></script>
<script type="text/javascript" src="https://unpkg.com/webcam-easy/dist/webcam-easy.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/hammer.js/2.0.8/hammer.min.js"></script>
<script>

</script>
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

    $("#webcam").bind("loadedmetadata", function() {
      displaySize = {
        width: this.scrollWidth,
        height: this.scrollHeight
      }
    });

  })
</script>



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
          <hr>
          <form action="<?= base_url('auth/logout') ?>" method="POST">
            <button class="btn btn-danger">Logout</button>
          </form>
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

    $(".btn-audio").click(function() {
      const fileAudio = $(this).data("file-audio")
      changeGlobalAudio("<?= base_url('/audio') ?>/" + fileAudio)
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
        const {
          antrian,
          message
        } = JSON.parse(data);

        (async function() {
          if (message == "Antrian berhasil dicetak") {
            changeGlobalAudio("/audio/intruction-antrian-1.mp3")
          } else {
            changeGlobalAudio("/audio/intruction-antrian-2.mp3")
          }
        })()

        const nomor_antrian = antrian.kode + "-" + antrian.nomor_urutan;

        Swal.fire({
          title: "Nomor Antrian Anda : " + nomor_antrian,
          icon: "success",
          html: message + "<br/><b></b>",
          timer: 6000,
          timerProgressBar: true,
          didOpen: () => {
            const timer = Swal.getPopup().querySelector("b");
            let sec = 5;
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
        changeGlobalAudio("<?= base_url("/audio/intruction-antrian-sidang-1.mp3") ?>")
      },
      error(err) {
        $("#checkInModal-body").html(err.responseText && err.message)
      }
    })
  }

  const disableAfterSubmit = (e) => {
    swalLoading()
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

  /**
   * Fungsi untuk memutar audio berulang yang sumber nya di dalam array.
   * @param {string[]} audioList
   * @returns {void}
   */
  function playAudioStreak(audioList) {
    if (audioList.length == 0) {
      return true;
    }

    let audio = new Audio();
    audio.src = audioList[0];
    audio.play();
    audio.addEventListener("ended", () => {
      if (indexAudio < audioList.length) {
        audioList.shift()
        playAudioStreak(audioList)
      }
    });
  }

  /**
   * @param {string} antrianNumber
   * return {string[]}
   */
  function getAudioFromAntrianNmber(antrianNumber) {
    const arrayOfNumber = antrianNumber.split("")
    const arrayAudioSource = [];

    if (antrianNumber.length == 1) {
      return [
        `<?= base_url('/audio/nomor_antrian/') ?>${arrayOfNumber[0]}.mp3`,
      ]
    }

    if (antrianNumber.length == 2 && parseInt(arrayOfNumber[0]) == 1) {
      arrayAudioSource.push('<?= base_url('/audio/nomor_antrian/') ?>SE.mp3');

      if (parseInt(arrayOfNumber[1]) == 0) {
        return [...arrayAudioSource, `<?= base_url('/audio/nomor_antrian/') ?>PULUH.mp3`];
      }

      if (arrayOfNumber[1] == "00") {
        return [...arrayAudioSource, `<?= base_url('/audio/nomor_antrian/') ?>RATUS.mp3`];
      }

    }
    const audioPath = `<?= base_url('/audio/nomor_antrian/') ?>${arrayOfNumber[1]}.mp3`
    return audioPath
  }

  window.addEventListener("load", function() {
    var pusher = new Pusher('<?= $_ENV['PUSHER_APP_KEY'] ?>', {
      cluster: 'ap1'
    });

    var channel = pusher.subscribe('scan-data');
    channel.bind('recive', function(data) {
      $.ajax({
        url: "<?= base_url('ktp/fetch_form') ?>",
        method: "POST",
        data: {
          photo: data
        },
        success(form) {
          $("#form-container").html(form)
        }
      })
    });
  })
</script>