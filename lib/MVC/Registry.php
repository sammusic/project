<?php
class MVC_Registry
{
    static public $instance = null;
    private $container = array();

    private function __construct()
    {
        echo __CLASS__ . ' loaded';
    }

    static public function getInstance()
    {
        if (null === self::$instance) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function set($key, $value)
    {
        if (!isset($this->container[$key])) {
            $this->container[$key] = $value;
        } else {
//            throw new \Exception('This key is already present in container');
        }
    }

    public function get($key)
    {
        if (isset($this->container[$key])) {
            return $this->container[$key];
        }
        return null;
    }
}