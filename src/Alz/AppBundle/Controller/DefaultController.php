<?php

namespace Alz\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Alz\AppBundle\Entity\Empresa;
use Alz\AppBundle\Entity\UserClone;
use Alz\AppBundle\Form\EmpresaType;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $e = new Empresa();
        $e->setNombre("proba bat" . rand());
        $em = $this->getDoctrine()->getManager();
        $em->persist($e);
        $em->flush();

        /*
        $uc = new UserClone();
        $uc->setId(12);
        $em = $this->getDoctrine()->getManager();
    $em->persist($uc);
    $em->flush();
         */
        $uc = $this->getDoctrine()
        ->getRepository('AlzAppBundle:UserClone')
        ->find(12);

        $uc->addEmpresa($e);
        $em = $this->getDoctrine()->getManager();
        $em->persist($uc);
        $em->flush();


        $form = $this->createForm(new EmpresaType(), $e);
        

        return $this->render('AlzAppBundle:Default:index.html.twig', array('form' => $form->createView()));
    }
}
