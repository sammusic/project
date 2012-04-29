<?php
class MVC_Autoloader
{
    private $namespaces;
    private $prefixes;

    public function addPrefix($prefix, $dir)
    {
        $this->prefixes[$prefix] = $dir;
    }

    public function register()
    {
        spl_autoload_register(array($this, 'loadClass'), true, true);
    }

    public function loadClass($class)
    {
        if (null !== $file = $this->find($class)) {
            require $file;
        }
        return null;
    }

    public function find($classname)
    {
//        var_dump($classname);
//        var_dump($this->prefixes);
        foreach ($this->prefixes as $prefix => $dir) {
            if (0 === strpos($classname, $prefix)) {
                $filename = $dir . DIRECTORY_SEPARATOR . str_replace('_', DIRECTORY_SEPARATOR, $classname).'.php';
                if (file_exists($filename)) {
                    return $filename;
                }
            }
        }
        return null;
    }
}