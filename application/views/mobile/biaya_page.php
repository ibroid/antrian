<div class="header-large-title">
  <h1 class="title">Informasi Biaya</h1>
  <h4 class="subtitle">Silahkan Lihat biaya pendaftaran dibawah ini</h4>
</div>

<div class="section mt-2">
  <ol>
    <li>Panjar biaya perkara adalah biaya yang dikeluarkan para pihak untuk mengajukan permohonan/gugatan berdasarkan penetapan Ketua Pengadilan Agama Jakarta Utara.</li>
    <li> Biaya tersebut merupakan panjar, yang mana apabila biaya yang dibayarkan kurang maka akan diminta penambahan. Sebaliknya, apabila biaya yang dibayarkan lebih, maka sisa uang akan dikembalikan pada saat perkara sudah selesai diputus</li>
  </ol>

  <?php foreach ($data->items as $k => $d) { ?>
    <?php if (isset($d->expand)) { ?>
      <div class="card my-2">
        <div class="card-body">
          <div class="card-title">
            <h4>Biaya <?= $d->nama_perkara ?></h4>
          </div>
          <div class="card-text">
            <a class="btn btn-outline-primary" hx-get="<?= base_url("mobile/biaya/pilih_radius/$d->id") ?>" hx-target="#appCapsule">Selengkapnya</a>
          </div>
        </div>
      </div>
    <?php } ?>
  <?php } ?>
</div>