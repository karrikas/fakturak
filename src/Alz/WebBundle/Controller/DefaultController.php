<?php

namespace Alz\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AlzWebBundle:Default:index.html.twig');
    }
}
