<!doctype html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
  <meta name="apple-mobile-web-app-capable" content="yes" />
  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
  <meta name="theme-color" content="#000000">
  <title>Pelayanan Mobile PAJU | <?= $title ?? "Beranda" ?></title>
  <meta name="description" content="Pelayanan Mobile PAJU">
  <meta name="keywords" content="paju, pajakut, pengadilan agama jakarta utara" />

  <meta http-equiv='cache-control' content='no-cache'>
  <meta http-equiv='expires' content='0'>
  <meta http-equiv='pragma' content='no-cache'>

  <!-- Favivon resource -->
  <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('assets/mobile/favicon_io/') ?>apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('assets/mobile/favicon_io/') ?>favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('assets/mobile/favicon_io/') ?>favicon-16x16.png">
  <!-- End of Favicon Resourece -->

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Alata&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Alata' !important;
    }
  </style>

  <link rel="stylesheet" href="<?= base_url("assets/mobile/") ?>css/style.css">
  <link rel="manifest" href="<?= base_url("assets/mobile/") ?>manifest.json">
  <script src="<?= base_url('package/htmx/htm.js') ?>"></script>
</head>

<body>

  <!-- loader -->
  <div id="loader">
    <div class="spinner-border text-primary" role="status"></div>
  </div>
  <!-- * loader -->

  <!-- App Header -->
  <div class="appHeader bg-primary scrolled">
    <div class="pageTitle">
      <?= $page_title ?? "Beranda" ?>
    </div>
    <div class="left">
      <a data-bs-toggle="modal" data-bs-target="#dialog-info" href="javascript:void(0)" class="headerButton">
        <ion-icon name="information-circle-outline"></ion-icon>
      </a>
    </div>
    <div class="right">
      <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#modal-notifikasi" class="headerButton">
        <ion-icon name="notifications-outline"></ion-icon>
        <span class="badge badge-danger">1</span>
      </a>
      <a href="javascript:void(0)" class="headerButton" onclick="installApp()">
        <ion-icon color="success" name="download-outline"></ion-icon>
      </a>
    </div>
  </div>

  <div class="modal fade dialogbox" id="dialog-info" data-bs-backdrop="static" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Deskripsi</h5>
        </div>
        <div class="modal-body">
          Aplikasi Smart Portal Paju versi Web PWA
          <p hx-get="<?= base_url("mobile/visitor") ?>" hx-trigger="intersect">Visitor hari ini : 0</p>
        </div>
        <div class="modal-footer">
          <div class="btn-inline">
            <a href="#" class="btn btn-text-secondary" data-bs-dismiss="modal">Tutup</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade modalbox" id="modal-notifikasi" data-bs-backdrop="static" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h5 class="modal-title text-light">Pemberitahuan</h5>
          <a href="#" class="text-light" data-bs-dismiss="modal">Tutup</a>
        </div>
        <div class="modal-body p-0">
          <ul class="listview image-listview flush mb-2">
            <li>
              <a href="javascript:void(0)" data-bs-dismiss="modal" onclick=" notification('no-antrian-notif')" class="item">
                <img src="<?= base_url('assets/mobile/favicon_io/android-chrome-192x192.png') ?>" alt="image" class="image">
                <div class="in">
                  <div class="d-flex flex-column">
                    <div>Notifikasi System</div>
                    <div class="text-muted">Kami tidak bisa mengirim pemberitahuan panggilan antrian kepada anda. Klik untuk mendapatkan layanan yang lebih banyak.</div>
                  </div>
                </div>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <!-- * App Header -->

  <!-- App Capsule -->
  <div id="appCapsule" class="full-height">
    <?= $page ?>

    <div id="appFooter" class="appFooter">
      <img src="<?= base_url("assets/logo_pa.png?2") ?>" alt="logo pa" class="footer-logo mb-2">
      <div class="footer-title">
        Copyright © Pengadilan Agama Jakarta Utara <span class="yearNow"></span>.
      </div>
      <div>Smart Portal Paju Web.</div>
      Follow kami melalui media sosial dibawah ini.

      <div class="mt-2">
        <a target="_blank" href="https://www.facebook.com/pa.jakartautara/" class="btn btn-icon btn-sm btn-facebook">
          <ion-icon name="logo-facebook"></ion-icon>
        </a>
        <a target="_blank" href="https://x.com/pa_jakartautara" class="btn btn-icon btn-sm btn-twitter">
          <ion-icon name="logo-twitter"></ion-icon>
        </a>
        <!-- <a target="_blank" href="#" class="btn btn-icon btn-sm btn-linkedin">
      <ion-icon name="logo-linkedin"></ion-icon>
    </a> -->
        <a target="_blank" href="https://www.instagram.com/pa.jakartautara/" class="btn btn-icon btn-sm btn-instagram">
          <ion-icon name="logo-instagram"></ion-icon>
        </a>
        <a target="_blank" href="https://pa-jakartautara.go.id" class="btn btn-icon btn-sm btn-dark">
          <ion-icon name="globe"></ion-icon>
        </a>
        <!-- <a target="_blank" href="#" class="btn btn-icon btn-sm btn-secondary goTop">
      <ion-icon name="arrow-up-outline"></ion-icon>
    </a> -->
      </div>
    </div>
  </div>
  <!-- * App Capsule -->

  <!-- App Bottom Menu -->
  <div class="appBottomMenu">
    <a href="<?= base_url("mobile/beranda") ?>" class="item">
      <div class="col">
        <ion-icon name="home-outline"></ion-icon>
      </div>
    </a>
    <a href="app-components.html" class="item">
      <div class="col">
        <ion-icon name="cube-outline"></ion-icon>
      </div>
    </a>
    <a href="page-chat.html" class="item">
      <div class="col">
        <ion-icon name="chatbubble-ellipses-outline"></ion-icon>
        <span class="badge badge-danger"></span>
      </div>
    </a>
    <a href="app-pages.html" class="item">
      <div class="col">
        <ion-icon name="layers-outline"></ion-icon>
      </div>
    </a>
    <a href="#sidebarPanel" class="item" data-bs-toggle="offcanvas">
      <div class="col">
        <ion-icon name="menu-outline"></ion-icon>
      </div>
    </a>
  </div>
  <!-- * App Bottom Menu -->

  <!-- iOS Add to Home Action Sheet -->
  <div class="offcanvas offcanvas-bottom action-sheet inset ios-add-to-home" tabindex="-1" id="ios-add-to-home-screen">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title">Cara Install Aplikasi di IOS</h5>
      <a href="#" class="close-button" data-bs-dismiss="offcanvas">
        <ion-icon name="close"></ion-icon>
      </a>
    </div>
    <div class="offcanvas-body">
      <div class="action-sheet-content text-center">
        <div class="mb-1"><img src="<?= base_url("assets/mobile/favicon_io/android-chrome-192x192.png") ?>" alt="icon app install" class="imaged w48">
        </div>
        <h4>Smart Portal Paju Web</h4>
        <div>
          Dengan menambahkan aplikasi ini ke layar utama. Silahkan ikuti langkah berikut.
        </div>
        <div>
          Tekan <ion-icon name="share-outline"></ion-icon> lalu pilih Tambahkan ke Layar Utama.
        </div>
      </div>
    </div>
  </div>
  <!-- * iOS Add to Home Action Sheet -->


  <!-- Android Add to Home Action Sheet -->
  <div class="offcanvas offcanvas-top action-sheet inset android-add-to-home" tabindex="-1" id="android-add-to-home-screen">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title">Cara Install Aplikasi di Android</h5>
      <a href="#" class="close-button" data-bs-dismiss="offcanvas">
        <ion-icon name="close"></ion-icon>
      </a>
    </div>
    <div class="offcanvas-body">
      <div class="action-sheet-content text-center">
        <div class="mb-1">
          <img src="<?= base_url("assets/mobile/favicon_io/android-chrome-192x192.png") ?>" alt="icon app install" class="imaged w48">
        </div>
        <h4>Smart Portal Paju Web</h4>
        <div>
          Dengan menambahkan aplikasi ini ke layar utama. Silahkan ikuti langkah berikut.
        </div>
        <div>
          Tekan <ion-icon name="ellipsis-vertical"></ion-icon> lalu pilih Tambahkan ke Layar Utama.
        </div>
      </div>
    </div>
  </div>
  <!-- * Android Add to Home Action Sheet -->

  <!-- ============== Js Files ==============  -->
  <!-- Bootstrap -->
  <script src="<?= base_url('assets/mobile/') ?>js/lib/bootstrap.min.js"></script>
  <!-- Ionicons -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  <!-- Splide -->
  <script src="<?= base_url('assets/mobile/') ?>js/plugins/splide/splide.min.js"></script>
  <!-- ProgressBar js -->
  <script src="<?= base_url('assets/mobile/') ?>js/plugins/progressbar-js/progressbar.min.js"></script>
  <!-- Base Js File -->
  <script src="<?= base_url('assets/mobile/') ?>js/base.js?asidj"></script>
  <script>
    let deferredPrompt;

    window.addEventListener('beforeinstallprompt', (e) => {
      console.log("its not installed yet")
      // Mencegah browser menampilkan dialog instalasi secara otomatis
      e.preventDefault();
      // Menyimpan event untuk digunakan nanti
      deferredPrompt = e;
      // Menampilkan tombol atau UI untuk mengajak pengguna menginstal PWA
      showInstallPromotion();
    });

    function showInstallPromotion() {
      const installButton = document.createElement('button');
      const iconButton = document.createElement('ion-icon');

      iconButton.setAttribute("name", "download-outline");
      installButton.innerText = "Install App";
      // document.body.appendChild(installButton);
      installButton.classList = "btn btn-outline-success btn-sm mt-2"
      installButton.appendChild(iconButton)
      document.getElementById("appFooter").appendChild(installButton)

      installButton.addEventListener('click', async () => {
        // Menyembunyikan UI promosi instalasi
        installButton.style.display = 'none';
        // Memunculkan dialog instalasi
        deferredPrompt.prompt();
        // Menunggu respons pengguna
        const {
          outcome
        } = await deferredPrompt.userChoice;
        if (outcome === 'accepted') {
          console.log('User accepted the install prompt');
        } else {
          console.log('User dismissed the install prompt');
        }
        // Reset deferredPrompt variable
        deferredPrompt = null;
      });
    }

    function installApp() {
      const osDetection = navigator.userAgent || navigator.vendor || window.opera;
      const iosDetection = /iPad|iPhone|iPod/.test(osDetection) && !window.MSStream;

      if (iosDetection) {
        var offcanvas = new bootstrap.Offcanvas(document.getElementById('ios-add-to-home-screen'))
        offcanvas.toggle();
      } else {
        var offcanvas = new bootstrap.Offcanvas(document.getElementById('android-add-to-home-screen'))
        offcanvas.toggle();
      }
    }

    window.addEventListener("load", function() {
      console.log('sadjpsao ')
      const osDetection = navigator.userAgent || navigator.vendor || window.opera;
      const iosDetection = /iPad|iPhone|iPod/.test(osDetection) && !window.MSStream;

      const body = new FormData();
      body.append("device", iosDetection ? "ios" : "android");

      fetch("<?= base_url("mobile/visitor") ?>", {
          method: "POST",
          body: body,
        }).then(res => {
          if (!res.ok) {
            throw new Error(res.statusText);
          }

          return res.text();
        })
        .then((r) => console.log(r))
        .catch(err => {
          console.log("Visitor present error.", err);
        })
    })
  </script>
</body>

</html>