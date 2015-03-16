<?php
namespace Alz\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Alz\AppBundle\Entity\Factura;
use Alz\AppBundle\Form\FacturaType;
use Ps\PdfBundle\Annotation\Pdf;
use Alz\AppBundle\Controller\AppInController;

/**
 * controller
 */
class FacturaController extends AlzController
{
    /**
     * action
     * @param Request $request
     *
     * @return object
     */
    public function ListadoAction(Request $request)
    {
        $ema = $this->getDoctrine()->getManager();
        $facturas = $ema->getRepository('AlzAppBundle:Factura')
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

    /**
     * action
     *
     * @return object
     */
    public function NuevoAction()
    {
        $empresa = $this->getEmpresa();
        $ema = $this->getDoctrine()->getManager();
        $numerofactura = $ema->getRepository('AlzAppBundle:Factura')
        ->getNumero($this->getUser()->getId(), date('Y'));

        $direccion = '';
        $direccion .= $empresa->getNombre() . "\r";
        $direccion .= $empresa->getCif() . "\r";
        $direccion .= $empresa->getDireccion1() . "\r";
        $direccion .= $empresa->getCiudad() . "\r";
        if ($empresa->getCp() != null) {
            $direccion .= $empresa->getCp() . "\r";
        }
        if ($empresa->getRegion() != null) {
            $direccion .= $empresa->getRegion() . "\r";
        }

        $factura = new Factura();
        $factura->setEmpresa($empresa);
        $factura->setEmpresainfo($direccion);
        $factura->setNumero($numerofactura);
        $factura->setFecha(new \DateTime(date('Y-m-d')));
        $ema = $this->getDoctrine()->getManager();
        $ema->persist($factura);
        $ema->flush();


        return $this->redirect($this->generateUrl('alz_app_factura_editar', array('id' => $factura->getId())));
    }

    /**
     * action
     * @param Request $request
     *
     * @return object
     */
    public function EditarAction(Request $request)
    {
        $factura = $this->getDoctrine()
        ->getRepository('AlzAppBundle:Factura')
        ->find($request->get('id'));

        $this->checkEmpresa($factura->getEmpresa()->getId());

        $form = $this->createForm(new FacturaType(), $factura);
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

            $ema = $this->getDoctrine()->getManager();
            $ema->persist($factura);
            $ema->flush();

            $descargar = $request->get('descargar');
            if (null !== $descargar) {
                return $this->redirect($this->generateUrl('alz_app_factura_descargar', array('id' => $factura->getId())));
            }

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

    /**
     * action
     * @param Request $request
     *
     * @return object
     */
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

    /**
     * action
     * @param integer $ida
     * @param Request $request
     *
     * @return object
     */
    public function eliminarAction($ida, Request $request)
    {
        $factura = $this->getDoctrine()
        ->getRepository('AlzAppBundle:Factura')
        ->find($ida);

        $this->checkEmpresa($factura->getEmpresa()->getId());

        $ema = $this->getDoctrine()->getManager();
        $ema->remove($factura);
        $ema->flush();

        $request->getSession()->getFlashBag()->add(
            'danger',
            $this->get('translator')->trans('Los datos se han eliminado.')
        );

        return $this->redirect($this->generateUrl('alz_app_factura_listado'));
    }

    /**
     * @Pdf()
     * @param integer $id
     *
     * @return object
     */
    public function descargarAction($id)
    {
        $factura = $this->getDoctrine()
        ->getRepository('AlzAppBundle:Factura')
        ->find($id);

        $this->checkEmpresa($factura->getEmpresa()->getId());

        $logo = null;
        if ($factura->getEmpresa()->getLogo()) {
            $logo = __DIR__ . '/../../../../web/empresa/' . $factura->getEmpresa()->getLogo();
        }
        $logosis = __DIR__ . '/../../../../web/images/logo.png';

        $response = new Response();
        $response = $this->render('AlzAppBundle:Factura:descargar.pdf.twig', array(
            'filename' => 'proba',
            'conceptosextra' => 15 - count($factura->getConceptos()),
            'factura' => $factura,
            'logo' => $logo,
            'logosis' => $logosis
        ));

        $filename = sprintf('%s_%s.pdf',
            $factura->getFecha()->format('Y-m-d'),
            $factura->getNumero()
        );

        $response->headers->set('Content-Type', 'application/pdf');
        $response->headers->set('Content-Disposition', 'attachment; filename="' . $filename . '"');

        return $response;
    }
}
