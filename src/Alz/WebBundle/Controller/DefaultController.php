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
     * Action
     * @param object $request
     *
     * @return object
     */
    public function contactoAction($request)
    {
        $form = $this->createFormBuilder()
            ->add('nombre', 'text', array('label' => 'Tu nombre'))
            ->add('email', 'email', array('label' => 'E-mail de contacto'))
            ->add('mensaje', 'textarea', array('label' => '¿Qué quieres saber?'))
            ->add('submit', 'submit', array('label' => 'Preguntar'))
            ->getForm();

        $form->handleRequest($request);

        $enviado = false;
        if ($form->isValid()) {
            $fReq = $request->get('form');
            $mailer = $this->get('mailer');
            $message = $mailer->createMessage()
                ->setSubject('[sisfacturacion.com] Pregunta')
                ->setFrom($fReq['email'])
                ->setTo('karrikas@gmail.com')
                ->setBody('Pregunta de ' . $fReq['nombre'] . ":\r\r" . $fReq['mensaje']);

            $mailer->send($message);
            $enviado = true;
        }

        return $this->render('AlzWebBundle:Default:contacto.html.twig', array(
            'form' => $form->createView(),
            'enviado' => $enviado
        ));
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
