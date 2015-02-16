<?php

namespace Alz\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class ApiController extends Controller
{
    public function clienteGetAction(Request $request)
    {
        $id = $request->get('id');

        $cliente = $this->getDoctrine()
        ->getRepository('AlzAppBundle:Cliente')
        ->find($id);


        if (!$cliente) {
            return new JsonResponse();
        }

        echo $cliente->getEmpresa()->getNombre();

        $arr = array(
            'nombre' => $cliente->getNombre(),
            'cif' => $cliente->getCif(),
            'direccion1' => $cliente->getDireccion1(),
            'direccion2' => $cliente->getDireccion2(),
            'cp' => $cliente->getCp(),
            'region' => $cliente->getRegion(),
            'ciudad' => $cliente->getCiudad(),
            'telefono' => $cliente->getTelefono(),
            'fax' => $cliente->getFax(),
            'email' => $cliente->getEmail(),
        );

        return new JsonResponse($arr);
    }
}
