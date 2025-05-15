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

  .table-container {
    max-height: 1000px;
    overflow-y: auto;
  }

  .table thead th {
    position: sticky;
    top: 0;
    background-color: #343a40;
    /* sama dengan warna table-dark */
    color: #fff;
    z-index: 10;
  }

  .table th,
  .table td {
    width: 12.5%;
    /* Misal kalau ada 6 kolom: 100% / 6 = 16.66% */
    text-align: center;
    /* Biar teksnya juga rapi di tengah */
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

<!-- <div class="container-fluid">
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
      <div class="shadow bg-transparent rounded rounded-5 border border-light border-3">
        <div class="card-body text-center">
          <h1 class="text-dark bg-white rounded rounded-5 mb-2">Video Panduan Inovasi</h1>
          <div class="text-center">
            <iframe id="tvplayer" width="500" height="400" src="<?= $link_youtube_inovasi ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
            </iframe>
          </div>
          <ul id="channelTvList" class="pagination pagination-primary pagin-border-primary justify-content-center mb-2">
          </ul>
        </div>
      </div>
    </div>
  </div>
</div> -->

<div class="container-fluid m-5">
  <hr class="text-center text-white">
  <h1 class="text-warning text-center">Daftar Sidang Hari Ini</h1>
  <h2 class="text-center text-warning">Silahkan cari nama anda</h2>
  <div class="table-container m-3 border rounded p-3">
    <table class="m-5 rounded table table-bordered background-transparent table-responsive table-hover " id="table-sidang">
      <thead>
        <tr class="text-center text-white">
          <th>
            <h6> Pekara</h6>
          </th>
          <th>
            <h6> Pihak P </h6>
          </th>
          <th>
            <h6> Kuasa P</h6>
          </th>
          <th>
            <h6> Pihak T </h6>
          </th>
          <th>
            <h6> Kuasa T</h6>
          </th>
          <th>
            <h6> Ruangan</h6>
          </th>
          <th>
            <h6> Majelis</h6>
          </th>
          <th>
            <h6> Aksi</h6>
          </th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($daftar_sidang as $n => $ds) { ?>
          <tr class="text-center text-dark">
            <td>
              <p><?= $ds->perkara->nomor_perkara ?><br><?= $ds->perkara->jenis_perkara_nama ?></p>
            </td>
            <td>
              <p>
                <?= $ds->perkara->pihak_satu[0]->nama ?? "Kosong" ?>
              </p>
            </td>
            <td>
              <p>
                <?php if (count($ds->perkara->pengacara_satu) > 0) {
                  echo  $ds->perkara->pengacara_satu[0]->nama ?? "Kosong";
                } ?>
              </p>
            </td>
            <td>
              <p>
                <?php if (count($ds->perkara->pihak_dua) !== 0) {
                  echo  $ds->perkara->pihak_dua[0]->nama ?? "Kosong";
                }  ?>
              </p>
            </td>
            <td>
              <p>
                <?php if (count($ds->perkara->pengacara_dua) > 0) {
                  echo  $ds->perkara->pengacara_dua[0]->nama ?? "Kosong";
                } ?>
              </p>
            </td>
            <td>
              <p><?= $ds->ruangan ?><br><?= str_replace("Panitera Pengganti:", "", $ds->perkara->penetapan->panitera_pengganti_text)  ?></p>
            </td>
            <td>
              <p><?= $ds->perkara->penetapan->majelis_hakim_nama ?></p>
            </td>
            <td>
              <button
                hx-post="<?= base_url("ambil/fetch_table_checkin?secondary_print=true") ?>"
                class="btn btn-lg btn-primary"
                data-bs-toggle="modal"
                data-bs-target="#checkInModal"
                hx-on::after-request="changeGlobalAudio('<?= base_url("/audio/intruction-antrian-sidang-1.mp3") ?>')"
                hx-vals='{"sidang_id": <?= $ds->id ?>}'
                hx-target="#checkInModal-body">
                <p>Ambil Antrian</p>
              </button>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>


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


<script>
  let checkInModal;
  window.addEventListener("load", function() {
    $("#table-sidang").DataTable({
      language: {
        "search": "Cari :"
      }
    })

    checkInModal = new bootstrap.Modal(
      document.getElementById("checkInModal"),
    );

    fetchAllPageContent()

    const elementWithColorChanged = [
      document.querySelector("#pelayanan-info"),
    ];
    registerElementforColorToggle(elementWithColorChanged)
  })

  document.getElementById("checkInModal").addEventListener("hide.bs.modal", () => {
    $("#checkInModal-body").html(" <div class=\"text-center\"><h4>Mohon Tunggu ...</h4></div>")
  })

  const handleRowClick = (sidang_id) => {
    checkInModal.show()
    $.ajax({
      url: "<?= base_url("ambil/fetch_table_checkin?secondary_print=true") ?>",
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

  /**
   * Fungi untuk mengambil data dan menerapkan nya pada konten web.
   * @returns {Promise<void>}
   */
  function fetchAllPageContent() {

    fetchDataBanner().then(function(result) {
      const {
        status,
        data
      } = result

      data.forEach(renderBannerContent)
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
   * Fungsi untuk mengganti link video tv player.
   * @param {string} source
   */
  function changeIFrameVideoSource(source) {
    const iframe = document.querySelector("#tvplayer")
    iframe.setAttribute("src", source + "&amp;controls=1&autoplay=1")
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
      url: "<?= base_url("layar/fetch_table_loket_pelayanan") ?>",
      method: "POST",
      success: function(html) {
        $("#container-table-loket-pelayanan").html(html)
      },
      error: function(err) {
        $("#container-table-loket-pelayanan").html(`<div class="text-center"><h3>Terjadi kesalahaan saat memproses informasi tabel loket pelayanan. ${err.statusText ?? err.responseJSON }</h3></div>`)
      }
    })
  }


  document.body.addEventListener("after_print", function(evt) {
    if (checkInModal) {
      checkInModal.hide()
    }
    Toastify({
      text: "Berhasil mencetak antrian",
      duration: 4500,
      gravity: "top",
      position: 'center',
    }).showToast();
  })
</script>

<?= $this->session->flashdata('print_error') ?>