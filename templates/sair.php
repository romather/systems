<?php

require_once __DIR__ . '/../boot/setup.php';

if (!Auth::isLoggedIn()) {
    Redirect::to('home');
}

Auth::logout();