<?php

namespace Kanya\Core\Kanya;

use Kanya\Core\Kanya\Tool\Dispatcher;


class Handler extends KanyaClass
{

    private $callback;
    private $next;
    protected $default_called_method = 'index';

    public function __construct( $any = null, Handler $next = null )
    {
        $this->callback = $any;
        $this->next = $next;
    }

    public static function createHandler()
    {
        return new static();
    }

    public static function createHandlerFromCallable( $callable )
    {
        $handler = new static();
        $handler->target($callable);
        return $handler;
    }

    public static function createHandlerFromClassName( $classname )
    {
        $handler = new static();
        $handler->target($classname);
        return $handler;
    }

    public function setNextHandler( Handler $next )
    {
        $this->next = $next;
    }

    public function target( $classname )
    {
        
    }

    public function getNextHandler()
    {
        
    }

    public function invoke()
    {
        if ( is_callable($this->target) ) {
            $fn = $this->target;
            $fn($this->kanya);
        }
    }

    public function isExist()
    {

        list($class, $method, $params) = $this->explodePattern($this->callback);

        if ( $class ) {
            $object = new $class($this->provideContext());
            if ( !method_exists($object, $method) ) {
                throw new Exception();
            }
            $res = Dispatcher::call([ $object, $method ], $params);
        }
        else if ( is_callable($this->callback) ) {
            $res = Dispatcher::call($this->callback, [ $this->provideContext() ]);
        }
        else if ( !is_null($this->callback) && is_object($this->callback) ) {
            if ( !method_exists($object, $this->default_called_method) ) {
                throw new Exception();
            }
            $res = Dispatcher::call([ $this->callback, $this->default_called_method ], [ $this->provideContext() ]);
        }
    }

    protected function explodePattern( $pattern )
    {
        
    }

    protected function provideContext()
    {
        return $this->context()->core();
    }

    public function isInvalid()
    {
        return false;
    }

}
