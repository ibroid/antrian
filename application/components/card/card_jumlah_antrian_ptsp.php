<div class="card bg-transparent">
  <div class="card-header p-1">
    <h4 class="card-title bg-white text-center">SEDANG DI PANGGIL</h4>
  </div>
  <span id="sedang-di-panggil" style="font-size: 5rem" class="p-0 badge bg-white text-primary bg-opacity-50">000</span>
</div>
<div class="card bg-transparent">
  <div class="card-header p-1">
    <h4 class="card-title bg-white text-center">JUMLAH YANG SUDAH DIPANGGIL</h4>
  </div>
  <span id="sudah-dipanggil" style="font-size: 5rem" class="p-0 badge bg-white text-success bg-opacity-50"><?= $antrian_hari_ini->where("status", 1)->count() ?></span>
</div>
<div class="card bg-transparent">
  <div class="card-header p-1">
    <h4 class="card-title bg-white text-center">JUMLAH YANG BELUM DIPANGGIL</h4>
  </div>
  <span id="belum-dipanggil" style="font-size: 5rem" class="p-0 badge bg-white text-danger bg-opacity-50"><?= $antrian_hari_ini->where('status', 0)->count() ?></span>
</div>

<script>
  window.addEventListener("load", function() {
    "use strict"

    var pusher = new Pusher("<?= $_ENV['PUSHER_APP_KEY'] ?>", {
      cluster: 'ap1'
    });

    const antrianChannel = pusher.subscribe("antrian-channel");

    antrianChannel.bind('panggil-antrian-ptsp', function(data) {
      $("#sedang-di-panggil").text(data.antrian.kode + "-" + data.antrian.nomor_urutan)

      $.ajax({
        url: "<?= base_url('layar/jumlah_antrian_ptsp') ?>",
        headers: {
          "Accept": "application/json"
        },
        success(data) {
          const result = JSON.parse(data)
          console.log(result)

          $("#sudah-dipanggil").text(result.sudah_dipanggil)
          $("#belum-dipanggil").text(result.belum_dipanggil)
        },
        error(err) {
          console.log(err)
        }
      })
    });
  })
</script>