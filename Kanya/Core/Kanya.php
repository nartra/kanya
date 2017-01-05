<?php

namespace Kanya\Core\Kanya;


class Kanya extends Context
{

    public function __construct()
    {
        $this->initContext($this);
    }

    public function initContext( Context $context )
    {
        $context->setCoreClass($this);
        $context->setRequestClass(Http\Request::class);
        $context->setResponseClass(Http\Response::class);
        $context->setRouterClass(Router::class);
    }

    public function run()
    {
        try {
            return $this->exec();
        }
        catch ( Exception $e ) {
            
        }
    }

    protected function exec()
    {
        try {
            if ( $this->router->isRoutingOverLimit() ) {
                
            }

            $route = $this->router->routing($this->request());

            $handler_list = $route->getHandlerList();
            
            $handler = array_shift($handler_list);

            foreach ( $route->handlerIterator() as $handler ) {

                if ( is_null($handler) || $handler->isInvalid() ) {
                    throw new \Kanya\Exception\RouteHandlerNotFound();
                }

                try {
                    $this->invokeHandler($handler);
                }
                catch ( Cancel $retry ) {
                    
                }
                catch ( Skip $retry ) {
                    
                }
            }
        }
        catch ( Retry $retry ) {
            
        }
    }

    protected function handlingPlan(Handler $handler)
    {
        
    }

    protected function invokeHandler( Handler $handler )
    {
        $handler->run();
    }

    public function __get( $name )
    {
        if ( method_exists($this, $name) ) {
            return Tool\Dispatcher::call([ $this, $name ]);
        }
        throw new Exception();
    }

}
