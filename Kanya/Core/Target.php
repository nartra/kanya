<?php

namespace Kanya\Core\Kanya;

class Target extends KanyaClass {
    
    private $original_uri;

    public function __construct($uri = null) {
        parent::__construct();
        $this->original_uri = $uri;
    }
    
    public function addBaseUri($base_uri){
        
    }

    public static function create($any){
        if($uri = Target::parse($any)){
            return $uri;
        }
        return new static($any);
    }
    
}