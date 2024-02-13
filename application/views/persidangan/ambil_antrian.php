<div class="row">
  <div class="col-xl-12 p-0">
    <div class="login-card login-dark">
      <div class="login-main" style="width: max-content;">
        <?= $this->session->flashdata('flash_error') ?>
        <h4>Halaman Pengambilan Antrian Sidang. Silahkan Pilih Nama Anda</h4>
        <p>Pastikan anda sidang hari ini. Periksa kembali surat panggilan. Apabila tidak ada nama anda, Silahkan hubungi petugas.</p>

        <form action="<?= base_url('/ambil') ?>" style="width: 500px;" class="my-3" method="POST">
          <h6>Cari Berdasarkan Tanggal</h6>
          <div class="input-group mt-2">
            <input class="form-control date-picker" type="text" name="tanggal_sidang" required="Harap Isi Bidang ini">
            <button class="btn btn-outline-warning" id="button-addon2" type="submit">Submit</button>
            <a href="<?= base_url('/ambil') ?>" class="btn btn-outline-danger" id="button-addon3" type="reset">Reset</a>
          </div>
        </form>

        <table class="table table-responsive table-hover table-bordered" id="table-sidang">
          <thead>
            <tr>
              <th>No</th>
              <th>Pekara</th>
              <th>Pihak P </th>
              <th>Pihak T </th>
              <th>Kuasa </th>
              <th>Ruangan</th>
              <th>Majelis</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($daftar_sidang as $n => $ds) { ?>
              <tr onclick="handleRowClick(<?= $ds->perkara_id ?>)">
                <td><?= ++$n ?></td>
                <td><?= $ds->perkara->nomor_perkara ?><br><?= $ds->perkara->jenis_perkara_nama ?></td>
                <td>
                  <form action="<?= base_url('/ambil') ?>" style="width: 500px;" class="my-3" method="POST">
                    <input type="hidden" name="perkara_id" value="<?= $ds->perkara_id ?>">
                    <input type="hidden" name="nomor_ruang" value="<?= $ds->ruangan_id ?>">
                    <input type="hidden" name="nama_ruang" value="<?= $ds->ruangan ?>">
                    <input type="hidden" name="nomor_perkara" value="<?= $ds->perkara->nomor_perkara ?>">
                    <input type="hidden" name="pihak_satu" value="<?= $ds->perkara->nomor_perkara ?>">
                    <input type="hidden" name="pihak_dua" value="<?= $ds->perkara->nomor_perkara ?>">
                    <button class="btn btn-outline-success"><?= $ds->perkara->pihak_satu[0]->nama ?></button>
                  </form>
                <td> <?= count($ds->perkara->pihak_dua) == 0 ? null : $ds->perkara->pihak_dua[0]->nama  ?></td>
                <td> <?= count($ds->perkara->pengacara) == 0 ? null : $ds->perkara->pengacara[0]->nama ?></td>
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
    $("#table-sidang").DataTable();

    checkInModal = new bootstrap.Modal(
      document.getElementById("checkInModal"),
    );
  })

  const handleRowClick = (perkara_id) => {
    Swal.fire()
  }
</script>