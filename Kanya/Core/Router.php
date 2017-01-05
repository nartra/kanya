<?php

namespace Kanya\Core\Kanya;

class Router extends KanyaClass {

    protected $routes = [];

    public function createRouteFactory() {
        return new static();
    }

    public function createRoute($method, $uri, Handler $handler) {
        $route = new Route();
		$route->setMethod($method);
		$route->setBaseUri('/');
		$route->setUri($uri);
		$route->setHandler($handler);
		return $route;
    }

    public function route($method, $uri, $handler = null) {
        
    }
    
    public function any($uri, $handler = null){
        
    }

}
