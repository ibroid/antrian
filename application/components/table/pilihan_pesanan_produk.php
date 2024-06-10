<div class="btn-group">
  <button class="btn btn-dark btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
    <i class="fa fa-bars"></i>
  </button>
  <ul class="dropdown-menu dropdown-block">
    <li><a class="dropdown-item btn-kelap-kelip" href="<?= base_url('/pelayanan_produk/edit/' . Cypher::urlsafe_encrypt($data->id)) ?>">Lengkapi Data</a></li>
    <li>
      <form method="POST" action="<?= base_url('/pelayanan_produk/panggil_pihak') ?>">
        <button name="pihak" value="<?= $data->nama_pengambil ?>" class="dropdown-item" href="#">Panggil Pihak</button>
      </form>
    </li>
    <li><a data-id="<?= Cypher::urlsafe_encrypt($data->id) ?>" class="dropdown-item btn-sinkron-ac" href="#">Sinkron Ke SIPP</a></li>
  </ul>
</div>