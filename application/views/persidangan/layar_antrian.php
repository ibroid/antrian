<div class="row">
  <div class="col-xl-12 p-0">
    <div class="login-card login-dark" style="background: url('<?= base_url('assets/images/login/login_bg_green_cozy.jpg') ?>'); background-size: cover;">
      <div class="login-main" style="width: max-content;">
        <?= $this->session->flashdata('flash_error') ?>
        <?= $this->session->flashdata('flash_notif') ?>
        <div class="text-center">
          <h1>LAYAR ANTRIAN PERSIDANGAN</h1>
          <h4>Aplikasi Antrian Persidangan dan Pelayanan <?= $this->sysconf->NamaPN ?></h4>
        </div>
        <div class="d-flex justify-content-center">
          <ul class="tg-list common-flex">
            <li class="tg-list-item">
              <input class="tgl tgl-skewed" id="cb3" type="checkbox">
              <label class="tgl-btn" data-tg-off="OFF" data-tg-on="ON" for="cb3"></label>
            </li>
            <li>
              <h6> Audio</h6>
            </li>
          </ul>
        </div>
        <div class="d-flex gap-5">
          <?php foreach ($daftar_ruang_sidang as $ruang_sidang) { ?>
            <a href="<?= base_url('layar/ruangan/' . Cypher::urlsafe_encrypt($ruang_sidang->id)) ?>" class="card crypto-main-card" style="width: 400px;">
              <div class="card-body mb-auto">
                <div class="text-center">
                  <h1><?= strtoupper($ruang_sidang->nama) ?></h1>
                </div>
                <div class=" text-center">
                  <div>
                    <span class="nomor-antrian" data-nomor="<?= $ruang_sidang->kode ?>" style=" font-size: 15rem;">0</span>
                  </div>
                </div>
              </div>
            </a>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="toast-container position-fixed top-0 center-0 p-3 toast-index toast-rtl">
  <div class="toast hide toast fade" id="liveToast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header"><strong class="me-auto">Notification</strong><small>Now</small>
      <button class="btn-close" type="button" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body toast-dark" id="toast-body">This is notification.</div>
  </div>
</div>

<script>
  let isplaying = false;
  let audioQueue = [];

  window.addEventListener("load", () => {
    const pusher = new Pusher('<?= $_ENV["PUSHER_APP_KEY"] ?>', {
      cluster: 'ap1'
    });

    const channel = pusher.subscribe('antrian-channel');
    const pengumumanChannel = pusher.subscribe('audio-pengumuman')

    channel.bind('pengumuman', async function(data) {
      initAudo(data)
    });

    channel.bind('panggil-pihak', async function(data) {
      initAudo(data)
    })

    channel.bind('update-persidangan', async function(data) {
      fetchNomorAntrian()
    })

    fetchNomorAntrian()

    pengumumanChannel.bind("play", playAudioPengumuman)
  })

  function playAudioPengumuman(data) {
    const audio = new Audio("<?= base_url('audio/pengumuman/') ?>" + data.filename);
    audio.play()

    const audioPenutupan = new Audio("<?= base_url('audio/pengumuman/nama_ketua.mp3') ?>");
    audio.addEventListener("ended", () => {
      if (data.nama_ketua_penutup == "yes") {
        audioPenutupan.play()
      }
      $.ajax({
        url: "<?= base_url("layar/pengumuman_selesai") ?>",
        method: "POST",
        data: {
          id: data.id
        },
        success(res) {
          console.log("Pengumuman telah selesai diputar", res);
        },
        error(err) {
          console.error("Pengumuman gagal diselesaikan :", err)
        }
      })
    })
  }

  function fetchNomorAntrian() {
    $.ajax({
      url: "<?= base_url("/api/dalam_persidangan") ?>",
      method: "POST",
      headers: {
        Authorization: "Bearer <?= $_ENV['API_KEY'] ?>"
      },
      data: {
        password: "<?= password_hash($_ENV["API_PASSWORD"], PASSWORD_DEFAULT) ?>"
      },
      success(data) {
        const dataAntrian = JSON.parse(data)
        $(".nomor-antrian").each(function(index, el) {
          // $(el).text(dataAntrian[index]?.antrian_persidangan?.nomor_urutan)
          dataAntrian.forEach(ant => {
            if (ant.nomor_ruang == $(el).data("nomor")) {
              $(el).text(ant.antrian_persidangan.nomor_urutan)
            }
          })
        })
      },
      error(err) {
        notifToas("Gagal fetch antrian")
      }
    })
  }

  async function initAudo(data) {
    const audio = await requestVoice(data)
    audio.forEach(a => audioQueue.push(a.base64))

    if (!isplaying) {
      playAudioinQueue()
    }
  }

  /**@param {string} text  */
  async function requestVoice(text) {
    const body = new FormData()
    body.append('text', text.toLowerCase())
    return await fetch("<?= base_url("request_voice") ?>", {
        method: "POST",
        headers: {
          "Accept": "application/json",
        },
        body: body
      })
      .then(res => res.json())
      .catch(err => {
        notifToas("Gagal meminta audio. Silahkan refresh halaman ini")
      })
  }

  function playAudioinQueue() {
    // if audio queue is empty, do nothing
    if (audioQueue.length === 0) return;
    // get first element from queue
    const audio = audioQueue[0]
    // play audio
    playAudioFromBase64(audio, () => {
      // when audio is finished, play next audio
      audioQueue.shift();
      isplaying = false;
      playAudioinQueue()
    })


  }

  function playAudioFromBase64(base64, callback) {
    isplaying = true;
    const audio = new Audio(`data:audio/wav;base64,${base64}`);
    audio.playbackRate = 1.2;
    audio.play();
    audio.addEventListener('ended', callback)
  }

  function notifToas(message) {
    console.log(message)
    Toastify({
      text: message,
      duration: 5000,
      close: true,
      gravity: "top", // `top` or `bottom`
      position: "center", // `left`, `center` or `right`
      stopOnFocus: true, // Prevents dismissing of toast on hover
      onClick: function() {} // Callback after click
    }).showToast();
  }
</script>