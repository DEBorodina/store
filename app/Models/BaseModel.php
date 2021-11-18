<?php

namespace App\Models;
use mysqli;


class BaseModel
{

    protected static $tableName;
    protected static $connection;

    protected static function getConnection() {
        if (!self::$connection) {
            self::$connection = new mysqli('localhost', 'root', '', 'mvc');
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

    public static function findById($id){
        /**
         * @var mysqli $connection
         */
        $connection = self::getConnection();
        $smth = $connection->prepare("SELECT * FROM ? where id = ?");
        $table_name = static::getTableName();
        $smth->bind_param('si',$table_name,$id);
        $res = $smth->execute();
        $res = $smth->get_result();
        print_r($res->fetch_assoc());
    }
}