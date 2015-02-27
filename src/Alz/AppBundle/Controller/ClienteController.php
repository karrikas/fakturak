<?php
namespace Alz\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Alz\AppBundle\Entity\Cliente;
use Alz\AppBundle\Entity\ClienteRepository;
use Alz\AppBundle\Entity\Empresa;
use Alz\AppBundle\Form\ClienteType;

class ClienteController extends AlzController
{
    public function ListadoAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $clientes = $em->getRepository('AlzAppBundle:Cliente')
        ->findByUser($this->getUser()->getId());

        $paginator  = $this->get('knp_paginator');
        $clientes = $paginator->paginate(
            $clientes,
            $request->query->get('page', 1),
            10
        );

        return $this->render('AlzAppBundle:Cliente:listado.html.twig', array(
            'clientes' => $clientes
        ));
    }

    public function VerAction(Request $request)
    {
        $cliente = $this->getDoctrine()
        ->getRepository('AlzAppBundle:Cliente')
        ->find($request->get('id'));

        $this->checkEmpresa($cliente->getEmpresa()->getId());

        if (!$cliente) {
            throw $this->createNotFoundException();
        }

        return $this->render('AlzAppBundle:Cliente:ver.html.twig', array(
            'cliente' => $cliente
        ));
    }

    public function NuevoAction(Request $request)
    {
        $cliente = new Cliente();

        $form = $this->createForm(new ClienteType(), $cliente);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $cliente->setEmpresa($this->getEmpresa());
            $em = $this->getDoctrine()->getManager();
            $em->persist($cliente);
            $em->flush();

            $request->getSession()->getFlashBag()->add(
                'success',
                $this->get('translator')->trans('Los datos se han guardado.')
            );

            return $this->redirect($this->generateUrl('alz_app_cliente_ver', array('id' => $cliente->getId())));
        }
        
        return $this->render('AlzAppBundle:Cliente:editar.html.twig', array(
            'form' => $form->createView(),
            'nuevo' => true
        ));
    }

    public function EditarAction(Request $request)
    {
        $cliente = $this->getDoctrine()
        ->getRepository('AlzAppBundle:Cliente')
        ->find($request->get('id'));

        $this->checkEmpresa($cliente->getEmpresa()->getId());

        if (!$cliente) {
            throw $this->createNotFoundException();
        }

        $form = $this->createForm(new ClienteType(), $cliente);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($cliente);
            $em->flush();

            $request->getSession()->getFlashBag()->add(
                'success',
                $this->get('translator')->trans('Los datos se han guardado.')
            );

            return $this->redirect($this->generateUrl('alz_app_cliente_ver', array('id' => $cliente->getId())));
        }
        
        return $this->render('AlzAppBundle:Cliente:editar.html.twig', array(
            'form' => $form->createView(),
            'nuevo' => false
        ));
    }
}
