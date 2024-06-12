<link href="https://vjs.zencdn.net/8.10.0/video-js.css" rel="stylesheet" />
<script src="https://vjs.zencdn.net/8.10.0/video.min.js"></script>

<div class="text-center">
  <h6>Sedang Maintenance 😇.</h6>
</div>
<hr>
<!-- <div class="text-center">
  <h6>Demi menghemat bandwith dan resource. Dimohon untuk memutar CCTV yang diperlukan saja 😉. Tidak disarankan memutar semua nya 😇.</h6>
</div>
<hr> -->
<?php foreach ($data["payload"] as $n => $c) { ?>
  <!-- <p class="text-center"><?= $c["name"] ?></p>
  <video class="video-js" controls preload="auto" width="280" data-setup="{}">
    <source src="https://192.168.0.202:8143/stream/<?= $n ?>/channel/0/hlsll/live/index.m3u8">
  </video>
  <hr> -->
<?php } ?>