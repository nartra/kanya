<?php

/**
 * call Kanya Object shorthand
 * @return \Kanya\Core\Kanya
 */
function kanya()
{
    return \Kanya\Core\Initializer::sharedInstance()->getHandler();
}
