<?php

require __DIR__ . '/../vendor/autoload.php';

use Aethletic\Container\Container;
use Aethletic\Container\Bootstrap;

Bootstrap::autoload([
    __DIR__ . '/controllers/*.php',
    __DIR__ . '/models/*.php',
    __DIR__ . '/helpers/*.php',
]);

$app = new Container();

$app->register('route', function() {
    return new \Bramus\Router\Router();
});

$app->register('db', function() {
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

$app->register('twig', function() {
    $loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/views');
    $twig = new \Twig\Environment($loader, [
        'cache' => false,
        'auto_reload' => true,
        'debug' => true,
    ]);
    return $twig;
});

$app->register('memcache', function() {
    $mem = new \Memcached();
    $mem->addServer('localhost', '11211');
    return $mem;
});

$app->register('redis', function() {
    $redis = new \Redis;
    $redis->connect('127.0.0.1');
    return $redis;
});
