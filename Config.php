<?php
/**
 * Config.php
 **/

class Magik_Config
{
    public static $Data;

    public static function load($config)
    {
        if(isset($_ENV['environment'])){
            self::$Data = $config[$_ENV['environment']];
        }else{
            self::$Data = $config['development'];
        }
        return self::$Data;
    }


    public static function get($name)
    {
        return self::$Data[$name];
    }

    public static function set($name, $value)
    {
        self::$Data[$name] = $value;
    }
}
