<?php

class InformasiApi
{
  public $url = "http://192.168.0.202:8897/api";
  public $body = [];

  public $response;

  public static function make($endpoint = "")
  {
    $ch = curl_init();

    $self = new static;

    curl_setopt($ch, CURLOPT_URL, "$self->url/collections/$endpoint");
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

  public function fileUrl($COLLECTION_ID_OR_NAME, $RECORD_ID, $FILENAME)
  {
    $file = file_get_contents("$this->url/files/$COLLECTION_ID_OR_NAME/$RECORD_ID/$FILENAME");

    if ($file) {
      header('Content-Type: image/jpg');
      // header('Content-Length: ' . filesize($file_path));
      echo $file;
      exit;
    } else {
      header("HTTP/1.0 404 Not Found");
      echo "File not found!";
    }
  }
}
