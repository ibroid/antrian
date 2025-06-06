<div class="row">
  <div class="col-5">
    <div class="container text-center" style="height: 200px;">
      <img id="img-foto-ktp" width="400" src="<?= base_url('ktp/file/') ?><?= $data->img ?? null ?>" alt="KTP">
    </div>
  </div>
  <div class="col-7">
    <div class="row mb-3">
      <label class="col-sm-3 col-form-label" for="input-nama-lengkap">Nama Lengkap</label>
      <div class="col-sm-9">
        <input type="text" name="nama_lengkap" class="form-control" required id="input-nama-lengkap" placeholder="Sesuai Ktp" value="<?= $data->nama_lengkap ?? null ?>" />
      </div>
    </div>
    <div class="row mb-3">
      <label class="col-sm-3 col-form-label" for="select-jenis-kelamin">Jenis Kelamin</label>
      <div class="col-sm-9">
        <select required name="jenis_kelamin" class="form-select" id="select-jenis-kelamin">
          <option <?= (strtoupper($data->jenis_kelamin ?? null)) == "PEREMPUAN" ? "selected" : false ?>>Perempuan</option>
          <option <?= (strtoupper($data->jenis_kelamin ?? null)) == "LAKI-LAKI" ? "selected" : false ?>>Laki-laki</option>
        </select>
      </div>
    </div>
    <div class="row mb-3">
      <label class="col-sm-3 col-form-label" for="input-nik">NIK</label>
      <div class="col-sm-9">
        <div class="input-group input-group-merge">
          <input required type="text" name="nik" id="input-nik" class="form-control" placeholder="321 ******" aria-describedby="basic-default-nik16" value="<?= $data->nik ?? null ?>" />
          <span class="input-group-text" id="basic-default-nik16">16 Angka</span>
        </div>
      </div>
    </div>
    <div class="row mb-3">
      <label class="col-sm-3 col-form-label" for="select-sebagai">Sebagai</label>
      <div class="col-sm-9">
        <div class="input-group input-group-merge">
          <select class="form-select" required name="status_pengunjung" id="select-sebagai">
            <option value="" selected disabled>--- Pilih Status Pihak ---</option>
            <option>Pihak Berperkara</option>
            <option>Pihak Baru</option>
            <option>Pihak Non Berperkara</option>
            <option>Kuasa Hukum</option>
            <option>Saksi</option>
            <option>Pengantar</option>
            <option>Tamu</option>
          </select>
        </div>
      </div>
    </div>
    <div class="row mb-3">
      <label class="col-sm-3 col-form-label" for="input-serial-id">Serial ID KTP</label>
      <div class="col-sm-9">
        <div class="input-group input-group-merge">
          <input
            autofocus
            type="text"
            name="serial_id"
            id="input-serial-id"
            class="form-control"
            placeholder="-----"
            aria-describedby="basic-default-ser-id"
            value="<?= $data->serial->serial_id ?? null ?>" />
          <span class="input-group-text" id="basic-default-ser-id">10 Angka</span>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="text-center">
  <p class="text-danger">Form Di Atas Wajib Diisi</p>
</div>

<hr class="my-6 mx-n6">
<div class="text-center">
  <p class="text-muted">Opsional</p>
</div>

