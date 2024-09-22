<div class="section full mt-2">
    <div class="section-title"><?= $timeline['nomor_perkara'] ?></div>
    <div class="content-header mb-05">Berikut adalah riwayat proses perkara anda</div>
    <div class="wide-block">
        <!-- timeline -->
        <div class="timeline timed">
            <?php foreach ($timeline['data'] as $n => $t) { ?>
                <div class="item">
                    <span class="time"><?= $t->tanggal ?></span>
                    <div class="dot <?= $t->color ?>"></div>
                    <div class="content">
                        <h4 class="title"><?= $t->judul ?></h4>
                        <div class="text"><?= $t->isi ?></div>
                        <small class="text-muted"><?= $t->keterangan ?></small>
                    </div>
                </div>
            <?php } ?>
        </div>
        <!-- * timeline -->
    </div>

</div>