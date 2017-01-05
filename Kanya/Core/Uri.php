<?php

namespace Kanya\Core\Kanya;

class Uri extends KanyaClass {
    
    private $original_uri;

    public function __construct($uri = null) {
        parent::__construct();
        $this->original_uri = $uri;
    }
    
    public function addBaseUri($base_uri){
        
    }

    public static function create($any){
        if($uri = Uri::parse($any)){
            return $uri;
        }
        return new static($any);
    }
    
}