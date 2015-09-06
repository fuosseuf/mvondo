<?php

namespace Mvondo\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class MvondoUserBundle extends Bundle
{
    public function getParent() {
        return 'FOSUserBundle';
    }
}
