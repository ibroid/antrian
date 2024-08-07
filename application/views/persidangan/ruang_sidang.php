<div class="container-fluid py-3">
  <?= $this->session->flashdata("flash_error") ?>
  <?= $this->session->flashdata("flash_alert") ?>
  <div class="row">
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
      <?= $this->load->component(
        "card/detail_perkara_diruang_sidang",
        [
          "data" => $dalam_persidangan,
          "nomor_ruang" => $nomor_ruang,
          "nama_ruang" => $nama_ruang
        ]
      ) ?>
    </div>
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
      <?= $this->load->component("card/control_panel_diruang_sidang", [
        "data" => $dalam_persidangan,
        "nomor_ruang" => $nomor_ruang,
        "nama_ruang" => $nama_ruang
      ]) ?>
    </div>
  </div>
  <div class="row mx-1">
    <?php foreach ($antrian->filter(function ($i) {
      return $i->priority == 1;
    })->all() as $a) { ?>
      <div class="alert alert-primary p-2 rounded" role="alert">
        <div class="d-flex justify-content-between align-self-center">
          <div class="left">
            <h5>Pemberitahuan</h5>
            <p>Ada antrian prioritas pada nomor : <?= $a->nomor_urutan ?> | Nomor Perkara : <?= $a->nomor_perkara ?></p>
          </div>
          <div class="right">
            <i style="font-size: 2rem;" class="fa fa-warning"></i>
          </div>
        </div>
      </div>
    <?php }  ?>
    <div class="card">
      <div class="card-body" id="card-body-antrian">
        <div class="text-center">
          <h4>Sedang Memuat Antrian ...</h4>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  let tableAntrianSidang

  window.addEventListener("load", () => {
    const pusher = new Pusher('a360f9f6cfefca4c383b', {
      cluster: 'ap1'
    });

    const channel = pusher.subscribe('antrian-channel');

    channel.bind('new-antrian', function(data) {
      fetchTableAntrian()
    });

    setTimeout(fetchTableAntrian, 1000)
  })

  function fetchTableAntrian() {
    $.ajax({
      url: "<?= base_url("ruangsidang/fetch_table_antrian") ?>",
      method: "POST",
      data: {
        nomor_ruang: "<?= $nomor_ruang ?>"
      },
      success: function(data) {
        $("#card-body-antrian").html(data)
        tableAntrianSidang = $("#table-antrian").DataTable({
          "aaSorting": [],
          "columnDefs": [{
            "targets": 0,
            "orderable": false
          }]
        })
      },
      error: function(err) {
        $("#card-body-antrian").html(`<div class=\"text-center\">${err.message ?? err.responseText}<h4></h4></div>`)
      },
    })
  }
</script>