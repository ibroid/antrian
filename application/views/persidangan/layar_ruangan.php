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
      <div class="shadow bg-transparent rounded rounded-5 border border-light border-3">
        <div class="card-body text-center">
          <h1 class="text-dark bg-white rounded rounded-5 mb-2">TV Publik</h1>
          <div class="text-center">
            <iframe id="tvplayer" width="840" height="550" src="<?= $youtube_link ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
            </iframe>
          </div>
        </div>
      </div>
    </div>
    <div class="col-6">
      <div id="ruangan-container"></div>
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

    fetchTablePersidangan({
      nomor_ruang: <?= $ruang_sidang->kode ?>,
      nama_ruang: "<?= $ruang_sidang->nama ?>",
      nomor_perkara: "<?= $ruang_sidang->antrian->nomor_perkara ?>",
      nomor_urutan: "<?= $ruang_sidang->antrian->nomor_urutan ?>",
      majelis_hakim: "<?= $ruang_sidang->antrian->majelis_hakim ?>"
    })

    fetchAllPageContent()

    const elementWithColorChanged = [
      document.querySelector("#pelayanan-info"),
    ];
    registerElementforColorToggle(elementWithColorChanged)

    var pusher = new Pusher("<?= $_ENV['PUSHER_APP_KEY'] ?>", {
      cluster: 'ap1'
    });

    const channel = pusher.subscribe('antrian-channel');
    channel.bind("update-persidangan", function(data) {
      if (data.nomor_ruang == parseInt("<?= $ruang_sidang->kode ?>")) {
        fetchTablePersidangan({
          nomor_ruang: data.nomor_ruang,
          nama_ruang: data.ruang_sidang.nama,
          nomor_perkara: data.antrian_persidangan.nomor_perkara,
          nomor_urutan: data.antrian_persidangan.nomor_urutan,
          majelis_hakim: data.antrian_persidangan.majelis_hakim
        })
      }
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
  function fetchTablePersidangan(data) {
    $.ajax({
      url: "<?= base_url("layar/current_ruangan") ?>",
      method: "POST",
      data: data,
      success: function(html) {
        $("#ruangan-container").html(html)
      },
      error: function(err) {
        $("#ruangan-container").html(`<div class="text-center"><h3>Terjadi kesalahaan saat memproses informasi tabel loket pelayanan. ${err.statusText ?? err.responseJSON }</h3></div>`)
      }
    })
  }

  /**
   * Fungsi untuk mengambil data channel tv list.
   * @returns {Promise<string[]>}
   */
  function fetchDataChannelTvList() {
    return new Promise((resolve, reject) => {
      $.ajax({
        url: "<?= base_url("layar/fetch_data_channel_tv_list") ?>",
        headers: {
          "Accept": "application/json"
        },
        success: function(data) {
          resolve(data)
        },
        error: function(err) {
          reject(err)
        }
      })
    })
  }

  /**
   * Fungsi untuk merender button data channel tv list.
   * @param {{
   *   nama_channel: string,
   *   url: string,
   *   status: number,
   * }[]} data
   */
  function renderChannelTvList(data) {
    data.forEach(d => {
      const elementList = $("<li>").addClass("page-item")
      const elementLink = $("<a>").attr("href", "javascript:void(0)").addClass("page-link").text(d.nama_channel)
      elementList.append(elementLink)
      elementList.click(() => {
        changeIFrameVideoSource(d.url)
      })
      $("#channelTvList").append(elementList)
    })
  }

  /**
   * Fungsi untuk mengganti link video tv player.
   * @param {string} source
   */
  function changeIFrameVideoSource(source) {
    const iframe = document.querySelector("#tvplayer")
    iframe.setAttribute("src", source + "&amp;controls=1&autoplay=1")
  }
</script>