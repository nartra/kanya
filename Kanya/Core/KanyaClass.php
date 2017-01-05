<?php

namespace Kanya\Core\Kanya;


abstract class KanyaClass
{

    public function context()
    {
        return Initializer::sharedInstance()->getContext();
    }

    public static function parse( $any )
    {

        if ( !$any ) {
            return null;
        }

        if ( is_object($any) && $any instanceof static ) {
            return $any;
        }
        
        if( class_exists($any) && is_subclass_of($any, static::class)){
            
        }

        return null;
    }

}
