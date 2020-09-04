<?php

namespace App\Controller;

use Framework\Database\Connection;
use Framework\Helper\JSON;
use Framework\SuperGlobal\Server;

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

    protected function methodFilter($onlyAllowed)
    {
        if (Server::Has('REQUEST_METHOD') && !in_array(Server::Get('REQUEST_METHOD'), (array)$onlyAllowed)) {
            throw new \Exception('Only [' . implode(', ', (array)$onlyAllowed) . '] methods are allowed.');
        }
    }

    protected function getDatabaseConnection()
    {
        return Connection::Get(self::$config->database);
    }

    protected static function GetRootDir()
    {
        return (dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR);
    }
}