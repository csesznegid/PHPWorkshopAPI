<?php

namespace Framework\Database;

use Framework\Database\Exception\DatabaseConnectionException;

class Connection
{
    private static $db = null;

    public function __destruct()
    {
        self::$db = null;
    }

    public static function Get($config)
    {
        self::ConnectToDatabase($config);

        return self::$db;
    }

    private static function ConnectToDatabase($config)
    {
        try {
            if (!(self::$db instanceof \PDO)) {
                self::$db = new \PDO(
                    ('mysql:host=' . $config->host . ';port=' . $config->port),
                    $config->user,
                    $config->password
                );
                self::$db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                self::$db->exec(
                    " CREATE DATABASE IF NOT EXISTS " . $config->name . " DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
                    USE " . $config->name . ";
                    SET NAMES 'utf8';
                    SET CHARACTER SET 'utf8'; "
                );
            }
        }
        catch(\Exception $dbConnException) {
            throw new DatabaseConnectionException($dbConnException->getMessage());
        }
    }
}