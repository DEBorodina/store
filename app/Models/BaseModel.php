<?php

namespace App\Models;
use mysqli;


class BaseModel
{
    protected static function debug($num) {
        echo "<pre>";
        var_dump($num);
        echo "</pre>";
    }

    protected static $tableName;
    protected static $connection;

    protected static function getConnection() {
        if (!self::$connection) {
            self::$connection = new mysqli('localhost', 'root', 'root', 'electro');
        }
        return self::$connection;
    }

    protected static function getTableName() {
        if (empty(static::$tableName)) {
            $className = static::class;
            $className = explode('\\', $className);
            $className = array_pop($className);
            $className = strtolower($className);
            $tableName = $className . "s";
        } else {
            $tableName = static::$tableName;
        }
        return $tableName;
    }

    public static function selectAll() {
        $connection = self::getConnection();
        $tableName = static::getTableName();
        $res = $connection->query("SELECT * FROM ".$tableName);
        $arr = [];
        while ($row = $res->fetch_object(static::class)) {
            $arr[] = $row;
        }
        return debug($arr);
    }

}