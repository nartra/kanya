<?php

namespace Kanya\Core\Kanya;

class Handler extends KanyaClass {

	protected $target = null;
	
	public static function createHandler(){
		return new static();
	}
	
	public static function createHandlerFromCallable($callable){
		$handler = new static();
		$handler->target($callable);
		return $handler;
	}
	
	public static function createHandlerFromClassName($classname){
		$handler = new static();
		$handler->target($classname);
		return $handler;
	}
	
	public function target($classname){
		
	}

    public function run() {
        if(is_callable($this->target)){
			$fn = $this->target;
			$fn($this->kanya);
		}
    }

    public function isExist() {
        
    }

}
