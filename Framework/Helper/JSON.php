<?php

namespace Framework\Helper;

use Framework\Helper\Exception\JSONParseException;

abstract class JSON
{
    public static function Encode($data)
    {
        $dataEncoded = json_encode($data);
        self::CheckError();

        return $dataEncoded;
    }

    public static function Decode($data)
    {
        $dataDecoded = json_decode($data);
        self::CheckError();

        return $dataDecoded;
    }

    private static function CheckError()
    {
        if (JSON_ERROR_NONE !== json_last_error()) {
            throw new JSONParseException('JSON Error: ' . json_last_error_msg(), json_last_error());
        }
    }
}