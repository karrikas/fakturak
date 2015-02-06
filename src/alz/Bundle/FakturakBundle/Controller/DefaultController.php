<?php

namespace alz\Bundle\FakturakBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('alzFakturakBundle:Default:index.html.twig', array('name' => $name));
    }
}
