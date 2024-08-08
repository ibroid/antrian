<?php

class Visitor extends R_ApiController
{
  public function index()
  {
    try {
      delete_all_temporary();

      $photoFileName = $this->upload_file("photo");
      $imgFileName = $this->upload_file("img");

      $this->eloquent->connection("default")->beginTransaction();

      $this->eloquent->table("temporary_data")->insert([
        "temp_data" => json_encode(R_Input::pos()->except(['photo', 'img'])->toArray()),
        "temp_photo" => $photoFileName,
        "temp_img" => $imgFileName
      ]);

      $this->eloquent->connection("default")->commit();
      Broadcast::pusher()->trigger('scan-data', 'recive', $photoFileName);

      echo "Berhasil menyimpan data. Atas nama " . R_Input::pos('nama');
    } catch (\Throwable $th) {

      $this->eloquent->connection("default")->rollBack();
      set_status_header(400);
      echo $th->getMessage();
    }
  }

  private function upload_file($filename)
  {
    $config['upload_path'] = './uploads/temp/';
    $config['allowed_types'] = 'gif|jpg|png|jpeg';
    $config['max_size']  = '514';
    $config['encrypt_name'] = TRUE;

    $this->load->library('upload', $config);

    if (!$this->upload->do_upload($filename)) {
      throw new Exception($this->upload->display_errors(), 1);
    } else {
      return $this->upload->data('file_name');
    }
  }
}
