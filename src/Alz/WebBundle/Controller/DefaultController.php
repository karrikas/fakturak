<?php

namespace Alz\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Response;

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

    public function toPremiumAction()
    {
        $response = new Response();
        $response->headers->setCookie(new Cookie('premium', 'on'));
        $response->send();
        
        return $this->redirect($this->generateUrl('fos_user_registration_register'));
    }
}
