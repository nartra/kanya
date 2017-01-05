<?php

namespace Kanya\Core\Kanya;

abstract class KanyaClass {

    public function context() {
        return Initializer::sharedInstance()->getHandler();
    }
    
    public static function parse($any){
        
        if(is_object($any) && $any instanceof KanyaClass){
            return $any;
        }
        
        return null;
    }

}
