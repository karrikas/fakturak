<?php
namespace Alz\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Alz\AppBundle\Entity\Empresa;
use Alz\AppBundle\Entity\UserClone;
use Alz\AppBundle\Form\EmpresaType;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends AlzController
{
    public function indexAction(Request $request)
    {
        return $this->redirect($this->generateUrl('alz_app_factura_listado'));
    }

    public function premiumComprarAction(Request $request)
    {
        return $this->render('AlzAppBundle:Default:premium-comprar.html.twig', array());
    }

    public function premiumCancelarAction(Request $request)
    {
        
        $response = new Response();
        $response->headers->clearCookie('premium');
        $response->send();

        return $this->redirect($this->generateUrl('alz_app_homepage'));
    }
}
