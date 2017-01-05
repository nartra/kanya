<?php

namespace Kanya\Core\Kanya;


class Initializer extends KanyaClass
{
    use \Kanya\Core\Kanya\Tool\Singleton;

    private $context;

    public function setBasePath( $path )
    {
        
    }

    public function setApplicationPath( $path )
    {
        
    }

    public function setGlobalPath( $path )
    {
        
    }

    public function make( $kanya = null )
    {
        $context = Kanya::parse($kanya);
        $this->context = $context instanceof Context ? $context : $this->getDefaultContext();
    }

    public function getContext()
    {
        if ( !$this->context ) {
            $this->make();
        }

        return $this->context;
    }

    protected function getDefaultContext()
    {
        return new Kanya();
    }

}
