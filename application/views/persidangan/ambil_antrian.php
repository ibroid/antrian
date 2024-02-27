<div class="row ">
  <div class="col-xl-12 p-0">
    <div class="login-card login-dark ">
      <div class="login-main" style="width: 1200px;">
        <?= $this->session->flashdata('flash_error') ?>
        <?= $this->session->flashdata('flash_alert') ?>
        <div class="text-end">
          <a href="<?= base_url('/menu') ?>" class="btn btn-secondary">Kembali</a>
        </div>
        <h4>Halaman Pengambilan Antrian Sidang. Silahkan Pilih Nama Anda</h4>
        <p>Pastikan anda sidang hari ini. Periksa kembali surat panggilan. Apabila tidak ada nama anda, Silahkan hubungi petugas.</p>

        <form action="<?= base_url('/ambil') ?>" style="width: 500px;" class="my-3" method="POST">
          <h6>Cari Berdasarkan Tanggal</h6>
          <div class="input-group mt-2">
            <input class="form-control date-picker" type="text" name="tanggal_sidang" required="Harap Isi Bidang ini">
            <button class="btn btn-outline-warning" id="button-addon2" type="submit">Cari</button>
            <a href="<?= base_url('/ambil') ?>" class="btn btn-outline-danger" id="button-addon3" type="reset">Reset</a>
          </div>
        </form>

        <table class="table table-responsive table-hover table-bordered" id="table-sidang">
          <thead>
            <tr>
              <th>No</th>
              <th>Pekara</th>
              <th>Pihak P </th>
              <th>Kuasa P</th>
              <th>Pihak T </th>
              <th>Kuasa T</th>
              <th>Ruangan</th>
              <th>Majelis</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($daftar_sidang as $n => $ds) { ?>
              <tr onclick="handleRowClick(<?= $ds->id ?>)">
                <td><?= ++$n ?></td>
                <td><?= $ds->perkara->nomor_perkara ?><br><?= $ds->perkara->jenis_perkara_nama ?></td>
                <td>
                  <?= $ds->perkara->pihak_satu[0]->nama ?>
                </td>
                <td>
                  <?php if (count($ds->perkara->pengacara_satu) > 0) {
                    echo  $ds->perkara->pengacara_satu[0]->nama;
                  } ?>
                </td>
                <td>
                  <?php if (count($ds->perkara->pihak_dua) !== 0) {
                    echo  $ds->perkara->pihak_dua[0]->nama;
                  }  ?>
                </td>
                <td>
                  <?php if (count($ds->perkara->pengacara_dua) > 0) {
                    echo  $ds->perkara->pengacara_dua[0]->nama;
                  } ?>
                </td>
                <td><?= $ds->ruangan ?><br><?= str_replace("Panitera Pengganti:", "", $ds->perkara->penetapan->panitera_pengganti_text)  ?></td>
                <td><?= $ds->perkara->penetapan->majelis_hakim_nama ?></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>

      </div>
    </div>
    <p class=" text-center">Crafted By<a class="ms-2" target="_blank" href="https://mmaliki.my.id">Mmaliki</a></p>
  </div>
</div>


<!-- Modal Body -->
<!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
<div class="modal fade" id="checkInModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTitleId">
          Konfirmasi Kehadiran Pihak
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="checkInModal-body">
        <div class="text-center">
          <h4>Mohon Tunggu ...</h4>
        </div>
      </div>
    </div>
  </div>
</div>


<script>
  let checkInModal;
  window.addEventListener("load", function() {
    $(".date-picker").flatpickr();
    $("#table-sidang").DataTable({
      "language": {
        "search": "Cari Disini :",
      },
      "pageLength": 50
    });

    checkInModal = new bootstrap.Modal(
      document.getElementById("checkInModal"),
    );
  })

  document.getElementById("checkInModal").addEventListener("hide.bs.modal", () => {
    $("#checkInModal-body").html(" <div class=\"text-center\"><h4>Mohon Tunggu ...</h4></div>")
  })

  const handleRowClick = (sidang_id) => {
    checkInModal.show()
    $.ajax({
      url: "<?= base_url("ambil/fetch_table_checkin") ?>",
      method: "POST",
      data: {
        sidang_id: sidang_id
      },
      success(html) {
        $("#checkInModal-body").html(html)
      },
      error(err) {
        $("#checkInModal-body").html(err.responseText && err.message)
      }
    })
  }

  const disableAfterSubmit = (e) => {
    Swal.fire({
      title: "Loading...",
      text: "Please wait",
      showConfirmButton: false,
      allowOutsideClick: false,
      backdrop: true,
      willOpen: () => Swal.showLoading()
    })
  }
</script>