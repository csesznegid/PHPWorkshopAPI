<?php

/**
 * This file is part of the "PHP Workshop - API" package
 *
 * @author Denes Csesznegi
 * @since  2020.09.03.
 */

namespace Framework\Database;

use Framework\Database\Exception\DatabaseConnectionException;

/**
 * Database connection
 *
 * @package Framework\Database
 */
class Connection
{
    /**
     * Database connection
     *
     * @var    null|\PDO $db
     * @access private
     * @static
     */
    private static $db = null;

    /**
     * @access public
     */
    public function __destruct()
    {
        self::$db = null;
    }

    /**
     * Get database connection
     *
     * @param  object $config
     * @return null|\PDO
     * @throws \Framework\Database\Exception\DatabaseConnectionException
     * @access public
     * @static
     */
    public static function Get($config)
    {
        self::ConnectToDatabase($config);

        return self::$db;
    }

    /**
     * Connect to the database
     *
     * @param  object $config
     * @throws \Framework\Database\Exception\DatabaseConnectionException
     * @access private
     * @static
     */
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