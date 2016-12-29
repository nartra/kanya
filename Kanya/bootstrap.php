<?php

namespace {

    //Kanya autoload
    require __DIR__ . 'Core/autoload.php';

    //Composer autoload
    require __DIR__ . 'vendor/autoload.php';

    //get Initializer instance
    return Kanya\Core\Initializer::sharedInstance();
}