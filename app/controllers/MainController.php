<?php

use Aethletic\App\Container as App;

class MainController
{
    public static function index()
    {
        echo App::twig()->render('/pages/index.html');
    }
}
