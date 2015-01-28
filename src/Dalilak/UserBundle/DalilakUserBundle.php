<?php

namespace Dalilak\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class DalilakUserBundle extends Bundle {
	public function getParent() {
        return 'FOSUserBundle';
    }
}
