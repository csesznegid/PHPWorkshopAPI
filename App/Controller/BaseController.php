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

    protected function ipFilter()
    {
        $clientIP   = (Server::Has('REMOTE_ADDR') ? Server::Get('REMOTE_ADDR') : '');
        $allowedIPs = self::$config->ip_filter;

        $isAllowed  = false;
        foreach ($allowedIPs as $allowedIP) {
            if (stristr($clientIP, $allowedIP)) {
                $isAllowed = true;
                break;
            }
        }

        if (!$isAllowed) {
            throw new \Exception('Access denied from this IP address. ' . $clientIP);
        }
    }

    protected function osFilter()
    {
        $osRegEx = array(
            '/iphone|ipod|ipad|android|blackberry|webos/i' => 'Mobile',
            '/windows/i'                                   => 'Windows',
            '/macintosh|mac os x/i'                        => 'Mac OS',
            '/linux/i'                                     => 'Linux',
        );

        $clientOS = '';
        foreach ($osRegEx as $regEx => $os) {
            if (preg_match($regEx, Server::Get('HTTP_USER_AGENT'))) {
                $clientOS = $os;
                break;
            }
        }

        if (!in_array($clientOS, self::$config->os_filter)) {
            throw new \Exception('Access denied from this operating system. ' . $clientOS);
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