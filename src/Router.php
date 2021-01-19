<?php

namespace App;

use Pecee\SimpleRouter\SimpleRouter;

class Router extends SimpleRouter
{
    public static function init()
    {
        require_once __DIR__ . '/../bootstrap/helpers.php';
        require_once __DIR__ . '/../routes/web.php';
        parent::setDefaultNamespace('App\Controller');
        parent::start();
    }
}
