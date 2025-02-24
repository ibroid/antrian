<style>
  #no-antrian {
    font-size: 4rem;
    padding: 0px;
  }
</style>
<div class="vstack gap-0 text-center">
  <h5><?= $this->sysconf->NamaPN ?></h5>
  <h6>Antrian Persidangan <br> Ruang Sidang : <?= $data->nama_ruang ?></h6>
  <h1 id="no-antrian">
    <?= $data->nomor_urutan ?>
  </h1>
  <h6>Nomor Perkara <?= $data->nomor_perkara ?><br> Waktu Ambil : <?= date('Y-m-d H:i:s') ?></h6>
</div>