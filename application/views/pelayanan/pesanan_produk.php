<div class="container-fluid py-3">
  <div class="row">
    <?= $this->session->flashdata('flash_alert') ?>
    <?= $this->session->flashdata('flash_error') ?>
    <div class="alert alert-info">
      <h6>Data pesanan produk sudah otomatis terisi oleh sistem. Silahkan <strong> lengkapi data saja tanpa membuat data baru</strong>. Apabila data pesanan tidak ada, silahkan buat data baru.</h6>
    </div>
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <div class="card-title d-flex justify-content-between mb-5">
            <h4 class="card-title">Pesanan Produk Pengadilan</h4>
            <a href="<?= base_url('pelayanan_produk/tambah') ?>" class="btn btn-primary ">Tambah Pengambilan Produk</a>
          </div>
          <table class="table table-hovered table" id="table-produk">
            <thead>
              <tr>
                <th>No</th>
                <th>Nomor Perkara</th>
                <th>Nomor Akta</th>
                <th>Nama Pengambil</th>
                <th>Jenis Produk</th>
                <th>Jenis Perkara</th>
                <th>Aksi</th>
              </tr>
            </thead>

          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  window.addEventListener("load", function() {
    const datatable = $("#table-produk").DataTable({
      "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
      },
      "processing": true,
      "serverSide": true,
      "order": [],
      "ajax": {
        //panggil method ajax list dengan ajax
        "url": '<?= base_url('pelayanan_produk/datatable_pesanan_produk'); ?>',
        "type": "POST"
      },
      drawCallback: btnlengkapiDataKelapKelip
    })

    const pusher = new Pusher("<?= $_ENV['PUSHER_APP_KEY'] ?>", {
      cluster: 'ap1'
    });

    const produkChannel = pusher.subscribe('produk-channel');

    produkChannel.bind("saved-produk", (data) => {
      datatable.ajax.reload()
    })


    Swal.fire({
      icon: "warning",
      title: "Perhatian",
      text: "Data pesanan produk sudah otomatis terisi. Silahkan lengkapi data tanpa membuat data baru. Apabila pesanan tidak ada, silahkan tambah baru.",
      allowOutsideClick: false,
      timer: 10000,
      showConfirmButton: false,
      timerProgressBar: true
    })

  })

  function btnlengkapiDataKelapKelip() {
    $(".btn-kelap-kelip").each((i, e) => {
      let cls = "btn-secondary";
      setInterval(() => {
        cls = cls === "btn-secondary" ? "btn-warning" : "btn-secondary";
        e.classList.remove("btn-secondary", "btn-warning");
        e.classList.add(cls);
      }, 500);
    })


    $(".btn-sinkron-ac").each((i, e) => {
      const theButton = $(e)
      theButton.on("click", () => {
        console.log(theButton)
      })
    })
  }
</script>