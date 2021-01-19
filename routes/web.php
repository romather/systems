<?php

use Pecee\SimpleRouter\SimpleRouter;

SimpleRouter::get('/', 'App\Controller\HomeController@show')->name('home');
SimpleRouter::get('/data', 'App\Controller\DataController@show')->name('data');
SimpleRouter::get('/login', 'App\Controller\LoginController@show')->name('acc.login');
SimpleRouter::get('/nova', 'App\Controller\NovaController@show')->name('acc.nova');