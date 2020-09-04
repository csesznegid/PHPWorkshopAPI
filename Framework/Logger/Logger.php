<?php

namespace Framework\Logger;

class Logger
{
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

    public static function Access($message)
    {
        self::Write('access', $message);
    }

    public static function Success($message)
    {
        self::Write('success', $message);
    }

    public static function Error($message)
    {
        self::Write('error', $message);
    }
}