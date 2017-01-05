<?php

namespace Kanya\Core\Kanya;


class Route extends KanyaClass
{

    private $router;
    protected $method;
    protected $uri;
    protected $name;
    protected $dispatches = [];

    public function __construct( Router $router = null )
    {
        parent::__construct();
        $this->router = is_null($router) ? $this->context()->router() : $router;
    }

    public function method( $method )
    {
        $this->method = $method;
        return $this;
    }

    public function target( Uri $uri )
    {
        $this->uri = Uri::parse($uri);
        return $this;
    }

    public function name( $name )
    {
        $this->name = $name;
        return $this;
    }

    public function call( $handler )
    {
        $this->dispatches[] = Handler::parse($handler);
        return $this;
    }

    public function getFirstandler()
    {
        return reset($this->dispatches);
    }

    public function getHandlerList()
    {
        return $this->dispatches;
    }

    public function sub( \Closure $closure )
    {
        $router = $this->router->createRouteFactory($this->uri);
        $router->setPatcher($this->router);
        Tool\Dispatcher::call($closure, [ $router ]);
        return $this;
    }

}
