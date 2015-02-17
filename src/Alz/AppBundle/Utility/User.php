<?php
namespace Acme\DemoBundle\Utility;

class User
{
    public function __construct($em)
    {
        $this->em = $em;
    }

    public function add($a, $b)
    {
        return $a + $b;
    }
}
