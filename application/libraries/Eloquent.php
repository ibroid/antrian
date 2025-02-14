<?php

use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;

class Eloquent extends Illuminate\Database\Capsule\Manager
{

  public function __construct()
  {
    parent::__construct();

    $this->addConnection([
      'driver' => 'mysql',
      'host' => $_ENV["DB_HOST"],
      'database' => $_ENV["DB_NAME"],
      'username' => $_ENV["DB_USER"],
      'password' => $_ENV["DB_PASS"],
      'charset' => 'utf8',
      'collation' => 'utf8_unicode_ci',
      'prefix' => '',
      'options'   => [
        PDO::ATTR_TIMEOUT => 5,
      ],
    ]);

    $this->addConnection([
      'driver' => 'mysql',
      'host' => $_ENV["DB_SIPP_HOST"],
      'database' => $_ENV["DB_SIPP_NAME"],
      'username' => $_ENV["DB_SIPP_USER"],
      'password' => $_ENV["DB_SIPP_PASS"],
      'port' => $_ENV["DB_SIPP_PORT"],
      'charset' => 'utf8',
      'collation' => 'utf8_unicode_ci',
      'prefix' => '',
      'options'   => [
        PDO::ATTR_TIMEOUT => 5,
      ],
    ], "sipp");


    $this->setEventDispatcher(new Dispatcher(new Container));
    $this->setAsGlobal();
    $this->bootEloquent();

    $this->readEntity();
  }

  private function readEntity()
  {
    $entity_path = APPPATH . 'models' . DIRECTORY_SEPARATOR;
    if (file_exists($entity_path)) {
      $this->_read_entity_dir($entity_path);
    }
  }

  private function _read_entity_dir($dirpath)
  {
    $ci = &get_instance();

    $handle = opendir($dirpath);
    if (!$handle) return;

    while (false !== ($filename = readdir($handle))) {
      if ($filename == "." or $filename == "..") {
        continue;
      }

      $filepath = $dirpath . $filename;
      if (is_dir($filepath)) {
        $this->_read_entity_dir($filepath);
      } elseif (strpos(strtolower($filename), '.php') !== false) {
        require_once $filepath;
      } else {
        continue;
      }
    }

    closedir($handle);
  }
}
