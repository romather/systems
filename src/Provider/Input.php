<?php

namespace App\Provider;

use Exception;
use Laminas\Escaper\Escaper;

class Input
{
    static $errors = true;

    public static function check($arr, $on = false)
    {
        if ($on === false) {
            $on = $_REQUEST;
        }
        foreach ($arr as $value) {
            if (empty($on[$value])) {
                self::throwError('Data is missing', 900);
            }
        }
    }

    public static function int($val)
    {
        $val = filter_var($val, FILTER_VALIDATE_INT);
        if ($val === false) {
            self::throwError('Invalid Integer', 901);
        }
        return $val;
    }

    public static function str($val)
    {
        $escaper = new Escaper('utf-8');        
        if (!is_string($val)) {
            self::throwError('Invalid String', 902);
        }
        $val = $escaper->escapeHtml($val);        
        $filter = filter_var($val, FILTER_SANITIZE_STRING);
        return $filter;
    }

    public static function bool($val)
    {
        $val = filter_var($val, FILTER_VALIDATE_BOOLEAN);
        return $val;
    }

    public static function email($val)
    {
        $val = filter_var($val, FILTER_VALIDATE_EMAIL);
        if ($val === false) {
            self::throwError('Invalid Email', 903);
        }
        return $val;
    }

    public static function url($val)
    {
        $val = filter_var($val, FILTER_VALIDATE_URL);
        if ($val === false) {
            self::throwError('Invalid URL', 904);
        }
        return $val;
    }

    public static function throwError($error = 'Error In Processing', $errorCode = 0)
    {
        if (self::$errors === true) {
            throw new Exception($error, $errorCode);
        }
    }
}
