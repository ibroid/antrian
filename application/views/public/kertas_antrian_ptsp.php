<style>
  #no-antrian {
    font-size: 4rem;
    padding: 0px;
  }
</style>
<div class="vstack gap-0 text-center">
  <h5><?= $this->sysconf->NamaPN ?></h5>
  <h6>Antrian Pelayanan <?= $data->jenis_pelayanan->nama_layanan ?></h6>
  <h1 id="no-antrian">
    <?= $data->kode . " " . $data->nomor_urutan ?>
  </h1>
  <h6>Diambil : <?= date('Y-m-d H:i:s') ?></h6>
</div>