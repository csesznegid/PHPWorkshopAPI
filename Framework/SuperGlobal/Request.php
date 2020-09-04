<?php

namespace Framework\SuperGlobal;

abstract class Request
{
    public static function Get($key)
    {
        return $_REQUEST[$key];
    }

    public static function GetInt($key)
    {
        return (int)self::Get($key);
    }

    public static function GetFloat($key)
    {
        return (float)self::Get($key);
    }

    public static function GetBool($key)
    {
        return (bool)self::Get($key);
    }

    public static function Has($key)
    {
        return array_key_exists($key, $_REQUEST);
    }

    public static function Remove($key)
    {
        unset($_REQUEST[$key]);
    }
}