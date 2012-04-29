<?php
class MVC_Settings
{
    static private $settings = array();

    static public function init($settings = array())
    {
        self::$settings = $settings;
    }

    static public function get($name)
    {
        if (isset(self::$settings[$name])) {
            return self::$settings[$name];
        }
        return null;
    }

    static public function set($name, $value)
    {
        if (isset(self::$settings[$name])) {
            return null;
        }
        self::$settings[$name] = $value;
    }
}