<?php

/**
 * This file is part of the "PHP Workshop - API" package
 *
 * @author Denes Csesznegi
 * @since  2020.09.03.
 */

namespace Framework\SuperGlobal;

/**
 * Class to manage $_REQUEST super global
 *
 * @package Framework\SuperGlobal
 * @abstract
 */
abstract class Request
{
    /**
     * Get a value by key
     *
     * @param  string $key
     * @return string
     * @access public
     * @static
     */
    public static function Get($key)
    {
        return $_REQUEST[$key];
    }

    /**
     * Get the integer representation of a value by key
     *
     * @param  string $key
     * @return int
     * @access public
     * @static
     */
    public static function GetInt($key)
    {
        return (int)self::Get($key);
    }

    /**
     * Get the float representation of a value by key
     *
     * @param  string $key
     * @return float
     * @access public
     * @static
     */
    public static function GetFloat($key)
    {
        return (float)self::Get($key);
    }

    /**
     * Get the boolean representation of a value by key
     *
     * @param  string $key
     * @return bool
     * @access public
     * @static
     */
    public static function GetBool($key)
    {
        return (bool)self::Get($key);
    }

    /**
     * Check if a certain key exists
     *
     * @param  string $key
     * @return bool
     * @access public
     * @static
     */
    public static function Has($key)
    {
        return array_key_exists($key, $_REQUEST);
    }

    /**
     * Removes data by key
     *
     * @param  string $key
     * @access public
     * @static
     */
    public static function Remove($key)
    {
        unset($_REQUEST[$key]);
    }
}