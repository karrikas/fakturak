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
        return $this->render('AlzAppBundle:Factura:listado.html.twig', array());
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
        $factura->setFecha(date('Y-m-d'));
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

        $form = $this->createForm(new FacturaType(), $factura);
        $form->handleRequest($request);

        if ($form->isValid()) {
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
}

