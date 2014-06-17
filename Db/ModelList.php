<?php

class Magik_Db_ModelList implements Iterator{

    public static $db;

    private $_data = array();
    private $_position = 0;

    protected $_tableName;
    protected $_primaryKey;


    public function fetchAll($order = null)
    {
        $query = "SELECT * FROM " . $this->_tableName;
        if(!empty($order)){
            $query .= " " . $order;
        }

        $sth = self::$db->prepare($query);
        $sth->execute();

        return $sth->fetchAll();
    }

    /**
     * Set the db connection
     *
     * @param PDO $db
     */
    public static function setDb($db){
        self::$db = $db;
    }


    public function rewind()
    {
        $this->_position = 0;
    }

    public function current()
    {
        $m = new $this->_modelName;
        $m->loadData($this->_data[$this->_position]);
        return $m;
    }

    public function key()
    {
        return $this->_position;
    }

    public function next()
    {
        return $this->_position++;
    }

    public function valid()
    {
        return isset($this->_data[$this->_position]);
    }

}