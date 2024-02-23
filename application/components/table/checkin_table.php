<div class="text-center">
  <h4>Pilih Nama Anda</h4>
</div>

<table class="table table-bordered">
  <thead>
    <tr>
      <th>Pihak P</th>
      <td><?php
          foreach ($data->perkara->pihak_satu as $k => $ps) {
            ++$k;
            echo form_ambil_antrian_sidang($data, "P$k", $ps->nama);
          } ?>
      </td>
    </tr>
    <tr>
      <th>Pihak T</th>
      <td><?php
          foreach ($data->perkara->pihak_dua as $y => $pd) {
            ++$y;
            echo form_ambil_antrian_sidang($data, "T$y", $pd->nama);
          } ?>
      </td>
    </tr>
    <tr>
      <th>Kuasa P</th>
      <td><?php
          foreach ($data->perkara->pengacara_satu as $n => $ks) {
            ++$n;
            echo form_ambil_antrian_sidang($data, "KP$n", $ks->nama);
          } ?>
      </td>
    </tr>
    <tr>
      <th>Kuasa T</th>
      <td><?php
          foreach ($data->perkara->pengacara_dua as $c => $kd) {
            ++$c;
            echo form_ambil_antrian_sidang($data, "KT$c", $kd->nama);
          } ?>
      </td>
    </tr>
  </thead>
</table>