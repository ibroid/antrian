<style>
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
      <div class="d-flex justify-content-center">
        <ul class="tg-list common-flex">
          <li class="tg-list-item">
            <input class="tgl tgl-skewed" id="cb3" type="checkbox">
            <label class="tgl-btn" data-tg-off="OFF" data-tg-on="ON" for="cb3"></label>
          </li>
          <li>
            <h6> Audio</h6>
          </li>
        </ul>
      </div>
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
  <div class="row mt-2">
    <div class="col-6">
      <div class="p-1 shadow bg-black bg-opacity-50">
        <div class="card-body">
          <div class="text-center">
            <h1 class="text-warning">Informasi Dan Pengumuman</h1>
          </div>
          <div class="carousel slide" style="min-height: 360px;" id="carouselExampleInterval" data-bs-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active" data-bs-interval="10000"><img class="d-block w-100" src="<?= base_url('/uploads/images/Loading.gif') ?>" alt="drawing-room"></div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev"><span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="visually-hidden">Previous</span></button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next"><span class="carousel-control-next-icon" aria-hidden="true"></span><span class="visually-hidden">Next</span></button>
          </div>
        </div>
      </div>
    </div>
    <div class="col-6">
      <div id="loket-container"></div>
    </div>
  </div>


</div>

<div class="footer2 bg-white bg-opacity-50 ">
  <div class="marquee bg-dark">
    <span>Loading content running text. </span>
  </div>
</div>

