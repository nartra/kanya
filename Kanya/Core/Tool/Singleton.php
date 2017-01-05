<?php

namespace Kanya\Core\Kanya\Tool;


trait Singleton
{

    protected static $instances = [];

    public static function sharedInstance()
    {
        $class = static::class;
        if ( !isset(self::$instances[$class]) ) {
            self::$instances[$class] = static::newSingletonInstance();
        }
        return self::$instances[$class];
    }

    public static function newSingletonInstance()
    {
        return new static();
    }

}
