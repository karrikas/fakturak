<?php

namespace Alz\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class AlzUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
