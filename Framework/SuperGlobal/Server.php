<?php

/**
 * This file is part of the "PHP Workshop - API" package
 *
 * @author Denes Csesznegi
 * @since  2020.09.03.
 */

namespace Framework\SuperGlobal;

/**
 * Class to manage $_SERVER super global
 *
 * @package Framework\SuperGlobal
 * @abstract
 */
abstract class Server
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
        return $_SERVER[$key];
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
        return array_key_exists($key, $_SERVER);
    }
}