<?php

class InformasiApi
{
  public $url = "http://192.168.0.202:8897/api/collections/";
  public $body = [];

  public $response;

  public static function make($endpoint = "")
  {
    $ch = curl_init();

    $self = new static;

    curl_setopt($ch, CURLOPT_URL, $self->url . $endpoint);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    $self->setResponse(curl_exec($ch));
    curl_close($ch);

    return $self;
  }

  private function setResponse($res)
  {
    $this->response  = new class($res)
    {
      public $body;

      public function __construct($res)
      {
        $this->body = $res;
      }

      public function parseJson($arr = false)
      {
        return json_decode($this->body, $arr);
      }
    };
  }
}
