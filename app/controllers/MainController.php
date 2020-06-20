<?php

use Aethletic\Container\Container as App;

class MainController
{
    public static function index()
    {
        echo App::twig()->render('index.html');
    }
}
