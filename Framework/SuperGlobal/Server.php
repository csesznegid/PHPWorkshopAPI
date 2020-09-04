<?php

namespace Framework\SuperGlobal;

abstract class Server
{
    public static function Get($key)
    {
        return $_SERVER[$key];
    }

    public static function Has($key)
    {
        return array_key_exists($key, $_SERVER);
    }
}