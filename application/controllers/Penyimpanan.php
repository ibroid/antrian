<?php

class Penyimpanan extends R_Controller
{
  public function pengambil($filename)
  {
    $file_path = realpath('./uploads/pengambil/' . $filename);

    if (file_exists($file_path)) {
      header('Content-Type: ' . mime_content_type($file_path));
      header('Content-Length: ' . filesize($file_path));
      readfile($file_path);
      exit;
    } else {
      header("HTTP/1.0 404 Not Found");
      echo "File not found!";
    }
  }
}
