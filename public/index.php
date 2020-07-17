<?php

use Aethletic\App\Container as App;

require __DIR__ . '/../app/bootstrap.php';
require __DIR__ . '/../app/routes.php';

App::route()->run();
