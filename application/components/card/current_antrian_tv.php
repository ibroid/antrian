<div class="card text-center p-4 ">
  <div class="text-header">
    <h1 class="text-kelap-kelip text-danger"> ANTRIAN SAAT INI DIPANGGIL</h1>
  </div>
  <div class="card-body p-0">
    <h1 class="text-kelap-kelip" id="sedang-di-panggil" style="font-size: 12.7rem;">A-287</h1>
    <h5 style="font-size: 2.7rem;">DI Panggil Ke Loket</h5>
    <h1 id="loket-tujuan" class="text-kelap-kelip" style="font-size: 5.7rem;">Customer Service 4</h1>
  </div>
</div>

<script>
  "use strict"

  var pusher = new Pusher("<?= $_ENV['PUSHER_APP_KEY'] ?>", {
    cluster: 'ap1'
  });

  const antrianChannel = pusher.subscribe("antrian-channel");

  antrianChannel.bind('panggil-antrian-ptsp', function(data) {
    $("#sedang-di-panggil").text(data.antrian.kode + "-" + data.antrian.nomor_urutan)
    $("#loket-tujuan").text(data.nama_loket)

    $.ajax({
      url: "<?= base_url('layar/jumlah_antrian_ptsp') ?>",
      headers: {
        "Accept": "application/json"
      },
      success(data) {
        const result = JSON.parse(data)
        console.log(result)

        // $("#sudah-dipanggil").text(result.sudah_dipanggil)
        // $("#belum-dipanggil").text(result.belum_dipanggil)
      },
      error(err) {
        console.log(err)
      }
    })
  });

  btnlengkapiDataKelapKelip()

  function btnlengkapiDataKelapKelip() {
    $(".text-kelap-kelip").each((i, e) => {
      let cls = "text-danger";
      setInterval(() => {
        cls = cls === "text-danger" ? "text-warning" : "text-danger";
        e.classList.remove("text-danger", "text-warning");
        e.classList.add(cls);
      }, 500);
    })
  }
</script>