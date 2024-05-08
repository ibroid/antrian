<?php
require_once "./vendor/autoload.php";

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

return
    [
        'paths' => [
            'migrations' => '%%PHINX_CONFIG_DIR%%/db/migrations',
            'seeds' => '%%PHINX_CONFIG_DIR%%/db/seeds'
        ],
        'environments' => [
            'default_migration_table' => 'phinxlog',
            'default_environment' => 'development',
            'production' => [
                'adapter' => 'mysql',
                'host' => $_DB["DB_HOST"],
                'name' => $_ENV["DB_NAME"],
                'user' => $_ENV["DB_USER"],
                'pass' => $_ENV["DB_PASS"],
                'port' => '3306',
                'charset' => 'utf8',
            ],
            'development' => [
                'adapter' => 'mysql',
                'host' => $_DB["DB_HOST"],
                'name' => $_ENV["DB_NAME"],
                'user' => $_ENV["DB_USER"],
                'pass' => $_ENV["DB_PASS"],
                'port' => '3306',
                'charset' => 'utf8',
            ],
            'testing' => [
                'adapter' => 'mysql',
                'host' => $_DB["DB_HOST"],
                'name' =>  $_ENV["DB_NAME"],
                'user' => $_ENV["DB_USER"],
                'pass' => $_ENV["DB_PASS"],
                'port' => '3306',
                'charset' => 'utf8',
            ]
        ],
        'version_order' => 'creation'
    ];
