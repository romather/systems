<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Noodlehaus\Config;
use Tracy\Debugger;

require __DIR__ . '/../vendor/autoload.php';

session_start();

$config = new Config(__DIR__ . '/../config');

$host = $config->get('db.host');
$database = $config->get('db.database');
$username = $config->get('db.username');
$password = $config->get('db.password');

$capsule = new Capsule;
$capsule->addConnection([
    'driver' => 'mysql',
    'host' => $host,
    'database' => $database,
    'username' => $username,
    'password' => $password,
    'charset' => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
    'prefix' => '',
    'timezone' => '-03:00',
]);
$capsule->setAsGlobal();
$capsule->bootEloquent();

Debugger::enable();