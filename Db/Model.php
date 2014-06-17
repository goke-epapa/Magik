<?php

class Magik_Db_Model{

    public static $db;

    protected $_tableName;
    protected $_primaryKey;
    protected $_primaryKeyValue;

    public $data = array();


    /**
     * Instantiate a model and load data if primary key is passed
     *
     * @param string $primaryKeyValue
     */
    public function __construct($primaryKeyValue = null)
    {
        if(!empty($primaryKeyValue)){
            $sql = "SELECT * FROM " . $this->_tableName;
            $sql .= " WHERE " . $this->_primaryKey . "=?";

            $sth = self::$db->prepare($sql);
            $this->_primaryKeyValue = $primaryKeyValue;
            $sth->execute(array($primaryKeyValue));
            $this->data = $sth->fetch(PDO::FETCH_ASSOC);
        }

    }

    /**
     * Return a value of a property that wasn't defined
     *
     * @param string $name
     * @return string
     */
    public function __get($name)
    {
        return $this->data[$name];
    }


    /**
     * Set a value for a property that hasn't been defined
     *
     * @param string $name
     * @param string $value
     */
    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    /**
     * Set the db connection
     *
     * @param PDO $db
     */
    public static function setDb($db)
    {
        self::$db = $db;
    }

    /**
     * Return all the records in the table
     *
     * @param string $order
     * @return array
     */
    public static function fetchAll($order = null)
    {
        $query = "SELECT * FROM user";
        if(!empty($order)){
            $query .= " " . $order;
        }

        return self::$db->query($query);
    }

    /**
     * insert a new record into the db
     */
    public function insert()
    {
        foreach($this->data as $key => $value){
            $insert[$key] = '?';
        }

        $fields = implode(",", array_keys($insert));
        $qmarks = implode(",", array_values($insert));

        $sql = "INSERT INTO " . $this->_tableName . " (" . $fields . ")";
        $sql .= " VALUES (" . $qmarks . ")";

        $sth = self::$db->prepare($sql);

        $sth->execute(array_values($this->data));
    }


    /**
     * Update a db record
     */
    public function update()
    {
        $assignments = array();
        $sql = "UPDATE " . $this->_tableName . " SET ";
        foreach($this->data as $key => $value){
            $assignments[] = $key . "=?";
        }
        $sql .= implode(", ", $assignments);
        $sql .= " WHERE " . $this->_primaryKey . "=?";
        $this->data[] = $this->_primaryKeyValue;

        $sth = self::$db->prepare($sql);
        $values = array_values($this->data);

        $sth->execute($values);
    }


    /**
     * Update or insert depending on if there is a primary key value set
     */
    public function save()
    {
        if(!empty($this->_primaryKeyValue)){
            $this->update();
        }else{
            $this->insert();
        }
    }


    public function getTableName()
    {
        return $this->_tableName;
    }

    public function getValues()
    {
        return $this->data;
    }
}