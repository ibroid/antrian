<div class="row">
	<div class="col-xl-12 p-0">
		<div class="login-card login-dark">
			<div id="loading-container" class="login-main">
				<div class="text-center">
					<h3>Mohon Tunggu ...</h3>
				</div>
			</div>
			<div id="login-container" hidden class="login-main">
				<?= $this->session->flashdata('flash_error') ?>
				<form class="theme-form" autocomplete="off" method="POST" action="<?= base_url('auth/login') ?>">
					<input type="hidden" id="input-hidden-ip" name="remote_addr">
					<h4>Masuk Sebelum melanjutkan</h4>
					<p>Aplikasi Antrian Persidangan dan Pelayanan Pengadilan Agama Jakarta Utara</p>
					<div class="form-group">
						<label class="col-form-label">Identifier</label>
						<input class="form-control" name="login[identifier]" type="text" required="Harap Isi Bidang ini" placeholder="username">
					</div>
					<div class="form-group">
						<label class="col-form-label">Password</label>
						<div class="form-input position-relative">
							<input class="form-control" type="password" name="login[password]" required="" placeholder="*********">
							<div class="show-hide"><span class="show"> </span></div>
						</div>
					</div>
					<div class="form-group mb-0">
						<div class="checkbox p-0">
							<input id="checkbox1" name="login[remember]" type="checkbox">
							<label class="text-muted" for="checkbox1">Remember password</label>
						</div>
						<button type="submit" class="btn btn-primary btn-block w-100">Sign in</button>
					</div>
				</form>
			</div>
		</div>
		<p class=" text-center">Crafted By<a class="ms-2" target="_blank" href="https://mmaliki.my.id">Mmaliki</a></p>
	</div>
</div>

<script>
	window.addEventListener("load", function() {
		$.ajax({
			url: "https://192.168.0.202:5668",
			success: (res) => {
				$("#login-container").attr("hidden", false)
				$("#loading-container").attr("hidden", true)
				$("#input-hidden-ip").val(res)
			},
			error: (err) => {
				console.log(err)
				$("#loading-container > .text-center > h3").text("Terjadi kesalahan. Hubungi Admin")
			}
		})
	})
</script>