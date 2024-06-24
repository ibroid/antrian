<div class="card my-2 bg-dark">
  <div class="card-body bg-light text-center p-1">
    <div class="d-flex justify-content-evenly align-items-end">
      <img src="<?= base_url('static/vector/hakim.png') ?>" alt="Customer Service" width="170" height="200">
      <div class="text">
        <h2 class="text-light shadow-sm ">Nomor Antrian Persidangan Anda Saat Ini</h2>
        <h1 style="font-size: 5rem;"><?= $data->nomor_urutan ?></h1>
        <p class="m-0 p-0 shadow-sm ">Anda akan bersidang di ruang <?= $data->nama_ruang ?></p>
      </div>
    </div>
  </div>
</div>