<?php

namespace Alz\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Alz\AppBundle\Entity\Empresa;
use Alz\AppBundle\Entity\UserClone;
use Alz\AppBundle\Form\EmpresaType;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        /*
        $request->getSession()->getFlashBag()->add(
            'success',
            'Your changes were saved!'
        );
         */
        return $this->render('AlzAppBundle:Default:index.html.twig');
    }

    public function configuracionAction()
    {
        $user = $this->getDoctrine()
        ->getRepository('AlzAppBundle:UserClone')
        ->find($this->getUser()->getId());

        if (!is_null($user)) {
            $empresas = $user->getEmpresas();
            foreach ($empresas as $empresa);
        } else {
            return $this->redirect($this->generateUrl('alz_app_configuracion_editar'));
        }

        $form = $this->createForm(new EmpresaType(), $empresa);

        return $this->render('AlzAppBundle:Default:configuracion.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function configuracionEditarAction(Request $request)
    {
        $user = $this->getDoctrine()
        ->getRepository('AlzAppBundle:UserClone')
        ->find($this->getUser()->getId());

        if (!is_null($user)) {
            $empresas = $user->getEmpresas();
            foreach ($empresas as $empresa);
        } else {
            $empresa = new Empresa();
        }

        $form = $this->createForm(new EmpresaType(), $empresa);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($empresa);
            $em->flush();

            if (is_null($user)) {
                $user = new UserClone();
                $user->setId($this->getUser()->getId());
                $user->addEmpresa($empresa);
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();

                $request->getSession()->getFlashBag()->add(
                    'success',
                    $this->get('translator')->trans('Los datos se han guardado.')
                );

                return $this->redirect($this->generateUrl('alz_app_configuracion'));
            }
        }

        return $this->render('AlzAppBundle:Default:configuracion-editar.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
