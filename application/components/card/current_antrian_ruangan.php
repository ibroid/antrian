<div class="card text-center p-4 ">
  <div class="text-header">
    <h1 class="text-kelap-kelip text-danger"> ANTRIAN SAAT INI DIPANGGIL</h1>
  </div>
  <div class="card-body p-0">
    <h1 class="text-kelap-kelip" id="sedang-di-panggil" style="font-size: 10.7rem;"><?= R_Input::pos("nomor_urutan") ?></h1>
    <h5 style="font-size: 2.7rem;"><?= R_Input::pos("nomor_perkara") ?></h5>
    <h1 id="loket-tujuan" class="text-kelap-kelip" style="font-size: 5.7rem;">Ruang Sidang <?= R_Input::pos("nama_ruang") ?></h1>
  </div>
</div>