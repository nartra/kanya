<?php

namespace Kanya\Core\Kanya;

class Router extends KanyaClass {

    protected $routes = [];

    public function createRouteFactory() {
        return new static();
    }

    public function route($method, $uri, $handler = null) {
        
    }
    
    public function any($uri, $handler = null){
        
    }

}
