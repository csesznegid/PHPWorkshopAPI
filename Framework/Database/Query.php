<?php

/**
 * This file is part of the "PHP Workshop - API" package
 *
 * @author Denes Csesznegi
 * @since  2020.09.10.
 */

namespace Framework\Database;

/**
 * Class to create and execute basic SQL queries
 *
 * @package Framework\Database
 * @abstract
 */
abstract class Query
{
    /**
     * Executes an INSERT statement
     *
     * @param  \PDO &$db
     * @param  $table
     * @param  array $values
     * @return int
     * @access public
     * @static
     */
    public static function Insert(\PDO &$db, $table, $values = array())
    {
        $sql       = ("INSERT INTO `" . $table . "`");
        $bind      = array();
        $fieldStr  = " (";
        $valuesStr = " (";

        $curIndex  = 0;
        $lastIndex = (count($values) - 1);
        foreach ($values as $field => $value) {
            $closure            = ($curIndex === $lastIndex) ? '' : ',';
            $bind[':' . $field] = $value;

            $fieldStr  .= ("`" . $field . "`" . $closure);
            $valuesStr .= (":" . $field . $closure);

            $curIndex++;
        }

        $fieldStr  .= ")";
        $valuesStr .= ")";

        $statement = $db->prepare($sql . $fieldStr . " VALUES " . $valuesStr);
        $statement->execute($bind);

        return (int)$db->lastInsertId();
    }
}