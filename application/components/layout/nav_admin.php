<nav class="sidebar-main">
  <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
  <div id="sidebar-menu">
    <ul class="sidebar-links" id="simple-bar">
      <li class="back-btn">
        <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
      </li>
      <li class="pin-title sidebar-main-title">
        <div>
          <h6>Pinned</h6>
        </div>
      </li>
      <li class="sidebar-list">
        <i class="fa fa-thumb-tack"></i>
        <a class="sidebar-link sidebar-title" href="<?= base_url('/pelayanan') ?>">
          <svg class="stroke-icon">
            <use href="<?= base_url() ?>assets/svg/icon-sprite.svg#stroke-home"></use>
          </svg>
          <svg class="fill-icon">
            <use href="<?= base_url() ?>assets/svg/icon-sprite.svg#fill-home"></use>
          </svg>
          <span>Dashboard</span>
        </a>
      </li>
      <li class="sidebar-list">
        <i class="fa fa-thumb-tack"></i>
        <a class="sidebar-link sidebar-title" href="<?= base_url('/pengguna') ?>">
          <svg class="stroke-icon">
            <use href="<?= base_url() ?>assets/svg/icon-sprite.svg#stroke-project"></use>
          </svg>
          <span>Pengguna</span>
        </a>
      </li>
      <li class="sidebar-list">
        <i class="fa fa-thumb-tack"></i>
        <a class="sidebar-link sidebar-title" href="<?= base_url('/loket') ?>">
          <svg class="stroke-icon">
            <use href="<?= base_url() ?>assets/svg/icon-sprite.svg#stroke-home"></use>
          </svg>
          <span>Loket</span>
        </a>
      </li>
    </ul>
  </div>
  <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
</nav>