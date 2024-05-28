<?php


class Debug extends CI_Controller
{
  public Eloquent $eloquent;

  public function __construct()
  {
    parent::__construct();
    if ($_ENV["DEBUG"] == FALSE) {
      set_status_header(404);
      die;
    }
  }

  public function index()
  {
    $this->load->library("tts");
    // Usage example
    $text = "This is a sample text that is supposed to be converted to audio.";
    $options = [
      'lang' => 'en',
      'slow' => false,
      'host' => 'https://translate.google.com',
      'timeout' => 10000,
      'splitPunct' => ''
    ];

    try {
      $results = Tts::generateAudio($text, $options);
      foreach ($results as $result) {
        echo "Short Text: " . $result['shortText'] . "\n";
        echo "Base64: " . $result['base64'] . "\n";
      }
    } catch (Exception $e) {
      echo 'Error: ' . $e->getMessage();
    }
  }
}
