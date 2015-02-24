<?php
namespace Alz\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Alz\AppBundle\Entity\FacturaConcepto;

class ApiController extends AlzController
{
    public function ClienteGetAction(Request $request)
    {
        $id = $request->get('id');
        if (is_null($id)) {
            throw $this->createNotFoundException();
        }
            
        $cliente = $this->getDoctrine()
        ->getRepository('AlzAppBundle:Cliente')
        ->find($id);

        if (count($cliente) == 0) {
            throw $this->createNotFoundException();
        }

        $this->checkEmpresa($cliente->getEmpresa()->getId());

        $result = $this->getDoctrine()
            ->getRepository('AlzAppBundle:Cliente')
            ->createQueryBuilder('c')
            ->select('c')
            ->where('c.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

        return new JsonResponse($result[0]);
    }

    public function ClientePostAction(Request $request)
    {
    }

    public function FacturaconceptosGetAction(Request $request)
    {
        $factura_id = $request->get('facturaid');

        $factura = $this->getDoctrine()
        ->getRepository('AlzAppBundle:Factura')
        ->find($factura_id);

        if (count($factura) == 0) {
            throw $this->createNotFoundException();
        }

        $this->checkEmpresa($factura->getEmpresa()->getId());

        $result = $this->getDoctrine()
            ->getRepository('AlzAppBundle:FacturaConcepto')
            ->createQueryBuilder('fc')
            ->select('fc')
            ->where('fc.factura = :facturaid')
            ->setParameter('facturaid', $factura_id)
            ->getQuery()
            ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

        return new JsonResponse($result);
    }

    public function FacturaconceptoPutAction(Request $request)
    {
        $data = json_decode($request->getContent(), true);

        $factura = $this->getDoctrine()
        ->getRepository('AlzAppBundle:Factura')
        ->find($data['facturaid']);

        $concepto = new FacturaConcepto();
        $concepto->setNombre($data['nombre']);
        $concepto->setPrecio($data['precio']);
        $concepto->setCantidad((int)$data['cantidad']);
        $concepto->setIva((int)$data['iva']);
        $concepto->setTotal((float)$data['total']);
        $concepto->setTotaliva((float)$data['totaliva']);
        $concepto->setFactura($factura);

        $validator = $this->get('validator');
        $errors = $validator->validate($concepto);

        if(count($errors) > 0) {
            foreach($errors as $err) {
                var_dump($err->getMessage());
            }
            $response = new Response();
            //$response->setStatusCode(500);
            return $response;
        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($concepto);
        $em->flush();

        return new JsonResponse();
    }

    public function FacturaconceptoDeleteAction($id)
    {
        $concepto = $this->getDoctrine()
        ->getRepository('AlzAppBundle:FacturaConcepto')
        ->find($id);

        $empresaId = $concepto->getFactura()->getEmpresa()->getId();
        $this->checkEmpresa($empresaId);

        $em = $this->getDoctrine()->getManager();
        $em->remove($concepto);
        $em->flush();

        return new JsonResponse();
    }
}
