<?php
if (isset($data)) { ?>
  <div class="card crypto-main-card">
    <div class="card-body">
      <div class="deposit-wrap gap-3">
        <h3><?= $data->antrian_persidangan->nomor_perkara ?></h3>
        <p>Perkara yang sedang disidangkan saat ini</p>
        <p><?= $data->antrian_persidangan->perkara->jenis_perkara_nama ?></p>
        <button class="btn btn-white btn-data-perkara" data-url="<?= base_url("/informasi/perkara_data_umum_w_view/" . $data->antrian_persidangan->perkara->perkara_id) ?>">Data Umum</button>
        <button class="btn btn-white btn-data-perkara" data-url="<?= base_url("/informasi/perkara_jadwal_sidang_w_view/" . $data->antrian_persidangan->perkara->perkara_id) ?>">Jadwal Sidang</button>
        <button class="btn btn-white btn-data-perkara" data-url="<?= base_url("/informasi/perkara_biaya_w_view/" . $data->antrian_persidangan->perkara->perkara_id) ?>">Biaya Perkara</button>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modal-data-sipp" tabindex="-1" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-body" id="modal-data-sipp">
          <div class="text-center">
            <h4>Mohon Tunggu ...</h4>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    let modalDataSipp;

    window.addEventListener("load", () => {
      modalDataSipp = new bootstrap.Modal(document.getElementById("modal-data-sipp"))

      $(".btn-data-perkara").click(function() {
        let url = $(this).data("url")
        $.ajax({
          url: url,
          success: function(data) {
            $("#modal-data-sipp .modal-body").html(data)
          },
          error: function(xhr, status, error) {
            $("#modal-data-sipp .modal-body").html(`<div class=\"text-center\"><h4>${xhr.responseText ?? error}</h4></div>`)
          },
          complete: function() {
            modalDataSipp.show()
          }
        })
      })

    })

    document.getElementById("modal-data-sipp").addEventListener("hide.bs.modal", () => {
      $("#modal-data-sipp .modal-body").html(" <div class=\"text-center\"><h4>Mohon Tunggu ...</h4></div>")
    })
  </script>

<?php } else { ?>
  <div class="card crypto-main-card">
    <div class="card-body">
      <div class="deposit-wrap gap-3">
        <h3>Belum Ada Yang Di Panggil</h3>
        <p>Silahkan pilih perkara di antrian bawah lalu klik <strong>Masukan ke ruang sidang</strong></p>
      </div>
    </div>
  </div>
<?php } ?>