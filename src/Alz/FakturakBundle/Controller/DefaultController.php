<?php

namespace Alz\FakturakBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AlzFakturakBundle::index.html.twig');
    }
}
