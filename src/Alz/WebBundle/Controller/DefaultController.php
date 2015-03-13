<?php

namespace Alz\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Response;

/**
 * Controller
 */
class DefaultController extends Controller
{
    /**
     * index
     *
     * @return object
     */
    public function indexAction()
    {
        return $this->render('AlzWebBundle:Default:index.html.twig');
    }

    /**
     * index
     *
     * @return object
     */
    public function faqsAction()
    {
        return $this->render('AlzWebBundle:Default:faqs.html.twig');
    }

    /**
     * index
     *
     * @return object
     */
    public function preciosAction()
    {
        return $this->render('AlzWebBundle:Default:precios.html.twig');
    }

    /**
     * index
     *
     * @return object
     */
    public function hacerFacturasAction()
    {
        return $this->render('AlzWebBundle:Default:hacer-facturas.html.twig');
    }

    /**
     * index
     *
     * @return object
     */
    public function toPremiumAction()
    {
        $response = new Response();
        $response->headers->setCookie(new Cookie('premium', 'on'));
        $response->send();

        return $this->redirect($this->generateUrl('fos_user_registration_register'));
    }
}
