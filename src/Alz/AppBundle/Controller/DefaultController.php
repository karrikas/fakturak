<?php
namespace Alz\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Alz\AppBundle\Entity\Empresa;
use Alz\AppBundle\Entity\UserClone;
use Alz\AppBundle\Form\EmpresaType;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Response;

/**
 * controller
 */
class DefaultController extends AlzController
{
    /**
     * action
     *
     * @return object
     */
    public function indexAction()
    {
        return $this->redirect($this->generateUrl('alz_app_factura_listado'));
    }

    /**
     * action
     *
     * @return object
     */
    public function premiumComprarAction()
    {
        $empresa = $this->getEmpresa();

        return $this->render('AlzAppBundle:Default:premium-comprar.html.twig', array(
            'empresa' => $empresa
        ));
    }

    /**
     * action
     *
     * @return object
     */
    public function premiumCancelarAction()
    {
        $response = new Response();
        $response->headers->clearCookie('premium');
        $response->send();

        return $this->redirect($this->generateUrl('alz_app_homepage'));
    }

    /**
     * action
     *
     * @return object
     */
    public function premiumPaypalCancelarAction()
    {
        return $this->render('AlzAppBundle:Default:premium-paypal-cancelar.html.twig', array());
    }

    /**
     * action
     *
     * @return object
     */
    public function premiumPaypalOkAction()
    {
        return $this->render('AlzAppBundle:Default:premium-paypal-ok.html.twig', array());
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
            ->add('nombre', 'hidden')
            ->add('email', 'hidden')
            ->add('mensaje', 'textarea', array('label' => '¿Necesitas ayuda? Envianos tu consulta.'))
            ->add('submit', 'submit', array('label' => 'Preguntar'))
            ->getForm();

        $form->setData(array(
            'email' => $this->getUser()->getEmail(),
            'nombre' => $this->getUser()->getUsername()
        ));

        $form->handleRequest($request);

        $enviado = false;
        if ($form->isValid()) {
            $fReq = $request->get('form');
            $mailer = $this->get('mailer');
            $message = $mailer->createMessage()
                ->setSubject('[sisfacturacion.com][In App] Pregunta')
                ->setFrom($fReq['email'])
                ->setTo('karrikas@gmail.com')
                ->setBody('Pregunta de ' . $fReq['nombre'] . ":\r\r" . $fReq['mensaje']);

            $mailer->send($message);
            $enviado = true;
        }

        return $this->render('AlzAppBundle:Default:contacto.html.twig', array(
            'form' => $form->createView(),
            'enviado' => $enviado
        ));
    }

}
