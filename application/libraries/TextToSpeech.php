<?php


class TextToSpeech
{
  /**
   * Using an API to generate text-to-speech voice request.
   *
   * @param string $text The text to be converted to speech.
   * @throws Exception If there is an error during the API request.
   * @return string The result of the text-to-speech API request.
   */
  public static function usingApi($text)
  {
    $ch = curl_init($_ENV["TTS_URL_API"] . "/request_voice");
    $apiKey = $_ENV["TTS_API_KEY"];

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"key\": \"$apiKey\", \"text\": \"$text\"}");

    curl_setopt($ch, CURLOPT_HTTPHEADER, [
      "Content-Type: application/json"
    ]);

    // curl_setopt($ch, CURLOPT_TIMEOUT, 10);

    $result = curl_exec($ch);
    $err = curl_error($ch);
    curl_close($ch);
    if ($err) {
      throw new Exception($err);
    }

    return $result;
  }
}
