<ul class="listview image-listview flush mb-2">
  <?php foreach ($data as $d) { ?>
    <li>
      <?php if ($d->action == "none") { ?>
        <div class="item">
          <img src="<?= base_url('assets/mobile/favicon_io/android-chrome-192x192.png') ?>" alt="image" class="image">
          <div class="in">
            <div class="d-flex flex-column">
              <div><?= $d->title ?></div>
              <div class="text-muted"><?= $d->body ?></div>
            </div>
          </div>
        </div>
      <?php } else { ?>
        <a href="javascript:void(0)" <?= $d->action_param ?> class="item">
          <img src="<?= base_url('assets/mobile/favicon_io/android-chrome-192x192.png') ?>" alt="image" class="image">
          <div class="in">
            <div class="d-flex flex-column">
              <div><?= $d->title ?></div>
              <div class="text-muted"><?= $d->body ?></div>
            </div>
          </div>
        </a>

      <?php } ?>
    </li>
  <?php } ?>
</ul>