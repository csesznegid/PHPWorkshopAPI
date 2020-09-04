<?php

/**
 * This file is part of the "PHP Workshop - API" package
 *
 * @author Denes Csesznegi
 * @since  2020.09.03.
 */

namespace Framework\Logger;

/**
 * Class for logging messages
 *
 * @package Framework\Logger
 */
class Logger
{
    /**
     * Write an entry into a log file associated with the given type
     *
     * @param  string $type
     * @param  string $message
     * @access public
     * @static
     */
    public static function Write($type, $message)
    {
        $logDir = ('Log' . DIRECTORY_SEPARATOR);
        if (!is_dir($logDir)) {
            mkdir($logDir, 0777);
        }

        $logFile = fopen(($logDir . $type . '.log'), 'a');
        fwrite(
            $logFile,
            (date('[Y-m-d H:i:s] ') . $message . PHP_EOL)
        );
        fclose($logFile);
    }

    /**
     * Write an access log entry
     *
     * @param  string $message
     * @access public
     * @static
     */
    public static function Access($message)
    {
        self::Write('access', $message);
    }

    /**
     * Write a success log entry
     *
     * @param  string $message
     * @access public
     * @static
     */
    public static function Success($message)
    {
        self::Write('success', $message);
    }

    /**
     * Write an error log entry
     *
     * @param  string $message
     * @access public
     * @static
     */
    public static function Error($message)
    {
        self::Write('error', $message);
    }
}