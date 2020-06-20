<?php

use Aethletic\Container\Container as App;

App::route()->get('/', 'MainController::index');
