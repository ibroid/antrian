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
    </div>
    <div class="flex-grow-1">
      <div class="text-center">
        <h1 class="text-white">PENGADILAN AGAMA JAKARTA UTARA</h1>
        <h6>Jl. Plumpang Semper No.5, Tugu Sel., Kec. Koja, Jkt Utara, Daerah Khusus Ibukota Jakarta 14260 <br>
          <text id="pelayanan-info"> Buka Senin s/d Sabtu Pukul 08.00 - 16.00</text>
        </h6>

      </div>
    </div>
    <div class="ms-auto me-auto">|</div>
    <div class="clock p-3">
      <div class="text-center">
        <h3 class="text-warning" id="realtime-clock">00:00:00</h3>
      </div>
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
    <div class="col-5">
      <div class="p-1 shadow bg-black bg-opacity-50">
        <div class="card-body">
          <div class="text-center">
            <h1 class="text-warning">Informasi Dan Pengumuman</h1>
          </div>
          <div class="carousel slide" style="min-height: 360px;" id="carouselExampleInterval" data-bs-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active" data-bs-interval="10000"><img class="d-block w-100" src="/assets/images/banner/1.jpg" alt="drawing-room"></div>
              <div class="carousel-item" data-bs-interval="2000"><img class="d-block w-100" src="/assets/images/banner/2.jpg" alt="drawing-room"></div>
              <div class="carousel-item"><img class="d-block w-100" src="/assets/images/banner/3.jpg" alt="drawing-room"></div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev"><span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="visually-hidden">Previous</span></button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next"><span class="carousel-control-next-icon" aria-hidden="true"></span><span class="visually-hidden">Next</span></button>
          </div>
        </div>
      </div>
    </div>
    <div class="col-2">
      <div class="card bg-transparent">
        <div class="card-header p-3">
          <h4 class="card-title bg-white text-center">SEDANG DI PANGGIL</h4>
        </div>
        <span style="font-size: 5rem" class="p-0 badge bg-white text-primary bg-opacity-50">000</span>
      </div>
      <div class="card bg-transparent">
        <div class="card-header p-3">
          <h4 class="card-title bg-white text-center">JUMLAH YANG SUDAH DIPANGILL</h4>
        </div>
        <span style="font-size: 5rem" class="p-0 badge bg-white text-success bg-opacity-50">000</span>
      </div>
      <div class="card bg-transparent">
        <div class="card-header p-3">
          <h4 class="card-title bg-white text-center">JUMLAH YANG BELUM DIPANGGIL</h4>
        </div>
        <span style="font-size: 5rem" class="p-0 badge bg-white text-danger bg-opacity-50">000</span>
      </div>

    </div>
    <div class="col-5">
      <div class="shadow bg-transparent rounded rounded-5 border border-light border-3">
        <div class="card-body text-center">
          <h1 class="text-dark bg-white rounded rounded-5 mb-2">TV Publik</h1>
          <div class="text-center">
            <iframe id="tvplayer" width="720" height="450" src="https://www.youtube.com/embed/yNKvkPJl-tg?si=7fQq7qJbRJ32JUu7&amp;controls=1&mute=1&autoplay=1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
            </iframe>
          </div>
          <ul class="pagination pagination-primary pagin-border-primary justify-content-center mb-2">
            <li class="page-item"><a class="page-link" href="javascript:void(0)">Tv One</a></li>
            <li class="page-item"><a class="page-link" href="javascript:void(0)">Kompas Tv</a></li>
            <li class="page-item"><a class="page-link" href="javascript:void(0)">Metro Tv</a></li>
            <li class="page-item"><a class="page-link" href="javascript:void(0)">Spongebob</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>


</div>

