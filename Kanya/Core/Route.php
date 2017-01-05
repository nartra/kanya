<?php

namespace Kanya\Core\Kanya;

class Route extends KanyaClass {
    
    private $router;
    protected $method;
    protected $uri;
    protected $name;
    protected $dispatches = [];

    public function __construct(Router $router = null) {
        parent::__construct();
        $this->router = is_null($router) ? $this->context()->router() : $router;
    }
    
    public function setMethod($method){
        $this->method = $method;
    }
    
    public function setTarget($target){
        $this->uri = $target;
    }

    public function getFirstHandler(){
        return reset($this->dispatches);
    }

    public function method($method){
        $this->method = $method;
    }

    public function target(Target $uri){
        $this->uri = Target::parse($uri);
        return $this;
    }

	protected $callee = [];

    public function name($name) {
        $this->name = $name;
        return $this;
    }

    public function call($handler) {
        $this->dispatches[] = Handler::parse($handler);
        return $this;
    }

    public function sub(\Closure $closure) {
        $router = $this->router->createRouteFactory($this->uri);
        $router->setPatcher($this->router);
        Tool\Dispatcher::call($closure, [$router]);
        return $this;
    }
    
    public function handlerIterator(){
        foreach($this->dispatches as $ech){
            yield $ech;
        }
    }
	
	public function getHandler(){
		$me = $this;
		$handler = Handler::createHandler();
		$handler->target(function() use($me){
			foreach($me->iterator() as $ech){
				$ech->run();
			}
		});
	}
	
	protected function iterator(){
		foreach($this->callee as $c){
			yield $c;
		}
	}
	
	protected function enqueueHandler(Handler $handler){
		$this->callee[] = $handler;
	}
	
	protected function toHandler($handler){
		if($handler instanceof Handler){
			return $handler;
		}
		if(is_string($handler)){
			return Handler::createHandlerFromClassName($handler);
		}
		if(is_callable($handler)){
			return Handler::createHandlerFromCallable($handler);
		}
		
		return Handler::createHandler();
	}

}
