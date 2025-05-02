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

  body {
    background: url('<?= base_url('assets/images/login/login_bg_green_cozy.jpg') ?>');
    background-size: cover;
    margin-bottom: 160px;
  }

  html {
    position: relative;
    min-height: 100%;
    /* padding-bottom: 160px; */
  }

  footer {
    position: absolute;
    bottom: 0;
    width: 100%;
  }

  .footer2 {
    /* padding: 10px 0; */
    position: absolute;
    bottom: 0;
    width: 100%;
  }

  .marquee {
    overflow: hidden;
    white-space: nowrap;
    font-size: 20px;
  }

  .marquee span {
    display: inline-block;
    padding-left: 100%;
    animation: marquee 15s linear infinite;
  }

  @keyframes marquee {
    0% {
      transform: translateX(0);
    }

    100% {
      transform: translateX(-100%);
    }
  }

  table {
    border-collapse: collapse;
  }
</style>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <div class="container-fluid d-flex px-4">
    <div>
      <a class="navbar-brand" href="#">
        <?= Carbon\Carbon::parse(time())->locale('id_ID')->format("l d F Y") ?>
      </a>
    </div>
    <div class="flex-grow-1">
      <div class="text-center">
        <h1 class="text-white"><?= $this->sysconf->NamaPN ?></h1>
        <h6><?= $this->sysconf->AlamatPN ?> <br>
          <text id="pelayanan-info"> Buka Senin s/d Jumat Pukul 08.00 - 16.00</text>
        </h6>

      </div>
    </div>
    <div class="ms-auto me-auto">|</div>
    <div class="clock p-3">
      <div class="text-center">
        <h3 class="text-warning" id="realtime-clock">00:00:00</h3>
      </div>
      <a href="<?= base_url('/menu') ?>">Kembali</a>
      <script>
        const clockElement = document.getElementById('realtime-clock');

        function updateClock() {
          const date = new Date();
          const hh = date.getHours();
          const mm = date.getMinutes();
          const ss = date.getSeconds();
          clockElement.innerText = hh + ':' + (mm < 10 ? '0' + mm : mm) + ':' + (ss < 10 ? '0' + ss : ss);
        }
        setInterval(updateClock, 1000);
      </script>
    </div>

  </div>
</nav>

