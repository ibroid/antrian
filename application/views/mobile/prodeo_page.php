<div class="header-large-title">
  <h1 class="title">Informasi Prodeo</h1>
  <h4 class="subtitle">Dapatkan kuota prodeo untuk mendaftar perkara gratis tanpa biaya</h4>
</div>

<div class="section">
  <div id="cartProdeo"></div>
</div>

<div class="section mt-2">
  <div class="row">
    <?php foreach ($info->items as $i) { ?>
      <div class="col-6">
        <div class="card p-0 <?= $color[$i->peruntukan] ?>">
          <div class="card-body p-2">
            <div class="text-center">
              <h4 class="text-white">Kuota <?= $i->peruntukan ?></h4>
              <h1 id="total_kuota" class="text-white" style="font-size: 3rem;"><?= $i->jumlah ?></h1>
            </div>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>
</div>

<div class="section mt-2">
  <div class="row">
    <?php foreach ($info->items as $i) { ?>
      <div class="col-6">
        <div class="card p-0 <?= $color[$i->peruntukan] ?>">
          <div class="card-body p-2">
            <div class="text-center">
              <h4 class="text-white">Kuota <?= $i->peruntukan ?> Terpakai</h4>
              <h1 id="total_kuota" class="text-white" style="font-size: 3rem;">
                <?= $kuota[$i->peruntukan]->total  ?>
              </h1>
            </div>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>
</div>

<div class="section mt-2">
  <div class="row">
    <?php foreach ($info->items as $i) { ?>
      <div class="col-6">
        <div class="card p-0 <?= $color[$i->peruntukan] ?>">
          <div class="card-body p-2">
            <div class="text-center">
              <h4 class="text-white">Kuota <?= $i->peruntukan ?> Sisa</h4>
              <h1 id="total_kuota" class="text-white" style="font-size: 3rem;">
                <?= $i->jumlah - $kuota[$i->peruntukan]->total  ?>
              </h1>
            </div>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>
</div>

<div class="section mt-2">
  <div class="card">
    <div class="card-body">
      <div class="card-title">Persyaratan Pengajuan Prodeo</div>
      <div class="card-text mt-3">
        <ol>
          <li>Ber KTP di Jakarta Utara</li>
          <li>Masyarakat tidak mampu</li>
          <li>Membawa Surat Keterangan Tidak Mampu (SKTM) dari kelurahan.</li>
        </ol>
      </div>
    </div>
  </div>
</div>

<script>
  // function chartProdeoInit() {
  //   const options = {
  //     series: [<?= $total_pengguna_prodeo ?>, <?= $total_kuota_prodeo - $total_pengguna_prodeo ?>],
  //     chart: {
  //       width: 380,
  //       type: 'pie',
  //     },
  //     labels: ['Terpakai', 'Kosong'],
  //     legend: {
  //       position: 'bottom'
  //     },
  //     responsive: [{
  //       breakpoint: undefined,
  //       options: {
  //         chart: {
  //           width: 120
  //         },
  //         legend: {
  //           position: 'bottom'
  //         }
  //       }
  //     }]
  //   };

  //   const chart = new ApexCharts(document.querySelector("#cartProdeo"), options);
  //   chart.render();
  // }


  // chartProdeoInit()
</script>