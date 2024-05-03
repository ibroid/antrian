<div class="p-4 mb-3 bg-primary" id="card-antrian-saat-ini">
  <div class="card-body">
    <h4 class="card-title">Nomor Saat Ini</h4>
    <h1 class="card-text"><?= $data->nomor_antrian ?></h1>
    <p>--------</p>
    <div class="text-center">
      <p>Durasi Pelayanan : <a class="text-light" href="javascript:void(0)" data-bs-title="Menghitung durasi pelayanan." data-bs-toggle="tooltip" data-bs-placement="bottom" id="timer">00:00:00</a></p>
      <script>
        let startTime = new Date().getTime();
        let x = setInterval(function() {
          let now = new Date().getTime();
          let distance = now - startTime;
          let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
          let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
          let seconds = Math.floor((distance % (1000 * 60)) / 1000);
          document.getElementById("timer").innerHTML = ("0" + hours).slice(-2) + ":" +
            ("0" + minutes).slice(-2) + ":" +
            ("0" + seconds).slice(-2);
        }, 1000);
      </script>
    </div>
    <div class="text-center">
      <p>Jenis Pelayanan : <a class="text-light" href="javascript:void(0)" data-bs-title="Jenis pelayanan yang dipanggil." data-bs-toggle="tooltip" data-bs-placement="bottom" id="layanan">-</a></p>
    </div>
    <button class="btn btn-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-html="true" data-bs-title="<strong>Memindahkan antrian ini ke antrian lain seperti ke antrian posbakum atau ke antrian produk.</strong>">Pindahkan <i class="fa fa-share"></i></button>
    <button class="btn btn-success" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-html="true" data-bs-title="<strong>Mengisi data pelayanan dari nomor antrian.</strong>">Isi Data <i class="fa fa-plus"></i></button>
  </div>
</div>