<div class="container-fluid">
  <div class="login-card login-dark " style="background-image: none;">
    <!-- <div class="login-main"> -->
    <div class="row mt-2">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <?= $this->session->flashdata('flash_error') ?>
            <?= $this->session->flashdata('flash_alert') ?>
            <div class="text-center mb-3">
              <h3>Menu Pengambilan Antrian PTSP.</h3>
            </div>

            <div class="row">
              <?php foreach ($jenis_pelayanan as $jp) { ?>
                <div class="col-3">
                  <?php
                  if ($jp->support_picker == 1) { ?>
                    <div
                      class="card small-widget mb-sm-0 bg-warning mt-4"
                      onclick="openModalPerkaraProduk('<?= $jp->nama_layanan ?>', '<?= Cypher::urlsafe_encrypt($jp->id)  ?>')">
                      <div class="card-body primary"> <span class="f-light text-light"></span>
                        <div class="d-flex align-items-end gap-1">
                          <h4><?= $jp->kode_layanan . ". " . $jp->nama_layanan ?></h4>
                        </div>
                        <div class="bg-gradient">
                          <svg class="stroke-icon svg-fill">
                            <use href="../assets/svg/icon-sprite.svg#user-visitor"></use>
                          </svg>
                        </div>
                      </div>
                    </div>
                  <?php } else { ?>
                    <div
                      class="card small-widget mb-sm-0 bg-warning card-ambil-antrian-ptsp mt-4" data-antrian-tujuan="<?= $jp->nama_layanan ?>"
                      data-antrian-id="<?= Cypher::urlsafe_encrypt($jp->id)  ?>">
                      <div class="card-body primary"> <span class="f-light text-light"></span>
                        <div class="d-flex align-items-end gap-1">
                          <h4><?= $jp->kode_layanan . ". " . $jp->nama_layanan ?></h4>
                        </div>
                        <div class="bg-gradient">
                          <svg class="stroke-icon svg-fill">
                            <use href="../assets/svg/icon-sprite.svg#user-visitor"></use>
                          </svg>
                        </div>
                      </div>
                    </div>
                  <?php } ?>
                </div>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- </div> -->
  </div>
</div>

<template id="swal-produk-antrian-step-2">
  <swal-title>
    Pilih Tahun dan Jenis Perkara
  </swal-title>
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
          })() as $tahun
        ) { ?>
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
  <swal-button type="confirm">
    Ok, Lanjut..
  </swal-button>
  <swal-button type="cancel">
    Batal
  </swal-button>
</template>

<div class="footer2 bg-white bg-opacity-50 ">
  <div class="marquee bg-dark">
    <span>Loading content running text. </span>
  </div>
</div>

<script>
  window.addEventListener("load", function() {
    fetchAllPageContent()

    const elementWithColorChanged = [
      document.querySelector("#pelayanan-info"),
    ];
    registerElementforColorToggle(elementWithColorChanged)

    $(".card-ambil-antrian-ptsp").click(function() {
      const tujuan = $(this).data("antrian-tujuan")
      const id = $(this).data("antrian-id")

      ambilAntrianPelayanan(tujuan, id);
    })
  })

  /**
   * Fungi untuk mengambil data dan menerapkan nya pada konten web.
   * @returns {Promise<void>}
   */
  function fetchAllPageContent() {

    fetchAnnouncementList().then(function(result) {
      /**
       * @type {
       *   status: bool,
       *   data: {
       *     content: string
       *     status: 1
       *   }[]
       * }
       */
      const {
        status,
        data
      } = JSON.parse(result)

      let startPosition = 0

      changeAnnoucementEveryMarqueeEnd(startPosition, data)
      $(".marquee").on("animationiteration", function() {
        startPosition += 1
        if (startPosition == data.length) {
          startPosition = 0
        }
        changeAnnoucementEveryMarqueeEnd(startPosition, data)
      })
    })

    fetchDataBanner().then(function(result) {
      const {
        status,
        data
      } = result

      data.forEach(renderBannerContent)
    })

  }

  /**
   * Fungsi untuk mengambil data banner.
   * @returns {Promise<{
   *   status: bool,
   *   data: {
   *     filename: string,
   *     status: number
   *   }[]
   * }>}
   */
  function fetchDataBanner() {
    return new Promise((resolve, reject) => {
      $.ajax({
        url: "<?= base_url("layar/fetch_data_banner") ?>",
        headers: {
          "Accept": "application/json"
        },
        success: function(data) {
          resolve(JSON.parse(data))
        },
        error: function(err) {
          reject(err)
        }
      })
    })
  }

  /**
   * Fungsi untuk merender banner.
   * @param {{
   *   filename: string,
   *   status: number
   * }} data
   * @returns {void}
   */
  function renderBannerContent(data) {
    $(".carousel-inner").append(`<div class="carousel-item" data-bs-interval="10000"><img class="d-block w-100" src="/uploads/banner/${data.filename}" alt="drawing-room"></div>`)
  }

  /**
   * Fungsi untuk mengambil data running text.
   * @returns {Promise<string>}
   */
  function fetchAnnouncementList() {
    return new Promise((resolve, reject) => {
      $.ajax({
        url: "<?= base_url('layar/fetch_data_running_text') ?>",
        headers: {
          "Accept": "application/json",
        },
        success: function(data) {
          resolve(data)
        },
        error: function(xhr, status, error) {
          reject(xhr.responseText ?? error)
        }
      })
    })
  }

  /**
   * Fungsi untuk mengganti isi pengumuman di running text setelah running text berakhir.
   * @param {number} startPosition
   * @param {{content: string, status: 1}[]} listOfAnaouncement
   * @returns {void}
   */
  function changeAnnoucementEveryMarqueeEnd(startPosition = 0, listOfAnaouncement) {
    $(".marquee span").text(listOfAnaouncement[startPosition].content);
  }

  /**
   * Meregistrasi setiap element yang dikirimkan untuk di toggle warna nya.
   * @param {Element[]} elements
   */
  function registerElementforColorToggle(elements) {
    elements.forEach(e => {
      toggleColorElementEvery5ms(e)
    })
  }

  /** 
   * Fungsi untuk mengganti warna text secara otomatis setiap 5ms.
   * @param {Element} e
   * @returns {number}
   */
  function toggleColorElementEvery5ms(e) {
    return setInterval(() => {
      if (e.style.color === "red") {
        e.style.color = "yellow"
      } else {
        e.style.color = "red"
      }
    }, 500)
  }

  /**
   * Fungsi untuk menghandle pemilihan perkara sebelum mengambil antrian
   */
  async function openModalPerkaraProduk(tujuan, id) {
    changeGlobalAudio("<?= base_url("/audio/intruction-antrian-produk-1.mp3") ?>")

    const decissionNomorPerkara = await Swal.fire({
      title: "Input Nomor Perkara Anda",
      html: `<h2><strong></strong></h2><div style="display: grid;grid-template-columns: repeat(3, 1fr);grid-gap: 5px;padding: 5px;">
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
      return ambilAntrianPelayanan(tujuan, id)
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
          body.append('tujuan', tujuan)
          body.append('id', id)

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
      if (decissionPihakPengambil.value.message == "Antrian berhasil dicetak") {
        changeGlobalAudio("/audio/intruction-antrian-1.mp3")
      } else {
        changeGlobalAudio("/audio/intruction-antrian-2.mp3")
      }
    })()

    Swal.fire({
      html: decissionPihakPengambil.value.message,
      icon: "success",
      title: "Antrian Anda : " + nomor_antrian + "<br/><b></b>",
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
  }

  var globalAudio = new Audio();

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

  function ambilAntrianPelayanan(tujuan, id, callback = null) {
    swalLoading();
    $.ajax({
      url: "<?= base_url("ambil/ambil_antrian_ptsp") ?>",
      method: "POST",
      headers: {
        "Accept": "application/json",
      },
      data: {
        tujuan: tujuan,
        id: id,
      },
      success(data) {
        const {
          antrian,
          message,
          print_status
        } = JSON.parse(data);

        (async function() {
          if (message == "Antrian berhasil dicetak") {
            changeGlobalAudio("/audio/intruction-antrian-1.mp3")
          } else {
            changeGlobalAudio("/audio/intruction-antrian-2.mp3")
          }
        })()

        const nomor_antrian = antrian.kode + "-" + antrian.nomor_urutan;
        const swal_response = {
          title: "Nomor Antrian Anda : " + nomor_antrian,
          icon: "success",
          html: message + "<br/><b></b>",
        };

        if (print_status) {
          swal_response["timer"] = 5000;
          swal_response["timerProgressBar"] = true;
          swal_response["didOpen"] = () => {
            Swal.showLoading();
            const timer = Swal.getPopup().querySelector("b");
            timerInterval = setInterval(() => {
              timer.textContent = `${Swal.getTimerLeft()}`;
            }, 100);
          };
          swal_response["willClose"] = () => {
            clearInterval(timerInterval);
          }
        } else {
          swal_response['confirmButtonText'] = "Cetak melalui USB";
          swal_response['showCancelButton'] = true;
        }

        Swal.fire(swal_response).then((result) => {
          if (result.isConfirmed) {
            window.open(`<?= base_url('ambil/cetak_antrian') ?>?type=ptsp&id=${antrian.id}`, '_blank', 'location=yes,height=320,width=520,scrollbars=yes,status=yes')
          }
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
</script>