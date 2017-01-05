<?php

namespace Kanya\Core\Kanya;

class Route extends KanyaClass {

	protected $callee = [];

    public function name($name) {
        
    }

    public function call($handler) {
        
    }

    public function sub(\Closure $closure) {
        
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
