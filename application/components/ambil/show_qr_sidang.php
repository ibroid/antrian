 <div class="text-center">
   <h4>Silahkan Scan QR Code di bawah ini untuk mendapatkan nomor antrian sidang</h4>
 </div>
 <div class="text-center">
   <h4>Nomor Antrian: <?= $data->nomor_urutan ?></h4>
   <h4>Ruang Sidang: <?= $data->nama_ruang ?></h4>
   <img src="<?= $qr_code ?>" alt="QR Code">
 </div>