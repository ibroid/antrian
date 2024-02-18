<div class="text-center">
  <h4>Pilih Nama Anda</h4>
</div>

<table class="table table-bordered">
  <thead>
    <tr>
      <th>Pihak P</th>
      <td><?php
          foreach ($data->perkara->pihak_satu as $k => $ps) {
            echo form_ambil_antrian_sidang($data, "P" . ++$k, $ps->nama);
          } ?>
      </td>
    </tr>
    <tr>
      <th>Pihak T</th>
      <td><?php
          foreach ($data->perkara->pihak_dua as $k => $pd) {
            echo form_ambil_antrian_sidang($data, "T" . ++$k, $pd->nama);
          } ?>
      </td>
    </tr>
    <tr>
      <th>Kuasa P</th>
      <td><?php
          foreach ($data->perkara->pengacara_satu as $k => $ks) {
            echo form_ambil_antrian_sidang($data, "KP" . ++$k, $ks->nama);
          } ?>
      </td>
    </tr>
    <tr>
      <th>Kuasa T</th>
      <td><?php
          foreach ($data->perkara->pengacara_dua as $k => $kd) {
            echo form_ambil_antrian_sidang($data, "KD" . ++$k, $kd->nama);
          } ?>
      </td>
    </tr>
  </thead>
</table>