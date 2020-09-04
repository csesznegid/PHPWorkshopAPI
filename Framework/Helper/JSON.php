<?php

/**
 * This file is part of the "PHP Workshop - API" package
 *
 * @author Denes Csesznegi
 * @since  2020.09.03.
 */

namespace Framework\Helper;

use Framework\Helper\Exception\JSONParseException;

/**
 * JSON encoder, decoder with error handling
 *
 * @package Framework\Helper
 * @abstract
 */
abstract class JSON
{
    /**
     * Returns the JSON representation of a value
     *
     * @param  mixed $data
     * @return string
     * @throws \Framework\Helper\Exception\JSONParseException
     * @access public
     * @static
     */
    public static function Encode($data)
    {
        $dataEncoded = json_encode($data);
        self::CheckError();

        return $dataEncoded;
    }

    /**
     * Decodes a JSON string
     *
     * @param  string $data
     * @return mixed
     * @throws \Framework\Helper\Exception\JSONParseException
     * @access public
     * @static
     */
    public static function Decode($data)
    {
        $dataDecoded = json_decode($data);
        self::CheckError();

        return $dataDecoded;
    }

    /**
     * Throws an Exception if any error occurred
     * during the last json_encode() or json_decode() call
     *
     * @throws \Framework\Helper\Exception\JSONParseException
     * @access private
     * @static
     */
    private static function CheckError()
    {
        if (JSON_ERROR_NONE !== json_last_error()) {
            throw new JSONParseException('JSON Error: ' . json_last_error_msg(), json_last_error());
        }
    }
}