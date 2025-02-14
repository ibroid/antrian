<?php

class Request_voice extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();

    if (R_Input::ci()->request_headers()["Accept"] !== "application/json") {
      set_status_header(404);
      exit();
    }

    R_Input::mustPost();
    $this->load->library("tts");
    $this->load->library("Sysconf", ["ed" => $this->eloquent]);
  }

  public function index()
  {
    $audio = Tts::generateAudio(R_Input::pos("text"), [
      "lang" => "id",
      "timeout" => 20000
    ]);

    echo json_encode($audio);
  }

  public function short()
  {
    $audio = $this->tts->getAudioBase64(R_Input::pos("text"), [
      "lang" => "id",
      "timeout" => 20000
    ]);
    echo json_encode(["status" => true, 'data' => $audio]);
  }
}
