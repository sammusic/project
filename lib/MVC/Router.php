<?php

class MVC_Router
{
    private $routes;

    public function __construct(array $routes)
    {
        $this->routes = $routes;
    }

    public function addRoute($pattern, array $options)
    {
        if (empty($this->routes[$pattern])) {
            $this->routes[$pattern] = $options;
        }
    }

    public function match($url)
    {
        foreach ($this->routes as $pattern => $route) {
            
        }
    }
}