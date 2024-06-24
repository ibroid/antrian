 <!-- App Header -->
 <div class="appHeader bg-primary scrolled">
   <div class="pageTitle">
     <?= $page_title ?? "Beranda" ?>
   </div>
   <div class="left">
     <a data-bs-toggle="modal" data-bs-target="#dialog-info" href="javascript:void(0)" class="headerButton">
       <ion-icon name="information-circle-outline"></ion-icon>
     </a>
   </div>
   <div class="right">
     <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#modal-notifikasi" class="headerButton">
       <ion-icon hx-get="<?= base_url('mobile/notif') ?>" hx-trigger="every 3s" name="notifications-outline" hx-target="next"></ion-icon>
       <span class="badge badge-danger"></span>
     </a>
     <a href="javascript:void(0)" class="headerButton" onclick="installApp()">
       <ion-icon color="success" name="download-outline"></ion-icon>
     </a>
   </div>
 </div>

 <div class="modal fade modalbox" id="modal-notifikasi" data-bs-backdrop="static" tabindex="-1" role="dialog">
   <div class="modal-dialog" role="document">
     <div class="modal-content">
       <div class="modal-header bg-primary">
         <h5 class="modal-title text-light">Pemberitahuan</h5>
         <a href="#" class="text-light" data-bs-dismiss="modal">Tutup</a>
       </div>
       <div class="modal-body p-0" hx-get="<?= base_url("mobile/notif/list") ?>" hx-trigger="intersect">
         <div class="text-center">
           <h3>Mohon Tunggu</h3>
         </div>
       </div>
     </div>
   </div>
 </div>

 <div class="modal fade dialogbox" id="dialog-info" data-bs-backdrop="static" tabindex="-1" role="dialog">
   <div class="modal-dialog" role="document">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title">Deskripsi</h5>
       </div>
       <div class="modal-body">
         Aplikasi Smart Portal Paju versi Web PWA
         <p hx-get="<?= base_url("mobile/visitor") ?>" hx-trigger="intersect">Visitor hari ini : 0</p>
         Nomor Pengunjung : <p id="visitor_number"></p>
       </div>
       <div class="modal-footer">
         <div class="btn-inline">
           <a href="#" class="btn btn-text-secondary" data-bs-dismiss="modal">Tutup</a>
         </div>
       </div>
     </div>
   </div>
 </div>
 <!-- * App Header -->