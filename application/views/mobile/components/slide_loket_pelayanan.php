<ul class="listview image-listview media mt-1">
  <?php foreach ($loket_pelayanan as $l) { ?>
    <li>
      <a href="javascript:void(0)" class="item" data-bs-toggle="modal" data-bs-target="#modalDetailListAntrianPtsp" hx-get="<?= base_url("mobile/beranda/detail_list_antrian_ptsp?kode=" . $l->kode_loket) ?>" hx-trigger="click" hx-target="div#modalDetailListAntrianPtsp > div.modal-dialog > div.modal-content > div.modal-body">
        <div class="py-1 px-3 bg-<?= $l->warna_loket == "secondary" ? "danger" : $l->warna_loket ?> rounded rounded-50 me-2">
          <h3 class="text-center text-white"><?= $l->antrian->nomor_antrian ?? "R-00" ?></h3>
        </div>
        <div class="in">
          <div>
            <?= $l->antrian->tujuan ?? "Sedang Tidak Melayani" ?>
            <div class="text-muted"><?= $l->nama_loket ?></div>
          </div>
        </div>
      </a>
    </li>
  <?php } ?>
</ul>

<!-- Modal Listview -->
<div class="modal fade modalbox" id="modalDetailListAntrianPtsp" data-bs-backdrop="static" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Detail Antrian Pelayanan</h5>
        <a href="#" data-bs-dismiss="modal">Tutup</a>
      </div>
      <div class="modal-body p-0">
      </div>
    </div>
  </div>
</div>
<!-- * Modal Listview -->