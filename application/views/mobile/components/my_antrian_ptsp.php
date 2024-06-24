<div class="card my-2 bg-success">
  <div class="card-body bg-light text-center p-1">
    <div class="d-flex justify-content-evenly align-items-end">
      <div class="text">
        <h2 class="text-light shadow-sm ">Nomor Antrian Pelaynan Anda Saat Ini</h2>
        <h1 style="font-size: 5rem;"><?= $data->nomor_antrian ?></h1>
        <p class="m-0 p-0 shadow-sm ">Mohon untuk menjaga kertas antrian anda</p>
      </div>
      <img src="<?= base_url('static/vector/cs.png') ?>" alt="Customer Service" width="150" height="200">
    </div>
  </div>
</div>