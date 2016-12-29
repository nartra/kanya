<?php

namespace Kanya\Core\Kanya;

class KanyaClass {

    public function kanya() {
        return Initializer::sharedInstance()->getHandler();
    }

}
