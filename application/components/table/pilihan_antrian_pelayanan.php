<div class="d-flex gap-4">
  <p>
    <?= $data->status == 1 ? "Sudah Dipanggil" : "Masih Menunggu" ?>
  </p>
  <div class="btn-group">
    <a href="javascript:void(0)" class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
      <i class="fa fa-bars"></i>
    </a>
    <ul class="dropdown-menu dropdown-block">
      <li><a class="dropdown-item" href="#">Isi Data</a></li>
      <li><a class="dropdown-item" href="#">Akhiri</a></li>
      <li><a class="dropdown-item" href="#">Detail</a></li>
    </ul>
  </div>
</div>