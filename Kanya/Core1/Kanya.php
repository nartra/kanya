<?php

namespace Kanya\Core\Kanya;

class Kanya extends KanyaClass {

    public function request() {
        
    }

    public function run() {
        try {
            return $this->exec();
        } catch (Exception $e) {
            
        }
    }

    protected function exec() {
        $handler = $this->router->routing($this->getCurrentRequest());

        if (is_null($handler)) {
            throw new \Kanya\Exception\RouteHandlerNotFound();
        }
        
        $this->invokeHandler($handler);
    }

    protected function getCurrentRequest() {
        return $this->request();
    }
    
    protected function invokeHandler(Handler $handler){
        $handler->run();
    }

}
