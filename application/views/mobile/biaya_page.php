<div class="header-large-title">
  <h1 class="title">Informasi Biaya</h1>
  <h4 class="subtitle">Selamat datang di Layanan Hitung Panjar!
  </h4>
</div>

<div class="section mt-2">
  <ol>
    <li>Panjar biaya perkara merupakan biaya yang dikeluarkan para pihak untuk mengajukan permohonan/gugatan berdasarkan penetapan Ketua <?= $this->sysconf->NamaPN ?>.</li>
    <li> Apabila biaya yang dibayarkan kurang, maka akan diminta penambahan. Sebaliknya, apabila biaya yang dibayarkan lebih, maka sisa uang akan dikembalikan setelah perkara selesai diputus.</li>
    <li>
      Untuk menggunakan layanan, silakan pilih jenis perkara dan masukkan domisili para pihak.
    </li>
  </ol>

  <p>Informasi dan panduan selengkapnya dapat diakses <a target="_blank" href="https://bit.ly/infohitungpanjar ">Disini</a></p>

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