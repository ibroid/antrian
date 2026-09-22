<?php

defined('BASEPATH') or exit('No direct script access allowed');

$config['websocket'] = [
  'url' => 'http://172.168.0.15:3000/api/v1',
  'timeout' => 5,
  'headers' => [
    'Authorization' => 'Bearer your-token'
  ]
];