<div class="row">
  <div class="col-6">
    <div class="row mb-3">
      <label class="col-sm-4 col-form-label" for="input-pekerjaan">Pekerjaan</label>
      <div class="col-sm-8">
        <input type="text" id="input-pekerjaan" class="form-control" name="pekerjaan" value="<?= $data->pekerjaan ?? null ?>" />
      </div>
    </div>
  </div>
  <div class="col-6">
    <div class="row mb-3">
      <label class="col-sm-4 col-form-label" for="input-pendidikan">Pendidikan</label>
      <div class="col-sm-8">
        <input type="text" id="input-pendidikan" class="form-control" name="pendidikan" value="<?= $data->pendidikan ?? null ?>" />
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-6">
    <div class="row mb-3">
      <label class="col-sm-4 col-form-label" for="input-tempat">Tempat</label>
      <div class="col-sm-8">
        <input type="text" id="input-tempat" class="form-control" name="tempat" value="<?= $data->tempat ?? null ?>" />
      </div>
    </div>
  </div>
  <div class="col-6">
    <div class="row mb-3">
      <label class="col-sm-4 col-form-label" for="input-tanggal-lahir">Tanggal Lahir</label>
      <div class="col-sm-8">
        <input type="date" id="input-tanggal-lahir" class="form-control" name="tanggal_lahir" value="<?= $data->tanggal_lahir ?? null ?>" />
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-6">
    <div class="row mb-3">
      <label class="col-sm-4 col-form-label" for="input-provinsi">Provinsi</label>
      <div class="col-sm-8">
        <input type="text" id="input-provinsi" class="form-control" name="provinsi" value="<?= $data->provinsi ?? null ?>" />
      </div>
    </div>
  </div>
  <div class="col-6">
    <div class="row mb-3">
      <label class="col-sm-4 col-form-label" for="input-kota">Kota</label>
      <div class="col-sm-8">
        <input type="text" id="input-kota" class="form-control" name="kota" value="<?= $data->kota ?? null ?>" />
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-6">
    <div class="row mb-3">
      <label class="col-sm-4 col-form-label" for="input-kecamatan">Kecamatan</label>
      <div class="col-sm-8">
        <input type="text" id="input-kecamatan" class="form-control" name="kecamatan" value="<?= $data->kecamatan ?? null ?>" />
      </div>
    </div>
  </div>
  <div class="col-6">
    <div class="row mb-3">
      <label class="col-sm-4 col-form-label" for="input-keluarahan">Keluarahan</label>
      <div class="col-sm-8">
        <input type="text" id="input-keluarahan" class="form-control" name="kelurahan" value="<?= $data->kelurahan ?? null ?>" />
      </div>
    </div>
  </div>
</div>

<div class="row mb-3">
  <label class="col-sm-2 col-form-label" for="textarea-alamat">Alamat</label>
  <div class="col-sm-10">
    <textarea id="textarea-alamat" class="form-control" name="alamat"><?= $data->alamat ?? null ?></textarea>
  </div>
</div>

<div class="d-flex gap-3 justify-content-center">
  <button name="tujuan" value="SIDANG" class="btn card small-widget mb-sm-0 bg-secondary card-ambil-antrian-ptsp">
    <div class="card-body light">
      <div class="d-flex align-items-end gap-1">
        <h4>SEBAGAI SAKSI</h4>
      </div>
      <div class="bg-gradient">
        <svg class="stroke-icon svg-fill">
          <use href="../assets/svg/icon-sprite.svg#user-visitor"></use>
        </svg>
      </div>
    </div>
  </button>
  <button name="tujuan" value="Mengantar" class="btn card small-widget mb-sm-0 bg-secondary card-ambil-antrian-ptsp">
    <div class="card-body light">
      <div class="d-flex align-items-end gap-1">
        <h4>SEBAGAI PENGANTAR</h4>
      </div>
      <div class="bg-gradient">
        <svg class="stroke-icon svg-fill">
          <use href="../assets/svg/icon-sprite.svg#user-visitor"></use>
        </svg>
      </div>
    </div>
  </button>
  <button name="tujuan" value="Kepentingan" class="btn card small-widget mb-sm-0 bg-secondary card-ambil-antrian-ptsp">
    <div class="card-body light">
      <div class="d-flex align-items-end gap-1">
        <h4>SEBAGAI TAMU</h4>
      </div>
      <div class="bg-gradient">
        <svg class="stroke-icon svg-fill">
          <use href="../assets/svg/icon-sprite.svg#user-visitor"></use>
        </svg>
      </div>
    </div>
  </button>
</div>

<input type="hidden" name="temp_id" value="<?= $temp->id ?? null ?>">
<input type="hidden" name="temp_photo" value="<?= $temp->temp_photo ?? null ?>">
<input type="hidden" name="temp_img" value="<?= $temp->temp_img ?? null ?>">

<script>
  (() => {
    var searchData = new Bloodhound({
      datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
      queryTokenizer: Bloodhound.tokenizers.whitespace,
      remote: {
        url: '<?= base_url('ktp/suggest_nik') ?>?q=%QUERY',
        wildcard: '%QUERY'
      }
    });

    // Initialize Typeahead
    $('#input-nik').typeahead(null, {
      name: 'search-results',
      display: 'nik',
      source: searchData
    });
  })()
</script>