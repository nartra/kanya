<?php

namespace Kanya\Core\Kanya;

class Router extends KanyaClass {

    private $routes;
    protected $base_uri = '';
    protected $patcher;
    protected $allow_methods = ['GET', 'POST', 'PUT', 'DELETE'];
    protected $retry_limit = 5;
    private $routing_count = 0;

    public function __construct($base_uri = null) {
        parent::__construct();
        $this->routes = new Tool\Arr();
        $this->setBaseUri($base_uri);
        $this->setPatcher($this);
    }
    
    public function setBaseUri($base_uri){
        $this->base_uri = $base_uri;
    }
    
    public function setPatcher(Router $patcher){
        $this->patcher = $patcher;
    }

    public function initSpecialScript(){
        //TODO: script for PUT and DELETE
    }

    public function createRouteFactory($base_uri = null) {
        return new static($base_uri);
    }
    
    public function routing(){
        
        $this->routing_count++;
        $target = Uri::parse($this->context()->request());
        
        if(is_null($target)){
            return $target;
        }
        
        $route = $this->searchForMatchRoute($target);
        
        return $route;
    }
    
    public function routingCount(){
        return $this->routing_count;
    }
    
    public function isRoutingOverLimit(){
        return $this->routing_count > $this->retry_limit;
    }

    private function addToRouters($method, Uri $uri, Handler $handler){
        $uri->addBaseUri($this->base_uri);
        $route = $this->createRoute($method, $uri, $handler);
        $this->patcher->routes->put($this->prepareMethod($method), $route);
        return $route;
    }

    public function route($methods, $uri, $handler = null) {
        return $this->addToRouters($methods, Uri::parse($uri), Handler::parse($handler));
    }
    
    public function any($uri, $handler = null){
        return $this->route($this->allow_methods, $uri, $handler);
    }
    
    public function get($uri, $handler = null){
        return $this->route('GET', $uri, $handler);
    }
    
    public function post($uri, $handler = null){
        return $this->route('POST', $uri, $handler);
    }
    
    public function retry(){
        throw new Kanya\Exception\RuntimeController\Retry();
    }
    
    public function cancel(){
        throw new Kanya\Exception\RuntimeController\Cancel();
    }
    
    public function skip(){
        throw new Kanya\Exception\RuntimeController\Skip();
    }
    
    protected function createRoute($method, Uri $uri, Handler $handler){
        $route = new Route($this);
        $route->setMethod($method);
        $route->setTarget($uri);
        $route->call($handler);
        return $route;
    }

    private function prepareMethods($methods){
        $methods = is_array($methods) ? $methods : explode(' ', $methods);
        return array_filter(array_map('trim', $methods));
    }

    private function prepareMethod($method){
        $method = strtoupper($method);
        return $method;
    }
    
    private function searchForMatchRoute(Uri $lookup_uri){
        
    }

}
