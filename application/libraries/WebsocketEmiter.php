<?php

defined('BASEPATH') or exit('No direct script access allowed');

class WebsocketEmiter
{
  protected $CI;
  protected $config;
  protected $endpoint = '';

  public function __construct()
  {
    $this->CI = &get_instance();

    $this->CI->config->load('websocket');

    $this->config = $this->CI->config->item('websocket');
  }

  public function endpoint($endpoint)
  {
    $this->endpoint = trim($endpoint, '/');

    return $this;
  }

  /**
   * Emit websocket event
   *
   * @param string $event
   * @param mixed $payload
   * @return bool
   */
  public function emit($event, $payload = [])
  {
    $body = json_encode([
      'event'   => $event,
      'payload' => $payload
    ]);

    $headers = [
      'Content-Type: application/json',
      'Content-Length: ' . strlen($body)
    ];

    if (!empty($this->config['headers'])) {
      foreach ($this->config['headers'] as $key => $value) {
        $headers[] = $key . ': ' . $value;
      }
    }

    $url = rtrim($this->config['url'], '/');

    if ($this->endpoint != '') {
      $url .= '/' . $this->endpoint;
    }

    $ch = curl_init($url);

    curl_setopt_array($ch, [
      CURLOPT_POST => true,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_POSTFIELDS => $body,
      CURLOPT_HTTPHEADER => $headers,
      CURLOPT_TIMEOUT => $this->config['timeout']
    ]);

    $response = curl_exec($ch);
    $status   = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $error    = curl_error($ch);

    curl_close($ch);

    if ($error) {
      log_message('error', 'Websocket Emit Error : ' . $error);
      return false;
    }

    if ($status >= 400) {
      log_message('error', 'Websocket Emit HTTP ' . $status . ' : ' . $response);
      return false;
    }

    return true;
  }
}
