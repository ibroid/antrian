<div class="container-fluid py-3">
  <div class="card">
    <div class="card-body">
      <div class="text-center">
        <button onclick="location.reload()" class="btn btn-warning">
          <i class="fa fa-refresh"></i>
          Refresh
        </button>
      </div>
      <table class="table table-hover table-responsive" id="table-psp">
        <thead>
          <tr>
            <th>No</th>
            <th>Nomor Perkara</th>
            <th>Para Pihak</th>
            <th>Panitera Pengganti</th>
            <th>Majelis Hakim</th>
            <th>PSP</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($perkara_putus_hari_ini as $n => $ph) { ?>
            <tr>
              <td><?= ++$n ?></td>
              <td><?= $ph->perkara->nomor_perkara ?></td>
              <td><?= $ph->perkara->para_pihak ?></td>
              <td><?= $ph->perkara->penetapan->panitera_pengganti_text ?></td>
              <td><?= $ph->perkara->penetapan->majelis_hakim_text ?></td>
              <td>
                <button data-bs-toggle="modal" data-perkara-id="<?= $ph->perkara_id ?>" data-bs-target="#modalPsp" class="btn btn-success btn-cetak-psp">Cetak <i class="fa fa-print"></i></button>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<div class="modal fade" id="modalPsp" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTitleId">
          Rincian Biaya Panjars
        </h5>
        <div class="alert alert-secondary dark" role="alert">
          <p>Apabila sisa panjar belum sesuai, Silahkan periksa di SIPP</p>
        </div>
      </div>
      <div class="modal-body">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
          Tutup
        </button>
      </div>
    </div>
  </div>
</div>

<script>
  window.addEventListener("load", function() {
    $("#table-psp").DataTable({
      "language": {
        "search": "Cari Disini :",
      },
      "pageLength": 10
    });

    $(".btn-cetak-psp").on("click", function() {
      const perkara_id = $(this).data("perkara-id");

      $.ajax({
        url: "<?= base_url("informasi/perkara_biaya_w_view") ?>/" + perkara_id,
        success: function(data) {
          $("#modalPsp .modal-body").append(data);
        },
        error: function(err) {
          $("#modalPsp .modal-body").html("<tr><td colspan='4'>Terjadi Kesalahan. Error : " + err.message && err.responseText + ". Silahkan tutup jendela dan klik cetak kembali</td></tr>");
        }
      })

      $.ajax({
        url: "<?= base_url("kasir/form_skum") ?>/" + perkara_id,
        success: function(data) {
          $("#modalPsp .modal-body").prepend(data);
        },
        error: function(err) {
          $("#modalPsp .modal-body").append("<tr><td colspan='4'>Terjadi Kesalahan. Error : " + err.message && err.responseText + ". Silahkan tutup jendela dan klik cetak kembali</td></tr>");
        }
      })
    })

    $("#modalPsp").on("hidden.bs.modal", function() {
      $("#modalPsp .modal-body").html("");
    })
  })
</script>