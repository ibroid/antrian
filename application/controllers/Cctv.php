<?php

class Cctv extends R_Controller
{
  public function load_sidebar_player()
  {
    try {

      $curl = curl_init();

      curl_setopt_array($curl, [
        CURLOPT_PORT => "8183",
        CURLOPT_URL => "http://192.168.0.202:8183/streams",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_POSTFIELDS => "",
        CURLOPT_HTTPHEADER => [
          "Authorization: Basic ZGVtbzpkZW1v"
        ],
      ]);


      $response = json_decode(curl_exec($curl), TRUE);
      $err = curl_error($curl);

      if ($err) {
        throw new Exception($err, 1);
      }

      curl_close($curl);
      echo $this->load->component("layout/sidebar_cctv", ["data" => $response]);
    } catch (\Throwable $th) {
      echo  $th->getMessage();
    }
  }
}
