<?php

include_once APPPATH . 'traits/CetakThermalHelper.php';
include_once APPPATH . 'traits/AntrianPtspHelper.php';
include_once APPPATH . 'traits/AntrianSidangHelper.php';
include_once APPPATH . 'traits/PengunjungHelper.php';

class Ktp extends R_Controller
{
  use CetakThermalHelper, AntrianPtspHelper, AntrianSidangHelper, PengunjungHelper;

  public function index()
  {
    $base_url = base_url();

    $this->addons->init([
      'css' => [
        "<link rel='stylesheet' type='text/css' href='$base_url/assets/css/vendors/flatpickr/flatpickr.min.css'>\n",
        " <link rel=\"stylesheet\" type=\"text/css\" href=\"$base_url/assets/css/vendors/datatables.css\">",
        "<link rel=\"stylesheet\" type=\"text/css\" href=\"$base_url/assets/css/vendors/sweetalert2.css\">"
      ],
      'js' => [
        "<script src=\"$base_url/assets/js/flat-pickr/flatpickr.js\"></script>\n",
        "<script src=\"$base_url/assets/js/datatable/datatables/jquery.dataTables.min.js\"></script>\n",
        "<script src=\"https://cdn.jsdelivr.net/npm/sweetalert2@11\"></script>",
        "<script src=\"https://js.pusher.com/8.2.0/pusher.min.js\"></script>",
        "<script src=\"$base_url/assets/js/typeahead/typeahead.bundle.js\"></script>"
      ]
    ]);

    $data["daftar_sidang"] = PerkaraJadwalSidang::where("tanggal_sidang", isset($_POST["tanggal_sidang"]) ? $_POST["tanggal_sidang"] : date("Y-m-d"))->get();
    $this->load->page("ktp/ambil_antrian", $data)->layout("auth_layout");
  }

  public function fetch_form()
  {
    if (!R_Input::isPost()) {
      show_404();
    }

    try {
      $temp = $this->eloquent->table('temporary_data')->where('temp_photo', R_Input::pos('photo'))->first();

      $data = json_decode($temp->temp_data);
      $data->photo = $temp->temp_photo;
      $data->img = $temp->temp_img;

      $pengunjung = Pengunjung::where('nik', $data->nik)->first();

      if ($pengunjung) {
        $pengunjung->photo = $temp->temp_photo;
        $pengunjung->img = $temp->temp_img;
      }

      echo $this->load->component('pengunjung/form_pengunjung', [
        'data' => $pengunjung ?? $data,
        'temp' => $temp
      ]);
    } catch (\Throwable $th) {
      set_status_header(400);
      echo $th->getMessage();
    }
  }

  public function file($filename)
  {
    return read_uploaded_file("temp", $filename);
  }

  public function simpan()
  {
    if (!R_Input::isPost()) {
      show_404();
    }
    try {
      if (R_Input::pos()->count() < 2) {
        throw new Exception("KTP Pengunjung tidak terdeteksi", 1);
      }

      $this->eloquent->connection("default")->transaction(function () {
        $pengunjung = $this->pengunjung_save_from_post();

        $pengunjung->kunjungan()->create([
          "tanggal_kunjungan" => date('Y-m-d'),
          "status_pengunjung" => R_Input::pos("status_pengunjung"),
          "tujuan_kunjungan" => R_Input::pos("tujuan")
        ]);


        $pihakPerkara = Pihak::where('nomor_indentitas', $pengunjung->nik)->first();

        $perkara = $pihakPerkara->pihak_satu->perkara;

        if ($perkara) {
          $this->eloquent->table('perkara_pengunjung')->updateOrInsert(
            ['perkara_id' => $perkara->perkara_id],
            ['pengunjung_id' => $pengunjung->id]
          );
        }

        if (isset($this->daftarTujuan[R_Input::pos('tujuan')])) {

          $newAntrianPtsp = $this->ambil_antrian_ptsp(
            R_Input::pos('tujuan'),
            $pengunjung->id
          );

          $this->print_antrian_ptsp($newAntrianPtsp);
        } else {
          if (
            R_Input::pos('tujuan') == 'SIDANG'
            &&
            R_Input::pos('status_pengunjung') == 'Pihak Berperkara'
          ) {

            if (!$pihakPerkara) {
              throw new Exception("KTP Tidak Ditemukan DI SIPP", 1);
            }

            $antrianSidang = $this->ambil_antrian_sidang($perkara);
            $this->eloquent->table('pengunjung_sidang')->insert([
              'pengunjung_id' =>  $pengunjung->id,
              'antrian_sidang_id' => $antrianSidang->id
            ]);

            $this->print_antrian_sidang($antrianSidang);
          }
        }

        $this->update_serial($pengunjung->id);

        $this->move_files();
      });
    } catch (\Throwable $th) {
      Redirect::wfe($th->getMessage())->to("ktp");
    }

    Redirect::wfa(['message' => "Berhasil menyimpan data pengunjung. Silahkan Ambil Antrian"])->to("/ktp");
  }

  public function move_files()
  {
    $tempDir = './uploads/temp/';
    $targetDir = './uploads/pengunjung/';

    if (file_exists($tempDir . R_Input::pos('temp_photo'))) {
      rename(
        $tempDir . R_Input::pos('temp_photo'),
        $targetDir . R_Input::pos('temp_photo')
      );
    }

    if (file_exists($tempDir . R_Input::pos('temp_img'))) {
      rename(
        $tempDir . R_Input::pos('temp_img'),
        $targetDir . R_Input::pos('temp_img')
      );
    }
  }

  public function suggest_nik()
  {
    if (!$this->input->is_ajax_request()) {
      show_404();
    }
    $searchedData = $this->eloquent
      ->table('pengunjung')
      ->select('id', 'nik')
      ->where('nik', 'like',  R_Input::gett('q') . '%')
      ->limit(10)
      ->get();

    header('Content-Type: application/json');
    echo json_encode($searchedData);
  }
}
