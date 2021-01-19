<?php

namespace App\Provider;

use Laminas\Math\Rand;

class Hash
{
    public static function generateHash($string, $key = null)
    {
        return hash_pbkdf2('sha3-512', $string, $key, 64, 64, false);
    }

    public static function setKey($length)
    {
        return Rand::getBytes($length);
    }

    public static function make($password, $algo = PASSWORD_ARGON2ID, $options = [])
    {
        return password_hash($password, $algo, $options);
    }

    public static function getToken($length)
    {
        return bin2hex(self::setKey($length));
    }

}
