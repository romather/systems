<?php

namespace App\Controller;

use App\Provider\AppCookie;
use Noodlehaus\Config;

class DataController extends Controller
{
    public function show()
    {
        $config = new Config(dirname(__DIR__) . '/../config');
        $cookie = AppCookie::getInstance()->setCookie("SID", openssl_random_pseudo_bytes(32), 10, null, null, true, true);
        return $cookie;
    }
}
