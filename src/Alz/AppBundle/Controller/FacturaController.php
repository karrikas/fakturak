<?php
namespace Alz\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Alz\AppBundle\Entity\Factura;
use Alz\AppBundle\Form\FacturaType;

class FacturaController extends AlzController
{
    public function ListadoAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $facturas = $em->getRepository('AlzAppBundle:Factura')
        ->findByUser($this->getUser()->getId());

        $paginator  = $this->get('knp_paginator');
        $facturas = $paginator->paginate(
            $facturas,
            $request->query->get('page', 1),
            10
        );

        return $this->render('AlzAppBundle:Factura:listado.html.twig', array(
            'facturas' => $facturas
        ));
    }

    public function NuevoAction(Request $request)
    {
        $empresa = $this->getEmpresa();
        $em = $this->getDoctrine()->getManager();
        $numerofactura = $em->getRepository('AlzAppBundle:Factura')
        ->getNumero($this->getUser()->getId(), date('Y'));

        $direccion = <<<DIRECCION
{$empresa->getNombre()}\n
{$empresa->getDireccion1()}\n
{$empresa->getDireccion2()}\n
{$empresa->getRegion()} {$empresa->getCiudad()} {$empresa->getCp()}
DIRECCION;

        $factura = new Factura();
        $factura->setEmpresa($empresa);
        $factura->setEmpresainfo($direccion);
        $factura->setNumero($numerofactura);
        $factura->setFecha(new \DateTime(date('Y-m-d')));
        $em = $this->getDoctrine()->getManager();
        $em->persist($factura);
        $em->flush();


        return $this->redirect($this->generateUrl('alz_app_factura_editar', array('id' => $factura->getId())));
    }

    public function EditarAction(Request $request)
    {
        $factura = $this->getDoctrine()
        ->getRepository('AlzAppBundle:Factura')
        ->find($request->get('id'));

        $this->checkEmpresa($factura->getEmpresa()->getId());

        $form = $this->createForm(new FacturaType(), $factura, array('attr' => array('user_id' => $this->getUser()->getId())));
        $form->handleRequest($request);

        if ($form->isValid()) {
            $conceptos = $this->getDoctrine()
            ->getRepository('AlzAppBundle:FacturaConcepto')
            ->findByFactura($request->get('id'));

            $total = 0;
            $totaliva = 0;
            foreach ($conceptos as $concepto) {
                $total += $concepto->getTotal();
                $totaliva += $concepto->getTotaliva();
            }

            $factura->setTotal($total);
            $factura->setTotaliva($totaliva);

            $em = $this->getDoctrine()->getManager();
            $em->persist($factura);
            $em->flush();

            $request->getSession()->getFlashBag()->add(
                'success',
                $this->get('translator')->trans('Los datos se han guardado.')
            );

            return $this->redirect($this->generateUrl('alz_app_factura_ver', array('id' => $factura->getId())));
        }
        
        return $this->render('AlzAppBundle:Factura:editar.html.twig', array(
            'form' => $form->createView(),
            'empresa' => $this->getEmpresa(),
            'factura' => $factura,
            'nuevo' => true
        ));
    }

    public function verAction(Request $request)
    {
        $factura = $this->getDoctrine()
        ->getRepository('AlzAppBundle:Factura')
        ->find($request->get('id'));

        $this->checkEmpresa($factura->getEmpresa()->getId());

        $conceptos = $this->getDoctrine()
        ->getRepository('AlzAppBundle:FacturaConcepto')
        ->findByFactura($request->get('id'));

        return $this->render('AlzAppBundle:Factura:ver.html.twig', array(
            'factura' => $factura,
            'conceptos' => $conceptos
        ));
    }

    public function eliminarAction($id, Request $request)
    {
        $factura = $this->getDoctrine()
        ->getRepository('AlzAppBundle:Factura')
        ->find($id);

        $this->checkEmpresa($factura->getEmpresa()->getId());

        $em = $this->getDoctrine()->getManager();
        $em->remove($factura);
        $em->flush();

        $request->getSession()->getFlashBag()->add(
            'danger',
            $this->get('translator')->trans('Los datos se han eliminado.')
        );

        return $this->redirect($this->generateUrl('alz_app_factura_listado'));
    }
}