<div class="footer2 bg-white bg-opacity-50 ">
  <table style="--bs-table-bg: transparent;" class="table table-bordered background-transparent text-center">
    <thead>
      <tr>
        <th class="p-0 text-dark" scope="col" style="font-size: 1.2rem">Loket Kasir</th>
        <th class="p-0 text-dark" scope="col" style="font-size: 1.2rem">Loket Produk</th>
        <th class="p-0 text-dark" scope="col" style="font-size: 1.2rem">Loket Pelayanan 1</th>
        <th class="p-0 text-dark" scope="col" style="font-size: 1.2rem">Loket Pelayanan 2</th>
        <th class="p-0 text-dark" scope="col" style="font-size: 1.2rem">Loket Pelayanan 3</th>
        <th class="p-0 text-dark" scope="col" style="font-size: 1.2rem">Loket Pelayanan 4</th>
        <th class="p-0 text-dark" scope="col" style="font-size: 1.2rem">Loket Posbakum</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td class="p-2"><span style="font-size: 5rem" class="badge bg-success">B-0</span></td>
        <td class="p-2"><span style="font-size: 5rem" class="badge bg-warning">D-0</span></td>
        <td class="p-2"><span style="font-size: 5rem" class="badge bg-secondary">A-0</span></td>
        <td class="p-2"><span style="font-size: 5rem" class="badge bg-secondary">A-0</span></td>
        <td class="p-2"><span style="font-size: 5rem" class="badge bg-secondary">A-0</span></td>
        <td class="p-2"><span style="font-size: 5rem" class="badge bg-secondary">A-0</span></td>
        <td class="p-2"><span style="font-size: 5rem" class="badge bg-primary">C-0</span></td>
      </tr>
    </tbody>
  </table>
  <div class="marquee bg-dark">
    <span>Running Text. </span>
  </div>
</div>


<script>
  window.addEventListener("load", function() {
    const announcementTextList = [
      "This is a marquee text inside the Bootstrap 5 footer.",
      "This is a new paragraph of marquee.",
    ];

    const elementWithColorChanged = [
      document.querySelector("#pelayanan-info"),
    ];

    const tvChannelList = [{
        "channel_name": "TV One",
        "channel_link": "https://www.youtube.com/embed/yNKvkPJl-tg?si=AJHk-H1tdbPSQwS7",
      },
      {
        "channel_name": "Kompas TV",
        "channel_link": "https://www.youtube.com/embed/DOOrIxw5xOw?si=vYchAp7vVe6KSU_w",
      },
      {
        "channel_name": "Metro TV",
        "channel_link": "https://www.youtube.com/embed/XKueVSGTk2o?si=iHU8FRYVdNDuVsyN",
      },
      {
        "channel_name": "Spongebob",
        "channel_link": "https://www.youtube.com/embed/-AzqVQY32-Y?si=lkCY1Oip_o_nPzLq",
      }
    ]

    autoToggleColorEvery5Ms(elementWithColorChanged)

    $(".page-link").each((index, element) => {
      $(element).on("click", function() {
        changeIFrameVideoSource(tvChannelList[index].channel_link)
      })
    })


    let startPosition = 0
    changeAnnoucementEveryMarqueeEnd(startPosition, announcementTextList)
    $(".marquee").on("animationiteration", function() {
      startPosition += 1
      changeAnnoucementEveryMarqueeEnd(startPosition, announcementTextList)
    })
  })

  /**
   * Fungsi untuk mengganti isi pengumuman di running text setelah running text berakhir.
   * @param {number} startPosition
   * @param {string[]} listOfAnaouncement
   * @returns {void}
   */
  function changeAnnoucementEveryMarqueeEnd(startPosition = 0, listOfAnaouncement) {
    if (startPosition == listOfAnaouncement.length) {
      changeAnnoucementEveryMarqueeEnd(0, listOfAnaouncement)
    }

    $(".marquee span").text(listOfAnaouncement[startPosition]);
  }

  /**
   * Fungsi untuk mengganti warna background secara otomatis setiap 5ms.
   * @param {Element[]} element
   */
  function autoToggleColorEvery5Ms(element) {
    element.forEach(e => {
      setInterval(() => {
        if (e.style.color === "red") {
          e.style.color = "yellow"
        } else {
          e.style.color = "red"
        }
      }, 500)
    })
  }

  function changeIFrameVideoSource(source) {
    const iframe = document.querySelector("#tvplayer")
    iframe.setAttribute("src", source + "&amp;controls=1&autoplay=1")
  }
</script>