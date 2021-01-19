<?php

namespace App\Provider;

class AppCookie
{
    protected static $_instance = null;

    public static function getInstance()
    {
        if (self::$_instance == null) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function setCookie($name, $value = null, $expire = null, $path = null, $domain = null, $secure = true, $httponly = true)
    {
        $set = setcookie($name, $value, time() + $expire, $path, $domain, $secure, $httponly);
        return $set;
    }

    public function getCookie($name)
    {
        if (isset($_COOKIE) && is_array($_COOKIE) && array_key_exists($name, $_COOKIE)) {
            return $_COOKIE[$name];
        }
        return false;
    }

    public function unsetCookie($name)
    {
        if ($this->getCookie($name) != false) {
            setcookie($name, "", time() - 3600);
            return true;
        }
        return false;
    }

}
