<?php

namespace Kanya\Core\Kanya\Tool;


class Dispatcher extends KanyaClass
{

    public static function call( $callable, $args = [] )
    {
        if ( !is_callable($callable) ) {
            throw new \InvalidArgumentException('$callable must be callable');
        }

        $args = is_array($args) ? $args : [ $args ];

        switch ( count($args) ) {
            case 0:
                return $callable();
            case 1:
                return $callable(array_shift($args));
            case 2:
                return $callable(array_shift($args), array_shift($args));
            case 3:
                return $callable(array_shift($args), array_shift($args), array_shift($args));
            case 4:
                return $callable(array_shift($args), array_shift($args), array_shift($args), array_shift($args));
            case 5:
                return $callable(array_shift($args), array_shift($args), array_shift($args), array_shift($args), array_shift($args));
            case 6:
                return $callable(array_shift($args), array_shift($args), array_shift($args), array_shift($args), array_shift($args), array_shift($args));
            default:
                return call_user_func_array($callable, $args);
        }
    }

}
