<?php

date_default_timezone_set('Europe/Samara');

require __DIR__ . '/../vendor/autoload.php';

use Aethletic\App\Container;
use Aethletic\App\Bootstrap;

$app = Container::self();
$app->config = require '../config/app.php';

if ($app->config['dev_mode']) {
    error_reporting(E_ALL);
    ini_set('display_errors', true);
} else {
    ini_set('display_errors', false);
    error_reporting(0);
}

Bootstrap::autoload([
    __DIR__ . '/controllers/*.php',
    __DIR__ . '/models/*.php',
    __DIR__ . '/helpers/*.php',
]);

$app->set('route', $one_time = true, function() {
    return new \Bramus\Router\Router();
});

$app->set('db', $one_time = true, function() {
    $factory = new \Database\Connectors\ConnectionFactory();
    return $factory->make(array(
        'driver'    => 'mysql', // sqlite, mysql
        // 'path'      => '/path/to/db.sqlite'
        'host'      => 'localhost',
        'username'  => 'user',
        'database'  => 'dbname',
        'password'  => '123456',
        'charset'   => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'lazy'      => true,
    ));
});

$app->set('twig', $one_time = true, function() {
    $loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/views');
    $twig = new \Twig\Environment($loader, [
        'cache' => false,
        'auto_reload' => true,
        'debug' => true,
    ]);
    return $twig;
});

$app->set('memcache', $one_time = true, function() {
    $mem = new \Memcached();
    $mem->addServer('localhost', '11211');
    return $mem;
});

// $app->set('redis', $one_time = true, function() {
//     $redis = new \Redis;
//     $redis->connect('127.0.0.1');
//     return $redis;
// });
