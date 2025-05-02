<div class="text-center">
  <h4>Konfirmasi pihak yang mengambil antrian ini. Silahkan pilih nama anda</h4>
</div>

<table class="table table-bordered">
  <thead>
    <tr>
      <th>
        <h3> Pihak P</h3>
      </th>
      <td>
        <?php
        foreach ($data->perkara->pihak_satu as $k => $ps) {
          ++$k;
          echo $this->load->component("form/nama_pengambil_antrian_sidang", [
            "data_pihak" => $ps,
            "data" => $data,
            "pos" => "P$k",
            "nama" => $ps->nama,
          ]);
        } ?>
      </td>
    </tr>
    <tr>
      <th>
        <h3>Pihak T</h3>
      </th>
      <td>
        <?php
        foreach ($data->perkara->pihak_dua as $y => $pd) {
          ++$y;
          echo $this->load->component("form/nama_pengambil_antrian_sidang", [
            "data_pihak" => $pd,
            "data" => $data,
            "pos" => "T$y",
            "nama" => $pd->nama,
          ]);
        } ?>
      </td>
    </tr>
    <tr>
      <th>
        <h3>Kuasa P</h3>
      </th>
      <td>
        <?php
        foreach ($data->perkara->pengacara_satu as $n => $ks) {
          ++$n;
          echo $this->load->component("form/nama_pengambil_antrian_sidang", [
            "data_pihak" => $ks,
            "data" => $data,
            "pos" => "KP$n",
            "nama" => $ks->nama,
          ]);
        } ?>
      </td>
    </tr>
    <tr>
      <th>
        <h3>Kuasa T</h3>
      </th>
      <td>
        <?php
        foreach ($data->perkara->pengacara_dua as $c => $kd) {
          ++$c;
          echo $this->load->component("form/nama_pengambil_antrian_sidang", [
            "data_pihak" => $kd,
            "data" => $data,
            "pos" => "KT$c",
            "nama" => $kd->nama,
          ]);
        } ?>
      </td>
    </tr>
  </thead>
</table>