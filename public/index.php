<?php
error_reporting(E_ALL);
ini_set('display_errors', true);
date_default_timezone_set('Europe/Samara');

use Aethletic\Container\Container as App;

require __DIR__ . '/../app/bootstrap.php';
require __DIR__ . '/../app/routes.php';

App::route()->run();
