<?php

use Aethletic\App\Container as App;

App::route()->get('/', 'MainController::index');
