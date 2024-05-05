<?php

class Identitas extends R_Controller
{
  public function tambah()
  {
    R_Input::mustPost();
    try {
      $pihak = IdentitasPihak::create(R_Input::pos()->except("antrian_pelayanan_id")->all());

      AntrianPtsp::find(R_Input::pos('antrian_pelayanan_id'))->update([
        "identitas_pihak_id" => $pihak->id
      ]);

      if (R_Input::ci()->request_headers()["Accept"] == "application/json") {
        echo json_encode([
          "data" => $pihak, "message" => "Berhasil menyimpan data"
        ]);

        return set_status_header(200);
      }

      return Redirect::wfa([
        "message" => "Berhasil",
        "text" => "Pihak ditambahkan",
        "status" => "success"
      ])->go($_SERVER["HTTP_REFERER"]);
    } catch (\Throwable $th) {

      if (R_Input::ci()->request_headers(TRUE)["Accept"] == "application/json") {
        echo json_encode([
          "data" => null, "message" => $th->getMessage()
        ]);

        return set_status_header(500);
      }

      return Redirect::wfe($th->getMessage())->go($_SERVER['HTTP_REFERER']);
    }
  }
}
