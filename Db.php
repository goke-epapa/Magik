<?php

class Magik_Db
{
    public static $db;

    public static function factory($config)
    {
        self::$db = new PDO($config['dsn'], $config['username'], $config['password'], $config['options']);
        return self::$db;
    }

    public function execute($query, $values = null)
    {
        $sth = self::$db->prepare($query);
        return $sth->execute($values);
    }


    public function fetchAll($query, $values = null)
    {
        $sth = self::$db->prepare($query);
        $sth->execute($values);
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    public function fetch($query, $values = null)
    {
        $sth = self::$db->prepare($query);
        $sth->execute($values);
        return $sth->fetch(PDO::FETCH_ASSOC);
    }
}