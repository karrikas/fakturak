<?php

namespace Alz\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AlzWebBundle:Default:index.html.twig');
    }

    public function faqsAction()
    {
        return $this->render('AlzWebBundle:Default:faqs.html.twig');
    }

    public function preciosAction()
    {
        return $this->render('AlzWebBundle:Default:precios.html.twig');
    }
}
