<?php

namespace App\Controller;

use Framework\Helper\JSON;

abstract class BaseController implements IController
{
    private static $config = null;

    public function __construct()
    {
        $jsonConfig = file_get_contents(
            self::GetRootDir() . 'Config' . DIRECTORY_SEPARATOR . 'config.json'
        );

        self::$config = JSON::Decode($jsonConfig);
    }

    protected static function GetRootDir()
    {
        return (dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR);
    }
}