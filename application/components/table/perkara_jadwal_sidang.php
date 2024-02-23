<div class="notification main-timeline">
  <div class="card height-equal">
    <div class="card-header">
      <h4>Jadwal Sidang </h4>
    </div>
    <div class="card-body dark-timeline">
      <ul>
        <?php foreach ($data as $d2) { ?>
          <li class="d-flex">
            <div class="timeline-dot-primary"></div>
            <div class="w-100 ms-3">
              <p class="d-flex justify-content-between mb-2">
                <span class="date-content light-background"><?= tanggal_indo($d2->tanggal_sidang)  ?></span>
                <span>9:00 AM </span>
              </p>
              <h6><?= $d2->agenda ?><span class="dot-notification"></span></h6>
              <p class="f-light">Tunda : <?= $d2->alasan_ditunda ?></p>
            </div>
          </li>
        <?php } ?>
      </ul>
    </div>
  </div>
</div>