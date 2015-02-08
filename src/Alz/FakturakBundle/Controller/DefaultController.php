<?php

namespace Alz\FakturakBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('AlzFakturakBundle:Default:index.html.twig', array('name' => $name));
    }
}
