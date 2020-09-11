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
     * @param  string $table
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

    /**
     * Executes a SELECT statement
     *
     * @param  \PDO &$db
     * @param  string $table
     * @param  array $where
     * @param  bool $selectOnlyOne
     * @return null|object|array
     * @access public
     * @static
     */
    public static function Select(\PDO &$db, $table, $where = array(), $selectOnlyOne = false)
    {
        $whereArr  = self::GetWhere($where);
        $statement = $db->prepare(
            " SELECT * FROM `" . $table . "`" . $whereArr['where']
            . (($selectOnlyOne) ? " LIMIT 1 " : "")
        );
        $statement->execute($whereArr['bind']);

        return ($selectOnlyOne
            ? $statement->fetch(\PDO::FETCH_OBJ)
            : $statement->fetchAll(\PDO::FETCH_OBJ)
        );
    }

    /**
     * Generates a WHERE clause
     *
     * @param  array $where
     * @return array
     * @access protected
     * @static
     */
    protected static function GetWhere(&$where = array())
    {
        $whereStr = " WHERE TRUE ";
        $bind     = array();
        foreach ($where as $field => $value) {
            $bindStr        = (':where_' . $field);
            $whereStr      .= (" AND `" . $field . "` = " . $bindStr);
            $bind[$bindStr] = $value;
        }

        return array(
            'where' => $whereStr,
            'bind'  => $bind,
        );
    }
}