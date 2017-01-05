<?php

namespace Kanya\Core\Middleware;

use \Kanya\Core\Kanya\Handler;


abstract class Middleware extends Handler
{

    public function invoke()
    {
        $this->run($this->getNextHandler());
    }

    abstract function run( Handler $next );

}
