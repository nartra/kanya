<?php

namespace Kanya\Core\Kanya;

class Controller extends KanyaClass {
    
    protected $kanya;
            
    function __construct(Context $context){
        parent::__construct($context);
        $this->kanya = Kanya::parse($context);
    }
        
}