<script>
  const loketNametoAudioName = {
    "Customer Service 1": "ke_kastemer_servis_satu.mp3",
    "Customer Service 2": "ke_kastemer_servis_dua.mp3",
    "Customer Service 3": "ke_kastemer_servis_tiga.mp3",
    "Customer Service 4": "ke_kastemer_servis_empat.mp3",
    "Customer Service 5": "ke_kastemer_servis_lima.mp3",
    "Loket Produk": "ke_loket_produk.mp3",
    "Loket Posbakum": "ke_loket_posbakum.mp3",
    "Loket Pos Indonesia": "ke_loket_pos_indonesia.mp3",
    "Loket Bank": "ke_loket_bank.mp3",
  };


  window.addEventListener("load", function() {

    fetchAllPageContent()

    const elementWithColorChanged = [
      document.querySelector("#pelayanan-info"),
    ];
    registerElementforColorToggle(elementWithColorChanged)

    var pusher = new Pusher("<?= $_ENV['PUSHER_APP_KEY'] ?>", {
      cluster: 'ap1'
    });

    const loketChannel = pusher.subscribe('loket-channel');

    const antrianChannel = pusher.subscribe('antrian-channel');

    antrianChannel.bind('panggil-antrian-ptsp', function(data) {
      audioMemanggil(data)
      // fetchTableLoketPelayanan()
    });

    antrianChannel.bind('stop-antrian-ptsp', function(data) {
      const audio = new Audio("<?= base_url() ?>/audio/nomor_antrian/" + loketNametoAudioName[data.nama_loket])
      const audio2 = new Audio("<?= base_url() ?>/audio/nomor_antrian/sedang_istirahat.mp3");
      audio.currentTime = 0.3;
      audio.play()
      audio.addEventListener("ended", function() {
        audio2.play()
      })
    });

    const produkChannel = pusher.subscribe('produk-channel');
    produkChannel.bind('panggil-pihak', (data) => {
      fetch("<?= $_ENV["TTS_URL_API"] ?>/request_voice", {
          method: "POST",
          headers: {
            "Content-Type": "application/json"
          },
          body: JSON.stringify({
            key: "<?= $_ENV["TTS_API_KEY"] ?>",
            text: data
          })
        })
        .then(res => res.json())
        .then(res => {
          const audio = new Audio(`data:audio/wav;base64,${res.data}`)
          audio.playbackRate = 1.2;
          audio.play();
        })
        .catch(err => {
          console.log("Gagal meminta audio. Silahkan refresh halaman ini")
        })

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

    fetchTableLoketPelayanan()
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
   * Fungsi untuk memuat tabel loket pelayanan
   */
  function fetchTableLoketPelayanan() {
    $.ajax({
      url: "<?= base_url("tv/fetch_loket_antrian") ?>",
      method: "POST",
      success: function(html) {
        $("#loket-container").html(html)
      },
      error: function(err) {
        $("#loket-container").html(`<div class="text-center"><h3>Terjadi kesalahaan saat memproses informasi tabel loket pelayanan. ${err.statusText ?? err.responseJSON }</h3></div>`)
      }
    })
  }

  var audioQueue = []
  var isPlaying = false


  function audioMemanggil(loket) {

    const susunanAudio = [];

    const huruf = {
      'Satu': new Audio('<?= base_url('/audio/nomor_antrian/1.mp3') ?>'),
      'Dua': new Audio('<?= base_url('/audio/nomor_antrian/2.mp3') ?>'),
      'Tiga': new Audio('<?= base_url('/audio/nomor_antrian/3.mp3') ?>'),
      'Empat': new Audio('<?= base_url('/audio/nomor_antrian/4.mp3') ?>'),
      'Lima': new Audio('<?= base_url('/audio/nomor_antrian/5.mp3') ?>'),
      'Enam': new Audio('<?= base_url('/audio/nomor_antrian/6.mp3') ?>'),
      'Tujuh': new Audio('<?= base_url('/audio/nomor_antrian/7.mp3') ?>'),
      'Delapan': new Audio('<?= base_url('/audio/nomor_antrian/8.mp3') ?>'),
      'Sembilan': new Audio('<?= base_url('/audio/nomor_antrian/9.mp3') ?>'),
      'Sepuluh': new Audio('<?= base_url('/audio/nomor_antrian/10.mp3') ?>'),
      'Sebelas': new Audio('<?= base_url('/audio/nomor_antrian/11.mp3') ?>'),
      'Belas': new Audio('<?= base_url('/audio/nomor_antrian/BELAS.mp3') ?>'),
      'Puluh': new Audio('<?= base_url('/audio/nomor_antrian/PULUH.mp3') ?>'),
      'Ratus': new Audio('<?= base_url('/audio/nomor_antrian/RATUS.mp3') ?>'),
      'Seratus': new Audio('<?= base_url('/audio/nomor_antrian/SERATUS.mp3') ?>'),
    };

    susunanAudio.push(new Audio("<?= base_url() ?>" + `audio/nomor_antrian/nomor_antrian.mp3`));
    susunanAudio.push(new Audio("<?= base_url('audio/nomor_antrian/abjad/') ?>" + loket.antrian.kode + ".mp3"))

    // Push audio nomor antrian
    terbilang(loket.antrian.nomor_urutan).split(" ").forEach((char) => {
      susunanAudio.push(huruf[char])
    })

    // Push audio nama loket
    susunanAudio.push(new Audio("<?= base_url() ?>/audio/loket/" + loketNametoAudioName[loket.nama_loket]));

    audioQueue.push(susunanAudio);
    if (!isPlaying) {
      playAudioQueue()
    }
  }

  /**
   * @params {Audio[]} audios
   */
  function playSusunanAudio(audios, callback) {
    if (!audios) {
      return;
    }
    let current = 0;
    const playNext = () => {
      if (current < audios.length) {
        const audio = audios[current];
        current++;
        audio.addEventListener("ended", playNext);
        audio.play();
      } else {
        callback();
      }
    }
    playNext();
  }

  function playAudioQueue() {
    isPlaying = true

    if (audioQueue.length == 0) {
      isPlaying = false
      return true;

    }
    playSusunanAudio(audioQueue.shift(), () => {
      playAudioQueue();
    });
  }

  /**
   * @param {number} nilai
   * @returns {string}
   */
  function terbilang(nilai) {
    nilai = Math.floor(Math.abs(nilai));
    var huruf = [
      '',
      'Satu',
      'Dua',
      'Tiga',
      'Empat',
      'Lima',
      'Enam',
      'Tujuh',
      'Delapan',
      'Sembilan',
      'Sepuluh',
      'Sebelas',
    ];

    var bagi = 0;
    var penyimpanan = '';

    if (nilai < 12) {
      penyimpanan = '' + huruf[nilai];
    } else if (nilai < 20) {
      penyimpanan = terbilang(Math.floor(nilai - 10)) + ' Belas';
    } else if (nilai < 100) {
      bagi = Math.floor(nilai / 10);
      penyimpanan = terbilang(bagi) + `${nilai.toString()[1] == '0' ? ' Puluh' : ' Puluh '}` + terbilang(nilai % 10);
    } else if (nilai < 200) {
      penyimpanan = nilai == 100 ? 'Seratus' : 'Seratus ' + terbilang(nilai - 100);
    } else if (nilai < 1000) {
      bagi = Math.floor(nilai / 100);
      penyimpanan = terbilang(bagi) + ' Ratus ' + terbilang(nilai % 100);
    } else if (nilai < 2000) {
      penyimpanan = ' Seribu' + terbilang(nilai - 1000);
    } else if (nilai < 1000000) {
      bagi = Math.floor(nilai / 1000);
      penyimpanan = terbilang(bagi) + ' Ribu ' + terbilang(nilai % 1000);
    } else if (nilai < 1000000000) {
      bagi = Math.floor(nilai / 1000000);
      penyimpanan = terbilang(bagi) + ' Juta ' + terbilang(nilai % 1000000);
    } else if (nilai < 1000000000000) {
      bagi = Math.floor(nilai / 1000000000);
      penyimpanan = terbilang(bagi) + ' Miliar ' + terbilang(nilai % 1000000000);
    } else if (nilai < 1000000000000000) {
      bagi = Math.floor(nilai / 1000000000000);
      penyimpanan = terbilang(nilai / 1000000000000) + ' Triliun ' + terbilang(nilai % 1000000000000);
    } else {
      throw new Error('Terlalu Besar');
    }

    return penyimpanan;
  }
</script>