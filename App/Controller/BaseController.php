<?php

/**
 * This file is part of the "PHP Workshop - API" package
 *
 * @author Denes Csesznegi
 * @since  2020.09.03.
 */

namespace App\Controller;

use Framework\Database\Connection;
use Framework\Helper\JSON;
use Framework\SuperGlobal\Server;

/**
 * Abstract class for common controller properties and methods
 *
 * @package App\Controller
 * @abstract
 */
abstract class BaseController implements IController
{
    /**
     * Configurations
     *
     * @var    null|object
     * @access private
     * @static
     */
    private static $config = null;

    /**
     * @access public
     */
    public function __construct()
    {
        if (null === self::$config) {
            $jsonConfig = file_get_contents(
                self::GetRootDir() . 'Config' . DIRECTORY_SEPARATOR . 'config.json'
            );

            self::$config = JSON::Decode($jsonConfig);
        }
    }

    /**
     * HTTP request method filter
     *
     * @param  string|array $onlyAllowed e.g. "GET" or ["GET", "POST"]
     * @throws \Exception
     * @access protected
     */
    protected function methodFilter($onlyAllowed)
    {
        if (Server::Has('REQUEST_METHOD') && !in_array(Server::Get('REQUEST_METHOD'), (array)$onlyAllowed)) {
            throw new \Exception('Only [' . implode(', ', (array)$onlyAllowed) . '] methods are allowed.');
        }
    }

    /**
     * IP address filter
     *
     * @throws \Exception
     * @access protected
     */
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

    /**
     * Operating system filter
     *
     * @throws \Exception
     * @access protected
     */
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

    /**
     * Get database connection
     *
     * @return null|\PDO
     * @throws \Framework\Database\Exception\DatabaseConnectionException
     * @access protected
     */
    protected function getDatabaseConnection()
    {
        return Connection::Get(self::$config->database);
    }

    /**
     * Get app root directory
     *
     * @return string
     * @access protected
     * @static
     */
    protected static function GetRootDir()
    {
        return (dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR);
    }
}