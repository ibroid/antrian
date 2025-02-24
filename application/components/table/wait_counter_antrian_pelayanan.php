<?php $id = Cypher::urlsafe_encrypt($data->id); ?>
<p id="wait_counter<?= $id ?>">HH:MM:SS</p>
<script>
  (() => {
    let startTime = new Date().getTime();
    let created = new Date("<?= $data->created_at ?>").getTime()
    let x = setInterval(function() {
      let now = new Date().getTime();
      let distance = now - created;
      let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      let seconds = Math.floor((distance % (1000 * 60)) / 1000);
      const el = document.getElementById("wait_counter<?= $id ?>");
      if (el) {
        el.innerHTML = ("0" + hours).slice(-2) + ":" +
          ("0" + minutes).slice(-2) + ":" +
          ("0" + seconds).slice(-2);
      } else {
        clearInterval(x)
      }
    }, 1000);
  })()
</script>