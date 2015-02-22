<?php
namespace Alz\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Alz\AppBundle\Entity\Empresa;
use Alz\AppBundle\Form\EmpresaType;

class EmpresaController extends AlzController
{
    public function VerAction()
    {
        $user = $this->getDoctrine()
        ->getRepository('AlzAppBundle:UserClone')
        ->find($this->getUser()->getId());

        // erabiltzailea ez badago definitua
        if (is_null($user)) {
            return $this->redirect($this->generateUrl('alz_app_empresa_editar'));
        }

        $empresas = $user->getEmpresas();
        foreach ($empresas as $empresa);

        // empresa oraindik ez bada konfiguratu
        if (!isSet($empresa)) {
            return $this->redirect($this->generateUrl('alz_app_empresa_editar'));
        }

        return $this->render('AlzAppBundle:Empresa:ver.html.twig', array(
            'empresa' => $empresa,
        ));
    }

    public function EditarAction(Request $request)
    {
        $user = $this->getDoctrine()
        ->getRepository('AlzAppBundle:UserClone')
        ->find($this->getUser()->getId());

        if (is_null($user)) {
            $empresa = new Empresa();
        } else {
            $empresas = $user->getEmpresas();
            foreach ($empresas as $empresa);
        }

        if (!isSet($empresa)) {
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
            }

            $request->getSession()->getFlashBag()->add(
                'success',
                $this->get('translator')->trans('Los datos se han guardado.')
            );

            return $this->redirect($this->generateUrl('alz_app_empresa_ver'));
        }

        return $this->render('AlzAppBundle:Empresa:editar.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
