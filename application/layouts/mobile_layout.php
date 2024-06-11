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

  <link rel="stylesheet" href="<?= base_url("assets/mobile/") ?>css/style.css">
  <link rel="manifest" href="<?= base_url("assets/mobile/") ?>manifest.json">

</head>

<body>

  <!-- loader -->
  <div id="loader">
    <div class="spinner-border text-primary" role="status"></div>
  </div>
  <!-- * loader -->

  <!-- App Header -->
  <div class="appHeader bg-primary text-light">
    <div class="left">
      <a href="#" class="headerButton goBack">
        <ion-icon name="chevron-back-outline"></ion-icon>
      </a>
    </div>
    <div class="pageTitle">Blank Page</div>
    <div class="right"></div>
  </div>
  <!-- * App Header -->

  <!-- App Capsule -->
  <div id="appCapsule" class="full-height">


    <div class="section full mt-2">
      <div class="section-title">Title</div>
      <div class="wide-block pt-2 pb-2">
        Great to start your projects from here.
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
        <span class="badge badge-danger">5</span>
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

  <!-- App Sidebar -->
  <div class="offcanvas offcanvas-start" tabindex="-1" id="sidebarPanel">
    <div class="offcanvas-body">
      <!-- profile box -->
      <div class="profileBox">
        <div class="image-wrapper">
          <img src="<?= base_url('assets/mobile') ?>/img/sample/avatar/avatar1.jpg" alt="image" class="imaged rounded">
        </div>
        <div class="in">
          <strong>Julian Gruber</strong>
          <div class="text-muted">
            <ion-icon name="location"></ion-icon>
            California
          </div>
        </div>
        <a href="#" class="close-sidebar-button" data-bs-dismiss="offcanvas">
          <ion-icon name="close"></ion-icon>
        </a>
      </div>
      <!-- * profile box -->

      <ul class="listview flush transparent no-line image-listview mt-2">
        <li>
          <a href="index.html" class="item">
            <div class="icon-box bg-primary">
              <ion-icon name="home-outline"></ion-icon>
            </div>
            <div class="in">
              Discover
            </div>
          </a>
        </li>
        <li>
          <a href="app-components.html" class="item">
            <div class="icon-box bg-primary">
              <ion-icon name="cube-outline"></ion-icon>
            </div>
            <div class="in">
              Components
            </div>
          </a>
        </li>
        <li>
          <a href="app-pages.html" class="item">
            <div class="icon-box bg-primary">
              <ion-icon name="layers-outline"></ion-icon>
            </div>
            <div class="in">
              <div>Pages</div>
            </div>
          </a>
        </li>
        <li>
          <a href="page-chat.html" class="item">
            <div class="icon-box bg-primary">
              <ion-icon name="chatbubble-ellipses-outline"></ion-icon>
            </div>
            <div class="in">
              <div>Chat</div>
              <span class="badge badge-danger">5</span>
            </div>
          </a>
        </li>
        <li>
          <div class="item">
            <div class="icon-box bg-primary">
              <ion-icon name="moon-outline"></ion-icon>
            </div>
            <div class="in">
              <div>Dark Mode</div>
              <div class="form-check form-switch">
                <input class="form-check-input dark-mode-switch" type="checkbox" id="darkmodesidebar">
                <label class="form-check-label" for="darkmodesidebar"></label>
              </div>
            </div>
          </div>
        </li>
      </ul>

      <div class="listview-title mt-2 mb-1">
        <span>Friends</span>
      </div>
      <ul class="listview image-listview flush transparent no-line">
        <li>
          <a href="page-chat.html" class="item">
            <img src="<?= base_url('assets/mobile') ?>/img/sample/avatar/avatar7.jpg" alt="image" class="image">
            <div class="in">
              <div>Sophie Asveld</div>
            </div>
          </a>
        </li>
        <li>
          <a href="page-chat.html" class="item">
            <img src="<?= base_url('assets/mobile') ?>/img/sample/avatar/avatar3.jpg" alt="image" class="image">
            <div class="in">
              <div>Sebastian Bennett</div>
              <span class="badge badge-danger">6</span>
            </div>
          </a>
        </li>
        <li>
          <a href="page-chat.html" class="item">
            <img src="<?= base_url('assets/mobile') ?>/img/sample/avatar/avatar10.jpg" alt="image" class="image">
            <div class="in">
              <div>Beth Murphy</div>
            </div>
          </a>
        </li>
        <li>
          <a href="page-chat.html" class="item">
            <img src="<?= base_url('assets/mobile') ?>/img/sample/avatar/avatar2.jpg" alt="image" class="image">
            <div class="in">
              <div>Amelia Cabal</div>
            </div>
          </a>
        </li>
        <li>
          <a href="page-chat.html" class="item">
            <img src="<?= base_url('assets/mobile') ?>/img/sample/avatar/avatar5.jpg" alt="image" class="image">
            <div class="in">
              <div>Henry Doe</div>
            </div>
          </a>
        </li>
      </ul>
    </div>
    <!-- sidebar buttons -->
    <div class="sidebar-buttons">
      <a href="#" class="button">
        <ion-icon name="person-outline"></ion-icon>
      </a>
      <a href="#" class="button">
        <ion-icon name="archive-outline"></ion-icon>
      </a>
      <a href="#" class="button">
        <ion-icon name="settings-outline"></ion-icon>
      </a>
      <a href="#" class="button">
        <ion-icon name="log-out-outline"></ion-icon>
      </a>
    </div>
    <!-- * sidebar buttons -->
  </div>
  <!-- * App Sidebar -->

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

</body>

</html>